


<div class="rb-attach-vimeo" id="rb-attach-vimeo-wrapper">
      <ul class="list-group rb-attach-vimeo" data-role="attach-preview-vimeo"><!-- 링크 프리뷰 리스트 -->
         <?php if($parent_data['uid']):?>
             <?php echo getAttachvimeoList($parent_data['uid'],$parent_module)?>
          <?php endif?>
      </ul>
      <div class="panel-body">
            <p><button type="button" class="btn btn-link btn-block" data-toggle="modal" data-target="modal-attach-vimeo">추가하기</button></p>
      </div>

      <!-- 유튜브 링크 추가  -->
      <div class="modal fade" tabindex="-1" role="dialog" id="modal-attach-vimeo">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title"><i class="fa fa-vimeo fa-lg"></i> 비메오 비디오 추가</h4>
                  </div>
                  <div class="modal-body">
                    <div id="_vimeo_play_layer_" class="media-pic">

                    </div>
                    <form name="_upload_form1_" action="<?php echo $g['s']?>/" method="post" target="_upload_iframe_">
                    <input type="hidden" name="r" value="<?php echo $r?>">
                    <input type="hidden" name="m" value="mediaset">
                    <input type="hidden" name="a" value="upload_vod">
                    <input type="hidden" name="gparam" value="<?php echo $gparam?>">
                    <input type="hidden" name="category" value="<?php echo $_album?>">
                    <input type="hidden" name="mediaset" value="Y">
                    <input type="hidden" name="link" value="Y">
                    <input name="src" id="_vimeo_url_" class="form-control input-lg" type="text" value="" placeholder="비디오 URL을 입력하세요.">
                    <span class="help-block text-muted">예) https://vimeo.com/201926132</span>
                    </form>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default rb-preview pull-left" onclick="getVimeoPreview();">불러오기</button>
                    <button type="button" class="btn btn-default rb-reset pull-left" onclick="getVimeoReset();">초기화</button>
                    <button type="button" class="btn btn-default pull-left" onclick="getVimeoSave();">저장하기</button>

                    <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                    <button type="button" class="btn btn-default" data-role="btn-addVimeo" data-attach-act="saveVimeo" data-linkData="" disabled>리스트에 추가하기</button>
                  </div>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
</div>

<!-- 첨부 사진 메타정보 수정 -->
<div class="modal fade rb-modal-attach-meta" id="modal-attach-vimeo-meta" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id=""><i class="fa fa-vimeo fa-lg"></i> 비메오 동영상 정보수정</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- data-role="img-preview" src="_s 이미지" data-origin="원본 이미지" 넣는다. -->
                    <div class="col-md-7">

                        <video class="mejs-player img-responsive"  style="max-width:100%;"  preload="none">
                            <source src="https://player.vimeo.com/video/185717440?title=0&amp;byline=0&amp;portrait=0&amp;badge=0" type="video/vimeo">
                        </video>

                    </div>
                    <div class="col-md-5">
                            <div class="form-group">
                                <label for="link-title" class="control-label">제목:</label>
                                <input type="text" class="form-control" data-role="linkTitle" name="filename" id="link-title">
                            </div>
                            <div class="form-group">
                                <label for="link-caption" class="control-label">요약:</label>
                                <textarea class="form-control" data-role="linkCaption"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="link-caption" class="control-label">시간:</label>
                                <input type="text" class="form-control" data-role="linkTitle" name="filename">
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
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" data-attach-act="cancel" data-target="#modal-attach-vimeo-meta" data-role="eventHandler" data-id="">취소하기</button>
                <button type="button" class="btn btn-primary" data-attach-act="save-vimeo" data-target="#modal-attach-vimeo-meta" data-role="eventHandler" data-id="">저장하기</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo $g['url_attach_theme']?>/main-vimeo.js"></script>

<script>

function getVimeoPreview() {

  var gx1 = $('#_vimeo_url_').val();

  if(gx1.indexOf('vimeo.com/') > 0){
       gx2 = gx1.split('vimeo.com/')[1];
  } else  {
     alert('규격에 맞지 않습니다.');
     $('#_vimeo_url_').val('').focus();
     $('.rb-preview').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-default');
 		 return false;
  }

  var gx3 = '<video class="mejs-player"  style="max-width:100%;" preload="none"><source src="https://player.vimeo.com/video/'+gx2+'?title=0&amp;byline=0&amp;portrait=0&amp;badge=0" type="video/vimeo"></video>'
  $('#_vimeo_play_layer_').html(gx3);
  $('[data-attach-act="saveVimeo"]').removeAttr('disabled').removeClass('btn-default').addClass('btn-primary')
  isGetVod = true;

  // http://www.mediaelementjs.com/
  $('.mejs-player').mediaelementplayer();

}

function getVimeoReset() {
  $('#_vimeo_play_layer_').html('');
  $('#_vimeo_url_').val('').focus();
  $('[data-attach-act="saveVimeo"]').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-default');
  $('.rb-preview').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-default');
}

// vimeo 추가 모달 초기화
$('#modal-attach-vimeo').on('show.bs.modal', function () {
  $('#_vimeo_url_').val('');
  $('[data-attach-act="savevimeo"]').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-default')
})
$('#modal-attach-vimeo').on('shown.bs.modal', function () {
  $('#_vimeo_url_').focus();
})
$('#modal-attach-vimeo').on('hidden.bs.modal', function () {
  $('#_vimeo_play_layer_').html('');
})


$('#modal-attach-vimeo-meta').on('shown.bs.modal', function () {
  $('#link-title').focus();
})
$('#modal-attach-vimeo-meta').on('hidden.bs.modal', function () {
  $('#_vimeo_play_layer_').html('');
})

$('#_vimeo_url_').on('keyup', function() {

  if ($(this).val().length >= 5) {
    $('.rb-preview').removeAttr('disabled').removeClass('btn-default').addClass('btn-primary')
  } else {
    $('.rb-preview').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-default');
  }
});

$('.rb-preview').on('click', function() {
  $(this).removeClass('btn-primary').addClass('btn-default')
});

</script>
