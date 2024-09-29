@extends('layouts.dashboard')
@push('page_styles')

@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            معاينة وتعديل طلب السحب
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        {{-- <li class="m-portlet__nav-item">
                            <a href="{{ route('dashboard.banks.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                            <span>
                                <i class="la la-plus"></i>
                                <span>اضافة بنك</span>
                            </span>
                        </a> --}}
                        <li class="m-portlet__nav-item">
                                <a href="{{ route('dashboard.accounts.withdraw.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="fa fa-stream"></i>
                                    <span>جميع الطلبات</span>
                                </span>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item"></li>
                    </ul>
                </div>
            </div>
            

            <!--begin::Form-->
            <form method="POST" action="{{ route('dashboard.accounts.withdraw.update', ['id' => $withdraw->id]) }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="withdrawId" value="{{ $withdraw->id }}" >

                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">رقم الطلب</label>
                        <div class="col-lg-6">
                            <p style="line-height:40px;margin-bottom:0;">{{ $withdraw->id }}</p>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">المعقب / مكتب الخدمات</label>
                        <div class="col-lg-6">
                            {{-- <input type="text" name="accountName" value="" class="form-control m-input m-input--solid" > --}}
                            <p style="line-height:40px;margin-bottom:0;"><a target="_blank" href="{{ route('dashboard.vendor.vendor_show', ['id' => $withdraw->user->id ]) }}">{{ $withdraw->user->name }}</a></p>
                        </div>
                    </div>

                     <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">نوع الحساب</label>
                        <div class="col-lg-6">
                            {{-- <input type="text" name="accountName" value="" class="form-control m-input m-input--solid" > --}}
                            <p style="line-height:40px;margin-bottom:0;">
                                
                            @if($withdraw->user->type == 'vendor')
                                معقب 
                            @elseif($withdraw->user->type == 'vendorC')
                                مكتب خدمات 
                            @endif
                            </p>
                        </div>
                    </div>
        
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">المبلغ المطلوب</label>
                        <div class="col-lg-6">
                            <p style="line-height:40px;margin-bottom:0;">{{ $withdraw->total_amount }} ر.س</p>
                        </div>
                    </div>


                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الطلبات المرتبطة</label>
                        <div class="col-lg-6">

                            @php 
                                $arr = explode(',', $withdraw->balances);
                            
                                foreach ($arr as $rr) {
                                    $balance = App\Balance::find($rr);
                                    $balance_order_no = $balance->order->order_no;
                                    $balance_order_id = $balance->order->id;
                                    echo "<p style='line-height:40px;margin-bottom:0;'><a style='margin-left:7px;' target='_blank' href='".route('dashboard.order.mo3amla.show', $balance_order_id)."'>".$balance_order_no."</a></p>";
                                }
                            @endphp

                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">بيانات الحساب البنكي للمعقب</label>
                        <div class="col-lg-6">

                        @if($withdraw->user->banks->count() > 0 )

                            @php
                                
                            $bank = $withdraw->user->banks->last();
                            @endphp

                        
                            <div class="bank">
                                <p>
                                <strong> البنك : </strong>
                                <span>  {{$bank->name}} </span>
                                </p>
                                <p>
                                <strong> اسم الحساب :  </strong>
                                <span>  {{$bank->accountName}} </span>
                                </p>
                                <p>
                                <strong> رقم الحساب : </strong>
                                <span>  {{$bank->accountNo}} </span>
                                </p>
                                <p>
                                <strong> الايبان : </strong>
                                <span> {{$bank->accountIban}} </span>
                                </p>
                            </div>
                        
            
                        @else 
                            
                        <p style="line-height:40px;margin-bottom:0;">  لا يوجد</p>

                        @endif

                        </div>
                    </div>


                    @if($withdraw->status == '-1')
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">تعديل حالة الطلب</label>
                        <div class="col-lg-6">
                            <select required name="status" id="changeStatus" class="form-control m-input m-input--solid" >
                                <option value="">-- اختر الحالة -- </option>
                                <option value="1">تم التحويل</option>
                                <option value="0">مرفوض</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group m-form__group row" id="reasonWrap" style="display:none;">
                        <label class="col-lg-2 col-form-label">سبب الرفض</label>
                        <div class="col-lg-6">
                          <textarea name="reject_reason" id="reject_reason" class="form-control m-input m-input--solid" ></textarea>
                        </div>
                    </div>


                    <div class="form-group m-form__group row" id="transferProve" style="display:none;">
                        <label class="col-lg-2 col-form-label">اثبات التحويل</label>
                        <div class="col-lg-6">
                          <input type="file" name="transfer_prove" id="transfer_prove" class="form-control m-input m-input--solid" >
                        </div>
                    </div>


                      </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-accent">ارسال</button>
                            </div>
                        </div>
                    </div>
                </div>
                   
                    
                    @else 
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label"> حالة الطلب</label>
                        <div class="col-lg-6">
                          @if($withdraw->status == "0")

                            مرفوص
                            <br>
                            بسبب : {{ $withdraw->description}}
                        
                            @elseif($withdraw->status == "1")
                              
                            <p style="line-height:40px;margin-bottom:0;"> تم التحويل</p>

                             <br>
                            اثبات التحويل : 

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
        
                            @endif
                            @else
                            --
                            @endif

                            
                        </div>
                    </div>

                        
 </div>
                    @endif
                {{-- </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-accent">ارسال</button>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </form>

            <!--end::Form-->
        </div>

        <!--end::Portlet-->            
    </div>
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

@push('page_vendors')

@endpush

@push('page_scripts')
<script>
$(document).ready(function(){

  $(".openImageModal").on('click', function(){

        $("#imgView").attr('src', $(this).data('url'));
        $('#lightBox').modal('show');

    });





    $("#changeStatus").on("change", function(){ 
        var st = $(this).val();

        if( st == '0' ){

            $("#reasonWrap").show();
            $("#reject_reason").attr('required', true);

            $("#transferProve").hide();
            $("#transfer_prove").attr('required', false);

        }else if(st == '1'){

            $("#transferProve").show();
            $("#transfer_prove").attr('required', true);

            $("#reasonWrap").hide();
            $("#reject_reason").attr('required', false);

        }else{

            $("#reasonWrap").hide();
            $("#reject_reason").attr('required', false);

            $("#transferProve").hide();
            $("#transfer_prove").attr('required', false);

        }

    });
});
</script>    
@endpush
