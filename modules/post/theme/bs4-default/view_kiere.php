<?php
// 이전글 다음글 구하기
$prev_uid=getDbCnt($table[$m.'data'],'max(uid)',$blogque.' and uid<'.$uid);
$next_uid=getDbCnt($table[$m.'data'],'min(uid)',$blogque.' and uid>'.$uid);
$prev_link=$g['blog_view'].$prev_uid;
$next_link=$g['blog_view'].$next_uid;
?>
<section class="rb-blog rb-blog-view">
    <div class="rb-blog-heading">
        <h1 class="rb-title">
            <?php echo $R['subject']?>
        </h1>
        <div class="rb-meta">
            <ul class="list-inline">
                <li class="rb-date">
                    <span class="glyphicon glyphicon-calendar"></span>
                    <?php echo getTimeagoDate($R['d_published'],'d_published')?>
                </li>
                <li>
                    <span class="glyphicon glyphicon-user"></span>
                    <span class="rb-popover rb-help" title=""><?php echo $M[$_HS['nametype']]?></span>
                </li>
                <?php if(IsPostCat($B['uid'],$R['uid'])):?>
                <li>
                    <a href="<?php echo getPostCatLink($B['uid'],$R['uid']);?>" data-toggle="tooltip" title="분류">
                        <span class="glyphicon glyphicon-folder-close"></span> <?php echo getPostCatName($B['uid'],$R['uid']);?>
                    </a>
                </li>
                <?php endif?>
                <li>
                    <span data-toggle="tooltip" title="조회수">
                        <span class="glyphicon glyphicon-eye-open"></span> <?php echo $R['hit']?>
                    </span>
                </li>
                <li>
                    <a href="#comment" data-scroll data-toggle="tooltip" title="댓글">
                        <span class="glyphicon glyphicon-comment"></span> <?php echo $R['comment']?>
                    </a>
                </li>
            </ul>
        </div>
         <div class="btn-toolbar rb-actions">
            <div class="btn-group rb-resizer" role="group" aria-label="...">
                <span class="rb-font-xs"><a class="btn btn-default btn-xs hidden-xs">A</a></span>
                <span class="rb-font-sm"><a class="btn btn-default btn-xs">A</a></span>
                <span class="rb-font-md"><a class="btn btn-default btn-xs">A</a></span>
                <span class="rb-font-lg"><a class="btn btn-default btn-xs">A</a></span>
            </div>
        </div>
    </div> <!-- // rb-blog-heading-->
    <div class="rb-blog-heading" style="border-bottom:none;margin-top:-3px;">
         <div class="rb-meta">
            <small>
                최초 작성일 : <?php echo getTimeagoDate($R['d_regis'],'d_regis')?>
                <?php if($R['d_modify']):?>
                    <?php echo '(수정 :'.getTimeagoDate($R['d_modify'],'d_modify').')'?>
               <?php endif?>
            </small>
          </div>
    </div>
    <div class="rb-blog-body">
       <?php echo getContents($R['content'],'HTML')?>
    </div>
    <div class="rb-blog-footer">
        <?php if($R['tag']):?>
        <dl class="dl-horizontal rb-tag">
            <dt>태그</dt>
            <dd>
                <ul class="list-inline">
                 <?php $_tags=explode(',',$R['tag'])?>
                 <?php $_tagn=count($_tags)?>
                 <?php $i=0;for($i = 0; $i < $_tagn; $i++):?>
                 <?php $_tagk=trim($_tags[$i])?>
                    <li>#<a href="<?php echo $g['blog_front']?>list&amp;where=<?php echo $table[$m.'data']?>.tag&amp;keyword=<?php echo urlencode($_tagk)?>"><?php echo $_tagk?></a></li>
                  <?php endfor?>
                </ul>
            </dd>
        </dl>
        <?php endif?>
        <?php if($upload_data&&$attach_file_num>0):?>
        <dl class="dl-horizontal rb-attach">
            <dt>첨부</dt>
            <dd>
                <ul class="list-unstyled">
                 <?php foreach($upload_data as $_u):?>
                    <?php if($_u['hidden']&&!$_u['fileonly']) continue?>
                    <li>
                        <i class="fa fa-floppy-o fa-fw"></i>
                        <a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=attach&amp;a=download&amp;uid=<?php echo $_u['uid']?>"><?php echo $_u['name']?></a>
                        <span class="rb-size"><?php echo getSizeFormat($_u['size'],1)?></span>
                        <span class="rb-down" data-toggle="tooltip" title="다운로드 수"><?php echo number_format($_u['down'])?></span>
                    </li>
                    <?php endforeach?>
                </ul>
           </dd>
        </dl>
        <?php endif?>
        <div class="rb-toolbar btn-toolbar" role="toolbar">
            <div class="rb-share">

            </div>
            <div class="rb-buttons">
                <div class="btn-group btn-group-sm">
                    <a href="<?php echo $g['blog_front']?>list" class="btn btn-default">목록으로</a>
                    <a href="<?php echo $g['blog_front']?>write&amp;uid=<?php echo $R['uid']?>&amp;cat=<?php echo $cat?>&amp;vtype=<?php echo $vtype?>&amp;recnum=<?php echo $recnum?>" class="btn btn-default">수정</a>
                    <a href="<?php echo $g['blog_act']?>post_delete&amp;uid=<?php echo $R['uid']?>" onclick="return hrefCheck(this,true,'정말로 삭제하시겠습니까?');" class="btn btn-default">삭제</a>
                </div>
            </div>
        </div>
        <div class="panel panel-default rb-author">
            <div class="panel-heading hidden">작성자</div>
            <div class="panel-body">
                <div class="media">
                    <div class="media-left media-middle">
                        <img class="media-object img-rounded" src="<?php echo $avatar_src?>" alt="작성자 아바타 사진" style="width:64px;height:64px;">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $M['name']?> <span class="text-muted">(<?php echo $M[$_HS['nametype']]?>)</span></h4>
                        <ul class="list-inline">
                            <li><?php echo $M['email']?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="rb-tabs">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#comment" data-toggle="tab">댓글 <span class="badge">0</span></a></li>
                <li><a href="#trackback" data-toggle="tab">엮인글  <span class="badge">0</span></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="comment">
                    <?php getWidget('default/comment',array('theme'=>'default','parent'=>$m.'-'.$R['uid'],'feed_table'=>$table[$m.'data']));?>
                </div>
                <div class="tab-pane" id="trackback">
                    트래백 목록
                </div>
            </div>
        </div>
        <nav class="text-center">
            <ul class="pager">
                <li class="previous <?php echo !$prev_uid?'disabled':''?>"><a href="<?php echo $prev_link?>">← 이전</a></li>
                <li><a href="<?php echo $g['blog_front']?>list">목록</a></li>
                <li class="next <?php echo !$next_uid?'disabled':''?>"><a href="<?php echo $next_link?>">다음 →</a></li>
            </ul>
        </nav>
    </div>
