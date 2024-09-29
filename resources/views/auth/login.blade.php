<!DOCTYPE html>

<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>إنجاز فوري | تسجيل الدخول</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Web font -->

    <!--begin:: Global Mandatory Vendors -->
    <link href="{{ asset('metronic') }}/vendors/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />

    <!--end:: Global Mandatory Vendors -->

    <!--begin:: Global Optional Vendors -->


    <!--end:: Global Optional Vendors -->

    <!--begin::Global Theme Styles -->
    {{--<link href="{{ asset('metronic/default') }}/assets/demo/base/style.bundle.css" rel="stylesheet" type="text/css" />--}}

    <link href="{{ asset('metronic/default') }}/assets/demo/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles -->
    <link rel="shortcut icon" href="{{ asset('logo-clr.png') }}" />
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url({{ asset('metronic/default') }}/assets/app/media/img//bg/bg-3.jpg);">
        <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
            <div class="m-login__container">
                <div class="m-login__logo">
                    <a href="#">
                        <img style="max-width: 300px;" src="{{ asset('logo-clr.png') }}">
                    </a>
                </div>
                <div class="m-login__signin">
                    <div class="m-login__head">
                        <h3 class="m-login__title">تسجيل الدخول للوحة التحكم</h3>
                    </div>
                    @if (count($errors) > 0)
					    @foreach ($errors->all() as $error)
					        <div class="alert alert-danger">
					            <p class="text-center">
					                {{ $error }}
					            </p>
					        </div>
					    @endforeach
					@endif

					@if (session('success'))
					    <div class="alert alert-success">
					        <p class="text-center">
					            <i class="fa fa-check-square fa-lg" aria-hidden="true"></i>
					            {{ session('success') }}
					        </p>
					    </div>
					@endif

					@if (session('error'))
					    <div class="alert alert-danger">
					        <p class="text-center">
					            <i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i>
					            {{ session('error') }}
					        </p>
					    </div>
                    @endif  
                    <form class="m-login__form m-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" name="email" value="{{ old('email') }}" required autofocus placeholder="البريد الالكتروني" autocomplete="off">
                        </div>
                        <div class="form-group m-form__group">
                            <input id="password" type="password" class="form-control m-input m-login__form-input--last" name="password" required placeholder="كلمة السر" autocomplete="off">
                        </div>
                        <div class="row m-login__form-sub">
                            <div class="col m--align-left m-login__form-left">
                                <label class="m-checkbox  m-checkbox--focus">
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> تذكرني
                                    <span></span>
                                </label>
                            </div>
                            {{--<div class="col m--align-right m-login__form-right">--}}
                                {{--<a href="javascript:;" id="m_login_forget_password" class="m-link">Forget Password ?</a>--}}
                            {{--</div>--}}
                        </div>
                        <div class="m-login__form-action">
                            <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">تسجيل الدخول</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- end:: Page -->

<!--begin:: Global Mandatory Vendors -->
<script src="{{ asset('metronic') }}/vendors/jquery/dist/jquery.js" type="text/javascript"></script>
<script src="{{ asset('metronic') }}/vendors/popper.js/dist/umd/popper.js" type="text/javascript"></script>
<script src="{{ asset('metronic') }}/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{ asset('metronic') }}/vendors/js-cookie/src/js.cookie.js" type="text/javascript"></script>
<script src="{{ asset('metronic') }}/vendors/moment/min/moment.min.js" type="text/javascript"></script>
<script src="{{ asset('metronic') }}/vendors/tooltip.js/dist/umd/tooltip.min.js" type="text/javascript"></script>
<script src="{{ asset('metronic') }}/vendors/perfect-scrollbar/dist/perfect-scrollbar.js" type="text/javascript"></script>
<script src="{{ asset('metronic') }}/vendors/wnumb/wNumb.js" type="text/javascript"></script>

<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->


<!--end:: Global Optional Vendors -->

<!--begin::Global Theme Bundle -->
<script src="{{ asset('metronic/default') }}/assets/demo/base/scripts.bundle.js" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Scripts -->
{{--<script src="{{ asset('metronic/default') }}/assets/snippets/custom/pages/user/login.js" type="text/javascript"></script>--}}

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
