<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Bank;
use App\Setting;

class BankController extends Controller
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
        $banks = Bank::latest()->paginate($setting->paginate);
        return view('dashboard.banks.index', ['banks' => $banks]);
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
        return view('dashboard.banks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        // if(!auth()->user()->hasAnyPermission(['banks_create'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $r->validate([
            'name' => ['required', 'string'],
            'accountName' => ['required', 'string'],
            'accountNo' => ['required', 'string'],
            'accountIban' => ['required', 'string'],
        ]);

        $bank = new Bank;
        
        $bank->name = $r->name;
        $bank->accountName = $r->accountName;
        $bank->accountNo = $r->accountNo;
        $bank->accountIban = $r->accountIban;
      
        $bank->save();
        return redirect()->route('dashboard.banks.index')->with('success', 'تم اضافة البنك بنجاح');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if(!auth()->user()->hasAnyPermission(['banks_edite'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $bank = Bank::find($id);
        return view('dashboard.banks.edit', ['bank' => $bank]);
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
        // if(!auth()->user()->hasAnyPermission(['banks_edite'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // }
        $r->validate([
            'name' => ['required', 'string'],
            'accountName' => ['required', 'string'],
            'accountNo' => ['required', 'string'],
            'accountIban' => ['required', 'string'],
        ]);

        $bank = Bank::find($id);
        
        $bank->name = $r->name;
        $bank->accountName = $r->accountName;
        $bank->accountNo = $r->accountNo;
        $bank->accountIban = $r->accountIban;

    

        $bank->save();
        return redirect()->back()->with('success', 'تم تعديل البنك بنجاح'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if(!auth()->user()->hasAnyPermission(['banks_delete'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $bank = Bank::find($id);
        $bank->delete();
        return redirect()->route('dashboard.banks.index')->with('success', 'تم حذف البنك بنجاح');
    }
}
