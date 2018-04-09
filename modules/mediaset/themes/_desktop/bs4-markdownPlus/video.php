<style>
#modal-attach-video-meta .btn-group .btn {
  display: inline-block;
  margin-right: 4px;
  margin-bottom: 2px;
  padding: 0;
  border: 1px solid #eee;
  border-radius: 0
}
#modal-attach-video-meta .btn-group .btn.active {
  box-shadow: 0 0 0 3px #2e6da4;
}
</style>

<div id="attach-form-video"><!-- 파일폼 출력 --></div>
<div data-role="rb-attach-wrapper-video">
    <div class="rb-attach">
          <ul class="list-group list-group-flush rb-attach-video" data-role="attach-preview-video"><!-- 파일 리스트  -->
             <?php if($parent_data['uid']):?>
                 <?php echo getAttachFileList($parent_data,'upload','video')?>
              <?php endif?>
          </ul>

          <div class="panel-body">
               <button type="button" class="btn btn-link btn-block" data-role="attach-handler-video" data-type="file" data-label="업로드" data-loading-text="업로드 중..."><i class="fa fa-upload fa-fw"></i> <span>업로드</span></button>
          </div>
    </div>


    <!-- 첨부 파일 메타정보 수정 -->
    <div class="modal fade" id="modal-attach-video-meta" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id=""><i class="fa fa-file-video-o"></i> 비디오 정보수정</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">

                          <video class="mejs-player" style="max-width:100%;" preload="none" poster="http://www.mediaelementjs.com/images/big_buck_bunny.jpg">
                              <source src="http://clips.vorwaerts-gmbh.de/big_buck_bunny.mp4" type="video/mp4">
                          </video>
                          <hr>

                          <h4>미리보기 이미지 선택</h4>

                            <div class="btn-group" data-toggle="buttons" style="white-space: nowrap">
                              <label class="btn active">
                                <input type="radio" name="options" id="option1" autocomplete="off" checked>
                                <img src="/files/blog/2017/01/11/904f00d4c8c030a21c87ce209db268bb095614_64x64.jpg" alt="">
                              </label>
                              <label class="btn">
                                <input type="radio" name="options" id="option2" autocomplete="off">
                                <img src="/files/blog/2017/01/11/904f00d4c8c030a21c87ce209db268bb095614_64x64.jpg" alt="">
                              </label>
                              <label class="btn">
                                <input type="radio" name="options" id="option3" autocomplete="off">
                                <img src="/files/blog/2017/01/11/904f00d4c8c030a21c87ce209db268bb095614_64x64.jpg" alt="">
                              </label>
                              <label class="btn">
                                <input type="radio" name="options" id="option4" autocomplete="off">
                                <img src="/files/blog/2017/01/11/904f00d4c8c030a21c87ce209db268bb095614_64x64.jpg" alt="">
                              </label>
                              <label class="btn">
                                <input type="radio" name="options" id="option5" autocomplete="off">
                                <img src="/files/blog/2017/01/11/904f00d4c8c030a21c87ce209db268bb095614_64x64.jpg" alt="">
                              </label>
                              <label class="btn">
                                <input type="radio" name="options" id="option6" autocomplete="off">
                                <img src="/files/blog/2017/01/11/904f00d4c8c030a21c87ce209db268bb095614_64x64.jpg" alt="">
                              </label>
                              <label class="btn">
                                <input type="radio" name="options" id="option7" autocomplete="off">
                                <img src="/files/blog/2017/01/11/904f00d4c8c030a21c87ce209db268bb095614_64x64.jpg" alt="">
                              </label>
                            </div>
                            <p style="margin-top: 10px"><small class="text-muted">미리보기 이미지는 <code>사진추가</code>를 통해 등록할 수 있습니다.</small></p>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="file-name" class="sr-only">제목</label>
                                <input type="text" class="form-control" name="filename" data-role="filename" placeholder="제목">
                            </div>
                            <div class="form-group">
                                <label for="file-caption" class="sr-only">설명</label>
                                <textarea class="form-control" rows="3" data-role="filecaption" name="caption" placeholder="설명"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="file-caption" class="sr-only">태그</label>
                                <textarea class="form-control" rows="2" data-role="filetag" name="tag" placeholder="태그"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="link-caption" class="control-label">자막파일:</label>
                                <select class="form-control">
                                  <option value="">선택하세요</option>
                                  <option value="">mediaelement.vtt</option>
                                </select>
                                <small class="help-block text-muted">자막파일은 <code>파일첨부</code>를 통해 등록할 수 있습니다.</small>
                            </div>
                            <div class="form-group">
                                <label for="link-caption" class="control-label">삽입비율:</label>
                                <select class="form-control">
                                  <option value="21by9">21:9</option>
                                  <option value="16by9" selected>16:9</option>
                                  <option value="4by3">4:3</option>
                                  <option value="1by1">1:1</option>
                                </select>
                            </div>
                            <div class="well">
                              <ul class="list-inline" style="margin-bottom:0">
                                <li>용량 : 10M</li> <li>시간 : 01:00</li>
                              </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" data-attach-act="cancel" data-target="#modal-attach-video-meta" data-role="eventHandler" data-id="">취소하기</button>
                    <button type="button" class="btn btn-primary" data-attach-act="save-file" data-target="#modal-attach-video-meta" data-role="eventHandler" data-id="" data-type="">저장하기</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo $g['url_attach_theme']?>/main-video.js"></script>
<script>
// fileuploader.js 중복로드 방지
//if($.fn.RbUploadFile == undefined) $.getScript("<?php echo $g['url_attach_theme']?>/js/file-upload/fileuploader.js");

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
       $("#attach-form-video").RbUploadFile(file_upload_settings); // 아작스 폼+input=file 엘리먼트 세팅

       // main.js 기본값 세팅 : 이 옵션값 적용 엘리먼트는 해당 object 페이지에서 고유의 값을 세팅한다. 스크립트 중복실행 방지
        var attach_file_settings={
              module : 'mediaset',
              theme : '<?php echo $g['dir_attach_theme']?>',
              handler_getModalList : '<?php echo $attach_handler_getModalList?>',
              listModal : '#modal-attach'
        }

       // main.js 기본값 세팅 :
       $('[data-role="rb-attach-wrapper-file"]').RbAttachFile(attach_file_settings);

});
$(document).on('click','[data-toggle="modal"]',function(){
      var modal='#'+$(this).data('target');
      $(modal).appendTo('body');
      $(modal).modal({
         'show' :true
      });
})
</script>
