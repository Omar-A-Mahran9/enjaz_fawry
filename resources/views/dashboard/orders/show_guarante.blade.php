@extends('layouts.dashboard')
@push('page_styles')
@endpush

@section('content')
<!--begin::Portlet-->
<div class="m-portlet m-portlet--mobile" >
    <div class="m-portlet__head">
        <div class="m-portlet__head-progress">

            <!-- here can place a progress bar-->
        </div>
        <div class="m-portlet__head-wrapper">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="fa fa-shopping-cart"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        طلب ضمان سلعة رقم : {{  $order->order_no }}
                    </h3>
                    {{-- <a href="{{ route('dashboard.order.edit', ['id' => $order->id]) }}" class="btn m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fa fa-edit"></i>
                            <span>تعديل الطلب الحالي</span>
                        </span>
                    </a> --}}
                </div>
                
            </div>
            <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
            
                        @include('layouts.inc.editStatus')

                    </ul>
                </div>
        </div>
    </div>
    
    <form method="POST" action="{{ route('dashboard.order.guarante.update', ['id' => $order->id]) }}" class="m-form m-form--label-align-left- m-form--state-" id="m_form">
        @csrf
        @method('PUT')
        <!--begin: Form Body -->
        <div class="m-portlet__body">
            <div class="row">
                <div class="col-xl-8 offset-xl-2">
                    <div class="m-form__section m-form__section--first">

                        {{-- @if ($order->type == 1 && $order->payment_method == 1 ) --}}
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">حالة الطلب:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text"  class="form-control m-input"  value="{{  getStatusAdmin($order->status) }}" disabled>
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">جوال المشتري:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text"  class="form-control m-input"  value="{{ $order->phone_buyer }}" disabled>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">جوال البائع	:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input" value="{{$order->phone_seller}}" disabled>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">عدد أيام العمل	:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input" value="{{$order->days}} يوم" disabled>
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">قيمة التعميد:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input" value="{{$order->ta3med_value}} ر.س" disabled>
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">نص الاتفاق:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input" value="{{$order->ta3med_details}}" disabled>
                                </div>
                            </div>

                            
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">تكلفة الخدمة :</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input" value="{{$order->ta3med_price}} ر.س" disabled>

                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">اجمالي المبلغ :</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input" value="{{$order->total_price}} ر.س" disabled>

                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">طريقة الدفع:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input" value="@if ($order->payment_method == 'transfer')تحويل بنكي@elseif($order->payment_method == 'online_payment')دفع اونلاين@endif" disabled>
                                </div>
                            </div>

                            @if($order->attachment != Null )
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">المرفقات :</label>
                                    <div class="col-xl-9 col-lg-9">
                                    @php 
                                        $images = unserialize($order->attachment);
                                    @endphp

                                    @foreach($images as $img)

                                        @php 
                                            $ext = pathinfo($img, PATHINFO_EXTENSION);
                                        @endphp
                
                
                                        @if($ext == 'pdf' || $ext == 'PDF')
                        
                                        <a  class="pdfFile" href="{{ asset('storage/order_guarante') .'/'. $img}}" target="_blank">
                                            <i class="fa fa-file-pdf"></i>  
                                        </a>
                        
                                        @else
                                        {{-- data-target="#lightBox" data-toggle="modal" --}}
                                            <img data-url="{{ asset('storage/order_guarante') }}/{{$img}}" class="openImageModal" style="display: inline-block;
                                            float: right;
                                            border: 1px solid #853BCC;
                                            width: 50px;
                                            height: 50px;
                                            float: right;
                                            cursor:pointer;
                                            margin-left: 5px;" 
                                            src="{{ asset('storage/order_guarante') }}/{{$img}}" style="margin-left:7px;" width="50" height="50">
                                        
                                        @endif


                                    @endforeach
                                        
                                    </div>
                                </div>

                            @endif
                    

                            @if($order->transfer_prove != 0)
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">اثبات الدفع </label>


                                    
                                    <div class="col-xl-4 col-lg-4" >

                                    @if($order->payment_method == 'transfer')
                                        @php 
                                            $ext = pathinfo($order->transfer_prove, PATHINFO_EXTENSION);
                                        @endphp


                                        @if($ext == 'pdf')

                                        <a class="pdfFile" href="{{ asset('storage/payment_proves') .'/'. $order->transfer_prove}}" target="_blank">
                                          <i class="fa fa-file"></i>  
                                        </a>
                      
                                        @else
                      
                                            {{-- <img data-target="#lightBox" data-toggle="modal"  src="{{ url('storage/payment_proves') . '/' . $order->transfer_prove }}" width="200"  > --}}
                      
                                            <img data-url="{{ asset('storage/payment_proves') }}/{{$order->transfer_prove}}" class="openImageModal" style="display: inline-block;
                                            float: right;
                                            border: 1px solid #853BCC;
                                            width: 50px;
                                            height: 50px;
                                            float: right;
                                            cursor:pointer;
                                            margin-left: 5px;" 
                                            src="{{ asset('storage/payment_proves') }}/{{$order->transfer_prove}}" style="margin-left:7px;" width="50" height="50">

                                        @endif
                                    @elseif($order->payment_method == 'online_payment')

                                        <b>الرقم المرجعي : </b><span>{{ $order->transfer_prove }}</span>
                                    @endif

                                    </div>
                                    
                                </div>
                            @endif 

                            @if($order->payment_method != "online_payment")
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">حالة اثبات الدفع </label>
                                    @if($order->prove_status == 0 && $order->transfer_prove == 0)

                                        <div class="col-xl-4 col-lg-4" >
                                            لم يتم رفع اثبات الدفع 
                                        </div>
                                    @elseif($order->prove_status == -1 && $order->transfer_prove != 0)

                                        <div class="col-xl-4 col-lg-4" >
                                            مرفوض بانتظار اعادة الرفع من العميل
                                        </div>
                                    @elseif($order->prove_status == 0 && $order->transfer_prove != 0)
                                        <div class="col-xl-4 col-lg-4" >
                                            غير مؤكد 
                                        </div>

                                        <div class="col-xl-4 col-lg-4" >
                                            {{-- Approve--}}
                                            <a onclick="event.preventDefault(); if(confirm('هل انت متأكد من تأكيد عملية الدفع؟')) { document.getElementById('approvePayment').submit(); }else{ return false }" href="{{ route('dashboard.order.guarante.paymentStatus', ['id' => $order->id ]) }}"  class="btn btn-success">تأكيد الدفع</a>
                                        
                                            {{-- Deny--}}
                                            <a onclick="event.preventDefault(); if(confirm('هل انت متأكد من رفض عملية الدفع؟')) { document.getElementById('denyPayment').submit();}else{ return false }" href="{{ route('dashboard.order.guarante.paymentStatus', ['id' => $order->id ]) }}" class="btn btn-outline-danger">رفض الدفع</a>
                                        </div>

                                    @elseif($order->prove_status == 1)
                                        <div class="col-xl-4 col-lg-4" >
                                            مؤكد 
                                        </div>
                                    @endif
                                </div>
                            @endif 

                            @if($order->payment_method == "online_payment")
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">حالة الدفع </label>
                                    @if($order->prove_status == 1)
                                        مدفوع
                                    @else
                                        غير مدفوع
                                    @endif 
                                </div>
                            @endif 

                                        
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">معالجة لطلب</label>
                            <div class="col-xl-9 col-lg-9">
                                @if ($order->processing_id == NULL || !$order->processing()->exists())
                                    <select name="processing_id" class="form-control m-input">
                                        <option value="">اختار حالة</option>
                                        @foreach ($statuses as $status)
                                            @if ($status->id == $order->processing_id)
                                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                                            @endif
                                        @endforeach
                                        @foreach ($statuses as $status)
                                            @if ($status->id != $order->processing_id)
                                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                @else
                                <select name="processing_id" class="form-control m-input">
                                    @foreach ($statuses as $status)
                                        @if ($status->id == $order->processing_id)
                                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                                        @endif
                                    @endforeach
                                    @foreach ($statuses as $status)
                                        @if ($status->id != $order->processing_id)
                                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @endif
                            </div>
                        </div> 
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-accent">تحديث الحالة</button>
                    </div>
                </div>
            </div>
        </div>   
    </form>
</div>
<div></div>



 <form id="denyPayment" action="{{ route('dashboard.order.guarante.paymentStatus', ['id' => $order->id ]) }}" method="POST" style="display: none;">
    @method('PUT')
    @csrf
    <input type="hidden" name="guaranteOrderId" value="{{ $order->id }}">
    <input type="hidden" name="paymentStatus" value="-1">
</form>
<form id="approvePayment" action="{{ route('dashboard.order.guarante.paymentStatus', ['id' => $order->id ]) }}" method="POST" style="display: none;">
    @method('PUT')
    @csrf
    <input type="hidden" name="guaranteOrderId" value="{{ $order->id }}">
    <input type="hidden" name="paymentStatus" value="1">
</form>








<!--Change status Modal-->
<div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-body">
        <!-- Carousel markup goes in the modal body -->
            <form id="changeStatus" action="{{ route('dashboard.order.guarante.changeStatus', ['id' => $order->id ]) }}" method="POST" style="display: block;">
                @method('PUT')
                @csrf
                <input type="hidden" name="mo3amlaOrderId" value="{{ $order->id }}">
                <input type="hidden" name="status" id="change_status_value">
                <div class="form-group m-form__group row">
                    <label class="col-xl-3 col-lg-3 col-form-label" id="statusReason"></label>
                    <div class="col-xl-9 col-lg-9">
                        <textarea type="text" class="form-control m-input" name="statusReason" >{{ old('statusReason') }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-accent">تحديث </button>
            </form>
        </div>
    </div>
  </div>
</div>




<!--sendCustomSms Modal-->
<div class="modal fade" id="sendCustomSms" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <h3>ارسال رسالة SMS</h3>
            <!-- Carousel markup goes in the modal body -->
            <form id="customSMS" action="{{ route('dashboard.order.sendCustomSMS') }}" method="POST" style="display: block;">
              
                @csrf
                <input type="hidden" name="orderId" value="{{ $order->id }}">
                <input type="hidden" name="userPhone" value="{{ $order->orderUser->phone }}">
                <input type="hidden" name="userId" value="{{ $order->orderUser->id }}">
                
                <div class="form-group m-form__group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">جوال العميل </label>
                    <div class="col-xl-9 col-lg-9">
                        <input type="text" disabled class="form-control m-input" name="clientPhone"  value="{{ $order->orderUser->phone }}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">نص الرسالة</label>
                    <div class="col-xl-9 col-lg-9">
                        <textarea type="text" id="smsText" class="form-control m-input" name="smsText" >{{ old('statusReason') }}</textarea>
                        <div>عدد الحروف : <span id="countLetters">0</span></div>
                    </div>
                </div>
                <button type="submit" class="btn btn-accent pull-left">ارسال </button>
            </form>
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

@push('page_vendors')

@endpush

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