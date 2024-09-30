@extends('layouts.dashboard')
@push('page_styles')

@endpush
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    التدوينات
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                        <a href="{{ route('dashboard.blog.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>اضافة تدوينة</span>
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
                    <th>العنوان</th>
                    <th>النوع</th>
                    <th>الحالة</th>
                    <th>تاريخ الاضافة</th>
                    <th>اخر تعديل</th>
                    <th>خيارات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $index => $post)
                <tr>
                    {{-- <td>
                        <div class="m-card-user m-card-user--sm">
                            <div class="m-card-user__pic">
                                <img src="{{ url('storage/blog') . '/' . $post->main_image }}" class="m--img-rounded m--marginless" alt="photo">
                            </div>
                        </div>
                    </td> --}}

                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>
                        @if ($post->type == 1)
                        تدوينة
                        @elseif($post->type == 2)
                        خبر
                        @endif
                    </td>
                  
                    <td>
                        @if ($post->status == 1)
                        <a href="{{ route('dashboard.status_change', ['model' => 'Blog', 'id' => $post->id, 'status' => 0 ]) }}" class="btn btn-secondary m-btn m-btn--custom m-btn--label-metal">
                            الغاء النشر  
                        </a>
                        @else
                        <a href="{{ route('dashboard.status_change', ['model' => 'Blog', 'id' => $post->id, 'status' => 1 ]) }}" class="btn btn-secondary m-btn m-btn--custom m-btn--label-success">
                            نشر 
                        </a>
                        @endif
                    </td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.blog.edit', ['id' => $post->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-post m-btn--icon m-btn--icon-only m-btn--pill" title="تعديل">
                            <i class="la la-edit"></i>
                        </a>
                        <a onclick="event.preventDefault(); document.getElementById('delete_form_{{$index}}').submit();" href="{{ route('dashboard.blog.destroy', ['id' => $post->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-post m-btn--icon m-btn--icon-only m-btn--pill" title="حذف">
                            <i class="fa fa-window-close"></i>
                        </a>
                        <form id="delete_form_{{$index}}" action="{{ route('dashboard.blog.destroy', ['id' => $post->id ]) }}" method="POST" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>

                    </td>
                </tr>  
                @endforeach
            </tbody>
        </table>
        {!! $posts->links() !!}
    </div>

</div>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush
