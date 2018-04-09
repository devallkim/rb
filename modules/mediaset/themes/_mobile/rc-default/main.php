<style>
.rb-attach .table-view:empty {
  display: none !important
}
</style>

  <?php
  include $g['dir_attach_theme'].'/header.php';
  ?>

  <div id="attach-files" class="files"><!-- 파일폼 출력 --></div>

  <div class="backdrop hidden" data-dismiss="sheet" id="attach-files-backdrop"></div>
  <div class="rb-attach"><!-- 포토/이미지  리스트  -->
    <ul class="table-view bg-white" data-role="attach-preview-photo">
      <?php if($parent_data['uid']):?>
      <?php echo getAttachFileList($parent_data,'upload','photo')?>
      <?php endif?>
    </ul>

    <!-- 일반파일 리스트  -->
    <ul class="table-view bg-white" data-role="attach-preview-file">
      <?php if($parent_data['uid']):?>
      <?php echo getAttachFileList($parent_data,'upload','file')?>
      <?php echo getAttachFileList($parent_data,'upload','doc')?>
      <?php echo getAttachFileList($parent_data,'upload','zip')?>
      <?php endif?>
    </ul>

    <!-- 오디오 리스트  -->
    <ul class="table-view bg-white" data-role="attach-preview-audio">
      <?php if($parent_data['uid']):?>
      <?php echo getAttachFileList($parent_data,'upload','audio')?>
      <?php endif?>
    </ul>

    <!-- 비디오 리스트  -->
    <div class="table-view bg-white" data-role="attach-preview-video">
      <?php if($parent_data['uid']):?>
      <?php echo getAttachFileList($parent_data,'upload','video')?>
      <?php endif?>
    </div>

    <!-- 유튜브 리스트  -->
    <ul class="table-view bg-white" data-role="attach-preview-youtube">
      <?php if($parent_data['uid']):?>
      <?php echo getAttachPlatformList($parent_data,'upload','youtube')?>
      <?php endif?>
    </ul>

  </div>

    <!-- 유튜브 링크 추가  -->
    <div class="modal" tabindex="-1" role="dialog" id="modal-attach-youtube">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"><i class="fa fa-youtube fa-lg"></i> 유튜브 비디오 추가</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <div id="_youtube_play_layer_" class="media-pic">

                  </div>

                  <input name="src" id="_youtube_url_" class="form-control input-lg" type="text" value="" placeholder="비디오 URL을 입력하세요.">
                  <span class="help-block text-muted">예) https://youtu.be/NVgeV9ACexY</span>

                </div>
                <div class="modal-footer">

                  <div class="mr-auto">
                    <button type="button" class="btn btn-default rb-preview" onclick="getYoutubePreview();" role="button">불러오기</button>
                    <button type="button" class="btn btn-default rb-reset" onclick="getYoutubeReset();" role="button">초기화</button>
                  </div>


                  <button type="button" class="btn btn-default" data-dismiss="modal" role="button">닫기</button>
                  <button type="button" class="btn btn-default" data-role="btn-addYoutube" data-attach-act="saveYoutube" data-linkData="" disabled  role="button">추가하기</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->




  <!-- 첨부 사진 메타정보 수정 -->
  <div class="modal fade rb-modal-attach-meta" id="modal-attach-youtube-meta" tabindex="-1" role="dialog" aria-labelledby="">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id=""><i class="fa fa-youtube fa-lg"></i> 유튜브 비디오 정보수정</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <!-- data-role="img-preview" src="_s 이미지" data-origin="원본 이미지" 넣는다. -->
                      <div class="col-md-7 video-col">
                        <video class="mejs-player img-responsive"  style="max-width:100%;" preload="none">
                            <source data-role="src" type="video/youtube">
                        </video>
                      </div>
                      <div class="col-md-5">
                              <div class="form-group">
                                  <label for="link-title" class="control-label">제목:</label>
                                  <input type="text" class="form-control" data-role="caption" name="title" value="" placeholder="제목을 입력해주세요.">
                              </div>
                              <div class="form-group">
                                  <label for="link-caption" class="control-label">내용:</label>
                                  <textarea class="form-control" data-role="description"></textarea>
                              </div>
                              <div class="form-group">
                                  <label for="link-caption" class="control-label">시간:</label>
                                  <input type="text" class="form-control" data-role="time">
                              </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal" data-attach-act="cancel" data-role="eventHandler" data-id="" role="button">취소하기</button>
                  <button type="button" class="btn btn-primary" data-attach-act="editYoutube" data-target="#modal-attach-youtube-meta" data-role="eventHandler" data-id=""  role="button">저장하기</button>
              </div>
          </div>
      </div>
  </div>

  <script src="<?php echo $g['url_attach_theme']?>/main.js"></script>

  <?php
    include $g['dir_attach_theme'].'/footer.php';
  ?>


<!-- sheet -->
<div id="attach-moreAct" class="sheet bg-faded">
  <ul class="table-view table-view-full bg-white">
    <li class="table-view-cell table-view-divider" data-dismiss="sheet"><span data-role="title"></span></li>
    <li class="table-view-cell" data-attach-act="featured-img">대표이미지 설정</li>
    <li class="table-view-cell hidden" data-attach-act="showhide">정보수정</li>
    <li class="table-view-cell" data-attach-act="delete">삭제</li>
  </ul>
