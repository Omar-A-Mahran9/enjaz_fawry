@extends('engazFawry.layouts.dashboard')


@section('dashboard')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('client_dashboard') }}">لوحة التحكم</a></li>
    <li class="breadcrumb-item"><a href="{{ route('panel.setting') }}">بيانات الحساب</a></li>
    <li class="breadcrumb-item active" aria-current="page">تعديل بيانات الحساب </li>
  </ol>
</nav>

<div class="aside-row p-2 mb-3 text-right">

    <div class="row">
      <form method="POST" action="{{ route('user.setting.submit') }}" class="m-form m-form--fit m-form--label-align-right" enctype='multipart/form-data' >
                @csrf
                @method('PUT')

                @if (Auth::check())
                <?php $cid= Auth::id(); ?>
                    <input value="{{$cid}}" type="hidden" name="user_id">
                @endif
            <?php 
          
            $status = $user->status; 
            $type = $user->type;?>
               

        <div class="col-12 col-md-12">
            <div class="form-group row">
                <label class="col-4 col-md-4 col-xs-12" for="accountName">الاسم <span>*</span></label>
                <input required="required" type="text" class=" col-8 col-md-8 col-xs-12 form-control transform" name="name" value="{{ $user->name}}">
                @if ($errors->has('accountName'))
                    <span class="invalid-feedback" style="display:block;" role="alert">
                        <strong>{{ $errors->first('accountName') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-12">
            <div class="form-group row">
                <label class="col-4 col-md-4 col-xs-12" for="accountName"> تعديل رقم الجوال <span></span>
                
                  <span class="col-md-2" style="display:block;">
  
                    <ul class="tg-list">
                      <li class="tg-list-item">
                        <input class="tgl tgl-ios" id="cb_mobile" type="checkbox" name="changeMobile" />
                        <label class="tgl-btn" for="cb_mobile"></label>
                      </li>
                    </ul>
                  </span>
                
                </label>
                <input readonly required="required" type="text" class=" col-8 col-md-8 col-xs-12 form-control transform" name="phone" id="phone" value="{{ $user->phone }}">


                @if ($errors->has('phone'))
                    <span class="invalid-feedback" style="display:block;" role="alert">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
                
                <span class=" col-4 col-md-4 order-1" >
                  </span>
                <span style="color:red;font-size:12px" class=" col-8 col-md-8 col-xs-12 order-2" >
                    في حالة تعديل رقم الجوال يستلزم تفعيل الجوال قبل ان تتمكن من استخدام الحساب مرة اخرى  
                </span>
                
            </div>
        </div>

        <div class="col-12 col-md-12">
            <div class="form-group row">
                <label class="col-4 col-md-4 col-xs-12" for="email">البريد الالكتروني
                  
                  <span class="col-md-2" style="display:block;">
  
                    <ul class="tg-list">
                      <li class="tg-list-item">
                        <input class="tgl tgl-ios" id="cb_mail" type="checkbox" name="changeMail" />
                        <label class="tgl-btn" for="cb_mail"></label>
                      </li>
                    </ul>
                  </span>
                </label>
                <input readonly type="text" class=" col-8 col-md-8 col-xs-12 form-control transform" name="email" id="email" value="{{ $user->email }}">
                @if ($errors->has('email'))
                    <span class="invalid-feedback" style="display:block;" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-12">
            <div class="form-group row">
                <label class="col-4 col-md-4 col-xs-12" for="gender">النوع <span>*</span></label>
                {{-- <input readonly type="text" class="col-8 col-md-8 col-xs-12 form-control transform" name="phone" value="{{ $user->email }}"> --}}

                <select name="gender" id="gender" class="col-8 col-md-8 col-xs-12 form-control transform">
                    <option value="">-- اختر --</option>
                    <option value="male" @if($user->gender == 'male') selected="selected" @endif>ذكر</option>
                    <option value="female" @if($user->gender == 'female') selected="selected" @endif>انثى</option>
                </select>
                @if ($errors->has('gender'))
                    <span class="invalid-feedback" style="display:block;" role="alert">
                        <strong>{{ $errors->first('gender') }}</strong>
                    </span>
                @endif
            </div>
        </div>


         <div class="col-12 col-md-12">
            <div class="form-group row">
                <label class="col-4 col-md-4 col-xs-12" for="profileImg" style="padding-top:27px">الصورة الشخصية <span></span></label>
                <div class="form-group col-6 col-md-6 col-xs-12">
                                
                    <label for="uploadFile" class="form-control transform custom-input" style="cursor: pointer; font-size: unset; text-align: center;    margin-top: 21px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21.363" height="21.363" viewBox="0 0 21.363 21.363">
                        <path id="Icon_material-add-circle-outline" data-name="Icon material-add-circle-outline" d="M14.75,8.341H12.613v4.273H8.341V14.75h4.273v4.273H14.75V14.75h4.273V12.613H14.75ZM13.681,3A10.681,10.681,0,1,0,24.363,13.681,10.685,10.685,0,0,0,13.681,3Zm0,19.227a8.545,8.545,0,1,1,8.545-8.545A8.556,8.556,0,0,1,13.681,22.227Z" transform="translate(-3 -3)" fill="#853bcc"/>
                    </svg>
                    </label>
                    <span style="color:#8e1600">الملفات المسموحة : jpg - png</span>
                    <input type="file" class="form-control transform imagePreview" id="uploadFile" name="profileImg" style="opacity: 0;
                    position: absolute;width: 50px;
                    z-index: -1;">
                </div>   
                <div class="form-group col-2 col-md-2 col-xs-12">
                  @if($user->vendor_image == NULL  || empty($user->vendor_image)) 

                    @if($user->gender == 'male')

                      <img src="{{ asset('images/default_man.png')}}" class="imageThumb" width="100">

                    @elseif($user->gender == 'female')

                      <img src="{{ asset('images/default_woman.png')}}" class="imageThumb" width="100">

                    @else
                      <img src="{{ asset('images/default_man.png')}}" class="imageThumb" width="100">


                    @endif


                  @else

                    <img src="{{ asset('storage/profile_image/')."/".$user->vendor_image }}" class="imageThumb" width="100">

                  @endif
              
                </div>
                
                @if ($errors->has('accountName'))
                    <span class="invalid-feedback" style="display:block;" role="alert">
                        <strong>{{ $errors->first('accountName') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        
        <hr style="height: 1px;border-top: 1px solid #999;width: 100%;display: block;">
        <br>

          <div class="col-12 col-md-12">
            <div class="form-group row">
                <span class="col-4 col-md-4 col-xs-12" >
                  <h5> تعديل كلمة المرور </h5>
                </span>
                <span class="col-8 col-md-8 col-xs-12" style="color:#f00; font-size:16px;">
                    
                  <ul class="tg-list">
                  <li class="tg-list-item">
                    <input @if(old('changePass') || old('oldPass')) checked="checked" @endif class="tgl tgl-ios" id="cb2" type="checkbox" name="changePass" />
                    <label class="tgl-btn" for="cb2"></label>
                  </li>
                </ul>
                      {{-- في حال عدم رغبتك في تعديل كلمة المرور اترك الحقول التالية فارغة  --}}
                </span>
               
            </div>
        </div>
<br>

<div id="hide_pass"   class="row" @if( old('changePass') || old('oldPass') ) style="display: block;" @else style="display: none;" @endif>
  <div class="col-12 col-md-12">
      <div class="form-group row">
          <label class="col-4 col-md-4 col-xs-12" for="oldPass">كلمة المرور الحالية <span>*</span></label>

          <div class="col-8 col-md-8 col-xs-12">
            <input required disabled type="password" class="form-control transform" name="oldPass" id="oldPass" value="">
            @if ($errors->has('oldPass'))
                <span class="invalid-feedback" style="display:block;" role="alert">
                    <strong>{{ $errors->first('oldPass') }}</strong>
                </span>
            @endif
          </div>
      </div>
  </div>


        <div class="col-12 col-md-12">
            <div class="form-group row">
                <label class="col-4 col-md-4 col-xs-12" for="password">كلمة المرور الجديدة <span>*</span></label>
                <div class="col-8 col-md-8 col-xs-12">
                  <input disabled required type="password" class="form-control transform" name="password" id="password">
                  @if ($errors->has('password'))
                      <span class="invalid-feedback" style="display:block;" role="alert">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                </div>
            </div>
        </div>

         <div class="col-12 col-md-12">
            <div class="form-group row">
                <label class="col-4 col-md-4 col-xs-12" for="password_confirmation">تأكيد كلمة المرور الجديدة <span>*</span></label>

                <div class="col-8 col-md-8 col-xs-12">
                  <input disabled required type="password" class="form-control transform" name="password_confirmation" id="password_confirmation">
                  @if ($errors->has('password_confirmation'))
                      <span class="invalid-feedback" style="display:block;" role="alert">
                          <strong>{{ $errors->first('password_confirmation') }}</strong>
                      </span>
                  @endif
              </div>
            </div>
        </div>

</div>
         


        <div class="form-group text-left" style="margin-top:30px;">
            <button class="transform user-engaz-btn" type="submit"> تعديل</button>      
        </div>





          {{--  End Vendor Only Section --}}

          
          

         </form>

      </div>
    

      


      {{-- <div class="modal fade" id="lightBox" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <img class="d-block w-100" src="{{ url('storage/ids') . '/' . $user->identity_file }}">
              </div>
            </div>
          </div>
        </div> --}}
@endsection

@push('page_scripts')

@if($user->vendor_image == NULL  || empty($user->vendor_image)) 

  <script type="text/javascript">
    // change image when change gender
    $("#gender").on("change", function() {
      
      if(this.value == 'male'){
        $(".imageThumb").attr('src'," {{ asset('images/default_man.png')}}");
      }else if(this.value == 'female')
      {
        $(".imageThumb").attr('src', "{{ asset('images/default_woman.png')}}");
      }else{
        $(".imageThumb").attr('src', "{{ asset('images/default_man.png')}}");

      }

    });

  </script>
@endif


<script type="text/javascript">

// change password 
$("#cb2").change(function() {
    if(this.checked) {
      console.log('checked');
      $("#hide_pass").slideDown();
      $("#oldPass").attr('disabled', false);
      $("#password").attr('disabled', false);
      $("#password_confirmation").attr('disabled', false);

      $("#oldPass").attr('required', true);
      $("#password").attr('required', true);
      $("#password_confirmation").attr('required', true);

    }else{
      $("#hide_pass").slideUp();
      $("#oldPass").attr('disabled', true);
      $("#password").attr('disabled', true);
      $("#password_confirmation").attr('disabled', true);

      $("#oldPass").attr('required', false);
      $("#password").attr('required', false);
      $("#password_confirmation").attr('required', false);
    }
});

// change email 
$("#cb_mail").change(function() {
    if(this.checked) {
      $("#email").attr('disabled', false);
      $("#email").attr('readonly', false);
    }else{
      $("#email").attr('disabled', true);
      $("#email").attr('readonly', true);
    }
});

// change mobile 
$("#cb_mobile").change(function() {
    if(this.checked) {
      $("#phone").attr('disabled', false);
      $("#phone").attr('readonly', false);
    }else{
      $("#phone").attr('disabled', true);
      $("#phone").attr('readonly', true);
    }
});
</script> 
@endpush