<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

class ProfileController extends Controller
{
    
    public function show()
    {
        $user = User::find(auth()->user()->id);
        return view('dashboard.profile.show', ['user' => $user]);

    }

    public function update(Request $r)
    {
        $r->validate([
            'name' => ['required', 'string', 'max:90'],
            'email' => ['required', 'string', 'email', 'max:90', 'unique:users,email,' .auth()->user()->id],
            'password' => ['required', 'string'],
        ]);

        $user = User::find(auth()->user()->id);
        if (Hash::check($r->password, $user->password)) {
            $user->name = $r->name;
            $user->email = $r->email;
            $user->save();
            return redirect()->back()->with('success', 'success');
        }
        return redirect()->back()->with('error', 'password not valied');
        
    }

    public function changePassword(Request $r)
    {
        $r->validate([
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'current_pass' => ['required', 'string'],
        ]);

        
        $user = User::find(auth()->user()->id);

        if(Hash::check($r->current_pass, $user->password)){
            $user->password = Hash::make($r->password);
            $user->save();
            return redirect()->back()->with('success', 'success');
        }
        
        return redirect()->back()->with('error', 'password not valied');
    }

}
