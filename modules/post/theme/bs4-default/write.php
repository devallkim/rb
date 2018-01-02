
<?php
require_once $g['dir_module'].'lib/tree.func.php';
if (!$_SESSION['upsescode']) $_SESSION['upsescode'] = str_replace('.','',$g['time_start']);
$sescode = $_SESSION['upsescode'];
$sess_Code =$sescode.'_'.$my['uid']; // 코드- 회원 uid

// 승인발행 여부 체크
if($uid){
	if($R['use_auth']) $use_auth_checked='checked';
	else $use_auth_checked='';

	    // 발행버튼 세팅
		if($R['step']<3 && $B['use_auth']) {
			$btn_publish='발행요청';
		} elseif($R['step']<3 && !$B['use_auth']) {
			$btn_publish='발행';
		} else {
			$btn_publish='수정';
		}

}else{
	if($B['use_auth']) {
		$use_auth_checked='checked';
		$btn_publish='발행요청';
	}
   else { $use_auth_checked='';
   $btn_publish='발행';
 	}
}

// 필자정보
if($R['mbruid']){
   $AM=getDbData($table['s_mbrdata'],'memberuid='.$R['mbruid'],'memberuid,email,name,nic');
   $author_name=$AM[$_HS['nametype']];
   $autor_email=$AM['email'];
}

// html --> markdown 변환 코드
spl_autoload_register('getHtmlToMarkdownClass');
use League\HTMLToMarkdown\HtmlConverter;
$converter = new HtmlConverter();
$mdContent=$converter->convert(getContents($R['content'],'HTML')); // blog_data 테이블에는 html 값이 없어서 'HTML' 로 넣어준다.

?>
<link href="<?php echo $g['url_module_skin']?>/classic.css" rel="stylesheet">
<?php getImport('simplemde','simplemde.min','1.11.2','css')?>
<link href="<?php echo $g['url_module_skin']?>/write_plus.css" rel="stylesheet">
<link href="<?php echo $g['url_module_skin']?>/github-markdown.css" rel="stylesheet">
<?php getImport('bootstrap-tagsinput','bootstrap-tagsinput',false,'css') ?><!-- 태그 입력 -->

<!-- http://www.mediaelementjs.com/ -->
<?php getImport('mediaelement','build/mediaelementplayer','3.0.3','css') ?>

<div class="container">
  <form name="writeForm" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return writeCheck(this);" role="form">
  	<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="a" value="post_write" />
		<input type="hidden" name="set" value="<?php echo $B['uid']?>" />
		<input type="hidden" name="uid" value="<?php echo $R['uid']?>" />
		<input type="hidden" name="upfiles" id="upfilesValue" value="<?php echo $R['upload']?>" />
		<input type="hidden" name="sess_Code" value="<?php echo $sescode?>_<?php echo $my['uid']?>_<?php echo $B['uid']?>" />
		<input type="hidden" name="cat" value="<?php echo $cat?>" />
		<input type="hidden" name="vtype" value="<?php echo $vtype?>" />
		<input type="hidden" name="recnum" value="<?php echo $recnum?>" />
		<input type="hidden" name="category_members" value="" />
		<input type="hidden" name="reserved_time" value="" /> <!-- 예약발행 시간 -->
		<input type="hidden" name="published" value="<?php echo $R['published']?>" /> <!-- 발행여부 구분 : 임시저장일 경우 0 -->
		<input type="hidden" name="saveDir" value="<?php echo $g['path_file'].$m.'/'?>" /> <!-- 파일저장 폴더 -->
		<input type="hidden" name="featured_img" value="<?php echo $R['featured_img']?>" />  <!--대표 이미지 -->
		<input type="hidden" name="content_format" value="<?php echo $R['content_format']?>" />  <!-- 컨텐츠 포멧 -->
		<input type="hidden" name="backtype" value="<?php echo $uid?'view':'list'?>" />  <!-- 컨텐츠 포멧 -->
		<input type="hidden" name="use_auth" value="<?php echo $B['use_auth']?>" /> <!-- 승인시스템 사용여부 -->

	      <div class="rb-editor">
	            <div class="rb-editor-body active">
	                <textarea class="form-control" rows="1" id="simplemde" name="content" style="display:none"><?php echo $mdContent?></textarea>
	                <div class="editor-toolbar-title">
	                    <h1><?php echo $B['name']?></h1>
	                </div>
	                <div class="editor-toolbar-buttons">
	                    <a href="#" onclick="window.history.back();"class="btn btn-link">취소</a>
	                    <a href="<?php echo $g['blog_front'].'list'?>" class="btn btn-link">포스트 목록</a>
	                    <button class="btn btn-default" type="submit" onclick="tmp_save();" ><i class="fa fa-floppy-o fa-fw"></i> 저장</button>

	                    <!-- Split button -->
	                    <div class="btn-group">
	                      <button type="submit" class="btn btn-primary" onclick="publish_save();"><i class="fa fa-check fa-fw"></i><?php echo $btn_publish?></button>
	                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                        <span class="caret"></span>
	                        <span class="sr-only">Toggle Dropdown</span>
	                      </button>
	                      <ul class="dropdown-menu dropdown-menu-right">
	                        <li><a href="#">삭제</a></li>
	                      </ul>
	                    </div>
	                </div>
	                <div class="editor-title">
	                  <input type="text" class="form-control input-lg" name="subject" placeholder="제목을 입력해 주세요." value="<?php echo htmlspecialchars($R['subject'])?>" id="subject">
	                </div>
	                <div class="editor-emulator" data-role="editor-emulator">
                        <div class="btn-group" data-toggle="buttons" data-role="orientation-wrapper" style="display: none">
                            <label class="btn btn-default active" data-role="orientation-portrait">
                                <input type="radio" name="options" id="option1" autocomplete="off" checked> 세로방향
                            </label>
                            <label class="btn btn-default" data-role="orientation-landscape">
                                <input type="radio" name="options" id="option2" autocomplete="off"> 가로방향
                            </label>
                        </div>
	                    <button class="btn btn-link" type="button" data-role="emulator-reset" data-toggle="tooltip" title="화면 초기화" style="display: none"><i class="fa fa-ban fa-lg"></i></button>
                        <a class="btn btn-default btn-select">
                            <span class="btn-select-value">기기를 선택하세요</span>
                            <span class='btn-select-arrow glyphicon glyphicon-chevron-down'></span>
                            <ul>
                                <li data-role="emulator-option" data-type="mobile" data-width="360" data-height="640">Galaxy Note 2/3/4</li>
                                <li data-role="emulator-option" data-type="mobile" data-width="400" data-height="640">Galaxy Note 1</li>
                                <li data-role="emulator-option" data-type="mobile" data-width="360" data-height="640">Galaxy S 3/4/5/6</li>
                                <li data-role="emulator-option" data-type="mobile" data-width="320" data-height="533">Galaxy S 1/2</li>
                                <li data-role="emulator-option" data-type="mobile" data-width="414" data-height="736">iPhone 6+</li>
                                <li data-role="emulator-option" data-type="mobile" data-width="375" data-height="667">iPhone 6</li>
                                <li data-role="emulator-option" data-type="mobile" data-width="320" data-height="568">iPhone 5</li>
                                <li data-role="emulator-option" data-type="mobile" data-width="360" data-height="480">iPhone 3GS/4</li>
                                <li data-role="emulator-option" data-type="desktop"  data-width="780" data-height="780">Desktop</li>
                            </ul>
                        </a>
	                </div>
	                <div class="editor-meta rb-scrollbar">
	                    <div class="editor-meta-header">
                                <ul class="nav nav-pills nav-justified" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#meta-accordion" aria-controls="home" role="tab" data-toggle="tab">기본정보</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#attach-accordion" aria-controls="profile" role="tab" data-toggle="tab">첨부</a>
                                    </li>
                                </ul>
                         </div>

	                    <div class="tab-content">
	                        <div class="panel-group tab-pane fade in active" id="meta-accordion" role="tablist" aria-multiselectable="true">
	                        	<?php if($ISCAT):?> <!-- 메인에서 정의 -->
	                            <div class="panel panel-default">
	                                <div class="panel-heading" role="tab" id="heading-category">
	                                    <div class="media collapsed" role="button" data-toggle="collapse" data-parent="#meta-accordion" href="#meta-category">
	                                        <div class="media-left media-middle">
	                                            <i class="media-object fa fa-folder fa-lg"></i>
	                                        </div>
	                                        <div class="media-body">
	                                            <h4 class="media-heading">카테고리</h4>
	                                            <span data-role="preview-category"><?php echo getAllPostCat($B['uid'],$R['uid']);?></span>
	                                        </div>
	                                        <div class="media-right media-middle">
	                                            <i class="fa fa-chevron"></i>
	                                        </div>
	                                    </div>
	                                </div>
	                                <div id="meta-category" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-category">
	                                    <div class="panel-body">
	                                           <link href="<?php echo $g['s']?>/_core/css/tree.css" rel="stylesheet">
												                <?php $_treeOptions=array('table'=>$table[$m.'category'],'set'=>$B['uid'],'post'=>$R['uid'],'dispNum'=>true,'dispCheckbox'=>true,'allOpen'=>false)?>
												                <?php echo getTreeCategoryForWrite($_treeOptions,$code,0,0,'')?>
																				<div class="alert alert-warning" role="alert">
																					맨앞의 카테고리가 대표가 됩니다.
																				</div>
	                                    </div>
	                                </div>
	                            </div>
	                            <?php endif?>

	                            <div class="panel panel-default">
	                                <div class="panel-heading" role="tab" id="heading-tag">
	                                    <div class="media collapsed" role="button" data-toggle="collapse" data-parent="#meta-accordion" href="#meta-tag">
	                                        <div class="media-left media-middle">
	                                            <i class="media-object fa fa-tags fa-lg"></i>
	                                        </div>
	                                        <div class="media-body">
	                                            <h4 class="media-heading">태그</h4>
	                                            <span data-role="preview-tag"><?php echo ($R['tag']?'#':'').str_replace(',',', #', $R['tag']);?></span>
	                                        </div>
	                                        <div class="media-right media-middle">
	                                            <i class="fa fa-chevron"></i>
	                                        </div>
	                                    </div>
	                                </div>
	                                <div id="meta-tag" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-tag">
	                                    <div class="panel-body">
	                                        <input type="text" name="tag" class="form-control" id="meta-tag-content" data-role="tagsinput" value="<?php echo $R['tag']?>">
                                              <span id="helpBlock" class="help-block">콤마(,)로 구분하여 입력해 주세요.</span>
	                                    </div>
	                                </div>
	                            </div>

	                            <div class="panel panel-default">
	                                <div class="panel-heading" role="tab" id="heading-description">
	                                    <div class="media collapsed" role="button" data-toggle="collapse" data-parent="#meta-accordion" href="#meta-description">
	                                        <div class="media-left media-middle">
	                                            <i class="media-object fa fa-commenting-o fa-lg"></i>
	                                        </div>
	                                        <div class="media-body">
	                                            <h4 class="media-heading">요약</h4>
	                                            <!-- 입력됨 -->
	                                        </div>
	                                        <div class="media-right media-middle">
	                                            <i class="fa fa-chevron"></i>
	                                        </div>
	                                    </div>
	                                </div>
	                                <div id="meta-description" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-description">
	                                    <div class="panel-body">
	                                        <textarea class="form-control" name="review" rows="5" id="meta-description-content"  maxlength="155"><?php echo $R['review']?></textarea>
	                                    </div>
	                                </div>
	                            </div>

	                            <div class="panel panel-default">
	                                <div class="panel-heading" role="tab" id="heading-share">
	                                    <div class="media collapsed" role="button" data-toggle="collapse" data-parent="#meta-accordion" href="#post-share">
	                                        <div class="media-left media-middle">
	                                            <i class="media-object fa fa-share-alt fa-lg"></i>
	                                        </div>
	                                        <div class="media-body">
	                                            <h4 class="media-heading">공유</h4>
	                                            공유함
	                                        </div>
	                                        <div class="media-right media-middle">
	                                            <i class="fa fa-chevron"></i>
	                                        </div>
	                                    </div>
	                                </div>
	                                <div id="post-share" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-share">
	                                    <div class="panel-body">
	                                        <p>소셜미디어 서비스 공유</p>
	                                        <div class="checkbox">
	                                            <label>
	                                               <input type="checkbox" value="" checked>
                                                          링크공유 버튼 출력
	                                            </label>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>

	                            <div class="panel panel-default">
	                                <div class="panel-heading" role="tab" id="heading-format">
	                                    <div class="media collapsed" role="button" data-toggle="collapse" data-parent="#meta-accordion" href="#post-format">
	                                        <div class="media-left media-middle">
	                                            <i class="media-object fa fa-puzzle-piece fa-lg"></i>
	                                        </div>
	                                        <div class="media-body">
	                                            <h4 class="media-heading">컨텐츠 포맷</h4>
	                                            기본형
	                                        </div>
	                                        <div class="media-right media-middle">
	                                            <i class="fa fa-chevron"></i>
	                                        </div>
	                                    </div>
	                                </div>
	                                <div id="post-format" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-format">
	                                        <div class="panel-body">
		                                       <div class="radio">
                                                      <label>
                                                          <input type="radio" name="format"  value="1" <?php echo ($R['content_format']==1||!$R['content_format'])?'checked':''?>>
                                                          <i class="fa fa-align-left"></i> 기본형
                                                      </label>
                                               </div>
                                               <div class="radio">
                                                      <label>
                                                          <input type="radio" name="format"  value="2" <?php echo $R['content_format']==2?'checked':''?>>
                                                          <i class="fa fa-picture-o"></i> 이미지
                                                      </label>
                                               </div>
                                               <div class="radio">
                                                      <label>
                                                          <input type="radio" name="format"  value="3" <?php echo $R['content_format']==3?'checked':''?>>
                                                          <i class="fa fa-file-video-o"></i> 비디오
                                                      </label>
                                               </div>
                                               <div class="radio">
                                                      <label>
                                                          <input type="radio" name="format"  value="4" <?php echo $R['content_format']==4?'checked':''?>>
                                                          <i class="fa fa-quote-left"></i> 인용문
                                                      </label>
                                               </div>
                                               <div class="radio">
                                                      <label>
                                                          <input type="radio" name="format"  value="5" <?php echo $R['content_format']==5?'checked':''?>>
                                                          <i class="fa fa-globe"></i> 링크형
                                                      </label>
                                               </div>
	                                        </div>
	                                  </div>
	                             </div>
	                             <?php if($my['admin'] || $my['manager']):?>
                                  <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="heading-author">
                                            <div class="media collapsed" role="button" data-toggle="collapse" data-parent="#meta-accordion" href="#post-author">
                                                <div class="media-left media-middle">
                                                         <i class="media-object fa fa-user fa-lg"></i>
                                                </div>
                                                <div class="media-body">
                                                         <h4 class="media-heading">등록자</h4>
                                                         <span data-role="preview-author"><?php echo $R['uid']?$author_name. '('.$author_email.')':''?></span>
                                                </div>
                                                <div class="media-right media-middle">
                                                         <i class="fa fa-chevron"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="post-author" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-author">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                	 <?php $_AUTHOR=getDbData($table['s_mbrdata'],'memberuid='.$B['mbruid'],'*')?>
                                                	  <?php $_AUTHORS=explode(',',$B['members'])?>
                                                	 <label class="sr-only">필자</label>
                                                    <select name="author" class="form-control">
                                                    	 <?php foreach($_AUTHORS as $_ath):if(!trim($_ath))continue;$_B=getDbData($table['s_mbrid'],"id='".$_ath."'",'*');if(!$_B['uid'])continue;$_AUTHOR=getDbData($table['s_mbrdata'],'memberuid='.$_B['uid'],'*')?>
                                                              <?php if($uid):?>
											<option value="<?php echo $_AUTHOR['memberuid']?>"<?php if($R['mbruid']==$_AUTHOR['memberuid']):?> selected="selected"<?php endif?>><?php echo $_AUTHOR[$_HS['nametype']]?> (<?php echo $_AUTHOR['email']?>)</option>
											<?php else:?>
											<option value="<?php echo $_AUTHOR['memberuid']?>"<?php if($my['uid']==$_AUTHOR['memberuid']):?> selected="selected"<?php endif?>><?php echo $_AUTHOR[$_HS['nametype']]?> (<?php echo $_AUTHOR['email']?>)</option>
								 		      <?php endif?>
										 <?php endforeach?>
                                                    </select>
                                                </div>
                                                <span class="help-block">이 포스트의 등록자를 변경할 수 있습니다.</span>
                                            </div>
                                        </div>
                                  </div>
                                  <?php endif?>

	                            <div class="panel panel-default">
	                                <div class="panel-heading" role="tab" id="heading-options">
	                                    <div class="media collapsed" role="button" data-toggle="collapse" data-parent="#meta-accordion" href="#post-options">
	                                        <div class="media-left media-middle">
	                                            <i class="media-object fa fa-ellipsis-h fa-lg"></i>
	                                        </div>
	                                        <div class="media-body">
	                                            <h4 class="media-heading">기타설정</h4>
	                                            <!-- 공지글, 비밀글 -->
	                                        </div>
	                                        <div class="media-right media-middle">
	                                            <i class="fa fa-chevron"></i>
	                                        </div>
	                                    </div>
	                                </div>
	                                <div id="post-options" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-options">
	                                    <div class="panel-body">
	                                           <div class="form-group">
	                                                    <label>게시물 속성</label>
	                                                    <div class="checkbox">
	                                                        <label>
	                                                            <input type="checkbox" value="" checked>
	                                                            댓글포함
	                                                        </label>
	                                                    </div>
	                                                    <div class="checkbox">
	                                                        <label>
	                                                            <input type="checkbox" value="" checked>
	                                                            좋아요(추천) 버튼 출력
	                                                        </label>
	                                                    </div>
                                                </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="panel-group tab-pane fade" id="attach-accordion" role="tablist" aria-multiselectable="true">

	                            <div class="panel panel-default">
	                                <div class="panel-heading" role="tab" id="heading-photo">
	                                    <div class="media collapsed" role="button" data-toggle="collapse" data-parent="#attach-accordion" href="#attach-photo">
	                                        <div class="media-left media-middle">
	                                            <i class="media-object fa fa-picture-o fa-lg"></i>
	                                        </div>
	                                        <div class="media-body">
	                                            <h4 class="media-heading">사진추가</h4>
	                                            <span data-role="state-photo-num"></span>
	                                        </div>
	                                        <div class="media-right media-middle">
	                                            <i class="fa fa-chevron"></i>
	                                        </div>
	                                    </div>
	                                </div>
	                                <div id="attach-photo" class="panel-collapse collapse" role="tabpanel">
	                                    <!-- module : 첨부파일 사용 모듈 , theme : 첨부파일 테마 , attach_handler_file : 파일첨부 실행 엘리먼트 , attach_handler_photo : 사진첨부 실행 엘리먼트 ,parent_data : 수정시 필요한 해당 포스트 데이타 배열 변수, attach_handler_getModalList : 업로드 리스트 모달로 호출용 엘리먼트 (class 인 경우 . 까지 넘긴다.)  -->
                  										<?php getWidget('default/attach',array('parent_module'=>$m,'theme'=>'bs-markdownPlus','attach_handler_photo'=>'[data-role="attach-handler-photo"]','parent_data'=>$R,'attach_object_type'=>'photo'));?>
	                                  </div>
	                            </div>

	                            <div class="panel panel-default">
	                                <div class="panel-heading" role="tab" id="heading-file">
	                                    <div class="media collapsed" role="button" data-toggle="collapse" data-parent="#attach-accordion" href="#attach-file">
	                                        <div class="media-left media-middle">
	                                            <i class="media-object fa fa-floppy-o fa-lg"></i>
	                                        </div>
	                                        <div class="media-body">
	                                            <h4 class="media-heading">파일첨부</h4>
	                                            <span data-role="state-file-num"></span>
	                                        </div>
	                                        <div class="media-right media-middle">
	                                            <i class="fa fa-chevron"></i>
	                                        </div>
	                                    </div>
	                                </div>
	                                <div id="attach-file" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-file">
                   									<!-- module : 첨부파일 사용 모듈 , theme : 첨부파일 테마 , attach_handler_file : 파일첨부 실행 엘리먼트 , attach_handler_photo : 사진첨부 실행 엘리먼트 ,parent_data : 수정시 필요한 해당 포스트 데이타 배열 변수, attach_handler_getModalList : 업로드 리스트 모달로 호출용 엘리먼트 (class 인 경우 . 까지 넘긴다.)  -->
                										<?php getWidget('default/attach',array('parent_module'=>$m,'theme'=>'bs-markdownPlus','attach_handler_file'=>'[data-role="attach-handler-file"]','parent_data'=>$R,'attach_object_type'=>'file'));?>
                                 </div>
	                            </div>

															<div class="panel panel-default">
																	<div class="panel-heading" role="tab" id="heading-youtube">
																			<div class="media collapsed" role="button" data-toggle="collapse" data-parent="#meta-accordion" href="#attach-youtube">
																					<div class="media-left media-middle">
																							<i class="media-object fa fa-file-video-o fa-lg"></i>
																					</div>
																					<div class="media-body">
																							<h4 class="media-heading">비디오 추가</h4>
																					</div>
																					<div class="media-right media-middle">
																							<i class="fa fa-chevron"></i>
																					</div>
																			</div>
																	</div>
																	<div id="attach-youtube" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-youtube">
																		<?php getWidget('default/attach',array('parent_module'=>$m,'theme'=>'bs-markdownPlus','parent_data'=>$R,'attach_object_type'=>'youtube'));?>
																	</div>
															</div>

															<div class="panel panel-default">
																	<div class="panel-heading" role="tab" id="heading-audio">
																			<div class="media collapsed" role="button" data-toggle="collapse" data-parent="#meta-accordion" href="#attach-audio">
																					<div class="media-left media-middle">
																							<i class="media-object fa fa-file-audio-o fa-lg"></i>
																					</div>
																					<div class="media-body">
																							<h4 class="media-heading">오디오 추가</h4>
																					</div>
																					<div class="media-right media-middle">
																							<i class="fa fa-chevron"></i>
																					</div>
																			</div>
																	</div>
																	<div id="attach-audio" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-audio">
																		<!-- module : 첨부파일 사용 모듈 , theme : 첨부파일 테마 , attach_handler_file : 파일첨부 실행 엘리먼트 , attach_handler_photo : 사진첨부 실행 엘리먼트 ,parent_data : 수정시 필요한 해당 포스트 데이타 배열 변수, attach_handler_getModalList : 업로드 리스트 모달로 호출용 엘리먼트 (class 인 경우 . 까지 넘긴다.)  -->
                										<?php getWidget('default/attach',array('parent_module'=>$m,'theme'=>'bs-markdownPlus','attach_handler_file'=>'[data-role="attach-handler-audio"]','parent_data'=>$R,'attach_object_type'=>'audio'));?>
																	</div>
															</div>

	                        </div>
	                    </div>
	                </div>
	            </div>
	      </div>
      </form>
</div><!-- .container-->

<!-- 태그입력 -->
<?php getImport('bootstrap-tagsinput','bootstrap-tagsinput.min',false,'js') ?>
<!-- 요약부분 글자수 체크 -->
<?php getImport('bootstrap-maxlength','bootstrap-maxlength.min',false,'js') ?>
<!-- 마크다운 에디터 플러그인 : https://github.com/NextStepWebs/simplemde-markdown-editor -->
<?php getImport('simplemde','simplemde.min','1.9.0','js')?>

<!-- http://www.mediaelementjs.com/ -->
<?php getImport('mediaelement','build/mediaelement-and-player.min','3.0.3','js') ?>
<?php getImport('mediaelement','build/lang/ko','3.0.3','js') ?>


<script type="text/javascript">

	// 브라우저 타이틀 지정
	document.title = '<?php if (!$uid): ?>신규작성<?php else: ?>포스트 수정<?php endif; ?> | <?php echo $_HS['name'] ?>';

 var simplemde = new SimpleMDE({
        element: $("#simplemde")[0],

        placeholder: "Type here...",
        spellChecker: false,
        toolbar: ["bold", "italic", "heading","|",
            "code",
            "quote",
            "unordered-list",
            "ordered-list",
             "|",
             "link",
             "image",
             "table",
             "horizontal-rule",
            "|",
            "preview",
            "side-by-side",
            "fullscreen",
            "|",
            "guide"
        ],
 });



 simplemde.codemirror.on("viewportChange", function(){
 	$('.editor-preview-side .mejs-player').mediaelementplayer();
 });
 $('.editor-preview-side').on('click', 'video', function (e) {
 	$('.editor-preview-side .mejs-player').mediaelementplayer();
 });

