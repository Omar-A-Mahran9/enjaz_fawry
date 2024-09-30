<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;
use App\Setting;
use App\User;
use App\Status;


use App\Exports\ContactExport;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{


    public function export() 
    {
        return Excel::download(new ContactExport, 'Messages.xlsx');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(!auth()->user()->hasAnyPermission(['contact_index'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // }
        //$statuses = Status::where('where', 0)->orWhere('where', 3)->get();
        $setting = Setting::first();
        $messages = Contact::latest()->paginate($setting->paginate);
        return view('dashboard.contact.index', [
            'messages' => $messages, 
            //'statuses' => $statuses
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // if(!auth()->user()->hasAnyPermission(['contact_show'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // }
        // $statuses = Status::where('where', 0)->orWhere('where', 3)->get();
        $message = Contact::find($id);
        if ($message->status == -1) {
            $message->status = 0;
            $message->save();
        }
        return view('dashboard.contact.show', ['message' => $message]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $r, $id)
    // {
    //     if(!auth()->user()->hasAnyPermission(['contact_update'])){
    //         return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
    //     }
    //     $r->validate([
    //         'processing_id' => ['required'],
    //     ]);
    //     $status = Status::find($r->processing_id);
    //     $message = Contact::find($id);
    //     $message->processing_id = $status->id;
    //     $message->save();
    //     if ($status->sms == 1) {
    //         $sms_send_status = senSMS($message->phone, $status->sms_text);
    //         if ($sms_send_status == 1) {
    //             return redirect()->back()->with('success', 'تم تحديث حالة معالجة الطلب وارسال الرسالة بنجاح');
    //         } elseif ($sms_send_status === false){
    //             return redirect()->back()->with('error', 'الرقم غير صحيح' . $message->phone);
    //         }
    //         return redirect()->back()->with('error', 'حدث مشكلة اثناء ارسال الرسالة' . $message->phone);
    //     }
    //     return redirect()->back()->with('success', 'تم تحديث حالة معالجة الطلب بنجاح');

    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if(!auth()->user()->hasAnyPermission(['contact_delete'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $message = Contact::find($id);
        $message->delete();
        return redirect()->route('dashboard.contact.index')->with('success', 'تم حذف الرسالة بنجاح');
    }

    // public function statusUpdate(Request $r)
    // {
    //     if(!auth()->user()->hasAnyPermission(['contact_update'])){
    //         return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
    //     }
    //     $r->validate([
    //         'processing_id' => ['required'],
    //     ]);

    //     $ids = explode(",", $r->ids_input);

    //     foreach ($ids as $key => $value) {
    //         if($value == null){return redirect()->back()->with('error', 'لم تقم باختيار اي رسالة');}
    //         $status = Status::find($r->processing_id);
    //         $message = Contact::find($value);
    //         $message->processing_id = $status->id;
    //         $message->save();
    //         if ($status->sms == 1) {
    //             $sms_send_status = senSMS($message->phone, $status->sms_text);
    //             if ($sms_send_status == 1) {
    //                 return redirect()->back()->with('success', 'تم تحديث حالة معالجة الطلب وارسال الرسالة بنجاح');
    //             } elseif ($sms_send_status === false){
    //                 return redirect()->back()->with('error', 'الرقم غير صحيح' . $message->phone);
    //             }
    //             return redirect()->back()->with('error', 'حدث مشكلة اثناء ارسال الرسالة' . $message->phone);
    //         }
            
    //     }
    
        
    //     return redirect()->back()->with('success', 'تم تحديث حالة معالجة الطلب بنجاح');
    // }
}
