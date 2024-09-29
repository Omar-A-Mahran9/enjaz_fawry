<!DOCTYPE html>
<html lang="ar">
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8"/>
    <style type="text/css">
        body {
            font-family: helvetica,"Times New Roman", serif;
            direction: rtl;
            text-align: right;
            font-size: 17px;
        }

        .container{
            width: 98%;
            height:98%;
            padding: 15px 10px;
            margin:0 auto;
        }

        @page {
            header: page-header;
            footer: page-footer;
        }
       
        htmlpageheader{
            height: 120px;
            background-color: #fff;
           
        }
        .center{
            width: 50%;
            margin:0 auto;
            text-align:center;
            float: right;
        }
        .center p{
            margin:0;
            line-height: 1.5em;
        }
        .center span{
            margin:0;
            line-height: 1.5em;
        }
        .header-right{
            float: right;
            width: 20%;
        }
        .header-left{
            float: left;
            width: 20%;
        }
        .clr1{
            color:#a29061;
        }
         .clr2{
            color:#008a5f;
        }
        table{
            width: 100%;
        }
        table,td{
            border:0 solid #999;
        }
        table tr:last-child td{
            font-weight: 600;
        }
        .header_title{
            font-size:23px;
            text-align: center;
        }
        .header_title_2{
             font-size:20px;
            text-align: center;
        }
        .text-right{
            width: 50%;
            float: right;
        }
        table.invoice th,
        table.invoice td {
            padding: 15px;
            font-weight: normal;
            border: 1px solid #3CBFAF;
        }
        table.invoice{
            border: 1px solid #3CBFAF;
            font-size: 17px;
            text-align: center;
            color: #853BCC;
        }
        table.invoice td {
            background-color: #f5f3ee;
            padding:10px !important;
            border: 1px solid #3CBFAF;
        }
        table.invoice tr{
            border: 1px solid #3CBFAF;
        }
        table.invoice tr:last-child td{
            background-color: #ffffff;
            border: 1px solid #3CBFAF;
        }
        .invoice-footer {
            border-top: 1px solid #853BCC;
            color: #853BCC;
            padding: 10px 20px;
            text-align: center;
        }
        .invoice-footer p {
            color: #853BCC;
        }
        .text-right{
            text-align: right;
        }
        .wrap_top{
            width:100%;
            text-align:right;
            clear: both;
            margin-bottom: 20px;
            overflow: auto;
            min-height: 150px;
        }
        .wrap_top table{
            text-align:right;
        }
        .row{
            display: block;
            clear: both;
            overflow: hidden;
            margin-bottom: 50px;
        }
    </style>
</head>
<body>
<htmlpageheader name="page-header">
    <div style=" border-bottom: 1px solid #222;">
        <div class="header-right">
            <img class="logo" width="150" src="images/logo.png">
        </div>
    </div>
</htmlpageheader>



<section class="container p-5" style="padding: 0;background-color:#fff;">
    
    <p class="header_title">فاتورة</p>
    <p class="header_title_2">فاتورة رقم: {{ $order->order_no  }}</p>
        <div class="row">
            <div class="text-right">
                <table class="invoice-head-table">
                    <tr>
                        <td>
                            من شركة:
                        </td>
                        <td>
                            <span style="font-weight: 100;">إنجاز فوري</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            جهة المعاملة:
                        </td>
                        <td>
                            <span style="font-weight: 100;">{{ $order->service->name  }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            الخدمة المطلوبة:
                        </td>
                        <td>
                            <span style="font-weight: 100;">{{ $order->service->name  }}</span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="text-right">
                <table class="invoice-head-table-2">
                    <tr>
                        <td class="heading">
                            إلى السيد/ة:
                        </td>
                        <td>
                            <span style="font-weight: 100;">{{ $order->orderUser->name  }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            الجوال:
                        </td>
                        <td>
                            <span style="font-weight: 100;">{{ $order->orderUser->phone  }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            التاريخ:
                        </td>
                        <td>
                            <span style="font-weight: 100;">{{ $order->created_at->format('d/m/Y')  }}</span style="font-weight: 100;">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row justify-content-center">
            <table class="invoice"  cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                <thead>
                    <tr>
                    <th >المسلسل</th>
                    <th>البند</th>
                    <th>السعر</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>تكلفة انجاز المعاملة</td>
                        <td>{{ $tPrice }} ر.س</td>
                    </tr>
                    @if($order->m_processGovPrice != Null || $order->m_processGovPrice != 0)
                        <tr>
                            <td> <p>2</p></td>
                            <td><p> الرسوم الحكومية</p></td>
                            <td><p>{{ $order->m_processGovPrice }}  ر.س</p></td>
                        </tr>
                    @endif

                    <tr>
                        <td colspan="2">الاجمالي</td>
                        <td>  {{$order->price }} ر.س</td>
                    </tr>
                </tbody>
                
            </table>
        </div>
       
    </section>

<htmlpagefooter name="page-footer">
        <table class="invoice-footer">
            <tr>
                <td>  س.ت : 4030328458</td>
                <td>المملكة العربية السعودية</td>
            <td><p>جوال : {{ $mobile }}</p></td>
            </tr>
        </table>
</htmlpagefooter>

</body>
</html>