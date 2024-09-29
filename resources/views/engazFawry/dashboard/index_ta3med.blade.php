@extends('engazFawry.layouts.dashboard')


@section('dashboard')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="  {{ route('client_dashboard') }}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active" aria-current="page">طلبات التعميد</li>
    </ol>
  </nav>
<div class="aside-row p-2 mb-3">


{{-- @dd($order_ta3med) --}}
  @if($order_ta3med_count > 0 )
<div class="table-responsive-sm">
  <table class="table table-striped text-right">
      <thead>
        <tr>
          <th scope="col"># رقم الطلب</th>
          <th scope="col">حالة الطلب</th>
          <th scope="col">اجمالي المبلغ</th>
          <th scope="col">تاريخ الطلب</th>
          <th scope="col">اجراءات</th>
        </tr>
      </thead>
      <tbody>

        @foreach($order_ta3med as $ta3med)
            
             
            <tr>
                <th scope="row">{{ $ta3med['order_no'] }} </th>
                <td>
                    {{-- @if(( $ta3med['status'] == -1 || $ta3med['status'] == 0)  && $ta3med['processing_id']== NULL )
                      جديد
                    @else
                    {{  $ta3med->processing->name }}

                    @endif --}}

                    {{ getStatusUser($ta3med->status) }}
                </td>
                
                <td>{{ $ta3med['total_price'] }} ر.س</td>
                <td>{{ $ta3med['created_at']->format('d-m-Y') }}</td>
                <td>
                  <a href="{{ route('ta3med.show', $ta3med['id']  ) }} " title="معاينة">
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
      لا توجد طلبات تعميد بحسابك
    </div>
   
  @endif
      

       

@endsection