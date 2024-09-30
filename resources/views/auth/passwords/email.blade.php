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
                <div class="card-header text-right" style="background-color:#853BCC!important; color:#fff;">اعادة تعيين كلمة المرور</div>
                <div class="card-body">
                    {{-- <p>Thanks for registering with our platform. We will call you to verify your phone number in a jiffy. Provide the code below.</p> --}}
                    <P class="text-right">
                        يرجى ادخال بريدك الالكتروني وسيتم ارسال رابط لاعادة تعيين كلمة المرور الخاصة بك                    </p>

                    <div class="d-flex justify-content-center">
                        <div class="col-12">
                 

                    <form class="engaz-form" style="width:100%!important;" action="{{ route('password.email') }}" method="POST">

                        @csrf

                        <div class="form-group" style="direction:rtl;">
                            <label for="email" style="width:100%;" class="text-right">البريد الالكتروني</label>
                            <input id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" type="email"  placeholder="البريد الالكتروني" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback text-right" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {{-- <button  class="btn engaz-btn transform">تأكيد</button> --}}
                                <input type="submit" class="engaz-btn transform" value="ارسال رابط اعادة تعيين كلمة المرور">
                        </div>

                        

                        
                    </form>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
