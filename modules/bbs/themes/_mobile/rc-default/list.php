<?php
if ($c) $g['bbs_reset']	= getLinkFilter($g['s'].'/?'.($_HS['usescode']?'r='.$r.'&amp;':'').'c='.$c,array($skin?'skin':'',$iframe?'iframe':''));
else $g['bbs_reset']	= getLinkFilter($g['s'].'/?'.($_HS['usescode']?'r='.$r.'&amp;':'').'m='.$m,array($bid?'bid':'',$skin?'skin':'',$iframe?'iframe':''));
?>


<section id="page-bbs-list" class="rb-bbs-list page center" data-role="bbs-list" data-snap-ignore="true">

  <header class="bar bar-nav bar-dark bg-primary p-x-0">

    <a href="#drawer-left" data-toggle="drawer" class="icon icon-bars pull-left p-x-1" role="button"></a>

    <?php if ($my['uid']): ?>
    <a class="btn btn-link btn-nav pull-right p-x-1" href="<?php echo $g['bbs_write']?>">
      <span class="icon icon-compose"></span>
    </a>
    <?php else: ?>
    <a class="btn btn-link btn-nav pull-right p-x-1" href="#modal-login" data-toggle="modal" data-title="<?php echo stripslashes($d['layout']['header_title'])?>">
      <span class="icon icon-compose"></span>
    </a>
    <?php endif; ?>

    <h1 class="title">
      <a href="<?php echo $g['bbs_reset'] ?>"><?php echo $B['name']?$B['name']:($_HM['name']?$_HM['name']:$_HP['name'])?></a>
    </h1>
  </header>

  <?php if ($NUM_NOTICE || $B['category'] || $d['theme']['search']): ?>
  <div class="bar bar-standard bar-header-secondary bg-white px-0">
    <nav class="nav nav-inline">
      <!-- 동적생성 -->
    </nav>
  </div>
  <?php endif; ?>

  <?php if ($TPG > 1 && !$type): ?>
  <footer class="bar bar-standard bar-footer bar-light bg-white p-x-0">
    <div class="">
      <?php echo getPageLink_RC($d['theme']['pagenum'],$p,$TPG,'1')?>
    </div>
  </footer>
  <?php endif; ?>

  <main class="content rb-bbs-list" id="page-bbs-list" data-role="bbs-list">

    <div class="swiper-container">
      <div class="swiper-wrapper">

        <!-- 전체글 -->
        <div class="swiper-slide">
          <ul class="table-view my-0 border-top-0">
            <?php if ($cat || $keyword): ?>
            <li class="table-view-cell table-view-active text-muted">
              <i class="fa <?php echo $cat?'fa-folder-open-o':'fa-search' ?> fa-fw" aria-hidden="true"></i> <?php echo $cat ?> <?php echo $keyword ?> <small>(<?php echo $NUM ?>건)</small>
              <a class="btn btn-secondary js-btn-href" href="<?php echo $g['bbs_reset'] ?>" ><i class="fa fa-history fa-lg" aria-hidden="true"></i></a>
            </li>
            <?php endif; ?>

            <?php if ($NUM): ?>
            <!-- 일반글 출력부 -->
            <?php foreach($RCD as $R):?>
            <?php $R['mobile']=isMobileConnect($R['agent'])?>
            <li class="table-view-cell<?php echo $R['depth']?' rb-reply rb-reply-0'.$R['depth']:'' ?><?php echo $R['hidden']?' secret':'' ?>" id="item-<?php echo $R['uid']?>">
              <a data-title="<?php echo $B['name']?>"
                 data-toggle="page"
                 data-target="#page-bbs-view"
                 data-start="#page-bbs-list"
                 data-subject="<?php echo $R['subject']?>"
                 data-cat="<?php echo $R['category']?>"
                 data-url="<?php echo $g['bbs_view'].$R['uid']?>"
                 data-bid="<?php echo $B['id']?>"
                 data-uid="<?php echo $R['uid'] ?>" role="button">

                <?php if (!$R['depth']): ?>
                  <?php if ($d['theme']['media_object']=='1'): ?>
                  <img class="media-object pull-left rb-avatar img-circle bg-faded" src="<?php echo getAavatarSrc($R['mbruid'],'84') ?>" width="42">
                  <?php elseif ($d['theme']['media_object']=='2'): ?>
                    <?php if (getUpImageSrc($R)): ?>
                      <img class="media-object pull-left bg-faded border" src="<?php echo getPreviewResize(getUpImageSrc($R),'q') ?>" width="60">
                    <?php endif; ?>
                  <?php else: ?>
                  <?php endif; ?>
                <?php else: ?>
                <span class="media-object pull-left"><span class="rb-icon fa fa-level-up fa-rotate-90"></span></span>
                <?php endif; ?>

                <span class="badge badge-default badge-outline text-xs-center rounded">
                  <strong data-role="total_comment"><?php echo $R['comment']?><?php echo $R['oneline']?'+'.$R['oneline']:''?></strong><br>
                  <small>댓글</small>
                </span>
                <div class="media-body">
                  <?php if(getNew($R['d_regis'],24)):?><span class="rb-new mr-1"></span><?php endif?>
                  <?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'')?>
                  <?php if($R['hidden']):?><span class="badge badge-default badge-inverted"><i class="fa fa-lock fa-lg"></i></span><?php endif?>
                  <p>
                    <?php if($R['notice']):?><span class="badge badge-primary badge-outline">공지</span><?php endif?>
                    <span class="badge badge-default badge-inverted"><?php echo $R[$_HS['nametype']]?></span>
                    <?php if($R['category']):?><span class="badge badge-default badge-inverted"><i class="fa fa-folder-o fa-fw"></i> <?php echo $R['category']?></span><?php endif?>
                    <time class="badge badge-default badge-inverted" <?php echo $d['theme']['timeago']?'data-plugin="timeago"':'' ?> datetime="<?php echo getDateFormat($R['d_regis'],'c')?>">
                      <?php echo getDateFormat($R['d_regis'],'Y.m.d')?>
                    </time>
                    <span class="badge badge-default badge-inverted">조회 <?php echo $R['hit']?></span>
                    <span class="badge badge-default badge-inverted">좋아요 <?php echo $R['likes']?></span>
                    <?php if($R['upload']):?><span class="badge badge-default badge-inverted"><i class="fa fa-floppy-o"></i></span><?php endif?>
                  </p>
                </div>
              </a>
            </li>
            <?php endforeach?>

            <?php else: ?>
            <div class="rb-none">
              <div class="text-xs-center">
                <div class="display-1">
                  <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                </div>
                <p>게시물이 없습니다.</p>
                <?php if ($keyword): ?><a href="<?php echo $g['bbs_reset'] ?>&type=search" class="btn btn-outline-primary btn-lg">재검색</a><?php endif; ?>
                <?php if ($cat): ?><a href="<?php echo $g['bbs_reset'] ?>&type=category" class="btn btn-outline-primary btn-lg">재탐색</a><?php endif; ?>
              </div>
            </div>
            <?php endif; ?>
          </ul>
        </div><!-- /.swiper-slide -->

        <!-- 공지 -->

        <?php if ($NUM_NOTICE): ?>
        <div class="swiper-slide">
          <ul class="table-view border-top-0 mt-0">
            <?php foreach($NCD as $R):?>
            <?php $R['mobile']=isMobileConnect($R['agent'])?>
            <li class="table-view-cell<?php echo $R['depth']?' rb-reply rb-reply-0'.$R['depth']:'' ?><?php echo $R['hidden']?' secret':'' ?>" id="item-<?php echo $R['uid']?>">
              <a data-title="게시물 보기"
                 data-toggle="page"
                 data-target="#page-bbs-view"
                 data-start="#page-bbs-list"
                 data-subject="<?php echo $R['subject']?>"
                 data-cat="<?php echo $R['category']?>"
                 data-url="<?php echo $g['bbs_view'].$R['uid']?>"
                 data-bid="<?php echo $B['id']?>"
                 data-uid="<?php echo $R['uid'] ?>" role="button">
                <?php if (!$R['depth']): ?>
                  <?php if ($d['theme']['media_object']=='1'): ?>
                  <img class="media-object pull-left rb-avatar img-circle bg-faded" src="<?php echo getAavatarSrc($R['mbruid'],'84') ?>" width="42">
                  <?php elseif ($d['theme']['media_object']=='2'): ?>
                    <?php if (getUpImageSrc($R)): ?>
                      <img class="media-object pull-left bg-faded border" src="<?php echo getPreviewResize(getUpImageSrc($R),'q') ?>" width="60">
                    <?php endif; ?>
                  <?php else: ?>
                  <?php endif; ?>
                <?php else: ?>
                <span class="media-object pull-left"><span class="rb-icon fa fa-level-up fa-rotate-90"></span></span>
                <?php endif; ?>

                <span class="badge badge-default badge-outline text-xs-center rounded">
                  <strong data-role="total_comment"><?php echo $R['comment']?><?php echo $R['oneline']?'+'.$R['oneline']:''?></strong><br>
                  <small>댓글</small>
                </span>
                <div class="media-body">
                  <?php if(getNew($R['d_regis'],24)):?><span class="rb-new mr-1"></span><?php endif?>
                  <?php if($R['hidden']):?><span class="badge badge-default badge-inverted"><i class="fa fa-lock"></i></span><?php endif?>
                  <?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'')?>
                  <p>
                    <?php if($R['notice']):?><span class="badge badge-primary badge-outline">공지</span><?php endif?>
                    <?php if($R['category']):?><span class="badge badge-default badge-inverted"><i class="fa fa-folder-o fa-fw"></i> <?php echo $R['category']?></span><?php endif?>
                    <time class="badge badge-default badge-inverted" <?php echo $d['theme']['timeago']?'data-plugin="timeago"':'' ?> datetime="<?php echo getDateFormat($R['d_regis'],'c')?>">
                      <?php echo getDateFormat($R['d_regis'],'Y.m.d')?>
                    </time>
                    <span class="badge badge-default badge-inverted">조회 <?php echo $R['hit']?></span>
                    <span class="badge badge-default badge-inverted">좋아요 <?php echo $R['likes']?></span>
                    <?php if($R['upload']):?><span class="badge badge-default badge-inverted"><i class="fa fa-floppy-o"></i></span><?php endif?>
                  </p>
                </div>
              </a>
            </li>
            <?php endforeach?>
          </ul>

        </div><!-- /.swiper-slide -->
        <?php endif; ?>


        <!-- 분류 -->
        <?php if($B['category']):$_catexp = explode(',',$B['category']);$_catnum=count($_catexp)?>
        <div class="swiper-slide">
          <ul class="table-view border-top-0 mt-0">
            <li class="table-view-divider"><?php echo $_catexp[0]?></li>
            <?php for($i = 1; $i < $_catnum; $i++):if(!$_catexp[$i])continue;?>
            <li class="table-view-cell">
              <a href="<?php echo $g['bbs_reset'] ?>&cat=<?php echo $_catexp[$i]?>">
                <i class="fa fa-folder-o fa-fw" aria-hidden="true"></i> <?php echo $_catexp[$i]?>
                <?php if($d['theme']['show_catnum']):?>
                <span class="badge badge-pill"><?php echo getDbRows($table[$m.'data'],'site='.$s.' and notice=0 and bbs='.$B['uid']." and category='".$_catexp[$i]."'")?></span>
                <?php endif?>
              </a>
            </li>
            <?php endfor?>
          </ul>
        </div><!-- /.swiper-slide -->
        <?php endif; ?>

        <!-- 검색 -->
        <?php if($d['theme']['search']):?>
        <div class="swiper-slide">
          <form class="content-padded" name="bbssearchf" action="<?php echo $g['s']?>/">
            <input type="hidden" name="r" value="<?php echo $r?>">
            <input type="hidden" name="c" value="<?php echo $c?>">
            <input type="hidden" name="m" value="<?php echo $m?>">
            <input type="hidden" name="bid" value="<?php echo $bid?>">
            <input type="hidden" name="sort" value="<?php echo $sort?>">
            <input type="hidden" name="orderby" value="<?php echo $orderby?>">
            <input type="hidden" name="recnum" value="<?php echo $recnum?>">
            <input type="hidden" name="type" value="<?php echo $type?>">
            <input type="hidden" name="iframe" value="<?php echo $iframe?>">
            <input type="hidden" name="skin" value="<?php echo $skin?>">
            <input type="hidden" name="type" value="">

            <div class="form-group">
              <label class="sr-only">검색범위</label>
              <select class="form-control" name="where" style="width: 92%;height: 1.5rem;">
                <option value="subject|tag"<?php if($where=='subject|tag'):?> selected="selected"<?php endif?>>제목+태그</option>
                <option value="content"<?php if($where=='content'):?> selected="selected"<?php endif?>>본문</option>
                <option value="name"<?php if($where=='name'):?> selected="selected"<?php endif?>>이름</option>
                <option value="nic"<?php if($where=='nic'):?> selected="selected"<?php endif?>>닉네임</option>
                <option value="id"<?php if($where=='id'):?> selected="selected"<?php endif?>>아이디</option>
              </select>
            </div>

            <div class="form-group">
              <label class="sr-only">검색어</label>
              <input type="search" class="form-control" placeholder="검색어를 입력해주세요." name="keyword" value="<?php echo $_keyword?>" autocomplete="off">
            </div>

          </form>
        </div><!-- /.swiper-slide -->
        <?php endif; ?>

      </div><!-- /.swiper-wrapper -->
    </div><!-- /.swiper-container -->
  </main>

