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
                            تعديل بيانات الفرع 
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('dashboard.branch.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>اضافة فرع</span>
                                </span>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item">
                                <a href="{{ route('dashboard.branch.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="fa fa-stream"></i>
                                    <span>جميع الفروع</span>
                                </span>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item"></li>
                    </ul>
                </div>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('dashboard.branch.update', ['id' => $branch->id]) }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="m-portlet__body">

                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">المدينة</label>
                            <div class="col-lg-6">
                                <select name="city_id" class="form-control m-input m-input--solid" id="exampleSelect1">
                                    @foreach ($cities as $city)
                                        @if ($branch->city_id == $city->id)
                                            <option value="{{ $city->id }}">{{ $city->name_ar }}</option>
                                        @endif
                                    @endforeach

                                    @foreach ($cities as $city)
                                        @if ($branch->city_id != $city->id)
                                            <option value="{{ $city->id }}">{{ $city->name_ar }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">العنوان بالعربي</label>
                            <div class="col-lg-6">
                                <textarea name="branch_address_ar" id="" cols="30" rows="3" class="form-control m-input m-input--solid">{{ $branch->branch_address_ar }}</textarea>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">العنوان بالانجليزي</label>
                            <div class="col-lg-6">
                                <textarea name="branch_address_en" id="" cols="30" rows="3" class="form-control m-input m-input--solid">{{ $branch->branch_address_en }}</textarea>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">الاسم بالعربي</label>
                            <div class="col-lg-6">
                                <input type="text" name="branch_name_ar" class="form-control m-input m-input--solid" value="{{ $branch->branch_name_ar }}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">الاسم بالانجليزي</label>
                            <div class="col-lg-6">
                                <input type="text" name="branch_name_en" class="form-control m-input m-input--solid" value="{{ $branch->branch_name_en }}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">الوصف عربي</label>
                            <div class="col-lg-6">
         
                                <textarea name="descr_ar" id="" cols="30" rows="3" class="form-control m-input m-input--solid">{{ $branch->descr_ar }}</textarea>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">الوصف انجليزي</label>
                            <div class="col-lg-6">
         
                                <textarea name="descr_en" id="" cols="30" rows="3" class="form-control m-input m-input--solid">{{ $branch->descr_en }}</textarea>
                            </div>
                        </div>
    
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">الدوام عربي</label>
                            <div class="col-lg-6">
                                <textarea name="working_ar" id="" cols="30" rows="3" class="form-control m-input m-input--solid">{{ $branch->working_ar }}</textarea>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">الدوام انجليزي</label>
                            <div class="col-lg-6">
                                <textarea name="working_en" id="" cols="30" rows="3" class="form-control m-input m-input--solid">{{ $branch->working_en }}</textarea>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">رابط خرائط جوجل</label>
                            <div class="col-lg-6">
                                <input type="text" name="branch_google_url" class="form-control m-input m-input--solid" value="{{ $branch->branch_google_url }}">
                            </div>
                        </div>
                        {{-- <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">خط الطول</label>
                            <div class="col-lg-6">
                                <input type="text" name="longitude" class="form-control m-input m-input--solid" value="{{ $branch->longitude }}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">دائرة العرض</label>
                            <div class="col-lg-6">
                                <input type="text" name="latitude" class="form-control m-input m-input--solid" value="{{ $branch->latitude }}">
                            </div>
                        </div> --}}
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">الفريم</label>
                            <div class="col-lg-6">
                                <textarea name="frame" id="" cols="30" rows="3" class="form-control m-input m-input--solid">{{ $branch->frame }}</textarea>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">الهاتف</label>
                            <div class="col-lg-6">
                                <input type="text" name="phone" class="form-control m-input m-input--solid" value="{{ $branch->phone }}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">الوتساب</label>
                            <div class="col-lg-6">
                                <input type="text" name="whatsapp" class="form-control m-input m-input--solid" value="{{ $branch->whatsapp }}">
                            </div>
                        </div>
                        
                        <div class="m-form__group m-form__group--last form-group row">
                            <label class="col-lg-2 col-form-label">الحالة</label>
                            <div class="col-lg-6">
                                <div class="m-checkbox-inline">
                                    <label class="m-checkbox">
                                        <input type="radio" name="status" @if ($branch->status == '1' ) {{ 'checked' }} @endif value="1"> ظاهر
                                        <span></span>
                                    </label>
                                    <label class="m-checkbox">
                                        <input type="radio" name="status" @if ($branch->status == '0' ) {{ 'checked' }} @endif value="0"> مخفي  
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


@endpush
