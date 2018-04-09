<?php
if(!defined('__KIMS__')) exit;
$__SRC__ = str_replace("&lt;?php getWidget(",'<img class="rb-widget-edit-img" alt="getWidget(',$__SRC__);
$__SRC__ = str_replace("))?&gt;",'))" src="./_core/images/blank.gif">',$__SRC__);

$editor_height = $d['theme']['edit_height']?$d['theme']['edit_height']:'350';
?>

<style>

.rb-markdown-editor .media .card-header {
	padding: .75rem 1.25rem;
	margin-left: -.5rem;
	margin-right: -.5rem;
	margin-bottom: 0;
	background-color: #f6f8fa;
	border-bottom: 1px solid rgba(0,0,0,.125);
}
.rb-markdown-editor .card-header-tabs {
	border-bottom: 0;
}
.rb-markdown-editor .nav-tabs .nav-item {
	margin-bottom: -1px;
}
.rb-markdown-editor .nav-tabs .nav-link {
	padding: 14px 12px;
	font-size: 14px;
	line-height: 14px;
	color: #586069;
	cursor: pointer;
	background-color: transparent;
	border-top-left-radius: .25rem;
	border-top-right-radius: .25rem;
}
.rb-markdown-editor .nav-tabs .nav-link.active {
	color: #495057;
	background-color: #fff;
	border-color: #ddd #ddd #fff;
}
.rb-markdown-editor .nav-tabs .nav-link:not(.active) {
	border-right: none
}
.rb-markdown-editor .nav-tabs a:not(.active):hover,
.rb-markdown-editor .nav-tabs a:not(.active):focus {
	border-top-color: transparent;
	border-left-color: transparent;
	border-right-color: transparent;
	border-bottom: 0
}

.rb-markdown-editor .nav-tabs .nav-link.active:first-child {
	border-left: 1px solid #ddd;
}
.rb-markdown-editor .editor-toolbar {
	position: absolute;
	top: 3px;
	right: 0;
	border: 0
}
.rb-markdown-editor .editor-preview {
	background: #fff;
	height: auto;
  min-height: <?php echo $editor_height ?>px;
}


.rb-markdown-editor .media .CodeMirror {
	border-radius: 4px !important;
	background-color: #fafbfc;
}
.rb-markdown-editor .CodeMirror-scroll {
	  min-height: <?php echo $editor_height ?>px;
		padding-bottom: 55px;
}
.rb-markdown-editor .media .CodeMirror.CodeMirror-focused {
	background-color: #fff;
	border-color: #2188ff;
	outline: none;
	box-shadow: inset 0 1px 2px rgba(27,31,35,0.075), 0 0 0 0.2em rgba(3,102,214,0.3);
}
.preview .editor-toolbar {
	display: none
}
.editor-toolbar.disabled-for-preview {
	display: none
}
.preview .CodeMirror,
.rb-markdown-editor .disabled-for-preview ~ .CodeMirror {
	border: 0 !important
}

.editor-preview-side img {
	max-width: 100%;
	height: auto;
}

.rb-markdown-editor .editor-preview.editor-preview-active:empty::before {
	content: 'ë¯¸ë¦¬ ë³¼ ë‚´ìš©ì´ ì—†ìŠµë‹ˆë‹¤.';
	color: #999
}
.rb-markdown-editor .disabled-for-preview ~ .editor-statusbar {
	display: none
}

.rb-markdown-editor .editor-statusbar {
	display: none
}
.rb-markdown-editor .attach-files {
	position: absolute;
	bottom: 10px;
	z-index: 8;
	left: 1px;
	right: 1px;
	border-top: 1px dashed #dfe2e5;
	padding: 0 10px;
	margin: 0;
	font-size: 13px;
	line-height: 28px;
	color: #586069;
	background-color: #fafbfc;
}


.rb-markdown-editor .position-relative.preview {
	margin-bottom: 10px;
	border-bottom: 1px solid #e1e4e8;
}
.rb-markdown-editor .preview .attach-files {
	visibility: hidden;
}

.rb-markdown-editor .CodeMirror-wrap:focus ~ .attach-files {
	border-color: #2188ff;
}

.rb-markdown-editor .card .list-group-flush .list-group-item:last-child {
	border-bottom: none;
}


