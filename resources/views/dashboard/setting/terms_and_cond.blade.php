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
                            الشروط والاحكام الخاصة بالموقع 
                        </h3>
                    </div>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('dashboard.termsUpdate') }}" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator">
                @csrf
                @method('PUT')
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">شروط واحكام طلب تعميد</label>
                        <div class="col-lg-6">
                            <textarea name="terms_ta3med"  cols="30" rows="7" class="form-control m-input m-input--solid summernote">{!! $data->terms_ta3med !!}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">شروط واحكام طلب ضمان مبلغ سلعة</label>
                        <div class="col-lg-6">
                            <textarea name="terms_guarante"  cols="30" rows="7" class="form-control m-input m-input--solid summernote">{!! $data->terms_guarante !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">شروط واحكام طلب معاملة</label>
                        <div class="col-lg-6">
                            <textarea name="terms_mo3amla"  cols="30" rows="7" class="form-control m-input m-input--solid summernote">{!! $data->terms_mo3amla !!}</textarea>
                        </div>
                    </div>
               
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">شروط واحكام طلب استفسار</label>
                        <div class="col-lg-6">
                            <textarea name="terms_estfsar"  cols="30" rows="7" class="form-control m-input m-input--solid summernote">{!! $data->terms_estfsar !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">شروط واحكام طلب شركات</label>
                        <div class="col-lg-6">
                            <textarea name="terms_shrkat"  cols="30" rows="7" class="form-control m-input m-input--solid summernote">{!! $data->terms_shrkat !!}</textarea>
                        </div>
                    </div>

                     <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">شروط واحكام تسجيل معقب / مكتب خدمات</label>
                        <div class="col-lg-6">
                            <textarea name="terms_vendor"  cols="30" rows="7" class="form-control m-input m-input--solid summernote">{!! $data->terms_vendor !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">شروط واحكام تسجيل مستخدم</label>
                        <div class="col-lg-6">
                            <textarea name="terms_client"  cols="30" rows="7" class="form-control m-input m-input--solid summernote">{!! $data->terms_client !!}</textarea>
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