</section>


<section id="page-bbs-view" class="page right">
  <input type="hidden" name="bid" value="">
  <input type="hidden" name="uid" value="">
  <input type="hidden" name="theme" value="">
  <header class="bar bar-nav bar-dark bg-primary p-x-0">
		<a class="icon icon-left-nav pull-left p-x-1" role="button" data-history="back"></a>
    <h1 class="title" data-role="title">
      <?php echo $B['name']?$B['name']:($_HM['name']?$_HM['name']:$_HP['name'])?>
    </h1>
  </header>
  <div class="content">
    <div class="content-padded" data-role="post">
      <span data-role="cat" class="badge badge-primary badge-inverted">카테고리</span>
      <h3 data-role="subject" class="rb-article-title">게시물 제목</h3>
    </div>

    <div data-role="article">
      본문내용
    </div>

    <div data-role="attach">

      <!-- 유튜브 -->
      <div class="card-group mb-3 hidden" data-role="attach-youtube">
      </div>

      <!-- 비디오 -->
      <div class="mb-3 hidden" data-role="attach-video">
      </div>

      <!-- 오디오 -->
      <ul class="table-view table-view-full bg-white mb-3 hidden" data-role="attach-audio">
      </ul>

      <!-- 이미지 -->
      <div class="card-group mb-3 hidden" data-role="attach-photo" data-plugin="photoswipe">
      </div>

      <!-- 기타파일 -->
      <ul class="table-view table-view-full bg-white mb-3 hidden" data-role="attach-file">
      </ul>
    </div>


  </div>
