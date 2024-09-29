@extends('layouts.dashboard')
@push('page_styles')

@endpush
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    التقييمات
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                {{-- <li class="m-portlet__nav-item">
                        <a href="{{ route('dashboard.banks.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>اضافة تقييم</span>
                        </span>
                    </a>
                </li> --}}
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
                    <th>المعاملة</th>
                    <th>العميل</th>
                    <th>المعقب</th>
                    <th>النجوم</th>
                    <th>الوصف</th>
                    <th>تاريخ الاضافة</th>
                    <th>اخر تعديل</th>
                    <th>الحالة</th>
                    <th>خيارات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $index => $review)
                <tr>
                   
                    <td>{{ $review->id }}</td>
                    <td>{{ $review->order_no }}</td>
                    <td>{{ $review->client_id }}</td>
                    <td>{{ $review->vendor_id }}</td>
                    <td>{{ $review->stars }}</td>
                    <td>{{ $review->description }}</td>
                    <td>{{ $review->created_at }}</td>
                    <td>{{ $review->updated_at }}</td>
                    <td>
                        @if($review->status === Null)
                            جديد
                        @elseif($review->status == '1')
                            موافق عليه
                        @elseif($review->status == '0')
                            مرفوض
                        @else
                            --
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('dashboard.reviews.approve', ['id' => $review->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-bank m-btn--icon m-btn--icon-only m-btn--pill" title="موافقة">
                            <i class="la la-check"></i> 
                        </a>

                        <a href="{{ route('dashboard.reviews.reject', ['id' => $review->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-bank m-btn--icon m-btn--icon-only m-btn--pill" title="رفض">
                            <i class="la la-times"></i> 
                        </a>
                        {{-- <a onclick="event.preventDefault(); document.getElementById('delete_form_{{$index}}').submit();" href="{{ route('dashboard.reviews.destroy', ['id' => $review->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-bank m-btn--icon m-btn--icon-only m-btn--pill" title="حذف">
                            <i class="fa fa-window-close"></i>
                        </a>
                        <form id="delete_form_{{$index}}" action="{{ route('dashboard.reviews.destroy', ['id' => $review->id ]) }}" method="POST" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form> --}}

                    </td>
                </tr>  
                @endforeach
            </tbody>
        </table>
        {!! $reviews->links() !!}
    </div>

</div>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush
