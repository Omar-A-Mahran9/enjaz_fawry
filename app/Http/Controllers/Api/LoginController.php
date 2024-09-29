<?php

namespace App\Http\Controllers\Api;

use App\User;

use App\Setting;
use App\SentSms;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Mail;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
   // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
      //  $this->middleware('guest:client');

    }

    
    public function login(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'digits:10','min:10','max:10', 'regex:/^[0-9]+$/'],
            'password' => 'required|string',
            'remember_me' => 'boolean',
            'firebase_token' => 'required',
        ]);

        $credentials = ['phone' => $request->phone, 'password' => $request->password];
        if(!Auth::attempt($credentials))
            return response()->json([
                'status' => 0,
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $user->firebase_token = $request->firebase_token;
        $user->save();
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(6);
        $token->save();
        return response()->json([
            'status' => 1,
            'msg' => 'تم التحقق بنجاح',
            'type' => $user->type,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse( $tokenResult->token->expires_at )->toDateTimeString(),
            'id' => $request->user()->id,
            'phone_status' => $user->phone_status,
            'phone' => $request->user()->phone,
            'user_type' =>  $user->type,
        ]);
        
    }
       

    

   
}
