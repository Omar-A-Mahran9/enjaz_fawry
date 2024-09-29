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
                            تعديل الصفحة
                        </h3>
                    </div>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('dashboard.custom_pages.update', ['id' => $page->id]) }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">العنوان عربي</label>
                        <div class="col-lg-6">
                            <input type="text" name="title_ar" value="{{$page->title_ar}}" class="form-control m-input m-input--solid" >
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">العنوان انجليزي</label>
                        <div class="col-lg-6">
                            <input type="text" name="title_en" value="{{$page->title_en}}" class="form-control m-input m-input--solid" >
                        </div>
                    </div>
                    
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الوصف عربي</label>
                        <div class="col-lg-6">
                            <textarea name="description_ar" cols="30" rows="10" class="form-control m-input m-input--solid">{{$page->description_ar}}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الوصف انجليزي</label>
                        <div class="col-lg-6">
                            <textarea name="description_en" cols="30" rows="10" class="form-control m-input m-input--solid">{{$page->description_en}}</textarea>
                        </div>
                    </div>
                    
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">المحتوى عربي</label>
                        <div class="col-lg-6">
                            <textarea name="content_ar" cols="30" rows="10" class="form-control m-input m-input--solid summernote">{!!$page->content_ar!!}</textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">المحتوى انجليزي</label>
                        <div class="col-lg-6">
                            <textarea name="content_en" cols="30" rows="10" class="form-control m-input m-input--solid summernote">{!!$page->content_en!!}</textarea>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-accent">تحديث</button>
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
