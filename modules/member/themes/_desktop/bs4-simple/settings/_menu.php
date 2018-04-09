<div class="card mb-3">
  <div class="card-header">
    설정하기
  </div>
  <div class="list-group list-group-flush">
    <a href="<?php echo $g['url_reset']?>&amp;page=main" class="list-group-item list-group-item-action<?php if($page=='main'):?> selected<?php endif?>">
      개인정보 관리
    </a>
    <a href="<?php echo $g['url_reset']?>&amp;page=account" class="list-group-item list-group-item-action<?php if($page=='account'):?> selected<?php endif?>">
      회원계정 설정
    </a>
    <a href="<?php echo $g['url_reset']?>&amp;page=pw" class="list-group-item list-group-item-action<?php if($page=='pw'):?> selected<?php endif?>">
      비밀번호 변경
    </a>
    <a href="<?php echo $g['url_reset']?>&amp;page=leave" class="d-none list-group-item list-group-item-action<?php if($page=='leave'):?> selected<?php endif?>">
      회원탈퇴
    </a>
    <a href="<?php echo $g['url_reset']?>&amp;page=point" class="list-group-item list-group-item-action<?php if($page=='point'):?> selected<?php endif?>">
      포인트 내역
    </a>
    <a href="<?php echo $g['url_reset']?>&amp;page=leave" class="list-group-item list-group-item-action<?php if($page=='leave'):?> selected<?php endif?>">
      탈퇴
    </a>
  </div>
</div>
