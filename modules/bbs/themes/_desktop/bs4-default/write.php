<?php
if (!$_SESSION['upsescode'])
{
  $_SESSION['upsescode'] = str_replace('.','',$g['time_start']);
}
$sescode = $_SESSION['upsescode'];
if($R['uid']){
    $u_arr = getArrayString($R['upload']);
    $_tmp=array();
    $i=0;
    foreach ($u_arr['data'] as $val) {
       $U=getUidData($table['s_upload'],$val);
       if(!$U['fileonly']) $_tmp[$i]=$val;
       $i++;
    }
    $insert_array='';
    // 중괄로로 재조립
    foreach ($_tmp as $uid) {
        $insert_array.='['.$uid.']';
    }
}
?>

<link href="<?php echo $g['dir_module_skin']?>/_main.css">

<section class="rb-bbs-write">

  <?php if (!$_HM['uid']): ?>
  <header>
    <h1 class="h3"><?php echo $B['name']?></h1>
  </header>
  <?php endif; ?>


	<article>
  	<form name="writeForm" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return writeCheck(this);" role="form">
  		<input type="hidden" name="r" value="<?php echo $r?>">
  		<input type="hidden" name="a" value="write">
  		<input type="hidden" name="c" value="<?php echo $c?>">
  		<input type="hidden" name="cuid" value="<?php echo $_HM['uid']?>">
  		<input type="hidden" name="m" value="<?php echo $m?>">
  		<input type="hidden" name="bid" value="<?php echo $R['bbsid']?$R['bbsid']:$bid?>">
  		<input type="hidden" name="uid" value="<?php echo $R['uid']?>">
  		<input type="hidden" name="reply" value="<?php echo $reply?>">
  		<input type="hidden" name="nlist" value="<?php echo $g['bbs_list']?>">
  		<input type="hidden" name="pcode" value="<?php echo $date['totime']?>">
  		<input type="hidden" name="upfiles" id="upfilesValue" value="<?php echo $reply=='Y'?'':$R['upload']?>">
  		<input type="hidden" name="html" value="HTML">

      <?php if(!$my['id']):?>
      <div class="form-group row">
        <label class="col-lg-2 col-form-label text-lg-right" for="">이름</label>
        <div class="col-lg-10 col-xl-9">
          <input type="text" name="name" placeholder="이름을 입력해 주세요." value="<?php echo $R['name']?>" id="" class="form-control">
        </div>
      </div>
      <?php if(!$R['uid']||$reply=='Y'):?>
      <div class="form-group row">
        <label class="col-lg-2 col-form-label text-lg-right" for="">암호</label>
        <div class="col-lg-10 col-xl-9">
          <input type="password" name="pw" placeholder="암호는 게시글 수정 및 삭제에 필요합니다." value="<?php echo $R['pw']?>" id="" class="form-control">
          <small class="form-text text-muted">비밀답변은 비번을 수정하지 않아야 원게시자가 열람할 수 있습니다.</small>
        </div>
      </div>
      <?php endif?>
      <?php endif?>

      <?php if($B['category']):$_catexp = explode(',',$B['category']);$_catnum=count($_catexp)?>
  		<div class="form-group row">
  			<label class="col-lg-2 col-form-label text-lg-right" for="">카테고리</label>
  			<div class="col-lg-10 col-xl-9">
          <select name="category" class="form-control custom-select">
            <option value="">&nbsp;+ <?php echo $_catexp[0]?>선택</option>
            <?php for($i = 1; $i < $_catnum; $i++):if(!$_catexp[$i])continue;?>
            <option value="<?php echo $_catexp[$i]?>"<?php if($_catexp[$i]==$R['category']||$_catexp[$i]==$cat):?> selected="selected"<?php endif?>>ㆍ<?php echo $_catexp[$i]?><?php if($d['theme']['show_catnum']):?>(<?php echo getDbRows($table[$m.'data'],'site='.$s.' and notice=0 and bbs='.$B['uid']." and category='".$_catexp[$i]."'")?>)<?php endif?></option>
            <?php endfor?>
          </select>
  			</div>
  		 </div>
  		 <?php endif?>

		    <div class="form-group row">
					<label class="col-lg-2 col-form-label text-lg-right" for="">제목</label>
					<div class="col-lg-10 col-xl-9">
						<input type="text" name="subject" placeholder="제목을 입력해 주세요." value="<?php echo $R['subject']?>" id="" class="form-control">
					</div>
        </div>

        <div class="form-group row">
					<label class="col-lg-2 col-form-label text-lg-right" for=""></label>
					<div class="col-lg-10 col-xl-9">

            <?php if($my['admin']):?>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input type="checkbox" class="custom-control-input" id="notice" name="notice" value="1"<?php if($R['notice']):?> checked="checked"<?php endif?>>
              <label class="custom-control-label" for="notice">공지글</label>
            </div>
            <?php endif?>

            <?php if($d['theme']['use_hidden']==1):?>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input type="checkbox" class="custom-control-input" id="hidden" name="hidden" value="1"<?php if($R['hidden']):?> checked<?php endif?>>
              <label class="custom-control-label" for="hidden">비밀글</label>
            </div>
            <?php elseif($d['theme']['use_hidden']==2):?>
            <input type="hidden" name="hidden" value="1">
            <?php endif?>

					</div>
        </div>

        <div class="mb-3">
          <textarea id="summernote" name="content" class="d-none" rows="3"><?php echo getContents($R['content'],$R['html'])?></textarea>
        </div>

        <?php if($d['theme']['file_upload_show']&&$d['theme']['perm_upload']<=$my['level']):?>

         <?php if ($d['bbs']['attach']): ?>

           <?php if($d['theme']['perm_photo']<=$my['level']):?>
           <div class="btn-group my-3">
             <button type="button" data-role="attach-handler-file" data-type="file" class="btn btn-light" title="파일첨부" role="button" data-loading-text="업로드 중...">
               <i class="fa fa fa-upload fa-lg"></i> 파일추가
             </button>
          </div>
          <?php endif?>

        <!-- module : 첨부파일 사용 모듈 , theme : 첨부파일 테마 , attach_handler_file : 파일첨부 실행 엘리먼트 , attach_handler_photo : 사진첨부 실행 엘리먼트 ,parent_data : 수정시 필요한 해당 포스트 데이타 배열 변수, attach_handler_getModalList : 업로드 리스트 모달로 호출용 엘리먼트 (class 인 경우 . 까지 넘긴다.)  -->
         <?php getWidget('_default/attach',array('parent_module'=>$m,'theme'=> $d['bbs']['attach'],'attach_handler_file'=>'[data-role="attach-handler-file"]','attach_handler_photo'=>'[data-role="attach-handler-photo"]','attach_handler_getModalList'=>'.getModalList','parent_data'=>$R));?>
         <?php endif; ?>


        <?php endif?>


  		   <?php if($d['theme']['show_wtag']):?>
  			 <div class="form-group row">
  					<label class="col-lg-2 col-form-label text-lg-right" for="">태그<span class="rb-form-required text-danger"></span></label>
  					<div class="col-lg-10 col-xl-9">
  						<input class="form-control" type="text" name="tag" placeholder="검색태그를 입력해 주세요." value="<?php echo $R['tag']?>">
  						<small class="form-text text-muted">이 게시물을 가장 잘 표현할 수 있는 단어를 콤마(,)로 구분해서 입력해 주세요.</small>
  					</div>
  			 </div>
         <?php endif?>

       <div class="form-group row">
					<label class="col-lg-2 col-form-label text-lg-right" for="">등록 후</label>
					<div class="col-lg-10 col-xl-9 pt-2">

            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" id="backtype1" name="backtype" value="list"<?php if(!$_SESSION['bbsback'] || $_SESSION['bbsback']=='list'):?> checked<?php endif?>>
              <label class="custom-control-label" for="backtype1">목록으로 이동</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" id="backtype2" name="backtype" value="view"<?php if($_SESSION['bbsback']=='view'):?> checked<?php endif?>>
              <label class="custom-control-label" for="backtype2">본문으로 이동</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" class="custom-control-input" id="backtype3" name="backtype" value="now"<?php if($_SESSION['bbsback']=='now'):?> checked<?php endif?>>
              <label class="custom-control-label" for="backtype3">이 화면 유지</label>
            </div>

				   </div>
				</div><!-- /.form-group -->


      <footer class="text-center my-5">
        <button class="btn btn-light" type="button"onclick="cancelCheck();">취소</button>
        <button class="btn btn-primary" type="submit">등록</button>
      </footer>

  	</form>
	</article>

</section>

<!-- 코드미러를 먼저 호출하고 난 후에 summernote 호출해야 코드미러가 적용이 됨-->
<!-- include summernote codemirror-->

<?php getImport('codemirror','codemirror',false,'css')?>
<?php getImport('codemirror','codemirror',false,'js')?>
<?php getImport('codemirror','theme/monokai',false,'css')?>
<?php getImport('codemirror','mode/htmlmixed/htmlmixed',false,'js')?>
<?php getImport('codemirror','mode/xml/xml',false,'js')?>

<!-- include summernote css/js-->
<?php getImport('summernote','summernote-bs4.min','0.8.9','js')?>
<?php getImport('summernote','lang/summernote-ko-KR','0.8.9','js')?>
<?php getImport('summernote','summernote-bs4','0.8.9','css')?>

<script src="<?php echo $g['dir_module_skin']?>/_main.js"></script>

<script type="text/javascript">

// 에디터 호출
$(document).ready(function() {
  $('#summernote').summernote({
    placeholder: '내용을 입력하세요.',
    tabsize: 2,
    styleWithSpan: false,
    minHeight:<?php echo $d['theme']['edit_height']?>,  //에디터 최소 높이 : _var.php 에서 설정
    maxHeight: null,
    focus: true,
    lang: 'ko-KR',

    // 소스 편집창
    codemirror: {
    mode: "text/html",
    indentUnit: 4,
    lineNumbers: true,
    matchBrackets: true,
    indentWithTabs: true,
    theme: 'monokai'
  },
    // 이미지 바로 넣기
    onImageUpload: function(files, editor, welEditable) {
      Upload_file('img',files[0],editor,welEditable);
    }
  });
 });

// 첨부파일 : input-file onchange 이벤트시 해당 값 보여주기
// 글 등록 함수
var submitFlag = false;
function writeCheck(f)
{
	if (submitFlag == true)
	{
		alert('게시물을 등록하고 있습니다. 잠시만 기다려 주세요.');
		return false;
	}
	if (f.name && f.name.value == '')
	{
		alert('이름을 입력해 주세요. ');
		f.name.focus();
		return false;
	}
	if (f.pw && f.pw.value == '')
	{
		alert('암호를 입력해 주세요. ');
		f.pw.focus();
		return false;
	}
	if (f.category && f.category.value == '')
	{
		alert('카테고리를 선택해 주세요. ');
		f.category.focus();
		return false;
	}
	if (f.subject.value == '')
	{
		alert('제목을 입력해 주세요.      ');
		f.subject.focus();
		return false;
	}
	if (f.notice && f.hidden)
	{
		if (f.notice.checked == true && f.hidden.checked == true)
		{
			alert('공지글은 비밀글로 등록할 수 없습니다.  ');
			f.hidden.checked = false;
			return false;
		}
	}
	// 내용 체크 및 포커싱  ie 에서는 안됨
	var content =$('.note-editable').text();
	if (content.trim() =='')
	{
		$('.note-editable').focus();
      alert('내용을 입력해 주세요.       ');
      return false;
	}

  // 대표이미지가 없을 경우, 첫번째 업로드 사진을 지정함
  var featured_img_input = $('input[name="featured_img"]'); // 대표이미지 input
  var featured_img_uid = $(featured_img_input).val();
  if(featured_img_uid ==''){ // 대표이미지로 지정된 값이 없는 경우
      var first_attach_img_li = $('.rb-attach-photo li:first'); // 첫번째 첨부된 이미지 리스트 li
      var first_attach_img_uid = $(first_attach_img_li).data('id');
      $(featured_img_input).val(first_attach_img_uid);
  }

  // 첨부파일 uid 를 upfiles 값에 추가하기
  var attachfiles=$('input[name="attachfiles[]"]').map(function(){return $(this).val()}).get();
  var new_upfiles='';
  if(attachfiles){
        for(var i=0;i<attachfiles.length;i++)
        {
             new_upfiles+=attachfiles[i];
        }
        $('input[name="upfiles"]').val(new_upfiles);
  }


	submitFlag = true;
}
function cancelCheck()
{
	if (confirm('정말 취소하시겠습니까?    '))
	{
		history.back();
	}
}
</script>
