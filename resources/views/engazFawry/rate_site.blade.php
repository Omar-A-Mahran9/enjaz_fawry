@extends('engazFawry.layouts.app')
@section('content')
<img src="images/shape.png" alt="" class="bottom-left shape">
<img src="images/shape.png" alt="" class="bottom-right shape">
<div>
    <div class="row justify-content-center text-right">
        <h3 style="margin-top:40px;line-height:47px;display:block;clear:both;font-weight: 600;"> عميلنا العزيز ,,, </h3>
    </div>

    <div class="row justify-content-center text-right">
        <h5 style="margin:0 0 40px 0;line-height:47px;display:block;clear:both;font-weight: 600;">
            نأمل منكم تقييم الخدمة المقدمة لكم بكل شفافية 
        </h5>
    </div>
      <div class="row justify-content-center text-right mb-5">

        @if (session('success'))
            <div class="alert alert-success">
                <p class="text-center">
                    <i class="fa fa-check-square fa-lg" aria-hidden="true"></i>
                    {{ session('success') }}
                </p>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                <p class="text-center">
                    <i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i>
                    {{ session('error') }}
                </p>
            </div>
        @endif  
        <form class="engaz-form"  method="POST" id="rating" action="{{ route('rate_site.submit') }}" >
            @csrf
         
            <input type="hidden" id="raty" name="raty" value="no" >
            <input type="hidden" name="htoken" value="{{   $review->unique_key }}" >
            <input type="hidden" name="hid" value="{{ $review->id }}" >
            <div class="form-group row">
                <div class="col-md-4"><label for="mobile">الاسم *</label></div>
                <div class="col-md-8">
                  <input type="text" required="required" value="{{ old('name')}}" class="form-control transform" id="mobile" name="name" placeholder="ادخل اسمك">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" style="display:block;" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


            <div class="form-group row">
                <div class="col-md-4"><label for="mobile">رقم الجوال *</label></div>
                <div class="col-md-8">
                    <input type="text" required="required" value="{{ old('mobile')}}"  class="form-control transform" id="mobile" name="mobile" placeholder="مثال : 055xxxxxxx">
                    @if ($errors->has('mobile'))
                        <span class="invalid-feedback" style="display:block;" role="alert">
                            <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4"><label for="user">اختر عدد النجوم *</label></div>
                <div class="col-md-8">
                    <div class="rate_stars" >
                    {{-- <span>التقييم* : </span> --}}
                        <div class="rate-cnt">
                            <div id="1" class="rate-btn-1 rate-btn"></div>
                            <div id="2" class="rate-btn-2 rate-btn"></div>
                            <div id="3" class="rate-btn-3 rate-btn"></div>
                            <div id="4" class="rate-btn-4 rate-btn"></div>
                            <div id="5" class="rate-btn-5 rate-btn"></div>
                        </div>
                        <div class="res_light"></div>
                        <div class="result_light"></div>
                    </div><!-- rate-stars -->
                    

                    {{-- <span id="rate-messages" class="alert alert-danger" style="display:none;clear:both;" role="alert"></span> --}}
                    <span id="rate-messages" class="invalid-feedback" style="display:none;clear:both;" role="alert">
                        <strong>{{ $errors->first('stars') }}</strong>
                    </span>
                    @if ($errors->has('stars'))
                        <span class="invalid-feedback" style="display:block;" role="alert">
                            <strong>{{ $errors->first('stars') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-4"><label for="desc">التقييم *</label></div>
                <div class="col-md-8">
                    <textarea required="required" name="desc" value="{{ old('desc')}}" id="desc" class="form-control transform"></textarea>
                    {{-- <input type="text" class="form-control transform" id="user" name="mobile" placeholder="ادخل رقم الجوال الخاص بك"> --}}
                    @if ($errors->has('stars'))
                        <span class="invalid-feedback" style="display:block;" role="alert">
                            <strong>{{ $errors->first('stars') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        
          <div class="form-group text-center">
            <input type="submit" class="engaz-btn transform pull-left sendy"  value="ارسال">
          </div>
  
        </form>
      </div>
</div>
 
@endsection




@push('page_scripts')
<script>
  // rating script
  $(document).ready(function(){ 

      $(".openImageModal").on('click', function(){

        $("#imgView").attr('src', $(this).data('url'));
        $('#lightBox').modal('show');

    });


      $('.rate-btn').mouseenter( function(){
          $('.rate-btn').removeClass('rate-btn-hover');
          var therate = $(this).attr('id');
          for (var i = therate; i >= 0; i--) {
              $('.rate-btn-'+i).addClass('rate-btn-hover');
              // console.log(therate);
          };
          
          if (therate == 1) {
            $(".res").text("سيء جدا") ;
          }else if(therate == 2){
            $(".res").text("سيء") ;
          }else if(therate == 3){
            $(".res").text("متوسط") ;
          }else if(therate == 4){
            $(".res").text("جيد") ;
          }else if(therate == 5){
            $(".res").text("ممتاز") ;
          }
      });
      $('.rate-btn').mouseleave( function(){
          $('.rate-btn').removeClass('rate-btn-hover');
          var therate = $(this).attr('id');
          $(".res").text(' ') ;
      });
        
                      
      $('.rate-btn').click(function(){    
          var therate = $(this).attr('id');
        //  var dataRate = 'act=rate&post_id=&rate='+therate; //
          $('.rate-btn').removeClass('rate-btn-active');
          for (var i = therate; i >= 0; i--) {
              $('.rate-btn-'+i).addClass('rate-btn-active');
          };
          if (therate == 1) {
            $(".result_light").show().text("سيء جدا") ;
              $('#raty').val(therate);
          }else if(therate == 2){
            $(".result_light").show().text("سيء") ;
              $('#raty').val(therate);
          }else if(therate == 3){
            $(".result_light").show().text("متوسط") ;
              $('#raty').val(therate);
          }else if(therate == 4){
            $(".result_light").show().text("جيد") ;
              $('#raty').val(therate);
          }else if(therate == 5){
            $(".result_light").show().text("ممتاز") ;
              $('#raty').val(therate);
          }

          
      });

      $('.sendy').on('click', function(event){
        event.preventDefault();
        if(!$('#raty').val() || $("#raty").val() == "no"){
          console.log('eeee')
          $('#rate-messages').show();
          $('#rate-messages').text('يرجى اختيار تقييم النجوم');
        }else{
          $('#rate-messages').hide();
          $('#rating').submit();
        }
        
      });
  });
</script>
@endpush