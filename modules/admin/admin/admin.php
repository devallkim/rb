<?php
$R=array();
$mtype = $mtype  ? $mtype  : 'admin';
$recnum= $recnum ? $recnum : 10;
$sendsql= 'admin='.($mtype=='admin'?1:0);
$RCD = getDbArray($table['s_mbrdata'],$sendsql,'*','memberuid','asc',$recnum,$p);
$NUM = getDbRows($table['s_mbrdata'],$sendsql);
$TPG = getTotalPage($NUM,$recnum);
$_authset = array('','승인','보류','대기','탈퇴');
?>


<div id="admin-users">
	<div class="page-header">
		<h4>사용자 정보관리</h4>
	</div>
	<form name="listForm" action="<?php echo $g['s']?>/" method="post" onsubmit="return false;">
	<input type="hidden" name="r" value="<?php echo $r?>">
	<input type="hidden" name="m" value="<?php echo $module?>">
	<input type="hidden" name="a" value="">
	<input type="hidden" name="auth" value="">

	<div class="panel panel-default">
		<div class="panel-heading clearfix">
			<label class="pull-left">
				<span class="dropdown">
					<a href="#" class="btn btn-default rb-username" data-toggle="dropdown">
						<span><?php echo $mtype=='admin'?'관리자':'일반회원'?> <?php echo sprintf('%d명',$NUM)?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
						<li><a href="<?php echo $g['adm_href']?>&amp;mtype=admin"><i class="fa fa-user"></i> 관리자</a></li>
						<li><a href="<?php echo $g['adm_href']?>&amp;mtype=member"><i class="fa fa-user"></i> 일반회원</a></li>
					</ul>
				</span>
			</label>

			<div class="btn-group pull-right">
				<button type="button" class="btn btn-default"<?php if($p-1<1):?> disabled<?php endif?> data-toggle="tooltip" data-placement="bottom" title="" data-original-title="이전" onclick="location.href=getPageGo(<?php echo $p-1?>,0);"><i class="fa fa-chevron-left fa-lg"></i></button>
				<button type="button" class="btn btn-default"<?php if($p+1>$TPG):?> disabled<?php endif?> data-toggle="tooltip" data-placement="bottom" title="" data-original-title="다음" onclick="location.href=getPageGo(<?php echo $p+1?>,0);"><i class="fa fa-chevron-right fa-lg"></i></button>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th><label><input type="checkbox" id="checkAll-admin-user"></label></th>
						<th>상태</th>
						<th>구분</th>
						<th>이름</th>
						<th>닉네임</th>
						<th>아이디</th>
						<th>연락처</th>
						<th>최근접속</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php $_P=array()?>
					<?php while($R=db_fetch_array($RCD)):?>
					<?php $_R=getUidData($table['s_mbrid'],$R['memberuid'])?>
					<?php if($R['memberuid']==$uid)$_P=$R?>
					<tr>
						<?php if($R['memberuid']==1):?>
						<td><input type="checkbox" disabled="disabled"></td>
						<?php else:?>
						<td class="side1"><input type="checkbox" name="mbrmembers[]" value="<?php echo $R['memberuid']?>" class="rb-admin-user" onclick="checkboxCheck();"></td>
						<?php endif?>
						<td><?php echo $_authset[$R['auth']]?></td>
						<?php if($R['now_log']):?>
						<td><small class="label label-primary" data-tooltip="tooltip" title="온라인"><?php echo $R['admin']?($R['adm_view']?'부관리자':'최고관리자'):'일반회원'?></small></td>
						<?php else:?>
						<td><small class="label label-default" data-tooltip="tooltip" title="오프라인"><?php echo $R['admin']?($R['adm_view']?'부관리자':'최고관리자'):'일반회원'?></small></td>
						<?php endif?>

						<td><a href="#." data-toggle="modal" data-target="#modal_window" class="rb-modal-admininfo" onmousedown="admIdDrop('<?php echo $R['memberuid']?>','');"><?php echo $R['name']?></a></td>
						<td><?php echo $R['nic']?></td>
						<td><?php echo $_R['id']?></td>
						<td><?php echo $R['tel2']?$R['tel2']:$R['tel1']?></td>
						<td data-tooltip="tooltip" title="<?php echo getDateFormat($R['last_log'],'Y.m.d H:i')?>"><?php echo sprintf('%d일전',-getRemainDate($R['last_log']))?></td>
						<td>
						<?php if($my['uid']==1 && $R['admin']):?>
						<a href="#." data-toggle="modal" data-target="#modal_window" class="btn btn-default btn-xs rb-modal-admininfo" onmousedown="admIdDrop('<?php echo $R['memberuid']?>','perm');"<?php if($R['memberuid']==1):?> disabled<?php endif?>>관리제한</a>
						<?php endif?>
						<a href="#." data-toggle="modal" data-target="#modal_window" class="btn btn-default btn-xs rb-modal-admininfo" onmousedown="admIdDrop('<?php echo $R['memberuid']?>','info');">정보변경</a>
						</td>
					</tr>
					<?php endwhile?>
				</tbody>
			</table>
		</div>

		<div class="panel-footer clearfix">
			<div class="row">
				<div class="col-sm-3">
					<div class="btn-group">
						<fieldset id="rb-action-btn" disabled>
							<div class="btn-group">
								<div class="btn-group dropup">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
										<i class="fa fa-wrench"></i> 관리 <span class="caret"></span>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li role="presentation" class="dropdown-header">회원승인 상태변경</li>
										<li><a href="#" onclick="actQue('admin_delete','4');">탈퇴</a></li>
										<li><a href="#" onclick="actQue('admin_delete','1');">승인</a></li>
										<li><a href="#" onclick="actQue('admin_delete','3');">대기</a></li>
										<li><a href="#" onclick="actQue('admin_delete','2');">보류</a></li>
										<li class="divider"></li>
										<?php if($mtype=='admin'):?>
										<li><a href="#" onclick="actQue('admin_delete','');">관리자에서 제외</a></li>
										<?php else:?>
										<li><a href="#" onclick="actQue('admin_delete','A');">관리자로 추가</a></li>
										<?php endif?>
										<li><a href="#" onclick="actQue('admin_delete','D');"><span class="text-danger">데이터 삭제</span></a></li>
									</ul>
								</div>
							</div>
						</fieldset>
					</div>
					<div class="btn-group">
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-admin-add"><i class="fa fa-plus-circle"></i> <?php echo $mtype=='admin'?'관리자 추가':'회원 추가'?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>
</div>








