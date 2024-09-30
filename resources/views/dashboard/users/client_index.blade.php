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
                    جميع العملاء
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
                    <th>عدد الطلبات</th>
                    <th>وقت التسجيل</th>
                    <th>الخيارات</th>
                </tr>
            </thead>
            <tbody>
                   
               @foreach ($clients as $index => $user)
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
                        @php 
                            $count_all = $user->estfsar_orders->count() 
                                        + $user->estfsar_orders->count() 
                                        + $user->estfsar_orders->count()
                                        + $user->estfsar_orders->count();
                        @endphp 
                        {{ $count_all}}
                        
                    </td>
                    <td>{{ $user->created_at }}</td>
                   <td>
                       <a href="{{ route('dashboard.users.client_show', ['id' => $user->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="تعديل">
                           <i class="la la-eye"></i>
                       </a>
                       <a href="{{ route('dashboard.users.client_edit', ['id' => $user->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="تعديل">
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
        {!! $clients->links() !!}

    </div>
</div>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')
@endpush
