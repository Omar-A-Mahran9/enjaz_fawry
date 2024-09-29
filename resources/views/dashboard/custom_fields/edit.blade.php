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
                            تعديل الحقل
                        </h3>
                    </div>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('dashboard.custom_fields.update', ['id' => $field->id]) }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الوصف</label>
                        <div class="col-lg-6">
                            <textarea name="title" id="" cols="30" rows="2" class="form-control m-input m-input--solid">{{ $field->title }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الوصف عربي</label>
                        <div class="col-lg-6">
                            <textarea name="body_ar" id="" cols="30" rows="2" class="form-control m-input m-input--solid summernote">{{ $field->body_ar }}</textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الوصف انجليزي</label>
                        <div class="col-lg-6">
                            <textarea name="body_en" id="" cols="30" rows="3" class="form-control m-input m-input--solid summernote">{{ $field->body_en }}</textarea>
                        </div>
                    </div>


                    <div class="m-form__group m-form__group--last form-group row">
                        <label class="col-lg-2 col-form-label">الحالة</label>
                        <div class="col-lg-6">
                            <div class="m-checkbox-list">
                                <label class="m-checkbox">
                                    <input type="radio" name="status" @if ($field->status == 1)  checked @endif value="1"> معروض
                                    <span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="radio" name="status" @if ($field->status == 0) checked @endif value="0"> غير معروض
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
                                    <input type="checkbox" name="cars[]" @if (in_array($car->id, $cars_in_field_array)) {{'checked'}} @endif value="{{ $car->id }}">{{ carName($car) }}</p>
                                        <span></span>
                                    </label>
                                @endforeach
                            </div>
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
