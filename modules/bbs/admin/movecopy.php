<?php

//게시물링크
function getPostLink($arr)
{
	return RW('m=bbs&bid='.$arr['bbsid'].'&uid='.$arr['uid'].($GLOBALS['s']!=$arr['site']?'&s='.$arr['site']:''));
}

$postarray1 = array();
$postarray2 = array();

$postarray1 = getArrayString($postuid);
foreach($postarray1['data'] as $val)
{
	if (!strstr($_SESSION['BbsPost'.$type],'['.$val.']'))
	{
		$_SESSION['BbsPost'.$type] .= '['.$val.']';
	}
}
$postarray2 = getArrayString($_SESSION['BbsPost'.$type]);
rsort($postarray2['data']);
reset($postarray2['data']);
?>


<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $module?>" />
	<input type="hidden" name="type" value="<?php echo $type?>" />
	<input type="hidden" name="a" value="" />


<div id="toolbox" class="container">

	<div class="d-flex justify-content-between">
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link<?php if($type=='multi_move'):?> active<?php endif?>" href="<?php echo $g['adm_href']?>&amp;iframe=<?php echo $iframe?>&amp;type=multi_move">게시물이동</a>
			</li>
			<li class="nav-item">
				<a class="nav-link<?php if($type=='multi_copy'):?> active<?php endif?>" href="<?php echo $g['adm_href']?>&amp;iframe=<?php echo $iframe?>&amp;type=multi_copy">게시물복사</a>
			</li>
		</ul>
		<a class="btn btn-link" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=multi_empty&amp;type=<?php echo $type?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 대기리스트를 비우시겠습니까?       ');">비우기</a>
	</div>

	<table class="table text-center">
		<colgroup>
			<col width="30">
			<col width="80">
			<col>
			<col width="50">
			<col width="90">
		</colgroup>
		<thead>
			<tr>
				<th scope="col">
					<button type="button" class="btn btn-sm btn-light" onclick="chkFlag('post_members[]');">선택</button>
				</th>
				<th scope="col">게시판</th>
				<th scope="col">제목</th>
				<th scope="col">조회</th>
				<th scope="col" class="side2">날짜</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach($postarray2['data'] as $val):?>
			<?php $R=getUidData($table[$module.'data'],$val)?>
			<?php $R['mobile']=isMobileConnect($R['agent'])?>
			<tr>
				<td><input type="checkbox" name="post_members[]" value="<?php echo $R['uid']?>" checked="checked" /></td>
				<td class="bbsid"><?php echo $R['bbsid']?></td>
				<td class="text-left">
					<?php if($R['notice']):?><span class="badge badge-light">공지</span><?php endif?>
					<?php if($R['mobile']):?><span class="badge badge-light"><i class="fa fa-mobile fa-lg"></i></span><?php endif?>
					<?php if($R['category']):?><span class="badge badge-light"><?php echo $R['category']?></span><?php endif?>
					<a href="<?php echo getPostLink($R)?>" target="_blank"><?php echo $R['subject']?></a>
					<?php if(strstr($R['content'],'.jpg')):?>
					<span class="badge badge-light" data-toggle="tooltip" title="사진">
						<i class="fa fa-camera-retro fa-lg"></i>
					</span>
					<?php endif?>
					<?php if($R['upload']):?>
					<span class="badge badge-light" data-toggle="tooltip" title="첨부파일">
						<i class="fa fa-paperclip fa-lg"></i>
					</span>
					<?php endif?>
					<?php if($R['hidden']):?>
					<span class="badge badge-light" data-toggle="tooltip" title="비밀글"><i class="fa fa-lock fa-lg"></i></span>
					<?php endif?>
					<?php if($R['comment']):?><span class="badge badge-light"><?php echo $R['comment']?><?php if($R['oneline']):?>+<?php echo $R['oneline']?><?php endif?></span><?php endif?>
					<?php if(getNew($R['d_regis'],24)):?><span class="rb-new">new</span><?php endif?>
				</td>
				<td class="small"><?php echo $R['hit']?></td>
				<td><?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?></td>
			</tr>
			<?php endforeach?>

			<?php if(!$postarray2['count']):?>
			<tr>
				<td><input type="checkbox" disabled="disabled" /></td>
				<td></td>
				<td class="text-center">게시물이 없습니다.</td>
				<td>-</td>
				<td><?php echo getDateFormat($date['totime'],'Y.m.d H:i')?></td>
			</tr>
			<?php endif?>

		</tbody>
	</table>

	<div class="footer">


		<?php if($type == 'multi_copy'):?>

		<table class="table">
			<tr>
				<td class="td1">게시판 선택</td>
				<td class="td3">

					<select name="bid" class="form-control custom-select w-50">
						<option value="">&nbsp;+ 선택하세요</option>
						<option value="" disabled>---------------------------</option>
						<?php $_BBSLIST = getDbArray($table[$module.'list'],'','*','gid','asc',0,1)?>
						<?php while($_B=db_fetch_array($_BBSLIST)):?>
						<option value="<?php echo $_B['uid']?>"<?php if($_B['uid']==$bid):?> selected="selected"<?php endif?>>ㆍ<?php echo $_B['name']?>(<?php echo $_B['id']?> - <?php echo number_format($_B['num_r'])?>)</option>
						<?php endwhile?>
						<?php if(!db_num_rows($_BBSLIST)):?>
						<option value="">등록된 게시판이 없습니다.</option>
						<?php endif?>
					</select>

				</td>
			</tr>
			<tr>
				<td class="td1">복사옵션</td>
				<td class="td3 shift">
					<div class="shift">
					<input type="checkbox" name="inc_upload" value="1" checked="checked" />첨부파일포함
					<input type="checkbox" name="inc_comment" value="1" checked="checked" />댓글/한줄의견포함

					<input type="button" value="복사" class="btn btn-primary" onclick="actQue('multi_copy');" />
					<input type="button" value="닫기" class="btn btn-light" onclick="top.close();" />
					</div>
				</td>
			</tr>
		</table>


		<?php else:?>

		<table class="table">
			<tr>
				<td>게시판 선택</td>
				<td>
					<select name="bid" class="form-control custom-select w-50">
						<option value="">&nbsp;+ 선택하세요</option>
						<option value="" disabled>---------------------------</option>
						<?php $_BBSLIST = getDbArray($table[$module.'list'],'','*','gid','asc',0,1)?>
						<?php while($_B=db_fetch_array($_BBSLIST)):?>
						<option value="<?php echo $_B['uid']?>"<?php if($_B['uid']==$bid):?> selected="selected"<?php endif?>>ㆍ<?php echo $_B['name']?>(<?php echo $_B['id']?> - <?php echo number_format($_B['num_r'])?>)</option>
						<?php endwhile?>
						<?php if(!db_num_rows($_BBSLIST)):?>
						<option value="">등록된 게시판이 없습니다.</option>
						<?php endif?>
					</select>
					<small class="form-text text-muted mt-2">
					 동일게시판의 게시물은 제외됨
					</small>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="button" value="이동" class="btn btn-primary" onclick="actQue('multi_move');" />
					<input type="button" value="닫기" class="btn btn-light" onclick="top.close();" />
				</td>
			</tr>
		</table>

		<?php endif?>
	</div>

</div>

</form>

<script type="text/javascript">
//<![CDATA[
function actQue(act)
{
	var f = document.procForm;
    var l = document.getElementsByName('post_members[]');
    var n = l.length;
	var j = 0;
    var i;

    for (i = 0; i < n; i++)
	{
		if(l[i].checked == true)
		{
			j++;
		}
	}
	if (!j)
	{
		alert('선택된 게시물이 없습니다.      ');
		return false;
	}

	if (f.bid.value == '')
	{
		alert('게시판을 선택해 주세요.       ');
		f.bid.focus();
		return false;
	}
	if (confirm('정말로 실행하시겠습니까?    '))
	{
		f.a.value = act;
		f.submit();
	}
	return false;
}


document.title = "게시물 <?php echo $type=='multi_move'?'이동':'복사'?>";
self.resizeTo(650,650);
//]]>
</script>
