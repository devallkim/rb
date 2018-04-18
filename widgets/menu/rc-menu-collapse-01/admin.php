<div id="mjointbox">
	<h5>
		<i class="fa fa-info-circle"></i>
		<?php echo getFolderName($g['path_widget'].$swidget)?>
	</h5>

	<form name="procform" class="form-horizontal rb-form" role="form">
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">시작메뉴</label>
			<div class="col-sm-8">
				<select name="smenu" class="form-control">
				<option value="0"<?php if(!$wdgvar['smenu']):?> selected<?php endif?>>ㆍ처음(root)</option>
				<option value="-1">ㆍ1단계 선택메뉴</option>
				<option value="-2">ㆍ2단계 선택메뉴</option>
				<option value="-3">ㆍ3단계 선택메뉴</option>
				<option value="0">----------------------------------------------------------------</option>
				<?php $_isUid='u'?>
				<?php $cat=$wdgvar['smenu']?>
				<?php include $g['path_core'].'function/menu1.func.php'?>
				<?php getMenuShowSelect($s,$table['s_menu'],0,0,0,0,0,'')?>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">추출단계</label>
			<div class="col-sm-8">
				<select name="limit" class="form-control">
				<?php for($i = 1; $i < 3; $i++):?>
				<option value="<?php echo $i?>"<?php if($wdgvar['limit']==$i||(!$wdgvar['limit']&&$i==2)):?> selected="selected"<?php endif?>>ㆍ<?php echo sprintf('시작메뉴 포함 %s단계',$i)?></option>
				<?php endfor?>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label">링크방식</label>
			<div class="col-sm-8">
				<select name="link" class="form-control">
				<option value="link">ㆍ일반</option>
				<option value="bookmark">ㆍ북마크</option>
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
			<label class="col-sm-2 col-form-label">접근 ID</label>
			<div class="col-sm-8">
				<input type="text" name="collid" value="<?php echo $wdgvar['collid']?$wdgvar['collid']:'rb-sidemenu-collapse'?>" class="form-control">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-8">
				<label class="rb-label"><input type="checkbox" name="collapse" value="1"<?php if($wdgvar['collapse']):?> checked<?php endif?>> Collapse 사용(미 사용시 일반메뉴 출력)</label>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-8">
				<label class="rb-label"><input type="checkbox" name="dispfmenu" value="1"<?php if($wdgvar['dispfmenu']):?> checked<?php endif?>> Collapse 사용시 선택메뉴 링크를 포함시킴</label>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 col-form-label"></label>
			<div class="col-sm-8">
				<span class="help-block">
					<small>
						메뉴의 구조가 bootstrap의 <code>collapse</code> 용 태그로 생성됩니다.<br>
						아이디는 겹치지 않는 문자로 지정해야 합니다.
					</small>
				</span>
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
	if(f.collid.value) widgetInfo+= "'collid'=>'"+f.collid.value+"',";
	if(f.dispfmenu.checked) widgetInfo+= "'dispfmenu'=>'1',";
	if(f.collapse.checked) widgetInfo+= "'collapse'=>'1',";

	if (n) return "<img alt=\"getWidget('"+widgetName+"',array("+widgetInfo+"))\" class=\"rb-widget-edit-img\" src=\"./_core/images/blank.gif\">"; // 에디터삽입 위젯 이미지 코드
	else return "<"+"?php "+"getWidget('"+widgetName+"',array("+widgetInfo+"))?>"; // PHP 위젯함수 코드
}
//위젯 삽입하기
function saveCheck(n)
{
	<?php $isCodeOnly='Y'?>// 코드추출만 지원할 경우
}
</script>
