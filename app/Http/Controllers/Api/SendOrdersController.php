<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use App\User;
use App\Order_estfsar;
use App\Order_sharkat;
use App\Order_mo3amla;
use App\Order_ta3med;
use App\Order_guarante;
use App\SentSms;
use App\City;
use App\Service;
use App\Bank;

use Auth;
use Mail;

class SendOrdersController extends Controller
{

    public function __construct()
    {
       // $this->middleware('verifyPhone', ['except' => ['verify_form', 'verifyphone'] ]);
    }


    public function sharkat_send(Request $r)
    {
        $r->validate([
            'name' => ['required'],
            'phone'   => ['required', 'digits:10','min:10','max:10', 'regex:/^[0-9]+$/'],
            'city' => ['required'],
            'type' => ['required'],
            'service' => ['required'],
        ]);

        $order = new Order_sharkat;
        $order->name = $r->name;
        $order->mobile = $r->phone;
        $order->city_id = $r->city;
        $order->type = $r->type;
        $order->service = $r->service;

        $order->save();

        $insertedId = $order->id;
        $order->order_no = "C-".($insertedId+100);
        $order->save();
        $cities = City::all();


        $cityName = City::find($r->city)->name;

        $data = array(
			'name' => $r->name,
			'phone' => $r->phone,
			'city' => $cityName,
			'type' => $r->type,
			'service' => $r->service,
			'order_no' => $order->order_no,
			);


        $setting = Setting::first();

		Mail::send('customEmail.order_company', $data, function($message) use ($data,$setting){
			$message->from('no-replay@enjaz-fawry.com');
			$message->to($setting->email);
			$message->cc($setting->secmail);
			$message->subject('انجاز فوري : طلب شركات جديد - '.$data['order_no']);
		});

        return response()->json([
            'status' => 1,
            'type' => 'Success',
            'msg' => ' تم تقديم الطلب بنجاح .',
            'order_no' =>  $order->order_no,
        ]);
       // return redirect()->route('sharkat')->with($notification)->with('cities', $cities);
    }



    public function estfsar_send(Request $r)
    {
        $r->validate([
           // 'user_id' => ['required', 'regex:/[+0-9]/','min:1'],
            'name'    => ['string','required'],
            'phone'   => ['required', 'digits:10','min:10','max:10', 'regex:/^[0-9]+$/'],
            'type'    => ['string','required'],
            'service' => ['string','required'],
            'price' => ['required'],
            'payment_method' => ['string','required'],
        ]);

        $setting = Setting::get()->first();


        $order = new Order_estfsar;

        $user = request()->user();

        $order->user_id = $user->id;
        $order->name = $r->name;
        $order->phone = $r->phone;
        $order->type = $r->type;
        $order->price = $setting->estfsar_price;
        $order->service = $r->service;
        $order->payment_method = $r->payment_method;
        $order->bank_id = $r->bank_id;

        $order->save();

        $insertedId = $order->id;

        $order->order_no = "E-".($insertedId+1000);

        $order->save();

        $vNumber = validNumber($order->orderUser->phone);

        $sms_msg = "عزيزي العميل تم استلام طلبكم رقم (".$order->order_no.")" ;

        $send = senSMS($vNumber, $sms_msg);

        if( $send['statusCode'] == '201' ){

            $sentSMS = new SentSms;
            $sentSMS->user_id =  $order->orderUser->id;
            $sentSMS->content =  $sms_msg;
            $sentSMS->status = 1;
            $sentSMS->save();

        }

        if($order->payment_method == "online_payment"){

            $methodName = "دفع اونلاين";

        }elseif($order->payment_method == "transfer"){

            $methodName = "تحويل بنكي";

        }


        $data = array(
			'name' => $r->name,
			'phone' => $r->phone,
			'type' => $r->type,
			'service' => $r->service,
			'order_no' => $order->order_no,
			'price' => $order->price,
			'payment_method' => $methodName,
			);


        $setting = Setting::first();

		Mail::send('customEmail.order_estfsar', $data, function($message) use ($data,$setting){
			$message->from('no-replay@enjaz-fawry.com');
			$message->to($setting->email);
			$message->cc($setting->secmail);
			$message->subject('انجاز فوري : طلب استفسار جديد - '.$data['order_no']);
		});


        // $notification = array(
        //     'message' => 'لقد تم تقديم الطلب بنجاح .',
        //     'alert-type' => 'success'
        // );
        // return redirect()->route('estfsar.show', ['oid' => $order->id] )->with($notification);

        return response()->json([
            'status' => 1,
            'type' => 'Success',
            'msg' => ' تم تقديم الطلب بنجاح .',
            'order_id' => $order->id,
            'order_no' =>  $order->order_no,
        ]);
    }



    public function mo3amla_send(Request $r)
    {

        $r->validate([
           // 'user_id' => ['required', 'regex:/[+0-9]/','min:1'],
            'service_id' => ['required', 'regex:/[+0-9]/','min:1'],
            'mo3amla_subject' => ['required', 'min:5'],
            'mo3amla_details' => ['required', 'min:5'],
            'city_id' => ['required', 'regex:/[+0-9]/','min:1'],

        ]);

        $order = new Order_mo3amla;
        $user = request()->user();
        $order->user_id = $user->id;
        $order->service_id = $r->service_id;
        $order->mo3amla_subject = $r->mo3amla_subject;
        $order->mo3amla_details = $r->mo3amla_details;
        $order->city_id = $r->city_id;
        $order->m_processNewFilesStatus = "-2";

        $order->save();

        $insertedId = $order->id;
        $order->order_no = "M-".($insertedId+1000);
        $order->save();

        $vNumber = validNumber($order->orderUser->phone);

        $sms_msg = "عزيزي العميل تم استلام طلبكم رقم (".$order->order_no.")" ;

        $send = senSMS($vNumber, $sms_msg);

        if( $send['statusCode'] == '201' ){

            $sentSMS = new SentSms;
            $sentSMS->user_id =  $order->orderUser->id;
            $sentSMS->content =  $sms_msg;
            $sentSMS->status = 1;
            $sentSMS->save();

        }

        $cities = City::all();
        $services= Service::all();


        $data = array(
			'user_name' => $order->orderUser->name,
			'service' => $order->service->name,
			'mo3amla_subject' => $order->mo3amla_subject,
			'mo3amla_details' => $order->mo3amla_details,
			'city' => $order->city->name,
			'order_no' => $order->order_no,
			);


        $setting = Setting::first();

		Mail::send('customEmail.order_mo3amla', $data, function($message) use ($data,$setting){
			$message->from('no-replay@enjaz-fawry.com');
			$message->to($setting->email);
			$message->cc($setting->secmail);
			$message->subject('انجاز فوري : طلب معاملة جديد - '.$data['order_no']);
		});



        // $notification = array(
        //     'message' => 'لقد تم تقديم الطلب بنجاح .',
        //     'alert-type' => 'success'
        // );

        // return redirect()->route('mo3amla.show', ['oid' => $order->id] )->with($notification)
        // ->with(['services' => $services ,
        //         'cities'=> $cities ]);


        return response()->json([
            'status' => 1,
            'type' => 'Success',
            'msg' => ' تم تقديم الطلب بنجاح .',
            'order_id' => $order->id,
            'order_no' =>  $order->order_no,
        ]);
    }