</section>

<!-- 전체댓글보기 -->
<section id="page-bbs-allcomments" class="page right" data-role="comment">
  <div class="commentting-all"></div>
</section>


<!-- 모달 댓글 출력관련  -->

<?php $d['bbs']['c_mskin_modal'] = '_mobile/rc-modal'; ?>

<link href="<?php echo $g['url_root']?>/modules/comment/themes/<?php echo $d['bbs']['c_mskin_modal']?>/css/style.css" rel="stylesheet">
<script src="<?php echo $g['url_module_skin'] ?>/js/getPostData.js" ></script>

<script>

var settings={
  type    : 'page', // 타입(modal,page)
  mid     : '#page-bbs-view', // 컴포넌트 아이디
  ctheme  : '<?php echo $d['bbs']['c_mskin_modal']?>' //모달 댓글테마
}

$(function () {
  // 사용자 액션에 대한 피드백 메시지 제공을 위해 액션 실행후 쿠키에 저장된 결과 메시지를 출력시키고 초기화 시킵니다.
  putCookieAlert('bbs_action_result') // 실행결과 알림 메시지 출력

  getPostData(settings); // 모달 출력관련


  <?php if ($NUM_NOTICE || $B['category'] || $d['theme']['search']): ?>
  // 상단 navi(swiper)
  var bar_nav = new Swiper('.swiper-container', {
    autoHeight: true,
    pagination: {
      el: '.nav-inline',
      dynamicBullets: false,
      type: 'bullets',
      className : 'nav-link',
      bulletClass: 'nav-link',
      bulletActiveClass : 'active' ,
      clickable: true,
      renderBullet: function (index, className) {
        var title;

        <?php if (!$NUM_NOTICE && $B['category'] && !$d['theme']['search']): ?>
        if (index === 0) title = '전체글'
        if (index === 1) title = '분류'
        <?php elseif (!$NUM_NOTICE && !$B['category'] && $d['theme']['search']): ?>
        if (index === 0) title = '전체글'
        if (index === 1) title = '검색'
        <?php elseif (!$NUM_NOTICE && $B['category'] && $d['theme']['search']): ?>
        if (index === 0) title = '전체글'
        if (index === 1) title = '분류'
        if (index === 2) title = '검색'
        <?php elseif ($NUM_NOTICE && $B['category'] && !$d['theme']['search']): ?>
        if (index === 0) title = '전체글'
        if (index === 1) title = '공지'
        if (index === 2) title = '분류'
        <?php elseif ($NUM_NOTICE && !$B['category'] && $d['theme']['search']): ?>
        if (index === 0) title = '전체글'
        if (index === 1) title = '공지'
        if (index === 2) title = '검색'
        <?php else: ?>
        if (index === 0) title = '전체글'
        if (index === 1) title = '공지'
        if (index === 2) title = '분류'
        if (index === 3) title = '검색'
        <?php endif; ?>
        return '<a class=" ' + className + '">'+title+'</a>';
      }
    }
  });

  bar_nav.on('slideChange', function () {
    if (bar_nav.activeIndex == 0) {
        $('.bar-footer').removeClass("d-none");
    } else {
        $('.bar-footer').addClass("d-none");
    }
  });
  <?php endif; ?>

})

</script>
