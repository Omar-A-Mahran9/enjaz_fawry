<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog;
use App\Setting;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(!auth()->user()->hasAnyPermission(['blog_index'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $setting = Setting::first();
        $posts = Blog::latest()->paginate($setting->paginate);
        return view('dashboard.blog.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(!auth()->user()->hasAnyPermission(['blog_create'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        return view('dashboard.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        // if(!auth()->user()->hasAnyPermission(['blog_create'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $r->validate([
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
            // 'type' => ['required'],
            // 'lang' => ['required'],
            'status' => ['required'],


        ]);
        
        $post = new Blog;
        $post->title = $r->title;
        $post->body = $r->body;
        $post->type = 1;
        // $post->lang = $r->lang;
        $post->meta_keyword = $r->meta_keyword;
        $post->meta_desc = $r->meta_desc;
        $post->status = $r->status;

        // 
        // $fileExt            = $r->main_image->getClientOriginalExtension();
        // $fileNameNew        = uniqid() . time() . '.' . $fileExt;
        // $r->main_image->storeAs('public/blog', $fileNameNew);
        // $post->main_image = $fileNameNew;
        // 

        $post->save();

        return redirect()->route('dashboard.blog.index')->with('success', 'تم اضافة التدوينة بنجاح'); 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if(!auth()->user()->hasAnyPermission(['blog_edite'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $post = Blog::find($id);
        return view('dashboard.blog.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        // if(!auth()->user()->hasAnyPermission(['blog_edite'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $r->validate([
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
           
            'status' => ['required'],

        ]);
        
        $post = Blog::find($id);
        $post->title = $r->title;
        $post->body = $r->body;
        $post->type = 1;
        // $post->lang = $r->lang;
        $post->meta_keyword = $r->meta_keyword;
        $post->meta_desc = $r->meta_desc;
        $post->status = $r->status;

        // if($r->hasFile('main_image')) {
        //     $fileExt            = $r->main_image->getClientOriginalExtension();
        //     $fileNameNew        = uniqid() . time() . '.' . $fileExt;
        //     $r->main_image->storeAs('public/blog', $fileNameNew);
        //     $post->main_image = $fileNameNew;
        // }


        $post->save();
        return redirect()->back()->with('success', 'تم تعديل التدوينة بنجاح');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if(!auth()->user()->hasAnyPermission(['blog_delete'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $post = Blog::find($id);
        $post->delete();
        return redirect()->route('dashboard.blog.index')->with('success', 'تم حذف التدوينة بنجاح');
    }
}
