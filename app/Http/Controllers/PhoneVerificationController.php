<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Client;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;

class PhoneVerificationController extends Controller
{
    //
    
     public function show(Request $request)
    {

        $user = Auth::user();
        $id = Auth::id();


        dd(Auth::id());
        return $request->client()->hasVerifiedPhone()
                        ? redirect()->route('home')
                        : view('verifyphone');
    }

    public function verify(Request $request)
    {
        if ($request->client()->verification_code !== $request->code) {
            throw ValidationException::withMessages([
                'code' => ['الكود خاطئ. برجاء المحاولة مججدا أو طلب مكالمة جديدة.'],
            ]);
        }

        if ($request->client()->hasVerifiedPhone()) {
            return redirect()->route('home');
        }

        $request->client()->markPhoneAsVerified();

        return redirect()->route('home')->with('status', 'تم تفعيل الهاتف بنجاح!');
    }
}