// simplemde 미리보기 기본세팅
simplemde.toggleSideBySide(simplemde);

// Bootstrap Button Select : http://bootsnipp.com/snippets/yvAp8
$(document).ready(function () {
       $(".btn-select").each(function (e) {
             var value = $(this).find("ul li.selected").html();
             if (value != undefined) {
                  $(this).find(".btn-select-input").val(value);
                  $(this).find(".btn-select-value").html(value);
            }
      });
      $('.rb-editor-body').addClass('active');
      $('.editor-preview-side').addClass('markdown-body');
      $(".editor-toolbar a").attr("data-toggle","tooltip");
});

$(document).on('click', '.btn-select', function (e) {
      e.preventDefault();
      var ul = $(this).find("ul");
      if ($(this).hasClass("active")) {
	      if (ul.find("li").is(e.target)) {
	            var target = $(e.target);
	            target.addClass("selected").siblings().removeClass("selected");
	            var value = target.html();
	            $(this).find(".btn-select-input").val(value);
	            $(this).find(".btn-select-value").html(value);
            }
            ul.hide();
            $(this).removeClass("active");
      }
      else {
            $('.btn-select').not(this).each(function () {
                  $(this).removeClass("active").find("ul").hide();
            });
            ul.slideDown(300);
            $(this).addClass("active");
      }
});

$(document).on('click', function (e) {
      var target = $(e.target).closest(".btn-select");
      if (!target.length) {
            $(".btn-select").removeClass("active").find("ul").hide();
      }
});

// 디바이스 미리보기
$(function(){
      var emulator=$('[data-role="editor-emulator"]');// emulator 전체 container
      var option_sel=$('[data-role="emulator-option"]'); // enulator 옵션 select
      var option_sel_default=$('.btn-select-value');// emulator 옵션 기본값
      var orientation_wrapper=$('[data-role="orientation-wrapper"]'); // 방향 적용 엘리먼트 container
      var orientation_landscape=$('[data-role="orientation-landscape"]');// 가로방향 적용 엘리먼트
      var orientation_portrait=$('[data-role="orientation-portrait"]');// 세로방향 적용 엘리먼트
      var emulator_reset=$('[data-role="emulator-reset"]');// emulator 리셋 엘리먼트
      var editor_preview=$('.editor-preview-side'); // 에디터 미리보기 container
      var codemirror_preview=$('.CodeMirror-sided'); // simplemde codemirror 미리보기 container
      // 미리보기 사이즈 적용 함수
      var setPreviewSize=function(ele){
      	var p_width =  $(ele).attr('data-width'),
	           p_height =  $(ele).attr('data-height'),
	           t_width =  parseInt(p_width) + 280;
	      $(editor_preview).css("width",p_width).css("height",p_height);
	      $(codemirror_preview).css({ 'width': 'calc(100% - ' + t_width+ 'px)' });
	 }
      // 옵션 클릭 이벤트
      $(option_sel).on('click',function(){
      	var width=$(this).data('width'),height=$(this).data('height'),type=$(this).data('type');
           setPreviewSize($(this)); // 미리보기 적용
           $(orientation_wrapper).css("display","inline-block"); // 방향 버튼 출력
		$(emulator_reset).css("display","inline-block");// 리셋 버튼 출력
           $(orientation_portrait).attr("data-width",width).attr("data-height",height).addClass("active"); // 세로방향  버튼 active 활성화
		$(orientation_landscape).attr("data-width",height).attr("data-height",width).removeClass("active"); // 가로방향 버튼 active 비활성화
           if(type=='desktop') $(orientation_wrapper).css("display","none"); // desktop 버튼일 경우 방향버튼 숨기기
	});
	// 방향 버튼 클릭 이벤트
	$(orientation_wrapper).find('label').on('click',function(){
	      setPreviewSize($(this));
	});
      // reset 버튼 클릭 이벤트
	$(emulator_reset).on('click',function(){
	    $(editor_preview).css("width","calc(50% - 140px)").css("height","");
	    $(codemirror_preview).css("width","calc(50% - 140px)").css("height","");
	    $(emulator_reset).css("display","none");
	    $(orientation_wrapper).css("display","none");
	    $(option_sel_default).html("기기를 선택해주세요.");
	    $(orientation_portrait).addClass("active");
	    $(orientation_landscape).removeClass("active");
	});
});

 // 요약 : bootstrap-maxlength : https://github.com/mimo84/bootstrap-maxlength/
 $('#meta-description-content').maxlength({
      alwaysShow: true,
      threshold: 10,
      warningClass: "label label-info",
      limitReachedClass: "label label-danger"
 });

 // 태그 : bootstrap-tagsinput : https://github.com/bootstrap-tagsinput/bootstrap-tagsinput
 $('[data-role="tagsinput"]').tagsinput({
      maxChars: 8
 });

