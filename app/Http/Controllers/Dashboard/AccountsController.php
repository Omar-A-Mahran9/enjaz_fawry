<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Balance;
use App\Order_mo3amla;
use App\User;
use App\Withdrawal;
use App\Status;
use App\Setting;
use App\City;
use App\Order_estfsar;
use App\Order_ta3med;

use App\Exports\orderExport;
use Maatwebsite\Excel\Facades\Excel;

use Carbon\Carbon;



class AccountsController extends Controller
{
    //

    public function index()
    {
        // if(!auth()->user()->hasAnyPermission(['order_index'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // } 

           
        $setting = Setting::first();
        $city    = City::get();
      
        $orders_mo3amla = Order_mo3amla::where('closed', '=', 1)->where('status', '=', 5)->whereMonth('created_at', '=',  date('m'))->get();

        $m_total_enjaz = $orders_mo3amla->sum('m_enjazPrice');
        $m_total_gov = $orders_mo3amla->sum('m_processGovPrice');
        $m_total_thirdparty = $orders_mo3amla->sum('m_processThirdPartyPrice');
        $m_total_mo3amla = $orders_mo3amla->sum('price');

        $orders_estfsar = Order_estfsar::where('status', '=', 5)->whereMonth('created_at', '=',  date('m'))->get();
        $m_total_estfsar = $orders_estfsar->sum('price');

        $orders_ta3med = Order_ta3med::where('status', '=', 5)->whereMonth('created_at', '=',  date('m'))->get();
        $m_ta3med_price = $orders_ta3med->sum('ta3med_price');
        $m_ta3med_value = $orders_ta3med->sum('ta3med_value');
        $m_total_price = $orders_ta3med->sum('total_price');

        return view('dashboard.accounts.index', [
            'orders_mo3amla' => $orders_mo3amla, 
            'm_total_enjaz' => $m_total_enjaz, 
            'm_total_gov' => $m_total_gov, 
            'm_total_mo3amla' => $m_total_mo3amla, 
            'm_total_thirdparty' => $m_total_thirdparty, 

            'orders_estfsar' => $orders_estfsar,
            'm_total_estfsar' => $m_total_estfsar,

            'orders_ta3med' => $orders_ta3med,
            'm_ta3med_price' => $m_ta3med_price,
            'm_ta3med_value' => $m_ta3med_value,
            'm_total_price' => $m_total_price,
        
            ]);

    }


    public function indexDate(Request $r)
    {
        // if(!auth()->user()->hasAnyPermission(['order_index'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // } 

        $r->validate([
            'dateFrom' => ['required', 'date', 'before_or_equal:dateTo'],
            'dateTo' => ['required', 'date', 'after_or_equal:dateFrom'],
        ]);

           
        $setting = Setting::first();
        $city = City::get();


        if(!empty($r->dateFrom) && !empty($r->dateTo)){


           $from = Carbon::createFromFormat('Y-m-d', $r->dateFrom)->startOfDay();
           $to   = Carbon::createFromFormat('Y-m-d', $r->dateTo)->endOfDay();


        $orders_mo3amla = Order_mo3amla::where('closed', '=', 1)->where('status', '=', 5)->whereBetween('created_at', [$from, $to])->get();
        
        $m_total_enjaz = $orders_mo3amla->sum('m_enjazPrice');
        $m_total_gov = $orders_mo3amla->sum('m_processGovPrice');
        $m_total_thirdparty = $orders_mo3amla->sum('m_processThirdPartyPrice');
        $m_total_mo3amla = $orders_mo3amla->sum('price');

        $orders_estfsar = Order_estfsar::where('status', '=', 5)->whereBetween('created_at', [$from, $to])->get();
        $m_total_estfsar = $orders_estfsar->sum('price');

        $orders_ta3med = Order_ta3med::where('status', '=', 5)->whereBetween('created_at', [$from, $to])->get();
        $m_ta3med_price = $orders_ta3med->sum('ta3med_price');
        $m_ta3med_value = $orders_ta3med->sum('ta3med_value');
        $m_total_price = $orders_ta3med->sum('total_price');
        
          return view('dashboard.accounts.index', [
            'orders_mo3amla' => $orders_mo3amla, 
            'm_total_enjaz' => $m_total_enjaz, 
            'm_total_gov' => $m_total_gov, 
            'm_total_mo3amla' => $m_total_mo3amla, 
            
            'm_total_thirdparty' => $m_total_thirdparty, 
            'orders_estfsar' => $orders_estfsar,
            'm_total_estfsar' => $m_total_estfsar,

            'orders_ta3med' => $orders_ta3med,
            'm_ta3med_price' => $m_ta3med_price,
            'm_ta3med_value' => $m_ta3med_value,
            'm_total_price' => $m_total_price,
            'from' => $from,
            'to' => $to,
            ]);
        }
    }
    

