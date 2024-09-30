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
                    جميع الرسائل
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                        
                </li>
                
            </ul>
        </div>
    </div>
    <div class="m-portlet__body">

        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
            <thead>
                <tr>
                    <th>#</th>
                    {{-- <th>عنوان الرسالة</th> --}}
                    <th>الاسم</th>
                    <th>رقم الجوال</th>
                    <th>البريد الالكتروني</th>
                    <th>الرسالة</th>
                    <th>الحالة</th>
                    {{-- <th>معالجة الطلب</th> --}}
                    <th>توقيت الرسالة</th>
                    {{-- <th>الرابط</th> --}}
                    <th>الخيارات</th>
                </tr>
            </thead>
            <tbody>
                   
               @foreach ($messages as $index => $message)
               <tr @if($message->status == -1) style="color:brown" @endif>
                    <td>
                        {{ $message->id }}                   
                     </td>
                    {{-- <td>{{ $message->title }}</td> --}}
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->phone }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->message }}</td>
                    <td>
                        @if($message->status == -1)
                            {{'لم تشاهد بعد'}}
                        @else
                            {{'تمت المشاهدة'}}
                        @endif
                    </td>
                    {{-- <td>
                        @if ($message->processing_id == NULL)
                            لم تتم معالجة الطلب
                        @else
                            {{ $message->processing->name }}     
                        @endif
                        
                    </td> --}}
                    <td>{{ $message->created_at }}</td>
                    {{-- <td>
                        @if($message->link_id != null) {{ $message->link->title }} @endif
                    </td> --}}
                    <td>
                        <a href="{{ route('dashboard.contact.show', ['id' => $message->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-message m-btn--icon m-btn--icon-only m-btn--pill" title="عرض">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a onclick="event.preventDefault(); document.getElementById('delete_form_{{$index}}').submit();" href="{{ route('dashboard.contact.destroy', ['id' => $message->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-message m-btn--icon m-btn--icon-only m-btn--pill" title="حذف">
                            <i class="fa fa-window-close"></i>
                        </a>
                        <form id="delete_form_{{$index}}" action="{{ route('dashboard.contact.destroy', ['id' => $message->id ]) }}" method="POST" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>

                    </td>
                </tr>                   
               @endforeach
               
            </tbody>
        </table>
        {!! $messages->links() !!}
    </div>
   
    
</div>

@endsection

@push('page_vendors')
@endpush

@push('page_scripts')

<script>
    
</script>
@endpush
