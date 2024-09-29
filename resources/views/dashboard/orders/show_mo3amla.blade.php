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
                        معاملة رقم : {{  $order->order_no }}
                    </h3>
                    {{-- <a href="{{ route('dashboard.order.edit', ['id' => $order->id]) }}" class="btn m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fa fa-edit"></i>
                            <span>تعديل الطلب الحالي</span>
                        </span>
                    </a> --}}
                </div>
                
            </div>
            <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        {{-- <li class="m-portlet__nav-item">
                            <a href="{{ route('dashboard.order.mo3amla.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="fa fa-stream"></i>
                                    <span>عرض جميع المعاملات</span>
                                </span>
                            </a>
                        </li> --}}
                        @include('layouts.inc.editStatus',  ['order_type' => "mo3amla"])

                    </ul>
                </div>
        </div>
    </div>
    
    <form method="POST" action="{{ route('dashboard.assign.mo3amla') }}" class="m-form m-form--label-align-left- m-form--state-" id="m2_form" onsubmit="submity.disabled = true; return true;">
        @csrf
        <!--begin: Form Body -->
        <div class="m-portlet__body">
            <div class="row">
                <div class="col-xl-8">
                    <div class="m-form__section m-form__section--first">

                        {{-- @if ($order->type == 1 && $order->payment_method == 1 ) --}}
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">حالة الطلب:</label>
                            <div class="col-xl-9 col-lg-9">
                                <input type="text"  class="form-control m-input"  value="{{  getStatusAdmin($order->status) }}" disabled>
                            </div>
                        </div>

                        @if( ($order->status == "5" || $order->status == "4" ) && $order->enjaz_prove != NULL)
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">اثبات الانجاز:</label>
                                <div class="col-xl-9 col-lg-9">
                                    @php 
                                        $ext = pathinfo($order->enjaz_prove, PATHINFO_EXTENSION);
                                    @endphp


                                    @if($ext == 'pdf')

                                    <a class="pdfFile" href="{{ asset('storage/enjaz_prove') .'/'. $order->enjaz_prove}}" target="_blank">
                                    <i class="fa fa-file"></i>  
                                    </a>
                
                                    @else
                
                                        {{-- <img data-target="#lightBox" data-toggle="modal"  src="{{ url('storage/payment_proves') . '/' . $order->transfer_prove }}" width="200"  > --}}
                                        <img data-url="{{ url('storage/enjaz_prove') . '/' . $order->enjaz_prove }}" class="openImageModal" src="{{ url('storage/enjaz_prove') . '/' . $order->enjaz_prove }}" width="200"  >

                
                                    @endif
                                </div>
                            </div>

                        @endif


                        @if($order->status == "-2")
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">اعادة ارسال عرض السعر:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <a href="#" data-mo3amla="{{$order->id}}" style="padding: 3px 5px !important;" id="openModalEditPrice" class="btn btn-success">اعادة ارسال مع تعديل العرض المقدم</a>
                                </div>
                            </div>
                        @endif

                        @if($order->status == "-4")
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">ارسال الملاحظات للعميل:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <a href="#" id="openResendNotesModal" data-mo3amla="{{ $order->id }}" style="padding: 3px 5px !important;" class="btn btn-success">ارسال الملاحظات للعميل</a>
                                </div>
                            </div>
                        @endif

                        @if($order->status == "-3")
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">سبب الرفض:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text"  class="form-control m-input"  value="{{  $order->statusReason}}" disabled>
                                </div>
                            </div>
                        @elseif($order->status == "3")
                             <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">سبب التعليق:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text"  class="form-control m-input"  value="{{  $order->statusReason}}" disabled>
                                </div>
                            </div>

                        @endif

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">العميل:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text"  class="form-control m-input"  value="{{ $order->orderUser->name }}" disabled>
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">نوع الحساب:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text"  class="form-control m-input"  value="{{  getUserType($order->orderUser->type)}}" disabled>
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">التواصل مع العميل واتساب:</label>
                                <div class="col-xl-9 col-lg-9">
                                     <p style="line-height:40px;margin-bottom:0;">
                                         <a href="https://wa.me/966{{ (int)$order->orderUser->phone}}" target="_blank">التواصل عبر الواتساب</a>
                                     </p>
                                </div>

                            </div>

                            
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">المدينة:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input" value="{{$order->city->name}}" disabled>
                                </div>
                            </div> 
                            
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">جهة المعاملة:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input" value="{{$order->service->name}}" disabled>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">موضوع المعاملة:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input" value="{{$order->mo3amla_subject}}" disabled>
                                </div>
                            </div>

                            {{-- <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">الخدمة المطلوبة:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input" value="{{$order->subService->name}}" disabled>
                                </div>
                            </div> --}}

                            
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">تفاصيل المعاملة :</label>
                                <div class="col-xl-9 col-lg-9">
                                    <textarea class="form-control m-input" value="" disabled cols="30" rows="4" disabled>{{$order->mo3amla_details}}</textarea>
                                </div>
                            </div>


                            @if($order->attachments != Null )
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">المرفقات :</label>
                                    <div class="col-xl-9 col-lg-9">
                                    @php 
                                        $images = unserialize($order->attachments);
                                    @endphp

                                    @foreach($images as $img)

                                        @php 
                                            $ext = pathinfo($img, PATHINFO_EXTENSION);
                                        @endphp
                
                
                                        @if($ext == 'pdf' || $ext == 'PDF')
                        
                                        <a  class="pdfFile" href="{{ asset('storage/order_mo3amla') .'/'. $img}}" target="_blank">
                                            <i class="fa fa-file-pdf"></i>  
                                        </a>
                        
                                        @else
                                        {{-- data-target="#lightBox" data-toggle="modal" --}}
                                            <img data-url="{{ asset('storage/order_mo3amla') }}/{{$img}}" class="openImageModal" style="display: inline-block;
                                            float: right;
                                            border: 1px solid #853BCC;
                                            width: 50px;
                                            height: 50px;
                                            float: right;
                                            cursor:pointer;
                                            margin-left: 5px;" 
                                            src="{{ asset('storage/order_mo3amla') }}/{{$img}}" style="margin-left:7px;" width="50" height="50">
                                        
                                        @endif


                                    @endforeach
                                        
                                    </div>
                                </div>

                            @endif

                            @if(!empty($order->m_processType) || $order->m_processType !== NULL)

                            {{-- <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">اتعاب انجاز المعاملة:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input" value="{{$order->m_enjazPrice}}" disabled>
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">تكلفة الطرف الثالث:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input" value="{{$order->m_processThirdPartyPrice}}" disabled>
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">الرسوم الحكومية:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input" value="{{$order->m_processGovPrice}}" disabled>
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">سعر التنفيذ المرسل للعميل:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input" value="{{$order->price}}" disabled>
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">مدة التنفيذ:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input" value="{{$order->m_processDays}}" disabled>
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">متطلبات التنفيذ:</label>
                                <div class="col-xl-9 col-lg-9">
                                   {!! $order->m_processRequirment !!}
                                </div>
                            </div> --}}

                            {{-- <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">وضع الطلب :</label>
                                <div class="col-xl-9 col-lg-9">

                                    @if($order->status == "-2")
                                        مرفوض من قبل العميل 
                                        <a href="#" data-mo3amla="{{$order->id}}" style="padding: 3px 5px !important;" id="openModalEditPrice" class="btn btn-success">اعادة ارسال مع تعديل العرض المقدم</a>

                                    @elseif($order->status == "1")
                                        موافق عليه من قبل العميل    
                                    @elseif($order->status == "-1")
                                        جديد ولم تتم مشاهدته من قبل العميل    
                                    @elseif($order->status == "0")
                                        جديد وتمت مشاهدته من قبل العميل

                                    @endif
                                </div>
                            </div> --}}

                           
                            
                                
                            

                              
            


                        
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">طريقة الدفع:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" class="form-control m-input" value="@if ($order->payment_method == 'transfer')تحويل بنكي@elseif($order->payment_method == 'online_payment')دفع اونلاين@endif" disabled>
                                </div>
                            </div>
                    

                            @if($order->transfer_prove != "0")
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">اثبات الدفع </label>
                                    <div class="col-xl-6 col-lg-6">
                                    @if($order->payment_method == 'transfer')
                                        @php 
                                            $ext = pathinfo($order->transfer_prove, PATHINFO_EXTENSION);
                                        @endphp


                                        @if($ext == 'pdf')

                                        <a class="pdfFile" href="{{ asset('storage/payment_proves') .'/'. $order->transfer_prove}}" target="_blank">
                                        <i class="fa fa-file"></i>  
                                        </a>
                    
                                        @else
                    
                                            {{-- <img data-target="#lightBox" data-toggle="modal"  src="{{ url('storage/payment_proves') . '/' . $order->transfer_prove }}" width="200"  > --}}
                                            <img data-url="{{ url('storage/payment_proves') . '/' . $order->transfer_prove }}" class="openImageModal" src="{{ url('storage/payment_proves') . '/' . $order->transfer_prove }}" width="200"  >

                    
                                        @endif
                                    @elseif($order->payment_method == 'online_payment')

                                        <b>الرقم المرجعي : </b><span>{{ $order->transfer_prove }}</span>
                                    @endif
                                    </div>
                                    
                                </div>
                            @endif 

                            @if($order->payment_method != "online_payment")
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">حالة اثبات الدفع </label>
                                    @if($order->prove_status == 0 && $order->transfer_prove == 0)

                                        <div class="col-xl-4 col-lg-4" >
                                            لم يتم رفع اثبات الدفع 
                                        </div>
                                    @elseif($order->prove_status == -1 && $order->transfer_prove != 0)

                                        <div class="col-xl-4 col-lg-4" >
                                            مرفوض بانتظار اعادة الرفع من العميل
                                        </div>
                                    @elseif($order->prove_status == 0 && $order->transfer_prove != 0)
                                        <div class="col-xl-4 col-lg-4" >
                                            غير مؤكد 
                                        </div>

                                        <div class="col-xl-4 col-lg-4" >
                                            {{-- Approve--}}
                                            <a onclick="event.preventDefault(); if(confirm('هل انت متأكد من تأكيد عملية الدفع؟')) { document.getElementById('approvePayment').submit(); }else{ return false }" href="{{ route('dashboard.order.mo3amla.paymentStatus', ['id' => $order->id ]) }}"  class="btn btn-success">تأكيد الدفع</a>
                                        
                                            {{-- Deny--}}
                                            <a onclick="event.preventDefault(); if(confirm('هل انت متأكد من رفض عملية الدفع؟')) { document.getElementById('denyPayment').submit();}else{ return false }" href="{{ route('dashboard.order.mo3amla.paymentStatus', ['id' => $order->id ]) }}" class="btn btn-outline-danger">رفض الدفع</a>
                                        </div>

                                    @elseif($order->prove_status == 1)
                                        <div class="col-xl-4 col-lg-4" >
                                            مؤكد 
                                        </div>
                                    @endif
                                </div>
                            @endif 

                            @if($order->payment_method == "online_payment")
                                <div class="form-group m-form__group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">حالة الدفع </label>
                                    @if($order->prove_status == 1)
                                        مدفوع
                                    @else
                                        غير مدفوع
                                    @endif 
                                </div>
                            @endif 
                        @endif 



        @if(empty($order->m_processType) || $order->m_processType == NULL)
        <div class="form-group m-form__group row" style="background-color:#F2EFEA">
            <label class="col-xl-3 col-lg-3 col-form-label">معالجة المعاملة</label>
            <div class="col-xl-9 col-lg-9">
                <select name="mo3amla_process_type" id="mo3amla_process_type" class="form-control m-input">
                    <option value="null">اختار طريقة المعالجة المرغوبة</option>
                    <option value="1">الرد على العميل مباشرة</option>
                    <option value="2">ارسال لجميع المعقبين / مكاتب الخدمات المسجلين بالموقع</option>
                    <option value="2A">ارسال لجميع المعقبين المسجلين بالموقع</option>
                    <option value="2C">ارسال لجميع مكاتب الخدمات المسجلين بالموقع</option>
                    <option value="3">ارسال لمعقبين / مكاتب الخدمات محددين</option>
                </select>
            </div>
            <input type="hidden"  class="form-control m-input"  value="{{ $order->id }}" name="order_id">
        </div>

        @else

        {{-- {{ $order->m_processType }}  --}}
        {{-- Start Detect Process Type --}}
        @if( $order->m_processType == "1" )

            <div class="form-group m-form__group row" style="background-color:#F2EFEA">
                <label class="col-xl-3 col-lg-3 col-form-label">طريقة معالجة المعاملة</label>
                <div class="col-xl-9 col-lg-9">
                    <h5>  رد مباشر على العميل</h5>
                </div>
            </div>


            <div class="form-group m-form__group row" style="background-color:#F2EFEA">
                <label class="col-xl-3 col-lg-3 col-form-label">ارسال للتسعير </label>
                <div class="col-xl-9 col-lg-9">
                    <select name="mo3amla_process_type" id="mo3amla_process_type" class="form-control m-input">
                        <option value="null">اختار طريقة المعالجة المرغوبة</option>
                        {{-- <option value="1">الرد على العميل مباشرة</option> --}}
                        <option value="2">ارسال لجميع المعقبين / مكاتب الخدمات المسجلين بالموقع</option>
                        <option value="2A">ارسال لجميع المعقبين المسجلين بالموقع</option>
                        <option value="2C">ارسال لجميع مكاتب الخدمات المسجلين بالموقع</option>
                        <option value="3">ارسال لمعقبين / مكاتب الخدمات محددين</option>
                    </select>
                </div>
                <input type="hidden"  class="form-control m-input"  value="{{ $order->id }}" name="order_id">
            </div>

