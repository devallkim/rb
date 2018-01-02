<?php
  $_SEO=getDbData($table[$module.'seo'],'parent='.$uid,'*');
  $_R=getUidData($table[$module.'data'],$uid);
?>
<form name="seoForm" id="add-form" class="form-horizontal" action="<?php echo $g['s']?>/" method="post" enctype="multipart/form-data">
	<input type="hidden" name="r" value="<?php echo $r?>">
	<input type="hidden" name="m" value="<?php echo $module?>">
	<input type="hidden" name="uid" value="<?php echo $uid?>">
	<input type="hidden" name="a" value="_admin/seo_update">


	<div class="form-group rb-outside">
		<label class="col-sm-3 control-label">타이틀(title)</label>
		<div class="col-sm-8">
			<div class="input-group">
				<input type="text" class="form-control" name="s_title<?php echo $uid?>" value="<?php echo $_SEO['title']?>">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" onclick="document.seoForm.s_title<?php echo $uid?>.value='<?php echo $_R['subject']?>';">제목과 동일</button>
				</span>
			</div>
		</div>
	</div>
	<div class="form-group rb-outside">
		<label class="col-sm-3 control-label">주제(subject)</label>
		<div class="col-sm-8">
			<div class="input-group">
				<input type="text" class="form-control" name="s_subject<?php echo $uid?>" value="<?php echo $_SEO['subject']?>">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" onclick="document.seoForm.s_subject<?php echo $uid?>.value='<?php echo $_R['subject']?>';">제목과 동일</button>
				</span>
			</div>
		</div>
	</div>
	<div class="form-group rb-outside">
		<label class="col-sm-3 control-label">키워드(keywords)</label>
		<div class="col-sm-8">
			<div class="input-group">
				<input type="text" class="form-control" name="s_keywords<?php echo $uid?>" value="<?php echo $_SEO['keywords']?>">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" onclick="document.seoForm.s_keywords<?php echo $uid?>.value='<?php echo $_R['tag']?>';">태그와 동일</button>
				</span>
			</div>
		</div>
	</div>
	<div class="form-group rb-outside">
		<label class="col-sm-3 control-label">설명(description)</label>
		<div class="col-sm-8">
			<div class="input-group">
				<input type="text" class="form-control" name="s_desc<?php echo $uid?>" value="<?php echo $_SEO['description']?>">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" onclick="document.seoForm.s_desc<?php echo $uid?>.value='<?php echo $_R['review']?>';">리뷰와 동일</button>
				</span>
			</div>
		</div>
	</div>
	<div class="form-group rb-outside">
		<label class="col-sm-3 control-label">분류(classification)</label>
		<div class="col-sm-8">
				<input type="text" class="form-control" name="s_class<?php echo $uid?>" value="<?php echo $_SEO['classification']?>">
		</div>
	</div>
	<div class="form-group rb-outside">
		<label class="col-sm-3 control-label">연락처(reply-to)</label>
		<div class="col-sm-8">
				<input type="text" class="form-control" name="s_replyto<?php echo $uid?>" value="<?php echo $_SEO['replyto']?$_SEO['replyto']:$my['email']?>">
		</div>
	</div>
	<div class="form-group rb-outside">
		<label class="col-sm-3 control-label">언어(content-language)</label>
		<div class="col-sm-8">
				<input type="text" class="form-control" name="s_language<?php echo $uid?>" value="<?php echo $_SEO['language']?$_SEO['language']:'kr'?>">
		</div>
	</div>
	<div class="form-group rb-outside">
		<label class="col-sm-3 control-label">제작일(build)</label>
		<div class="col-sm-8">
				<input type="text" class="form-control" name="s_build<?php echo $uid?>" value="<?php echo $_SEO['build']?$_SEO['build']:date('Y.m.d')?>">
		</div>
	</div>

	<div class="modal-footer" style="text-align:center">
			<button type="submit" class="btn btn-primary">등록하기</button>
	</div>
</form>
