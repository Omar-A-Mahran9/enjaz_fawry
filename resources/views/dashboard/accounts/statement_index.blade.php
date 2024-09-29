@extends('layouts.dashboard')
@push('page_styles')

@endpush
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    البنوك
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                        <a href="{{ route('dashboard.banks.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>اضافة بنك</span>
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
                    <th>الشعار</th>
                    <th>اسم البنك</th>
                    <th>اسم الحساب</th>
                    <th>رقم الحساب</th>
                    <th>رقم الايبان</th>
                    <th>تاريخ الاضافة</th>
                    <th>اخر تعديل</th>
                    <th>خيارات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($banks as $index => $bank)
                <tr>
                    <td>
                        <div class="m-card-user m-card-user--sm">
                            <div class="m-card-user__pic">
                                <img src="{{ url('storage/banks') . '/' . $bank->logo }}" class="m--img-rounded m--marginless" alt="photo">
                            </div>
                        </div>
                    </td>
                   
                    <td>{{ $bank->name }}</td>
                    <td>{{ $bank->accountName }}</td>
                    <td>{{ $bank->accountNo }}</td>
                    <td>{{ $bank->accountIban }}</td>
                    <td>{{ $bank->created_at }}</td>
                    <td>{{ $bank->updated_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.banks.edit', ['id' => $bank->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-bank m-btn--icon m-btn--icon-only m-btn--pill" title="تعديل">
                            <i class="la la-edit"></i>
                        </a>
                        <a onclick="event.preventDefault(); document.getElementById('delete_form_{{$index}}').submit();" href="{{ route('dashboard.banks.destroy', ['id' => $bank->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-bank m-btn--icon m-btn--icon-only m-btn--pill" title="حذف">
                            <i class="fa fa-window-close"></i>
                        </a>
                        <form id="delete_form_{{$index}}" action="{{ route('dashboard.banks.destroy', ['id' => $bank->id ]) }}" method="POST" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>

                    </td>
                </tr>  
                @endforeach
            </tbody>
        </table>
        {!! $banks->links() !!}
    </div>

</div>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush
