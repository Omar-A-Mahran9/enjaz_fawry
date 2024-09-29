@extends('engazFawry.layouts.app')
@section('title')تسجيل الدخول - إنجاز فوري@endsection

@section('seo')
<meta name="title" content="تسجيل الدخول - منصة إنجاز فوري">
<meta name="description" content="سجل دخولك مباشرة بادخال بيانات التسجيل في الحقول المطلوبة، حتى تطلب اي خدمة او متابعة طلباتك، بكل سهولة ويسر">
@endsection

@section('content')
<img src="images/shape.png" alt="" class="bottom-left shape">
<img src="images/shape.png" alt="" class="bottom-right shape">
<div>
    <div class="row justify-content-center text-center">
        <a href="/"><img class="logo" src="images/logo.png" alt="Engaz Fawry Logo" ></a>
      </div>
      <div class="row justify-content-center text-right mb-5">

        {{-- @if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif --}}


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
        <form class="engaz-form"  method="POST" action="{{ route('login_form') }}" >
            @csrf
          <div class="form-group">
            <label for="user">رقم الجوال *</label>
            <input type="tel" class="form-control transform" id="user" name="phone" placeholder="ادخل رقم الجوال الخاص بك">
          </div>
           @if ($errors->has('phone'))
                <span class="invalid-feedback" style="display:block;" role="alert">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif

          <div class="form-group">
            <label for="password">كلمة المرور </label>
            <input type="password" class="form-control transform" id="password" name="password" placeholder="ادخل كلمة المرور الخاص بك">
          </div>

          @if ($errors->has('password'))
              <span class="invalid-feedback" style="display:block;" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
          <div class="d-flex justify-content-between">
            <div class="p-2">
              <div class="checkbox">
                <input id="checkbox1" type="checkbox" name="remember">
                <label for="checkbox1" class="checkbox-label">
                  تذكرني
                </label>
              </div>
            </div>
            <div class="p-2">
            <a  class="checkbox-label decoration" href="{{ route('password.request') }} ">نسيت كلمة السر</a>
            </div>
          </div>
          <div class="form-group text-center">
            <input type="submit" class="engaz-btn transform pull-left" value="دخول">
          </div>
  
        </form>
      </div>
</div>
 
@endsection