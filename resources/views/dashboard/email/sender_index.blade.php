@extends('layouts.dashboard')
@push('page_styles')
@endpush
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    البريد المرسل
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                        <a href="{{ route('dashboard.emailSender.form') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>ارسال بريد</span>
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
                    <th>النوان</th>
                    <th>المحتوى</th>
                    <th>تاريخ الارسال</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($emails as $index => $email)
                <tr>

                    <td>{{ $email->id }}</td>
                    <td>{{ $email->title }}</td>
                    <td>{{ $email->content }}</td>
                    <td>{{ $email->created_at }}</td>

                </tr>  
                @endforeach
            </tbody>
        </table>
        {!!   $emails->links() !!}
    </div>

</div>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush
