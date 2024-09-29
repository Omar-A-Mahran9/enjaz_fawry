@extends('engazFawry.layouts.app')
@section('content')
<section class="light">
    <div class="container">
      <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
          <div class="text-center">
            <h2 class="text-right engaz-heading-dot-light" style="font-size:38px!important;">مكاتب الخدمات</h2>
          </div>
          <div>
            @csrf

            @foreach ($vendorCs as $vendorC)

                <div class="row text-center text-md-right user">
                    <div class="col-12 col-lg-4">

                      @if(!empty($vendorC->vendor_image) ||  $vendorC->vendor_image != NULL)
                        <img class="rounded-circle" width="100" src="{{ asset('storage/profile_image') . '/'.$vendorC->vendor_image }}" alt="{{ $vendorC->name }}">

                      @else

                        @if($vendorC->gender == 'male')
                          <img class="rounded-circle" width="100" src="{{ asset('images/default_man.png')}}" alt="{{ $vendorC->name }}">
                        @elseif($vendorC->gender == 'female')
                          <img class="rounded-circle" width="100" src="{{ asset('images/default_woman.png')}}" alt="{{ $vendorC->name }}">
                        @else 
                          <img class="rounded-circle" width="100" src="{{ asset('images/default_man.png')}}" alt="{{ $vendorC->name }}">
                        @endif
                    
                      @endif

                    </div>
                    <div class="col-12 col-lg-4 user-info">
                      <h1>{{ $vendorC->name }}</h1>

                      @if($vendorC->vendor_has_reviwes()->exists() && $vendorC->vendor_has_reviwes->count() > 0)
                        @php 
                          $totalC = 0;
                          $iC = 0;
                        @endphp
                        @foreach ($vendorC->vendor_has_reviwes as $revC)
                          @php 
                            $iC++;
                            $totalC +=  $revC->stars;
                            $avgC =  $totalC/$iC;
                          @endphp
                        @endforeach

                        {{-- Print Stars --}}
                        {!! printStars($avgC) !!}
                        <span class="rateCount"> {{ $avgC }} من 5 ( {{$iC}} تقييم)</span>
                        @else 
                          لا توجد تقييمات
                      @endif
                    </div>
                    <div class="col-12 col-lg-4">
                      {{-- <div class="row mt-2 justify-content-center">
                        <a href="#" class="user-light-btn transform">الملف الشخصي</a>
                      </div> --}}
                      <div class="row justify-content-center">
                      <a data-toggle="modal" data-user="{{ $vendorC->id}}" data-target="#myModal" style="margin-top: 20px;color: #3CBFAF;" class="user-light-btn transform getUserModal">المزيد</a>

                        {{-- <a data-toggle="modal" data-target="#myModal" class="user-dark-btn transform">الخدمات المتاحة</a> --}}
                      </div>
                    </div>
                  </div>
          @endforeach

                
          </div>

        </div>
<div class="col-2"></div>


        {{-- <div class="col-4">
          <div class="category p-5">
            <div class="row">
              <span style="margin-top:3px;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="41.346" height="21.346" viewBox="0 0 41.346 41.346">
                    <path id="Icon_awesome-filter" data-name="Icon awesome-filter" d="M39.406,0H1.94A1.94,1.94,0,0,0,.57,3.309L15.5,18.246v16.64a1.938,1.938,0,0,0,.827,1.588l6.46,4.521a1.939,1.939,0,0,0,3.05-1.588V18.246L40.776,3.309A1.94,1.94,0,0,0,39.406,0Z" fill="#3cbfaf"/>
                  </svg>                  
              </span>
              <h1 style="color: #3CBFAF;font-size:25px!important;">تصنيف حسب</h1>
            </div>
            <hr>
            <div class="row">
                <div class="checkbox checkbox-custom">
                    <input id="checkbox1" type="checkbox">
                    <label for="checkbox1" class="checkbox-custom-label">
                        لوريم أبيسوم
                    </label>
                  </div>
                  
            </div>
            <div class="row">
                <div class="checkbox checkbox-custom">
                    <input id="checkbox2" type="checkbox">
                    <label for="checkbox2" class="checkbox-custom-label">
                        لوريم أبيسوم
                    </label>
                  </div>
                  
            </div>
            <div class="row">
                <div class="checkbox checkbox-custom">
                    <input id="checkbox3" type="checkbox">
                    <label for="checkbox3" class="checkbox-custom-label">
                        لوريم أبيسوم
                    </label>
                  </div>
                  
            </div>
            <div class="row">
                <div class="checkbox checkbox-custom">
                    <input id="checkbox4" type="checkbox">
                    <label for="checkbox4" class="checkbox-custom-label">
                        لوريم أبيسوم
                    </label>
                  </div>
                  
            </div>
            <div class="row">
                <div class="checkbox checkbox-custom">
                    <input id="checkbox5" type="checkbox">
                    <label for="checkbox5" class="checkbox-custom-label">
                        لوريم أبيسوم
                    </label>
                  </div>
                  
            </div>
            <hr>
            <div class="row text-center justify-content-center">
                <a href="#" class="transform user-engaz-btn">تطبيق </a>
              </div>
          </div>
        </div> --}}

        
      </div>


    </div>
  </section>

<!-- The Modal -->
<div class="modal transform" id="userModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal body -->
        <div class="modal-body">
          <div class="text-right pb-5">
              <h2 class="text-right engaz-heading-dot-white" style="color: #fff;"> بيانات الحساب</h2>
            </div>
            <div id="ajaxRespons"></div>
          </div>
      </div>
    </div>
  </div>
@endsection


@push('page_scripts')
  <script>
    $(document).ready(function(){ 
      $(".getUserModal").on('click', function () {

          var user_id = $(this).data('user');

            var token = $("input[name='_token']").val();
            $.ajax({
                url: "{{ route('ajax.vendorData') }}",
                method: 'POST',
                data: {user_id:user_id, _token:token},
                success: function(data) {
                  $("#ajaxRespons").html(data.options);
                }
            });
        
          $('#userModal').modal('show');

      });

      $('#userModal').on('hidden.bs.modal', function () {
        $("#ajaxRespons").html('');
      });
    });
  </script>
@endpush