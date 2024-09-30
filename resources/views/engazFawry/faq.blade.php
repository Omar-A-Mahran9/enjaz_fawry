@extends('engazFawry.layouts.app')

@section('title')الأسئلة الشائعة - إنجاز فوري@endsection

@section('seo')
<meta name="title" content="الأسئلة الشائعة - إنجاز فوري">
<meta name="description" content="تسهيل لخدمة العملاء وتنظيمها قمنا باعداد عدد من الاسئلة الشائعة التي تم عرضها للمنصة ليكون بمثابة مرجع للعملاء للإجابة عن معظم تساؤلاتهم حول المنصة.">
@endsection
@section('content')
 <section class="light">
    <div class="container">
    <div class="row">
      <div class="text-center">
            <h2 class="text-right engaz-heading-dot-light mb-5">الأسئلة الشائعة</h2>
          </div>
    </div
      <div class="row">
        <div class="col-12">
          <div class="accordion indicator-plus-before round-indicator" id="accordionH" aria-multiselectable="true">
            <div class="card m-b-0">
            
              @foreach ($questions as $index => $question)
    
                <div class="card-header transform collapsed" role="tab" id="heading-{{($index + 1)}}" href="#collapse-{{($index + 1)}}" data-toggle="collapse" data-parent="#accordionH" aria-expanded="false" aria-controls="collapse-{{($index + 1)}}">
                  <a class="card-title">{{ $question->question }} ؟</a>
                </div>
                <div class="collapse" id="collapse-{{($index + 1)}}" role="tabpanel" aria-labelledby="headingOneH">
                  <div class="card-body">
                  {!! $question->answer !!}
                  </div>
                </div>

              @endforeach


            </div> <!--  card m-b-0 -->
          </div>	
        </div>
      </div>
    </div>
  </section>
  @endsection