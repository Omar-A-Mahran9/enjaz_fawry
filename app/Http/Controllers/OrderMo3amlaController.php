<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\User;
use App\Bank;
use App\Order_mo3amla;
use App\City;
use App\Service;
use App\Terms;
use App\Mo3amlaNote;
use App\SentSms;
use PDF;

use Auth;
use Mail;
use Moyasar;

class OrderMo3amlaController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyPhone', ['except' => ['verify_form', 'verifyphone'] ]);
    }

    public function mo3amla()
    {
        $cities = City::all();
        $user = Auth::user();
        $services= Service::all();
        $terms = Terms::get()->first();
        return view('engazFawry.form1', [
            'pagetitle' => __('engazFawry.form1'),
            'cities'    =>  $cities,
            'services' => $services,
            'terms' => $terms,
            'user' =>  $user,
        ]);
    }

    public function mo3amla_send(Request $r)
    {

        $r->validate([
            'user_id' => ['required', 'regex:/[+0-9]/','min:1'],
            'service_id' => ['required', 'regex:/[+0-9]/','min:1'],
            'mo3amla_subject' => ['required', 'min:5'],
            'mo3amla_details' => ['required', 'min:5'],
            'city_id' => ['required', 'regex:/[+0-9]/','min:1'],
            'terms'           => ['required'],
        ]);

        $order = new Order_mo3amla;
        $order->user_id = $r->user_id;
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



        $notification = array(
            'message' => 'لقد تم تقديم الطلب بنجاح .',
            'alert-type' => 'success'
        );

        return redirect()->route('mo3amla.show', ['oid' => $order->id] )->with($notification)
        ->with(['services' => $services ,
                'cities'=> $cities ]);
    }


    public function index()
    {

        $user = User::find(auth()->user()->id);
        $order_mo3amla = $user->mo3amla_orders;
        $order_mo3amla_count = $user->mo3amla_orders->count();

        return view('engazFawry.dashboard.index_mo3amla', [
            'pagetitle' => __('index_mo3amla'),
            'order_mo3amla' =>  $order_mo3amla ,
            'order_mo3amla_count' =>  $order_mo3amla_count ,
            'user' =>  $user ,
        ]);
    }


    public function review( $oid, Request $r)
    {
        $user = User::find(auth()->user()->id);
        $orders = $user->mo3amla_orders->pluck('id')->toArray();

        if( in_array($oid, $orders) ){

            $order = Order_mo3amla::find($oid);
            return view('engazFawry.dashboard.order_mo3amla', [
                'pagetitle' => __('order_mo3amla'),
                'order' =>  $order,
                'user' =>  $user,
                // 'setting' =>  $setting,
                // 'banks' =>  $banks,
            ]);

        }else{

            abort(403, 'Unauthorized action.');
        }
    }

    public function mo3amlaShow(Request $r, $oid)
    {
        $setting = Setting::first();
        $user = User::find(auth()->user()->id);
        $banks = Bank::get();

        $orders = $user->mo3amla_orders->pluck('id')->toArray();

        if( in_array($oid, $orders) ){

            $order = Order_mo3amla::find($oid);

            if( $order->m_have_notes == "1"){

                if($order->notes->count() > 0){

                    if($lastNote = $order->notes->where('user_id', $user->id)->where('status', '=', 0)->last()){

                        $lastNote->status = 1;
                        $lastNote->save();
                    }
                }
            }

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
             return view('engazFawry.dashboard.order_mo3amla', [
                'pagetitle' => __('order_mo3amla'),
                'order' =>  $order,
                'user' =>  $user,
                'setting' =>  $setting,
                'banks' =>  $banks,
                'response' =>  $response,
            ]);
        }else{
             return view('engazFawry.dashboard.order_mo3amla', [
                'pagetitle' => __('order_mo3amla'),
                'order' =>  $order,
                'user' =>  $user,
                'setting' =>  $setting,
                'banks' =>  $banks,
            ]);
        }




        }else{
            abort(403, 'Unauthorized action ... no access');
        }
    }

    public function confirmReject(Request $r, $id)
    {

        $r->validate([
            'orderId' => ['required'],
            'status' => ['required'],
        ]);

        if($r->orderId ==  $id){

            $order = Order_mo3amla::find($id);

            $order->status = $r->status;
            $order->save();

            $notification = array(
                'message' => ' تم تحديث حالة الطلب بنجاح !',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        }else{

            $notification = array(
                'message' => ' حدث خطأ اثناء تنفيذ طلبك !',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function mo3amlaAddNewFiles(Request $r)
    {
         $r->validate([
            'order_id' => ['required'],
            'user_id' => ['required'],
        ]);

        // if mo3amla required new files

        $user = User::find(auth()->user()->id);
        $orders = $user->mo3amla_orders->pluck('id')->toArray();

        if( in_array($r->order_id, $orders)  && $user->id == $r->user_id){

            $order = Order_mo3amla::find($r->order_id);

            // bank add payment
            if(isset($r->addPayment) && $r->addPayment == 1){

                $r->validate([
                    'payment_method' => ['string','required'],
                ]);
                $order->payment_method = $r->payment_method;

                if($order->payment_method != null ){

                    if( $r->payment_method == "transfer"){

                        $r->validate([
                            'bank_id' => ['required'],
                        ]);

                        $order->bank_id = $r->bank_id;
                    }
                }
            }

        // if mo3amla required Notes
        if(isset($r->addNote) ){

            $r->validate([
                'orderNote' => ['string','required'],
            ]);

            $note =  Mo3amlaNote::find($r->addNote);
            $note->answer    =  $r->orderNote;
            $note->status    =  2;
            $note->save();
        }


    // if mo3amla required new files
    if(isset($r->needNewFiles) && $r->needNewFiles == 1){
        if($order->m_processNewFilesStatus == -1){

            $r->validate([
                'newFiles.*' => ['required','mimes:jpeg,png,jpg,pdf','max:5120'],
                'newFiles'   => ['max:5'],
            ]);

            $file_names =[];

            if($files = $r->file('newFiles')){

                foreach($files as $file){
                    $fileExt            = $file->getClientOriginalExtension();
                    $fileIdNameNew        = uniqid() . time() . '.' . $fileExt;
                    $file->storeAs('public/order_mo3amla', $fileIdNameNew);
                    array_push($file_names,$fileIdNameNew);
                }

                if($order->attachments != null){
                    $old_files = unserialize($order->attachments);
                    foreach($old_files as $old_file){
                        array_push($file_names,$old_file);
                    }
                }
                $order->attachments = serialize($file_names);
                $order->m_processNewFilesStatus = 0;

            } else {
                abort(403, 'Unauthorized action 001.');
            }
        }
    }

            $order->m_have_notes = "0";
            $order->status = "-5";

            $order->save();

            $notification = array(
                'message' => 'لقد تم ارسال البيانات بنجاح !',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        }else{
            abort(403, 'Unauthorized action 0001 .');
        }
    }


    public function printInvoice($id)
    {
        $user = User::find(auth()->user()->id);

        $orders = $user->mo3amla_orders->pluck('id')->toArray();

        if( in_array($id, $orders) ){

            $order = Order_mo3amla::find($id);

            $setting = Setting::first();
            $mobile = $setting->phone;

            $tPrice = (int)$order->m_enjazPrice + (int)$order->m_processThirdPartyPrice;


            $pdf = PDF::loadView('engazFawry.dashboard.printInvoice', array('order' => $order, 'tPrice' => $tPrice, 'mobile' => $mobile), []);

            return $pdf->stream('document.pdf');

        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function mo3amlaProve(Request $r)
    {
        $r->validate([
            'proveFile' => ['required','mimes:jpeg,png,jpg,pdf'],
            'order_id' => ['required'],
            'user_id' => ['required'],
        ]);

        $user = User::find(auth()->user()->id);

        $orders = $user->mo3amla_orders->pluck('id')->toArray();

        if( in_array($r->order_id, $orders)  && $user->id == $r->user_id){

            if( $r->hasFile('proveFile')){

                //file upload and check
                $fileExt            = $r->proveFile->getClientOriginalExtension();
                $fileIdNameNew        = uniqid() . time() . '.' . $fileExt;
                $r->proveFile->storeAs('public/payment_proves', $fileIdNameNew);

                $order = Order_mo3amla::find($r->order_id);
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
}
