@extends('layouts.dashboard')
@push('page_styles')

@endpush
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    الفيديوهات
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="{{ route('dashboard.video.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>اضافة فيديو</span>
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
                    <th>الرابط</th>
                    <th>الوصف</th>
                    <th>تاريخ الاضافة</th>
                    <th>اخر تعديل</th>
                    <th>خيارات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($videos as $index => $video)
                <tr>

                    <td>{{ $video->title_ar }}</td>
                    <td>{{ $video->video_url }}</td>
                    <td>{{ $video->descr_ar }}</td>
                    <td>
                        @if ($video->status == 0)
                            غير منشور
                        @else
                            منشور
                        @endif
                    </td>
                    <td>{{ $video->created_at }}</td>
                    <td>{{ $video->updated_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.video.edit', ['id' => $video->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-video m-btn--icon m-btn--icon-only m-btn--pill" title="تعديل">
                            <i class="la la-edit"></i>
                        </a>
                        <a onclick="event.preventDefault(); document.getElementById('delete_form_{{$index}}').submit();" href="{{ route('dashboard.video.destroy', ['id' => $video->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-video m-btn--icon m-btn--icon-only m-btn--pill" title="حذف">
                            <i class="fa fa-window-close"></i>
                        </a>
                        <form id="delete_form_{{$index}}" action="{{ route('dashboard.video.destroy', ['id' => $video->id ]) }}" method="POST" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>

                    </td>
                </tr>  
                @endforeach
            </tbody>
        </table>
        {!! $videos->links() !!}
    </div>

</div>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush
