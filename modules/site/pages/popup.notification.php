<?php
include $g['path_module'].'notification/var/var.php';
if($callMod == 'config')
{
	$NT_DATA = explode('|',$my['noticeconf']);
	$nt_rcv = $NT_DATA[0];
	$nt_rcvtype = $NT_DATA[1];
	$nt_rcvdel = $NT_DATA[2];
	$nt_modules = getArrayString($NT_DATA[3]);
	$nt_members = getArrayString($NT_DATA[4]);
	$nt_email = $NT_DATA[5];
	$_SESSION['sh_notify_auto_del'] = '';
	$_SESSION['sh_notify_popup'] = '';
}
else if ($callMod == 'view')
{
	$recnum = 1000;
	$NUM = getDbRows($table['s_notice'],'mbruid='.$my['uid']);
	$TPG = getTotalPage($NUM,$recnum);
}
?>

<div id="rb-modal-body">
	<?php if($callMod == 'config'):?>
	<div class="callMod-config">
		<form name="procForm" class="form-horizontal" action="<?php echo $g['s']?>/" method="post">
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="m" value="notification">
		<input type="hidden" name="a" value="notice_config_user">

		<div class="well">
			<i class="glyphicon glyphicon-info-sign fa-2x pull-left"></i>
			<small>
				알림을 수신하면 웹 사이트내의 정보는 물론 회원님이 언급되거나 관련된 정보들을 실시간으로 받아보실 수 있습니다.<br>
			</small>
		</div>

		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">알림 수신설정</label>
			<div class="col-sm-10">
				<div class="btn-toolbar">
					<div class="btn-group btn-group-justified" data-toggle="buttons">
						<label class="btn <?php if($nt_rcv==''):?>btn-primary active<?php else:?>btn-default<?php endif?>" onclick="btnCheck(this);">
							<input type="radio" value="" name="nt_rcv"<?php if($nt_rcv==''):?> checked<?php endif?>> 받음
						</label>
						<label class="btn <?php if($nt_rcv=='1'):?>btn-primary active<?php else:?>btn-default<?php endif?>" onclick="btnCheck(this);">
							<input type="radio" value="1" name="nt_rcv"<?php if($nt_rcv=='1'):?> checked<?php endif?>> 받지않음
						</label>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">알림 수신방법</label>
			<div class="col-sm-10">
				<div class="btn-toolbar">
					<div class="btn-group btn-group-justified" data-toggle="buttons">
						<label class="btn <?php if($nt_rcvtype==''):?>btn-primary active<?php else:?>btn-default<?php endif?>" onclick="btnCheck(this);">
							<input type="radio" value="" name="nt_rcvtype"<?php if($nt_rcvtype==''):?> checked<?php endif?>> 갯수변동
						</label>
						<label class="btn <?php if($nt_rcvtype=='1'):?>btn-primary active<?php else:?>btn-default<?php endif?>" onclick="btnCheck(this);">
							<input type="radio" value="1" name="nt_rcvtype"<?php if($nt_rcvtype=='1'):?> checked<?php endif?>> 갯수변동+팝업
						</label>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">이메일 연동</label>
			<div class="col-sm-10">
				<div class="btn-toolbar">
					<div class="btn-group btn-group-justified" data-toggle="buttons">
						<label class="btn <?php if($nt_email=='1'):?>btn-primary active<?php else:?>btn-default<?php endif?>" onclick="btnCheck(this);">
							<input type="radio" value="1" name="nt_email"<?php if($nt_email=='1'):?> checked<?php endif?>> 이메일도 받음
						</label>
						<label class="btn <?php if($nt_email==''):?>btn-primary active<?php else:?>btn-default<?php endif?>" onclick="btnCheck(this);">
							<input type="radio" value="" name="nt_email"<?php if($nt_email==''):?> checked<?php endif?>> 연동안함
						</label>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">수신후 삭제처리</label>
			<div class="col-sm-10">
				<div class="btn-toolbar">
					<div class="btn-group btn-group-justified" data-toggle="buttons">
						<label class="btn <?php if($nt_rcvdel=='1'):?>btn-primary active<?php else:?>btn-default<?php endif?>" onclick="btnCheck(this);">
							<input type="radio" value="1" name="nt_rcvdel"<?php if($nt_rcvdel=='1'):?> checked<?php endif?>> 자동삭제
						</label>
						<label class="btn <?php if($nt_rcvdel==''):?>btn-primary active<?php else:?>btn-default<?php endif?>" onclick="btnCheck(this);">
							<input type="radio" value="" name="nt_rcvdel"<?php if($nt_rcvdel==''):?> checked<?php endif?>> 수동삭제
						</label>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="form-group">
			<label class="col-sm-2 control-label">알림보내기 차단중인 곳</label>
			<div class="col-sm-10">
				<div class="rb-tbl-box">
					<table class="table table-hover">
						<thead>
							<tr>
								<th class="rb-tbl-left"><span>모듈명 (보낸 곳)</span></th>
								<th class="rb-tbl-right">차단해제</th>
							</tr>
						</thead>
					</table>
					<div class="rb-tbl-box1">
						<table class="table">
							<tbody>

								<?php foreach($nt_modules['data'] as $_md):?>
								<?php $_R=getDbData($table['s_module'],"id='".$_md."'",'*')?>
								<tr>
									<td class="rb-tbl-left">
										<span>
											<i class="<?php echo $_R['icon']?>"></i>
											<?php echo $_R['name']?>
											<small> <?php echo ucfirst($_R['id'])?></small>
										</span>
									</td>
									<td class="rb-tbl-right">
										<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=notification&amp;a=notice_config_user&amp;module_id=<?php echo $_R['id']?>" onclick="return hrefCheck(this,true,'정말로 해제하시겠습니까?');">해제</a>
									</td>
								<tr>
								<?php endforeach?>
							</tbody>
						</table>
					</div>
					<?php if(!$nt_modules['count']):?>
					<div class="rb-none">
						<i class="glyphicon glyphicon-ok-sign"></i> 차단된 곳이 없습니다.
					</div>
					<?php endif?>
				</div>
			</div>
		</div>
		<hr>
		<div class="form-group">
			<label class="col-sm-2 control-label">알림보내기 차단중인 회원</label>
			<div class="col-sm-10">
				<div class="rb-tbl-box">
					<table class="table table-hover">
						<thead>
							<tr>
								<th class="rb-tbl-left"><span>회원명</span></th>
								<th class="rb-tbl-right">차단해제</th>
							</tr>
						</thead>
					</table>
					<div class="rb-tbl-box1">
						<table class="table">
							<tbody>

								<?php $_i=0;foreach($nt_members['data'] as $_md):?>
								<?php $_R=getDbData($table['s_mbrdata'],'memberuid='.$_md,'*')?>
								<tr>
									<td class="rb-tbl-left">
										<span>
											<a href="#." id='_rb-popover-from-<?php echo $_i?>' data-placement="right" data-popover="popover" data-content="<div id='rb-popover-from-<?php echo $_i?>'><script>getPopover('member','<?php echo $_R['memberuid']?>','rb-popover-from-<?php echo $_i?>')</script></div>">
												<i class="glyphicon glyphicon-user"></i>
												<?php echo $_R['nic']?> (<?php echo $_R['name']?>)
											</a>
										</span>
									</td>
									<td class="rb-tbl-right">
										<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=notification&amp;a=notice_config_user&amp;member_uid=<?php echo $_R['memberuid']?>" onclick="return hrefCheck(this,true,'정말로 해제하시겠습니까?');">해제</a>
									</td>
								<tr>
								<?php $_i++;endforeach?>
							</tbody>
						</table>
					</div>
					<?php if(!$nt_members['count']):?>
					<div class="rb-none">
						<i class="glyphicon glyphicon-ok-sign"></i> 차단된 회원이 없습니다.
					</div>
					<?php endif?>
				</div>
			</div>
		</div>
		</form>
	</div>
	<?php else:?>
	<form name="listForm" action="<?php echo $g['s']?>/" method="post">
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="m" value="notification">
		<input type="hidden" name="a" value="">
		<input type="hidden" name="deltype" value="">
		<div id="rb-notifications-layer" class="list-group callMod-<?php echo $callMod?>">
		<!-- 여기에 알림정보를 실시간으로 받아옴 -->
		</div>
	</form>
	<?php if($callMod=='view'):?>
	<div class="rb-page-block">
		<fieldset<?php if(!$NUM):?> disabled<?php endif?>>
			<div class="btn-group">
				<div class="btn-group dropup">
					<a class="btn btn-default" href="#." onclick="actCheck('multi_delete_user','cut_member');"><i class="glyphicon glyphicon-ban-circle"></i> 차단</a>
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li role="presentation" class="dropdown-header">알림 차단 처리</li>
						<li class="divider"></li>
						<li><a href="#." onclick="actCheck('multi_delete_user','cut_member');"><i class="glyphicon glyphicon-lock"></i> 보낸회원 차단하기</a></li>
						<li><a href="#." onclick="actCheck('multi_delete_user','cut_module');"><i class="glyphicon glyphicon-lock"></i> 보낸곳 차단하기</a></li>
					</ul>
				</div>
			</div>
			<div class="btn-group pull-right">
				<button type="button" onclick="chkFlag('noti_members[]');noti_check_all();" class="btn btn-default checkAll-noti-user"><i class="glyphicon glyphicon-ok"></i></button>
				<div class="btn-group dropup">
					<a class="btn btn-default" href="#." onclick="actCheck('multi_delete_user','delete_select');"><i class="glyphicon glyphicon-trash"></i> 삭제</a>
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li role="presentation" class="dropdown-header">일괄 삭제 처리</li>
						<li class="divider"></li>
						<li><a href="#." onclick="actCheck('multi_delete_user','delete_read');"><i class="glyphicon glyphicon-remove"></i> 읽은알림 삭제</a></li>
						<li><a href="#." onclick="actCheck('multi_delete_user','delete_all');"><i class="glyphicon glyphicon-remove"></i> 전체알림 삭제</a></li>
					</ul>
				</div>
			</div>
		</fieldset>
	</div>
	<?php endif?>
	<?php endif?>
</div>



<!----------------------------------------------------------------------------
@부모레이어를 제어할 수 있도록 모달의 헤더와 풋터를 부모레이어에 출력시킴
----------------------------------------------------------------------------->

<div id="_modal_header" class="hidden">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title" id="myModalLabel"><i class="fa fa-bell-o fa-lg"></i> 알림 <?php if($callMod=='config'):?>설정<?php elseif($callMod=='view'):?>(전체) <span id="rb-notification-modal-num" class="badge" style="position:relative;top:-3px;"><?php echo $NUM?></span><?php else:?><span id="rb-notification-modal-num" class="badge" style="position:relative;top:-3px;">x</span><?php endif?></h4>
</div>

<div id="_modal_footer" class="hidden">
	<div class="btn-group btn-group-justified">
		<a href="#." class="btn btn-default" onclick="frames._modal_iframe_modal_window.getViewNotification('view');">전체보기</a>
		<a href="#." class="btn btn-default" onclick="frames._modal_iframe_modal_window.getViewNotification('config');">설정</a>
		<a href="#." class="btn btn-default" data-dismiss="modal" aria-hidden="true" id="_close_btn_">닫기</a>
	</div>
</div>




<script>
function actCheck(act,type)
{
	var f = document.listForm;
	var l = document.getElementsByName('noti_members[]');
	var n = l.length;
	var j = 0;
	var i;

	if (type == 'delete_all' || type == 'delete_read')
	{
		if (confirm('정말로 일괄 삭제하시겠습니까?'))
		{
			getIframeForAction(f);
			f.a.value = act;
			f.deltype.value = type;
			f.submit();
		}
		return false;
	}

	for (i = 0; i < n; i++)
	{
		if(l[i].checked == true)
		{
			j++;
		}
	}
	if (!j)
	{
		alert('선택된 알림이 없습니다. ');
		return false;
	}

	var xtypestr = type == 'delete_select' ? '정말로 삭제 하시겠습니까?' : '정말로 차단 하시겠습니까?';

	if(confirm(xtypestr))
	{
		getIframeForAction(f);
		f.a.value = act;
		f.deltype.value = type;
		f.submit();
	}
	return false;
}
function noti_check_child(obj)
{
	noti_check_all();
}
function noti_check_all()
{
	var l = document.getElementsByName('noti_members[]');
	var n = l.length;
	var i;
	var val;

	for	(i = 0; i < n; i++)
	{
		val = l[i].value.split('|');
		if (l[i].checked == true) getId('noti-'+val[0]).className = 'btn btn-primary ';
		else getId('noti-'+val[0]).className = 'btn btn-default';
	}
}
function btnCheckSubmit()
{
	var f = document.procForm;
	getIframeForAction(f);
	f.submit();
}
function btnCheck(obj)
{
	obj.parentNode.children[0].className = 'btn btn-default';
	obj.parentNode.children[1].className = 'btn btn-default';
	obj.className = 'btn btn-primary';
	setTimeout("btnCheckSubmit();",100);
}
function getViewNotification(type)
{
	location.href = rooturl + '/?r=' + raccount + '&iframe=Y&system=<?php echo $system?>&callMod='+type;
}
function getNotificationNum(num)
{
	<?php if(!$callMod):?>
	var badge = parent.getId('rb-notification-modal-num');
	var _num = (num >= <?php echo $d['ntfc']['num']?> ? '+<?php echo $d['ntfc']['num']?>' : num);
	badge.innerHTML = _num;
	if(_num > 0) badge.style.background = '#ff0000';
	<?php endif?>
}
function modalSetting()
{
	<?php if($callMod != 'config'):?>
	getId('rb-notifications-layer').innerHTML = getAjaxData('<?php echo $g['s']?>/?r=<?php echo $r?>&m=notification&a=notice_check&noticedata=Y&isModal=Y&callMod=<?php echo $callMod?>&p=<?php echo $p?>&recnum=<?php echo $recnum?$recnum:10?>');
	<?php endif?>

	var ht = 400;

	parent.getId('modal_window_dialog_modal_window').style.width = '100%';
	parent.getId('modal_window_dialog_modal_window').style.paddingRight = '20px';
	parent.getId('modal_window_dialog_modal_window').style.maxWidth = '550px';
	parent.getId('_modal_iframe_modal_window').style.height = <?php echo $g['device']?"'400px'":"ht + 'px'"?>;
	parent.getId('_modal_body_modal_window').style.height = <?php echo $g['device']?"'400px'":"ht + 'px'"?>;

	parent.getId('_modal_header_modal_window').innerHTML = getId('_modal_header').innerHTML;
	parent.getId('_modal_header_modal_window').className = 'modal-header';
	parent.getId('_modal_body_modal_window').style.padding = '0';
	parent.getId('_modal_body_modal_window').style.margin = '0';

	parent.getId('_modal_footer_modal_window').innerHTML = getId('_modal_footer').innerHTML;
	parent.getId('_modal_footer_modal_window').className = 'modal-footer';
}
modalSetting();
</script>
