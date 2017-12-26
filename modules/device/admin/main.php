<?php
$R = getDbData($table['s_mobile'],'','*');
?>
<div id="mobilebox" class="p-4">
	<form class="rb-form" name="procForm" action="<?php echo $g['s']?>/" method="post" onsubmit="return saveCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="mobile" />
		<input type="hidden" name="checkm" value="<?php echo $R['usemobile']?$R['usemobile']:0?>" />

		<ul class="list-inline">
			<li class="list-inline-item"><i class="fa fa-tablet fa-5x"></i></li>
			<li class="list-inline-item"><i class="fa fa-mobile fa-4x"></i></li>
			<li class="list-inline-item"><h2>모바일 기기로 접속 시</h2></li>
		</ul>
		<div class="nav btn-group btn-group-lg w-100" data-toggle="buttons">
			<a href="#usemobile-00" class="btn btn-light<?php if(!$R['usemobile']):?> active<?php endif?>" style="width: 33.3%;height:46px;font-size:18px;" data-toggle="tab">
				<input type="radio" name="usemobile" value="0"<?php if(!$R['usemobile']):?> checked="checked"<?php endif?>> 사이트별 모바일모드 적용
			</a>
			<a href="#usemobile-02" class="btn btn-light<?php if($R['usemobile']==2):?> active<?php endif?>" style="width: 33.3%;height:46px;font-size:18px;" data-toggle="tab">
				<input type="radio" name="usemobile" value="2"<?php if($R['usemobile']==2):?> checked="checked"<?php endif?>> 특정 도메인 으로 이동
			</a>
			<a href="#usemobile-01" class="btn btn-light<?php if($R['usemobile']==1):?> active<?php endif?>" style="width: 33.3%;height:46px;font-size:18px;" data-toggle="tab">
				<input type="radio" name="usemobile" value="1"<?php if($R['usemobile']==1):?> checked="checked"<?php endif?>> 특정 사이트로 연결
			</a>
		</div>
		<div class="tab-content">
			<div class="tab-pane bg-light border rounded p-3 text-muted fade<?php if(!$R['usemobile']):?> show active<?php endif?>" id="usemobile-00">
				모바일 기기로 접속 시 사이트별로 모바일 모드를 적용할 수 있습니다.
			</div>
			<div class="tab-pane text-muted fade<?php if($R['usemobile']==2):?> show active<?php endif?>" id="usemobile-02">
				<div class="input-group input-group-lg">
					<span class="input-group-addon"><i class="fa fa-lg fa-fw kf kf-domain"></i></span>
					<select name="startdomain" class="form-control custom-select" style="height:50px;">
						<option value="">모바일 기기로 접속 시 연결할 도메인을 선택 하세요</option>
						<?php $SITES = getDbArray($table['s_domain'],'','*','gid','asc',0,$p)?>
						<?php while($S = db_fetch_array($SITES)):?>
						<option value="http://<?php echo $S['name']?>"<?php if('http://'.$S['name']==$R['startdomain']):?> selected<?php endif?>>ㆍ<?php echo $S['name']?></option>
						<?php endwhile?>
						<?php if(!db_num_rows($SITES)):?>
						<option value="">등록된 도메인이 없습니다.</option>
						<?php endif?>
					</select>
				</div>
				<p class="mt-2">
					모바일 기기로 접속 시 특정 도메인을 연결할 수 있습니다.
					<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=domain&amp;type=makedomain" class="btn btn-link">도메인 추가</a>
				</p>
			</div>
			<div class="tab-pane text-muted fade<?php if($R['usemobile']==1):?> show active<?php endif?>" id="usemobile-01">
				<div class="input-group input-group-lg">
					<span class="input-group-addon"><i class="fa fa-lg fa-fw kf kf-home"></i></span>
					<select name="startsite" class="form-control custom-select" style="height:50px;">
						<option value="">모바일 기기로 접속 시 연결할 사이트를 선택하세요.</option>
						<?php $SITES = getDbArray($table['s_site'],'','*','gid','asc',0,$p)?>
						<?php while($S = db_fetch_array($SITES)):?>
						<option value="<?php echo $S['uid']?>"<?php if($S['uid']==$R['startsite']):?> selected<?php endif?>>ㆍ<?php echo $S['name']?></option>
						<?php endwhile?>
						<?php if(!db_num_rows($SITES)):?>
						<option value="">등록된 사이트가 없습니다.</option>
						<?php endif?>
					</select>
				</div>
				<p class="pt-2">
					모바일 기기로 접속 시 특정 사이트로 연결할 수 있습니다. 도메인은 유지 됩니다.
					<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=site&amp;type=makesite" class="btn btn-link">사이트 추가</a>
				</p>
			</div>
		</div>


		<div class="form-group mt-4">
			<label>디바이스 목록</label>
			<textarea name="agentlist" rows="11" class="form-control"><?php echo trim(implode('',file($g['path_var'].'mobile.agent.txt')))?></textarea>
		</div>

		<button type="submit" class="btn btn-outline-primary btn-block btn-lg my-4">저장하기</button>

</form>
</div>

<script>
function saveCheck(f)
{
	if (f.checkm.value == '1')
	{
		if (f.startsite.value == '')
		{
			alert('시작사이트를 지정해 주세요.   ');
			f.startsite.focus();
			return false;
		}
	}
	if (f.checkm.value == '2')
	{
		if (f.startdomain.value == '')
		{
			alert('시작도메인을 지정해 주세요.   ');
			f.startdomain.focus();
			return false;
		}
	}
	if (confirm('정말로 실행하시겠습니까?       '))
	{
		getIframeForAction(f);
		$(".btn-primary").addClass("disabled");
		return true;
	}
	return false;
}
</script>