    public function displayDate(Request $r)
    {
        // if(!auth()->user()->hasAnyPermission(['order_index'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // } 

        $r->validate([
            'type' => ['required'],
        ]);

        $setting = Setting::first();
        $city = City::get();

        if($r->type == "fromBegining"){

            // Where All
            $orderArray = [];
            $orders_mo3amla = Order_mo3amla::where('closed', '=', 1)->where('status', '=', 5)->get();
            $m_total_enjaz = $orders_mo3amla->sum('m_enjazPrice');
  
           foreach ($orders_mo3amla as $mo3amla) {

                $mo = [
                    'id' =>  $mo3amla->id, 
                    'type' =>  'mo3amla', 
                    'order_no' => $mo3amla->order_no,
                    'price_revenue' => $mo3amla->m_enjazPrice,
                    'price_thirdParty' =>  $mo3amla->m_processThirdPartyPrice,
                    'price_gov' =>  $mo3amla->m_processGovPrice,
                    'status' =>  $mo3amla->status, 
                    'date' =>  $mo3amla->created_at->format('d/m/Y'), 
                ];
                
                array_push($orderArray, $mo);
            }
        
            $orders_estfsar = Order_estfsar::where('status', '=', 5)->get();
            $m_total_estfsar = $orders_estfsar->sum('price');

            foreach ($orders_estfsar as $estfsar) {

                $es = [
                    'id' =>  $estfsar->id, 
                    'type' =>  'estfsar', 
                    'order_no' => $estfsar->order_no,
                    'price_revenue' => $mo3amla->price,
                    'price_thirdParty' =>  '--',
                    'price_gov' =>  '--',
                    'status' =>  $estfsar->status, 
                    'date' =>  $estfsar->created_at->format('d/m/Y'), 
                ];
                
                array_push($orderArray, $es);
            }

            $orders_ta3med = Order_ta3med::where('status', '=', 5)->get();
            $m_ta3med_price = $orders_ta3med->sum('ta3med_price');

            foreach ($orders_ta3med as $ta3med) {

                $t3 = [
                    'id' =>  $ta3med->id, 
                    'type' =>  'ta3med', 
                    'order_no' => $ta3med->order_no,
                    'price_revenue' => $ta3med->ta3med_price,
                    'price_thirdParty' => $ta3med->ta3med_value,
                    'price_gov' =>  '--',
                    'status' =>  $ta3med->status, 
                    'date' =>  $ta3med->created_at->format('d/m/Y'), 
                ];
                
                array_push($orderArray, $t3);
            }

            return view('dashboard.accounts.display_date', [
                'orders' => $orderArray, 
                'm_total_enjaz' => $m_total_enjaz, 
                'm_total_estfsar' => $m_total_estfsar,
                'orders_ta3med' => $orders_ta3med,
                'm_ta3med_price' => $m_ta3med_price,
                'dateTemplate' => 'fromBegining',
            ]);


        }elseif($r->type == "thisMonth"){

            // Where month
            // whereMonth('created_at', '=',  date('m'))

            $orderArray = [];

            $orders_mo3amla = Order_mo3amla::where('closed', '=', 1)->where('status', '=', 5)->whereMonth('created_at', '=',  date('m'))->get();

            $m_total_enjaz = $orders_mo3amla->sum('m_enjazPrice');

            foreach ($orders_mo3amla as $mo3amla) {

                $mo = [
                    'id' =>  $mo3amla->id, 
                    'type' =>  'mo3amla', 
                    'order_no' => $mo3amla->order_no,
                    'price_revenue' => $mo3amla->m_enjazPrice,
                    'price_thirdParty' =>  $mo3amla->m_processThirdPartyPrice,
                    'price_gov' =>  $mo3amla->m_processGovPrice,
                    'status' =>  $mo3amla->status, 
                    'date' =>  $mo3amla->created_at->format('d/m/Y'), 
                ];
                
                array_push($orderArray, $mo);
            }
        
            $orders_estfsar = Order_estfsar::where('status', '=', 5)->whereMonth('created_at', '=',  date('m'))->get();
            $m_total_estfsar = $orders_estfsar->sum('price');

            foreach ($orders_estfsar as $estfsar) {

                $es = [
                    'id' =>  $estfsar->id, 
                    'type' =>  'estfsar', 
                    'order_no' => $estfsar->order_no,
                    'price_revenue' => $estfsar->price,
                    'price_thirdParty' =>  '--',
                    'price_gov' =>  '--',
                    'status' =>  $estfsar->status, 
                    'date' =>  $estfsar->created_at->format('d/m/Y'), 
                ];
                
                array_push($orderArray, $es);
            }

            $orders_ta3med = Order_ta3med::where('status', '=', 5)->whereMonth('created_at', '=',  date('m'))->get();
            $m_ta3med_price = $orders_ta3med->sum('ta3med_price');

            foreach ($orders_ta3med as $ta3med) {

                $t3 = [
                    'id' =>  $ta3med->id, 
                    'type' =>  'ta3med', 
                    'order_no' => $ta3med->order_no,
                    'price_revenue' => $ta3med->ta3med_price,
                    'price_thirdParty' => $ta3med->ta3med_value,
                    'price_gov' =>  '--',
                    'status' =>  $ta3med->status, 
                    'date' =>  $ta3med->created_at->format('d/m/Y'), 
                ];
                
                array_push($orderArray, $t3);
            }

            return view('dashboard.accounts.display_date', [
                'orders' => $orderArray, 
                'm_total_enjaz' => $m_total_enjaz, 
                'm_total_estfsar' => $m_total_estfsar,
                'orders_ta3med' => $orders_ta3med,
                'm_ta3med_price' => $m_ta3med_price,
                'dateTemplate' => 'thisMonth',
            ]);

        }elseif($r->type == "fromTo"){
            // Where from to

            $from = Carbon::createFromFormat('Y-m-d', $r->from)->startOfDay();
            $to   = Carbon::createFromFormat('Y-m-d', $r->to)->endOfDay();

            $orderArray = [];

            $orders_mo3amla = Order_mo3amla::where('closed', '=', 1)->where('status', '=', 5)->whereBetween('created_at', [$from, $to])->get();
            $m_total_enjaz = $orders_mo3amla->sum('m_enjazPrice');

           foreach ($orders_mo3amla as $mo3amla) {

                $mo = [
                    'id' =>  $mo3amla->id, 
                    'type' =>  'mo3amla', 
                    'order_no' => $mo3amla->order_no,
                    'price_revenue' => $mo3amla->m_enjazPrice,
                    'price_thirdParty' =>  $mo3amla->m_processThirdPartyPrice,
                    'price_gov' =>  $mo3amla->m_processGovPrice,
                    'status' =>  $mo3amla->status, 
                    'date' =>  $mo3amla->created_at->format('d/m/Y'), 
                ];
                
                array_push($orderArray, $mo);
            }

            
            $orders_estfsar = Order_estfsar::where('status', '=', 5)->whereBetween('created_at', [$from, $to])->get();
            $m_total_estfsar = $orders_estfsar->sum('price');

            foreach ($orders_estfsar as $estfsar) {

                $es = [
                    'id' =>  $estfsar->id, 
                    'type' =>  'estfsar', 
                    'order_no' => $estfsar->order_no,
                    'price_revenue' => $estfsar->price,
                    'price_thirdParty' =>  '--',
                    'price_gov' =>  '--',
                    'status' =>  $estfsar->status, 
                    'date' =>  $estfsar->created_at->format('d/m/Y'), 
                ];
                
                array_push($orderArray, $es);
            }


            $orders_ta3med = Order_ta3med::where('status', '=', 5)->whereBetween('created_at', [$from, $to])->get();
            $m_ta3med_price = $orders_ta3med->sum('ta3med_price');

            foreach ($orders_ta3med as $ta3med) {

                $t3 = [
                    'id' =>  $ta3med->id, 
                    'type' =>  'ta3med', 
                    'order_no' => $ta3med->order_no,
                    'price_revenue' => $ta3med->ta3med_price,
                    'price_thirdParty' => $ta3med->ta3med_value,
                    'price_gov' =>  '--',
                    'status' =>  $ta3med->status, 
                    'date' =>  $ta3med->created_at->format('d/m/Y'), 
                ];
                
                array_push($orderArray, $t3);
            }

            return view('dashboard.accounts.display_date', [
                'orders' => $orderArray, 
                'm_total_enjaz' => $m_total_enjaz, 
                'm_total_estfsar' => $m_total_estfsar,
                'orders_ta3med' => $orders_ta3med,
                'm_ta3med_price' => $m_ta3med_price,
                'dateTemplate' => 'fromTo',
                'from' => $from,
                'to' => $to,
            ]);

        } 

    }



