@extends('layouts.dashboard')
@push('page_styles')
    <link href="{{ asset('metronic/default') }}/assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    جميع المعقبين / مكاتب الخدمات
                </h3>
            </div>
        </div>
        {{-- <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="{{ route('dashboard.moderators.create') }}" class="btn btn-info m-btn m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>اضافة مشرف</span>
                        </span>
                    </a>
                </li>
                
            </ul>
        </div> --}}
    </div>
    <div class="m-portlet__body">

        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
            <thead>
                <tr>
                    <th>رقم الحساب</th>
                    <th>الاسم</th>
                    <th>البريد الالكتروني</th>
                    <th>الجوال</th>
                    <th>حالة الجوال</th>
                    <th>اثبات الهوية</th>
                    <th>حالة اثبات الهوية</th>
                    <th>حالة الحساب</th>
                    <th>عدد الطلبات</th>
                    <th>النوع</th>
                    <th>تاريخ / وقت التسجيل</th>
                    <th>الخيارات</th>
                </tr>
            </thead>
            <tbody>
                   
               @foreach ($vendors as $index => $user)
               <tr>
                    <td>{{ $user->account_no }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        @if($user->phone_status == 1)
                            مفعل 
                        @else
                            غير مفعل : كود التفعيل / {{ $user->verification_code }}
                        @endif
                    </td>
                   
                    <td>
                        @if($user->identity_file != Null )
                        @php 

                            $ext = pathinfo($user->identity_file, PATHINFO_EXTENSION);

                        @endphp

                            @if($ext == 'pdf')

                            <a href="{{ asset('storage/ids') .'/'. $user->identity_file}}" target="_blank">
                                معاينة الملف
                            </a>

                            @else
                            {{-- <div class="col-lg-6" data-target="#lightBox" data-toggle="modal">
                            <img width="50" src="{{ asset('storage/ids') .'/'. $user->identity_file}}">

                            </div> --}}

                            <img class="openImageModal" src="{{ url('storage/ids') . '/' . $user->identity_file }}"  data-url="{{ url('storage/ids') . '/' . $user->identity_file }}" width="70"  >

                            @endif

                        @else
                            لم يتم رفع اثبات الهوية
                        @endif
                    </td>

                    <td>  
                        @if($user->identity_file != Null && $user->identity_status == 1)
                            مفعل 

                        @elseif($user->identity_file != Null && $user->identity_status == -1)
                            مرفوض .. بانتظار اعادة الرفع

                        @elseif($user->identity_file != Null && $user->identity_status == 0)
                           جديد ... بانتظار التعميد
                        @else
                            جديد
                        @endif
                    </td>
                    <td>  
                        @if($user->status == 1)
                           <span style="color:green"> مفعل </span>
                        @else
                        <span style="color:red"> غير مفعل</span>
                        @endif
                    </td>
                    {{-- <td>---</td> --}}
                    <td>---</td>
                    <td>
                         @if($user->type == 'vendor')
                            معقب 
                        @elseif($user->type == 'vendorC')
                            مكتب خدمات
                        @endif
                    </td>
                    <td>{{ $user->created_at }}</td>
                   <td>
                       <a href="{{ route('dashboard.vendor.vendor_show', ['id' => $user->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="معاينة">
                           <i class="la la-eye"></i>
                       </a>
                       <a href="{{ route('dashboard.vendor.vendor_edit', ['id' => $user->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="تعديل">
                           <i class="la la-edit"></i>
                       </a>
                       <a href="{{ route('dashboard.vendor.vendor_pushTest', ['id' => $user->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="تعديل">
                            <i class="la la-cogs"></i>
                        </a>
                      
                   </td>
                </tr>                   
               @endforeach
               
            </tbody>
        </table>
        {!! $vendors->links() !!}

    </div>
</div>


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
        <img class="d-block w-100" id="imgView" src="">
            {{-- <img class="d-block w-100" src="{{ url('storage/ids') . '/' . $user->identity_file }}"> --}}
        </div>
    </div>
    </div>
</div>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

<script>
    $(document).ready(function(){

$(".openImageModal").on('click', function(){

    $("#imgView").attr('src', $(this).data('url'));
    $('#lightBox').modal('show');

});
});
</script>

@endpush
