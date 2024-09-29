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
                            اضافة صفحة
                        </h3>
                    </div>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('dashboard.custom_pages.store') }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                @csrf
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">العنوان عربي</label>
                        <div class="col-lg-6">
                            <input type="text" name="title_ar" value="{{ old('title_ar') }}" required class="form-control m-input m-input--solid" >
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">العنوان انجليزي</label>
                        <div class="col-lg-6">
                            <input type="text" name="title_en" value="{{ old('title_en') }}" required class="form-control m-input m-input--solid" >
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الوصف عربي</label>
                        <div class="col-lg-6">
                            <textarea name="description_ar" value="{{ old('description_ar') }}" required id="" cols="30" rows="10" class="form-control m-input m-input--solid"></textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الوصف انجليزي</label>
                        <div class="col-lg-6">
                            <textarea name="description_en" value="{{ old('description_en') }}" required id="" cols="30" rows="10" class="form-control m-input m-input--solid"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">المحتوى عربي</label>
                        <div class="col-lg-6">
                            <textarea name="content_ar" value="{{ old('content_ar') }}" required id="" cols="30" rows="10" class="form-control m-input m-input--solid summernote"></textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">المحتوى انجليزي</label>
                        <div class="col-lg-6">
                            <textarea name="content_en" value="{{ old('content_en') }}" required id="" cols="30" rows="10" class="form-control m-input m-input--solid summernote"></textarea>
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

@push('page_vendors')

@endpush

@push('page_scripts')
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
@endpush
