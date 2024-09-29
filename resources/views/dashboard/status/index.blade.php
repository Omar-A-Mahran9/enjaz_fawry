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
                    الحالات
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                        <a href="{{ route('dashboard.status.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>اضافة حالة</span>
                        </span>
                    </a>
                </li>
                <li class="m-portlet__nav-item"></li>
                
            </ul>
        </div>
    </div>
    <div class="m-portlet__body">

        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>ارسال رسالة</th>
                    <th>نص الرسالة</th>
                    <th>تحتاج اجراء</th>
                    <th>تاريخ الاضافة</th>
                    <th>اخر تعديل</th>
                    <th>خيارات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Status as $index => $status)
                <tr>

                    <td>{{ $status->name }}</td>
                    <td>
                        @if ($status->sms == 0)
                            لا
                        @else
                            نعم
                        @endif
                    </td>
                    <td>{{ $status->sms_text }}</td>
                    <td>
                        @if ($status->needAction == 1)
                            نعم
                        @else
                            لا
                        @endif
                    </td>
                    <td>{{ $status->created_at }}</td>
                    <td>{{ $status->updated_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.status.edit', ['id' => $status->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-status m-btn--icon m-btn--icon-only m-btn--pill" title="تعديل">
                            <i class="la la-edit"></i>
                        </a>
                        <a onclick="event.preventDefault(); document.getElementById('delete_form_{{$index}}').submit();" href="{{ route('dashboard.status.destroy', ['id' => $status->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-status m-btn--icon m-btn--icon-only m-btn--pill" title="حذف">
                            <i class="fa fa-window-close"></i>
                        </a>
                        <form id="delete_form_{{$index}}" action="{{ route('dashboard.status.destroy', ['id' => $status->id ]) }}" method="POST" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>

                    </td>
                </tr>  
                @endforeach
            </tbody>
        </table>
        {!!   $Status->links() !!}
    </div>

</div>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush
