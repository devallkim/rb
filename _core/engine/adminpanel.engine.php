<?php
if (!defined('__KIMS__') || !$my['admin']) exit;
$_MODULES = array();
$_MODULES_ALL = getDbArray($table['s_module'],'','*','gid','asc',0,1);
while($_R = db_fetch_array($_MODULES_ALL))
{
	$_MODULES['display'][] = $_R;
	$_MODULES['disp'.$_R['hidden']][] = $_R;
}

$_SITES = array();
$_SITES['list'] = array();
$_SITES_ALL = getDbArray($table['s_site'],'','*','gid','asc',0,1);
while($_R = db_fetch_array($_SITES_ALL))
{
	$_SITES['list'][] = $_R;
	$_SITES['count'.$_R['s004']]++;
}
$d['layout']['dom'] = array();
$_nowlayuotdir = dirname($_SESSION['setLayoutKind']?$_HS['m_layout']:$_HS['layout']);
$g['layoutVarForSite'] = $g['path_layout'].$_nowlayuotdir.'/_var/_var.'.$r.'.php';
$g['themelang1'] = $g['path_layout'].$_nowlayuotdir.'/_var/_var.config.php';
$g['themelang2'] = $g['path_layout'].$_nowlayuotdir.'/_languages/_var.config.'.$d['admin']['syslang'].'.php';
$g['layvarfile'] = is_file($g['layoutVarForSite']) ? $g['layoutVarForSite'] : $g['path_layout'].$_nowlayuotdir.'/_var/_var.php';
include getLangFile($g['path_module'].'admin/language/',$d['admin']['syslang'],'/lang.panel.php');
if (is_file($g['themelang2'])) include $g['themelang2'];
else if (is_file($g['themelang1'])) include $g['themelang1'];
if (is_file($g['layvarfile'])) include $g['layvarfile'];
$g['wcache'] = $d['admin']['cache_flag']?'?nFlag='.$date[$d['admin']['cache_flag']]:'';

//사이트별 매니페스트
$g['manifestForSite'] = $g['path_var'].'site/'.$r.'/manifest.json'; // 사이트 회원모듈 변수파일
$_manifestfile = file_exists($g['manifestForSite']) ? $g['manifestForSite'] : $g['path_module'].'site/var/manifest.json';
$mf_str = file_get_contents($_manifestfile);
$mf_json = json_decode($mf_str , true);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta name="robots" content="NOINDEX,NOFOLLOW">
<title>킴스큐 관리모드 (Rb V <?php echo $d['admin']['version']?>)</title>

<?php getImport('bootstrap','css/bootstrap.min','4.1.3','css')?>

<?php getImport('jquery','jquery.min','3.3.1','js')?>
<?php getImport('popper.js','umd/popper.min','1.14.0','js')?>
<?php getImport('bootstrap','js/bootstrap.min','4.1.3','js')?>

<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $g['s']?>/_core/images/ico/apple-touch-icon-144-precomposed.png">
<link rel="shortcut icon" href="<?php echo $g['s']?>/_core/images/ico/favicon.ico">

<?php getImport('font-awesome','css/font-awesome','4.7.0','css')?>
<?php getImport('font-kimsq','css/font-kimsq',false,'css')?>

<link href="<?php echo $g['s']?>/_core/engine/adminpanel/main.css" rel="stylesheet">
<link href="<?php echo $g['s']?>/_core/engine/adminpanel/theme/<?php echo $d['admin']['pannellink']?>" rel="stylesheet">

<script>
	var rooturl = '<?php echo $g['url_root']?>';
	var rootssl = '<?php echo $g['ssl_root']?>';
	var raccount= '<?php echo $r?>';
	var moduleid= '<?php echo $m?>';
	var memberid= '<?php echo $my['id']?>';
	var is_admin= '<?php echo $my['admin']?>';
</script>

<script src="<?php echo $g['s']?>/_core/js/sys.js<?php echo $g['wcache']?>"></script>
</head>

<body>
<div class="container-fluid rb-fixed-sidebar<?php if($_COOKIE['_tabShow1']):?> rb-minified-sidebar<?php endif?><?php if($_COOKIE['_tabShow2']):?> rb-hidden-system-admin<?php endif?><?php if($_COOKIE['_tabShow3']):?> rb-hidden-system-site<?php endif?>">
	<div class="rb-system-sidebar rb-system-admin rb-inverse" role="navigation">
		<div class="rb-icons">
			<span class="rb-icon-hide js-tooltip" title="<?php echo $_COOKIE['_tabShow2']?'고정하기':'숨기기'?>"><i class="fa rb-icon"></i></span>
			<span class="rb-icon-minify js-tooltip" title="<?php echo $_COOKIE['_tabShow1']?'펼치기':'접기'?>"><i class="fa rb-icon"></i></span>
		</div>
		<div class="login-info">
			<span class="dropdown">
				<a href="#" class="rb-username" data-toggle="dropdown">
					<?php if ($my['photo']): ?>
					<img class="rounded-circle" data-role="avatar" src="<?php echo $g['s']?>/_core/opensrc/timthumb/thumb.php?src=/_var/avatar/<?php echo $my['photo']?>&w=50&h=50&s=1" width="25">
					<?php else: ?>
					<img class="rounded-circle" data-role="avatar" src="<?php echo $g['s']?>/_var/avatar/0.svg" width="25">
					<?php endif; ?>
					<span><?php echo $my[$_HS['nametype']]?></span>
					<small id="rb-notification-name"></small>
				</a>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a href="#" data-toggle="modal" data-target="#modal_window" class="dropdown-item rb-modal-profile"><i class="fa fa-user"></i> 프로필관리</a></li>
					<a href="#" data-toggle="modal" data-target="#modal_window" class="dropdown-item rb-modal-log"><i class="fa fa-clock-o"></i> 접속기록</a></li>
					<a href="#" data-toggle="modal" data-target="#modal_window" class="dropdown-item rb-modal-notification">
						<i class="kf kf-notify"></i> 알림 <small id="rb-notification-badge" class="badge badge-light pull-right"></small>
					</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;a=logout"><i class="fa fa-sign-out"></i> 로그아웃</a>
				</div>
			</span>
		</div>
		<div class="tabs-below">
			<div class="rb-buttons rb-content-padded">
				<div class="btn-toolbar" role="toolbar">
					<div class="dropdown js-tooltip" title="만들기">
						<button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-plus fa-2x"></i></button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=site&amp;type=makesite" target="_ADMPNL_"><i class="fa fa-home"></i> 새 사이트</a>
							<a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=site&amp;front=menu" target="_ADMPNL_"><i class="fa fa-sitemap"></i> 새 메뉴</a>
							<a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=site&amp;front=page" target="_ADMPNL_"><i class="fa fa-file-text-o"></i> 새 페이지</a>
							<a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;a=clear_wcache" target="_ACTION_"><i class="fa fa-refresh"></i> 캐시 재생성</a>
						</div>
					</div>

					<div class="dropdown js-tooltip" title="각종도구">
						<button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-tasks fa-2x"></i></button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a href="#" data-toggle="modal" data-target="#modal_window" class="dropdown-item rb-modal-photo"><i class="fa fa-photo"></i> 포토셋</a>
							<a href="#" data-toggle="modal" data-target="#modal_window" class="dropdown-item rb-modal-video"><i class="fa fa-video-camera"></i> 비디오셋</a>
							<a href="#" data-toggle="modal" data-target="#modal_window" class="dropdown-item rb-modal-widgetcode"><i class="fa fa-puzzle-piece"></i> 위젯코드</a>
							<a href="#" data-toggle="modal" data-target="#modal_window" class="dropdown-item rb-modal-snippet"><i class="fa fa-scissors" style="width:12px"></i> 스니핏</a>
							<a href="//kimsq.com/docs" class="dropdown-item" target="_blank"><i class="fa fa-book" style="width:12px"></i> 도움말</a>
						</div>
					</div>
					<div class="btn-group">
						<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=dashboard" target="_ADMPNL_" class="btn btn-link js-tooltip" title="대시보드"><i class="fa fa-dashboard fa-2x"></i></a>
						<a href="<?php echo $g['s']?>/?r=<?php echo $r?>" target="_ADMPNL_" class="btn btn-link js-tooltip" title="홈페이지"><i class="fa fa-home fa-2x"></i></a>
					</div>
				</div>
			</div>
			<div class="rb-buttons rb-content-padded">
				<div class="btn-group">
					<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=project&amp;front=gallery" target="_ADMPNL_" class="btn btn-light rb-modal-add-package" style="width:165px"><i class="fa fa-plus-circle fa-lg"></i> 패키지 갤러리</a>
					<button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-caret-down" aria-hidden="true"></i>
					</button>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
						<h6 class="dropdown-header">확장요소 추가하기</h6>
						<a href="#" data-toggle="modal" data-target="#modal_window" class="dropdown-item rb-modal-add-package">패키지</a>
						<a href="#" data-toggle="modal" data-target="#modal_window" class="dropdown-item rb-modal-add-module">모듈</a>
						<a href="#" data-toggle="modal" data-target="#modal_window" class="dropdown-item rb-modal-add-layout">레이아웃</a>
						<a href="#" data-toggle="modal" data-target="#modal_window" class="dropdown-item rb-modal-add-widget">위젯</a>
						<a href="#" data-toggle="modal" data-target="#modal_window" class="dropdown-item rb-modal-add-switch">스위치</a>
						<a href="#" data-toggle="modal" data-target="#modal_window" class="dropdown-item rb-modal-add-plugin">플러그인</a>
						<a href="#" data-toggle="modal" data-target="#modal_window" class="dropdown-item rb-modal-add-dashboard">대시보드</a>
						<a href="#" data-toggle="modal" data-target="#modal_window" class="dropdown-item rb-modal-add-etc">기타자료</a>
					</div>
				</div>
			</div>

			<div class="tab-content">
				<div class="tab-pane<?php if(!$_COOKIE['sideBottomTab']||$_COOKIE['sideBottomTab']=='quick'):?> active<?php endif?>" id="sidebar-quick">
					<nav>
						<ul class="list-group" id="sidebar-quick-tree">
							<?php $_i=0;$d['amenu']=array()?>
							<?php foreach($_MODULES['disp0'] as $_SM1):?>
							<?php if(strpos('_'.$my['adm_view'],'['.$_SM1['id'].']')) continue?>
							<?php include getLangFile($g['path_module'].$_SM1['id'].'/language/',$d['admin']['syslang'],'/lang.admin-menu.php')?>
							<?php $d['afile']=$g['path_module'].$_SM1['id'].'/admin/var/var.menu.php'?>
							<?php if(is_file($d['afile'])) include $d['afile'] ?>
							<li id="sidebar-quick-<?php echo $_SM1['id']?>" class="list-group-item panel">
								<a<?php if(!is_file($d['afile'])):?> href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=<?php echo $_SM1['id']?>" target="_ADMPNL_"<?php else:?> data-toggle="collapse" href="#sidebar-quick-tree-<?php echo $_SM1['id']?>"<?php endif?> class="collapsed" onclick="_quickSelect('<?php echo $_SM1['id']?>');">
									<i class="<?php echo $_SM1['icon']?$_SM1['icon']:'fa fa-th-large'?>"></i>
									<span class="menu-item-parent"><?php echo $_SM1['name']?></span>
									<?php if(is_file($d['afile'])):?><b class="collapse-sign"><em class="fa rb-icon"></em></b><?php endif?>
								</a>
								<?php if(count($d['amenu'])):?>
								<ul id="sidebar-quick-tree-<?php echo $_SM1['id']?>" class="collapse" data-parent="#sidebar-quick-tree">
								<?php foreach($d['amenu'] as $_k => $_v):?>
									<li id="sidebar-quick-tree-<?php echo $_SM1['id']?>-<?php echo $_k?>">
										<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&module=<?php echo $_SM1['id']?>&amp;front=<?php echo $_k?>" target="_ADMPNL_" onclick="_quickSelect1('<?php echo $_SM1['id']?>','<?php echo $_k?>');"><?php echo $_v?></a>
									</li>
								<?php endforeach?>
								</ul>
								<?php endif;$d['amenu']=array()?>
							</li>
							<?php endforeach?>
						</ul>
					</nav>
				</div>
				<div class="tab-pane<?php if($_COOKIE['sideBottomTab']=='modules'):?> active<?php endif?>" id="sidebar-modules">
					<nav>
						<ul class="list-group">
							<?php $_i=0?>
							<?php foreach($_MODULES['display'] as $_SM1):?>
							<?php if(strpos('_'.$my['adm_view'],'['.$_SM1['id'].']')) continue?>
							<li id="sidebar-modules-<?php echo $_SM1['id']?>" class="list-group-item panel">
								<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&m=admin&module=<?php echo $_SM1['id']?>" target="_ADMPNL_" class="collapsed" onclick="_moduleSelect('<?php echo $_SM1['id']?>');">
									<i class="<?php echo $_SM1['icon']?$_SM1['icon']:'fa fa-th-large'?>"></i>
									<span class="menu-item-parent"><?php echo $_SM1['name']?></span>
								</a>
							</li>
							<?php endforeach?>
						</ul>
					</nav>
				</div>
				<div class="tab-pane<?php if($_COOKIE['sideBottomTab']=='sites'):?> active<?php endif?>" id="sidebar-sites">
					<nav>
						<ul class="list-group">
							<?php foreach($_SITES['list'] as $S):?>
							<li id="sidebar-sites-<?php echo $S['id']?>" class="list-group-item<?php if($r==$S['id']):?> active<?php endif?>">
								<span class="pull-right rb-blank"><a href="<?php echo $g['s']?>/?r=<?php echo $S['id']?>&amp;panel=N" target="_blank" class="btn btn-link btn-sm js-tooltip"><i class="fa fa-share" title="새창"></i></a></span>
								<a href="<?php echo $g['s']?>/?r=<?php echo $S['id']?>&amp;panel=Y" class="rb-inframe">
									<i class="<?php echo $S['icon']?$S['icon']:'fa fa-home'?>"></i>
									<span class="menu-item-parent"><?php echo $S['label']?></span>
									<?php if($S['s004']==2):?><span class="badge pull-right inbox-badge"><i class="fa fa-lock"></i></span><?php endif?>
									<?php if($S['s004']==3):?><span class="badge pull-right inbox-badge"><i class="fa fa-lock"></i></span><?php endif?>
								</a>
							</li>
							<?php endforeach?>
						</ul>
					</nav>
				</div>
			</div>
			<ul class="nav nav-tabs nav-fill" role="tablist">
				<li class="nav-item">
					<a href="#sidebar-quick" class="nav-link js-tooltip<?php if(!$_COOKIE['sideBottomTab']||$_COOKIE['sideBottomTab']=='quick'):?> active<?php endif?>" role="tab" data-toggle="tab" title="퀵패널" onclick="_cookieSetting('sideBottomTab','quick');">
						<i class="kf kf-bi-05 fa-2x"></i>
					</a>
				</li>
				<li class="nav-item">
					<a href="#sidebar-modules" role="tab" data-toggle="tab" title="모듈패널" class="nav-link js-tooltip<?php if($_COOKIE['sideBottomTab']=='modules'):?> active<?php endif?>">
						<i class="kf kf-module fa-2x" onclick="_cookieSetting('sideBottomTab','modules');"></i>
					</a>
				</li>
				<li class="nav-item">
					<a href="#sidebar-sites" role="tab" data-toggle="tab" title="사이트패널" class="nav-link js-tooltip<?php if($_COOKIE['sideBottomTab']=='sites'):?> active<?php endif?>" onclick="_cookieSetting('sideBottomTab','sites');">
						<i class="kf kf-home fa-2x"></i>
					</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="rb-system-main" role="main">
		<div class="rb-full-overlay">
			<div id="site-preview" class="rb-full-overlay-main">
				<div class="rb-table">
					<div class="rb-table-cell">
						<?php if($_admpnl_):?>
						<iframe id="_ADMPNL_" name="_ADMPNL_" src="<?php echo urldecode($_admpnl_)?>"></iframe>
						<?php else:?>
						<iframe id="_ADMPNL_" name="_ADMPNL_" src="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo ($pickmodule?'admin&amp;module='.$pickmodule:$m)?><?php echo $pickfront?'&amp;front='.$pickfront:'' ?>"></iframe>
						<?php endif?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="rb-system-sidebar rb-system-site rb-default" role="application">
		<div class="rb-opener" role="button"><i class="fa fa-caret-left fa-lg"></i></div>
		<div class="rb-panel-top">
			<span class="rb-icon-hide js-tooltip" title="<?php echo $_COOKIE['_tabShow3']?'고정하기':'숨기기'?>"><i class="fa rb-icon"></i></span>
		</div>
		<div class="rb-content-padded">

			<ul class="nav nav-tabs nav-fill">
				<li class="nav-item">
					<a class="nav-link<?php if($_COOKIE['rightAdmTab']=='site'||!$_COOKIE['rightAdmTab']):?> active<?php endif?>" href="#site-settings" role="tab" data-toggle="tab" onclick="_cookieSetting('rightAdmTab','site');">
						사이트
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link<?php if($_COOKIE['rightAdmTab']=='layout'):?> active<?php endif?>" href="#layout-settings" role="tab" data-toggle="tab" onclick="_cookieSetting('rightAdmTab','layout');">
						레이아웃
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link<?php if($_COOKIE['rightAdmTab']=='emulator'):?> active<?php endif?>" href="#device-emulator" role="tab" data-toggle="tab" onclick="_cookieSetting('rightAdmTab','emulator');">
						애뮬레이터
					</a>
				</li>
			</ul>

			<div class="tab-content" style="padding-top:15px;">
				<div class="tab-pane<?php if($_COOKIE['rightAdmTab']=='site'||!$_COOKIE['rightAdmTab']):?> active<?php endif?><?php if(!$_HS['uid']):?> hidden<?php endif?>" id="site-settings">

						<div class="panel-group rb-scrollbar" id="site-settings-panels">

							<div class="card" id="site-settings-manifest" style="margin-bottom: 5px">
								<div class="card-header">
									<a class="collapsed" data-toggle="collapse" href="#site-settings-manifest-body"><i></i>매니페스트</a>
								</div>
								<div class="card-body panel-collapse collapse" id="site-settings-manifest-body" data-parent="#site-settings-panels">
									<form action="<?php echo $g['s']?>/" method="post" enctype="multipart/form-data" target="_ACTION_">
										<input type="hidden" name="r" value="<?php echo $r?>">
										<input type="hidden" name="m" value="site">
										<input type="hidden" name="a" value="regisSiteManifest">
										<input type="hidden" name="site_uid" value="<?php echo $_HS['uid']?>">

										<div class="form-group">
											<label>앱 짧은 이름</label>
											<input type="text" class="form-control" name="site_manifest_short_name" value="<?php echo $mf_json['short_name'] ?>">
										</div>

										<div class="form-group">
											<label>앱 이름</label>
											<input type="text" class="form-control" name="site_manifest_name" value="<?php echo $mf_json['name'] ?>">
										</div>

										<?php
										$_manifestIcon_png = $g['path_var'].'site/'.$r.'/homescreen.png';
										$_manifestIcon_jpg = $g['path_var'].'site/'.$r.'/homescreen.jpg';
										$_manifestIcon_gif = $g['path_var'].'site/'.$r.'/homescreen.gif';
										if (file_exists($_manifestIcon_png) || file_exists($_manifestIcon_jpg) || file_exists($_manifestIcon_gif)) {
											$is_manifestIcon = ture;
										}
										?>

										<div class="form-group">
											<label>아이콘 (png,192x192 이상)</label>
											<div class="input-group">
												<input type="text" class="form-control" id="site_manifest_icon_name" value="<?php echo $is_manifestIcon?'등록됨':'' ?>" onclick="$('#site_manifest_icon').click();">
												<input type="file" class="d-none" name="site_manifest_icon" id="site_manifest_icon" onchange="getId('site_manifest_icon_name').value='파일 선택됨';">
												<span class="input-group-append">
													<button class="btn btn-light" type="button" onclick="$('#site_manifest_icon').click();">
														<i class="fa fa-picture-o"></i>
													</button>
												</span>
											</div>

											<?php if ($is_manifestIcon): ?>
											<div style="padding:3px 0 0 2px;"><input type="checkbox" name="site_manifest_icon_del" value="1"> 현재파일 삭제</div>
											<?php endif; ?>

										</div>

										<div class="form-group">
											<label>배경 색상</label>
											<div class="input-group">
												<input type="text" class="form-control" name="site_manifest_background_color" id="site_manifest_background_color" value="<?php echo $mf_json['background_color'] ?>">
												<span class="input-group-append">
													<button class="btn btn-light" type="button" data-toggle="modal" data-target=".bs-example-modal-sm" onclick="getColorLayer(getId('site_manifest_background_color').value.replace('#',''),'site_manifest_background_color');">
													<i class="fa fa-tint"></i>
													</button>
												</span>
											</div>
										</div>

										<div class="form-group">
											<label>테마 색상</label>
											<div class="input-group">
												<input type="text" class="form-control" name="site_manifest_theme_color" id="site_manifest_theme_color" value="<?php echo $mf_json['theme_color'] ?>">
												<span class="input-group-append">
													<button class="btn btn-light" type="button" data-toggle="modal" data-target=".bs-example-modal-sm" onclick="getColorLayer(getId('site_manifest_theme_color').value.replace('#',''),'site_manifest_theme_color');">
													<i class="fa fa-tint"></i>
													</button>
												</span>
											</div>
										</div>
										<div class="form-group">
											<label>디스플레이 유형</label>
											<select name="site_manifest_display" class="form-control custom-select">
												<option value="standalone"<?php echo $mf_json['display']=='standalone'?' selected':'' ?>>Standalone</option>
												<option value="fullscreen"<?php echo $mf_json['display']=='fullscreen'?' selected':'' ?>>fullscreen</option>
												<option value="minimal-ui"<?php echo $mf_json['display']=='minimal-ui'?' selected':'' ?>>minimal-ui</option>
												<option value="browser"<?php echo $mf_json['display']=='browser'?' selected':'' ?>>Browser</option>
											</select>
										</div>
										<div class="form-group">
											<label>초기 방향</label>
											<select name="site_manifest_orientation" class="form-control custom-select">
												<option value=""<?php echo !$mf_json['orientation']?' selected':'' ?>>Potrait</option>
												<option value="landscape"<?php echo $mf_json['orientation']=='landscape'?' selected':'' ?>>Landscape</option>
											</select>
										</div>

										<button type="submit" class="btn btn-outline-primary btn-block">저장하기</button>
									</form>

									<p class="mt-3 mb-0 small">웹앱을 위한 <a href="https://developers.google.com/web/fundamentals/web-app-manifest/?hl=ko&authuser=0" target="_blank">매니페스트</a> 파일을 구성합니다.</p>

								</div>
							</div>


							<form action="<?php echo $g['s']?>/" method="post" target="_ACTION_" onsubmit="return _siteInfoSaveCheck(this);">
								<input type="hidden" name="r" value="<?php echo $r?>">
								<input type="hidden" name="m" value="site">
								<input type="hidden" name="a" value="regissitepanel" />
								<input type="hidden" name="site_uid" value="<?php echo $_HS['uid']?>">
								<input type="hidden" name="layout" value="">
								<input type="hidden" name="m_layout" value="">
								<input type="hidden" name="referer" value="">

								<div class="card" id="site-settings-01">
									<div class="card-header">
										<a class="collapsed" data-toggle="collapse" href="#site-settings-01-body">
											<i></i>기본정보
										</a>
									</div>
									<div class="card-body panel-collapse collapse" id="site-settings-01-body" data-parent="#site-settings-panels">
										<div class="form-group">
											<label>사이트 라벨</label>
											<input type="text" class="form-control" name="label" value="<?php echo $_HS['label']?>">
										</div>
										<div class="form-group">
											<label>사이트 명</label>
											<input type="text" class="form-control" name="name" value="<?php echo $_HS['name']?>">
										</div>
										<div class="form-group">
											<label>사이트 코드</label>
											<input type="text" class="form-control" name="id" value="<?php echo $_HS['id']?>">
										</div>
										<div class="form-group">
											<label>타이틀 구성</label>
											<input type="text" class="form-control" name="title" value="<?php echo $_HS['title']?>">
											<span class="form-text text-muted"><small>입력된 내용은 브라우저의 타이틀로 사용됩니다. 치환코드는 매뉴얼을 참고하세요.</small></span>
										</div>
										<button type="submit" class="btn btn-outline-primary btn-block">저장하기</button>
									</div>
								</div>

								<div class="card panel-default" id="site-settings-02">
									<div class="card-header">
										<a class="collapsed" data-toggle="collapse" href="#site-settings-02-body"><i></i>레이아웃</a>
									</div>
									<div id="site-settings-02-body" class="panel-collapse collapse" data-parent="#site-settings-panels">
										<div class="card-body">
											<div class="form-group">
												<label>기본</label>
												<div id="rb-layout-select">
													<select class="form-control custom-select" name="layout_1" required onchange="getSubLayout(this,'rb-layout-select2','layout_1_sub','');">
														<?php $_layoutExp1=explode('/',$_HS['layout'])?>
														<?php $dirs = opendir($g['path_layout'])?>
														<?php $_i=0;while(false !== ($tpl = readdir($dirs))):?>
														<?php if($tpl=='.' || $tpl == '..' || $tpl == '_blank' || is_file($g['path_layout'].$tpl))continue?>
														<?php if(!$_i&&!$_HS['layout']) $_layoutExp1[0] = $tpl?>
														<option value="<?php echo $tpl?>"<?php if($_layoutExp1[0]==$tpl):?> selected<?php endif?>><?php echo getFolderName($g['path_layout'].$tpl)?>(<?php echo $tpl?>)</option>

														<?php $_i++;endwhile?>
														<?php closedir($dirs)?>
													</select>
												</div>
												<div id="rb-layout-select2" style="margin-top:5px;">
													<select class="form-control custom-select" name="layout_1_sub"<?php if(!$_layoutExp1[0]):?> disabled<?php endif?>>
														<?php $dirs1 = opendir($g['path_layout'].$_layoutExp1[0])?>
														<?php while(false !== ($tpl1 = readdir($dirs1))):?>
														<?php if(!strstr($tpl1,'.php') || $tpl1=='_main.php')continue?>
														<option value="<?php echo $tpl1?>"<?php if($_layoutExp1[1]==$tpl1):?> selected<?php endif?>><?php echo str_replace('.php','',$tpl1)?></option>
														<?php endwhile?>
														<?php closedir($dirs1)?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label>모바일 전용</label>
												<div id="rb-mlayout-select">
													<select class="form-control custom-select" name="m_layout_1" required onchange="getSubLayout(this,'rb-mlayout-select2','m_layout_1_sub','');">
														<option value="0">사용안함</option>
														<?php $_layoutExp2=explode('/',$_HS['m_layout'])?>
														<?php $dirs = opendir($g['path_layout'])?>
														<?php while(false !== ($tpl = readdir($dirs))):?>
														<?php if($tpl=='.' || $tpl == '..' || $tpl == '_blank' || is_file($g['path_layout'].$tpl))continue?>
														<option value="<?php echo $tpl?>"<?php if($_layoutExp2[0]==$tpl):?> selected<?php endif?>><?php echo getFolderName($g['path_layout'].$tpl)?>(<?php echo $tpl?>)</option>
														<?php endwhile?>
														<?php closedir($dirs)?>
													</select>
												</div>
												<div id="rb-mlayout-select2" style="margin-top:5px;">
													<select class="form-control custom-select" name="m_layout_1_sub"<?php if(!$_HS['m_layout']):?> disabled<?php endif?>>
														<?php if(!$_HS['m_layout']):?><option>서브 레이아웃</option><?php endif?>
														<?php $dirs1 = opendir($g['path_layout'].$_layoutExp2[0])?>
														<?php while(false !== ($tpl1 = readdir($dirs1))):?>
														<?php if(!strstr($tpl1,'.php') || $tpl1=='_main.php')continue?>
														<option value="<?php echo $tpl1?>"<?php if($_layoutExp2[1]==$tpl1):?> selected<?php endif?>><?php echo str_replace('.php','',$tpl1)?></option>
														<?php endwhile?>
														<?php closedir($dirs1)?>
													</select>
												</div>
											</div>
											<button type="submit" class="btn btn-outline-primary btn-block">저장하기</button>
										</div>
									</div>
								</div>

								<div class="card panel-default" id="site-settings-03">
									<div class="card-header">
										<a class="collapsed" data-toggle="collapse" href="#site-settings-03-body"><i></i>메인페이지</a>
									</div>
									<div id="site-settings-03-body" class="panel-collapse collapse" data-parent="#site-settings-panels">
										<div class="card-body">
											<div class="form-group">
												<label>모바일 전용</label>
												<select name="startpage" class="form-control custom-select">
												<option>레이아웃에 포함된 메인페이지</option>
												<option disabled><i class="fa fa-edit"></i>페이지 리스트 ↓</option>
												<?php $PAGES1 = getDbArray($table['s_page'],'site='.$s.' and ismain=1','*','uid','asc',0,1)?>
												<?php while($S = db_fetch_array($PAGES1)):?>
												<option value="<?php echo $S['uid']?>"<?php if($_HS['startpage']==$S['uid']):?> selected<?php endif?>><?php echo $S['name']?>(<?php echo $S['id']?>)</option>
												<?php endwhile?>
												</select>
											</div>
											<div class="form-group">
												<label>모바일 전용</label>
												<select name="m_startpage" class="form-control custom-select">
												<option>레이아웃에 포함된 메인페이지</option>
												<option disabled><i class="fa fa-edit"></i>페이지 리스트 ↓</option>
												<?php $PAGES2 = getDbArray($table['s_page'],'site='.$s.' and mobile=1','*','uid','asc',0,1)?>
												<?php while($S = db_fetch_array($PAGES2)):?>
												<option value="<?php echo $S['uid']?>"<?php if($_HS['m_startpage']==$S['uid']):?> selected<?php endif?>><?php echo $S['name']?>(<?php echo $S['id']?>)</option>
												<?php endwhile?>
												</select>
											</div>
											<button type="submit" class="btn btn-outline-primary btn-block">저장하기</button>
										</div>
									</div>
								</div>

								<div class="card panel-default" id="site-settings-04">
									<div class="card-header">
										<a class="collapsed" data-toggle="collapse" href="#site-settings-04-body"><i></i>고급설정</a>
									</div>
									<div id="site-settings-04-body" class="panel-collapse collapse" data-parent="#site-settings-panels">
										<div class="card-body">
											<div class="form-group">
												<label>도메인</label>
												<ul class="list-unstyled">
													<?php $DOMAINS = getDbArray($table['s_domain'],'site='.$_HS['uid'],'*','gid','asc',0,1)?>
													<?php $DOMAINN = db_num_rows($DOMAINS)?>
													<?php if($DOMAINN):?>
													<?php while($D=db_fetch_array($DOMAINS)):?>
													<li><a href="http://<?php echo $D['name']?>" target="_blank"><?php echo $D['name']?></a></li>
													<?php endwhile?>
													<?php else:?>
													<li>
														<small class="text-muted">연결된 도메인이 없습니다.
														<a class="muted-link" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=domain&amp;selsite=<?php echo $_HS['uid']?>&amp;type=makedomain" target="_ADMPNL_">
															추가하기
														</a>
														</small>
													</li>
													<?php endif?>
												</ul>
											</div>
											<div class="form-group">
												<label>서비스 상태</label>
												<select name="open" class="form-control custom-select">
												<option value="1"<?php if($_HS['s004']=='1'):?> selected="selected"<?php endif?>>정상서비스</option>
												<option value="2"<?php if($_HS['s004']=='2'):?> selected="selected"<?php endif?>>관리자오픈</option>
												<option value="3"<?php if($_HS['s004']=='3'):?> selected="selected"<?php endif?>>정지</option>
												</select>
											</div>
											<button type="submit" class="btn btn-outline-primary btn-block">저장하기</button>
										</div>
									</div>
								</div>

							</form>
						</div>




					<div class="bg-light rb-tab-pane-bottom">
						<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=site" target="_ADMPNL_" class="btn btn-light btn-block">자세히</a>
					</div>
				</div>

				<div class="tab-pane<?php if($_COOKIE['rightAdmTab']=='layout'):?> active<?php endif?><?php if(!$_HS['uid']):?> hidden<?php endif?>" id="layout-settings">
					<form action="<?php echo $g['s']?>/" method="post" enctype="multipart/form-data" target="_ACTION_" onsubmit="return _layoutInfoSaveCheck(this);">
						<input type="hidden" name="r" value="<?php echo $r?>">
						<input type="hidden" name="m" value="site">
						<input type="hidden" name="a" value="regislayoutpanel">
						<input type="hidden" name="site_uid" value="<?php echo $_HS['uid']?>">
						<input type="hidden" name="layout" value="<?php echo $_nowlayuotdir?>">
						<input type="hidden" name="themelang1" value="<?php echo $g['themelang1']?>">
						<input type="hidden" name="themelang2" value="<?php echo $d['admin']['syslang']=='DEFAULT'||!is_file($g['themelang2'])?'':$g['themelang2']?>">

					<div class="panel-group rb-scrollbar" id="layout-settings-panels">
						<?php $_i=1;foreach($d['layout']['dom'] as $_key => $_val):$__i=sprintf('%02d',$_i)?>
						<div class="card" id="layout-settings-<?php echo $__i?>">
							<div class="card-header">
								<a class="collapsed" data-toggle="collapse" href="#layout-settings-<?php echo $__i?>-body">
									<i></i><?php echo $_val[0]?>
								</a>
							</div>
							<div class="card-body panel-collapse collapse f13" id="layout-settings-<?php echo $__i?>-body" data-parent="#layout-settings-panels">
								<p><?php echo $_val[1]?></p>

								<?php if(count($_val[2])):?>
								<?php foreach($_val[2] as $_v):?>
								<div class="form-group">
									<?php if($_v[1]!='hidden'):?>
									<label><?php echo $_v[2]?></label>
									<?php endif?>

									<?php if($_v[1]=='hidden'):?>
									<input type="hidden" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" value="<?php echo $d['layout'][$_key.'_'.$_v[0]]?>">
									<?php endif?>

									<?php if($_v[1]=='input'):?>
									<input type="text" class="form-control" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" value="<?php echo stripslashes($d['layout'][$_key.'_'.$_v[0]])?>">
									<?php endif?>

									<?php if($_v[1]=='color'):?>
									<div class="input-group">
										<input type="text" class="form-control" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" id="layout_<?php echo $_key?>_<?php echo $_v[0]?>" value="<?php echo $d['layout'][$_key.'_'.$_v[0]]?>">
										<span class="input-group-append">
											<button class="btn btn-light" type="button" data-toggle="modal" data-target=".bs-example-modal-sm" onclick="getColorLayer(getId('layout_<?php echo $_key?>_<?php echo $_v[0]?>').value.replace('#',''),'layout_<?php echo $_key?>_<?php echo $_v[0]?>');"><i class="fa fa-tint"></i></button>
										</span>
									</div>
									<?php endif?>

									<?php if($_v[1]=='date'):?>
									<div class="input-group input-daterange">
										<input type="text" class="form-control" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" id="layout_<?php echo $_key?>_<?php echo $_v[0]?>" value="<?php echo $d['layout'][$_key.'_'.$_v[0]]?>">
										<span class="input-group-append">
											<button class="btn btn-light" type="button" onclick="getCalCheck('<?php echo $_key?>_<?php echo $_v[0]?>');"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
									<?php endif?>

									<?php if($_v[1]=='mediaset'):?>
									<div class="input-group">
										<input type="text" class="form-control rb-modal-photo-drop js-tooltip" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" id="layout_<?php echo $_key?>_<?php echo $_v[0]?>" value="<?php echo $d['layout'][$_key.'_'.$_v[0]]?>" onmousedown="_mediasetField='layout_<?php echo $_key?>_<?php echo $_v[0]?>&dfiles='+this.value;" title="선택된 사진" data-toggle="modal" data-target="#modal_window">
										<span class="input-group-append">
											<button onmousedown="_mediasetField='layout_<?php echo $_key?>_<?php echo $_v[0]?>';" class="btn btn-light rb-modal-photo-drop js-tooltip" type="button" title="포토셋" data-toggle="modal" data-target="#modal_window"><i class="fa fa-picture-o"></i></button>
										</span>
									</div>
									<?php endif?>

									<?php if($_v[1]=='videoset'):?>
									<div class="input-group">
										<input type="text" class="form-control rb-modal-video-drop js-tooltip" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" id="layout_<?php echo $_key?>_<?php echo $_v[0]?>" value="<?php echo $d['layout'][$_key.'_'.$_v[0]]?>" onmousedown="_mediasetField='layout_<?php echo $_key?>_<?php echo $_v[0]?>&dfiles='+this.value;" title="선택된 비디오" data-toggle="modal" data-target="#modal_window">
										<span class="input-group-append">
											<button onmousedown="_mediasetField='layout_<?php echo $_key?>_<?php echo $_v[0]?>';" class="btn btn-light rb-modal-video-drop js-tooltip" type="button" title="비디오셋" data-toggle="modal" data-target="#modal_window"><i class="fa fa-video-camera"></i></button>
										</span>
									</div>
									<?php endif?>

									<?php if($_v[1]=='file'):?>
									<div class="input-group">
										<input type="text" class="form-control" id="layout_<?php echo $_key?>_<?php echo $_v[0]?>_name" value="<?php echo $d['layout'][$_key.'_'.$_v[0]]?>" onclick="$('#layout_<?php echo $_key?>_<?php echo $_v[0]?>').click();">
										<input type="file" class="d-none" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" id="layout_<?php echo $_key?>_<?php echo $_v[0]?>" onchange="getId('layout_<?php echo $_key?>_<?php echo $_v[0]?>_name').value='파일 선택됨';">
										<span class="input-group-append">
											<button class="btn btn-light" type="button" onclick="$('#layout_<?php echo $_key?>_<?php echo $_v[0]?>').click();"><i class="fa fa-picture-o"></i></button>
										</span>
									</div>
									<?php if($d['layout'][$_key.'_'.$_v[0]]):?>
									<div style="padding:3px 0 0 2px;"><input type="checkbox" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>_del" value="1"> 현재파일 삭제</div>
									<?php endif?>
									<?php endif?>

									<?php if($_v[1]=='textarea'):?>
									<textarea type="text" rows="<?php echo $_v[3]?>" class="form-control" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>"><?php echo stripslashes($d['layout'][$_key.'_'.$_v[0]])?></textarea>
									<?php endif?>

									<?php if($_v[1]=='select'):?>
									<select name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" class="form-control custom-select">
										<?php $_sk=explode(',',$_v[3])?>
										<?php foreach($_sk as $_sa):?>
										<?php $_sa1=explode('=',$_sa)?>
										<option value="<?php echo $_sa1[1]?>"<?php if($d['layout'][$_key.'_'.$_v[0]] == $_sa1[1]):?> selected<?php endif?>><?php echo $_sa1[0]?></option>
										<?php endforeach?>
									</select>
									<?php endif?>

									<?php if($_v[1]=='radio'):?>
									<?php $_sk=explode(',',$_v[3])?>
									<?php foreach($_sk as $_sa):?>
									<?php $_sa1=explode('=',$_sa)?>
									<label class="rb-rabel"><input type="radio" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" value="<?php echo $_sa1[1]?>"<?php if($d['layout'][$_key.'_'.$_v[0]] == $_sa1[1]):?> checked<?php endif?>> <?php echo $_sa1[0]?></label>
									<?php endforeach?>
									<?php endif?>

									<?php if($_v[1]=='checkbox'):?>
									<?php $_sk=explode(',',$_v[3])?>
									<?php foreach($_sk as $_sa):?>
									<?php $_sa1=explode('=',$_sa)?>
									<label class="rb-rabel"><input type="checkbox" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>_chk[]" value="<?php echo $_sa1[1]?>"<?php if(strstr($d['layout'][$_key.'_'.$_v[0]],$_sa1[1])):?> checked<?php endif?>> <?php echo $_sa1[0]?></label>
									<?php endforeach?>
									<?php endif?>

									<?php if($_v[1]=='menu'):?>
									<select name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" class="form-control custom-select">
										<option value="">사용안함</option>
								    <option value="" disabled>--------------------------------</option>
								    <?php include_once $g['path_core'].'function/menu1.func.php'?>
								    <?php $cat=$d['layout'][$_key.'_'.$_v[0]]?>
								    <?php getMenuShowSelectCode($s,$table['s_menu'],0,0,0,0,0,'')?>
									</select>
									<?php endif?>

									<?php if($_v[1]=='bbs'):?>
									<select name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" class="form-control custom-select">
										<option value="">사용안함</option>
										<option value="" disabled>----------------------------------</option>
										<?php $BBSLIST = getDbArray($table['bbslist'],'','*','gid','asc',0,1)?>
										<?php while($R=db_fetch_array($BBSLIST)):?>
										<option value="<?php echo $R['id']?>"<?php if($d['layout'][$_key.'_'.$_v[0]]==$R['id']):?> selected="selected"<?php endif?>>
											ㆍ<?php echo $R['name']?>(<?php echo $R['id']?>)
										</option>
										<?php endwhile?>
									</select>
									<?php endif?>

								</div>
								<?php endforeach?>

								<button type="submit" class="btn btn-outline-primary btn-block">저장하기</button>
								<?php endif?>

							</div>
						</div>
						<?php $_i++;endforeach?>

						<?php if($_i==1):?>
						<div class="card border-primary" id="layout-settings-01">
							<div class="card-header">
								<a class="collapsed" data-toggle="collapse" data-parent="#layout-settings-panels" href="#layout-settings-01-body"><i></i>레이아웃 설정 안내</a>
							</div>
							<div class="card-body panel-collapse collapse show" id="layout-settings-01-body">
								<p>현재 사이트에 지정된 레이아웃은 별도의 설정을 지원하지 않습니다.</p>
							</div>
						</div>
						<div class="card panel-default" id="layout-settings-02">
							<div class="card-header">
								<a class="collapsed" data-toggle="collapse" data-parent="#layout-settings-panels" href="#layout-settings-02-body"><i></i>레이아웃 분기설정</a>
							</div>
							<div id="layout-settings-02-body" class="panel-collapse collapse">
								<div class="card-body">
									<p>현재 사이트에 기본 레이아웃과 모바일 전용레이아웃을 지정했을 경우 두 레이아웃을 구분하여 설정할 수 있습니다.</p>
								</div>
							</div>
						</div>
						<?php endif?>
					</div>

					<div class="bg-light rb-tab-pane-bottom">
						<div class="form-group">
							<label class="sr-only"><small>레이아웃 선택</small></label>
							<select class="form-control custom-select" onchange="layoutChange(this);">
								<option value="">기본 레이아웃 설정</option>
								<?php if($_HS['m_layout']):?><option value="1"<?php if($_SESSION['setLayoutKind']):?> selected<?php endif?>>모바일 전용 레이아웃 설정</option><?php endif?>
							</select>
						</div>
					</div>
					</form>
				</div>

				<div class="tab-pane<?php if($_COOKIE['rightAdmTab']=='emulator'):?> active<?php endif?>" id="device-emulator">
					<div class="btn-group btn-group-toggle rb-device-buttons w-100 px-2" data-toggle="buttons">
						<label class="btn btn-light rb-btn-desktop <?php if($_COOKIE['rightemulTab']=='desktop'||!$_COOKIE['rightemulTab']):?> active<?php endif?>" title="Desktop">
							<input type="radio" name="options" id="rightemulTab_desktop" checked> <i class="fa fa-desktop fa-2x"></i><br>데스크탑
						</label>
						<label class="btn btn-light rb-btn-tablet <?php if($_COOKIE['rightemulTab']=='tablet'):?> active<?php endif?>" title="Tablet">
							<input type="radio" name="options" id="rightemulTab_tablet"> <i class="fa fa-tablet fa-2x"></i><br>태블릿
						</label>
						<label class="btn btn-light rb-btn-mobile <?php if($_COOKIE['rightemulTab']=='mobile'):?> active<?php endif?>" title="Mobile">
							<input type="radio" name="options" id="rightemulTab_mobile"> <i class="fa fa-mobile fa-2x"></i><br>폰
						</label>
					</div>

					<fieldset id="deviceshape"<?php if(!$_COOKIE['rightemulTab'] || $_COOKIE['rightemulTab'] == 'desktop'):?> disabled<?php endif?>>
						<div class="btn-group btn-group-toggle w-100 nav-justified px-2" data-toggle="buttons">
							<label id="deviceshape_1" class="btn btn-light w-50<?php if(!$_COOKIE['rightemulDir'] || $_COOKIE['rightemulDir'] == '1'):?> active<?php endif?>" title="Potrait" onclick="_deviceshape(1);">
								<input type="radio" name="deviceshape"><i class="fa fa-rotate-left fa-lg"></i> 세로방향
							</label>
							<label id="deviceshape_2" class="btn btn-light w-50<?php if($_COOKIE['rightemulDir'] == '2'):?> active<?php endif?>" title="Landscape" onclick="_deviceshape(2);">
								<input type="radio" name="deviceshape"> <i class="fa fa-rotate-right fa-lg"></i> 가로방향
							</label>
						</div>
					</fieldset>

					<div class="rb-scrollbar" id="emuldevices">
					    <table class="table table-sm table-striped table-hover mb-0">
					        <thead>
					            <tr>
					                <th class="rb-name">기기명</th>
					                <th class="rb-brand">제조사</th>
					                <th class="rb-viewport">화면크기</th>
					            </tr>
					        </thead>
					        <tbody>
								<?php $d['magent']= file($g['path_var'].'mobile.agent.txt')?>
								<?php $_i=0;foreach($d['magent'] as $_line):if($_i):if(!trim($_line))continue;$_val=explode(',',trim($_line));$_scSize=explode('*',$_val[2])?>
								<?php if(!$_firstPhone[0]&&$_val[3]=='phone'){$_firstPhone[0]=$_i;$_firstPhone[1]=$_scSize[0];$_firstPhone[2]=$_scSize[1];}?>
								<?php if(!$_firstTablet[0]&&$_val[3]=='tablet'){$_firstTablet[0]=$_i;$_firstTablet[1]=$_scSize[1];$_firstTablet[2]=$_scSize[0];}?>
					            <tr id="emdevice_<?php echo $_i?>" onclick="_emuldevice(this,'<?php echo $_val[2]?>','<?php echo $_val[3]?>');">
					                <td class="rb-name js-tooltip" title="<?php echo $_val[3]?>"><?php echo $_val[0]?></td>
					                <td class="rb-brand"><?php echo $_val[1]?></td>
					                <td class="rb-viewport"><?php echo $_scSize[0]?><var>x</var><?php echo $_scSize[1]?></td>
					            </tr>
								<?php endif;$_i++;endforeach?>
					        </tbody>
					    </table>
					</div>

					<div class="bg-light rb-tab-pane-bottom rb-form">
						<ul class="list-group">
							<li class="list-group-item py-2">
								<fieldset>

									<label class="custom-control custom-checkbox mb-0">
									  <input type="checkbox" class="custom-control-input"<?php if($g['mobile']):?> checked<?php endif?> onclick="viewbyMobileDevice(this);">
									  <span class="custom-control-label">
											모바일 디바이스 접속
											<span class="fa fa-question-circle" data-toggle="popover" title="[도움말] 모바일 디바이스 접속이란?" data-content="<small>모바일 기기로 접속한 것으로 가정하여 사이트를 보여줍니다. 사이트 설정에서 모바일 분기설정을 적용하면 모바일 전용 레이아웃, 시작페이지, 메뉴가 적용 됩니다.</small>"></span>
										</span>
									</label>
								</fieldset>
							</li>
							<li class="list-group-item">
								<div class="input-group input-group-sm">
									<input id="outlink_url" type="text" class="form-control" placeholder="http://" onkeypress="getOuturl(0);">
									<span class="input-group-append">
										<button class="btn btn-light js-tooltip" type="button" title="Go" onclick="getOuturl(1);">Go!</button>
									</span>
								</div>
							</li>
							<li class="list-group-item">
								<small><i class="fa fa-info-circle fa-4x pull-left"></i>기기별 기본 브라우저의 실제크기 화면을 제공합니다. 기기 또는 운영체제별 특성은 실제 기기를 통해 확인하세요.</small>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<nav class="navbar navbar-default fixed-bottom" style="border-top:#efefef solid 1px;" hidden>
	<div class="container">
		<div class="btn-group">
			<div class="login-info">
				<span class="dropdown" style="top:5px;">
					<a href="#" class="rb-username" data-toggle="dropdown">
						<span style="width:105px;overflow:hidden;color:#666;">
							<span>
								<?php echo $my[$_HS['nametype']]?>
							</span>
							<span class="caret"></span>
						</span>
					</a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
					<li><a href="#" data-toggle="modal" data-target="#modal_window" class="rb-modal-profile"><i class="fa fa-user" style="padding-top:3px;padding-bottom:3px;"></i> 프로필관리</a></li>
					<li><a href="#" data-toggle="modal" data-target="#modal_window" class="rb-modal-log"><i class="fa fa-clock-o" style="padding-top:3px;padding-bottom:3px;"></i> 접속기록</a></li>
					<li class="divider"></li>
					<li style="padding-bottom:3px;"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;a=logout"><i class="fa fa-sign-out"></i> 로그아웃</a></li>
					</ul>
				</span>
			</div>
		</div>
		<div class="btn-group pull-right">
			<div class="btn-group dropup">
				<a class="btn btn-link" data-toggle="dropdown" style="font-size:21px;top:4px;">
					<i class="kf kf-bi-06"></i>
				</a>
				<ul class="dropdown-menu rb-device-bottom" role="menu" style="max-height:400px;overflow:auto;left:-55px;">
				<?php $_i=0;$_dmnum=count($_MODULES['disp0'])-1;foreach($_MODULES['disp0'] as $_SM1):?>
				<?php if(strpos('_'.$my['adm_view'],'['.$_SM1['id'].']')) continue?>
				<li style="padding-top:5px;padding-bottom:4px;<?php if($_i<$_dmnum):?>border-bottom:#dfdfdf solid 1px;<?php endif?>">
					<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&m=admin&module=<?php echo $_SM1['id']?>" target="_ADMPNL_">
						<i class="<?php echo $_SM1['icon']?$_SM1['icon']:'fa-th-large'?>"></i>
						<span class="menu-item-parent"><?php echo $_SM1['name']?></span>
					</a>
				</li>
				<?php $_i++;endforeach?>
				</ul>
			</div>
			<div class="btn-group dropup">
				<?php $_smnum=count($_SITES['list'])-1?>
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>" target="_ADMPNL_" class="btn btn-link"<?php if($_smnum):?> data-toggle="dropdown"<?php endif?> style="top:4px;">
					<i class="fa fa-home fa-2x"></i>
				</a>
				<?php if($_smnum):?>
				<ul class="dropdown-menu rb-device-bottom" role="menu" style="max-height:400px;overflow:auto;left:-55px;">
				<?php $_i=0;foreach($_SITES['list'] as $S):?>
				<li id="bottombar-sites-<?php echo $S['id']?>"<?php if($r==$S['id']):?> class="active<?php endif?>">
					<a href="<?php echo $g['s']?>/?r=<?php echo $S['id']?>&amp;panel=Y" style="padding-top:7px;padding-bottom:6px;<?php if($_i<$_smnum):?>border-bottom:#dfdfdf solid 1px;<?php endif?>">
						<i class="<?php echo $S['icon']?$S['icon']:'fa fa-home'?>"></i> &nbsp;
						<span class="menu-item-parent" style="position:absolute;width:100px;overflow:hidden;"><?php echo $S['name']?></span>
					</a>
				</li>
				<?php $_i++;endforeach?>
				</ul>
				<?php endif?>
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=dashboard&amp;front=mobile.shortcut" target="_ADMPNL_" class="btn btn-link" style="font-size:22px;top:2px;">
					<i class="fa fa-th"></i>
				</a>
			</div>
		</div>
	</div>
