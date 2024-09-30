<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Order_ta3med;
use App\Order_mo3amla;
use App\Order_estfsar;
use App\Status;
use App\Mo3amlaProcessing;
use App\Order_sharkat;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class SearchController extends Controller
{


    public function search(Request $r)
    {
        // if(!auth()->user()->hasAnyPermission(['order_index'])){
        //     return redirect()->back()->with('success', 'عفواً لا تملك الصلاحية');
        // }

        $r->validate([
            'search' => ['required', 'regex:/[(m|t|e|c|M|T|E|C)]+-+[0-9]/'],
        ]);

        $statuses = Status::get();
       
        $str = explode("-", $r->search);

        if( $str[0] == 'm' || $str[0] == 'M'){

            $order = Order_mo3amla::where('order_no', '=' ,$r->search)->first();

            if($order){
                if($order->count() > 0 ){

                    $process = Mo3amlaProcessing::where('mo3amla_id', $order->id)->get();

                    return view('dashboard.orders.show_mo3amla', ['order' => $order, 'statuses' => $statuses, 'process' => $process]);
                }else{

                    return redirect()->back()->withErrors(['field' => 'الرقم المدخل غير موجود']);
                }
            }else{

                return redirect()->back()->withErrors(['field' => 'الرقم المدخل غير موجود']);
            }


        }elseif ($str[0] == 't' || $str[0] == 'T') {
            
            $order = Order_ta3med::where('order_no', '=' ,$r->search)->first();

            if($order){
                if($order->count() > 0 ){

                    return view('dashboard.orders.show_ta3med', ['order' => $order, 'statuses' => $statuses]);

                }else{

                    return redirect()->back()->withErrors(['field' => 'الرقم المدخل غير موجود']);
                }
            }else{

                return redirect()->back()->withErrors(['field' => 'الرقم المدخل غير موجود']);
            }

        }
        elseif ($str[0] == 'c' || $str[0] == 'C') {
            
            $order = Order_sharkat::where('order_no', '=' ,$r->search)->first();

            if($order){
                if($order->count() > 0 ){

                    return view('dashboard.orders.show_company', ['order' => $order, 'statuses' => $statuses]);
                }else{

                    return redirect()->back()->withErrors(['field' => 'الرقم المدخل غير موجود']);
                }
            }else{

                return redirect()->back()->withErrors(['field' => 'الرقم المدخل غير موجود']);
            }

        }
        elseif ($str[0] == 'e' || $str[0] == 'E') {
            
            $order = Order_estfsar::where('order_no', '=' ,$r->search)->first();

            if($order){
                if($order->count() > 0 ){
                    return view('dashboard.orders.show_estfsar', ['order' => $order, 'statuses' => $statuses]);
                }
            }else{

                return redirect()->back()->withErrors('new', 'not found');
            }

            
        }else{

            return redirect()->back()->withErrors('new', 'not found');
        }
    }
}