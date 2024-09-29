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
                        ادخل البريد الالكتروني وكلمة المرور الجديدة                    </p>

                    <div class="d-flex justify-content-center">
                        <div class="col-12">
                 

                    <form method="POST" action="{{ route('password.update') }}">
                    <form class="engaz-form" style="width:100%!important;" action="{{ route('password.update') }}" method="POST">

                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
