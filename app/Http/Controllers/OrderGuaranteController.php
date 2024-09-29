<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Terms;
use App\User;
use App\Bank;
use App\Order_guarante;
use PDF;
use App\SentSms;

use Auth;
use Mail;
use Moyasar;

class OrderGuaranteController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyPhone', ['except' => ['verify_form', 'verifyphone'] ]);
    }


    public function guarante()
    {
        $setting = Setting::get()->first();
        $user = Auth::user();
        $terms = Terms::get()->first();
        $banks = Bank::all();
        return view('engazFawry.guarante', [
            'pagetitle' => __('engazFawry.guarante'),
            'banks' => $banks,
            'setting' => $setting,
            'terms' => $terms,
            'user' => $user,
        ]);
    }
    public function guarante_send(Request $r)
    {
        $r->validate([
            'user_id'         => ['required', 'regex:/[+0-9]/','min:1'],
            'phone_seller'    => ['required', 'digits:10','min:10','max:10', 'regex:/^[0-9]+$/'],
            'phone_buyer'   => ['required', 'digits:10','min:10','max:10', 'regex:/^[0-9]+$/'],
            'days'            => ['required', 'regex:/[+0-9]/'],
            'ta3med_value'    => ['required', 'regex:/[+0-9]/', 'min:0'],
            'ta3med_details'  => ['required', 'min:0'],
            'payment_method'  => ['required', 'min:0'],
            //'uploadFile'      => ['mimes:jpeg,JPEG,png,PNG,jpg,JPG,pdf,PDF'],
            'uploadFile.*'    => ['mimes:jpeg,png,jpg,pdf','max:5120'],
            'uploadFile'      => ['max:3'],
            'terms'           => ['required'],
        ]);

        $setting = Setting::get()->first();
       // $percent = ($r->ta3med_value *  $setting->guarante_percentage)/100;

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
        $order->user_id = $r->user_id;
        $order->phone_seller = $r->phone_seller;
        $order->phone_buyer = $r->phone_buyer;
        $order->days = $r->days;
        $order->ta3med_value = $r->ta3med_value;
        $order->ta3med_price = $percent;
        $order->total_price = $total;
        $order->ta3med_details = $r->ta3med_details;
        $order->payment_method = $r->payment_method;

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
        $vNumber2 = validNumber($order->phone_seller);

        $sms_msg2 = "عزيزي البائع تم إنشاء طلب ضمان سلعة لكم برقم (".$order->order_no.")";

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
			'phone_buyer' => $order->phone_buyer,
			'phone_seller' => $order->phone_seller,
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
			$message->subject('انجاز فوري : طلب ضمان سلع جديد - '.$data['order_no']);
		});


        $banks = Bank::all();

        $notification = array(
            'message' => 'لقد تم تقديم الطلب بنجاح .',
            'alert-type' => 'success'
        );

        return redirect()->route('guarante.show', ['oid' => $order->id] )->with($notification)->with('banks', $banks);
    }


    public function index()
    {
        $user = User::find(auth()->user()->id);
        $order_ta3med = $user->guarante_orders;
        $order_ta3med_count = $user->guarante_orders->count();

        return view('engazFawry.dashboard.index_guarante', [
            'pagetitle' => __('index_guarante'),
            'order_ta3med' =>  $order_ta3med ,
            'order_ta3med_count' =>  $order_ta3med_count ,
            'user' =>  $user ,
        ]);
    }

    public function guaranteShow(Request $r,$oid)
    {
        $user = User::find(auth()->user()->id);

        $orders = $user->guarante_orders->pluck('id')->toArray();

        if( in_array($oid, $orders) ){

            $order = Order_guarante::find($oid);


               // check moyasar payment response
        $response = [];

        if($r->id  !== null  && $r->status !== null   && $r->message !== null ){

            Moyasar\Client::setApiKey("sk_live_pRCggGGMpfxZTqgecwGCfiSnCFRrxUAdWv6gk9st");
            $retrieve = Moyasar\Payment::fetch($r->id);

            $error = 0;
            // if($retrieve->status == "paid" && $retrieve->source->message == "Succeeded!"){
            if($retrieve->status == "paid" && ( $retrieve->source->message == "Succeeded!" || $retrieve->source->message == "APPROVED") ){

                // payment Done success

                $visaDetails = array('type'=> $retrieve->source->type , 'name' => $retrieve->source->name ,'company'=> $retrieve->source->company, 'number'=> $retrieve->source->number);
                $readyvisaDetails =  serialize($visaDetails);

                $amount = $retrieve->amount/100;
                // update prove_status & transfer_prove
                // $response = ['success' => 'تم السداد بنجاح'];
                $response = ['success' => 'تم سداد مبلغ '.$amount.' ريال بنجاح'];

                $order->transfer_prove = $retrieve->id;
                $order->prove_status =  1;
                $order->status =  1;
                $order->visa_data =  $readyvisaDetails;



                // Send sms To external Mo3aqeb
                $vNumber = validNumber($order->phone_mo3akeb);

                $sms_msg = "عزيزي المعقب تم استلام مبلغ وقدره(".$order->ta3med_value." ريال) و حجزه لصالحكم كتعميد برقم ( ".$order->order_no.")";

                $send = senSMS($vNumber, $sms_msg);

                if( $send['statusCode'] == '201' ){

                    $sentSMS = new SentSms;
                    $sentSMS->user_id =  $order->orderUser->id;
                    $sentSMS->content =  $sms_msg;
                    $sentSMS->status = 1;
                    $sentSMS->save();
                }


                $order->save();


            }elseif($retrieve->status == "failed"){

                //   payment failed;

                if($retrieve->source->message == "Unable to process the purchase transaction"){

                    $error = "عفوا ... لايمكن معالجة عملية الشراء";

                }elseif($retrieve->source->message == "3-D Secure transaction attempt failed (Not Enrolled)"){

                    $error = "فشلت محاولة المعاملة الآمنة ثلاثية الأبعاد (غير مسجل)";

                }elseif($retrieve->source->message == "Insufficient Funds"){

                    $error = "لا يوجد رصيد كافي لاتمام العملية";

                }elseif($retrieve->source->message == "Declined"){

                    $error = "العملية مرفوضة ... يرجى مراجعة البنك المصدر للبطاقة";

                }elseif($retrieve->source->message == "Invalid Card. Unable to store the card"){

                    $error = "بطاقة غير صالحة. غير قادر على تخزين البطاقة";

                }elseif($retrieve->source->message == "Invalid Card. Unable to store the card"){

                    $error = "بطاقة غير صالحة. غير قادر على تخزين البطاقة";

                }elseif($retrieve->source->message == "Unable to process the purchase transaction"){

                    $error = "غير قادر على معالجة عملية الشراء";

                }else{

                    $error = "خطأ غير معروف ... يرجى مراجعة البنك المصدر للبطاقة";
                }

                 $response = ['error' => $error ];

            }elseif($retrieve->status == "expired"){

                $error = "خطأ غير معروف ... expired";
                $response = ['error' => $error ];

            }elseif($retrieve->status == "canceled"){

                $error = "خطأ غير معروف ... canceled";
                $response = ['error' => $error ];

            }



        }elseif($r->error !== null  ){}



        if($response){

             return view('engazFawry.dashboard.order_guarante', [
                'pagetitle' => __('order_guarante'),
                'order' =>  $order ,
                'user' =>  $user ,
                'response' =>  $response,
            ]);
        }else{
               return view('engazFawry.dashboard.order_guarante', [
                'pagetitle' => __('order_guarante'),
                'order' =>  $order ,
                'user' =>  $user ,
            ]);
        }




        }else{

            abort(403, 'Unauthorized action.');
        }
    }


    public function guaranteProve(Request $r)
    {

        $r->validate([
            'proveFile' => ['required','mimes:jpeg,png,jpg,pdf','max:5120'],
            'order_id' => ['required'],
            'user_id' => ['required'],
        ]);

        $user = User::find(auth()->user()->id);

        $orders = $user->guarante_orders->pluck('id')->toArray();

        if( in_array($r->order_id, $orders)  && $user->id == $r->user_id){

            if( $r->hasFile('proveFile')){

                //file upload and check
                $fileExt            = $r->proveFile->getClientOriginalExtension();
                $fileIdNameNew        = uniqid() . time() . '.' . $fileExt;
                $r->proveFile->storeAs('public/payment_proves', $fileIdNameNew);

                $order = Order_guarante::find($r->order_id);
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



    public function printInvoice($id)
    {

        $user = User::find(auth()->user()->id);

        $orders = $user->guarante_orders->pluck('id')->toArray();

        if( in_array($id, $orders) ){

            $order = Order_guarante::find($id);

            $setting = Setting::first();
            $mobile = $setting->phone;

            $tPrice = (int)$order->m_enjazPrice + (int)$order->m_processThirdPartyPrice;

            $pdf = PDF::loadView('engazFawry.dashboard.printInvoice_guarante', array('order' => $order, 'tPrice' => $tPrice, 'mobile' => $mobile), []);

            return $pdf->stream('document.pdf');

        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
