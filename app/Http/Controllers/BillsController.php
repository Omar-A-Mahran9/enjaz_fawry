<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\User;
use App\Bank;
use App\Order_estfsar;

use Auth;

class BillsController  extends Controller
{

    public function __construct()
    {
      //  $this->middleware('auth:web');

        $this->middleware('verifyPhone', ['except' => ['verify_form', 'verifyphone'] ]);
    }

    
    public function estfsar()
    {
        $setting = Setting::get()->first();
        $banks = Bank::all();
        return view('engazFawry.form3', [
            'pagetitle' => __('engazFawry.form3'),
            'banks'=> $banks,
            'setting'=> $setting
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


        $notification = array(
            'message' => 'لقد تم تقديم الطلب بنجاح .',
            'alert-type' => 'success'
        );
        return redirect()->route('estfsar.show', ['oid' => $order->id] )->with($notification); 
        
    }


    public function index()
    {

        $user = User::find(auth()->user()->id);

        // $order_estfsar = $user->estfsar_orders;
        // $order_estfsar_count = $user->estfsar_orders->count();

        return view('engazFawry.dashboard.index_bills', [
            'pagetitle' => __('Bills'),
            'user' =>  $user ,
            // 'order_estfsar_count' =>  $order_estfsar_count ,
        ]);
    }

    public function estfsarShow( $oid)
    {
        $user = User::find(auth()->user()->id);

        $orders = $user->estfsar_orders->pluck('id')->toArray();

        if( in_array($oid, $orders) ){

            $order = Order_estfsar::find($oid);
            return view('engazFawry.dashboard.order_estfsar', [
                'pagetitle' => __('order_estfsar'),
                'order' =>  $order ,
            ]);

        }else{
        
            abort(403, 'Unauthorized action.');
        }
    }


    public function estfsarProve(Request $r)
    {
    
        $r->validate([
            'proveFile' => ['required','mimes:jpeg,png,jpg'],
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




}
