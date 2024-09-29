<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
// namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Setting;
// use App\Bank;

use App\Order_mo3amla;
use App\User;
use App\Mo3amlaProcessing;
use App\Mo3amlaNote;


// use Auth;

class VendorOrdersController extends Controller
{

    public function __construct()
    {
      //  $this->middleware('auth:web');

      //  $this->middleware('verifyPhone', ['except' => ['verify_form', 'verifyphone'] ]);
    }

    
    public function vendorUpdateStatus(Request $r)
    {

        $r->validate([
            'orderId' => ['required'],
           // 'vendorId' => ['required'],
            'newStatus' => ['required', 'in:2,4,-4'],
            'process_id' => ['required'],
        ]);


        if($r->orderId){


            $order = Order_mo3amla::find($r->orderId);

            if($r->newStatus == '-4'){
                $r->validate([
                    'vendor_notes' => ['required'],
                ]);

                $note = new Mo3amlaNote;

                $note->mo3amla_id =  $r->orderId;
                $note->user_id    =  $order->user_id;
                $note->vendor_id  =  $r->vendorId;
                $note->content    =  $r->vendor_notes;
                $note->status     =  "0";
                $note->from     =  "vendor";
                $note->to     =  "user";
                $note->save();

                $order->m_have_notes = "1";

            }

            if($r->newStatus == '2' || $r->newStatus == '4'){

                $process = Mo3amlaProcessing::find($r->process_id);

                $process->status = $r->newStatus;
                $process->save();

            }
          
            $order->status = $r->newStatus;
            $order->save();

            return response()->json([
                'status' => 1, 
                'type' => 'Success',
                'msg' => ' تم تحديث حالة الطلب بنجاح !',
                'order' => $order,
            ]);

        }else{

            return response()->json([
                'status' => 0, 
                'type' => 'error',
                'msg' => ' حدث خطأ اثناء تنفيذ طلبك !',
            ]);

        }

    }



    public function vendorUpdateEnjazProve(Request $r)
    {

        $r->validate([
            'orderId' => ['required'],
            // 'vendorId' => ['required'],
            'newStatus' => ['required', 'in:2,4,-4'],
            'process_id' => ['required'],
            'enjaz_prove' => ['required','mimes:jpeg,JPEG,png,PNG,jpg,JPG,pdf,PDF'],
            
        ]);


        if($r->orderId){


            if( $r->hasFile('enjaz_prove')){

                //file upload and check
                $fileExt            = $r->enjaz_prove->getClientOriginalExtension();
                $fileIdNameNew        = uniqid() . time() . '.' . $fileExt;
                $r->enjaz_prove->storeAs('public/enjaz_prove', $fileIdNameNew);
    
                $order = Order_mo3amla::find($r->orderId);
                $order->enjaz_prove = $fileIdNameNew;
                $order->status = $r->newStatus;

    
                $order->save();
    
    

                return response()->json([
                    'status' => 1, 
                    'type' => 'Success',
                    'msg' => ' تم تحديث حالة الطلب بنجاح !',
                ]);
                // return redirect()->back()->with('success', 'تم انجاز الطلب وارسال اثبات الانجاز بنجاح');
                
            }else{

                return response()->json([
                    'status' => 0, 
                    'type' => 'error',
                    'order' =>  'يجب رفع ملف اثبات الانجاز',
                ]);
              
            }

    
        }else{

            return response()->json([
                'status' => 0, 
                'type' => 'error',
                'msg' => ' حدث خطأ اثناء تنفيذ طلبك !',
            ]);


        }

    }

    public function indexNew()
    {
        
        $user = request()->user();

        $notify= $user->processMo3ala->where('status','=','-1')->count();

        $process = $user->processMo3ala->whereIn('status', ["1", "-1", "0"])->whereNotIn('choosen', ['0'])->sortByDesc('id');

       // $process_count = $user->processMo3ala->whereIn('status', ["1", "-1", "0"])->whereNotIn('choosen', ['0'])->count();

        // $orders = $process->mo3amla();

        $orders =[];
        foreach( $process as $proc ){
            $order = Order_mo3amla::find($proc['mo3amla_id']);

            if(  $proc['status'] == -1 || $proc['status'] == 0){

                $status = "جديد";
               
            }elseif(  $proc['status'] == 1 && $proc['choosen'] == 1){

                $status = "معمد لديكم";
            }else{
                $status = "تم تقديم السعر";
                
            }


            if( $proc['price'] != Null){
                $price =   $proc['price']." ر.س";
            }else{
                $price =  "--";
            }

            if($proc->mo3amla){

                $service_name = $proc->mo3amla->service['name'];
            }else{

                $service_name = "--";

            }
        
            $arr = array(
                'mo3amla_id' => $proc['mo3amla_id'],
                'process_id' => $proc['id'],
                'status' =>  $status,
                'service' =>  $service_name,
                'price' => $price,
                'date' => $proc['created_at']->format('d-m-Y'),
            );

            array_push($orders, $arr);

        } //end foreach 

        return response()->json([
            'status' => 1, 
            'type' => 'Success',
            'orders' =>  $orders ,
            'notify' =>  $notify,
        ]);


      
    }

