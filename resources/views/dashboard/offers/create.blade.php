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
                            اضافة عرض جديد
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                                <a href="{{ route('dashboard.offers.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="fa fa-stream"></i>
                                    <span>جميع العروض</span>
                                </span>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item"></li>
                    </ul>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('dashboard.offers.store') }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                @csrf
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الاسم عربي</label>
                        <div class="col-lg-6">
                            <input type="text" name="title_ar" value="{{ old('title_ar') }}" class="form-control m-input m-input--solid" >
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الاسم انجليزي</label>
                        <div class="col-lg-6">
                            <input type="text" name="title_en" value="{{ old('title_en') }}" class="form-control m-input m-input--solid" >
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الوصف عربي</label>
                        <div class="col-lg-6">
                            <textarea name="body_ar" id="" cols="30" rows="2" class="form-control m-input m-input--solid summernote">{{ old('body_ar') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الوصف انجليزي</label>
                        <div class="col-lg-6">
                            <textarea name="body_en" id="" cols="30" rows="3" class="form-control m-input m-input--solid summernote">{{ old('body_en') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الصورة</label>
                        <div class="col-lg-6">
                            <input type="file" name="main_image" class="form-control m-input m-input--solid">
                        </div>
                    </div>

                    <div class="m-form__group m-form__group--last form-group row">
                        <label class="col-lg-2 col-form-label">نوع الغلاف</label>
                        <div class="col-lg-6">
                            <div class="m-checkbox-list">
                                <label class="m-checkbox">
                                    <input type="radio" name="type" @if (old('type') == 1)  checked @endif id="type_image" value="1"> صورة
                                    <span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="radio" name="type" @if (old('type') == 2) checked @endif id="type_video" value="2"> فيديو 
                                    <span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="radio" name="type" @if (old('type') == 3) checked @endif id="type_slider" value="3"> سلايدر 
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group m-form__group row"  id="image_type">
                        <label class="col-lg-2 col-form-label">صورة الغلاف</label>
                        <div class="col-lg-6">
                            <input type="file" name="image" class="form-control m-input m-input--solid">
                        </div>
                    </div>

                    <div class="form-group m-form__group row" id="video_type">
                        <label class="col-lg-2 col-form-label">الفيديو</label>
                        <div class="col-lg-6">
                            <input type="text" name="video" class="form-control m-input m-input--solid">
                        </div>
                    </div>

                    <div class="form-group m-form__group row" id="slider_type">
                        <label class="col-lg-2 col-form-label">السلايدر</label>
                        <div class="col-lg-6">
                            <select name="slider_name" class="form-control m-input">
                                @foreach ($sliders as $slider)
                                    <option value="{{ $slider->alias }}">{{ $slider->title }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>


                    <div class="m-form__group m-form__group--last form-group row">
                        <label class="col-lg-2 col-form-label">الحالة</label>
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

                    <div class="m-form__group m-form__group--last form-group row">
                        <label class="col-lg-2 col-form-label">السيارات</label>
                        <div class="col-lg-6">
                            <div class="m-checkbox-inline">
                                @foreach ($cars as $car)
                                    <label class="m-checkbox">
                                    <input type="checkbox" name="cars[]" value="{{ $car->id }}">{{ carName($car) }}</p>
                                        <span></span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>   
                    <div class="m-form__group m-form__group--last form-group row">
                        <label class="col-lg-2 col-form-label">الصلاحية</label>
                        <div class="col-lg-6">
                            <div class="m-checkbox-list">
                                <label class="m-checkbox">
                                    <input type="radio" name="validity" @if (old('validity') == 1)  checked @endif value="1"> متاح 
                                    <span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="radio" name="validity" @if (old('validity') == 0) checked @endif value="0"> غير متاح
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>


                    SEO
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الكلمات المفتاحية عربي</label>
                        <div class="col-lg-6">
                            <textarea name="meta_keyword_ar" id="" cols="30" rows="3" class="form-control m-input m-input--solid">{{ old('meta_keyword_ar') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الكلمات المفتاحية انجليزي</label>
                        <div class="col-lg-6">
                            <textarea name="meta_keyword_en" id="" cols="30" rows="3" class="form-control m-input m-input--solid">{{ old('meta_keyword_en') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الوصف عربي</label>
                        <div class="col-lg-6">
                            <textarea name="meta_desc_ar" id="" cols="30" rows="3" class="form-control m-input m-input--solid">{{ old('meta_desc_ar') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الوصف انجليزي</label>
                        <div class="col-lg-6">
                            <textarea name="meta_desc_en" id="" cols="30" rows="3" class="form-control m-input m-input--solid">{{ old('meta_desc_en') }}</textarea>
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

<script>
    $("#image_type").hide();
    $("#video_type").hide();
    $("#slider_type").hide();

    $(document).ready(function () {

        var ckbox = $('#type_image');
        $('#type_image').on('click',function () {
            if (ckbox.is(':checked')) {
                $("#image_type").show();
                $("#video_type").hide();
                 $("#slider_type").hide();
            }
        });

    });

    $(document).ready(function () {

        var ckbox = $('#type_video');
        $('#type_video').on('click',function () {
            if (ckbox.is(':checked')) {
                $("#video_type").show();
                $("#image_type").hide();
                $("#slider_type").hide();
            }
        });

    });

    $(document).ready(function () {

        var ckbox = $('#type_slider');
        $('#type_slider').on('click',function () {
            if (ckbox.is(':checked')) {
                $("#slider_type").show();
                $("#image_type").hide();
                $("#video_type").hide();
            }
        });

    });
</script>
@endpush
