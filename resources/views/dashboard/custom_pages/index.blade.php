@extends('layouts.dashboard')
@push('page_styles')
<link href="{{ asset('metronic') }}/vendors/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" />

@endpush
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    جميع الصفحات 
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                        <a href="{{ route('dashboard.custom_pages.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>اضافة صفحة جديدة</span>
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
                    <th>العنوان</th>
                    <th>الوصف</th>
                    <th>الرابط</th>
                    <th>تاريخ الاضافة</th>
                    <th>اخر تعديل</th>
                    <th>خيارات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pages as $index => $page)
                <tr>
                    <td>{{ $page->title_ar }}</td>
                    <td>{{ $page->description_ar }}</td>
                    <td>
                        <button type="button" value="{{ route('customPages.show', ['id' => $page->random_id]) }}" class="btn btn-secondary m-btn m-btn--custom m-btn--label-accent sweetalert_copy_link" >نسخ الرابط</button>
                    </td>
                    <td>{{ $page->created_at }}</td>
                    <td>{{ $page->updated_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.custom_pages.edit', ['id' => $page->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="تعديل">
                            <i class="la la-edit"></i>
                        </a>
                        <a onclick="event.preventDefault(); document.getElementById('delete_form_{{$index}}').submit();" href="{{ route('dashboard.custom_pages.destroy', ['id' => $page->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="حذف">
                            <i class="fa fa-window-close"></i>
                        </a>
                        <form id="delete_form_{{$index}}" action="{{ route('dashboard.custom_pages.destroy', ['id' => $page->id ]) }}" method="POST" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>

                    </td>
                </tr>  
                @endforeach
            </tbody>
        </table>
        {!! $pages->links() !!}
    </div>

</div>
@endsection

@push('page_vendors')
<script src="{{ asset('metronic') }}/vendors/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
<script src="{{ asset('metronic') }}/vendors/js/framework/components/plugins/base/sweetalert2.init.js" type="text/javascript"></script>
@endpush

@push('page_scripts')
<script src="{{ asset('metronic/default') }}/assets/demo/custom/components/base/sweetalert2.js" type="text/javascript"></script>

<script>
    $('.sweetalert_copy_link').click(function(e) {
        data1 = $(this).val();
        
        swal('<label> الرابط: </label> <input type="text"' + 'value=' + data1 +'>');
    });
</script>
@endpush
