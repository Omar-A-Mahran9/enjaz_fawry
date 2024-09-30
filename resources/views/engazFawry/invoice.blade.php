@extends('engazFawry.layouts.app')
@section('content')

<section class="container p-5" style="padding: 0;background-color:#fff;">
<header class="" style="background-color: #fff;">
        <div class="container">
            <nav class="navbar navbar-expand-md fixed-top-sm justify-content-start flex-nowrap engaz-nav"
                style="background-color: #fff!important;border-bottom: 1px solid #222;">
                <a class="navbar-brand"><img class="logo" src="images/logo.png"></a>
            </nav>
        </div>
    </header>
    
        <div class="row mt-5">
            <div class="container">
                <h1 class="text-center w-100">فاتورة</h1>
                <h1 class="text-center w-100">معاملة بدائرة هجرة</h1>
                <h4 class="text-center w-100">فاتورة رقم: 002151</h4 class="text-center w-100">
            </div>
        </div>
        <div class="row d-flex justify-content-between mb-5">
            <div class="text-right">
                <table class="invoice-table">
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
                            <span style="font-weight: 100;">دائرة الجوزات</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            الخدمة المطلوبة:
                        </td>
                        <td>
                            <span style="font-weight: 100;">تجديد الإقامة</span style="font-weight: 100;">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="text-right">
                <table class="invoice-table">
                    <tr>
                        <td class="heading">
                            إلى السيد/ة:
                        </td>
                        <td>
                            <span style="font-weight: 100;">اسم مستخدم</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            الجوال:
                        </td>
                        <td>
                            <span style="font-weight: 100;">01010101010</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            التاريخ:
                        </td>
                        <td>
                            <span style="font-weight: 100;">20 / 10 / 2019</span style="font-weight: 100;">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row justify-content-center">
            <table class="invoice w-100 text-right">
                <thead>
                    <th>المسلسل</th>
                    <th>البند</th>
                    <th>السعر</th>
                </thead>
                <tbody>
                    <tr>
                        <td>01</td>
                        <td>تكلفة انجاز المعاملة</td>
                        <td>رس 800</td>
                    </tr>
                    <tr>
                        <td>01</td>
                        <td>تكلفة انجاز المعاملة</td>
                        <td>رس 800</td>
                    </tr>
                    <tr>
                        <td>01</td>
                        <td>تكلفة انجاز المعاملة</td>
                        <td>رس 800</td>
                    </tr>
                    <tr>
                        <td colspan="1" style="border:none;"></td>
                        <td colspan="1">الاجمالي</td>
                        <td> رس 10000</td>
                    </tr>
                </tbody>
                
            </table>
        </div>
        <div class="row d-flex justify-content-between invoice-footer mt-5">
            <div>
                <p>س.ت : 40303228458</p>
            </div>
            <div>
                <p>المملكة العربية السعودية</p>
            </div>
            <div>
                <p>ت : +966 0566661 105</p>
            </div>

        </div>
    </section>
@endsection