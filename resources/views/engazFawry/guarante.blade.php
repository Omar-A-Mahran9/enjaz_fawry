@extends('engazFawry.layouts.app')

@section('title')ضمان مبلغ سلعة - إنجاز فوري@endsection

@section('seo')
<meta name="title" content="ضمان مبلغ سلعة - إنجاز فوري">
<meta name="description" content="أضف السلعة  التي ترغب في ضمان قيمتها عبر منصة إنجاز فوري (منصة متخصصه في التعقيب وإنجاز جميع الخدمات الحكومية وتراخيص الأنشطة التجاريه خبره 25 عاما) 0566661105">
@endsection
@section('content')
<section class="light">
  <div class="container">
    <div class="row text-center">
      <h1 class="text-center engaz-heading-dot" style="width: 100%;">ضمان مبلغ سلعة </h1>
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
      <form class="engaz-form signup-form text-right light" id="form" action="{{ route('guarante_send') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @if (Auth::check())
            <?php $cid= Auth::id(); ?>
            <input value="{{$cid}}" type="hidden" name="user_id">
          @endif
          <div class="row">
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="phone_buyer">جوال المشتري<span>*</span></label>
              <input required="" type="tel" class="form-control transform" id="phone_seller" name="phone_seller" value="{{ old('phone_seller')}}"  placeholder="مثال : 055xxxxxxx">
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="phone_seller"> جوال البائع<span>*</span></label>
                <input required="" type="tel" class="form-control transform" id="phone_buyer" name="phone_buyer" value="{{ old('phone_buyer')}}"  placeholder="مثال : 055xxxxxxx">
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="days">عدد أيام العمل<span>*</span></label>
                <input required="" type="number" class="form-control transform" id="days" name="days" value="{{ old('days')}}" placeholder="حدد عدد الأيام" min="1">
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="ta3med_value">قيمة التعميد<span>*</span></label>
                <input required="" onchange="calc_percentage(this.value)" type="number" class="form-control transform" min="0" id="ta3ed_value" value="{{ old('ta3med_value')}}" name="ta3med_value" placeholder="اكتب المبلغ الذي ترغب بتعميدة">
              </div>
            </div>
                
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="ta3med_price">رسوم الخدمة<span>*</span></label>
                <div class="textinside form-control transform" class="form-control transform" id="ta3med_price">
                  @if(old('ta3med_value'))
                    @php 
                      $percent = (old('ta3med_value') *  $setting->guarante_percentage)/100;
                      echo $percent. ' ر.س';
                    @endphp 
                  @endif
                </div>
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="total_price">اجمالي المبلغ<span>*</span></label>
                <div class="textinside form-control transform" class="form-control transform" id="total_price">
                  @if(old('ta3med_value'))
                    @php 
                      $total =  old('ta3med_value') +  $percent;
                      echo $total. ' ر.س';
                    @endphp 
                  @endif
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="mo3amla_details">نص الاتفاق <span>*</span></label>
                <input required="" type="text" class="form-control transform" name="ta3med_details" value="{{ old('ta3med_details')}}" placeholder="مثال : الاتفاق ينص على كذا .... ">
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="payment_method">طريقة الدفع<span>*</span></label>
                <select required="" onchange="ShowDiv(this.value)" class="form-control transform" id="payment_method" name="payment_method">
                  <option selected="" value="">اختر طريقة</option>
                  @if($setting->bankPayment == 1)<option @if(old('transfer') == 1) selected="selected" @endif value="transfer">تحويل بنكي</option> @endif
                  @if($setting->onlinePayment == 1)<option @if(old('transfer') == 1) selected="online_payment" @endif value="online_payment">دفع عن طريق فيزا / ماستر</option>@endif
                </select>
              </div>
            </div>
            <div class="col-12 col-md-3 d-none" id="banks">
              <div class="form-group">
                <label for="bank_name">البنك<span>*</span></label>
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
              <div class="col-12 col-md-5 d-none " id="bank_{{$bank->id}}">
                <div class="bankDt">
                  <p><span>اسم الحساب </span> <strong>{{$bank->accountName}}</strong> </p>
                  <p><span>رقم الحساب </span> <strong>{{$bank->accountNo}}</strong> </p>
                  <p><span>ايبان </span> <strong>{{$bank->accountIban}}</strong> </p>
                </div>
              </div>
            @endforeach

            <div class="col-md-12 col-xs-12">
              <div class="form-group">
                <label for=""> المرفقات<span style="font-size: 1rem; padding: 0 10px;">(اختياري)</span> </label>
                <label for="uploadFile" class="form-control transform custom-input inputTextPreview"  style="cursor: pointer; font-size: unset; text-align: center;">تحميل الملفات <svg xmlns="http://www.w3.org/2000/svg" width="21.363" height="21.363" viewBox="0 0 21.363 21.363">
                  <path id="Icon_material-add-circle-outline" data-name="Icon material-add-circle-outline" d="M14.75,8.341H12.613v4.273H8.341V14.75h4.273v4.273H14.75V14.75h4.273V12.613H14.75ZM13.681,3A10.681,10.681,0,1,0,24.363,13.681,10.685,10.685,0,0,0,13.681,3Zm0,19.227a8.545,8.545,0,1,1,8.545-8.545A8.556,8.556,0,0,1,13.681,22.227Z" transform="translate(-3 -3)" fill="#853bcc"/>
                  
                  </svg>
                  <div class="progress" style="display:none;">
                      <div class="progress-bar" style="display:none;background-color:#3CBFAF!important" role="progressbar" aria-valuenow=""
                      aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        0%
                      </div>
                    </div>
                    <div  id="imagePreviewWrap" style="display:none;">
                      <img id="imagePreview" width="50">
                    </div>
                </label>
                <input type="file" multiple class="form-control transform inputWithPreview" id="uploadFile" name="uploadFile[]" style="opacity: 0;position: absolute;width: 50px;z-index: -1;">
                <span class="upload_notes" style="color:#af0505">* الملفات المسموحة : jpg , png , pdf / بحد اقصى 3 ملفات / الا يزيد حجم الملف الواحد عن 2 ميجا بايت.</span>
              </div>
            </div>
           

          </div>
      
          <div class="form-group text-center" style="margin-top:30px;">
            <a data-toggle="modal" data-target="#terms_ta3med"  class="engaz-btn transform" id="termsApprove" >طلب الخدمة</a>
          </div>


<!-- Terms Modal  -->
<div class="modal" id="terms_ta3med">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #3CBFAF!important">
        <h4 class="modal-title" style="color: #fff;">شروط خدمة ضمان مبلغ سلعة</h4>
        <button type="button" class="close" data-dismiss="modal" style="margin: -1rem -1rem -1rem 0;">&times;</button>
      </div>
      <div class="modal-body text-right p-5" style="direction: rtl;">
        <br>
        {!! $terms->terms_guarante  !!}
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
          <input type="submit" class="engaz-btn transform" value="طلب الخدمة">
        </div>
      </div>
    </div>
  </div>
</div>

      </form>
    </div>
  </div> {{-- end container --}}
</section>
    	

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
        $('#bank_name > option').each(function() {
          if($(this).val() != ''){
            $('#bank_'+$(this).val()).addClass('d-none');
          }
        });
        $('#bank_'+val).removeClass('d-none');
      }

      function calc_percentage(val){

        var percentage =   parseInt({{ $setting->guarante_percentage }}) ;

        var amount = parseInt(val);


        if(amount <= 1000 ){
          var totaPercent = 50;

        }else if(amount <= 2000){

          var totaPercent = 100;

        }else{

          var totaPercent = (percentage * amount)/100;
        }

       // var totaPercent = (percentage * amount)/100;

        $("#ta3med_price").text(totaPercent+" ر.س");
        
        var totaAmount = totaPercent+amount;

        $("#total_price").text(totaAmount+" ر.س");

      }
</script>
@endsection