@extends('engazFawry.layouts.dashboard')


@section('dashboard')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="  {{ route('client_dashboard') }}">لوحة التحكم</a></li>
      <li class="breadcrumb-item"><a href="  {{ route('panel.balance') }}">الحسابات</a></li>
      <li class="breadcrumb-item active" aria-current="page">الرصيد</li>
    </ol>
  </nav>


   <div class="sepTabs row">
    <div class="col-md-4">
      <a href="{{ route('panel.balance')}}" class="active">الرصيد</a>
    </div>
    <div class="col-md-4">
      <a href="{{ route('withdrawal.index')}}" >طلبات المسحوبات</a>
    </div>
    <div class="col-md-4">
      <a href="{{ route('tranfers.index')}}">التحويلات</a>
    </div>
  </div> {{-- sepTabs --}}


<div class="aside-row p-2 mb-3">

{{-- @dd($order_ta3med) --}}
  @if($balance_count > 0 )

   <div class="alert alert-success text-right">

      <span>  رصيد الحساب: 

        @php
            $bb = 0;
            $bId = [];
        @endphp

        @foreach($balance as $b)

          @php
            $bb += $b->vendor_price;
          @endphp

        @endforeach

        {{ $bb }} ر.س

      </span>
          @php   
           $have_pending_withdraw = 0;
          @endphp

        @if($user->vendor_withdrawal()->exists())

          @php   
            $have_pending_withdraw = 0;
          @endphp
       
          @if($user->vendor_withdrawal->whereIn('status', ['-1', 0])->count() > 0)

            @foreach ($user->vendor_withdrawal as $wi)

              @php   
                $have_pending_withdraw = 0;
                  if($wi->status == '-1' ){
                    $have_pending_withdraw++;
                  }
              @endphp

            @endforeach

            
          
          @endif



          

            {{-- @else 
              <a href="#">طلب سحب الرصيد </a>
              <a style="margin: 2px 0; float:left;padding: 2px 11px;margin-top: -3px;" onclick="event.preventDefault();document.getElementById('askWithdrawal').submit();" href="{{ route('dashboard.order.mo3amla.paymentStatus', ['id' => $user->id ]) }}"  class="btn btn-success">طلب سحب الرصيد </a>
              --}}
        @endif



        @if($have_pending_withdraw > 0 && $bb > 0)

              <a style="margin: 2px 0; float:left;padding: 2px 11px;margin-top: -3px;" href="{{ route('withdrawal.index') }}"  class="btn btn-success">الطلبات السابقة </a>
              <span style="float:left;margin-left:7px; "> يوجد طلب سحب رصيد سابق</span>

              @elseif($have_pending_withdraw == 0 && $bb == 0)
                 
              

              @elseif($have_pending_withdraw == 0 && $bb > 0)
                  
                {{-- <a href="#">طلب سحب الرصيد </a> --}}
                <a style="margin: 2px 0; float:left;padding: 2px 11px;margin-top: -3px;" onclick="event.preventDefault();document.getElementById('askWithdrawal').submit();" href="{{ route('dashboard.order.mo3amla.paymentStatus', ['id' => $user->id ]) }}"  class="btn btn-success">طلب سحب الرصيد </a>

              @else 
                {{-- <a href="#">طلب سحب الرصيد </a> --}}
                <a style="margin: 2px 0; float:left;padding: 2px 11px;margin-top: -3px;" onclick="event.preventDefault();document.getElementById('askWithdrawal').submit();" href="{{ route('dashboard.order.mo3amla.paymentStatus', ['id' => $user->id ]) }}"  class="btn btn-success">طلب سحب الرصيد </a>
  
            @endif
   </div>



@if($have_pending_withdraw == 0  && $bb > 0)
<div class="table-responsive-sm">
  <table class="table table-striped text-right" >
      <thead>
        <tr>
          <th scope="col"># رقم الطلب</th>
          <th scope="col">حالة الطلب</th>
          <th scope="col">المبلغ</th>
          <th scope="col">تاريخ الطلب</th>
          {{-- <th scope="col">اجراءات</th> --}}
        </tr>
      </thead>
      <tbody>
{{-- @dd($balance); --}}
        @foreach($balance as $b)
            
            @php 
               array_push($bId, $b->id)  
            @endphp
            <tr>
                <th scope="row">{{ $b->order->order_no }} </th>
                <td>
                  {{ getStatusUser($b->order->status) }}
                </td>

                <td>
                  {{ $b->vendor_price }} ر.س
                </td>
                
                {{-- <td>{{ $b['total_price'] }} ر.س</td> --}}
                <td>{{ $b['created_at']->format('d-m-Y') }}</td>
                {{-- <td>
                  <a href="{{ route('balance.show', $b['id']  ) }} " title="معاينة">
                    <i class="fa fa-eye"></i>
                  </a>
                </td> --}}
              </tr>
          @endforeach
      </tbody>
    </table>
 </div> {{-- table-responsive-sm  --}}
    @else 

      <p style="text-align:center;">لا يوجد معاملات معلقة </p>

    @endif



@php 

    $bids = implode($bId, ',');

@endphp
 <form id="askWithdrawal" action="{{ route('balance.ask.withdraw') }}" method="POST" style="display: none;">
        {{-- @method('PUT') --}}
        @csrf
        <input type="hidden" name="vendor_id" value="{{ $user->id }}">
        <input type="hidden" name="TotalBalance" value="{{ $bb }}">
        <input type="hidden" name="balanceIds" value="{{ $bids }}">

    </form>
{{-- @dd($bids) --}}
  @else  
    <div class="text-right">
      لا توجد ارصدة معاملات بحسابك
    </div>
   
  @endif

   

    
    
@endsection