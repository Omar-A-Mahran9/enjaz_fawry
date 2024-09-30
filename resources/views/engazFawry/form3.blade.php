@extends('engazFawry.layouts.app')

@section('title')استفسار مدفوع الثمن  - إنجاز فوري@endsection

@section('seo')
<meta name="title" content="استفسار مدفوع الثمن">
<meta name="description" content="أضف الاستفسار التي ترغب فيه ليجيب عليك خبراء  منصة إنجاز فوري (منصة متخصصه في التعقيب وإنجاز جميع الخدمات الحكومية وتراخيص الأنشطة التجاريه خبره 25 عاما) 0566661105">
@endsection

@section('content')
<section class="light">
    <div class="container">
      <div class="row text-center">
        <h1 class="text-center engaz-heading-dot" style="width: 100%;">استفسار مدفوع الثمن</h1>
      </div>
      
      <div class="notes">
        <div class="alert alert-primary" role="alert">
        تكلفة الخدمة : {{ $setting->estfsar_price }} ريال 
        </div>
      </div>
      
      
      <div class="row justify-content-center" id="form">
       @if ($errors->any())
            <div class="alert alert-danger justify-content-center mt-5">
                <ul class="text-right">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                </ul>
            </div>
          @endif
          <form class="engaz-form signup-form text-right light" action="{{ route('estfsar_send') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (Auth::check())
            <?php $cid= Auth::id(); ?>
                <input value="{{$cid}}" type="hidden" name="user_id">
                <input value="{{ $setting->estfsar_price }}" type="hidden" name="price">
            @endif
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="name">  الاسم<span>*</span></label>
                        <input required="" type="text" class="form-control transform" id="name" name="name" value="{{ old('name')}}" placeholder=" اسم صاحب الاستفسار ">
                      </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="phone">الجوال<span>*</span></label>
                        <input required="" type="tel" class="form-control transform" id="phone" value="{{ old('phone')}}" name="phone"  placeholder="مثال : 055xxxxxxx">
                      </div>
                  </div>
                  <div class="col-12 col-md-4">
                      <div class="form-group">
                          <label for="type">نوع الاستفسار<span>*</span></label>
                          <input required="" type="text" class="form-control transform" id="type" name="type" value="{{ old('type')}}" placeholder="اكتب نوع الاستفسار">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="service">اشرح تفاصيل استفسارك<span>*</span></label>
                        <input required="" type="text" class="form-control transform" id="service" name="service" value="{{ old('service')}}" placeholder="مثال : اريد ان اقوم بتجديد رخصة قيادة">
                          </div>
                      </div>


                      
            <div class="col-12 col-md-4">
                          <div class="form-group">
                              <label for="payment_method">طريقة الدفع<span>*</span></label>
                              <select onchange="ShowDiv(this.value)" class="form-control transform" id="payment_method" name="payment_method">
                                <option selected="" value="">اختر طريقة</option>
                                @if($setting->bankPayment == 1)<option value="transfer">تحويل بنكي</option> @endif
                                @if($setting->onlinePayment == 1)<option value="online_payment">دفع عن طريق فيزا / ماستر</option>@endif
                                
                              </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 d-none" id="banks">
                            <div class="form-group">
                                <label for="bank_id">البنك<span>*</span></label>
                                <select onchange="Bank_details(this.value)" class="form-control transform" id="bank_name" name="bank_id">
                                  <option selected="" value="">اختر بنك</option>
                                  @if(isset($banks))
                                      @foreach($banks as $bank)
                                          <option value="{{$bank->id}}">{{$bank->name}}</option>
                                      @endforeach
                                  @endif
                                </select>
                            </div>
                        </div>
                        @foreach($banks as $bank)
                        <div class="col-12 col-md-5 d-none" id="bank_{{$bank->id}}">
                            <table>
                              <tr>
                                <td><label>اسم الحساب</label></td><td>{{$bank->accountName}}</td>
                              </tr>
                              <tr>
                                <td><label>رقم الحساب</label></td><td>{{$bank->accountNo}}</td>
                              </tr>
                              <tr>
                                <td><label>IBAN</label></td><td>{{$bank->accountIban}}</td>
                              </tr>
                            </table>
                        </div>
                        @endforeach
              
                  
            </div>
            

              <div class="form-group text-center">
                {{-- <input type="submit" class="engaz-btn transform" value="طلب استفسار "> --}}
              <a data-toggle="modal" data-target="#terms_mo3amla"  class="engaz-btn transform" id="termsApprove" >طلب استفسار</a>

              </div>







<!-- The Modal terms & conditions -->
<div class="modal" id="terms_mo3amla">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header" style="background-color: #3CBFAF!important">
        <h4 class="modal-title" style="color: #fff;">شروط واحكام طلب استفسار</h4>
        <button type="button" class="close" data-dismiss="modal" style="margin: -1rem -1rem -1rem 0;">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body text-right p-5" style="direction: rtl;">
        
        <br>
        {!! $terms->terms_estfsar  !!}
       
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
          <input type="submit" class="engaz-btn transform" value="طلب استفسار">
        </div>
      </div>

     
    </div>
  </div>
</div>






            </form>
      </div>
    </div>
    
  
  </section>


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

      
  <script>
      function ShowDiv(val)
      {
           switch(val)
           {
                case "transfer":
                {
                     $('#banks').removeClass('d-none');
                     $('#bank_name').val('')
                     break;
                }
                case "online_payment":
                {
                     $('#banks').addClass('d-none');
                     $('#bank_name  > option').each(function() {
                        if($(this).val() != ''){
                          $('#bank_'+$(this).val()).addClass('d-none');
                        }
                      });
                     break;
                }
           }
      }
      function Bank_details(val)
      {
        $('#bank_name  > option').each(function() {
          if($(this).val() != ''){
            $('#bank_'+$(this).val()).addClass('d-none');
          }
        });
        $('#bank_'+val).removeClass('d-none');
                    
      }

      
 </script>
@endsection