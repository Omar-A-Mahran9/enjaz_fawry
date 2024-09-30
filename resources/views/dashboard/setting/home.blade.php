@extends('layouts.dashboard')
@push('page_styles')

@endpush
@section('content')



<div class="row">
    <div class="col-lg-12">

        <!--begin::Portlet-->
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            اعدادات الصفحة الرئيسية
                        </h3>
                    </div>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('dashboard.homeUpdate') }}" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator">
                @csrf
                @method('PUT')
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">ليش صالح عربي</label>
                        <div class="col-lg-6">
                            <textarea name="item1_ar"  cols="30" rows="2" class="form-control m-input m-input--solid ">{{ $home_setting->item1_ar }}</textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">ليش صالح انجليزي</label>
                        <div class="col-lg-6">
                            <textarea name="item1_en"  cols="30" rows="2" class="form-control m-input m-input--solid ">{{ $home_setting->item1_en }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">وصف ليش صالح عربي</label>
                        <div class="col-lg-6">
                            <textarea name="item2_ar"  cols="30" rows="5" class="form-control m-input m-input--solid ">{{ $home_setting->item2_ar }}</textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">وصف ليش صالح انجليزي</label>
                        <div class="col-lg-6">
                            <textarea name="item2_en"  cols="30" rows="5" class="form-control m-input m-input--solid ">{{ $home_setting->item2_en }}</textarea>
                        </div>
                    </div>


                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">موزع معتمد عربي</label>
                        <div class="col-lg-6">
                            <textarea name="item3_ar"  cols="30" rows="2" class="form-control m-input m-input--solid ">{{ $home_setting->item3_ar }}</textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">موزع معتمد انجليزي</label>
                        <div class="col-lg-6">
                            <textarea name="item3_en"  cols="30" rows="2" class="form-control m-input m-input--solid ">{{ $home_setting->item3_en }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">وصف موزع معتمد عربي</label>
                        <div class="col-lg-6">
                            <textarea name="item4_ar"  cols="30" rows="5" class="form-control m-input m-input--solid ">{{ $home_setting->item4_ar }}</textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">وصف موزع معتمد انجليزي</label>
                        <div class="col-lg-6">
                            <textarea name="item4_en"  cols="30" rows="5" class="form-control m-input m-input--solid ">{{ $home_setting->item4_en }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">طلب الشراء عربي</label>
                        <div class="col-lg-6">
                            <textarea name="item5_ar"  cols="30" rows="2" class="form-control m-input m-input--solid ">{{ $home_setting->item5_ar }}</textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">طلب الشراء انجليزي</label>
                        <div class="col-lg-6">
                            <textarea name="item5_en"  cols="30" rows="2" class="form-control m-input m-input--solid ">{{ $home_setting->item5_en }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">وصف طلب الشراء عربي</label>
                        <div class="col-lg-6">
                            <textarea name="item6_ar"  cols="30" rows="5" class="form-control m-input m-input--solid ">{{ $home_setting->item6_ar }}</textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">وصف طلب الشراء انجليزي</label>
                        <div class="col-lg-6">
                            <textarea name="item6_en"  cols="30" rows="5" class="form-control m-input m-input--solid ">{{ $home_setting->item6_en }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">من نحن عربي</label>
                        <div class="col-lg-6">
                            <textarea name="item7_ar"  cols="30" rows="5" class="form-control m-input m-input--solid summernote">{{ $home_setting->item7_ar }}</textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">من نحن انجليزي</label>
                        <div class="col-lg-6">
                            <textarea name="item7_en"  cols="30" rows="5" class="form-control m-input m-input--solid summernote">{{ $home_setting->item7_en }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">فيديو من نحن</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control m-input m-input--solid" name="item8" value="{{ $home_setting->item8 }}">
                        </div>
                    </div>

                    صفحة طلب الشراء

                    
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الجزء العلوي عربي</label>
                        <div class="col-lg-6">
                            <textarea name="item9_ar"  cols="30" rows="5" class="form-control m-input m-input--solid ">{{ $home_setting->item9_ar }}</textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الجزء العلوي انجليزي</label>
                        <div class="col-lg-6">
                            <textarea name="item9_en"  cols="30" rows="5" class="form-control m-input m-input--solid ">{{ $home_setting->item9_en }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الجزء السفلي عربي</label>
                        <div class="col-lg-6">
                            <textarea name="item10_ar"  cols="30" rows="5" class="form-control m-input m-input--solid ">{{ $home_setting->item10_ar }}</textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الجزء السفلي انجليزي</label>
                        <div class="col-lg-6">
                            <textarea name="item10_en"  cols="30" rows="5" class="form-control m-input m-input--solid ">{{ $home_setting->item10_en }}</textarea>
                        </div>
                    </div>


                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">رقم الجوال</label>
                        <div class="col-lg-6">
                            <input name="item11" type="text" class="form-control m-input m-input--solid"  value="{{ $home_setting->item11 }}">
                        </div>
                    </div>

                    
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">البريد الالكتروني</label>
                        <div class="col-lg-6">
                            <input name="item12" type="text" class="form-control m-input m-input--solid"  value="{{ $home_setting->item12 }}">
                        </div>
                    </div>

                    
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">واتساب</label>
                        <div class="col-lg-6">
                            <input name="item13" type="text" class="form-control m-input m-input--solid"  value="{{ $home_setting->item13 }}">
                        </div>
                    </div>
                   
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success">تحديث</button>
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
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
@endpush
