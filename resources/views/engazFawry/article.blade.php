@extends('engazFawry.layouts.app')

@section('title'){{ $article->title }} - إنجاز فوري@endsection

@section('seo')
<meta name="title" content="{{ $article->title }} - إنجاز فوري">
<meta name="description" content="مدونة انجاز فوري (منصة متخصصه في التعقيب وإنجاز جميع الخدمات الحكومية وتراخيص الأنشطة التجاريه خبره 25 عاما) 0566661105">
@endsection

@section('content')
<section class="light p-0 p-md-5">
    <div class="container">
      <div class="row">
        <div class="text-right">
            {{-- <h2 class="text-right engaz-heading-dot-light">{{$article->title }}</h2> --}}
        </div>
      </div>
      <div class="row modwna mb-2">
        <div class="col-12 col-md-8">
            <div class="row row-border">
                <h2 class="h2-margin">{{ $article->title }}</h2>
                <div class="">
                    <p class="big-p">
                      {!! $article->body !!}
                    </p>
                </div>
            </div>

            @if($blogs->count() > 0)
            <div class="row">
                <h1 class="engaz-heading-dot">مواضيع ذات صلة</h1>




                @foreach ($blogs as $blog)

                  <div class="row row-border">
                    <h2 style="font-size:19px;"> {{ $blog->title }}</h2>

                    <div class="col-md-12">
                      <div class="row">
                        <div class="modawana-content col-md-9" style="text-align: right;font-size:15px;">   
                           {!! exerpt_text( $blog->body, 160 ) !!}
                        </div>
                        <div class="modawana-content col-md-3">   
                          <a href="{{ route('article', $blog->id)}}" class="user-dark-btn transform">اقرأ المزيد</a>
                        </div>
                        </div> {{-- row --}}
                    </div>

                    {{-- <div class=" justify-content-between">
                      <p> {!! exerpt_text( $blog->body, 100 ) !!}</p>
                      <a href="{{ route('article', $blog->id)}}" class="user-dark-btn transform">اقرأ المزيد</a>

                    </div> --}}
                  </div>
                    
                @endforeach
            </div>
            @endif
        </div>

        <div class="col-12 col-md-4">
          <div class="dark p-3"style="">
              <div class="row text-center">
                  <div class="col-12">
                    <div class="text-center" style="width:fit-content; margin: auto;">
                        <h2 class="text-center engaz-heading-dot-light text-blue">طلب الخدمة</h2>
                    </div>
                    <div class="text-center">
                            <div class="custom-width text-center justify-content-center" style="width: 100%;">
                                <a href="{{ route('ta3med')}}"><button type="button" class="btn engaz-main-btn transform">التعمــــــيد</button></a>
                                <a href="{{ route('mo3amla')}}"><button type="button" class="btn engaz-main-btn transform">المعـــاملات</button></a>
                                <a href="{{ route('estfsar')}}"><button type="button" class="btn engaz-main-btn transform">استفسار مدفوع</button></a>
                                <a href="{{ route('sharkat')}}"><button type="button" class="btn engaz-main-btn transform">الشركات</button></a>
                            </div>
                    </div>
                  </div>
                </div>
          </div>
        </div>

        
      </div>


    </div>
  </section>
@endsection