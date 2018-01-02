<?php
  //if(!$my['admin']) getLink($g['s'],'','접근권한이 없습니다.','');
?>

<?php
// 이전글 다음글 구하기
$_bbsque ="site='".$s."' and bbs='".$B['uid']."' and category='".$cat."'";
$prev_uid=getDbCnt($table[$m.'data'],'max(uid)',$_bbsque.' and uid<'.$uid);
$next_uid=getDbCnt($table[$m.'data'],'min(uid)',$_bbsque.' and uid>'.$uid);
$prev_link=$g['bbs_view'].$prev_uid;
$next_link=$g['bbs_view'].$next_uid;
$subject = getStrCut($R['subject'],$d['bbs']['sbjcut'],'...');

// 연락처/이메일 추출
$adddata = explode('^^',$R['adddata']);
$tel = $adddata[0];
$email = $adddata[1];

?>
<link href="<?php echo $g['url_module_skin']?>/_main.css" rel="stylesheet">
<section class="rb-bbs rb-bbs-view mt-1">

  <div class="bbs-header mt-3 d-flex">
    <h2 class=""><i class="fa fa-circle-o text-primary" aria-hidden="true"></i> 메일로 문의하기</h2>
    <a href="<?php echo $g['bbs_list']?>" class="btn btn-primary ml-auto">목록</a>
  </div>

  <div class="card mt-1">
    <div class="card-header">
      <strong><?php echo $subject?></strong>
      <div class="d-flex">
        <div class="">
          <ul class="list-inline mb-0">
            <li class="list-inline-item"><?php echo getDateFormat($R['d_regis'],'Y.m.d')?></li>
            <li class="list-inline-item">작성자 : <?php echo $R[$_HS['nametype']]?></li>
          </ul>
        </div>
        <div class="ml-auto">
           <ul class="list-inline mb-0">
             <li class="list-inline-item"><?php echo $email?></li>
             <li class="list-inline-item"><?php echo $tel?></li>
           </ul>
        </div>
      </div><!-- /.row -->
    </div><!-- /.card-header -->

    <div class="card-block">
     <?php echo getContents($R['content'],$R['html'])?>
    </div><!-- /.card-block -->
    <?php $last_attach=$d['upload']['count']-$hidden_file_num; //  _view.php 61 라인에 추가 2015. 1. 2 ?>
    <?php if($d['upload']['data']&&$d['theme']['show_upfile']&&$last_attach>0):?>
    <div class="card-block">
        <section class="rb-comments mt-3">
            <h1 class="h5">첨부 (<span class="text-danger"><?php echo $last_attach?></span>)</h1>
            <ul class="list-group">
                <?php foreach($d['upload']['data'] as $_u):?>
                <?php if($_u['hidden'])continue?>
                <?php
                   $ext_to_fa=array('xls'=>'excel','xlsx'=>'excel','ppt'=>'powerpoint','pptx'=>'powerpoint','txt'=>'text','pdf'=>'pdf','zip'=>'archive','doc'=>'word');
                   $ext_icon=in_array($_u['ext'],array_keys($ext_to_fa))?'-'.$ext_to_fa[$_u['ext']]:'';
                 ?>
                   <li class="list-group-item"><i class="fa fa-file<?php echo $ext_icon?>-o"></i>
                    <a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=attach&amp;a=download&amp;uid=<?php echo $_u['uid']?>" title="<?php echo $_u['caption']?>"><?php echo $_u['name']?></a>
                    <small class="text-muted">(<?php echo getSizeFormat($_u['size'],1)?>)</small> <span title="다운로드 수" data-toggle="tooltip" class="badge hidden-xs"><?php echo number_format($_u['down'])?></span>
                    <?php if($my['admin']):?>
                  <a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=bbs&amp;a=delete_attach&amp;uid=<?php echo $_u['uid']?>" class="btn btn-danger btn-xs" onclick="return confirm('정말로 삭제하시겠습니까?');" data-toggle="tooltip" title="삭제"> <i class="fa fa-trash-o fa-lg"></i></a>
                  <?php endif?>
                </li>
              <?php endforeach?>

        </section>
    </div>
    <?php endif?>

    <div class="card-footer">

      <div class="d-flex justify-content-between">
        <div class="">

        <?php if($my['admin'] || $my['uid']==$R['mbruid']):?>
          <a href="<?php echo $g['bbs_modify'].$R['uid']?>" class="btn btn-secondary">수정</a>
          <a href="<?php echo $g['bbs_delete'].$R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');" class="btn btn-secondary">삭제</a>
         <?php endif?>

        </div>
        <div class="">
          <a href="<?php echo $prev_link?>" class="btn btn-secondary<?php echo !$prev_uid?' disabled':''?>">이전글</a>
          <a href="<?php echo $next_link?>" class="btn btn-secondary<?php echo !$next_uid?' disabled':''?>">다음글</a>
        </div>
        <div class="">
          <a href="<?php echo $g['bbs_list']?>" class="btn btn-secondary">목록</a>
        </div>
      </div>

    </div><!-- /.carfooter -->

  </div><!-- /.card -->

