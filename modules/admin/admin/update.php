<?php
include $g['path_core'].'function/rss.func.php';
include $g['path_module'].'market/var/var.php';
$_serverinfo = explode('/',$d['market']['url']);
$_updatelist = getUrlData('http://'.$_serverinfo[2].'/__update/update.v2.txt',10);
$_updatelist = explode("\n",$_updatelist);
$_updatelength = count($_updatelist)-1;
$_version = explode('.',$d['admin']['version']);
$recnum	=  10;
$TPG = getTotalPage($_updatelength,$recnum);
?>

<div id="update-body">
	<div class="page-header">
	  <h4>킴스큐 원격 업데이트</h4>
	</div>

	<div class="media well">
	  <div class="pull-left version">
		<span class="fa kf-bi-01"></span> Rb <i><?php echo $d['admin']['version']?></i>
	  </div>
	  <div class="media-body hidden-xs">
			원격 업데이트를 이용하시면 킴스큐Rb를 항상 최신의 상태로 유지할 수 있습니다. <br>패치 및 업데이트 내용에 따라서 업데이트를 진행해 주세요.
	  </div>
	</div>

	<div class="update-info table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr class="active">
					<th>버전</th>
					<th>패치/업데이트</th>
					<th>적용일자</th>
					<th>처리여부</th>
					<th>관리</th>
				</tr>
			</thead>
			<tbody>

				<?php $_ishistory=false?>
				<?php for($i = $_updatelength-(($p-1)*$recnum)-1; $i > $_updatelength-($p*$recnum)-1; $i--):?>
				<?php $_update=trim($_updatelist[$i]);if(!$_update)continue?>
				<?php $var1=explode(',',$_update)?>
				<?php $var2=explode(',',$_updatelist[$i-1])?>
				<?php $_updatefile=$g['path_var'].'update/'.$var1[1].'.txt'?>
				<?php if(is_file($_updatefile)):?>
				<?php $_supdate=explode(',',implode('',file($_updatefile)))?>

				<tr class="active">
					<td>
						<span><?php echo $var1[0]?></span>
					</td>
					<td>
						<span>
							<?php if($var1[2]):?>
							<a href="<?php echo $var1[2]?>" target="_blank" data-tooltip="tooltip" title="업데이트 내역 보기"><?php echo $var1[0]?>_<?php echo $var1[1]?></a>
							<?php else:?>
							<a href="#." data-tooltip="tooltip" title="정보가 없는 없데이트입니다"><?php echo $var1[0]?>_<?php echo $var1[1]?></a>
							<?php endif?>
							&nbsp;
							<a href="http://<?php echo $_serverinfo[2]?>/__update/files/v2/<?php echo $var1[1]?>.zip" class="rb-update-download" data-tooltip="tooltip" title="파일 다운로드"><i class="glyphicon glyphicon-download-alt"></i></a>
						</span>
					</td>
					<td>
						<span><?php echo getDateFormat($_supdate[0],'Y.m.d')?></span>
					</td>
					<td>
						<button class="btn btn-default disabled">
							<i class="fa fa-circle-o"></i> 완료됨 <?php if($_supdate[1]):?>(수동)<?php else:?>(원격)<?php endif?>
						</button>
					</td>
					<td>
						<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;a=update&amp;type=delete&amp;ufile=<?php echo $var1[1]?>" title="업데이트기록 제거" onclick="return hrefCheck(this,true,'정말로 업데이트 기록을 제거하시겠습니까?');" class="btn btn-default"><i class="fa fa-times"></i> 기록제거</a>
					</td>
				</tr>

				<?php else:?>

				<tr>
					<td>
						<span><?php echo $var1[0]?></span>
					</td>
					<td>
						<span>
							<?php if($var1[2]):?>
							<a href="<?php echo $var1[2]?>" target="_blank" data-tooltip="tooltip" title="업데이트 내역 보기"><?php echo $var1[0]?>_<?php echo $var1[1]?></a>
							<?php else:?>
							<a href="#." data-tooltip="tooltip" title="정보가 없는 없데이트입니다"><?php echo $var1[0]?>_<?php echo $var1[1]?></a>
							<?php endif?>
							&nbsp;
							<a href="http://<?php echo $_serverinfo[2]?>/__update/files/v2/<?php echo $var1[1]?>.zip" class="rb-update-download" data-tooltip="tooltip" title="파일 다운로드"><i class="glyphicon glyphicon-download-alt"></i></a>
						</span>
					</td>
					<td></td>
					<td>
						<button class="btn btn-default disabled">
							<i class="glyphicon glyphicon-pause"></i> 미적용
						</button>
					</td>
					<td>
						<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;a=update&amp;type=auto&amp;ufile=<?php echo $var1[1]?>" onclick="return hrefCheck(this,true,'정말로 업데이트 하시겠습니까?');" class="btn btn-primary"><i class="glyphicon glyphicon-download-alt"></i> 원격 업데이트</a>
						<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;a=update&amp;type=manual&amp;ufile=<?php echo $var1[1]?>" onclick="return hrefCheck(this,true,'정말로 수동으로 업데이트 처리하시겠습니까?\n수동 업데이트 처리시 원격업데이트는 건너뜁니다.');" class="btn btn-primary"><i class="glyphicon glyphicon-import"></i> 수동 업데이트</a>
					</td>
				</tr>

				<?php endif?>
				<?php endfor?>
				<?php if(!$_updatelength):?>
				<tr>
				<td colspan="5">업데이트 대기리스트가 없습니다.</td>
				</tr>
				<?php endif?>
			</tbody>
		</table>

		<?php if($TPG>1):?>
		<div class="text-center">
			<ul class="pagination">
			<script>getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'');</script>
			<?php //echo getPageLink(10,$p,$TPG,'')?>
			</ul>
		</div>
		<?php endif?>

	</div>


	<div class="well">
		<p class="clearfix">
			<i class="fa fa-question-circle fa-lg"></i>
			<strong>원격 업데이트 도움말</strong>
		</p>

		<ul>
		<li>원격 업데이트는 킴스큐의 코어 및 관련 파일들을 항상 최신의 상태로 유지할 수 있는 시스템입니다.</li>
		<li>그러나 사용자가 직접 수정하거나 커스터마이징 한 사항이 업데이트 내역에 포함되어 있을 경우 해당사항이 덧씌워 지므로 이 경우 반드시 수작업으로 패치한 후 수동 업데이트를 클릭해 주어야 합니다.</li>
		<li>정상적으로 업데이트 되지 않았거나 재 업데이트를 원하시면 기록을 제거한 후 재시도해 주세요.</li>
		<li>이 작업은 데이터의 용량이나 처리내용에 따라서 다소 시간이 걸릴 수 있습니다.</li>
		</ul>
	</div>
</div>
