@extends('layouts.dashboard')
@push('page_styles')

@endpush
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    القائمة السوداء
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="{{route('dashboard.blacklist.create')}}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>اضافة رقم للقائمة</span>
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
                    <th>#</th>
                    <th>الاسم</th>
                    <th>الجوال</th>
                    <th>سبب الاضافة</th>
                    <th>حالة السبب</th>
                    <th>تاريخ الاضافة</th>
                    <th>خيارات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $index => $l)
                <tr>

                    <td>{{ $l->id }}</td>
                    <td>{{ $l->name }}</td>
                    <td>{{ $l->mobile }}</td>
                    <td>{{ $l->desc }}</td>


                    <td>
                        @if($l->show_reason == 1)
                            معلن
                        @else
                            مخفي 
                        @endif
                      
                    </td>
                    <td>{{ $l->created_at }}</td>
            
                    <td>
                              
                        <a onclick="event.preventDefault(); document.getElementById('delete_form_{{$index}}').submit();" class="m-portlet__nav-link btn m-btn m-btn--hover-bank m-btn--icon m-btn--icon-only m-btn--pill" title="حذف الرقم">
                            <i class="la la-times"></i>
                             <form id="delete_form_{{$index}}" action="{{ route('dashboard.blacklist.destroy', ['id' => $l->id ]) }}" method="POST" style="display: none;">
                                @method('DELETE')
                                @csrf
                            </form>
                        </a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $list->links() !!}

    </div>

</div>
    <form id="newUrl" action="{{ route('dashboard.site_review.create') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection

