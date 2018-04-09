<?php
// 첨부파일 리스트 갯수 추출 함수
function getAttachNum($upload,$mod)
{
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
function getAttachFileList($parent_data,$mod,$type) {
    global $table;

     $upload=$parent_data['upload'];
     $featured_img_uid=$parent_data['featured_img'];// 대표이미지 uid

     if($type=='photo') $sql='type=2';
     else if($type=='audio') $sql='type=4';
     else if($type=='file') $sql='(type=1 or type=3 or type=6 or type=7)';

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
        $html.=getAttachFile($U,$mod,$featured_img_uid);
      }

    return $html;
}


// 첨부파일 리스트 추출 함수 (낱개)
function getAttachFile($R,$mod,$featured_img_uid)
{
    global $g,$r;

      $fileName=explode('.',$R['name']);
      $file_name=$fileName[0]; // 파일명만 분리

      if ($R['type']==2) {
        $type='photo';
      } elseif ($R['type']==4) {
        $type='audio';
      } else {
        $type='file';
      }

      if($type=='photo'){
            $caption=$R['caption']?$R['caption']:$file_name;
            $img_origin=$R['url'].$R['folder'].'/'.$R['tmpname'];
            if($R['ext']!='svg'){
                 $thumb_list=getPreviewResize($img_origin,'s'); // 미리보기 사이즈 조정 (이미지 업로드시 썸네일을 만들 필요 없다.)
                 $thumb_modal=getPreviewResize($img_origin,'q'); // 정보수정 모달용  사이즈 조정 (이미지 업로드시 썸네일을 만들 필요 없다.)
            }else{
                 $thumb_list=$img_origin;
                 $thumb_modal=$img_origin;
            }
            $insert_text='!['.$caption.']('.$img_origin.')';

      }else if($type=='audio'){
            $caption=$R['caption']?$R['caption']:$R['name'];
            $src=$R['url'].$R['folder'].'/'.$R['tmpname'];
            $insert_text='<audio src='.$src.' controls  preload=auto class=w-100></audio>';
            // $insert_text='['.$caption.']('.$g['url_root'].'/?r='.$r.'&m=attach&a=download&uid='.$R['uid'].')';

      }else if($type=='file'){
            $caption=$R['caption']?$R['caption']:$R['name'];
            $src=$R['url'].$R['folder'].'/'.$R['tmpname'];
            // $insert_text='['.$caption.']('.$src.')';
            $insert_text='['.$caption.']('.$g['url_root'].'/?r='.$r.'&m=mediaset&a=download&uid='.$R['uid'].')';
      }
      $html='';
    $html.='
     <li class="list-group-item" data-id="'.$R['uid'].'">
          <span class="pull-right">
              <div class="btn-group btn-group-sm">';
                 if($mod=='upload')  $html.='<input type="hidden" name="attachfiles[]" value="['.$R['uid'].']"/>';
                  $html.='
                  <button type="button" class="btn btn-light" data-attach-act="insert-'.($R['type']==2?'photo':($R['type']==4?'audio':'file')).'" data-type="'.$type.'" data-origin="'.($R['type']==2?$img_origin:$src).'" data-caption="'.$caption.'" data-role="attachList-menu-insert-'.$R['uid'].'"><i class="fa fa-code fa-lg"></i></button>';
                  if($mod=='upload'){
                  $html.='
                  <div class="btn-group btn-group-sm" role="group">
                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">';
                      if($R['type']==2){
                        $html.='
                          <a class="dropdown-item"  href="#" data-attach-act="featured-img" data-type="'.$type.'" data-id="'.$R['uid'].'">대표이미지 설정</a>';
                       }
                       $html.='
                      <a class="dropdown-item"  href="#modal-attach-'.($R['type']==2?'photo':($R['type']==4?'audio':'file')).'-meta"
                            data-filename="'.$file_name.'" data-toggle="modal" data-fileext="'.$R['ext'].'" data-caption="'.$R['caption'].'" data-src="'.($R['type']==2?$thumb_modal:$src).'"  data-id="'.$R['uid'].'" data-type="'.$type.'" data-role="attachList-menu-edit-'.$R['uid'].'">정보수정</a>
                      <a class="dropdown-item"  href="#" data-attach-act="copy" data-plugin="clipboard" data-clipboard-text="'.$insert_text.'" data-role="attachList-menu-copy-'.$R['uid'].'">삽입코드 복사</a>
                      <a class="dropdown-item"  href="#" data-attach-act="showhide" data-role="attachList-menu-showhide-'.$R['uid'].'" data-id="'.$R['uid'].'" data-content="'.($R['hidden']?'show':'hide').'" >'.($R['hidden']?'보이기':'숨기기').'</a>
                      <a class="dropdown-item"  href="#" data-attach-act="delete" data-id="'.$R['uid'].'" data-role="attachList-menu-delete-'.$R['uid'].'" data-featured="" data-type="'.$type.'">삭제</a>
                     </div>
                   </div>';
                  }
                  $html.='
              </div>
          </span>';
     if($R['type']==2){
          $html.='
            <div class="media">
             <a class="mr-2" href="#modal-attach-'.($R['type']==2?'photo':($R['type']==4?'audio':'file')).'-meta"
                   data-filename="'.$file_name.'" data-toggle="modal" data-fileext="'.$R['ext'].'" data-caption="'.$R['caption'].'" data-src="'.($R['type']==2?$thumb_modal:$src).'"  data-id="'.$R['uid'].'" data-type="'.$type.'" data-role="attachList-menu-edit-'.$R['uid'].'">
              <img src="'.$thumb_list.'" alt="'.$caption.'" style="width:50px" class="border">
              </a>
              <div class="media-body">';
                  $html.='<span class="badge badge-pill badge-primary '.($R['uid']==$featured_img_uid?'':'hidden').'" data-role="attachList-label-featured" data-id="'.$R['uid'].'">대표</span> ';
                  $html.='<span class="badge badge-pill badge-secondary'.(!$R['hidden']?'hidden':'').'" data-role="attachList-label-hidden-'.$R['uid'].'">숨김</span>';
                  $html.='
                  <a href="#" data-role="attachList-list-name-'.$R['uid'].'" data-attach-act="insert-photo" data-type="'.$type.'" data-origin="'.($R['type']==2?$img_origin:$src).'" data-caption="'.$caption.'">'.$R['name'].'</a><br>
                  <small class="text-muted">'.getSizeFormat($R['size'],2).'</small>
              </div>
            </div>';
      }else{
           $ext_arr="doc,docx,xls,xlsx,ppt,pptx,pdf,mp3";
           $file_ext=array('doc'=>'word','docx'=>'word','xls'=>'excel','xlsx'=>'excel','ppt'=>'powerpoint','pptx'=>'powerpoint','pdf'=>'pdf','mp3'=>'audio'); // 나머지는 fa-archive-o
           if(strstr($ext_arr,$R['ext'])) $ext_fa=$file_ext[$R['ext']];
           else $ext_fa='archive';
           $html.='
            <i class="fa fa-file-'.$ext_fa.'-o fa-2x fa-pull-left fa-border"></i>';
           $html.='<span class="badge badge-secondary '.(!$R['hidden']?'hidden':'').'" data-role="attachList-label-hidden-'.$R['uid'].'">숨김</span>';
           $html.='
            <a href="#" class="list-group-item-text" data-role="attachList-list-name-'.$R['uid'].'" data-attach-act="insert-'.$type.'" data-type="'.$type.'" data-origin="'.($R['type']==2?$img_origin:$src).'" data-caption="'.$caption.'">'.$R['name'].'</a>
            <span class="rb-size">'.getSizeFormat($R['size'],2).'</span>';
      }
      $html.='
      </li>';

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


function getAttachLinkList($uid,$m)
{
  global $table;

      $sql="module='".$m."' and entry='".$uid."'";
      $RCD=getDbArray($table['s_link'],$sql,'*','uid','desc','',1);
      $html='';
      while($R=db_fetch_array($RCD)){
          $html.=getAttachLink($R);
      }
  return $html;
}

// 첨부링크 추출 함수 (낱개)
function getAttachLink($R)
{
      global $g,$r;

      $md_title=str_replace('|','-',$R['title']);
      $insert_text='<p>!['.$R['title'].']('.$R['featured_img'].')</p> <p>'.$R['title'].'</p> <p>'.$R['url'].'</p><p>'.$R['description'].'</p>';
      $html='';
      $html.='
      <li class="list-group-item" data-id="'.$R['uid'].'">
            <span class="pull-right">
              <div class="btn-group btn-group-xs">';
                  $html.='<input type="hidden" name="attachLink[]" value="'.$R['uid'].'"/>';
                  $html.='
                  <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-right" role="menu">
                      <li><a href="#" data-attach-act="delete" data-id="'.$R['uid'].'" data-role="attachList-menu-delete-'.$R['uid'].'" data-featured="" data-type="'.$type.'">삭제</a></li>
                   </ul>';
                  $html.='
              </div>
            </span>';
        $html.='
            <div class="media clearfix">
                <a class="pull-left" href="#">
                    <img class="media-object" src="'.$R['featured_img'].'" alt="'.$R['title'].'" width="50px">
                </a>
                <div class="media-body">';
                    $html.='<span class="badge badge-secondary '.(!$R['hidden']?'hidden':'').'" data-role="attachList-label-hidden-'.$R['uid'].'">숨김</span>';
                    $html.='
                     <div class="previewTitle">'.$R['title'].'</div>
                     <div class="previewUrl">'.$R['url'].'</div>
                     <p class="rb-description">'.$R['description'].'</p>
                </div>
            </div>
  </li>';

  return $html;
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
function getAttachPlatform($R) {
      global $g,$r;

      $md_title=str_replace('|','-',$R['title']);
      $insert_text='<video class=mejs-player img-responsive img-fluid  style=max-width:100% preload=none><source src=https://www.youtube.com/embed/'.$R['src'].' type=video/youtube></video>';
      $html='';
      $html.='
      <li class="list-group-item" data-id="'.$R['uid'].'">
            <span class="pull-right">
              <div class="btn-group">';
                  $html.='<input type="hidden" name="attachfiles[]" value="['.$R['uid'].']"/>';
                   $html.='
                   <button type="button" class="btn btn-light" data-attach-act="copy" data-plugin="clipboard" data-clipboard-text="'.$insert_text.'" data-role="attachList-menu-copy-'.$R['uid'].'"><i class="fa fa-code fa-lg"></i></button>';
                  $html.='
                  <div class="btn-group" role="group">
                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a class="dropdown-item" href="#" data-attach-act="featured-img" data-type="'.$type.'" data-id="'.$R['uid'].'">대표이미지 설정</a>
                      <a class="dropdown-item" href="#modal-attach-'.($R['type']==8?'youtube':'file').'-meta" data-toggle="modal" data-filename="'.$R['name'].'"  data-caption="'.$R['caption'].'" data-description="'.$R['description'].'" data-time="'.$R['time'].'" data-id="'.$R['uid'].'"
                       data-type="'.($R['type']==8?'youtube':'file').'" data-role="attachList-menu-edit-'.$R['uid'].'">정보수정</a>
                      <a class="dropdown-item" href="#" data-attach-act="copy" data-plugin="clipboard" data-clipboard-text="'.$insert_text.'" data-role="attachList-menu-copy-'.$R['uid'].'">삽입코드 복사</a>
                      <a class="dropdown-item" href="#" data-attach-act="showhide" data-role="attachList-menu-showhide-'.$R['uid'].'" data-id="'.$R['uid'].'" data-content="'.($R['hidden']?'show':'hide').'" >'.($R['hidden']?'보이기':'숨기기').'</a>
                      <a class="dropdown-item" href="#" data-attach-act="delete" data-id="'.$R['uid'].'" data-role="attachList-menu-delete-'.$R['uid'].'" data-featured="" data-type="'.($R['type']==8?'youtube':'file').'">삭제</a>
                     </div>
                    </div>';
                  $html.='
              </div>
            </span>';
        $html.='
            <div class="media">
                <a class="mr-2" href="#modal-attach-'.($R['type']==8?'youtube':'file').'-meta" data-toggle="modal" data-filename="'.$R['name'].'"  data-caption="'.$R['caption'].'" data-description="'.$R['description'].'" data-time="'.$R['time'].'" data-id="'.$R['uid'].'"
                 data-type="'.($R['type']==8?'youtube':'file').'" data-role="attachList-menu-edit-'.$R['uid'].'">
                    <img src="/files/youtube/'.$R['name'].'/thumb_50x50.jpg" alt="">
                </a>
                <div class="media-body">';
                    $html.='<span class="badge badge-pill badge-primary '.($R['uid']==$featured_img_uid?'':'hidden').'" data-role="attachList-label-featured" data-id="'.$R['uid'].'">대표</span> ';
                    $html.='<span class="badge badge-pill badge-secondary '.(!$R['hidden']?'hidden':'').'" data-role="attachList-label-hidden-'.$R['uid'].'">숨김</span>';
                    $html.='
                     <div class="title" data-role="attachList-list-name-'.$R['uid'].'" >'.($R['caption']?$R['caption']:'제목없음').'</div>
                     <div class="meta"><span class="badge badge-pill badge-danger">Youtube</span> <small class="text-muted" data-role="attachList-list-time-'.$R['uid'].'">'.$R['time'].'</small></div>
                </div>
            </div>
  </li>';

  return $html;
}


?>
