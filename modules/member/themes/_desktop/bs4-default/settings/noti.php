<?php
$emailque= 'mbruid='.$my['uid'].' and d_verified<>0';
$RCD = getDbArray($table['s_mbremail'],$emailque,'*','uid','asc',0,1);
?>

<?php include_once $g['dir_module_skin'].'_header.php'?>

<div class="page-wrapper row">
  <nav class="col-3 page-nav">
    <?php include_once $g['dir_module_skin'].'_menu.php'?>
  </nav>
  <div class="col-9 page-main">

    <div class="subhead mt-0">
      <h2 class="subhead-heading">알림 관리</h2>
    </div>

    <?php if (!getValid($my['last_log'],$d['member']['settings_expire'])): //로그인 후 경과시간 비교(분 ?>
    <?php include_once $g['dir_module_skin'].'_lock.php'?>
    <?php else: ?>


    <p>알림을 수신하면 웹 사이트내의 정보는 물론 회원님이 언급되거나 관련된 정보들을 실시간으로 받아보실 수 있습니다.</p>

    <h3>알림 수신설정</h3>

    <div id="save-config">
      <div class="form-group">
        <label>알림수신 이메일 </label>
        <select class="form-control custom-select" name="email_noti">
          <option value="">사용안함</option>
          <?php while($R=db_fetch_array($RCD)):?>
          <option value="<?php echo $R['email'] ?>"<?php echo ($my['email_noti']==$R['email'])?' selected':'' ?>>
            <?php echo $R['email'] ?>
          </option>
          <?php endwhile?>
        </select>

        <small class="form-text text-muted mt-2">
          <a href="<?php echo $g['url_reset']?>&amp;page=email">이메일 관리</a>에서 이메일을 추가할수 있습니다. 본인인증된 메일만 추가할 수 있습니다.
        </small>
      </div>

      <button type="button" class="btn btn-primary js-submit">
        <span class="not-loading">저장</span>
        <span class="is-loading">저장중..</span>
      </button>
    </div><!-- /#save-config -->
    <?php endif; ?>

  </div><!-- /.page-main -->
</div><!-- /.row -->

<?php include_once $g['dir_module_skin'].'_footer.php'?>


<script>

$(function () {

  putCookieAlert('member_settings_result') // 실행결과 알림 메시지 출력

  // 환경설정 저장
  $('#save-config').find('.js-submit').click(function() {
    var form = $('#save-config')
    var email_noti = form.find('[name=email_noti]').val();
    var act = 'save_config'
    var url = rooturl+'/?r='+raccount+'&m=member&a=settings_noti&act='+act+'&email_noti='+email_noti
    $(this).attr('disabled',true)
    getIframeForAction();
    setTimeout(function(){
      frames.__iframe_for_action__.location.href = url;
    }, 300);
  });

})


</script>
