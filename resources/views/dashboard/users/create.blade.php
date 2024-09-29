@extends('layouts.dashboard')
@push('page_styles')

@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--tab">

            <!--begin::Form-->
            <form method="POST" action="{{ route('dashboard.moderators.store') }}" class="m-form m-form--fit m-form--label-align-right">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group m--margin-top-10">
                                {{-- <div class="alert m-alert m-alert--default" role="alert">
                                    The example form below demonstrates common HTML form elements air(box shadowed) style.
                                </div> --}}
                            </div>
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">الاسم</label>
                                <input name="name" type="text" class="form-control m-input m-input--solid" id="exampleInputName" placeholder="Enter Name">
                                {{-- <span class="m-form__help">We'll never share your email with anyone else.</span> --}}
                            </div>
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">البريد الالكتروني</label>
                                <input name="email" type="email" class="form-control m-input m-input--solid" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                {{-- <span class="m-form__help">We'll never share your email with anyone else.</span> --}}
                            </div>
                            <div class="form-group m-form__group">
                                <label for="exampleInputPassword1">كلمة السر</label>
                                <input name="password" type="password" class="form-control m-input m-input--solid" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="exampleInputPassword1">تأكيد كلمة السر</label>
                                <input name="password_confirmation" type="password" class="form-control m-input m-input--solid" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="exampleSelect1">الدور</label>
                                <select name="role" class="form-control m-input m-input--solid" id="exampleSelect1">
                                    <option value="">Select role...</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                    </div>
                </div><div class="col-md-12">

                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <button type="submit" class="btn btn-accent">اضافة</button>
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
