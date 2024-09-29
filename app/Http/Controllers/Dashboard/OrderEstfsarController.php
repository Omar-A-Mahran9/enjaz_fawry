<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Status;
use App\City;
use App\Setting;
use App\Bank;
use App\Order_estfsar;
use App\SentSms;
use Mail;

use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderEstfsarController extends Controller
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
        $orders = Order_estfsar::latest()->paginate($setting->paginate);
        return view('dashboard.orders.index_estfsar', ['orders' => $orders,'statuses' => $statuses, 'city'=>$city, 'bank'=>$bank]);
    }


    public function showEstfsar($id)
    {
        // if(!auth()->user()->hasAnyPermission(['order_show'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $statuses = Status::get();
        $order = Order_estfsar::find($id);

        if(isset($order)){
            if ($order->status == -1) {
                $order->status = 0;
                $order->save();
            }
            return view('dashboard.orders.show_estfsar', ['order' => $order, 'statuses' => $statuses]);
        }else{

            $statuses = Status::get();
            $setting = Setting::first();
            $orders = Order_estfsar::latest()->paginate($setting->paginate);
            return view('dashboard.orders.index_estfsar', ['orders' => $orders,'statuses' => $statuses]);

        }

    }

    public function paymentStatusEstfsar(Request $r, $id)
    {

        $r->validate([
            'estfsarOrderId' => ['required'],
            'paymentStatus' => ['required'],
        ]);

        if($r->estfsarOrderId ==  $id){

            $order = Order_estfsar::find($id);

            $order->prove_status = $r->paymentStatus;

            if($r->paymentStatus == 1){

                $order->status = 1;

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
        $order = Order_estfsar::find($id);
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
        $order = Order_estfsar::find($id);
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

            return redirect()->back()->with('error', 'حدث مشكلة اثناء ارسال الرسالة' . $order->phone_client);



            // $sms_send_status = senSMS($order->phone, $status->sms_text);
            // if ($sms_send_status == 1) {
            //     return redirect()->back()->with('success', 'تم تحديث حالة معالجة الطلب وارسال الرسالة بنجاح');
            // } elseif ($sms_send_status === false){
            //     return redirect()->back()->with('error', 'الرقم غير صحيح' . $order->phone);
            // }
            // return redirect()->back()->with('error', 'حدث مشكلة اثناء ارسال الرسالة' . $order->phone);
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
            if($value == null){
                return redirect()->back()->with('error', 'لم تقم باختيار اي طلب');
            }

            $status = Status::find($r->processing_id);
            $order = Order_estfsar::find($value);
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

                // $msg = ['error', 'حدث مشكلة اثناء ارسال الرسالة' . $order->orderUser->phone];

                // array_push($msgArray , $msg);



                // $sms_send_status = senSMS($order->phone, $status->sms_text);
                // if ($sms_send_status == 1) {
                //     return redirect()->back()->with('success', 'تم تحديث حالة معالجة الطلب وارسال الرسالة بنجاح');
                // } elseif ($sms_send_status === false){
                //     return redirect()->back()->with('error', 'الرقم غير صحيح' . $order->phone);
                // }
                // return redirect()->back()->with('error', 'حدث مشكلة اثناء ارسال الرسالة' . $order->phone);


            }
            
        }
        //return redirect()->back()->with('success', 'تم تحديث حالة معالجة الطلب بنجاح');
        //dd($msgArray);
         return redirect()->back()->with( $msgArray );
    }




    // public function edit(Request $r, $id)
    // {
    //     if(!auth()->user()->hasAnyPermission(['order_show'])){
    //         return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
    //     }
    //     $order_cars = OrderCars::where('order_id', $id)->get();
    //     $statuses = Status::where('where', 1)->orWhere('where', 3)->get();
    //     $order = Order::find($id);
    //     if ($order->status == -1) {
    //         $order->status = 0;
    //         $order->save();
    //     }
    //     return view('dashboard.orders.edit', ['order' => $order, 'statuses' => $statuses, 'order_cars' => $order_cars]);
    // }

    // public function updateData(Request $r)
    // {
    //     $id = $r->id;
    //     if ($r->type == 1) {
    //         $r->validate([
    //             'phone' => ['required', 'regex:/[+0-9]/'],
    //             'name' => ['required', 'string', 'max:90'],
    //             'car' => ['required', 'string', 'max:120'],
    //             'price' => ['required', 'string', 'max:20'],
    //         ]);

    //         $order =  OrderDetailsOne::where('order_id', $id)->first();
    //         $order->name = $r->name;
    //         $order->phone = $r->phone;
    //         $order->car = $r->car;
    //         $order->price = $r->price;
    //         $order->save();

    //         return redirect()->back()->with('success', 'تم تحديث بيانات الطلب بنجاح');

    //     }elseif($r->type == 2){
    //         $r->validate([
    //             'price' => ['required', 'numeric', 'notIn:null'],
    //             'name' => ['required'],
    //             'phone' => ['required', 'regex:/[+0-9]/'],
    //             'city' => ['required'],
    //             'work' => ['required'],
    //             'bank_account' => ['required','notIn:null'],
    //             'driving_license_status' => ['required'],
    //             'mortgage_loan' => ['required'],
    //             'salary' => ['required', 'numeric','min:3000'],
    //             'commitments' => ['required','numeric'],
    //             'last_installment' => ['required'],
    //             'first_installment' => ['required']
    //         ]);

    //         $order = OrderDetailsTow::where('order_id', $id)->first();
    //         $order->name = $r->name;
    //         $order->phone = $r->phone;


    //         $order->price = $r->price;

    //         $order->city = $r->city;
    //         $order->work = $r->work;
    //         $order->bank_account = $r->bank_account;
    //         $order->driving_license_status = $r->driving_license_status;
    //         $order->mortgage_loan = $r->mortgage_loan;
    //         $order->salary = $r->salary;
    //         $order->commitments = $r->commitments;

    //         $order->last_installment = $r->last_installment;
    //         $order->first_installment = $r->first_installment;
    //         $order->save();
    //         return redirect()->back()->with('success', 'تم تحديث بيانات الطلب بنجاح');
    //     }elseif($r->type == 3){
    //         $r->validate([
    //             'company_name' => ['required', 'string', 'min:3', 'max:90'],
    //             'email' => ['required','email', 'string', 'max:120'],
    //             'responsible_person' => ['required', 'string', 'max:120'],
    //             'phone' => ['required', 'regex:/[+0-9]/'],
    //         ]);

    //         $order = OrderDetailsThree::where('order_id', $id)->first();
    //         $order->order_id = $order->id;
    //         $order->company_name = $r->company_name;
    //         $order->phone = $r->phone;
    //         $order->email = $r->email;
    //         $order->responsible_person = $r->responsible_person;
    //         $order->save();
    //         return redirect()->back()->with('success', 'تم تحديث بيانات الطلب بنجاح');
    //     }else{
    //         $r->validate([
    //             'company_name' => ['required','min:3', 'string', 'max:90'],
    //             'email' => ['required', 'email', 'max:150'],
    //             'responsible_person' => ['required', 'string', 'min:3', 'max:90'],
    //             'phone' => ['required', 'regex:/[+0-9]/'],
    //             'headquarters' => ['required', 'string', 'max:255'],
    //             'company_activity' => ['required', 'string', 'max:255'],
    //             'company_age' => ['required', 'string', 'max:12'],
    //             'bank_account' => ['required', 'string', 'max:120'],
    //         ]);

    //         $order = OrderDetailsOne::where('order_id', $id)->first();
    //         $order->order_id = $order->id;
    //         $order->name = $r->name;
    //         $order->phone = $r->phone;
    //         $order->car = $r->car;
    //         $order->price = $r->price;
    //         $order->save();
    //         return redirect()->back()->with('success', 'تم تحديث بيانات الطلب بنجاح');
    //     }
    // }


    public function changeStatus(Request $r, $id)
    {

        $r->validate([
            'mo3amlaOrderId' => ['required'],
            'status' => ['required'],
        ]);

        if($r->mo3amlaOrderId ==  $id){


            $order = Order_estfsar::find($id);

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
                        'type' => 'estfsar',
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
