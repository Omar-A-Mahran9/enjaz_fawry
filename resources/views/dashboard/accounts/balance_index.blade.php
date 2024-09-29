@extends('layouts.dashboard')
@push('page_styles')

@endpush
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    الارصدة
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            {{-- <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                        <a href="{{ route('dashboard.banks.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>اضافة بنك</span>
                        </span>
                    </a>
                </li>
                <li class="m-portlet__nav-item"></li>
                
            </ul> --}}
        </div>
    </div>
    <div class="m-portlet__body">

        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
            <thead>
                <tr>
                    <th>#م</th>
                    <th>رقم المعاملة</th>
                    <th>المعقب</th>
                    <th>القيمة</th>
                    <th>الحالة</th>
                    <th>طلب سحب رصيد</th>
                    <th>تاريخ الاضافة</th>
                    <th>خيارات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($balances as $index => $balance)
                <tr>
                   
                    <td>{{ $balance->id }}</td>
                    <td>{{ $balance->order->order_no }}</td>
                    <td>{{ $balance->user->name }}</td>
                    <td>{{ $balance->vendor_price }} ر.س</td>
                    <td>{{ $balance->status }}</td>
                    <td>
                        @if($balance->withdraw_id == Null)

                         لم يتم طلب سحب
                        @else
                        مرتبط بطلب سحب  : 
                        <a href="{{ route('dashboard.accounts.withdraw.show', ['id' =>  $balance->withdraw->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-witdraw m-btn--icon m-btn--icon-only m-btn--pill" title="معاينة">
                            رقم {{$balance->withdraw->id}}
                        </a>
                       

                        @endif
                    
                    </td>
                    
                    <td>{{ $balance->updated_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.accounts.balance.show', ['id' => $balance->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-balance m-btn--icon m-btn--icon-only m-btn--pill" title="تعديل">
                            <i class="la la-edit"></i>
                        </a>
                        {{-- <a onclick="event.preventDefault(); document.getElementById('delete_form_{{$index}}').submit();" href="{{ route('dashboard.balances.destroy', ['id' => $balance->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-balance m-btn--icon m-btn--icon-only m-btn--pill" title="حذف">
                            <i class="fa fa-window-close"></i>
                        </a> --}}
                       

                    </td>
                </tr>  
                @endforeach
            </tbody>
        </table>
        {!! $balances->links() !!}
    </div>

</div>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush
