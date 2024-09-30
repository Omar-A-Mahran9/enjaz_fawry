@extends('engazFawry.layouts.dashboard')


@section('dashboard')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="  {{ route('client_dashboard') }}">لوحة التحكم</a></li>
    <li class="breadcrumb-item"><a href="{{ route('withdrawal.index') }}">طلبات المسحوبات</a></li>
    <li class="breadcrumb-item active" aria-current="page">طلب رقم: {{$withdraw->id}}</li>
  </ol>
</nav>
 
<div class="aside-row p-2 mb-3 text-right">

    <div class="row">
      
      <h5>تفاصيل طلب السحب رقم : {{$withdraw->id}}</h5>

      <table class="table table-bordered">
        <tbody>
          <tr>
            <td>حالة الطلب  </td>
            <td>
                @if($withdraw->status == "-1")
                    جديد 
                @elseif($withdraw->status == "0")
                    مرفوض
                @elseif($withdraw->status == "1")
                    تم التحويل
                @else
                    --
                @endif
            </td>
          </tr>

          @if($withdraw->status == "0")
            <tr>
                <td>سبب الرفض  </td>
                <td>{{ $withdraw->description }}</td>
            </tr>
          @endif
         
          <tr>
            <td>اجمالى المبلغ المطلوب  </td>
            <td>{{ $withdraw->total_amount }} ر.س</td>
          </tr>
          <tr>
            <td>الطلبات المرتبطة  </td>
            <td>
                {{-- {{ $withdraw->balances }} --}}
                @php 
                    $arr = explode(',', $withdraw->balances);

                
                    foreach ($arr as $rr) {
                        $balance = App\Balance::find($rr);
                        $balance_order_no = $balance->order->order_no;
                        $balance_order_id = $balance->order->id;
                      //  $balance_process_id = $balance->order->processMo3ala()->id;

                          $processMo3amla = App\Mo3amlaProcessing::where('mo3amla_id', $balance_order_id)->where('user_id', $user->id)->where('choosen', 1)->first();

                          $processMo3amlaId = $processMo3amla->id;
                        // dd($balance_order_no);
                        echo "<a style='margin-left:7px;' href='".route('order.show', $processMo3amlaId  )."'>".$balance_order_no."</a> ";
                    }
                @endphp
                 
            </td>
          </tr>

          @if($withdraw->status == "1")
          <tr>
            <td>اثبات التحويل  </td>
            <td>
              @php 
                $ext = pathinfo($withdraw->transfer_prove, PATHINFO_EXTENSION);
              @endphp


              @if($ext == 'pdf')

                <a class="pdfFile" href="{{ asset('storage/transfer_prove') .'/'. $withdraw->transfer_prove}}" target="_blank">
                    <i class="fa fa-file"></i>  
                </a>

              @else

                {{-- data-target="#lightBox" data-toggle="modal"  --}}
                <img class="openImageModal" src="{{ url('storage/transfer_prove') . '/' . $withdraw->transfer_prove }}"  data-url="{{ url('storage/transfer_prove') . '/' . $withdraw->transfer_prove }}" width="200"  >

              @endif</td>
          </tr>
          @endif
        

        </tbody>
      </table>


  </div>


  

<div class="modal fade" id="lightBox" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <!-- Carousel markup goes in the modal body -->
            <img class="d-block w-100" id="imgView" src="">
            {{-- <img class="d-block w-100" src="{{ url('storage/payment_proves') . '/' . $order->transfer_prove }}"> --}}
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