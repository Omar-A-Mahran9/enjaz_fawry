<div class="vendor text-right">

    


    <div class="topData">
        <h4>الاسم : {{ $vendor->name }}</h4>
        <p>رقم الحساب : {{ $vendor->account_no }}</p>
        @if($vendor->vendor_has_reviwes()->exists() && $vendor->vendor_has_reviwes->count() > 0)
            @php 
                $total = 0;
                $i = 0;
            @endphp
            @foreach ($vendor->vendor_has_reviwes as $rev)
                @php 
                    $i++;
                    $total +=  $rev->stars;
                    $avg =  $total/$i;
                @endphp
            @endforeach
                <div class="goLeft">
                    {{-- Print Stars --}}
                    {!! printStars($avg) !!}
                <span> {{ $avg }} من 5 ( {{$i}} تقييم)</span>
                </div>
            @else 
            لا توجد تقييمات 
        @endif


        </div> {{-- topData --}}
        
   
        
       
        
       

        @if($vendor->vendor_has_reviwes()->exists() && $vendor->vendor_has_reviwes->count() > 0)
<hr>
         <div class="modalRate">
            @php 
                $ig = 0;
                // $vend = ;
            @endphp
            <h4 class="text-right engaz-heading-dot-white" style="color: #fff;margin-bottom:21px;"> التقييمات</h4>

            @foreach ($vendor->vendor_has_reviwes->sortByDesc('id') as $rev)
                @php 
                    $ig++;
                    if($ig >= 3){
                        break;
                    }

                @endphp
                <div class="rateWrap">
                    <div class="rateContent">
                        <p>{{ $rev->user_did_reviwes->name }}</p>
                        <p>{{ $rev->description }}</p>
                    </div>
                    <div class="rateSt">
                          {!! printStars($rev->stars) !!}
                    </div>
                </div>

                @php 
                    // $i++;
                    // $total +=  $rev->stars;
                    // $avg =  $total/$i;
                @endphp
            @endforeach
            {{-- Print Stars --}}
          
            {{-- @else 
            لا توجد تقييمات  --}}

               </div>
        @endif

</div>