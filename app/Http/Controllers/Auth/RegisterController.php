<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Client;
use App\Setting;
use App\Terms;
use App\SentSms;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->middleware('guest');
      //  $this->middleware('guest:client');

    }

    public function showClientRegisterForm()
    {
         $setting = Setting::first();
         $terms = Terms::first();
         return view('engazFawry.signup', [
            'pagetitle' => __('engazFawry.signup'),
            'setting' => $setting,
            'terms' => $terms,
        ]);

    }

    public function showVendorRegisterForm()
    {
        $setting = Setting::first();
        $terms = Terms::first();
         return view('engazFawry.signup_vendor', [
            'pagetitle' => __('engazFawry.signup'),
            'setting' => $setting,
            'terms' => $terms,
        ]);

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
        ]);


        $tNumber = translateNumber($request->phone);
        $vNumber = validNumber($tNumber);


       
        $client = User::create([
            'name' => $request['name'],
            'phone' => $request['phone'],     
        //   'identity_no' => $request['identity_no'],
            'email' => $request['email'],
            'status' => 1,
            'type' => $request['type'],
            'verification_code' => $verifyCode,
            'password' => Hash::make($request['password']),
            'mail_token' => sha1(time()),
        ]);

      
        // create account No 

        $insertedId = $client->id;

        $client->account_no = ($insertedId+50050);
        
        $client->save();

        // $new_msg = "تنبيه عزيزي العميل موقع انجاز فوري لاينفذ طلبات قرض بنك التنميه التسليف
        // نأمل عدم الأنسياق خلف المحتالين وإعطاء رقمك لأحد نظراً لكثرة الاحتيال الإلكتروني
        // للأستفسار 0566661105 - 
        // رقم التفعيل هو :" . $verifyCode;

        $new_msg = " إنجاز فوري: رمز التفعيل الخاص بك : ". $verifyCode;

        $send = senSMS($vNumber, $new_msg);

        // dd( $send);

        if( $send['statusCode'] == '201' ){

            $sentSMS = new SentSms;

            $sentSMS->user_id =  $client->id;
            $sentSMS->content =  $new_msg;
            $sentSMS->status = 1;
            $sentSMS->save();

            $notification = array(
                'message' => 'تم الارسال بنجاح',
                'alert-type' => 'success'
            );

           //  Mail::to($client->email)->send(new VerifyMail($client));

          //  $url = url('user/verify', $client->mail_token); 

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


        }else{
            
            $notification = array(
                'message' => 'خطأ اثناء الارسال',
                'alert-type' => 'error'
            );
        }


        // $notification = array(
        //     'message' => 'يرجى التواصل مع الادارة',
        //     'alert-type' => 'error'
        // );
        $cid = $client->id;

        Auth::loginUsingId($cid);

        $hashed_otp = Hash::make($verifyCode);

        session(['otp' => $hashed_otp, 'cid' => $cid]);

        

        return redirect()->route('verifyphone')->with($notification);
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
            'email' => ['required', 'email:rfc,dns'],
            'password' => ['required', 'min:6', 'string','confirmed'],
            'approve' => ['required'],
        ]);


     

        if( $request->hasFile('uploadFile')){

            //file upload and check
            $fileExt            = $request->uploadFile->getClientOriginalExtension();
            $fileIdNameNew        = uniqid() . time() . '.' . $fileExt;
            $request->uploadFile->storeAs('public/ids', $fileIdNameNew);

            
        } else {

            $fileIdNameNew = null;
            //dd('No image was found');
        }



    
        if($request->type == 2){
            $typo = 'vendor';
        }elseif($request->type == 3){
            $typo = 'vendorC';
        }else{
            return back()->withErrors('خطأ في نوع الحساب');
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
        ]);


        // create account No 

        $insertedId = $client->id;

        $client->account_no = ($insertedId+60050);
        
        $client->save();




        $sms_msg = " إنجاز فوري: رمز التفعيل الخاص بك : ". $verifyCode;

       $send =  senSMS($vNumber, $sms_msg);

        
        if( $send['statusCode'] == '201' ){

            $sentSMS = new SentSms;

            $sentSMS->user_id =  $client->id;
            $sentSMS->content =  $sms_msg;
            $sentSMS->status = 1;
            $sentSMS->save();


            $notification = array(
                'message' => 'تم الارسال بنجاح',
                'alert-type' => 'success'
            );

        }else{
            
            $notification = array(
                'message' => 'خطأ اثناء الارسال',
                'alert-type' => 'error'
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

        Auth::loginUsingId($cid);

        $hashed_otp = Hash::make($verifyCode);

        session(['otp' => $hashed_otp, 'cid' => $cid]);

        $notification = array(
            'message' => 'يرجى التواصل مع الادارة',
            'alert-type' => 'error'
        );
        return redirect()->route('verifyphone')->with($notification);
    }

  
    public function validatePhone()
    {

        $hashed_otp = session('otp');
        $id         = session('cid');

        if ( session('otp') !== null && session('cid')  !== null ) {

            $client =  User::where('id', $id)->first(); 
        
            if($client &&  Hash::check( $client['verification_code'], $hashed_otp ) ){

                return view('engazFawry.verifyphone');

            }else{

                return view('engazFawry.verifyphone');

            }

        } // is set sessions
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
