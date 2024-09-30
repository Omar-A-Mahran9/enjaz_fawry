@extends('engazFawry.layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center m-5">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{-- {{ dd($cid) }} --}}
            <div class="card" style="background-color: #F2EFEA;">
                <div class="card-header text-right" style="background-color:#853BCC!important; color:#fff;">تأكيد رقم الجوال</div>
                <div class="card-body">
                    {{-- <p>Thanks for registering with our platform. We will call you to verify your phone number in a jiffy. Provide the code below.</p> --}}
                    <P class="text-right">
                    شكراً للتسجيل عبر موقعنا. تم ارسال رسالة تحقق على جوالك . أدخل الكود في المكان المخصص بالأسفل.
                    </p>

                    <div class="d-flex justify-content-center">
                        <div class="col-12">
                            <form class="engaz-form" style="width:100%!important;" action="{{ route('verify_form') }}" method="POST">
                                @csrf

                                {{-- {{ dd(session('otp')) }} --}}
                                
                                <div class="form-group" style="direction:rtl;">
                                    <label for="code" style="width:100%;" class="text-right">أدخل الكود</label>
                                    <input id="code" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" type="text"  placeholder="كود التحقق" required autofocus>
                                    @if ($errors->has('code'))
                                        <span class="invalid-feedback text-right" role="alert">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                    @endif
                                </div>

                              
                                <div class="form-group">

                                    <button id="resend" type="button" disabled class="btn engaz-btn-light transform">اعادة ارسال الرمز  <span id="counter">60</span></button>

                                    <input type="submit" class="engaz-btn transform" value="تأكيد">

                                    

                               
                                     
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="resend_otp_mawad" action="{{ route('resend_otp') }}" method="POST" style="display: none;">
    @csrf
  
</form>
@endsection

@push('page_scripts')

<script>

    var counter = 60;
    var interval = setInterval(function() {
        counter--;
        
        // Display 'counter' wherever you want to display it.
        
        if (counter <= 0) {
            clearInterval(interval);
            $('#counter').text("");  
            return;
        }else{
            $('#counter').text(counter);
            // console.log("Timer --> " + counter);
        }

    }, 1000);


    function explode(){
        $("#resend").attr('disabled', false);     
    }
    setTimeout(explode, 60000);


$(document).ready(function() {
    

$("#resend").click(function(){
    //e.preventDefault();
    //$('#ta3medModal').modal('show');
   // var order_id = $(this).data('mo3amla');
   // var token = $("input[name='_token']").val();

    document.getElementById("resend_otp_mawad").submit();
    console.log("submitted");


    // $.ajax({
    //     url: "{{ route('resend_otp') }}",
    //     method: 'POST',
    //     data: {_token:token},
    //     success: function(data) {
    //         $("#response").html(data.options);
    //     }
    // });
    });
});
</script>
@endpush