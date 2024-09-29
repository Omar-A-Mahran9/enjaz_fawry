<?php


namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
 //use App\FrontEndHome;
// use App\Setting;
// use App\Bank;
// use App\Client;
// use App\City;
// use App\Service;
use App\Order_mo3amla;
use App\Order_ta3med;
use App\Order_sharkat;
use App\Order_estfsar;
// use App\CommonQuestion;
use App\Home;
use App\User;
use App\Contact;
use App\Blog;
// use Mail;

// use Moyasar;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
       // $home = Home::get()->first();

        $clients_count = User::Where('type', 'individual')->count();
        $vendors = User::Where('type','=' ,'vendor')->where('status', '=', 1)->limit(5)->with('reviews')->get(['id', 'name', 'account_no', 'type','status','vendor_image']);
        $vendorCs = User::Where('type', '=' ,'vendorC')->where('status', '=', 1)->limit(5)->with('reviews')->get(['id', 'name', 'account_no', 'type','status','vendor_image']);
       
        $vendors_count = User::Where('type','=' ,'vendor')->where('status', '=', 1)->count();
        $vendorCs_count =  User::Where('type','=' ,'vendorC')->where('status', '=', 1)->count();

        $allVendors = $vendors_count + $vendorCs_count;

        $mo3amla = Order_mo3amla::count();
        $ta3med = Order_ta3med::count();
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

       
        return response()->json([
            'status' => 1, 
            'type' => 'Success',
            //    'home' => $home,
            'clients_counter' => $clients_count,
            'vendors_counter' => $allVendors,
            'orders_counter' => $orders,
            'vendors' => $vendors,
            'vendorCs' => $vendorCs,
            'latest_orders' => $marquee_array,
        ]);
    }



    
    public function vendorData(Request $r)
    {   

        $r->validate([
            'user_id' => ['required'], 
        ]); 

        $vendor = User::where('id', '=', $r->user_id)->where('status', '=', 1)->with('reviews')->get(['id', 'name', 'account_no', 'type','status','vendor_image']);

       // dd($vendor);

        // $data = view('engazFawry.parts.vendorData', compact(['vendor']))->render();
        // return response()->json(['options'=>$data]);

        return response()->json([
            'status' => 1, 
            'type' => 'Success',
            'vendor' =>  $vendor,
        ]);


    }
    public function vendors()
    {
        $vendors = User::where('type', '=', 'vendor')->where('status', '=', 1)->with('reviews')->get(['id', 'name', 'account_no', 'type','status','vendor_image']);
        return response()->json([
            'status' => 1, 
            'type' => 'Success',
            'vendors' =>  $vendors,
        ]);
       
    
    }

    public function vendors_company()
    {
        
        $vendorCs = User::where('type', '=', 'vendorC')->where('status', '=', 1)->with('reviews')->get(['id', 'name', 'account_no', 'type','status','vendor_image']);
       
        return response()->json([
            'status' => 1, 
            'type' => 'Success',
            'vendors' =>  $vendorCs,
        ]);
       
    }
 
    

    public function blogs()
    {
       
        $blogs = Blog::where('status', '=', 1)->get();

        return response()->json([
            'status' => 1, 
            'type' => 'Success',
            'blogs' =>  $blogs,
        ]);
       
    }

    public function article(Request $r)
    {

        $r->validate([
            'article_id' => ['required'], 
        ]); 

        $id = $r->article_id;
        $article = Blog::where('id', '=', $id)->where('status', '=', 1)->first();
        $blogs = Blog::where('status', '=', 1)->where('id', '<>', $id)->limit(3)->get(['id', 'title', ]);

        if($article){
            return response()->json([
                'status' => 1, 
                'type' => 'Success',
                'article' =>  $article,
                'related_article' =>$blogs,
            ]);
        }else{
            return response()->json([
                'status' => 0, 
                'type' => 'error',
               
            ]);
        }
    }

}
