<?php
include_once $g['path_module'].$module.'/var/var.php';
?>

<div class="container-fluid">
	<div class="row">

		<nav class="col-sm-4 col-md-3 col-xl-2 d-none d-sm-block sidebar">

			<div class="card">
			  <div class="card-header">
			    메뉴
			  </div>
			  <div class="list-group" id="list-tab" role="tablist">
			    <a class="list-group-item list-group-item-action" data-toggle="list" href="#robots" role="tab" aria-selected="false" onclick="sessionSetting('sh_admin_seo','robots','','');">
			      <i class="fa fa-code fa-lg pull-right"></i> 기초환경 설정
			    </a>
			    <a class="list-group-item list-group-item-action" data-toggle="list" href="#rewrite" role="tab" onclick="sessionSetting('sh_admin_seo','rewrite','','');" aria-selected="false">
			      <i class="fa fa-code fa-lg pull-right"></i> 댓글 환경설정
			    </a>
			    <a class="list-group-item list-group-item-action" data-toggle="list" href="#sitemap" role="tab" onclick="sessionSetting('sh_admin_seo','sitemap','','');" aria-selected="false">
			      <i class="fa fa-code fa-lg pull-right"></i> 첨부파일 환경설정
			    </a>
			    <a class="list-group-item list-group-item-action active show" data-toggle="list" href="#error" role="tab" onclick="sessionSetting('sh_admin_seo','errorpage','','');" aria-selected="true">
			     <i class="fa fa-file-text-o fa-lg pull-right"></i>파일서버 환경설정
			    </a>
			  </div>
			</div><!-- /.card -->


		</nav>
		<div class="col-sm-8 col-md-9 ml-sm-auto col-xl-10 pt-3">

			<form class="form-horizontal rb-form" role="form" name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
				<input type="hidden" name="r" value="<?php echo $r?>" />
				<input type="hidden" name="m" value="<?php echo $module?>" />
				<input type="hidden" name="a" value="_admin/config" />
				<div class="page-header">
					<h4>블로그 기초환경</h4>
				</div>
			   <div class="form-group">
			  	  <label class="col-sm-2 control-label">대표테마 <small class="text-muted"><a data-toggle="collapse" data-tooltip="tooltip" title="도움말" href="#s_theme_pc-guide"><i class="fa fa-question-circle fa-fw"></i></a></small></label>
			     <div class="col-sm-10">
			  		   <div class="row">
			  		   	 <div class="col-sm-5">
						  		    <select name="s_theme_pc" class="form-control">
										<option value="">&nbsp;+ 선택하세요</option>
										<option value="">--------------------------------</option>
										<?php $tdir = $g['path_module'].$module.'/theme/'?>
										<?php $dirs = opendir($tdir)?>
										<?php while(false !== ($skin = readdir($dirs))):?>
										<?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
										<option value="<?php echo $skin?>" title="<?php echo $skin?>"<?php if($d['blog']['s_theme_pc']==$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($tdir.$skin)?>(<?php echo $skin?>)</option>
										<?php endwhile?>
										<?php closedir($dirs)?>
									</select>
						    </div> <!-- .col-sm-3  -->
						</div> <!-- .row  -->
						<p class="help-block collapse" id="s_theme_pc-guide">
							<small>
						   지정된 대표테마는 블로그 개별 설정시 별도의 테마를 지정하지 않으면 자동으로 적용됩니다.<br />
							가장 많이 사용하는 테마를 지정해 주세요.
						   </small>
						</p>
					</div> <!-- .col-sm-10  -->
				</div> <!-- .form-group  -->
				<div class="form-group">
			  	  <label class="col-sm-2 control-label">모바일 테마 <small class="text-muted"><a data-toggle="collapse" data-tooltip="tooltip" title="도움말" href="#s_theme_mobile-guide"><i class="fa fa-question-circle fa-fw"></i></a></small></label>
			     <div class="col-sm-10">
			  		   <div class="row">
			  		   	 <div class="col-sm-5">
						  		    <select name="s_theme_mobile" class="form-control">
										<option value="">&nbsp;+ PC모드와 동일</option>
										<option value="">--------------------------------</option>
										<?php $tdir = $g['path_module'].$module.'/theme/'?>
										<?php $dirs = opendir($tdir)?>
										<?php while(false !== ($skin = readdir($dirs))):?>
										<?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
										<option value="<?php echo $skin?>" title="<?php echo $skin?>"<?php if($d['blog']['s_theme_mobile']==$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($tdir.$skin)?>(<?php echo $skin?>)</option>
										<?php endwhile?>
										<?php closedir($dirs)?>
									</select>
						    </div> <!-- .col-sm-3  -->
						</div> <!-- .row  -->
						<p class="help-block collapse" id="s_theme_mobile-guide">
							 <small>선택하지 않으면 데스크탑 대표테마로 설정됩니다.</small>
						</p>
					</div> <!-- .col-sm-10  -->
				</div> <!-- .form-group  -->
				<div class="page-header" style="padding-top:20px;">
					<h4>댓글 환경설정</h4>
				</div>
			   <div class="form-group">
			  	  <label class="col-sm-2 control-label">댓글권한</label>
			     <div class="col-sm-10">
			  		   <div class="row">
			  		   	 <div class="col-sm-5">
						  		    <select name="c_perm_write" class="form-control">
										<option value="0">&nbsp;+ 전체허용</option>
										<option value="0">--------------------------------</option>
									   <?php $_LEVEL=getDbArray($table['s_mbrlevel'],'','*','uid','asc',0,1)?>
										<?php while($_L=db_fetch_array($_LEVEL)):?>
										<option value="<?php echo $_L['uid']?>"<?php if($_L['uid']==$d['blog']['c_perm_write']):?> selected="selected"<?php endif?>>ㆍ<?php echo $_L['name']?>(<?php echo number_format($_L['num'])?>) 이상</option>
										<?php if($_L['gid'])break; endwhile?>
									</select>
						    </div> <!-- .col-sm-3  -->
						</div> <!-- .row  -->
					</div> <!-- .col-sm-10  -->
				 </div> <!-- .form-group  -->
				 <div class="form-group">
			  	   <label class="col-sm-2 control-label">소셜연동</label>
			       <div class="col-sm-10">
			  		   <div class="row">
			  		   	 <div class="col-sm-5">
						  		    <select name="c_snsconnect" class="form-control">
										<option value="0">&nbsp;+ 연동안함</option>
										<option value="0">--------------------------------</option>
									 	<?php $tdir = $g['path_module'].'social/inc/'?>
										<?php if(is_dir($tdir)):?>
										<?php $dirs = opendir($tdir)?>
										<?php while(false !== ($skin = readdir($dirs))):?>
										<?php if($skin=='.' || $skin == '..')continue?>
										<option value="social/inc/<?php echo $skin?>"<?php if($d['blog']['c_snsconnect']=='social/inc/'.$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo str_replace('.php','',$skin)?></option>
										<?php endwhile?>
										<?php closedir($dirs)?>
										<?php endif?>
									</select>
						    </div> <!-- .col-sm-3  -->
						</div> <!-- .row  -->
						<p class="form-control-static text-muted">
						    <small class="text-danger">소셜모듈을 설치 후 사용가능</small>
						</p>
					</div> <!-- .col-sm-10  -->
				 </div> <!-- .form-group  -->
				 <div class="form-group">
			  	   <label class="col-sm-2 control-label">비밀댓글등록</label>
			       <div class="col-sm-10">
			  		   <div class="row">
			  		   	 <div class="col-sm-5">
						  		    <select name="c_use_hidden" class="form-control">
						  		    	 <option value="1"<?php if($d['blog']['c_use_hidden']==1):?> selected="selected"<?php endif?>>사용함</option>
							           <option value="0"<?php if($d['blog']['c_use_hidden']==0):?> selected="selected"<?php endif?>>사용안함</option>
									</select>
						    </div> <!-- .col-sm-3  -->
						</div> <!-- .row  -->
					</div> <!-- .col-sm-10  -->
				 </div> <!-- .form-group  -->
				 <div class="form-group">
						<label class="col-sm-2 control-label">댓글출력수</label>
						<div class="col-sm-10">
							<div class="row">
								<div class="col-sm-3">
									<div class="input-group">
										<input type="text" name="c_recnum" value="<?php echo $d['blog']['c_recnum']?>" class="form-control">
										<span class="input-group-addon">개</span>
									</div>
								</div>
							</div>
						</div>
				 </div>
				 <div class="form-group">
				 	   <label class="col-sm-2 control-label">댓글정렬</label>
				 	   <div class="col-sm-10">
				 	   	   <div class="row">
				 	    	    <div class="col-sm-5">
								   	  <label class="radio-inline">
								         <input  type="radio"  name="c_orderby1" value="asc"<?php if(!$d['blog']['c_orderby1']||$d['blog']['c_orderby1']=='asc'):?> checked="checked"<?php endif?> > 최근댓글이 위로 정렬
								     </label>
								</div>
								 <div class="col-sm-5">
								   	  <label class="radio-inline">
								         <input  type="radio"  name="c_orderby1" value="desc"<?php if($d['blog']['c_orderby1']=='desc'):?> checked="checked"<?php endif?> > 최근댓글이 아래로 정렬
								     </label>
								</div>
							 </div>
						</div>
				  </div>
				  <div class="form-group">
				 	   <label class="col-sm-2 control-label">한줄의견정렬</label>
				 	   <div class="col-sm-10">
				 	   	    <div class="row">
					 	    	    <div class="col-sm-5">
									   	  <label class="radio-inline">
									         <input  type="radio"  name="c_orderby2" value="desc"<?php if($d['blog']['c_orderby2']=='desc'):?> checked="checked"<?php endif?> > 최근한줄의견이 위로 정렬
									     </label>
									</div>
									<div class="col-sm-5">
									   	  <label class="radio-inline">
									         <input  type="radio"  name="c_orderby2" value="asc"<?php if(!$d['blog']['c_orderby2']||$d['blog']['c_orderby2']=='asc'):?> checked="checked"<?php endif?> > 최근한줄의견이 아래로 정렬
									     </label>
									</div>
						   </div>
						</div>
				  </div>
				   <div class="form-group">
						<label class="col-sm-2 control-label">삭제 제한</label>
						<div class="col-sm-10">
							<div class="checkbox">
								<label>
									<input  type="checkbox" name="c_onelinedel" value="1"  <?php if($d['blog']['c_onelinedel']):?> checked<?php endif?>  class="form-control">
									<i></i>한줄의견이 있는 댓글의 삭제를 제한합니다.
								</label>
							</div>
						</div>
				 </div>
				 <div class="form-group">
						<label class="col-sm-2 control-label">댓글포인트</label>
						<div class="col-sm-10">
							<div class="row">
								<div class="col-sm-3">
									<div class="input-group">
										<input type="text" name="c_give_point" value="<?php echo $d['blog']['c_give_point']?>" class="form-control">
										<span class="input-group-addon">포인트 지급</span>
									</div>
								</div>
							</div>
							<p class="form-control-static text-muted">
							    <small>등록한 댓글을 삭제시 환원됩니다</small>
							</p>
						</div>
				 </div>
				 <div class="form-group">
						<label class="col-sm-2 control-label">한줄의견포인트</label>
						<div class="col-sm-10">
							<div class="row">
								<div class="col-sm-3">
									<div class="input-group">
										<input type="text" name="c_give_opoint" value="<?php echo $d['blog']['c_give_opoint']?>" class="form-control">
										<span class="input-group-addon">포인트 지급</span>
									</div>
								</div>
							</div>
							<p class="form-control-static text-muted">
							    <small>등록한 한줄의견을 삭제시 환원됩니다</small>
							</p>
						</div>
				 </div>
				<div class="form-group">
			       <label class="col-sm-2 control-label">댓글제한단어</label>
				     <div class="col-sm-10">
			             <p>
									<textarea name="badword" rows="5" class="form-control" onfocus="this.style.color='#000000';" onblur="this.style.color='#ffffff';" style="color:#fff" ><?php echo $d['blog']['badword']?></textarea>
			 				 </p>
			          </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-2 control-label">제한단어 처리</label>
				  	  <div class="col-sm-10">
				  	  	   <p>
				  	  	   	     <label>
							          <input type="radio" name="badword_action" value="0" <?php if($d['blog']['badword_action']==0):?> checked<?php endif?> /> 제한단어 체크하지 않음
								   </label>
			              </p>
			              <p>
			               	  <label>
								     <input type="radio" name="badword_action" value="1"<?php if($d['blog']['badword_action']==1):?> checked<?php endif?> /> 등록을 차단함
			                    </label>
			               </p>
			               <p>
							   	 <label>
								      <input type="radio" name="badword_action" value="2"<?php if($d['blog']['badword_action']==2):?> checked<?php endif?> /> 제한단어를 다음의 문자로 치환하여 등록함
							       </label>
							       <input type="text" name="badword_escape" value="<?php echo $d['blog']['badword_escape']?>" maxlength="1"   />
			               </p>
					   </div><!-- .col-sm-10 -->
				</div>
				<div class="page-header" style="padding-top:20px;">
					<h4>첨부파일 환경설정</h4>
				</div>
				<div class="form-group">
						<label class="col-sm-2 control-label">일반파일 첨부</label>
						<div class="col-sm-10">
							<div class="row">
								<div class="col-sm-2">
									<div class="input-group">
										<input type="text" name="up_maxnum_file" value="<?php echo $d['blog']['up_maxnum_file']?>" class="form-control">
										<span class="input-group-addon">개</span>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="input-group">
										<input type="text" name="up_maxsize_file" value="<?php echo $d['blog']['up_maxsize_file']?>" class="form-control">
										<span class="input-group-addon">MB 이내</span>
									</div>
								</div>
							</div>
						</div>
				 </div>
				 <div class="form-group">
						<label class="col-sm-2 control-label">사진파일 첨부</label>
						<div class="col-sm-10">
							<div class="row">
								<div class="col-sm-2">
									<div class="input-group">
										<input type="text" name="up_maxnum_img" value="<?php echo $d['blog']['up_maxnum_img']?>" class="form-control">
										<span class="input-group-addon">개</span>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="input-group">
										<input type="text" name="up_maxsize_img" value="<?php echo $d['blog']['up_maxsize_file']?>" class="form-control">
										<span class="input-group-addon">MB 이내</span>
									</div>
								</div>
							</div>
							<p class="form-control-static text-muted">
							    <small>현재 <span class="text-danger">서버에서 허용하고 있는 1회 최대 첨부용량은 <strong><?php echo str_replace('M','',ini_get('upload_max_filesize'))?>MB</strong></span>입니다.</small>
							</p>
						</div>
				 </div>
				 <div class="form-group">
						<label class="col-sm-2 control-label">일반파일 명칭</label>
						<div class="col-sm-10">
							<div class="row">
								<div class="col-sm-3">
									<div class="input-group">
										<input type="text" name="up_name_file" value="<?php echo $d['blog']['up_name_file']?>" class="form-control">
					 				</div>
								</div>
								<div class="col-sm-7">
									<div class="input-group">
								        <span class="input-group-addon">허용 확장자</span>
										 <input type="text" name="up_ext_file" value="<?php echo $d['blog']['up_ext_file']?>" class="form-control">
					 				</div>
								</div>
							</div>
						</div>
				 </div>
				 <div class="form-group">
						<label class="col-sm-2 control-label">사진파일 명칭</label>
						<div class="col-sm-10">
							<div class="row">
								<div class="col-sm-3">
									<div class="input-group">
										<input type="text" name="up_name_img" value="<?php echo $d['blog']['up_name_img']?>" class="form-control">
					 				</div>
								</div>
								<div class="col-sm-7">
									<div class="input-group">
								        <span class="input-group-addon">허용 확장자</span>
										 <input type="text" name="up_ext_img" value="<?php echo $d['blog']['up_ext_img']?>" class="form-control">
					 				</div>
								</div>
							</div>
						</div>
				 </div>
			     <div class="form-group">
						<label class="col-sm-2 control-label">사진 사이즈</label>
						<div class="col-sm-10">
							<div class="row">
								<div class="col-sm-3">
									<select name="up_width_img" class="form-control">
										<option value="240"<?php if($d['blog']['up_width_img']=='240'):?> selected="selected"<?php endif?>>240px</option>
										<option value="320"<?php if($d['blog']['up_width_img']=='320'):?> selected="selected"<?php endif?>>320px</option>
										<option value="400"<?php if($d['blog']['up_width_img']=='400'):?> selected="selected"<?php endif?>>400px</option>
										<option value="480"<?php if($d['blog']['up_width_img']=='480'):?> selected="selected"<?php endif?>>480px</option>
										<option value="640"<?php if($d['blog']['up_width_img']=='640'):?> selected="selected"<?php endif?>>640px</option>
										<option value="720"<?php if($d['blog']['up_width_img']=='720'):?> selected="selected"<?php endif?>>720px</option>
										<option value="1024"<?php if($d['blog']['up_width_img']=='1024'):?> selected="selected"<?php endif?>>1024px</option>
									</select>
								</div>
							</div>
							<p class="form-control-static text-muted">
							    <small class="text-danger">본문에 삽입되는 사진의 가로사이즈</small>
							</p>
						</div>
				</div>
			    <div class="form-group">
						<label class="col-sm-2 control-label">첨부제한 파일</label>
						<div class="col-sm-10">
							<div class="row">
								<div class="col-sm-8">
										<input type="text" name="up_ext_cut" value="<?php echo $d['blog']['up_ext_cut']?>" class="form-control">
					 			</div>
							</div>
							<p class="form-control-static text-muted">
							    <small>
							    	파일첨부시 모든파일에 대해서 파일명 필터링이 이루어지므로 php 관련파일을 첨부해도 안전합니다.<br />
							       그래도 제한하려면 *.php *.php3 *.html *.inc *.cgi *.pl *.js 를 등록해 주세요.
						       </small>
							</p>
						</div>
				 </div>
			    <div class="page-header" style="padding-top:20px;">
					<h4>파일서버 환경설정<small class="text-muted"><a data-toggle="collapse" data-tooltip="tooltip" title="도움말" href="#file_server-guide"><i class="fa fa-question-circle fa-fw"></i></a></small></h4>
				 </div>
				 <p class="help-block collapse" id="file_server-guide">
					 <small>
					 	파일서버를 별도로 분리하여 운영하고자 할 경우 사용합니다.<br />
					   이 모듈을 통해 업로드되는 모든 첨부파일들은 지정된 파일서버로 전송됩니다.<br />
				      전용서버가 아니면 파일업로드 및 삭제/갱신시에 오히려 더 느려질 수 있습니다.<br />
					   반드시 필요한 경우가 아니라면 사용을 권장하지 않습니다.<br />
					   FTP연결은 되나 에러코드가 발생할 경우 Passive Mode에 체크한 후 시도해 보세요<br />
					 </small>
				 </p>
				 <div class="form-group">
						<label class="col-sm-2 control-label">FTP주소/포트</label>
						<div class="col-sm-10">
							<div class="row">
									<div class="col-sm-3">
										 <input type="text" name="ftp_host" value="<?php echo $d['blog']['ftp_host']?>" placeholder="FTP Host" class="form-control">
									</div>
									<div class="col-sm-3">
										 <input type="text" name="ftp_port" value="<?php echo $d['blog']['ftp_port']?>" placeholder="FTP Port" class="form-control">
									</div>
									<div class="col-sm-4">
										<div class="checkbox">
											<label>
												<input  type="checkbox" name="ftp_pasv" value="1"  <?php if($d['blog']['ftp_pasv']):?> checked<?php endif?>  class="form-control"><i></i> Passive Mode
											</label>
										</div>
								   </div>
						   </div>
						</div>
				 </div>
				 <div class="form-group">
						<label class="col-sm-2 control-label">FTP 아이디</label>
						<div class="col-sm-10">
							<div class="row">
							   <div class="col-sm-3">
								  <input type="text" name="ftp_user" value="<?php echo $d['blog']['ftp_user']?>" class="form-control">
							   </div>
						    </div>
						</div>
				 </div>
				 <div class="form-group">
						<label class="col-sm-2 control-label">FTP 패스워드</label>
						<div class="col-sm-10">
							<div class="row">
								<div class="col-sm-3">
									 <input type="text" name="ftp_pass" value="<?php echo $d['blog']['ftp_pass']?>" class="form-control">
								</div>
						   </div>
						</div>
				 </div>

			   <div class="form-group">
						<div class="col-md-offset-2 col-md-9">
							<button type="submit" class="btn btn-primary btn-lg">저장하기</button>
						</div>
				</div>
			</form>


		</div>


	</div><!-- /.row -->
</div><!-- /.container-fluid -->




<script type="text/javascript">
//<![CDATA[
function saveCheck(f)
{
	if (f.s_theme_pc.value == '')
	{
		alert('대표테마를 선택해 주세요.       ');
		f.s_theme_pc.focus();
		return false;
	}
	// if (f.s_theme_mobile.value == '')
	// {
	// 	alert('모바일테마를 선택해 주세요.       ');
	// 	f.s_theme_mobile.focus();
	// 	return false;
	// }
	  if (confirm('정말로 실행하시겠습니까?         '))
		{
			getIframeForAction(f);
			f.submit();
		}
}
//]]>
</script>
