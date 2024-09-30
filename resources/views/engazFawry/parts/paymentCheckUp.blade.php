@if($order->payment_method != "0")
<tr>
    <td>طريقة الدفع  </td>
    <td>
        @if($order->payment_method == 'transfer')
            تحويل بنكي
        @elseif($order->payment_method == 'online_payment')
            دفع اونلاين
        @elseif($order->payment_method == 0)
            لايوجد
        @else
            -- 
        @endif

    </td>
</tr>
@endif

@if($order->payment_method == "transfer" && $order->bank_id != Null && $order->prove_status != 1)
<tr>
    <td>بيانات الحساب البنكي  </td>
    <td>
        <div class="col-12 col-md-12 " id="bank_{{ $order->bank->id }}">
            <div class="bankDt2">
            <p><span>اسم الحساب </span> <strong>{{$order->bank->accountName}}</strong> </p>
            <p><span>رقم الحساب </span> <strong>{{$order->bank->accountNo}}</strong> </p>
            <p><span>ايبان </span> <strong>{{$order->bank->accountIban}}</strong> </p>
            </div>
        </div>
    </td>
</tr>
@endif

@if($order->payment_method == 'transfer' &&  ($order->prove_status == -1 || $order->prove_status == 0 ) )
<tr style="background-color:#fff">
    <td>اثبات الدفع  </td>
    <td>
    @if($order->transfer_prove == 0 && $order->prove_status == 0)
    <div class="row">

    <form class=" signup-form text-right" style="margin-bottom:0;" action="{{ route($route) }}" method="POST" enctype="multipart/form-data" id="form">
    @csrf
    @if (Auth::check())
        <?php $cid= Auth::id(); ?>
        <input value="{{$cid}}" type="hidden" name="user_id">
    @endif

    <input value="{{$order->id}}" type="hidden" name="order_id">

    <div class="col-md-6 float-right">
        <div class="form-group">
        
        <label for="uploadFile" class="form-control transform custom-input" style="cursor: pointer; font-size: unset; text-align: center;">
            <svg xmlns="http://www.w3.org/2000/svg" width="21.363" height="21.363" viewBox="0 0 21.363 21.363">
            <path id="Icon_material-add-circle-outline" data-name="Icon material-add-circle-outline" d="M14.75,8.341H12.613v4.273H8.341V14.75h4.273v4.273H14.75V14.75h4.273V12.613H14.75ZM13.681,3A10.681,10.681,0,1,0,24.363,13.681,10.685,10.685,0,0,0,13.681,3Zm0,19.227a8.545,8.545,0,1,1,8.545-8.545A8.556,8.556,0,0,1,13.681,22.227Z" transform="translate(-3 -3)" fill="#853bcc"/>
        </svg>
        <div class="progress" style="display:none;">
            <div class="progress-bar" style="display:none;background-color:#3CBFAF!important" role="progressbar" aria-valuenow=""
            aria-valuemin="0" aria-valuemax="100" style="width: 0%">
            0%
            </div>
        </div>
        </label>
        <input required type="file" multiple class="form-control transform inputWithPreview" id="uploadFile" name="proveFile" style="opacity: 0;
        position: absolute;width: 50px;
        z-index: -1;">
        </div>
    </div>

    <div class=" col-md-6 float-right">
        <input type="submit" class="engaz-btn transform" style=" margin: 0;padding: 7px 50px !important;" value="ارسال">
        </div>
    </form>  
</div>
    
@elseif($order->prove_status == -1)
    <p style="color:#f00">مرفوض / اعادة رفع اثبات الدفع</p>

    <div class="row">

        <form class="signup-form text-right" style="margin-bottom:0;" action="{{ route($route) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (Auth::check())
        <?php $cid= Auth::id(); ?>
            <input value="{{$cid}}" type="hidden" name="user_id">
        @endif
        <input value="{{$order->id}}" type="hidden" name="order_id">
        <div class="col-md-6 float-right">
            <div class="form-group">
            
            <label for="uploadFile" class="form-control transform custom-input" style="cursor: pointer; font-size: unset; text-align: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="21.363" height="21.363" viewBox="0 0 21.363 21.363">
                <path id="Icon_material-add-circle-outline" data-name="Icon material-add-circle-outline" d="M14.75,8.341H12.613v4.273H8.341V14.75h4.273v4.273H14.75V14.75h4.273V12.613H14.75ZM13.681,3A10.681,10.681,0,1,0,24.363,13.681,10.685,10.685,0,0,0,13.681,3Zm0,19.227a8.545,8.545,0,1,1,8.545-8.545A8.556,8.556,0,0,1,13.681,22.227Z" transform="translate(-3 -3)" fill="#853bcc"/>
            </svg>
            <div class="progress" style="display:none;">
                <div class="progress-bar" style="display:none;background-color:#3CBFAF!important" role="progressbar" aria-valuenow=""
                aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                0%
                </div>
            </div>
            </label>
            <input type="file" required class="form-control transform inputWithPreview" id="uploadFile" name="proveFile" style="opacity: 0;
            position: absolute;width: 50px;
            z-index: -1;">
            </div>
        </div>

        <div class=" col-md-6 float-right">
            <input type="submit" class="engaz-btn transform" style=" margin: 0;padding: 7px 50px !important;" value="ارسال">
            </div>
        </form>  
    </div>

    @elseif($order->transfer_prove != 0 && $order->prove_status == 0)

    بانتظار التأكيد
    @else

    --

    @endif
</td>


</tr>

@elseif($order->payment_method == 'transfer' && $order->prove_status == 1)
<tr>
    <td>حالة الدفع </td>
    <td>  <p style="color:green;margin: 0;"> مثبت </p></td>
</tr>
@endif

@if( $order->payment_method == 'online_payment' &&  ( $order->prove_status == -1 || $order->prove_status == 0 ) )

<tr style="background-color:#fff">
    <td>بيانات الدفع 
        <br> 
        @if(strpos($order->order_no, "T") !== false)

            @php 
                $payment_price = $order->total_price*100;
            @endphp 
            
        @elseif(strpos($order->order_no, "M") !== false)

            @php 
                $payment_price = $order->price*100;
            @endphp 
            
        @elseif(strpos($order->order_no, "E") !== false)
            
            @php 
                $payment_price = $order->price*100;
            @endphp 


        @elseif(strpos($order->order_no, "G") !== false)

            @php 
                $payment_price = $order->total_price*100;
            @endphp 

        @endif
    </td>
    <td>  
        <form accept-charset="UTF-8" id="payment_form" action="https://api.moyasar.com/v1/payments.html" method="POST">

            <input type="hidden" name="callback_url" value="{{ route($route) }}/{{$order->id}}" />

            <input type="hidden" name="publishable_api_key" value="{{ getPaymentKeys('publishable_api_key') }}">
            {{-- <input type="hidden" name="publishable_api_key" value="pk_live_1jbKA3oCaopbB9GZhKXtJjS343Kjg2PwTQbAiK5b"> --}}

            {{-- 100 Halals to charges 1 Riyal --}}
            <input type="hidden" name="amount" value="{{ $payment_price }}">
            <input type="hidden" name="source[type]" value="creditcard">

            {{-- User Data --}}
            <div class="form-group col-md-12 p-mz">
                <label for="source_name">الاسم على البطاقة <span>*</span></label>
                <input placeholder="الاسم على البطاقة"  type="text" required="required" class="form-control" id="source_name" name="source[name]" />
                <span id="source_name_error" class="error_span"></span>
            </div>
            <div class="form-group col-md-12 p-mz">
                <label for="source_number">رقم البطاقة <span>*</span></label>
                <input placeholder="12345678910" type="number" required="required"  class="form-control" id="source_number" name="source[number]" />
                <span id="source_number_error" class="error_span"></span>
            </div>
            <div class="form-group row ">
                <div class="col-md-4 p-mz">
                    <label for="source_month">الشهر <span>*</span></label>
                    <select name="source[month]" required="required" class="form-control" id="source_month" >
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                    <span id="source_month_error"  class="error_span"></span>
                </div>
                <div class="col-md-4 p-mz">
                    <label for="source_year">السنة <span>*</span></label>
                        @php
                            $year = date("Y");
                        @endphp 
                     <select name="source[year]" required="required" class="form-control" id="source_year" >

                       @for ($i = 0; $i < 24; $i++)
                            <option value="{{$year+$i}}">{{$year+$i}}</option>
                       @endfor
                                             
                    </select>
                    <span id="source_year_error" class="error_span"></span>
                </div>
                <div class="col-md-4 p-mz">
                    <label for="source_cvc" style="font-size:15px;">رمز الحماية cvc <span>*</span></label>
                    <input placeholder="123"  type="number" required="required" class="form-control" id="source_cvc" name="source[cvc]" />
                    <span id="source_cvc_error" class="error_span"></span>
                </div>
            </div>
         
            <div class=" col-md-4 float-left">
                <input type="submit" id="paymentBtn" disabled class="engaz-btn transform" style=" margin: 0;padding: 7px 50px !important;" value="دفع">
            </div>
            <br>
        </form>

        <div class="payment_icon">
            <ul>
                <li><img width="70" src="{{ asset('images/visa.png')}}" alt="الدفع عبر بطاقات الفيزا"></li>
                <li><img width="70" src="{{ asset('images/master.png')}}" alt="الدفع عبر بطاقات الماستر كارد"></li>
                <li><img width="70" src="{{ asset('images/mada.png')}}" alt="الدفع عبر بطاقات مدى"></li>
            </ul>
        </div>
</td>
</tr>

@elseif($order->payment_method == 'online_payment' && $order->prove_status == 1)
<tr>
    <td>حالة الدفع </td>
    <td>  <p style="color:green;margin: 0;"> تم السداد </p></td>
</tr>
@endif
<script src="{{asset('js/')}}/jquery.creditCardValidator.js"></script>
<script>
$(function(){
    $("#source_name").keypress(function(event){
        var ew = event.which;
        if(ew == 32)
            return true;
        if(48 <= ew && ew <= 57)
            return true;
        if(65 <= ew && ew <= 90)
            return true;
        if(97 <= ew && ew <= 122)
            return true;
        return false;
    });

});    

    function cardFormValidate(){
    var cardValid = 0;

    //card number validation
    $('#source_number').validateCreditCard(function(result){
        if(result.valid){
            $("#source_number").removeClass('required');
            cardValid = 1;
        }else{
            $("#source_number").addClass('required');
            cardValid = 0;
        }
    });
      
    //card details validation
    var cardName = $("#source_name").val();
    var expMonth = $("#source_month").val();
    var expYear = $("#source_year").val();
    var cvv = $("#source_cvc").val();
    var regName = /^[a-z ,.'-]+$/i;
    var regMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
    var regYear = /^2020|2021|2022|2023|2024|2025|2026|2027|2028|2029|2030|2031$/;
    var regCVV = /^[0-9]{3,3}$/;
     if (!regName.test(cardName)) {
        $("#source_number").removeClass('required');
          $('#source_number_error').text('');
        $("#source_month").removeClass('required');
        $("#source_year").removeClass('required');
        $("#source_cvc").removeClass('required');
        $("#source_name").addClass('required');
        $('#source_name_error').text('الاسم مطلوب');
        $('#source_name_error').text('');
        // $("#source_name").focus();
        return false;
    }else if (cardValid == 0) {
        $("#source_number").addClass('required');
        $('#source_number_error').text('رقم البطاقة المدخل غير صحيح ');
        // $("#source_number").focus();
        return false;
    }else if (!regMonth.test(expMonth)) {
        $("#source_number").removeClass('required');
        $('#source_number_error').text('');
        $("#source_month").addClass('required');
      //  $('#source_number_error').text('خطأ بالتاريخ ');
       // $("#source_month").focus();
        return false;
    }else if (!regYear.test(expYear)) {
        $("#source_number").removeClass('required');
          $('#source_number_error').text('');
        $("#source_month").removeClass('required');
        $("#source_year").addClass('required');
       // $("#source_year").focus();
        return false;
    }else if (!regCVV.test(cvv)) {
        $("#source_number").removeClass('required');
        $('#source_number_error').text('');
        $("#source_month").removeClass('required');
        $("#source_year").removeClass('required');
        $("#source_cvc").addClass('required');
       // $("#source_cvc").focus();
       
        $('#source_number_error').text('');
        return false;
    }else{
        $("#source_number").removeClass('required');
        $("#source_month").removeClass('required');
        $("#source_year").removeClass('required');
        $("#source_cvc").removeClass('required');
        $("#source_name").removeClass('required');

        $('#source_name_error').text('');
        $('#source_number_error').text('');
        return true;
    }
}
$(document).ready(function() {
    //card validation on input fields
    $('#payment_form input[type=text], #payment_form input[type=number]').on('keyup',function(){
    
        if(cardFormValidate() === true){

            $("#paymentBtn").attr('disabled', false);

        }else{
            $("#paymentBtn").attr('disabled', true);


        }
    });
});
</script>