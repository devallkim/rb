<?php
$sort	= $sort ? $sort : 'uid';
$orderby= $orderby ? $orderby : 'asc';
$popupque	= '';

// 키워드 검색 추가
if ($keyw)
{
	$popupque .= "(name like '%".$keyw."%')";
}

$POPUPS = getDbArray($table['s_popup'],$popupque,'*',$sort,$orderby,$recnum,$p);
$NUM = db_num_rows($POPUPS);
if ($uid)
{
	$R = getUidData($table['s_popup'],$uid);
}
if ($R['uid'])
{
	$year1	= substr($R['term1'],0,4);
	$month1	= substr($R['term1'],4,2);
	$day1	= substr($R['term1'],6,2);
	$hour1	= substr($R['term1'],8,2);
	$min1	= substr($R['term1'],10,2);
	$year2	= substr($R['term2'],0,4);
	$month2	= substr($R['term2'],4,2);
	$day2	= substr($R['term2'],6,2);
	$hour2	= substr($R['term2'],8,2);
	$min2	= substr($R['term2'],10,2);
	$width =$R['width'];
	$height =$R['height'];

}
else {
	$year1	= substr($date['today'],0,4);
	$month1	= substr($date['today'],4,2);
	$day1	= substr($date['today'],6,2);
	$hour1	= 0;
	$min1	= 0;
	$year2	= substr($date['today'],0,4);
	$month2	= substr($date['today'],4,2);
	$day2	= substr($date['today'],6,2);
	$hour2	= 23;
	$min2	= 59;
	$R['width'] = 400;
	$R['height']= 400;
}
?>

<div id="rb-popup" class="row no-gutters">
	<div class="col-sm-4 col-md-4 col-xl-3 d-none d-sm-block sidebar"><!-- 좌측  내용 -->
		<div class="panel-group" id="accordion">
			<div class="card">
				<div class="card-header d-flex justify-content-between p-2">
					팝업 목록
					<button type="button" class="btn btn-link muted-link py-0<?php if(!$_SESSION['sh_popup_search']):?> collapsed<?php endif?>" data-toggle="collapse" data-target="#panel-search" onclick="sessionSetting('sh_popup_search','1','','1');getSearchFocus();">
						<i class="fa fa-search"></i>
					</button>
				</div>
				<div class="card-body p-0" style="height: calc(100vh - 10.5rem);">
					<div id="panel-search" class="collapse<?php if($_SESSION['sh_popup_search']):?> show<?php endif?>">
						<form role="form" action="<?php echo $g['s']?>/" method="get">
						<input type="hidden" name="r" value="<?php echo $r?>">
						<input type="hidden" name="m" value="<?php echo $m?>">
						<input type="hidden" name="module" value="<?php echo $module?>">
						<input type="hidden" name="front" value="<?php echo $front?>">

						<div class="panel-heading rb-search-box">
							<div class="input-group w-100">
								<div class="input-group-prepend">
									<span class="input-group-text">출력수</span>
								</div>
								<select class="form-control custom-select" name="recnum" onchange="this.form.submit();">
									<option value="15"<?php if($recnum==15):?> selected<?php endif?>>15</option>
									<option value="30"<?php if($recnum==30):?> selected<?php endif?>>30</option>
									<option value="60"<?php if($recnum==60):?> selected<?php endif?>>60</option>
									<option value="100"<?php if($recnum==100):?> selected<?php endif?>>100</option>
								</select>
							</div>
						</div>
						<div class="rb-keyword-search input-group">
							<input type="text" name="keyw" class="form-control" value="<?php echo $keyw?>" placeholder="등록된 팝업 검색어 입력">
							<div class="input-group-append">
								<button class="btn btn-light" type="submit">검색</button>
							</div>
						</div>
						</form>
					</div>
					<?php if($NUM):?>
					<div class="list-group list-group-flush border-bottom">
						<?php while($PR = db_fetch_array($POPUPS)):?>
						<a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?php if($PR['uid']==$uid):?> border border-primary<?php endif?>" href="<?php echo $g['adm_href']?>&amp;p=<?php echo $p?>&amp;uid=<?php echo $PR['uid']?>">
							<?php echo $PR['name']?>
							<span class="badge badge-dark badge-pill ml-auto">데스크탑</span>
						</a>
						<?php endwhile?>
					</div>
					<?php else:?>
					<div class="d-flex justify-content-center align-items-center text-muted" style="height: calc(100vh - 13rem);">

						<div class="text-center">
							<i class="fa fa-exclamation-circle fa-3x mb-2 d-block" aria-hidden="true"></i>
							등록된 팝업이 없습니다.
						</div>

					</div>
					<?php endif?>
				</div>

				<?php if($TPG>1):?>
				<ul class="pagination justify-content-center">
					<script>getPageLink(5,<?php echo $p?>,<?php echo $TPG?>,'');</script>
				</ul>
				<?php endif?>

				<div class="card-footer">
				 	 <a href="<?php echo $g['adm_href']?>&amp;newpop=Y" class="btn btn-outline-primary btn-block"><i class="fa fa-plus"></i> 새 팝업 만들기</a>
				 </div>

			</div>

			<?php if($g['device']):?><a name="popup-info"></a><?php endif?>
		</div>
	</div><!-- //좌측  내용 끝 -->

	<!-- 우측 내용 시작 -->
	<div id="tab-content-view" class="col-sm-8 col-md-8 ml-sm-auto col-xl-9">

		<form class="card rounded-0 border-0" role="form" name="procForm" action="<?php echo $g['s']?>/" method="post" onsubmit="return saveCheck(this);">
			<input type="hidden" name="r" value="<?php echo $r?>" />
			<input type="hidden" name="m" value="<?php echo $module?>" />
			<input type="hidden" name="front" value="<?php echo $front?>" />
			<input type="hidden" name="a" value="regispopup" />
			<input type="hidden" name="uid" value="<?php echo $R['uid']?>" />
			<input type="hidden" name="dispage" value="<?php echo $R['dispage']?>" />

			<div class="card-header d-flex justify-content-between align-items-center">
				<?php echo $R['uid']?'팝업 등록정보':'새 팝업 만들기' ?>
			</div><!-- /.card-header -->
			<div class="card-body">

				<div class="form-group row">
					<label class="col-lg-2 col-form-label text-lg-right">팝업이름</label>
					<div class="col-lg-10 col-xl-9">
						<?php if($R['uid']):?>
						<div class="input-group">
							<input type="text" name="name" value="<?php echo $R['name']?>" class="form-control"<?php if(!$g['device']):?> autofocus<?php endif?>>
							<span class="input-group-append">
								<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=deletepopup&amp;uid=<?php echo $R['uid']?>"  class="btn btn-light" onclick="return hrefCheck(this,true,'정말로 삭제하시겠습니까?');" data-tooltip="tooltip" title="팝업 삭제">
									<i class="fa fa-trash-o fa-lg"></i>
								</a>
							</span>
							<span class="input-group-append">
								<a href="#" onmousedown="popUpModalSet('<?php echo $R['uid']?>');" class="btn btn-light popup-preview" data-tooltip="tooltip" title="미리보기">
									<i class="fa fa-eye fa-lg" aria-hidden="true"></i>
								</a>
							</span>

						</div>
						<?php else:?>
						<input class="form-control" placeholder="" type="text" name="name" value="<?php echo $R['name']?>"<?php if(!$g['device']):?> autofocus<?php endif?>>
						<?php endif?>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-lg-2 col-form-label text-lg-right">노출옵션</label>
					<div class="col-sm-10">
						<div class="custom-control custom-checkbox custom-control-inline">
						  <input type="checkbox" class="custom-control-input" id="scroll" name="scroll" value="1"<?php if($R['scroll']):?> checked<?php endif?>>
						  <label class="custom-control-label" for="scroll">스크롤</label>
						</div>
						<div class="custom-control custom-checkbox custom-control-inline">
							<input type="checkbox" class="custom-control-input" id="hidden" name="hidden" value="1"<?php if($R['hidden']):?> checked<?php endif?>>
							<label class="custom-control-label" for="hidden">일시중지</label>
						</div>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-lg-2 col-form-label text-lg-right">노출기간</label>
					<div class="col-sm-10">
						<div class="custom-control custom-checkbox custom-control-inline">
						  <input type="checkbox" class="custom-control-input" id="term0" name="term0" value="1"<?php if($R['term0']):?> checked<?php endif?>>
						  <label class="custom-control-label" for="term0">제한없음</label>
						</div>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-lg-2 col-form-label text-lg-right">시작일</label>
					<div class="col-md-9 col-sm-10">
						<div class="form-inline">
							<div class="input-group">
								<select name="year1" class="form-control custom-select">
									<?php for($i=$date['year'];$i<$date['year']+2;$i++):?>
									<option value="<?php echo $i?>"<?php if($year1==$i):?> selected<?php endif?>>
										<?php echo $i?>
									</option>
									<?php endfor?>
								</select>
								<div class="input-group-append">
							    <span class="input-group-text">년</span>
							  </div>
							</div>
							<div class="input-group ml-1">
								<select name="month1" class="form-control custom-select">
									<?php for($i=1;$i<13;$i++):?>
									<option value="<?php echo sprintf('%02d',$i)?>"<?php if($month1==$i):?> selected<?php endif?>>
										<?php echo sprintf('%02d',$i)?>
									</option>
									<?php endfor?>
								</select>
								<div class="input-group-append">
							    <span class="input-group-text">월</span>
							  </div>
							</div>
							<div class="input-group ml-1">
								<select name="day1" class="form-control custom-select">
									<?php for($i=1;$i<32;$i++):?>
									<option value="<?php echo sprintf('%02d',$i)?>"<?php if($day1==$i):?> selected<?php endif?>>
										<?php echo sprintf('%02d',$i)?>(<?php echo getWeekday(date('w',mktime(0,0,0,$month1,$i,$year1)))?>)
									</option>
									<?php endfor?>
								</select>
								<div class="input-group-append">
							    <span class="input-group-text">일</span>
							  </div>
							</div>
							<div class="input-group ml-1">
								<select name="hour1" class="form-control custom-select">
									<?php for($i=0;$i<24;$i++):?>
									<option value="<?php echo sprintf('%02d',$i)?>"<?php if($hour1==$i):?> selected<?php endif?>>
										<?php echo sprintf('%02d',$i)?>
									</option>
									<?php endfor?>
								</select>
								<div class="input-group-append">
							    <span class="input-group-text">시</span>
							  </div>
							</div>
							<div class="input-group ml-1">
								<select name="min1" class="form-control custom-select">
									<?php for($i=0;$i<60;$i++):?>
									<option value="<?php echo sprintf('%02d',$i)?>"<?php if($min1==$i):?> selected<?php endif?>>
										<?php echo sprintf('%02d',$i)?>
									</option>
									<?php endfor?>
								</select>
								<div class="input-group-prepend">
							    <span class="input-group-text">분</span>
							  </div>
							</div>
						</div><!-- /.form-inline -->
					</div>
				</div>

				<div class="form-group row">
					<label class="col-lg-2 col-form-label text-lg-right">종료일</label>
					<div class="col-md-9 col-sm-10">

						<div class="form-inline">
							<div class="input-group">
								<select name="year2" class="form-control custom-select">
									<?php for($i=$date['year'];$i<$date['year']+2;$i++):?>
									<option value="<?php echo $i?>"<?php if($year2==$i):?> selected<?php endif?>>
										<?php echo $i?>
									</option>
									<?php endfor?>
								</select>
								<div class="input-group-append">
							    <span class="input-group-text">년</span>
							  </div>
							</div>
							<div class="input-group ml-1">
								<select name="month2" class="form-control custom-select">
									<?php for($i=1;$i<13;$i++):?>
									<option value="<?php echo sprintf('%02d',$i)?>"<?php if($month2==$i):?> selected<?php endif?>>
										<?php echo sprintf('%02d',$i)?>
									</option>
									<?php endfor?>
								</select>
								<div class="input-group-append">
							    <span class="input-group-text">월</span>
							  </div>
							</div>
							<div class="input-group ml-1">
								<select name="day2" class="form-control custom-select">
									<?php for($i=1;$i<32;$i++):?>
									<option value="<?php echo sprintf('%02d',$i)?>"<?php if($day2==$i):?> selected<?php endif?>>
										<?php echo sprintf('%02d',$i)?>(<?php echo getWeekday(date('w',mktime(0,0,0,$month2,$i,$year2)))?>)
									</option>
									<?php endfor?>
								</select>
								<div class="input-group-append">
							    <span class="input-group-text">일</span>
							  </div>
							</div>
							<div class="input-group ml-1">
								<select name="hour2" class="form-control custom-select">
									<?php for($i=0;$i<24;$i++):?>
									<option value="<?php echo sprintf('%02d',$i)?>"<?php if($hour2==$i):?> selected<?php endif?>>
										<?php echo sprintf('%02d',$i)?>
									</option>
									<?php endfor?>
								</select>
								<div class="input-group-append">
							    <span class="input-group-text">시</span>
							  </div>
							</div>
							<div class="input-group ml-1">
								<select name="min2" class="form-control custom-select">
									<?php for($i=0;$i<60;$i++):?>
									<option value="<?php echo sprintf('%02d',$i)?>"<?php if($min2==$i):?> selected<?php endif?>>
										<?php echo sprintf('%02d',$i)?>
									</option>
									<?php endfor?>
								</select>
								<div class="input-group-prepend">
							    <span class="input-group-text">분</span>
							  </div>
							</div>
						</div><!-- /.form-inline -->

					</div>
				</div>

				<div class="form-group row">
					<label class="col-lg-2 col-form-label text-lg-right">테마</label>
					<div class="col-sm-4">
						<select class="form-control custom-select" name="theme" id="popup-theme">
						  <option>선택하세요</option>
						  <option value="bs4-modal"<?php if($R['theme'] == 'bs4-modal'):?> selected<?php endif?>>bs4-modal</option>
						  <option value="rc-modal"<?php if($R['theme'] == 'rc-modal'):?> selected<?php endif?>>rc-modal</option>
						  <option value="rc-popup"<?php if($R['theme'] == 'rc-popup'):?> selected<?php endif?>>rc-popup</option>
						</select>
						</div>
					</div>

				<div id="popup-size" style="display:none">
					<div class="form-group row">
						<label class="col-lg-2 col-form-label text-right">노출크기</label>
						<div class="col-md-5 col-sm-10">
							<div class="input-group">
								<input type="text" name="width" value="<?php echo $R['width']?>" class="form-control" placeholder="가로">
								<div class="input-group-prepend">
							    <span class="input-group-text">x</span>
							  </div>
								<input type="text" name="height" value="<?php echo $R['height']?>" class="form-control" placeholder="세로">
							</div>
							<small class="form-text text-muted">가로 * 세로의 단위는 픽셀입니다.</small>
						</div>
					</div>
				</div>

				<div id="popup-position" style="display:none">
					<div class="form-group row">
						<label class="col-lg-2 col-form-label text-lg-right">노출위치</label>
						<div class="col-md-5 col-sm-10">
							<div class="input-group">
								<input type="text" name="ptop" value="<?php echo $R['ptop']?$R['ptop']:0?>" class="form-control" placeholder="위쪽">
								<div class="input-group-prepend">
							    <span class="input-group-text">x</span>
							  </div>
								<input type="text" name="pleft" value="<?php echo $R['pleft']?$R['pleft']:0?>" class="form-control" placeholder="왼쪽">
								<div class="input-group-append">
							    <div class="input-group-text">
							      <input class="mr-2" type="checkbox" name="center" value="1"<?php if($R['center']):?> checked<?php endif?>> 중앙에서 위치계산
							    </div>
							  </div>
							</div>
							<small class="form-text text-muted">위쪽 * 왼쪽의 단위는 픽셀입니다.</small>
						</div>

					</div>
				</div>


				<hr>

				<div class="form-group row">
					<label class="col-lg-2 col-form-label text-lg-right">내용</label>
					<div class="col-md-9 col-sm-10">
						<input type="hidden" name="html" value="<?php echo $R['html']?$R['html']:'HTML'?>">
						<textarea class="form-control" rows="3" name="source"><?php echo $R['content']?></textarea>
						<div class="btn-group mt-2">
							<a class="btn btn-light rb-modal-photoset" href="#." data-toggle="modal" data-target="#modal_window"><i class="fa fa-photo"></i> 포토셋</a>
						</div>
					</div>
				</div>


				<div class="card">
					<div class="card-header">
						<i class="kf-home fa-fw"></i> 노출 사이트 지정
					</div><!-- /.card-header -->
					<div class="card-body">
						<?php $i=0?>
						<?php $dispagex = explode('|',$R['dispage'])?>
						<?php $SITES = getDbArray($table['s_site'],'','*','gid','asc',0,$p)?>
						<?php while($S = db_fetch_array($SITES)):?>
						<div class="form-group row">
							<label class="col-lg-2 col-form-label text-lg-right"><?php echo $S['name']?></label>
							<div class="col-md-9 col-sm-10">
								<div class="d-none">
									<input type="checkbox" name="sitemembers[]" value="[<?php echo $S['uid']?>]" checked />
								</div>
								<div class="input-group">
									<input type="text" name="pagemembers[]" value="<?php echo str_replace('m['.$S['uid'].']','',str_replace('[s['.$S['uid'].']]','',str_replace('[c['.$S['uid'].']]','',$dispagex[$i])))?>" class="form-control" />
									<div class="input-group-append">
										<div class="input-group-text">
											<input class="mr-2" type="checkbox" name="cutmembers[]" value="[<?php echo $S['uid']?>]"<?php if(strstr($dispagex[$i],'[c['.$S['uid'].']]')):?> checked<?php endif?>>
											전체차단
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php $i++?>
						<?php endwhile?>

					</div><!-- /.card-body -->
					<div class="card-footer">
						<small class="text-muted">아래의 입력란에 사이트별로 노출페이지 및 메뉴를 지정할 수 있습니다. 특정 페이지만 출력시 : <code>[페이지ID][페이지ID]...</code> 의 형식으로 출력페이지를 등록<br>특정메뉴만 출력시 : <code>[메뉴코드][메뉴코드]...</code> 의 형식으로 출력메뉴를 등록. 전체차단 체크없이 공백으로 두시면 모든페이지에 대해서 팝업이 출력됩니다.</small>
					</div>
				</div><!-- /.card -->

				<hr>

				<button type="submit" class="btn btn-outline-primary btn-block btn-lg">
					<?php echo $R['uid']?'팝업 속성 변경':'새 팝업 만들기' ?>
				</button>


			</div><!-- /.card-body -->

		</form>
	</div>
