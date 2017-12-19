<?php include $g['path_module'].$module.'/var/var.php' ?>

<div id="configbox">

	<form name="procForm" action="<?php echo $g['s']?>/" method="post" onsubmit="return saveCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="m" value="<?php echo $module?>">
		<input type="hidden" name="a" value="config">
		<input type="hidden" name="ftp_connect" value="<?php echo $d['mediaset']['use_fileserver']?>">

		<div class="page-header">
			<h4>파일첨부 설정</h4>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">일반파일 첨부</label>
			<div class="col-sm-10">
				<div class="row">
					<div class="col-sm-3">
						<div class="input-group">
							<input type="text" name="maxnum_file" value="<?php echo $d['mediaset']['maxnum_file']?>" class="form-control">
							<span class="input-group-addon">개</span>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="input-group">
							<input type="text" name="maxsize_file" value="<?php echo $d['mediaset']['maxsize_file']?>" class="form-control">
							<span class="input-group-addon">MB이내</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">사진파일 첨부</label>
			<div class="col-sm-10">
				<div class="row">
					<div class="col-sm-3">
						<div class="input-group">
							<input type="text" name="maxnum_img" value="<?php echo $d['mediaset']['maxnum_img']?>" class="form-control">
							<span class="input-group-addon">개</span>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="input-group">
							<input type="text" name="maxsize_img" value="<?php echo $d['mediaset']['maxsize_img']?>" class="form-control">
							<span class="input-group-addon">MB이내</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">동영상파일 첨부</label>
			<div class="col-sm-10">
				<div class="row">
					<div class="col-sm-3">
						<div class="input-group">
							<input type="text" name="maxnum_vod" value="<?php echo $d['mediaset']['maxnum_vod']?>" class="form-control">
							<span class="input-group-addon">개</span>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="input-group">
							<input type="text" name="maxsize_vod" value="<?php echo $d['mediaset']['maxsize_vod']?>" class="form-control">
							<span class="input-group-addon">MB이내</span>
						</div>
					</div>
				</div>
				<p class="form-control-static text-muted"><?php echo sprintf('현재 서버에서 허용하고 있는 1회 최대 첨부용량은 <code>%sMB</code>입니다.',str_replace('M','',ini_get('upload_max_filesize')))?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">썸네일 사이즈</label>
			<div class="col-sm-10">
				<div class="row">
					<div class="col-sm-3">
						<div class="input-group">
							<input type="text" name="thumbsize" value="<?php echo $d['mediaset']['thumbsize']?>" class="form-control">
							<span class="input-group-addon">픽셀</span>
						</div>
					</div>
				</div>
				<p class="form-control-static text-muted">
					사진파일 업로드시 썸네일이 생성됩니다. 이때 생성할 썸네일의 가로사이즈를 지정해 주세요.<br>
					세로사이즈는 가로사이즈의 비율에 맞춰 자동으로 조정됩니다.
				</p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">업로드할 서버</label>
			<div class="col-sm-10">
				<div class="row">
					<div class="col-sm-3">
						<select name="use_fileserver" class="form-control" onchange="serverChange(this);">
						<option value=""<?php if(!$d['mediaset']['use_fileserver']):?> selected<?php endif?>>현재서버</option>
						<option value="1"<?php if($d['mediaset']['use_fileserver']):?> selected<?php endif?>>원격서버</option>
						</select>
					</div>
				</div>
				<p class="form-control-static text-muted">
					원격서버로 지정하면 파일 전용서버로 업로드할 수 있습니다.
				</p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary btn-lg<?php if($g['device']):?> btn-block<?php endif?>">저장하기</button>
			</div>
		</div>

		<div id="use_fileserver"<?php if(!$d['mediaset']['use_fileserver']):?> class="d-none"<?php endif?>>
			<div class="page-header">
				<h4>파일서버 설정</h4>
			</div>


			<div class="form-group">
				<label class="col-sm-2 control-label">FTP Type</label>
				<div class="col-sm-9">
					<select name="ftp_type" class="form-control" onchange="ftp_select(this);">
					<option value=""<?php if(!$d['mediaset']['ftp_type']):?> selected<?php endif?>>FTP</option>
					<option value="sftp"<?php if($d['mediaset']['ftp_type']=='sftp'):?> selected<?php endif?>>SFTP</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">FTP Server</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="ftp_host" value="<?php echo $d['mediaset']['ftp_host']?>" placeholder="예) example.kimsq.com  또는 IP adress 입력">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">FTP Port</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="ftp_port" value="<?php echo $d['mediaset']['ftp_port']?$d['mediaset']['ftp_port']:'21'?>" placeholder="" style="width:100px;">
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-9">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="ftp_pasv" value="1"<?php if($d['mediaset']['ftp_pasv']):?> checked<?php endif?>> <i></i>Passive Mode
						</label>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">FTP ID</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="ftp_user" value="<?php echo $d['mediaset']['ftp_user']?>" placeholder="FTP ID">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Password</label>
				<div class="col-sm-9">
					<input type="password" class="form-control" name="ftp_pass" value="<?php echo $d['mediaset']['ftp_pass']?>" placeholder="Password">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">첨부할 폴더</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="ftp_folder" value="<?php echo $d['mediaset']['ftp_folder']?>" placeholder="">
					<p class="form-control-static">
						<small class="text-muted">
							FTP접속시 최상위폴더로 부터 실제 첨부할 폴더의 서버경로를 지정해 주세요.<br>
							경로의 처음과 마지막은 반드시 슬래쉬(/)로 끝나야 합니다.<br>
							보기)<code>/www/myfolder/</code> 또는 <code>/public_html/myfolder/</code>
						</small>
					</p>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">URL 경로</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="ftp_urlpath" value="<?php echo $d['mediaset']['ftp_urlpath']?>" placeholder="">
					<p class="form-control-static">
						<small class="text-muted">
							첨부폴더를 웹상에서 접근할 수 있는 URL주소를 http://포함하여 입력해 주세요.<br>
							경로의 마지막은 반드시 슬래쉬(/)로 끝나야 합니다.<br>
							보기)<code>http://www.kimsq.com/myfolder/</code>
						</small>
					</p>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="button" class="btn btn-light" id="ftpbtn" onclick="sendCheck(this.id);"><?php if($d['mediaset']['ftp']):?><i class="fa fa-info-circle fa-lg fa-fw"></i>정상<?php else:?>FTP 연결확인<?php endif?></button>
					<button type="submit" class="btn btn-primary<?php if($g['device']):?> btn-block<?php endif?>">저장하기</button>
				</div>
			</div>
		</div>


	</form>