.is-comment-editing .CodeMirror,
.is-comment-editing .CodeMirror-scroll {
	min-height: 100px !important;
	max-height: 500px !important;
}

.rb-markdown-editor .editor-preview.editor-preview-active:empty::before {
	content: '미리 볼 내용이 없습니다.';
	color: #999;
}

.CodeMirror-scroll .CodeMirror-line  {
	word-break:break-all;
	word-wrap:break-word;
}

</style>

<!-- 마크다운 에디터 플러그인 : https://github.com/sparksuite/simplemde-markdown-editor -->
<?php getImport('simplemde','simplemde.min','1.11.2','css')?>
<?php getImport('simplemde','simplemde.min','1.11.2','js')?>

<!-- 동영상,유튜브,오디오 player : http://www.mediaelementjs.com/ -->
<?php getImport('mediaelement','mediaelement-and-player.min','4.2.8','js') ?>
<?php getImport('mediaelement','lang/ko','4.2.8','js') ?>
<?php getImport('mediaelement','mediaelementplayer','4.2.8','css') ?>
<?php $editor_type = 'markdown'; // 에디터 타입 : html,markdown  ?>

<link href="<?php echo $g['s']?>/_core/css/github-markdown.css" rel="stylesheet">

<section class="rb-markdown-editor">
	<div class="media">
		<div class="media-body">

			<div class="card bg-white">

				<div class="position-relative px-2">
					<div class="card-header">
						 <ul class="nav nav-tabs card-header-tabs">
							 <li class="nav-item">
								 <a class="nav-link active">작성하기</a>
							 </li>
							 <li class="nav-item">
								 <a class="nav-link togglePreview">미리보기</a>
							 </li>
						 </ul>
					</div>

					<div class="card-body px-0 pt-2 pb-2">
						<input type="hidden" name="markdown" value="1">
						<textarea name="content" class="form-control" id="simplemde"><?php echo getMarkdownContents($R['content'])?></textarea>
					 </div><!-- /.card-body -->
				</div><!-- /.position-relative -->

			</div><!-- /.card -->
		</div><!-- /.media-body" -->
	</div><!-- /.media -->
</section>



<script>

function InserHTMLtoEditor(type,sHTML) {
	pos = simplemde.codemirror.getCursor();
	simplemde.codemirror.setSelection(pos, pos);
	simplemde.codemirror.replaceSelection(sHTML);
}

// 마크다운 에디터 세팅
var simplemde = new SimpleMDE({
	element: $('#simplemde')[0],
	spellChecker: false,
	placeholder: "내용을 작성하세요...",
	insertTexts: {
		horizontalRule: ["", "\n\n-----\n\n"],
		image: ["![](http://", ")"],
		link: ["[", "](http://)"],
	},
	toolbar: ["bold", "italic", "heading","link","horizontal-rule","|",
			"code",
			"quote",
			"unordered-list",
			"ordered-list",
			 "|",
			"side-by-side",
			"fullscreen"
	]
});

$('.rb-markdown-editor').on('click', '.nav-tabs .nav-link', function() {
	$('.rb-markdown-editor .nav-tabs .nav-link').removeClass('active').addClass('togglePreview')
	$(this).addClass('active').removeClass('togglePreview')
	var isPreview = simplemde.isPreviewActive()
	if (isPreview) {
		$('.CodeMirror-wrap').removeAttr('style');
		$('[data-role="attach"]').removeClass('d-none')
	} else {
		setTimeout(function(){
			var preview_height = $('.editor-preview').height() + 20;
			$('.CodeMirror-wrap').css('height',preview_height)
		}, 300);
		$('[data-role="attach"]').addClass('d-none')
	}
});

$('.rb-markdown-editor').on('click', '.nav-item .togglePreview', function() {
	simplemde.togglePreview();
	$('.position-relative').toggleClass('preview')
	$('.editor-preview').toggleClass('markdown-body')
	$('.editor-preview .mejs-player').mediaelementplayer();

})

simplemde.codemirror.on("viewportChange", function(){
	console.log('전환')
	$('.editor-preview .mejs-player').mediaelementplayer();
});

$('.editor-preview').on('click', 'video', function (e) {
	$('.editor-preview .mejs-player').mediaelementplayer();
});
</script>
