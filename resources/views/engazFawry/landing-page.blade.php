<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="desciption" content="منصة رقمية توفر لك كل ما تحتاجه من خدمات تعقيب لإنهاء المعاملات الحكومية باحترافية وفي أسرع وقت، لدينا أكثر من 110 مكتب تعقيب و معقب محترف في خدمتك." >

    <title>   @yield('title' ,"خدمات تعقيب احترافية في منصة رقمية واحدة - إنجاز فوري")</title>


    @yield('seo')

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MCN54JT');</script>
    <!-- End Google Tag Manager -->


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/engazFawry/bootstrap.min.rtl.css') }}">
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
    <script src="https://use.fontawesome.com/d5972571a6.js"></script>

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
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <style>
        .landing-page .logo{
            width: 150px;
            padding: 0;
        }
        body{
            padding-top: 0;
        }
        .text-lightBlue{
            color: #3CBFAF;
        }
        .text-lightBlue.engaz-heading-dot::after{
            background-color: #3CBFAF;
        }
        .text-blue{
            color: #23395B;
        }
        .text-purple{
            color: #853BCC;
        }
        .intro{
            background-image: url('{{asset("web/intro-bg.png")}}');
            background-position: bottom right;
            background-size: cover;
            background-repeat: no-repeat;
        }
        .font-smaller{
            font-size: 12px;
            margin-right: 23px;
        }
        .corporations{
            margin-top: 50px;
        }
        .corporations .img-container{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .corporations .title{
            text-align: center;
            color: #23395B;
            font-size: 23px;
            margin-bottom: 30px;
        }
        .how-to .title{
            color: #853BCC;
            font-size: 27px;
            text-align: center;
        }
        .how-to .engaz-card-title{
            display: inline-flex;
            background-color: #3CBFAF;
            color: #fff;
            -ms-transform: skew(175deg,0deg);
            -webkit-transform: skew(175deg,0deg);
            transform: skew(175deg,0deg);
            margin-right: 5px;
        }
        .how-to .engaz-card-title h6:first-child{
            padding: 10px;
            width: 50px;
            text-align: center;
            background-color: #853BCC;
            color: #fff;
            margin-bottom: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .how-to .engaz-card-title h6:not(:first-child){
            padding: 15px 20px;
            width: 260px;
            overflow: hidden;
            text-align: justify;
            margin-bottom: 0;
            text-align: center;
        }
        .engaz-card{
            margin-right: 64px;
            background-color: #F2EFEA;
            color: #23395B;
            text-align: center;
        }
        .engaz-card-icon .custom-icons img{
            width: 90%;
        }
        .why-item{
            text-align: center;
        }
        .why-item img{
            margin-bottom: 20px;
        }
        footer{
            background-color: #853BCC;
            padding: 10px;
        }
        footer::before{
            display: none;
        }
        footer p{
            margin-bottom: 0;
            color: #fff;
        }
        footer a{
            border: 1px solid #fff;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }
        .service-card{
            margin-top: 30px;
        }
        .service-card .head{
            background-color: #3CBFAF;
            color: #fff;
            text-align: center;
            font-size: 16px;
            padding: 20px
        }
        .service-card .details{
            background-color: #F2EFEA;
            color: #23395B;
            padding: 30px
        }
        .service-card .details .item{
            display: inline-flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .service-card .details .item p{
            margin-bottom: 0
        }
        .service-card .details .item .num{
            background-color: #853BCC;
            color: #fff;
            position: relative;
            width: 30px;
            height: 30px;
            margin-left: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .service-card .details .item .num::before{
            content: '';
            position: absolute;
            width: 30px;
            height: 30px;
            border: 2px solid #853BCC;
            left: -5px;
            top: 5px;
        }
        .stars .product-rating span{
            color: #eee;
        }
        .stars .product-rating span.checked{
            color: orange;
        }
        .why .section-img{
            width: 50%;
        }
        @media(max-width: 800px){
            .why .section-img{
                width: 100%;
            }
            .corporations .img-container{
                margin-top: 30px;
            }
            .how-to p.w-50{
                width: 100% !important;
            }
            .engaz-main-btn{
                width: 100%;
            }
            .font-smaller{
                font-size: 15px;
                text-align: center;
                margin-right: 0;
            }
        }
    </style>
</head>

<body>

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



    <div class="min-height landing-page">
        <section class="intro">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-12">
                        <img src="{{asset('images/logo.png')}}" alt="" class="logo">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center">
                        <div>
                            <h1>
                                كل ما تحتاجه من خدمات تعقیب
                                في منصة رقمیة واحدة
                            </h1>
                            <p>
                                إذا كنت تبحث عن مكتب تعقیب أو معقب لإنھاء إجراءات جوازات أو نقل كفالة أو شطب سجل تجاري أو تفویض تأشیرة فمنصة إنجاز فوري ھي خیارك الأمثل حیث تضم أكثر من 110 مكتب ومعقب لإنجاز معاملاتك  في أسرع وقت
                            </p>
                            <div class="mb-4">
                                <a href="https://enjaz-fawry.com/signup" class="btn engaz-main-btn transform">انشئ حسابك الآن</a>
                                <p class="mb-0 font-smaller text-lightBlue">
                                    انشاء الحساب مجاني والدفع مقابل الخدمات فقط
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center">
                        <img src="{{asset('web/intro.png')}}" alt="" class="w-75">
                    </div>
                </div>

                <div class="row corporations">
                    <div class="col-12">
                        <h2 class="title">
                            خدمات تعقیب احترافیة لإنھاء معاملاتك في ھذه الجھات بأسرع وقت
                        </h2>
                    </div>
                    <div class="col-6 col-lg-2 img-container">
                        <img src="{{asset('web/الجوازات السعودية.png')}}" alt="">
                    </div>
                    <div class="col-6 col-lg-2 img-container">
                        <img src="{{asset('web/وزارة التجارة والاستثمار.png')}}" alt="">
                    </div>
                    <div class="col-6 col-lg-2 img-container">
                        <img src="{{asset('web/2560px-شعار_وزارة_العمل_والتنمية_الاجتماعية_السعودية.svg.png')}}" alt="">
                    </div>
                    <div class="col-6 col-lg-2 img-container">
                        <img src="{{asset('web/1200px-General_Department_of_Traffic_of_Saudi_Arabia.svg.png')}}" alt="">
                    </div>
                    <div class="col-6 col-lg-2 img-container">
                        <img src="{{asset('web/شعار-الزكاة-والدخل.png')}}" alt="">
                    </div>
                    <div class="col-6 col-lg-2 img-container">
                        <img src="{{asset('web/logo.c419e12d.png')}}" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section class="how-to">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h5 class="title">
                            أنت على بعد ثلاث خطوات فقط من إنھاء معاملاتك
                        </h5>
                        <p class="text-center w-50 mx-auto">
                            بعد إنشاء حسابك المجاني على منصة إنجاز فوري یمكنك الاختیار بین خدمات تعقیب عدیدة منھا طلب نقل كفالة أو التفویض على تأشیرة أو شطب سجل تجاري وغیرھا من خدمات التعقیب في مكتب العمل ووزارة التجارة والاستثمار والمرور وجھات أخرى
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="text-right engaz-card-icon">
                                <div class="custom-icons">
                                    <img src="{{asset('web/icon-1.png')}}" alt="">
                                </div>
                                <div class="engaz-card-title">
                                    <h6>1</h6>
                                    <h6 class="">
                                        إنشاء حساب على منصة
                                        إنجاز فوري
                                    </h6>
                                </div>
                                <p class="engaz-card transform">
                                    أدخل بیاناتك لإنشاء حسابك على منصة التعقیب إنجاز فوري ثم أدخل رقم تأكید الحساب الذي یصلك عبر ھاتفك الجوال.
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="text-right engaz-card-icon">
                                <div class="custom-icons">
                                    <img src="{{asset('web/icon-2.png')}}" alt="">
                                </div>
                                <div class="engaz-card-title">
                                    <h6>2</h6>
                                    <h6 class="">
                                        اختیار الخدمة وتقدیم الطلب من حسابك
                                    </h6>
                                </div>
                                <p class="engaz-card transform">
                                    من داخل لوحة التحكم في حسابك اختر الجھة الرسمیة وخدمة التعقیب التي تریدھا في ھذه الجھة وقدم طلبك.
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="text-right engaz-card-icon">
                                <div class="custom-icons">
                                    <img src="{{asset('web/icon-3.png')}}" alt="">
                                </div>
                                <div class="engaz-card-title">
                                    <h6>3</h6>
                                    <h6 class="">
                                        استقبال مكالمة تأكیدیة وإتمام الطلب
                                    </h6>
                                </div>
                                <p class="engaz-card transform">
                                    سیتواصل معك أحد مكاتب التعقیب أو معقب محترف مسجل لدى المنصة لتأكید طلبك وإبلاغك بمیعاد الانتھاء منھ.
                                </p>
                            </div>
                            </div>
                        </div>
                </div>
            </div>
        </section>
        <section class="dark" id="reviews" style="padding-top:122px;">
            <div class="container">

                <div class="text-center" style="margin-bottom:50px">
                    <h4 class="text-center engaz-heading-dot text-lightBlue">
                        تشرفنا بتقدیم خدمات التعمید والتعقیب لأكثر من 7,100 عمیل وھذه بعض آرائھم
                    </h4>
                </div>

                <div class="owl-carousel owl-theme">

                    @foreach (App\SiteReviews::whereIn('id',[51,14,59,65,73,103,102,88,87,86,80,81,76])->where('status', 1)->get() as $review )
                        <div class="item">
                            <div class="stars">
                                <div class="product-rating">
                                    @for ($i=1 ; $i <= 5 ; $i++)
                                        <span class="fa fa-star @if($i <= $review->stars) checked @endif"></span>
                                    @endfor
                                </div>
                            </div>
                            <h4>{{$review->name}}</h4>
                            <p>
                                {{$review->desc}}
                            </p>
                        </div>
                    @endforeach



                </div>


                <div class="text-center">
                    <a  href="https://enjaz-fawry.com/signup" class="btn engaz-main-btn transform">انشئ حسابك الآن</a>
                    <p class="mb-0 font-smaller text-lightBlue">
                        انشاء الحساب مجاني والدفع مقابل الخدمات فقط
                    </p>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-center engaz-heading-dot text-purple">
                            أبرز خدمات إتمام المعاملات  التي توفرھا منصة إنجاز فوري
                        </h4>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="service-card transform">
                            <div class="head">
                                <h6>خدماتنا في وزارة العمل والتنمیة الاجتماعیة</h6>
                            </div>
                            <div class="details">
                                <div class="item">
                                    <p class="num">1</p>
                                    <p>فتح ملف - تفعیل ملف - شطب ملف</p>
                                </div>
                                <div class="item">
                                    <p class="num">2</p>
                                    <p>تعدیل مھنة - نقل كفالة - شھادة سعودة</p>
                                </div>
                                <div class="item">
                                    <p class="num">3</p>
                                    <p>إصدار تأشیرة عمل - إصدار رخصة عمل</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="service-card transform">
                            <div class="head">
                                <h6>
                                    خدماتنا في الجوازات
                                </h6>
                            </div>
                            <div class="details">
                                <div class="item">
                                    <p class="num">1</p>
                                    <p>
                                        نقل كفالات - نقل معلومات - برنت معلومات
                                    </p>
                                </div>
                                <div class="item">
                                    <p class="num">2</p>
                                    <p>
                                        تعدیل المھنة - إصدار إقامة - بلاغ تغیب
                                    </p>
                                </div>
                                <div class="item">
                                    <p class="num">3</p>
                                    <p>
                                        إلغاء بلاغ تغیب - إنھاء مخالفات الوافدین
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="service-card transform">
                            <div class="head">
                                <h6>
                                    خدماتنا في وزارة التجارة والاستثمار
                                </h6>
                            </div>
                            <div class="details">
                                <div class="item">
                                    <p class="num">1</p>
                                    <p>
                                        إصدار أو تجدید سجل تجاري
                                    </p>
                                </div>
                                <div class="item">
                                    <p class="num">2</p>
                                    <p>
                                        تعدیل أو شطب سجل تجاري
                                    </p>
                                </div>
                                <div class="item">
                                    <p class="num">3</p>
                                    <p>
                                        حجز اسم تجاري و إفادة عدم وجود سجل
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="service-card transform">
                            <div class="head">
                                <h6>
                                    خدماتنا في المرور بالأمن العام
                                </h6>
                            </div>
                            <div class="details">
                                <div class="item">
                                    <p class="num">1</p>
                                    <p>
                                        نقل ملكیة سیارة - تجدید رخصة قیادة
                                    </p>
                                </div>
                                <div class="item">
                                    <p class="num">2</p>
                                    <p>
                                        لوحات بدل فاقد - لوحات بدل تالف
                                    </p>
                                </div>
                                <div class="item">
                                    <p class="num">3</p>
                                    <p>
                                        برنت معلومات - تامین سیارات
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="service-card transform">
                            <div class="head">
                                <h6>
                                    خدماتنا في منصة مساند
                                </h6>
                            </div>
                            <div class="details">
                                <div class="item">
                                    <p class="num">1</p>
                                    <p>
                                        استخراج تأشیرات عمالة منزلیة وسائقین
                                    </p>
                                </div>
                                <div class="item">
                                    <p class="num">2</p>
                                    <p>
                                        استخراج تأشیرة مربیة أو ممرضة منزلیة
                                    </p>
                                </div>
                                <div class="item">
                                    <p class="num">3</p>
                                    <p>
                                        إلغاء تأشیرات العمالة المنزلیة
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="service-card transform">
                            <div class="head">
                                <h6>
                                    خدماتنا في الھیئة العامة للزكاة والدخل
                                </h6>
                            </div>
                            <div class="details">
                                <div class="item">
                                    <p class="num">1</p>
                                    <p>
                                        فتح ملف والتسجیل في القیمة المضافة
                                    </p>
                                </div>
                                <div class="item">
                                    <p class="num">2</p>
                                    <p>
                                        رفع الإقرارات الزكویة والضریبیة
                                    </p>
                                </div>
                                <div class="item">
                                    <p class="num">3</p>
                                    <p>
                                        إیقاف الرقم الممیز والتصفیة النھائیة
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <a href="https://enjaz-fawry.com/signup" class="btn engaz-main-btn transform">انشئ حسابك الآن</a>
                            <p class="mb-0 font-smaller text-lightBlue">
                                انشاء الحساب مجاني والدفع مقابل الخدمات فقط
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="dark why">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex flex-column justify-content-center">
                        <h4 class="text-center engaz-heading-dot text-purple">
                            لماذا تختار خدمات التعقیب والتعمید التي تقدمھا منصة إنجاز فوري؟
                        </h4>
                        <img src="{{asset('web/why-new.png')}}" alt="" class="my-4 mx-auto section-img">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="why-item">
                            <img src="{{asset('web/icon-4.png')}}" alt="">
                            <h5 class="text-lightBlue">
                                متابعة طلبات التعمید والتعقیب في أي وقت
                            </h5>
                            <p>
                                تابع حالة طلباتك من أي مكان سواء عبر
                                موقع منصة إنجاز فوري أو تطبیق الجوال
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="why-item">
                            <img src="{{asset('web/icon-5.png')}}" alt="">
                            <h5 class="text-lightBlue">
                                خبرة طویلة في إنھاء المعاملات
                            </h5>
                            <p>
                                لدینا خبرة أكثر من 25 عامًا في التعامل مع
                                الدوائر الرسمیة وإنھاء المعاملات
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="why-item">
                            <img src="{{asset('web/icon-6.png')}}" alt="">
                            <h5 class="text-lightBlue">
                                شبكة كبیرة من مكاتب التعقیب والمعقبین
                            </h5>
                            <p>
                                لا ترھق نفسك بالبحث عن معقب لإنجاز
                                معاملاتك جمعنا لك المعقبین في مكان واحد
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <div>


        <footer>
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <p>© جميع الحقوق محفوظة لصالح مؤسسة إنجاز فوري</p>
                    <a href="#">
                        <i class="fa fa-long-arrow-up"></i>
                    </a>
                </div>
            </div>
        </footer>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script>
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
    </script>

    <script type="text/javascript">


        function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

        //  reader.fileName = input.name // file came from a input file element. file = el.files[0];


            reader.onload = function(e) {
            $('.progress').show();
            $('.progress-bar').show();



            $('.progress-bar').text('تم اختيار المرفق بنجا
