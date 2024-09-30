<div class="form-group m-form__group row" style="margin-left:0; margin-right:0;">
    <label class="col-xl-3 col-lg-3 col-form-label">متطلبات اتمام المعاملة:</label>
    <div class="col-xl-9 col-lg-9">
       <textarea required name="requirments" class="form-control m-input summernote"></textarea>
    </div>
</div>

<div class="form-group m-form__group row" style="margin-left:0; margin-right:0;">
    <label class="col-xl-3 col-lg-3 col-form-label">  اتعاب انجاز المعاملة :
        <br><span style="color:red">هذا السعر لن يظهر لدى العميل</span>

    </label>
    <div class="col-xl-9 col-lg-9">
      <input type="number" required class="form-control m-input" id="enjaz_price" name="enjaz_price">
    </div>
</div>

<div class="form-group m-form__group row" style="margin-left:0; margin-right:0;">
    <label class="col-xl-3 col-lg-3 col-form-label">  تكلفة الطرف الثالث :
        <br><span style="color:red">هذا السعر لن يظهر لدى العميل</span>
    </label>
    <div class="col-xl-9 col-lg-9">
      <input type="number" required class="form-control m-input" id="thirdparty_price" name="thirdparty_price">
    </div>
</div>
<div class="form-group m-form__group row" style="margin-left:0; margin-right:0;">
    <label class="col-xl-3 col-lg-3 col-form-label">  الرسوم الحكومية :
        {{-- <br><span style="color:red">هذا السعر لن يظهر لدى العميل</span> --}}
    </label>
    <div class="col-xl-9 col-lg-9">
      <input type="number" required class="form-control m-input" name="gov_price" id="gov_price">
    </div>
</div>
<div class="form-group m-form__group row" style="margin-left:0; margin-right:0;">
    <label class="col-xl-3 col-lg-3 col-form-label">سعر التنفيذ المرسل للعميل:</label>
    <div class="col-xl-9 col-lg-9">
      <input readonly type="number" required class="form-control m-input" name="price" id="price">
      <span id="nottt"  style="color:red"></span>
    </div>
</div>
<div class="form-group m-form__group row" style="margin-left:0; margin-right:0;">
    <label class="col-xl-3 col-lg-3 col-form-label">مدة تنفيذ الخدمة:</label>
    <div class="col-xl-9 col-lg-9">
      <input type="number" required class="form-control m-input" name="days">
    </div>
</div>
{{-- <div class="form-group m-form__group row" style="margin-left:0; margin-right:0;">
    <label class="col-xl-3 col-lg-3 col-form-label">فتح خيار ارسال ملفات جديدة من العميل:</label>
    <div class="col-xl-9 col-lg-9">
        <select name="needNewFiles" class="form-control m-input">
            <option value="null">-- اختر -- </option>
            <option value="1">نعم </option>
            <option value="0">لا ما يحتاج</option>
        </select>
    </div>
</div> --}}

<div class="m-form__actions m-form__actions--solid">
    <div class="row">
        <div class="col-lg-9"></div>
        <div class="col-lg-3">
            <button type="submit" name="submity" class="btn btn-accent push-left">ارسال</button>
        </div>
    </div>
</div>


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