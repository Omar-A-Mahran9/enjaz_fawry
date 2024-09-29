<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="canonical" href="{{request()->url()}}">
 
  <title>   @yield('title' , " Enjaz-Fawry :: انجاز فوري")</title>

  @yield('seo')
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-MCN54JT');</script>
  <!-- End Google Tag Manager -->
  

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('css/engazFawry/bootstrap.min.css') }}">
  <link rel=" stylesheet" href="{{ asset('css/engazFawry/style.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

  <link rel="shortcut icon" type="image/png" href="{{ asset('images/fav.png') }}"/>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-32173456-56"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-32173456-56');
</script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  {{-- <script
      src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"
      integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f"
      crossorigin="anonymous"
    ></script> --}}
  <!-- Toastr -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="{{ asset('js/engazFawry/bootstrap.min.js') }}"></script>
  <script src="https://use.fontawesome.com/d5972571a6.js"></script>


  @stack('page_styles')

  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TKS3TPFC');</script>
<!-- End Google Tag Manager -->
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TKS3TPFC"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
 
  <!-- begin ClickGUARD Tracking Code --> 
  <script defer type="application/javascript" src="https://io.clickguard.com/s/cHJvdGVjdG9y/YwteqSED"></script>
  <script defer type="application/javascript"> 
  (function () { window.cg_convert = function (x, y) { if (window._cg_convert) window._cg_convert(x || null, y || null); else setTimeout(function () { cg_convert(x || null, y || null) }, 500); }; })(); 
  </script> <!-- end ClickGUARD Tracking Code -->

 @if(Session::has('message'))

 <script>
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  </script>
  @endif

  <header class="fixed-top">
    <nav class="navbar navbar-expand-md fixed-top-sm justify-content-start flex-nowrap engaz-nav">
      <div class="container">
        <a class="navbar-brand" href="/"><img class="logo" src="{{ asset('images/logo.png') }}"></a>

        @if (Auth::check())

        <?php
         $cid= Auth::id();
      //   $user_name= Auth::name();
         // $user = User::find(auth()->user()->id);
         
         ?>

          
        <ul class="navbar-nav mr-md-auto text-right d-none d-md-block">
        {{-- <span class="" style="display:inline-block;margin-left:-15px;">
          <svg xmlns="http://www.w3.org/2000/svg" width="20.718" height="25.25" viewBox="0 0 20.718 25.25" style="margin: 0 10px;">
                <path id="Icon_material-notifications" data-name="Icon material-notifications" d="M16.359,29a2.6,2.6,0,0,0,2.59-2.59H13.769A2.589,2.589,0,0,0,16.359,29Zm7.769-7.769V14.756c0-3.975-2.124-7.3-5.827-8.184V5.692a1.942,1.942,0,1,0-3.885,0v.881c-3.716.881-5.827,4.2-5.827,8.184v6.474L6,23.821v1.295H26.718V23.821Z" transform="translate(-6 -3.75)" fill="#3cbfaf"/>
              </svg>
        </span> --}}
        <span class="" style="display:inline-block;margin-left:0; color:#3CBFAF">
          <i class="fa fa-user"></i>
        </span> 
        
        <li class="nav-item second-navbar-li transform" style="display:inline-block;">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
            مرحبا  {{ $name }}</a>
            <div class="dropdown-menu text-right" style="">
              <a class="m-nav__itemn av-item dropdown-item" href="{{ route('my.orders.new')}}"> طلباتي</a>
              <a class="m-nav__itemn av-item dropdown-item" href="{{ route('client_dashboard')}}"> لوحة التحكم</a>
              <a class="m-nav__itemn av-item dropdown-item" href="{{ route('panel.setting')}}">الاعدادات</a>
              {{-- Start Logout  --}}
              <a class="m-nav__itemn av-item dropdown-item" href="{{ route('logout_front') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">تسجيل الخروج</a>
              <form id="logout-form" action="{{ route('logout_front') }}" method="POST" style="display: none;">
                @csrf
              </form>
              {{-- End Logout --}}
            </div>
          </li>
        
        </ul>

        @else

        <ul class="navbar-nav mr-auto d-none d-md-flex">
        <li class="transform"><a class="nav-item engaz-btn-light transform" style="padding: 5px 10px!important;" href="{{ route('login_front')}}">الدخول</a></li>
        <li class="transform"><a class="nav-item engaz-btn transform" style="padding: 5px 10px!important;" href="{{ route('signup')}}">التسجيل</a></li>
        </ul>

        @endif


        <button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#navbar2" style="outline: none!important;">
          <span class="navbar-toggler-icon">
            <i class="fa fa-bars"></i>
          </span>
        </button>
        </div>
    </nav>

    <nav class="navbar navbar-expand-md second-navbar p-0" style="z-index: -1; border-bottom: 2px solid #853BCC;">
      <div class="navbar-collapse collapse container" id="navbar2">
       @if (Auth::check())

        <?php $cid= Auth::id(); ?>
          <ul class="navbar-nav mr-md-auto text-center d-md-none" style="width:90%;">
        <li class="nav-item second-navbar-li transform">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
             <svg xmlns="http://www.w3.org/2000/svg" width="20.718" height="25.25" viewBox="0 0 20.718 25.25" style="margin: 0 10px;">
                <path id="Icon_material-notifications" data-name="Icon material-notifications" d="M16.359,29a2.6,2.6,0,0,0,2.59-2.59H13.769A2.589,2.589,0,0,0,16.359,29Zm7.769-7.769V14.756c0-3.975-2.124-7.3-5.827-8.184V5.692a1.942,1.942,0,1,0-3.885,0v.881c-3.716.881-5.827,4.2-5.827,8.184v6.474L6,23.821v1.295H26.718V23.821Z" transform="translate(-6 -3.75)" fill="#3cbfaf"/>
              </svg>
              الحساب
            </a>
            <div class="dropdown-menu text-right" style="">
              <a class="m-nav__itemn av-item dropdown-item" href="{{ route('client_dashboard')}}">حسابي</a>
              <a class="m-nav__itemn av-item dropdown-item" href="{{ route('panel.setting')}}">الاعدادات</a>
              {{-- Start Logout  --}}
              <a class="m-nav__itemn av-item dropdown-item" href="{{ route('logout_front') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">تسجيل الخروج</a>
            
              {{-- End Logout --}}
            </div>
          </li>

          @csrf
        </ul>

        @else
          <ul class="navbar-nav list-group-horizontal mr-md-auto d-flex d-md-none w-100" style="margin-bottom: 20px;">
              <li class="list-group-item engaz-btn-light transform"><a class="" href="{{ route('login_front')}}">الدخول</a></li>
              <li class="list-group-item engaz-btn transform"><a class=" " href="{{ route('signup')}}">التسجيل</a></li>
            </ul>
        @endif    

        <ul class="navbar-nav mr-md-auto text-right">
          <li class="nav-item  second-navbar-li transform {{ (\Request::route()->getName() == 'index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('index')}}">الرئيسية</a>
          </li>

          <li class="nav-item  second-navbar-li transform">
            <a class="nav-link" id="toApps" href="{{ route('index')}}/#download_apps">تنزيل التطبيق</a>
          </li>


          <li class="nav-item  second-navbar-li transform">
            <a class="nav-link" id="toApps" href="{{ route('index')}}/#reviews">اراء العملاء</a>
          </li>

          
          
          {{-- <li class="nav-item second-navbar-li transform {{ (\Request::route()->getName() == 'vendors') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('vendors')}}">المعقبين</a>
          </li>
          <li class="nav-item second-navbar-li transform {{ (\Request::route()->getName() == 'vendors-company') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('vendors-company')}}">مكاتب الخدمات</a>
          </li> --}}
          <li class="nav-item second-navbar-li transform  {{ (\Request::route()->getName() == 'mo3amla') ? 'active' : '' }}
                                                          {{ (\Request::route()->getName() == 'ta3med') ? 'active'  : '' }}
                                                          {{ (\Request::route()->getName() == 'guarante') ? 'active'  : '' }}
                                                          {{ (\Request::route()->getName() == 'estfsar') ? 'active' : '' }}
                                                          {{ (\Request::route()->getName() == 'sharkat') ? 'active' : '' }}">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">طلب خدمة</a>
            <div class="dropdown-menu text-right" style="">
              <a class="dropdown-item" href="{{ route('mo3amla')}}">طلب معاملة </a>
              <a class="dropdown-item" href="{{ route('ta3med')}}">طلب تعميد</a>
              <a class="dropdown-item" href="{{ route('estfsar')}}">طلب استفسار</a>
              <a class="dropdown-item" href="{{ route('sharkat')}}">طلبات الشركات</a>
              <a class="dropdown-item" href="{{ route('guarante')}}">طلب ضمان مبلغ سلعة </a>
            </div>
          </li>
          <li class="nav-item second-navbar-li transform {{ (\Request::route()->getName() == 'faq') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('faq')}}">الاسئلة الشائعة</a>
          </li>
          <li class="nav-item second-navbar-li transform {{ (\Request::route()->getName() == 'contact') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('contact')}}">تواصل معنا</a>
          </li>


            @if (Auth::check())

              <li class="nav-item second-navbar-li transform  {{ (\Request::route()->getName() == 'my.orders.new') ? 'active' : '' }}
                                                          {{ (\Request::route()->getName() == 'my.orders.onprocess') ? 'active'  : '' }}
                                                          {{ (\Request::route()->getName() == 'my.orders.finished') ? 'active' : '' }}
                                                            ">
              <a class="nav-link dropdown-toggle" style="color: #3CBFAF;" href="#" data-toggle="dropdown">طلباتي</a>
              <div class="dropdown-menu text-right" style="">
                <a class="dropdown-item" href="{{ route('my.orders.new')}}">الطلبات الجديدة </a>
                <a class="dropdown-item" href="{{ route('my.orders.onprocess')}}">طلبات قيد التنفيذ</a>
                <a class="dropdown-item" href="{{ route('my.orders.finished')}}">الطلبات المنتهية </a>
              </div>
            </li>

            @endif

        </ul>
      </div>
    </nav>
  </header>

  <div class="min-height">
    @yield('content')
  <div>

  <!--Footer Start-->
  <footer class="footer">
 
    <div class="whatsapp-contact">
      <a target="_blank" rel="nofollow noopener" role="link"  href="https://wa.me/966{{ $setting->general_whats }}" class="img-icon-a nofocus" data-wpel-link="external" rel="nofollow external noopener noreferrer">   
        <img style="height: 57px;" src="{{ asset('images/whatsapp-logo.svg') }}" alt="WhatsApp chat">
      </a>
    </div>

    <div class="container mb-5">
      <div class="row">
        <div class="col-12 col-md-4 text-right p-lg-0" >
          <div class="row">
            <h1 class="footer-heading">
              <svg xmlns="http://www.w3.org/2000/svg" width="141.81" height="85.555" viewBox="0 0 141.81 85.555">
                <g id="Group_142" data-name="Group 142" transform="translate(-852.382 -379.884)">
                  <g id="Group_35" data-name="Group 35" transform="translate(852.382 418.2)">
                    <path id="Path_56" data-name="Path 56" d="M1230.747,595.809a5.866,5.866,0,0,0-2.953.76,3.234,3.234,0,0,0-1.62,2.377l-.311,1.765h5.391a3.15,3.15,0,0,1,2.566,1.152,3.261,3.261,0,0,1,.664,2.77l-.432,2.451a9.995,9.995,0,0,1-1.291,3.432,11.334,11.334,0,0,1-2.385,2.819,11.145,11.145,0,0,1-3.151,1.887,9.6,9.6,0,0,1-3.552.686h-10.293a7.847,7.847,0,0,1-3.31-.686,6.877,6.877,0,0,1-2.486-1.887,7.025,7.025,0,0,1-1.39-2.819,8.214,8.214,0,0,1-.081-3.432l1.037-5.882a1.153,1.153,0,0,1,.415-.686,1.124,1.124,0,0,1,.738-.294h3.921a.784.784,0,0,1,.635.294.811.811,0,0,1,.172.686l-.9,5.1a4.625,4.625,0,0,0,.2,2.6,2,2,0,0,0,2.081,1.127h10.294a3.778,3.778,0,0,0,2.115-.735,3.2,3.2,0,0,0,1.345-2.206l.087-.49h-6.372a2.369,2.369,0,0,1-1.932-.858,2.454,2.454,0,0,1-.49-2.083l.821-4.657a11.5,11.5,0,0,1,1.411-3.971,9.323,9.323,0,0,1,5.511-4.289,12.722,12.722,0,0,1,3.645-.515,16.689,16.689,0,0,1,5.521.931l-1.132,2.627a3.364,3.364,0,0,1-3.095,2.033Z" transform="translate(-1205.972 -585.514)" fill="#f9f7f3"/>
                    <path id="Path_57" data-name="Path 57" d="M1412.356,619.984a4.1,4.1,0,0,1-.808-3.481l.519-2.942a9.995,9.995,0,0,1,1.392-3.725,9.681,9.681,0,0,1,2.419-2.6,9.823,9.823,0,0,1,3.111-1.519,12.458,12.458,0,0,1,3.469-.49,12.673,12.673,0,0,1,3.912.612,10.321,10.321,0,0,1,3.4,1.838l-1.383,7.844h2.451l-1.037,5.882h-2.451a12.03,12.03,0,0,1-1.316,3.849,9.605,9.605,0,0,1-2.191,2.7,8.607,8.607,0,0,1-2.8,1.568,10.019,10.019,0,0,1-3.2.515,14.888,14.888,0,0,1-3.708-.515,13.718,13.718,0,0,1-3.633-1.5l1.136-2.246a2.717,2.717,0,0,1,3.107-1.388l.023.006a9.66,9.66,0,0,0,2.35.294,5.478,5.478,0,0,0,2.8-.711,3.46,3.46,0,0,0,1.557-2.574h-5.882A3.955,3.955,0,0,1,1412.356,619.984Zm10.866-8.53q-.513-.147-.986-.245a4.733,4.733,0,0,0-.963-.1,3.914,3.914,0,0,0-2.142.612,2.6,2.6,0,0,0-1.182,1.838l-.346,1.961h4.9Z" transform="translate(-1367.739 -597.385)" fill="#f9f7f3"/>
                    <path id="Path_58" data-name="Path 58" d="M1498.058,654.886a1.69,1.69,0,0,1,1.127-.416h9.8l-1.037,5.882h-9.8a1.2,1.2,0,0,1-.98-.416,1.242,1.242,0,0,1-.231-1.054l.519-2.941A1.74,1.74,0,0,1,1498.058,654.886Z" transform="translate(-1436.085 -636.331)" fill="#f9f7f3"/>
                    <path id="Path_59" data-name="Path 59" d="M1544.952,654.886a1.69,1.69,0,0,1,1.127-.416h9.8l-1.037,5.882h-9.8a1.2,1.2,0,0,1-.98-.416,1.243,1.243,0,0,1-.231-1.054l.519-2.941A1.739,1.739,0,0,1,1544.952,654.886Z" transform="translate(-1473.176 -636.331)" fill="#f9f7f3"/>
                    <path id="Path_60" data-name="Path 60" d="M1591.845,654.886a1.689,1.689,0,0,1,1.127-.416h9.8l-1.037,5.882h-9.8a1.2,1.2,0,0,1-.98-.416,1.242,1.242,0,0,1-.231-1.054l.519-2.941A1.741,1.741,0,0,1,1591.845,654.886Z" transform="translate(-1510.265 -636.331)" fill="#f9f7f3"/>
                    <path id="Path_61" data-name="Path 61" d="M1638.739,654.886a1.69,1.69,0,0,1,1.127-.416h9.8l-1.037,5.882h-9.8a1.2,1.2,0,0,1-.98-.416,1.242,1.242,0,0,1-.231-1.054l.519-2.941A1.743,1.743,0,0,1,1638.739,654.886Z" transform="translate(-1547.356 -636.331)" fill="#f9f7f3"/>
                    <path id="Path_62" data-name="Path 62" d="M1685.633,654.886a1.691,1.691,0,0,1,1.127-.416h9.8l-1.037,5.882h-9.8a1.2,1.2,0,0,1-.981-.416,1.243,1.243,0,0,1-.231-1.054l.519-2.941A1.743,1.743,0,0,1,1685.633,654.886Z" transform="translate(-1584.446 -636.331)" fill="#f9f7f3"/>
                    <path id="Path_63" data-name="Path 63" d="M1802.663,568.345a2.494,2.494,0,0,0-1.8-.639,3.4,3.4,0,0,0-2.024.639,2.413,2.413,0,0,0-1.061,1.57,1.625,1.625,0,0,0,.508,1.564,2.494,2.494,0,0,0,1.8.64,3.4,3.4,0,0,0,2.025-.64,2.4,2.4,0,0,0,1.061-1.564A1.632,1.632,0,0,0,1802.663,568.345Zm3.705,14,.509-2.877a.4.4,0,0,0,.01-.068Z" transform="translate(-1674.031 -567.706)" fill="#f9f7f3"/>
                    <path id="Path_64" data-name="Path 64" d="M1745.761,605.24a9.664,9.664,0,0,0-3.206.538,10.273,10.273,0,0,0-2.756,1.444,8.311,8.311,0,0,0-2.02,2.16,7.344,7.344,0,0,0-1.07,2.717,7.611,7.611,0,0,0-.1,1.695,6.827,6.827,0,0,0,.33,1.739h-3.284a1.669,1.669,0,0,0-1.124.417,1.745,1.745,0,0,0-.606,1.051l-.518,2.945a1.248,1.248,0,0,0,.233,1.051,1.187,1.187,0,0,0,.978.417h18.629a1.119,1.119,0,0,0,.736-.291,1.17,1.17,0,0,0,.417-.688l1.322-7.5.155-.9.518-2.945.673-3.851Zm1.618,10.293h-2.843a2.188,2.188,0,0,1-1.72-.664,1.75,1.75,0,0,1-.441-1.545,2.452,2.452,0,0,1,1.012-1.564,3.119,3.119,0,0,1,1.928-.639h2.843Z" transform="translate(-1621.536 -597.393)" fill="#f9f7f3"/>
                    <path id="Path_65" data-name="Path 65" d="M1213.2,638.055H1211l-.332,2.1" transform="translate(-1209.683 -623.348)" fill="#f9f7f3"/>
                    <path id="Path_66" data-name="Path 66" d="M1344.9,605.24l-.17.964-.247,1.424-2.431,13.785a12.244,12.244,0,0,1-1.288,3.826,9.467,9.467,0,0,1-2.136,2.669,8.315,8.315,0,0,1-2.8,1.569,10.227,10.227,0,0,1-3.231.513,12.827,12.827,0,0,1-3.54-.489l1.593-3.57a1.953,1.953,0,0,1,1.821-1.133h.014a3.565,3.565,0,0,0,2.383-.857,4.147,4.147,0,0,0,1.3-2.528l2.678-15.195a1.145,1.145,0,0,1,.417-.688,1.119,1.119,0,0,1,.736-.29Z" transform="translate(-1303.326 -597.393)" fill="#f9f7f3"/>
                  </g>
                  <g id="Group_36" data-name="Group 36" transform="translate(855.446 379.884)">
                    <path id="Path_67" data-name="Path 67" d="M1278.5,399.132a3.408,3.408,0,0,1,2.024-.637,2.505,2.505,0,0,1,1.8.637,1.645,1.645,0,0,1,.508,1.569,2.415,2.415,0,0,1-1.061,1.569,3.408,3.408,0,0,1-2.024.637,2.506,2.506,0,0,1-1.8-.637,1.643,1.643,0,0,1-.508-1.569A2.417,2.417,0,0,1,1278.5,399.132Z" transform="translate(-1265.535 -395.554)" fill="#f9f7f3"/>
                    <path id="Path_68" data-name="Path 68" d="M1313.6,384.722a.807.807,0,0,1,.173.686l-3.544,20.1h2.451l-1.037,5.883h-7.352a.782.782,0,0,1-.634-.294.809.809,0,0,1-.173-.686l4.408-25a1.149,1.149,0,0,1,.415-.686,1.119,1.119,0,0,1,.738-.295h3.921A.782.782,0,0,1,1313.6,384.722Z" transform="translate(-1286.149 -384.427)" fill="#f9f7f3"/>
                    <path id="Path_69" data-name="Path 69" d="M1337.8,485.673a1.69,1.69,0,0,1,1.127-.416h9.8l-1.037,5.882h-9.8a1.2,1.2,0,0,1-.98-.417,1.241,1.241,0,0,1-.231-1.054l.519-2.941A1.742,1.742,0,0,1,1337.8,485.673Z" transform="translate(-1312.394 -464.177)" fill="#f9f7f3"/>
                    <path id="Path_70" data-name="Path 70" d="M1384.692,485.673a1.691,1.691,0,0,1,1.127-.416h9.8l-1.037,5.882h-9.8a1.2,1.2,0,0,1-.98-.417,1.238,1.238,0,0,1-.231-1.054l.519-2.941A1.741,1.741,0,0,1,1384.692,485.673Z" transform="translate(-1349.484 -464.177)" fill="#f9f7f3"/>
                    <path id="Path_71" data-name="Path 71" d="M1431.587,485.673a1.69,1.69,0,0,1,1.127-.416h9.8l-1.037,5.882h-9.8a1.2,1.2,0,0,1-.98-.417,1.24,1.24,0,0,1-.231-1.054l.519-2.941A1.742,1.742,0,0,1,1431.587,485.673Z" transform="translate(-1386.575 -464.177)" fill="#f9f7f3"/>
                    <path id="Path_72" data-name="Path 72" d="M1478.48,485.673a1.69,1.69,0,0,1,1.127-.416h9.8l-1.038,5.882h-9.8a1.2,1.2,0,0,1-.981-.417,1.242,1.242,0,0,1-.231-1.054l.519-2.941A1.744,1.744,0,0,1,1478.48,485.673Z" transform="translate(-1423.665 -464.177)" fill="#f9f7f3"/>
                    <path id="Path_73" data-name="Path 73" d="M1525.374,485.673a1.69,1.69,0,0,1,1.127-.416h9.8l-1.037,5.882h-9.8a1.2,1.2,0,0,1-.981-.417,1.241,1.241,0,0,1-.231-1.054l.519-2.941A1.741,1.741,0,0,1,1525.374,485.673Z" transform="translate(-1460.755 -464.177)" fill="#f9f7f3"/>
                    <path id="Path_74" data-name="Path 74" d="M1572.268,485.673a1.692,1.692,0,0,1,1.128-.416h9.8l-1.037,5.882h-9.8a1.2,1.2,0,0,1-.98-.417,1.24,1.24,0,0,1-.23-1.054l.519-2.941A1.741,1.741,0,0,1,1572.268,485.673Z" transform="translate(-1497.846 -464.177)" fill="#f9f7f3"/>
                    <path id="Path_75" data-name="Path 75" d="M1619.161,485.673a1.69,1.69,0,0,1,1.128-.416h9.8l-1.037,5.882h-9.8a1.2,1.2,0,0,1-.981-.417,1.242,1.242,0,0,1-.231-1.054l.519-2.941A1.742,1.742,0,0,1,1619.161,485.673Z" transform="translate(-1534.935 -464.177)" fill="#f9f7f3"/>
                    <path id="Path_76" data-name="Path 76" d="M1666.11,441.116a1.8,1.8,0,0,1,1.118-.371h10.836q-.228-.932-.426-2.034a10.265,10.265,0,0,0-.572-2.035,4.261,4.261,0,0,0-1.026-1.544,2.423,2.423,0,0,0-1.73-.613,5.009,5.009,0,0,0-1.669.294q-.219.077-.434.167a1.019,1.019,0,0,1-1.416-.747l-.5-2.8a15.015,15.015,0,0,1,3.277-1.764,9.429,9.429,0,0,1,3.43-.686,4.623,4.623,0,0,1,3.44,1.2,8.052,8.052,0,0,1,1.826,2.99,26.037,26.037,0,0,1,1.037,3.848,19.416,19.416,0,0,0,1.083,3.726h2.4l-1.037,5.883h-19.607a1.2,1.2,0,0,1-.98-.417,1.239,1.239,0,0,1-.23-1.053l.518-2.941A1.748,1.748,0,0,1,1666.11,441.116Zm8.522,9.09a3.408,3.408,0,0,1,2.024-.637,2.508,2.508,0,0,1,1.8.637,1.645,1.645,0,0,1,.507,1.569,2.416,2.416,0,0,1-1.061,1.569,3.411,3.411,0,0,1-2.024.637,2.506,2.506,0,0,1-1.8-.637,1.643,1.643,0,0,1-.508-1.569A2.417,2.417,0,0,1,1674.632,450.205Z" transform="translate(-1572.026 -419.665)" fill="#f9f7f3"/>
                    <path id="Path_77" data-name="Path 77" d="M1810.054,399.138a2.512,2.512,0,0,0-1.8-.635,3.429,3.429,0,0,0-2.025.635,2.437,2.437,0,0,0-1.061,1.569,1.638,1.638,0,0,0,.509,1.569,2.493,2.493,0,0,0,1.8.639,3.4,3.4,0,0,0,2.024-.639,2.436,2.436,0,0,0,1.061-1.569A1.639,1.639,0,0,0,1810.054,399.138Z" transform="translate(-1682.941 -395.56)" fill="#f9f7f3"/>
                    <path id="Path_78" data-name="Path 78" d="M1830.907,523.685a2.049,2.049,0,0,0-.689-.123,1.252,1.252,0,0,0-.7.2.961.961,0,0,0-.391.686.876.876,0,0,0,.213.735,1.192,1.192,0,0,0,.969.343h1.863l-.389,2.206h-6.078l.389-2.206h1.176a1.631,1.631,0,0,1-.418-1.519,2.547,2.547,0,0,1,1.193-1.766,3.947,3.947,0,0,1,2.171-.637,3.551,3.551,0,0,1,1.349.27,3.51,3.51,0,0,1,1.084.662L1831.464,524A1.561,1.561,0,0,0,1830.907,523.685Z" transform="translate(-1699.211 -492.923)" fill="#f9f7f3"/>
                    <path id="Path_79" data-name="Path 79" d="M1838.326,384.427h5.849l-4.754,26.962h-5.849Z" transform="translate(-1705.43 -384.427)" fill="#f9f7f3"/>
                    <path id="Path_80" data-name="Path 80" d="M1343.866,384.427h2.156l-.9,4.376" transform="translate(-1318.102 -384.427)" fill="#f9f7f3"/>
                    <path id="Path_81" data-name="Path 81" d="M1773.077,436.013l-2.16,12.255a4.62,4.62,0,0,1-1.637,2.771,4.485,4.485,0,0,1-2.974,1.153h-6.375a1.2,1.2,0,0,1-.978-.417,1.252,1.252,0,0,1-.233-1.056l.518-2.94a1.755,1.755,0,0,1,.605-1.056,1.694,1.694,0,0,1,1.129-.417h4.408l1.642-9.315a1.142,1.142,0,0,1,.417-.683,1.109,1.109,0,0,1,.736-.3Z" transform="translate(-1646.206 -425.228)" fill="#f9f7f3"/>
                    <path id="Path_82" data-name="Path 82" d="M1237.436,432.561l-3.027,17.151a12.972,12.972,0,0,1-1.366,4.054,10.1,10.1,0,0,1-2.267,2.833,8.76,8.76,0,0,1-2.969,1.666,10.88,10.88,0,0,1-3.425.543,13.608,13.608,0,0,1-3.753-.518l1.69-3.788a2.077,2.077,0,0,1,1.933-1.2h.015a3.776,3.776,0,0,0,2.523-.911,4.366,4.366,0,0,0,1.38-2.679l2.843-16.115a1.21,1.21,0,0,1,.441-.727,1.177,1.177,0,0,1,.78-.31Z" transform="translate(-1220.629 -422.498)" fill="#f9f7f3"/>
                  </g>
                  <path id="Path_132" data-name="Path 132" d="M1802.663,568.345a2.493,2.493,0,0,0-1.8-.639,3.4,3.4,0,0,0-2.025.639,2.413,2.413,0,0,0-1.061,1.57,1.625,1.625,0,0,0,.508,1.564,2.493,2.493,0,0,0,1.8.64,3.4,3.4,0,0,0,2.025-.64,2.4,2.4,0,0,0,1.061-1.564A1.632,1.632,0,0,0,1802.663,568.345Zm3.706,14,.509-2.877a.4.4,0,0,0,.01-.068Z" transform="translate(-934.052 -116.909)" fill="#f9f7f3"/>
                  <path id="Path_133" data-name="Path 133" d="M1802.663,568.345a2.493,2.493,0,0,0-1.8-.639,3.4,3.4,0,0,0-2.025.639,2.413,2.413,0,0,0-1.061,1.57,1.625,1.625,0,0,0,.508,1.564,2.493,2.493,0,0,0,1.8.64,3.4,3.4,0,0,0,2.025-.64,2.4,2.4,0,0,0,1.061-1.564A1.632,1.632,0,0,0,1802.663,568.345Zm3.706,14,.509-2.877a.4.4,0,0,0,.01-.068Z" transform="translate(-940.796 -116.909)" fill="#f9f7f3"/>
                </g>
              </svg>
            </h1>
          </div>
          <div class="row">
            <p class="footer-paragraph">
              {{ $setting->slogan }}
            </p>
          </div>
          <div class="row">
            <p class="footer-paragraph text-right" style="direction: ltr;">
              <span class="inn"><i class="fa fa-phone"></i><a href="tel:{{ $setting->phone }}"> +996{{ $setting->phone }}</a></span>
              <br>
               <span class="inn"><i class="fa fa-whatsapp"></i><a href="https://wa.me/966{{ $setting->general_whats }}" target="_blank"> 0{{ $setting->general_whats }}</a></span>
              <br>
              {{ $setting->address }}
            </p>
          </div>
           
          <div class="row">
           
            @if(!empty($setting->facebook) && $setting->facebook != '' && $setting->facebook !== '#')
              <a class="socila-icons" href="{{ $setting->facebook }}" target="_blank">
                <i class="fa fa-facebook"></i>
              </a>
            @endif

            @if(!empty($setting->twitter) && $setting->twitter != '' && $setting->twitter != '#')
              <a class="socila-icons" href="{{ $setting->twitter }}" target="_blank">
                <i class="fa fa-twitter"></i>
              </a>
            @endif

            @if(!empty($setting->instagram) && $setting->instagram != '' && $setting->instagram != '#')
              <a class="socila-icons" href="{{ $setting->instagram }}" target="_blank">
                <i class="fa fa-instagram"></i>
              </a>
            @endif

            @if(!empty($setting->youtube) && $setting->youtube != '' && $setting->youtube != '#')
              <a class="socila-icons" href="{{ $setting->youtube }}" target="_blank">
                <i class="fa fa-youtube"></i>
              </a>
            @endif

            @if(!empty($setting->linkedin) && $setting->linkedin != '' && $setting->linkedin != '#')
              <a class="socila-icons" href="{{ $setting->linkedin }}" target="_blank">
                <i class="fa fa-linkedin"></i>
              </a>
            @endif

            @if(!empty($setting->snapchat) && $setting->snapchat != '' && $setting->snapchat != '#')
              <a class="socila-icons" href="{{ $setting->snapchat }}" target="_blank">
                <i class="fa fa-snapchat"></i>
              </a>
            @endif

          </div>
          
        </div>
        <div class="col-12 col-md-4 text-right">
          <div class="row" style="">
            <div class="col-md-6">
              <nav class="navbar">
                <ul class="navbar-nav p-0">
                  <li class="nav-item">
                    <a class="nav-link footer-links" href="{{ route('index')}}">الرئيسية</a>
                  </li>

                  {{-- <li class="nav-item">
                    <a class="nav-link footer-links" href=" {{ route('vendors')  }}">المعقبين</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link footer-links" href="{{ route('vendors-company')  }}">مكاتب الخدمات</a>
                  </li> --}}
                  <li class="nav-item">
                    <a class="nav-link footer-links" href="{{ route('mo3amla')}}">طلب معاملة</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link footer-links" href="{{ route('ta3med')}}">طلب تعميد</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link footer-links" href="{{ route('guarante')}}">ضمان مبلغ سلعة</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link footer-links" href="{{ route('estfsar')}}">طلب استفسار</a>
                  </li>
                </ul>
              </nav>
            </div> {{-- end col6 --}}

             <div class="col-md-6">
               <nav class="navbar">
                <ul class="navbar-nav p-0">
                  <li class="nav-item"> 
                    <a class="nav-link footer-links" href="{{ route('faq')}}">الاسئلة الشائعة</a>
                  </li>
                  <li class="nav-item"> 
                    <a class="nav-link footer-links" href="{{ route('blog')}}">المدونة</a>
                  </li>
                  <li class="nav-item"> 
                    <a class="nav-link footer-links" href="{{ route('black_list')}}">القائمة السوداء</a> <span class="badge">جديد</span>
                  </li>
                  
                  <li class="nav-item">
                    <a class="nav-link footer-links" href="{{ route('contact')}}">تواصل معنا</a>
                  </li>
                </ul>
              </nav>
             </div>{{-- end col6 --}}
             
          </div>{{-- end row --}}

          <div class="row footerPayment">
            <div class="col-md-12">
                <p>طرق الدفع المتوفرة</p>
                <div class="payment_icon">
                  <ul>
                      <li><img width="70" src="{{ asset('images/visa.png')}}" alt="الدفع عبر بطاقات الفيزا"></li>
                      <li><img width="70" src="{{ asset('images/master.png')}}" alt="الدفع عبر بطاقات الماستر كارد"></li>
                      <li><img width="70" src="{{ asset('images/mada.png')}}" alt="الدفع عبر بطاقات مدى"></li>
                      <li><img width="70" src="{{ asset('images/transfer.png')}}" alt="الدفع عبر بطاقات مدى"></li>
                  </ul>
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="col-12 col-md-2 text-right">
          <div class="row" style="">

            

          </div>
        </div> --}}
        <div class="col-12 col-md-4 text-right">
          <div class="row" style="padding-top: 15px;overflow:hidden; height:150px;">


            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="68.566" height="58.222" viewBox="0 0 68.566 58.222">
              <g id="Group_176" data-name="Group 176" transform="translate(-1426.352 -3944.317)">
                <path id="Path_51" data-name="Path 51" d="M-548.346,367.522h53.222l-9.385,53.222H-557.73Z"
                  transform="translate(1987.062 3579.294)" fill="none" stroke="#f9f7f3" stroke-width="5" />
                <g id="Group_47" data-name="Group 47" transform="translate(1443.714 3955.927)">
                  <path id="Path_54" data-name="Path 54"
                    d="M801.557,434.028,797.065,459.5H771.59l5.39-30.57h5.1l-4.492,25.475h15.285l.9-5.095h-10.19l.9-5.095h10.19l.9-5.095h-10.19l.9-5.095Z"
                    transform="translate(-771.59 -423.838)" fill="#f9f7f3" />
                  <path id="Path_55" data-name="Path 55"
                    d="M899.356,383.941l-.9,5.095h-5.095l.9-5.095h-20.38l.9-5.1h20.38Z"
                    transform="translate(-863.476 -378.846)" fill="#f9f7f3" />
                </g>
              </g>
            </svg> --}}

            {{-- <iframe src="https://maroof.sa/Business/GetStamp?bid=91828" style=" width: 100%; height: 250px;     overflow-y: hidden;  "  frameborder="0" seamless='seamless' scrollable="no"></iframe> --}}
                                    
          <a href="https://maroof.sa/91828" target="_blank" style="display: inline-block;margin: 0;left: 22px;top: 17px;position: absolute;"><img src="{{ asset('images/ma3roof.png') }}" width="200"></a>

          </div>
          {{-- <div class="row text-center">
            <a target="_blank"  style="    margin-right: auto;margin-left: 30px;display: inline-block;" href="https://qr.mci.gov.sa/info/review?lang=ar&q=MrWwK94mDjLCjxWQXGgP8w=="><img src='{{ asset('images/Cr-4030328458.png') }}' width="150" /></a>
          </div> --}}
        </div>
      </div>
    </div>
    <div class="row footer-copyrights mt-3">
      <div class="col-12 container" style="padding: 0;">
        <div class="d-flex justify-content-between container">
          <div>
            <p class="pt-2 pb-2" style="margin-bottom: 0;">© جميع الحقوق محفوظة لصالح مؤسسة إنجاز فوري </p>
          </div>
          <div>
            <p class="pt-2 pb-2" style="margin-bottom: 0;">
              {{-- تم تطويره بواسطة 
              <a href="https://webstdy.com/">ويبستدي</a> --}}
              تم تطويره بواسطة :  <a title="ويب ستدي لتصميم و برمجة المواقع" target="_blank" href="https://webstdy.com">
                        <img src="https://webstdy.com/CDN/cr_dark.png" title="ويب ستدي لتصميم و برمجة المواقع" alt="شركة ويب ستيدي للبرمجيات" style="height:30px">
                    </a>
            </p>
          </div>
        </div>
      </div>
    </div>

  </footer>


<!--begin::Page Scripts -->
@stack('page_scripts')

  <script type="text/javascript">


    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

      //  reader.fileName = input.name // file came from a input file element. file = el.files[0];

        
        reader.onload = function(e) {
          $('.progress').show();
          $('.progress-bar').show();
        

          
          $('.progress-bar').text('تم اختيار المرفق بنجاح');
          $('.progress-bar').css('width', '100%');
           $('.inputTextPreview').append('');

          //$('#imagePreviewWrap #imagePreview').attr('src', e.target.result);

        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }


   

	// Default Configuration
		$(document).ready(function() {


      
      var $root = $('html, body');

      $('a#toApps').click(function () {
          $root.animate({
              scrollTop: $( $.attr(this, 'href') ).offset().top
          }, 300);

          return false;
      });

      $(".inputWithPreview").change(function() {
        readURL(this);
      });

			toastr.options = {
				'closeButton': false,
				'debug': false,
				'newestOnTop': false,
				'progressBar': false,
				'positionClass': 'toast-top-left',
				'preventDuplicates': false,
				'showDuration': '1000',
				'hideDuration': '1000',
				'timeOut': '15000',
				'extendedTimeOut': '1000',
				'showEasing': 'swing',
				'hideEasing': 'linear',
				'showMethod': 'fadeIn',
				'hideMethod': 'fadeOut',
			}
		});
		

	// Toast Type
	//	$('#success').click(function(event) {
	//		toastr.success('You clicked Success toast');
	//	});
  </script>
  
{{--   @if(isset($success))

  {{-- hello --}}
  {{-- <script>toastr.success( {{$success}} );</script>

  @endif --}} 



</body>

</html>