<div id="attach-form-file"><!-- 파일폼 출력 --></div>
<div data-role="rb-attach-wrapper-file">
    <div class="rb-attach">
          <ul class="list-group list-group-flush rb-attach-file" data-role="attach-preview-file"><!-- 파일 리스트  -->
             <?php if($parent_data['uid']):?>
                 <?php echo getAttachFileList($parent_data,'upload','file')?>
              <?php endif?>
          </ul>
    </div>


    <!-- 첨부 파일 메타정보 수정 -->
    <div class="modal fade rb-modal-attach-meta" id="modal-attach-file-meta" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id=""><i class="fa fa-floppy-o"></i> 첨부파일 정보수정</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4"><h1 class="text-center"><i class="fa fa-floppy-o fa-4x"></i></h1></div>
                        <div class="col-md-8">
                                <div class="form-group">
                                    <label for="file-name" class="control-label">파일명:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="filename" data-role="filename">
                                        <span class="input-group-addon" data-role="fileext"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="file-caption" class="control-label">캡션:</label>
                                    <textarea class="form-control" data-role="filecaption" name="caption"></textarea>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" data-attach-act="cancel" data-target="#modal-attach-file-meta" data-role="eventHandler" data-id="">취소하기</button>
                    <button type="button" class="btn btn-primary" data-attach-act="save-file" data-target="#modal-attach-file-meta" data-role="eventHandler" data-id="" data-type="">저장하기</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo $g['url_attach_theme']?>/main-file.js"></script>
<script>
// fileuploader.js 중복로드 방지
//if($.fn.RbUploadFile == undefined) $.getScript("<?php echo $g['url_attach_theme']?>/js/file-upload/fileuploader.js");

$('#modal-attach-file-meta').appendTo('body');

var inputFileId='attach-input-file'; // 실제 작옹하는 input 엘리먼트 id 값을 옵션으로 지정을 해준다. (커스텀 버튼으로 click 이벤트 바인딩)
var attach_file_saveDir = '<?php echo $g['path_file'].$parent_module?>/';// 파일 업로드 폴더
var attach_module_theme = '<?php echo $attach_module_theme?>';// attach 모듈 테마
$(document).ready(function()
{
       // 파일업로드 옵션값 세팅
       var file_upload_settings = {
           //allowedTypes:"jpg,png,gif,hwp,doc,pdf,ppt,pptx,xls,xlsx,zip",// 업로드 가능한 파일 확장자. 여기에 명시하지 않으면 파일 확장자 필터링하지 않음.
            fileName: "files", // <input type="file" name=""> 의 name 값 --> php 에서 파일처리할 때 사용됨.
            multiple: true, // 멀티업로드를 할 경우 true 로 해준다.
            event_handler : '[data-role="attach-handler-file"]', // 업로드 버튼  엘리먼트
            formData: {"saveDir":attach_file_saveDir,"theme":attach_module_theme} // 추가 데이타 세팅
       }
       $("#attach-form-file").RbUploadFile(file_upload_settings); // 아작스 폼+input=file 엘리먼트 세팅

       // main.js 기본값 세팅 : 이 옵션값 적용 엘리먼트는 해당 object 페이지에서 고유의 값을 세팅한다. 스크립트 중복실행 방지
        var attach_file_settings={
              module : 'mediaset',
              theme : '<?php echo $g['dir_attach_theme']?>',
              handler_getModalList : '<?php echo $attach_handler_getModalList?>',
              listModal : '#modal-attach'
        }

       // main.js 기본값 세팅 :
       $('[data-role="rb-attach-wrapper-file"]').RbAttachFile(attach_file_settings);


       $('#modal-attach-file-meta').on('shown.bs.modal', function (event) {

         var button = $(event.relatedTarget) // Button that triggered the modal
         var uid = button.data('id');
         var type = button.data('type'); // file or photo

         // data 값 세팅
         var filename = button.attr('data-filename'); // data-로 하면 변경된 값 적용 안됨
         var fileext = button.data('fileext');
         var caption = button.attr('data-caption'); // data-로 하면 변경된 값 적용 안됨
        //  var caption = button.attr('data-caption'); // data- 로 하면 변경된 값 적용 안됨

         var modal = $(this)
         // data 값 모달에 적용
         modal.find('[data-role="filename"]').val(filename);
         modal.find('[data-role="fileext"]').text(fileext);
         modal.find('[data-role="filecaption"]').val(caption).focus();;
         modal.find('[data-role="eventHandler"]').attr('data-id',uid); // save, cancel 엘리먼트 data-id="" 값에 uid 값 적용
         modal.find('[data-role="eventHandler"]').attr('data-type',type); // save, cancel 엘리먼트 data-type="" 값에 type 값 적용

       })

       $('#modal-attach-file-meta').on('hidden.bs.modal', function (event) {
         $(this).find('[data-role="filename"]').val(''); // 입력된 파일명 초기화
         $(this).find('[data-role="fileext"]').text(''); // 입력된 파일 확장자명 초기화
         $(this).find('[data-role="filecaption"]').val(''); // 입력된 캡션명 초기화
       })

});

</script>
