<?php

// namespace App\Http\Controllers;

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Setting;
use App\User;
use App\Bank;
use App\Order_mo3amla;
use App\Review;
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
       // $this->middleware('verifyPhone', ['except' => ['verify_form', 'verifyphone'] ]);
    }


    // public function review( $oid, Request $r)
    // {
    //     $user = User::find(auth()->user()->id);
    //     $orders = $user->mo3amla_orders->pluck('id')->toArray();

    //     if( in_array($oid, $orders) ){

    //         $order = Order_mo3amla::find($oid);
    //         return view('engazFawry.dashboard.order_mo3amla', [
    //             'pagetitle' => __('order_mo3amla'),
    //             'order' =>  $order,
    //             'user' =>  $user,
    //             // 'setting' =>  $setting,
    //             // 'banks' =>  $banks,
    //         ]);

    //     }else{

    //         abort(403, 'Unauthorized action.');
    //     }
    // }

    public function mo3amlaShow(Request $r)
    {

        $r->validate([
            'order_id' => ['required'],
        ]);


        $oid = $r->order_id;
        $note = 0;

      //  $setting = Setting::first();
        $user =  request()->user();
      //  $banks = Bank::get();

        $orders = $user->mo3amla_orders->pluck('id')->toArray();

        if( in_array($oid, $orders) ){

            $order = Order_mo3amla::find($oid);


            if( $order->m_have_notes == "1"){

                if($order->notes->count() > 0){


                    // if($lastNote = $order->notes->where('user_id', $user->id)->where('status', '=', 0)->last()){
                        if($lastNote = $order->notes->where('user_id', $user->id)->whereIn('status', [1,0])->last()){

                        $lastNote->status = 1;
                        $lastNote->save();

                        $note =  array(
                            'note_id' => $lastNote->id,
                            'note_content' => $lastNote->content,
                            'note_need_upload_files' => $lastNote->need_files,
                            'note_need_add_text' => $lastNote->need_text,
                        );
                    }
                }else{
                    $note = 0;
                }
            }else{
                $note = 0;
            }

            return response()->json([
                'status' => 1,
                'msg' => 'success',
                'order' =>  $order ,
                'notes' => $note,
            //    'banks' =>  $banks,
            //    'setting' =>  $setting,
            ]);



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





    public function mo3amla_payment_callback(Request $r){


        $r->validate([
            'oid' => ['required'],
        ]);

        $oid = $r->oid;

        $order = Order_mo3amla::find($oid);
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





    public function approveOrRejectPrice(Request $r)
    {

        $r->validate([
            'order_id' => ['required'],
            'status' => ['required'], // -2 reject / 1 approve
        ]);


        $oid = $r->order_id;
        $user =  request()->user();

        $orders = $user->mo3amla_orders->pluck('id')->toArray();


        // security check if this order belong to this user
        if( in_array($oid, $orders) ){

            $order = Order_mo3amla::find($oid);
            $order->status = $r->status;
            $order->save();


            return response()->json([
                'status' => 1,
                'type' => 'success',
                'msg' =>  ' تم تحديث حالة الطلب بنجاح !',
                'order' => $order,
            ]);


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


    public function SelectPayment(Request $r)
    {
        $r->validate([
            'order_id' => ['required'],
            'addPayment' => ['required'],
            'payment_method' => ['string','required'],
        ]);

        $user = request()->user();
        $orders = $user->mo3amla_orders->pluck('id')->toArray();


        if( in_array($r->order_id, $orders) ){

            $order = Order_mo3amla::find($r->order_id);

            // bank add payment
            if(isset($r->addPayment) && $r->addPayment == 1){


                $order->payment_method = $r->payment_method;

                if($order->payment_method != null ){

                    if( $r->payment_method == "transfer"){

                        $r->validate([
                            'bank_id' => ['required'],
                        ]);

                        $order->bank_id = $r->bank_id;
                    }
                    $order->save();
                }

                return response()->json(
                    [
                        'status' => 1,
                        'type' => 'success',
                        'response' =>   'تم اختيار طريقة الدفع بنجاح',
                        'order' => $order,
                    ]
                );
            }
        }else{

            return response()->json(
                [
                    'status' => 0,
                    'type' => 'error',
                    'response' =>   'عملية غير مصرح بها',
                ]
            );
        }



    }




    public function AddNewFilesAndAnswerNote(Request $r)
    {
         $r->validate([
            'order_id' => ['required'],
        ]);

        // if mo3amla required new files
        $user = request()->user();
        $orders = $user->mo3amla_orders->pluck('id')->toArray();

        if( in_array($r->order_id, $orders) ){

            $order = Order_mo3amla::find($r->order_id);



        // if mo3amla required Notes
        if(isset($r->addNote) ){

            $r->validate([
                'orderNote' => ['required'],
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
              //  'newFiles'   => ['max:5'],
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
                return response()->json(
                    [
                        'status' => 0,
                        'type' => 'error',
                        'msg' =>  'لم يتم ارفاق ملفات  N01',
                    ]
                );
            }
        }
    }

            $order->m_have_notes = "0";
            $order->status = "-5";

            $order->save();


            return response()->json(
                [
                    'status' => 1,
                    'type' => 'success',
                    'response' =>  'تم ارسال البيانات بنجاح',
                    'order' => $order,
                ]
            );

        }else{
            return response()->json(
                [
                    'status' => 0,
                    'type' => 'error',
                    'msg' =>  'عملية غير مصرح بها N02',
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
        $orders = $user->mo3amla_orders->pluck('id')->toArray();

        if( in_array($id, $orders) ){

            $order = Order_mo3amla::find($id);

            $setting = Setting::first();
            $mobile = $setting->phone;

            $tPrice = (int)$order->m_enjazPrice + (int)$order->m_processThirdPartyPrice;


           // $pdf = PDF::loadView('engazFawry.dashboard.printInvoice', array('order' => $order, 'tPrice' => $tPrice, 'mobile' => $mobile), []);


            $view = view('engazFawry.dashboard.printInvoice_estfsar', compact('order', 'mobile', 'tPrice'));

            //return $pdf->stream('document.pdf');

            return response()->json(
                [
                    'status' => 1,
                    'type' => 'success',
                    'response' =>   $view->render(),
                ]
            );

        } else {
            // abort(403, 'Unauthorized action.');

            return response()->json(
                [
                    'status' => 0,
                    'type' => 'error',
                    'msg' =>  'عملية غير مصرح بها',
                ]
            );
        }
    }

    public function mo3amlaProve(Request $r)
    {

        $r->validate([
            'proveFile' => ['required','mimes:jpeg,png,jpg,pdf'],
            'order_id' => ['required'],
        ]);

        $user = request()->user();

        $orders = $user->mo3amla_orders->pluck('id')->toArray();

        if( in_array($r->order_id, $orders)){

            if( $r->hasFile('proveFile')){

                $order = Order_mo3amla::find($r->order_id);

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




    public function confirm_online_payment(Request $r){


        $r->validate([
            'oid' => ['required'],
            'id' => ['required'],
            'status' => ['required'],
            'message' => ['required'],
        ]);

        $oid = $r->oid;

        $order = Order_mo3amla::find($oid);
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


    public function ReviewMo3amla(Request $r)
    {
        $r->validate([
            'order_id' => ['required', 'regex:/[+0-9]/','min:1'],
            'order_no' => ['required'],
        ]);

        $oid = $r->order_id;

        $user = request()->user();
        $orders = $user->mo3amla_orders->pluck('id')->toArray();

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
            $review->type = 'M';

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
                'stars' => $r->stars,
                'description' => $r->description,
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

                return response()->json(
                    [
                        'status' => 1,
                        'type' => 'success',
                        'msg' =>  ' تم تقييم الطلب بنجاح .',
                    ]
                );

            }else{

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
        }

    }










}
