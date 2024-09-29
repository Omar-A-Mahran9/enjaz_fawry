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
                            اعدادات الموقع
                        </h3>
                    </div>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('dashboard.setting.update') }}" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator">
                @csrf
                @method('PUT')
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">اسم الموقع </label>
                        <div class="col-lg-6">
                            <input type="text" name="name" class="form-control m-input m-input--solid" value="{{ $setting->name }}">
                        </div>
                    </div>
                    {{-- <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">اسم الموقع انجليزي</label>
                        <div class="col-lg-6">
                            <input type="text" name="name_en" class="form-control m-input m-input--solid" value="{{ $setting->name_en }}">
                        </div>
                    </div> --}}

                   
                    {{-- <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">وصف الموقع انجليزي</label>
                        <div class="col-lg-6">
                            <input type="text" name="description_en" class="form-control m-input m-input--solid" value="{{ $setting->description_en }}">
                        </div>
                    </div> --}}
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">رابط الفيسبوك</label>
                        <div class="col-lg-6">
                            <input type="text" name="facebook" class="form-control m-input m-input--solid" value="{{ $setting->facebook }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">رابط تويتر</label>
                        <div class="col-lg-6">
                            <input type="text" name="twitter" class="form-control m-input m-input--solid" value="{{ $setting->twitter }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">رابط الانستجرام</label>
                        <div class="col-lg-6">
                            <input type="text" name="instagram" class="form-control m-input m-input--solid" value="{{ $setting->instagram }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">رابط اليوتيوب</label>
                        <div class="col-lg-6">
                            <input type="text" name="youtube" class="form-control m-input m-input--solid" value="{{ $setting->youtube }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">لينكد ان</label>
                        <div class="col-lg-6">
                            <input type="text" name="linkedin" class="form-control m-input m-input--solid" value="{{ $setting->linkedin }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">سناب شات</label>
                        <div class="col-lg-6">
                            <input type="text" name="snapchat" class="form-control m-input m-input--solid" value="{{ $setting->snapchat }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">البريد الالكتروني</label>
                        <div class="col-lg-6">
                            <input type="email" name="email" class="form-control m-input m-input--solid" value="{{ $setting->email }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">رقم الجوال</label>
                        <div class="col-lg-6">
                            <input type="text" name="phone" class="form-control m-input m-input--solid" value="{{ $setting->phone }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">رقم الواتساب</label>
                        <div class="col-lg-6">
                            <input type="text" name="general_whats" class="form-control m-input m-input--solid" value="{{ $setting->general_whats }}">
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الشعار النصي (سلوجان)</label>
                        <div class="col-lg-6">
                            <input type="text" name="slogan" class="form-control m-input m-input--solid" value="{{ $setting->slogan }}">
                        </div>
                    </div>

                     <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">العنوان</label>
                        <div class="col-lg-6">
                            <input type="text" name="address" class="form-control m-input m-input--solid" value="{{ $setting->address }}">
                        </div>
                    </div>

                    <hr>
                    <div class="form-group m-form__group row">
                        <h3>SEO:</h3>
                    </div>
                    
                     <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">وصف الموقع </label>
                        <div class="col-lg-6">
                            {{-- <input type="text" name="description" class="form-control m-input m-input--solid" value="{{ $setting->description }}"> --}}
                            <textarea type="text" name="description" class="form-control m-input m-input--solid">{{ $setting->description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الكلمات المفتاحية </label>
                        <div class="col-lg-6">
                            <input type="text" name="keywords" class="form-control m-input m-input--solid" value="{{ $setting->keywords }}">
                        </div>
                    </div>
                    {{-- <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الكلمات المفتاحية انجليزي</label>
                        <div class="col-lg-6">
                            <input type="text" name="keywords_en" class="form-control m-input m-input--solid" value="{{ $setting->keywords_en }}">
                        </div>
                    </div> --}}
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">عدد الصفوف المعروضة</label>
                        <div class="col-lg-6">
                            <input type="number" name="paginate" class="form-control m-input m-input--solid" value="{{ $setting->paginate }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الشعار</label>
                        <div class="col-lg-6">
                            <input type="file" name="logo" class="form-control m-input m-input--solid">
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الشعار المصغر</label>
                        <div class="col-lg-6">
                            <input type="file" name="small_logo" class="form-control m-input m-input--solid">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group m-form__group row">
                        <h3>تفعيل وايقاف طرق الدفع</h3>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">طريقة الدفع عن طريق التحويل البنكي</label>
                        <div class="col-lg-6">
                              <select required="" class="form-control transform" id="bankPayment" name="bankPayment">
                                <option value="1" @if($setting->bankPayment == 1) selected="selected" @endif>مفعل</option> 
                                <option value="0" @if($setting->bankPayment == 0) selected="selected" @endif>غير مفعل</option> 
                            </select>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">طريقة الدفع عن طريق الدفع اونلاين</label>
                        <div class="col-lg-6">
                              <select required="" class="form-control transform" id="onlinePayment" name="onlinePayment">
                                <option value="1" @if($setting->onlinePayment == 1) selected="selected" @endif>مفعل</option> 
                                <option value="0" @if($setting->onlinePayment == 0) selected="selected" @endif>غير مفعل</option> 
                            </select>
                        </div>
                    </div>



                    <hr>
                    <div class="form-group m-form__group row">
                        <h3>الاسعار:</h3>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">نسبة التعميد:</label>
                        <div class="col-lg-6">
                            <input type="number" name="ta3med_price"  class="form-control m-input m-input--solid" value="{{ $setting->ta3med_price }}" >
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">نسبة ضمان مبلغ سلعة:</label>
                        <div class="col-lg-6">
                            <input type="number" name="guarante_percentage"  class="form-control m-input m-input--solid" value="{{ $setting->guarante_percentage }}" >
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">تكلفة الاستفسار:</label>
                        <div class="col-lg-6">
                            <input type="number" name="estfsar_price" class="form-control m-input m-input--solid" value="{{ $setting->estfsar_price }}" >
                        </div>
                    </div>

                 
                   
                  <hr>


                <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label">تفعيل التحذير</label>
                    <div class="col-lg-6">
                          <select required="" class="form-control transform" id="warning_on" name="warning_on">
                            <option value="1" @if($setting->warning_on == 1) selected="selected" @endif>مفعل</option> 
                            <option value="0" @if($setting->warning_on == 0) selected="selected" @endif>غير مفعل</option> 
                        </select>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label">عنوان التحذير </label>
                    <div class="col-lg-6">
                        <input type="text" name="warning_title" class="form-control m-input m-input--solid" value="{{ $setting->warning_title }}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label"> محتوى التحذير الموقع </label>
                    <div class="col-lg-6">
                        {{-- <input type="text" name="description" class="form-control m-input m-input--solid" value="{{ $setting->description }}"> --}}
                        <textarea type="text" name="warning_text" class="form-control m-input m-input--solid summernote">{{ $setting->warning_text }}</textarea>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label"> محتوى التحذير التطبيق </label>
                    <div class="col-lg-6">
                        {{-- <input type="text" name="description" class="form-control m-input m-input--solid" value="{{ $setting->description }}"> --}}
                        <textarea type="text" name="warning_text_app" class="form-control m-input m-input--solid">{{ $setting->warning_text_app }}</textarea>
                    </div>
                </div>
                

                    {{-- <div class="m-form__group m-form__group--last form-group row">
                        <label class="col-lg-2 col-form-label">تعطيل الموقع</label>
                        <div class="col-lg-6">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input type="radio"  name="site_down" @if ($setting->site_down == '1' ) {{ 'checked' }} @endif value="1"> نعم
                                    <span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="radio" name="site_down" @if ($setting->site_down == '0' ) {{ 'checked' }} @endif value="0"> لا 
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div> --}}

                    
                  

                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-success pull-left">تحديث</button>
                                {{-- <button type="reset" class="btn btn-secondary">الغاء</button> --}}
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