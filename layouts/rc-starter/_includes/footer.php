<footer class="footer bg-faded">

  <div class="mb-2">
    <?php if ($my['uid']): ?>
    <a class="btn btn-secondary btn-sm" href="<?php echo $g['s']?>/?r=<?php echo $r?>&a=logout">로그아웃</a>
    <?php else: ?>
    <a class="btn btn-secondary btn-sm" href="#modal-login" data-toggle="modal" data-title="<?php echo stripslashes($d['layout']['header_title'])?>">로그인</a>
    <?php endif; ?>

    <a class="btn btn-secondary btn-sm" href="<?php echo RW('mod=settings') ?>">내정보</a>
    <a class="btn btn-secondary btn-sm" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;a=pcmode">PC화면</a>
    <a class="btn btn-secondary btn-sm" href="#modal-sitemap" data-toggle="modal" data-title="전체보기">전체보기</a>
  </div>

  <nav class="nav mb-2">
    <a class="nav-link" href="<?php echo RW('mod=policy') ?>">이용약관</a>
    <span class="divider">|</span>
    <a class="nav-link" href="<?php echo RW('mod=privacy') ?>">개인정보취급방침</a>
  </nav>


  <p>© Company <?php echo $date['year']?></p>

</footer>