// 태그 추가/삭제 이벤트
$(function(){
      var tagInput='[data-role="tagsinput"]';
	var preview_tag=$('[data-role="preview-tag"]');
      var new_tag;

      // 추가 이벤트
	$(tagInput).on('itemAdded', function(e) {
             var old_tag=$(preview_tag).text();
	       var tag='#'+e.item;

	       if(old_tag=='') new_tag=tag;
	       else new_tag=old_tag+', '+tag;

	       $(preview_tag).text(new_tag);
	});

	// 삭제 이벤트
	$(tagInput).on('itemRemoved', function(e) {
		var old_tag=$(preview_tag).text();
		var tag=e.item; // 삭제되는 태그
		var stag='#'+tag;// 태그앞에 # 추가
		var tagArr=old_tag.split(', ');

           if(tagArr[0]=='') tagArr.splice(0,1); // 태그가 없는 경우 첫번째 빈값은 삭제
           tagArr.splice($.inArray(stag, tagArr),1); // 삭제된 태그 태그배열에서 삭제
           new_tag=tagArr.join(', ');
           $(preview_tag).text(new_tag);
	});
});

//카테고리 선택되는 순간 이벤트
 $('[data-role="category-checkbox"]').click(function() {
 	 var preview_cat=$('[data-role="preview-category"]');
 	 var preview_cat_text=$('[data-role="preview-category"]').text();
       var cat_arr=preview_cat_text.split(', '); // 콤마로 분리해서 배열 생성
       if(cat_arr[0]=='')  cat_arr.splice(0,1); // 카테고리 없는 경우 공백 삭제

       var cat=$(this).data('name');
       var is_selected,new_cat='';

       // 체크되었는지 체크
       var is_checked=$(this).prop('checked');

      // 기존에 선택되었는지 체크
      if ($.inArray(cat, cat_arr) !='-1') is_selected=true;
      else is_selected=false;

      // 체크 선택/비선택 여부 및 기존에 체크되었는지 체크
      if(is_checked){
            if(is_selected==false) cat_arr.push(cat);
      }else{
      	 if(is_selected==true){
      	 	cat_arr.splice($.inArray(cat, cat_arr),1);
      	 }
      }
      // 배열 콤마로 분리
      var cat_text=cat_arr.join(', ');

       // 카테고리 미리보기 업데이트
      $(preview_cat).text(cat_text);

});


