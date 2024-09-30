<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Email;
use App\Setting;

use App\Exports\MailListExport;
use Maatwebsite\Excel\Facades\Excel;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();
        $emails = Email::latest()->paginate($setting->paginate);
        return view('dashboard.email.index', ['emails' => $emails]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.email.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $r->validate([
            'title' => ['required', 'string', 'max:90'],
            'content' => ['required', 'string', 'max:255'],
        ]);

        $email = new Email;
        $email->title = $r->title;
        $email->content = $r->content;
        $email->save();

        return redirect()->route('dashboard.email.index')->with('success', 'تم اضافة البريد بنجاح'); 


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $email = Email::find($id);
        return view('dashboard.email.edit', ['email' => $email]);
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
        $r->validate([
            'title' => ['required', 'string', 'max:90'],
            'content' => ['required', 'string', 'max:255'],
        ]);

        $email = Email::find($id);
        $email->title = $r->title;
        $email->content = $r->content;
        $email->save();

        return redirect()->back()->with('success', 'تم تعديل البريد بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $email = Email::find($id);
        $email->delete();
        return redirect()->route('dashboard.email.index')->with('success', 'تم حذف االبريد بنجاح');
    }

    public function export() 
    {
        return Excel::download(new MailListExport, 'emails.xlsx');
    }


}
