<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Status;
use App\City;
use App\Setting;
use App\Bank;
use App\Order_guarante;
use App\SentSms;
use Mail;

use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderGuaranteController extends Controller
{

    public function export() 
    {
        return Excel::download(new OrdersExport, 'emails.xlsx');
    }

    public function index()
    {
        // if(!auth()->user()->hasAnyPermission(['order_index'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // }
        $statuses = Status::get();
        $setting = Setting::first();
        $city = City::get();
        $bank = Bank::get();
        $orders = Order_guarante::latest()->paginate($setting->paginate);
        return view('dashboard.orders.index_guarante', ['orders' => $orders,'statuses' => $statuses, 'city'=>$city, 'bank'=>$bank]);
    }


    public function showTa3med($id)
    {
        // if(!auth()->user()->hasAnyPermission(['order_show'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $statuses = Status::get();
        $order = Order_guarante::find($id);


        if(isset($order)){
            if ($order->status == -1) {
                $order->status = 0;
                $order->save();
            }
            return view('dashboard.orders.show_guarante', ['order' => $order, 'statuses' => $statuses]);
        }else{

            $statuses = Status::get();
            $setting = Setting::first();
            $orders = Order_guarante::latest()->paginate($setting->paginate);
            return view('dashboard.orders.index_guarante', ['orders' => $orders,'statuses' => $statuses]);

        }
    }

    public function paymentStatusTa3med(Request $r, $id)
    {

        $r->validate([
            'guaranteOrderId' => ['required'],
            'paymentStatus' => ['required'],
        ]);

        if($r->guaranteOrderId ==  $id){

            $order = Order_guarante::find($id);

            $order->prove_status = $r->paymentStatus;
           
            if($r->paymentStatus == 1){

                $order->status = 1;


                // Send sms To external Mo3aqeb 
                $vNumber = validNumber($order->phone_seller);

                // $sms_msg = "" $order->ta3med_value . "رقم : ".$order->order_no;

                $sms_msg = "عزيزي البائع تم استلام مبلغ وقدره(".$order->ta3med_value." ريال) و حجزه لصالحكم كتعميد برقم ( ".$order->order_no.")";

                $send = senSMS($vNumber, $sms_msg);

                if( $send['statusCode'] == '201' ){

                    $sentSMS = new SentSms;
                    $sentSMS->user_id =  $order->orderUser->id;
                    $sentSMS->content =  $sms_msg;
                    $sentSMS->status = 1;
                    $sentSMS->save();

                   // return redirect()->back()->with('success', 'تم تحديث حالة معالجة الطلب وارسال الرسالة بنجاح');
                }



            }

            $order->save();

            return redirect()->back()->with('success', 'تم تعديل حالة الدفع للطلب '.$id.' بنجاح');

        }else{

            return redirect()->back()->with('error', 'حدث خطأ اثناء معالجة طلبك');

        }

    }

    public function destroy($id)
    {
        // if(!auth()->user()->hasAnyPermission(['order_delete'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $order = Order_guarante::find($id);
        $order->delete();
        return redirect()->back()->with('success', 'تم حذف الطلب بنجاح');
    }





  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        // if(!auth()->user()->hasAnyPermission(['order_update'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $r->validate([
            'processing_id' => ['required'],
        ]);
        $status = Status::find($r->processing_id);
        $order = Order_guarante::find($id);
        $order->processing_id = $status->id;
        $order->save();

        if ($status->sms == 1) {



            $vNumber = validNumber($order->orderUser->phone);

            $sms_msg = $status->sms_text . "رقم : ".$order->order_no;

            $send = senSMS($vNumber, $sms_msg);

            if( $send['statusCode'] == '201' ){

                $sentSMS = new SentSms;
                $sentSMS->user_id =  $order->orderUser->id;
                $sentSMS->content =  $sms_msg;
                $sentSMS->status = 1;
                $sentSMS->save();

                return redirect()->back()->with('success', 'تم تحديث حالة معالجة الطلب وارسال الرسالة بنجاح');
            }else{
                return redirect()->back()->with('error', 'الرقم غير صحيح' .$order->orderUser->phone);
            }

            return redirect()->back()->with('error', 'حدث مشكلة اثناء ارسال الرسالة' . $order->phone_buyer);



        }


        return redirect()->back()->with('success', 'تم تحديث حالة معالجة الطلب بنجاح');

    }

   


    public function statusUpdate(Request $r)
    {
        // if(!auth()->user()->hasAnyPermission(['order_update'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $r->validate([
            'processing_id' => ['required'],
        ]);

        $ids = explode(",", $r->ids_input);
        $msgArray = [];
        foreach ($ids as $key => $value) {
            if($value == null){return redirect()->back()->with('error', 'لم تقم باختيار اي طلب');}
            $status = Status::find($r->processing_id);
            $order = Order_guarante::find($value);
            $order->processing_id = $status->id;
            $order->save();
            if ($status->sms == 1) {


                  
                $vNumber = validNumber($order->orderUser->phone);

                $sms_msg = $status->sms_text . "رقم : ".$order->order_no;

                $send = senSMS($vNumber, $sms_msg);

                if( $send['statusCode'] == '201' ){

                    $sentSMS = new SentSms;
                    $sentSMS->user_id =  $order->orderUser->id;
                    $sentSMS->content =  $sms_msg;
                    $sentSMS->status = 1;
                    $sentSMS->save();

                    $msg = ['success', 'تم تحديث حالة معالجة الطلب وارسال الرسالة بنجاح'];

                    array_push($msgArray , $msg);
                }else{

                    $msg = ['error', 'الرقم غير صحيح' .$order->orderUser->phone];
                    array_push($msgArray , $msg);
                }

               // $msgArray .= array('error', 'حدث مشكلة اثناء ارسال الرسالة' . $order->orderUser->phone);

                // $sms_send_status = senSMS($order->phone_client, $status->sms_text);
                // if ($sms_send_status == 1) {
                //     return redirect()->back()->with('success', 'تم تحديث حالة معالجة الطلب وارسال الرسالة بنجاح');
                // } elseif ($sms_send_status === false){
                //     return redirect()->back()->with('error', 'الرقم غير صحيح' . $order->phone_client);
                // }
                // return redirect()->back()->with('error', 'حدث مشكلة اثناء ارسال الرسالة' . $order->phone_client);



            }
            
        }
        // return redirect()->back()->with('success', 'تم تحديث حالة معالجة الطلب بنجاح');
         return redirect()->back()->with( $msgArray );

    }



    public function changeStatus(Request $r, $id)
    {

        $r->validate([
            'mo3amlaOrderId' => ['required'],
            'status' => ['required'],
        ]);

        if($r->mo3amlaOrderId ==  $id){


            $order = Order_guarante::find($id);

            if($r->status == "3" || $r->status == "-3"){
                
                $r->validate([
                    'statusReason' => ['required'],
                ]);

                $order->statusReason = $r->statusReason;
            }elseif ($r->status == "5") {
               
                $vNumber = validNumber($order->orderUser->phone);

                $sms_msg = "عزيزي العميل : تم إنجاز معاملتكم رقم (".$order->order_no.") نأمل منكم تقييم الطلب وتحميل الفاتورة" ;

                $send = senSMS($vNumber, $sms_msg);

                if( $send['statusCode'] == '201' ){

                    $sentSMS = new SentSms;
                    $sentSMS->user_id =  $order->orderUser->id;
                    $sentSMS->content =  $sms_msg;
                    $sentSMS->status = 1;
                    $sentSMS->save();

                }

                    /*
                    *
                    * SEND Notification To client
                    */
                    //--------------------------
                    // send mail 
                    //--------------------------
                    $data = array(
                        'name' => $order->orderUser->name,
                        'id' => $order->id,
                        'order_no' => $order->order_no,
                        'email' => $order->orderUser->email,
                        'type' => 'guarante',
                    );
                    Mail::send('customEmail.clients.client_orderComplete', $data, function($message) use ($data){
                        $message->from('no-replay@enjaz-fawry.com');
                        $message->to( $data['email'] );
                        $message->subject('انجاز فوري : تم انجاز طلبك رقم - '.$data['order_no']);
                    });

                $order->closed = 1;
            }

            $order->status = $r->status;
            
            $order->save();

            return redirect()->back()->with('success', 'تم تعديل حالة الطلب '.$id.' بنجاح');

        }else{

            return redirect()->back()->with('error', 'حدث خطأ اثناء معالجة طلبك');

        }

    }









}
