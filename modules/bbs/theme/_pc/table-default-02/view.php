<?php
// 이전글 다음글 구하기
$_bbsque ="site='".$s."' and bbs='".$B['uid']."' and category='".$cat."'";
$prev_uid=getDbCnt($table[$m.'data'],'max(uid)',$_bbsque.' and uid<'.$uid);
$next_uid=getDbCnt($table[$m.'data'],'min(uid)',$_bbsque.' and uid>'.$uid);
$prev_link=$g['bbs_view'].$prev_uid;
$next_link=$g['bbs_view'].$next_uid;


?>

<link href="<?php echo $g['url_module_skin']?>/_main.css" rel="stylesheet">

<section class="rb-bbs rb-bbs-view">

  <div class="rb-bbs-heading">
    <div class="d-flex align-items-center">
      <h1 class="my-0">
        <i class="fa fa-circle-o text-primary align-middle" aria-hidden="true"></i>
        <?php echo $B['name']?>
      </h1>
      <div class="ml-auto">
        <a href="<?php echo $g['bbs_list']?>" class="btn btn-primary">목록</a>
      </div>
    </div>
  </div>

  <div class="card rb-bbs-body">
    <div class="card-header">
      <h3>
          <?php echo $R['subject']?>
      </h3>
      <div class="rb-meta d-flex justify-content-start">
          <ul class="list-inline align-self-end">
              <li class="list-inline-item">
                <?php echo getDateFormat($R['d_regis'],'Y/m/d') ?>
              </li>
              <li class="list-inline-item">
                작성자 : <?php echo $R[$_HS['nametype']]?>
              </li>
          </ul>

          <ul class="list-inline align-self-end ml-auto d-print-none">
              <li class="list-inline-item">
                <a href="#" id="printButton">인쇄</a>
              </li>
              <li class="list-inline-item hidd">
                <a href="<?php echo $g['bbs_action']?>singo&amp;uid=<?php echo $R['uid']?>">신고</a>
              </li>
          </ul>
      </div>
    </div><!-- /.card-header -->

    <div class="rb-bbs-body card-block rb-article">
      <?php echo getContents($R['content'],$R['html'])?>
    </div>
    <div class="card-footer d-flex justify-content-between px-0">

      <div class="">
        <?php if($my['admin'] || $my['uid']==$R['mbruid']):?>
        <div class="btn-group">
            <a href="<?php echo $g['bbs_modify'].$R['uid']?>" class="btn btn-secondary">수정</a>
            <a href="<?php echo $g['bbs_delete'].$R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');"  class="btn btn-secondary">삭제</a>
        </div>
        <?php endif?>
      </div>

      <div class="">
        <a href="<?php echo $prev_link?>" class="btn btn-secondary<?php echo !$prev_uid?' disabled':''?>">이전글</a>
        <a href="<?php echo $next_link?>" class="btn btn-secondary<?php echo !$next_uid?' disabled':''?>">다음글</a>
      </div>

      <div class="btn-group">
        <?php if($my['admin']&&$d['theme']['use_reply']):?>
          <a href="<?php echo $g['bbs_reply'].$R['uid']?>" class="btn btn-secondary">답변</a>
        <?php endif?>
          <a href="<?php echo $g['bbs_list']?>" class="btn btn-secondary">목록</a>
      </div>

    </div><!-- /.card-footer -->
  </div><!-- /.card -->


    <div class="rb-bbs-footer">

        <?php if($R['tag']&&$d['theme']['show_tag']):?>
        <dl class="dl-horizontal rb-tag">
            <dt>태그</dt>
            <dd>
                <ul class="list-inline">
                    <?php $_tags=explode(',',$R['tag'])?>
                    <?php $_tagn=count($_tags)?>
                    <?php $i=0;for($i = 0; $i < $_tagn; $i++):?>
                    <?php $_tagk=trim($_tags[$i])?>
                    <li>#<a href="<?php echo $g['bbs_orign']?>&amp;where=subject|tag&amp;keyword=<?php echo urlencode($_tagk)?>"><?php echo $_tagk?></a></li>
                    <?php endfor?>
                </ul>

            </dd>
        </dl>
        <?php endif?>

        <?php if($d['upload']['data']&&$d['theme']['show_upfile']&&$attach_file_num>0):?>
        <dl class="row">
            <dt class="col-1">첨부</dt>
            <dd class="col-11">
                <ul class="list-unstyled">
                     <?php foreach($d['upload']['data'] as $_u):?>
                    <?php if($_u['hidden']) continue?>
                    <li>
                        <img src="<?php echo $g['img_module_skin']?>/ico_attach.png" alt="첨부파일" class="align-text-top">
                        <a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=attach&amp;a=download&amp;uid=<?php echo $_u['uid']?>"><?php echo $_u['name']?></a>
                        <span class="badge badge-pill badge-default"><?php echo getSizeFormat($_u['size'],1)?></span>
                        <span class="badge badge-pill badge-default" data-toggle="tooltip" title="다운로드 수"><?php echo number_format($_u['down'])?></span>
                    </li>
                    <?php endforeach?>
                </ul>
           </dd>
        </dl>
        <?php endif?>

        <div class="hidden">
          <?php getWidget('default/comment',array('theme'=>'default','parent'=>$m.'-'.$R['uid'],'feed_table'=>$table[$m.'data']));?>
        </div>


    </div>
</section>

<!-- nivo-lightbox : https://github.com/gilbitron/Nivo-Lightbox -->
<?php getImport('nivo-lightbox','nivo-lightbox',false,'css') ?>
<?php getImport('nivo-lightbox','themes/default/default',false,'css') ?>
<?php getImport('nivo-lightbox','nivo-lightbox.min',false,'js') ?>

<!-- jQuery Text Resizer : http://trevordavis.net/blog/simple-jquery-text-resizer/ -->
<?php getImport('jquery-cookie','jquery-cookie',false,'js') ?>

<!-- theme js -->
<script src="<?php echo $g['url_module_skin']?>/_main.js"></script>

<script type="text/javascript">

$(function() {

  // 인쇄
  $('#printButton').on('click', function () {
    window.print();
  });

  //로그인체크
  function isLogin2() {
      if (memberid == '') {
          alert('로그인을 먼저 해주세요.  ');
          return false;
      }
      return true;
  }


});

</script>


<!-- 댓글 인클루드 -->
<?php if(!$d['bbs']['c_hidden']):?>
<?php //include $g['dir_module_skin'].'comment/list.php' ?>
<?php endif?>

<?php if($d['theme']['show_list']&&$print!='Y'):?>
<?php include_once $g['dir_module'].'mod/_list.php' ?>
<?php include_once $g['dir_module_skin'].'list.php' ?>
<?php endif?>
