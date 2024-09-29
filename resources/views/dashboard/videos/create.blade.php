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
                            اضافة فيديو
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                                <a href="{{ route('dashboard.video.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="fa fa-stream"></i>
                                    <span>جميع الفيديوهات</span>
                                </span>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item"></li>
                    </ul>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('dashboard.video.store') }}" class="m-form m-form--fit m-form--label-align-right">
                @csrf
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">العنوان عربي</label>
                        <div class="col-lg-6">
                            <input type="text" name="title_ar" value="{{ old('title_ar') }}" class="form-control m-input m-input--solid" >
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">العنوان انجليزي</label>
                        <div class="col-lg-6">
                            <input type="text" name="title_en" value="{{ old('title_en') }}" class="form-control m-input m-input--solid" >
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الوصف عربي</label>
                        <div class="col-lg-6">
                            <textarea name="descr_ar" id="" cols="30" rows="3" class="form-control m-input m-input--solid">{{ old('descr_ar') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الوصف انجليزي</label>
                        <div class="col-lg-6">
                                <textarea name="descr_en" id="" cols="30" rows="3" class="form-control m-input m-input--solid">{{ old('descr_en') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الرابط</label>
                        <div class="col-lg-6">
                            <input type="text" name="video_url" value="{{ old('video_url') }}" class="form-control m-input m-input--solid">
                        </div>
                    </div>
              
                    <div class="m-form__group m-form__group--last form-group row">
                        <label class="col-lg-2 col-form-label">حالة الفيديو</label>
                        <div class="col-lg-6">
                            <div class="m-checkbox-list">
                                <label class="m-checkbox">
                                    <input type="radio" name="status" @if (old('status') == 1)  checked @endif value="1"> منشور
                                    <span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="radio" name="status" @if (old('status') == 0) checked @endif value="0"> غير منشور
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-accent">اضافة</button>
                                <button type="reset" class="btn btn-secondary">الغاء</button>
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

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush
