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
                            تعديل المدينة
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('dashboard.cities.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>اضافة مدينة </span>
                                </span>
                            </a>
                        </li>    
                        <li class="m-portlet__nav-item">
                                <a href="{{ route('dashboard.cities.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="fa fa-stream"></i>
                                    <span>جميع المدن </span>
                                </span>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item"></li>
                    </ul>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('dashboard.cities.update', ['id' => $city->id]) }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="m-portlet__body">
                    

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الاسم </label>
                        <div class="col-lg-6">
                            <input type="text" name="name" class="form-control m-input m-input--solid" value="{{ $city->name }}">
                        </div>
                    </div>

                    {{-- <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الاسم بالانجليزي</label>
                        <div class="col-lg-6">
                            <input type="text" name="name_en" class="form-control m-input m-input--solid" value="{{ $city->name_en }}">
                        </div>
                    </div> --}}

                   
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
