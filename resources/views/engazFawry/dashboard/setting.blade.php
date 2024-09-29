@extends('engazFawry.layouts.dashboard')


@section('dashboard')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="  {{ route('client_dashboard') }}">لوحة التحكم</a></li>
    <li class="breadcrumb-item active" aria-current="page">الاعدادات </li>
  </ol>
</nav>

<div class="aside-row p-2 mb-3 text-right">

    <div class="row">
      
      <h5>بيانات الحساب :</h5> 

      <a href="{{ route('user.setting.edit')}}" style="left: 50px;position: absolute;"><i class="fa fa-edit"></i> تعديل </a>

      <table class="table table-bordered">
        <tbody>
          <tr>
            <td>حالة الحساب  </td>
            <td> 
            <?php 
          
            $status = $user->status; 
            $type = $user->type;?>
               

             {{-- @if ($type == 'vendor' || $type == 'vendorC') --}}

                @if ($status == 0 || $status == -1 || $status == -2)

                  <div style="color:red">
                     غير نشط  
                  </div>

                  @elseif($status == 1)
                   <div style="color:green">
                      نشط  
                  </div>

                @endif



              {{-- @endif --}}
         
            </td>
          </tr>
          <tr>
            <td>الاسم </td>
            <td>
               {{ $user->name}}
            </td>
          </tr>
          <tr>
            <td>رقم الجوال  </td>
            <td>
               {{ $user->phone}} -
                @if($user->phone_status == 1)
                 <span style="color:green">
                      مفعل  
                  </span>
                  @else
                  <span style="color:red">
                     غير مفعل  
                  </span>
                  @endif
            </td>
          </tr>
          
          <tr>
            <td>البريد الالكتروني  </td>
            <td>
               {{ $user->email}}
            </td>
          </tr>
        

          <tr>
            <td>
               @if ($type == 'vendor' || $type == 'vendorC') 
              رقم الاثبات  

              @else
              رقم الهوية  
              @endif
            
            </td>
            <td>
              {{ $user->identity_no }}
            </td>
          </tr>

          <tr>
            <td>تاريخ انشاء الحساب  </td>
            <td>
              {{ $user->created_at->format('d-m-Y')}}
            </td>
          </tr>






          {{-- Vendor Only --}}

          @if ($type == 'vendor' || $type == 'vendorC') 
          <tr>
              <td>حالة الاوراق الثبوتية  </td>
              <td>
                @if($user->identity_status == 0 && $user->identity_file != NULL)

                  بانتظار التعميد
  
                @elseif($user->identity_status == 0 && $user->identity_file == NULL)
                <span style="color:orange">
                  لم يتم رفع الملف ... يرجى ارسال الاوراق الثبوتية
                </span>
                @elseif($user->identity_status == -1)

                  @if($user->identity_file_reject_reason  != Null)
    
                    <span style="color:red">
                  
                      {{ $user->identity_file_reject_reason }}                     
                    </span>

                  @else
                    <span style="color:red">
                      مرفوض ... يرجى اعادة رفع الاوراق الثبوتية                       
                    </span>


                  @endif
                @elseif($user->identity_status == -2)
                  <span style="color:red">
                    مرفوض  
                  </span>

                @elseif($user->identity_status == 1)
  
                  <span style="color:green">
                    مقبولة  
                  </span>
  
                @endif
              </td>
            </tr>
          <tr>
            <td>الاوراق الثبوتية  </td>
            <td>
              @if($user->identity_status == 0 && $user->identity_file != NULL)

                @php 
                  $ext = pathinfo($user->identity_file, PATHINFO_EXTENSION);
                @endphp

                @if($ext == 'pdf')

                  <a  class="pdfFile" href="{{ asset('storage/ids') .'/'. $user->identity_file}}" target="_blank">
                    <i class="fa fa-file-pdf-o"></i>  
                  </a>

                @else

                  <a href="#"  data-target="#lightBox" data-toggle="modal"><img width="50" src="{{ asset('storage/ids') .'/'. $user->identity_file}}"></a>
                @endif

              @elseif( ($user->identity_status == 0 && $user->identity_file == NULL) || $user->identity_status == -1 || $user->identity_status == -2)



                <form class="signup-form text-right" style="margin-bottom:0;" action="{{ route('user.id.send') }}" method="POST" enctype="multipart/form-data" id="form">
                  @csrf
                  @if (Auth::check())
                    <?php $cid= Auth::id(); ?>
                    <input value="{{$cid}}" type="hidden" name="user_id">
                  @endif
  

                  <div class="col-md-6 float-right">
                    <div class="form-group">
                    
                      <label for="uploadFile" class="form-control transform custom-input" style="cursor: pointer; font-size: unset; text-align: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21.363" height="21.363" viewBox="0 0 21.363 21.363">
                        <path id="Icon_material-add-circle-outline" data-name="Icon material-add-circle-outline" d="M14.75,8.341H12.613v4.273H8.341V14.75h4.273v4.273H14.75V14.75h4.273V12.613H14.75ZM13.681,3A10.681,10.681,0,1,0,24.363,13.681,10.685,10.685,0,0,0,13.681,3Zm0,19.227a8.545,8.545,0,1,1,8.545-8.545A8.556,8.556,0,0,1,13.681,22.227Z" transform="translate(-3 -3)" fill="#853bcc"/>
                      </svg>
                      </label>
                      <input required type="file" multiple class="form-control transform" id="uploadFile" name="uploadFile" style="opacity: 0;
                      position: absolute;width: 50px;
                      z-index: -1;">
                    </div>
                  </div>
  
                  <div class=" col-md-6 float-right">
                      <input type="submit" class="engaz-btn transform" style=" margin: 0;padding: 7px 50px !important;" value="ارسال">
                    </div>
                </form>

                @if ($errors->has('uploadFile'))
                <div class="alert alert-danger justify-content-center mt-5">
                    <ul class="">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
            

              @elseif($user->identity_status == 1)


              @php 

              $ext = pathinfo($user->identity_file, PATHINFO_EXTENSION);

             

              @endphp

                  @if($ext == 'pdf')

                  <a  class="pdfFile" href="{{ asset('storage/ids') .'/'. $user->identity_file}}" target="_blank">
                    <i class="fa fa-file-pdf-o"></i>  
                  </a>

                  @else

                  <a href="#" data-target="#lightBox" data-toggle="modal"><img width="50" src="{{ asset('storage/ids') .'/'. $user->identity_file}}"></a>

                  @endif

        

              @endif
              
            </td>
          </tr>

          <tr>
            <td>الحساب البنكي </td>
            <td>
              @if($user->banks->count() > 0 )

              @php
                  
              $bank = $user->banks->last();
              @endphp
              
                  <div class="bank">
                    <p>
                      <strong> البنك : </strong>
                      <span>  {{$bank->name}} </span>
                    </p>
                    <p>
                      <strong> اسم الحساب :  </strong>
                      <span>  {{$bank->accountName}} </span>
                    </p>
                    <p>
                      <strong> رقم الحساب : </strong>
                      <span>  {{$bank->accountNo}} </span>
                    </p>
                    <p>
                      <strong> الايبان : </strong>
                      <span> {{$bank->accountIban}} </span>
                    </p>
                    <a href="#" data-toggle="modal" data-target="#editBank">تعديل</a>
                </div>
            

              @else 

                <a data-toggle="modal" data-target="#addBank"  class="engaz-btn transform" id="termsApprove" >
                اضافة الحساب البنكي
                </a>

              @endif
            </td>
          </tr>


          @endif

          {{--  End Vendor Only Section --}}

          
          

          
            
        </tbody>
      </table>


      

      </div>
    

      @if($user->banks->count() > 0 )

        @php
          $bank = $user->banks->last();
        @endphp

        @if (count($errors) > 0)
            <script>
                $( document ).ready(function() {
                    $('#editBank').modal('show');
                });
            </script>
        @endif

      <div class="modal fade" id="editBank" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog " role="document">
          <div class="modal-content">
            {{-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> --}}
            <div class="modal-body">

              <form method="POST" action="{{ route('bank.edit',['id'=> $bank->id]) }}" class="m-form m-form--fit m-form--label-align-right">
                @csrf
                @method('PUT')

                @if (Auth::check())
                <?php $cid= Auth::id(); ?>
                    <input value="{{$cid}}" type="hidden" name="user_id">
                @endif

                <div class="row">


                <div class="col-12 col-md-12">
                  <div class="form-group">
                    <label for="name">اسم البنك<span>*</span></label>
                    <input required="required" type="text" class="form-control transform" name="name" value="{{$bank->name}}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" style="display:block;" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="col-12 col-md-12">
                  <div class="form-group">
                    <label for="accountName">اسم الحساب<span>*</span></label>
                    <input required="required" type="text" class="form-control transform" name="accountName" value="{{$bank->accountName}}">
                    @if ($errors->has('accountName'))
                        <span class="invalid-feedback" style="display:block;" role="alert">
                            <strong>{{ $errors->first('accountName') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="col-12 col-md-12">
                  <div class="form-group">
                    <label for="accountNo">رقم الحساب<span>*</span></label>
                    <input required="required" type="text" class="form-control transform" name="accountNo" value="{{$bank->accountNo}}">
                    @if ($errors->has('accountNo'))
                        <span class="invalid-feedback" style="display:block;" role="alert">
                            <strong>{{ $errors->first('accountNo') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="col-12 col-md-12">
                  <div class="form-group">
                    <label for="accountIban">رقم الايبان<span>*</span></label>
                    <input required="required" type="text" class="form-control transform" name="accountIban" value=" {{$bank->accountIban}}">
                    @if ($errors->has('accountIban'))
                        <span class="invalid-feedback" style="display:block;" role="alert">
                            <strong>{{ $errors->first('accountIban') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>

                <div class="form-group text-left" style="margin-top:30px;">

                  <button class="transform user-engaz-btn" type="submit"> تعديل</button>      

                </div>


              </div><!-- end row -->
                
              </form>

            </div>
          </div>
        </div>
      </div>


      @else

      @if (count($errors) > 0)
          <script>
              $( document ).ready(function() {
                  $('#addBank').modal('show');
              });
          </script>
      @endif

      <div class="modal fade" id="addBank" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog " role="document">
            <div class="modal-content">
              {{-- <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> --}}
              <div class="modal-body">
  
                <form method="POST" action="{{ route('bank.store') }}" class="m-form m-form--fit m-form--label-align-right">
                  @csrf
  
                  @if (Auth::check())
                  <?php $cid= Auth::id(); ?>
                      <input value="{{$cid}}" type="hidden" name="user_id">
                  @endif
  
                  <div class="row">
  
  
                  <div class="col-12 col-md-12">
                    <div class="form-group">
                      <label for="name">اسم البنك<span>*</span></label>
                      <input required="required" type="text" class="form-control transform" value="{{ old('name')}}" name="name">
                      @if ($errors->has('name'))
                        <span class="invalid-feedback" style="display:block;" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                    </div>
                  </div>
                  <div class="col-12 col-md-12">
                    <div class="form-group">
                      <label for="accountName">اسم الحساب<span>*</span></label>
                      <input required="required" type="text" class="form-control transform" value="{{ old('accountName')}}"  name="accountName">
                      @if ($errors->has('accountName'))
                        <span class="invalid-feedback" style="display:block;" role="alert">
                            <strong>{{ $errors->first('accountName') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
  
                  <div class="col-12 col-md-12">
                    <div class="form-group">
                      <label for="accountNo">رقم الحساب<span>*</span></label>
                      <input required="required" type="text" class="form-control transform" value="{{ old('accountNo')}}" name="accountNo">
                      @if ($errors->has('accountNo'))
                        <span class="invalid-feedback" style="display:block;" role="alert">
                            <strong>{{ $errors->first('accountNo') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
  
                  <div class="col-12 col-md-12">
                    <div class="form-group">
                      <label for="accountIban">رقم الايبان<span>*</span></label>
                      <input required="required" type="text" class="form-control transform" value="{{ old('accountIban')}}" name="accountIban">
                      @if ($errors->has('accountIban'))
                        <span class="invalid-feedback" style="display:block;" role="alert">
                            <strong>{{ $errors->first('accountIban') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
  
                  <div class="form-group text-left" style="margin-top:30px;">
  
                    <button class="transform user-engaz-btn" type="submit"> اضافة</button>      
  
                  </div>
  
  
                </div><!-- end row -->
                  
                </form>
  
              </div>
            </div>
          </div>
        </div>

      @endif


      <div class="modal fade" id="lightBox" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              {{-- <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> --}}
              <div class="modal-body">
                <!-- Carousel markup goes in the modal body -->
                
                    <img class="d-block w-100" src="{{ url('storage/ids') . '/' . $user->identity_file }}">
              </div>
            </div>
          </div>
        </div>
@endsection

@push('page_scripts')

{{-- <script type="text/javascript">
@if(count($errors) > 0)
    $('#addBank').modal('show');
@endif
</script> --}}




@endpush
    
