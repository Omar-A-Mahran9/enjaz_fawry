@extends('engazFawry.layouts.dashboard')


@section('dashboard')
  @if ($errors->any())
    <div class="alert alert-danger text-right justify-content-center mt-5">
      <ul class="">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="  {{ route('client_dashboard') }}">لوحة التحكم</a></li>
    <li class="breadcrumb-item"><a href="{{ route('panel.mo3amla') }}">المعاملات</a></li>
    <li class="breadcrumb-item active" aria-current="page">معاملة رقم: {{$order->order_no}}</li>
  </ol>
</nav>

<div class="aside-row p-2 mb-3 text-right">
    <div class="row">
      <h5>تفاصيل المعاملة رقم : {{ $order->order_no }}</h5>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td>حالة الطلب  </td>
            <td>
                {{ getStatusUser($order->status) }}
            </td>
          </tr>
          <tr>
            <td>جهة المعاملة  </td>
            <td>{{ $order->service->name }}</td>
          </tr>
          <tr>
            <td>موضوع المعاملة  </td>
            <td>{{ $order->mo3amla_subject }}</td>
          </tr>
          <tr>
            <td>تفاصيل المعاملة  </td>
            <td>{{ $order->mo3amla_details }} </td>
          </tr>

          @if($order->attachments != Null )
          <tr>
            <td>المرفقات  </td>
            <td>
                @php 
                  $images = unserialize($order->attachments);
                @endphp

                @foreach($images as $img)
                  @php 
                    $ext = pathinfo($img, PATHINFO_EXTENSION);
                  @endphp

                  @if($ext == 'pdf' || $ext == 'PDF')

                    <a class="pdfFile" href="{{ asset('storage/order_mo3amla') .'/'. $img}}" target="_blank">
                      <i style="line-height: 50px;" class="fa fa-file-pdf-o"></i>  
                    </a>
                  @else
                    <img data-url="{{ asset('storage/order_mo3amla') }}/{{$img}}" class="openImageModal"  style="display: inline-block;float: right;border: 1px solid #853BCC;width: 50px;cursor:pointer;height: 50px;float: right;margin-left: 5px;" src="{{ asset('storage/order_mo3amla') }}/{{$img}}" style="margin-left:7px;" width="50" height="50">
                  @endif
                @endforeach
            </td>
          </tr>
          @endif {{-- $order->attachments != Null --}}
      
      

          {{-- Start if admin answer Mo3amla --}}

          @if( 
             ($order->m_processType == "1" && $order->status != "-1") 
             || ($order->m_processType == "2" && $order->m_processVendorSelected != NULL) 
             || ($order->m_processType == "2A" && $order->m_processVendorSelected != NULL)   
             || ($order->m_processType == "2C" && $order->m_processVendorSelected != NULL)  
             || ($order->m_processType == "3" && $order->m_processVendorSelected != NULL)
             || ($order->m_processRequirment != NULL && $order->price != NULL && $order->m_processDays != NULL)
            )
          <tr style="background-color:#ccccd5;color:#333">
            <td><b> متطلبات انجاز المعاملة  </b></td>
            <td><b> {!! $order->m_processRequirment !!} </b></td>
          </tr>

          <tr style="background-color:#ccccd5;color:#333">
            <td><b> عدد ايام الانجاز  </b></td>
            <td><b> {{ $order->m_processDays }} ايام عمل </b></td>
          </tr>

          @if($order->m_processGovPrice != 0)
            <tr style="background-color:#ccccd5; color:#333">
              <td><b> تكلفة إنجاز المعاملة  </b></td>
              <td><b> {{ $order->m_enjazPrice + $order->m_processThirdPartyPrice }} ر.س </b></td>
            </tr>
            <tr style="background-color:#ccccd5; color:#333">
              <td><b> الرسوم الحكومية  </b></td>
              <td><b> {{ $order->m_processGovPrice }} ر.س </b></td>
            </tr>
            <tr style="background-color:#ccccd5; color:#333">
              <td><b> الاجمالي  </b></td>
              <td><b> {{ $order->price }} ر.س </b></td>
            </tr>
          @else
            <tr style="background-color:#ccccd5; color:#333">
              <td><b> تكلفة إنجاز المعاملة  </b></td>
              <td><b> {{ $order->price }} ر.س </b></td>
            </tr>
          @endif  {{-- $order->m_processGovPrice != 0 --}}
         
{{--************************************************
    ************************************************
    ************************************************
    *
    *               Action Needed
    *
    ************************************************
    ************************************************
    ************************************************--}}

@if(($order->status == "-1" || $order->status == "0") && $order->m_processType != Null)

  <tr style="background-color:#fff;color:#333">
    <td colspan="2">
      {{-- Approve--}}
      <a onclick="event.preventDefault();  document.getElementById('approve').submit();" class="btn btn-success" style="background-color: #3CBFAF;border-color:#3CBFAF; cursor:pointer">موافقة</a>
      {{-- Reject--}}
      <a onclick="event.preventDefault(); if(confirm('هل انت متأكد من رفض المعاملة؟')) { document.getElementById('reject').submit();}else{ return false }" style="cursor:pointer;" class="btn btn-outline-danger">رفض</a>
    </td>
  </tr>

@endif {{-- New order Approve Or reject price--}}


         


  {{--  check if he didnt select or upload payment File -----> Action Needed --}}

  @if( ($order->status == 1 || $order->status == "2" || $order->status == "-4" ) 
      && $order->m_processType != Null)

  <form class="signup-form text-right" style="margin-bottom:0;" action="{{ route('mo3amla.addNew.files') }}" method="POST" enctype="multipart/form-data" id="form">

    @csrf
    @if (Auth::check())
        <?php $cid= Auth::id(); ?>
        <input value="{{$cid}}" type="hidden" name="user_id">
        <input value="{{$order->id}}" type="hidden" name="order_id">
    @endif


    {{-- 1- Payment Method --}}
    @if($order->payment_method == "0")

    {{-- 1 - Detect Hidden field --}}
    <input value="1" type="hidden" name="addPayment">

    <tr style="background-color:#fff">
      <td> اختر طريقة الدفع * </td>
      <td>
        <div class="form-group">
          <select required="" onchange="ShowDiv(this.value)" class="form-control transform" id="payment_method" name="payment_method">
            <option selected="" value="null">اختر طريقة</option>
            @if($setting->bankPayment == 1)<option value="transfer">تحويل بنكي</option> @endif
            @if($setting->onlinePayment == 1)<option value="online_payment">دفع عن طريق فيزا / ماستر</option>@endif
          </select>
        </div>

        <div class="col-12 col-md-12 d-none" id="banks">
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
      <div class="col-12 col-md-12 d-none " id="bank_{{$bank->id}}">

        <div class="bankDt2">
          <p><span>اسم الحساب </span> <strong>{{$bank->accountName}}</strong> </p>
          <p><span>رقم الحساب </span> <strong>{{$bank->accountNo}}</strong> </p>
          <p><span>ايبان </span> <strong>{{$bank->accountIban}}</strong> </p>
        </div>
      </div>
      @endforeach

      </td>
    </tr>
    @endif   {{-- 1- Payment Method --}}


  {{-- 2- Order Need Notes --}}

  @if( $order->status == "-4" && $order->m_have_notes == "1")

    @if($order->notes->count() > 0 )

      @php
        $lastNote = $order->notes->last();
      @endphp

        @if( $lastNote->from == "admin" && $lastNote->to == "client" && $lastNote->user_id == $cid  && $lastNote->status == "1" )

          {{-- 2 - Detect Hidden field addNote --}}

          

          <tr style="background-color:#fff">
            <td>الملاحظات على الطلب :</td>
            <td>
              {{  $lastNote->content }}
            </td>
          </tr>
          @if($order->m_processNeedTextNotes ==  1 )

        <input value="{{  $lastNote->id  }}" type="hidden" name="addNote">
            <tr style="background-color:#fff">
              <td>اضافة ملاحظات :</td>
              <td>
                <textarea class="form-control" rows="3" name="orderNote" placeholder="ملاحظات" required autocomplete="off"></textarea>
              </td>
            </tr>
            
          @endif {{--  $lastNote->m_processNeedTextNotes ==  1 --}}

        @endif {{--  $lastNote->from == "admin" && $lastNote->to == "client" && $lastNote->user_id == $cid  && $lastNote->status == "1"  --}}

      @endif {{-- $order->notes->count() > 0  --}}

    @endif {{-- $order->status == "-4" && $order->m_have_notes == "1" --}}



{{-- 3- Order Need New Files --}}

  @if( $order->m_processNewFilesStatus == "-1")
    <tr style="background-color:#fff">

      <input value="1" type="hidden" name="needNewFiles">
      <td>ارفاق الملفات المطلوبة* :</td>
      <td>
          {{-- <div class="col-md-6 float-right"> --}}
          <div class="form-group">
          
          <label for="uploadFile" class="form-control transform custom-input" style="cursor: pointer; font-size: unset; text-align: center;">
              <svg xmlns="http://www.w3.org/2000/svg" width="21.363" height="21.363" viewBox="0 0 21.363 21.363">
              <path id="Icon_material-add-circle-outline" data-name="Icon material-add-circle-outline" d="M14.75,8.341H12.613v4.273H8.341V14.75h4.273v4.273H14.75V14.75h4.273V12.613H14.75ZM13.681,3A10.681,10.681,0,1,0,24.363,13.681,10.685,10.685,0,0,0,13.681,3Zm0,19.227a8.545,8.545,0,1,1,8.545-8.545A8.556,8.556,0,0,1,13.681,22.227Z" transform="translate(-3 -3)" fill="#853bcc"/>
          </svg>
          <div class="progress" style="display:none;">
              <div class="progress-bar" style="display:none;background-color:#3CBFAF!important" role="progressbar" aria-valuenow=""
              aria-valuemin="0" aria-valuemax="100" style="width: 0%">
              0%
              </div>
          </div>
          </label>
          <span class="upload_notes" style="color:#af0505; font-size:14px;">* الملفات المسموحة : jpg , png , pdf / بحد اقصى 5 ملفات / الا يزيد حجم الملف الواحد عن 2 ميجا بايت.</span>

          <input required type="file" multiple class="form-control transform inputWithPreview" id="uploadFile" name="newFiles[]" style="opacity: 0;
          position: absolute;width: 50px;
          z-index: -1;">
          </div>
      {{-- </div> --}}

      
      </td>
    </tr>


        


        @endif  {{-- $order->m_processNewFilesStatus == "-1" --}}

        @if(  $order->m_processNewFilesStatus == "-1" || ($order->payment_method != "0" && $order->transfer_prove != "0" && $order->prove_status != 1)  || ( $order->m_have_notes == "1" && ( $order->m_processNeedUploadNewFiles == "1" || $order->m_processNeedTextNotes == "1" ) ) )
          <tr style="background-color:#fff">
            <td colspan="2">                
              <input type="submit" class="engaz-btn transform" style=" margin: 0;padding: 7px 50px !important;" value="ارسال">
            </td>
          </tr>
        @endif  {{--  $order->m_processNewFilesStatus == "-1" || $order->payment_method != "0" --}}

          
{{-- <div class=" col-md-6 float-right">
              </div> --}}

          </form>

          @endif   {{-- end if client approve order price  --}}




          @else

          

          @endif




     
      


        {!! paymentMethodCheckUp($order, 'mo3amla.payment.prove') !!}


         {{-- Enjaz Prove  --}}

         @if($order->status == "5" && $order->enjaz_prove != NULL)

           

         <tr style="background-color:#fff; color:#333">
           <td><b> اثبات الانجاز  </b></td>
           <td>

              @php 
                  $ext = pathinfo($order->enjaz_prove, PATHINFO_EXTENSION);
              @endphp

              @if($ext == 'pdf')

                <a class="pdfFile" href="{{ asset('storage/enjaz_prove') .'/'. $order->enjaz_prove}}" target="_blank">
                  <i class="fa fa-file"></i>  
                </a>

              @else

                <img style="display: inline-block;float: right;border: 1px solid #853BCC;width: 50px;cursor:pointer;height: 50px;float: right;margin-left: 5px;" data-url="{{ url('storage/enjaz_prove') . '/' . $order->enjaz_prove }}" class="openImageModal"  width="70" height="70" src="{{ url('storage/enjaz_prove') . '/' . $order->enjaz_prove }}"  >

              @endif
            
            
            </td>
         </tr>

   
        
       @endif 

        {{-- Start Rating  --}}

        @if($order->status == "5" && $order->reviewed == "0")

           

          <tr style="background-color:#fff; color:#333">
            <td><b> تقييم الطلب  </b></td>
            <td><a href="#" data-toggle="modal" data-target="#rateOrder">تقييم الطلب</a></td>
          </tr>

    
         
        @endif 


        @if($order->reviewed == "1")
          {{-- @if($order->order_review->count() > 0) --}}

            <tr style="background-color:#fff; color:#333">
              <td><b> فاتورة الطلب   </b></td>
              <td><a href="{{ route('print.invoice.mo3amla', ['id' => $order->id])}}" target="_blank">  <i class="fa fa-file-pdf-o"></i>  الفاتورة </a></td>
            </tr>
          
          {{-- @endif  --}}
        @endif 


        {{-- @if($order->order_review()->exists())
          @if($order->order_review->count() > 0)

            <tr style="background-color:#fff; color:#333">
              <td><b> فاتورة الطلب   </b></td>
              <td><a href="#"  >  <i class="fa fa-file-pdf-o"></i>  الفاتورة </a></td>
            </tr>
          
          @endif 
        @endif  --}}
        

        </tbody>
      </table>

        {{-- @dd($order) --}}


      </div> {{--   row --}}
    </div> {{--  aside-row p-2 mb-3 text-right --}}

{{-- Image modal  --}}
@if($order->attachments != Null )
<div class="modal fade" id="lightBox" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <!-- Carousel markup goes in the modal body -->
        <img class="d-block w-100" id="imgView" src="">
            {{-- <img class="d-block w-100" src="{{ url('storage/order_mo3amla') . '/' . $img }}"> --}}
      </div>
    </div>
  </div>
</div>
@endif


{{-- Approve & Reject forms --}}
<form id="reject" action="{{ route('mo3amla.confirmReject', ['oid' => $order->id ]) }}" method="POST" style="display: none;">
  @method('PUT')
  @csrf
  <input type="hidden" name="orderId" value="{{ $order->id }}">
  <input type="hidden" name="status" value="-2">
</form>
<form id="approve" action="{{ route('mo3amla.confirmReject', ['oid' => $order->id ]) }}" method="POST" style="display: none;">
  @method('PUT')
  @csrf
  <input type="hidden" name="orderId" value="{{ $order->id }}">
  <input type="hidden" name="status" value="1">
</form>       

{{-- Rate Order Form Modal  --}}
<div class="modal fade" id="rateOrder" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="{{ route('mo3amla.review', ['oid' => $order->id ])}}" method="POST" id="rating" class="m-form m-form--fit m-form--label-align-right">
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
@endsection


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
    <script type="text/javascript">
//         $(function(){
//     var form=$('#rating');
//     var formMessages=$('#rate-messages');
//     $(form).submit(function(event){
//         event.preventDefault();
//         var formData=$(form).serialize();
//         $.ajax({
//             type:'POST',
//             url:$(form).attr('action'),
//             data:formData
//         }).done(function(response){
//             $(formMessages).removeClass('alert alert-danger');
//             $(formMessages).addClass('alert alert-success');
//             $(formMessages).text(response);
//             $('#ratename').val('');
//             $('#ratemail').val('');
//             $('#ratecontent').val('');
//             $('#raty').val('');            
//             //window.setTimeout(function(){location.reload()},5000);
//         }).fail(function(data){
//             $(formMessages).removeClass('alert alert-success');
//             $(formMessages).addClass('alert alert-danger');
//             if(data.responseText!==''){
//                 $(formMessages).text(data.responseText);
//             }else{
//                 $(formMessages).text('Oops! An error occured and your message could not be sent.');
//             }
//             //window.setTimeout(function(){location.reload()},5000);
//         });
//     });
// });
$(document).ready(function(){

$(document).ajaxStart(function () {
        $("#loading").show();
        $(".sendy").hide();
    }).ajaxStop(function () {
        $("#loading").hide();
        $(".sendy").show();
        setTimeout(function() {
            $('#form-messages').fadeOut('slow');
        }, 3000); // <-- time in milliseconds
    });
});
$(function () {
  $('[data-toggle="tooltipy"]').tooltip()
})
    </script>


@endpush