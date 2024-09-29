<div id="responseInput"></div>

<div class="col-12">

  
              <div class="form-group">
                <label for=""> المرفقات<span style="font-size: 1rem; padding: 0 10px;">(اختياري)</span> </label>
                <label id="OpenImgUpload" {{-- data-toggle="modal" data-target="#upload_img" --}} for="uploadFile" class="form-control transform custom-input" style="cursor: pointer; font-size: unset; text-align: center;">تحميل الملفات <svg xmlns="http://www.w3.org/2000/svg" width="21.363" height="21.363" viewBox="0 0 21.363 21.363">
                  <path id="Icon_material-add-circle-outline" data-name="Icon material-add-circle-outline" d="M14.75,8.341H12.613v4.273H8.341V14.75h4.273v4.273H14.75V14.75h4.273V12.613H14.75ZM13.681,3A10.681,10.681,0,1,0,24.363,13.681,10.685,10.685,0,0,0,13.681,3Zm0,19.227a8.545,8.545,0,1,1,8.545-8.545A8.556,8.556,0,0,1,13.681,22.227Z" transform="translate(-3 -3)" fill="#853bcc"/>
                  </svg>
                </label>
        {{-- <a data-toggle="modal" data-target="#upload_img"  class="engaz-btn transform" id="sss" >upload_img</a> --}}

                {{-- <input type="file" multiple class="form-control transform" id="uploadFile" name="uploadFile" style="opacity: 0;position: absolute;width: 50px;z-index: -1;"> --}}
              </div>
                <div id="uploading" style="display:none">

                  <div class="progress">
                    <div class="progress-bar" style="background-color:#3CBFAF!important" role="progressbar" aria-valuenow=""
                    aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                      0%
                    </div>
                  </div>

                </div>
              <div id="success">
                <table class="table table-responsive">
                  <thead>
                  <tr>
                    <th id="tableImage"></th>
                    <th id="tableMsg"></th>
                    <th id="tableActions">
                      <span id="tableActionsDel" > <i class="fa fa-times"></i>حذف المرفق</span>
                    </th>
                  </tr>
                  </thead>
                </table>
              </div>
            </div>