<?php
if(!defined('__KIMS__')) exit;
if(!$my['uid']) exit;

include $g['path_core'].'function/email.func.php';

$m = 'orgs';
$_ORG = getDbData($table[$m.'data'],"memberuid='".$org."'",'*');
$MBR = getDbData($table['s_mbrdata'],'nic="'.$nic.'"','memberuid,name,photo,email');
$_isAdd = getDbRows($table[$m.'member'],'mbruid='.$MBR['memberuid'].' and org='.$org);
$_isOwner = getDbRows($table[$m.'member'],'mbruid='.$my['uid'].' and org='.$org.' and owner=1');
$MBRID = getDbData($table['s_mbrid'],'uid='.$MBR['memberuid'],'uid,id');
$mbruid = $MBR['memberuid'];
?>

<?php if ($_isAdd): ?>
[RESULT:



:RESULT]
<?php else: ?>

  [RESULT:
   <li class="list-group-item p-2 d-flex justify-content-between align-items-center animated fadeInUp" id="member-item-<?php echo $MBRID['uid']?>">
     <a href="/<?php echo $MBRID['id'] ?>" class="muted-link">
       <img class="mr-1 avatar align-self-center" src="/_var/avatar/<?php echo $MBR['photo']?$MBR['photo']:'0.gif' ?>" width="32" height="32">
       <?php echo $nic ?>
     </a>
     <div class="">
       <span class="badge badge-pill badge-secondary"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i> 초대됨</span>
       <button class="btn btn-link muted-link js-delete" type="button" name="button" data-uid="<?php echo $MBRID['uid']?>">
         <i class="fa fa-times" aria-hidden="true"></i>
       </button>
     </div>
   </li>
  :RESULT]


  <?php
  $_QKEY = "org,mbruid,auth,team,gid,owner,d_regis";
  $_QVAL = "'$org','$mbruid','0','','','','".$date['totime']."'";
  getDbInsert($table[$m.'member'],$_QKEY,$_QVAL);

  // 초대등록
  $_QKEY2 = "org,from_mbruid,to_mbruid,accept,d_regis";
  $_QVAL2 = "'$org','".$my['uid']."','$mbruid','0','".$date['totime']."'";
  getDbInsert($table[$m.'invite'],$_QKEY2,$_QVAL2);

  // 이메일 보내기
  $to      = $MBR['email'].'|'.$MBR['nic']; //받는사람 (이름 없을 경우 이메일만 기록)
  $from    = 'noreply@kimsq.com|'.$my['nic']; //보내는사람 (이름 없을 경우 이메일만 기록)
  $subject = '[킴스큐]'.$my['nic'].'님이 회원님을 '.$_ORG['name'].' 에 구성원으로 참여를 요청했습니다.';
  $invitation = 'https://kimsq.com/orgs/'.$org_id.'/invitation';
  $content= '<p>';
  $content.= '<a href="'.$invitation.'" target="_blank">참여요청 내역 보기</a>';
  $content.= '</p>';
  getSendMail($to,$from,$subject,$content,'HTML');

  // 알림보내기
  putNotice($mbruid,$org_id,$my['uid'],$_ORG['name'].' 에 구성원으로 참여를 요청했습니다.','','');

  exit;
  ?>

<?php endif; ?>
