@extends('layouts.dashboard')
@push('page_styles')
@endpush

@section('content')
<!--begin::Portlet-->
<div class="m-portlet m-portlet--mobile" >
    <div class="m-portlet__head">
        <div class="m-portlet__head-progress">

            <!-- here can place a progress bar-->
        </div>
        <div class="m-portlet__head-wrapper">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="fa fa-shopping-cart"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        تعديل الطلب
                    </h3>
                    <a href="{{ route('dashboard.order.show', ['id' => $order->id]) }}" class="btn m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fa fa fa-eye"></i>
                            <span>عرض الطلب الحالي</span>
                        </span>
                    </a>
                </div>
                
            </div>
            <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('dashboard.order.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fa fa-stream"></i>
                            <span>عرض جميع الطلبات</span>
                        </span>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item"></li>

                    </ul>
                </div>
        </div>
    </div>
    
    <form method="POST" action="{{ route('dashboard.order.updateData') }}" class="m-form m-form--label-align-left- m-form--state-" id="m_form">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $order->id }}">
        <!--begin: Form Body -->
        <div class="m-portlet__body">
            <div class="row">
                <div class="col-xl-8 offset-xl-2">
                    <div class="m-form__section m-form__section--first">

                        @if ($order->type == 1 && $order->payment_method == 1 )
                            <input type="hidden" name="type" value="1">
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">الاسم:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="name"  class="form-control m-input"  value="{{ $order->one->name }}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">هاتف:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="phone" class="form-control m-input" value="{{$order->one->phone}}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">السعر:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="price" class="form-control m-input" value="{{$order->one->price}}">
                                </div>
                            </div>
                             <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">السيارات المطلوبة :</label>
                                <div class="col-xl-9 col-lg-9">
                                    <textarea name="car" class="form-control m-input" value="" cols="30" rows="4">{{$order->one->car}}</textarea>
                                </div>
                            </div>

                        @elseif($order->type == 1 && $order->payment_method == 2)
                        <input type="hidden" name="type" value="2">
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">الاسم:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="name"  class="form-control m-input"  value="{{ $order->tow->name }}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">هاتف:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="phone" class="form-control m-input" value="{{$order->tow->phone}}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">السعر:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="price" class="form-control m-input" value="{{$order->tow->price}}">
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">المدينة:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="city"  class="form-control m-input"  value="{{ $order->tow->city }}">
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">جهة العمل:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="work"  class="form-control m-input"  value="{{ $order->tow->work }}">
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">الحساب البنكي:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="bank_account"  class="form-control m-input"  value="{{ $order->tow->bank_account }}">
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">حالة رخصة القيادة:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input"  value="@if ($order->tow->driving_license_status ==1 ) {{'سارية'}} @elseif ($order->tow->driving_license_status ==2 ) {{'منتهية'}} @else {{'غير متاحة'}} @endif">
                                    <input type="hidden" name="driving_license_status"   value="{{$order->tow->driving_license_status}}">
                                    
                                </div>
                            </div>
                                
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">قروض عقارية:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="mortgage_loan"  class="form-control m-input"  value="@if ($order->tow->mortgage_loan == 1 ) {{'نعم'}} @else {{'لا'}} @endif">
                                    <input type="hidden" name="mortgage_loan"   value="{{$order->tow->mortgage_loan}}">
                                </div>
                            </div>
                            
                            
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">الراتب:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="salary"  class="form-control m-input"  value="{{ $order->tow->salary }}">
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">الالتزامات:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="commitments"  class="form-control m-input"  value="{{ $order->tow->commitments }}">
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">الدفعة الاخيرة:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="last_installment"  class="form-control m-input"  value="{{ $order->tow->last_installment }}">
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">الدفعة الاولى:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="first_installment" class="form-control m-input"  value="{{ $order->tow->first_installment }}">
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">السيارة المطلوبة :</label>
                                <div class="col-xl-9 col-lg-9">
                                    <textarea class="form-control m-input" name="car"  cols="30" rows="4">{{$order->tow->car}}</textarea>
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">صورة الهوية  </label>
                                <div class="col-xl-9 col-lg-9">
                                   <img src="{{ url('storage/orders') . '/' . $order->tow->id_image }}" width="200">
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">رخصة القيادة </label>
                                <div class="col-xl-9 col-lg-9">
                                    <img src="{{ url('storage/orders') . '/' . $order->tow->driving_license_image }}" width="200"  >
                                </div>
                            </div>
                            
                            


                        @elseif($order->type == 2 && $order->payment_method == 1)
                        <input type="hidden" name="type" value="3">
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">اسم الشركة:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="company_name" class="form-control m-input"  value="{{ $order->three->company_name }}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">هاتف:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="phone" class="form-control m-input" value="{{$order->three->phone}}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">البريد الالكتروني:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="email" class="form-control m-input" value="{{$order->three->email}}">
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">اسم الشخص المسؤول:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="responsible_person" class="form-control m-input" value="{{$order->three->responsible_person}}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">السيارات المطلوبة :</label>
                                <div class="col-xl-9 col-lg-9">
                                    <textarea class="form-control m-input" name="cars" value="" cols="30" rows="4" disabled> @foreach ($order->cars as $car) {!! $car->name . ' السعر: ' . $car->quantity . " \n" !!} @endforeach </textarea>
                                </div>
                            </div>

                        @else
                        <input type="hidden" name="type" value="4">
                            <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">اسم الشركة:</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="company_name" class="form-control m-input"  value="{{ $order->four->company_name }}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">هاتف:</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="phone" class="form-control m-input" value="{{$order->four->phone}}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">البريد الالكتروني:</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="email" class="form-control m-input" value="{{$order->four->email}}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">اسم الشخص المسؤول:</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="responsible_person" class="form-control m-input" value="{{$order->four->responsible_person}}">
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">مقر الشركة بأي مدينة:</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="headquarters" class="form-control m-input" value="{{$order->four->headquarters}}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">نشاط الشركة (حسب السجل):</label>
                                    <div class="col-xl-9 col-lg-9"company_activity>
                                        <input type="text"  name="" class="form-control m-input" value="{{$order->four->company_activity}}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">عمر الشركة:</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text"  name="company_age" class="form-control m-input" value="{{$order->four->company_age}}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">الحسابات البنكية في اي بنك:</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <input type="text" name="bank_account" class="form-control m-input" value="{{$order->four->bank_account}}">
                                    </div>
                                </div>


                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">السيارات المطلوبة :</label>
                                    <div class="col-xl-9 col-lg-9">
                                        <textarea name="cars" class="form-control m-input" value="" cols="30" rows="4" disabled> @foreach ($order->cars as $car) {!! $car->name . ' السعر: ' . $car->quantity . " \n" !!} @endforeach </textarea>
                                    </div>
                                </div>

                                <div class="m-card-user m-card-user--sm">
                                    <div class="m-card-user__pic">
                                        <img src="{{ url('storage/orders') . '/' . $order->id_image }}" class="m--img-rounded m--marginless" alt="id">
                                    </div>
                                </div>

                                <div class="m-card-user m-card-user--sm">
                                    <div class="m-card-user__pic">
                                        <img src="{{ url('storage/orders') . '/' . $order->driving_license_image }}" class="m--img-rounded m--marginless" alt="license">
                                    </div>
                                </div>

                        @endif
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
</div>
<div></div>

    <!--end::Portlet-->
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush