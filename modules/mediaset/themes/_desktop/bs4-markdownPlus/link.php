<link href="<?php echo $g['url_attach_theme']?>/css/linkpreview.css" rel="stylesheet">
<div class="rb-attach-link" id="rb-attach-link-wrapper">

  <ul class="list-group rb-attach-link" data-role="attach-preview-link"><!-- 링크 프리뷰 리스트 -->
    <?php if($parent_data['uid']):?>
    <?php echo getAttachLinkList($parent_data,$parent_module)?>
    <?php endif?>
  </ul>
  <button type="button" class="btn btn-link btn-block" data-toggle="modal" data-target="modal-attach-link">추가하기</button>

  <!-- 링크 추가  -->
  <div class="modal fade" tabindex="-1" role="dialog" id="modal-attach-link">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><i class="media-object fa fa-globe fa-lg"></i> 링크 추가</h4>
        </div>
        <div class="modal-body">
          <p id="attach-linkpreview-wrapper"><!--링크 입력 textarea 동적 생성 --></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left">불러오기</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
          <button type="button" class="btn btn-primary" data-role="btn-addLink" data-attach-act="saveLink" data-linkData="">추가하기</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

</div>

<script src="<?php echo $g['url_attach_theme']?>/js/link-preview/linkPreview.js"></script>
<script src="<?php echo $g['url_attach_theme']?>/main-link.js"></script>

<script>
$(document).ready(function() {
  var link_settings={
    module : 'attach',
    theme : '<?php echo $g['dir_attach_theme']?>',
    placeholder : 'URL 을 입력해주세요'
  }
  $('#attach-linkpreview-wrapper').linkPreview(link_settings);

  var link_settings={
    module : 'attach',
    theme : '<?php echo $g['dir_attach_theme']?>',
    linkSelector : 'attach-linkpreview-wrapper' // 위 link_settings 옵션 selector 와 같게 해준다.
  }

  $('#rb-attach-link-wrapper').RbAttachLink(link_settings);

  $('[data-attach-act="saveLink"]').click(function(){  // 저장시 모달 닫음
    $('#modal-attach-link').modal('hide')
  });

  $('#modal-attach-link').on('show.bs.modal', function () {
    $('#preview_attach-linkpreview-wrapper').css('display','none');
    $('#text_attach-linkpreview-wrapper').val('')
  })
  $('#modal-attach-link').on('shown.bs.modal', function () {
    $('#text_attach-linkpreview-wrapper').focus()
  })

});

</script>