{{-- 

            <div class="form-group m-form__group row" style="background-color:#F2EFEA">
                <label class="col-xl-3 col-lg-3 col-form-label">متطلبات اتمام المعاملة</label>
                <div class="col-xl-9 col-lg-9">
                    {!! $order->m_processRequirment !!}
                </div>
            </div>

            <div class="form-group m-form__group row" style="background-color:#F2EFEA">
                <label class="col-xl-3 col-lg-3 col-form-label">اتعاب انجاز المعاملة</label>
                <div class="col-xl-9 col-lg-9">
                    {{ $order->m_enjazPrice }} ر.س
                </div>
            </div>

            <div class="form-group m-form__group row" style="background-color:#F2EFEA">
                <label class="col-xl-3 col-lg-3 col-form-label">تكلفة الطرف الثالث</label>
                <div class="col-xl-9 col-lg-9">
                    {{ $order->m_processThirdPartyPrice }} ر.س
                </div>
            </div>

            <div class="form-group m-form__group row" style="background-color:#F2EFEA">
                <label class="col-xl-3 col-lg-3 col-form-label">الرسوم الحكومية</label>
                <div class="col-xl-9 col-lg-9">
                    {{ $order->m_processGovPrice }} ر.س
                </div>
            </div>

            <div class="form-group m-form__group row" style="background-color:#F2EFEA">
                <label class="col-xl-3 col-lg-3 col-form-label">سعر التنفيذ المرسل للعميل</label>
                <div class="col-xl-9 col-lg-9">
                    {{ $order->price }} ر.س
                </div>
            </div>

            <div class="form-group m-form__group row" style="background-color:#F2EFEA">
                <label class="col-xl-3 col-lg-3 col-form-label">مدة التنفيذ</label>
                <div class="col-xl-9 col-lg-9">
                    {{ $order->m_processDays }} ايام
                </div>
            </div> 
            --}}

            


            @elseif( $order->m_processType == "2" || $order->m_processType == "2A"   || $order->m_processType == "2C"  || $order->m_processType == "3")

            {{-- <h4>222222222</h4> --}}
            <div class="form-group m-form__group row" style="background-color:#F2EFEA">
                <label class="col-xl-3 col-lg-3 col-form-label">طريقة معالجة المعاملة</label>
                <div class="col-xl-9 col-lg-9">

                    @if( $order->m_processType == "2")
                        <h5>ارسال لجميع المعقبين + ومكاتب الخدمات المسجلين بالموقع</h5> 

                    @elseif( $order->m_processType == '2A')

                        <h5>ارسال لجميع المعقبين الفرديين المسجلين بالموقع</h5>

                        
                    @elseif( $order->m_processType == '2C')

                    <h5>ارسال لجميع مكاتب الخدمات المسجلين بالموقع</h5>
                        

                    @elseif( $order->m_processType == "3")

                    <h5>ارسال لمجموعة محددة بالموقع</h5> 
                    
                    @endif
                </div>
            </div>

                @if($process->count() > 0 )

                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم / حساب المعقب</th>
                            <th>الجوال</th>
                            <th>الحالة</th>
                            <th>نوع الحساب</th>
                            <th>السعر</th>
                            <th>المتطلبات</th>
                            <th>ايام التنفيذ</th>
                            <th>حالة الحساب</th>
                            <th>تعميد</th>
                        </tr>
                    </thead>
                    <tbody>

 @if($order->m_processVendorSelected === NULL )
                        @foreach ($process as $proc)

                       
                        <tr>
                            <td>{{ $proc->id }}</td>
                            <td>
                                <a target="_blank" href="{{ route('dashboard.users.client_show', ['id' => $proc->userz->id ]) }}">
                                    {{ $proc->user_id }} - 
                                    {{ $proc->userz->name }}
                                </a>
                            </td>
                            <td>{{ $proc->userz->phone }}</td>
                            <td>
                                @if($proc->status == -1)
                                    جديد ولم يتم فتح الطلب
                                @elseif($proc->status == 0)
                                    جديد وتم فتح الطلب  
                                @elseif($proc->status == 1)
                                    تم تقديم سعر ومتطلبات التنفيذ 

                                @elseif($proc->status == 2)
                                    قيد التنفيذ 
                                
                                @elseif($proc->status == 4)
                                    تم الانجاز
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($proc->userz->type == 'vendor')
                                    معقب
                                @elseif($proc->userz->type == 'vendorC')
                                    مكتب خدمات  
                                @else
                                    --
                                @endif
                            </td>
                            <td>
                                @if($proc->price != Null)
                                    {{ $proc->price }}
                                @else
                                    --
                                @endif
                            </td>
                            <td>
                                @if($proc->requirement != Null)
                                    {{ $proc->requirement }}
                                @else
                                    --
                                @endif
                            </td>
                            <td>
                                @if($proc->days != Null)
                                    {{ $proc->days }}
                                @else
                                    --
                                @endif
                            </td>
                            <td>
                                @if($proc->userz->status == 0 ) 
                                    جديد
                                @elseif($proc->userz->status == 1 ) 
                                    <span style="color:green">  نشط</span>
                                @elseif($proc->userz->status == -1 ) 
                                    <span style="color:red">   موقوف</span>
                                @elseif($proc->userz->status == -2 ) 
                                    <span style="color:black">  القائمة السوداء</span>
                                @else
                                    {{ $proc->userz->status }}
                                @endif
                                
                            </td>
                            <td>
                                @if($proc->price != Null && $proc->status == 1 && $proc->mo3amla->m_processVendorSelected == Null)
                                    <a href="#" data-mo3amla="{{$proc->id}}" style="padding: 3px 5px !important;" class="btn btn-success openModal">تعميد</a>
                                @elseif($proc->price != Null && $proc->status == 1 && 
                                $proc->mo3amla->m_processVendorSelected == $proc->user_id)
                                    <span style="color:green">معتمد</span>
                                @else 
                                    N/A
                                @endif
                            </td>
                        </tr>
                        @endforeach
@else {{-- check if we haven't select user --}}  
@php


// dd($order->id);
$procy = \App\Mo3amlaProcessing::where('mo3amla_id','=', $order->id)
                                ->where('user_id', $order->m_processVendorSelected)
                                ->where('choosen', "1")->first();
@endphp
 <tr>
    <td>{{ $procy->id }}</td>
    <td>
        <a target="_blank" href="{{ route('dashboard.users.client_show', ['id' => $procy->userz->id ]) }}">
            {{ $procy->user_id }} - 
            {{ $procy->userz->name }}
        </a>
    </td>
    <td>{{ $procy->userz->phone }}</td>
    <td>
        @if($procy->status == -1)
            جديد ولم يتم فتح الطلب
        @elseif($procy->status == 0)
            جديد وتم فتح الطلب  
        @elseif($procy->status == 1)
            تم تقديم سعر ومتطلبات التنفيذ 
        @elseif($procy->status == 2)
            قيد التنفيذ 
        
        @elseif($procy->status == 4)
            تم الانجاز
        @else
            N/A
        @endif
    </td>
    <td>
        @if($procy->userz->type == 'vendor')
            معقب
        @elseif($procy->userz->type == 'vendorC')
            مكتب خدمات  
        @else
            --
        @endif
    </td>
    <td>
        @if($procy->price != Null)
            {{ $procy->price }}
        @else
            --
        @endif
    </td>
    <td>
        @if($procy->requirement != Null)
            {{ $procy->requirement }}
        @else
            --
        @endif
    </td>
    <td>
        @if($procy->days != Null)
            {{ $procy->days }}
        @else
            --
        @endif
    </td>
    <td>
        @if($procy->userz->status == 0 ) 
            جديد
        @elseif($procy->userz->status == 1 ) 
            <span style="color:green">  نشط</span>
        @elseif($procy->userz->status == -1 ) 
            <span style="color:red">   موقوف</span>
        @elseif($procy->userz->status == -2 ) 
            <span style="color:black">  القائمة السوداء</span>
        @else
            {{ $procy->userz->status }}
        @endif
        
    </td>
    <td>
        @if($procy->price != Null && ( $procy->status == 1 ||  $procy->status == 2 ||  $procy->status == 4) && $procy->mo3amla->m_processVendorSelected == Null)
            <a href="#" data-mo3amla="{{$procy->id}}" style="padding: 3px 5px !important;" class="btn btn-success openModal">تعميد</a>
        @elseif($procy->price != Null && ( $procy->status == 1 ||  $procy->status == 2 ||  $procy->status == 4) && 
        $procy->mo3amla->m_processVendorSelected == $procy->user_id)
            <span style="color:green">معتمد</span>
        @else 
            N/A
        @endif
    </td>
    </tr>




@endif {{-- end if we haven't select user --}}                        
                    </tbody>
                    </table>
                @endif
            @endif
            

        @endif
       
        <div id="ajaxRespons" style="background-color:#F2EFEA; margin-left:-15px;margin-right:-15px;padding:15px 0;">
            
        </div>
                       

                </div>
            </div> {{-- col-8 --}}

            {{-- *
                 ////////********************************************
                 ////////******************************************** ////////********************************************
                 ////////********************************************
                ////////********************************************--}}
            <div class="col-xl-4">

                <div class="make-me-sticky">
              

            @if(!empty($order->m_processType) || $order->m_processType !== NULL)

                <table class="table table-borderd">
                    <thead>
                        <th colspan="2" style="text-align:center">
                            <h5>ملخص المعاملة</h5> 
                        </th>
                    </thead>

                    <tr>
                        <td>طريقة معالجة المعاملة</td>
                        <td>

                            @if( $order->m_processType == "1" || $order->m_processType == "1A")

                                <p>الرد مباشرة على العميل</p> 

                            @elseif( $order->m_processType == "2")

                                <p>ارسال لجميع المعقبين + ومكاتب الخدمات المسجلين بالموقع</p>  

                            @elseif( $order->m_processType == '2A')

                                <p>ارسال لجميع المعقبين الفرديين المسجلين بالموقع</p> 

                            @elseif( $order->m_processType == '2C')

                                <p>ارسال لجميع مكاتب الخدمات المسجلين بالموقع</p>                             

                            @elseif( $order->m_processType == "3")

                                <p>ارسال لمجموعة محددة بالموقع</p> 
                            
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>اتعاب انجاز المعاملة:</td>
                        <td>{{$order->m_enjazPrice}} ر.س</td>
                    </tr>
                    <tr>
                        <td> تكلفة الطرف الثالث:</td>
                        <td>{{$order->m_processThirdPartyPrice}} ر.س</td>
                    </tr>
                    <tr>
                        <td> الرسوم الحكومية:</td>
                        <td>{{$order->m_processGovPrice}} ر.س</td>
                    </tr>
                    <tr>
                        <td> سعر التنفيذ المرسل للعميل:</td>
                        <td>{{$order->price}} ر.س</td>
                    </tr>
                    <tr>
                        <td> مدة التنفيذ:</td>
                        <td>{{$order->m_processDays}} ايام</td>
                    </tr>
                    <tr>
                        <td> متطلبات التنفيذ:</td>
                        <td>{!! $order->m_processRequirment !!}</td>
                    </tr>

                    @if($order->notes->count() > 0)
                    <tr>
                        <td colspan="2"> <a href="#" data-target="#openAllNotes" data-toggle="modal">ملاحظات الطلب</a> </td>
                    </tr>
                    @endif
                </table>
        @endif

                </div> {{-- sticky --}}
            </div> {{-- col-4 --}}
        </div> {{-- end row --}}
    </div> {{-- portlet__body --}}
    </form>
                                
       
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">

            <form method="POST" action="{{ route('dashboard.order.mo3amla.update',  ['id' => $order->id]) }}"  id="m_form">

                @csrf
                @method('PUT')

            <div class="m-form__actions m-form__actions--solid">
            
                <div class="row">
                    <div class="col-lg-8">

                    <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">معالجة لطلب</label>
                            <div class="col-xl-9 col-lg-9">
                                @if( $order->processing_id == NULL || !$order->processing()->exists() )
                                    <select name="processing_id" class="form-control m-input">
                                        <option value="">اختار حالة</option>
                                        @foreach($statuses as $status)
                                            @if ($status->id == $order->processing_id)
                                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                                            @endif
                                        @endforeach
                                        @foreach($statuses as $status)
                                            @if ($status->id != $order->processing_id)
                                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                @else
                                <select name="processing_id" class="form-control m-input">
                                    @foreach($statuses as $status)
                                        @if($status->id == $order->processing_id)
                                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                                        @endif
                                    @endforeach
                                    @foreach($statuses as $status)
                                        @if ($status->id != $order->processing_id)
                                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @endif
                            </div>
                        </div> 

                    </div>

                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-accent">تحديث الحالة</button>
                    </div>
                    
                </div>
                 
            </div>
            </form>
        </div>   

   
</div>
<div>
</div>


<form id="denyPayment" action="{{ route('dashboard.order.mo3amla.paymentStatus', ['id' => $order->id ]) }}" method="POST" style="display: none;">
    @method('PUT')
    @csrf
    <input type="hidden" name="mo3amlaOrderId" value="{{ $order->id }}">
    <input type="hidden" name="paymentStatus" value="-1">
</form>
<form id="approvePayment" action="{{ route('dashboard.order.mo3amla.paymentStatus', ['id' => $order->id ]) }}" method="POST" style="display: none;">
    @method('PUT')
    @csrf
    <input type="hidden" name="mo3amlaOrderId" value="{{ $order->id }}">
    <input type="hidden" name="paymentStatus" value="1">
</form>


<!--end::Portlet-->
<div class="modal fade" id="lightBox" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <!-- Carousel markup goes in the modal body -->
            <img class="d-block w-100" id="imgView" src="">
      </div>
    </div>
  </div>
</div>

<!--end::Portlet-->
<div class="modal fade" id="ta3medModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <div id="t3meedResponse"></div>
        </div>
    </div>
  </div>
</div>


<!--Change status Modal-->
<div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-body">
        <!-- Carousel markup goes in the modal body -->
            <form id="changeStatus" action="{{ route('dashboard.order.mo3amla.changeStatus', ['id' => $order->id ]) }}" method="POST" style="display: block;">
                @method('PUT')
                @csrf
                <input type="hidden" name="mo3amlaOrderId" value="{{ $order->id }}">
                <input type="hidden" name="status" id="change_status_value">
                <div class="form-group m-form__group row">
                    <label class="col-xl-3 col-lg-3 col-form-label" id="statusReason"></label>
                    <div class="col-xl-9 col-lg-9">
                        <textarea type="text" class="form-control m-input" name="statusReason" >{{ old('statusReason') }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-accent">تحديث </button>
            </form>
        </div>
    </div>
  </div>
</div>



<!--openModalResendNotes Modal-->
<div class="modal fade" id="openModalResendNotes" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-body">
        <!-- Carousel markup goes in the modal body -->
            <form id="changeStatus" action="{{ route('dashboard.order.mo3amla.sendNotes', ['id' => $order->id ]) }}" method="POST" style="display: block;">
               
                @csrf
                <input type="hidden" name="mo3amlaOrderId" value="{{ $order->id }}">
                @if($order->notes->count() > 0)
                <div class="form-group m-form__group row">
                    <label class="col-xl-3 col-lg-3 col-form-label" id="statusReason">الملاحظات: </label>
                    <div class="col-xl-9 col-lg-9">
                        
                        @php 
                        
                            $lastNote = $order->notes->last();
                        @endphp 
                        <textarea  type="text" class="form-control m-input " name="notes" >{{ $lastNote->content }}</textarea>
                    </div>
                </div>
                <input type="hidden" name="noteId" value="{{ $lastNote->id }}"> 


                     @endif 
                       
                         
                <div class="form-group m-form__group row" style="margin-left:0; margin-right:0;">
                    <label class="col-xl-3 col-lg-3 col-form-label">فتح خيار ارسال ملفات جديدة من العميل:</label>
                    <div class="col-xl-9 col-lg-9">
                        <select required name="needNewFiles" class="form-control m-input">
                            <option value="">-- اختر -- </option>
                            <option value="1">نعم </option>
                            <option value="0">لا ما يحتاج</option>
                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row" style="margin-left:0; margin-right:0;">
                    <label class="col-xl-3 col-lg-3 col-form-label">فتح خيار الرد النصي:</label>
                    <div class="col-xl-9 col-lg-9">
                        <select required name="needTextAnswer" class="form-control m-input">
                            <option value="">-- اختر -- </option>
                            <option value="1">نعم </option>
                            <option value="0">لا ما يحتاج</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-accent">ارسال </button>
            </form>
        </div>
    </div>
  </div>
</div>



<!--openModalSendNewNotes Modal-->
<div class="modal fade" id="openModalSendNewNotes" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-body">
        <!-- Carousel markup goes in the modal body -->
            <form id="changeStatus" action="{{ route('dashboard.order.mo3amla.sendNewNotes', ['id' => $order->id ]) }}" method="POST" style="display: block;">
                @csrf
                <input type="hidden" name="mo3amlaOrderId" value="{{ $order->id }}">
                <div class="form-group m-form__group row">
                    <label class="col-xl-3 col-lg-3 col-form-label" id="statusReason">الملاحظات: </label>
                    <div class="col-xl-9 col-lg-9">
                        <textarea  type="text" class="form-control m-input " name="notes" ></textarea>
                    </div>
                </div>

                <div class="form-group m-form__group row" style="margin-left:0; margin-right:0;">
                    <label class="col-xl-3 col-lg-3 col-form-label">ارسال الملاحظة الي:</label>
                    <div class="col-xl-9 col-lg-9">
                        <select required name="sendTo" class="form-control m-input">
                            <option value="">-- اختر -- </option>
                            <option value="client">العميل </option>
                            <option value="vendor">المعقب</option>
                        </select>
                    </div>
                </div>
                         
                <div class="form-group m-form__group row" style="margin-left:0; margin-right:0;">
                    <label class="col-xl-3 col-lg-3 col-form-label">فتح خيار ارسال ملفات جديدة من العميل:</label>
                    <div class="col-xl-9 col-lg-9">
                        <select required name="needNewFiles" class="form-control m-input">
                            <option value="">-- اختر -- </option>
                            <option value="1">نعم </option>
                            <option value="0">لا ما يحتاج</option>
                        </select>
                    </div>
                </div>

                <div class="form-group m-form__group row" style="margin-left:0; margin-right:0;">
                    <label class="col-xl-3 col-lg-3 col-form-label">فتح خيار الرد النصي:</label>
                    <div class="col-xl-9 col-lg-9">
                        <select required name="needTextAnswer" class="form-control m-input">
                            <option value="">-- اختر -- </option>
                            <option value="1">نعم </option>
                            <option value="0">لا ما يحتاج</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-accent">ارسال </button>
            </form>
        </div>
    </div>
  </div>
</div>



<!--enjaz_prove Modal-->
<div class="modal fade" id="enjaz_prove" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h3> رفع اثبات الانجاز </h3>
                <!-- Carousel markup goes in the modal body -->
                <form action="{{ route('dashboard.order.mo3amla.enjaz_prove') }}" method="POST" style="display: block;" enctype="multipart/form-data">
                
                    @csrf
                    <input type="hidden" name="orderId" value="{{ $order->id }}">
                    <input type="hidden" name="userPhone" value="{{ $order->orderUser->phone }}">
                    <input type="hidden" name="userId" value="{{ $order->orderUser->id }}">
                    @if($order->enjaz_prove != Null && $order->status == 4)

                    <div class="form-group m-form__group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">  اثبات الانجاز المرسل من المعقب</label>
                        <div class="col-xl-9 col-lg-9">
                    <input type="hidden" name="mo3kb_enjaz_prove" value="{{ $order->enjaz_prove }}">
                        @php 
                            $ext = pathinfo($order->enjaz_prove, PATHINFO_EXTENSION);
                        @endphp


                        @if($ext == 'pdf')

                            <a class="pdfFile" href="{{ asset('storage/enjaz_prove') .'/'. $order->enjaz_prove}}" target="_blank">
                            <i class="fa fa-file"></i>  
                            </a>
      
                        @else
      
                        {{-- data-target="#lightBox" data-toggle="modal"  --}}
                            <img id="imgOnModal" src="{{ url('storage/enjaz_prove') . '/' . $order->enjaz_prove }}"  data-url="{{ url('storage/enjaz_prove') . '/' . $order->enjaz_prove }}" width="200"  >
      
                        @endif


                    </div>
                </div>
                    @endif

                    
                        

                    <div class="form-group m-form__group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">اثبات الانجاز </label>
                        <div class="col-xl-9 col-lg-9">
                            <input type="file" class="form-control m-input" name="enjaz_prove" >
                        </div>
                    </div>

                    <button type="submit" class="btn btn-accent pull-left">ارسال </button>
                </form>
            </div>
        </div>
    </div>
  </div>




<!--sendCustomSms Modal-->
<div class="modal fade" id="sendCustomSms" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <h3>ارسال رسالة SMS</h3>
            <!-- Carousel markup goes in the modal body -->
            <form id="customSMS" action="{{ route('dashboard.order.sendCustomSMS') }}" method="POST" style="display: block;">
              
                @csrf
                <input type="hidden" name="orderId" value="{{ $order->id }}">
                <input type="hidden" name="userPhone" value="{{ $order->orderUser->phone }}">
                <input type="hidden" name="userId" value="{{ $order->orderUser->id }}">
                
                <div class="form-group m-form__group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">جوال العميل </label>
                    <div class="col-xl-9 col-lg-9">
                        <input type="text" disabled class="form-control m-input" name="clientPhone"  value="{{ $order->orderUser->phone }}">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">نص الرسالة</label>
                    <div class="col-xl-9 col-lg-9">
                        <textarea type="text" id="smsText" class="form-control m-input" name="smsText" >{{ old('statusReason') }}</textarea>
                        <div>عدد الحروف : <span id="countLetters">0</span></div>
                    </div>
                </div>
                <button type="submit" class="btn btn-accent pull-left">ارسال </button>
            </form>
        </div>
    </div>
  </div>
</div>

{{--  Modal Display notes  --}}

@if($order->notes->count() > 0)



<!--openModalSendNewNotes Modal-->
<div class="modal fade" id="openAllNotes" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-body">
        <!-- Carousel markup goes in the modal body -->
            <table class="table">
                <tr>
                    <td>م #</td>
                    <td>المحتوى</td>
                    <td>يحتاج ملفات</td>
                    <td>يحتاج رد</td>
                    <td>الرد</td>
                    <td>من</td>
                    <td>الي</td>
                    <td>الحالة</td>
                </tr>

                @foreach ($order->notes as $note)
                <tr>
                    <td>{{ $note->id }}</td>
                    <td>{{ $note->content }}</td>
                    <td>
                        @if($note->need_files == 1)
                            نعم
                        @else
                            لا
                        @endif
                    </td>
                    <td>
                        @if($note->need_text == 1)
                            نعم
                        @else
                            لا
                        @endif
                    </td>
                    <td>{{ $note->answer }}</td>
                    <td>{{ $note->from }}</td>
                    <td>{{ $note->to }}</td>
                    <td>
                        @if($note->status == 0)
                            جديد
                        @elseif($note->status == 1)
                            تمت المشاهدة
                        @elseif($note->status == 2)
                            تم الرد
                        @endif
                       
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
  </div>
</div>

@endif

@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

<script>
  $(document).ready(function(){

  $('.summernote').summernote();


  

    $("#imgOnModal").on('click', function(){

        var src = $(this).data('url');
        $(this).parent().parent().parent().parent().parent().modal('hide');
        //console.log(src);
        $("#imgView").attr('src',src);
        $('#lightBox').modal('show');

    });
  
    $(".openImageModal").on('click', function(){

        $("#imgView").attr('src', $(this).data('url'));
        $('#lightBox').modal('show');

    });

    $(".openModal").on("click", function(e){
        e.preventDefault();
        $('#ta3medModal').modal('show');
        var order_id = $(this).data('mo3amla');
        var token = $("input[name='_token']").val();
        $.ajax({
            url: "{{ route('dashboard.ajax.mo3amla.assignTo') }}",
            method: 'POST',
            data: {order_id:order_id, _token:token},
            success: function(data) {
                $("#t3meedResponse").html(data.options);
            }
        });
    });

    $("#openModalEditPrice").on("click", function(e){
        e.preventDefault();
        $('#ta3medModal').modal('show');
        var order_id = $(this).data('mo3amla');
        var token = $("input[name='_token']").val();
        $.ajax({
            url: "{{ route('dashboard.ajax.mo3amla.reAssignTo') }}",
            method: 'POST',
            data: {order_id:order_id, _token:token},
            success: function(data) {
                $("#t3meedResponse").html(data.options);
            }
        });
    });

    $("#openResendNotesModal").on("click", function(e){
        e.preventDefault();
        $('#openModalResendNotes').modal('show');

    });
});

</script>

<script>
$(document).ready(function(){
    $("#mo3amla_process_type").on("change", function(){
        var proccess_type = $(this).val();
        if( proccess_type == '1' ){
            //console.log(1);
            var order_id = {{ $order->id }};
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "{{ route('dashboard.ajax.mo3amla.one') }}",
                method: 'POST',
                data: {order_id:order_id, _token:token},
                success: function(data) {
                    $("#ajaxRespons").html(data.options);
                }
            });
        }else if( proccess_type  == '2'){
           // console.log(2);
            var order_id = {{ $order->id }};
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "{{ route('dashboard.ajax.mo3amla.two') }}",
                method: 'POST',
                data: {order_id:order_id, _token:token},
                success: function(data) {
                    $("#ajaxRespons").html(data.options);
                }
            });
        }else if(proccess_type == "2A"){
            //console.log("2A");
            var order_id = {{ $order->id }};
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "{{ route('dashboard.ajax.mo3amla.two.a') }}",
                method: 'POST',
                data: {order_id:order_id, _token:token},
                success: function(data) {
                    $("#ajaxRespons").html(data.options);
                }
            });
        }else if(proccess_type == "2C"){
            //console.log("2C");
            var order_id = {{ $order->id }};
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "{{ route('dashboard.ajax.mo3amla.two.c') }}",
                method: 'POST',
                data: {order_id:order_id, _token:token},
                success: function(data) {
                    $("#ajaxRespons").html(data.options);
                }
            });
        }else if(proccess_type == '3'){
            //console.log(3);
            var order_id = {{ $order->id }};
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "{{ route('dashboard.ajax.mo3amla.three') }}",
                method: 'POST',
                data: {order_id:order_id, _token:token},
                success: function(data) {
                    $("#ajaxRespons").html(data.options);
                }
            });
        }else{
            $("#ajaxRespons").html('');
        }
    });
});
</script>
@endpush