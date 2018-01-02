<?php
if(!defined('__KIMS__')) exit;
//require_once $g['path_layout'].'rc-kfm/_includes/Rb.class.php';
//require_once $g['path_layout'].'rc-kfm/_includes/Module.class.php';
//$module=new Module();

include_once $g['path_module'].$m.'/lib/tree.func.php';

$sort = $_GET['sort']; // 정렬 기준
$orderby = $_GET['orderby']; // 정렬순서
$recnum = $_GET['recnum']; // 출력갯수
$page = $_GET['page']; // 처음엔 무조건 1
$_where = $_GET['_where']; // 출력 조건 : 이 부분은 해당 위젯과 맞춰준다. 만약 동적으로 변경되야 하면 파라미터로 넘겨줘야 하다.
$title =  $_GET['title']; // $wdgvar['title'] 데이터 전달

$result=array();
$result['error'] = false;

//$RCD = getDbArray($table[$m.'catidx'].','.$table[$m.'data'],$_where,'*',$sort,$orderby,$recnum,$page);
//$NUM = getDbRows($table[$m.'catidx'].','.$table[$m.'data'],$_where);

$RCD=getDbArray($table[$m.'catidx'],$_where,'post','post','desc',$recnum,$page);
$NUM = getDbRows($table[$m.'catidx'],$_where);

$html='';

while($C = db_fetch_array($RCD)){

  $R = getDbData($table[$m.'data'],'uid='.$C['post'],'uid,step,isreserve,subject,content,d_published,upload,featured_img,mbruid');

  $img='';
  if($R['upload'])
  {
      $img=getUpImageSrc($R); // sys.func.php 파일 참조
      $img_data=array('src'=>$img,'width'=>'180','height'=>'140','qulity'=>'90','filter'=>'','align'=>'');
  }

   $html.='
    <li class="table-view-cell media">
      <a class=""  tabindex="-1"
        data-toggle="modal"
        data-target="#widget-newView05"
        data-uid="'.$R['uid'].'"
        data-markup="blogView"
        data-mod="view"
        data-name="'.getPostData($R,'mbr_name').'"
        data-date="'.getDateFormat($R['d_published'],'Y-m-d H:i').'"
        data-register="'.$R['mbruid'].'"
        data-title="'.$title.'"
        data-url="/news/view/'.$R['uid'].'"
        data-subject="'.htmlspecialchars($R['subject']).'">';

      if($img) $html.='
          <img class="media-object pull-left" src="'.getTimThumb($img_data).'" alt="'.htmlspecialchars($R['subject']).'" style="width: 90px;height:70px">';

      $html.='
        <div class="media-body">
          <h3>'.getStrCut(htmlspecialchars($R['subject']),$title_len,'...').'</h3>
          <p class="clearfix">
            <span class="pull-xs-left badge badge-default badge-inverted">
              <i class="fa fa-clock-o" aria-hidden="true"></i> '.getDateFormat($R['d_published'],'Y-m-d').'
            </span>
            <span class="pull-xs-right badge badge-primary badge-inverted hidden">
              <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
              <span class="text-muted"></span>
            </span>
          </p>
        </div>

      </a>
    </li>';
}
$result['content'] = $html;
echo json_encode($result);
exit;
?>
