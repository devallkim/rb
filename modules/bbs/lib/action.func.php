<?php

// 게시물 태그추출 함수
function getPostTag($tag,$bid){
  global $g,$r;
  $_tags=explode(',',$tag);
  $_tagn=count($_tags);
  $html='';
  $bbs_list = $g['url_root'].'/?r='.$r.'&m=bbs&bid='.$bid;
  $i=0;
  for($i = 0; $i < $_tagn; $i++):;
    $_tagk=trim($_tags[$i]);
    $html.='<a href="'.$bbs_list.'&amp;where=subject|tag&amp;keyword='.$_tagk.'" class="badge badge-primary badge-outline">';
    $html.=$_tagk;
    $html.='</a>';
  endfor;
  return $html;
}

// 첨부파일 리스트 갯수 추출 함수
function getAttachNum($upload,$mod){
  global $table;

  $attach = getArrayString($upload);
  $attach_file_num=0;// 첨부파일 수량
  $hidden_file_num=0; // 숨김파일(다운로드 방지) 수량
  foreach($attach['data'] as $val)
  {
    $U = getUidData($table['s_upload'],$val);
    if($U['fileonly']==1) $attach_file_num++; // 전체 첨부파일 수량 증가
    if($U['hidden']==1) $hidden_file_num++; // 숨김파일 수량 증가
  }
      $down_file_num=$attach_file_num-$hidden_file_num; // 다운로드 가능한 첨부파일
      $result=array();
      $result['modify']=$attach_file_num;
      $result['view']=$down_file_num;

      return $result[$mod];
}

// 첨부파일 리스트 추출 함수 (전체)
/*
   $parent_data : 해당 포스트의 row 배열
   $mod : upload or modal  ==> 실제 업로드 모드 와 모달을 띄워서 본문에 삽입용도로 쓰거나
*/
function getAttachFileList($parent_data,$mod,$type){
  global $table;

     $upload=$parent_data['upload'];
     $featured_img_uid=$parent_data['featured_img'];// 대표이미지 uid
     $featured_video_uid=$parent_data['featured_video'];// 대표비디오 uid
     $featured_audio_uid=$parent_data['featured_audio'];// 대표오디오 uid

     if($type=='file') $sql='type=1 and hidden=0';
     else if($type=='photo') $sql='type=2 and hidden=0';
     else if($type=='audio') $sql='type=4 and hidden=0';
     else if($type=='video') $sql='type=5 and hidden=0';
     else if($type=='doc') $sql='type=6 and hidden=0';
     else if($type=='zip') $sql='type=7 and hidden=0';
     else $sql='type=1';

     $attach = getArrayString($upload);
     $uid_q='(';
     foreach($attach['data'] as $uid)
      {
        $uid_q.='uid='.$uid.' or ';
      }
      $uid_q=substr($uid_q,0,-4).')';
      $sql=$sql.' and '.$uid_q;
      $RCD=getDbArray($table['s_upload'],$sql,'*','gid','desc','',1);
      $html='';
      while($R=db_fetch_array($RCD)){
        $U=getUidData($table['s_upload'],$R['uid']);

        if($type=='file') $html.=getAttachFile($U,$mod,$featured_img_uid);
        else if($type=='photo') $html.=getAttachPhoto($U,$mod,$featured_img_uid);
        else if($type=='audio') $html.=getAttachAudio($U,$mod,$featured_audio_uid);
        else if($type=='video') $html.=getAttachVideo($U,$mod,$featured_video_uid);
        else $html.=getAttachFile($U,$mod,$featured_img_uid);;
      }
  return $html;
}

function getAttachObjectArray($parent_data,$type){
  global $table;

     $upload=$parent_data['upload'];
     $featured_img_uid=$parent_data['featured_img'];// 대표이미지 uid
     $featured_video_uid=$parent_data['featured_video'];// 대표비디오 uid
     $featured_audio_uid=$parent_data['featured_audio'];// 대표오디오 uid

     if($type=='file') $sql='type=1 and hidden=0';
     else if($type=='photo') $sql='type=2 and hidden=0';
     else if($type=='audio') $sql='type=4 and hidden=0';
     else if($type=='video') $sql='type=5 and hidden=0';
     else if($type=='doc') $sql='type=6 and hidden=0';
     else if($type=='zip') $sql='type=7 and hidden=0';
     else $sql='type=1';

     $attachArray = [];
     $attach = getArrayString($upload);
     $uid_q='(';
     foreach($attach['data'] as $uid)
      {
        $uid_q.='uid='.$uid.' or ';
      }
      $uid_q=substr($uid_q,0,-4).')';
      $sql=$sql.' and '.$uid_q;
      $RCD=getDbArray($table['s_upload'],$sql,'*','gid','asc','',1);

      // Loop through query and push results into $someArray;
      // while ($R = mysqli_fetch_assoc($query)) {
      while($R=db_fetch_array($RCD)){
        $U=getUidData($table['s_upload'],$R['uid']);
        $src = $U['url'].$U['folder'].'/'.$U['tmpname'];
        array_push($attachArray, [
          'src'   => $src,
          'w' => $U['width'],
          'h' => $U['height'],
          'title' => $U['caption']
        ]);
      }
  return $attachArray;
}


// 첨부파일 리스트 추출 함수 (낱개)
function getAttachPhoto($R,$mod,$featured_img_uid) {
  global $g,$r;

  $fileName=explode('.',$R['name']);
  $file_name=$fileName[0]; // 파일명만 분리

  $caption=$R['caption']?$R['caption']:$file_name;
  $img_origin=$R['url'].$R['folder'].'/'.$R['tmpname'];
  $img_origin_size=$R['width'].'x'.$R['height'];
  $thumb_list=getPreviewResize($img_origin,'c'); // 미리보기 사이즈 조정 (이미지 업로드시 썸네일을 만들 필요 없다.)
  $thumb_modal=getPreviewResize($img_origin,'q'); // 정보수정 모달용  사이즈 조정 (이미지 업로드시 썸네일을 만들 필요 없다.)
  $insert_text='!['.$caption.']('.$g['url_root'].$img_origin.')';

  $html='';
  $html.='
   <figure class="card figure" data-id="'.$R['uid'].'">';

   $html.='
       <a href="'.$img_origin.'" data-size="'.$img_origin_size.'">
       <img class="card-img-top img-fluid" src="'.$img_origin.'" alt="'.$caption.'">
       <button type="button" class="btn"><i class="fa fa-search-plus fa-lg" aria-hidden="true"></i></button>
       </a>
       <figcaption class="figure-caption hidden">'.$caption.'</figcaption>';

            $html.='
        </div>

      </figure>';

  return $html;
}

// 첨부파일 리스트 추출 함수 (낱개)
function getAttachFile($R,$mod,$featured_img_uid) {
  global $g,$r;

      $fileName=explode('.',$R['name']);
      $file_name=$fileName[0]; // 파일명만 분리

      if ($R['type']==2) {
        $type='photo';
      } elseif($R['type']==4) {
        $type='audio';
      } elseif($R['type']==5) {
        $type='video';
      } else {
        $type='file';
      }


      if($type=='photo'){
        $caption=$R['caption']?$R['caption']:$file_name;
        $img_origin=$R['url'].$R['folder'].'/'.$R['tmpname'];
        $thumb_list=getPreviewResize($img_origin,'c'); // 미리보기 사이즈 조정 (이미지 업로드시 썸네일을 만들 필요 없다.)
        $thumb_modal=getPreviewResize($img_origin,'q'); // 정보수정 모달용  사이즈 조정 (이미지 업로드시 썸네일을 만들 필요 없다.)
      }else if($type=='file'){
        $src=$R['url'].$R['folder'].'/'.$R['name'];
        $download_link=$g['url_root'].'/?r='.$r.'&m=mediaset&a=download&uid='.$R['uid'];
      }


      $html='';
  $html.='
   <li class="table-view-cell" data-id="'.$R['uid'].'"><a href="'.$download_link.'">';

   if($R['type']==2){
        $html.='
            <img class="media-object pull-left" src="'.$thumb_list.'" alt="'.$caption.'">
            <div class="media-body">';
                $html.='<span class="badge badge-default'.($R['uid']==$featured_img_uid?'':' hidden-xs-up').'" data-role="attachList-label-featured" data-id="'.$R['uid'].'">대표</span> ';
                $html.='<span class="badge badge-default'.(!$R['hidden']?' hidden-xs-up':'').'" data-role="attachList-label-hidden-'.$R['uid'].'">숨김</span>';
                $html.='
                <a href="#" data-role="attachList-list-name-'.$R['uid'].'" data-attach-act="insert" data-type="'.$type.'" data-origin="'.($R['type']==2?$img_origin:$src).'" data-caption="'.$caption.'">'.$R['name'].'</a>
                <span class="rb-size">'.getSizeFormat($R['size'],2).'</span>
            </div>';

      }else {
            $html.='
            <span class="media-object pull-left"><i class="fa fa-floppy-o fa-fw fa-2x"></i></span>';
           $html.='<div class="media-body"><span class="badge badge-default'.(!$R['hidden']?' hidden-xs-up':'').'" data-role="attachList-label-hidden-'.$R['uid'].'">숨김</span>';
           $html.=$R['name'].'
            <p>'.getSizeFormat($R['size'],2).'</p>
            </div>';
      }

  return $html;
}

// 오디오파일 리스트 추출 함수 (낱개)
function getAttachAudio($R,$mod,$featured_audio_uid) {
    global $g,$r;

    $fileName=explode('.',$R['name']);
    $file_name=$fileName[0]; // 파일명만 분리
    $caption=$R['caption']?$R['caption']:$file_name;

    $html='';
    $html.='
    <li class="table-view-cell p-0" data-id="'.$R['uid'].'">';
    $html.='<span class="badge badge-default'.($R['uid']==$featured_audio_uid?'':' hidden-xs-up').'" data-role="attachList-label-featured" data-id="'.$R['uid'].'">대표</span> ';
    $html.='<span class="badge badge-default'.(!$R['hidden']?' hidden-xs-up':'').'" data-role="attachList-label-hidden-'.$R['uid'].'">숨김</span>';
    $html.='
    <audio controls data-plugin="mediaelement" class="w-100"><source src="'.$R['url'].$R['folder'].'/'.$R['tmpname'].'" type="audio/mpeg"></audio>';
    $html.='</li>';
    return $html;
}

// 비디오파일 리스트 추출 함수 (낱개)
function getAttachVideo($R,$mod,$featured_video_uid) {
    global $g,$r;

    $fileName=explode('.',$R['name']);
    $file_name=$fileName[0]; // 파일명만 분리
    $caption=$R['caption']?$R['caption']:$file_name;

    $html='';
    $html.='
    <div class="card bg-white" data-id="'.$R['uid'].'">';
    $html.='
    <video controls data-plugin="mediaelement" class="card-img-top img-fluid" width="640" height="360" style="max-width:100%;"><source src="'.$R['url'].$R['folder'].'/'.$R['tmpname'].'" type="video/'.$R['ext'].'"></video>';
    $html.='<div class="card-block"><h5 class="card-title">'.$R['name'].'</h5>';
    $html.='
    <p class="card-text text-muted"><small>'.getSizeFormat($R['size'],2).'</small></p></div></div>';

    return $html;
}


// 본문삽입 이미지 uid 얻기 함수
function getInsertImgUid($upload)
{
    global $table;

    $u_arr = getArrayString($upload);
    $Insert_arr=array();
    $i=0;
    foreach ($u_arr['data'] as $val) {
       $U=getUidData($table['s_upload'],$val);
       if(!$U['fileonly']) $Insert_arr[$i]=$val;
       $i++;
    }
    $upfiles='';
    // 중괄로로 재조립
    foreach ($Insert_arr as $uid) {
        $upfiles.='['.$uid.']';
    }

    return $upfiles;
}

