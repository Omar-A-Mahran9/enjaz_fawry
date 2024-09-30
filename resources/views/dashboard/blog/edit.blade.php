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
                            تعديل التدوينة
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('dashboard.blog.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>اضافة تدوينة</span>
                                </span>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item">
                                <a href="{{ route('dashboard.blog.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="fa fa-stream"></i>
                                    <span>جميع التدوينات</span>
                                </span>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item"></li>
                    </ul>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('dashboard.blog.update', ['id' => $post->id]) }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">العنوان</label>
                        <div class="col-lg-6">
                            <input type="text" name="title" value="{{ $post->title }}" class="form-control m-input m-input--solid" >
                        </div>
                    </div>
                  
                    {{-- <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">تغير الصورة الرئيسية</label>
                        <div class="col-lg-6">
                            <input type="file" name="main_image" class="form-control m-input m-input--solid">
                        </div>
                    </div> --}}

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">محتوى التدوينة</label>
                        <div class="col-lg-6">
                            <textarea name="body" id="" cols="30" rows="3" class="form-control m-input m-input--solid summernote">{{ $post->body }}</textarea>
                        </div>
                    </div>

                    {{-- <div class="m-form__group m-form__group--last form-group row">
                        <label class="col-lg-2 col-form-label">النوع</label>
                        <div class="col-lg-6">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input type="radio" @if ($post->type == '1')  {{ 'checked' }} @endif name="type" value="1"> تدوينة 
                                    <span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="radio" @if ($post->type == '2')  {{ 'checked' }} @endif name="type" value="2"> خبر
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="m-form__group m-form__group--last form-group row">
                        <label class="col-lg-2 col-form-label">اللغة</label>
                        <div class="col-lg-6">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input type="radio" @if ($post->lang == '1')  {{ 'checked' }} @endif name="lang" value="1"> عربي 
                                    <span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="radio" @if ($post->lang == '2')  {{ 'checked' }} @endif name="lang" value="2"> انجليزي
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div> --}}

                    <div class="m-form__group m-form__group--last form-group row">
                        <label class="col-lg-2 col-form-label">الحالة</label>
                        <div class="col-lg-6">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input type="radio" @if ($post->status == '1')  {{ 'checked' }} @endif name="status" value="1"> منشور
                                    <span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="radio" @if ($post->status == '0')  {{ 'checked' }} @endif name="status" value="0"> غير منشور 
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>

                   <h3> SEO </h3>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الكلمات المفتاحية</label>
                        <div class="col-lg-6">
                            <textarea name="meta_keyword" id="" cols="30" rows="3" class="form-control m-input m-input--solid">{{ $post->meta_keyword }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الوصف</label>
                        <div class="col-lg-6">
                            <textarea name="meta_desc" id="" cols="30" rows="3" class="form-control m-input m-input--solid">{{ $post->meta_desc }}</textarea>
                        </div>
                    </div>

           
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-accent">تعديل</button>
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
