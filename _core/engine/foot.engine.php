<!-- 사이트 풋터 코드 -->
<?php echo $_HS['footercode'] ?>

<!-- 푸터 스위치 -->
<?php foreach($g['switch_3'] as $_switch) include $_switch ?>

<div id="_box_layer_"></div>
<div id="_action_layer_"></div>
<div id="_hidden_layer_"></div>
<div id="_overLayer_"></div>
<div id="rb-context-menu" class="dropdown"><a data-toggle="dropdown" href="#."></a><div class="dropdown-menu" role="menu"></div></div>
<iframe hidden name="_action_frame_<?php echo $m?>" width="0" height="0" frameborder="0" scrolling="no" title="iframe"></iframe>

<?php
$g['wdgcod'] = $g['path_tmp'].'widget/c'.$_HM['uid'].'.p'.$_HP['uid'].'.cache';
if(is_file($g['wdgcod'])) include $g['wdgcod'];
if($g['widget_cssjs']) include $g['path_core'].'engine/widget.cssjs.php';
if($my['uid']) include $g['path_core'].'engine/notification.engine.php';
?>

<script>

// 알림 기본 셋팅값 정의
$.notifyDefaults({
  placement: {
    from: "bottom",
    align: "center"
  },
  allow_dismiss: false,
  offset: 20,
  type: "dark",
  timer: 100,
  delay: 1500,
  animate: {
    enter: "animated fadeInUp",
    exit: "animated fadeOutDown"
  }
});

<?php if($_HS['dtd']):?>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', '<?php echo $_HS['dtd']?>', 'auto');
ga('send', 'pageview');
<?php endif?>
<?php if($my['uid']):?>
<?php if($my['admin'] && $d['admin']['dblclick'] && $panel!='N'):?>
document.ondblclick = function(event)
{
	<?php if($_HM['uid']):?>
	getContext('<a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&m=admin&module=site&front=menu&cat=<?php echo $_HM['uid']?>">메뉴 등록정보</a><?php if($_HM['menutype']>1):?><a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&m=admin&module=site&front=_edit&_mtype=menu&cat=<?php echo $_HM['uid']?>&uid=<?php echo $_HM['uid']?>&type=<?php echo $_HM['menutype']==2?'source':'widget'?>"><?php echo $_HM['menutype']==2?'소스코드 편집모드':''?></a><?php if($_HM['menutype']==2):?><a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&m=admin&module=site&front=_edit&_mtype=menu&cat=<?php echo $_HM['uid']?>&uid=<?php echo $_HM['uid']?>&type=source&markdown=Y">마크다운 편집모드</a><?php endif?><?php endif?><div class="dropdown-divider"></div><a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&m=admin&module=site&front=menu">새 메뉴 만들기</a>',event);
	<?php elseif($_HP['uid']):?>
	getContext('<a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&m=admin&module=site&front=page&uid=<?php echo $_HP['uid']?>">페이지 등록정보</a><?php if($_HP['pagetype']>1):?><a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&m=admin&module=site&front=_edit&_mtype=page&uid=<?php echo $_HP['uid']?>&type=<?php echo $_HP['pagetype']==2?'source':'widget'?>"><?php echo $_HP['pagetype']==2?'소스코드 편집모드':''?></a><?php if($_HP['pagetype']==2):?><a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&m=admin&module=site&front=_edit&_mtype=page&uid=<?php echo $_HP['uid']?>&type=source&markdown=Y">마크다운 편집모드</a><?php endif?><?php endif?><div class="dropdown-divider"></div><a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&m=admin&module=site&front=page">새 페이지 만들기</a>',event);
	<?php else:?>
	getContext('<a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&m=admin&module=<?php echo $m?>">관리자모드 보기</a><a class="dropdown-item" href="<?php echo $g['s']?>/?r=<?php echo $r?>&m=admin&module=module&front=main&id=<?php echo $m?>">모듈 등록정보</a>',event);
	<?php endif?>
}
<?php endif?>
<?php else:?>
$('.rb-modal-login').on('click',function() {
	modalSetting('modal_window','<?php echo getModalLink('&amp;system=popup.login')?>');
});
<?php endif?>
</script>
