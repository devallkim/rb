<style media="screen">
  .mejs-player  iframe {
    max-width: 100% !important
  }
</style>


<div class="rb-attach-youtube" id="rb-attach-youtube-wrapper">

      <ul class="list-group list-group-flush rb-attach-youtube" data-role="attach-preview-youtube"><!-- 링크 프리뷰 리스트 -->
         <?php if($parent_data['uid']):?>
              <?php echo getAttachPlatformList($parent_data,'upload','youtube')?>
          <?php endif?>
      </ul>

      <!-- 유튜브 링크 추가  -->
      <div class="modal fade" tabindex="-1" role="dialog" id="modal-attach-youtube">
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
                    <small class="form-text text-muted mt-2">예) https://youtu.be/NVgeV9ACexY</small>

                  </div>
                  <div class="modal-footer justify-content-between">
                    <div class="">
                      <button type="button" class="btn btn-light rb-preview" onclick="getYoutubePreview();">불러오기</button>
                      <button type="button" class="btn btn-light rb-reset ml-2" onclick="getYoutubeReset();">초기화</button>
                    </div>
                    <div class="">
                      <button type="button" class="btn btn-light" data-dismiss="modal">닫기</button>
                      <button type="button" class="btn btn-light" data-role="btn-addYoutube" data-attach-act="saveYoutube" data-linkData="" disabled>추가하기</button>
                    </div>
                  </div>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
</div>

<!-- 첨부 사진 메타정보 수정 -->
<div class="modal fade rb-modal-attach-meta" id="modal-attach-youtube-meta" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 860px;">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id=""><i class="fa fa-youtube fa-lg"></i> 유튜브 비디오 정보수정</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- data-role="img-preview" src="_s 이미지" data-origin="원본 이미지" 넣는다. -->
                    <div class="col-md-7 video-col">
                      <video class="mejs-player img-fluid"  style="max-width:100%;" preload="none">
                          <source data-role="src" type="video/youtube">
                      </video>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="link-title" class="sr-only">제목:</label>
                            <input type="text" class="form-control" data-role="caption" name="title" value="" placeholder="제목을 입력해주세요.">
                        </div>
                        <div class="form-group">
                            <label for="link-caption" class="sr-only">내용:</label>
                            <textarea class="form-control" data-role="description" placeholder="내용을 입력해주세요."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="link-caption" class="control-label">시간:</label>
                            <input type="text" class="form-control" data-role="time">
                        </div>
                        <div class="form-group">
                            <label for="link-caption" class="control-label">삽입비율:</label>
                            <select class="form-control custom-select">
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
                <button type="button" class="btn btn-light" data-dismiss="modal" data-attach-act="cancel" data-role="eventHandler" data-id="">취소하기</button>
                <button type="button" class="btn btn-primary" data-attach-act="editYoutube" data-target="#modal-attach-youtube-meta" data-role="eventHandler" data-id="">저장하기</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo $g['url_attach_theme']?>/main-youtube.js"></script>

<!-- 동영상,유튜브,오디오 player : http://www.mediaelementjs.com/ -->
<?php getImport('mediaelement','mediaelement-and-player.min','4.2.8','js') ?>
<?php getImport('mediaelement','lang/ko','4.2.8','js') ?>
<?php getImport('mediaelement','mediaelementplayer','4.2.8','css') ?>

<script>

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
       $('.rb-preview').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-light');
   		 return false;
  }
    var gx3 = '<video class="mejs-player" style="max-width:100%;" preload="none"><source src="https://www.youtube.com/embed/'+gx2+'" type="video/youtube"></video>'
  	$('#_youtube_play_layer_').html(gx3);
    $('#_youtube_play_layer_ .mejs-player').mediaelementplayer();
    $('[data-attach-act="saveYoutube"]').removeAttr('disabled').removeClass('btn-light').addClass('btn-primary')
  	isGetVod = true;

    var dataArray = { "title":gx2, "src":gx2, "thumb":gx2};
    var youtubeArray = JSON.stringify(dataArray);
    $('[data-role="btn-addYoutube"]').attr('data-linkdata',youtubeArray);

  }

  function getYoutubeReset() {
    $('#_youtube_play_layer_').html('');
    $('#_youtube_url_').val('').focus();
    $('[data-attach-act="saveYoutube"]').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-light');
    $('.rb-preview').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-light');
  }

  $('[data-attach-act="saveYoutube"]').click(function(){  // 저장시 모달 닫음
    $('#modal-attach-youtube').modal('hide')
  });

  var link_settings={
    module : 'mediaset',
    theme : '<?php echo $g['dir_attach_theme']?>',
  };

  $('#rb-attach-youtube-wrapper').RbAttachYoutube(link_settings);

  // youtube 추가 모달 초기화
  $('#modal-attach-youtube').on('show.bs.modal', function () {
    $('#_youtube_url_').val('');
    $('[data-attach-act="saveYoutube"]').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-light')
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
    $(this).find('.video-col').html('<video class="mejs-player img-fluid" style="max-width:100%;" preload="none"><source data-role="src" type="video/youtube"></video>');
  })

  $('#_youtube_url_').on('keyup', function() {

    if ($(this).val().length >= 5) {
      $('.rb-preview').removeAttr('disabled').removeClass('btn-light').addClass('btn-primary')
    } else {
      $('.rb-preview').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-light');
    }
  });

  $('.rb-preview').on('click', function() {
    $(this).removeClass('btn-primary').addClass('btn-light')
  });

</script>
