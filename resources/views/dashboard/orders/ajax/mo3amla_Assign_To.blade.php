<form action="{{ route('dashboard.order.mo3amla.AsignSubmit', ['id' => $procces->id ]) }}" method="POST">
    @csrf
    <input type="hidden" name="mo3amlaOrderId" value="{{ $procces->mo3amla->id }}">
    <input type="hidden" name="mo3amlaProcessOrderId" value="{{ $procces->id }}">
    <input type="hidden" name="vendor_id" value="{{ $procces->userz->id }}">
    <input type="hidden" name="vendor_price" value="{{ $procces->price }}">
    <div class="form-group m-form__group row">
        <label class="col-xl-4 col-lg-4 col-form-label">اسم المعقب / مكتب الخدمة:</label>
        <div class="col-xl-8 col-lg-8">
            <input type="text" disabled class="form-control m-input" name="vendor_name" value="{{ $procces->userz->name }}">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-xl-4 col-lg-4 col-form-label">النوع:</label>
        <div class="col-xl-8 col-lg-8">
            <input type="text" disabled class="form-control m-input" name="user_type" value="@if($procces->userz->type == 'vendor')معقب@elseif($procces->userz->type == 'vendorC') مكتب خدمات @else--@endif">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-xl-4 col-lg-4 col-form-label">عدد ايام تنفيذ الخدمة:</label>
        <div class="col-xl-8 col-lg-8">
            <input type="text" class="form-control m-input" name="days" value="{{ $procces->days }}">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-xl-4 col-lg-4 col-form-label">متطلبات التنفيذ:</label>
        <div class="col-xl-8 col-lg-8">
            <textarea type="text" class="form-control m-input summernote" name="requirments" >{{ $procces->requirement }}</textarea>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-xl-4 col-lg-4 col-form-label">سعر تنفيذ المعقب (الطرف الثالث):</label>
        <div class="col-xl-8 col-lg-8">
            <input type="number" readonly  class="form-control m-input" id="thirdparty_price" name="thirdparty_price" value="{{ $procces->price }}">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-xl-4 col-lg-4 col-form-label">اتعاب انجاز المعاملة:</label>
        <div class="col-xl-8 col-lg-8">

            @if($procces->mo3amla->price != Null)
                @php 
                $difPrice = $procces->mo3amla->price - $procces->mo3amla->m_processGovPrice -  $procces->price;
                @endphp
            @else 
                @php 
                $difPrice = "";
                @endphp
            @endif
        <input type="number"  class="form-control m-input" name="enjaz_price" id="enjaz_price" value="{{  $difPrice }}">
        </div>
    </div>

     <div class="form-group m-form__group row">
        <label class="col-xl-4 col-lg-4 col-form-label">الرسوم الحكومية :</label>
        <div class="col-xl-8 col-lg-8">
        <input type="number"  class="form-control m-input" name="gov_price" id="gov_price" @if($procces->mo3amla->m_processGovPrice != Null) disabled value="{{ $procces->mo3amla->m_processGovPrice }}" @endif>
        </div>
    </div>

    
    <div class="form-group m-form__group row">
        <label class="col-xl-4 col-lg-4 col-form-label">السعر المرسل للعميل:</label>
        <div class="col-xl-8 col-lg-8">
            @if($procces->mo3amla->price != Null)
                <input disabled type="number" name="priceO" id="priceO" class="form-control m-input"    value="{{ $procces->mo3amla->price }}">
            @else
            <input required readonly type="number" name="price" id="price" class="form-control m-input" value="{{ $procces->price }}" >
            @endif
              <span id="nottt"  style="color:red"></span>
        </div>
        
    </div>

    {{-- <div class="form-group m-form__group row" >
        <label class="col-xl-3 col-lg-3 col-form-label">فتح خيار ارسال ملفات جديدة من العميل:</label>
        <div class="col-xl-9 col-lg-9">
            <select required name="needNewFiles" class="form-control m-input">
                <option value="">-- اختر -- </option>
                <option value="1">نعم </option>
                <option value="0">لا ما يحتاج</option>
            </select>
        </div>
    </div> --}}
        
    <div class="m-form__actions m-form__actions--solid">
        <div class="row">
            <div class="col-lg-9"></div>
            <div class="col-lg-3">
                @if($procces->mo3amla->price != Null)
                    <button type="submit" name="submity" class="btn btn-accent push-left">تعميد</button>
                @else
                    <button type="submit" name="submity" class="btn btn-accent push-left">ارسال للعميل</button>
                @endif
            </div>
        </div>
    </div>
</form>




<script>
    $(document).ready(function() {
        $('.summernote').summernote();

        $("#enjaz_price, #thirdparty_price, #gov_price").on('keyup', function(){


            if( !$("#enjaz_price").val()  ||  !$("#thirdparty_price").val() || !$("#gov_price").val()){
               
                $("#nottt").text('يجب ادخال جميع الاسعار بالاعلى');
                $('#price').val('');


            }

            if( $("#enjaz_price").val()  && $("#thirdparty_price").val() && $("#gov_price").val()){

                var enjaz_price       =  parseInt( $("#enjaz_price").val() );
                var thirdparty_price  =  parseInt( $("#thirdparty_price").val() );
                var gov_price         =  parseInt( $("#gov_price").val() );

                $('#price').val(enjaz_price + thirdparty_price + gov_price);
               // console.log(enjaz_price);

                $("#nottt").text('');
            }
           
           
          

        });    
    });
</script>