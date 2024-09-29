<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\User;
use App\Order_mo3amla;
use App\Order_estfsar;
use App\Order_ta3med;
use App\Review;
use App\Order_guarante;

use Auth;
use Mail;



class ReviewsController extends Controller
{

    public function __construct()
    {

        $this->middleware('verifyPhone', ['except' => ['verify_form', 'verifyphone'] ]);
    }



    public function storeMo3amla(Request $r, $oid)
    {
        $r->validate([
            'user_id' => ['required', 'regex:/[+0-9]/','min:1'],
            'order_id' => ['required', 'regex:/[+0-9]/','min:1'],
            'order_no' => ['required'],
        ]);

        $user = User::find(auth()->user()->id);
        $orders = $user->mo3amla_orders->pluck('id')->toArray();

    if( $oid == $r->order_id ){
        if( in_array($oid, $orders) ){

            $r->validate([
                'user_id' => ['required'],
                'order_no' => ['required'],
                'raty' => ['required'],
                'ratecontent' => ['required'],
            ]); 

            $review = new Review;
          
            $review->order_no = $r->order_no;
            $review->client_id = $r->user_id;
            $review->stars = $r->raty;
            $review->description = $r->ratecontent;
            $review->type = 'm';

            $order = Order_mo3amla::find($r->order_id); 

            if($order->m_processType !== 1){

                $process = $order->processMo3ala->where('choosen', '=', 1)->first();

                if($process){

                    $review->vendor_id = $process->user_id;
                }

            }


            $review->save();
            
            $order->closed = "1";
            $order->reviewed = "1";
            $order->save();



            $data = array(
                'stars' => $r->raty,
                'description' => $r->ratecontent,
                'type' => 'معاملة',
                'order_no' => $r->order_no,
                );
    
    
            $setting = Setting::first();
    
            Mail::send('customEmail.review', $data, function($message) use ($data,$setting){
                $message->from('no-reply@enjaz-fawry.com');
                $message->to($setting->email);
                $message->cc($setting->secmail);
                $message->subject('انجاز فوري : تقييم جديد للمعاملة رقم - '.$data['order_no']);
            });

            $notification = array(
                'message' => ' تم تقييم الطلب بنجاح .',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

            }else{
        
                abort(403, 'Unauthorized action.');
            }

        }else{
        
            abort(403, 'Unauthorized action ... id not equal');
        }
      
    }



    public function storeGuarante(Request $r, $oid)
    {
         $r->validate([
            'user_id' => ['required', 'regex:/[+0-9]/','min:1'],
            'order_id' => ['required', 'regex:/[+0-9]/','min:1'],
            'order_no' => ['required'],
        ]);
        $user = User::find(auth()->user()->id);
        $orders = $user->guarante_orders->pluck('id')->toArray();

    if( $oid == $r->order_id ){
        if( in_array($oid, $orders) ){

            $r->validate([
                'user_id' => ['required'],
                'order_id' => ['required'],
                'raty' => ['required'],
                'ratecontent' => ['required'],
            ]); 

            $review = new Review;
          
            $review->order_no = $r->order_no;
            $review->client_id = $r->user_id;
            $review->stars = $r->raty;
            $review->description = $r->ratecontent;
            $review->type = 'g';

            $review->save();

            $order = Order_guarante::find($r->order_id); 
            $order->closed = "1";
            $order->reviewed = "1";
            $order->save();



            $data = array(
                'stars' => $r->raty,
                'description' => $r->ratecontent,
                'type' => 'ضمان سلعة',
                'order_no' => $r->order_no,
                );
    
    
            $setting = Setting::first();
    
            Mail::send('customEmail.review', $data, function($message) use ($data,$setting){
                $message->from('no-reply@enjaz-fawry.com');
                $message->to($setting->email);
                $message->cc($setting->secmail);
                $message->subject('انجاز فوري : تقييم جديد للطلب رقم - '.$data['order_no']);
            });

            $notification = array(
                'message' => ' تم تقييم الطلب بنجاح .',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
           
            }else{
        
                abort(403, 'Unauthorized action.');
            }

        }else{
        
            abort(403, 'Unauthorized action ... id not equal');
        }
      
    }




    public function storeTa3med(Request $r, $oid)
    {
         $r->validate([
            'user_id' => ['required', 'regex:/[+0-9]/','min:1'],
            'order_id' => ['required', 'regex:/[+0-9]/','min:1'],
            'order_no' => ['required'],
        ]);
        $user = User::find(auth()->user()->id);
        $orders = $user->ta3med_orders->pluck('id')->toArray();

    if( $oid == $r->order_id ){
        if( in_array($oid, $orders) ){

            $r->validate([
                'user_id' => ['required'],
                'order_id' => ['required'],
                'raty' => ['required'],
                'ratecontent' => ['required'],
            ]); 

            $review = new Review;
          
            $review->order_no = $r->order_no;
            $review->client_id = $r->user_id;
            $review->stars = $r->raty;
            $review->description = $r->ratecontent;
            $review->type = 't';

            $review->save();

            $order = Order_ta3med::find($r->order_id); 
            $order->closed = "1";
            $order->reviewed = "1";
            $order->save();



            $data = array(
                'stars' => $r->raty,
                'description' => $r->ratecontent,
                'type' => 'تعميد',
                'order_no' => $r->order_no,
                );
    
    
            $setting = Setting::first();
    
            Mail::send('customEmail.review', $data, function($message) use ($data,$setting){
                $message->from('no-reply@enjaz-fawry.com');
                $message->to($setting->email);
                $message->cc($setting->secmail);
                $message->subject('انجاز فوري : تقييم جديد للطلب رقم - '.$data['order_no']);
            });

            $notification = array(
                'message' => ' تم تقييم الطلب بنجاح .',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
           
            }else{
        
                abort(403, 'Unauthorized action.');
            }

        }else{
        
            abort(403, 'Unauthorized action ... id not equal');
        }
      
    }


    public function storeEstfsar(Request $r, $oid)
    {
          $r->validate([
            'user_id' => ['required', 'regex:/[+0-9]/','min:1'],
            'order_id' => ['required', 'regex:/[+0-9]/','min:1'],
            'order_no' => ['required'],
        ]);

        $user = User::find(auth()->user()->id);
        $orders = $user->estfsar_orders->pluck('id')->toArray();

    if( $oid == $r->order_id ){
        if( in_array($oid, $orders) ){

            $r->validate([
                'user_id' => ['required'],
                'order_id' => ['required'],
                'raty' => ['required'],
                'ratecontent' => ['required'],
            ]); 

            $review = new Review;
          
            $review->order_no = $r->order_no;
            $review->client_id = $r->user_id;
            $review->stars = $r->raty;
            $review->description = $r->ratecontent;
            $review->type = 'E';

            $review->save();

            $order = Order_estfsar::find($r->order_id); 
            $order->closed = "1";
            $order->reviewed = "1";
            $order->save();

            $data = array(
                'stars' => $r->raty,
                'description' => $r->ratecontent,
                'type' => 'تعميد',
                'order_no' => $r->order_no,
                );
    
    
            $setting = Setting::first();
    
            Mail::send('customEmail.review', $data, function($message) use ($data,$setting){
                $message->from('no-replay@enjaz-fawry.com');
                $message->to($setting->email);
                $message->cc($setting->secmail);
                $message->subject('انجاز فوري : تقييم جديد للطلب رقم - '.$data['order_no']);
            });
            
            $notification = array(
                'message' => ' تم تقييم الطلب بنجاح .',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }else{
    
            abort(403, 'Unauthorized action.');
        }

    }else{
    
        abort(403, 'Unauthorized action ... id not equal');
    }
      
    }
    
}