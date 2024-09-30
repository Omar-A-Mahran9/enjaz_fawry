@extends('engazFawry.layouts.dashboard')


@section('dashboard')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="  {{ route('client_dashboard') }}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active" aria-current="page">طلبات تم تنفيذها</li>
    </ol>
  </nav>
<div class="aside-row p-2 mb-3">



  @if($process_count > 0 )
<div class="table-responsive-sm">
  <table class="table table-striped text-right">
      <thead>
        <tr>
          <th scope="col"># رقم الطلب</th>
          <th scope="col">حالة الطلب</th>
          <th scope="col">الجهة</th>
          <th scope="col">السعر</th>
          <th scope="col">تاريخ الطلب</th>
          <th scope="col">اجراءات</th>
        </tr>
      </thead>
      <tbody>

        @foreach($process as $proc)
            

         @if (  App\Order_mo3amla::withTrashed()->find($proc['mo3amla_id'])->trashed())

                    
            
           
          @else 
          
             
            <tr>
                <th scope="row">{{ $proc['id'] }} </th>
                <td>
                    @if(  $proc['status'] == -1 || $proc['status'] == 0)
                      جديد
                    @else


                     تم تقديم السعر


                    @endif

                </td>
                <td>{{-- 
                 getServiceName($proc->mo3amla['service_id'])
                --}} 
                  {{ $proc->mo3amla->service->name  }}
              </td>
                {{-- $proc->mo3amla->service->name --}}
                <td>
                  @if( $proc['price'] != Null)
                    {{$proc['price']}} ر.س
                  @else
                    --
                  @endif
                </td>
                <td>{{ $proc['created_at']->format('d-m-Y') }}</td>
                <td>
                  <a href="{{ route('order.show', $proc['id']  ) }} " title="معاينة">
                    <i class="fa fa-eye"></i> عرض
                  </a>
                </td>
              </tr>

              @endif
          @endforeach
      </tbody>
    </table>
 </div> {{-- table-responsive-sm  --}}
  @else  
    <div class="text-right">
      لا توجد طلبات تم تنفيذها 
    </div>
   
  @endif
      

       

@endsection