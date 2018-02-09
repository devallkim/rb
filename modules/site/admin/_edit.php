<?php
if ($_mtype == 'page')
{
	$_HP = getUidData($table['s_page'],$uid);
	$_filekind = $r.'-pages/'.$_HP['id'];
	$_filetype= '페이지';
	$_filesbj = $_HP['name'];
}
if ($_mtype == 'menu')
{
	$_HM = getUidData($table['s_menu'],$uid);
	$_filekind = $r.'-menus/'.$_HM['id'];
	$_filetype = '메뉴';
	$_filesbj = $_HM['name'];

	include $g['path_core'].'function/menu.func.php';
	$ctarr = getMenuCodeToPath($table['s_menu'],$_HM['uid'],0);
	$ctnum = count($ctarr);
	$_HM['code'] = '';
	for ($i = 0; $i < $ctnum; $i++) $_HM['code'] .= $ctarr[$i]['id'].($i < $ctnum-1 ? '/' : '');
}

if($type == 'source'):
$_editArray = array(
	'source' => array('','HTML (Basic)','.php'),
	'mobile' => array('mobile','HTML (Mobile Only)','.mobile.php'),
	'css' => array('css','CSS','.css'),
	'js' => array('js','Javascript','.js'),
);
?>
<!-- 직접 꾸미기 -->
<div id="rb-page-source" class="p-4">

	<div class="d-flex justify-content-between">
		<h4><?php echo $_filetype?> - <?php echo $_filesbj?></h4>
		<div class="rb-top-btnbox">
				<?php if($markdown=='Y'):?>
				<div class="btn-group">
					<a class="btn btn-light rb-modal-photoset" href="#." data-toggle="modal" data-target="#modal_window"><i class="fa fa-photo"></i> 포토셋</a>
					<button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<div class="dropdown-menu dropdown-menu-right">
						<a href="#." data-toggle="modal" data-target="#modal_window" class="dropdown-item rb-modal-videoset"><i class="fa fa-video-camera"></i> 비디오셋</a>
						<a href="#." data-toggle="modal" data-target="#modal_window" class="dropdown-item rb-modal-widgetedit"><i class="fa fa-puzzle-piece"></i> 위젯</a>
					</div>
				</div>
				<?php else:?>
				<a href="#." class="btn btn-light rb-modal-widgetcode" data-toggle="modal" data-target="#modal_window"><i class="fa fa-puzzle-piece fa-lg"></i> 위젯</a>
				<?php endif?>

				<?php if ($_mtype == 'page'):$_viewpage=RW('mod='.$_HP['id'])?>
				<!-- 페이지 -->
				<div class="btn-group rb-btn-view">
					<a href="<?php echo $_viewpage?>" class="btn btn-light">접속하기</a>
					<button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="<?php echo $_viewpage?>" target="_blank"><i class="fa fa-window-restore"></i> 새창으로 보기</a>
					</div>
				</div>
				<div class="btn-group">
					<a id="rb-list-back" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $module?>&amp;front=<?php echo $_mtype?>&amp;uid=<?php echo $uid?>&amp;cat=<?php echo urlencode($cat)?>&amp;p=<?php echo $p?>&amp;recnum=<?php echo $recnum?>&amp;keyw=<?php echo urlencode($keyw)?>" class="btn btn-light"><i class="fa fa-list"></i> 페이지목록</a>
					<button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<div class="dropdown-menu dropdown-menu-right">
						<?php if($markdown=='Y'):?>
						<a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $module?>&amp;front=_edit&amp;_mtype=<?php echo $_mtype?>&amp;type=source&amp;uid=<?php echo $uid?>&amp;cat=<?php echo urlencode($cat)?>&amp;p=<?php echo $p?>&amp;recnum=<?php echo $recnum?>&amp;keyw=<?php echo urlencode($keyw)?>"><i class="fa fa-code"></i> 소스코드 편집모드</a>
						<?php else:?>
						<a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $module?>&amp;front=_edit&amp;_mtype=<?php echo $_mtype?>&amp;type=source&amp;uid=<?php echo $uid?>&amp;cat=<?php echo urlencode($cat)?>&amp;p=<?php echo $p?>&amp;recnum=<?php echo $recnum?>&amp;keyw=<?php echo urlencode($keyw)?>&amp;markdown=Y"><i class="fa fa-edit"></i> 마크다운 편집모드</a>
						<?php endif?>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $module?>&amp;front=<?php echo $_mtype?>"><i class="fa fa-plus"></i> 새 페이지</a>
						<a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=deletepage&amp;uid=<?php echo $uid?>&back=Y" onclick="return hrefCheck(this,true,'정말로 삭제하시겠습니까?');"><i class="fa fa-trash-o"></i> 페이지 삭제</a>
					</div>
				</div>
				<?php else:$_viewpage=RW('c='.$_HM['code'])?>
				<!-- 메뉴 -->
				<div class="btn-group">
					<a href="<?php echo $_viewpage?>" class="btn btn-light">접속하기</a>
					<button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="<?php echo $_viewpage?>" target="_blank"><i class="fa fa-window-restore"></i> 새창으로 보기</a>
					</div>
				</div>
				<div class="btn-group">
					<a id="rb-list-back" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $module?>&amp;front=<?php echo $_mtype?>&amp;cat=<?php echo $cat?>&amp;code=<?php echo $code?>" class="btn btn-light">메뉴목록</a>
					<button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<div class="dropdown-menu dropdown-menu-right">
						<?php if($markdown=='Y'):?>
						<a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $module?>&amp;front=_edit&amp;_mtype=<?php echo $_mtype?>&amp;type=source&amp;uid=<?php echo $uid?>&amp;cat=<?php echo $cat?>&amp;code=<?php echo $code?>"><i class="fa fa-code"></i> 소스코드 편집모드</a>
						<?php else:?>
						<a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $module?>&amp;front=_edit&amp;_mtype=<?php echo $_mtype?>&amp;type=source&amp;uid=<?php echo $uid?>&amp;cat=<?php echo $cat?>&amp;code=<?php echo $code?>&amp;markdown=Y"><i class="fa fa-edit"></i> 마크다운 편집모드</a>
						<?php endif?>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $module?>&amp;front=<?php echo $_mtype?>"><i class="fa fa-plus"></i> 새 메뉴</a>
						<a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=deletemenu&amp;cat=<?php echo $cat?>&amp;back=Y" onclick="return hrefCheck(this,true,'정말로 삭제하시겠습니까?');"><i class="fa fa-trash-o"></i> 메뉴삭제</a>
					</div>
				</div>
				<?php endif?>
			</div>
	</div>

	<div class="row">
		<div class="col-sm-8">

			<form name="procForm" action="<?php echo $g['s']?>/" method="post" onsubmit="return sourcecheck(this);">
				<input type="hidden" name="r" value="<?php echo $r?>">
				<input type="hidden" name="m" value="<?php echo $module?>">
				<input type="hidden" name="a" value="sourcewrite">
				<input type="hidden" name="type" value="<?php echo $_mtype?>">
				<?php if($_mtype=='menu'):?>
				<input type="hidden" name="uid" value="<?php echo $_HM['uid']?>">
				<input type="hidden" name="id" value="<?php echo $_HM['id']?>">
				<?php else:?>
				<input type="hidden" name="id" value="<?php echo $_HP['id']?>">
				<?php endif?>
				<input type="hidden" name="markdown" value="<?php echo $markdown?>">
				<input type="hidden" name="editFilter" value="<?php echo $d['admin']['editor']?>">

				<?php
				if($markdown=='Y'):
				$__SRC__ = is_file($g['path_page'].$_filekind.'.php') ? implode('',file($g['path_page'].$_filekind.'.php')) : '';
				include $g['path_plugin'].$d['admin']['editor'].'/import.php';
				?>

				<div class="form-group">
					<button class="btn btn-outline-primary btn-block btn-lg my-4" id="rb-submit-button" type="submit"><i class="fa fa-check fa-lg"></i> 수정하기</button>
				</div>
				<?php else:?>
				<div id="tab-edit-area">
					<div class="form-group">
						<div class="panel-group" id="accordion">
							<?php $_i=1;foreach($_editArray as $_key => $_val):?>
							<div class="card">
								<div class="card-header p-0">
									<a class="d-block collapsed muted-link" data-toggle="collapse" data-parent="#accordion" href="#site-code-<?php echo $_key?>" onclick="focusArea('code_<?php echo $_key?>');sessionSetting('sh_sys_page_edit','<?php echo $_key?>','','');">
										<?php echo $_val[1]?>
										<?php if(is_file($g['path_page'].$_filekind.$_val[2])):?><i class="fa fa-check-circle" title="내용있음" data-tooltip="tooltip"></i><?php endif?>
									</a>
								</div>
								<div id="site-code-<?php echo $_key?>" class="panel-collapse collapse<?php if(($_key==$_SESSION['sh_sys_page_edit']) || (!$_SESSION['sh_sys_page_edit']&&$_i==1)):?> in<?php endif?>">

									<div class="rb-codeview">
										<div class="rb-codeview-header">
											<ol class="breadcrumb">
												<li class="breadcrumb-item">파일경로 :</li>
												<li class="breadcrumb-item">root</li>
												<li class="breadcrumb-item">pages</li>
												<?php if($_mtype=='menu'):?>
												<li class="breadcrumb-item">menu</li>
												<?php endif?>
												<li class="breadcrumb-item active"><?php echo str_replace('menu/','',$_filekind).$_val[2]?></li>
											</ol>
										</div>
										<div class="rb-codeview-body">
											<textarea name="<?php echo $_key?>" id="code_<?php echo $_key?>" class="form-control" rows="35"><?php if(is_file($g['path_page'].$_filekind.$_val[2])) echo htmlspecialchars(implode('',file($g['path_page'].$_filekind.$_val[2])))?></textarea>
										</div>
										<div class="rb-codeview-footer">
											<ul class="list-inline">
												<li><code><?php echo is_file($g['path_page'].$_filekind.$_val[2])?count(file($g['path_page'].$_filekind.$_val[2])):'0'?> lines</code></li>
												<li><code><?php echo is_file($g['path_page'].$_filekind.$_val[2])?getSizeFormat(@filesize($g['path_page'].$_filekind.$_val[2]),2):'0B'?></code></li>
												<li class="pull-right">파일을 편집한 후 저장 버튼을 클릭하면 실시간으로 사용자 페이지에 적용됩니다.</li>
											</ul>
										</div>
									</div>

								</div>
							</div>
							<?php $_i++;endforeach?>
						</div>
					</div>
					<div class="form-group rb-submit">
						<button class="btn btn-outline-primary btn-block btn-lg my-4" id="rb-submit-button" type="submit"><i class="fa fa-check fa-lg"></i> 수정하기</button>
					</div>
				</div>
				<?php endif?>
			</form>

		</div><!-- /.col-sm-8 -->
		<div class="col-sm-4">

			<div class="card">
				<div class="card-header">
					파일첨부
				</div>
				<div class="card-body">
					<div class="attach-files">
						<div class="btn-group">
							<button type="button" data-role="attach-handler-file" data-type="file" class="btn btn-link muted-link btn-sm" title="파일첨부" role="button" data-loading-text="업로드 중...">
								<i class="fa fa fa-upload"></i> 파일첨부
							</button>
							 <small>최대 <?php echo str_replace('M','',ini_get('upload_max_filesize'))?>MB 까지 업로드 할수 있습니다.</small>
					 </div>
					</div><!-- /.attach-files -->

					<div class="d-flex justify-content-start align-items-center pl-2">
						<a href="https://simplemde.com/markdown-guide" class="f12 muted-link" target="_blank">
							마크다운 문법안내
						</a>
					</div>

				</div><!-- /.card -->

				<!-- module : 첨부파일 사용 모듈 , theme : 첨부파일 테마 , attach_handler_file : 파일첨부 실행 엘리먼트 , attach_handler_photo : 사진첨부 실행 엘리먼트 ,parent_data : 수정시 필요한 해당 포스트 데이타 배열 변수, attach_handler_getModalList : 업로드 리스트 모달로 호출용 엘리먼트 (class 인 경우 . 까지 넘긴다.)  -->
				<?php getWidget('default/attach',array('parent_module'=>$m,'theme'=>'bs4-markdown','attach_handler_file'=>'[data-role="attach-handler-file"]','attach_handler_photo'=>'[data-role="attach-handler-photo"]','attach_handler_getModalList'=>'.getModalList','parent_data'=>$_issue));?>


			</div>


		</div><!-- /.col-sm-4 -->
	</div><!-- /.row -->

</div>


<?php if($markdown!='Y' && $d['admin']['codeeidt']):?>
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
var editor_php1 = CodeMirror.fromTextArea(getId('code_source'), {
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
var editor_php2 = CodeMirror.fromTextArea(getId('code_mobile'), {
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
var editor_css = CodeMirror.fromTextArea(getId('code_css'), {
	mode: "text/css",
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
var editor_js = CodeMirror.fromTextArea(getId('code_js'), {
	mode: "text/javascript",
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
editor_php1.setSize('100%','550px');
editor_php2.setSize('100%','550px');
editor_css.setSize('100%','550px');
editor_js.setSize('100%','550px');

_isCodeEdit = true;
function _codefullscreen()
{
	if(_nowArea == 'source') editor_php1.setOption('fullScreen', !editor_php1.getOption('fullScreen'));
	if(_nowArea == 'mobile') editor_php2.setOption('fullScreen', !editor_php2.getOption('fullScreen'));
	if(_nowArea == 'css') editor_css.setOption('fullScreen', !editor_css.getOption('fullScreen'));
	if(_nowArea == 'js') editor_js.setOption('fullScreen', !editor_js.getOption('fullScreen'));
}
</script>
<!-- @codemirror -->
<?php endif?>

<script>
_nowArea = '';
function focusArea(xid)
{

}
function sourcecheck(f)
{
	var f = document.procForm;
	getIframeForAction(f);
	return true;
}
getId('rb-more-tab-<?php echo $_mtype=='page'?'3':'2'?>').className = 'active';
</script>
<?php endif?>

<script>
$('.rb-modal-widgetcode').on('click',function() {
	modalSetting('modal_window','<?php echo getModalLink('&amp;system=popup.widget&amp;isWcode=Y')?>');
});
$('.rb-modal-widgetedit').on('click',function() {
	modalSetting('modal_window','<?php echo getModalLink('&amp;system=popup.widget&amp;isWcode=Y&amp;isEdit=Y')?>');
});
$('.rb-modal-photoset').on('click',function() {
	modalSetting('modal_window','<?php echo getModalLink('&amp;m=mediaset&amp;mdfile=modal.photo.media&amp;dropfield=editor')?>');
});
$('.rb-modal-videoset').on('click',function() {
	modalSetting('modal_window','<?php echo getModalLink('&amp;m=mediaset&amp;mdfile=modal.video.media&amp;dropfield=editor')?>');
});
$('.rb-modal-widgetcall').on('click',function() {
	modalSetting('modal_window','<?php echo getModalLink('&amp;system=popup.widget')?>&amp;dropfield=-1');
});
$('.rb-modal-widgetcall-modify').on('click',function() {
	modalSetting('modal_window','<?php echo getModalLink('&amp;system=popup.widget')?>&amp;dropfield='+_Wdropfield+'&amp;option='+_Woption);
});

<?php if($d['admin']['dblclick']):?>
document.ondblclick = function(event)
{
	getContext('<a class="dropdown-item" href="<?php echo $_viewpage?>">사용자모드 보기</a><a class="dropdown-item" href="#." onclick="goHref(getId(\'rb-list-back\').href);">등록정보 보기</a><div class="dropdown-divider"></div><a class="dropdown-item" href="#." onclick="getId(\'rb-submit-button\').click();">실행하기</a>',event);
}
<?php endif?>


putCookieAlert('site_edit_result') // 실행결과 알림 메시지 출력
</script>
