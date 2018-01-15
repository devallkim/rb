<?php
function getSwitchList($pos)
{
	$incs = array();
	foreach($GLOBALS['d']['switch'][$pos] as $_switch => $_sites)
	{
		if(is_file($GLOBALS['g']['path_switch'].$pos.'/'.$_switch.'/main.php')) $incs[] = array($_switch,$_sites);
	}
	$dirh = opendir($GLOBALS['g']['path_switch'].$pos);
	while(false !== ($folder = readdir($dirh)))
	{
		$_fins = substr($folder,0,1);
		if(strpos('_.',$_fins) || isset($GLOBALS['d']['switch'][$pos][$folder])) continue;
		$incs[] = array($folder,'');
	}
	closedir($dirh);
	return $incs;
}
$_switchset = array(
	'start'=>'스타트 스위치',
	'top'=>'탑 스위치',
	'head'=>'헤더 스위치',
	'foot'=>'풋터 스위치',
	'end'=>'엔드 스위치'
);
$TMPST = array();
$SITES = getDbArray($table['s_site'],'','*','gid','asc',0,$p);
$SITEN = db_num_rows($SITES);
?>

<div class="container-fluid">
	<div class="row" id="switch">
		<div class="col-sm-4 col-md-4 col-xl-3 d-none d-sm-block sidebar">
			<div class="card">
				<div class="card-header">
					<i class="fa fa-power-off fa-lg fa-fw"></i> 스위치 관리
				</div>
				<div class="rb-panel-form">
					<select class="form-control custom-select border-0" onchange="goHref('<?php echo $g['s']?>/?m=<?php echo $m?>&module=<?php echo $module?>&front=<?php echo $front?>&switchdir=<?php echo $switchdir?>&r='+this.value);">
						<?php while($S = db_fetch_array($SITES)):$TMPST[]=array($S['label'],$S['id'])?>
						<option value="<?php echo $S['id']?>"<?php if($r==$S['id']):?> selected<?php endif?>><?php echo $S['name']?> (<?php echo $S['id']?>)</option>
						<?php endwhile?>
					</select>
				</div>

				<form action="<?php echo $g['s']?>/" method="post" class="rb-form" onsubmit="return orderCheck(this);">
					<input type="hidden" name="r" value="<?php echo $r?>">
					<input type="hidden" name="m" value="<?php echo $module?>">
					<input type="hidden" name="a" value="switch_order">
					<input type="hidden" name="auto" value="">

					<?php foreach($_switchset as $_key => $_val):?>
					<div class="card-body">
						<h5><small><?php echo $_val?></small></h5>
						<div class="dd" id="nestable-<?php echo $_key?>">
							<ol class="dd-list">
							<?php if(isset($d['switch'][$_key])):?>
							<?php $_i=1;foreach(getSwitchList($_key) as $_switch):$_switch[2]=getFolderName($g['path_switch'].$_key.'/'.$_switch[0]);$_switch[3]=$_key?>
							<li class="dd-item dd3-item<?php if($_key.'/'.$_switch[0]==$switchdir):$sinfo=$_switch?> rb-active<?php endif?>" data-id="<?php echo $_i?>">
								<div class="dd-handle dd3-handle"></div>
								<div class="dd3-content"><a href="<?php echo $g['adm_href']?>&amp;switchdir=<?php echo $_key.'/'.$_switch[0]?>"><?php echo $_switch[2]?></a> <small>(<?php echo $_switch[0]?>)</small></div>
								<div class="dd-checkbox">
									<input type="checkbox" name="switchmembers_<?php echo $_key?>[]" value="<?php echo $_switch[0]?>" checked class="d-none"><i class="fa fa-eye<?php echo strstr($_switch[1],'['.$r.']')?'':'-slash rb-eye-close'?>"></i>
								</div>
							</li>
							<?php $_i++;endforeach?>
							<?php else:?>
							<li><small></small></li>
							<?php endif?>
							</ol>
						</div>
					</div>
					<?php endforeach?>

					<div class="card-footer p-2">
						<div class="btn-group w-100">
							<button type="button" class="btn btn-light rb-modal-add-switch w-50" data-toggle="modal" href="#modal_window">
								스위치 추가
							</button>
							<button type="submit" class="btn btn-light w-50">
								스위치 업데이트
							</button>
						</div>
					</div>

				</form>
			</div>
		</div>
		<div class="col-sm-8 col-md-8 ml-sm-auto col-xl-9 pt-3">
			<?php if($switchdir):?>

			<h4>스위치 등록정보</h4>

			<div class="row">
				<div class="col-md-2 col-sm-2 text-center">
					<span class="fa-stack fa-3x">
						<i class="fa fa-square fa-stack-2x"></i>
						<i class="fa fa-power-off fa-stack-1x fa-inverse"></i>
					</span>
				</div>
				<div class="col-md-10 col-sm-10">
					<h4 class="media-heading">
						<strong><?php echo $sinfo[2]?></strong>
						<small class="text-muted">(<?php echo $sinfo[0]?>) <span class="label label-default"><?php echo $sinfo[3]?></span></small>
					</h4>
					<p class="text-muted"><small>선택된 스위치 대한 등록정보입니다.</small></p>
					<div class="btn-group">
					  <a class="btn btn-light" data-toggle="collapse" data-target="#_edit_area_" onclick="sessionSetting('sh_admin_switch1','1','','1');"><i class="fa fa-code fa-lg"></i> 편집하기</a>
					  <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
					  </button>
					  <div class="dropdown-menu dropdown-menu-right" role="menu">
							<?php if(is_file($g['path_switch'].$switchdir.'/readme.txt')):?>
							<a class="dropdown-item" href="#." data-toggle="collapse" data-target="#_guide_area_" onclick="sessionSetting('sh_admin_switch2','1','','1');">안내문서 보기</a>
							<?php endif?>
						  <a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=switch_delete&amp;switch=<?php echo $switchdir?>" onclick="return hrefCheck(this,true,'정말로 삭제시겠습니까?');">삭제하기</a>
					  </div>
					</div>
				</div>
			</div>

			<form name="procForm" class="mt-4" role="form" action="<?php echo $g['s']?>/" method="post" onsubmit="return saveCheck(this);">
				<input type="hidden" name="r" value="<?php echo $r?>">
				<input type="hidden" name="m" value="<?php echo $module?>">
				<input type="hidden" name="a" value="switch_edit">
				<input type="hidden" name="switch" value="<?php echo $switchdir?>">
				<input type="hidden" name="name" value="<?php echo $sinfo[2]?>">

				<h4>적용 사이트</h4>

				<div class="form-group">
					<div class="col-lg-12">
						<?php foreach($TMPST as $_val):?>
						<div class="custom-control custom-checkbox custom-control-inline">
						  <input type="checkbox" class="custom-control-input" id="aply_sites_<?php echo $_val[1]?>" name="aply_sites[]" value="<?php echo $_val[1]?>"<?php if(strstr($sinfo[1],'['.$_val[1].']')):?> checked<?php endif?>>
						  <label class="custom-control-label" for="aply_sites_<?php echo $_val[1]?>"><?php echo $_val[0]?> <small class="text-muted">(<?php echo $_val[1]?>)</small></label>
						</div>
						<?php endforeach?>
					</div>
				</div>

				<hr>

				<div class="form-group">
					<div class="col-sm-12">
						<div class="btn-group">
							<button type="button" class="btn btn-light" onclick="checkboxChoice('aply_sites[]',true);">전체선택</button>
							<button type="button" class="btn btn-light" onclick="checkboxChoice('aply_sites[]',false);">전체취소</button>
						</div>
						<button class="btn btn-primary" type="submit"><i class="fa fa-check fa-lg"></i> 저장하기</button>
					</div>
				</div>

				<div id="_edit_area_" class="collapse<?php if($_SESSION['sh_admin_switch1']):?> in<?php endif?>">
					<div class="rb-files">
						<div class="rb-codeview">
							<div class="rb-codeview-header">
								<ol class="breadcrumb pull-left">
									<li>파일경로 :</li>
									<li>root</li>
									<li>switchs</li>
									<li><?php echo str_replace('/','</li><li>',$switchdir)?></li>
									<li class="active">main.php</li>
								</ol>
								<button type="button" class="btn btn-light btn-xs pull-right rb-full-screen" data-tooltip="tooltip" title="전체화면" onclick="editFullSize('_edit_area_',this);"><i class="fa fa-arrows-alt fa-lg"></i></button>
							</div>
							<div class="rb-codeview-body">
								<textarea name="switch_code" id="__code__" class="form-control" rows="35"><?php echo implode('',file($g['path_switch'].$switchdir.'/main.php'))?></textarea>
							</div>
							<div class="rb-codeview-footer">
								<ul class="list-inline">
									<li><code><?php echo count(file($g['path_switch'].$switchdir.'/main.php'))?> lines</code></li>
									<li><code><?php echo getSizeFormat(filesize($g['path_switch'].$switchdir.'/main.php'),2)?></code></li>
									<li class="pull-right">파일을 편집한 후 저장 버튼을 클릭하면 실시간으로 사용자 페이지에 적용됩니다.'</li>
								</ul>
							</div>
						</div>
					</div>

					<div class="rb-submit clearfix">
						<button type="submit" class="btn btn-primary">저장하기</button>
					</div>
				</div>

			</form>

			<?php if(is_file($g['path_switch'].$switchdir.'/readme.txt')):?>
			<br>
			<br>
			<div id="_guide_area_" class="collapse well<?php if($_SESSION['sh_admin_switch2']):?> in<?php endif?>">
				<small><?php echo getContents(nl2br(implode('',file($g['path_switch'].$switchdir.'/readme.txt'))),'HTML')?></small>
			</div>
			<?php endif?>


			<?php else:?>

			<h4>사용 가이드</h4>

			<ul class="list-unstyled text-muted">
				<li>스위치는 프로그램의 실행단계를 5개의 구역으로 분리하여 각각의 구역에 실행여부를 온/오프 할 수 있는 응용 프로그램입니다.</li>
				<li>너무 많은 스위치를 동작시킬 경우 실행속도에 영향을 줄 수 있으니 꼭 필요한 스위치만 사용하세요.</li>
			</ul>


			<h4 class="mt-5">요소별 실행위치</h4>
			<small>
				<dl class="row border p-3 bg-light mx-0">
				  <dt class="col-sm-2">스타트 스위치</dt>
				  <dd class="col-sm-9"><small class="text-muted">(start)</small> 프로그램 시작과 함께 DB연결,주요파일 로드 후 실행됩니다.</dd>
				  <dt class="col-sm-2">탑 스위치</dt>
				  <dd class="col-sm-9"><small class="text-muted">(top)</small> 모듈 및 레이아웃에 대한 정의후 화면출력 직전에 실행됩니다.</dd>
				  <dt class="col-sm-2">헤더 스위치</dt>
				  <dd class="col-sm-9"><small class="text-muted">(head)</small> head 태그를 닫기 직전에 실행됩니다.</dd>
				  <dt class="col-sm-2">풋터 스위치</dt>
				  <dd class="col-sm-9"><small class="text-muted">(foot)</small> body 태그를 닫기 직전에 실행됩니다.</dd>
				  <dt class="col-sm-2">엔드 스위치</dt>
				  <dd class="col-sm-9"><small class="text-muted">(end)</small> 화면출력을 끝내고 실행됩니다.</dd>
				</dl>
			</small>

			<p class="text-right">
				<a class="btn btn-light" data-toggle="modal" href="#admin-switch-structure">스위치 실행 스트럭처 보기</a>
			</p>
			<?php endif?>

		</div>
	</div>

</div>



<?php if($d['admin']['codeeidt']):?>
<!-- codemirror -->
<style>
.CodeMirror {
	font-size: 13px;
	font-weight: normal;
	font-family: Menlo,Monaco,Consolas,"Courier New",monospace !important;
}
</style>
<?php getImport('codemirror','codemirror',false,'css')?>
<?php getImport('codemirror','codemirror',false,'js')?>
<?php getImport('codemirror','theme/'.$d['admin']['codeeidt'],false,'css')?>
<?php getImport('codemirror','addon/display/fullscreen',false,'css')?>
<?php getImport('codemirror','addon/display/fullscreen',false,'js')?>
<?php getImport('codemirror','mode/htmlmixed/htmlmixed',false,'js')?>
<?php getImport('codemirror','mode/xml/xml',false,'js')?>
<?php getImport('codemirror','mode/javascript/javascript',false,'js')?>
<?php getImport('codemirror','mode/clike/clike',false,'js')?>
<?php getImport('codemirror','mode/php/php',false,'js')?>
<?php getImport('codemirror','mode/css/css',false,'js')?>
<script>
var editor = CodeMirror.fromTextArea(getId('__code__'), {
	mode: "application/x-httpd-php",
    indentUnit: 4,
    lineNumbers: true,
    matchBrackets: true,
    indentWithTabs: true,
	theme: '<?php echo $d['admin']['codeeidt']?>',
	extraKeys: {
		"F11": function(cm) {
		  cm.setOption("fullScreen", !cm.getOption("fullScreen"));
		},
		"Esc": function(cm) {
		  if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
		}
	}
});
editor.setSize('100%','550px');
_isCodeEdit = true;
function _codefullscreen()
{
	editor.setOption('fullScreen', !editor.getOption('fullScreen'));
}
</script>
<!-- @codemirror -->
<?php endif?>


<!-- nestable : https://github.com/dbushell/Nestable -->
<?php getImport('nestable','jquery.nestable',false,'js')?>
<script>
$('#nestable-start').nestable({group:1});
$('#nestable-top').nestable({group:2});
$('#nestable-head').nestable({group:3});
$('#nestable-foot').nestable({group:4});
$('#nestable-end').nestable({group:5});
$('.dd').on('change', function() {
	var f = document.forms[0];
	getIframeForAction(f);
	f.auto.value = '1';
	f.submit();
});
$(document).ready(function()
{
	$('.rb-full-screen').on('click',function() {

	});
	$('.rb-modal-add-switch').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;m=admin&amp;module=market&amp;front=modal.add&amp;addType=switch&amp;reload=Y')?>');
	});
});
</script>

<script>
function orderCheck(f)
{
	getIframeForAction(f);
	return true;
}
function saveCheck(f)
{
	if (f.name.value == '')
	{
		alert('스위치명을 입력해 주세요.   ');
		f.name.focus();
		return false;
	}

	getIframeForAction(f);
	return confirm('정말로 실행하시겠습니까?   ');
}
</script>




<div class="modal fade" id="admin-switch-structure" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">스위치 실행 스트럭처</h4>
			</div>
			<div class="modal-body">
				<fieldset id="guide_structure">
<pre>
		<i>- 프로그램 시작 -</i>
		<i>- DB연결 -</i>
		<i>- 주요파일 로드 -</i>

		<span>[스타트 스위치]</span>

		<i>- 모듈 정의 -</i>
		<i>- 레이아웃 정의 -</i>

		<span>[탑 스위치]</span>
		<fieldset>
		<legend>[화면에 출력되는 부분]</legend>
		&lt;html&gt;
		&lt;head&gt;

			<i>- 기초 헤드 -</i>
			<span>[헤더 스위치]</span>

		&lt;/head&gt;
		&lt;body&gt;

			<i>- 콘텐츠 영역 -</i>
			<span>[풋터 스위치]</span>

		&lt;/body&gt;
		&lt;/html&gt;
		</fieldset>
		<span>[엔드 스위치]</span>

</pre>
				</fieldset>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-dismiss="modal">닫기</button>
			</div>
		</div>
	</div>
</div>
