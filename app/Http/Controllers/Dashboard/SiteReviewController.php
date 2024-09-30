<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SiteReviews;
use App\Setting;

class SiteReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(!auth()->user()->hasAnyPermission(['banks_index'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $setting = Setting::first();
        $reviews = SiteReviews::latest()->paginate($setting->paginate);
        return view('dashboard.site_review.index', ['reviews' => $reviews]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $r)
    {
        // dd($r);

        function random_strings($length_of_string)
        {

            // md5 the timestamps and returns substring 
            // of specified length 
            return substr(md5(time()), 0, $length_of_string);
        } 
      //  dd(random_strings(5));
        

        $newReview = new SiteReviews;
        $newReview->unique_key = random_strings(5);
        $newReview->status = "-1";
        $newReview->save();

        return redirect()->back()->with('success', 'تم انشاء الرابط '. $newReview->id.' بنجاح'); 
    

        // return view('dashboard.review.create');
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Approve($id)
    {
        // if(!auth()->user()->hasAnyPermission(['banks_edite'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $review = SiteReviews::find($id);
        $review->status = 1;
        $review->save();


        return redirect()->back()->with('success', 'تم نشر التقييم بنجاح'); 
    }

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Reject($id)
    {

        // if(!auth()->user()->hasAnyPermission(['banks_delete'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }

        $review = SiteReviews::find($id);
        $review->status = "2";
        $review->save();
   
        return redirect()->back()->with('success', 'تم رفض التقييم بنجاح');
    }
}
