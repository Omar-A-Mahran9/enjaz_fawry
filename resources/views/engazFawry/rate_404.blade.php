@extends('engazFawry.layouts.app')
@section('content')
<img src="images/shape.png" alt="" class="bottom-left shape">
<img src="images/shape.png" alt="" class="bottom-right shape">
<div>
    {{-- <div class="row justify-content-center text-right">
        <h3 style="margin-top:40px;line-height:47px;display:block;clear:both;font-weight: 600;"> عميلنا العزيز ,,, </h3>
    </div>

    <div class="row justify-content-center text-right">
        <h5 style="margin:0 0 40px 0;line-height:47px;display:block;clear:both;font-weight: 600;">
            نأسف  .... تم استخدام هذا الرابط من قبل  
        </h5>
    </div> --}}

    <div class="container" style="margin-top:70px;margin-bottom:70px;padding-top:20px;padding-bottom:20px;" >

        <div class="alert alert-danger text-center">
            <i style="font-size:70px;margin:30px 0;" class="fa fa-exclamation-triangle"></i>
            <h5 style="margin:0 0 20px 0;line-height:47px;display:block;clear:both;font-weight: 600;">
                نأسف  .... تم استخدام هذا الرابط للتقييم من قبل  
            </h5>
            <p>
                للحصول على رابط جديد نأمل <a href="{{ route('contact')}}"> التواصل معنا </a> 
            </p>
        </div>
     
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