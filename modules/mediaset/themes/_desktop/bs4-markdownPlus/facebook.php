
<div class="rb-attach-facebook" id="rb-attach-facebook-wrapper">
      <ul class="list-group rb-attach-facebook" data-role="attach-preview-facebook"><!-- 링크 프리뷰 리스트 -->
         <?php if($parent_data['uid']):?>
             <?php echo getAttachfacebookList($parent_data['uid'],$parent_module)?>
          <?php endif?>
      </ul>
      <div class="panel-body">
            <p><button type="button" class="btn btn-link btn-block" data-toggle="modal" data-target="modal-attach-facebook">추가하기</button></p>
      </div>

      <!-- 페이스북 링크 추가  -->
      <div class="modal fade" tabindex="-1" role="dialog" id="modal-attach-facebook">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title"><i class="fa fa-facebook fa-lg"></i> 페이스북 비디오 추가</h4>
                  </div>
                  <div class="modal-body">
                    <div id="_facebook_play_layer_" class="media-pic">
                    </div>
                    <form name="_upload_form1_" action="<?php echo $g['s']?>/" method="post" target="_upload_iframe_">
                    <input type="hidden" name="r" value="<?php echo $r?>">
                    <input type="hidden" name="m" value="mediaset">
                    <input type="hidden" name="a" value="upload_vod">
                    <input type="hidden" name="gparam" value="<?php echo $gparam?>">
                    <input type="hidden" name="category" value="<?php echo $_album?>">
                    <input type="hidden" name="mediaset" value="Y">
                    <input type="hidden" name="link" value="Y">
                    <input name="src" id="_facebook_url_" class="form-control" type="text" value="" placeholder="비디오 URL을 입력하세요.">
                    <span class="help-block text-muted">예) https://www.facebook.com/ABCNews/videos/10155345236708812/</span>
                    </form>

                  </div>
                  <div class="modal-footer">

                    <button type="button" class="btn btn-default rb-preview pull-left" onclick="getFacebookPreview();">불러오기</button>
                    <button type="button" class="btn btn-default rb-reset pull-left" onclick="getFacebookReset();">초기화</button>
                    <button type="button" class="btn btn-default pull-left" onclick="getFacebookSave();">저장하기</button>

                    <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                    <button type="button" class="btn btn-default" data-role="btn-addFacebook" data-attach-act="saveFacebook" data-linkData="" disabled>리스트에 추가하기</button>

                  </div>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
</div>

<!-- 첨부 사진 메타정보 수정 -->
<div class="modal fade rb-modal-attach-meta" id="modal-attach-facebook-meta" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id=""><i class="fa fa-facebook fa-lg"></i> 페이스북 동영상 정보수정</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- data-role="img-preview" src="_s 이미지" data-origin="원본 이미지" 넣는다. -->
                    <div class="col-md-7">
                      <video class="mejs-player img-responsive"  style="max-width:100%;" preload="none">
                          <source src="https://www.facebook.com/ABCNews/videos/10155345236708812/" type="video/facebook">
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
                <button type="button" class="btn btn-default" data-dismiss="modal" data-attach-act="cancel" data-target="#modal-attach-facebook-meta" data-role="eventHandler" data-id="">취소하기</button>
                <button type="button" class="btn btn-primary" data-attach-act="save-facebook" data-target="#modal-attach-facebook-meta" data-role="eventHandler" data-id="">저장하기</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo $g['url_attach_theme']?>/main-facebook.js"></script>

<script>


function getFacebookPreview() {

	var gx1 = $('#_facebook_url_').val();
  if(gx1.indexOf('/videos/') > 0){
       gx2 = gx1.split('/videos/')[1];
  } else  {
     alert('규격에 맞지 않습니다.');
     $('#_facebook_url_').val('').focus();
     $('.rb-preview').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-default');
 		 return false;
}
  var gx3 = '<video class="mejs-player" preload="none"><source src="https://www.facebook.com/ABCNews/videos/10155345236708812/" type="video/facebook"></video>'
	$('#_facebook_play_layer_').html(gx3);
  $('[data-attach-act="savefacebook"]').removeAttr('disabled').removeClass('btn-default').addClass('btn-primary')
	isGetVod = true;

  // http://www.mediaelementjs.com/
  $('.mejs-player').mediaelementplayer();

}

function getFacebookReset() {
  $('#_facebook_play_layer_').html('');
  $('#_facebook_url_').val('').focus();
  $('[data-attach-act="savefacebook"]').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-default');
  $('.rb-preview').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-default');
}

function getFacebookSave() {
	if (isGetVod == false)
	{
		alert('동영상을 불러온 후 저장해 주세요.');
		return false;
	}
	//if (confirm('<?php echo _LANG('m0032','mediaset')?>    '))
	//{
		var f = document._upload_form1_;
		f.submit();
	//}
	return false;
}


// facebook 추가 모달 초기화
$('#modal-attach-facebook').on('show.bs.modal', function () {
  $('#_facebook_url_').val('');
  $('[data-attach-act="savefacebook"]').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-default')
})
$('#modal-attach-facebook').on('shown.bs.modal', function () {
  $('#_facebook_url_').focus();
})
$('#modal-attach-facebook').on('hidden.bs.modal', function () {
  $('#_facebook_play_layer_').html('');
})


$('#modal-attach-facebook-meta').on('shown.bs.modal', function () {
  $('#link-title').focus();
})
$('#modal-attach-facebook-meta').on('hidden.bs.modal', function () {
  $('#_facebook_play_layer_').html('');
})

$('#_facebook_url_').on('keyup', function() {

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
