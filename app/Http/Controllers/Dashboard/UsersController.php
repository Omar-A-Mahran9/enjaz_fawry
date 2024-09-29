<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Setting;
use App\BlackList;

// use App\Traits\Firebase;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class UsersController extends Controller
{

    // use  Firebase;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexClient()
    {
        // if(!auth()->user()->hasAnyPermission(['super'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $setting = Setting::first();
        $clients = User::where('type', 'individual')->orderBy('id', 'desc')->paginate($setting->paginate);

        return view('dashboard.users.client_index', ['clients' => $clients]);
    }

    public function indexVendor()
    {
        // if(!auth()->user()->hasAnyPermission(['super'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $setting = Setting::first();
        $vendors = User::where('type', 'vendor')->orWhere('type', 'vendorC')->orderBy('id', 'desc')->paginate($setting->paginate);
        return view('dashboard.users.vendor_index', ['vendors' => $vendors]);

    }

    public function sendPushNotification(Request $r){


       
        $user = User::find($r->id);

    

// start notification 

if(!empty($user->firebase_token) ||  $user->firebase_token != null){





    $optionBuilder = new OptionsBuilder();
    $optionBuilder->setTimeToLive(60*20);

    $notificationBuilder = new PayloadNotificationBuilder('تست اشعار');
    $notificationBuilder->setBody('تست اشعار')->setSound('default');
    $notificationBuilder->setClickAction("FLUTTER_NOTIFICATION_CLICK");

    $dataBuilder = new PayloadDataBuilder();
    $dataBuilder->addData([
        'click_action' =>  'FLUTTER_NOTIFICATION_CLICK',
        'notification_title' => 'تست اشعار',
        'notification_body' => 'تست اشعار',
        // 'order_id' => $order->id,
        // 'note_id' => $note->id,
        'type' => 'user',
        'page' => 'home_page',
        'content_available' =>  true,

    ]);

    $option = $optionBuilder->build();
    $notification = $notificationBuilder->build();
    $data = $dataBuilder->build();

    $token = $user->firebase_token;

    $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

    // end notification


    // $data = [
    //     'user_id' => $user->id,
    //     'body' => 'تست جديد ',
    //     'title' => 'تست جديد',
    //     'type' => 'user',
    //     'click_action' => 'FLUTTER_NOTIFICATION_CLICK', 
    //     'page' =>  'home_page',   
    // ];
    // $this->sendNotification($user->firebase_token, $data['title'], $data['body'], $data); // for karag



}

     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(!auth()->user()->hasAnyPermission(['super'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $roles = Role::all();
        return view('dashboard.moderators.create', ['roles' => $roles]);
    }


    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        // if(!auth()->user()->hasAnyPermission(['super'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $r->validate([
            'name' => ['required', 'string', 'max:90'],
            'email' => ['required', 'string', 'email', 'max:90', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required', 'string'],
        ]);
        $user = new User;
        $user->name = $r->name;
        $user->email = $r->email;
        $user->password = Hash::make($r->password);
        $user->save();
        $user->assignRole($r->role);
        return redirect()->route('dashboard.moderators.index')->with('success', 'تم اضافة المشرف بناجح');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showClient($id)
    {
        //
        $user = User::find($id);
        $mo3amlat = $user->mo3amla_orders;
        $ta3meed = $user->ta3med_orders;
        $estfsarat = $user->estfsar_orders;
        return view('dashboard.users.client_show', 
        [ 'user' => $user,
          'mo3amlat' => $mo3amlat,
          'ta3meed' => $ta3meed,
          'estfsarat' => $estfsarat
        ]);
    }


    public function showVendor($id)
    {
        //
        // $user = User::find($id);
        // return view('dashboard.users.vendor_show', ['user' => $user]);


        $user = User::find($id);
        $mo3amlat = $user->mo3amla_orders;
        $ta3meed = $user->ta3med_orders;
        $estfsarat = $user->estfsar_orders;
        return view('dashboard.users.vendor_show', 
        [ 'user' => $user,
          'mo3amlat' => $mo3amlat,
          'ta3meed' => $ta3meed,
          'estfsarat' => $estfsarat
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editClient($id)
    {
        // if(!auth()->user()->hasAnyPermission(['super'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $user = User::find($id);
        return view('dashboard.users.client_edit', ['user' => $user]);
    }

    public function editVendor($id)
    {
        // if(!auth()->user()->hasAnyPermission(['super'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $user = User::find($id);
        return view('dashboard.users.vendor_edit', ['user' => $user]);
    }

    public function updateClient($id,  Request $r)
    {
        $user = User::find($id);
        $r->validate([
            'name' => ['required', 'string', 'max:90'],
            'email' => ['required', 'string', 'email', 'max:90', 'unique:users,email,' .$id],
            'status' => ['required'],
            'type' => ['required'],
        ]);
    
        if($r->status == -2){

            $r->validate([
                'blacklist_reson' => ['required', 'string'],
            ]);

            $blacklist_reson = $r->blacklist_reson;

            $list = new BlackList;

            $list->name = $r->name;
            $list->mobile = $user->phone;
            $list->desc = $r->blacklist_reson;
            $list->show_reason = 0;
            $list->save();

        }else{

            $blacklist_reson = $user->blacklist_reson;

        }

        if( $r->exists('phone_status') ){

            $phone_status = $r->phone_status;

        }else{

            $phone_status = $user->phone_status;
        }

        if($r->phone != $user->phone){

            $r->validate([
                'phone' => ['required', 'digits:10', 'unique:users','min:10','max:10', 'regex:/^[0-9]+$/'],
            ]);

            $user->phone = $r->phone;
        }

        if($r->identity_no != $user->identity_no){

            $r->validate([
                'identity_no' => ['required', 'digits:10', 'unique:users,identity_no','min:10','max:10', 'regex:/^[0-9]+$/'],
            ]);

            $user->identity_no = $r->identity_no;
        }

    
        $user->name = $r->name;
        $user->type = $r->type;
    
        $user->email = $r->email;
        $user->status = $r->status;
        $user->blacklist_reson = $blacklist_reson;
        $user->phone_status = $phone_status;
        $user->save();

        return redirect()->back()->with('success', 'تم تعديل بيانات الحساب بنجاح');
    }


    public function updateVendor($id, Request $r)
    {
        $user = User::find($id);
        $r->validate([
            'name' => ['required', 'string', 'max:90'],
            'email' => ['required', 'string', 'email', 'max:90', 'unique:users,email,' .$id],
            'identity_status' => ['required'],
            'status' => ['required'],
            'type' => ['required'],

        ]);

        if($r->status == -2){

            $r->validate([
                'blacklist_reson' => ['required', 'string'],
            ]);

            $blacklist_reson = $r->blacklist_reson;

            $list = new BlackList;

            $list->name = $r->name;
            $list->mobile = $user->phone;
            $list->desc = $r->blacklist_reson;
            $list->show_reason = 0;
            $list->save();

        }else{

            $blacklist_reson = $user->blacklist_reson;

        }

        if( $r->exists('phone_status') ){

            $phone_status = $r->phone_status;

        }else{
            $phone_status = $user->phone_status;

        }

        if($r->phone != $user->phone){

            $r->validate([
                'phone' => ['required', 'digits:10', 'unique:users','min:10','max:10', 'regex:/^[0-9]+$/'],
            ]);

            $user->phone = $r->phone;
        }

        if($r->identity_no != $user->identity_no){

            $r->validate([
                'identity_no' => ['required', 'digits:10', 'unique:users,identity_no','min:10','max:10', 'regex:/^[0-9]+$/'],
            ]);

            $user->identity_no = $r->identity_no;
        }

        if($r->has('reject_file_reson')){

            $user->identity_file_reject_reason = $r->reject_file_reson;

        }

        $user->name = $r->name;
        $user->email = $r->email;
        $user->status = $r->status;
        $user->type = $r->type;
        $user->identity_status = $r->identity_status;
        $user->blacklist_reson = $blacklist_reson;
        $user->phone_status = $phone_status;
        $user->save();


        
// start notification 
 if(!empty($user->firebase_token) ||  $user->firebase_token != null){

    if($user->status == 1 && $user->identity_status == 1 ){

        
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);
        
        $notificationBuilder = new PayloadNotificationBuilder(' تفعيل الحساب');
        $notificationBuilder->setBody('تم تفعيل الحساب الخاص بك ')->setSound('default');
        $notificationBuilder->setClickAction("FLUTTER_NOTIFICATION_CLICK");
        
        
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData([
            'click_action' =>  'FLUTTER_NOTIFICATION_CLICK',
            'notification_title' => 'تفعيل الحساب',
            'notification_body' => 'تم تفعيل الحساب الخاص بك',
            'type' => 'user',
            'page' => 'home',
        ]);
        
        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        
        $token = $user->firebase_token;
        
        
        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
    }
     }
    // end notification


        return redirect()->back()->with('success', 'تم تعديل بيانات الحساب بنجاح');
        
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if(!auth()->user()->hasAnyPermission(['super'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'تم حذف العميل بنجاح');
    }
}