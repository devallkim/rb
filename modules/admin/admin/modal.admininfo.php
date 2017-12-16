<?php
$tab = $tab ? $tab : 'profile';
$_R1=getUidData($table['s_mbrid'],$uid);
$_R2=getDbData($table['s_mbrdata'],'memberuid='.$_R1['uid'],'*');
$_M=array_merge($_R1,$_R2);
if (!$_M['uid']) exit;
?>

<ul class="nav nav-tabs" role="tablist">
	<li<?php if($tab=='profile'):?> class="active"<?php endif?>><a href="<?php echo $g['adm_href']?>&amp;iframe=Y&amp;tab=profile&amp;uid=<?php echo $_M['uid']?>">프로필</a></li>
	<li<?php if($tab=='info'):?> class="active"<?php endif?>><a href="<?php echo $g['adm_href']?>&amp;iframe=Y&amp;tab=info&amp;uid=<?php echo $_M['uid']?>">정보변경</a></li>
	<li<?php if($tab=='log'):?> class="active"<?php endif?>><a href="<?php echo $g['adm_href']?>&amp;iframe=Y&amp;tab=log&amp;uid=<?php echo $_M['uid']?>">접속기록</a></li>
	<?php if($my['uid']==1 && $_M['uid']!=1 && $_M['admin']==1):?>
	<li<?php if($tab=='perm'):?> class="active"<?php endif?>><a href="<?php echo $g['adm_href']?>&amp;iframe=Y&amp;tab=perm&amp;uid=<?php echo $_M['uid']?>">관리제한</a></li>
	<?php endif?>
</ul>

<div class="tab-content">
	<div class="tab-pane active">

		<?php if($tab=='profile'):?>
		<div class="row">
			<div class="col-sm-3 col-lg-3 text-center">
				<br><br>
				<img alt="User Pic" src="<?php echo $g['s']?>/_var/avatar/<?php echo $_M['photo']?'180.'.$_M['photo']:'180.0.gif'?>" width="120" height="120" class="img-circle">
			</div>
			<div class="col-sm-9 col-lg-9">
				<table class="table rb-table-user">
					<tbody>
						<tr>
							<td>아이디</td>
							<td><?php echo $_M['id']?></td>
						</tr>
						<tr>
							<td>이름</td>
							<td><?php echo $_M['name']?></td>
						</tr>
						<tr>
							<td>닉네임</td>
							<td><?php echo $_M['nic']?></td>
						</tr>
						<tr>
							<td>이메일</td>
							<td><a href="mailto:<?php echo $_M['email']?>"><?php echo $_M['email']?></a></td>
						</tr>
						<tr>
							<td>연락처</td>
							<td><?php echo $_M['tel2']?$_M['tel2']:($_M['tel1']?$_M['tel1']:'<small>미등록</small>')?></td>
						</tr>
						<tr>
							<td>최근접속</td>
							<td><?php if($_M['last_log']):?><?php echo getDateFormat($_M['last_log'],'Y.m.d H:i')?> (<?php echo sprintf('%d일전',-getRemainDate($_M['last_log']))?>)<?php else:?><small>기록없음</small><?php endif?></td>
						</tr>
						<tr>
							<td>등록일</td>
							<td><?php echo getDateFormat($_M['d_regis'],'Y.m.d H:i')?> (<?php echo sprintf('%d일전',-getRemainDate($_M['d_regis']))?>)</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<?php endif?>


		<?php if($tab=='info'):?>
		<form name="procForm" class="form-horizontal" action="<?php echo $g['s']?>/" method="post" enctype="multipart/form-data" onsubmit="return saveCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="m" value="<?php echo $module?>">
		<input type="hidden" name="a" value="admin_member_add">
		<input type="hidden" name="id" value="<?php echo $_M['id']?>">
		<input type="hidden" name="uid" value="<?php echo $_M['uid']?>">
		<input type="hidden" name="avatar" value="<?php echo $_M['photo']?>">
		<input type="hidden" name="check_id" value="1">
		<input type="hidden" name="check_nic" value="1">
		<input type="hidden" name="check_email" value="1">
		<input type="submit" style="position:absolute;left:-1000px;">
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">아이디</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo $_M['id']?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">비밀번호</label>
			<div class="col-sm-9">
				<input type="password" class="form-control" name="pw1" placeholder="">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-9">
				<input type="password" class="form-control" name="pw2" placeholder="">
			</div>
		</div>
		<hr>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">프로필</label>
			<div class="col-sm-9">
				<div class="media">
					<span class="pull-left">
						<img class="media-object img-circle" src="<?php echo $g['s']?>/_var/avatar/<?php echo $_M['photo']?$_M['photo']:'0.gif'?>" alt="" style="width:45px">
					</span>
					<div class="media-body">
						<input type="file" name="upfile" class="hidden" id="rb-upfile-avatar" accept="image/jpg" onchange="getId('rb-photo-btn').innerHTML='이미지 파일 선택됨';">
						<button type="button" class="btn btn-default" onclick="$('#rb-upfile-avatar').click();" id="rb-photo-btn">찾아보기</button>
						<small class="help-block">
							<code>jpg</code> 파일을 등록해주세요.
							<?php if($_M['photo']):?> <label>( <input type="checkbox" name="avatar_delete" value="1"> 현재 아바타 삭제 )</label><?php endif?>
						</small>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">이름</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="name" placeholder="" value="<?php echo $_M['name']?>" maxlength="10">
			</div>
		</div>
		<div class="form-group rb-outside">
			<label class="col-sm-2 control-label">닉네임</label>
			<div class="col-sm-9">
				<div class="input-group">
					<input type="text" class="form-control" name="nic" placeholder="" value="<?php echo $_M['nic']?>" maxlength="20" onchange="sendCheck('rb-nickcheck','nic');">
					<span class="input-group-btn">
						<button type="button" class="btn btn-default" id="rb-nickcheck" onclick="sendCheck('rb-nickcheck','nic');">중복확인</button>
					</span>
				</div>
			</div>
		</div>
		<div class="form-group rb-outside">
			<label class="col-sm-2 control-label">이메일</label>
			<div class="col-sm-9">
				<div class="input-group">
					<input type="email" class="form-control" name="email" placeholder="" value="<?php echo $_M['email']?>" onchange="sendCheck('rb-emailcheck','email');">
					<span class="input-group-btn">
						<button type="button" class="btn btn-default" id="rb-emailcheck" onclick="sendCheck('rb-emailcheck','email');">중복확인</button>
					</span>
				</div>
				<p class="form-control-static"><small class="text-muted">비밀번호 분실시에 사용됩니다. 정확하게 입력하세요.</small></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">연락처</label>
			<div class="col-sm-9">
				<input type="tel" class="form-control" name="tel2" placeholder="예) 010-000-0000" value="<?php echo $_M['tel2']?$_M['tel2']:$_M['tel1']?>">
			</div>
		</div>
		</form>
		<form name="actionform" action="<?php echo $g['s']?>/" method="post">
			<input type="hidden" name="r" value="<?php echo $r?>">
			<input type="hidden" name="m" value="<?php echo $module?>">
			<input type="hidden" name="a" value="admin_member_add_check">
			<input type="hidden" name="type" value="">
			<input type="hidden" name="fvalue" value="">
		</form>
		<?php endif?>



		<?php if($tab=='log'):?>
		<?php
		$sort	= $sort ? $sort : 'uid';
		$orderby= $orderby ? $orderby : 'desc';
		$recnum	= $recnum && $recnum < 200 ? $recnum : 10;

		$sqlque = 'mbruid='.$_M['uid'];
		if ($siteuid) $sqlque .= ' and site='.$siteuid;
		if ($d_start) $sqlque .= ' and d_regis > '.str_replace('/','',$d_start).'000000';
		if ($d_finish) $sqlque .= ' and d_regis < '.str_replace('/','',$d_finish).'240000';
		if ($where && $keyw)
		{
			$sqlque .= getSearchSql($where,$keyw,$ikeyword,'or');
		}
		$RCD = getDbArray($table['s_referer'],$sqlque,'*',$sort,$orderby,$recnum,$p);
		$NUM = getDbRows($table['s_referer'],$sqlque);
		$TPG = getTotalPage($NUM,$recnum);
		?>

		<div id="admin-log">
			<p>
				<small><?php echo sprintf('총 %d건',$NUM)?>  (<?php echo $p?>/<?php echo $TPG?> page<?php if($TPG>1):?>s<?php endif?>)</small>
			</p>

			<form name="searchForm" class="form-horizontal" action="<?php echo $g['s']?>/" method="post">
			<input type="hidden" name="r" value="<?php echo $r?>">
			<input type="hidden" name="m" value="<?php echo $m?>">
			<input type="hidden" name="module" value="<?php echo $module?>">
			<input type="hidden" name="front" value="<?php echo $front?>">
			<input type="hidden" name="tab" value="<?php echo $tab?>">
			<input type="hidden" name="uid" value="<?php echo $_M['uid']?>">
			<input type="hidden" name="p" value="<?php echo $p?>">
			<input type="hidden" name="iframe" value="<?php echo $iframe?>">

			<div class="panel-heading">
			   <div class="row well well-sm">
					<div class="col-sm-6">
						<select name="siteuid" class="form-control input-sm" onchange="this.form.submit();">
						<option value="">전체사이트</option>
						<?php $SITES = getDbArray($table['s_site'],'','*','gid','asc',0,$p)?>
						<?php while($S = db_fetch_array($SITES)):?>
						<option value="<?php echo $S['uid']?>"<?php if($S['uid']==$siteuid):?> selected<?php endif?>><?php echo $S['name']?> (<?php echo $S['id']?>)</option>
						<?php endwhile?>
						</select>
					</div>
					<div class="col-sm-6">
						<div class="input-daterange input-group input-group-sm" id="datepicker">
							<input type="text" class="form-control" name="d_start" placeholder="시작일 선택" value="<?php echo $d_start?>">
							<span class="input-group-addon">~</span>
							<input type="text" class="form-control" name="d_finish" placeholder="종료일 선택" value="<?php echo $d_finish?>">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit">기간적용</button>
							</span>
						</div>
					</div>
			   </div>
			</div>

			<table class="table table-hover" style="border-bottom:#ccc solid 1px;">
				<thead>
					<tr>
						<th>번호</th>
						<th>아이피</th>
						<th class="rb-url">접속경로</th>
						<th>브라우저</th>
						<th>기기</th>
						<th>날짜</th>
					</tr>
				</thead>
				<tbody>
					<?php while($R=db_fetch_array($RCD)):?>
					<?php $_browzer=getBrowzer($R['agent'])?>
					<?php $_deviceKind=isMobileConnect($R['agent'])?>
					<?php $_deviceType=getDeviceKind($R['agent'],$_deviceKind)?>
					<tr>
						<td><?php echo $NUM-((($p-1)*$recnum)+$_rec++)?></td>
						<td><?php echo $R['ip']?></td>
						<td class="rb-url"><a href="<?php echo $R['referer']?>" target="_blank"><?php echo getDomain($R['referer'])?></a></td>
						<td><?php echo strtoupper($_browzer)?></td>
						<td>
							<?php if($_browzer=='Mobile'):?>
							<small class="label label-<?php echo $_deviceType=='tablet'?'danger':'warning'?>" data-tooltip="tooltip" title="<?php echo $_deviceKind?>"><?php echo $_deviceType?></small>
							<?php else:?>
							<small class="label label-default">desktop</small>
							<?php endif?>
						</td>
						<td class="rb-update">
							<time class="timeago" data-toggle="tooltip" datetime="<?php echo getDateFormat($R['d_regis'],'c')?>" data-tooltip="tooltip" title="<?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?>"></time>
						</td>
					</tr>
					<?php endwhile?>
				</tbody>
			</table>
			<?php if(!$NUM):?>
			<div class="rb-none">접속기록이 없습니다.</div>
			<?php endif?>

			<div class="panel-body text-center">
				<ul class="pagination pagination-sm">
				<script type="text/javascript">getPageLink(5,<?php echo $p?>,<?php echo $TPG?>,'');</script>
				<?php //echo getPageLink(5,$p,$TPG,'')?>
				</ul>
			</div>
			<div class="panel-body text-center">
			   <div class="row well well-sm">
					<div class="col-sm-12">
						<div class="input-group input-group-sm">
							<span class="input-group-btn">
								<select name="where" class="btn btn-default">
									<option<?php if($where=='ip'):?> selected<?php endif?>>아이피</option>
									<option<?php if($where=='referer'):?> selected<?php endif?>>접속경로</option>
								</select>
							</span>
							<input type="text" name="keyw" class="form-control" placeholder="검색어를 입력해주세요" value="<?php echo $keyw?>">
							<span class="input-group-btn" style="margin-bottom:0;">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i>검색</button>
								<button class="btn btn-default" type="button" onclick="this.form.keyw.value='';this.form.submit();">리셋</button>
							</span>
						</div>
					</div>
			   </div>
			</div>
			</form>
		</div>

		<!-- bootstrap-datepicker,  http://eternicode.github.io/bootstrap-datepicker/  -->
		<?php getImport('bootstrap-datepicker','css/datepicker3',false,'css')?>
		<?php getImport('bootstrap-datepicker','js/bootstrap-datepicker',false,'js')?>
		<?php getImport('bootstrap-datepicker','js/locales/bootstrap-datepicker.kr',false,'js')?>
		<style type="text/css">
		.datepicker {z-index: 1151 !important;}
		</style>
		<script>
		$('.input-daterange').datepicker({
			format: "yyyy/mm/dd",
			todayBtn: "linked",
			language: "kr",
			calendarWeeks: true,
			todayHighlight: true,
			autoclose: true
		});
		</script>
		<!-- timeago -->
		<?php getImport('jquery-timeago','jquery.timeago',false,'js')?>
		<?php getImport('jquery-timeago','locales/jquery.timeago.ko',false,'js')?>
		<script>
		jQuery(document).ready(function() {
			$(".rb-update time").timeago();
		});
		</script>
		<?php endif?>


		<?php if($tab=='perm'):?>
		<form name="permForm" action="<?php echo $g['s']?>/" method="post" onsubmit="return saveCheck1();">
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="m" value="<?php echo $module?>">
		<input type="hidden" name="a" value="admin_perm">
		<input type="hidden" name="memberuid" value="<?php echo $_M['uid']?>">
		<input type="submit" style="position:absolute;left:-1000px;">
		<div class="alert alert-danger">
			<div class="clearfix">
				<h5 class="pull-left">
					<i class="fa fa-warning fa-lg pull-left"></i>
					<strong>접근을 제한할 모듈</strong>을 선택해 주세요.
				</h5>
				<div class="checkbox pull-right" style="padding-left:20px;">
					<label><input type="checkbox" id="checkAll-perm"> 전체선택</label>
				</div>
			</div>

			<div>
				<ul class="list-inline">
				<?php $MODULES = getDbArray($table['s_module'],'','*','gid','asc',0,1)?>
				<?php while($_MD=db_fetch_array($MODULES)):?>
				<li>
					<label class="checkbox-inline">
						<input type="checkbox" name="module_members[]" value="<?php echo $_MD['id']?>"<?php if(strpos('_'.$_M['adm_view'],'['.$_MD['id'].']')):?> checked<?php endif?> class="rb-module-perm">
						<?php echo $_MD['name']?>
					</label>
				</li>
				<?php endwhile?>
				</ul>
			</div>
		</div>
		</form>
		<?php endif?>
	</div>
</div>

















<!----------------------------------------------------------------------------
@부모레이어를 제어할 수 있도록 모달의 헤더와 풋터를 부모레이어에 출력시킴
----------------------------------------------------------------------------->

<div id="_modal_header" class="hidden">
	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	<h4 class="modal-title">
		<small class="label label-<?php echo $_M['now_log']?'primary':'default'?>" data-tooltip="tooltip" title="<?php echo $_M['now_log']?'온라인':'오프라인'?>"><?php echo $_M['admin']?($_M['adm_view']?'부관리자':'최고관리자'):'일반회원'?></small>
		<?php echo sprintf('<strong>%s</strong> 님의 정보',$_M['name'])?>
	</h4>
</div>
<div id="_modal_footer" class="hidden">
	<?php if($tab=='info'):?>
	<button type="submit" class="btn btn-primary pull-left" onclick="frames._modal_iframe_modal_window.saveCheck();">정보 수정하기</button>
	<?php endif?>
	<?php if($tab=='perm'):?>
	<button type="submit" class="btn btn-primary pull-left" onclick="frames._modal_iframe_modal_window.saveCheck1();">권한 제한하기</button>
	<?php endif?>
	<button id="_close_btn_" type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
</div>



<script>
$("#checkAll-perm").click(function(){
	$(".rb-module-perm").prop("checked",$("#checkAll-perm").prop("checked"))
})
var submitFlag = false;
function sendCheck(id,t)
{
	var f = document.actionform;
	var f1 = document.procForm;

	if (submitFlag == true)
	{
		alert('응답을 기다리는 중입니다. 잠시 기다려 주세요.');
		return false;
	}
	if (eval("f1."+t).value == '')
	{
		eval("f1."+t).focus();
		return false;
	}
	f.type.value = t;
	f.fvalue.value = eval("f1."+t).value;
	getId(id).innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
	getIframeForAction(f);
	f.submit();
	submitFlag = true;
}
function saveCheck()
{
	var f = document.procForm;
	if (f.pw1.value != f.pw2.value)
	{
		alert('비밀번호가 서로 일치하지 않습니다. ');
		return false;
	}
	if (f.name.value == '')
	{
		alert('이름을 입력해 주세요.   ');
		f.name.focus();
		return false;
	}
	if (f.nic.value == '')
	{
		alert('닉네임을 입력해 주세요.   ');
		f.nic.focus();
		return false;
	}
	if (f.email.value == '')
	{
		alert('이메일을 입력해 주세요.   ');
		f.email.focus();
		return false;
	}
	if (confirm('정말로 수정하시겠습니까?   '))
	{
		getIframeForAction(f);
		f.submit();
	}
	return false;
}
function saveCheck1()
{
	var f = document.permForm;
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


<style>
#rb-body {
	background: #fff;
}
#rb-body .rb-table-user > tbody > tr:first-child td {
    border-top: none;
}
#admin-log .panel {
	border: none;
}

