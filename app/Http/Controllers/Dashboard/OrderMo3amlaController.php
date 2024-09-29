<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Status;
use App\City;
use App\Setting;
use App\Bank;
use App\Order_mo3amla;
use App\User;
use App\Mo3amlaProcessing;
use App\Mo3amlaNote;
use App\Balance;
use App\SentSms;
use Mail;


use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;


use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderMo3amlaController extends Controller
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
        $orders = Order_mo3amla::whereIn('status', ['-1', 0,1,2,3,4,'-2','-4','-5'])->latest()->paginate($setting->paginate);
        return view('dashboard.orders.index_mo3amla', ['orders' => $orders,'statuses' => $statuses, 'city'=>$city, 'bank'=>$bank]);
    }

   


    public function archive()
    {
        // if(!auth()->user()->hasAnyPermission(['order_index'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // } 
        $statuses = Status::get();
        $setting = Setting::first();
        $city = City::get();
        $bank = Bank::get();
        $orders = Order_mo3amla::whereIn('status', [5,'-3'])->latest()->paginate($setting->paginate);
        return view('dashboard.orders.archive_mo3amla', ['orders' => $orders,'statuses' => $statuses, 'city'=>$city, 'bank'=>$bank]);
    }


    public function AjaxMo3amlaOne(Request $r)
    {
         
        //$options = Setting::first();
        $data = view('dashboard.orders.ajax.mo3amla_One')->render();
        return response()->json(['options'=>$data]);
        
    }

    public function AjaxMo3amlaTwo(Request $r)
    {
         
        //$options = Setting::first();
        $data = view('dashboard.orders.ajax.mo3amla_Two')->render();
        return response()->json(['options'=>$data]);
        
    }
    public function AjaxMo3amlaTwoA(Request $r)
    {
         
        $data = view('dashboard.orders.ajax.mo3amla_Two_A')->render();
        return response()->json(['options'=>$data]);
        
    }

    public function AjaxMo3amlaAssignTo(Request $r)
    {
           
        $procces = Mo3amlaProcessing::find($r->order_id);
        $data = view('dashboard.orders.ajax.mo3amla_Assign_To', compact(['procces']))->render();
        return response()->json(['options'=>$data]);
        
    }


     public function AjaxMo3amlaReAssignTo(Request $r)
    {
           
        $order = Order_mo3amla::find($r->order_id);

        if($order->m_processType == "1" || $order->m_processType == "1A" ){

            $data = view('dashboard.orders.ajax.mo3amla_ReAssign_To_One', compact(['order']))->render();
            return response()->json(['options'=>$data]);
        
        }else{
            $process = Mo3amlaProcessing::where('mo3amla_id', $r->order_id)->where('choosen', 1)->first();
            $data = view('dashboard.orders.ajax.mo3amla_ReAssign_To', compact(['order', 'process']))->render();
            return response()->json(['options'=>$data]);
        }
        
        
    }


    public function sendNotes(Request $r)
    {

        // dd($r);

        $r->validate([
            'mo3amlaOrderId' => ['required'],
            'notes' => ['required'],           
            'needNewFiles' => ['required'],           
            'needTextAnswer' => ['required'],
            'noteId' => ['required'],
        ]);

        $note = Mo3amlaNote::find($r->noteId);

        $order = Order_mo3amla::find($r->mo3amlaOrderId);

        $note->mo3amla_id =  $r->mo3amlaOrderId;
        $note->user_id    =  $order->user_id;
        //$note->vendor_id  =  $order->vendor_id;
        $note->content    =  $r->notes;
        $note->status     =  1;
        $note->from       =  "admin";
        $note->to         =  "client";

        if($r->needNewFiles == "1"){

            $note->need_files =  1;

        }else{

            $note->need_files =  0;

        }

        if($r->needTextAnswer == "1"){

            $note->need_text =  1;
          
        }else{
            $note->need_text =  0;

        }
        



        $note->save();



        $user = User::find($order->user_id);

       
      


        if($r->needNewFiles == "1"){

            $order->m_processNeedUploadNewFiles = 1;
            $order->m_processNewFilesStatus  = "-1";

            // $order->save();

        }else{

            $order->m_processNeedUploadNewFiles = null;

        }

        if($r->needTextAnswer == "1"){

            $order->m_processNeedTextNotes = 1;
          

        }else{
            $order->m_processNeedTextNotes = null;

        }

        $order->m_have_notes = 1;

        $order->save();






       

            
      
// start notification 

if(!empty($user->firebase_token) ||  $user->firebase_token != null){

    $optionBuilder = new OptionsBuilder();
    $optionBuilder->setTimeToLive(60*20);

    $notificationBuilder = new PayloadNotificationBuilder('يوجد ملاحظة على طلبك');
    $notificationBuilder->setBody('يوجد ملاحظة على معاملتك')->setSound('default');
    $notificationBuilder->setClickAction("FLUTTER_NOTIFICATION_CLICK");

    $dataBuilder = new PayloadDataBuilder();
    $dataBuilder->addData([
        'click_action' =>  'FLUTTER_NOTIFICATION_CLICK',
        'notification_title' => 'يوجد ملاحظة على طلبك',
        'notification_body' => 'يوجد ملاحظة على معاملتك',
        'order_id' => $order->id,
        'note_id' => $note->id,
        'type' => 'user',
        'page' => 'mo3amla_details_page',
    ]);

    $option = $optionBuilder->build();
    $notification = $notificationBuilder->build();
    $data = $dataBuilder->build();

    $token = $order->orderUser->firebase_token;

    $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

    // end notification



}



        return redirect()->back()->with('success', 'تم ارسال الملاحظات للمعاملة رقم  '.$r->mo3amlaOrderId.' بنجاح');





    }



     public function sendNewNotes(Request $r)
    {

        // dd($r);

        $r->validate([
            'mo3amlaOrderId' => ['required'],
            'notes' => ['required'],           
            'needNewFiles' => ['required'],           
            'needTextAnswer' => ['required'],
            'sendTo' => ['required'],
        ]);

        $note = new Mo3amlaNote;

        $order = Order_mo3amla::find($r->mo3amlaOrderId);


        $processChoosenVendor =  $order->processMo3ala->where('choosen', 1)->first();

        if($processChoosenVendor){

            if($processChoosenVendor->count() > 0){

                $note->vendor_id  =  $processChoosenVendor->user_id;
            }
        }
       


        $note->mo3amla_id =  $r->mo3amlaOrderId;
        $note->user_id    =  $order->user_id;
        
        $note->content    =  $r->notes;
        $note->status     =  0;
        $note->from       =  "admin";
        $note->to         =  $r->sendTo;
       
        


        if($r->needNewFiles == "1"){

            $order->m_processNeedUploadNewFiles = 1;
            $order->m_processNewFilesStatus  = "-1";
            $note->need_files =  1;

           // $order->save();

        }else{

            $order->m_processNeedUploadNewFiles = null;

        }

        if($r->needTextAnswer == "1"){

            $order->m_processNeedTextNotes = 1;
            
            $note->need_text =  1;

            

        }else{

              
            $order->m_processNeedTextNotes = null;

        }

        $order->m_have_notes = 1;
        $order->status =  "-4";
        $order->save();

        $note->save();


if($r->sendTo == 'vendor'){
    $push_type = "vendor";
}else{
    $push_type = "user";
}
        
$user = User::find($order->user_id);
// start notification 
if(!empty($user->firebase_token) ||  $user->firebase_token != null){
    $optionBuilder = new OptionsBuilder();
    $optionBuilder->setTimeToLive(60*20);

    $notificationBuilder = new PayloadNotificationBuilder('يوجد ملاحظة على طلبك');
    $notificationBuilder->setBody('يوجد ملاحظة على معاملتك ')->setSound('default');
    $notificationBuilder->setClickAction("FLUTTER_NOTIFICATION_CLICK");

    $dataBuilder = new PayloadDataBuilder();
    $dataBuilder->addData([
        'click_action' =>  'FLUTTER_NOTIFICATION_CLICK',
        'notification_title' => 'يوجد ملاحظة على طلبك',
        'notification_body' => 'يوجد ملاحظة على معاملتك',
        'order_id' => $order->id,
        'note_id' => $note->id,
        'type' =>  $push_type,
        'page' => 'mo3amla_details_page',
    ]);

    $option = $optionBuilder->build();
    $notification = $notificationBuilder->build();
    $data = $dataBuilder->build();

    $token = $order->orderUser->firebase_token;

    $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
}
// end notification


        return redirect()->back()->with('success', 'تم ارسال الملاحظات للمعاملة رقم  '.$r->mo3amlaOrderId.' بنجاح');




    }





    /**
     * Send mo3amla price and data to client
     * 
     */
    public function Mo3amlaAsignSubmit(Request $r)
    {
       

        $r->validate([
            'mo3amlaOrderId' => ['required'],
            'mo3amlaProcessOrderId' => ['required'],           
            'vendor_id' => ['required'],           
            'enjaz_price' => ['required'],
            'thirdparty_price' => ['required'],
           
           
            'days' => ['required'],
            'requirments' => ['required', 'max:191'],
        ]);
       

         // update mo3amla order record with data
            $order = Order_mo3amla::find($r->mo3amlaOrderId);

        if($order->m_processGovPrice == Null){

            $r->validate([
                'gov_price' => ['required'],
            ]);

            $order->m_processGovPrice     =  $r->gov_price;
        }


        if($order->price == Null){

            $r->validate([
                 'price' => ['required'],
            ]);

            $order->price     =  $r->price;
        }
       
       

            $order->m_processVendorSelected     =  $r->vendor_id;
            $order->m_processRequirment         =  $r->requirments;




            $order->m_processThirdPartyPrice    =  $r->thirdparty_price;
            
            $order->m_enjazPrice                =  $r->enjaz_price;
           // $order->price                       =  $r->price;
            $order->m_processDays               =  $r->days;
            $order->m_processNewFilesStatus     =  "-1";
            
        
            $order->save();   


            // update all others with 0
            
            Mo3amlaProcessing::where('mo3amla_id', '=', $order->id)->where('id', '<>', $r->mo3amlaProcessOrderId)->update(['choosen' => 0]);



            // update proccesd with chosen mo3akeb 
            $procces = Mo3amlaProcessing::find($r->mo3amlaProcessOrderId);
            $procces->choosen = 1;
            $procces->save();




            $user = User::find($r->vendor_id);




         // start notification 
        if(!empty($user->firebase_token) ||  $user->firebase_token != null){



            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20);

            $notificationBuilder = new PayloadNotificationBuilder('تم تعميد الطلب لديك');
            $notificationBuilder->setBody('تم تعميد الطلب لديك نأمل البدء بالتنفيذ')->setSound('default');
            $notificationBuilder->setClickAction("FLUTTER_NOTIFICATION_CLICK");

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData([
                'click_action' =>  'FLUTTER_NOTIFICATION_CLICK',
                'notification_title' => 'تم تعميد الطلب لديك',
                'notification_body' => 'تم تعميد الطلب لديك نأمل البدء بالتنفيذ',
                'order_id' => $order->id,
                'process_id' => $r->mo3amlaProcessOrderId,
                'type' => 'vendor',
                'page' => 'mo3amla_details_page',
            ]);

            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();

            $token = $user->firebase_token;

            $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        }
        // end notification


        
        
        return redirect()->back()->with('success', 'تم ارسال المعاملة رقم  '.$r->mo3amlaOrderId.' بنجاح');

        // send sms to client 


    }


     public function Mo3amlaAsignReSubmit(Request $r)
    {
       
        
        $r->validate([
            'mo3amlaOrderId' => ['required'],
           // 'mo3amlaOrderId' => ['required'],
                 
            'enjaz_price' => ['required'],
            'thirdparty_price' => ['required'],
            'gov_price' => ['required'],
            'price' => ['required'],
            'days' => ['required'],
            'requirments' => ['required'],
        ]);

        // update mo3amla order record with data
        $order = Order_mo3amla::find($r->mo3amlaOrderId);

            // if($order->m_processType == "1" || $order->m_processType == "1A" ){
            //     //dd($r);
            // }else{

            //     //dd('hello');

            //       $r->validate([
            //         'vendor_id' => ['required'],           
            //     ]);
            // }
           // $order->m_CustomerPrice =  $r->enjaz_price;

            $order->m_processRequirment         =  $r->requirments;


            if($order->m_processType == "1" || $order->m_processType == "1A" ){
               $order->m_processThirdPartyPrice    =  $r->thirdparty_price;
            }
           
            $order->m_processGovPrice           =  $r->gov_price;
            $order->m_enjazPrice                =  $r->enjaz_price;
            $order->price                       =  $r->price;
            $order->m_processDays               =  $r->days;

            $order->status = "-1";
            $order->save();


            
            $user = User::find($order->user_id);

         // start notification 
        if(!empty($user->firebase_token) ||  $user->firebase_token != null){



            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20);

            $notificationBuilder = new PayloadNotificationBuilder('عرض سعر جديد');
            $notificationBuilder->setBody('يوجد عرض سعر جديد لتنفيذ طلبك')->setSound('default');
            $notificationBuilder->setClickAction("FLUTTER_NOTIFICATION_CLICK");

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData([
                'click_action' =>  'FLUTTER_NOTIFICATION_CLICK',
                'notification_title' => 'عرض سعر جديد',
                'notification_body' => 'يوجد عرض سعر جديد لتنفيذ طلبك',
                'order_id' => $order->id,
            //    'process_id' => $r->mo3amlaProcessOrderId,
                'type' => 'user',
                'page' => 'mo3amla_details_page',
            ]);

            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();

            $token = $user->firebase_token;

            $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        }
        // end notification

        
        return redirect()->back()->with('success', 'تم اعادة ارسال المعاملة رقم  '.$r->mo3amlaOrderId.' بنجاح');

        // send sms to client 


    }

    public function AjaxMo3amlaTwoC(Request $r)
    {
         
        //$options = Setting::first();
        $data = view('dashboard.orders.ajax.mo3amla_Two_C')->render();
        return response()->json(['options'=>$data]);
        
    }
    public function AjaxMo3amlaThree(Request $r)
    {
         
        $setting = Setting::first();

        $order = Order_mo3amla::find($r->order_id);

        $vendors = User::where([ ['type', '=', 'vendor'], ['status', '=', '1'], ['id', '<>', $order->user_id] ])
                    ->orWhere([ ['type', '=', 'vendorC'],['status', '=', '1'],['id', '<>', $order->user_id] ])->get();
                    
        $data = view('dashboard.orders.ajax.mo3amla_Three', compact(['vendors', 'order']))->render();
        
        return response()->json(['options'=>$data]);
        
    }

    public function assignMo3amla(Request $r)
    {
         
        $r->validate([
            'mo3amla_process_type' => ['required'],
            'order_id' => ['required'],           
        ]);

        

        if($r->mo3amla_process_type == "1"){
        
            $r->validate([
                'enjaz_price' => ['required'],
                'thirdparty_price' => ['required'],
                'gov_price' => ['required'],
                'price' => ['required'],
                'days' => ['required'],
                'requirments' => ['required'],
            ]);

            $id = $r->order_id;

           // dd($r);
            $order = Order_mo3amla::find($id);


            $order->m_processType = "1";
            $order->m_processRequirment = $r->requirments;

            $order->m_enjazPrice = $r->enjaz_price;
            $order->m_processThirdPartyPrice = $r->thirdparty_price;
            $order->m_processGovPrice = $r->gov_price;
            $order->price = $r->price;

            $order->m_processDays = $r->days;

            $order->m_processNeedUploadNewFiles = $r->needNewFiles;

            $order->m_processNewFilesStatus = "-1";


            $order->save();


            $user = User::find($order->user_id);




            // start notification 
        if(!empty($user->firebase_token) ||  $user->firebase_token != null){

            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20);
    
            $notificationBuilder = new PayloadNotificationBuilder('تم الرد على الطلب رقم '.$order->order_no.'');
            $notificationBuilder->setBody('يوجد عرض سعر لتنفيذ طلبكم رقم  '.$order->order_no.'')->setSound('default');
            $notificationBuilder->setClickAction("FLUTTER_NOTIFICATION_CLICK");
    
            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData([
                'click_action' =>  'FLUTTER_NOTIFICATION_CLICK',
                'notification_title' => 'تم الرد على الطلب رقم '.$order->order_no.' ',
                'notification_body' => 'يوجد عرض سعر لتنفيذ طلبكم رقم  '.$order->order_no.' ',
                'order_id' => $order->id,
                'type' => 'user',
                'page' => 'mo3amla_details_page',
            ]);
    
            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();
    
            $token = $order->orderUser->firebase_token;
    
            $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
         }
         // end notification



        

            return redirect()->back()->with('success', 'تم ارسال المعاملة رقم  '.$id.' بنجاح');


        }elseif($r->mo3amla_process_type == "2"){

            $id = $r->order_id;

            $vendors = User::whereNotIn('status',['-2','-1','0'])->where('type', 'vendor')->orWhere('type', 'vendorC')->get();

            $order = Order_mo3amla::find($id);

            $vv=[];
            foreach ($vendors as  $vendor) {

                if($vendor->id !== $order->user_id ){


                    $assign = new Mo3amlaProcessing;
                    $assign->mo3amla_id = $r->order_id;
                    $assign->user_id = $vendor->id;
                    $assign->save();



                    /*
                    *
                    * SEND Notification To Vendor
                    */
                    //--------------------------
                    // send mail 
                    //--------------------------
                    $data = array(
                        'name' => $vendor->name,
                        'id' => $assign->id,
                        'email' => $vendor->email,
                    );
                    Mail::send('customEmail.clients.vendor_newOrder', $data, function($message) use ($data){
                        $message->from('no-replay@enjaz-fawry.com');
                        $message->to($data['email']);
                        $message->subject('انجاز فوري : طلب جديد بانتظار عرض سعرك');
                    });
                    //--------------------------
                    // send SMS 
                    //--------------------------
                    // $vNumber = validNumber($vendor->phone);
                    // if($vendor->type == 'vendor'){
                    //     $tupe = 'معقب';
                    // }elseif($vendor->type == 'vendorC'){
                    //     $tupe = 'مكتب الخدمات';
                    // }
                    // $sms_msg = 'عزيزي '. $tupe .' لديك طلب جديد على حسابك قم بالدخول لتقديم سعرك';
                    // $send = senSMS($vNumber, $sms_msg);
                    // if( $send['ResponseStatus'] == 'success' ){
                    //     $sentSMS = new SentSms;
                    //     $sentSMS->user_id =  $order->orderUser->id;
                    //     $sentSMS->content =  $sms_msg;
                    //     $sentSMS->status = 1;
                    //     $sentSMS->save();
                    // }

                    /*
                    *
                    * End SEND Notification To Vendor
                    */



                    // start notification 
                 //  $user = User::find($order->user_id);




                    // start notification 
                if(!empty($vendor->firebase_token) ||  $vendor->firebase_token != null){

                    $optionBuilder = new OptionsBuilder();
                    $optionBuilder->setTimeToLive(60*20);
            
                    $notificationBuilder = new PayloadNotificationBuilder('يوجد طلب جديد بحسابك');
                    $notificationBuilder->setBody('نأمل تقديم عرض سعركم لتنفيذ الطلب ')->setSound('default');
                    $notificationBuilder->setClickAction("FLUTTER_NOTIFICATION_CLICK");
            
                    $dataBuilder = new PayloadDataBuilder();
                    $dataBuilder->addData([
                        'click_action' =>  'FLUTTER_NOTIFICATION_CLICK',
                        'notification_title' => 'يوجد طلب جديد بحسابك',
                        'notification_body' => 'نأمل تقديم عرض سعركم لتنفيذ الطلب',
                        'order_id' => $order->id,
                        'process_id' => $assign->id,
                        'type' => 'vendor',
                        'page' => 'mo3amla_details_page',
                    ]);
            
                    $option = $optionBuilder->build();
                    $notification = $notificationBuilder->build();
                    $data = $dataBuilder->build();
            
                    $token = $vendor->firebase_token;
            
                    $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
                }
                    // end notification

                   //  response()->json(200);
                    //array_push($vv, $vendor->account_no);

                }
               

            }

            $order->m_processType = "2";
            $order->save();


            // $res =  array('success',  'تم ارسال المعاملة بنجاح' , 200);
            // return redirect()->back()->with('success', 'تم ارسال المعاملة رقم  '.$id.' بنجاح');
            // return redirect()->back()->response()->json($res);

            
            return redirect()->back()->with('success', 'تم ارسال المعاملة رقم  '.$id.' بنجاح');

            //  return response()->json($Order, 200);
        
            // dd($r->order_id);
        }elseif($r->mo3amla_process_type == "2A"){ 
           
            $id = $r->order_id;

            $vendors = User::whereNotIn('status',['-2','-1','0'])->where('type', 'vendor')->get();

            $order = Order_mo3amla::find($id);

            $vv=[];
            foreach ($vendors as  $vendor) {

                if($vendor->id !== $order->user_id ){

                    $assign = new Mo3amlaProcessing;
                    $assign->mo3amla_id = $r->order_id;
                    $assign->user_id = $vendor->id;
                    $assign->save();


                     /*
                    *
                    * SEND Notification To Vendor
                    */
                    //--------------------------
                    // send mail 
                    //--------------------------
                    $data = array(
                        'name' => $vendor->name,
                        'id' => $assign->id,
                        'email' => $vendor->email,
                    );
                    Mail::send('customEmail.clients.vendor_newOrder', $data, function($message) use ($data){
                        $message->from('no-replay@enjaz-fawry.com');
                        $message->to($data['email']);
                        $message->subject('انجاز فوري : طلب جديد بانتظار عرض سعرك');
                    });
                    //--------------------------
                    // send SMS 
                    //--------------------------
                    // $vNumber = validNumber($vendor->phone);
                    // if($vendor->type == 'vendor'){
                    //     $tupe = 'معقب';
                    // }elseif($vendor->type == 'vendorC'){
                    //     $tupe = 'مكتب خدمات';
                    // }
                    // $sms_msg = 'عزيزي '. $tupe .' لديك طلب جديد على حسابك قم بالدخول لتقديم سعرك';
                    // $send = senSMS($vNumber, $sms_msg);
                    // if( $send['ResponseStatus'] == 'success' ){
                    //     $sentSMS = new SentSms;
                    //     $sentSMS->user_id =  $order->orderUser->id;
                    //     $sentSMS->content =  $sms_msg;
                    //     $sentSMS->status = 1;
                    //     $sentSMS->save();
                    // }

                    /*
                    *
                    * End SEND Notification To Vendor
                    */


                    // start notification 
                    if(!empty($vendor->firebase_token) ||  $vendor->firebase_token != null){

                    $optionBuilder = new OptionsBuilder();
                    $optionBuilder->setTimeToLive(60*20);
            
                    $notificationBuilder = new PayloadNotificationBuilder('يوجد طلب جديد بحسابك');
                    $notificationBuilder->setBody('نأمل تقديم عرض سعركم لتنفيذ الطلب ')->setSound('default');
                    $notificationBuilder->setClickAction("FLUTTER_NOTIFICATION_CLICK");
            
                    $dataBuilder = new PayloadDataBuilder();
                    $dataBuilder->addData([
                        'click_action' =>  'FLUTTER_NOTIFICATION_CLICK',
                        'notification_title' => 'يوجد طلب جديد بحسابك',
                        'notification_body' => 'نأمل تقديم عرض سعركم لتنفيذ الطلب',
                        'order_id' => $order->id,
                        'process_id' => $assign->id,
                        'type' => 'vendor',
                        'page' => 'mo3amla_details_page',
                    ]);
            
                    $option = $optionBuilder->build();
                    $notification = $notificationBuilder->build();
                    $data = $dataBuilder->build();
            
                    $token = $vendor->firebase_token;
            
                    $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
                    }
                    // end notification


                }
            }

            $order->m_processType = "2A";
            $order->save();


            return redirect()->back()->with('success', 'تم ارسال المعاملة رقم  '.$id.' بنجاح');

        }elseif($r->mo3amla_process_type == "2C"){ 
           
            $id = $r->order_id;

            $vendors = User::whereNotIn('status',['-2','-1','0'])->where('type', 'vendorC')->get();

            $order = Order_mo3amla::find($id);

            $vv=[];
            foreach ($vendors as  $vendor) {

                if($vendor->id !== $order->user_id ){

                    $assign = new Mo3amlaProcessing;
                    $assign->mo3amla_id = $r->order_id;
                    $assign->user_id = $vendor->id;
                    $assign->save();


                     /*
                    *
                    * SEND Notification To Vendor
                    */
                    //--------------------------
                    // send mail 
                    //--------------------------
                    $data = array(
                        'name' => $vendor->name,
                        'id' => $assign->id,
                        'email' => $vendor->email,
                    );
                    Mail::send('customEmail.clients.vendor_newOrder', $data, function($message) use ($data){
                        $message->from('no-replay@enjaz-fawry.com');
                        $message->to($data['email']);
                        $message->subject('انجاز فوري : طلب جديد بانتظار عرض سعرك');
                    });
                    //--------------------------
                    // send SMS 
                    //--------------------------
                    // $vNumber = validNumber($vendor->phone);
                    // if($vendor->type == 'vendor'){
                    //     $tupe = 'معقب';
                    // }elseif($vendor->type == 'vendorC'){
                    //     $tupe = 'مكتب خدمات';
                    // }
                    // $sms_msg = 'عزيزي '. $tupe .' لديك طلب جديد على حسابك قم بالدخول لتقديم سعرك';
                    // $send = senSMS($vNumber, $sms_msg);
                    // if( $send['ResponseStatus'] == 'success' ){
                    //     $sentSMS = new SentSms;
                    //     $sentSMS->user_id =  $order->orderUser->id;
                    //     $sentSMS->content =  $sms_msg;
                    //     $sentSMS->status = 1;
                    //     $sentSMS->save();
                    // }

                    /*
                    *
                    * End SEND Notification To Vendor
                    */

                    // start notification 
                    if(!empty($vendor->firebase_token) ||  $vendor->firebase_token != null){
                        $optionBuilder = new OptionsBuilder();
                        $optionBuilder->setTimeToLive(60*20);
                
                        $notificationBuilder = new PayloadNotificationBuilder('يوجد طلب جديد بحسابك');
                        $notificationBuilder->setBody('نأمل تقديم عرض سعركم لتنفيذ الطلب ')->setSound('default');
                        $notificationBuilder->setClickAction("FLUTTER_NOTIFICATION_CLICK");
                
                        $dataBuilder = new PayloadDataBuilder();
                        $dataBuilder->addData([
                            'click_action' =>  'FLUTTER_NOTIFICATION_CLICK',
                            'notification_title' => 'يوجد طلب جديد بحسابك',
                            'notification_body' => 'نأمل تقديم عرض سعركم لتنفيذ الطلب',
                            'order_id' => $order->id,
                            'process_id' => $assign->id,
                            'type' => 'vendor',
                            'page' => 'mo3amla_details_page',
                        ]);
                
                        $option = $optionBuilder->build();
                        $notification = $notificationBuilder->build();
                        $data = $dataBuilder->build();
                
                        $token = $vendor->firebase_token;
                
                        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
                    }
                    // end notification
                }
            }

            $order->m_processType = "2C";
            $order->save();


            return redirect()->back()->with('success', 'تم ارسال المعاملة رقم  '.$id.' بنجاح');


        }elseif($r->mo3amla_process_type == "3"){ 


            $r->validate([
                'order_id' => ['required'],
                'user_id' => ['required'],
                'ids_input' => ['required'],
            ]);

            $ids = explode(",", $r->ids_input);


            

            $order_id = $r->order_id;

           // $vendors = User::whereNotIn('status',['-2','-1','0'])->where('type', 'vendorC')->get();

            $order = Order_mo3amla::find($order_id);
         
             //   dd($order->user_id);
            // $vv=[];
            foreach ($ids as  $vendor_id) {

                if($vendor_id != $order->user_id ){


                    $vendor = User::find($vendor_id);

                    $assign = new Mo3amlaProcessing;
                    $assign->mo3amla_id = $r->order_id;
                    $assign->user_id = $vendor_id;
                    $assign->save();

                     /*
                    *
                    * SEND Notification To Vendor
                    */
                    //--------------------------
                    // send mail 
                    //--------------------------
                    $data = array(
                        'name' => $vendor->name,
                        'id' => $assign->id,
                        'email' => $vendor->email,
                    );
                    Mail::send('customEmail.clients.vendor_newOrder', $data, function($message) use ($data){
                        $message->from('no-replay@enjaz-fawry.com');
                        $message->to($data['email']);
                        $message->subject('انجاز فوري : طلب جديد بانتظار عرض سعرك');
                    });
                    //--------------------------
                    // send SMS 
                    //--------------------------
                    // $vNumber = validNumber($vendor->phone);
                    // if($vendor->type == 'vendor'){
                    //     $tupe = 'معقب';
                    // }elseif($vendor->type == 'vendorC'){
                    //     $tupe = 'مكتب خدمات';
                    // }
                    // $sms_msg = 'عزيزي '. $tupe .' لديك طلب جديد على حسابك قم بالدخول لتقديم سعرك';
                    // $send = senSMS($vNumber, $sms_msg);
                    // if( $send['ResponseStatus'] == 'success' ){
                    //     $sentSMS = new SentSms;
                    //     $sentSMS->user_id =  $order->orderUser->id;
                    //     $sentSMS->content =  $sms_msg;
                    //     $sentSMS->status = 1;
                    //     $sentSMS->save();
                    // }

                    /*
                    *
                    * End SEND Notification To Vendor
                    */

                     // start notification 
                     if(!empty($vendor->firebase_token) ||  $vendor->firebase_token != null){
                     $optionBuilder = new OptionsBuilder();
                     $optionBuilder->setTimeToLive(60*20);
             
                     $notificationBuilder = new PayloadNotificationBuilder('يوجد طلب جديد بحسابك');
                     $notificationBuilder->setBody('نأمل تقديم عرض سعركم لتنفيذ الطلب ')->setSound('default');
                     $notificationBuilder->setClickAction("FLUTTER_NOTIFICATION_CLICK");
             
                     $dataBuilder = new PayloadDataBuilder();
                     $dataBuilder->addData([
                        'click_action' =>  'FLUTTER_NOTIFICATION_CLICK',
                        'notification_title' => 'يوجد طلب جديد بحسابك',
                        'notification_body' => 'نأمل تقديم عرض سعركم لتنفيذ الطلب',
                        'order_id' => $order->id,
                        'process_id' => $assign->id,
                        'type' => 'vendor',
                        'page' => 'mo3amla_details_page',
                     ]);
             
                     $option = $optionBuilder->build();
                     $notification = $notificationBuilder->build();
                     $data = $dataBuilder->build();
             
                     $token = $vendor->firebase_token;
             
                     $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
                     }
                     // end notification
                }
            }

            $order->m_processType = 3;
            $order->save();


            return redirect()->back()->with('success', 'تم ارسال المعاملة رقم  '.$order_id.' بنجاح');


            // echo $r->mo3amla_process_type;
            // dd($r);



        }
        // $setting = Setting::first();

        // $vendors = User::whereNotIn('status',['-2','-1','0'])->where('type', 'vendor')->orWhere('type', 'vendorC')->paginate($setting->paginate);

        // $data = view('dashboard.orders.ajax.mo3amla_Three', compact(['vendors']))->render();
        
        // return response()->json(['options'=>$data]);
        
    }




    public function show($id)
    {
        // if(!auth()->user()->hasAnyPermission(['order_show'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $statuses = Status::get();
        $order = Order_mo3amla::find($id);
        $process = Mo3amlaProcessing::where('mo3amla_id', $id)->get();

        // dd($process);
        if(isset($order)){
            if ($order->status == -1) {
                $order->status = 0;
                $order->save();
            }
            return view('dashboard.orders.show_mo3amla', ['order' => $order, 'statuses' => $statuses, 'process' => $process]);

        }else{

            $statuses = Status::get();
            $setting = Setting::first();
            $orders = Order_mo3amla::latest()->paginate($setting->paginate);
            return view('dashboard.orders.index_mo3amla', ['orders' => $orders,'statuses' => $statuses]);

        }
    }


    
    


    public function paymentStatusMo3amla(Request $r, $id)
    {

        $r->validate([
            'mo3amlaOrderId' => ['required'],
            'paymentStatus' => ['required'],
        ]);

        if($r->mo3amlaOrderId ==  $id){

            $order = Order_mo3amla::find($id);

            $order->prove_status = $r->paymentStatus;
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
        $order = Order_mo3amla::find($id);
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
        $order = Order_mo3amla::find($id);
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
            $order = Order_mo3amla::find($value);
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
            }
            
        }
        return redirect()->back()->with( $msgArray );
    }


    

    public function enjazProve(Request $r)
    {

        $r->validate([
            'orderId' => ['required'],
            'userId' => ['required'],
            'mo3kb_enjaz_prove' => ['required_without:enjaz_prove'],
            'enjaz_prove' => ['required_without:mo3kb_enjaz_prove','mimes:jpeg,JPEG,png,PNG,jpg,JPG,pdf,PDF'],
        ]);

        
      
        if( $r->hasFile('enjaz_prove')){

            //file upload and check
            $fileExt            = $r->enjaz_prove->getClientOriginalExtension();
            $fileIdNameNew        = uniqid() . time() . '.' . $fileExt;
            $r->enjaz_prove->storeAs('public/enjaz_prove', $fileIdNameNew);

            $order = Order_mo3amla::find($r->orderId);
            $order->enjaz_prove = $fileIdNameNew;

            $order->enjaz_prove_img_link =   url('storage/enjaz_prove') . '/' . $fileIdNameNew;

            $order->status = 5;

            if($order->m_processType != "1" && $order->m_processVendorSelected != NULL){

                $balance = new Balance;
                $balance->order_id =  $order->id;
                $balance->vendor_id =  $order->m_processVendorSelected;
                $balance->vendor_price =  $order->m_processThirdPartyPrice;
                $balance->save();
                
            }

            $order->closed = 1;

            $order->save();

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
                    * SEND Notification To Vendor
                    */
                    //--------------------------
                    // send mail 
                    //--------------------------
                    $data = array(
                        'name' => $order->orderUser->name,
                        'id' => $order->id,
                        'order_no' => $order->order_no,
                        'email' => $order->orderUser->email,
                        'type' => 'mo3amla',
                    );
                    Mail::send('customEmail.clients.client_orderComplete', $data, function($message) use ($data){
                        $message->from('no-replay@enjaz-fawry.com');
                        $message->to( $data['email'] );
                        $message->subject('انجاز فوري : تم انجاز طلبك رقم - '.$data['order_no']);
                    });

    
            return redirect()->back()->with('success', 'تم انجاز الطلب وارسال اثبات الانجاز بنجاح');
            
        }elseif( isset($r->mo3kb_enjaz_prove) ){
            
            
            $order = Order_mo3amla::find($r->orderId);
            $order->status = 5;

            if($order->m_processType != "1" && $order->m_processVendorSelected != NULL){

                $balance = new Balance;
                $balance->order_id =  $order->id;
                $balance->vendor_id =  $order->m_processVendorSelected;
                $balance->vendor_price =  $order->m_processThirdPartyPrice;
                $balance->save();
            }

            $order->closed = 1;

            $order->save();

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
                        'type' => 'mo3amla',
                    );
                    Mail::send('customEmail.clients.client_orderComplete', $data, function($message) use ($data){
                        $message->from('no-replay@enjaz-fawry.com');
                        $message->to( $data['email'] );
                        $message->subject('انجاز فوري : تم انجاز طلبك رقم - '.$data['order_no']);
                    });
    
            return redirect()->back()->with('success', 'تم انجاز الطلب وارسال اثبات الانجاز بنجاح');



        }




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


            $order = Order_mo3amla::find($id);

            if($r->status == "3" || $r->status == "-3"){
                
                $r->validate([
                    'statusReason' => ['required'],
                ]);

                $order->statusReason = $r->statusReason;
            }elseif ($r->status == "5") {
                if($order->m_processType != "1" && $order->m_processVendorSelected != NULL){

                    $balance = new Balance;
                    $balance->order_id =  $order->id;
                    $balance->vendor_id =  $order->m_processVendorSelected;
                    $balance->vendor_price =  $order->m_processThirdPartyPrice;
                    $balance->save();
                }

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
                    * SEND Notification To Vendor
                    */
                    //--------------------------
                    // send mail 
                    //--------------------------
                    $data = array(
                        'name' => $order->orderUser->name,
                        'id' => $order->id,
                        'order_no' => $order->order_no,
                        'email' => $order->orderUser->email,
                        'type' => 'mo3amla',
                    );
                    Mail::send('customEmail.clients.client_orderComplete', $data, function($message) use ($data){
                        $message->from('no-replay@enjaz-fawry.com');
                        $message->to( $data['email'] );
                        $message->subject('انجاز فوري : تم انجاز طلبك رقم - '.$data['order_no']);
                    });

                $order->closed = 1;
            }elseif ($r->status == "2") {


                $process = Mo3amlaProcessing::where('mo3amla_id','=', $id)->where('choosen','=', 1)->first();

                if($process){

                    if($process->count() > 0){

                        $process->status = $r->status;
                        $process->save();
                    }
                }



            }

            $order->status = $r->status;
            
            $order->save();



