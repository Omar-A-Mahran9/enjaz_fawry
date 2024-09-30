<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Contact_order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use App\Setting;
use Illuminate\Support\Facades\Mail;

class RequstController extends Controller
{
    public function storeContact(Request $r)
    {
        $r->validate([
            'name' => ['required'],
            'mobile'   => ['required'],
            'email' => ['required'],
            'service_id' => ['required'],
        ]); 
        $contact = new Contact_order();

        if(isset($r->user_id)){
            $contact->user_id = $r->user_id;
        }
    

        $contact->name = $r->name;
        $contact->email = $r->email;
        $contact->phone = $r->mobile;
        $contact->service_id = $r->service_id;


        $contact->save();


        $setting = Setting::first();
	    $data = array(
			'name' => $r->name,
			'email' => $r->email,
			'mobile' => $r->mobile,
 			);
 
		// Mail::send('customEmail.contact', $data, function($message) use ($data,$setting){
		// 	$message->from($data['email']);
		// 	$message->to($setting->email);
		// 	$message->cc($setting->secmail);
		// 	$message->subject('انجاز فوري : رسالة جديدة من صفحة  التواصل ');
		// });

        return response()->json([
            'status' => 1,
            'type' => 'success',
            'msg' =>  'تم ارسال طلب تواصلك بنجاح .'
        ]);

     }

     public function getAll(){
        $setting = Setting::first();

        $messages = Contact_order::latest()->paginate($setting->paginate);
 
        return view('dashboard.contact_order.index', [
            'messages' => $messages, 
            //'statuses' => $statuses
        ]);
     }

  
     public function show($id)
     {
          // if(!auth()->user()->hasAnyPermission(['contact_show'])){
         //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
         // }
         // $statuses = Status::where('where', 0)->orWhere('where', 3)->get();
         $message = Contact_order::find($id);
         $service=Service::find($message->service_id);
          if ($message->status == -1) {
             $message->status = 0;
             $message->save();
         }
         return view('dashboard.contact_order.show', ['message' => $message,"service"=> $service]);
     }

     public function destroy($id)
     {
         // if(!auth()->user()->hasAnyPermission(['contact_delete'])){
         //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
         // }
         $message = Contact_order::find($id);
         $message->delete();
         return redirect()->route('dashboard.contact_order.All')->with('success', 'تم حذف طلب التواصل بنجاح');
     }

     public function service($id){
        $setting = Setting::first();
        $messages = Contact_order::latest()->where('service_id',$id)->paginate($setting->paginate);
        return view('dashboard.contact_order.index', [
            'messages' => $messages, 
            //'statuses' => $statuses
        ]);
     }
 

}
