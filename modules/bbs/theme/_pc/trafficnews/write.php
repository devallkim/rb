
 <div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="kf-bbs"></i> <?php echo $B['name']?> 등록</h3>
		</div>
		<div class="mt-4">
			<form name="writeForm" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return writeCheck(this);" role="form" class="form-horizontal">
			<input type="hidden" name="r" value="<?php echo $r?>" />
			<input type="hidden" name="a" value="write" />
			<input type="hidden" name="c" value="<?php echo $c?>" />
			<input type="hidden" name="cuid" value="<?php echo $_HM['uid']?>" />
			<input type="hidden" name="m" value="<?php echo $m?>" />
			<input type="hidden" name="bid" value="<?php echo $R['bbsid']?$R['bbsid']:$bid?>" />
			<input type="hidden" name="uid" value="<?php echo $R['uid']?>" />
			<input type="hidden" name="reply" value="<?php echo $reply?>" />
			<input type="hidden" name="nlist" value="<?php echo $g['bbs_list']?>" />
			<input type="hidden" name="pcode" value="<?php echo $date['totime']?>" />
      <input type="hidden" name="backtype1" value="list" />
			<input type="hidden" name="upfiles" id="upfilesValue" value="<?php echo $reply=='Y'?'':$R['upload']?>" />
			<input type="hidden" name="html" value="HTML" />
      <input type="hidden" name="hidden" value="0" />
				<fieldset>
			      <?php if(!$my['id']):?>
							<div class="form-group row">
								<label class="col-2 col-form-label" for="">이름<span class="rb-form-required text-danger"></span></label>
								<div class="col-10">
									<input type="text" name="name" placeholder="이름을 입력해 주세요." value="<?php echo $R['name']?>" id="" class="form-control">
									<span class="help-block"></span>
								</div>
							</div>
							<?php if(!$R['uid']||$reply=='Y'):?>
							<div class="form-group has-error has-feedback">
								<label class="col-2 col-form-label" for="">암호<span class="rb-form-required text-danger"></span></label>
								<div class="col-10">
									<input type="password" name="pw" placeholder="암호는 게시글 수정 및 삭제에 필요합니다." value="<?php echo $R['pw']?>" id="" class="form-control">
									<span class="help-block">비밀답변은 비번을 수정하지 않아야 원게시자가 열람할 수 있습니다.</span>
									<span class="glyphicon glyphicon-remove form-control-feedback"></span>
								</div>
							</div>
						  <?php endif?>
				   <?php endif?>

            <?php if($B['category']):$_catexp = explode(',',$B['category']);$_catnum=count($_catexp)?>
            <div class="form-group row">
              <div class="col-12">
                <select name="category" class="form-control form-control-lg" style="width: 200px">
                <option value="">&nbsp;+ <?php echo $_catexp[0]?>선택</option>
                <?php for($i = 1; $i < $_catnum; $i++):if(!$_catexp[$i])continue;?>
                <option value="<?php echo $_catexp[$i]?>"<?php if($_catexp[$i]==$R['category']||$_catexp[$i]==$cat):?> selected="selected"<?php endif?>>ㆍ<?php echo $_catexp[$i]?><?php if($d['theme']['show_catnum']):?><?php endif?></option>
                <?php endfor?>
                </select>
              </div>
            </div>
            <?php endif?>

				    <div class="form-group row">
								<div class="col-10">
									<input type="text" name="subject" placeholder="실시간 교통소식을 입력해 주세요." value="<?php echo $R['subject']?>" id="" class="form-control form-control-lg">
								</div>
								<?php if($my['admin']):?>
									<div class="checkbox col-sm-1">
									    <label>
									      <input type="checkbox" name="notice" value="1"<?php if($R['notice']):?> checked="checked"<?php endif?>>
									      <span data-toggle="tooltip" title="공지"><i class="fa fa-volume-up fa-lg"></i></span>
									    </label>
									 </div>
							  	<?php endif?>

					 </div>

				</fieldset>

        <div class="text-center">
          <input type="button" value="취소" class="btn btn-secondary" onclick="cancelCheck();" />
          <input type="submit" value="확인" class="btn btn-primary" />
        </div>

			</form>
		</div>
	</div><!-- panel panel-default-->

<!-- 코드미러를 먼저 호출하고 난 후에 summernote 호출해야 코드미러가 적용이 됨-->
<!-- include summernote codemirror-->

<script type="text/javascript">


// 글 등록 함수
var submitFlag = false;

function writeCheck(f)
{
	if (submitFlag == true)
	{
		alert('게시물을 등록하고 있습니다. 잠시만 기다려 주세요.');
		return false;
	}
	if (f.name && f.name.value == '')
	{
		alert('이름을 입력해 주세요. ');
		f.name.focus();
		return false;
	}
	if (f.pw && f.pw.value == '')
	{
		alert('암호를 입력해 주세요. ');
		f.pw.focus();
		return false;
	}
	if (f.category && f.category.value == '')
	{
		alert('카테고리를 선택해 주세요. ');
		f.category.focus();
		return false;
	}
	if (f.subject.value == '')
	{
		alert('제목을 입력해 주세요.      ');
		f.subject.focus();
		return false;
	}
	if (f.notice && f.hidden)
	{
		if (f.notice.checked == true && f.hidden.checked == true)
		{
			alert('공지글은 비밀글로 등록할 수 없습니다.  ');
			f.hidden.checked = false;
			return false;
		}
	}

}

function cancelCheck()
{
	if (confirm('정말 취소하시겠습니까?    '))
	{
		history.back();
	}
}


//]]>
</script>
