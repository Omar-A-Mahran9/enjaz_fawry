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
                            بيانات الصفحة الرئيسية
                        </h3>
                    </div>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('dashboard.home.update') }}" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator">
                @csrf
                @method('PUT')
                <div class="m-portlet__body">

                   

                    <div class="form-group m-form__group row">
                      <h3>قسم كيفية عمل الموقع </h3>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">ايقون 1  </label>
                        <div class="col-lg-6">
                            <input type="text" name="sitWork_icon1" class="form-control m-input m-input--solid" value="{{ $home->sitWork_icon1 }}">
                        </div>
                    </div>
            
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">وصف 1 </label>
                        <div class="col-lg-6">
                            <input type="text" name="sitWork_text1" class="form-control m-input m-input--solid" value="{{ $home->sitWork_text1 }}">
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">ايقون 2  </label>
                        <div class="col-lg-6">
                            <input type="text" name="sitWork_icon2" class="form-control m-input m-input--solid" value="{{ $home->sitWork_icon2 }}">
                        </div>
                    </div>
            
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">وصف 2 </label>
                        <div class="col-lg-6">
                            <input type="text" name="sitWork_text2" class="form-control m-input m-input--solid" value="{{ $home->sitWork_text2 }}">
                        </div>
                    </div>


                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">ايقون 3  </label>
                        <div class="col-lg-6">
                            <input type="text" name="sitWork_icon3" class="form-control m-input m-input--solid" value="{{ $home->sitWork_icon3}}">
                        </div>
                    </div>
            
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">وصف 3 </label>
                        <div class="col-lg-6">
                            <input type="text" name="sitWork_text3" class="form-control m-input m-input--solid" value="{{ $home->sitWork_text3 }}">
                        </div>
                    </div>


                    <hr>

                    <div class="form-group m-form__group row">
                        <h3>العدادات </h3>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">عنوان عداد 1 </label>
                        <div class="col-lg-6">
                            <input type="text" name="counter1_title" class="form-control m-input m-input--solid" value="{{ $home->counter1_title }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">ايقون عداد 1  </label>
                        <div class="col-lg-6">
                            <input type="text" name="counter1_icon" class="form-control m-input m-input--solid" value="{{ $home->counter1_icon }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">رقم عداد 1 </label>
                        <div class="col-lg-6">
                            <input type="text" name="counter1_no" class="form-control m-input m-input--solid" value="{{ $home->counter1_no }}">
                        </div>
                    </div>


                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">عنوان عداد 2 </label>
                        <div class="col-lg-6">
                            <input type="text" name="counter2_title" class="form-control m-input m-input--solid" value="{{ $home->counter2_title }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">ايقون عداد 2  </label>
                        <div class="col-lg-6">
                            <input type="text" name="counter2_icon" class="form-control m-input m-input--solid" value="{{ $home->counter2_icon }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">رقم عداد 2 </label>
                        <div class="col-lg-6">
                            <input type="text" name="counter2_no" class="form-control m-input m-input--solid" value="{{ $home->counter2_no }}">
                        </div>
                    </div>


                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">عنوان عداد 3 </label>
                        <div class="col-lg-6">
                            <input type="text" name="counter3_title" class="form-control m-input m-input--solid" value="{{ $home->counter3_title }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">ايقون عداد 3  </label>
                        <div class="col-lg-6">
                            <input type="text" name="counter3_icon" class="form-control m-input m-input--solid" value="{{ $home->counter3_icon }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">رقم عداد 3 </label>
                        <div class="col-lg-6">
                            <input type="text" name="counter3_no" class="form-control m-input m-input--solid" value="{{ $home->counter3_no }}">
                        </div>
                    </div>


                    
                    
                    

                  

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