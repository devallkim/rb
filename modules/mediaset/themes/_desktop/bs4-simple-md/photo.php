<div id="attach-form-photo"><!-- 파일폼 출력 --></div>

<div data-role="rb-attach-wrapper-photo">
    <div class="rb-attach">
      <ul class="list-group list-group-flush rb-attach-photo" data-role="attach-preview-photo"><!-- 포토/이미지  리스트  -->
       <?php if($parent_data['uid']):?>
       <?php echo getAttachFileList($parent_data,'upload','photo')?>
        <?php endif?>
      </ul>
    </div>

    <!-- 첨부 사진 메타정보 수정 -->
    <div class="modal fade rb-modal-attach-meta" id="modal-attach-photo-meta" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id=""><i class="fa fa-camera-retro"></i> 사진 정보수정</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- data-role="img-preview" src="_s 이미지" data-origin="원본 이미지" 넣는다. -->
                        <div class="col-md-4"><p><img class="img-thumbnail" src="" alt="" data-role="img-preview" data-origin=""></p></div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="file-name" class="control-label">파일명:</label>
                                <div class="input-group">
                                  <input type="text" class="form-control" data-role="filename" name="filename">
                                  <div class="input-group-append">
                                    <span class="input-group-text" data-role="fileext"></span>
                                  </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file-caption" class="control-label">캡션:</label>
                                <textarea class="form-control" data-role="filecaption"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal" data-attach-act="cancel" data-target="#modal-attach-photo-meta" data-role="eventHandler" data-id="">취소하기</button>
                    <button type="button" class="btn btn-primary" data-attach-act="save-photo" data-target="#modal-attach-photo-meta" data-role="eventHandler" data-id="">저장하기</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo $g['url_attach_theme']?>/main-photo.js"></script>
<script src="<?php echo $g['url_attach_theme']?>/js/file-upload/fileuploader.js"></script>

<script>

$('#modal-attach-photo-meta').appendTo('body');

var inputPhotoId='attach-input-photo'; // 실제 작옹하는 input 엘리먼트 id 값을 옵션으로 지정을 해준다. (커스텀 버튼으로 click 이벤트 바인딩)
var attach_file_saveDir = '<?php echo $g['path_file'].$parent_module?>/';// 파일 업로드 폴더
var attach_module_theme = '<?php echo $attach_module_theme?>';// attach 모듈 테마
$(document).ready(function()
{
       // 파일업로드 옵션값 세팅 및 초기화
       var photo_upload_settings = {
           //allowedTypes:"jpg,png,gif,hwp,doc,pdf,ppt,pptx,xls,xlsx,zip",// 업로드 가능한 파일 확장자. 여기에 명시하지 않으면 파일 확장자 필터링하지 않음.
            fileName: "files", // <input type="file" name=""> 의 name 값 --> php 에서 파일처리할 때 사용됨.
            multiple: true, // 멀티업로드를 할 경우 true 로 해준다.
            event_handler : '[data-role="attach-handler-photo"]', // 업로드 버튼 엘리먼트
            formData: {"saveDir":attach_file_saveDir,"theme":attach_module_theme} // 추가 데이타 세팅
       }
       $("#attach-form-photo").RbUploadFile(photo_upload_settings); // 아작스 폼+input=file 엘리먼트 세팅

        // main.js 기본값 세팅 : 이 옵션값 적용 엘리먼트는 해당 object 페이지에서 고유의 값을 세팅한다. 스크립트 중복실행 방지
        var attach_photo_settings={
          module : 'mediaset',
          theme : '<?php echo $g['dir_attach_theme']?>',
          handler_getModalList : '<?php echo $attach_handler_getModalList?>',
          listModal : '#modal-attach'
        }

       // main.js 기본값 세팅 :
       $('[data-role="rb-attach-wrapper-photo"]').RbAttachPhoto(attach_photo_settings);

});


$('#modal-attach-photo-meta').on('shown.bs.modal', function (event) {

  var button = $(event.relatedTarget) // Button that triggered the modal
  var uid = button.data('id');
  var type = button.data('type'); // file or photo

  // data 값 세팅
  var filename = button.attr('data-filename'); // data-로 하면 변경된 값 적용 안됨
  var fileext = button.data('fileext');
  var caption = button.attr('data-caption'); // data-로 하면 변경된 값 적용 안됨
 //  var caption = button.attr('data-caption'); // data- 로 하면 변경된 값 적용 안됨
  var img_thumb = button.data('src');// 미리보기 이미지

  var modal = $(this)
  // data 값 모달에 적용
  modal.find('[data-role="filename"]').val(filename).focus();
  modal.find('[data-role="fileext"]').text(fileext);
  modal.find('[data-role="filecaption"]').val(caption);
  modal.find('[data-role="eventHandler"]').attr('data-id',uid); // save, cancel 엘리먼트 data-id="" 값에 uid 값 적용
  modal.find('[data-role="eventHandler"]').attr('data-type',type); // save, cancel 엘리먼트 data-type="" 값에 type 값 적용
  modal.find('[data-role="img-preview"]').attr('src',img_thumb); // 미리보기 이미지 src 적용

})

$('#modal-attach-photo-meta').on('hidden.bs.modal', function (event) {
  $(this).find('[data-role="filename"]').val(''); // 입력된 파일명 초기화
  $(this).find('[data-role="fileext"]').text(''); // 입력된 파일 확장자명 초기화
  $(this).find('[data-role="filecaption"]').val(''); // 입력된 캡션명 초기화
  $(this).find('[data-role="img-preview"]').attr('src',''); // 적용된 섬네일 초기화

})
</script>
