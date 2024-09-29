@extends('engazFawry.layouts.app')
@section('content')
<section class="light">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="aside">
            <div class="aside-head p-3 text-right">
              <i class="fa fa-cogs"></i>
              <h5  class="d-inline">لوحة التحكم</h5>
            
              @if(isset($notify) && $notify >0)<span class="notification"> {{ $notify }}</span> @endif
              <button class="navbar-toggler mr-auto d-lg-none" style="float:left; outline: none!important;" type="button" data-toggle="collapse" data-target="#navbar">
                <span class="navbar-toggler-icon"><i style="color:#fff" class="fa fa-bars fa-1x"></i></span>
              </button>
            </div>
            <div class="aside-body p-2z">
            <nav class="navbar-expand-lg p-0" style="z-index: -1;">
              <div class="navbar-collapse collapse container" id="navbar">
                <ul class="nav text-right pr-0" style="width:100%; height:auto;display:block">
                   <li class="nav-item {{ (\Request::route()->getName() == 'client_dashboard') ? 'active' : '' }}">
                      <a class="nav-link" href="{{ route('client_dashboard') }}"><i class="fa fa-home"></i>الشاشة الرئيسية </a>
                    </li>
                    <li class="nav-item {{ (\Request::route()->getName() == 'my.orders.new') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('my.orders.new')}}"><i class="fa fa-briefcase"></i> طلباتي </a>
                      {{-- <ul>
                        <li class="{{ (\Request::route()->getName() == 'panel.estfsar') ? 'active' : '' }}"><a class="nav-link" href="{{ route('panel.estfsar') }}"><i class="fa fa-puzzle-piece"></i>  الاستفسارات </a></li>
                        <li class="{{ (\Request::route()->getName() == 'panel.mo3amla') ? 'active' : '' }}"><a class="nav-link" href="{{ route('panel.mo3amla') }}"><i class="fa fa-inbox"></i> المعاملات </a></li>
                        <li class="{{ (\Request::route()->getName() == 'panel.ta3med') ? 'active' : '' }}"><a class="nav-link" href="{{ route('panel.ta3med') }}"><i class="fa fa-send"></i> التعميد </a></li>
                      </ul> --}}
                    </li>
                    {{-- <li class="nav-item {{ (\Request::route()->getName() == 'panel.bills') ? 'active' : '' }}">
                      <a class="nav-link" href="{{ route('panel.bills') }}"><i class="fa fa-print"></i>الفواتير </a>
                    </li> --}}
                    


                    <?php 
          
                      $status = $user->status; 
                      $type = $user->type;
                      
                      $route = \Request::route()->getName();
                      ?>
                        
                      @if ($type == 'vendor' || $type == 'vendorC')

                        
                        @if($status == 1)
                          
                          <li class="nav-item ">
                            <a class="nav-link" href="{{ route('panel.setting') }}"><i class="fa fa-envelope"></i> طلبات العملاء</a>
                              <ul>
                                <li class="{{ (\Request::route()->getName() == 'orders.new') ? 'active' : '' }}"><a class="nav-link" href="{{ route('orders.new') }}"><i class="fa fa-puzzle-piece"></i>  الطلبات الجديدة @if(isset($notify) && $notify >0)<span class="notification"> {{ $notify }}</span> @endif</a></li>
                                <li class="{{ (\Request::route()->getName() == 'orders.on_going') ? 'active' : '' }}"><a class="nav-link" href="{{ route('orders.on_going') }}"><i class="fa fa-inbox"></i> طلبات قيد الاجراء </a></li>
                                <li class="{{ (\Request::route()->getName() == 'orders.finished') ? 'active' : '' }}"><a class="nav-link" href="{{ route('orders.finished') }}"><i class="fa fa-send"></i> طلبات منتهية </a></li>
                              </ul>
                          </li>
                          <li class="nav-item @if( $route == 'panel.balance'   ||    $route == 'withdrawal.index'  ||  $route == 'tranfers.index' )  active @else  @endif">
                            <a class="nav-link" href="{{ route('panel.balance') }}"><i class="fa fa-university"></i> الحسابات</a>
                          </li>
                        @endif
                      @endif

                    <li class="nav-item {{ (\Request::route()->getName() == 'panel.setting') ? 'active' : '' }}">
                      <a class="nav-link" href="{{ route('panel.setting') }}"><i class="fa fa-cog"></i> بيانات الحساب</a>
                    </li>
                    
                  </ul>
                </div>
              </nav>
            </div>
          </div>
        </div>

        {{-- @if ($errors->any())
                <div class="alert alert-danger justify-content-center mt-5">
                    <ul class="">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif --}}

        <div class="col-lg-8 p-2z">

          @if (Auth::check())

          
            <?php 
            $user = auth()->user();
            $status = $user->status; 
            $type = $user->type;?>
               

             @if ($type == 'vendor' || $type == 'vendorC')

                @if ($status == 0 || $status == -1 || $status == -2)

                  <div class="alert alert-danger text-right">
                      عفوا حسابك غير مفعل حاليا ... لا يمكنك استقبال طلبات العملاء 
                  </div>

                @endif
              @endif
          @endif


          @yield('dashboard')


          

          

        </div>
      </div>
    </div>
  </section>

  <script>
  



$(".imagePreview").change(function() {
  
   if (this.files && this.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('.imageThumb').attr('src', e.target.result);
    }
    
   reader.readAsDataURL(this.files[0]);
  }

});


  </script>

  @if(isset($success))
  @php
    echo $success;
  @endphp
@endif	
@endsection