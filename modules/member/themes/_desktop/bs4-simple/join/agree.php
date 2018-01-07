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

<!-- global css -->
<link href="<?php echo $g['url_module_skin']?>/_style.css" rel="stylesheet">

<article id="pages-signup">
  	<form name="procForm" action="<?php echo $g['s']?>/" method="get">
	<input type="hidden" name="r" value="<?php echo $r?>">
	<input type="hidden" name="c" value="<?php echo $c?>">
	<input type="hidden" name="m" value="<?php echo $_m?>">
	<input type="hidden" name="front" value="<?php echo $front?>">
	<input type="hidden" name="mod" value="<?php echo $_GET['mod']?>">
	<input type="hidden" name="page" value="forms">
	<input type="hidden" name="comp" value="0">

	<div class="page-header">
		<h2>약관동의 <small>약관 및 안내를 읽고 동의해 주세요.</small></h2>
	</div>
<!-- 	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="fa fa-info-circle fa-lg"></i> 회원으로 가입을 원하실 경우, [홈페이지 약관 및 개인정보 수집·이용]에 동의 하셔야 합니다.
	</div> -->

	<section class="page-section" id="agreement">
		<h4><i class="fa fa-file-text-o"></i> 이용약관</h4>
		<p>
		<textarea readonly="readonly" class="form-control" rows="12"><?php readfile($agree1File)?></textarea>
		</p>
	</section>

	<section class="page-section" id="privacy">
		<h4><i class="fa fa-file-text-o"></i> 개인정보 취급방침</h4>
		<ul class="nav nav-tabs hidden-xs hidden-sm">
		  <li class="nav-item"><a class="nav-link active" href="#agree-privacy-1" data-toggle="tab">개인정보수집 및 이용목적</a></li>
		  <li class="nav-item"><a class="nav-link" href="#agree-privacy-2" data-toggle="tab">수집하는 개인정보의 항목</a></li>
		  <li class="nav-item"><a class="nav-link" href="#agree-privacy-3" data-toggle="tab">개인정보보유 및 이용기간</a></li>
		  <li class="nav-item"><a class="nav-link" href="#agree-privacy-4" data-toggle="tab">개인정보의 위탁처리</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="agree-privacy-1"><textarea readonly="readonly" class="form-control" rows="12"><?php readfile($agree2File)?></textarea></div>
			<div class="tab-pane" id="agree-privacy-2"><textarea readonly="readonly" class="form-control" rows="12"><?php readfile($agree3File)?></textarea></div>
			<div class="tab-pane" id="agree-privacy-3"><textarea readonly="readonly" class="form-control" rows="12"><?php readfile($agree4File)?></textarea></div>
			<div class="tab-pane" id="agree-privacy-4"><textarea readonly="readonly" class="form-control" rows="12"><?php readfile($agree5File)?></textarea></div>
		</div>
	</section>
   <br >
	<div class="form-group checkbox">
		<label>
			<input type="checkbox" name="agreecheckbox"> 위의 <strong>'홈페이지 이용약관 및 개인정보 수집·이용'</strong>에 동의 합니다.
		</label>
	</div>

	<div class="page-footer">
		<?php if($d['member']['form_comp']&&!$d['member']['form_jumin']):?>
		<button type="button" class="btn btn-primary" onclick="return nextStep(0);"><i class="fa fa-male fa-lg"></i> 회원가입</button>
		<?php else:?>
		<button type="button" class="btn btn-primary" onclick="return nextStep(0);">다음단계로</button>
		<?php endif?>
	</div>
 </form>
</article>


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
