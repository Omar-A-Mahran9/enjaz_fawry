@extends('engazFawry.layouts.dashboard')


@section('dashboard')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="  {{ route('client_dashboard') }}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active" aria-current="page">الاستفسارات</li>
    </ol>
  </nav>
<div class="aside-row p-2 mb-3">



  @if($order_estfsar_count > 0 )
<div class="table-responsive-sm">
  <table class="table table-striped text-right">
      <thead>
        <tr>
          <th scope="col"># رقم الطلب</th>
          <th scope="col">حالة الطلب</th>
          <th scope="col">السعر</th>
          <th scope="col">تاريخ الطلب</th>
          <th scope="col">اجراءات</th>
        </tr>
      </thead>
      <tbody>

        @foreach($order_estfsar as $estfsar)
            
             
            <tr>
                <th scope="row">{{ $estfsar['order_no'] }} </th>
                <td>
                    {{-- @if( ( $estfsar['status'] == -1 || $estfsar['status'] == 0) && $estfsar['processing_id']== NULL)
                      جديد
                    @else


                    {{  $estfsar->processing->name }}


                    @endif --}}
                {{ getStatusUser($estfsar->status) }}
                </td>
                <td>{{ $estfsar['price'] }} ر.س</td>
                <td>{{ $estfsar['created_at']->format('d-m-Y') }}</td>
                <td>
                  <a href="{{ route('estfsar.show', $estfsar['id']  ) }} " title="معاينة">
                    <i class="fa fa-eye"></i>
                  </a>
                </td>
              </tr>
          @endforeach
      </tbody>
    </table>
 </div> {{-- table-responsive-sm  --}}
  @else  
    <div class="text-right">
      لا توجد طلبات استفسارات بحسابك
    </div>
   
  @endif
      

       

@endsection