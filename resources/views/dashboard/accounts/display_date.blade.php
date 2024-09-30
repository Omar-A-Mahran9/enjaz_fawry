@extends('layouts.dashboard')
@push('page_styles')

@endpush
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    @if(isset($dateTemplate) && $dateTemplate == 'fromBegining')
                        ملخص العملبات المنفذة : منذ البداية
                    @elseif(isset($dateTemplate) && $dateTemplate == 'thisMonth')
                            ملخص العملبات المنفذة : شهر {{ date('m-Y')}}
                    @elseif(isset($dateTemplate) && $dateTemplate == 'fromTo' && isset($from) && isset($to))
                            ملخص العملبات المنفذة : من تاريخ {{ $from->format('Y-m-d')}} حتى تاريخ {{ $to->format('Y-m-d') }}
                    @else
                       العمليات من تاريخ الي تاريخ
                    @endif
                    
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    ارباح العمليات :
                </li>
                <li class="m-portlet__nav-item mawadTopHead">
                    المعاملات : {{ $m_total_enjaz }} ر.س
                </li>
                <li class="m-portlet__nav-item mawadTopHead">
                    التعميد : {{ $m_ta3med_price }} ر.س
                </li>
                <li class="m-portlet__nav-item mawadTopHead">
                    الاستفسار : {{ $m_total_estfsar }} ر.س
                </li>
                
            </ul>
        </div>
    </div>
    <div class="m-portlet__body">


    @if(!empty($orders) )

  <table class="table text-right">
      <thead>
        <tr>
          <th scope="col"># </th>
          <th scope="col"> رقم الطلب</th>
          <th scope="col">النوع</th>
          <th scope="col">حالة الطلب</th>
          <th scope="col">ارباح انجاز</th>
          <th scope="col">تكلفة الطرف الثالث</th>
          <th scope="col">الرسوم الحكومية</th>
          <th scope="col">تاريخ الطلب</th>
          <th scope="col">اجراءات</th>
        </tr>
      </thead>
      <tbody>

        @foreach($orders as $index => $order)
            
             
            <tr>

                 <td>{{ $index+1 }}</td>
                <th scope="row">{{ $order['order_no'] }} </th>

                <td>
                    @if($order['type'] == 'mo3amla')
                        معاملة
                    @elseif($order['type'] == 'estfsar')
                        استفسار
                    @elseif($order['type'] == 'ta3med')
                        تعميد
                    @endif
                </td>
                <td>

                    {{  getStatusAdmin($order['status']) }}

                </td>

                
                <td>{{ $order['price_revenue'] }} ر.س</td>
                <td>{{ $order['price_thirdParty'] }} ر.س</td>
                <td>{{ $order['price_gov'] }} ر.س</td>
                <td>{{ $order['date'] }}</td>
                <td>
                    @if($order['type'] == 'mo3amla')
                        <a target="_blank" href="{{ route('dashboard.order.mo3amla.show', ['id' => $order['id'] ]) }} " title="معاينة">
                    @elseif($order['type'] == 'estfsar')
                         <a target="_blank" href="{{ route('dashboard.order.estfsar.show', ['id' =>$order['id'] ]) }} " title="معاينة">
                    @elseif($order['type'] == 'ta3med')
                         <a target="_blank" href="{{ route('dashboard.order.ta3med.show',  ['id' => $order['id'] ]  ) }} " title="معاينة">

                    @endif
                    <i class="fa fa-eye"></i> عرض
                  </a>
                </td>
              </tr>
          @endforeach
      </tbody>
    </table>

  @else  
    <div class="text-center" style="color:red">
      لا توجد طلبات بالتاريخ المدخل
    </div>
   
  @endif
      

    </div>

</div>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush
