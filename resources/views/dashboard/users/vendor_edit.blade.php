

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
                                تعديل بيانات 
                            @if($user->type == 'vendor')

                                المعقب : {{ $user->id }}
                            @elseif($user->type == 'vendorC')
                                مكتب الخدمات : {{ $user->id }}
                            @endif
                        </h3>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                <form method="POST" action="{{ route('dashboard.vendor.vendor_update', ['id' =>$user->id]) }}" class="m-form m-form--fit m-form--label-align-right">
                    @csrf
                    @method('PUT')
                    <div class="m-portlet__body">
                        
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

                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">الجوال</label>
                            <div class="col-lg-6">
                                <input type="tel" name="phone" class="form-control m-input m-input--solid" value="{{ $user->phone }}"> 
                                @if($user->phone_status == 1)
                                 <span style="color:green">   مفعل </span>
                                @else
                                   <span style="color:red">  غير مفعل : كود التفعيل / {{ $user->verification_code }}</span>
                                @endif

                            </div>
                        </div>

                        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">تعديل نوع الحساب</label>
                            <div class="col-lg-6">
                                <select name="type" class="form-control m-input m-input--solid">
                                    <option value="vendor" @if($user->type == "vendor" ) selected="selected" @endif >معقب</option>
                                    <option value="vendorC" @if($user->type == "vendorC" ) selected="selected" @endif >مكتب خدمات</option>
                                </select>
                            </div>
                        </div>
                        

                        @if($user->phone_status == 0)
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">حالة الجوال</label>
                                <div class="col-lg-6">
                                    <select name="phone_status" class="form-control m-input m-input--solid">
                                        <option value="0" @if($user->phone_status == 0 ) selected="selected" @endif >غير مفعل</option>
                                        <option value="1" @if($user->phone_status == 1 ) selected="selected" @endif >مفعل</option>
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">رقم الهوية</label>
                            <div class="col-lg-6">
                                <input type="text" name="identity_no" class="form-control m-input m-input--solid" value="{{ $user->identity_no }}"> 
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">اثبات الهوية</label>

                            
                            @if($user->identity_file != Null )
                            @php 

                                $ext = pathinfo($user->identity_file, PATHINFO_EXTENSION);

                            @endphp

                                @if($ext == 'pdf')

                                <a href="{{ asset('storage/ids') .'/'. $user->identity_file}}" target="_blank">
                                    معاينة الملف
                                </a>

                                @else
                                <div class="col-lg-6" data-target="#lightBox" data-toggle="modal">
                                <img width="50" src="{{ asset('storage/ids') .'/'. $user->identity_file}}">
                                </div>
                                @endif

                            @else
                                لم يتم رفع اثبات الهوية
                            @endif
                        </div>

                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">حالة اثبات الهوية</label>
                            <div class="col-lg-6">

                                <select id="identity_status" name="identity_status" class="form-control m-input m-input--solid">
                                    @if($user->identity_status == 0 ) selected="selected" @endif 
                                    <option value="0" @if($user->identity_status == 0 ) selected="selected" @endif >جديد</option>
                                    <option value="1" @if($user->identity_status == 1 ) selected="selected" @endif >مقبول</option>
                                    <option value="-1" @if($user->identity_status == -1 ) selected="selected" @endif >مرفوض</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group m-form__group row " style="@if($user->identity_status != -1 ) display:none @endif " id="reject_file_reson" >
                            <label class="col-lg-2 col-form-label">سبب الرفض</label>
                            <div class="col-lg-6">
                                <textarea name="reject_file_reson" class="form-control m-input m-input--solid" >{{ $user->identity_file_reject_reason }}</textarea>
                                <span>في حال ترك هذا الحقل فارغا ستظهر الرسالة التالية : <span style="color:red">مرفوض ... يرجى اعادة رفع الاوراق الثبوتية</span></span>
                            </div>
                        </div>


                        <hr>

                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">حالة الحساب</label>
                            <div class="col-lg-6">

                                <select name="status" id="status" class="form-control m-input m-input--solid">
                                    @if($user->status == 0 ) selected="selected" @endif 
                                    <option value="0" @if($user->status == 0 ) selected="selected" @endif >جديد</option>
                                    <option value="1" @if($user->status == 1 ) selected="selected" @endif >نشط</option>
                                    <option value="-1" @if($user->status == -1 ) selected="selected" @endif >موقوف</option>
                                    <option value="-2" @if($user->status == -2 ) selected="selected" @endif >القائمة السوداء</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group m-form__group row " style="display:none" id="blacklist_reson" >
                            <label class="col-lg-2 col-form-label">سبب الاضافة في القائمة السوداء</label>
                            <div class="col-lg-6">
                                <textarea name="blacklist_reson" class="form-control m-input m-input--solid" >{{ $user->blacklist_reson }}</textarea>
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
<div class="modal fade" id="lightBox" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      {{-- <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> --}}
      <div class="modal-body">
        <!-- Carousel markup goes in the modal body -->
        
            <img class="d-block w-100" src="{{ url('storage/ids') . '/' . $user->identity_file }}">
      </div>
    </div>
  </div>
</div>

        </div>
    </div>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')
    <script src="{{ asset('metronic/default') }}/assets/demo/custom/crud/forms/widgets/bootstrap-select.js" type="text/javascript"></script>

    <script>
        $(document).ready(function(){

            


        $('#identity_status').on('change', function(){

            if($(this).val() == -1) {
                $("#reject_file_reson").show();
            }else{
                $("#reject_file_reson").hide();
            }
            
        });
       
        $('#status').on('change', function(){

            if($(this).val() == -2) {
                $("#blacklist_reson").show();
            }else{
                $("#blacklist_reson").hide();
            }
            
        });


    });

    </script>

@endpush