</div>
<div class="modal" id="popup-preview">
   <div class="modal-cont">
		   <div class="modal-body">
		       <!-- 아작스 모달내용 출력 -->
		    </div>
		    <div id="popclose">
			    <form name="pop">
			      <input type="checkbox" name="x" checked="cbecked" /> 오늘 하루 이창을 그만 엽니다.
			       <a href="#" data-dismiss="modal"> close</a>
			    </form>
			  </div>
	 </div>
</div>
<style>
#popclose {z-index:1200;width:100%;padding:2px 0;height:25px;background:#343434;text-align:center;color:#ffffff;}
#popclose a {color:#fff;margin-left: 20px;}
#popclose a:hover {color:#fff;text-decoration: none;}
#popup-preview .modal-cont {width:<?php echo $width?>px;height:<?php echo $height?>px;margin-top:<?php echo $R['ptop']?>px;margin-left:<?php echo $R['pleft']?>px;background: #fff;}
#popup-preview .modal-body {width:<?php echo $width?>px;height:<?php echo $height?>px;padding:0;overflow:hidden;}
</style>
<?php if($R['scroll']):?>
<style>
.modal-body {padding:0;overflow-x: hidden;overflow-y: scroll;}
</style>
<?php endif?>
<script>

putCookieAlert('result_popup_main') // 실행결과 알림 메시지 출력

