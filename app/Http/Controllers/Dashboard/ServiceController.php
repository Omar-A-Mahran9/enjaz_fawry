<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
// use App\CarBrand;
use App\Setting;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(!auth()->user()->hasAnyPermission(['model_index'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $setting = Setting::first();
        $services =Service::latest()->paginate($setting->paginate);
        return view('dashboard.service.index', ['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(!auth()->user()->hasAnyPermission(['model_create'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        return view('dashboard.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        // if(!auth()->user()->hasAnyPermission(['model_create'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $r->validate([
            'name' => ['required', 'string'],
        ]);
        $service = new Service;
        $service->name = $r->name;
       
        $service->save();
        return redirect()->route('dashboard.service.index')->with('success', 'تم اضافة الخدمة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if(!auth()->user()->hasAnyPermission(['model_edite'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $service = Service::find($id);
        return view('dashboard.service.edit', [ 'service' => $service]);
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
        // if(!auth()->user()->hasAnyPermission(['model_edite'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $r->validate([
            'name' => ['required', 'string'],
        ]);
        $service = Service::find($id);
        $service->name = $r->name;
    
        $service->save();
        return redirect()->back()->with('success', 'تم تعديل الخدمة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if(!auth()->user()->hasAnyPermission(['model_delete'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $service = Service::find($id);
        $service->delete();
        return redirect()->route('dashboard.service.index')->with('success', 'تم حذف الخدمة التجارية بنجاح');
    }
}