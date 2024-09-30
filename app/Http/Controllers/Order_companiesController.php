<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Order_companies;


class Order_companiesController extends Controller
{
    public function index()
    {
        $user = Auth::user();

       $cities = City::all();
        return view('engazFawry.form4', [
            'pagetitle' => __('engazFawry.form4'),
            'user' => $user,
            'cities' =>  $cities
        ]);
    }

    public function order_companies_form(Request $r)
    {
        $r->validate([
            'name' => ['required'],            
            'phone' => ['required', 'regex:/[+0-9]/','min:10'],
            'city_id' => ['required'],
            'type' => ['required'],
            'service' => ['required'],
        ]); 

        $order = new Order_companies;
        $order->name = $r->name;
        $order->phone = $r->phone;
        $order->city_id = $r->city;
        $order->type = $r->type;
        $order->service = $r->service;

        $order->save();

        $insertedId = $order->id;

        $order->order_no = "C-".($insertedId+100);
        $order->save();
        
        return redirect(route('/sharkat'));       
    }
}