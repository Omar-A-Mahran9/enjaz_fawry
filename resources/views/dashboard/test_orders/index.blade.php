@extends('layouts.dashboard')
@push('page_styles')
@endpush

@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    طلبات التجربة
                </h3>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">

        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>رقم الهاتف</th>
                    <th>نوع السيارة</th>
                    <th>توقيت الطلب</th>
                    <th>الحالة</th>
                    <th>معالجة الطلب</th>
                    <th>الخيارات</th>
                </tr>
            </thead>
            <tbody>
                   
               @foreach ($orders as $index => $order)
               <tr>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->car_type }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        @if($order->status == -1)
                            {{'لم تشاهد بعد'}}
                        @else
                            {{'تمت المشاهدة'}}
                        @endif
                    </td>
                    <td>
                        @if ($order->processing_id == NULL)
                            لم تتم معالجة الطلب
                        @else
                            {{ $order->processing->name }}     
                        @endif
                        
                    </td>
                    
                    <td>
                        <a href="{{ route('dashboard.test_order.show', ['id' => $order->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-order m-btn--icon m-btn--icon-only m-btn--pill" title="عرض">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a onclick="event.preventDefault(); document.getElementById('delete_form_{{$index}}').submit();" href="{{ route('dashboard.test_order.destroy', ['id' => $order->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-order m-btn--icon m-btn--icon-only m-btn--pill" title="حذف">
                            <i class="fa fa-window-close"></i>
                        </a>
                        <form id="delete_form_{{$index}}" action="{{ route('dashboard.test_order.destroy', ['id' => $order->id ]) }}" method="POST" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>

                    </td>
                </tr>                   
               @endforeach
               
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('page_vendors')
@endpush

@push('page_scripts')
@endpush
