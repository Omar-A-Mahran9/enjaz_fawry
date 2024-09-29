<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
 use Illuminate\Http\Request;
//use User;
//use App\User;
// use App\User;
//use App\Models\User;
use \App\User;

class PhoneVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

            if ( Auth::check('web') ){
                $user = Auth::user();
              //  $uss = new \App\User;
              // dd($user);
                $user = User::find($user->id);
                $phoneStatus = $user->phone_status;

                //if($phoneStatus == 1 || !is_null($phoneStatus)){
                if($phoneStatus == 1 && !is_null($phoneStatus)){
                     return $next($request);
                }else{
                   // return redirect()->route('verifyphone');
                  //  return view('engazFawry.verifyphone')->with('user',Auth::user());


                  if ($request->isMethod('post') && $request->has(['code'])) {
                       return $next($request);
                    }else{

                        return response()->view('engazFawry.verifyphone');
                    }  

                }
            }else{
  //return $next($request);

            }
            // elseif(){

            // }

        
        return $next($request);
    }
}
