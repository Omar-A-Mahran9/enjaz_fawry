@extends('engazFawry.layouts.dashboard')


@section('dashboard')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="  {{ route('client_dashboard') }}">لوحة التحكم</a></li>
      <li class="breadcrumb-item"><a href="  {{ route('panel.balance') }}">الحسابات</a></li>
      <li class="breadcrumb-item active" aria-current="page">التحويلات</li>
    </ol>
  </nav>

   <div class="sepTabs row">
    <div class="col-md-4">
      <a href="{{ route('panel.balance')}}">الرصيد</a>
    </div>
    <div class="col-md-4">
      <a href="{{ route('withdrawal.index')}}"  >طلبات المسحوبات</a>
    </div>
    <div class="col-md-4">
      <a href="{{ route('tranfers.index')}}" class="active">التحويلات</a>
    </div>
  </div> {{-- sepTabs --}}

<div class="aside-row p-2 mb-3">


   
{{-- @dd($order_ta3med) --}}
  @if($vendor_withdrawal_count > 0 )

<div class="table-responsive-sm">
  <table class="table table-striped text-right">
      <thead>
        <tr>
          <th scope="col"># رقم الطلب</th>
          <th scope="col">حالة الطلب</th>
          <th scope="col">المبلغ</th>
          <th scope="col">تاريخ الطلب</th>
          <th scope="col">اجراءات</th>
        </tr>
      </thead>
      <tbody>
{{-- @dd($balance); --}}
        @foreach($vendor_withdrawal as $w)
            
            {{-- @php 
               array_push($bId, $b->id)  
            @endphp --}}
            <tr>
                <th scope="row">{{ $w->id }} </th>
                <td>
                  @if($w->status == "-1")
                    جديد 
                  @elseif($w->status == "0")
                    مرفوض
                  @elseif($w->status == "1")
                    تم التحويل
                  @else

                  @endif
                </td>

                <td>
                  {{ $w->total_amount }} ر.س
                </td>
                
                {{-- <td>{{ $b['total_price'] }} ر.س</td> --}}
                <td>{{ $w->created_at->format('d-m-Y') }}</td>
                <td>
                  <a href="{{ route('withdraw.show', ['wid' => $w->id]  ) }} " title="معاينة">
                    <i class="fa fa-eye"></i> عرض
                  </a>
                </td>
              </tr>
          @endforeach
      </tbody>
    </table>
     </div> {{-- table-responsive-sm  --}}
@php 

    // $bids = implode($bId, ',');

@endphp

  @else  
    <div class="text-right">
      لا توجد طلبات سحب بحسابك
    </div>
   
  @endif

   

    
    
@endsection