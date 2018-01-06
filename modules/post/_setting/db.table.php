<?php
$table[$module.'channel'] = $DB['head'].'_'.$module.'_channel'; //채널
$table[$module.'category'] = $DB['head'].'_'.$module.'_category'; //포스트카테고리
$table[$module.'catidx'] = $DB['head'].'_'.$module.'_category_index'; //포스트카테고리인덱스
$table[$module.'data'] = $DB['head'].'_'.$module.'_data'; //포스트데이터
$table[$module.'month']  = $DB['head'].'_'.$module.'_month'; //월별수량
$table[$module.'day']  = $DB['head'].'_'.$module.'_day'; //일별수량
$table[$module.'members'] = $DB['head'].'_'.$module.'_members';//구독회원(예비용)
$table[$module.'likes'] = $DB['head'].'_'.$module.'_likes';// 좋아요
$table[$module.'seo'] = $DB['head'].'_'.$module.'_seo';//SEO
$table[$module.'keywordset'] = $DB['head'].'_'.$module.'_keywordset'; // 키워드셋 리스트
$table[$module.'keyword'] = $DB['head'].'_'.$module.'_keyword'; // 키워드 데이타
?>
