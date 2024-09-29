<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Email;
use App\EmailSender;
use App\Setting;

class EmailSenderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();
        $emails = EmailSender::latest()->paginate($setting->paginate);
        return view('dashboard.email.sender_index', ['emails' => $emails]);
    }

    public function form(Request $r)
    {
        $emails = Email::get(['id', 'title']);
        return view('dashboard.email.form', ['emails' => $emails]);
    }

    public function send(Request $r)
    {

        if ($r->email_id == null ) {
            if ($r->title  == null || $r->content == null) {
                return redirect()->back()->with('error', 'لم تقوم بتحديد عنوان البريد او محتواه');
            }
            $content = $r->content; 
            $title = $r->title; 
        } else {
            $email = Email::find($r->email_id);
            $content = $email->content;
            $title = $email->title;
        }

        $send = new EmailSender;
        $send->content = $content;
        $send->title = $title;

        $send->save();

        return redirect()->route('dashboard.emailSender.index')->with('success', 'تم ارسال البريد بنجاح'); 
    }
}
