

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
                                تعديل بيانات المشرف
                            </h3>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                <form method="POST" action="{{ route('dashboard.moderators.update', ['id' =>$user->id]) }}" class="m-form m-form--fit m-form--label-align-right">
                    @csrf
                    @method('PUT')
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">الدور</label>
                            <div class="col-lg-6">
                                <select name="role" class="form-control m-input m-input--solid">
                                        <option value="{{ str_replace(['[', '"', ']'], '', $user->getRoleNames()) }}">{{ str_replace(['[', '"', ']'], '', $user->getRoleNames()) }}</option>
                                        @foreach ($roles as $role)
                                            @if (str_replace(['[', '"', ']'], '', $user->getRoleNames()) != $role->name)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">الاسم</label>
                            <div class="col-lg-6">
                                <input type="text" name="name" class="form-control m-input m-input--solid" value="{{ $user->name }}">
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">البريد الالكتروني</label>
                            <div class="col-lg-6">
                                <input type="text" name="email" class="form-control m-input m-input--solid" value="{{ $user->email }}">
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
    <script src="{{ asset('metronic/default') }}/assets/demo/custom/crud/forms/widgets/bootstrap-select.js" type="text/javascript"></script>

@endpush






