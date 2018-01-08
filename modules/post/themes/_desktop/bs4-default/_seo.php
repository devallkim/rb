<div class="form-group">
	<label class="col-md-1 control-label">타이틀</label>
	<div class="col-md-11">
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Title" name="s_title" value="<?php echo $_SEO['title']?>">
			<span class="input-group-btn">
				<button type="button" class="btn btn-default" onclick="document.writeForm.s_title.value=document.writeForm.subject.value;">제목과 동일</button>
			</span>
		</div>
	</div>
</div>
<div class="form-group">
	<label class="col-md-1 control-label">주제</label>
	<div class="col-md-11">
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Subject" name="s_subject" value="<?php echo $_SEO['subject']?>">
			<span class="input-group-btn">
				<button type="button" class="btn btn-default" onclick="document.writeForm.s_subject.value=document.writeForm.subject.value;">제목과 동일</button>
			</span>
		</div>
	</div>
</div>
<div class="form-group">
	<label class="col-md-1 control-label">키워드</label>
	<div class="col-md-11">
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Keywords" name="s_keywords" value="<?php echo $_SEO['keywords']?>">
			<span class="input-group-btn">
				<button type="button" class="btn btn-default" onclick="document.writeForm.s_keywords.value=document.writeForm.tag.value;">태그와 동일</button>
			</span>
		</div>
	</div>
</div>
<div class="form-group">
	<label class="col-md-1 control-label">설명</label>
	<div class="col-md-11">
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Description" name="s_desc" value="<?php echo $_SEO['description']?>">
			<span class="input-group-btn">
				<button type="button" class="btn btn-default" onclick="document.writeForm.s_desc.value=document.writeForm.review.value;">리뷰와 동일</button>
			</span>
		</div>
	</div>
</div>
<div class="form-group">
	<label class="col-md-1 control-label">분류</label>
	<div class="col-md-11">
			<input type="text" class="form-control" placeholder="Classification" name="s_class" value="<?php echo $_SEO['classification']?>">
	</div>
</div>
<div class="form-group">
	<label class="col-md-1 control-label">연락처</label>
	<div class="col-md-11">
			<input type="text" class="form-control" placeholder="Rreply-to" name="s_replyto" value="<?php echo $_SEO['replyto']?$_SEO['replyto']:$my['email']?>">
	</div>
</div>
<div class="form-group">
	<label class="col-md-1 control-label">언어</label>
	<div class="col-md-11">
			<input type="text" class="form-control" placeholder="Content-language" name="s_language" value="<?php echo $_SEO['language']?$_SEO['language']:'kr'?>">
	</div>
</div>
<div class="form-group">
	<label class="col-md-1 control-label">제작일</label>
	<div class="col-md-11">
			<input type="text" class="form-control" placeholder="Build" name="s_build" value="<?php echo $_SEO['build']?$_SEO['build']:date('Y.m.d')?>">
	</div>
</div>
