@extends('engazFawry.layouts.app')

@section('title')إضافة معاملة - إنجاز فوري@endsection

@section('seo')
<meta name="title" content="إضافة معاملة">
<meta name="description" content="أضف المعاملة التي ترغب في إنجازها عبر منصة إنجاز فوري (منصة متخصصه في التعقيب وإنجاز جميع الخدمات الحكومية وتراخيص الأنشطة التجاريه خبره 25 عاما) 0566661105">
@endsection
@section('content')
<section class="light">
    <div class="container">
      <div class="row text-center">
        <h1 class="text-center engaz-heading-dot" style="width: 100%;">أضافة معاملة</h1>
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
          <form class="engaz-form signup-form text-right light" action="{{ route('mo3amla_send') }}" method="POST" enctype="multipart/form-data" id="form">
            @csrf
            @if (Auth::check())
            <?php $cid= Auth::id(); ?>
                <input value="{{$cid}}" type="hidden" name="user_id">
            @endif

        
            
            <div class="row">
              <div class="col-12 col-md-4">
                  <div class="form-group">
                      <label for="service_id">جهة المعاملة <span>*</span></label>
                  <select required="" class="form-control transform" id="services" name="service_id">
                    <option selected="" value="">اختر الجهة</option>
                        @if(isset($services))
                            @foreach($services as $service)
                                <option @if(old('service_id') == $service->id) selected="selected" @endif value="{{$service->id}}">{{$service->name}}</option>
                            @endforeach
                        @endif
                  </select>
                    </div>
              </div>
              <div class="col-12 col-md-8">
                  <div class="form-group">
                      <label for="mo3amla_subject">موضوع  معاملتك <span>*</span></label>
                  <input required="" type="text" class="form-control transform" name="mo3amla_subject" value="{{ old('mo3amla_subject')}}" placeholder="اكتب نوع المعاملة">
                    </div>
                </div>

                <div class="col-12 col-md-4">
                      <div class="form-group">
                          <label for="city_id">المدينة<span>*</span></label>
                          <select required="" class="form-control transform" id="city_id" name="city_id">
                            <option value="">اختر المدينة</option>
                            @if(isset($cities))
                                @foreach($cities as $city)
                                    <option @if(old('city_id') == $city->id) selected="selected" @endif value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            @endif
                          </select>
                      </div>
                    </div>


                <div class="col-12 col-md-8">
                    <div class="form-group">
                        <label for="mo3amla_details">اشرح تفاصيل معاملتك <span>*</span></label>
                        <input required="" type="text" class="form-control transform" name="mo3amla_details" value="{{ old('mo3amla_details')}}" placeholder="مثال : اريد ان اقوم بتجديد رخصة قيادة">
                      </div>
                </div>
                {{-- <div class="col-12">
                    <div class="form-group">
                        <label for=""> المرفقات<span>*</span> </label>
                        <label for="attachments" class="form-control transform custom-input" style="cursor: pointer; font-size: unset; text-align: center;">تحميل الملفات <svg xmlns="http://www.w3.org/2000/svg" width="21.363" height="21.363" viewBox="0 0 21.363 21.363">
                          <path id="Icon_material-add-circle-outline" data-name="Icon material-add-circle-outline" d="M14.75,8.341H12.613v4.273H8.341V14.75h4.273v4.273H14.75V14.75h4.273V12.613H14.75ZM13.681,3A10.681,10.681,0,1,0,24.363,13.681,10.685,10.685,0,0,0,13.681,3Zm0,19.227a8.545,8.545,0,1,1,8.545-8.545A8.556,8.556,0,0,1,13.681,22.227Z" transform="translate(-3 -3)" fill="#853bcc"/>
                        </svg>
                        </label>
                        <input  required="" type="file" class="form-control transform" id="attachments" name="attachments[]" style="opacity: 0;
                        position: absolute;width: 50px;
                        z-index: -1;" multiple>
                      </div>
                </div> --}}
                {{-- <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="sub_service_id">الخدمة التي تبحث عنها ؟<span>*</span></label>
                        <select required="" class="form-control transform" id="sub_service_id" name="sub_service_id">
                          <option selected="" value="">  اختر الخدمة </option>
                          @if(isset($sub_services))
                                @foreach($sub_services as $sub_service)
                                    <option class="service_{{$sub_service->service_id}} d-none" value="{{$sub_service->id}}">{{$sub_service->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div> --}}
                {{-- <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="mo3amla_budget"> ميزانية المعاملة<span>*</span></label>
                        <input required="" type="number" class="form-control transform" name="mo3amla_budget" placeholder="ر.س" min="0">
                      </div>
                  </div> --}}
                  
            </div>
            

              <div class="form-group text-center">
                {{-- <input type="submit" class="engaz-btn transform" value="طلب معاملة"> --}}
                <a data-toggle="modal" data-target="#terms_mo3amla"  class="engaz-btn transform" id="termsApprove" >طلب معاملة</a>

              </div>




<!-- The Modal terms & conditions -->
<div class="modal" id="terms_mo3amla">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header" style="background-color: #3CBFAF!important">
        <h4 class="modal-title" style="color: #fff;">شروط واحكام طلب معاملة</h4>
        <button type="button" class="close" data-dismiss="modal" style="margin: -1rem -1rem -1rem 0;">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body text-right p-5" style="direction: rtl;">
    
          {{-- <b>الشروط والأحكام والضوابط</b> --}}
          <br>
          {!! $terms->terms_mo3amla  !!}
      
      </div>

      <div class="modal-footer">


        <div class="col-8 text-right order-1">
          <div class="checkbox">
            <input required="" id="terms" name="terms" type="checkbox">
            <label for="terms" class="checkbox-label">
                قرأت وأوافق علي شروط الخدمة
            </label>
            </div>
        </div>

        <div class="form-group text-center col-4 order-2">
          <input type="submit" class="engaz-btn transform" value="طلب معاملة">
        </div>
      </div>

     
    </div>
  </div>
</div>



            </form>
      </div>
    </div>



  </section>
  <script>
  // function ShowOption(val)
  //     {
  //          $('#services  > option').each(function() {
  //             if($(this).val() != ''){
  //               $('.service_'+$(this).val()).addClass('d-none');
  //             }
  //           });
  //           $('.service_'+val).removeClass('d-none');
  //     }
  
  </script>
   @if(isset($success))
        @php
          echo $success;
        @endphp
      @endif	

  @if (!Auth::check())
<script>
 $('#form').html('<div class="row justify-content-center"><div class="card text-center custom-card" style=""><div class="card-body"><h4 class="card-title text-center" style="color: #853BCC;">لاستكمال الطلب يرجى اتمام عملية التسجيل</h4><p class="card-text mb-4">اذا كنت مشترك بالفعل يرجي تسجيل الدخول إلى حسابك</p><div class=""><a class="engaz-btn-light transform" href="/login">الدخول</a><a class="engaz-btn transform" href="/signup">التسجيل</a></div></div></div></div>');
</script>
@endif

@endsection