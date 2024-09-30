@extends('engazFawry.layouts.dashboard')


@section('dashboard')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="  {{ route('client_dashboard') }}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active" aria-current="page">طلباتي</li>
      <li class="breadcrumb-item active" aria-current="page">الطلبات الجديدة</li>
    </ol>
  </nav>

  <div class="sepTabs row">
    <div class="col-md-4">
      <a href="{{ route('my.orders.new')}}" class="active">الطلبات الجديدة</a>
    </div>
    <div class="col-md-4">
      <a href="{{ route('my.orders.onprocess')}}" >طلبات قيد التنفيذ</a>
    </div>
    <div class="col-md-4">
      <a href="{{ route('my.orders.finished')}}"> الطلبات المنتهية</a>
    </div>
  </div> {{-- sepTabs --}}

<div class="aside-row p-2 mb-3">


{{-- @dd($order_ta3med) --}}
  @if(!empty($orders) )
<div class="table-responsive-sm">
  <table class="table table-striped text-right">
      <thead>
        <tr>
          <th scope="col"># رقم الطلب</th>
          <th scope="col">النوع</th>
          <th scope="col">حالة الطلب</th>
          {{-- <th scope="col">اجمالي المبلغ</th> --}}
          <th scope="col">تاريخ الطلب</th>
          <th scope="col">اجراءات</th>
        </tr>
      </thead>
      <tbody>

        @foreach($orders as $order)
            
             
            <tr>
                <th scope="row">{{ $order['order_no'] }} </th>

                <td>
                    @if($order['type'] == 'mo3amla')
                        معاملة
                    @elseif($order['type'] == 'estfsar')
                        استفسار
                    @elseif($order['type'] == 'ta3med')
                        تعميد
                    @elseif($order['type'] == 'guarante')
                        ضمان مبلغ سلعة  
                    @endif
                </td>
                <td>
                    {{-- @if(( $order['status'] == -1 || $order['status'] == 0) && $order['processing_id']== NULL)
                        جديد
                    @else
                        {{  $order->processing->name }}
                    @endif --}}
                    {{ getStatusUser($order['status']) }}
                </td>
                
                {{-- <td>{{ $mo3amla['total_price'] }} ر.س</td> --}}
                <td>{{ $order['date'] }}</td>
                <td>
                    @if($order['type'] == 'mo3amla')
                        <a href="{{ route('mo3amla.show', $order['id']  ) }} " title="معاينة">
                    @elseif($order['type'] == 'estfsar')
                         <a href="{{ route('estfsar.show', $order['id']  ) }} " title="معاينة">
                    @elseif($order['type'] == 'ta3med')
                         <a href="{{ route('ta3med.show', $order['id']  ) }} " title="معاينة">
                    @elseif($order['type'] == 'guarante')
                          <a href="{{ route('guarante.show', $order['id']  ) }} " title="معاينة">
                    @endif
                 
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
      لا توجد طلبات جديدة بحسابك
    </div>
   
  @endif
      

    
@endsection