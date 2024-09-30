@extends('engazFawry.layouts.app')
@section('content')
<section class="light">
  <div class="container">
    <div class="row text-center">
      <h1 class="text-center engaz-heading-dot" style="width: 100%;">إضافة طلب تعميد </h1>
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
      <form class="engaz-form signup-form text-right light" id="form" action="{{ route('ta3med_send') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @if (Auth::check())
            <?php $cid= Auth::id(); ?>
            <input value="{{$cid}}" type="hidden" name="user_id">
          @endif
          <div class="row">
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="phone_client">جوال صاحب الطلب<span>*</span></label>
                <input required="" type="tel" class="form-control transform" id="phone_client" name="phone_client"  placeholder="مثال : 055xxxxxxx">
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="phone_mo3akeb"> جوال المعقب<span>*</span></label>
                <input required="" type="tel" class="form-control transform" id="phone_mo3akeb" name="phone_mo3akeb"  placeholder="مثال : 055xxxxxxx">
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="days">عدد أيام العمل<span>*</span></label>
                <input required="" type="number" class="form-control transform" id="days" name="days" placeholder="حدد عدد الأيام" min="1">
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="ta3med_value">قيمة التعميد<span>*</span></label>
                <input required="" onchange="calc_percentage(this.value)" type="number" class="form-control transform"  min="0" id="ta3ed_value" value="{{ old('ta3med_value')}}" name="ta3med_value" placeholder="اكتب المبلغ الذي ترغب بتعميدة">
              </div>
            </div>
                
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="ta3med_price">رسوم التعميد<span>*</span></label>
                <div class="textinside form-control transform" class="form-control transform" id="ta3med_price">
                  @if(old('ta3med_value'))
                    @php 
                      $percent = (old('ta3med_value') *  $setting->tameed_percentage)/100;
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
                <input required="" type="text" class="form-control transform" name="ta3med_details" placeholder="مثال : الاتفاق ينص على كذا .... ">
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-group">
                <label for="payment_method">طريقة الدفع<span>*</span></label>
                <select required="" onchange="ShowDiv(this.value)" class="form-control transform" id="payment_method" name="payment_method">
                  <option selected="" value="">اختر طريقة</option>
                  @if($setting->bankPayment == 1)<option value="transfer">تحويل بنكي</option> @endif
                  @if($setting->onlinePayment == 1)<option value="online_payment">دفع عن طريق فيزا / ماستر</option>@endif
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

            @include('engazFawry.parts.uploadFileInForm')



          </div>
      
          <div class="form-group text-center" style="margin-top:30px;">
            <a data-toggle="modal" data-target="#terms_ta3med"  class="engaz-btn transform" id="termsApprove" >طلب تعميد</a>
          </div>


<!-- Terms Modal  -->
<div class="modal" id="terms_ta3med">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #3CBFAF!important">
        <h4 class="modal-title" style="color: #fff;">شروط خدمة التعميد</h4>
        <button type="button" class="close" data-dismiss="modal" style="margin: -1rem -1rem -1rem 0;">&times;</button>
      </div>
      <div class="modal-body text-right p-5" style="direction: ltr;">
        <p class="text-right">
          <br><br>
          {!! $terms->terms_ta3med  !!}
        </p>
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
          <input type="submit" class="engaz-btn transform" value="طلب تعميد">
        </div>
      </div>
    </div>
  </div>
</div>





      </form>
    </div>
  </div> {{-- end container --}}





@include('engazFawry.parts.uploadFileOutForm')






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

        var percentage =   parseInt({{ $setting->tameed_percentage }}) ;

        var amount = parseInt(val);

        var totaPercent = (percentage * amount)/100;

        $("#ta3med_price").text(totaPercent+" ر.س");
        
        var totaAmount = totaPercent+amount;

        $("#total_price").text(totaAmount+" ر.س");

      }
</script>
<script src="{{ asset('js')}}/jquery.form.js"></script>

<script>

// $(document).ready(function(){


//   $('#OpenImgUpload').click(function(){ $('.imgupload').trigger('click'); });


//   document.getElementById("file").onchange = function() {
//    $("#uploadImageBtn").trigger('click');

// };

//     $('#addImageForm').ajaxForm({
//       beforeSend:function(){
//         $('#tableImage').empty();
//         $('#tableActions').empty();
        

//       },
//       uploadProgress:function(event, position, total, percentComplete)
//       {

//         $('#uploading').show();
//         $('.progress-bar').text(percentComplete + '%');
//         $('.progress-bar').css('width', percentComplete + '%');
//       },
//       success:function(data)
//       {
//          $('#uploading').hide();
//         if(data.errors)
//         {
//           $('.progress-bar').text('0%');
//           $('.progress-bar').css('width', '0%');
//           $('#tableImage').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
          

//         }
//         if(data.success)
//         {
//           $('.progress-bar').text('تم تحميل المرفق بنجاح');
//           $('.progress-bar').css('width', '100%');
//           $('#success #tableActions').html('<span class="text-success"><b>'+data.success+'</b></span><br /><br />');
//           $('#success #tableImage').append(data.image);
//           $('#success').append(data.image_input);

          
//         }
//       }
//     });

// });
</script>

@endsection