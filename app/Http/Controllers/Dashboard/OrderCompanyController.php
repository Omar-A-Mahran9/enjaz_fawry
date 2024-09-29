<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Status;
use App\City;
use App\Setting;
use App\Bank;
use App\Order_sharkat;


use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderCompanyController extends Controller
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
        $orders = Order_sharkat::latest()->paginate($setting->paginate);
        return view('dashboard.orders.index_shrkat', ['orders' => $orders, 'statuses' => $statuses, 'city'=>$city]);

    }


    public function showCompany($id)
    {
        // if(!auth()->user()->hasAnyPermission(['order_show'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $statuses = Status::get();
        $order = Order_sharkat::find($id);

        if(isset($order)){
            if ($order->status == -1) {
                $order->status = 0;
                $order->save();
            }
            return view('dashboard.orders.show_company', ['order' => $order, 'statuses' => $statuses]);
        }else{

            $statuses = Status::get();
            $setting = Setting::first();
            $orders = Order_sharkat::latest()->paginate($setting->paginate);
            return view('dashboard.orders.index_shrkat', ['orders' => $orders,'statuses' => $statuses]);

        }


    }

    

    public function destroy($id)
    {
        // if(!auth()->user()->hasAnyPermission(['order_delete'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $order = Order_sharkat::find($id);
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
        $order = Order_sharkat::find($id);
        $order->processing_id = $status->id;
        $order->save();
        if ($status->sms == 1) {
            $sms_send_status = senSMS($order->phone, $status->sms_text);
            if ($sms_send_status['statusCode'] == '201') {
                return redirect()->back()->with('success', 'تم تحديث حالة معالجة الطلب وارسال الرسالة بنجاح');
            } elseif ($sms_send_status === false){
                return redirect()->back()->with('error', 'الرقم غير صحيح' . $order->phone);
            }
            return redirect()->back()->with('error', 'حدث مشكلة اثناء ارسال الرسالة' . $order->phone);
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

        foreach ($ids as $key => $value) {
            if($value == null){return redirect()->back()->with('error', 'لم تقم باختيار اي طلب');}
            $status = Status::find($r->processing_id);
            $order = Order_sharkat::find($value);
            $order->processing_id = $status->id;
            $order->save();
            if ($status->sms == 1) {
                $sms_send_status = senSMS($order->phone, $status->sms_text);
                if ($sms_send_status['statusCode'] == '201') {
                    return redirect()->back()->with('success', 'تم تحديث حالة معالجة الطلب وارسال الرسالة بنجاح');
                } elseif ($sms_send_status === false){
                    return redirect()->back()->with('error', 'الرقم غير صحيح' . $order->phone);
                }
                return redirect()->back()->with('error', 'حدث مشكلة اثناء ارسال الرسالة' . $order->phone);
            }
            
        }
        return redirect()->back()->with('success', 'تم تحديث حالة معالجة الطلب بنجاح');
    }


}
