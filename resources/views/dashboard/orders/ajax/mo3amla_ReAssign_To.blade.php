<form action="{{ route('dashboard.order.mo3amla.AsignReSubmit', ['id' => $order->id ]) }}" method="POST">
    @csrf
    <input type="hidden" name="mo3amlaOrderId" value="{{ $order->id }}">
    <input type="hidden" name="vendor_id" value="{{ $order->m_processVendorSelected }}">
    <input type="hidden" name="vendor_price" value="{{ $order->m_processPrice }}">
    <div class="form-group m-form__group row">
        <label class="col-xl-4 col-lg-4 col-form-label">اسم المعقب / مكتب الخدمة:</label>
        <div class="col-xl-8 col-lg-8">
            <input type="text" disabled class="form-control m-input" name="vendor_name" value="{{ $process->userz->name }}">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-xl-4 col-lg-4 col-form-label">النوع:</label>
        <div class="col-xl-8 col-lg-8">
            <input type="text" disabled class="form-control m-input" name="user_type" value="@if($process->userz->type == 'vendor')معقب@elseif($process->userz->type  == 'vendorC') مكتب خدمات @else--@endif">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-xl-4 col-lg-4 col-form-label">عدد ايام تنفيذ الخدمة:</label>
        <div class="col-xl-8 col-lg-8">
            <input type="text" class="form-control m-input" name="days" value="{{ $order->m_processDays }}">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-xl-4 col-lg-4 col-form-label">متطلبات التنفيذ:</label>
        <div class="col-xl-8 col-lg-8">
            <textarea type="text" class="form-control m-input summernote" name="requirments" >{{ $order->m_processRequirment }}</textarea>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-xl-4 col-lg-4 col-form-label">سعر تنفيذ المعقب (الطرف الثالث):</label>
        <div class="col-xl-8 col-lg-8">
            <input type="number" readonly  class="form-control m-input" id="thirdparty_price" name="thirdparty_price" value="{{ $order->m_processThirdPartyPrice }}">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-xl-4 col-lg-4 col-form-label">اتعاب انجاز المعاملة:</label>
        <div class="col-xl-8 col-lg-8">
            <input type="number"  class="form-control m-input" name="enjaz_price" id="enjaz_price" value="{{ $order->m_enjazPrice }}">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label class="col-xl-4 col-lg-4 col-form-label">الرسوم الحكومية :</label>
        <div class="col-xl-8 col-lg-8">
            <input type="number"  class="form-control m-input" name="gov_price" id="gov_price" value="{{ $order->m_processGovPrice }}">
        </div>
    </div>
    
    <div class="form-group m-form__group row">
        <label class="col-xl-4 col-lg-4 col-form-label">السعر المرسل للعميل:</label>
        <div class="col-xl-8 col-lg-8">
            <input required readonly type="number" name="price" id="price" class="form-control m-input" value="{{ $order->price }}">
              <span id="nottt"  style="color:red"></span>
        </div>
    </div>
        
    <div class="m-form__actions m-form__actions--solid">
        <div class="row">
            <div class="col-lg-9"></div>
            <div class="col-lg-3">
                <button type="submit" name="submity" class="btn btn-accent push-left">اعادة ارسال للعميل</button>
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