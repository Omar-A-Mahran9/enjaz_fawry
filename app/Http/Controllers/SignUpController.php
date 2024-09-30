<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
 //use App\FrontEndHome;
use App\Setting;
use App\Client;
use Illuminate\Support\Facades\Auth;



class SignUpController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function doLogout()
    {
        Auth::logout(); // log the user out of our application
        return Redirect::to('login'); // redirect the user to the login screen
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
       
        return view('engazFawry.signup', [
            'pagetitle' => __('engazFawry.signup')
        ]);
    }

    protected function registered(Request $request, User $user)
    {
        $user->callToVerify();
        return redirect($this->redirectPath());
    }

    public function signup_form(Request $r)
    {
        $r->validate([
            'name' => ['required'],
            'phone' => ['required', 'regex:/[+0-9]/','min:10'],
            'email' => ['required', 'email:rfc,dns'],
            'password' => ['required', 'min:6', 'string','confirmed'],
            'approve' => ['required'],
        ]); 

        $client = new Client;
        $client->name = $r->name;
        $client->phone = $r->phone;
        $client->email = $r->email;
        $client->password = Hash::make($r->password);

        $client->save();

        $cid = $client->id;

        Auth::loginUsingId($cid);

        return redirect(route('phoneverification.notice'));
       
    }

}
