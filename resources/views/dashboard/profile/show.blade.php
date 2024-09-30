@extends('layouts.dashboard')
@push('page_styles')

@endpush
@section('content')


<div class="row">
    <div class="col-xl-3 col-lg-4">
        <div class="m-portlet m-portlet--full-height  ">
            <div class="m-portlet__body">
                <div class="m-card-profile">
                    <div class="m-card-profile__title m--hide">
                        حسابك
                    </div>
                    <div class="m-card-profile__details">
                        <span class="m-card-profile__name">{{ $user->name }}</span>
                        <a href="" class="m-card-profile__email m-link">{{ $user->email }}</a>
                    </div>
                    <div class="m-portlet__body-separator"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-lg-8">
        <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-tools">
                    <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
                                <i class="flaticon-share m--hide"></i>
                                تحديث بيانات الحساب
                            </a>
                        </li>

                    </ul>
                </div>
                
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="m_user_profile_tab_1">
                    <form method="POST" action="{{ route('dashboard.profile.update', ['id' => auth()->user()->id ]) }}" class="m-form m-form--fit m-form--label-align-right">
                        @csrf
                        @method('PUT')
                        <div class="m-portlet__body">

                            <div class="form-group m-form__group row">
                                <div class="col-10 ml-auto">
                                    <h3 class="m-form__section">1. البيانات الشخصية</h3>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="example-text-input" class="col-3 col-form-label">الاسم بالكامل</label>
                                <div class="col-7">
                                    <input name="name" class="form-control m-input" type="text" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="example-text-input" class="col-3 col-form-label">البريد الالكتروني</label>
                                <div class="col-7">
                                    <input name="email" class="form-control m-input" type="email" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="example-text-input" class="col-3 col-form-label">كلمة السر</label>
                                <div class="col-7">
                                    <input name="password" class="form-control m-input" type="password" placeholder="ادخل كلمة السر الحالية لحفظ التغيرات" autocomplete="off">
                                </div>
                            </div>
                            <div class="m-form__actions">
                                <div class="row">
                                    <div class="col-3">
                                    </div>
                                    <div class="col-7">
                                        <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">حفظ</button>&nbsp;&nbsp;
                                        <button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">الغاء</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                    <div class="m-portlet__foot m-portlet__foot--fit"></div>

                    <form method="POST" action="{{ route('dashboard.profile.changePassword', ['id' => auth()->user()->id ]) }}" class="m-form m-form--fit m-form--label-align-right">
                        @csrf
                        @method('PUT')
                        <div class="m-portlet__body">

                            <div class="form-group m-form__group row">
                                <div class="col-10 ml-auto">
                                    <h3 class="m-form__section">2. تغير كلمة السر</h3>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="example-text-input" class="col-3 col-form-label">كلمة سر جديدة</label>
                                <div class="col-7">
                                    <input name="password" class="form-control m-input" type="password" placeholder="ادخل كلمة السر الجديدة" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="example-text-input" class="col-3 col-form-label">تأكيد كلمة السر</label>
                                <div class="col-7">
                                    <input name="password_confirmation" class="form-control m-input" type="password" placeholder="اعد ادخال كلمة السر" autocomplete="off">
                                </div>
                            </div> 
                            <div class="form-group m-form__group row">
                                <label for="example-text-input" class="col-3 col-form-label">كلمة السر الحالية</label>
                                <div class="col-7">
                                    <input name="current_pass" class="form-control m-input" type="password" placeholder="ادخل كلمة السر الحالية لحفظ التغيرات"  autocomplete="off">
                                </div>
                            </div>                               
                            <div class="m-form__actions">
                                <div class="row">
                                    <div class="col-3">
                                    </div>
                                    <div class="col-7">
                                        <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">حفظ</button>&nbsp;&nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane " id="m_user_profile_tab_2">
                </div>
                <div class="tab-pane " id="m_user_profile_tab_3">
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush
