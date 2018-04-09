<?php
if(!defined('__KIMS__')) exit;
$__SRC__ = str_replace("&lt;?php getWidget(",'<img class="rb-widget-edit-img" alt="getWidget(',$__SRC__);
$__SRC__ = str_replace("))?&gt;",'))" src="./_core/images/blank.gif">',$__SRC__);
?>

<div<?php if (!$d['theme']['show_edittoolbar']): ?> class="border p-4"<?php endif; ?>>
	<textarea id="summernote" name="content" class="d-none" rows="3"><?php echo $__SRC__?></textarea>
</div>




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

<?php
$editor_type = 'html'; // 에디터 타입 : html,markdown
$editor_height = $d['theme']['edit_height']?$d['theme']['edit_height']:'350';
?>


<style>
	.note-editor.card {
		border-radius: 0;
		border: 1px solid #d1d1d1
	}
	.card-header.note-toolbar {
    padding: 5px 0 7px 10px;
		margin: 0;
	}
	.note-editor .note-toolbar-wrapper {
		height: 47px !important
	}
</style>

<script>

var textarea = $('#summernote')

function InserHTMLtoEditor(type,sHTML,src,caption){

	if (type=='photo') {
		textarea.summernote('insertImage',src, function ($image) {
			$image.attr('alt',caption);
		});
	} else {
		textarea.summernote('createLink', {
			text: caption,
			url: src ,
			newWindow: true
		});
	}
}

textarea.summernote({

	<?php if (!$d['theme']['show_edittoolbar']): ?>  //에디터 툴바숨김
	airMode: true,
	<?php endif; ?>

	placeholder: '내용을 입력하세요.',
	tabsize: 2,
	styleWithSpan: false,
	minHeight:<?php echo $editor_height ?>,  //에디터 최소 높이 : _var.php 에서 설정
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
	theme: 'monokai' }
});

</script>
