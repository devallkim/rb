<?php if($NUM):?>
<div class="rb-viewtype-list">
    <table class="table">
        <colgroup>
            <col width="60">
            <col>
            <col width="80">
            <col width="150">
            <col width="70">
        </colgroup>
        <thead>
            <tr>
                <th class="rb-num">번호</th>
                <th class="rb-title">제목</th>
                <th class="rb-user">작성자</th>
                <th class="rb-time">등록일</th>
                <th class="rb-hit">조회</th>
            </tr>
        </thead>
        <tbody>
            <?php while($R=db_fetch_array($RCD)):?>
            <?php $_M=getDbData($table['s_mbrdata'],'memberuid='.$R['mbruid'],'*')?>
             <tr>
                <th class="rb-num" scope="row"><?php echo $NUM-((($p-1)*$recnum)+$_rec++)?></th>
                <td class="rb-title">
                    <?php if(getNew($R['d_regis'],24)):?><span class="rb-new"></span><?php endif?>
                    <?php if($R['isphoto']):?><span class="" data-toggle="tooltip" title="사진"><i class="fa fa-camera-retro fa-lg"></i></span><?php endif?>
                    <?php if($R['isvod']):?><span class="" data-toggle="tooltip" title="동영상"><i class="fa fa-movie-o fa-lg"></i></span><?php endif?>
                    <?php if(IsPostCat($B['uid'],$R['uid'])):?>
                    <span><a href="<?php echo getPostCatLink($B['uid'],$R['uid']);?>" class="rb-tooltip" title="분류">[<?php echo getPostCatName($B['uid'],$R['uid']);?>] </a></span>
                    <?php endif?>
                    <a href="<?php echo ($rwcat?$g['blog_home_rw'].'/c/'.$rwcat.'/':$g['blog_view']).$R['uid']?>">
                        <?php echo $R['subject']?><?php if($R['comment']):?><span class="badge"><?php echo $R['comment']?><?php if($R['oneline']):?>+<?php echo $R['oneline']?><?php endif?></span><?php endif?>
                    </a>
                </td>
                <td class="rb-user">
                    <?php echo $_M[$_HS['nametype']]?>
                </td>
                <td class="rb-time"><time class="timeago" data-toggle="tooltip" datetime="<?php echo getDateFormat($R['d_regis'],'c')?>" data-tooltip="tooltip" title="<?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?>"><?php echo getDateFormat($R['d_regis'],'Y.m.d')?></time></td>
                <td class="rb-hit"><?php echo $R['hit']?></td>
            </tr>
            <?php endwhile?>
        </tbody>
    </table>
</div>
<?php else:?>
 <div class="rb-bbs-body rb-nopost">
      <h2 class=""><i class="fa fa-exclamation-circle fa-4x"></i></h2>
       <p>등록된 자료가 없습니다.</p>
 </div>
<?php endif?>
