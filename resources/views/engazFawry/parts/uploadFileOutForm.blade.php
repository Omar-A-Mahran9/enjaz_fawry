
<!-- Upload Image Modal  -->
<div class="modal" id="upload_img">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #3CBFAF!important">
        <h4 class="modal-title" style="color: #fff;">تحميل المرفقات</h4>
        <button type="button" class="close" data-dismiss="modal" style="margin: -1rem -1rem -1rem 0;">&times;</button>
      </div>
      <div class="modal-body text-right p-5" style="direction: ltr;">
        
          

  <div class="container">
  
     <div class="panel panel-default">
        {{-- <div class="panel-heading">
            <h3 class="panel-title">File Upload with Progressbar using Ajax jQuery</h3>
        </div> --}}
        <div class="panel-body">
            {{-- <br /> --}}
            <form method="post" id="addImageForm" action="{{ route('upload') }}" enctype="multipart/form-data">
              @csrf
              <div class="row">
                    <div class="col-md-3 col-xs-12 order-3"><h6>اختر الملف </h6></div>
                    <div class="col-md-6 col-xs-12 order-2">
                      <input type="file" class="imgupload" name="file" id="file" />
                    </div>
                    <div class="col-md-3 col-xs-12 order-1">
                      <input type="submit" id="uploadImageBtn" name="upload" value="تحميل المرفق" class="btn  engaz-btn-light transform" />
                    </div>
                </div>
            </form>
           
        </div>
    </div>
  </div>


      </div>
      <div class="modal-footer">
       
        {{-- <div class="form-group text-center col-4 order-2">
          <input type="submit"  class="engaz-btn transform" value="طلب تعميد">
        </div> --}}
      </div>
    </div>
  </div>
</div> {{-- end upload_img --}}

<form method="POST" id="delete_image_form" action="{{ route('delete_image')}}">
    @csrf
    <input type="hidden" value="" name="imageName" id="imageName">

</form>

<script>
$(document).ready(function(){


  $('#OpenImgUpload').click(function(){ $('.imgupload').trigger('click'); });


  document.getElementById("file").onchange = function() {
   $("#uploadImageBtn").trigger('click');

};

    $('#addImageForm').ajaxForm({
      beforeSend:function(){
        $('#tableImage').empty();
        $('#tableActions').empty();
        

      },
      uploadProgress:function(event, position, total, percentComplete)
      {

        $('#uploading').show();
        $('.progress-bar').text(percentComplete + '%');
        $('.progress-bar').css('width', percentComplete + '%');
      },
      success:function(data)
      {
         $('#uploading').hide();
        if(data.errors)
        {
          $('.progress-bar').text('0%');
          $('.progress-bar').css('width', '0%');
          
          $('#tableMsg').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
          
        }
        if(data.success)
        {
            $('.progress-bar').text('تم تحميل المرفق بنجاح');
            $('.progress-bar').css('width', '100%');
            $('#success #tableMsg').html('<span class="text-success"><b>'+data.success+'</b></span>');
            $('#success #tableActionsDel').attr('onClick', data.image_name);
            $('#success #tableImage').html(data.image);
            $('#responseInput').append(data.image_input);


          
          
        }
      }
    });

});

function delete_image_form(name) {

    console.log(name);
    
}
</script>