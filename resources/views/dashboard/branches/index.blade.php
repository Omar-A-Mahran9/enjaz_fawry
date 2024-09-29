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
                    الفروع
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="{{ route('dashboard.branch.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>اضافة فرع</span>
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
                    <th>الاسم عربي</th>
                    <th>الاسم انجليزي</th>
                    <th>الهاتف</th>
                    <th>الوتساب</th>

                    <th>الحالة</th>
                    <th>تاريخ الاضافة</th>
                    <th>اخر تعديل</th>
                    <th>خيارات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($branches as $index => $branch)
                <tr>

                    <td>{{ $branch->branch_name_ar }}</td>
                    <td>{{ $branch->branch_name_en }}</td>
                    <td>{{ $branch->phone }}</td>
                    <td>{{ $branch->whatsapp }}</td>

                    <td>
                        @if ($branch->status == 1)
                        <a href="{{ route('dashboard.status_change', ['model' => 'Branch', 'id' => $branch->id, 'status' => 0 ]) }}" class="btn btn-secondary m-btn m-btn--custom m-btn--label-metal">
                            اخفاء
                        </a>
                        @else
                        <a href="{{ route('dashboard.status_change', ['model' => 'Branch', 'id' => $branch->id, 'status' => 1 ]) }}" class="btn btn-secondary m-btn m-btn--custom m-btn--label-success">
                            اظهار 
                        </a>
                        @endif
                    </td>
                    <td>{{ $branch->created_at }}</td>
                    <td>{{ $branch->updated_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.branch.edit', ['id' => $branch->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-branch m-btn--icon m-btn--icon-only m-btn--pill" title="تعديل">
                            <i class="la la-edit"></i>
                        </a>
                        <a onclick="event.preventDefault(); document.getElementById('delete_form_{{$index}}').submit();" href="{{ route('dashboard.branch.destroy', ['id' => $branch->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-branch m-btn--icon m-btn--icon-only m-btn--pill" title="حذف">
                            <i class="fa fa-window-close"></i>
                        </a>
                        <form id="delete_form_{{$index}}" action="{{ route('dashboard.branch.destroy', ['id' => $branch->id ]) }}" method="POST" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>

                    </td>
                </tr>  
                @endforeach
            </tbody>
        </table>
        {!!   $branches->links() !!}
    </div>

</div>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush
