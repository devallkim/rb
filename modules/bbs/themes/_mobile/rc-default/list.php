<?php
if ($c) $g['bbs_reset']	= getLinkFilter($g['s'].'/?'.($_HS['usescode']?'r='.$r.'&amp;':'').'c='.$c,array($skin?'skin':'',$iframe?'iframe':''));
else $g['bbs_reset']	= getLinkFilter($g['s'].'/?'.($_HS['usescode']?'r='.$r.'&amp;':'').'m='.$m,array($bid?'bid':'',$skin?'skin':'',$iframe?'iframe':''));
?>

<section id="page-bbs-list">

  <header class="bar bar-nav bar-dark bg-primary p-x-0">
    <a class="btn btn-link btn-nav pull-left p-x-1" href="<?php echo RW(0)?>">
      <span class="icon icon-home"></span>
    </a>

    <?php if ($my['uid']): ?>
    <a class="btn btn-link btn-nav pull-right p-x-1" href="<?php echo $g['bbs_write']?>">
      <span class="icon icon-compose"></span>
    </a>
    <?php else: ?>
    <a class="btn btn-link btn-nav pull-right p-x-1" href="#modal-login" data-toggle="modal">
      <span class="icon icon-compose"></span>
    </a>
    <?php endif; ?>


    <h1 class="title" data-location="reload">
      <?php echo $B['name']?$B['name']:($_HM['name']?$_HM['name']:$_HP['name'])?>
    </h1>
  </header>

  <div class="bar bar-standard bar-header-secondary bg-white">
    <nav class="nav nav-inline">
      <a class="nav-link<?php echo !$type?' active':'' ?>" href="<?php echo $g['bbs_reset'] ?>" data-control="push">메인</a>
      <a class="nav-link<?php echo $type=="notice"?' active':'' ?>" href="<?php echo $g['bbs_reset'] ?>&type=notice" data-control="push">공지</a>
      <a class="nav-link<?php echo $type=="category"?' active':'' ?>" href="<?php echo $g['bbs_reset'] ?>&type=category" data-control="push">분류</a>
      <?php if($d['theme']['search']):?>
      <a class="nav-link<?php echo $type=="search"?' active':'' ?>" href="<?php echo $g['bbs_reset'] ?>&type=search" data-control="push">검색</a>
      <?php endif; ?>
      <a class="nav-link<?php echo $type=="my"?' active':'' ?>" href="<?php echo $g['bbs_reset'] ?>&type=my" data-control="push" >내글</a>
    </nav>
  </div>

  <?php if ($TPG > 1 && !$type): ?>
  <footer class="bar bar-standard bar-footer bar-light bg-white p-x-0">
    <div class="">
      <?php echo getPageLink_RC($d['theme']['pagenum'],$p,$TPG,'1')?>
    </div>
  </footer>
  <?php endif; ?>

  <main class="content" id="page-bbs-list">

    <?php if ($type=="scrap"): ?>

    <?php endif; ?>

    <?php if ($type=="my"): ?>

    <?php if ($my['uid']): ?>
    <div class="rb-panel rb-bbs-list">
      <div class="d-flex align-items-center justify-content-center text-muted" style="height: 400px">
        준비중입니다.
      </dic>
    </div>
    <?php else: ?>
    <div class="d-flex align-items-center justify-content-center text-muted" style="height: 350px">
      <div class="text-xs-center">
        <div class="display-1">
          <i class="fa fa-sign-in" aria-hidden="true"></i>
        </div>
        <p><small>로그인이 필요합니다.</small></p>
        <button type="button" name="button" class="btn btn-outline-primary btn-lg" data-toggle="modal" data-target="#modal-login">로그인</button>
      </div>
    </div>
    <?php endif; ?>


  <?php endif; ?>

    <?php if ($type=="notice"): ?>
      <div class="rb-panel rb-bbs-list">
        <ul class="table-view border-top-0">
          <?php foreach($NCD as $R):?>
          <?php $R['mobile']=isMobileConnect($R['agent'])?>
          <li class="table-view-cell<?php echo $R['depth']?' rb-reply rb-reply-0'.$R['depth']:'' ?>" id="item-<?php echo $R['uid']?>">
            <a
              data-toggle="modal"
              data-target="#modal-bbs-view"
              data-title="<?php echo htmlspecialchars($R['subject'])?>"
              data-cat="<?php echo $R['category']?>"
              data-hit="<?php echo $R['hit']?>"
              data-regisTime="<?php echo getDateFormat($R['d_regis'],'Y.m.d')?>"
              data-url="<?php echo $g['bbs_view'].$R['uid']?>"
              data-regisName="<?php echo $R[$_HS['nametype']]?>"
              data-avatarSrc="<?php echo getAavatarSrc($R['mbruid'],'84') ?>"
              data-uid="<?php echo $R['uid'] ?>">
              <?php if (!$R['depth']): ?>
              <img class="media-object pull-left rb-avatar img-circle bg-faded" src="<?php echo getAavatarSrc($R['mbruid'],'84') ?>">
              <?php else: ?>
              <span class="media-object pull-left"><span class="rb-icon fa fa-level-up fa-rotate-90"></span></span>
              <?php endif; ?>
              <?php if($R['comment']):?>
              <button class="btn btn-outlined" data-toggle="modal" data-target="modal-bbs-default" data-title="댓글보기"><?php echo $R['comment']?><?php echo $R['oneline']?'+'.$R['oneline']:''?></button>
              <?php endif?>
              <div class="media-body">
                <?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'')?>
                <p>
                  <span class="badge badge-primary badge-outline">공지</span>
                  <span class="badge badge-inverted"><?php echo getDateFormat($R['d_regis'],'Y.m.d')?></span>
                  <span class="badge badge-inverted">조회 <?php echo $R['hit']?></span>
                  <span class="badge badge-inverted">좋아요 2</span>
                  <?php if($R['hidden']):?><span class="badge badge-inverted"><i class="fa fa-lock"></i></span><?php endif?>
                  <?php if($R['upload']):?><span class="badge badge-inverted"><i class="fa fa-floppy-o"></i></span><?php endif?>
                  <?php if(getNew($R['d_regis'],24)):?><span class="badge badge-inverted badge-danger">N</span><?php endif?>
                </p>
              </div>
            </a>
          </li>
          <?php endforeach?>
        </ul>
      </div>
    <?php endif; ?>

    <?php if ($type=="search"): ?>
    <div class="content-padded">


      <form name="bbssearchf" action="<?php echo $g['s']?>/">
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
          <select class="form-control custom-select" name="where">
            <option value="subject|tag"<?php if($where=='subject|tag'):?> selected="selected"<?php endif?>>제목+태그</option>
            <option value="content"<?php if($where=='content'):?> selected="selected"<?php endif?>>본문</option>
            <option value="name"<?php if($where=='name'):?> selected="selected"<?php endif?>>이름</option>
            <option value="nic"<?php if($where=='nic'):?> selected="selected"<?php endif?>>닉네임</option>
            <option value="id"<?php if($where=='id'):?> selected="selected"<?php endif?>>아이디</option>
          </select>
        </div>

        <div class="form-group">
          <label class="sr-only">검색어</label>
          <input type="search" class="form-control" placeholder="검색어를 입력해주세요." name="keyword" value="<?php echo $_keyword?>" autocomplete="off" autofocus>
        </div>

      </form>
    </div>
    <?php endif; ?>
    <!-- /검색 -->

    <?php if ($type=="category"): ?>

      <?php if($B['category']):$_catexp = explode(',',$B['category']);$_catnum=count($_catexp)?>
      <div class="rb-panel rb-bbs-list">
        <ul class="table-view border-top-0">
          <li class="table-view-divider"><?php echo $_catexp[0]?></li>
          <?php for($i = 1; $i < $_catnum; $i++):if(!$_catexp[$i])continue;?>
          <li class="table-view-cell">
            <a href="<?php echo $g['bbs_reset'] ?>&cat=<?php echo $_catexp[$i]?>" data-control="push">
              <i class="fa fa-folder-o fa-fw" aria-hidden="true"></i> <?php echo $_catexp[$i]?>
              <?php if($d['theme']['show_catnum']):?>
              <span class="badge badge-pill"><?php echo getDbRows($table[$m.'data'],'site='.$s.' and notice=0 and bbs='.$B['uid']." and category='".$_catexp[$i]."'")?></span>
              <?php endif?>
            </a>
          </li>
          <?php endfor?>
        </ul>
      </div>
      <?php endif?>

    <?php endif; ?>

        <?php if (!$type): ?>
        <div class="rb-panel rb-bbs-list">



          <ul class="table-view border-top-0">
            <?php if ($cat || $keyword): ?>
              <li class="table-view-cell table-view-active text-muted">
                <i class="fa fa-folder-open-o fa-fw" aria-hidden="true"></i> <?php echo $cat ?> <?php echo $keyword ?> <small>(<?php echo $NUM ?>건)</small>
                <a class="btn btn-secondary js-btn-href" href="<?php echo $g['bbs_reset'] ?>" data-control="push"><i class="fa fa-retweet" aria-hidden="true"></i></a>
              </li>
            <?php endif; ?>

            <?php if ($NUM): ?>

              <!-- 일반글 출력부 -->
              <?php foreach($RCD as $R):?>
              <?php $R['mobile']=isMobileConnect($R['agent'])?>
              <li class="table-view-cell<?php echo $R['depth']?' rb-reply rb-reply-0'.$R['depth']:'' ?><?php echo $R['hidden']?' secret':'' ?>" id="item-<?php echo $R['uid']?>">
                <a data-toggle="modal"
                   data-target="#modal-bbs-view"
                   data-title="<?php echo htmlspecialchars($R['subject'])?>"
                   data-cat="<?php echo $R['category']?>"
                   data-hit="<?php echo $R['hit']?>"
                   data-regisTime="<?php echo getDateFormat($R['d_regis'],'Y.m.d')?>"
                   data-url="<?php echo $g['bbs_view'].$R['uid']?>"
                   data-regisName="<?php echo $R[$_HS['nametype']]?>"
                   data-avatarSrc="<?php echo getAavatarSrc($R['mbruid'],'84','') ?>"
                   data-uid="<?php echo $R['uid'] ?>" role="button">
                  <?php if (!$R['depth']): ?>
                  <img class="media-object pull-left rb-avatar img-circle bg-faded" src="<?php echo getAavatarSrc($R['mbruid'],'84') ?>" width="42">
                  <?php else: ?>
                  <span class="media-object pull-left"><span class="rb-icon fa fa-level-up fa-rotate-90"></span></span>
                  <?php endif; ?>
                  <button class="btn btn-outline-secondary" data-role="total_comment"><span class="badge badge-inverted"><?php echo $R['comment']?><?php echo $R['oneline']?'+'.$R['oneline']:''?></span></button>
                  <div class="media-body">
                    <?php if($R['hidden']):?><span class="badge badge-default badge-inverted"><i class="fa fa-lock"></i></span><?php endif?>
                    <?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'')?>
                    <p>
                      <span class="badge badge-default badge-inverted"><?php echo $R[$_HS['nametype']]?></span>
                      <?php if($R['category']):?><span class="badge badge-default badge-inverted"><i class="fa fa-folder-o fa-fw"></i> <?php echo $R['category']?></span><?php endif?>
                      <span class="badge badge-default badge-inverted"><?php echo getDateFormat($R['d_regis'],'Y.m.d')?></span>
                      <span class="badge badge-default badge-inverted">조회 <?php echo $R['hit']?></span>
                      <span class="badge badge-default badge-inverted">좋아요 <?php echo $R['score1']?></span>
                      <?php if($R['upload']):?><span class="badge badge-default badge-inverted"><i class="fa fa-floppy-o"></i></span><?php endif?>
                      <?php if(getNew($R['d_regis'],24)):?><span class="badge badge-inverted badge-danger">N</span><?php endif?>
                    </p>
                  </div>
                </a>
              </li>
              <?php endforeach?>

            <?php else: ?>
              검색된 자료가 없습니다.
            <?php endif; ?>


        </ul>

    </div>



    <?php endif; ?>

    </div>

  </main>

</section>

<!-- 모달,팝업등의 컴포넌트 모음 -->
<?php include_once $g['dir_module_skin'].'_component.php'?>

<script>

// 사용자 액션에 대한 피드백 메시지 제공을 위해 액션 실행후 쿠키에 저장된 결과 메시지를 출력시키고 초기화 시킵니다.
putCookieAlert('bbs_action_result') // 실행결과 알림 메시지 출력

// 페이지 푸시(page push)는 게시판 목록의 필터링,페이징에 적용 되었습니다. 페이지 푸시 후에는 페이지의 JS를 바인딩 처리해야 줘야 합니다.
// 참고 : https://kimsq.com/docs/rc/controls/push
window.addEventListener('push', doBbsList); // 페이지 푸시와 게시판 목록 JS 바인딩 처리
doBbsList(); // 게시판 목록 JS 실행

</script>
