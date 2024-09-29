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
                                <form class="m-form" method="post" action="{{ route('dashboard.permissions.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group m-form__group">
                                                <label for="exampleInputEmail1">اسم الدور</label>
                                                <input name="name" type="text" class="form-control m-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="As admin">
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
                                                <input name="permissions[]" type="checkbox" value="super"> مستخدم سوبر
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                    <input name="permissions[]" type="checkbox" value="setting"> الاعدادات
                                                    <span></span>
                                                </label>
                                        </div>
                                    </div>
                                    <div class="m-form__group form-group">
                                        <label for="">الرسائل</label>
                                        <div class="m-checkbox-inline">
                                             <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="contact_index"> عرض الجميع
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="contact_show"> مشاهدة التفاصيل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="contact_update"> تحديث الحالة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="contact_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> 
                                    <div class="m-form__group form-group">
                                        <label for="">الطلبات</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="order_index"> عرض الجميع
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="order_show"> مشاهدة التفاصيل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="order_update"> تحديث الحالة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="order_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> 
                                    <div class="m-form__group form-group">
                                        <label for="">طلبات العروض الخاصة</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="sorder_index"> عرض الجميع
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="sorder_show"> مشاهدة التفاصيل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="sorder_update"> تحديث الحالة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="sorder_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> 
                                    <div class="m-form__group form-group">
                                        <label for="">الحالات</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="status_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="status_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="status_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="status_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> 
                                    <div class="m-form__group form-group">
                                        <label for="">العروض</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="offers_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="offers_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="offers_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="offers_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> 
                                    <div class="m-form__group form-group">
                                        <label for="">الحقول المخصصة</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="custom_field_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="custom_field_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="custom_field_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="custom_field_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> 
                                    <div class="m-form__group form-group">
                                        <label for="">العلامات التجارية</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="brand_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="brand_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="brand_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="brand_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> 
                                    <div class="m-form__group form-group">
                                        <label for="">الموديلات</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="model_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="model_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="model_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="model_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>    
                                    <div class="m-form__group form-group">
                                        <label for="">الموديلات الفرعية</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="model_type_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="model_type_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="model_type_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="model_type_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>  
                                    <div class="m-form__group form-group">
                                        <label for="">الالوان</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="color_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="color_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="color_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="color_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>   
                                          
                                    <div class="m-form__group form-group">
                                        <label for="">السيارات</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="cars_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="cars_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="cars_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="cars_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>   
                                    <div class="m-form__group form-group">
                                        <label for="">الفيديوهات</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="videos_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="videos_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="videos_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="videos_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>   
                                    <div class="m-form__group form-group">
                                        <label for="">المدن</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="cities_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="cities_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="cities_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="cities_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="m-form__group form-group">
                                        <label for="">البنوك</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="banks_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="banks_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="banks_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="banks_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="m-form__group form-group">
                                        <label for="">الفروع</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="branches_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="branches_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="branches_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="branches_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>  
                                    
                                    <div class="m-form__group form-group">
                                        <label for="">المدونة</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="blog_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="blog_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="blog_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="blog_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> 
                                    
                                    <div class="m-form__group form-group">
                                        <label for="">الوظائف</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="job_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="job_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="job_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="job_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="m-form__group form-group">
                                        <label for="">الروابط</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="links_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="links_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="links_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="links_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="m-form__group form-group">
                                        <label for="">الاسئلة الشائعة</label>
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="questions_create"> اضافة
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="questions_edite"> تعديل
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="questions_index"> عرض
                                                <span></span>
                                            </label>
                                            <label class="m-checkbox">
                                                <input name="permissions[]" type="checkbox" value="questions_delete"> حذف
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="m-portlet__foot m-portlet__foot--fit">
                                        <div class="m-form__actions">
                                            <button type="submit" class="btn btn-primary">اضافة</button>
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