<!-- 회원추가 모달 -->
<div class="modal fade" id="modal-admin-add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="procForm" class="form-horizontal" action="<?php echo $g['s']?>/" method="post" enctype="multipart/form-data" onsubmit="return saveCheck(this);">
			<input type="hidden" name="r" value="<?php echo $r?>">
			<input type="hidden" name="m" value="<?php echo $module?>">
			<input type="hidden" name="a" value="admin_member_add">
			<input type="hidden" name="check_id" value="0">
			<input type="hidden" name="check_nic" value="0">
			<input type="hidden" name="check_email" value="0">
			<?php if($mtype=='admin'):?>
			<input type="hidden" name="admin" value="1">
			<?php endif?>

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title"><?php echo $mtype=='admin'?'관리자 추가':'회원 추가'?></h4>
			</div>
			<div class="modal-body">

				<div class="form-group rb-outside">
					<label for="inputEmail3" class="col-sm-2 control-label">아이디</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" class="form-control" name="id" placeholder="4~12자의 영문(소문자)과 숫자만 사용" value="" maxlength="12" autofocus onchange="sendCheck('rb-idcheck','id');">
							<span class="input-group-btn">
								<button type="button" class="btn btn-default" id="rb-idcheck" onclick="sendCheck('rb-idcheck','id');">중복확인</button>
							</span>
						</div>
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
								<img class="media-object img-circle" src="<?php echo $g['s']?>/_var/avatar/0.gif" alt="" style="width:45px">
							</span>
							<div class="media-body">
								<input type="file" name="upfile" class="hidden" id="rb-upfile-avatar" accept="image/jpg" onchange="getId('rb-photo-btn').innerHTML='이미지 파일 선택됨';">
								<button type="button" class="btn btn-default" onclick="$('#rb-upfile-avatar').click();" id="rb-photo-btn">찾아보기</button>
								<small class="help-block"><code>jpg</code> 파일을 등록해주세요.</small>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">이름</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="name" placeholder="이름을 입력해주세요" value="<?php echo $regis_name?>" maxlength="10">
					</div>
				</div>
				<div class="form-group rb-outside">
					<label class="col-sm-2 control-label">닉네임</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" class="form-control" name="nic" placeholder="닉네임을 입력해주세요" value="" maxlength="20" onchange="sendCheck('rb-nickcheck','nic');">
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
							<input type="email" class="form-control" name="email" placeholder="이메일을 입력해주세요" value="" onchange="sendCheck('rb-emailcheck','email');">
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
						<input type="tel" class="form-control" name="tel2" placeholder="예) 010-000-0000" value="">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">취소</button>
				<button type="submit" class="btn btn-primary">등록하기</button>
			</div>
		</form>
		<form name="actionform" action="<?php echo $g['s']?>/" method="post">
			<input type="hidden" name="r" value="<?php echo $r?>">
			<input type="hidden" name="m" value="<?php echo $module?>">
			<input type="hidden" name="a" value="admin_member_add_check">
			<input type="hidden" name="type" value="">
			<input type="hidden" name="fvalue" value="">
		</form>
		</div>
	</div>
</div>

<!-- bootstrap Validator -->
<?php getImport('bootstrap-validator','dist/css/bootstrapValidator.min',false,'css')?>
<?php getImport('bootstrap-validator','dist/js/bootstrapValidator.min',false,'js')?>
<script>
$(document).ready(function() {
    $('.form-horizontal').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },

        fields: {
            id: {
                validators: {
                    notEmpty: {
                        message: '아이디를 입력해주세요.'
                    },
                    regexp: {
                        regexp: /^[a-z0-9]+$/,
                        message: '4~12자의 영문(소문자)과 숫자만 사용할 수 있습니다.'
                    }
                }
            },
            pw1: {
                message: 'The password is not valid',
                validators: {
                    notEmpty: {
                        message: '비밀번호를 입력해주세요'
                    }
                }
            },

            pw2: {
                message: 'The password is not valid',
                validators: {
                    notEmpty: {
                        message: '비밀번호를 다시 입력해주세요'
                    }
                }
            },
            name: {
                message: 'The name is not valid',
                validators: {
                    notEmpty: {
                        message: '이름(실명)을 입력해주세요'
                    }
                }
            },
            nic: {
                message: 'The name is not valid',
                validators: {
                    notEmpty: {
                        message: '닉네임을 입력해주세요'
                    }
                }
            },
            email: {
                message: '',
                validators: {
                    notEmpty: {
                        message: '이메일을 입력해주세요'
                    }
                }
            },
        }
    });
});
</script>

<!-- basic -->
<script>
var _admModalUid;
var _admModalMod;
function admIdDrop(uid,mod)
{
	_admModalUid = uid;
	_admModalMod = mod;
}
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
function saveCheck(f)
{
	if (f.pw1.value != f.pw2.value)
	{
		alert('비밀번호가 서로 일치하지 않습니다.');
		return false;
	}
	getIframeForAction(f);
	return true;
}
function actQue(flag,ah)
{
	var f = document.listForm;
    var l = document.getElementsByName('mbrmembers[]');
    var n = l.length;
    var i;
	var j=0;

	if (flag == 'admin_delete')
	{
		for	(i = 0; i < n; i++)
		{
			if (l[i].checked == true)
			{
				j++;
			}
		}
		if (!j)
		{
			alert('회원(관리자)을 선택해 주세요.     ');
			return false;
		}

		if (confirm('정말로 실행하시겠습니까?      '))
		{
			getIframeForAction(f);
			f.a.value = flag;
			f.auth.value = ah;
			f.submit();
		}
	}
	return false;
}
function checkboxCheck()
{
	var f = document.listForm;
    var l = document.getElementsByName('mbrmembers[]');
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
$("#checkAll-admin-user").click(function(){
	$(".rb-admin-user").prop("checked",$("#checkAll-admin-user").prop("checked"));
	checkboxCheck();
});
$('.rb-modal-admininfo').on('click',function() {
	modalSetting('modal_window','<?php echo getModalLink('&amp;m=admin&amp;module=admin&amp;front=modal.admininfo&amp;uid=')?>'+_admModalUid+'&amp;tab='+_admModalMod);
});
</script>
