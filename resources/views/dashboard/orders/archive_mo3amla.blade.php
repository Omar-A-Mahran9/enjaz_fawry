@extends('layouts.dashboard')
@push('page_styles')
@endpush

@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                  ارشيف المعاملات
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                        <a href="{{ route('dashboard.order.mo3amla.index') }}" class="btn btn-success m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-bullseye"></i>
                            <span>
                                طلبات المعاملات الجديدة / قيد التنفيذ
                                </span>
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
                    <th>رقم الطلب</th>
                    <th>العميل</th>
                    <th>نوع الحساب</th>
                    <th>جهة المعاملة</th>
                    <th>موضوع المعاملة</th>                
                    <th>تفاصيل المعاملة</th>
                    <th>طريقة الدفع</th>
                    <th>حالة الدفع</th>
                    <th>توقيت الطلب</th>
                    <th>منذ</th>
                    <th>حالة الطلب</th>
                    <th>معالجة الطلب</th>
                    <th>الخيارات</th>
                </tr>
            </thead>
            <tbody>
                   
               @foreach ($orders as $index => $order)
               
               <tr @if($order->status == -1) style="color:brown" @endif>
                    <td>
                        <input type="checkbox" class="ids" name="status" value="{{ $order->id }}"> 
                    </td>
                    <td>
                        {{ $order->order_no }}
                    </td>
                    <td>
                       <a target="_blank" href="{{ route('dashboard.users.client_show', ['id' => $order->orderUser->id ]) }}"> {{ $order->orderUser->name }} </a>
                    </td>
                    <td>
                        {{  getUserType($order->orderUser->type)}}
                    </td>
                    <td>
                        {{ $order->service->name }}
                    </td>
                    <td>
                        {{ $order->mo3amla_subject }} 
                    </td>
                    <td>
                        {{ $order->mo3amla_details }}
                    </td>
                   
                    <td>
                        @if ($order->payment_method == 'transfer')
                           تحويل بنكي
                        @elseif($order->payment_method == 'online_payment')
                            دفع اونلاين
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if ($order->prove_status == 0 && $order->transfer_prove == 0)
                           غير مؤكد
                        @elseif($order->prove_status == -1 && $order->transfer_prove != 0)
                            مرفوض
                        @elseif($order->prove_status == 1 && $order->transfer_prove != 0)
                            مؤكد
                        @elseif($order->prove_status == 0 && $order->transfer_prove != 0)
                            بانتظار التعميد
                        @else
                            --
                        @endif
                    </td>
                   <td>
                        {{-- {{ $order->created_at->format('d-m-Y') }} --}}
                        {{ $order->created_at }}
                    </td>

                    <td>{{ $order->created_at->subMinutes(2)->diffForHumans() }}</td>
                    
                    {{-- <td>
                        @if($order->link_id != null) {{ $order->link->title }} @endif
                    </td>    --}}

                    <td>
                        {{  getStatusAdmin($order->status) }}
                    </td>
                    <td>
                        @if ($order->processing_id == NULL)
                            لم تتم معالجة الطلب
                        @else

                        
                            @if( $order->processing()->exists() )
                                {{  $order->processing->name }}
                            @else
                                تم حذف الحالة
                            @endif

                        @endif
                        
                    </td>
                    
                    <td>
                        <a href="{{ route('dashboard.order.mo3amla.show', ['id' => $order->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-order m-btn--icon m-btn--icon-only m-btn--pill" title="عرض">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a onclick="event.preventDefault(); document.getElementById('delete_form_{{$index}}').submit();" href="{{ route('dashboard.order.mo3amla.destroy', ['id' => $order->id ]) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-order m-btn--icon m-btn--icon-only m-btn--pill" title="حذف">
                            <i class="fa fa-window-close"></i>
                        </a>
                        <form id="delete_form_{{$index}}" action="{{ route('dashboard.order.mo3amla.destroy', ['id' => $order->id ]) }}" method="POST" style="display: none;">
                            @method("DELETE")
                            {{-- {{ method_field('DELETE') }} --}}
                            @csrf
                        </form>

                    </td>
                </tr>                   
               @endforeach
               
            </tbody>
        </table>
        {!! $orders->links() !!}
    </div>
    <form method="POST" action="{{route('dashboard.order.mo3amla.statusUpdate')}}" class="m-form m-form--label-align-left- m-form--state- " id="m_form">
        @csrf
        @method('POST')
        <!--begin: Form Body -->
        <div class="m-portlet__body">
            <div class="row">
                <div class="col-xl-8 offset-xl-2">
                    <div class="m-form__actions m-form__actions--solid">
                        <div class="form-group m-form__group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">معالجة الطلبات المحددة</label>
                            
                            <div class="col-xl-6 col-lg-9">

                                <select name="processing_id" class="form-control m-input">
                                    <option value="">اختار حالة</option>
                                    @foreach ($statuses as $status)
                                        
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>

                                    @endforeach
                                </select>

                            </div>

                            <input type="hidden" name="ids_input" id="12121212">

                            <button type="submit" class="btn btn-accent col-xl-3 col-lg-3 update_status" onclick="getValueUsingClass()">تحديث الحالة</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('page_vendors')
@endpush

@push('page_scripts')

<script>
    function getValueUsingClass(){
        
        /* declare an checkbox array */
        var ids = [];
        
        /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
        $(".ids:checked").each(function() {
            ids.push($(this).val());
        });
        
        /* we join the array separated by the comma */
        var selected;
        selected = ids.join(',') ;

        $("select[name='ids_input'").val('sdfds');
        $('#12121212').val(selected);

    }
</script>
@endpush