// youtube
function getAttachPlatformList($parent_data,$mod,$type) {
  global $table;

      $upload=$parent_data['upload'];
      $featured_img_uid=$parent_data['featured_img'];// 대표이미지 uid

      $sql='type=8';
      $attach = getArrayString($upload);

      $uid_q='(';
      foreach($attach['data'] as $uid)
     {
         $uid_q.='uid='.$uid.' or ';
     }

     $uid_q=substr($uid_q,0,-4).')';
       $sql=$sql.' and '.$uid_q;
       $RCD=getDbArray($table['s_upload'],$sql,'*','gid','desc','',1);
       $html='';
       while($R=db_fetch_array($RCD)){
             $U=getUidData($table['s_upload'],$R['uid']);
         $html.=getAttachPlatform($U,$mod,$featured_img_uid);
       }
  return $html;

}

// Youtube 추출 함수 (낱개)
function getAttachPlatform($R,$mod) {
      global $g,$r;

      $html='';

      if($mod=='view'){
        $html.='<div class="card"><video data-plugin="mediaelement" class="img-responsive img-fluid"  style="max-width:100%" preload=none><source src=https://www.youtube.com/embed/'.$R['src'].' type=video/youtube></video></div>';
      }

      if($mod=='upload'){

        $md_title=str_replace('|','-',$R['title']);
        $insert_text='<video data-plugin="mediaelement" class="img-responsive img-fluid"  style="max-width:100%" preload=none><source src=https://www.youtube.com/embed/'.$R['src'].' type=video/youtube></video>';
        $html.='
        <li class="list-group-item d-flex" data-id="'.$R['uid'].'" style="background-color: transparent">';

          $html.='
              <div class="media w-75 mr-auto align-items-center">
                  <img class="d-flex align-self-center mr-3" src="/files/youtube/'.$R['name'].'/thumb_50x50.jpg" alt="">
                  <div class="media-body">';
                      $html.='<span class="badge badge-pill badge-warning '.($R['uid']==$featured_img_uid?'':'hidden').'" data-role="attachList-label-featured" data-id="'.$R['uid'].'">대표</span> ';
                      $html.='<span class="badge badge-pill badge-default '.(!$R['hidden']?'hidden':'').'" data-role="attachList-label-hidden-'.$R['uid'].'">숨김</span>';
                      $html.='
                       <div class="title d-inline" data-role="attachList-list-name-'.$R['uid'].'" >'.($R['caption']?$R['caption']:'제목없음').'</div>
                       <div class="meta"><span class="badge badge-pill badge-danger">Youtube</span> <span class="badge badge-pill badge-default" data-role="attachList-list-time-'.$R['uid'].'">'.$R['time'].'</span></div>
                  </div>
              </div>';

              $html.='
              <span class="ml-auto">
                <div class="btn-group btn-group-sm">';
                    $html.='<input type="hidden" name="attachfiles[]" value="['.$R['uid'].']"/>';
                     $html.='
                     <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-attach-'.($R['type']==8?'youtube':'file').'-meta" data-filename="'.$R['name'].'"  data-caption="'.$R['caption'].'" data-description="'.$R['description'].'" data-time="'.$R['time'].'" data-id="'.$R['uid'].'" data-type="'.($R['type']==8?'youtube':'file').'" data-role="attachList-menu-edit-'.$R['uid'].'"  role="button">정보등록</button>
                     <button type="button" class="btn btn-secondary" data-attach-act="delete" data-id="'.$R['uid'].'" data-role="attachList-menu-delete-'.$R['uid'].'" data-featured="" data-type="'.($R['type']==8?'youtube':'file').'" role="button">삭제</button>';
                    $html.='
                    <div class="btn-group"><button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" role="button">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a class="dropdown-item" href="#" data-attach-act="featured-img" data-type="'.$type.'" data-id="'.$R['uid'].'">대표이미지 설정</a>
                      <a class="dropdown-item" href="#" data-attach-act="showhide" data-role="attachList-menu-showhide-'.$R['uid'].'" data-id="'.$R['uid'].'" data-content="'.($R['hidden']?'show':'hide').'" >'.($R['hidden']?'보이기':'숨기기').'</a>
                     </div>
                     </div>

                </div>
              </span>';
            $html.='
            </li>';
          }

  return $html;
}


?>
