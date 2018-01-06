<?php
if(!defined('__KIMS__')) exit;
require_once $g['path_module'].'keywordset/_main.php'; // 공통함수 파일
$KWS=getUidData($table['keywordsetdata'],$uid);
$TG=getDbData($table['s_tag'],"keyword='".$KWS['name']."'",'*'); // s_tag uid 추출
$TBD=getDbSelect($table['s_tagrelation'],"module='set' and tag='".$TG['uid']."'",'*');
$i=0;
$WH='(';
while($TB=db_fetch_array($TBD)){
      $WH .='uid='.$TB['entry'].' or ';
      $i++;
 }
$WH =substr($WH,0,-4).')';

$RCD=getDbArray($table['setdata'],$WH,'*','uid','desc','20',1);
$NUM=getDbRows($table['setdata'],$WH);
while($R=db_fetch_array($RCD)) $BCD[]=$R;
$result=array();
$result['error']=false;
$list='
<ul class="table-view rb-thumbnails-01">';
	 foreach ($BCD as $R){
          $preview_img=getPostData($R,'preview_img');
          $img_data=array('src'=>$preview_img,'width'=>'230','height'=>'230');

         $list.='<li class="table-view-cell media">
            <a href="#" id="rb_set_data-'.$R['uid'].'" data-modal-open="postview-01">
             <img class="media-object pull-left" src="'.getTimThumb($img_data).'">
             <div class="media-body">
                 <strong>'.getPostData($R,'title').'</strong>
              <p>'.getPostData($R,'summary').'</p>
              <small>
                 <span class="badge badge-inverted">'.getPostData($R,'mbr_name').'</span>
                  <span class="badge badge-inverted"><i class="fa fa-clock-o"></i><time class="timeago" data-toggle="tooltip" datetime="'.getDateFormat($R['d_regis'],'c').'" data-tooltip="tooltip" title="'.getDateFormat($R['d_regis'],'Y.m.d H:i').'"></time></span>
             </small>
             </div>
           </a>
      </li>';
     }
$list.='</ul>';
$img_src=$KWS['img_src'];
$img_data=array('src'=>$img_src,'width'=>'600','height'=>'180');
$result['img_src']=getTimThumb($img_data);
$result['list']=trim($list);
echo json_encode($result,true);
exit;
?>
