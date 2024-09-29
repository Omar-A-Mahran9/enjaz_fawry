<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Setting;
use App\User;
// use App\Bank;
use App\Order_estfsar;
// use App\SentSms;
// use App\Terms;
use App\Review;

// use PDF;
use Auth;
use Mail;
use Moyasar;

class OrderEstfsarController extends Controller
{

    public function __construct()
    {
        //$this->middleware('verifyPhone', ['except' => ['verify_form', 'verifyphone'] ]);
    }



    public function estfsarShow(Request $r)
    {

        $r->validate([
            'order_id' => ['required'],
        ]);
        // $user = User::find(auth()->user()->id);

        $user = request()->user();
        $oid = $r->order_id;

        $orders = $user->estfsar_orders->pluck('id')->toArray();

        if( in_array($oid, $orders) ){

            $order = Order_estfsar::find($oid);

        // check moyasar payment response 
        $response = [];
        
        if($r->id  !== null  && $r->status !== null   && $r->message !== null ){
            $secret_api_key = getPaymentKeys('secret_api_key');

            Moyasar\Client::setApiKey( $secret_api_key );
            // Moyasar\Client::setApiKey("sk_test_KRfg7JNU7AQ7g6pkM8hrZFJNTURSs8qpYtiq74TZ");
            $retrieve = Moyasar\Payment::fetch($r->id);
        
            // dump($retrieve);
            $error = 0;
            if($retrieve->status == "paid" && ( $retrieve->source->message == "Succeeded!" || $retrieve->source->message == "APPROVED") ){

                // payment Done success
    
                $visaDetails = array('type'=> $retrieve->source->type , 'name' => $retrieve->source->name ,'company'=> $retrieve->source->company, 'number'=> $retrieve->source->number);
                $readyvisaDetails =  serialize($visaDetails);

                $amount = $retrieve->amount/100;
                // update prove_status & transfer_prove
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
         
            
            return response()->json([
                'status' => 1,
                'msg' => 'success',
                'order' =>  $order ,
                'response' =>  $response,
            ]);

        }else{
          
            return response()->json(
                [
                    'status' => 1,
                    'msg' => 'success',
                    'order' =>  $order ,
                ]
            );
        }

        }else{

            return response()->json(
                [
                    'status' => 0,
                    'type' => 'error',
                    'msg' =>  'عملية غير مصرح بها',
                ]
            );
        
          
        }
    }




    public function estfsar_payment_callback(Request $r){


        $r->validate([
            'oid' => ['required'],
        ]);

        $oid = $r->oid;

        $order = Order_estfsar::find($oid);
         // check moyasar payment response 
         $response = [];
        
         if($r->id  !== null  && $r->status !== null   && $r->message !== null ){
 
            $secret_api_key = getPaymentKeys('secret_api_key');
            Moyasar\Client::setApiKey( $secret_api_key );
             //Moyasar\Client::setApiKey("sk_live_FN3R8HqqV5GTXpLcA4jDRHhLj2qmRwt1Laor12UA");
             // Moyasar\Client::setApiKey("sk_test_KRfg7JNU7AQ7g6pkM8hrZFJNTURSs8qpYtiq74TZ");
             $retrieve = Moyasar\Payment::fetch($r->id);
         
             $error = 0;
             if($retrieve->status == "paid" && ( $retrieve->source->message == "Succeeded!" || $retrieve->source->message == "APPROVED") ){
 
                 // payment Done success
     
                 $visaDetails = array('type'=> $retrieve->source->type , 'name' => $retrieve->source->name ,'company'=> $retrieve->source->company, 'number'=> $retrieve->source->number);
                 $readyvisaDetails =  serialize($visaDetails);
 
                 $amount = $retrieve->amount/100;
                 // update prove_status & transfer_prove
                 //$response = ['success' => 'تم سداد مبلغ '.$amount.' ريال بنجاح'];

                 $response = [
                    'status' => 1,
                    'type' => 'success',
                    'msg' => 'تم سداد مبلغ '.$amount.' ريال بنجاح'];
 
                 $order->transfer_prove = $retrieve->id;
                 $order->prove_status =  1;
                 $order->status =  1;
                 $order->visa_data =  $readyvisaDetails;
                 $order->save();
 
                 
             }elseif($retrieve->status == "failed"){
 
                 //   payment failed;
 
                 if($retrieve->source->message == "Unable to process the purchase transaction"){
 
                    $error = "عفوا ... لايمكن معالجة عملية الشراء";

                    $response = [
                        'status' => 0,
                        'type' => 'error',
                        'msg' =>   $error ];
                     
                 }elseif($retrieve->source->message == "3-D Secure transaction attempt failed (Not Enrolled)"){
 
                     $error = "فشلت محاولة المعاملة الآمنة ثلاثية الأبعاد (غير مسجل)";

                     $response = [
                        'status' => 0,
                        'type' => 'error',
                        'msg' =>   $error ];
 
                 }elseif($retrieve->source->message == "Insufficient Funds"){
 
                     $error = "لا يوجد رصيد كافي لاتمام العملية";
                     $response = [
                        'status' => 0,
                        'type' => 'error',
                        'msg' =>   $error ];
 
                 }elseif($retrieve->source->message == "Declined"){
 
                     $error = "العملية مرفوضة ... يرجى مراجعة البنك المصدر للبطاقة";
                     $response = [
                        'status' => 0,
                        'type' => 'error',
                        'msg' =>   $error ];
 
                 }elseif($retrieve->source->message == "Invalid Card. Unable to store the card"){
 
                     $error = "بطاقة غير صالحة. غير قادر على تخزين البطاقة";
                     $response = [
                        'status' => 0,
                        'type' => 'error',
                        'msg' =>   $error ];
 
                 }elseif($retrieve->source->message == "Invalid Card. Unable to store the card"){
 
                     $error = "بطاقة غير صالحة. غير قادر على تخزين البطاقة";
                     $response = [
                        'status' => 0,
                        'type' => 'error',
                        'msg' =>   $error ];
 
                 }elseif($retrieve->source->message == "Unable to process the purchase transaction"){
 
                     $error = "غير قادر على معالجة عملية الشراء";
                     $response = [
                        'status' => 0,
                        'type' => 'error',
                        'msg' =>   $error ];
 
                 }else{
 
                     $error = "خطأ غير معروف ... يرجى مراجعة البنك المصدر للبطاقة";
                     $response = [
                        'status' => 0,
                        'type' => 'error',
                        'msg' =>   $error ];
                 }
 
                  
 
             }elseif($retrieve->status == "expired"){
 
                 $error = "خطأ غير معروف ... expired";
                 $response = [
                    'status' => 0,
                    'type' => 'error',
                    'msg' =>   $error ];
 
             }elseif($retrieve->status == "canceled"){
 
                 $error = "خطأ غير معروف ... canceled";
                 $response = [
                    'status' => 0,
                    'type' => 'error',
                    'msg' =>   $error ];
                
             }
 
 
             
         }elseif($r->error !== null  ){

            $response = [
                'status' => 0,
                'type' => 'error',
                'msg' =>   'unknown error 1003' ];
         }

        return response()->json([$response]);


    }


    public function confirm_online_payment(Request $r){


        $r->validate([
            'oid' => ['required'],
            'id' => ['required'],
            'status' => ['required'],
            'message' => ['required'],
        ]);

        $oid = $r->oid;

        $order = Order_estfsar::find($oid);
         // check moyasar payment response 
         $response = [];
        
         if($r->id  !== null  && $r->status !== null){
 
            $secret_api_key = getPaymentKeys('secret_api_key');
            Moyasar\Client::setApiKey( $secret_api_key );
             //Moyasar\Client::setApiKey("sk_live_FN3R8HqqV5GTXpLcA4jDRHhLj2qmRwt1Laor12UA");
             // Moyasar\Client::setApiKey("sk_test_KRfg7JNU7AQ7g6pkM8hrZFJNTURSs8qpYtiq74TZ");
             $retrieve = Moyasar\Payment::fetch($r->id);
         
             $error = 0;
             if($retrieve->status == "paid" && ( $retrieve->source->message == "Succeeded!" || $retrieve->source->message == "APPROVED") ){
 
                 // payment Done success
     
                 $visaDetails = array('type'=> $retrieve->source->type , 'name' => $retrieve->source->name ,'company'=> $retrieve->source->company, 'number'=> $retrieve->source->number);
                 $readyvisaDetails =  serialize($visaDetails);
 
                 $amount = $retrieve->amount/100;
                 // update prove_status & transfer_prove
                 //$response = ['success' => 'تم سداد مبلغ '.$amount.' ريال بنجاح'];

                 $response = [
                    'status' => 1,
                    'type' => 'success',
                    'msg' => 'تم سداد مبلغ '.$amount.' ريال بنجاح'];
 
                 $order->transfer_prove = $retrieve->id;
                 $order->prove_status =  1;
                 $order->status =  1;
                 $order->visa_data =  $readyvisaDetails;
                 $order->save();
 
                 
             }elseif($retrieve->status == "failed"){
 
                 //   payment failed;
 
                 if($retrieve->source->message == "Unable to process the purchase transaction"){
 
                    $error = "عفوا ... لايمكن معالجة عملية الشراء";

                    $response = [
                        'status' => 0,
                        'type' => 'error',
                        'msg' =>   $error ];
                     
                 }elseif($retrieve->source->message == "3-D Secure transaction attempt failed (Not Enrolled)"){
 
                     $error = "فشلت محاولة المعاملة الآمنة ثلاثية الأبعاد (غير مسجل)";

                     $response = [
                        'status' => 0,
                        'type' => 'error',
                        'msg' =>   $error ];
 
                 }elseif($retrieve->source->message == "Insufficient Funds"){
 
                     $error = "لا يوجد رصيد كافي لاتمام العملية";
                     $response = [
                        'status' => 0,
                        'type' => 'error',
                        'msg' =>   $error ];
 
                 }elseif($retrieve->source->message == "Declined"){
 
                     $error = "العملية مرفوضة ... يرجى مراجعة البنك المصدر للبطاقة";
                     $response = [
                        'status' => 0,
                        'type' => 'error',
                        'msg' =>   $error ];
 
                 }elseif($retrieve->source->message == "Invalid Card. Unable to store the card"){
 
                     $error = "بطاقة غير صالحة. غير قادر على تخزين البطاقة";
                     $response = [
                        'status' => 0,
                        'type' => 'error',
                        'msg' =>   $error ];
 
                 }elseif($retrieve->source->message == "Invalid Card. Unable to store the card"){
 
                     $error = "بطاقة غير صالحة. غير قادر على تخزين البطاقة";
                     $response = [
                        'status' => 0,
                        'type' => 'error',
                        'msg' =>   $error ];
 
                 }elseif($retrieve->source->message == "Unable to process the purchase transaction"){
 
                     $error = "غير قادر على معالجة عملية الشراء";
                     $response = [
                        'status' => 0,
                        'type' => 'error',
                        'msg' =>   $error ];
 
                 }else{
 
                     $error = "خطأ غير معروف ... يرجى مراجعة البنك المصدر للبطاقة";
                     $response = [
                        'status' => 0,
                        'type' => 'error',
                        'msg' =>   $error ];
                 }
 
                  
 
             }elseif($retrieve->status == "expired"){
 
                 $error = "خطأ غير معروف ... expired";
                 $response = [
                    'status' => 0,
                    'type' => 'error',
                    'msg' =>   $error ];
 
             }elseif($retrieve->status == "canceled"){
 
                 $error = "خطأ غير معروف ... canceled";
                 $response = [
                    'status' => 0,
                    'type' => 'error',
                    'msg' =>   $error ];
                
             }elseif($retrieve->status == "initiated"){
 
                $error = "خطأ غير معروف ... initiated";
                $response = [
                   'status' => 0,
                   'type' => 'error',
                   'msg' =>   $error ];
               
            }else{

                $response = [
                    'status' => 0,
                    'type' => 'error',
                    'msg' =>   'unknown error 1002' ];
    
             }
 
 
             
         }elseif($r->error !== null  ){

            $response = [
                'status' => 0,
                'type' => 'error',
                'msg' =>   'unknown error 1003' ];
         }else{

            $response = [
                'status' => 0,
                'type' => 'error',
                'msg' =>   'unknown error 1004' ];

         }

        return response()->json([$response]);


    }

    public function estfsarProve(Request $r)
    {
    
        $r->validate([
            'proveFile' => ['required','mimes:jpeg,png,jpg,pdf'],
            'order_id' => ['required'],
        ]);

        $user = request()->user();
       // $user = User::find(auth()->user()->id);

        $orders = $user->estfsar_orders->pluck('id')->toArray();

        if( in_array($r->order_id, $orders)){



        
            if( $r->hasFile('proveFile')){


                $order = Order_estfsar::find($r->order_id);


                if($order->payment_method !== 'transfer'){

                    return response()->json(
                        [
                            'status' => 0,
                            'type' => 'error',
                            'msg' =>  'لا يمكن رفع اثبات الدفع حيث ان طريقة الدفع اونلاين',
                        ]
                    );

                }

                //file upload and check
                $fileExt            = $r->proveFile->getClientOriginalExtension();
                $fileIdNameNew        = uniqid() . time() . '.' . $fileExt;
                $r->proveFile->storeAs('public/payment_proves', $fileIdNameNew);

                
                $order->transfer_prove = $fileIdNameNew;
                $order->prove_status = 0;

                $order->save();
                
                return response()->json(
                    [
                        'status' => 1,
                        'type' => 'success',
                        'msg' =>  'لقد تم تعديل حالة الدفع بنجاح !',
                    ]
                );
                
            } else {

                return response()->json(
                    [
                        'status' => 0,
                        'type' => 'error',
                        'msg' =>  'عملية غير مصرح بها',
                    ]
                );
            }

        }else{

            return response()->json(
                [
                    'status' => 0,
                    'type' => 'error',
                    'msg' =>  'عملية غير مصرح بها',
                ]
            );
        }
    }



    public function printInvoice(Request $r)
    {
        $r->validate([
            'order_id' => ['required'],
        ]);

        $user = request()->user();

        $id = $r->order_id;

        $orders = $user->estfsar_orders->pluck('id')->toArray();

        if( in_array($id, $orders) ){

            $order = Order_estfsar::find($id);
            
            $setting = Setting::first();
            $mobile = $setting->phone;

            $view = view('engazFawry.dashboard.printInvoice_estfsar', compact('order', 'mobile'));

           

            return response()->json(
                [
                    'status' => 1,
                    'type' => 'success',
                    'response' =>   $view->render(),
                ]
            );
            // $pdf = PDF::loadView('engazFawry.dashboard.printInvoice_estfsar', array('order' => $order, 'mobile' => $mobile), []);
            // return $pdf->stream('document.pdf');
        } else {
            return response()->json(
                [
                    'status' => 0,
                    'type' => 'error',
                    'msg' =>  'عملية غير مصرح بها',
                ]
            );
        }

    }


    public function ReviewEstfsar(Request $r)
    {
        $r->validate([
            'order_id' => ['required', 'regex:/[+0-9]/','min:1'],
            'order_no' => ['required'],
        ]);

        $oid = $r->order_id;

        $user = request()->user();
        $orders = $user->estfsar_orders->pluck('id')->toArray();

    if( $oid == $r->order_id ){
        if( in_array($oid, $orders) ){

            $r->validate([
                'stars' => ['required'],
                'description' => ['required'],
            ]); 

            $review = new Review;
          
            $review->order_no = $r->order_no;
            $review->client_id = $user->id;
            $review->stars = $r->stars;
            $review->description = $r->description;
            $review->type = 'E';

            $review->save();

            $order = Order_estfsar::find($r->order_id); 
            $order->closed = "1";
            $order->reviewed = "1";
            $order->save();

            $data = array(
                'stars' => $r->stars,
                'description' => $r->description,
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
            
            // $notification = array(
            //     'message' => ' تم تقييم الطلب بنجاح .',
            //     'alert-type' => 'success'
            // );

           // return redirect()->back()->with($notification);

            return response()->json(
                [
                    'status' => 1,
                    'type' => 'success',
                    'msg' =>  ' تم تقييم الطلب بنجاح .',
                ]
            );
            
        }else{
    
            //abort(403, 'Unauthorized action.');
            return response()->json(
                [
                    'status' => 0,
                    'type' => 'error',
                    'msg' =>  'عملية غير مصرح بها .. Unauthorized action ',
                ]
            );
        }

    }else{
    
        return response()->json(
            [
                'status' => 0,
                'type' => 'error',
                'msg' =>  'عملية غير مصرح بها id not equal ',
            ]
        );
     //   abort(403, 'Unauthorized action ... id not equal');
    }
      
    }

}