</nav>



<script>
var _mediasetField='';
$(document).ready(function(){

	$('.js-tooltip').tooltip()

	$(".rb-system-admin .rb-icon-minify").click(function(){
		$(".container-fluid").toggleClass("rb-minified-sidebar");
		if ($(".container-fluid").hasClass("rb-minified-sidebar"))
		{
			$(".rb-system-sidebar .rb-icon-minify").attr("data-original-title", "펼치기");
		} else
		{
			$(".rb-system-sidebar .rb-icon-minify").attr("data-original-title", "접기");
		}
		if(getCookie('_tabShow1')=='') setCookie('_tabShow1',1,1);
		else setCookie('_tabShow1','',1);
	});

	$(".rb-system-admin .rb-icon-hide").click(function(){
		$(".container-fluid").toggleClass("rb-hidden-system-admin");
		if ($(".container-fluid").hasClass("rb-hidden-system-admin"))
		{
			$(".rb-system-sidebar .rb-icon-hide").attr("data-original-title", "고정하기");
		}
		else
		{
			$(".rb-system-sidebar .rb-icon-hide").attr("data-original-title", "숨기기");
		}
		if(getCookie('_tabShow2')=='') setCookie('_tabShow2',1,1);
		else setCookie('_tabShow2','',1);
	});

	$(".rb-system-site .rb-icon-hide").click(function(){
		$(".container-fluid").toggleClass("rb-hidden-system-site");

		if ($(".container-fluid").hasClass("rb-hidden-system-site"))
		{
			$(".rb-system-site .rb-icon-hide").attr("data-original-title", "고정하기");
		}
		else
		{
			$(".rb-system-site .rb-icon-hide").attr("data-original-title", "숨기기");
		}
		if(getCookie('_tabShow3')=='') setCookie('_tabShow3',1,1);
		else setCookie('_tabShow3','',1);
	});


	if(navigator.userAgent.indexOf("Mac") > 0) {
		$("body").addClass("mac-os");
	}

	$(".rb-btn-desktop").click(function(){
		getId('_ADMPNL_').style.display = '';
		getId('_ADMPNL_').style.width = '';
		getId('_ADMPNL_').style.height = '';
		setCookie('rightemulTab','desktop',1);
		$("#emuldevices tr").removeClass("active");
		$(".rb-full-overlay-main").removeClass( "mobile tablet" ).addClass( "desktop" );
		getId('deviceshape').disabled = true;
		_nowSelectedDevice = '';
	});

	$(".rb-btn-tablet").click(function(){
		setCookie('rightemulTab','tablet',1);
		setCookie('rightemulDir',2,1);
		$("#emuldevices tr").removeClass("active");
		$("#emdevice_<?php echo $_firstTablet[0]?>").addClass("active");
		$("#deviceshape_1").removeClass("active");
		$("#deviceshape_2").addClass("active");
		$(".rb-full-overlay-main").removeClass( "desktop mobile" ).addClass( "tablet" );
		getId('_ADMPNL_').style.display = 'block';
		getId('_ADMPNL_').style.width = '<?php echo $_firstTablet[2]?>px';
		getId('_ADMPNL_').style.height = '<?php echo $_firstTablet[1]?>px';
		getId('deviceshape').disabled = false;
		_nowSelectedDevice = 'emdevice_<?php echo $_firstTablet[0]?>';
	});

	$(".rb-btn-mobile").click(function(){
		setCookie('rightemulTab','mobile',1);
		setCookie('rightemulDir',1,1);
		$("#emuldevices tr").removeClass("active");
		$("#emdevice_<?php echo $_firstPhone[0]?>").addClass("active");
		$("#deviceshape_1").addClass("active");
		$("#deviceshape_2").removeClass("active");
		$(".rb-full-overlay-main").removeClass( "desktop tablet" ).addClass( "mobile" );
		getId('_ADMPNL_').style.display = 'block';
		getId('_ADMPNL_').style.width = '<?php echo $_firstPhone[1]?>px';
		getId('_ADMPNL_').style.height = '<?php echo $_firstPhone[2]?>px';
		getId('deviceshape').disabled = false;
		_nowSelectedDevice = 'emdevice_<?php echo $_firstPhone[0]?>';
	});

	<?php if($_COOKIE['rightemulTab'] && $_COOKIE['rightemulTab'] != 'desktop'):?>
	$(".rb-btn-<?php echo $_COOKIE['rightemulTab']?>").click();
	<?php else:?>
	getId('deviceshape').disabled = true;
	<?php endif?>

	$('.rb-modal-profile').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;m=admin&amp;module=admin&amp;front=modal.admininfo&amp;uid='.$my['uid'].'&amp;tab=info')?>');
	});
	$('.rb-modal-log').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;m=admin&amp;module=admin&amp;front=modal.admininfo&amp;uid='.$my['uid'].'&amp;tab=log')?>');
	});
	$('.rb-modal-notification').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;system=popup.notification')?>');//&amp;callMod=view
	});
	$('.rb-modal-photo').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;m=mediaset&amp;mdfile=modal.photo.media')?>');
	});
	$('.rb-modal-video').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;m=mediaset&amp;mdfile=modal.video.media')?>');
	});
	$('.rb-modal-photo-drop').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;m=mediaset&amp;mdfile=modal.photo.media&amp;dropfield=')?>'+_mediasetField);
	});
	$('.rb-modal-video-drop').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;m=mediaset&amp;mdfile=modal.video.media&amp;dropfield=')?>'+_mediasetField);
	});
	$('.rb-modal-widgetcode').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;system=popup.widget&amp;isWcode=Y')?>');
	});
	$('.rb-modal-add-package').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;m=admin&amp;module=market&amp;front=modal.package')?>');
	});
	$('.rb-modal-add-module').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;m=admin&amp;module=market&amp;front=modal.add&amp;addType=module')?>');
	});
	$('.rb-modal-add-layout').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;m=admin&amp;module=market&amp;front=modal.add&amp;addType=layout')?>');
	});
	$('.rb-modal-add-widget').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;m=admin&amp;module=market&amp;front=modal.add&amp;addType=widget')?>');
	});
	$('.rb-modal-add-switch').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;m=admin&amp;module=market&amp;front=modal.add&amp;addType=switch')?>');
	});
	$('.rb-modal-add-plugin').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;m=admin&amp;module=market&amp;front=modal.add&amp;addType=plugin')?>');
	});
	$('.rb-modal-add-dashboard').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;m=admin&amp;module=market&amp;front=modal.add&amp;addType=dashboard')?>');
	});
	$('.rb-modal-add-etc').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;m=admin&amp;module=market&amp;front=modal.add&amp;addType=etc')?>');
	});
	$('.rb-modal-snippet').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;system=popup.snippet')?>');
	});
});
var _nowSelectedDevice = '';
function _emuldevice(obj,size,type)
{
	var s = size.split('*');
	type = type == 'phone' ? 'mobile' : type;
	setCookie('rightemulTab',type,1);
	$(".rb-device-buttons label").removeClass( "active" );
	$(".rb-btn-"+type).addClass( "active" );
	$(".rb-full-overlay-main").removeClass( "desktop" ).removeClass( "tablet" ).removeClass( "mobile" ).addClass( type );
	$("#emuldevices tr").removeClass("active");
	$("#"+obj.id).addClass("active");
	getId('deviceshape').disabled = false;

	getId('_ADMPNL_').style.display = 'block';
	if(getCookie('rightemulDir') == '2')
	{
		if (type == 'mobile')
		{
			getId('_ADMPNL_').style.width = s[1]+'px';
			getId('_ADMPNL_').style.height = s[0]+'px';
		}
		else {
			getId('_ADMPNL_').style.width = s[0]+'px';
			getId('_ADMPNL_').style.height = s[1]+'px';
		}
	}
	else {
		if (type == 'mobile')
		{
			getId('_ADMPNL_').style.width = s[0]+'px';
			getId('_ADMPNL_').style.height = s[1]+'px';
		}
		else {
			getId('_ADMPNL_').style.width = s[1]+'px';
			getId('_ADMPNL_').style.height = s[0]+'px';
		}
	}
	_nowSelectedDevice = obj.id;
}
function _deviceshape(n)
{
	setCookie('rightemulDir',n,1);
	$("#"+_nowSelectedDevice).click();
}
function _quickSelect(id)
{
	$("#sidebar-quick .list-group-item").removeClass("active");
	$("#sidebar-quick-"+id).addClass("active");
}
function _quickSelect1(id,_k)
{
	$("#sidebar-quick-tree-"+id+" li").removeClass("active");
	$("#sidebar-quick-tree-"+id+"-"+_k).addClass("active");
}
function _siteSelect(id)
{
	$(".rb-device-bottom li").removeClass("active");
	$("#bottombar-sites-"+id).addClass("active");
}
function _moduleSelect(id)
{
	$("#sidebar-modules .list-group-item").removeClass("active");
	$("#sidebar-modules-"+id).addClass("active");
}
function _cookieSetting(name,tab)
{
	setCookie(name,tab,1);
}
function _siteInfoSaveCheck(f)
{
	f.layout.value = f.layout_1.value + '/' + f.layout_1_sub.value;
	if(f.m_layout_1.value != '0') f.m_layout.value = f.m_layout_1.value + '/' + f.m_layout_1_sub.value;
	else f.m_layout.value = '';
	f.referer.value = frames._ADMPNL_.location.href;
	return confirm('정말로 변경하시겠습니까?    ');
}
function _layoutInfoSaveCheck(f)
{
	return confirm('정말로 변경하시겠습니까?    ');
}
function getOuturl(n)
{
	if (n == 0)
	{
		if(event.keyCode != 13) return false;
	}
	if (getId('outlink_url').value != '')
	{
		var url = 'http://' + getId('outlink_url').value.replace('http://');
		frames._ADMPNL_.location.href = url;
	}
}
function viewbyMobileDevice(obj)
{
	frames._ACTION_.location.href = rooturl + '/?a=sessionsetting&target=parent.frames._ADMPNL_.&name=pcmode&value=' + (obj.checked ? 'E' : '');
}
function layoutChange(obj)
{
	frames._ACTION_.location.href = rooturl + '/?a=sessionsetting&target=parent.&name=setLayoutKind&value=' + obj.value;
}
function getColorLayer(color,layer)
{
	getId('_small_modal_').innerHTML = '<iframe id="_small_modal_iframe_" src="<?php echo $g['s']?>/_core/opensrc/colorjack/color.php?color='+color+'&dropf='+layer+'&callback=" frameborder="0" scrolling="no"></iframe>';
}
function _small_modal_close_()
{
	$('.bs-example-modal-sm').modal('s003');
}

