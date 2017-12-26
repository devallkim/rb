<?php
$sort	= $sort ? $sort : 'uid';
$orderby= $orderby ? $orderby : 'desc';
$recnum	= $recnum && $recnum < 301 ? $recnum : 30;
$sqlque	= 'uid';

if ($siteuid) $sqlque .= ' and site='.$siteuid;
if ($moduleid) $sqlque .= " and frommodule='".$moduleid."'";
if ($isread)
{
	if ($isread == 1) $sqlque .= " and d_read<>''";
	else $sqlque .= " and d_read=''";
}
if ($where && $keyw)
{
	$sqlque .= getSearchSql($where,$keyw,$ikeyword,'or');
}

$RCD = getDbArray($table['s_notice'],$sqlque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['s_notice'],$sqlque);
$TPG = getTotalPage($NUM,$recnum);
?>


<div id="notification" class="p-4">

	<h4>알림 로그</h4>

	<form name="procForm" action="<?php echo $g['s']?>/" method="get" class="form-horizontal">
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="m" value="<?php echo $m?>">
		<input type="hidden" name="module" value="<?php echo $module?>">
		<input type="hidden" name="front" value="<?php echo $front?>">

		<div class="bg-light border rounded p-3 mb-4">

			<div class="form-group row">
				<label class="col-md-1 col-form-label text-md-right">필터</label>
				<div class="col-md-11 col-lg-10">
					<div class="form-row">
						<div class="col-sm-4">
							<select name="siteuid" class="form-control custom-select" onchange="this.form.submit();">
								<option value="">사이트(전체)</option>
								<?php $SITES = getDbArray($table['s_site'],'','*','gid','asc',0,$p)?>
								<?php while($S = db_fetch_array($SITES)):?>
								<option value="<?php echo $S['uid']?>"<?php if($S['uid']==$siteuid):?> selected<?php endif?>><?php echo $S['name']?> (<?php echo $S['id']?>)</option>
								<?php endwhile?>
							</select>
						</div>
						<div class="col-sm-4">
							<select name="moduleid" class="form-control custom-select" onchange="this.form.submit();">
								<option value="">모듈(전체)</option>
								<?php $MODULES = getDbArray($table['s_module'],'','*','gid','asc',0,$p)?>
								<?php while($MD = db_fetch_array($MODULES)):?>
								<option value="<?php echo $MD['id']?>"<?php if($MD['id']==$moduleid):?> selected<?php endif?>><?php echo $MD['name']?> (<?php echo $MD['id']?>)</option>
								<?php endwhile?>
							</select>
						</div>
						<div class="col-sm-4">
							<select name="isread" class="form-control custom-select" onchange="this.form.submit();">
								<option value="">상태(전체)</option>
								<option value="1"<?php if($isread==1):?> selected<?php endif?>>확인</option>
								<option value="2"<?php if($isread==2):?> selected<?php endif?>>미확인</option>
							</select>
						</div>
					</div>
				</div>
			</div>

			<div id="search-more" class="collapse<?php if($_SESSION['sh_noti']):?> show<?php endif?>">
				<div class="form-group row">
					<label class="col-md-1 col-form-label text-md-right">정렬</label>
					<div class="col-md-11 col-lg-10">

						<div class="btn-toolbar">
							<div class="btn-group" data-toggle="buttons">
								<label class="btn btn-light<?php if($sort=='uid'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
									<input type="radio" value="uid" name="sort"<?php if($sort=='uid'):?> checked<?php endif?>> 알림일
								</label>
								<label class="btn btn-light<?php if($sort=='d_read'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
									<input type="radio" value="d_read" name="sort"<?php if($sort=='d_read'):?> checked<?php endif?>> 확인일
								</label>
							</div>

							<div class="btn-group ml-2" data-toggle="buttons">
								<label class="btn btn-light<?php if($orderby=='desc'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
									<input type="radio" value="desc" name="orderby"<?php if($orderby=='desc'):?> checked<?php endif?>> <i class="fa fa-sort-amount-desc"></i> 역순
								</label>
								<label class="btn btn-light<?php if($orderby=='asc'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
									<input type="radio" value="asc" name="orderby"<?php if($orderby=='asc'):?> checked<?php endif?>> <i class="fa fa-sort-amount-asc"></i> 정순
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-md-1 col-form-label text-md-right">검색</label>
					<div class="col-md-11 col-lg-10">
						<div class="input-group">
							<span class="input-group-btn" style="width: 120px">
								<select name="where" class="form-control custom-select">
									<option value="message"<?php if($where=='message'):?> selected="selected"<?php endif?>>메시지</option>
									<option value="referer"<?php if($where=='referer'):?> selected="selected"<?php endif?>>URL</option>
								</select>
							</span>
							<input type="text" name="keyw" value="<?php echo stripslashes($keyw)?>" class="form-control">
							<span class="input-group-btn">
								<button class="btn btn-light" type="submit">검색</button>
							</span>
						</div>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-md-1 col-form-label text-md-right">출력수</label>
					<div class="col-md-11 col-lg-10">
						<select name="recnum" onchange="this.form.submit();" class="form-control custom-select">
							<?php for($i=30;$i<=300;$i=$i+30):?>
							<option value="<?php echo $i?>"<?php if($i==$recnum):?> selected="selected"<?php endif?>><?php echo sprintf('%d 개',$i)?></option>
							<?php endfor?>
						</select>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-11 col-lg-10 offset-md-1">
					<button type="button" class="btn btn-light rb-advance<?php if(!$_SESSION['sh_noti']):?> collapsed<?php endif?>" data-toggle="collapse" data-target="#search-more" onclick="sessionSetting('sh_noti','1','','1');">고급검색 <small></small></button>
					<a href="<?php echo $g['adm_href']?>" class="btn btn-light">초기화</a>
					<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=notice_testonly" onclick="return hrefCheck(this,true,'정말로 테스트 알림을 보내시겠습니까?     ');" class="btn btn-light">테스트 알림</a>
					<a href="#." class="btn btn-light rb-notifications-modal" role="button" data-toggle="modal" data-target="#modal_window">내알림 보기</a>
				</div>
			</div>

		</div>
	</form>

	<form name="listForm" action="<?php echo $g['s']?>/" method="post">
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="m" value="<?php echo $module?>">
		<input type="hidden" name="a" value="">

		<div class="table-responsive">
			<table class="table table-striped">
				<tr>
					<th>
						<label class="custom-control custom-checkbox">
						  <input type="checkbox" class="custom-control-input checkAll-noti-user">
						  <span class="custom-control-indicator"></span>
						</label>
					</th>
					<th>번호</th>
					<th>보낸사람</th>
					<th>받는사람</th>
					<th class="rb-message">내용</th>
					<th>연결 URL</th>
					<th>알림일시</th>
					<th>확인일시</th>
				</tr>
				<?php $_i=0;while($R=db_fetch_array($RCD)):?>
				<?php $SM1=$R['mbruid']?getDbData($table['s_mbrdata'],'memberuid='.$R['mbruid'],'name,nic'):array()?>
				<?php $SM2=$R['frommbr']?getDbData($table['s_mbrdata'],'memberuid='.$R['frommbr'],'name,nic'):array()?>
				<tr>
					<td>
						<label class="custom-control custom-checkbox">
						  <input type="checkbox" class="custom-control-input rb-noti-user" name="noti_members[]" value="<?php echo $R['uid']?>" onclick="checkboxCheck();">
						  <span class="custom-control-indicator"></span>
						</label>
					</td>
					<td><?php echo $NUM-((($p-1)*$recnum)+$_rec++)?></td>
					<td>
						<?php if($SM2['name']):?>
						<a href="#." id='_rb-popover-from-<?php echo $_i?>' data-placement="auto" data-popover="popover" data-content="<div id='rb-popover-from-<?php echo $_i?>'><script>getPopover('member','<?php echo $R['frommbr']?>','rb-popover-from-<?php echo $_i?>')</script></div>"><?php echo $SM2['name']?></a>
						<?php else:?>
						시스템
						<?php endif?>
					</td>
					<td>
						<a href="#." id='_rb-popover-to-<?php echo $_i?>' data-placement="auto" data-popover="popover" data-content="<div id='rb-popover-to-<?php echo $_i?>'><script>getPopover('member','<?php echo $R['mbruid']?>','rb-popover-to-<?php echo $_i?>')</script></div>"><?php echo $SM1['name']?></a>
					</td>
					<td class="rb-message">
						<?php echo $R['message']?>
					</td>
					<td>
						<?php if($R['referer']):?>
						<a href="<?php echo $R['referer']?>" target="<?php echo $R['target']?>">보기</a>
						<?php else:?>
						<span class="rb-none">없음</span>
						<?php endif?>
					</td>
					<td class="rb-update">
						<time class="timeago" data-toggle="tooltip" datetime="<?php echo getDateFormat($R['d_regis'],'c')?>" data-tooltip="tooltip" title="<?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?>"></time>
					</td>
					<td class="rb-update">
						<?php if($R['d_read']):?>
						<time class="timeago" data-toggle="tooltip" datetime="<?php echo getDateFormat($R['d_read'],'c')?>" data-tooltip="tooltip" title="<?php echo getDateFormat($R['d_read'],'Y.m.d H:i')?>"></time>
						<?php else:?>
						<span class="label label-primary">미확인</span>
						<?php endif?>
					</td>
				</tr>
				<?php $_i++;endwhile?>
			</table>
		</div>

		<?php if(!$NUM):?>
		<div class="rb-none">알림이 없습니다.</div>
		<?php endif?>

		<div class="rb-footer clearfix">
			<div class="pull-right">
				<ul class="pagination">
				<script>getPageLink(5,<?php echo $p?>,<?php echo $TPG?>,'');</script>
				<?php //echo getPageLink(5,$p,$TPG,'')?>
				</ul>
			</div>
			<div>
				<button type="button" onclick="chkFlag('noti_members[]');checkboxCheck();" class="btn btn-light">선택/해제</button>
				<button type="button" onclick="actCheck('multi_delete');" class="btn btn-light" id="rb-action-btn" disabled>삭제</button>
			</div>
		</div>
	</form>

</div>

<!-- timeago -->
<?php getImport('jquery-timeago','jquery.timeago',false,'js')?>
<?php getImport('jquery-timeago','locales/jquery.timeago.'.$lang['notification']['a2039'],false,'js')?>
<script>
jQuery(document).ready(function() {
	$(".rb-update time").timeago();
});
</script>

<!-- basic -->
<script>
$(".checkAll-noti-user").click(function(){
	$(".rb-noti-user").prop("checked",$(".checkAll-noti-user").prop("checked"));
	checkboxCheck();
});
function checkboxCheck()
{
	var f = document.listForm;
    var l = document.getElementsByName('noti_members[]');
    var n = l.length;
    var i;
	var j=0;

	for	(i = 0; i < n; i++)
	{
		if (l[i].checked == true) j++;
	}
	if (j) getId('rb-action-btn').disabled = false;
	else getId('rb-action-btn').disabled = true;
}
function actCheck(act)
{
	var f = document.listForm;
    var l = document.getElementsByName('noti_members[]');
    var n = l.length;
	var j = 0;
    var i;
	var s = '';

    for (i = 0; i < n; i++)
	{
		if(l[i].checked == true)
		{
			j++;
			s += '['+l[i].value+']';
		}
	}
	if (!j)
	{
		alert('선택된 알림이 없습니다.      ');
		return false;
	}

	if (act == 'multi_delete')
	{
		if(confirm('정말로 삭제하시겠습니까?    '))
		{
			getIframeForAction(f);
			f.a.value = act;
			f.submit();
		}
	}
	return false;
}
</script>