//###### write.php 내용 ###############################

// 리뷰,예약,SEO 입력 이벤트
function layerShowHide1(divid,obj)
{
	if (obj.checked == true)
	{
		$(divid).removeClass('hide');
	}
	else {
		$(divid).addClass('hide');
	}
}


// 임시저장 적용 함수
function tmp_save(){
   var f=document.writeForm;
   f.published.value=0;
	 f.backtype.value='';  // backtype 값을 넘기지 않아 페이지 이동되지 않도록 함
}
// 발행저장 적용 함수
function publish_save()
{
	var f=document.writeForm;
    f.published.value=1;
}
var submitFlag = false;
function writeCheck(f)
{
	var published=$('input[name="published"]').val();
	if (submitFlag == true)
	{
		alert('포스트를 등록하고 있습니다. 잠시만 기다려 주세요.   ');
		return false;
	}

    // 임시저장인 경우 제목 체크 안함
	if(published==1)
	{
		 if (f.subject.value == '')
	      {
		       alert('제목을 입력해 주세요.      ');
		       f.subject.focus();
		      return false;
	       }
	}

      // 예약시간 설정
      if (f.isreserve && f.isreserve.checked == true)
	 {
		 var ymd=f.ymd.value;
		 var hm=f.hm.value;
            var ymd_arr=ymd.split('-'); // 날짜 선택값
            var hm_arr=hm.split(':'); // 시간 선택값

             f.reserved_time.value=ymd_arr[0]+ymd_arr[1]+ymd_arr[2]+hm_arr[0]+hm_arr[1];
	 }

	// 카테고리 체크
	var cat_sel=$('input[name="category[]"]');
	var cat_sel_n=cat_sel.length;
      var cat_arr=$('input[name="category[]"]:checked').map(function(){return $(this).val();}).get();
	var cat_n=cat_arr.length;

	 // 컨텐츠 포멧 체크
      if($('input[name="format"]:checked').length<=0){
            alert('컨텐츠 포멧을 선택해주세요');
            return false;
      }else{
            var format=$('input[name="format"]:checked').val();
            f.content_format.value=format;
      }

	if(published==1 && cat_sel_n>0 && cat_arr==''){
		alert('지정된 카테고리가 없습니다.\n적어도 하나이상의 카테고리를 지정해 주세요.');
		return false;
	}else{
  	       var s='';
	       for (var i=0;i <cat_n;i++)
	      {
	   	        if(cat_arr[i]!='')  s += '['+cat_arr[i]+']';
	      }
	      f.category_members.value = s;
	}

    // 임시저장인 경우 리뷰 체크 안함
	if(published==1)
	{
		if (f.review.value == '')
	      {
		   alert('리뷰를 입력해 주세요.      ');
		   f.review.focus();
		    return false;
	      }
	}

     // 내용 체크 및 포커싱  ie 에서는 안됨
      var content=simplemde.value();
	if (content ==' ')
	{
	      alert('내용을 입력해 주세요.       ');
            return false;
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


			if(confirm('정말로 <?php echo $R['uid']?'수정':'등록'?>하시겠습니까?    '))



	{
             submitFlag = true;
  	}else{
	       return false;
	}

}

function cancelCheck()
{
	if (confirm('정말 취소하시겠습니까?    '))
	{
		history.back();
	}
}

</script>
