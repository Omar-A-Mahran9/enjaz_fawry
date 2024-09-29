<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sitting;
use App\User;
use App\Order_estfsar;
use App\Order_mo3amla;
use App\Order_sharkat;
use App\Order_ta3med;
use App\VendorBanks;
use App\SentSms;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;




use Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');

        $this->middleware('verifyPhone', ['except' => ['verify_form', 'verifyphone', 'resendOtp'] ]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        $user = Auth::user();

        $notify= $user->processMo3ala->where('status','=','-1')->count();

         return view('engazFawry.dashboard.index', [
            'pagetitle' => __('engazFawry.dashboard'),
            'user' => $user,
            'notify' => $notify,
        ]);
    }


    public function saveToken (Request $request)
    {
        $user = User::find($request->user_id);
        $user->firebase_token = $request->fcm_token;
        $user->save();

        if($user)
            return response()->json([
                'message' => 'User token updated'
            ]);

        return response()->json([
            'message' => 'Error!'
        ]);
    }


    public function setting()
    {
        //


        $user = auth()->user();
        $notify = $user->processMo3ala->where('status','=','-1')->count();

         return view('engazFawry.dashboard.setting', [
            'pagetitle' => __('engazFawry.setting'),
            'user' => $user,
            'notify' => $notify,
        ]);
    }


    public function verifyPhone(Request $r)
    {

        $this->validate($r, [
            'code'   => 'required|min:4',
        ]);

        // if logged in user
        if ( Auth::check('web') ){

            $user = Auth::user();

            $user = User::find($user->id);

            if($r->code == $user['verification_code']){

                $r->user()->markPhoneAsVerified();



                return redirect()->route('thank-you')->with('success', 'تم تفعيل رقم الجوال بنجاح');
                // return redirect()->route('client_dashboard')->with('success', 'تم تفعيل رقم الجوال بنجاح');


            }else{
                return back()->withErrors(['code' => ['الكود المدخل غير صحيح']]);
            }
        }
        // if not logged in but have session
        /* elseif( session('otp') !== null && session('cid')  !== null){

            $hashed_otp = session('otp');
            $cid         = session('cid');

            $user = User::find($cid);
            if(Hash::check( $r->code, $hashed_otp) ) {
                $r->user()->markPhoneAsVerified();
            }else{
                return back()->withErrors(['code' => ['الكود المدخل غير صحيح']]);
            }
        } */
        else{
            return abort(404);
        }

    }

    public function resendOtp(Request $r)
    {
        $user = User::find(auth()->user()->id);

        $verifyCode = $user->verification_code;

        $vNumber = validNumber($user->phone);
        $sms_msg = " إنجاز فوري: رمز التفعيل الخاص بك : ". $verifyCode;

        $notification = array(
            'message' => 'يرجى التواصل مع الادارة',
            'alert-type' => 'error'
        );
       $send = senSMS($vNumber, $sms_msg);



        if( $send['statusCode'] == '201' ){

            $sentSMS = new SentSms;

            $sentSMS->user_id =  $user->id;
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
        return redirect()->back()->with($notification);
    }

    public function storeVendorBank(Request $r)
    {
        $r->validate([
            'name' => ['required', 'string', 'max:90'],
            'user_id' => ['required'],
            'accountName' => ['required', 'string'],
            'accountNo' => ['required', 'string', 'min:10'],
            'accountIban' => ['required', 'string', 'min:10'],
        ]);

        $bank = new VendorBanks;
        $bank->name = $r->name;
        $bank->user_id = $r->user_id;
        $bank->accountName = $r->accountName;
        $bank->accountNo = $r->accountNo;
        $bank->accountIban = $r->accountIban;
        $bank->status = 1;

        $bank->save();

        $notification = array(
            'message' => ' تم اضافة الحساب البنكي بنجاح .',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function editVendorBank(Request $r, $id)
    {
        $r->validate([
            'name' => ['required', 'string', 'max:90'],
            'user_id' => ['required'],
            'accountName' => ['required', 'string'],
            'accountNo' => ['required', 'string', 'min:10'],
            'accountIban' => ['required', 'string'],
        ]);

        $bank = VendorBanks::find($id);
        $bank->name = $r->name;
        $bank->user_id = $r->user_id;
        $bank->accountName = $r->accountName;
        $bank->accountNo = $r->accountNo;
        $bank->accountIban = $r->accountIban;
        $bank->status = 1;

        $bank->save();

        $notification = array(
            'message' => ' تم تحديث الحساب البنكي بنجاح .',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function identityProve(Request $r)
    {
        $r->validate([
            'uploadFile' => ['required','mimes:jpeg,png,jpg,pdf'],
            'user_id' => ['required'],
        ]);

        $user = User::find(auth()->user()->id);


        if($user->id == $r->user_id){

            if( $r->hasFile('uploadFile')){

                //file upload and check
                $fileExt            = $r->uploadFile->getClientOriginalExtension();
                $fileIdNameNew        = uniqid() . time() . '.' . $fileExt;
                $r->uploadFile->storeAs('public/ids', $fileIdNameNew);

                if(!empty($user->identity_file) || $user->identity_file != Null ){

                    $oldFile = asset('storage/ids') .'/'. $user->identity_file;
                    unlink(storage_path('app/public/ids/'.$user->identity_file));

                }

                $user->identity_file = $fileIdNameNew;
                $user->identity_status = 0;
                $user->save();

                $notification = array(
                    'message' => 'تم ارسال الاوراق الثبوتية بنجاح !',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);

            } else {
                abort(403, 'Unauthorized action.');
            }

        }else{
            abort(403, 'Unauthorized action.');
        }
    }

    public function dashboard()
    {

        if (Auth::check('admin')){
            $user = Auth::user();
            $cid = User::find(auth()->user()->id)->phone_status;


            // if(is_null($cid) || $cid == NULL){
            // // echo "رقم الهاتف غير مفعل ";
            // }else{
            // //  echo " مفعل ";
            // }

        }

        $user = User::find(auth()->user()->id);


        $notify = $user->processMo3ala->where('status','=','-1')->count();


        $order_estfsar = $user->estfsar_orders;
        $order_estfsar_count = $user->estfsar_orders->count();


        $mo3amla_orders = $user->mo3amla_orders;
        $mo3amla_orders_count = $user->mo3amla_orders->count();

        $ta3med_orders = $user->ta3med_orders;
        $ta3med_orders_count = $user->ta3med_orders->count();

        return view('engazFawry.dashboard.index', [
            'pagetitle' => __('engazFawry.dashboard'),
            'order_estfsar' =>  $order_estfsar ,
            'notify' => $notify,
            'order_estfsar_count' =>  $order_estfsar_count ,
            'mo3amla_orders' =>  $mo3amla_orders ,
            'mo3amla_orders_count' =>  $mo3amla_orders_count ,
            'ta3med_orders' =>  $ta3med_orders ,
            'ta3med_orders_count' =>  $ta3med_orders_count ,
            'user' =>  $user ,
        ])->withModel(User::find(auth()->user()->id));
    }

    public function estfsar()
    {
        $user = User::find(auth()->user()->id);

        $order_estfsar = $user->estfsar_orders;
        $order_estfsar_count = $user->estfsar_orders->count();

        $notify = $user->processMo3ala->where('status','=','-1')->count();

        return view('engazFawry.dashboard.index_estfsar', [
            'pagetitle' => __('order_estfsar'),
            'order_estfsar' =>  $order_estfsar ,
            'order_estfsar_count' =>  $order_estfsar_count ,
            'user' =>  $user ,
            'notify' =>  $notify ,
        ]);
    }

    public function estfsarShow( $oid)
    {
        $user = User::find(auth()->user()->id);

        $notify = $user->processMo3ala->where('status','=','-1')->count();

        $orders = $user->estfsar_orders->pluck('id')->toArray();

        if( in_array($oid, $orders) ){

            $order = Order_estfsar::find($oid);
            return view('engazFawry.dashboard.order_estfsar', [
                'pagetitle' => __('order_estfsar'),
                'order' =>  $order ,
                 'user' =>  $user ,
                 'notify' =>  $notify ,
            ]);
        }else{
            abort(403, 'Unauthorized action.');
        }
    }
    public function estfsarProve(Request $r)
    {

        $r->validate([
            'proveFile' => ['required','mimes:jpeg,png,jpg'],
            'order_id' => ['required'],
            'user_id' => ['required'],
        ]);


        $user = User::find(auth()->user()->id);

        $orders = $user->estfsar_orders->pluck('id')->toArray();

        if( in_array($r->order_id, $orders)  && $user->id == $r->user_id){

            if( $r->hasFile('proveFile')){


                //file upload and check
                $fileExt            = $r->proveFile->getClientOriginalExtension();
                $fileIdNameNew        = uniqid() . time() . '.' . $fileExt;
                $r->proveFile->storeAs('public/payment_proves', $fileIdNameNew);

                $order = Order_estfsar::find($r->order_id);
                $order->transfer_prove = $fileIdNameNew;
                $order->prove_status = 0;

                $order->save();

                $notification = array(
                    'message' => 'لقد تم تعديل حالة الدفع بنجاح !',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);

            } else {
                abort(403, 'Unauthorized action.');
            }

        }else{
            abort(403, 'Unauthorized action.');
        }
    }

    public function EditAccountDetails(Request $r)
    {
        $user = auth()->user();

        $notify = $user->processMo3ala->where('status','=','-1')->count();

        return view('engazFawry.dashboard.setting_edit', [
            'pagetitle' => __('engazFawry.setting_edit'),
            'user' => $user,
            'notify' => $notify,
        ]);
    }

    public function UpdateAccountDetails(Request $r)
    {
        $user = auth()->user();
        $updateUser = User::find($user->id);

        // defaults
        $updateUser->name = $r->name;
        $updateUser->gender = $r->gender;

        $r->validate([
            'name' => ['required'],
            'gender' => ['required'],
        ]);

        // check if mobile need change
        if(!is_null($r->changeMobile)){

            if($updateUser->phone != $r->phone){

                $verifyCode =  rand(1111, 9999);

                $r->validate([
                    'phone' => ['required', 'digits:10', 'unique:users','min:10','max:10', 'regex:/^[0-9]+$/'],
                ]);

                $updateUser->phone = $r->phone;
                $updateUser->verification_code = $verifyCode;
                $updateUser->phone_status = 0;
            }
        } // end if mobile

        // check if mail need change
        if(!is_null($r->changeMail)){

            if($updateUser->email != $r->email){
                $r->validate([
                    'email' => ['required', 'unique:users', 'email:rfc,dns'],
                ]);
                $updateUser->email = $r->email;
            }
        } // end if mobile

        // check if password need change
        if(!is_null($r->changePass)){

            if( Hash::check($r->oldPass, $updateUser->password) ){

                $r->validate([
                    'oldPass'   =>['required'],
                    'password' => ['required', 'min:6', 'string','confirmed'],
                ]);

                $updateUser->password = Hash::make($r->password);

            }else{

                $notification = array(
                    'message' => ' خطأ اثناء التعديل !',
                    'alert-type' => 'error'
                );

                $errors = array(
                    'oldPass' => ' كلمة المرور المدخلة غير صحيحة !',
                );
                return redirect()->back()->with($notification)->with(['message' => 'كلمة المرور القديمة غير صحيحة'])->withErrors($errors);

            }
        } // end if mobile


        if( $r->hasFile('profileImg')){

            //file upload and check
            $fileExt            = $r->profileImg->getClientOriginalExtension();
            $fileIdNameNew      = uniqid().time().'.'.$fileExt;
            $r->profileImg->storeAs('public/profile_image', $fileIdNameNew);

            $updateUser->vendor_image = $fileIdNameNew;

        } // image check

        $updateUser->save();

        $notification = array(
            'message' => ' تم تعديل البيانات بنجاح !',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
}
