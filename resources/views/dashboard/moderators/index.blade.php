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
                    جميع المشرفين
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
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
        </div>
    </div>
    <div class="m-portlet__body">

        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>البريد الالكتروني</th>
                    <th>الدور</th>
                    <th>وقت الاضافة</th>
                    <th>الخيارات</th>
                </tr>
            </thead>
            <tbody>
                   
               @foreach ($users as $index => $user)
               <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ str_replace(['[', '"', ']'], '', $user->getRoleNames()) }}</td>
                    <td>{{ $user->created_at }}</td>
                   <td>
                       <a href="{{ route('dashboard.moderators.edit', ['id' => $user->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="تعديل">
                           <i class="la la-edit"></i>
                       </a>
                       <a onclick="event.preventDefault(); document.getElementById('{{ 'delete-form-' . $index}}').submit();" href="{{ route('dashboard.moderators.destroy', ['id' => $user->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="حذف">
                           <i class="fa fa-trash-alt"></i>
                       </a>
                       <form id="delete-form-{{$index}}" action="{{ route('dashboard.moderators.destroy', ['id' => $user->id ]) }}" method="POST" style="display: none;">
                           @method('DELETE')
                           @csrf
                       </form>
                   </td>
                </tr>                   
               @endforeach
               
            </tbody>
        </table>
        {!! $users->links() !!}

    </div>
</div>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')
@endpush
