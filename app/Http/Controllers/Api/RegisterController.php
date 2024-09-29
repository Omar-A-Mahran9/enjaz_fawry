<?php

namespace App\Http\Controllers\Api;

use App\User;
// use App\Client;
use App\Setting;
// use App\Terms;
use App\SentSms;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Mail;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
      //  $this->middleware('guest:client');

    }


    protected function createClient(Request $request)
    {

        $verifyCode =  rand(1111, 9999);


        $request->validate([
            'phone' => ['required', 'digits:10', 'unique:users','min:10','max:10', 'regex:/^[0-9]+$/'],
            'name' => ['required'],
          //  'identity_no' => ['required', 'digits:10', 'unique:users,identity_no','min:10','max:10', 'regex:/^[0-9]+$/'],
            'email' => ['required', 'unique:users', 'email:rfc,dns'],
            'type' => ['required'],
            'password' => ['required', 'min:6', 'string','confirmed'],
            'approve' => ['required'],
            'firebase_token' => 'required',
        ]);


        $tNumber = translateNumber($request->phone);
        $vNumber = validNumber($tNumber);


       
        $client = User::create([
            'name' => $request['name'],
            'phone' => $request['phone'],     
            'email' => $request['email'],
            'status' => 1,
            'type' => $request['type'],
            'verification_code' => $verifyCode,
            'password' => Hash::make($request['password']),
            'mail_token' => sha1(time()),
            'firebase_token' => $request['firebase_token'],
            'phone_status' => 0,
        ]);

      
        // create account No 

        $insertedId = $client->id;

        $client->account_no = ($insertedId+50050);
        
        $client->save();

        $tokenResult = $client->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(6);
        $token->save();


                
        // $new_msg = "تنبيه عزيزي العميل موقع انجاز فوري لاينفذ طلبات قرض بنك التنميه التسليف
        //         نأمل عدم الأنسياق خلف المحتالين وإعطاء رقمك لأحد نظراً لكثرة الاحتيال الإلكتروني
        //     للأستفسار 0566661105 - 
        //     رقم التفعيل هو :" . $verifyCode;

        $new_msg = " إنجاز فوري: رمز التفعيل الخاص بك : ". $verifyCode;

        $send = senSMS($vNumber, $new_msg);

      //  return $send['statusCode'];
        if( $send['statusCode'] == '201' ){

            $sentSMS = new SentSms;

            $sentSMS->user_id =  $client->id;
            $sentSMS->content =  $new_msg;
            $sentSMS->status = 1;
            $sentSMS->save();

            $sms_status = array(
                'status' => 1,
                'type' => 'success',
                'msg' => 'تم الارسال بنجاح'
            );

            


        }else{
            
            $sms_status = array(
                'status' => 1,
                'type' => 'warning',
                'msg' => ' خطأ اثناء الارسال رمز التحقق',

            );
        }


        $data = array(
            'user_name' => $client->name,
            'mail_token' => $client->mail_token,
            'email' => $client->email,
            'account_no' => $client->account_no,
        );
            

        //$setting = Setting::first();

        Mail::send('customEmail.clients.register_user', $data, function($message) use ($data){
            $message->from('no-replay@enjaz-fawry.com');
            $message->to($data['email']);
            $message->subject('انجاز فوري : تفعيل حسابك');
        });

        $cid = $client->id;

        //Auth::loginUsingId($cid);

       // $hashed_otp = Hash::make($verifyCode);

        //session(['otp' => $hashed_otp, 'cid' => $cid]);

        //$access_token = $client->createToken('authToken');


       // return response(['response' => $notification, 'user' => $client, 'access_token' => $access_token, 'otp' => $verifyCode,]);


        return response()->json([
            'status' => 1,
            'msg' => 'تم التسجيل بنجاح',
            'sms_status' => $sms_status,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse( $tokenResult->token->expires_at )->toDateTimeString(),
            'client_id' => $client->id,
            'phone' => $client->phone,
            'phone_status' => $client->phone_status,
            'otp' => $verifyCode,
        ]);

        
    }

    protected function forgetPaswordSendCode(Request $r){

        $r->validate([
            'mobile' => ['required', 'digits:10','min:10','max:10', 'regex:/^[0-9]+$/'],
        ]);

        $user = User::where('phone',  $r->mobile)->first();




        if($user){

       
        $randCode =  rand(111111, 999999);

        $user->verification_code = $randCode;

        $user->save();


        $tNumber = translateNumber($user->phone);
        $vNumber = validNumber($tNumber);
        //$vNumber = validNumber($user->phone);

        $sms_msg = " إنجاز فوري: رمز التأكيد الخاص بك : ". $randCode;

        $send =  senSMS($vNumber, $sms_msg);


       // return response()->json($send);

        if( $send['statusCode'] == '201' ){

            $sentSMS = new SentSms;

            $sentSMS->user_id =  $user->id;
            $sentSMS->content =  $sms_msg;
            $sentSMS->status = 1;
            $sentSMS->save();


            $sms_status = array(
                'status' => 1 , 
                'msg' => 'تم الارسال بنجاح',
                'type' => 'success'
            );
          //  return response(['status' => 0, 'type' => 'error', 'msg' => 'خطأ في نوع الحساب']);
          return response()->json($sms_status);
        }else{
            
            $sms_status = array(
                'status' => 0,
                'type' => 'warning',
                'msg' => ' خطأ اثناء الارسال رمز التحقق',
            );

            return response()->json($sms_status);
        }

    }else{

        return response()->json([
            'status' => 0,
            'type' => 'error',
            'msg' => 'لم يتم ايجاد بيانات المستخدم المطلوب',
        ]);
    }


    }

    protected function saveNewPass(Request $r){
        $r->validate([
            'token' => ['required'],
            'mobile' => ['required', 'digits:10','min:10','max:10', 'regex:/^[0-9]+$/'],
            'password' => ['required', 'min:6', 'string','confirmed'],
        ]);

        $user = User::where('phone',  $r->mobile)->where('verification_code',  $r->token)->first();


        if($user){

            $user->password = Hash::make($r['password']);

            $user->save();


            return response()->json([
                'status' => 1,
                'type' => 'success',
                'msg' => 'تم تحديث كلمة المرور بنجاح',
            ]);

        }else{



            return response()->json([
                'status' => 0,
                'type' => 'error',
                'msg' => 'لم يتم ايجاد بيانات المستخدم المطلوب',
            ]);


        }


    }



    protected function createVendor(Request $request)
    {

        $verifyCode =  rand(1111, 9999);


        $valid = $request->validate([
            'phone' => ['required', 'digits:10', 'unique:users','min:10','max:10', 'regex:/^[0-9]+$/'],
            'name' => ['required'],
            'uploadFile' => ['required', 'mimes:jpeg,png,jpg,pdf'],
            'type' => ['required', 'in:2,3'],
            'identity_no' => ['required', 'digits:10', 'unique:users,identity_no','min:10','max:10', 'regex:/^[0-9]+$/'],
            'email' => ['required', 'unique:users','email:rfc,dns'],
            'password' => ['required', 'min:6', 'string','confirmed'],
            'approve' => ['required'],
            'firebase_token' => 'required',
        ]);


     

        if( $request->hasFile('uploadFile')){

            //file upload and check
            $fileExt            = $request->uploadFile->getClientOriginalExtension();
            $fileIdNameNew        = uniqid() . time() . '.' . $fileExt;
            $request->uploadFile->storeAs('public/ids', $fileIdNameNew);

            
        } else {

            $fileIdNameNew = null;
        }



    
        if($request->type == 2){
            $typo = 'vendor';
        }elseif($request->type == 3){
            $typo = 'vendorC';
        }else{
            return response()->json(['status' => 0 , 'type'=> 'error', 'msg'=> 'خطأ في نوع الحساب']);
        }


        $tNumber = translateNumber($request->phone);
        $vNumber = validNumber($tNumber);


        //$brand->brand_image = $fileIdNameNew;

        $client = User::create([
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'identity_no' => $request['identity_no'],
            'status' => 0,
            'identity_file' => $fileIdNameNew,
            'type' => $typo,
            'verification_code' => $verifyCode,
            'password' => Hash::make($request['password']),
            'mail_token' => sha1(time()),
            'firebase_token' => $request['firebase_token'],
            'phone_status' => 0,
        ]);


        // create account No 

        $insertedId = $client->id;

        $client->account_no = ($insertedId+60050);
        
        $client->save();

        
        $tokenResult = $client->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(6);
        $token->save();


        $sms_msg = " إنجاز فوري: رمز التفعيل الخاص بك : ". $verifyCode;

        $send =  senSMS($vNumber, $sms_msg);

        
        if( $send['statusCode'] == '201' ){

            $sentSMS = new SentSms;

            $sentSMS->user_id =  $client->id;
            $sentSMS->content =  $sms_msg;
            $sentSMS->status = 1;
            $sentSMS->save();


            $sms_status = array(
                'status' => 1 , 
                'msg' => 'تم الارسال بنجاح',
                'type' => 'success'
            );
          //  return response(['status' => 0, 'type' => 'error', 'msg' => 'خطأ في نوع الحساب']);

        }else{
            
            $sms_status = array(
                'status' => 1,
                'type' => 'warning',
                'msg' => ' خطأ اثناء الارسال رمز التحقق',
            );
        }


         $data = array(
            'user_name' => $client->name,
            'mail_token' => $client->mail_token,
            'email' => $client->email,
            'account_no' => $client->account_no,
        );
            

        //$setting = Setting::first();

        Mail::send('customEmail.clients.register_user', $data, function($message) use ($data){
            $message->from('no-replay@enjaz-fawry.com');
            $message->to($data['email']);
            $message->subject('انجاز فوري : تفعيل حسابك');
        });

        $cid = $client->id;


        if($request->type == 2){
            $typD = 'معقب';
        }elseif($request->type == 3){
            $typD = 'مكتب خدمات';
        }

        $data = array(
			'name' => $request->name,
			'phone' => $request->phone,
			'type' => $typD,
			'account_no' => $client->account_no,
			);


        $setting = Setting::first();

		Mail::send('customEmail.new_vendor', $data, function($message) use ($data,$setting){
			$message->from('no-replay@enjaz-fawry.com');
			$message->to($setting->email);
			$message->cc($setting->secmail);
			$message->subject('انجاز فوري : تسجيل '.$data['type'].' جديد - رقم '.$data['account_no']);
		});

      //  Auth::loginUsingId($cid);

      //  $hashed_otp = Hash::make($verifyCode);

       // session(['otp' => $hashed_otp, 'cid' => $cid]);


    //    $access_token = $client->createToken('authToken');

     //   return response()->json(['response' => $notification, 'user' => $client, 'access_token' => $access_token, 'otp' => $verifyCode]);


        return response()->json([
            'status' => 1,
            'msg' => 'تم التسجيل بنجاح',
            'sms_status' => $sms_status,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse( $tokenResult->token->expires_at )->toDateTimeString(),
            'client_id' => $client->id,
            'phone' => $client->phone,
            'phone_status' => $client->phone_status,
            'otp' => $verifyCode,
        ]);

        //return redirect()->route('verifyphone')->with($notification);
    }



    public function verifyPhone(Request $r)
    {

        $this->validate($r, [
            'code'   => 'required|min:4',
            //'client_id'   => 'required',
        ]);

        $user = request()->user();
        // return response()->json([
        //     'status' => request()->user(),
        // ]);

        if( $r->code !== null){

           // $hashed_otp = session('otp');
          //  $cid  = $r->client_id;
       //     $user = User::find($usr_id);

            if( $r->code ==  $user->verification_code ) {
                $user->markPhoneAsVerified();

                return response()->json([
                    'status' => 1,
                    'type' => 'success',
                    'msg' => 'تم تفعيل رقم الجوال بنجاح'
                ]);
            }else{
                //return back()->withErrors(['code' => ['الكود المدخل غير صحيح']]);

                return response()->json([
                    'status' => 0,
                    'type' => 'error',
                    'msg' => 'الكود المدخل غير صحيح',
                ]);
            }
        } else {
            return abort(404);
        }
    }


    public function resendOtp()
    {

        $user = request()->user();


        // $this->validate($r, [
        //     'client_id'   => 'required',
        // ]);

        //$user = User::find($r->client_id);

        if($user){

            $verifyCode = $user->verification_code; 

            $vNumber = validNumber($user->phone);
            $sms_msg = " إنجاز فوري: رمز التفعيل الخاص بك : ". $verifyCode;
            
            $send = senSMS($vNumber, $sms_msg);
    
            if( $send['statusCode'] == '201' ){
    
                $sentSMS = new SentSms;
    
                $sentSMS->user_id =  $user->id;
                $sentSMS->content =  $sms_msg;
                $sentSMS->status = 1;
                $sentSMS->save();
    
    
                $notification = array(
                    'status' => 1 , 
                    'msg' => 'تم الارسال بنجاح',
                    'type' => 'success'
                );
                
    
            }else{
                $notification = array(
                    'status' => 0,
                    'type' => 'warning',
                    'msg' => ' خطأ اثناء الارسال رمز التحقق',
                );
            }

            return response()->json([$notification]);
        }else{

            $notification = array(
                'status' => 0,
                'type' => 'error',
                'msg' => 'لم يتم ايجاد بيانات المستخدم',
            );


            return response()->json([$notification]);
        }

       

       

    }
  
   


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

   
}
