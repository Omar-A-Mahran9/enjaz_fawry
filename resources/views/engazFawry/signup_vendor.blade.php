@extends('engazFawry.layouts.app')

@section('title')إنشاء حساب معقب / شركات - إنجاز فوري@endsection

@section('seo')
<meta name="title" content="إنشاء حساب معقب / شركات - إنجاز فوري">
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
            <a class="nav-link" href="{{ route('signup') }}">مستخدم</a>
          </li>
          <li class="nav-item pill">
            <a class="nav-link active" href="#">معقب / شركة</a>
          </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div class="container tab-pane active"><br>

          @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
          
            <form class="engaz-form signup-form" action="{{ route('signup_form_vendor') }}" method="POST" enctype="multipart/form-data">
               @csrf
                {{-- <input type="hidden" name="type" value="vendor"> --}}
                {{-- <input type="hidden" name="tab" value="vendor"> --}}
              <div class="form-group">
                <label for="name">الاسم <span>*</span></label>
                <input type="text" class="form-control transform" name="name" value="{{ old('name') }}" id="name" placeholder="ادخل الاسم">
              </div>
               <div class="form-group">
                <label for="phone"> الجوال <span>*</span> <span class="note">سيتم ارسال رمز التحقق على جوالك</span></label>
                <input type="tel" class="form-control transform" name="phone"  value="{{ old('phone') }}" required="required" id="phone" placeholder="مثال : 055xxxxxxx">
              </div>
              <div class="form-group">
                  <label for="sel1">نوع الحساب <span>*</span></label>
                  <select class="form-control transform" id="type" name="type">
                    <option selected="" value="null"> اختر من القائمة</option>
                    <option value="2">معقب</option>
                    <option value="3">مكتب خدمات</option>
                  </select>
              </div>
              <div class="form-group">
                <label for="name">رقم الاثبات  <span>*</span></label>
                <input type="text" class="form-control transform"  value="{{ old('identity_no') }}" name="identity_no" id="identity_no" required="required" placeholder="يرجى ادخال رقم الهوية أو السجل التجاري">
              </div>
              <div class="form-group">
                <label for="">الأوراق الثبوتية <span>*</span></label>
                <label for="uploadFile" class="form-control transform custom-input" style="cursor: pointer; font-size: unset; text-align: center;">تحميل الملفات <svg xmlns="http://www.w3.org/2000/svg" width="21.363" height="21.363" viewBox="0 0 21.363 21.363">
                  <path id="Icon_material-add-circle-outline" data-name="Icon material-add-circle-outline" d="M14.75,8.341H12.613v4.273H8.341V14.75h4.273v4.273H14.75V14.75h4.273V12.613H14.75ZM13.681,3A10.681,10.681,0,1,0,24.363,13.681,10.685,10.685,0,0,0,13.681,3Zm0,19.227a8.545,8.545,0,1,1,8.545-8.545A8.556,8.556,0,0,1,13.681,22.227Z" transform="translate(-3 -3)" fill="#853bcc"/>
                </svg>
                <div class="progress" style="display:none;">
                    <div class="progress-bar" style="display:none;background-color:#3CBFAF!important" role="progressbar" aria-valuenow=""
                    aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    0%
                    </div>
                </div>
                </label>
                <input type="file" class="form-control transform inputWithPreview" id="uploadFile" name="uploadFile" style="opacity: 0;position: absolute;width: 50px;z-index: -1;">
              </div>
              <div class="form-group">
                <label for="email">الايميل <span>*</span></label>
                <input type="email" value="{{ old('email') }}" class="form-control transform" name="email" id="email" placeholder="ادخل الايميل الخاص بك">
              </div>
              <div class="form-group">
                <label for="password">كلمة المرور <span>*</span></label>
                <input type="password" class="form-control transform" id="password" name="password"
                  placeholder="ادخل كلمة المرور الخاص بك">
              </div>
              <div class="form-group">
                <label for="confirmPassword">اعد كتابة كلمة المرور <span>*</span></label>
                <input type="password" class="form-control transform" id="confirmPassword" name="password_confirmation"
                  placeholder="اعد كتابة كلمة المرور الخاص بك">
              </div>
              <div class="d-flex justify-content-between">
                <div class="p-2">
                  <div class="checkbox">
                    <input id="checkbox2" type="checkbox" name="approve"   @if( old('approve') )  checked="checked" @endif>
                    <label for="checkbox2" class="checkbox-label">
                        قرأت وأوافق علي
                      <a data-toggle="modal" data-target="#terms" style="cursor: pointer; text-decoration: underline; color: #3CBFAF!important;">
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


<!-- The Modal Vendor -->
<div class="modal" id="terms">
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
            {!! $terms->terms_vendor  !!}
        </p>
      </div>
    </div>
  </div>
</div>


@endsection



@push('page_scripts')

@endpush