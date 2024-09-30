<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 //use App\FrontEndHome;
use App\Setting;
use App\Bank;
use App\Client;
use App\City;
use App\Service;
use App\Order_mo3amla;
use App\Order_ta3med;
use App\Order_sharkat;
use App\Order_estfsar;
use App\CommonQuestion;
use App\Home;
use App\User;
use App\Contact;
use App\SiteReviews;
use App\Blog;
use Mail;

use Moyasar;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $home = Home::get()->first();

        $clients_count = User::Where('type', 'individual')->count();
       // $vendors = User::Where('type','=' ,'vendor')->where('status', '=', 1)->limit(5)->get();
       // $vendorCs = User::Where('type', '=' ,'vendorC')->where('status', '=', 1)->limit(5)->get();
        $setting = Setting::first();


        $site_review = SiteReviews::where('status', 1)->get();


        $vendors_count  = User::Where('type','=' ,'vendor')->where('status', '=', 1)->count();
        $vendorCs_count =  User::Where('type','=' ,'vendorC')->where('status', '=', 1)->count();

        $allVendors = $vendors_count + $vendorCs_count;

        $mo3amla = Order_mo3amla::count();
        $ta3med  = Order_ta3med::count();
        $estfsar = Order_estfsar::count();
        $company = Order_sharkat::count();
        $contact = Contact::count();


        $orders = $mo3amla +  $ta3med + $estfsar + $company + $contact;


            $marquee_array = [];

            $mo3amla_marquee = Order_mo3amla::select('order_no','service_id')->limit(5)->latest()->get();
         
            foreach ($mo3amla_marquee as $moq) {
                $ord = array( 
                    'name' => 'معاملة',
                    'key' => $moq->order_no,
                    'value' => $moq->service->name,
                   //  'value' =>'',
                );
                array_push($marquee_array, $ord);
            }

            $mo3amla_estfsar = Order_ta3med::select('order_no')->limit(5)->latest()->get();
         
            foreach ($mo3amla_estfsar as $estq) {
                $ord = array( 
                    'name' => 'طلب استفسار',
                    'key' => $estq->order_no,
                    'value' =>'',
                );
                array_push($marquee_array, $ord);
            }


            $mo3amla_ta3med = Order_estfsar::select('order_no')->limit(5)->latest()->get();
         
            foreach ($mo3amla_ta3med as $taq) {
                $ord = array( 
                    'name' => 'طلب تعميد',
                    'key' => $taq->order_no,
                    'value' =>'',
                );
                array_push($marquee_array, $ord);
            }


            shuffle ( $marquee_array);

        return view('engazFawry.home', [
            'pagetitle' => __('web.home'),
            'home' => $home,
            'clients_count' => $clients_count,
          //  'vendors' => $vendors,
          //  'vendorCs' => $vendorCs,
          
            'site_review' => $site_review,
            'setting' => $setting,
            'vendors_count' => $vendors_count,
            'vendorCs_count' => $vendorCs_count,
            'orders' => $orders,
            'allVendors' => $allVendors,
            'marquee_array' => $marquee_array,
        ]);
    }

public function verifyUser($token)
{
$verifyUser = User::where('mail_token', $token)->first();


  if(isset($verifyUser) ){
    $user = $verifyUser->user;
    if(!$verifyUser->mail_verified_at || $verifyUser->mail_verified_at == 'NULL') {
      $verifyUser->mail_verified_at = now();
      $verifyUser->save();
      //$status = "Your e-mail is verified. You can now login.";
     //  dd($status);
      $notification = array(
            'message' => 'تم تفعيل البريد الالكتروني بنجاح',
            'alert-type' => 'success',
        );
    } else {
     // $status = "Your e-mail is already verified. You can now login.";
       $notification = array(
                'message' => 'البريد الالكتروني تم تفعيله من قبل ',
                'alert-type' => 'error',
            );
    }
  } else {


    $notification = array(
        'message' => 'هذا البريد لايمكن تعريفه ',
        'alert-type' => 'error'
    );
  //dd($notification);
    return redirect('/login')->with($notification);


  }

  //dd($notification);
        
// return redirect()->back()->with($notification);
  return redirect('/login')->with($notification);
    
}




    public function invoice()
    {
        return view('engazFawry.invoice', [
            'pagetitle' => __('web.invoice'),
        ]);
    }
    public function login()
    {       
        return view('engazFawry.login', [
            'pagetitle' => __('engazFawry.login')
        ]);
    }



    
    public function vendorData(Request $r)
    {   

        $r->validate([
            'user_id' => ['required'], 
        ]); 

        $vendor = User::where('id', '=', $r->user_id)->where('status', '=', 1)->first();

       // dd($vendor);

        $data = view('engazFawry.parts.vendorData', compact(['vendor']))->render();
        return response()->json(['options'=>$data]);


    }
    public function vendors()
    {
        $vendors = User::where('type', '=', 'vendor')->where('status', '=', 1)->get();
        return view('engazFawry.vendors', [
            'pagetitle' => __('engazFawry.vendors'),
             'vendors' => $vendors,
        ]);
    }
    public function vendors_company()
    {
        
        $vendorCs = User::where('type', '=', 'vendorC')->where('status', '=', 1)->get();
       
        
        return view('engazFawry.vendors-company', [
            'pagetitle' => __('engazFawry.vendors-company'),
            'vendorCs' => $vendorCs,
        ]);
    }
    public function vendor()
    {       
        return view('engazFawry.vendor', [
            'pagetitle' => __('engazFawry.vendor')
        ]);
    }


    public function blog()
    {
       
        $blogs = Blog::where('status', '=', 1)->get()->sortByDesc('id');
        return view('engazFawry.blog', [
            'pagetitle' => __('المدونة'),
            'blogs' => $blogs,
        ]);
    }

    public function article($id)
    {
        $article = Blog::where('id', '=', $id)->where('status', '=', 1)->first();
        $blogs = Blog::where('status', '=', 1)->where('id', '<>', $id)->limit(3)->get();

        if($article){
            return view('engazFawry.article', [
                'pagetitle' => $article->title,
                'article' =>$article,
                'blogs' =>$blogs,
            ]);
        }else{
            abort(404);
        }
    }

    public function sharkat()
    {
       $cities = City::all();
        return view('engazFawry.form4', [
            'pagetitle' => __('engazFawry.form4')
        ])->with('cities', $cities);
    }

    public function sharkat_send(Request $r)
    {
        $r->validate([
            'name' => ['required'],
            'phone'   => ['required', 'digits:10','min:10','max:10', 'regex:/^[0-9]+$/'],
            'city' => ['required'],
            'type' => ['required'],
            'service' => ['required'],
        ]); 

        $order = new Order_sharkat;
        $order->name = $r->name;
        $order->mobile = $r->phone;
        $order->city_id = $r->city;
        $order->type = $r->type;
        $order->service = $r->service;

        $order->save();

        $insertedId = $order->id;
        $order->order_no = "C-".($insertedId+100);
        $order->save();
        $cities = City::all(); 


        $cityName = City::find($r->city)->name;

        $data = array(
			'name' => $r->name,
			'phone' => $r->phone,
			'city' => $cityName,
			'type' => $r->type,
			'service' => $r->service,
			'order_no' => $order->order_no,
			);


        $setting = Setting::first();

		Mail::send('customEmail.order_company', $data, function($message) use ($data,$setting){
			$message->from('no-replay@enjaz-fawry.com');
			$message->to($setting->email);
			$message->cc($setting->secmail);
			$message->subject('انجاز فوري : طلب شركات جديد - '.$data['order_no']);
		});


        $notification = array(
            'message' => 'لقد تم تقديم الطلب بنجاح .',
            'alert-type' => 'success'
        );
        return redirect()->route('sharkat')->with($notification)->with('cities', $cities); 
    }

    public function faq()
    {    
        $questions = CommonQuestion::orderBy('sorting_number', 'asc')->where('status', 1)->paginate(20);
        return view('engazFawry.faq', ['questions' => $questions, 'pagetitle' => __('الاسئلة الشائعة')]);
    }

    public function contact()
    {    
        $setting = Setting::first();
        return view('engazFawry.contact', [
            'pagetitle' => __('للتواصل'),
            'setting' => $setting
        ]);
    }


    public function storeContact(Request $r)
    {
        $r->validate([
            'name' => ['required'],
            'mobile'   => ['required'],
            'email' => ['required'],
            'message' => ['required'],
        ]); 
        $contact = new Contact;

        if(isset($r->user_id)){
            $contact->user_id = $r->user_id;
        }

        $contact->name = $r->name;
        $contact->email = $r->email;
        $contact->phone = $r->mobile;
        $contact->message = $r->message;
        $contact->save();

        $notification = array(
            'message' => 'تم ارسال رسالتك بنجاح .',
            'alert-type' => 'success'
        );


        $setting = Setting::first();
	    $data = array(
			'name' => $r->name,
			'email' => $r->email,
			'mobile' => $r->mobile,
			'bodyMessage' => $r->message
			);

		Mail::send('customEmail.contact', $data, function($message) use ($data,$setting){
			$message->from($data['email']);
			$message->to($setting->email);
			$message->cc($setting->secmail);
			$message->subject('انجاز فوري : رسالة جديدة من صفحة تواصل معنا ');
		});



        return redirect()->back()->with($notification); 
    }

/* 
    public function paymentTest()
    {    
        //$setting = Setting::first();
        return view('engazFawry.parts.visaPayment', [
            'pagetitle' => __('kkk'),
         //   'setting' => $setting
        ]);
    }


    public function visa(Request $r)
    {    

        Moyasar\Client::setApiKey("sk_test_KRfg7JNU7AQ7g6pkM8hrZFJNTURSs8qpYtiq74TZ");


        $retrieve = Moyasar\Payment::fetch($r->id);

        dd($retrieve);
        dd($r);
        //$setting = Setting::first();
        return view('engazFawry.parts.visaResponse', [
            'pagetitle' => __('kkk'),
         //   'setting' => $setting
        ]);
    } */
}
