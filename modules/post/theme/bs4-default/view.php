<?php
// 이전글 다음글 구하기
$prev_uid=getDbCnt($table[$m.'data'],'max(uid)',$setque.' and uid<'.$uid);
$next_uid=getDbCnt($table[$m.'data'],'min(uid)',$setque.' and uid>'.$uid);
$prev_link=$g['blog_view'].$prev_uid;
$next_link=$g['blog_view'].$next_uid;

// 이미지 Resize 함수
function getPreviewResize($image,$size)
{
 $_array=explode('.',$image);
 $name=$_array[0];
 $ext=$_array[1];
 $result=$name.'_'.$size.'.'.$ext;

 return $result;
}

?>

<?php if($upload_data&&$attach_file_num>0):?>
<?php
$img_files = array();
$audio_files = array();
$video_files = array();
$down_files = array();

foreach($upload_data as $_u){
  if($_u['type']==2 and $_u['hidden']==0) array_push($img_files,$_u);
  else if($_u['type']==4 and $_u['hidden']==0) array_push($audio_files,$_u);
  else if($_u['type']==5 and $_u['hidden']==0) array_push($video_files,$_u);
  else if($_u['type']==1 || $_u['type']==6 || $_u['type']==7 and $_u['hidden']==0) array_push($down_files,$_u);
}
$attach_photo_num = count ($img_files);
$attach_video_num = count ($video_files);
$attach_audio_num = count ($audio_files);
$attach_down_num = count ($down_files);
?>
<?php endif?>

<?php

$_WTIT=strip_tags($g['meta_tit']);
$_link_url=$g['url_root'].$_SERVER['REQUEST_URI'];
 ?>

<link href="<?php echo $g['url_module_skin']?>/github-markdown.css" rel="stylesheet">

<!-- captionjs : https://captionjs.com/ -->
<?php getImport('captionjs','jquery.caption.min',false,'js') ?>

<!-- http://www.mediaelementjs.com/ -->
<?php getImport('mediaelement','build/mediaelementplayer','3.0.3','css') ?>


<section class="rb-module-post">

  <div class="pagehead">
    <div class="container d-flex justify-content-start align-items-center">

      <h1>
        <a class="muted-link text-gray-light" href="<?php echo $g['blog_home'] ?>">
          <small class="fa fa-home" aria-hidden="true"></small>
        </a>
        <span class="blog-title">
          <?php echo $R['subject']?>
        </span>

      </h1>
      <div class="ml-auto">
        <button type="button" class="btn btn-light d-none" data-history="back" role="button">이전가기</button>
      </div>
    </div><!-- /.container -->
  </div><!-- /.pagehead -->


  <div class="container clearfix">

    <div class="blog-aside d-print-none">
      <?php include $g['dir_module_skin'].'_aside.php';?>
    </div><!-- /.blog-aside -->

    <div class="blog-content">

      <ul class="list-inline align-self-end">
          <li class="list-inline-item">
            <i class="fa fa-calendar" aria-hidden="true"></i> <?php echo getDateFormat($R['d_regis'],'Y/m/d') ?>
          </li>
          <?php if($R['d_modify']):?>
          <li class="list-inline-item">
            (<?php echo '수정 : '.getDateFormat($R['d_modify'],'Y-m-d H:i') ?>)
          </li>
          <?php endif?>
          <li class="list-inline-item pl-2">
            작성자 : <?php echo $M['name']?>
          </li>
          <li class="list-inline-item pl-2">
            조회 : <?php echo $R['hit']?>
          </li>
          <li class="list-inline-item pl-2">
            댓글 : <a class="muted-link" href="#comments"><?php echo $R['comment']?></a>
          </li>
      </ul>

      <article class="markdown-body">
        <!-- 오디오 -->
        <?php if($attach_audio_num>0):?>
        <div class="mt-2 mb-4">
          <ul class="list-group mb-2 px-0">
            <?php foreach($audio_files as $_u):?>
            <?php if($_u['hidden']) continue?>
            <li class="list-group-item justify-content-between bg-faded">
              <audio controls class="align-middle">
                <source src="<?php echo $_u['url']?><?php echo $_u['folder']?>/<?php echo $_u['tmpname']?>" type="audio/<?php echo $_u['ext']?>">
              </audio>
            <span class="badge badge-secondary badge-pill"><?php echo $_u['name']?></span>
            </li>
            <?php endforeach?>
          </ul>
        </div>
        <?php endif?>
        <!-- //오디오 -->

        <div class="rb-article">

          <?php if ($R['review']): ?>
            <blockquote>
              <?php echo $R['review'] ?>
            </blockquote>
          <?php endif; ?>

          <!-- 사진 -->
          <!-- 이전데이터에서 사진이 추가될 경우 본문 삽입처리 -->
          <?php if($attach_photo_num>0 and $uid<9293400):?>

            <ul class="list-inline float-right">
              <?php foreach($img_files as $_u):?>

              <?php
                $img_origin=$_u['tmpname'];
                $thumb_list=getPreviewResize($img_origin,''); // 미리보기 사이즈 조정 (이미지 업로드시 썸네일을 만들 필요 없다.)
                $thumb_modal=getPreviewResize($img_origin,''); // 정보수정 모달용  사이즈 조정 (이미지 업로드시 썸네일을 만들 필요 없다.)
              ?>
                <li class="list-inline-item">
                  <img src="<?php echo $_u['url'] ?><?php echo$_u['folder'] ?>/<?php echo $_u['tmpname'] ?>" alt="">
                </li>
              <?php endforeach?>
            </ul>
          <?php endif?>

           <?php echo getContents($R['content'],'HTML')?>

          <?php if($upload_data&&$attach_file_num>0):?>
          <dl class="file_div">
              <dt class="">첨부</dt>
              <dd class="">
                  <ul class="list-unstyled">
                   <?php foreach($upload_data as $_u):?>
                      <?php if($_u['hidden']==1) continue?>
                      <li>
                          <i class="fa fa-floppy-o fa-fw"></i>
                          <a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=attach&amp;a=download&amp;uid=<?php echo $_u['uid']?>"><?php echo $_u['name']?></a>
                          <span class="rb-size"><?php echo getSizeFormat($_u['size'],1)?></span>
                          <span class="rb-down" data-toggle="tooltip" title="다운로드 수"><?php echo number_format($_u['down'])?></span>
                      </li>
                      <?php endforeach?>
                  </ul>
             </dd>
          </dl>
          <?php endif?>

            <?php if($R['tag']):?>
            <dl class="rb-tag">
                <dt>태그</dt>
                <dd>
                    <ul class="list-inline">
                     <?php $_tags=explode(',',$R['tag'])?>
                     <?php $_tagn=count($_tags)?>
                     <?php $i=0;for($i = 0; $i < $_tagn; $i++):?>
                     <?php $_tagk=trim($_tags[$i])?>
                        <li class="list-inline-item">#<a href="<?php echo $g['blog_front']?>list&amp;where=<?php echo $table[$m.'data']?>.tag&amp;keyword=<?php echo urlencode($_tagk)?>"><?php echo $_tagk?></a></li>
                      <?php endfor?>
                    </ul>
                </dd>
            </dl>
            <?php endif?>


      </article>


      <div class="d-flex justify-content-between mt-4 px-0 py-4 d-print-none border-top">
        <div class="btn-group">
          <?php if($my['admin'] || $my['uid']==$R['mbruid']):?>
          <a href="<?php echo $g['blog_front']?>write&amp;uid=<?php echo $R['uid']?>&amp;cat=<?php echo $cat?>&amp;vtype=<?php echo $vtype?>&amp;recnum=<?php echo $recnum?>" class="btn btn-light">수정</a>
          <a href="<?php echo $g['blog_act']?>post_delete&amp;uid=<?php echo $R['uid']?>" onclick="return hrefCheck(this,true,'정말로 삭제하시겠습니까?');" class="btn btn-light">삭제</a>
          <?php endif?>
        </div>

        <div class="">
          <a href="<?php echo $prev_link ?>" class="btn btn-light<?php if ($prev_uid == 0) :?>  disabled<?php endif?>">이전글</a>
          <a href="<?php echo $next_link ?>" class="btn btn-light<?php if ($next_uid == 0) :?>  disabled<?php endif?>">다음글</a>
        </div>
        <div class="btn-group">

          <a href="<?php echo $g['blog_front']?>list" class="btn btn-light">목록</a>
        </div>

      </div><!-- /.card-footer -->

        <div class="rb-blog-footer">

          <?php if($upload_data&&$attach_file_num>0):?>
          <dl class="row">
              <dt class="col-1 m-0 pr-0"><small style="color: #333">첨부</small></dt>
              <dd class="col-9">
                  <ul class="list-unstyled">
                   <?php foreach($upload_data as $_u):?>
                      <?php if($_u['hidden']) continue?>
                      <li>
                          <i class="fa fa-floppy-o fa-fw"></i>
                          <a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=attach&amp;a=download&amp;uid=<?php echo $_u['uid']?>"><?php echo $_u['name']?></a>
                          <span class="rb-size"><?php echo getSizeFormat($_u['size'],1)?></span>
                          <span class="rb-down" data-toggle="tooltip" title="다운로드 수"><?php echo number_format($_u['down'])?></span>
                      </li>
                      <?php endforeach?>
                  </ul>
             </dd>
          </dl>
          <?php endif?>


          <!-- 댓글 -->
          <div class="mt-4 d-print-none" id="comments">
              <?php getWidget('default/comment',array('module'=>'post','parent_uid' => $R['uid'],'parent_table'=>'rb_post_data','theme' => 'bs4-default'))?>
          </div><!-- /댓글 -->

        </div><!-- /.rb-blog-footer -->


    </div><!-- /.blog-content -->
  </div><!-- /.container -->


