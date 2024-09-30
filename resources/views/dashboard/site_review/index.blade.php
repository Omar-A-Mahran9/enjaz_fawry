@extends('layouts.dashboard')
@push('page_styles')

@endpush
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    تقييمات انجاز فوري
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a onclick="document.getElementById('newUrl').submit();" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>انشاء رابط تقييم جديد</span>
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
                    <th>الرابط</th>
                    <th>اسم العميل</th>
                    <th>الجوال</th>
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
                    <td><a id="myInput-{{ $review->id }}" target="_blank" href="{{URL::to('/rate_site/')}}/{{ $review->id }}/{{ $review->unique_key }}">{{URL::to('/rate_site/')}}/{{ $review->id }}/{{ $review->unique_key }}</a></td>
                    <td>{{ $review->name }}</td>
                    <td>{{ $review->mobile }}</td>
                    <td>{{ $review->stars }}</td>
                    <td>{{ $review->desc }}</td>
                    <td>{{ $review->created_at }}</td>
                    <td>{{ $review->updated_at }}</td>
                    <td>
                        @if($review->status === '-1')
                            جديد
                        @elseif($review->status == '1')
                            موافق عليه
                        @elseif($review->status == '0')
                            تم التقييم
                        @elseif($review->status == '2')
                            مرفوض
                        @else
                        --
                        @endif


                    </td>
                    <td>
                                                            
                        @if($review->status === '-1')
                            <a onclick="copyText('#myInput-{{ $review->id }}')" class="m-portlet__nav-link btn m-btn m-btn--hover-bank m-btn--icon m-btn--icon-only m-btn--pill" title="نسخ الرابط">
                                <i class="la la-copy"></i>
                            </a>
                            <input type="text" style="display:none;" value="{{URL::to('/rate_site/')}}/{{ $review->id }}/{{ $review->unique_key }}" id="myInput-{{ $review->id }}">

                        @elseif($review->status == '1')
                            <a href="{{ route('dashboard.site_review.reject', ['id' => $review->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-bank m-btn--icon m-btn--icon-only m-btn--pill" title="رفض">
                                <i class="la la-times"></i>
                            </a>
                        @elseif($review->status == '0')
                            <a href="{{ route('dashboard.site_review.approve', ['id' => $review->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-bank m-btn--icon m-btn--icon-only m-btn--pill" title="موافقة">
                                <i class="la la-check"></i>
                            </a>

                            <a href="{{ route('dashboard.site_review.reject', ['id' => $review->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-bank m-btn--icon m-btn--icon-only m-btn--pill" title="رفض">
                                <i class="la la-times"></i>
                            </a>
                        @elseif($review->status == '2')
                            <a href="{{ route('dashboard.site_review.approve', ['id' => $review->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-bank m-btn--icon m-btn--icon-only m-btn--pill" title="موافقة">
                                <i class="la la-check"></i>
                            </a>
                        @else
                        --
                        @endif
                        {{-- <a href="{{ route('dashboard.reviews.approve', ['id' => $review->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-bank m-btn--icon m-btn--icon-only m-btn--pill" title="موافقة">
                            <i class="la la-check"></i>
                        </a>

                        <a href="{{ route('dashboard.reviews.reject', ['id' => $review->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-bank m-btn--icon m-btn--icon-only m-btn--pill" title="رفض">
                            <i class="la la-times"></i>
                        </a> --}}
                        
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

        <!-- The text field -->

<!-- The button used to copy the text -->
{{-- <button onclick="copyText()">Copy text</button> --}}
    </div>

</div>
    <form id="newUrl" action="{{ route('dashboard.site_review.create') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')


<script>

function copyText(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}



// function copyText(urlId) {
//   /* Get the text field */
//   var copyText = document.getElementById("myInput-"+urlId);

//   console.log(copyText);

//   /* Select the text field */
//   copyText.select();
//   copyText.setSelectionRange(0, 99999); /*For mobile devices*/

//   /* Copy the text inside the text field */
//   document.execCommand("copy");

//   /* Alert the copied text */
//   alert("Copied the text: " + copyText.value);
// }

</script>
@endpush