</section>

<div class="card card-block my-4">
  <?php getWidget('default/comment',array('theme'=>'default-bs4','parent'=>$m.'-'.$R['uid'],'feed_table'=>$table[$m.'data']));?>
</div>



<!-- autosize : http://www.jacklmoore.com/autosize/ -->
<?php getImport('autosize','autosize.min',false,'js') ?>

<script>
$(document).ready(function(){
    autosize($('textarea'));
    $("body").append('<div class="modal fade" id="modal-report"></div>'); // 신고모달 생성

});

// 신고모달 관련 스크립트
$(function(){
    // 모달 오픈시 이벤트
    $('#modal-report').on('show.bs.modal',function(e){
        var triger = e.relatedTarget;
        var title = $(triger).data('title');
        var user = $(triger).data('user');
        var bbs_name = $(triger).attr('data-bbsName');
        var my_mbruid = $(triger).data('mbruid'); // 작성자 uid
        var module = $(triger).data('module'); // chanel,bbs,blog,comment...
        var entry = $(triger).data('entry'); // 댓글 or 게시글 uid


        var modal = $(this);
        $(modal).load("<?php echo $g['dir_module_skin']?>/component/modal-report.php",function(){
            var form =$('#form-post-report');
            var radioChk = $(form).find('.custom-control-input');
            $(modal).find('[data-role="title"]').text(title);
            $(modal).find('[data-role="user"]').text(user);
            $(modal).find('[data-role="bbs_name"]').text(bbs_name);
            $(modal).find('input[name="module"]').val(module);
            $(modal).find('input[name="my_mbruid"]').val(my_mbruid);
            $(modal).find('input[name="entry"]').val(entry);

            // 신고사유 선택 이벤트(기타사유)
            $(radioChk).on('click',function(){
               var val = $(this).val();
               if(val==4) $('#report-message').show();
               else $('#report-message').hide();
            });

            // 신고내용 전송 이벤트
            $('[data-role="btn-report"]').on('click',function(){
                var m = '<?php echo $m?>';
                var postData = $(form).serializeArray();
                var formURL = rooturl+'/?m='+m+'&a=regis_report';
                $.ajax({
                    url : formURL,
                    type: "POST",
                    data : postData,
                    success:function(response, textStatus, jqXHR){
                        var result = $.parseJSON(response);
                        var error = result.error;
                        if(!error){
                           feedback.show("신고가 접수되었습니다.");
                           $('#modal-report').modal('hide');
                        }else{
                           feedback.show('관리자에게 문의해주시기 바랍니다.');
                        }
                      },
                        error: function(jqXHR, textStatus, errorThrown){
                      }
                 });
            });
        });
    });

    // 모달 닫을시 이벤트
    $('#modal-report').on('hidden.bs.modal',function(e){
        $(this).empty()
    });
});

</script>