</section><!-- view 끝 -->


<!-- 라이트 박스를 사용할 경우  -->
<!-- nivo-lightbox : https://github.com/gilbitron/Nivo-Lightbox -->
<?php getImport('nivo-lightbox','nivo-lightbox',false,'css') ?>
<?php getImport('nivo-lightbox','themes/default/default',false,'css') ?>
<?php getImport('nivo-lightbox','nivo-lightbox.min',false,'js') ?>
<script type="text/javascript">
$(function() {
    $(".rb-blog-view .rb-blog-body img").each(function() {
    var a = $('<a/>').attr('href', this.src);
    $(a).addClass('lightbox');
    $(a).attr('title', this.alt);
    $(a).attr('data-lightbox-gallery', "postview");
    $(this).addClass('img-responsive').wrap(a);
    $('.lightbox').nivoLightbox();
    });
});
</script>


<script>
// sns 이벤트
function snsWin(sns)
{
    var snsset = new Array();
    var enc_tit = "<?php echo urlencode($_HS['title'])?>";
    var enc_sbj = "<?php echo urlencode($R['subject'])?>";
    var enc_url = "<?php echo urlencode($g['url_root'].($_HS['rewrite']?($_HS['usescode']?'/'.$r:'').'/blog/'.$B['uid'].'/'.$R['uid']:'/?'.($_HS['usescode']?'r='.$r.'&':'').'m='.$m.'&blog='.$B['id'].'&uid='.$R['uid']))?>";
    var enc_tag = "<?php echo urlencode(str_replace(',',' ',$R['tag']))?>";
    snsset['t'] = 'http://twitter.com/home/?status=' + enc_sbj + '+++' + enc_url;
    snsset['f'] = 'http://www.facebook.com/sharer.php?u=' + enc_url + '&t=' + enc_sbj;
    snsset['g'] = 'https://plus.google.com/share?url=' + enc_url;
    window.open(snsset[sns]);
}
</script>
