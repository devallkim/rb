<link href="<?php echo $g['s']?>/_core/css/github-markdown.css" rel="stylesheet">
<?php getImport('jquery-markdown','jquery.markdown','0.0.10','js')?>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-4 col-md-4 col-xl-3 d-none d-sm-block sidebar"><!-- 좌측영역 시작 -->
    	<div class="card">
    		<div class="card-header">
          테마 리스트
   			</div>

        <div class="list-group list-group-flush">
          <?php $i=0?>
          <?php $xdir = $g['path_module'].$module.'/theme/'?>
          <?php $tdir = $xdir.'_pc/'?>
          <?php $dirs = opendir($tdir)?>
          <?php while(false !== ($skin = readdir($dirs))):?>
          <?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
          <?php $i++?>
          <a href="<?php echo $g['adm_href']?>&amp;theme=_pc/<?php echo $skin?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center<?php if($theme=='_pc/'.$skin):?> border border-primary<?php endif?>">
            <span><i class="fa fa-desktop fa-lg fa-fw" aria-hidden="true"></i> <?php echo getFolderName($tdir.$skin)?></span>
            <span class="badge badge-<?php echo $theme=='_pc/'.$skin?'primary':'dark' ?> badge-pill"><?php echo $skin?></span>
          </a>
          <?php endwhile?>
          <?php closedir($dirs)?>
          <?php $tdir = $xdir.'_mobile/'?>
          <?php $dirs = opendir($tdir)?>
          <?php while(false !== ($skin = readdir($dirs))):?>
          <?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
          <?php $i++?>
          <a href="<?php echo $g['adm_href']?>&amp;theme=_mobile/<?php echo $skin?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center<?php if($theme=='_mobile/'.$skin):?> border border-primary<?php endif?>">
            <span><i class="fa fa-mobile fa-2x fa-fw" aria-hidden="true"></i> <?php echo getFolderName($tdir.$skin)?></span>
            <span class="badge badge-<?php echo $theme=='_mobile/'.$skin?'primary':'dark' ?> badge-pill"><?php echo $skin?></span>
          </a>
        <?php endwhile?>
        <?php closedir($dirs)?>
        </div>

        <?php if(!$i):?>
        <div class="none">등록된 테마가 없습니다.</div>
        <?php endif?>


      </div> <!-- 좌측 card 끝 -->
    </div>  <!-- 좌측 영역 끝 -->
 	<div class="col-sm-8 col-md-8 ml-sm-auto col-xl-9 pt-3">


 		<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
   		<input type="hidden" name="r" value="<?php echo $r?>" />
   		<input type="hidden" name="m" value="<?php echo $module?>" />
   		<input type="hidden" name="a" value="theme_config" />
   		<input type="hidden" name="theme" value="<?php echo $theme?>" />

 		<?php if($theme):?>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">root</li>
        <li class="breadcrumb-item">modules</li>
        <li class="breadcrumb-item"><?php echo $module?></li>
        <li class="breadcrumb-item">theme</li>
        <li class="breadcrumb-item"><?php echo $theme?></li>
        <li class="breadcrumb-item">_var.php</li>
      </ol>


      <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
          <a class="nav-link active" href="#readme" data-toggle="tab"><i class="fa fa-file-text-o" aria-hidden="true"></i> 안내문서</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#var" data-toggle="tab"><i class="fa fa-code" aria-hidden="true"></i> 설정 변수</a>
        </li>
      </ul>

      <div class="tab-content">

        <div class="tab-pane show active" id="readme" role="tabpanel" aria-labelledby="readme-tab">

          <div class="markdown-body px-2 py-0 readme">
            <?php readfile($g['path_module'].$module.'/theme/'.$theme.'/README.md')?>
          </div>
          <div class="py-5">
            <h2>라이센스</h2>
            <textarea class="form-control" rows="10"><?php readfile($g['path_module'].$module.'/theme/'.$theme.'/LICENSE')?></textarea>
          </div>

        </div>

        <div class="tab-pane" id="var" role="tabpanel" aria-labelledby="var-tab">

       		<div class="rb-files">
       			<div class="rb-codeview">

       				<div class="rb-codeview-body">
       					<textarea name="theme_var" id="__code__" class="form-control" rows="35"><?php echo implode('',file($g['path_module'].$module.'/theme/'.$theme.'/_var.php'))?></textarea>
       				</div>
       				<div class="input-group hidden-xs">
       					<span class="input-group-addon"><small>Theme Name</small></span>
       					<input type="text" name="name" value="<?php echo getFolderName($g['path_module'].$module.'/theme/'.$theme)?>" class="form-control">

       					<span class="input-group-addon"><small>Theme Folder</small></span>
       					<input type="text" name="newLayout" value="<?php echo $theme?>" class="form-control">
       				</div>

       				<div class="rb-codeview-footer">
       					<ul class="list-inline">
       						<li><code><?php echo count(file($g['path_module'].$module.'/theme/'.$theme.'/_var.php')).' lines'?></code></li>
       						<li><code><?php echo getSizeFormat(@filesize($g['path_module'].$module.'/theme/'.$theme.'/_var.php'),2).' Byte'?></code></li>
       						<li class="pull-right">파일을 편집한 후 저장 버튼을 클릭하면 실시간으로 사용자 페이지에 적용됩니다.</li>
       					</ul>
       				</div>

       			</div> <!--.rb-codeview -->
       			</div> <!--.rb-files -->
       			<div class="rb-submit">
              <div class="small text-muted">
                이 테마를 사용하는 모든 게시판에 아래의 설정값이 적용됩니다.
              </div>
       				<button type="submit" class="btn btn-primary<?php if($g['device']):?> btn-block<?php endif?>">저장하기</button>

              <?php if($theme):?>
              <div class="pull-right">
                <a class="btn btn-danger" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=theme_delete&amp;theme=<?php echo $theme?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 이 테마를 삭제하시겠습니까?       ');">테마삭제</a>
              </div>
              <?php endif?>

       			</div>
        </div><!-- /.tab-pane -->

      </div><!-- /.tab-content -->



 		<?php else:?>

 		<div class="help-block">
 			테마가 선택되지 않았습니다. 테마를 선택해 주세요.<br />
 			테마설정은 해당 테마를 사용하는 모든 게시판에 적용됩니다.
 		</div>
       <div class="help-block">
 			<ul class="list list-unstyled">
 				<li>테마는 게시판의 외형을 변경할 수 있는 요소입니다.</li>
 				<li>테마설정은 게시판의 외형만 제어하며 게시판의 내부시스템에는 영향을 주지 않습니다.</li>
 				<li>테마의 속성을 변경하면 해당테마를 사용하는 모든 게시판에 적용됩니다.</li>
 			</ul>
 	   </div>

 		<?php endif?>

 		</form>
    </div> <!-- 우측영역 끝 -->
 </div> <!--.row -->
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

$(".markdown-body").markdown();

var editor = CodeMirror.fromTextArea(getId('__code__'), {
	mode: "<?php echo $codeset[$codeext]?$codeset[$codeext]:'application/x-httpd-php'?>",
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


<script type="text/javascript">
//<![CDATA[
function saveCheck(f)
{
	return confirm('정말로 실행하시겠습니까?         ');
}
//]]>
</script>
