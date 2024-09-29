<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Auth;
use Lang;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/client_dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
       // $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
          return view('engazFawry.login', [
            'pagetitle' => __('engazFawry.login')
        ]);

        
    }

    // public function showClientLoginForm()
    // {
    //       return view('engazFawry.login', [
    //         'pagetitle' => __('engazFawry.login')
    //     ]);
    // }

    // protected function createClient(Request $request)
    // {
    //     $this->validator($request->all())->validate();
    //     $admin = Admin::create([
    //         'name' => $request['name'],
    //         'email' => $request['email'],
    //         'password' => Hash::make($request['password']),
    //     ]);
    //     return redirect()->intended('/login');
    // }

    public function login(Request $request)
    {
        $validator = $this->validate($request, [
            'phone'   => 'required',
            'password' => 'required|min:6'
        ]);

        // if($validator->fails()) {
        //     return Redirect::back()->withErrors($validator);
        // }

        

        if (Auth::guard('web')->attempt(['phone' => $request->phone, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/client_panel');
        }
        return back()->withInput($request->only('phone', 'remember'))->withErrors([
            'phone' => ['رقم الجوال المدخل غير صحيح'],
            'password' => ['كلمة المرور غير صحيحة'],

        ]);

     //  dd($validator);
        //return back()->withInput($request->only('email', 'remember') );


    }

    public function logout(){

        Auth::guard('web')->logout();
        return redirect('/');
    }

    // protected function sendFailedLoginResponse(Request $request)
    //     {
    //         return redirect()->to('/login')
    //             ->withInput($request->only($this->username(), 'remember'))
    //             ->withErrors([
    //                 $this->username() => Lang::get('auth.failed'),
    //             ]);
    //     }

    // public function phone()
    // {
    //     return 'phone';
    // }

    // public function username()
    // {
    //     return 'phone';
    // }

    public function username()
    {
        return 'phone';
    }
}