$("#popup-theme").change(function(){
	var theme =  this.value
	if (theme == 'bs4-modal') {
		$("#popup-size").css('display','block');
		$("#popup-position").css('display','block');
	} else {
		$("#popup-size").css('display','none');
		$("#popup-position").css('display','none');
	}
});


// 팝업 미리보기 모달창 호출
function popUpModalSet(uid)
{
   var ajax=getHttprequest(rooturl+'/?r='+raccount+'&m=admin&module=<?php echo $module?>&front=preview&uid='+uid,'');
   var result=getAjaxFilterString(ajax,'RESULT');
   result=result.replace(/&nbsp;/gi,'');
   $('#popup-preview').find('.modal-body').html(result);
   $('#popup-preview').modal({show:true});
   $('.modal-backdrop').remove(); // 백드롭 없앤다.
}

//<![CDATA[
$('.rb-modal-photoset').on('click',function() {
	modalSetting('modal_window','<?php echo getModalLink('&amp;m=mediaset&amp;mdfile=modal.photo.media&amp;dropfield=editor')?>');
});
$('.rb-modal-videoset').on('click',function() {
	modalSetting('modal_window','<?php echo getModalLink('&amp;m=mediaset&amp;mdfile=modal.video.media&amp;dropfield=editor')?>');
});

function ToolCheck(compo)
{
	frames.editFrame.showCompo();
	frames.editFrame.EditBox(compo);
}

function saveCheck(f)
{
	if (f.name.value == '')
	{
		alert('팝업이름을 입력해 주세요.');
		f.name.focus();
		return false;
	}

	if (f.width.value == "")
	{
		alert('팝업창의 가로폭을 입력해 주세요');
		f.width.focus();
		return false;
	}
	if (f.height.value == "")
	{
		alert('팝업창의 세로폭을 입력해 주세요 ');
		f.height.focus();
		return false;
	}

    var s = document.getElementsByName('sitemembers[]');
    var c = document.getElementsByName('cutmembers[]');
    var l = document.getElementsByName('pagemembers[]');
    var n = l.length;
    var i;
	var cs = '';

    for (i = 0; i < n; i++)
	{
		if (c[i].checked == true)
		{
			cs += '[c'+s[i].value+']';
		}
		if (l[i].value == '')
		{
			cs += '[s'+s[i].value+']' + '|';
		}
		else {
			cs += l[i].value.replace(/\[/g,'[m'+s[i].value) + '|';
		}
	}

	f.dispage.value = cs;

	getIframeForAction(f);
	f.submit();

}
//]]>
</script>
