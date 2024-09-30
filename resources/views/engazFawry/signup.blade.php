@extends('engazFawry.layouts.app')
@section('title')إنشاء حساب  - إنجاز فوري@endsection

@section('seo')
<meta name="title" content="إنشاء حساب - إنجاز فوري">
<meta name="description" content="قم بتعبئة جميع الحقول المطلوبة حتى تتمكن من انشاء حساب على منصة انجاز فوري المتخصصه في خدمات التعقيب والانشطة التجارية والمعاملات الحكومية">
@endsection
@section('content')
<img src="images/shape.png" alt="" class="bottom-left shape">
  <img src="images/shape.png" alt="" class="bottom-right shape">
  <div>
    <div class="row justify-content-center text-center">
      <a href="/"><img class="logo" src="{{ asset('images/logo.png')}}" alt="Engaz Fawry Logo"></a>
    </div>
    <div class="row justify-content-center text-right mb-5">
      <div class="engaz-form" style="padding: 0;margin: 0;">
        <ul class="nav nav-pills nav-justified" id="tablist" role="tablist" style="width: 100%; padding: 0;">
          <li class="nav-item pill">
            <a class="nav-link active" href="#">مستخدم</a>
          </li>
          <li class="nav-item pill">
          <a class="nav-link" href="{{ route('signup_vendor') }}">معقب / شركة</a>
          </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div id="home" class="container tab-pane active"><br>

          @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif

            <form class="engaz-form signup-form" action="{{ route('signup_form') }}" method="POST">
               @csrf
              <input type="hidden" name="type" value="individual">
              

              <div class="form-group">
                <label for="name">الاسم <span>*</span></label>
              <input type="text" class="form-control transform"name="name" id="name" required="required" value="{{ old('name') }}" placeholder="ادخل الاسم">
              </div>
              <div class="form-group">
                <label for="phone"> الجوال <span>*</span> <span class="note">سيتم ارسال رمز التحقق على جوالك</span></label>
                <input type="tel" class="form-control transform" name="phone" required="required" id="phone" value="{{ old('phone') }}" placeholder="مثال : 055xxxxxxx">
              </div>
              {{-- <div class="form-group">
                <label for="name">رقم الهوية <span>*</span></label>
                <input type="text" class="form-control transform" name="identity_no" id="identity_no" value="{{ old('identity_no') }}" required="required" placeholder="يرجى ادخال رقم الهوية أو الاقامة">
              </div> --}}
              <div class="form-group">
                <label for="email">الايميل <span>*</span></label>
                <input type="email" class="form-control transform" name="email" required="required" id="email" value="{{ old('email') }}"  placeholder="ادخل الايميل الخاص بك">
              </div>
              <div class="form-group">
                <label for="password">كلمة المرور  <span>*</span></label>
                <input type="password" class="form-control transform" id="password" required="required" value="{{ old('password') }}" name="password"
                  placeholder="ادخل كلمة المرور  الخاص بك">
              </div>
              <div class="form-group">
                <label for="confirmPassword">اعد كتابة كلمة المرور <span>*</span></label>
                <input type="password" class="form-control transform" required="required" name="password_confirmation" id="confirmPassword"
                  placeholder="اعد كتابة كلمة المرور  الخاص بك">
              </div>
              <div class="d-flex justify-content-between">
                <div class="p-2">
                  <div class="checkbox">
                    <input id="checkbox1" type="checkbox" name="approve" required="required" 
                    @if( old('approve') )  checked="checked" @endif>
                    <label for="checkbox1" class="checkbox-label">
                      قرأت وأوافق علي
                      <a data-toggle="modal" data-target="#terms_client" style="cursor: pointer; text-decoration: underline;">
                       شروط الخدمة
                      </a>
                    </label>
                  </div>
                </div>
                <div class="p-2">
                  <a class="checkbox-label decoration" href="{{ route('login_front') }}">لديك حساب</a>
                </div>
              </div>
              <div class="form-group text-center">
                <input type="submit" class="engaz-btn transform pull-left" value="تسجيل">
              </div>

            </form>
          </div>
          
        </div>
      </div>


    </div>
  </div>


<!-- The Modal Client -->
<div class="modal" id="terms_client">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header" style="background-color: #3CBFAF!important">
        <h4 class="modal-title" style="color: #fff;">شروط الخدمة</h4>
        <button type="button" class="close" data-dismiss="modal" style="margin: -1rem -1rem -1rem 0;">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body text-right p-5" style="direction: rtl;">
        <p class="text-right">
          <b>الشروط والأحكام والضوابط</b>
          <br><br>
          {!! $terms->terms_client  !!}
        </p>
      </div>
    </div>
  </div>
</div>
@endsection



@push('page_scripts')



@endpush