</div>


<script>
function serverChange(obj)
{
	if (obj.value == '1')
	{
		getId('use_fileserver').className = '';
	}
	else {
		getId('use_fileserver').className = 'hidden';
	}
}
var submitFlag = false;
function sendCheck(id)
{
	if (submitFlag == true)
	{
		alert('응답을 기다리는 중입니다. 잠시 기다려 주세요.');
		return false;
	}
	var f = document.procForm;

	if (f.ftp_host.value == '')
	{
		alert('FTP 서버주소를 입력해 주세요.   ');
		f.ftp_host.focus();
		return false;
	}
	if (f.ftp_port.value == '')
	{
		alert('FTP 포트번호를 입력해 주세요.    ');
		f.ftp_port.focus();
		return false;
	}
	if (f.ftp_user.value == '')
	{
		alert('FTP 아이디를 입력해 주세요.    ');
		f.ftp_user.focus();
		return false;
	}
	if (f.ftp_pass.value == '')
	{
		alert('FTP 암호를 입력해 주세요.    ');
		f.ftp_pass.focus();
		return false;
	}
	if (f.ftp_folder.value == '')
	{
		alert('첨부할 폴더경로를 입력해 주세요.    ');
		f.ftp_folder.focus();
		return false;
	}
	if (f.ftp_urlpath.value == '')
	{
		alert('URL 접속주소를 입력해 주세요.    ');
		f.ftp_urlpath.focus();
		return false;
	}
	f.a.value = 'ftp_check';
	getId(id).innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
	getIframeForAction(f);
	f.submit();
	submitFlag = true;
}
function saveCheck(f)
{
	if (f.use_fileserver.value == '1')
	{
		if (f.ftp_host.value == '')
		{
			alert('FTP 서버주소를 입력해 주세요.   ');
			f.ftp_host.focus();
			return false;
		}
		if (f.ftp_port.value == '')
		{
			alert('FTP 포트번호를 입력해 주세요.    ');
			f.ftp_port.focus();
			return false;
		}
		if (f.ftp_user.value == '')
		{
			alert('FTP 아이디를 입력해 주세요.    ');
			f.ftp_user.focus();
			return false;
		}
		if (f.ftp_pass.value == '')
		{
			alert('FTP 암호를 입력해 주세요.   ');
			f.ftp_pass.focus();
			return false;
		}
		if (f.ftp_folder.value == '')
		{
			alert('첨부할 폴더경로를 입력해 주세요.    ');
			f.ftp_folder.focus();
			return false;
		}
		if (f.ftp_urlpath.value == '')
		{
			alert('URL 접속주소를 입력해 주세요.    ');
			f.ftp_urlpath.focus();
			return false;
		}
	}
	if (f.ftp_connect.value == '')
	{
		alert('FTP가 연결되는지 확인해 주세요.   ');
		return false;
	}
	getIframeForAction(f);
	return confirm('정말로 실행하시겠습니까?         ');
}
function ftp_select(obj)
{
	if (obj.value == '') obj.form.ftp_port.value = '21';
	else obj.form.ftp_port.value = '22';
}
</script>
