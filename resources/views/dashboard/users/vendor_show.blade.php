

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
                            معاينة حساب  

                            @if($user->type == 'vendor')

                            المعقب : {{ $user->id }}
                        @elseif($user->type == 'vendorC')
                            مكتب الخدمات : {{ $user->id }}

                        @endif
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('dashboard.vendor.vendor_edit', ['id' => $user->id ]) }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                            <span>
                                <i class="la la-edit"></i>
                                <span>تعديل  </span>
                            </span>
                        </a>
                        
                        <li class="m-portlet__nav-item"></li>
                    </ul>
                </div>
            </div>

            <div class="m-portlet__body">

                <div class="col-md-5">
                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                        <thead>
                            <tr>
                                <th colspan="2"> بيانات @if($user->type == 'vendor')

                                    المعقب : {{ $user->id }}
                                @elseif($user->type == 'vendorC')
                                    مكتب الخدمات : {{ $user->id }}
        
                                @endif </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>رقم الحساب </th>
                                <td>{{ $user->account_no }}</td>
                            </tr>
                            <tr>
                                <th>الاسم </th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>البريد الالكتروني </th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>رقم الجوال </th>
                                <td>{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <th>حالة الجوال </th>
                                <td> 
                                    @if($user->phone_status == 1)
                                        <span style="color:green">   مفعل </span>
                                    @else
                                        <span style="color:red">  غير مفعل : كود التفعيل / {{ $user->verification_code }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>رقم الهوية </th>
                                <td>{{ $user->identity_no }}</td>
                            </tr>
                            <tr>
                                <th>اثبات الهوية </th>
                                <td>
                                @if($user->identity_status == 0 && $user->identity_file != NULL)

                                @php 
                
                                $ext = pathinfo($user->identity_file, PATHINFO_EXTENSION);
                
                                
                
                                @endphp
                
                                    @if($ext == 'pdf')
                
                                    <a  class="pdfFile" href="{{ asset('storage/ids') .'/'. $user->identity_file}}" target="_blank">
                                        <i class="fa fa-file-pdf-o"></i>  
                                    </a>
                
                                    @else
                
                                <a href="#"  data-target="#lightBox" data-toggle="modal"><img width="50" src="{{ asset('storage/ids') .'/'. $user->identity_file}}"></a>
                
                                @endif

                                @else 
                                لا يوجد
                                @endif
                                </td>
                            </tr>

                            <tr>
                                <th>بيانات الحساب البنكي </th>
                                <td>
                                        @if($user->banks->count() > 0 )

                                        @php
                                            
                                        $bank = $user->banks->last();
                                        @endphp
                                        
                                            <div class="bank">
                                              <p>
                                                <strong> البنك : </strong>
                                                <span>  {{$bank->name}} </span>
                                              </p>
                                              <p>
                                                <strong> اسم الحساب :  </strong>
                                                <span>  {{$bank->accountName}} </span>
                                              </p>
                                              <p>
                                                <strong> رقم الحساب : </strong>
                                                <span>  {{$bank->accountNo}} </span>
                                              </p>
                                              <p>
                                                <strong> الايبان : </strong>
                                                <span> {{$bank->accountIban}} </span>
                                              </p>
                                          </div>
                                      
                          
                                        @else 
                                          لا يوجد
                                        @endif
                                </td>
                            </tr>
                            <tr>
                                <th>حالة الحساب </th>
                                <td>
                                    @if($user->status == 0 ) 
                                        جديد
                                    @elseif($user->status == 1 ) 
                                    <span style="color:green">  نشط</span>
                                    @elseif($user->status == -1 ) 
                                    <span style="color:red">   موقوف</span>
                                    @elseif($user->status == -2 ) 
                                    <span style="color:black">  القائمة السوداء</span>
                                    @else
                                        {{ $user->status }}
                                    @endif
                                </td>
                            </tr>
                            @if($user->status == -2 && $user->blacklist_reson != NULL) 
                            <tr>
                                <th>سبب الاضافة في القائمة السوداء </th>
                                <td>
                                    {{ $user->blacklist_reson }}
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div> <!--col5 -->

                
                <div style="margin:30px 0;width:100%; height:5px;"></div>

                <hr >

<div style="margin:30px 0;width:100%; height:5px;"></div>
<div class="row">

<div class="col-md-4">
    <h4 class="text-center">طلبات المعاملات [ @if($mo3amlat->count() > 0 ) {{$mo3amlat->count() }} @else 0 @endif ]</h4>
    @if($mo3amlat->count() > 0 )
        <table class="table table-striped text-center">
            <thead>
                <tr>
                <th scope="col"># رقم الطلب</th>
                <th scope="col">حالة الطلب</th>
                {{-- <th scope="col">اجمالي المبلغ</th> --}}
                <th scope="col">تاريخ الطلب</th>
                <th scope="col">اجراءات</th>
                </tr>
            </thead>
            <tbody>
            @foreach($mo3amlat as $mo3amla)
                <tr>
                    <th scope="row">{{ $mo3amla['id'] }} </th>
                    <td>
                        @if(( $mo3amla['status'] == -1 || $mo3amla['status'] == 0) && $mo3amla['processing_id']== NULL)
                        جديد
                        @else


                            @if( $mo3amla->processing()->exists() )
                                {{  $mo3amla->processing->name }}
                            @else
                                تم حذف الحالة
                            @endif
    
                        @endif
                    </td>
                    {{-- <td>{{ $mo3amla['total_price'] }} ر.س</td> --}}
                    <td>{{ $mo3amla['created_at']->format('d-m-Y') }}</td>
                    <td>
                    <a target="_blank" href="{{ route('dashboard.order.mo3amla.show', ['id' => $mo3amla->id ]) }} " title="معاينة">
                        <i class="fa fa-eye"></i>
                    </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    @else
        <div class="alert alert-secondary">لا توجد طلبات معاملات</div>
    @endif
</div> <!-- Col4  -->




<div class="col-md-4">
    <h4 class="text-center">طلبات التعميد [ @if($ta3meed->count() > 0 ) {{$ta3meed->count() }} @else 0  @endif ]</h4>
    @if($ta3meed->count() > 0 )
        <table class="table table-striped text-center">
            <thead>
                <tr>
                <th scope="col"># رقم الطلب</th>
                <th scope="col">حالة الطلب</th>
                {{-- <th scope="col">اجمالي المبلغ</th> --}}
                <th scope="col">تاريخ الطلب</th>
                <th scope="col">اجراءات</th>
                </tr>
            </thead>
            <tbody>
            @foreach($ta3meed as $ta3med)
                <tr>
                    <th scope="row">{{ $ta3med['id'] }} </th>
                    <td>
                        @if(( $ta3med['status'] == -1 || $ta3med['status'] == 0) && $ta3med['processing_id']== NULL)
                        جديد
                        @else
                        
                            @if( $ta3med->processing()->exists() )
                                {{  $ta3med->processing->name }}
                            @else
                                تم حذف الحالة
                            @endif
    
                        @endif
                    </td>
                    {{-- <td>{{ $ta3med['total_price'] }} ر.س</td> --}}
                    <td>{{ $ta3med['created_at']->format('d-m-Y') }}</td>
                    <td>
                    <a target="_blank" href="{{ route('dashboard.order.ta3med.show', ['id' => $ta3med->id ]) }}" title="معاينة">
                        <i class="fa fa-eye"></i>
                    </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    @else
        <div class="alert alert-secondary">لا توجد طلبات تعميد</div>
    @endif
</div> <!-- Col4  -->




<div class="col-md-4">
    <h4 class="text-center">طلبات الاستفسارات  [ @if($estfsarat->count() > 0 ) {{$estfsarat->count() }} @else 0 @endif ]</h4>
    @if($estfsarat->count() > 0 )
        <table class="table table-striped text-center">
            <thead>
                <tr>
                <th scope="col"># رقم الطلب</th>
                <th scope="col">حالة الطلب</th>
                {{-- <th scope="col">اجمالي المبلغ</th> --}}
                <th scope="col">تاريخ الطلب</th>
                <th scope="col">اجراءات</th>
                </tr>
            </thead>
            <tbody>
            @foreach($estfsarat as $estfsar)
                <tr>
                    <th scope="row">{{ $estfsar['id'] }} </th>
                    <td>
                        @if(( $estfsar['status'] == -1 || $estfsar['status'] == 0) && $estfsar['processing_id']== NULL)
                        جديد
                        @else
                        


                            @if(  $estfsar->processing()->exists() )
                                {{  $estfsar->processing->name }}
                            @else
                                تم حذف الحالة
                            @endif
    
                        @endif
                    </td>
                    {{-- <td>{{ $estfsar['total_price'] }} ر.س</td> --}}
                    <td>{{ $estfsar['created_at']->format('d-m-Y') }}</td>
                    <td>
                    <a target="_blank" href="{{ route('dashboard.order.estfsar.show', ['id' => $estfsar->id ]) }}" title="معاينة">
                        <i class="fa fa-eye"></i>
                    </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    @else
        <div class="alert alert-secondary">لا توجد طلبات استفسارات</div>
    @endif
</div> <!-- Col4  -->


</div> <!-- End Row -->




                    
        
                </div>
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






