 <?php
 $col_arr=array();
 $col_arr['my_confirm']=array('10','40','','80','100','100');
 $col_arr['my_all']=array('10','20','60','','100','100');
 $col_arr['my_draft']=array('10','20','60','','100','100');
 ?>
 <?php if($NUM):?>
 <div class="rb-blog-body">
    <table class="table">
        <colgroup>
           <?php
             foreach ($col_arr[$front] as $width) {
                 echo '<col width="'.$width.'" >';
             }
           ?>
        </colgroup>
        <thead>
          <tr>
            <th class="rb-check"><i class="fa fa-check"></i></th>
            <th class="rb-num">NO</th>
            <?php if($front!='my_confirm'):?>
            <th class="rb-type">구분</th>
            <?php endif?>
            <th class="rb-title">제목</th>
            <?php if($front=='my_confirm'):?>
            <th class="rb-user">글쓴이</th>
            <?php endif?>
            <th class="rb-time">작성일시</th>
            <th class="rb-time">발행일시</th>
          </tr>
        </thead>
        <tbody>
           <?php while($R=db_fetch_array($RCD)):?>
           <?php $M=getDbData($table['s_mbrdata'],'memberuid='.$R['mbruid'],'*');?>
            <tr>
                <td><input type="checkbox" name="post_members[]" value="<?php echo $R['uid']?>"></td>
                <td class="rb-num" scope="row"><?php echo $NUM-((($p-1)*$recnum)+$_rec++)?></td>
                <?php if($front!='my_confirm'):?>
                <td class="rb-type">
                  <?php if($R['use_auth']):?><span class="badge badge-secondary" data-toggle="tooltip" title="승인문서"><i class="fa fa-code-fork fa-lg"></i></span><?php endif?>
                </td>
                <?php endif?>
                <td class="rb-title">
                    <?php echo postLabel('user',$R['step'],$R['isreserve']);?> <!-- blog/lib/tree.func.php postLabel() 함수 참조 -->
                    <a href="<?php echo $g['blog_front'].(!$R['published']?'write':'list').'&uid='.$R['uid']?>"><?php echo $R['subject']?></a>
                    <?php if (!$R['published']): ?>
                      <a href="<?php echo $g['blog_front'].'list'.'&uid='.$R['uid'] ?>" class="badge badge-light" target="_blank">미리보기</a>
                    <?php endif; ?>
                </td>
                <?php if($front=='my_confirm'):?>
                <td><?php echo $M[$_HS['nametype']]?></td>
                <?php endif?>
                <td class="rb-time">
                   <?php echo getTimeagoDate($R['d_regis'],'d_regis')?>
                </td>
                <td class="rb-time">
                   <?php echo getTimeagoDate($R['d_published'],'d_published')?>
                </td>
            </tr>
            <?php endwhile?>
        </tbody>
    </table>
 </div>
<?php else:?>
 <div class="blankslate blankslate-spacious text-gray-light my-4">
    <i class="fa fa-exclamation-circle fa-4x"></i>
     <p>등록된 포스트가 없습니다.</p>
  </div>
 <?php endif?>