    public function indexOnGoing()
    {

        $user = request()->user();

        $notify= $user->processMo3ala->where('status','=','-1')->count();


        $process = $user->processMo3ala->where('status', "=", "2")->where('choosen', "=", "1")->sortByDesc('id');
       // $process_count = $user->processMo3ala->where('status', "=", "2")->where('choosen', "=", "1")->count();


        $orders =[];
        foreach( $process as $proc ){
            $order = Order_mo3amla::find($proc['mo3amla_id']);

            if(  $proc['status'] == -1 || $proc['status'] == 0){

                $status = "جديد";
               
            }elseif(  $proc['status'] == 1 && $proc['choosen'] == 1){

                $status = "معمد لديكم";
            }else{
                $status = "تم تقديم السعر";
                
            }

            if( $proc['price'] != Null){
                $price =   $proc['price']." ر.س";
            }else{
                $price =  "--";
            }

            
            if($proc->mo3amla->service){

                $service_name = $proc->mo3amla->service['name'];
            }else{

                $service_name = "--";

            }
        
            $arr = array(
                'mo3amla_id' => $proc['mo3amla_id'],
                'process_id' => $proc['id'],
                'status' =>  $status,
                'service' =>  $service_name,
                'price' => $price,
                'date' => $proc['created_at']->format('d-m-Y'),
            );

            array_push($orders, $arr);

        } //end foreach 
    

        return response()->json([
            'status' => 1, 
            'type' => 'Success',
            'orders' =>  $orders,
        ]);

    }


    public function answerNote(Request $r)
    {
        
        $r->validate([
            'orderNote' => ['string','required'],
            'order_id' => ['required'],
            'note_id' => ['required'],
        ]);

        $note =  Mo3amlaNote::find($r->note_id);
        $note->answer    =  $r->orderNote;
        $note->status    =  2;
        $note->save();

        return response()->json([
            'status' => 1, 
            'type' => 'Success',
            'msg' =>  'تم ارسال البيانات بنجاح !',
        ]);

    }


    public function indexFinished()
    {

    
        $user = request()->user();

        $notify= $user->processMo3ala->where('status','=','-1')->count();


        $process = $user->processMo3ala->whereIn('status',[5,4])->where('choosen', "=", "1")->sortByDesc('id');
        $process_count = $user->processMo3ala->whereIn('status',[5,4])->where('choosen', "=", "1")->count();

        $orders =[];
        foreach( $process as $proc ){
            $order = Order_mo3amla::find($proc['mo3amla_id']);

            if(  $proc['status'] == -1 || $proc['status'] == 0){

                $status = "جديد";
               
            }elseif(  $proc['status'] == 1 && $proc['choosen'] == 1){

                $status = "معمد لديكم";
            }else{
                $status = "تم تقديم السعر";
                
            }

            if( $proc['price'] != Null){
                $price =   $proc['price']." ر.س";
            }else{
                $price =  "--";
            }

            if($proc->mo3amla->service){

                $service_name = $proc->mo3amla->service['name'];
            }else{

                $service_name = "--";

            }
        
            $arr = array(
                'mo3amla_id' => $proc['mo3amla_id'],
                'process_id' => $proc['id'],
                'status' =>  $status,
                'service' =>  $service_name,
                'price' => $price,
                'date' => $proc['created_at']->format('d-m-Y'),
            );

            array_push($orders, $arr);

        } //end foreach 

        return response()->json([
            'status' => 1, 
            'type' => 'Success',
            'orders' =>  $orders,
        ]);
    }

    public function show(Request $r)
    {
     //   $user = User::find(auth()->user()->id);

        $r->validate([
            'oid' => ['required'],
        ]);

        $oid = $r->oid;
        $user = request()->user();

        $notify= $user->processMo3ala->where('status','=','-1')->count();


        $orders = $user->processMo3ala->pluck('id')->toArray();

        if( in_array($oid, $orders) ){

            $order = Mo3amlaProcessing::find($oid);

            if ($order->status == -1) {
                $order->status = 0;
                $order->save();
            }


            if( $order->mo3amla->m_have_notes == "1"){

                if($order->mo3amla->notes->count() > 0){

                
                    if($lastNote = $order->mo3amla->notes->where('vendor_id', $user->id)->where('status', '=', 0)->first()){

                        $lastNote->status = 1;
                        $lastNote->save();

                    }

                }
            }

            return response()->json([
                'status' => 1, 
                'type' => 'Success',
                'order' =>  $order,
            ]);

            // return view('engazFawry.dashboard.client_order_single', [
            //     'pagetitle' => __('client_order_single'),
            //     'order' =>  $order ,
            //     'user' =>  $user ,
            //     'notify' =>  $notify ,

                
            // ]);

        }else{

            return response()->json([
                'status' => 0, 
                'type' => 'error',
                'order' =>  'عملية غير مصرح بها',
            ]);
        
        }
    }

    

    public function submitProposal(Request $r)
    {

        $r->validate([
            'vendor_price' => ['required'],
            'vendor_days' => ['required'],
            'vendor_requirement' => ['required'],
            'process_id' => ['required'],
        ]);


       // $user = User::find(auth()->user()->id);

        $user = request()->user();

        $orders = $user->processMo3ala->pluck('id')->toArray();

         if( in_array($r->process_id, $orders) ){

            $proc = Mo3amlaProcessing::find($r->process_id);

            $proc->price = $r->vendor_price; 
            $proc->requirement = $r->vendor_requirement; 
            $proc->days = $r->vendor_days; 
            $proc->status = 1; 
            $proc->save(); 
           

            return response()->json([
                'status' => 1, 
                'type' => 'Success',
                'msg' =>  ' تم تقديم العرض بنجاح !',
            ]);
                    

        }else{
        
            return response()->json([
                'status' => 0, 
                'type' => 'error',
                'msg' =>  'عملية غير مصرح بها',
            ]);
        }



    }



}
