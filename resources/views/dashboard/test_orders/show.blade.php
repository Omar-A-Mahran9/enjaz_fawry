@extends('layouts.dashboard')
@push('page_styles')
    <link href="{{ asset('metronic/default') }}/assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<!--begin::Portlet-->
<div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="main_portlet">
    <div class="m-portlet__head">
        <div class="m-portlet__head-progress">

            <!-- here can place a progress bar-->
        </div>
        <div class="m-portlet__head-wrapper">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class=" fa fa-headset"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        الطلب
                    </h3>
                </div>
                
            </div>
            <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('dashboard.test_order.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fa fa-stream"></i>
                            <span>عرض جميع طلبات التجربة</span>
                        </span>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item"></li>

                    </ul>
                </div>
        </div>
    </div>
    
    <form method="POST" action="{{ route('dashboard.test_order.update', ['id' => $order->id]) }}" class="m-form m-form--label-align-left- m-form--state-" id="m_form">
        @csrf
        @method('PUT')
        <!--begin: Form Body -->
        <div class="m-portlet__body">
            <div class="row">
                <div class="col-xl-8 offset-xl-2">
                    <div class="m-form__section m-form__section--first">

                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">الاسم:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text"  class="form-control m-input"  value="{{$order->name}}" disabled>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">هاتف:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="number" name="phone" class="form-control m-input" value="{{$order->phone}}" disabled>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">السيارة :</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" class="form-control m-input" value="{{$order->car_type}}" disabled>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">الوقت :</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text" class="form-control m-input" value="{{$order->date}}" disabled>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">معالج الطلب</label>
                            <div class="col-xl-9 col-lg-9">
                                @if ($order->processing_id == NULL)
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

    <!--end::Portlet-->
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush