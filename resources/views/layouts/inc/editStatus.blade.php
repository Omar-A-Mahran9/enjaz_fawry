{{-- 
    No Action Needed 
    -----------------

    -1 == new & not open 
    0  == new & opened
    5  == Order Closed 


    1  == client approve
    2  == On process 
    3  == On Hold – need Reason 
    4  == vendor complete order

    -2 == Client Reject 
    -3 == Admin Reject
    -4 == order has notes

    --}}


    {{-- 
        
    -1 == new & not open 
    0  == new & opened
    5  == Order Closed 
        --}}
<li class="m-portlet__nav-item">
    <a href="javascript:void(0);" onclick="changeStatus('sms')" class="btn btn-accent m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
        <span>
            <i class="fa fa-paper-plane"></i>
            <span>SMS ... </span>
        </span>
    </a>
</li>

@if($order->status == "-1" || $order->status == "0" || $order->status == "5")


    @if($order->status == "-1" || $order->status == "0" )

        <li class="m-portlet__nav-item">
            <a href="javascript:void(0);" onclick="changeStatus('-3')" class="btn btn-danger m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                <span>
                    <i class="fa fa-times"></i>
                    <span>رفض الطلب ... </span>
                </span>
            </a>
        </li>
       

    @endif

@else
    <li class="m-portlet__nav-item">تعديل حالة الطلب : </li>

    {{--  2  == On process  --}}
    @if($order->status == "2" )

    
    <li class="m-portlet__nav-item">
        <a href="javascript:void(0);" onclick="changeStatus('-4')" class="btn btn-warning m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
            <span>
                <i class="fa fa-exclamation-triangle"></i>
                <span>ارسال ملاحظة ...</span>
            </span>
        </a>
    </li>
    <li class="m-portlet__nav-item">
        <a href="javascript:void(0);" onclick="changeStatus('3')" class="btn btn-warning m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
            <span>
                <i class="fa fa-exclamation-triangle"></i>
                <span>معلق ...</span>
            </span>
        </a>
    </li>
    <li class="m-portlet__nav-item">
        <a href="javascript:void(0);" onclick="changeStatus('-3')" class="btn btn-danger m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
            <span>
                <i class="fa fa-times"></i>
                <span>رفض الطلب ... </span>
            </span>
        </a>
    </li>
    @if($order->payment_method != "0" && $order->prove_status == 1)

        
        @if(isset($order_type) && $order_type == 'mo3amla')
            <li class="m-portlet__nav-item">
                <a href="javascript:void(0);" onclick="changeStatus('5c')" class="btn btn-success m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                    <span>
                        <i class="fa fa-check"></i>
                        <span>تم الانجاز ...</span>
                    </span>
                </a>
            </li>
        @else 

            <li class="m-portlet__nav-item">
                <a href="javascript:void(0);" onclick="changeStatus('5')" class="btn btn-success m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                    <span>
                        <i class="fa fa-check"></i>
                        <span>تم الانجاز</span>
                    </span>
                </a>
            </li>
        @endif {{-- end if mo3amla --}}
    @endif
{{--  3  == On Hold – need Reason --}}
    @elseif($order->status == "3" )
        <li class="m-portlet__nav-item">
            <a href="javascript:void(0);" onclick="changeStatus('2')" data-st="2" class=" changeStatus btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                <span>
                    <i class="fa fa-stream"></i>
                    <span>قيد الاجراء</span>
                </span>
            </a>
        </li>
        <li class="m-portlet__nav-item">
            <a href="javascript:void(0);" onclick="changeStatus('-4')" class="btn btn-warning m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                <span>
                    <i class="fa fa-exclamation-triangle"></i>
                    <span>ارسال ملاحظة ...</span>
                </span>
            </a>
        </li>
        <li class="m-portlet__nav-item">
            <a href="javascript:void(0);" onclick="changeStatus('-3')" class="btn btn-danger m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                <span>
                    <i class="fa fa-times"></i>
                    <span>رفض الطلب ... </span>
                </span>
            </a>
        </li>
        @if($order->payment_method != "0" && $order->prove_status == 1)

            @if(isset($order_type) && $order_type == 'mo3amla')
                <li class="m-portlet__nav-item">
                    <a href="javascript:void(0);" onclick="changeStatus('5c')" class="btn btn-success m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fa fa-check"></i>
                            <span>تم الانجاز ...</span>
                        </span>
                    </a>
                </li>
            @else 

                <li class="m-portlet__nav-item">
                    <a href="javascript:void(0);" onclick="changeStatus('5')" class="btn btn-success m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fa fa-check"></i>
                            <span>تم الانجاز</span>
                        </span>
                    </a>
                </li>
            @endif {{-- end if mo3amla --}}
        @endif
    
    {{--  -3 == Admin Reject--}}
    @elseif($order->status == "-3" )
         <li class="m-portlet__nav-item">
            <a href="javascript:void(0);" onclick="changeStatus('2')" data-st="2" class=" changeStatus btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                <span>
                    <i class="fa fa-stream"></i>
                    <span>قيد الاجراء</span>
                </span>
            </a>
        </li>
        <li class="m-portlet__nav-item">
            <a href="javascript:void(0);" onclick="changeStatus('-4')" class="btn btn-warning m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                <span>
                    <i class="fa fa-exclamation-triangle"></i>
                    <span>ارسال ملاحظة ...</span>
                </span>
            </a>
        </li>
{{--  4  == vendor complete order --}}
    @elseif($order->status == "4" )

       
        {{-- @if($order->payment_method != "0" && $order->prove_status == 1) --}}

            @if(isset($order_type) && $order_type == 'mo3amla')
                <li class="m-portlet__nav-item">
                    <a href="javascript:void(0);" onclick="changeStatus('5c')" class="btn btn-success m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fa fa-check"></i>
                            <span>تم الانجاز ...</span>
                        </span>
                    </a>
                </li>
            @else 

                <li class="m-portlet__nav-item">
                    <a href="javascript:void(0);" onclick="changeStatus('5')" class="btn btn-success m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fa fa-check"></i>
                            <span>تم الانجاز</span>
                        </span>
                    </a>
                </li>
            @endif {{-- end if mo3amla --}}

        {{-- @endif --}}



        {{-- -2 == Client Reject --}}

    @elseif($order->status == "-2" )
        
        <li class="m-portlet__nav-item">
            <a href="javascript:void(0);" onclick="changeStatus('-4')" class="btn btn-warning m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                <span>
                    <i class="fa fa-exclamation-triangle"></i>
                    <span>ارسال ملاحظة ...</span>
                </span>
            </a>
        </li>
        <li class="m-portlet__nav-item">
            <a href="javascript:void(0);" onclick="changeStatus('3')" class="btn btn-warning m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                <span>
                    <i class="fa fa-exclamation-triangle"></i>
                    <span>معلق ...</span>
                </span>
            </a>
        </li>
        <li class="m-portlet__nav-item">
            <a href="javascript:void(0);" onclick="changeStatus('-3')" class="btn btn-danger m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                <span>
                    <i class="fa fa-times"></i>
                    <span>رفض الطلب ... </span>
                </span>
            </a>
        </li>

    @else

    {{-- @if($order->status != "-1" || $order->status != "0") --}}
    <li class="m-portlet__nav-item">
        <a href="javascript:void(0);" onclick="changeStatus('2')" data-st="2" class=" changeStatus btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
            <span>
                <i class="fa fa-stream"></i>
                <span>قيد الاجراء</span>
            </span>
        </a>
    </li>
    <li class="m-portlet__nav-item">
        <a href="javascript:void(0);" onclick="changeStatus('-4')" class="btn btn-warning m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
            <span>
                <i class="fa fa-exclamation-triangle"></i>
                <span>ارسال ملاحظة ...</span>
            </span>
        </a>
    </li>
    <li class="m-portlet__nav-item">
        <a href="javascript:void(0);" onclick="changeStatus('3')" class="btn btn-warning m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
            <span>
                <i class="fa fa-exclamation-triangle"></i>
                <span>معلق ...</span>
            </span>
        </a>
    </li>
    <li class="m-portlet__nav-item">
        <a href="javascript:void(0);" onclick="changeStatus('-3')" class="btn btn-danger m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
            <span>
                <i class="fa fa-times"></i>
                <span>رفض الطلب ... </span>
            </span>
        </a>
    </li>

        @if($order->payment_method != "0" && $order->prove_status == 1)

            @if(isset($order_type) && $order_type == 'mo3amla')
                <li class="m-portlet__nav-item">
                    <a href="javascript:void(0);" onclick="changeStatus('5c')" class="btn btn-success m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fa fa-check"></i>
                            <span>تم الانجاز ...</span>
                        </span>
                    </a>
                </li>
            @else 

                <li class="m-portlet__nav-item">
                    <a href="javascript:void(0);" onclick="changeStatus('5')" class="btn btn-success m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fa fa-check"></i>
                            <span>تم الانجاز</span>
                        </span>
                    </a>
                </li>
            @endif {{-- end if mo3amla --}}
        @endif

    
    @endif
@endif







<script>
    
function changeStatus(st){
    $("#change_status_value").val(st);
    if(st == "2"){
        //"قيد الاجراء"
        document.getElementById('changeStatus').submit();
        
    }else if(st == "3"){
        //"معلق"
        if(confirm('هل انت متأكد من تعليق الطلب؟')) 
        { 
          $('#changeStatusModal').modal('show');
          $('#statusReason').text('سبب التعليق:');
        }else{
            return false 
        }
    }else if(st == "-4"){
        //"ارسال ملاحظة"
        
          $('#openModalSendNewNotes').modal('show');
        //   $('#statusReason').text('سبب التعليق:');
        
    }else if(st == "-3"){
        //"مرفوض"
        if(confirm('هل انت متأكد من رفض الطلب؟')) 
        { 
            $('#changeStatusModal').modal('show');
            $('#statusReason').text('سبب الرفض:');
        }else{
            return false 
        }
    }else if(st == "5"){
        //"تم الانجاز"
        document.getElementById('changeStatus').submit();
    }else if(st == "sms"){
       // 'SMS'
        $('#sendCustomSms').modal('show');
        $("#smsText").keyup(function(){
            $("#countLetters").text($(this).val().length);
        });
       
    }else if(st == "5c"){
       // 'enjaz_prove needed '
        $('#enjaz_prove').modal('show');
            
       
    }



    
}
</script>