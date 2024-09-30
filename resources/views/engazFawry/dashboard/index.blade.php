@extends('engazFawry.layouts.dashboard')


@section('dashboard')

<div class="aside-row-home p-2 mb-3">


        <div class="row text-center">

          <div class="col-md-4">
            <div class="mawadCard">
              <div class="mawadCard-title">
                المعاملات
                <span class="mawadCard-count">{{ $mo3amla_orders_count }}</span>
              </div>

              @if($mo3amla_orders_count > 0)
              <div class="mawadCard-content">

                <ul class="mawadCard-orders">
                  <?php $countB = 0; ?>
                  @foreach ($mo3amla_orders as $mo3mla)

                  <?php if($countB == 3) break; ?>
              
                  <li>
                    <a href="{{ route('mo3amla.show', $mo3mla->id  ) }}">
                      {{$mo3mla->order_no }} > {{ str_limit($mo3mla->service->name, $limit = 17, $end = '...')  }}
                    </a>
                  </li>
                  <?php $countB++; ?>
                  @endforeach

                  <li>
                    <a href="{{ route('panel.mo3amla') }}">
                      جميع الطلبات >>
                    </a>
                  </li>
                </ul>
              </div>
              @else

              <div class="mawadCard-content-noData">
                لا يوجد طلبات معاملات بحسابك 

                <br>

               

              </div>
              @endif 
              <div class="mawadCard-footer">
                <a href="{{ route('mo3amla')}}"> انشاء طلب معاملة جديد</a>
              </div>
            </div>
          </div>





          <div class="col-md-4 col-xs-12">
            <div class="mawadCard">

              <div class="mawadCard-title">
                طلبات التعميد
                <span class="mawadCard-count">{{ $ta3med_orders_count }}</span>
              </div>
              @if($ta3med_orders_count > 0)
              <div class="mawadCard-content">

                <ul class="mawadCard-orders">


                  <?php $countA = 0; ?>
                  @foreach ($ta3med_orders as  $t3med)

                  <?php if($countA == 3) break; ?>
              
                  <li>
                    <a href="{{ route('ta3med.show', $t3med->id  ) }}">
                      {{$t3med->order_no }} > {{ str_limit($t3med->ta3med_details, $limit = 17, $end = '...')  }}
                    </a>
                  </li>
                  <?php $countA++; ?>
                  @endforeach
                  
                  

                  <li>
                    <a href="{{ route('panel.ta3med')}}">
                      جميع الطلبات  >>
                    </a>
                  </li>
                </ul>
              </div>
              @else

              <div class="mawadCard-content-noData">
                لا يوجد طلبات تعميد بحسابك 

                <br>

               

              </div>
              @endif 
              <div class="mawadCard-footer">
                <a href="{{ route('ta3med')}}">انشاء طلب تعميد جديد </a>
              </div>
            </div>
          </div>

          


          
          <div class="col-md-4 col-xs-12">
            <div class="mawadCard">
              <div class="mawadCard-title">
                الاستفسارات المدفوعة
                <span class="mawadCard-count">{{ $order_estfsar_count }}</span>
              </div>

              @if($order_estfsar_count > 0)
              <div class="mawadCard-content">

                <ul class="mawadCard-orders">
                 
                  
                  <?php $countC = 0; ?>
                  @foreach ($order_estfsar as $estfsar)

                  <?php if($countC == 3) break; ?>
              
                  <li>
                    <a href="{{ route('estfsar.show', $estfsar->id  ) }}">
                      {{$estfsar->order_no }} > {{ str_limit($estfsar->type, $limit = 17, $end = '...')  }}
                    </a>
                  </li>
                  <?php $countC++; ?>
                  @endforeach
                  

                  <li>
                  <a href="{{ route('panel.estfsar')}}">
                      جميع الطلبات >>
                    </a>
                  </li>
                </ul>
              </div>
              @else

              <div class="mawadCard-content-noData">
                لا يوجد طلبات استفسار بحسابك 

                <br>

               

              </div>
              @endif 
              <div class="mawadCard-footer">
                <a href="{{ route('estfsar')}}">انشاء استفسار جديد </a>
              </div>
            </div>
          </div>




        </div>

@endsection