// 사이트 패널 활성 스타일 적용
$('.rb-system-site .panel-collapse').on('show.bs.collapse', function () {
	var card = $(this).closest('.card')
	card.addClass("border-primary");
	card.find('.card-header').addClass("bg-primary text-white");
});
$('.rb-system-site .panel-collapse').on('hide.bs.collapse', function () {
	var card = $(this).closest('.card')
	card.removeClass("border-primary");
	card.find('.card-header').removeClass("bg-primary text-white");
});

</script>

<?php if($d['layout']['date']):?>
<?php getImport('bootstrap-datepicker','css/datepicker3',false,'css')?>
<?php getImport('bootstrap-datepicker','js/bootstrap-datepicker',false,'js')?>
<?php getImport('bootstrap-datepicker','js/locales/bootstrap-datepicker.kr',false,'js')?>
<script>
$('.input-daterange').datepicker({
format: "yyyy/mm/dd",
todayBtn: "linked",
language: "kr",
calendarWeeks: true,
todayHighlight: true,
autoclose: true
});
function getCalCheck(layer)
{
	$('#layout_'+layer).focus();
}
</script>
<?php endif?>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true"><div id="_small_modal_body_" class="modal-dialog modal-sm"><div class="modal-content" id="_small_modal_"></div></div></div>
<div id="_box_layer_"></div>
<div id="_action_layer_"></div>
<div id="_hidden_layer_"></div>
<div id="_overLayer_"></div>
<iframe id="_ACTION_" name="_ACTION_" hidden></iframe>
</body>
</html>
