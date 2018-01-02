<?php
$tab = $tab ? $tab : 'date';
?>

<ul class="nav nav-tabs" role="tablist">
   <li<?php if($tab=='date'):?> class="active"<?php endif?>><a href="<?php echo $g['adm_href']?>&amp;iframe=Y&amp;tab=date">발행일시 변경</a></li>
</ul>

<!-- tab 내용 -->
<div class="tab-content">
	<div class="tab-pane active">
         <form name="editForm" action="<?php echo $g['s']?>/" method="post" class="form-horizontal rb-form">
			<input type="hidden" name="r" value="<?php echo $r?>">
			<input type="hidden" name="m" value="<?php echo $module?>">
			<input type="hidden" name="a" value="_admin/edit_post">
			<input type="hidden" name="front" value="<?php echo $front?>">
			<input type="hidden" name="editType" value="<?php echo $tab?>">
			<input type="hidden" name="iframe" value="<?php echo $iframe?>">
			<input type="hidden" name="post_array" value="<?php echo $_post_members?>">	

		   <?php include $g['path_module'].$module.'/admin/manager/edit-'.$tab.'.php';?>
		 </form>			
	</div>
</div>
<!--@부모레이어를 제어할 수 있도록 모달의 헤더와 풋터를 부모레이어에 출력시킴-->
<div id="_modal_header" class="hidden">
	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	<h4 class="modal-title">포스트 수정</h4>
</div>
<div id="_modal_footer" class="hidden">
	<button type="submit" class="btn btn-primary pull-left" onclick="frames._modal_iframe_modal_window.saveCheck();">정보 수정하기</button>
	<button id="_close_btn_" type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
</div>

<script>
 // 툴팁 이벤트 
$(document).ready(function() {
       $('[data-toggle=tooltip]').tooltip();
 }); 
</script>

<!-- bootstrap-datepicker,  http://eternicode.github.io/bootstrap-datepicker/  -->
<?php getImport('bootstrap-datepicker','css/datepicker3',false,'css')?>
<?php getImport('bootstrap-datepicker','js/bootstrap-datepicker',false,'js')?>
<?php getImport('bootstrap-datepicker','js/locales/bootstrap-datepicker.kr',false,'js')?>
<style type="text/css">
.datepicker {z-index: 1151 !important;}
</style>
<script>
$('#datepicker').datepicker({
	format: "yyyy/mm/dd",
	todayBtn: "linked",
	language: "kr",
	calendarWeeks: true,
	todayHighlight: true,
	autoclose: true
});
</script>
<!-- End of  bootstrap-timepicker,  https://github.com/jdewit/bootstrap-timepicker/ , http://jdewit.github.io/bootstrap-timepicker/ : 메뉴얼 -->
<?php getImport('bootstrap-timepicker','js/bootstrap-timepicker.min',false,'js')?>
<?php getImport('bootstrap-timepicker','css/bootstrap-timepicker.min',false,'css')?>
<script>
 $('#timepicker').timepicker({
  	 showSeconds : true, // 초 노출
  	 showMeridian:false, // 24시 모드 
    maxHours: 24
 });
</script>
<script>

function saveCheck()
{
	var f = document.editForm;
	if (confirm('정말로 수정하시겠습니까?    '))
	{
		getIframeForAction(f);
		f.submit();
	}
	return false;
}
function modalSetting()
{
	var ht = document.body.scrollHeight - 55;

	parent.getId('modal_window_dialog_modal_window').style.width = '100%';
	parent.getId('modal_window_dialog_modal_window').style.paddingRight = '20px';
	parent.getId('modal_window_dialog_modal_window').style.maxWidth = '900px';
	parent.getId('_modal_iframe_modal_window').style.height = ht+'px'
	parent.getId('_modal_body_modal_window').style.height = ht+'px';

	parent.getId('_modal_header_modal_window').innerHTML = getId('_modal_header').innerHTML;
	parent.getId('_modal_header_modal_window').className = 'modal-header';
	parent.getId('_modal_body_modal_window').style.padding = '0';
	parent.getId('_modal_body_modal_window').style.margin = '0';

	parent.getId('_modal_footer_modal_window').innerHTML = getId('_modal_footer').innerHTML;
	parent.getId('_modal_footer_modal_window').className = 'modal-footer';
}
document.body.onresize = document.body.onload = function()
{
	setTimeout("modalSetting();",100);
	setTimeout("modalSetting();",200);
}
</script>
