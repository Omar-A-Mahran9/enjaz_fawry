@if($response['found'] == 1)
  <div class="row mb-5">
    <div class="container">
      <div class="col-md-2 float-right mobile-none" style="height: 50px;"></div>
      <div class="col-md-8 float-right">
        <div class="alert alert-warning text-center">
          <br> 
          <i class="fa fa-ban" style="font-size:47px"></i>
          <br>
          <br>
          <h3>
            الرقم <strong> {{ $response['mobile']  }}</strong> مسجل بالقائمة السوداء
          </h3>
          <br> 
          @if($response['name'] != '')
            <p><strong> الاسم :</strong> {{ $response['name']}}</p>
          @endif
          @if($response['reason'] != '')
            <p><strong> سبب الاضافة :</strong> {{ $response['reason']}}</p>
          @endif
        </div>
      </div>
      <div class="col-md-2 float-right mobile-none" style="height: 50px;"></div>
    </div>
  </div>
@else 

<div class="row mb-5">
    <div class="container">
      <div class="col-md-2 float-right mobile-none" style="height: 50px;"></div>
      <div class="col-md-8 float-right">
        <div class="alert alert-success text-center">
          <br> 
          <i class="fa fa-check" style="font-size:47px"></i>
          <br>
          <br>
          <h3>
            الرقم <strong> {{ $response['mobile']  }}</strong> غير مدرج بالقائمة السوداء
          </h3>
          <br> 
        </div>
      </div>
      <div class="col-md-2 float-right mobile-none" style="height: 50px;"></div>
    </div>
  </div>
@endif

