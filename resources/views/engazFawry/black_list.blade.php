@extends('engazFawry.layouts.app')
@section('title')القائمة السوداء - إنجاز فوري@endsection

@section('seo')
<meta name="title" content="القائمة السوداء - إنجاز فوري">
<meta name="description" content="ادخل رقم الجوال المطلوب الاستعلام عنه عبر منصة انجاز فوري المتخصص في خدمات التعقيب المختلفة">
@endsection

@section('content')
<img src="images/shape.png" alt="" class="bottom-left shape">
<img src="images/shape.png" alt="" class="bottom-right shape">
<div>
    <div class="row justify-content-center text-right">
        <h3 style="margin-top:40px;line-height:47px;display:block;clear:both;font-weight: 600;"> القائمة السوداء  </h3>
    </div>

    <div class="row justify-content-center text-right">
        <h5 style="margin:0 0 40px 0;line-height:47px;display:block;clear:both;font-weight: 600;">
            ادخل رقم الجوال المطلوب الاستعلام عنه 
        </h5>
    </div>
      <div class="row justify-content-center text-right ">

      
        @if (session('error'))
            <div class="alert alert-danger">
                <p class="text-center">
                    <i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i>
                    {{ session('error') }}
                </p>
            </div>
        @endif  

        <div class="container">
      <div class="col-md-2 float-right mobile-none" style="height: 50px;"></div>
      <div class="col-md-8 float-right">
       
           <form class="engaz-form-q mb-5" method="POST" id="query">
            @csrf
         
            <div class="form-group row">
                <div class="col-md-4"><label for="phone">رقم الجوال *</label></div>
                <div class="col-md-8">
                    <input type="tel" required="required" value="{{ old('phone')}}"  class="form-control transform" id="phone" name="phone" placeholder="مثال : 055xxxxxxx">
                    @if ($errors->has('phone'))
                        <span class="invalid-feedback" style="display:block;" role="alert">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif

                      <span class="invalid-feedback" id="error_ajax" style="display:none;margin-top:17px;" role="alert">
                          
                      </span>
                </div>
            </div>
        
          <div class="form-group text-center">
            <input type="submit" class="engaz-btn transform pull-left sendy" id="sendy"  value="استعلام">
          </div>
  
        </form>

      </div>
      <div class="col-md-2 float-right mobile-none"  style="height: 50px;"></div>
    </div>
       

      
      </div>
      
    <div id="query_response" style="margin-top: -3rem;"></div>
 
@endsection



@push('page_scripts')
<script>
$(document).ready(function(){
    $("#sendy").on("click", function(e){

      e.preventDefault();


      // $("#query").submit();
          var phone = document.getElementById('phone').value;




          console.log(phone);
          var token = $("input[name='_token']").val();
          $.ajax({
              url: "{{ route('black_list.query') }}",
              method: 'POST',
              data: {phone:phone, _token:token},
              success: function(data) {

                if(data.msg == 'success'){

                    $("#error_ajax").hide();

                     $("#query_response").html(data.options);

                }else if(data.msg == 'error'){


                  $("#error_ajax").show();
                  $("#error_ajax").css('display','block');

                  $("#query_response").html('');
                   $("#error_ajax").html('');

                  data.options.forEach(function(entry) {
                    //   console.log(entry);
                        $("#error_ajax").append("<li><strong>"+entry+"</strong></li>");
                  });

                }
               
              }, 
              error: function(data) {
                    $("#query_response").html(data.options);
              }
              
              
          });
       
    });
});
</script>
@endpush


