@extends('engazFawry.layouts.app')
@section('title')خدمات التعقيب للشركات - إنجاز فوري@endsection

@section('seo')
<meta name="title" content="خدمات التعقيب للشركات من إنجاز فوري">
<meta name="description" content="هذه الخدمة متاحه للشركات التي ترغب بالتعاقد لمده اطول لانجاز اعمالها في مجال التعقيب، توفرها منصة إنجاز فوري بمجموعة من الباقات حسب حجم الشركة.">
@endsection
@section('content')
<section class="light">
    <div class="container">
      <div class="row text-center">
        <h1 class="text-center engaz-heading-dot" style="width: 100%;">شركات</h1>
      </div>
      <div class="row justify-content-center">
          @if ($errors->any())
            <div class="alert alert-danger justify-content-center mt-5">
                <ul class="text-right">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
          <form class="engaz-form signup-form text-right light" action="{{ route('sharkat_send') }}" method="POST" enctype="multipart/form-data">
          @csrf
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="name">  الاسم<span>*</span></label>
                        <input type="text" required="" class="form-control transform" id="name" name="name" placeholder="" value="{{ old('name')}}">
                      </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="phone">الجوال<span>*</span></label>
                        <input type="tel" required="" class="form-control transform" id="phone" name="phone" value="{{ old('phone')}}" placeholder="مثال : 055xxxxxxx">
                      </div>
                  </div>
                  <div class="col-12 col-md-4">
                      <div class="form-group">
                          <label for="city">المدينة<span>*</span></label>
                      <select required="" class="form-control transform" id="city" name="city">
                        <option value="">اختر المدينة </option>
                        @if(isset($cities))
                            @foreach($cities as $city)
                                <option  @if(old('city') == $city->id) selected="" @endif value="{{$city->id}}"> {{$city->name}} </option>
                            @endforeach
                        @endif
                      </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="type">نوع نشاط الشركة/المؤسسة<span>*</span></label>
                            <input type="text" required="" value="{{ old('type')}}" class="form-control transform" id="type" name="type" placeholder="مثال : شركة أدوية">
                          </div>
                      </div>


                      
              <div class="col-12 col-md-6">
                  <div class="form-group">
                      <label for="service">الخدمات المطلوبة<span>*</span></label>
                      <input type="text" required="" class="form-control transform" id="service"  value="{{ old('service')}}" name="service" placeholder="اكتب الخدمات المطلوب إتمامها">
                    </div>
              </div>
              
                  
            </div>
            

              <div class="form-group text-center">
                <input type="submit" class="engaz-btn transform" value="تقديم الطلب">
              </div>

            </form>
      </div>
    </div>
  </section>

  
@endsection