    public function ta3med_send(Request $r)
    {
        $r->validate([
          //  'user_id'         => ['required', 'regex:/[+0-9]/','min:1'],
            'phone_client'    => ['required', 'digits:10','min:10','max:10', 'regex:/^[0-9]+$/'],
            'phone_mo3akeb'   => ['required', 'digits:10','min:10','max:10', 'regex:/^[0-9]+$/'],
            'days'            => ['required', 'regex:/[+0-9]/'],
            'ta3med_value'    => ['required', 'regex:/[+0-9]/', 'min:0'],
            'ta3med_details'  => ['required', 'min:0'],
            'payment_method'  => ['required', 'min:0'],
            //'uploadFile'      => ['mimes:jpeg,JPEG,png,PNG,jpg,JPG,pdf,PDF'],
            'uploadFile.*'    => ['mimes:jpeg,png,jpg,pdf','max:5120'],
             //  'uploadFile'      => ['max:3'],

        ]);

        $setting = Setting::get()->first();
        //$percent = ($r->ta3med_value *  $setting->tameed_percentage)/100;

        if($r->ta3med_value <= 1000) {

            $percent  = 50;

        }elseif($r->ta3med_value <= 2000){

            $percent  = 100;
        }else{

            $percent = ($r->ta3med_value *  $setting->tameed_percentage)/100;

        }
        $total =  $r->ta3med_value +  $percent;

        $file_names =[];

        if( $r->hasFile('uploadFile')){

            $files = $r->file('uploadFile');

            foreach($files as $file){
                $fileExt            = $file->getClientOriginalExtension();
                $fileIdNameNew        = uniqid() . time() . '.' . $fileExt;
                $file->storeAs('public/order_ta3med', $fileIdNameNew);
                array_push($file_names,$fileIdNameNew);
            }


            $fileIdNameNew = serialize($file_names);


        } else {
            $fileIdNameNew = null;
        }



        $order = new Order_ta3med;
        $user = request()->user();
        $order->user_id = $user->id;
        $order->phone_client = $r->phone_client;
        $order->phone_mo3akeb = $r->phone_mo3akeb;
        $order->days = $r->days;
        $order->ta3med_value = $r->ta3med_value;
        $order->ta3med_price = $percent;
        $order->total_price = $total;
        $order->ta3med_details = $r->ta3med_details;
        $order->payment_method = $r->payment_method;
        // $order->bank_id = $r->bank_id;


        if( $r->bank_id == null){

            $order->bank_id = 2;

        }else{

            $order->bank_id = $r->bank_id;
        }

        $order->attachment = $fileIdNameNew;

        $order->save();

        $insertedId = $order->id;

        $order->order_no = "T-".($insertedId+1000);

        $order->save();


        // 1- Send sms  To User

        $vNumber = validNumber($order->orderUser->phone);

        $sms_msg = "عزيزي العميل تم استلام طلبكم رقم (".$order->order_no.")" ;

        $send = senSMS($vNumber, $sms_msg);

        if( $send['statusCode'] == '201' ){

            $sentSMS = new SentSms;
            $sentSMS->user_id =  $order->orderUser->id;
            $sentSMS->content =  $sms_msg;
            $sentSMS->status = 1;
            $sentSMS->save();

        }


        // 2 - Send sms To external Mo3aqeb
        $vNumber2 = validNumber($order->phone_mo3akeb);

        $sms_msg2 = "عزيزي المعقب تم إنشاء طلب تعميد لكم برقم (".$order->order_no.")";

        $send2 = senSMS($vNumber2, $sms_msg2);

        if( $send2['statusCode'] == '201' ){

            $sentSMS = new SentSms;
            $sentSMS->user_id =  $order->orderUser->id;
            $sentSMS->content =  $sms_msg;
            $sentSMS->status = 1;
            $sentSMS->save();
        }


        if($order->payment_method == "online_payment"){

            $methodName = "دفع اونلاين";

        }elseif($order->payment_method == "transfer"){

            $methodName = "تحويل بنكي";

        }

        $data = array(
			'user_name' => $order->orderUser->name,
			'phone_client' => $order->phone_client,
			'phone_mo3akeb' => $order->phone_mo3akeb,
			'days' => $order->days,
			'ta3med_value' => $order->ta3med_value,
			'ta3med_price' => $order->ta3med_price,
			'total_price' => $order->total_price,
			'ta3med_details' => $order->ta3med_details,
			'payment_method' => $methodName,
			'order_no' => $order->order_no,
			);


        $setting = Setting::first();

		Mail::send('customEmail.order_ta3med', $data, function($message) use ($data,$setting){
			$message->from('no-replay@enjaz-fawry.com');
			$message->to($setting->email);
			$message->cc($setting->secmail);
			$message->subject('انجاز فوري : طلب تعميد جديد - '.$data['order_no']);
		});






        $banks = Bank::all();

        // $notification = array(
        //     'message' => 'لقد تم تقديم الطلب بنجاح .',
        //     'alert-type' => 'success'
        // );

        return response()->json([
            'status' => 1,
            'type' => 'Success',
            'msg' => ' تم تقديم الطلب بنجاح .',
            'order_id' => $order->id,
            'order_no' =>  $order->order_no,
        ]);

       // return redirect()->route('ta3med.show', ['oid' => $order->id] )->with($notification)->with('banks', $banks);
    }