#admin-log .panel-heading label {
	line-height: 35px
}

#admin-log .panel-heading,
#admin-log .panel-footer {
	background-color: transparent;
	padding: 10px 0
}

#admin-log .panel-footer .row [class*="col-"] {
    margin-top: 10px
}

@media (min-width: 768px) {
	#admin-log .panel-footer .row {
	    margin-left: -.5%;
	    margin-right: -.5%;
	}
	#admin-log .panel-footer .row [class*="col-"] {
	    min-height: 1px;
	    padding-left: .5%;
	    padding-right: .5%;
	    padding-top: 10px;
	    margin-top: 0;
	}
}

#admin-log .table th {
	font-weight: normal;
	font-size: 11px;
	border-bottom: 1px solid #ddd;
	color: #777;
	text-align: center
}

#admin-log .table td {
	font-size: 12px;
	text-align: center;
}

#admin-log .table td small {
	display: inline-block;
	width: 60px;
	font-size: 10px;
	padding-top: 3px;
	padding-bottom: 4px;
}
#admin-log .panel-body .pagination {
	margin-bottom: 0
}

#admin-log .table .rb-url {
	width: 50px;
	text-overflow: ellipsis;
	white-space: nowrap;
	overflow: hidden;
	-o-text-overflow: ellipsis;
	-ms-text-overflow: ellipsis;
}

#admin-log .rb-message {
	width: 60%;
}
#admin-log .rb-message span {
	display: block;
	text-align: left;
}
#admin-log .rb-not-confirm {
	font-size: 11px;
}
#admin-log .rb-table-tbody td {
	color: #666;
}

#admin-log .rb-none {
	text-align: center;
	color: #999;
	border-bottom: #dfdfdf solid 1px;
	padding-bottom: 15px;
	margin-bottom: 15px;
}

@media (min-width: 768px) {
	#admin-log .panel-heading .row {
	    margin-left: -.5%;
	    margin-right: -.5%;
	}
	#admin-log .panel-heading .row [class*="col-"] {
	    min-height: 1px;
	    padding-left: .5%;
	    padding-right: .5%;
	    margin-top: 0;

	}

	#admin-log .panel-heading .row .rb-year {
		width: 100px
	}
	#admin-log .panel-heading .row .rb-month {
		width: 90px
	}
	#admin-log .panel-heading .row .rb-day {
		width: 100px
	}
}

@media (max-width: 767px) {
	#admin-log .panel-heading .row [class*="col-"] {
	    padding-top: 10px;
	}
}
</style>
