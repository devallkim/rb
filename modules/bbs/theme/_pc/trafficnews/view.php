<link href="<?php echo $g['dir_module_skin']?>/_main.css" rel="stylesheet">
<div class="row">
	 <div class="col-sm-1">
	 	   <?php if($g['member']['photo']):?>
	 	       <img src="<?php echo $g['url_root']?>/_var/avatar/<?php echo $g['member']['photo']?>" alt="회원 아바타" class="mbr-simbol" />
         <?php else:?>
              <img src="<?php echo $g['url_root']?>/_var/avatar/180.0.gif" alt="회원 아바타 샘플" class="mbr-simbol" />
	 	  <?php endif?>
	 </div>
	 <div class="col-sm-11">
	 	  <h2><?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'...')?></h2>
	 	  <div class="">
	 	  	  <span class="title-ele"><?php echo $R[$_HS['nametype']]?></span>
	 	  	  <span class="title-ele"><?php echo getDateFormat($R['d_regis'],$d['theme']['date_viewf'])?></span>
		  </div>
	 </div>



	 <?php if($R['tag']&&$d['theme']['show_tag']):?>
	 <div>
	    <div class="panel panel-default">
	    	  <div class="panel-body">
	            <div class="col-sm-12 nopd-left">
	                     <?php $_tags=explode(',',$R['tag'])?>
						      <?php $_tagn=count($_tags)?>
						     <?php $i=0;for($i = 0; $i < $_tagn; $i++):?>
						     <?php $_tagk=trim($_tags[$i])?>
	                    <span class="badge tag-links">
	                    	  <i class="fa fa-tags" title="태그"></i>
	                    	  <a href="<?php echo $g['bbs_orign']?>&amp;where=subject|tag&amp;keyword=<?php echo urlencode($_tagk)?>"> <?php echo $_tagk?></a>
	                    	</span>
	                    <?php endfor?>
	              </div>
	          </div>
	    </div>
	 </div>
    <?php endif?>
    <div class="text-xs-center">
       <div class="btn-group">
          <?php if($my['admin'] || $my['uid']==$R['mbruid']):?>
            <a href="<?php echo $g['bbs_modify'].$R['uid']?>" class="btn btn-secondary">수정</a>
            <a href="<?php echo $g['bbs_delete'].$R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');" class="btn btn-secondary">삭제</a>
           <?php endif?>
           <a href="<?php echo $g['bbs_list']?>" class="btn btn-secondary">목록</a>
        </div>
	 </div>

</div> <!--.row-->

<script type="text/javascript">
//<![CDATA[

// 툴팁 이벤트
$(document).ready(function() {
    $('[data-toggle=tooltip]').tooltip();
});

<?php if($d['theme']['snsping']):?>
function snsWin(sns)
{
	var snsset = new Array();
	var enc_tit = "<?php echo urlencode($_HS['title'])?>";
	var enc_sbj = "<?php echo urlencode($R['subject'])?>";
	var enc_url = "<?php echo urlencode($g['url_root'].($_HS['rewrite']?($_HS['usescode']?'/'.$r:'').'/b/'.$R['bbsid'].'/'.$R['uid']:'/?'.($_HS['usescode']?'r='.$r.'&':'').'m='.$m.'&bid='.$R['bbsid'].'&uid='.$R['uid']))?>";
	var enc_tag = "<?php echo urlencode(str_replace(',',' ',$R['tag']))?>";
	snsset['t'] = 'http://twitter.com/home/?status=' + enc_sbj + '+++' + enc_url;
	snsset['f'] = 'http://www.facebook.com/sharer.php?u=' + enc_url + '&t=' + enc_sbj;
	snsset['g'] = 'https://plus.google.com/share?url=' + enc_url;
	window.open(snsset[sns]);
}
<?php endif?>

//로그인체크
function isLogin2()
{
	if (memberid == '')
	{
		alert('로그인을 먼저 해주세요.  ');
		return false;
	}
	return true;
}

function printWindow(url)
{
	window.open(url,'printw','left=0,top=0,width=700px,height=600px,statusbar=no,scrollbars=yes,toolbar=yes');
}
//]]>
</script>

<?php if($d['theme']['show_list']&&$print!='Y'):?>
<?php include_once $g['dir_module'].'mod/_list.php'?>
<?php include_once $g['dir_module_skin'].'list.php'?>
<?php endif?>
