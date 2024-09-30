@extends('engazFawry.layouts.app')

@section('title')اتصل بنا - إنجاز فوري@endsection


@section('seo')
<meta name="title" content="اتصل بنا - إنجاز فوري">
<meta name="description" content="قم بمراسلتنا عبر هذة الصفحة عن شئ تريده حول المنصة او احد خدماتها، هاتف المنصة 0566661105">
@endsection
@section('content')
<section class="light">
    <div class="container">
      <div class="row text-center">
        <h2 class="text-center engaz-heading-dot-light" style="width: 100%;">للتواصل</h2>
      </div>
      <div class="row mt-5">
        <div class="col-12 col-xl-6">
        <form class="engaz-form signup-form text-right light" action="{{ route('store.contact')}}" method="POST" enctype="multipart/form-data" id="form">
          @csrf
          @if (Auth::check())
            <?php $cid= Auth::id(); ?>
              <input value="{{$cid}}" type="hidden" name="user_id">
          @endif
            <div class="form-group">
                <label for="name">  الاسم<span>*</span></label>
                <input required="" type="text" class="form-control transform" id="name" name="name" >
            </div>
            <div class="form-group">
              <label for="email"> البريد الالكتروني<span>*</span></label>
              <input type="email" required="" class="form-control transform" id="email" name="email" >
            </div>
            <div class="form-group">
              <label for="company_name">رقم الجوال <span>*</span></label>
              <input type="tel" required="" class="form-control transform" id="mobile" name="mobile" >
            </div>
            <div class="form-group">
              <label for="message">رسالتك/استفسارك <span>*</span></label>
              <textarea class="form-control transform" required="" rows="5" id="message" name="message" ></textarea>
            </div>
            <div class="form-group text-left">
              <input type="submit" class="engaz-btn transform" value="ارسال">
            </div>
          </form>
        </div>
        <div class="col-12 col-xl-6" style="padding-top:57px;">
           <h3 class="inerTitle">بيانات التواصل :</h3>
          <div class="row">
           
            <ul class="contact-nav p-0">
              <li class="nav-item">
                {{-- <a class="nav-link" href="#"> --}}
                <i class="fa fa-phone"></i>
                <a href="tel:{{ $setting->phone }}"> +996{{ $setting->phone }}</a>
                {{-- </a> --}}
              </li>
              <li class="nav-item">

               <i class="fa fa-whatsapp"></i>
                <a href="https://wa.me/966{{ $setting->general_whats }}" target="_blank"> 0{{ $setting->general_whats }}</a>

              </li>
              <li class="nav-item">
               <i class="fa fa-envelope-o"></i>
                <a href="mailto:{{ $setting->email }}" target="_blank"> {{ $setting->email }}</a>

              </li>


                <li>

                
                </li>







            </ul>
            
<h3 class="inerTitle">شبكات التواصل :</h3>
              <div class="row" style="width:100%; clear:both">
                
                @if(!empty($setting->facebook) && $setting->facebook != '' && $setting->facebook !== '#')
                  <a class="socila-icons-contact" href="{{ $setting->facebook }}" target="_blank">
                    <i class="fa fa-facebook"></i>
                  </a>
                @endif

                @if(!empty($setting->twitter) && $setting->twitter != '' && $setting->twitter != '#')
                  <a class="socila-icons-contact" href="{{ $setting->twitter }}" target="_blank">
                    <i class="fa fa-twitter"></i>
                  </a>
                @endif
                @if(!empty($setting->instagram) && $setting->instagram != '' && $setting->instagram != '#')
                  <a class="socila-icons-contact" href="{{ $setting->instagram }}" target="_blank">
                    <i class="fa fa-instagram"></i>
                  </a>
                @endif
                @if(!empty($setting->youtube) && $setting->youtube != '' && $setting->youtube != '#')
                  <a class="socila-icons-contact" href="{{ $setting->youtube }}" target="_blank">
                    <i class="fa fa-youtube"></i>
                  </a>
                @endif
                @if(!empty($setting->linkedin) && $setting->linkedin != '' && $setting->linkedin != '#')
                  <a class="socila-icons-contact" href="{{ $setting->linkedin }}" target="_blank">
                    <i class="fa fa-linkedin"></i>
                  </a>
                @endif
                @if(!empty($setting->snapchat) && $setting->snapchat != '' && $setting->snapchat != '#')
                  <a class="socila-icons-contact" href="{{ $setting->snapchat }}" target="_blank">
                    <i class="fa fa-snapchat"></i>
                  </a>
                @endif

        

              </div>
          </div>
         
        </div>
      </div>

    </div>
  </section>

   

@endsection