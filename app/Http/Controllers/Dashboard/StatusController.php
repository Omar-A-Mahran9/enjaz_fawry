<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Status;
use App\Setting;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(!auth()->user()->hasAnyPermission(['status_index'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // }
        $setting = Setting::first();
        $Status = Status::latest()->paginate($setting->paginate);
        return view('dashboard.status.index', ['Status' => $Status]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(!auth()->user()->hasAnyPermission(['status_create'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // }
        return view('dashboard.status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        // if(!auth()->user()->hasAnyPermission(['status_create'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // }
        $r->validate([
            'name' => ['required'],
            'sms' => ['required'],
            'action' => ['required'],
        ]);

        $status = new Status;
        $status->name = $r->name;
        $status->sms = $r->sms;
        $status->needAction = $r->action;
        if($r->sms == 1){
            if($r->sms_text == null){
                return redirect()->back()->with('error', 'لم تضف نص الرسالة');
            }
            $status->sms_text = $r->sms_text;
        }
        
        $status->save();
        return redirect()->route('dashboard.status.index')->with('success', 'تم اضافة الحالة بنجاح'); 

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
        // if(!auth()->user()->hasAnyPermission(['status_edite'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // }
        $status = Status::find($id);
        return view('dashboard.status.edit', ['status' => $status]);
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
        // if(!auth()->user()->hasAnyPermission(['status_edite'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // }
        $r->validate([
            'name' => ['required'],
            'sms' => ['required'],
            'action' => ['required'],
        ]);

        $status = Status::find($id);
        $status->name = $r->name;
        $status->sms = $r->sms;
        $status->needAction = $r->action;
        if($r->sms == 1){
            if($r->sms_text == null){
                return redirect()->back()->with('error', 'لم تضف نص الرسالة');
            }
            $status->sms_text = $r->sms_text;
        }else{
            $status->sms_text = null;
        }

        $status->save();
        return redirect()->back()->with('success', 'تم تعديل الحالة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if(!auth()->user()->hasAnyPermission(['status_delete'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // }
        $status = Status::find($id);
        $status->delete();
        return redirect()->route('dashboard.status.index')->with('success', 'تم حذف الحالة بنجاح');

    }
}