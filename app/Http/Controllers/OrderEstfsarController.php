<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\User;
use App\Bank;
use App\Order_estfsar;
use App\SentSms;
use App\Terms;

use PDF;
use Auth;
use Mail;
use Moyasar;

class OrderEstfsarController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyPhone', ['except' => ['verify_form', 'verifyphone'] ]);
    }

    
    public function estfsar()
    {
        $user = Auth::user();
        $setting = Setting::get()->first();
        $banks = Bank::all();
        $terms = Terms::get()->first();
        return view('engazFawry.form3', [
            'pagetitle' => __('engazFawry.form3'),
            'banks'=> $banks,
            'setting'=> $setting,
            'user'=> $user,
            'terms'=> $terms,
        ]);
    }

    public function estfsar_send(Request $r)
    {
        $r->validate([
            'user_id' => ['required', 'regex:/[+0-9]/','min:1'],
            'name'    => ['string','required'],
            'phone'   => ['required', 'digits:10','min:10','max:10', 'regex:/^[0-9]+$/'],
            'type'    => ['string','required'],
            'service' => ['string','required'],
            'price' => ['required'],
            'payment_method' => ['string','required'],
        ]); 

        $setting = Setting::get()->first();


        $order = new Order_estfsar;
        $order->user_id = $r->user_id;
        $order->name = $r->name;
        $order->phone = $r->phone;
        $order->type = $r->type;
        $order->price = $setting->estfsar_price;
        $order->service = $r->service;
        $order->payment_method = $r->payment_method;
        $order->bank_id = $r->bank_id;

        $order->save();

        $insertedId = $order->id;

        $order->order_no = "E-".($insertedId+1000);
        
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

        if($order->payment_method == "online_payment"){

            $methodName = "دفع اونلاين";

        }elseif($order->payment_method == "transfer"){

            $methodName = "تحويل بنكي";

        }


        $data = array(
			'name' => $r->name,
			'phone' => $r->phone,
			'type' => $r->type,
			'service' => $r->service,
			'order_no' => $order->order_no,
			'price' => $order->price,
			'payment_method' => $methodName,
			);


        $setting = Setting::first();

		Mail::send('customEmail.order_estfsar', $data, function($message) use ($data,$setting){
			$message->from('no-replay@enjaz-fawry.com');
			$message->to($setting->email);
			$message->cc($setting->secmail);
			$message->subject('انجاز فوري : طلب استفسار جديد - '.$data['order_no']);
		});


        $notification = array(
            'message' => 'لقد تم تقديم الطلب بنجاح .',
            'alert-type' => 'success'
        );
        return redirect()->route('estfsar.show', ['oid' => $order->id] )->with($notification); 
        
    }


    public function index()
    {

        $user = User::find(auth()->user()->id);

        $order_estfsar = $user->estfsar_orders;
        $order_estfsar_count = $user->estfsar_orders->count();

        return view('engazFawry.dashboard.index_estfsar', [
            'pagetitle' => __('order_estfsar'),
            'order_estfsar' =>  $order_estfsar ,
            'order_estfsar_count' =>  $order_estfsar_count ,
            'user' =>  $user ,
        ]);
    }

    public function estfsarShow(Request $r, $oid)
    {
        $user = User::find(auth()->user()->id);


        

        $orders = $user->estfsar_orders->pluck('id')->toArray();

        if( in_array($oid, $orders) ){

            $order = Order_estfsar::find($oid);


           

        // check moyasar payment response 
        $response = [];
        
        if($r->id  !== null  && $r->status !== null   && $r->message !== null ){

            Moyasar\Client::setApiKey("sk_live_pRCggGGMpfxZTqgecwGCfiSnCFRrxUAdWv6gk9st");
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
            return view('engazFawry.dashboard.order_estfsar', [
                'pagetitle' => __('order_estfsar'),
                'order' =>  $order ,
                'user' =>  $user ,
                'response' =>  $response,
            ]);
        }else{
            return view('engazFawry.dashboard.order_estfsar', [
                'pagetitle' => __('order_estfsar'),
                'order' =>  $order ,
                'user' =>  $user ,
            ]);
        }

        }else{
        
            abort(403, 'Unauthorized action.');
        }
    }


    public function estfsarProve(Request $r)
    {
    
        $r->validate([
            'proveFile' => ['required','mimes:jpeg,png,jpg,pdf'],
            'order_id' => ['required'],
            'user_id' => ['required'],
        ]);

        $user = User::find(auth()->user()->id);

        $orders = $user->estfsar_orders->pluck('id')->toArray();

        if( in_array($r->order_id, $orders)  && $user->id == $r->user_id){
        
            if( $r->hasFile('proveFile')){

                //file upload and check
                $fileExt            = $r->proveFile->getClientOriginalExtension();
                $fileIdNameNew        = uniqid() . time() . '.' . $fileExt;
                $r->proveFile->storeAs('public/payment_proves', $fileIdNameNew);

                $order = Order_estfsar::find($r->order_id);
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

        $orders = $user->estfsar_orders->pluck('id')->toArray();

        if( in_array($id, $orders) ){

            $order = Order_estfsar::find($id);
            
            $setting = Setting::first();
            $mobile = $setting->phone;


            $pdf = PDF::loadView('engazFawry.dashboard.printInvoice_estfsar', array('order' => $order, 'mobile' => $mobile), []);

            return $pdf->stream('document.pdf');
            
        } else {
            abort(403, 'Unauthorized action.');
        }

    }

}