    public function guarante_send(Request $r)
    {
        $r->validate([
          //  'user_id'         => ['required', 'regex:/[+0-9]/','min:1'],
            'phone_seller'    => ['required', 'digits:10','min:10','max:10', 'regex:/^[0-9]+$/'],
            'phone_buyer'   => ['required', 'digits:10','min:10','max:10', 'regex:/^[0-9]+$/'],
            'days'            => ['required', 'regex:/[+0-9]/'],
            'ta3med_value'    => ['required', 'regex:/[+0-9]/', 'min:0'],
            'ta3med_details'  => ['required', 'min:0'],
            'payment_method'  => ['required', 'min:0'],
            //'uploadFile'      => ['mimes:jpeg,JPEG,png,PNG,jpg,JPG,pdf,PDF'],
            'uploadFile.*'    => ['mimes:jpeg,png,jpg,pdf','max:5120'],
             //  'uploadFile'      => ['max:3'],

        ]);

        $setting = Setting::get()->first();
        //$percent = ($r->ta3med_value *  $setting->guarante_percentage)/100;

        if($r->ta3med_value <= 1000) {

            $percent  = 50;

        }elseif($r->ta3med_value <= 2000){

            $percent  = 100;
        }else{

            $percent = ($r->ta3med_value *  $setting->tameed_percentage)/100;

        }

        $total =  $r->ta3med_value +  $percent;

        $file_names =[];

        if( $r->hasFile('uploadFile')){

            $files = $r->file('uploadFile');

            foreach($files as $file){
                $fileExt            = $file->getClientOriginalExtension();
                $fileIdNameNew        = uniqid() . time() . '.' . $fileExt;
                $file->storeAs('public/order_guarante', $fileIdNameNew);
                array_push($file_names,$fileIdNameNew);
            }


            $fileIdNameNew = serialize($file_names);


        } else {
            $fileIdNameNew = null;
        }



        $order = new Order_guarante;
        $user = request()->user();
        $order->user_id = $user->id;
        $order->phone_seller = $r->phone_seller;
        $order->phone_buyer = $r->phone_buyer;
        $order->days = $r->days;
        $order->ta3med_value = $r->ta3med_value;
        $order->ta3med_price = $percent;
        $order->total_price = $total;
        $order->ta3med_details = $r->ta3med_details;
        $order->payment_method = $r->payment_method;
       // $order->bank_id = $r->bank_id;

        if( $r->bank_id == null){

            $order->bank_id = 2;

        }else{

            $order->bank_id = $r->bank_id;
        }

        $order->attachment = $fileIdNameNew;

        $order->save();

        $insertedId = $order->id;

        $order->order_no = "G-".($insertedId+1000);

        $order->save();


        // 1- Send sms  To User

        $vNumber = validNumber($order->orderUser->phone);

        $sms_msg = "عزيزي العميل تم استلام طلبكم رقم (".$order->order_no.")" ;

        $send = senSMS($vNumber, $sms_msg);

        if( $send['statusCode'] == '201' ){

            $sentSMS = new SentSms;
            $sentSMS->user_id =  $order->orderUser->id;
            $sentSMS->content =  $sms_msg;
            $sentSMS->status = 1;
            $sentSMS->save();

        }


        // 2 - Send sms To external Mo3aqeb
        $vNumber2 = validNumber($order->phone_buyer);

        $sms_msg2 = "عزيزي المعقب تم إنشاء طلب ضمان مبلغ لكم برقم (".$order->order_no.")";

        $send2 = senSMS($vNumber2, $sms_msg2);

        if( $send2['statusCode'] == '201' ){

            $sentSMS = new SentSms;
            $sentSMS->user_id =  $order->orderUser->id;
            $sentSMS->content =  $sms_msg;
            $sentSMS->status = 1;
            $sentSMS->save();
        }


        if($order->payment_method == "online_payment"){

            $methodName = "دفع اونلاين";

        }elseif($order->payment_method == "transfer"){

            $methodName = "تحويل بنكي";

        }

        $data = array(
			'user_name' => $order->orderUser->name,
			'phone_seller' => $order->phone_seller,
			'phone_buyer' => $order->phone_buyer,
			'days' => $order->days,
			'ta3med_value' => $order->ta3med_value,
			'ta3med_price' => $order->ta3med_price,
			'total_price' => $order->total_price,
			'ta3med_details' => $order->ta3med_details,
			'payment_method' => $methodName,
			'order_no' => $order->order_no,
			);


        $setting = Setting::first();

		Mail::send('customEmail.order_guarante', $data, function($message) use ($data,$setting){
			$message->from('no-replay@enjaz-fawry.com');
			$message->to($setting->email);
			$message->cc($setting->secmail);
			$message->subject('انجاز فوري : طلب ضمان مبلغ سلعة جديد - '.$data['order_no']);
		});






        $banks = Bank::all();

        // $notification = array(
        //     'message' => 'لقد تم تقديم الطلب بنجاح .',
        //     'alert-type' => 'success'
        // );

        return response()->json([
            'status' => 1,
            'type' => 'Success',
            'msg' => ' تم تقديم الطلب بنجاح .',
            'order_id' => $order->id,
            'order_no' =>  $order->order_no,
        ]);

       // return redirect()->route('ta3med.show', ['oid' => $order->id] )->with($notification)->with('banks', $banks);
    }

}
