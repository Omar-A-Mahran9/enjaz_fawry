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
                    العروض
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                        <a href="{{ route('dashboard.offers.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>اضافة عرض </span>
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
                    <th>الترتيب</th>
                    <th>الصورة</th>
                    <th>الاسم عربي</th>
                    <th>نوع السلايد</th>
                    <th>الحالة</th>
                    <th>تاريخ الاضافة</th>
                    <th>اخر تعديل</th>
                    <th>خيارات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($offers as $index => $offer)
                <tr>
                    <td>
                        <form id="sorting_change_{{$index}}" name="sorting_change" action="{{ route('dashboard.sortingChange', ['id' => $offer->id, 'model' => 'Offer' ]) }}" method="POST">
                            @csrf
                            <div class="form-group m-form__group">
                                <select class="form-control m-input sorting_change" name="sorting_number" id="exampleSelect1">
                                    @for ($i = 1; $i <= $offers_count; $i++)
                                        <option value="{{$i}}" @if ($offer->sorting_number == $i) selected @endif>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            
                        </form>
                    </td>
                    <td>
                        <div class="m-card-user m-card-user--sm">
                            <div class="m-card-user__pic">
                                <img src="{{ url('storage/offers') . '/' . $offer->main_image }}" class="m--img-rounded m--marginless" alt="photo">
                            </div>
                        </div>
                    </td>
                    <td>{{ $offer->title_ar }}</td>
                    <td>
                        @if ($offer->type == 1)
                            صورة
                        @elseif($offer->type == 2)
                            فيديو
                        @else 
                            سلايدر
                        @endif
                    </td>
                    <td>
                        @if ($offer->status == 1)
                        <a href="{{ route('dashboard.status_change', ['model' => 'Offer', 'id' => $offer->id, 'status' => 0 ]) }}" class="btn btn-secondary m-btn m-btn--custom m-btn--label-metal">
                            الغاء النشر  
                        </a>
                        @else
                        <a href="{{ route('dashboard.status_change', ['model' => 'Offer', 'id' => $offer->id, 'status' => 1 ]) }}" class="btn btn-secondary m-btn m-btn--custom m-btn--label-success">
                            نشر 
                        </a>
                        @endif
                    </td>

                    <td>{{ $offer->created_at }}</td>
                    <td>{{ $offer->updated_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.offers.edit', ['id' => $offer->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-offer m-btn--icon m-btn--icon-only m-btn--pill" title="تعديل">
                            <i class="la la-edit"></i>
                        </a>
                        <a onclick="event.preventDefault(); document.getElementById('delete_form_{{$index}}').submit();" href="{{ route('dashboard.offers.destroy', ['id' => $offer->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-offer m-btn--icon m-btn--icon-only m-btn--pill" title="حذف">
                            <i class="fa fa-window-close"></i>
                        </a>
                        <form id="delete_form_{{$index}}" action="{{ route('dashboard.offers.destroy', ['id' => $offer->id ]) }}" method="POST" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>

                    </td>
                </tr>  
                @endforeach
            </tbody>
        </table>
        {!! $offers->links() !!}
    </div>

</div>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('.sorting_change').on('change', function() {
                $(this).closest('form').submit();
            });
        });
    </script>
@endpush
