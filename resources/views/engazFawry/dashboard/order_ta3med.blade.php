@extends('engazFawry.layouts.dashboard')


@section('dashboard')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="  {{ route('client_dashboard') }}">لوحة التحكم</a></li>
    <li class="breadcrumb-item"><a href="{{ route('panel.ta3med') }}">طلبات التعميد</a></li>
    <li class="breadcrumb-item active" aria-current="page">طلب رقم: {{$order->order_no}}</li>
  </ol>
</nav>

<div class="aside-row p-2 mb-3 text-right">

    <div class="row">
      
      <h5>تفاصيل الطلب رقم : {{$order->order_no}}</h5>

      <table class="table table-bordered">
        <tbody>
          <tr>
            <td>جوال صاحب الطلب  </td>
            <td>{{ $order->phone_client }}</td>
          </tr>
          <tr>
            <td>جوال المعقب  </td>
            <td>{{ $order->phone_mo3akeb }}</td>
          </tr>
          <tr>
            <td>عدد أيام العمل  </td>
            <td>{{ $order->days }} يوم</td>
          </tr>
          <tr>
            <td>قيمة التعميد  </td>
            <td>{{ $order->ta3med_value }} ر.س</td>
          </tr>
          <tr>
            <td>تكلفة الخدمة  </td>
            <td>{{ $order->ta3med_price }} ر.س</td>
          </tr>
          <tr>
            <td> <b> اجمالي المبلغ  </b></td>
            <td><b> {{ $order->total_price }} ر.س </b></td>
          </tr>
          <tr>
            <td> <b> نص الاتفاق  </b></td>
            <td><b> {{ $order->ta3med_details }}  </b></td>
          </tr>

          @if($order->attachment != Null )
            <tr>
              <td>المرفقات  </td>
              <td>
                  @php 
                    $images = unserialize($order->attachment);
                  @endphp

                  @foreach($images as $img)
                    @php 
                      $ext = pathinfo($img, PATHINFO_EXTENSION);
                    @endphp

                    @if($ext == 'pdf' || $ext == 'PDF')

                      <a class="pdfFile" href="{{ asset('storage/order_ta3med') .'/'. $img}}" target="_blank">
                        <i style="line-height: 50px;" class="fa fa-file-pdf-o"></i>  
                      </a>
                    @else
                      <img data-url="{{ asset('storage/order_ta3med') }}/{{$img}}" class="openImageModal"  style="display: inline-block;float: right;border: 1px solid #853BCC;width: 50px;cursor:pointer;height: 50px;float: right;margin-left: 5px;" src="{{ asset('storage/order_ta3med') }}/{{$img}}" style="margin-left:7px;" width="50" height="50">
                    @endif
                  @endforeach
              </td>
            </tr>
            @endif {{-- $order->attachments != Null --}}

          {!! paymentMethodCheckUp ($order, 'ta3med.payment.prove') !!}

          <tr>
            <td>حالة الطلب  </td>
            <td>
              {{ getStatusUser($order->status) }}
            </td>
          </tr>


        {{-- Start Rating  --}}

        @if($order->status == "5" && $order->reviewed == "0")

           

          <tr style="background-color:#fff; color:#333">
            <td><b> تقييم الطلب  </b></td>
            <td><a href="#" data-toggle="modal" data-target="#rateOrder">تقييم الطلب</a></td>
          </tr>

    
         
        @endif 


        {{-- if Rated print invoice  --}}
        @if($order->reviewed == "1")
          {{-- @if($order->order_review->count() > 0) --}}

            <tr style="background-color:#fff; color:#333">
              <td><b> فاتورة الطلب   </b></td>
              <td><a href="{{ route('print.invoice.ta3med', ['id' => $order->id])}}" target="_blank">  <i class="fa fa-file-pdf-o"></i>  الفاتورة </a></td>
            </tr>
          
          {{-- @endif  --}}
        @endif 

        </tbody>
      </table>

  </div>
{{-- Rate Order Form Modal  --}}
<div class="modal fade" id="rateOrder" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="{{ route('ta3med.review', ['oid' => $order->id ])}}" method="POST" id="rating" class="m-form m-form--fit m-form--label-align-right">
          @csrf
          @if (Auth::check())
          <?php $cid= Auth::id(); ?>
              <input value="{{$cid}}" type="hidden" name="user_id">
          @endif

          <div class="row">
            <h4>اضف تقييمك</h4>
            <br><br>
            <div class="col-12 col-md-12">
              <div class="form-group">
                <div class="rate_stars">
                    <span>التقييم* : </span>
                    <div class="rate-cnt">
                      <div id="1" class="rate-btn-1 rate-btn"></div>
                      <div id="2" class="rate-btn-2 rate-btn"></div>
                      <div id="3" class="rate-btn-3 rate-btn"></div>
                      <div id="4" class="rate-btn-4 rate-btn"></div>
                      <div id="5" class="rate-btn-5 rate-btn"></div>
                    </div>
                    <div class="res"></div>
                    <div class="result"></div>
                  </div><!-- rate-stars -->
                @if ($errors->has('rate'))
                    <span class="invalid-feedback" style="display:block;" role="alert">
                      <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="col-12 col-md-12">
              <div class="form-group">
                <label for="accountIban">الوصف<span>*</span></label>
                  <textarea class="form-control" rows="3" id="ratecontent" name="ratecontent" placeholder="التقييم" required autocomplete="off"></textarea>
                @if ($errors->has('description'))
                    <span class="invalid-feedback" style="display:block;" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
              </div>
            </div>
       
            <input type="hidden" id="raty" name="raty" value="no" >
            <input type="hidden" name="order_id" value="{{ $order->id }}" >
            <input type="hidden" name="order_no" value="{{ $order->order_no }}" >

          <button type="submit" class="transform user-engaz-btn"><span class="sendy">ارسال</span> </button>
        </div><!-- end row -->
      </form>
      <br>
      <span id="rate-messages" class="alert alert-danger" style="display:none;clear:both;" role="alert"></span>

      <div class="form-group text-left" style="margin-top:30px;"></div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="lightBox" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-body">
          <img class="d-block w-100" id="imgView" src="">
        </div>
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
            $(".result").show().text("سيء جدا") ;
              $('#raty').val(therate);
          }else if(therate == 2){
            $(".result").show().text("سيء") ;
              $('#raty').val(therate);
          }else if(therate == 3){
            $(".result").show().text("متوسط") ;
              $('#raty').val(therate);
          }else if(therate == 4){
            $(".result").show().text("جيد") ;
              $('#raty').val(therate);
          }else if(therate == 5){
            $(".result").show().text("ممتاز") ;
              $('#raty').val(therate);
          }

          
                          // $.ajax({
          //     type : "POST",
          //     url : "http://localhost/rating/ajax.php",
          //     data: dataRate,
          //     success:function(){}
          // });
          
      });

      $('.sendy').on('click', function(event){
        event.preventDefault();
        if(!$('#raty').val() || $("#raty").val() == "no"){
          console.log('eeee')
          $('#rate-messages').show();
          $('#rate-messages').text('يرجى اختيار التقييم المناسب');
        }else{
          $('#rate-messages').hide();
          $('#rating').submit();
        }
        
      });
  });
</script>
@endpush