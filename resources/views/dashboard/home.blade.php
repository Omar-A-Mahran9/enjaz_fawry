@extends('layouts.dashboard')
@push('page_styles')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['المعاملات', {{ $coun_of_orders_mo3amla}}],
          ['التعميد', {{ $coun_of_orders_t3meed}}],
          ['الاستفسارات', {{ $coun_of_orders_estfsar}}],
          ['الشركات', {{ $coun_of_orders_company}}],
          ['الرسائل', {{ $coun_of_contacts}}]
        ]);

        // Set chart options
        var options = {'title':'بيان الطلبات',
                       'width':400,
                       'height':300,
                       'is3D':true,
                       'legend':'right'
                       };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>


<script type="text/javascript">

      // Load the Visualization API and the corechart package.
   //   google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChartClient);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChartClient() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['العملاء', {{ $coun_of_clients}}],
          ['المعقبين',  {{ $coun_of_vendors}}],
          ['مكاتب الخدمات',  {{ $coun_of_vendorCs}}],
        ]);

        // Set chart options
        var options = {'title':'بيان العملاء',
                       'width':400,
                       'height':300,
                       'is3D':true,
                       'legend':'right'};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div_client'));
        chart.draw(data, options);
      }
    </script>


<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChartSales);


      function drawChartSales() {
        var data = google.visualization.arrayToDataTable([
          ['الشهر'             , 'المعاملات', 'التعميد', 'الاستفسار', 'الشركات'],
          ['{{ $this_month }}' ,  {{ $mo3amla_this_month}},  {{ $ta3med_this_month}}, {{ $estfsar_this_month}},     {{ $sharkat_this_month}}],
          ['{{ $month_one }}'  ,  {{ $mo3amla_month_one}},  {{ $ta3med_month_one}},{{ $estfsar_month_one}},       {{ $sharkat_month_one}}],
          ['{{ $month_two }}'  ,  {{ $mo3amla_month_two}},   {{ $ta3med_month_two}},{{ $estfsar_month_two}},      {{ $sharkat_month_two}}],
          ['{{ $month_three }}',  {{ $mo3amla_month_three}},  {{ $ta3med_month_three}},{{ $estfsar_month_three}},     {{ $sharkat_month_three}}]
        ]);

        var options = {
          title: 'تحليل الطلبات بالشهور',
          hAxis: {title: 'الشهر',  titleTextStyle: {color: '#222'}, direction:-1},
          vAxis: {minValue: 0, direction:1},
          legend:{alignment: 'start'},
       //   orientation:'vertical',
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div_sales'));
        chart.draw(data, options);
      }
    </script>
@endpush
@section('content')









<div class="row">

    <div class="col-xl-6">

        <!--begin:: Widgets/Last Updates-->
        <div class="m-portlet m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            الطلبات
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body" >

                <div id="chart_div"></div>

            </div>

        </div>

        <!--end:: Widgets/Last Updates-->
    </div>  <!--end:: col4-->



     <div class="col-xl-6">
        <!--begin:: Widgets/Last Updates-->
        <div class="m-portlet m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            الاعضاء
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">

                 <div id="chart_div_client"></div>
                 

                 

            </div>

        </div>

        <!--end:: Widgets/Last Updates-->
    </div>  <!--end:: col4-->

    <div class="col-xl-12">
        <!--begin:: Widgets/Last Updates-->
        <div class="m-portlet m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            المبيعات
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">

                <div id="chart_div_sales"></div>

            </div>

        </div>

        <!--end:: Widgets/Last Updates-->
    </div>  <!--end:: col4-->
    

    
</div>












    <!--Begin::Section-->
    <div class="m-portlet">
        <div class="m-portlet__body m-portlet__body--no-padding">
            <div class="row m-row--no-padding m-row--col-separator-xl">


                
                <div class="col-md-12 col-lg-12 col-xl-4">

                    <!--begin:: Widgets/Stats2-1 -->
                    <div class="m-widget1">
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title"> طلبات المعاملات</h3>
                                    <span class="m-widget1__desc">عدد المعاملات</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-brand"> {{ $coun_of_orders_mo3amla}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">طلبات التعميد</h3>
                                    <span class="m-widget1__desc">عدد طلبات التعميد</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-danger"> {{ $coun_of_orders_t3meed}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">الاستفسارات المدفوعة</h3>
                                    <span class="m-widget1__desc">عدد الاستفسارات المدفوعة</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-success"> {{ $coun_of_orders_estfsar}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end:: Widgets/Stats2-1 -->
                </div>
                <div class="col-md-12 col-lg-12 col-xl-4">

                    <!--begin:: Widgets/Stats2-2 -->
                    <div class="m-widget1">
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">طلبات الشركات</h3>
                                    <span class="m-widget1__desc">عدد الطلبات</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-accent">{{ $coun_of_orders_company}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">عدد العملاء</h3>
                                    <span class="m-widget1__desc">العملاء</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-warning">{{ $coun_of_clients}}</span>
                                </div>
                            </div>
                        </div> 
                                       
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title">الرسائل</h3>
                                    <span class="m-widget1__desc">عدد الرسائل</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-info">{{ $coun_of_contacts}}</span>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <!--begin:: Widgets/Stats2-2 -->
                </div>
                <div class="col-md-12 col-lg-12 col-xl-4">

                    <!--begin:: Widgets/Stats2-3 -->
                    <div class="m-widget1">
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title"> العملاء</h3>
                                    <span class="m-widget1__desc">عدد العملاء</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-success">{{ $coun_of_clients}}</span>
                                </div>
                            </div>
                        </div>
                                      
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title"> المعقبين</h3>
                                    <span class="m-widget1__desc">عدد المعقبين</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-danger">{{ $coun_of_vendors}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="m-widget1__item">
                            <div class="row m-row--no-padding align-items-center">
                                <div class="col">
                                    <h3 class="m-widget1__title"> مكاتب الخدمات</h3>
                                    <span class="m-widget1__desc">عدد مكاتب الخدمات</span>
                                </div>
                                <div class="col m--align-right">
                                    <span class="m-widget1__number m--font-warning"> {{ $coun_of_vendorCs }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--begin:: Widgets/Stats2-3 -->
                </div>
            </div>
        </div>
    </div>

    <!--End::Section-->

<div class="row">

    <div class="col-xl-4">

        <!--begin:: Widgets/Last Updates-->
        <div class="m-portlet m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            المزيد من الاحصائيات
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">

                <!--begin::widget 12-->
                <div class="m-widget4">
                    <div class="m-widget4__item">
                        <div class="m-widget4__ext">
                            <span class="m-widget4__icon m--font-brand">
                                <i class="fab fa-blogger"></i>
                            </span>
                        </div>
                        <div class="m-widget4__info">
                            <span class="m-widget4__text">
                                عدد التدوينات
                            </span>
                        </div>
                        <div class="m-widget4__ext">
                            <span class="m-widget4__number m--font-info">
                                {{$coun_of_posts}}
                            </span>
                        </div>
                    </div>
                    {{-- <div class="m-widget4__item">
                        <div class="m-widget4__ext">
                            <span class="m-widget4__icon m--font-brand">
                                <i class="fab fa-youtube"></i>
                            </span>
                        </div>
                        <div class="m-widget4__info">
                            <span class="m-widget4__text">
                                عدد الفيديوهات
                            </span>
                        </div>
                        <div class="m-widget4__ext">
                            <span class="m-widget4__number m--font-info">
                                000
                            </span>
                        </div>
                    </div> --}}
                    <div class="m-widget4__item">
                        <div class="m-widget4__ext">
                            <span class="m-widget4__icon m--font-brand">
                                <i class="fab fa-readme"></i>
                            </span>
                        </div>
                        <div class="m-widget4__info">
                            <span class="m-widget4__text">
                                عدد الاسئلة الشائعة
                            </span>
                        </div>
                        <div class="m-widget4__ext">
                            <span class="m-widget4__number m--font-info">
                                {{ $coun_of_faq}}
                            </span>
                        </div>
                    </div>
                    {{-- <div class="m-widget4__item">
                        <div class="m-widget4__ext">
                            <span class="m-widget4__icon m--font-brand">
                                <i class="fa fa-user-check"></i>
                            </span>
                        </div>
                        <div class="m-widget4__info">
                            <span class="m-widget4__text">
                                عدد المشرفين
                            </span>
                        </div>
                        <div class="m-widget4__ext">
                            <span class="m-widget4__number m--font-info">
                                {{$coun_of_admins}}
                            </span>
                        </div>
                    </div> --}}
                    <div class="m-widget4__item m-widget4__item-border">
                        <div class="m-widget4__ext">
                            <span class="m-widget4__icon m--font-brand">
                                <i class="fa fa-link"></i>
                            </span>
                        </div>
                        <div class="m-widget4__info">
                            <span class="m-widget4__text">
                                عدد رسائل SMS المتبقية
                            </span>
                        </div>
                        <div class="m-widget4__ext">
                            <span class="m-widget4__number m--font-info">
                                @php 
                                    $balance = smsBalance();
                                    
                                    // if(isset($balance['ResponseStatus']) && $balance['ResponseStatus'] == 'success'){

                                    //     $bb =  $balance['Data']['balance'];

                                    //     $da =  explode(':', $bb);

                                    //     echo $da[0];
                                    // }
                                    echo '0';
                                @endphp
                                
                            </span>
                        </div>
                    </div>
                    
                </div>

                <!--end::Widget 12-->
            </div>
        </div>

        <!--end:: Widgets/Last Updates-->
    </div>

    

    
</div>



@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush
