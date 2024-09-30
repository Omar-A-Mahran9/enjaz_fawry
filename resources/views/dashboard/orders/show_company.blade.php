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
                        طلب شركة رقم : {{  $order->order_no }}
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
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('dashboard.order.company.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="fa fa-stream"></i>
                                    <span>عرض جميع طلبات الشركات</span>
                                </span>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item"></li>

                    </ul>
                </div>
        </div>
    </div>
    
    <form method="POST" action="{{ route('dashboard.order.company.update', ['id' => $order->id]) }}" class="m-form m-form--label-align-left- m-form--state-" id="m_form">
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
                                <label class="col-xl-3 col-lg-3 col-form-label">الاسم:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text"  class="form-control m-input"  value="{{ $order->name }}" disabled>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">الجوال:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input" value="{{$order->mobile}}" disabled>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">المدينة:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input" value="{{$order->city->name}}" disabled>
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">نوع نشاط الشركة/المؤسسة:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input" value="{{$order->type}}" disabled>
                                </div>
                            </div>

                            
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">الخدمات المطلوبة :</label>
                                <div class="col-xl-9 col-lg-9">
                                    <textarea class="form-control m-input" value="" disabled cols="30" rows="4" disabled>{{$order->service}}</textarea>
                                </div>
                            </div>
        

                        

                                        
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




    <!--end::Portlet-->
<div class="modal fade" id="lightBox" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      {{-- <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> --}}
      <div class="modal-body">
        <!-- Carousel markup goes in the modal body -->
        
            <img class="d-block w-100" src="{{ url('storage/payment_proves') . '/' . $order->transfer_prove }}">
      </div>
    </div>
  </div>
</div>









@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush