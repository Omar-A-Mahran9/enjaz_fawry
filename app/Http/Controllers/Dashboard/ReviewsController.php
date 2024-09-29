<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Review;
use App\Setting;

class ReviewsController extends Controller
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
        $reviews = Review::latest()->paginate($setting->paginate);
        return view('dashboard.reviews.index', ['reviews' => $reviews]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(!auth()->user()->hasAnyPermission(['banks_create'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        return view('dashboard.review.create');
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
        $review = Review::find($id);
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

        $review = Review::find($id);
        $review->status = "0";
        $review->save();
   
        return redirect()->route('dashboard.reviews.index')->with('success', 'تم حذف التقييم بنجاح');
    }
}
