@extends('layouts.dashboard')
@push('page_styles')
<link href="{{ asset('metronic/vendors/chartist/dist/chartist.min.css')}}" rel="stylesheet" type="text/css" />

@endpush
@section('content')

<h3>الحسابات : الشاشة الرئيسية</h3>
<div class="row">
    <div class="col-md-12 m-portlet">
        <div class="m-widget14">
            <div class="row">
                <div class="col-md-8">

                    <h4 class="m-widget14__title">
                        اختر التاريخ: 
                        <span style="font-size:15px;color:#080">

                            @if(isset($dateTemplate) && $dateTemplate == 'fromBegining')

                               التاريخ المعروض منذ البداية 
                                
                            @elseif(isset($from) && isset($to))

                                التاريخ المعروض من {{ $from->format('Y-m-d') }} حتى {{ $to->format('Y-m-d') }}

                            @else 

                               التاريخ المعروض خلال شهر {{date('m-Y')}}

                            @endif
                           
                        </span>
                    </h4>
                    
                    <form method="POST" action="{{ route('dashboard.accounts.index.dates') }}" class="m-form m-form--fit m-form--label-align-right">
                        @csrf
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                <label class="col-md-1 col-form-label">من: </label>
                                <div class="col-md-3">
                                    {{-- <input type="text" name="name" value="{{ old('name') }}"  > --}}
                                <input type="date" name="dateFrom" class="form-control m-input m-input--solid"  @if(isset($from)) value="{{ $from }}" @endif>
                                </div>
                                <label class="col-md-1 col-form-label">الي: </label>
                                <div class="col-md-3">
                                    {{-- <input type="text" name="name" value="{{ old('name') }}"  > --}}
                                    <input type="date" name="dateTo" class="form-control m-input m-input--solid" @if(isset($to)) value="{{ $to }}" @endif>
                                </div>

                                <div class="col-md-3">
                                    {{-- <input type="text" name="name" value="{{ old('name') }}"  > --}}
                                        <input type="submit" class="btn btn-accent" value="تطبيق">
                                </div>

                            </div>
                            
                        </div>
                    </form>

                </div>
                <div class="col-md-4" style="border-right:1px solid #ccc;">
                    <h4 class="m-widget14__title">
                        او اختر الفترة:
                    </h4>
                    <form method="POST" action="{{ route('dashboard.accounts.index.dateTemplate') }}" class="m-form m-form--fit m-form--label-align-right">
                        @csrf

                        <select name="dateTemplate" class="form-control m-input m-input--solid">
                            <option value="">-- اختر --</option>
                            <option value="today" @if(isset($dateTemplate) && $dateTemplate == 'today') selected @endif>اليوم</option>
                            <option value="yesterday" @if(isset($dateTemplate) && $dateTemplate == 'yesterday') selected @endif>امس</option>
                            <option value="lastWeek" @if(isset($dateTemplate) && $dateTemplate == 'lastWeek') selected @endif>اخر سبعة ايام</option>
                            <option value="lastMonth" @if(isset($dateTemplate) && $dateTemplate == 'lastMonth') selected @endif>اخر شهر</option>
                            <option value="fromBegining" @if(isset($dateTemplate) && $dateTemplate == 'fromBegining') selected @endif>منذ البداية</option>
                        </select>
                         <input type="submit" class="btn btn-accent pull-left" style="margin-top:20px;" value="تطبيق">
                    </form>

                </div>

            </div> {{-- row in  --}}



            
        
        </div>
    </div>
<div class="col-md-4">

    <!--begin:: Widgets/Profit Share-->
    <div class="m-widget14 m-portlet">
        <div class="m-widget14__header m--margin-bottom-30">
            <h3 class="m-widget14__title" style="color:#080">
                اجمالي المبيعات 
            </h3>
            <span class="m-widget14__desc">
               @if(isset($dateTemplate) && $dateTemplate == 'fromBegining')

                    منذ البداية 
                    
                @elseif(isset($from) && isset($to))

                    التاريخ المعروض من {{ $from->format('Y-m-d') }} حتى {{ $to->format('Y-m-d') }}

                @else 
                
                    التاريخ المعروض خلال شهر {{date('m-Y')}}

                @endif
            </span>
            <div class="total_account" style="color:#080">
                    {{ number_format($m_total_mo3amla  + $m_total_estfsar + $m_total_price) }} <span> ر.س </span> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <h5>المعاملات</h5>
                <p> {{  number_format($m_total_mo3amla) }} <span>ر.س</span></p>
            </div>
            <div class="col-md-4">
                <h5>الاستفسارات</h5>
                <p> {{  number_format($m_total_estfsar) }} <span>ر.س</span></p>
            </div>
            <div class="col-md-4">
                <h5>التعميد</h5>
                <p> {{  number_format($m_total_price) }} <span>ر.س</span></p>
            </div>
        </div>
        {{-- <div class="row align-items-center">
            <div class="col">
                <div id="m_chart_profit_share" class="m-widget14__chart" style="height: 160px">
                    <div class="m-widget14__stat">45</div>
                </div>
            </div>
            <div class="col">
                <div class="m-widget14__legends">
                    <div class="m-widget14__legend">
                        <span class="m-widget14__legend-bullet m--bg-accent"></span>
                        <span class="m-widget14__legend-text">37% Sport Tickets</span>
                    </div>
                    <div class="m-widget14__legend">
                        <span class="m-widget14__legend-bullet m--bg-warning"></span>
                        <span class="m-widget14__legend-text">47% Business Events</span>
                    </div>
                    <div class="m-widget14__legend">
                        <span class="m-widget14__legend-bullet m--bg-brand"></span>
                        <span class="m-widget14__legend-text">19% Others</span>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <!--end:: Widgets/Profit Share-->
</div>





<div class="col-md-4">

    <!--begin:: Widgets/Daily Sales-->
    <div class="m-widget14 m-portlet">
        <div class="m-widget14__header m--margin-bottom-30">
            <h3 class="m-widget14__title" style="color:#0679ef">
                تفصيل المعاملات  
            </h3>
            <span class="m-widget14__desc">
                @if(isset($dateTemplate) && $dateTemplate == 'fromBegining')

                    منذ البداية 
                    
                @elseif(isset($from) && isset($to))

                    التاريخ المعروض من {{ $from->format('Y-m-d') }} حتى {{ $to->format('Y-m-d') }}

                @else 
                
                    التاريخ المعروض خلال شهر {{date('m-Y')}}

                @endif
            </span>
            <div class="total_account" style="color:#0679ef">
                    {{ number_format($m_total_mo3amla) }}  <span> ر.س </span>
            </div>
        </div>
      

         <div class="row">
            <div class="col-md-4">
                <h5>ايرادات انجاز</h5>
                <p>{{ number_format($m_total_enjaz) }} <span>ر.س</span></p>
            </div>
            <div class="col-md-4">
                <h5>الرسوم الحكومية</h5>
                <p>{{ number_format($m_total_gov) }} <span>ر.س</span></p>
            </div>
            <div class="col-md-4">
                <h5>الطرف الثالث</h5>
                <p>{{ number_format($m_total_thirdparty) }} <span>ر.س</span></p>
            </div>
        </div>
        {{-- <div class="m-widget14__chart" style="height:120px;">
            <canvas id="m_chart_daily_sales"></canvas>
        </div> --}}
    </div>

    <!--end:: Widgets/Daily Sales-->
</div>


<div class="col-md-4">

    <!--begin:: Widgets/Daily Sales-->
    <div class="m-widget14 m-portlet">
        <div class="m-widget14__header m--margin-bottom-30">
            <h3 class="m-widget14__title" style="color:#c7630e">
                تفصيل التعميد 
            </h3>
            <span class="m-widget14__desc">
                @if(isset($dateTemplate) && $dateTemplate == 'fromBegining')

                    منذ البداية 
                    
                @elseif(isset($from) && isset($to))

                    التاريخ المعروض من {{ $from->format('Y-m-d') }} حتى {{ $to->format('Y-m-d') }}

                @else 
                
                    التاريخ المعروض خلال شهر {{date('m-Y')}}

                @endif
            </span>
            <div class="total_account" style="color:#c7630e">
                    {{ number_format($m_total_price ) }} <span> ر.س </span> 
            </div>

        </div>
        <div class="row">
                <div class="col-md-6">
                    <h5> نسبة انجاز (رسوم التعميد) </h5>
                    <p>  {{ number_format($m_ta3med_price ) }} <span>ر.س</span></p>
                </div>
                <div class="col-md-6">
                    <h5>تكلفة المعقبين</h5>
                    <p> {{ number_format($m_ta3med_value ) }}  <span>ر.س</span></p>
                </div>
             
            </div>
        {{-- <div class="m-widget14__chart" style="height:120px;">
            <canvas id="m_chart_daily_sales"></canvas>
        </div> --}}
    </div>

    <!--end:: Widgets/Daily Sales-->
</div>


</div>

<div class="m-portlet m-portlet--mobile">

    <div class="m-portlet__body"  style="padding-bottom:0; padding-top:0">
        <input type="submit" class="btn btn-accent pull-left" style="margin:20px;" onclick="event.preventDefault(); document.getElementById('displayDate').submit();"  value="عرض">
        <input type="submit" class="btn btn-accent pull-left" style="margin:20px;" onclick="event.preventDefault(); document.getElementById('exportExcel').submit();" value="تصدير Excel">

    
        <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
        
        </table>

    </div>

</div>

<form id="displayDate" method="POST" action="{{ route('dashboard.accounts.index.displayDate') }}" class="m-form m-form--fit m-form--label-align-right">
    @csrf



    @if(isset($dateTemplate) && $dateTemplate == 'fromBegining')

      <input type="hidden" name="type" value="fromBegining">
        
    @elseif(isset($from) && isset($to))

        <input type="hidden" name="type" value="fromTo">
        <input type="hidden" name="from" value="{{ $from->format('Y-m-d') }}">
        <input type="hidden" name="to" value="{{ $to->format('Y-m-d') }}">

    @else
    
        <input type="hidden" name="type" value="thisMonth">

    @endif


</form>



<form id="exportExcel" method="POST" action="{{ route('dashboard.accounts.index.exportExcel') }}" class="m-form m-form--fit m-form--label-align-right">
    @csrf



    @if(isset($dateTemplate) && $dateTemplate == 'fromBegining')

      <input type="hidden" name="type" value="fromBegining">
        
    @elseif(isset($from) && isset($to))

        <input type="hidden" name="type" value="fromTo">
        <input type="hidden" name="from" value="{{ $from->format('Y-m-d') }}">
        <input type="hidden" name="to" value="{{ $to->format('Y-m-d') }}">

    @else
    
        <input type="hidden" name="type" value="thisMonth">

    @endif


</form>



@endsection

@push('page_vendors')

@endpush

@push('page_scripts')
{{-- 
    <script src="{{ asset('metronic/vendors/moment/min/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('metronic/vendors/chartist/dist/chartist.js')}}" type="text/javascript"></script>
    <script src="{{ asset('metronic/vendors/chart.js/dist/Chart.bundle.js')}}" type="text/javascript"></script>
    <script src="{{ asset('metronic/vendors/js/framework/components/plugins/charts/chart.init.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/engazFawry/custom_mawad.js') }}" type="text/javascript"></script> 
--}}
@endpush