<?php
$g['memberAgree1ForSite'] = $g['path_var'].'site/'.$r.'/member.agree1.txt';
$agree1File = file_exists($g['memberAgree1ForSite']) ? $g['memberAgree1ForSite'] : $g['dir_module'].'var/agree1.txt';

$g['memberAgree2ForSite'] = $g['path_var'].'site/'.$r.'/member.agree2.txt';
$agree2File = file_exists($g['memberAgree2ForSite']) ? $g['memberAgree2ForSite'] : $g['dir_module'].'var/agree2.txt';

$g['memberAgree3ForSite'] = $g['path_var'].'site/'.$r.'/member.agree3.txt';
$agree3File = file_exists($g['memberAgree3ForSite']) ? $g['memberAgree3ForSite'] : $g['dir_module'].'var/agree3.txt';

$g['memberAgree4ForSite'] = $g['path_var'].'site/'.$r.'/member.agree4.txt';
$agree4File = file_exists($g['memberAgree4ForSite']) ? $g['memberAgree4ForSite'] : $g['dir_module'].'var/agree4.txt';

$g['memberAgree5ForSite'] = $g['path_var'].'site/'.$r.'/member.agree5.txt';
$agree5File = file_exists($g['memberAgree5ForSite']) ? $g['memberAgree5ForSite'] : $g['dir_module'].'var/agree5.txt';
?>

<form class="content-padded" name="procForm" action="<?php echo $g['s']?>/" method="get">
  <input type="hidden" name="r" value="<?php echo $r?>">
  <input type="hidden" name="c" value="<?php echo $c?>">
  <input type="hidden" name="m" value="<?php echo $_m?>">
  <input type="hidden" name="front" value="<?php echo $front?>">
  <input type="hidden" name="mod" value="<?php echo $_GET['mod']?>">
  <input type="hidden" name="page" value="forms">
  <input type="hidden" name="comp" value="0">

  <header class="bar bar-nav bar-dark bg-inverse">
  	<a class="icon icon-home pull-left" role="button" href="<?php  echo RW(0) ?>"></a>
  	<h1 class="title">약관동의</h1>
  </header>
  <footer class="bar bar-footer bar-light bg-faded">
    <button class="btn btn-primary btn-block" type="button" onclick="return nextStep(0);">다음단계로</button>
  </footer>

  <main class="content">
    <div class="content-padded">

      <p>약관 및 안내를 읽고 동의해 주세요.</p>
      <h5>이용약관</h5>
      <p><textarea class="form-control" rows="5"><?php readfile($agree1File)?></textarea></p>
      <h5>개인정보 취급방침</h5>
      <textarea class="form-control" rows="5"><?php readfile($agree2File)?><?php readfile($agree3File)?><?php readfile($agree4File)?><?php readfile($agree5File)?></textarea>

      <label class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" name="agreecheckbox">
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">위의 사항에 동의 합니다.</span>
      </label>

    </div>
  </main>

</form>

<script type="text/javascript">
//<![CDATA[
function nextStep(n)
{
	var f = document.procForm;

	if (f.agreecheckbox.checked == false)
	{
		alert('회원으로 가입을 원하실 경우,\n\n[홈페이지 약관 및 개인정보 수집·이용]에 동의하셔야 합니다.');
		return false;
	}

	f.comp.value = n;
	f.submit();
}
function tabShow(n)
{
	var i;

	for (i = 1; i < 5; i++)
	{
		getId('tagree'+i).style.borderBottom = '#dfdfdf solid 1px';
		getId('tagree'+i).style.background = '#f9f9f9';
		getId('tagree'+i).style.color = '#666666';
		getId('bagree'+i).style.display = 'none';
	}
	getId('tagree'+n).style.borderBottom = '#ffffff solid 1px';
	getId('tagree'+n).style.background = '#ffffff';
	getId('tagree'+n).style.color = '#000000';
	getId('bagree'+n).style.display = 'block';
}
//]]>
</script>