$user = User::find($order->user_id); 

// start notification 
 if(!empty($user->firebase_token) ||  $user->firebase_token != null){
$optionBuilder = new OptionsBuilder();
$optionBuilder->setTimeToLive(60*20);

$notificationBuilder = new PayloadNotificationBuilder(' تحديث حالة الطلب');
$notificationBuilder->setBody('تم تحديث حالة الطلب الخاص بك ')->setSound('default');
$notificationBuilder->setClickAction("FLUTTER_NOTIFICATION_CLICK");


$dataBuilder = new PayloadDataBuilder();
$dataBuilder->addData([
    'click_action' =>  'FLUTTER_NOTIFICATION_CLICK',
    'notification_title' => 'تحديث حالة الطلب',
    'notification_body' => 'تم تحديث حالة الطلب الخاص بك',
    'order_id' => $order->id,
    'type' => 'user',
    'page' => 'mo3amla_details_page',
]);

$option = $optionBuilder->build();
$notification = $notificationBuilder->build();
$data = $dataBuilder->build();

$token = $order->orderUser->firebase_token;

$downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
 }
// end notification

            return redirect()->back()->with('success', 'تم تعديل حالة الطلب '.$id.' بنجاح');

        }else{

            return redirect()->back()->with('error', 'حدث خطأ اثناء معالجة طلبك');

        }

    }
}