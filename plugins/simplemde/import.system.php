<?php
if(!defined('__KIMS__')) exit;
$__SRC__ = str_replace("&lt;?php getWidget(",'<img class="rb-widget-edit-img" alt="getWidget(',$__SRC__);
$__SRC__ = str_replace("))?&gt;",'))" src="./_core/images/blank.gif">',$__SRC__);
?>

<!-- 마크다운 에디터 플러그인 : https://github.com/sparksuite/simplemde-markdown-editor -->
<?php getImport('simplemde','simplemde.min','1.11.2','css')?>
<?php getImport('simplemde','simplemde.min','1.11.2','js')?>

<?php $editor_type = 'markdown'; // 에디터 타입 : html,markdown  ?>

<!-- 동영상,유튜브,오디오 player : http://www.mediaelementjs.com/ -->
<?php getImport('mediaelement','mediaelement-and-player.min','4.2.8','js') ?>
<?php getImport('mediaelement','lang/ko','4.2.8','js') ?>
<?php getImport('mediaelement','mediaelementplayer','4.2.8','css') ?>

<link href="<?php echo $g['s']?>/_core/css/github-markdown.css" rel="stylesheet">
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
					<?php
					// html --> markdown 변환 코드
					spl_autoload_register('getHtmlToMarkdownClass');
					use League\HTMLToMarkdown\HtmlConverter;
					$converter = new HtmlConverter(array('header_style'=>'atx'));
					$mdContent=$converter->convert(getContents($__SRC__,'HTML'));
					?>

					<textarea name="<?php echo $mobileOnly?'mobile':'source' ?>" class="form-control" id="simplemde"><?php echo $mdContent?></textarea>

				 </div><!-- /.card-body -->
			</div><!-- /.position-relative -->

		</div><!-- /.card -->
	</div><!-- /.media-body" -->
</div><!-- /.media -->


<script>

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
	toolbar: ["bold", "italic", "heading","link","horizontal-rule","table","|",
			"code",
			"quote",
			"unordered-list",
			"ordered-list",
			 "|",
			"side-by-side",
			"fullscreen"
	]
});

$('#rb-page-source').on('click', '.nav-tabs .nav-link', function() {
	$('#rb-page-source .nav-tabs .nav-link').removeClass('active').addClass('togglePreview')
	$(this).addClass('active').removeClass('togglePreview')
});

$('#rb-page-source').on('click', '.nav-item .togglePreview', function() {
	simplemde.togglePreview();
	$('.position-relative').toggleClass('preview')
	$('.editor-preview').toggleClass('markdown-body')
	$('.editor-preview .mejs-player').mediaelementplayer();
})

$('#rb-page-source').on('click', '[data-act="comment-edit-cancel"]', function() {
	console.log(simplemde)
	comment.removeClass('is-comment-editing')
	simplemde.toTextArea();  // 에디터 제거

});

simplemde.codemirror.on("viewportChange", function(){
	console.log('전환')
	$('.editor-preview .mejs-player').mediaelementplayer();
});

$('.editor-preview').on('click', 'video', function (e) {
	$('.editor-preview .mejs-player').mediaelementplayer();
});
</script>