</div>


<script>

  $('#attach-moreAct').on('shown.rc.sheet', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var uid = button.attr('data-id')
    var type = button.attr('data-type')
    var name = button.attr('data-name')
    var insert_text = button.attr('data-insert')
    var sheet = $(this)
    $('#attach-files-backdrop').removeClass('hidden')
    sheet.find('[data-role="insert_text"]').val(insert_text)
    sheet.find('[data-attach-act="featured-img"]').attr('data-id',uid).attr('data-type',type)
    sheet.find('[data-attach-act="delete"]').attr('data-id',uid).attr('data-type',type)

    if (type!='photo') { // 이미지가 아닐 경우
      sheet.find('[data-attach-act="featured-img"]').addClass('hidden')  // 대표이미지 항목 숨김처리함
    }

  })
  $('#attach-files-backdrop').tap(function() { // 백드롭을 터치하면
    $('#attach-moreAct').removeClass('active') // 시트를 닫고
    $(this).addClass('hidden'); // 백드롭을 숨김
  });

  $('#attach-moreAct').find('.table-view-cell').tap(function() { // 시트에 항목을 터치하면
    var sheet = $('#attach-moreAct')
    sheet.removeClass('active') // 시트를 닫고
    $('#attach-files-backdrop').addClass('hidden'); // 백드롭을 숨김
  });



  $('#modal-attach-youtube-meta').appendTo('body');
  $('#modal-attach-youtube').appendTo('body');


  function getYoutubePreview() {

  	var gx1 = $('#_youtube_url_').val();
    if(gx1.indexOf('watch?v=') > 0){
         gx2 = gx1.split('watch?v=')[1];
    } else if(gx1.indexOf('youtu.be/') > 0) {
         gx2 = gx1.split('youtu.be/')[1];
    }
    else  {
       alert('규격에 맞지 않습니다.');
       $('#_youtube_url_').val('').focus();
       $('.rb-preview').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-default');
   		 return false;
  }
    var gx3 = '<video class="mejs-player"  style="max-width:100%;" preload="none"><source src="https://www.youtube.com/embed/'+gx2+'" type="video/youtube"></video>'
  	$('#_youtube_play_layer_').html(gx3);
    $('#_youtube_play_layer_ .mejs-player').mediaelementplayer();
    $('[data-attach-act="saveYoutube"]').removeAttr('disabled').removeClass('btn-default').addClass('btn-primary')
  	isGetVod = true;



    var dataArray = { "title":gx2, "src":gx2, "thumb":gx2};
    var youtubeArray = JSON.stringify(dataArray);
    $('[data-role="btn-addYoutube"]').attr('data-linkdata',youtubeArray);

  }

  function getYoutubeReset() {
    $('#_youtube_play_layer_').html('');
    $('#_youtube_url_').val('').focus();
    $('[data-attach-act="saveYoutube"]').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-default');
    $('.rb-preview').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-default');
  }

  $('[data-attach-act="saveYoutube"]').click(function(){  // 저장시 모달 닫음
    $('#modal-attach-youtube').modal('hide')
  });

  var link_settings={
    module : 'attach',
    theme : '<?php echo $g['dir_attach_theme']?>',
  };

  //$('#rb-attach-youtube-wrapper').RbAttachYoutube(link_settings);

  // youtube 추가 모달 초기화
  $('#modal-attach-youtube').on('show.bs.modal', function () {
    $('#_youtube_url_').val('');
    $('[data-attach-act="saveYoutube"]').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-default')
  })
  $('#modal-attach-youtube').on('shown.bs.modal', function () {
    $('#_youtube_url_').focus();
  })
  $('#modal-attach-youtube').on('hidden.bs.modal', function () {
    $('#_youtube_play_layer_').html('');
  })

  $('#modal-attach-youtube-meta').on('shown.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Button that triggered the modal
    var uid = button.data('id');
    var type = button.data('type'); // file or photo

    // data 값 세팅
    var filename = button.data('filename');
    var caption = button.attr('data-caption');
    var description = button.attr('data-description');
    var time = button.attr('data-time');
    var youtube_embed = 'https://www.youtube.com/embed/';// 미리보기 이미지

    var modal = $(this)
    // data 값 모달에 적용 description
    modal.find('[data-role="caption"]').val(caption).focus();
    modal.find('[data-role="description"]').val(description);
    modal.find('[data-role="time"]').val(time);
    modal.find('[data-role="eventHandler"]').attr('data-id',uid); // save, cancel 엘리먼트 data-id="" 값에 uid 값 적용
    modal.find('[data-role="eventHandler"]').attr('data-type',type); // save, cancel 엘리먼트 data-type="" 값에 type 값 적용
    modal.find('[data-role="src"]').attr('src',youtube_embed + filename)

    $('.modal .mejs-player').mediaelementplayer();

  })

  $('#modal-attach-youtube-meta').on('hidden.bs.modal', function () {
    $(this).find('[data-role="caption"]').val(''); // 입력된 캡션명 초기화
    $(this).find('[data-role="description"]').val(''); // 입력된 description 초기화
    $(this).find('.video-col').html('<video class="mejs-player img-responsive"  style="max-width:100%;" preload="none"><source data-role="src" type="video/youtube"></video>');
  })

  $('#_youtube_url_').on('keyup', function() {

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
