@extends('engazFawry.layouts.app')

@section('title')مدونة - إنجاز فوري@endsection

@section('seo')
<meta name="title" content="مدونة - إنجاز فوري">
<meta name="description" content="مدونة انجاز فوري (منصة متخصصه في التعقيب وإنجاز جميع الخدمات الحكومية وتراخيص الأنشطة التجاريه خبره 25 عاما) 0566661105">
@endsection

@section('content')
<section class="light p-0 p-md-5">
    <div class="container">
      <div class="row">
            <div class="text-right">
                <h2 class="text-right engaz-heading-dot-light">المدونة</h2>
            </div>
      </div>
      <div class="row modwna mb-2">

        <div class="col-12 col-md-8" style="margin-top:20px;">

          @if($blogs->count() > 0 )

            @foreach ($blogs as $article)
                
                <div class="row row-border">
                    <h2>{{ $article->title}}</h2>
                    <div class="col-md-12">
                      <div class="row">
                          <div class="modawana-content col-md-9" style="text-align: right;">   
                            {{ exerpt_text( $article->title, 160 ) }}
                          </div>
                          <div class="modawana-content col-md-3">   
                            <a href="{{ route('article', $article->id)}}" class="user-dark-btn transform">اقرأ المزيد</a>
                          </div>
                      </div> {{-- row --}}
                    </div>
                </div>
            @endforeach

            @else 
                <div class="alert alert-warning text-center" style="margin-top: 30px;">
                  لا توجد مقالات حاليا

                </div>

            @endif
        
            
        </div>

        <div class="col-12 col-md-4">
          <div class="dark p-3"style="">
              <div class="row text-center">
                  <div class="col-12">

                    <div class="text-center" style="width:fit-content; margin: auto;">
                        <h2 class="text-blue text-center engaz-heading-dot-light">طلب الخدمة</h2>
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

        
      </div> <!-- end  row --> 


    </div>
  </section>


@endsection