<?php
if(!defined('__KIMS__')) exit;
$__SRC__ = str_replace("&lt;?php getWidget(",'<img class="rb-widget-edit-img" alt="getWidget(',$__SRC__);
$__SRC__ = str_replace("))?&gt;",'))" src="./_core/images/blank.gif">',$__SRC__);
?>

<!-- 마크다운 에디터 플러그인 : https://github.com/sparksuite/simplemde-markdown-editor -->
<?php getImport('simplemde','simplemde.min','1.11.2','css')?>
<?php getImport('simplemde','simplemde.min','1.11.2','js')?>

<?php
// html --> markdown 변환 코드
spl_autoload_register('getHtmlToMarkdownClass');
use League\HTMLToMarkdown\HtmlConverter;
$converter = new HtmlConverter(array('header_style'=>'atx'));
$mdContent=$converter->convert(getContents($__SRC__,'HTML'));
?>

<textarea name="source" class="form-control" id="simplemde"><?php echo $mdContent?></textarea>

<script>

// 마크다운 에디터 세팅
var simplemde = new SimpleMDE({
  element: $('#simplemde')[0],
  spellChecker: false,
	placeholder: "내용을 작성하세요..."
});

</script>
