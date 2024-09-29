<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Terms;
use App\User;
use App\Bank;
use App\Order_ta3med;
use App\Order_mo3amla;
use App\Order_estfsar;
use App\Order_guarante;


use Auth;

class AllOrdersController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyPhone', ['except' => ['verify_form', 'verifyphone'] ]);
    }


    public function index()
    {



        $user = User::find(auth()->user()->id);

        $notify= $user->processMo3ala->where('status','=','-1')->count();

        $order_ta3med = $user->ta3med_orders->whereIn('status', ['0','-1']);
        $order_ta3med_count = $user->ta3med_orders->count();

        $order_estfsar = $user->estfsar_orders->whereIn('status', ['0','-1']);
        $order_estfsar_count = $user->estfsar_orders->count();

        $order_mo3amla = $user->mo3amla_orders->whereIn('status', ['0','-1']);

        $order_guarante = $user->guarante_orders->whereIn('status', ['0','-1']);
        $order_mo3amla_count = $user->mo3amla_orders->count();


        $allOrders =[];

        foreach ($order_mo3amla as $mo3amla) {

            $mo = [
                'id' =>  $mo3amla->id, 
                'type' =>  'mo3amla', 
                'order_no' => $mo3amla->order_no,
                'status' =>  $mo3amla->status, 
                'date' =>  $mo3amla->created_at->format('d/m/Y'), 
                'processing_id' => $mo3amla->processing_id,
            ];
            
            array_push($allOrders, $mo);
        }


        foreach ($order_guarante as $guarante) {

            $gu = [
                'id' =>  $guarante->id, 
                'type' =>  'guarante', 
                'order_no' => $guarante->order_no,
                'status' =>  $guarante->status, 
                'date' =>  $guarante->created_at->format('d/m/Y'), 
                'processing_id' => $guarante->processing_id,
            ];
            
            array_push($allOrders, $gu);
        }

        foreach ($order_estfsar as $estfsar) {

            $es = [
                'id' =>  $estfsar->id, 
                'type' =>  'estfsar', 
                'order_no' => $estfsar->order_no,
                'status' =>  $estfsar->status, 
                'date' =>  $estfsar->created_at->format('d/m/Y'), 
                'processing_id' => $estfsar->processing_id,

            ];
            
            array_push($allOrders, $es);
        }

        foreach ($order_ta3med as $ta3med) {

            $t3 = [
                'id' =>  $ta3med->id, 
                'type' =>  'ta3med', 
                'order_no' => $ta3med->order_no,
                'status' =>  $ta3med->status, 
                'date' =>  $ta3med->created_at->format('d/m/Y'), 
                'processing_id' => $ta3med->processing_id,

            ];
            
            array_push($allOrders, $t3);
        }



        return view('engazFawry.dashboard.index_NewOrders', [
            'pagetitle' => __('index_ta3med'),
            'orders' =>  $allOrders,
            'user' =>  $user ,
            'notify' =>  $notify ,
        ]);
    }




    public function onProcess()
    {

        $user = User::find(auth()->user()->id);

        $notify= $user->processMo3ala->where('status','=','-1')->count();

        $order_ta3med = $user->ta3med_orders->whereIn('status', ['1','2','3','-4','-3']);
        $order_ta3med_count = $user->ta3med_orders->count();

        $order_estfsar = $user->estfsar_orders->whereIn('status', ['1','2','3','-4','-3']);
        $order_estfsar_count = $user->estfsar_orders->count();

        $order_mo3amla = $user->mo3amla_orders->whereIn('status', ['1','2','3','-4','-3']);
        $order_guarante = $user->guarante_orders->whereIn('status', ['1','2','3','-4','-3']);

        $order_mo3amla_count = $user->mo3amla_orders->count();


        $allOrders =[];

        foreach ($order_mo3amla as $mo3amla) {

            $mo = [
                'id' =>  $mo3amla->id, 
                'type' =>  'mo3amla', 
                'order_no' => $mo3amla->order_no,
                'status' =>  $mo3amla->status, 
                'date' =>  $mo3amla->created_at->format('d/m/Y'), 
                'processing_id' => $mo3amla->processing_id,
            ];
            
            array_push($allOrders, $mo);
        }

        foreach ($order_guarante as $guarante) {

            $gu = [
                'id' =>  $guarante->id, 
                'type' =>  'guarante', 
                'order_no' => $guarante->order_no,
                'status' =>  $guarante->status, 
                'date' =>  $guarante->created_at->format('d/m/Y'), 
                'processing_id' => $guarante->processing_id,
            ];
            
            array_push($allOrders, $gu);
        }

        foreach ($order_estfsar as $estfsar) {

            $es = [
                'id' =>  $estfsar->id, 
                'type' =>  'estfsar', 
                'order_no' => $estfsar->order_no,
                'status' =>  $estfsar->status, 
                'date' =>  $estfsar->created_at->format('d/m/Y'), 
                'processing_id' => $estfsar->processing_id,

            ];
            
            array_push($allOrders, $es);
        }

        foreach ($order_ta3med as $ta3med) {

            $t3 = [
                'id' =>  $ta3med->id, 
                'type' =>  'ta3med', 
                'order_no' => $ta3med->order_no,
                'status' =>  $ta3med->status, 
                'date' =>  $ta3med->created_at->format('d/m/Y'), 
                'processing_id' => $ta3med->processing_id,

            ];
            
            array_push($allOrders, $t3);
        }



        return view('engazFawry.dashboard.index_OnProcessOrders', [
            'pagetitle' => __('index_OnProcessOrders'),
            'orders' =>  $allOrders,
            'user' =>  $user ,
            'notify' =>  $notify ,
        ]);
    }







    public function finished()
    {

        $user = User::find(auth()->user()->id);

        $notify= $user->processMo3ala->where('status','=','-1')->count();

        $order_ta3med = $user->ta3med_orders->whereIn('status', ['4','5']);
        $order_ta3med_count = $user->ta3med_orders->count();

        $order_estfsar = $user->estfsar_orders->whereIn('status', ['4','5']);
        $order_estfsar_count = $user->estfsar_orders->count();

        $order_mo3amla = $user->mo3amla_orders->whereIn('status', ['4','5']);
        $order_guarante = $user->guarante_orders->whereIn('status', ['4','5']);
        $order_mo3amla_count = $user->mo3amla_orders->count();


        $allOrders =[];

        foreach ($order_mo3amla as $mo3amla) {

            $mo = [
                'id' =>  $mo3amla->id, 
                'type' =>  'mo3amla', 
                'order_no' => $mo3amla->order_no,
                'status' =>  $mo3amla->status, 
                'date' =>  $mo3amla->created_at->format('d/m/Y'), 
                'processing_id' => $mo3amla->processing_id,
            ];
            
            array_push($allOrders, $mo);
        }

        foreach ($order_guarante as $guarante) {

            $gu = [
                'id' =>  $guarante->id, 
                'type' =>  'guarante', 
                'order_no' => $guarante->order_no,
                'status' =>  $guarante->status, 
                'date' =>  $guarante->created_at->format('d/m/Y'), 
                'processing_id' => $guarante->processing_id,
            ];
            
            array_push($allOrders, $gu);
        }

        foreach ($order_estfsar as $estfsar) {

            $es = [
                'id' =>  $estfsar->id, 
                'type' =>  'estfsar', 
                'order_no' => $estfsar->order_no,
                'status' =>  $estfsar->status, 
                'date' =>  $estfsar->created_at->format('d/m/Y'), 
                'processing_id' => $estfsar->processing_id,

            ];
            
            array_push($allOrders, $es);
        }

        foreach ($order_ta3med as $ta3med) {

            $t3 = [
                'id' =>  $ta3med->id, 
                'type' =>  'ta3med', 
                'order_no' => $ta3med->order_no,
                'status' =>  $ta3med->status, 
                'date' =>  $ta3med->created_at->format('d/m/Y'), 
                'processing_id' => $ta3med->processing_id,

            ];
            
            array_push($allOrders, $t3);
        }



        return view('engazFawry.dashboard.index_FinishedOrders', [
            'pagetitle' => __('index_OnProcessOrders'),
            'orders' =>  $allOrders,
            'user'   =>  $user ,
            'notify' =>  $notify ,
            
        ]);
    }
}