@extends('engazFawry.layouts.dashboard')


@section('dashboard')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="  {{ route('client_dashboard') }}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active" aria-current="page">المعاملات</li>
    </ol>
  </nav>
<div class="aside-row p-2 mb-3">


{{-- @dd($order_ta3med) --}}
  @if($order_mo3amla_count > 0 )
<div class="table-responsive-sm">
  <table class="table table-striped text-right">
      <thead>
        <tr>
          <th scope="col"># رقم الطلب</th>
          <th scope="col">حالة الطلب</th>
          {{-- <th scope="col">اجمالي المبلغ</th> --}}
          <th scope="col">تاريخ الطلب</th>
          <th scope="col">اجراءات</th>
        </tr>
      </thead>
      <tbody>

        @foreach($order_mo3amla as $mo3amla)
            
             
            <tr>
                <th scope="row">{{ $mo3amla['order_no'] }} </th>
                <td>

                  {{ getStatusUser($mo3amla['status']) }}
                    {{-- @if(( $mo3amla['status'] == -1 || $mo3amla['status'] == 0) && $mo3amla['processing_id']== NULL)
                      جديد
                    @else
                    {{  $mo3amla->processing->name }}

                    @endif --}}
                </td>
                
                {{-- <td>{{ $mo3amla['total_price'] }} ر.س</td> --}}
                <td>{{ $mo3amla['created_at']->format('d-m-Y') }}</td>
                <td>
                  <a href="{{ route('mo3amla.show', $mo3amla['id']  ) }} " title="معاينة">
                    <i class="fa fa-eye"></i> عرض
                  </a>
                </td>
              </tr>
          @endforeach
      </tbody>
    </table>
 </div> {{-- table-responsive-sm  --}}
  @else  
    <div class="text-right">
      لا توجد طلبات معاملات بحسابك
    </div>
   
  @endif
      

    
@endsection