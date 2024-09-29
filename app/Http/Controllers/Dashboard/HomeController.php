<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Blog;
use App\Contact;
use App\User;


use App\Order_sharkat;
use App\Status;
use App\City;
// use App\Bank;
use App\Order_estfsar;
use App\Order_mo3amla;
use App\Order_ta3med;
use App\SentSms;
use App\CommonQuestion;

use Carbon\Carbon;


class HomeController extends Controller
{
    public function home()
    {



        // prepare sales charts data


        // 1 - mo3amla
        $mo3amla_this_month = Order_mo3amla::whereMonth('created_at', '=',  Carbon::now()->month)->count();
        $mo3amla_month_one  = Order_mo3amla::whereMonth('created_at', '=',  Carbon::now()->subMonth()->month)->count();
        $mo3amla_month_two  = Order_mo3amla::whereMonth('created_at', '=',  Carbon::now()->subMonths(2)->month)->count();
        $mo3amla_month_three = Order_mo3amla::whereMonth('created_at', '=',  Carbon::now()->subMonths(3)->month)->count();


        // 2 - ta3med
        $ta3med_this_month = Order_ta3med::whereMonth('created_at', '=',  Carbon::now()->month)->count();
        $ta3med_month_one  = Order_ta3med::whereMonth('created_at', '=',  Carbon::now()->subMonth()->month)->count();
        $ta3med_month_two  = Order_ta3med::whereMonth('created_at', '=',  Carbon::now()->subMonths(2)->month)->count();
        $ta3med_month_three = Order_ta3med::whereMonth('created_at', '=',  Carbon::now()->subMonths(3)->month)->count();


        // 3 - estfsar
        $estfsar_this_month = Order_estfsar::whereMonth('created_at', '=',  Carbon::now()->month)->count();
        $estfsar_month_one  = Order_estfsar::whereMonth('created_at', '=',  Carbon::now()->subMonth()->month)->count();
        $estfsar_month_two  = Order_estfsar::whereMonth('created_at', '=',  Carbon::now()->subMonths(2)->month)->count();
        $estfsar_month_three = Order_estfsar::whereMonth('created_at', '=',  Carbon::now()->subMonths(3)->month)->count();


        // 4 - sharkat
        $sharkat_this_month = Order_estfsar::whereMonth('created_at', '=',  Carbon::now()->month)->count();
        $sharkat_month_one  = Order_estfsar::whereMonth('created_at', '=',  Carbon::now()->subMonth()->month)->count();
        $sharkat_month_two  = Order_estfsar::whereMonth('created_at', '=',  Carbon::now()->subMonths(2)->month)->count();
        $sharkat_month_three = Order_estfsar::whereMonth('created_at', '=',  Carbon::now()->subMonths(3)->month)->count();




        
        //dd($sharkat_month_two);

        $orders_ta3med = Order_ta3med::where('status', '=', 5)->whereMonth('created_at', '=',  date('m'))->get();


        $coun_of_contacts   = Contact::count();
       
        $coun_of_orders_mo3amla      = Order_mo3amla::count();
        $new_mo3amla                = Order_mo3amla::where('status', "=",-1)->count();


        $coun_of_orders_company      = Order_sharkat::count();
        $coun_of_orders_t3meed       = Order_ta3med::count();
        $coun_of_orders_estfsar      = Order_estfsar::count();

        $coun_of_posts      = Blog::count();
        $coun_of_faq      = CommonQuestion::count();

        
        $coun_of_contacts   = Contact::count();

        $coun_of_clients    = User::where('type', 'individual')->count();
        $coun_of_vendors    = User::where('type', 'vendor')->count();
        $coun_of_vendorCs   = User::where('type', 'vendorC')->count();


        return view('dashboard.home', [
           
            'coun_of_contacts' => $coun_of_contacts,
            'coun_of_posts' => $coun_of_posts,
            'coun_of_faq' => $coun_of_faq,
            'coun_of_orders_mo3amla' => $coun_of_orders_mo3amla,
            'coun_of_orders_company' => $coun_of_orders_company,
            'coun_of_orders_t3meed' => $coun_of_orders_t3meed,
            'coun_of_orders_estfsar' => $coun_of_orders_estfsar,
            'coun_of_clients' => $coun_of_clients,
            'coun_of_vendors' => $coun_of_vendors,
            'coun_of_vendorCs' => $coun_of_vendorCs,
            'new_mo3amla' => $new_mo3amla,

            // new sales chart


            'this_month' =>  Carbon::now()->format('F-Y'),
            'month_one' =>  Carbon::now()->subMonth()->format('F-Y'),
            'month_two' =>  Carbon::now()->subMonths(2)->format('F-Y'),
            'month_three' =>  Carbon::now()->subMonths(3)->format('F-Y'),

            'mo3amla_this_month' => $mo3amla_this_month,
            'mo3amla_month_one' => $mo3amla_month_one,
            'mo3amla_month_two' => $mo3amla_month_two,
            'mo3amla_month_three' => $mo3amla_month_three,

            'ta3med_this_month' => $ta3med_this_month,
            'ta3med_month_one' => $ta3med_month_one,
            'ta3med_month_two' => $ta3med_month_two,
            'ta3med_month_three' => $ta3med_month_three,

            'estfsar_this_month' => $estfsar_this_month,
            'estfsar_month_one' => $estfsar_month_one,
            'estfsar_month_two' => $estfsar_month_two,
            'estfsar_month_three' => $estfsar_month_three,

            'sharkat_this_month' => $sharkat_this_month,
            'sharkat_month_one' => $sharkat_month_one,
            'sharkat_month_two' => $sharkat_month_two,
            'sharkat_month_three' => $sharkat_month_three,


        ]);

    }



    public function customSMS(Request $r)
    {
        

        $r->validate([
            'orderId' => ['required'],
            'userPhone' => ['required'],
            'userId' => ['required'],
            'smsText' => ['required'],
        ]);

        $vNumber = validNumber($r->userPhone);
        $sms_msg = $r->smsText;
        $send = senSMS($vNumber, $sms_msg);

      //  dd( $send );

        if( $send['statusCode'] == '201' ){

            $sentSMS = new SentSms;

            $sentSMS->user_id =  $r->userId;
            $sentSMS->content =  $sms_msg;
            $sentSMS->status = 1;
            $sentSMS->order_id = $r->orderId;

            $sentSMS->save();

            return redirect()->back()->with('success', 'تم ارسال الرسالة بنجاح');

        }else{

            return redirect()->back()->withErrors(['field' => 'حدث خطأ اثناء الارسال']);

        }







//    dd($r);
     

    }
   
}
