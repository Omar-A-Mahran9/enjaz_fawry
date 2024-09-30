<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Bank;

use App\Order_mo3amla;
use App\User;
use App\Mo3amlaProcessing;
use App\Mo3amlaNote;


use Auth;

class ClientOrderController extends Controller
{

    public function __construct()
    {
      //  $this->middleware('auth:web');

        $this->middleware('verifyPhone', ['except' => ['verify_form', 'verifyphone'] ]);
    }

    
    public function vendorUpdateStatus(Request $r, $oid)
    {

        $r->validate([
            'orderId' => ['required'],
            'vendorId' => ['required'],
            'newStatus' => ['required', 'in:2,4,-4'],
            'process_id' => ['required'],
        ]);


        if($r->orderId ==  $oid){


            $order = Order_mo3amla::find($oid);

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



    public function vendorUpdateEnjazProve(Request $r, $oid)
    {

        $r->validate([
            'orderId' => ['required'],
            'vendorId' => ['required'],
            'newStatus' => ['required', 'in:2,4,-4'],
            'process_id' => ['required'],
            'enjaz_prove' => ['required','mimes:jpeg,JPEG,png,PNG,jpg,JPG,pdf,PDF'],
            
        ]);


        if($r->orderId ==  $oid){


            // $order = Order_mo3amla::find($oid);

          //  dd($r);


            if( $r->hasFile('enjaz_prove')){

                //file upload and check
                $fileExt            = $r->enjaz_prove->getClientOriginalExtension();
                $fileIdNameNew        = uniqid() . time() . '.' . $fileExt;
                $r->enjaz_prove->storeAs('public/enjaz_prove', $fileIdNameNew);
    
                $order = Order_mo3amla::find($r->orderId);
                $order->enjaz_prove = $fileIdNameNew;
                $order->status = $r->newStatus;

    
                $order->save();
    
        
                $notification = array(
                    'message' => ' تم تحديث حالة الطلب بنجاح !',
                    'alert-type' => 'success'
                );
                // return redirect()->back()->with('success', 'تم انجاز الطلب وارسال اثبات الانجاز بنجاح');
                
            }else{


                $notification = array(
                    'message' => ' حدث خطأ اثناء تنفيذ طلبك !',
                    'alert-type' => 'error'
                );
            }

        

            return redirect()->back()->with($notification);

        }else{

            $notification = array(
                'message' => ' حدث خطأ اثناء تنفيذ طلبك !',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        }

    }

    public function indexNew()
    {

        $user = User::find(auth()->user()->id);

        $notify= $user->processMo3ala->where('status','=','-1')->count();

        $process = $user->processMo3ala->whereIn('status', ["1", "-1", "0"])->whereNotIn('choosen', ['0'])->sortByDesc('id');

        $process_count = $user->processMo3ala->whereIn('status', ["1", "-1", "0"])->whereNotIn('choosen', ['0'])->count();

        return view('engazFawry.dashboard.client_orders_new', [
            'pagetitle' => __('client_orders_new'),
            'process' =>  $process,
            'process_count' =>  $process_count ,
            'user' =>  $user,
            'notify' =>  $notify,
        ]);
    }

    public function indexOnGoing()
    {

        $user = User::find(auth()->user()->id);

        $notify= $user->processMo3ala->where('status','=','-1')->count();


        $process = $user->processMo3ala->where('status', "=", "2")->where('choosen', "=", "1")->sortByDesc('id');
        $process_count = $user->processMo3ala->where('status', "=", "2")->where('choosen', "=", "1")->count();

        return view('engazFawry.dashboard.client_orders_onGoing', [
            'pagetitle' => __('order_estfsar'),
            'process' =>  $process,
            'process_count' =>  $process_count ,
            'user' =>  $user,
            'notify' =>  $notify,
        ]);
    }


    public function answerNote(Request $r)
    {
        
        $r->validate([
            'orderNote' => ['string','required'],
            'order_id' => ['required'],
            'addNote' => ['required'],
            
            'user_id' => ['required'],
        ]);

        $note =  Mo3amlaNote::find($r->addNote);
        $note->answer    =  $r->orderNote;
        $note->status    =  2;
        $note->save();


        $notification = array(
            'message' => 'لقد تم ارسال البيانات بنجاح !',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);



    }
    public function indexFinished()
    {

        $user = User::find(auth()->user()->id);

        $notify= $user->processMo3ala->where('status','=','-1')->count();


        $process = $user->processMo3ala->whereIn('status',[5,4])->where('choosen', "=", "1")->sortByDesc('id');
        $process_count = $user->processMo3ala->whereIn('status',[5,4])->where('choosen', "=", "1")->count();

        return view('engazFawry.dashboard.client_orders_finished', [
            'pagetitle' => __('order_estfsar'),
            'process' =>  $process,
            'process_count' =>  $process_count ,
            'user' =>  $user,
            'notify' =>  $notify,
        ]);
    }

    public function show( $oid)
    {
        $user = User::find(auth()->user()->id);

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

            return view('engazFawry.dashboard.client_order_single', [
                'pagetitle' => __('client_order_single'),
                'order' =>  $order ,
                'user' =>  $user ,
                'notify' =>  $notify ,

                
            ]);

        }else{
        
            abort(403, 'Unauthorized action.');
        }
    }

    

    public function submitProposal(Request $r)
    {

        //dd($r);
        $r->validate([
            'vendor_price' => ['required'],
            'vendor_days' => ['required'],
            'vendor_requirement' => ['required'],
            'user_id' => ['required'],
            'process_id' => ['required'],
        ]);


        $user = User::find(auth()->user()->id);

        $orders = $user->processMo3ala->pluck('id')->toArray();

         if( in_array($r->process_id, $orders) ){

            $proc = Mo3amlaProcessing::find($r->process_id);

            $proc->price = $r->vendor_price; 
            $proc->requirement = $r->vendor_requirement; 
            $proc->days = $r->vendor_days; 
            $proc->status = 1; 
            $proc->save(); 
           
            $notification = array(
                'message' => ' تم تقديم العرض بنجاح !',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
            
           
           
           
            

        }else{
        
            abort(403, 'Unauthorized action.');
        }



    }

    // public function estfsarProve(Request $r)
    // {
    
    //     $r->validate([
    //         'proveFile' => ['required','mimes:jpeg,png,jpg,pdf'],
    //         'order_id' => ['required'],
    //         'user_id' => ['required'],
    //     ]);

    //     $user = User::find(auth()->user()->id);

    //     $orders = $user->estfsar_orders->pluck('id')->toArray();

    //     if( in_array($r->order_id, $orders)  && $user->id == $r->user_id){
        
    //         if( $r->hasFile('proveFile')){

    //             //file upload and check
    //             $fileExt            = $r->proveFile->getClientOriginalExtension();
    //             $fileIdNameNew        = uniqid() . time() . '.' . $fileExt;
    //             $r->proveFile->storeAs('public/payment_proves', $fileIdNameNew);

    //             $order = Order_estfsar::find($r->order_id);
    //             $order->transfer_prove = $fileIdNameNew;
    //             $order->prove_status = 0;

    //             $order->save();

    //             $notification = array(
    //                 'message' => 'لقد تم تعديل حالة الدفع بنجاح !',
    //                 'alert-type' => 'success'
    //             );

    //             return redirect()->back()->with($notification);
                
    //         } else {
    //             abort(403, 'Unauthorized action.');
    //         }

    //     }else{
    //         abort(403, 'Unauthorized action.');
    //     }
    // }




}