</section><!-- view 끝 -->

<!-- http://www.mediaelementjs.com/ -->
<?php getImport('mediaelement','build/mediaelement-and-player.min','3.0.3','js') ?>
<?php getImport('mediaelement','build/lang/ko','3.0.3','js') ?>


<?php getImport('zero-clipboard','ZeroClipboard.min',false,'js') ?>

<script type="text/javascript">

$(function() {

  // history.back
  $(document).on('click','[data-history="back"]',function(e){
    e.preventDefault();
    history.back();
  });

  $('[data-toggle="tooltip"]').tooltip()

  $('.rb-article .mejs-player').mediaelementplayer();

  $('.rb-article img').captionjs({
    'force_dimensions': false
  });

  // 인쇄
  $('#printButton').on('click', function () {
    window.print();
  });

  //메뉴
  $('.rb-share').on('click', function () {
      $(this).popover({
        placement: 'bottom',
        container: 'body',
        html: true,
        trigger: 'manual',
        template: '<div class="popover rb-share" role="tooltip"><div class="arrow"></div><div class="popover-content"></div></div>',
        content: function() {
          return $('#rb-share').html();
        }
      }).popover('toggle');
      $('[data-toggle="tooltip"]').tooltip()

  });

  $('html').on('click', function(e) {
    if (typeof $(e.target).data('original-title') == 'undefined' && !$(e.target).parents().is('.popover.show')) {
      $('[data-original-title]').popover('hide');
    }
  });

  $('[data-toggle="share"]').on('shown.bs.popover', function () {
    // zero-clipboard : https://github.com/zeroclipboard/zeroclipboard
    var client = new ZeroClipboard($(".rb-clipboard"));
    client.on( "ready", function( readyEvent ) {
    	client.on( "aftercopy", function( event ) {
    		$('.tooltip .tooltip-inner').text('복사되었습니다');
    	});
    });

  })

  $('[data-toggle="share"]').on('hidden.bs.popover', function () {
    $('.popover-content li').tooltip('hide')
  })

});

</script>
