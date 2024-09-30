<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SiteReviews;
use App\Setting;

class RateSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rate($id, $token)
    {
        if(!isset($id) || !isset($token)){

            abort(404);
        }else{

            $review = SiteReviews::where('unique_key', '=', $token)->where('id', '=', $id)->first();

            if($review){
                if($review->status === "-1"){

                    // dd($token);
                    return view('engazFawry.rate_site', ['review' => $review]);

                }else{


                    return view('engazFawry.rate_404', ['review' => $review]);
                }
            
            }else{
                //review not found
                abort(404);
            }
           
        }
        
        // $setting = Setting::first();
        // $reviews = SiteReviews::latest()->paginate($setting->paginate);
        // return view('dashboard.site_review.index', ['reviews' => $reviews]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function submitRate(Request $r)
    {
         

        $r->validate([
            'name' => ['required', 'string'],
            'mobile' => ['required'],
            'raty' => ['required', 'string'],
            'desc' => ['required', 'string'],
            'htoken' => ['required', 'string'],
            'hid' => ['required', 'string'],
        ]);


        // if ($id === $r->hid && $token === $r->htoken){


            $review = SiteReviews::where('unique_key', '=', $r->htoken)->where('id', '=', $r->hid)->first();

            if ($review) {

               //  dd($r);
                $review->stars = $r->raty;
                $review->name = $r->name;
                $review->mobile = $r->mobile;
                $review->desc = $r->desc;
                $review->status = 0;
                $review->save();


                $notification = array(
                    'message' => ' تم ارسال التقييم بنجاح ... شكرا لك ',
                    'alert-type' => 'success'
                );

                return redirect('/')->with($notification);


            } else {


                $notification = array(
                    'message' => ' حدث خطأ اثناء تنفيذ طلبك !',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }



    }




 
}
