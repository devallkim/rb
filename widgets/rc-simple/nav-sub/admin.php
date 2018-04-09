<div id="mjointbox">
	<p class="text-muted">
		<i class="fa fa-info-circle"></i>
		<?php echo sprintf('이 위젯(<strong>%s</strong>)의 코드를 추출하시겠습니까?',getFolderName($g['path_widget'].$swidget))?>
	</p>

	<form name="procform" class="form-horizontal rb-form" role="form">
		<div class="form-group row">
			<label class="col-sm-3 control-label">시작메뉴</label>
			<div class="col-sm-8">
				<select name="smenu" class="form-control custom-select">
				<option value="0">처음(root)</option>
				<option value="-1">1단계 선택메뉴</option>
				<option value="-2">2단계 선택메뉴</option>
				<option value="-3">3단계 선택메뉴</option>
				<option value="0" disabled>---------------------------------------</option>
				<?php $_isUid='u'?>
				<?php $cat=$wdgvar['smenu']?>
				<?php include $g['path_core'].'function/menu1.func.php'?>
				<?php getMenuShowSelect($s,$table['s_menu'],0,0,0,0,0,'')?>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-3 control-label">추출단계</label>
			<div class="col-sm-8">
				<select name="limit" class="form-control custom-select">
				<?php for($i = 1; $i < 6; $i++):?>
				<option value="<?php echo $i?>"<?php if($wdgvar['limit']==$i || (!$wdgvar['limit']&&$i==2)):?> selected="selected"<?php endif?>><?php echo sprintf('시작메뉴 하위 %s단계',$i)?></option>
				<?php endfor?>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-3 control-label">링크방식</label>
			<div class="col-sm-8">
				<select name="link" class="form-control custom-select">
				<option value="link">일반</option>
				<option value="bookmark">북마크</option>
				</select>
				<span class="help-block">
					<small>
						북마크 방식을 지정하면 링크가 다음과 같이 생성됩니다.<br>
						<code>&lt;a data-scroll href=&quot;#MENUCODE&quot;&gt;</code>
					</small>
				</span>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-3 control-label">드롭다운</label>
			<div class="col-sm-8">

				<div class="custom-control custom-checkbox">
				  <input type="checkbox" class="custom-control-input" id="dropdown" name="dropdown" value="1"<?php if($wdgvar['dropdown']):?> checked<?php endif?>>
				  <label class="custom-control-label" for="dropdown">부트스트랩 드롭다운 class 삽입</label>
				</div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="dispfmenu" name="dispfmenu" value="1"<?php if($wdgvar['dispfmenu']):?> checked<?php endif?>>
					<label class="custom-control-label" for="dispfmenu">서브메뉴에 상위메뉴 링크를 포함시킴</label>
				</div>

				<small class="form-text text-muted">
					(드롭다운은 메뉴 2단계까지만 지원됩니다.) <br>
					메뉴의 구조는 <code>&lt;ul&gt;</code> 태그로 생성됩니다.<br>
					추출한 코드를 <code>&lt;ul class=&quot;nav navbar-nav&quot;&gt;[위젯코드]&lt;/ul&gt;</code> 와 같은 형식으로 감싼 후 CSS로 디자인해 주세요.<br>
					선택된 메뉴는 <code>.active</code> 클래스로 접근할 수 있습니다.
				</small>
			</div>
		</div>
	</form>
</div>

<style>
#mjointbox {padding-bottom:50px;}
#mjointbox h5 {border-bottom:#dfdfdf dashed 1px;padding:12px 0 15px 0;margin:0 0 30px 0;}
#mjointbox .rb-label {font-weight:normal;cursor:pointer;}
</style>


<script>
//위젯코드 리턴
function widgetCode(n)
{
	var f = document.procform;
	var widgetName = "<?php echo $swidget?>"; // 위젯명칭
	var widgetInfo = "";

	if(f.smenu.value) widgetInfo+= "'smenu'=>'"+f.smenu.value+"',";
	if(f.limit.value) widgetInfo+= "'limit'=>'"+f.limit.value+"',";
	if(f.link.value) widgetInfo+= "'link'=>'"+f.link.value+"',";
	if(f.dropdown.checked) widgetInfo+= "'dropdown'=>'1',";
	if(f.dispfmenu.checked) widgetInfo+= "'dispfmenu'=>'1',";

	if (n) return "<img alt=\"getWidget('"+widgetName+"',array("+widgetInfo+"))\" class=\"rb-widget-edit-img\" src=\"./_core/images/blank.gif\">"; // 에디터삽입 위젯 이미지 코드
	else return "<"+"?php "+"getWidget('"+widgetName+"',array("+widgetInfo+"))?>"; // PHP 위젯함수 코드
}
//위젯 삽입하기
function saveCheck(n)
{
	<?php $isCodeOnly='Y'?>// 코드추출만 지원할 경우
}
</script>