    public function exportExcel(Request $r)
    {
        // if(!auth()->user()->hasAnyPermission(['order_index'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // } 
        $r->validate([
            'type' => ['required'],
        ]);

        $setting = Setting::first();
        $city = City::get();

      
        if($r->type == "fromBegining"){

            // Where All

            $orderArray = [];

            $orders_mo3amla = Order_mo3amla::where('closed', '=', 1)->where('status', '=', 5)->get();
            $m_total_enjaz = $orders_mo3amla->sum('m_enjazPrice');
  

           foreach ($orders_mo3amla as $mo3amla) {

                $mo = [
                    'id' =>  $mo3amla->id, 
                    'type' =>  'معاملة', 
                    'order_no' => $mo3amla->order_no,
                    'price_revenue' => $mo3amla->m_enjazPrice,
                    'price_thirdParty' =>  $mo3amla->m_processThirdPartyPrice,
                    'price_gov' =>  $mo3amla->m_processGovPrice,
                    'status' => 'تم الانجاز', 
                    'date' =>  $mo3amla->created_at->format('d/m/Y'), 
                ];
                
                array_push($orderArray, $mo);
            }
        
            $orders_estfsar = Order_estfsar::where('status', '=', 5)->get();
            $m_total_estfsar = $orders_estfsar->sum('price');

            foreach ($orders_estfsar as $estfsar) {

                $es = [
                    'id' =>  $estfsar->id, 
                    'type' =>  'استفسار', 
                    'order_no' => $estfsar->order_no,
                    'price_revenue' => $estfsar->price,
                    'price_thirdParty' =>  '--',
                    'price_gov' =>  '--',
                    'status' => 'تم الانجاز', 
                    'date' =>  $estfsar->created_at->format('d/m/Y'), 
                ];
                
                array_push($orderArray, $es);
            }

            $orders_ta3med = Order_ta3med::where('status', '=', 5)->get();
            $m_ta3med_price = $orders_ta3med->sum('ta3med_price');

            foreach ($orders_ta3med as $ta3med) {

                $t3 = [
                    'id' =>  $ta3med->id, 
                    'type' =>  'تعميد', 
                    'order_no' => $ta3med->order_no,
                    'price_revenue' => $ta3med->ta3med_price,
                    'price_thirdParty' => $ta3med->ta3med_value,
                    'price_gov' =>  '--',
                    'status' => 'تم الانجاز', 
                    'date' =>  $ta3med->created_at->format('d/m/Y'), 
                ];
                
                array_push($orderArray, $t3);
            }



            $headings = [
                '#', 
                'النوع', 
                'رقم الطلب', 
                'ارباح إنجاز', 
                'تكلفة الطرف الثالث', 
                'الرسوم الحكومية', 
                'حالة الطلب', 
                'التاريخ', 
            ];

            return Excel::download(new orderExport($orderArray, $headings), 'orders-all.xlsx');

        }elseif($r->type == "thisMonth"){

            // Where month
            // whereMonth('created_at', '=',  date('m'))

            $orderArray = [];
            $orders_mo3amla = Order_mo3amla::where('closed', '=', 1)->where('status', '=', 5)->whereMonth('created_at', '=',  date('m'))->get();

            $m_total_enjaz = $orders_mo3amla->sum('m_enjazPrice');

            foreach ($orders_mo3amla as $mo3amla) {

                $mo = [
                    'id' =>  $mo3amla->id, 
                    'type' =>  'معاملة', 
                    'order_no' => $mo3amla->order_no,
                    'price_revenue' => $mo3amla->m_enjazPrice,
                    'price_thirdParty' =>  $mo3amla->m_processThirdPartyPrice,
                    'price_gov' =>  $mo3amla->m_processGovPrice,
                    'status' => 'تم الانجاز', 
                    'date' =>  $mo3amla->created_at->format('d/m/Y'), 
                ];
                
                array_push($orderArray, $mo);
            }
        
            $orders_estfsar = Order_estfsar::where('status', '=', 5)->whereMonth('created_at', '=',  date('m'))->get();
            $m_total_estfsar = $orders_estfsar->sum('price');

            foreach ($orders_estfsar as $estfsar) {

                $es = [
                    'id' =>  $estfsar->id, 
                    'type' =>  'استفسار', 
                    'order_no' => $estfsar->order_no,
                    'price_revenue' => $estfsar->price,
                    'price_thirdParty' =>  '--',
                    'price_gov' =>  '--',
                    'status' => 'تم الانجاز', 
                    'date' =>  $estfsar->created_at->format('d/m/Y'), 
                ];
                
                array_push($orderArray, $es);
            }

            $orders_ta3med = Order_ta3med::where('status', '=', 5)->whereMonth('created_at', '=',  date('m'))->get();
            $m_ta3med_price = $orders_ta3med->sum('ta3med_price');

            foreach ($orders_ta3med as $ta3med) {

                $t3 = [
                    'id' =>  $ta3med->id, 
                    'type' =>  'تعميد', 
                    'order_no' => $ta3med->order_no,
                    'price_revenue' => $ta3med->ta3med_price,
                    'price_thirdParty' => $ta3med->ta3med_value,
                    'price_gov' =>  '--',
                    'status' => 'تم الانجاز', 
                    'date' =>  $ta3med->created_at->format('d/m/Y'), 
                ];
                
                array_push($orderArray, $t3);
            }


            $headings = [
                '#', 
                'النوع', 
                'رقم الطلب', 
                'ارباح إنجاز', 
                'تكلفة الطرف الثالث', 
                'الرسوم الحكومية', 
                'حالة الطلب', 
                'التاريخ', 
            ];

            return Excel::download(new orderExport($orderArray, $headings), 'orders-thismonth.xlsx');


        }elseif($r->type == "fromTo"){
            // Where from to
            $from = Carbon::createFromFormat('Y-m-d', $r->from)->startOfDay();
            $to   = Carbon::createFromFormat('Y-m-d', $r->to)->endOfDay();

            $orderArray = [];
            $orders_mo3amla = Order_mo3amla::where('closed', '=', 1)->where('status', '=', 5)->whereBetween('created_at', [$from, $to])->get();
            $m_total_enjaz = $orders_mo3amla->sum('m_enjazPrice');

           foreach ($orders_mo3amla as $mo3amla) {

                $mo = [
                    'id' =>  $mo3amla->id, 
                    'type' =>  'معاملة', 
                    'order_no' => $mo3amla->order_no,
                    'price_revenue' => $mo3amla->m_enjazPrice,
                    'price_thirdParty' =>  $mo3amla->m_processThirdPartyPrice,
                    'price_gov' =>  $mo3amla->m_processGovPrice,
                    'status' => 'تم الانجاز', 
                    'date' =>  $mo3amla->created_at->format('d/m/Y'), 
                ];
                
                array_push($orderArray, $mo);
            }

            
            $orders_estfsar = Order_estfsar::where('status', '=', 5)->whereBetween('created_at', [$from, $to])->get();
            $m_total_estfsar = $orders_estfsar->sum('price');

            foreach ($orders_estfsar as $estfsar) {

                $es = [
                    'id' =>  $estfsar->id, 
                    'type' =>  'استفسار', 
                    'order_no' => $estfsar->order_no,
                    'price_revenue' => $estfsar->price,
                    'price_thirdParty' =>  '--',
                    'price_gov' =>  '--',
                    'status' => 'تم الانجاز', 
                    'date' =>  $estfsar->created_at->format('d/m/Y'), 
                ];
                
                array_push($orderArray, $es);
            }


            $orders_ta3med = Order_ta3med::where('status', '=', 5)->whereBetween('created_at', [$from, $to])->get();
            $m_ta3med_price = $orders_ta3med->sum('ta3med_price');

            foreach ($orders_ta3med as $ta3med) {

                $t3 = [
                    'id' =>  $ta3med->id, 
                    'type' =>  'تعميد', 
                    'order_no' => $ta3med->order_no,
                    'price_revenue' => $ta3med->ta3med_price,
                    'price_thirdParty' => $ta3med->ta3med_value,
                    'price_gov' =>  '--',
                    'status' => 'تم الانجاز', 
                    'date' =>  $ta3med->created_at->format('d/m/Y'), 
                ];
                
                array_push($orderArray, $t3);
            }

            $headings = [
                '#', 
                'النوع', 
                'رقم الطلب', 
                'ارباح إنجاز', 
                'تكلفة الطرف الثالث', 
                'الرسوم الحكومية', 
                'حالة الطلب', 
                'التاريخ', 
            ];
            return Excel::download(new orderExport($orderArray, $headings), 'orders-from-to.xlsx');
        } 

    }

    public function dateTemplate(Request $r)
    {
        // if(!auth()->user()->hasAnyPermission(['order_index'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // } 

        $r->validate([
            'dateTemplate' => ['required'],
        ]);

           
        if($r->dateTemplate == "today"){

       
            $from = Carbon::today()->startOfDay();
            $to   = Carbon::today()->endOfDay();

            $dateTemplate = 'today';


        }elseif ($r->dateTemplate == "yesterday") {

            $from = Carbon::yesterday()->startOfDay();
            $to   = Carbon::yesterday()->endOfDay();
            
            $dateTemplate = 'yesterday';

        }elseif ($r->dateTemplate == "lastWeek") {

            $now = Carbon::today()->startOfDay();
            $lastWeek = $now->subDays(7); 

            $thisDay = Carbon::today()->startOfDay();
            
            $from = $lastWeek;
            $to   = $thisDay;

            $dateTemplate = 'lastWeek';
            
        }elseif ($r->dateTemplate == "lastMonth") {
            
            $now = Carbon::today()->startOfDay();
            $lastMonth = $now->subDays(30); 

            $thisDay = Carbon::today()->startOfDay();

            $from = $lastMonth;
            $to   = $thisDay;   

            $dateTemplate = 'lastMonth';

        }elseif ($r->dateTemplate == "fromBegining") {
            
            $orders_mo3amla = Order_mo3amla::where('closed', '=', 1)->where('status', '=', 5)->get();

            $m_total_enjaz = $orders_mo3amla->sum('m_enjazPrice');
            $m_total_gov = $orders_mo3amla->sum('m_processGovPrice');
            $m_total_thirdparty = $orders_mo3amla->sum('m_processThirdPartyPrice');
            $m_total_mo3amla = $orders_mo3amla->sum('price');

            $orders_estfsar = Order_estfsar::where('status', '=', 5)->get();
            $m_total_estfsar = $orders_estfsar->sum('price');

            $orders_ta3med = Order_ta3med::where('status', '=', 5)->get();
            $m_ta3med_price = $orders_ta3med->sum('ta3med_price');
            $m_ta3med_value = $orders_ta3med->sum('ta3med_value');
            $m_total_price = $orders_ta3med->sum('total_price');
            
            return view('dashboard.accounts.index', [
                'orders_mo3amla' => $orders_mo3amla, 
                'm_total_enjaz' => $m_total_enjaz, 
                'm_total_gov' => $m_total_gov, 
                'm_total_mo3amla' => $m_total_mo3amla, 
                
                'm_total_thirdparty' => $m_total_thirdparty, 
                'orders_estfsar' => $orders_estfsar,
                'm_total_estfsar' => $m_total_estfsar,

                'orders_ta3med' => $orders_ta3med,
                'm_ta3med_price' => $m_ta3med_price,
                'm_ta3med_value' => $m_ta3med_value,
                'm_total_price' => $m_total_price,
                'dateTemplate'=> 'fromBegining',
            ]);
        }else {
            abort(404);
        }

            $orders_mo3amla = Order_mo3amla::where('closed', '=', 1)->where('status', '=', 5)->whereBetween('created_at', [$from, $to])->get();

            $m_total_enjaz = $orders_mo3amla->sum('m_enjazPrice');
            $m_total_gov = $orders_mo3amla->sum('m_processGovPrice');
            $m_total_thirdparty = $orders_mo3amla->sum('m_processThirdPartyPrice');
            $m_total_mo3amla = $orders_mo3amla->sum('price');
        
            $orders_estfsar = Order_estfsar::where('status', '=', 5)->whereBetween('created_at', [$from, $to])->get();
            $m_total_estfsar = $orders_estfsar->sum('price');

            $orders_ta3med = Order_ta3med::where('status', '=', 5)->whereBetween('created_at', [$from, $to])->get();
            $m_ta3med_price = $orders_ta3med->sum('ta3med_price');
            $m_ta3med_value = $orders_ta3med->sum('ta3med_value');
            $m_total_price = $orders_ta3med->sum('total_price');
            
            return view('dashboard.accounts.index', [
                'orders_mo3amla' => $orders_mo3amla, 
                'm_total_enjaz' => $m_total_enjaz, 
                'm_total_gov' => $m_total_gov, 
                'm_total_mo3amla' => $m_total_mo3amla, 
                
                'm_total_thirdparty' => $m_total_thirdparty, 
                'orders_estfsar' => $orders_estfsar,
                'm_total_estfsar' => $m_total_estfsar,

                'orders_ta3med' => $orders_ta3med,
                'm_ta3med_price' => $m_ta3med_price,
                'm_ta3med_value' => $m_ta3med_value,
                'm_total_price' => $m_total_price,
                'from' => $from,
                'to' => $to,
                'dateTemplate'=> $dateTemplate,
                ]);

    }

    
    public function balanceIndex()
    {

        $setting = Setting::first();
        $city = City::get();
        $balance = Balance::latest()->paginate($setting->paginate);
        $orders = Order_mo3amla::latest()->paginate($setting->paginate);
        return view('dashboard.accounts.balance_index', ['orders' => $orders, 'balances' => $balance, 'city'=>$city]);

    }

