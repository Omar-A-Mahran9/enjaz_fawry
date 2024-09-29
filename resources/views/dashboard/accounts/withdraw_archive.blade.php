@extends('layouts.dashboard')
@push('page_styles')

@endpush
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    ارشيف طلبات سحب الارصدة
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                        <a href="{{ route('dashboard.accounts.withdraw.index') }}" class="btn btn-success m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-bullseye"></i>
                            <span>الطلبات الجديدة</span>
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
                    <th>م</th>
                    <th>المعقب</th>
                    <th>نوع الحساب</th>
                    <th>حالة الحساب</th>
                    <th>الرصيد المطلوب</th>
                    <th>تاريخ الطلب</th>
                    <th>الحالة</th>
                    <th>خيارات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($witdraws as $index => $witdraw)
                <tr>
                  
                   
                    <td>{{  $index+1 }}</td>
                    <td><a target="_blank" href="{{ route('dashboard.vendor.vendor_show', ['id' => $witdraw->user->id ]) }}">{{ $witdraw->user->name }}</a></td>
                    <td>
                        @if($witdraw->user->type == 'vendor')
                            معقب
                        @elseif($witdraw->user->type == 'vendorC')
                            مكتب خدمات
                        @elseif($witdraw->user->type == 'individual')
                            عميل 
                        @else
                        --
                        @endif
                       
                    </td>
                    <td>
                        @if($witdraw->user->status == '0')
                            جديد
                        @elseif($witdraw->user->status == '-1')
                            يحتاج تفعيل بيانات الهوية
                        @elseif($witdraw->user->status == '-2')
                            القائمة السوداء 
                        @elseif($witdraw->user->status == '1')
                            مفعل 
                        @else
                            --
                        @endif
                       
                    </td>
                    <td>{{ $witdraw->total_amount }} ر.س</td>
                    <td>{{ $witdraw->created_at }}</td>
                    <td>
                        @if($witdraw->status  == "-1")
                            جديد
                        @elseif($witdraw->status  == "0")
                            مرفوض
                        @elseif($witdraw->status  == "1")

                            تم التحويل 

                        @endif
                    </td>
                    <td>
                        <a href="{{ route('dashboard.accounts.withdraw.show', ['id' => $witdraw->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-witdraw m-btn--icon m-btn--icon-only m-btn--pill" title="تعديل">
                            <i class="la la-edit"></i>
                        </a>
                        {{-- <a onclick="event.preventDefault(); document.getElementById('delete_form_{{$index}}').submit();" href="{{ route('dashboard.banks.destroy', ['id' => $witdraw->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-witdraw m-btn--icon m-btn--icon-only m-btn--pill" title="حذف">
                            <i class="fa fa-window-close"></i>
                        </a> --}}
                        {{-- <form id="delete_form_{{$index}}" action="{{ route('dashboard.banks.destroy', ['id' => $witdraw->id ]) }}" method="POST" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form> --}}

                    </td>
                </tr>  
                @endforeach
            </tbody>
        </table>
        {{-- {!! $witdraws->links() !!} --}}
    </div>

</div>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush
