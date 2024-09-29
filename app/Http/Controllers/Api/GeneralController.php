<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Terms;
use App\City;
use App\Setting;
use App\Bank;
use App\Service;
use App\CommonQuestion;
use App\Contact;
use App\SiteReviews;
use Mail;
use Illuminate\Support\Facades\Validator;

use  App\BlackList;
use Moyasar;


class GeneralController extends Controller
{
    public function terms(Request $r)
    {

      //  dd($r);

        $r->validate([
            'type' => ['required'],
        ]); 

        $type = $r->type; 

        $terms = Terms::get()->first();

        if($type == 'shrkat'){

            return response()->json([
                'status' => 1,
                'type' => 'success',
                'terms' => $terms->terms_shrkat,
            ]);

        }elseif($type == 'mo3amla'){

            return response()->json([
                'status' => 1,
                'type' => 'success',
                'terms' => $terms->terms_mo3amla,
            ]);

        }elseif($type == 'ta3med'){

            return response()->json([
                'status' => 1,
                'type' => 'success',
                'terms' => $terms->terms_ta3med,
            ]);
            
        }elseif($type == 'estfsar'){
            
            return response()->json([
                'status' => 1,
                'type' => 'success',
                'terms' => $terms->terms_estfsar,
            ]);

        }elseif($type == 'registerUser'){
            
            return response()->json([
                'status' => 1,
                'type' => 'success',
                'terms' => $terms->terms_client,
            ]);

        }elseif($type == 'registerVendor'){

            return response()->json([
                'status' => 1,
                'type' => 'success',
                'terms' => $terms->terms_vendor,
            ]);
            
        }elseif($type == 'guarante'){

            return response()->json([
                'status' => 1,
                'type' => 'success',
                'terms' => $terms->terms_guarante,
            ]);
            
        }else{

            return response()->json([
                'status' => 0,
                'type' => 'error',
                'msg' => 'Not Found',
            ]);
        }
    }


    public function cities()
    {
        $cities = City::all(); 
        return response()->json([
            'status' => 1,
            'type' => 'success',
            'cities' =>  $cities,
        ]);
    }

    public function aboutUs()
    {
       
        $setting = Setting::get()->first();
        return response()->json([
            'status' => 1,
            'type' => 'success',
            'about' =>  $setting->about_us_page ,
        ]);
    }

    public function banks()
    {
        $banks = Bank::all(); 
        return response()->json([
            'status' => 1,
            'type' => 'success',
            'banks' =>  $banks,
        ]);
    }

    public function services()
    {
        $services = Service::all(); 
        return response()->json([
            'status' => 1,
            'type' => 'success',
            'services' =>  $services,
        ]);
    }

    public function SiteReviews()
    {

        $site_review = SiteReviews::where('status', 1)->get();
        return response()->json([
            'status' => 1,
            'type' => 'success',
            'reviews' =>  $site_review,
        ]);
    }


    
    public function setting()
    {
       // $cities = Setting::all(); 
        $setting = Setting::get()->first();


        $social = [];
        if( $setting->facebook != '' ||  $setting->facebook != "#"){
            $face = ['facebook' => $setting->facebook];
            array_push( $social, $face);
        }

        if( $setting->twitter != '' ||  $setting->twitter != "#"){
            $twitter = ['twitter' => $setting->twitter];
            array_push( $social, $twitter);
        }

        if( $setting->instagram != '' ||  $setting->instagram != "#"){
            $instagram = ['instagram' => $setting->instagram];
            array_push( $social, $instagram);
        }

        if( $setting->youtube != '' ||  $setting->youtube != "#"){
            $youtube = ['youtube' => $setting->youtube];
            array_push( $social, $youtube);
        }

        if( $setting->linkedin != '' ||  $setting->linkedin != "#"){
            $linkedin = ['linkedin' => $setting->linkedin];
            array_push( $social, $linkedin);
        }

        if( $setting->snapchat != '' ||  $setting->snapchat != "#"){
            $snapchat = ['snapchat' => $setting->snapchat];
            array_push( $social, $snapchat);
        }

        if( $setting->warning_on == 1){

            $warning = ['title' =>  $setting->warning_title  , 
                        'text' =>  $setting->warning_text_app];

        }else {
            $warning = 0;
        }

        return response()->json([
            'status' => 1,
            'type' => 'success',
            'social' =>  $social,
            'email' =>  $setting->email,
            'phone' =>  $setting->phone,
            'whatsapp' =>  $setting->general_whats,
            'estfsar_price' =>  $setting->estfsar_price,
            'ta3med_percentage' =>  $setting->ta3med_price,
            'payment_method_bank' =>  $setting->bankPayment,
            'payment_method_visa' =>  $setting->onlinePayment,
            'address' =>  $setting->address,
            'warning' =>  $warning,
        ]);
    }



    public function faq()
    {    
        $questions = CommonQuestion::orderBy('sorting_number', 'asc')->where('status', 1)->paginate(20);
      //  return view('engazFawry.faq', ['questions' => $questions, 'pagetitle' => __('الاسئلة الشائعة')]);

        return response()->json([
            'status' => 1,
            'type' => 'success',
            'questions' =>  $questions,
           
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

        return response()->json([
            'status' => 1,
            'type' => 'success',
            'msg' =>  'تم ارسال رسالتك بنجاح .'
        ]);

        // return redirect()->back()->with($notification); 
    }


    public function blacklist(Request $r)
    {

        $validator = Validator::make($r->all(), [
            'phone' => ['required', 'digits:10', 'min:10', 'max:10', 'regex:/^[0-9]+$/'],
        ]);

    

        if ($validator->passes()) {


            $que = BlackList::where('mobile', '=', $r->phone)->first();

            if($que){

                
                if($que->show_reason == 1){
                    $reason = $que->desc;
                }else{
                    $reason = "";
                }
                if ($que->name != null) {
                    $name = $que->name;
                } else {
                    $name = "";
                }
                $response = array(
                    'found' => 1, 
                    'mobile' =>  $r->phone ,
                    'name' =>  $name, 
                    'reason' =>  $reason,
                );
            }else{

                $response = array(
                    'found' => 0,
                    'mobile' =>  $r->phone,
                );
            }

            return response()->json([
                'status' => 1,
                'type' => 'success',
                'response' => $response,
                ]);

        }

        return response()->json([
            'status' => 0,
            'type' => 'error',
            'response' => $validator->errors()->all(),
            ]);
        
    }


    public function paymentKeys(){
        return response()->json([
            'status' => 1,
            'type' => 'success',
            'secret_api_key' => getPaymentKeys('secret_api_key'),
            'publishable_api_key' => getPaymentKeys('publishable_api_key'),
        ]);
    }


    




}