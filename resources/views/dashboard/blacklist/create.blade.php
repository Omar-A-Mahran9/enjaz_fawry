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
                            اضافة رقم للقائمة
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                                <a href="{{ route('dashboard.blacklist.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="fa fa-stream"></i>
                                    <span>العودة للقائمة السوداء</span>
                                </span>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item"></li>
                        
                    </ul>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('dashboard.blacklist.store') }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                @csrf
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الاسم</label>
                        <div class="col-lg-6">
                            <input required type="text" name="name" value="{{ old('name') }}" class="form-control m-input m-input--solid" >
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">رقم الجوال</label>
                        <div class="col-lg-6">
                            <input required type="tel" name="mobile" value="{{ old('mobile') }}" class="form-control m-input m-input--solid" placeholder="مثال : 05xxxxxxxx" >
                        </div>
                    </div>
            
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">السبب</label>
                        <div class="col-lg-6">
                            <textarea required name="desc" id="" cols="30" rows="3" class="form-control m-input m-input--solid">{{ old('desc') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">اظهار السبب للعملاء </label>
                        <div class="col-lg-6">
                            <select required name="show_reason" class="form-control">
                                <option value=""> -- اختر -- </option>
                                <option value="1">نعم - اظهار السبب</option>
                                <option value="0"> لا - اخفاء السبب</option>
                            </select>
                        </div>
                    </div>
           
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-accent">اضافة</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

            <!--end::Form-->
        </div>

        <!--end::Portlet-->            
    </div>
</div>
@endsection

