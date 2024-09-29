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
                    جميع الادوار
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="{{ route('dashboard.permissions.create') }}" class="btn btn-info m-btn m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>اضافة دور</span>
                        </span>
                    </a>
                </li>
                
            </ul>
        </div>
    </div>
    <div class="m-portlet__body">

        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>تاريخ الاضافة</th>
                    <th>تاريخ اخر تعديل</th>
                    <th>الخيارات</th>
                </tr>
            </thead>
            <tbody>
                   
               @foreach ($roles as $index => $role)
               <tr>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->created_at }}</td>
                    <td>{{ $role->updated_at }}</td>

                   <td>
                       <a href="{{ route('dashboard.permissions.edit', ['id' => $role->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="تعديل">
                           <i class="la la-edit"></i>
                       </a>
                       <a onclick="event.preventDefault(); document.getElementById('{{ 'delete-form-' . $index}}').submit();" href="{{ route('dashboard.permissions.destroy', ['id' => $role->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="حذف">
                           <i class="fa fa-trash-alt"></i>
                       </a>
                       <form id="delete-form-{{$index}}" action="{{ route('dashboard.permissions.destroy', ['id' => $role->id ]) }}" method="POST" style="display: none;">
                           @method('DELETE')
                           @csrf
                       </form>
                   </td>
                </tr>                   
               @endforeach
               
            </tbody>
        </table>
        {!! $roles->links() !!}

    </div>
</div>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')
@endpush
