@extends('layouts.dashboard')
@push('page_styles')

@endpush
@section('content')
<div class="row">
    <div class="col-md-12">

        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--tab">

            <div class="m-portlet__body">

                <!--begin::Section-->
                <div class="m-section m-form--fit m-form--label-align-right">

                    <div class="m-section__content">
                        <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
                            <div class="m-demo__preview">
                                <!--begin::Form-->
                                <form class="m-form" method="post" action="{{ route('dashboard.permissions.update', ['id' => $role->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group m-form__group">
                                                <label for="exampleInputEmail1">اسم الدور</label>
                                                <input name="name" type="text" value="{{ $role->name }}" class="form-control m-input" id="exampleInputEmail1" placeholder="As admin">
                                            </div>
                                        </div>
                                    </div>   
                                    <br>
                                    <div class="m-portlet__foot m-portlet__foot--fit">
                                        <label for="exampleInputEmail1">الصلاحيات</label>
                                    </div>    
                                    <div class="m-form__group form-group">
                                        <label for="">صلاحيات خاصة</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('super')) checked @endif value="super"> مستخدم سوبر
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                    <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('setting')) checked @endif value="setting"> الاعدادات
                                                    <span></span>
                                                </label>
                                        </div>
                                    </div>
                                    <div class="m-form__group form-group">
                                        <label for="">الرسائل</label>
                                        <div class="m-checkbox-inline">
                                             <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('contact_index')) checked @endif value="contact_index"> عرض الجميع
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('contact_show')) checked @endif value="contact_show"> مشاهدة التفاصيل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('contact_update')) checked @endif value="contact_update"> تحديث الحالة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('contact_delete')) checked @endif value="contact_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> 
                                    <div class="m-form__group form-group">
                                        <label for="">الطلبات</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('order_index')) checked @endif value="order_index"> عرض الجميع
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('order_show')) checked @endif value="order_show"> مشاهدة التفاصيل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('order_update')) checked @endif value="order_update"> تحديث الحالة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('order_delete')) checked @endif value="order_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> 
                                    <div class="m-form__group form-group">
                                        <label for="">طلبات العروض الخاصة</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('sorder_index')) checked @endif value="sorder_index"> عرض الجميع
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('sorder_show')) checked @endif value="sorder_show"> مشاهدة التفاصيل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('sorder_update')) checked @endif value="sorder_update"> تحديث الحالة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('sorder_delete')) checked @endif value="sorder_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> 
                                    <div class="m-form__group form-group">
                                        <label for="">الحالات</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('status_create')) checked @endif value="status_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('status_edite')) checked @endif value="status_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('status_index')) checked @endif value="status_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('status_delete')) checked @endif value="status_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> 
                                    <div class="m-form__group form-group">
                                        <label for="">العروض</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('offers_create')) checked @endif value="offers_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('offers_edite')) checked @endif value="offers_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('offers_index')) checked @endif value="offers_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('offers_delete')) checked @endif value="offers_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> 
                                    <div class="m-form__group form-group">
                                        <label for="">الحقول المخصصة</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('custom_field_create')) checked @endif value="custom_field_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('custom_field_edite')) checked @endif value="custom_field_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('custom_field_index')) checked @endif value="custom_field_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('custom_field_delete')) checked @endif value="custom_field_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> 
                                    <div class="m-form__group form-group">
                                        <label for="">العلامات التجارية</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('brand_create')) checked @endif value="brand_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('brand_edite')) checked @endif value="brand_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('brand_index')) checked @endif value="brand_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('brand_delete')) checked @endif value="brand_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> 
                                    <div class="m-form__group form-group">
                                        <label for="">الموديلات</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('model_create')) checked @endif value="model_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('model_edite')) checked @endif value="model_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('model_index')) checked @endif value="model_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('model_delete')) checked @endif value="model_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>    
                                    <div class="m-form__group form-group">
                                        <label for="">الموديلات الفرعية</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('model_type_create')) checked @endif value="model_type_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('model_type_edite')) checked @endif value="model_type_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('model_type_index')) checked @endif value="model_type_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('model_type_delete')) checked @endif value="model_type_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>  
                                    <div class="m-form__group form-group">
                                        <label for="">الالوان</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('color_create')) checked @endif value="color_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('color_edite')) checked @endif value="color_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('color_index')) checked @endif value="color_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('color_delete')) checked @endif value="color_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>   
                                          
                                    <div class="m-form__group form-group">
                                        <label for="">السيارات</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('cars_create')) checked @endif value="cars_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('cars_edite')) checked @endif value="cars_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('cars_index')) checked @endif value="cars_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('cars_delete')) checked @endif value="cars_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>   
                                    <div class="m-form__group form-group">
                                        <label for="">الفيديوهات</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('videos_create')) checked @endif value="videos_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('videos_edite')) checked @endif value="videos_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('videos_index')) checked @endif value="videos_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('videos_delete')) checked @endif value="videos_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>   
                                    <div class="m-form__group form-group">
                                        <label for="">المدن</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('cities_create')) checked @endif value="cities_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('cities_edite')) checked @endif value="cities_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('cities_index')) checked @endif value="cities_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('cities_delete')) checked @endif value="cities_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="m-form__group form-group">
                                        <label for="">البنوك</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('banks_create')) checked @endif value="banks_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('banks_edite')) checked @endif value="banks_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('banks_index')) checked @endif value="banks_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('banks_delete')) checked @endif value="banks_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="m-form__group form-group">
                                        <label for="">الفروع</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('branches_create')) checked @endif value="branches_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('branches_edite')) checked @endif value="branches_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('branches_index')) checked @endif value="branches_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('branches_delete')) checked @endif value="branches_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>  
                                    
                                    <div class="m-form__group form-group">
                                        <label for="">المدونة</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('blog_create')) checked @endif value="blog_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('blog_edite')) checked @endif value="blog_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('blog_index')) checked @endif value="blog_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('blog_delete')) checked @endif value="blog_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> 
                                    
                                    <div class="m-form__group form-group">
                                        <label for="">الوظائف</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('job_create')) checked @endif value="job_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('job_edite')) checked @endif value="job_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('job_index')) checked @endif value="job_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('job_delete')) checked @endif value="job_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="m-form__group form-group">
                                        <label for="">الروابط</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('links_create')) checked @endif value="links_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('links_edite')) checked @endif value="links_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('links_index')) checked @endif value="links_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('links_delete')) checked @endif value="links_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="m-form__group form-group">
                                        <label for="">الاسئلة الشائعة</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('questions_create')) checked @endif value="questions_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('questions_edite')) checked @endif value="questions_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('questions_index')) checked @endif value="questions_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" @if ($role->hasPermissionTo('questions_delete')) checked @endif value="questions_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>                                             
                                    <div class="m-portlet__foot m-portlet__foot--fit">
                                        <div class="m-form__actions">
                                            <button type="submit" class="btn btn-primary">تحديث</button>
                                        </div>
                                    </div>
                                </form>
                                <!--end::Form-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Section-->
            </div>
        </div>

        <!--end::Portlet-->
    </div>
    
</div>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush