@extends('engazFawry.layouts.app')

@push('page_styles')
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
@endpush

@section('title')لماذا منصة إنجاز فوري؟@endsection

@section('seo')
<meta name="title" content="لماذا منصة إنجاز فوري؟">
<meta name="description" content="منصة متخصصه في التعقيب وإنجاز جميع الخدمات  وتراخيص الأنشطة التجاريه (خبره 25 عاما) 0566661105">
@endsection

@section('content')
{{-- <section class=""
    style="background-image: url('images/header.jpg');background-size: cover;height: calc(100vh - 120px); max-height: 700px;">
</section> --}}

<div class="homeSlider">

  <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselIndicators" data-slide-to="1"></li>
    <!--<li data-target="#carouselIndicators" data-slide-to="2"></li>-->
    <!--<li data-target="#carouselIndicators" data-slide-to="3"></li>-->
    <!--<li data-target="#carouselIndicators" data-slide-to="4"></li>-->
    <!--<li data-target="#carouselIndicators" data-slide-to="5"></li>-->
    <!--<li data-target="#carouselIndicators" data-slide-to="6"></li>-->
    <!--<li data-target="#carouselIndicators" data-slide-to="7"></li>-->
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="{{ asset('images/slider/2030.jpg')}}" alt="رؤية 2030">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('images/slider/register.jpg')}}" alt="فتح باب التسجيل">
        <div class="carousel-caption " style="">
          {{-- <h1 class="banner-text-size" style="font-size:40px;text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000;"> MY Headline here</h1> --}}
          <a href="{{ route('signup_vendor')}}" style="display:inline-block" type="button" class="btn engaz-main-btn transform">تسجيل</a>
        </div>
      
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('images/slider/3ml.jpg')}}" alt="خدمات وزارة العمل">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('images/slider/gawazat.jpg')}}" alt="خدمات الجوازات">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('images/slider/mosaned.jpg')}}" alt="خدمات مساند">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('images/slider/mror.jpg')}}" alt="خدمات المرور">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('images/slider/tgara.jpg')}}" alt="خدمات وزارة التجارة">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('images/slider/zakah.jpg')}}" alt="خدمات الزكاه والدخل">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">السابق</span>
  </a>
  <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">التالي</span>
  </a>
</div>
</div>

<section class="marqueeOnHome transform">
  <div class="container">
    <div class="col-md-3 order-1 pull-right marqueTitle ">
      اخر الطلبات
    </div>
    <div class="col-md-9 order-2 pull-right white">
      <div class="marquee" style="display:none;">
        <ul>
          @foreach ($marquee_array as $marq)
            <li><span class="mainTitle">{{ $marq['name'] }} رقم <span class="numb"> {{ $marq['key'] }}</span></span> @if($marq['value'] != ''): @endif {{ $marq['value'] }}</li>
          @endforeach
        </ul>
      </div>
    </div>
   
  </div>
</section>


{{-- {{ dd($marquee_array) }} --}}
  <section class="light">
    <div class="container">
      <div class="text-center">
        <h1 class="text-center engaz-heading-dot">لماذا إنجاز فوري؟</h1>
      </div>
      <div class="row">
        <div class="col-12 col-md-4">
          <div class="text-right engaz-card-icon">
            <div class="custom-icons">
              <i class="{{$home->sitWork_icon1}}"></i>
            </div>
            <p class="engaz-card transform">
              {{ $home->sitWork_text1 }} 
            </p>
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="text-right engaz-card-icon">
            <div class="custom-icons">
              <i class="{{$home->sitWork_icon2}}"></i>
            </div>
        
            <p class="engaz-card transform">
              {{ $home->sitWork_text2 }}
            </p>
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="text-right engaz-card-icon">
            <div class="custom-icons">
              <i class="{{$home->sitWork_icon3}}"></i>
            </div>
            <p class="engaz-card transform">
              {{ $home->sitWork_text3 }} 
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="dark">
    <div class="container">
      <div class="text-center">
        <h1 class="text-center engaz-heading-dot">اختار الخدمة</h1>
      </div>
      <div class="btn-group row text-center justify-content-center" style="width: 100%;">
        <div class="col-md-4 col-xs-12">
          <a class="services_home" href="{{ route('ta3med')}}"><button type="button" class="btn engaz-main-btn transform">طلب تعمـيـد</button></a>
        </div>

        <div class="col-md-4 col-xs-12">
          <a class="services_home" href="{{ route('mo3amla')}}"><button type="button" class="btn engaz-main-btn transform">طلب معاملة</button></a>
        </div>
        <div class="col-md-4 col-xs-12">
          <a class="services_home" href="{{ route('guarante')}}"><button type="button" class="btn engaz-main-btn transform">طلب ضمان مبلغ سلعة</button></a>
        </div>
        <div class="col-md-4 col-xs-12">
          <a class="services_home" href="{{ route('estfsar')}}"><button type="button" class="btn engaz-main-btn transform">طلب استفسار مدفوع</button></a>
        </div>
        <div class="col-md-4 col-xs-12">
          <a class="services_home" href="{{ route('sharkat')}}"><button type="button" class="btn engaz-main-btn transform">طلبات الشركـــات</button></a>
        </div>
        
      </div>
    </div>
  </section>

  <section class="light">
    <div class="container">
      <div class="row" id="counter">
        <div class="col-12 col-md-4">
          <div class="counter text-center">
            {{-- Clients --}}
            <i class="fa fa-bolt"></i>
            {{-- <div class="count counter-number" data-count="{{ $home->counter1_no }}">0</div> --}}
            <div class="count counter-number" data-count="{{ $orders }}">0</div>
            <p class="counter-text">عدد الطلبات</p>
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="counter text-center">
            {{-- vendors --}}
            <i class="fa fa-user-circle"></i>

            <div class="count counter-number" data-count="{{ $clients_count }}">0</div>
            <p class="counter-text">عميل</p>

          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="counter text-center">
             {{-- vendorsC --}}
            <i class="fa fa-address-card"></i>

            <div class="count counter-number" data-count="{{ $allVendors }}">0</div>
            <p class="counter-text">معقب / مكتب خدمات</p>
          </div>
        </div>
      </div>

      
    </div>
  </section>

  <section class="dark" id="reviews" style="padding-top:122px;">
    <div class="container">

      <div class="text-center" style="margin-bottom:50px">
        <h1 class="text-center engaz-heading-dot" >اراء العملاء</h1>
      </div>

      <div class="owl-carousel owl-theme">

        @foreach($site_review as $review)
          <div class="item">
            <div class="stars">
              {!! printStars($review->stars) !!}
            </div>
            <h4>{{ $review->name }}</h4>
            <p>{{ $review->desc }}</p> 
          </div>
        @endforeach
      </div>

    </div>
  </section>
  
@csrf
  <section class="light" id="download_apps" style="padding-top:122px">
    <div class="container">

      <div class="text-center">
        <h1 class="text-center engaz-heading-dot">تنزيل التطبيق</h1>
      </div>

      <div class="row">
        <div class="col-2 col-lg-2 col-xs-12"></div>
        <div class="col-8 col-lg-8 col-xs-12">
          <div class="d-inline-block py-4 text-center iconzWrap">
            <a target="_blank" href="https://apps.apple.com/us/app/id1515734655" class="px-3 iconz">
              <img class="downlad-app-btn" alt="download" src="{{ asset('images/iosp.png') }}">
            </a>
            <a target="_blank" href="https://play.google.com/store/apps/details?id=stdy.web.ingaz.fawry" class="px-3 iconz">
              <img class="downlad-app-btn mt-4 mt-lg-0" alt="Play Store" src="{{ asset('images/google.png') }}">
            </a>
        </div>
        <div class="col-2 col-lg-2 col-xs-12"></div>
        </div>

      </div>

    </div>
  </section>

  
  @if($setting->warning_on == 1 )
  <!--Footer End-->
  <div id="warning_enjaz" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" style="text-align: right; direction:rtl;"> @if($setting->warning_title != '')  {{ $setting->warning_title }}@else تنويه هـــام @endif</h4>

                <button style="margin:-1rem auto -1rem -1rem" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body" style="text-align: right; direction:rtl;">
              @if($setting->warning_text == '' )
              
                  <h4>عملائنا الكرام ... </h4>
                  <p>
                    لاحظنا في الأيام الماضية استغلال بعض ضعاف النفوس اسم إنجاز فوري للترويج لخدمات وهمية وإجراء عمليات نصب واحتيال على العملاء باستخدام بعض روابط المنصة للترويج لهم ، لذا وحرصا منا على تأمين عملائنا وتنبيههم 
                    <b>وتأكيدا على الهدف الاساسي لانشاء منصة انجاز فوري وهو (حماية العملاء وضمان وصول الخدمات للعملاء باعلى جودة واقل تكلفة )</b>
                    نأمل منكم التأكد من التالي
                    <br>

                    <ul>
                      <li> وسيلة الاتصال التي تمثلنا هي ( 0566661105 ) فقط </li>
                      <li>رقم الحسابات البنكية أدناه فقط </li>
                    </ul>     
                    وما يتم تداوله عبر شبكة الإنترنت غير ما ذكر أعلاه لا يمثلنا وغير مسؤولين عنه إطلاقا
                  </p>
               
                  <table class="table table-bordered" style="color:#fff">
                    <tbody>
                      <tr>
                        <td>اسم الحساب</td>
                        <td>مؤسسة انجاز فوري</td>
                      </tr>
                      <tr>
                        <td>رقم الحساب</td>
                        <td>648608010012340</td>
                      </tr>
                        <td>رقم الايبان </td>
                        <td>SA6180000648608010012340 </td>
                      </tr>
                    </tbody>
                  </table>

                  @else 

                 {!! $setting->warning_text !!}

                  @endif

            </div>
        </div>
    </div>
</div>
@endif

@endsection

@push('page_scripts')
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>

@if($setting->warning_on == 1 )
  <script>
      $(document).ready(function(){
          $("#warning_enjaz").modal('show');
      });
  </script>
@endif

<script type='text/javascript' src='{{asset('js/engazFawry/')}}/jquery.marquee.min.js'></script>


<script>

$(document).ready(function(){ 

  // $(".owl-carousel").owlCarousel();


  $('.owl-carousel').owlCarousel({
    loop:true,
    rtl:true,
    nav:false,
    autoplay:true,
    autoplayHoverPause:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:4,
            nav:false,
            loop:true
        }
    }
});
      
  $('.marquee').show();


  $('.marquee').marquee({
      //speed in milliseconds of the marquee
      duration: 20000,
      //gap in pixels between the tickers
      gap: 0,
      //time in milliseconds before the marquee will start animating
      delayBeforeStart: 0,
      //'left' or 'right'
      direction: 'right',

      pauseOnHover: true,
      //true or false - should the marquee be duplicated to show an effect of continues flow
      duplicated: true
  });
  // $(".getUserModal").on('click', function () {

  //     var user_id = $(this).data('user');

  //       var token = $("input[name='_token']").val();
  //       $.ajax({
  //           url: "{{ route('ajax.vendorData') }}",
  //           method: 'POST',
  //           data: {user_id:user_id, _token:token},
  //           success: function(data) {
  //             $("#ajaxRespons").html(data.options);
  //           }
  //       });
    
  //     $('#userModal').modal('show');

  // });

  // $('#userModal').on('hidden.bs.modal', function () {
  //     $("#ajaxRespons").html('');
  // });
});
</script>
<script>
  $(window).scroll(function() {
      if ($('#counter').is(':visible')) {
          $('.count').each(function() {
            var $this = $(this),
            countTo = $this.attr('data-count');
          
            $({ countNum: $this.text()}).animate({
              countNum: countTo
            },

            {

              duration: 800,
              easing:'linear',
              step: function() {
                $this.text(Math.floor(this.countNum));
              },
              complete: function() {
                $this.text(this.countNum);
              }

            });  
        });
      }
  });
</script>
@endpush