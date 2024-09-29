<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderDetailsOne;
use App\OrderDetailsTow;
use App\OrderDetailsThree;
use App\OrderDetailsFour;
use App\SpecialOrder;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrderDetailsOneExport;
use App\Exports\OrderDetailsTowExport;
use App\Exports\OrderDetailsThreeExport;
use App\Exports\OrderDetailsFourExport;
use App\Exports\SpecialOrderExport;
use App\Exports\PhoneListExport;

class ExportController extends Controller
{
    public function one_export() 
    {
        return Excel::download(new OrderDetailsOneExport, 'طلبات افراد كاش.xlsx');
    }

    public function tow_export() 
    {
        return Excel::download(new OrderDetailsTowExport, 'طلبات افراد تمويل.xlsx');
    }

    public function three_export() 
    {
        return Excel::download(new OrderDetailsThreeExport, 'طلبات شركات كاش.xlsx');
    }

    public function four_export() 
    {
        return Excel::download(new OrderDetailsFourExport, 'طلبات شركات تمويل.xlsx');
    }

    public function special_order_export() 
    {
        return Excel::download(new SpecialOrderExport, 'طلبات العروض الخاصة.xlsx');
    }

    public function phone_list_export() 
    {
        return Excel::download(new PhoneListExport, 'ارقام الهاتف.xlsx');
    }
}
