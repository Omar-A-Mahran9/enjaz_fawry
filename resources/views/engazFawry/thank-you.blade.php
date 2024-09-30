@extends('engazFawry.layouts.app')
@section('title')إنشاء حساب  - إنجاز فوري@endsection

@section('seo')
<meta name="title" content="إنشاء حساب - إنجاز فوري">
<meta name="description" content="قم بتعبئة جميع الحقول المطلوبة حتى تتمكن من انشاء حساب على منصة انجاز فوري المتخصصه في خدمات التعقيب والانشطة التجارية والمعاملات الحكومية">
@endsection
@section('content')
<div class="text-center">
    <img src="{{asset('images/thank-you.png')}}" width="300">
    <h1 class="text-bold">
        تم إنشاء حسابك على منصة إنجاز فوري بنجاح
    </h1>
    <p>
        سيتم توجيهك تلقائيًا إلى لوحة تحكم حسابك خلال 5 ثواني
    </p>
    <p>
        <a href="{{route('client_dashboard')}}" class="btn engaz-btn ">انتقل إلى حسابك الآن</a>
    </p>
</div>
@endsection



@push('page_scripts')

<script>
    setTimeout(() => {
        location.href = "{{route('client_dashboard')}}"
    }, 10000);
</script>

@endpush