    public function withdrawIndex()
    {

        $setting = Setting::first();
        $witdraws = Withdrawal::where('status','=','-1')->latest()->paginate($setting->paginate);
        $orders = Order_mo3amla::latest()->paginate($setting->paginate);
        return view('dashboard.accounts.withdraw_index', ['orders' => $orders, 'witdraws' => $witdraws]);

    }

    public function withdrawArchive()
    {

        $setting = Setting::first();
     
        $witdraws = Withdrawal::whereIn('status', [1,0])->latest()->paginate($setting->paginate);
        $orders = Order_mo3amla::latest()->paginate($setting->paginate);
        return view('dashboard.accounts.withdraw_archive', ['orders' => $orders, 'witdraws' => $witdraws]);

    }

    public function statementIndex()
    {


    }


    public function balanceShow($id)
    {


    }


    public function withdrawShow($id)
    {

        $withdraw = Withdrawal::find($id);
        return view('dashboard.accounts.withdraw_show', ['withdraw' => $withdraw]);

    }


    public function withdrawUpdate(Request $r, $id)
    {

        $r->validate([
            'status' => ['required'],
            'withdrawId' => ['required'],
        ]);

        if($r->withdrawId != $id){

            abort(403);

        }else{

            $withdraw = Withdrawal::find($id);

            if($r->status == '0'){

                $r->validate([
                    'reject_reason' => ['required', 'string'],
                ]);

                $withdraw->description = $r->reject_reason;

            }elseif($r->status == '1'){

                $r->validate([
                    'transfer_prove' =>  ['required','mimes:jpeg,JPEG,png,PNG,jpg,JPG,pdf,PDF'],
                ]);

                if( $r->hasFile('transfer_prove')){

                    //file upload and check
                    $fileExt              = $r->transfer_prove->getClientOriginalExtension();
                    $fileIdNameNew        = uniqid() . time() . '.' . $fileExt;
                    $r->transfer_prove->storeAs('public/transfer_prove', $fileIdNameNew);

                    $withdraw->transfer_prove =  $fileIdNameNew;
                
                } 

            }

            $balance =  $withdraw->balance;

            foreach($balance as $b){

                $b->status = $r->status;

                if($r->status == '0'){

                    $b->description = $r->reject_reason;
                }
                $b->save();
            }

            $withdraw->status = $r->status;
            $withdraw->save();

            return redirect()->back()->with('success', 'تم الارسال بنجاح'); 

        }
    }
}