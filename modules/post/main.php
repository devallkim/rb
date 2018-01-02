<?php
if(!defined('__KIMS__')) exit;

include $g['dir_module'].'var/var.php';

if ($upload == 'Y')
{
	if (!$mod) exit;
	$iframe = 'Y';
	$g['dir_module_skin'] = $g['dir_module'].'lib/uploader/';
	$g['url_module_skin'] = $g['url_module'].'/lib/uploader';
	$g['img_module_skin'] = $g['url_module_skin'].'/image';
	$g['dir_module_mode'] = $g['dir_module_skin'].$mod;
	$g['url_module_mode'] = $g['url_module_skin'].'/'.$mod;
	$g['main'] = $g['dir_module_mode'].'.php';
}
else if ($admin == 'Y')
{
	if (!$mod) exit;
	$iframe = 'Y';
	$B = getUidData($table[$m.'list'],$uid);
	if (!$B['uid']) getLink($g['s'].'/?r='.$r,'','정상적인 접근이 아닙니다.','');
	if (!$my['uid']||$my['uid']!=$B['mbruid']) getLink($g['s'].'/?r='.$r,'','관리권한이 없습니다.','');

	$g['dir_module_skin'] = $g['dir_module'].'lib/admin/';
	$g['url_module_skin'] = $g['url_module'].'/lib/admin';
	$g['img_module_skin'] = $g['url_module_skin'].'/image';
	$g['dir_module_mode'] = $g['dir_module_skin'].$mod;
	$g['url_module_mode'] = $g['url_module_skin'].'/'.$mod;
	$g['main'] = $g['dir_module_mode'].'.php';
}
else{
	if(!$set){ getLink($g['s'].'/?r='.$r,'','포스트셋 아이디가 지정되지 않았습니다.','');	}
	$B = getDbData($table[$m.'list'],"id='".$set."'",'*');
	if (!$B['uid']) getLink($g['s'].'/?r='.$r,'','존재하지 않는 포스트셋 입니다.','');
	include $g['dir_module'].'var/var.'.$B['id'].'.php';

	// 메타정보 셋팅

	$g['meta_tit'] = $B['name'].' - '.$_HS['name'];
	$g['meta_sbj'] = $B['name'];
	$g['meta_key'] = $B['name'];

	if(!$_HS['titlefix']&&!$_HM['uid']) $g['browtitle'] = $_HS['title'].' - '.strip_tags($B['name']);

	$d['blog']['theme'] = $d['blog']['theme_pc'] ? $d['blog']['theme_pc'] : $d['blog']['s_theme_pc'];
	// 모바일 디바이스 접속 & PC모드 아님
	if ($g['mobile']&&$_SESSION['pcmode']!='Y')
	{
		$d['blog']['theme'] = $d['blog']['theme_mobile'] ? $d['blog']['theme_mobile'] : ($d['blog']['s_theme_mobile'] ? $d['blog']['s_theme_mobile'] : $d['blog']['theme_pc']);
	}

	$_HM['layout'] = $d['blog']['layout'];

	// 모바일 디바이스 접속 & PC모드 아님
	if ($g['mobile']&&$_SESSION['pcmode']!='Y')
	{
		$_HM['m_layout'] = $d['blog']['m_layout'] ? $d['blog']['m_layout'] : $d['blog']['layout'];
	}
	$front = $front ? $front : 'list';
	$C['vtype'] = $d['blog']['vtype'];
	$C['recnum'] = $d['blog']['recnum'];
	$C['vopen'] = $d['blog']['vopen'];

	$CXA = array();
	include $g['dir_module'].'lib/tree.func.php';
	$ISCAT = getDbRows($table[$m.'category'],'blog='.$B['uid']);
	if($rwcat)
	{
		$_rwcat = getDbData($table[$m.'category'],'blog='.$B['uid']." and id='".$rwcat."'",'uid');
		$cat = $_rwcat['uid'];
	}
	if($cat)
	{
		if($front!='write'&&$front!='meta') $front = 'list';
		$C = getUidData($table[$m.'category'],$cat);
		$ctarr = getMenuCodeToPathBlog($table[$m.'category'],$cat,0);
		$ctnum = count($ctarr);
		for ($i = 0; $i < $ctnum; $i++) $CXA[] = $ctarr[$i]['uid'];
		$vtype = $vtype ? $vtype : $C['vtype'];

	}else{
		//cat가 없다면 찾아온다.
		if($uid){
			$row_data = getDbArray($table[$m.'catidx'],"post=".$_tmp['m']['uid']." and depth=1",'*','category','asc',1,1);
			$catdata = db_fetch_array($row_data);
			$cat = $catdata['category'];
		}
	}
	$vtype = $vtype ? $vtype : $C['vtype'];

	if ($C['vopen'] && $front != 'main' && $front != 'write' && !$uid && !$keyword)
	{
		$uid = getDbCnt($table[$m.'data'],'max(uid)','isreserve=0');
	}

	$d['blog']['writeperm'] = !$my['uid'] || ($my['uid']!=$B['mbruid'] && !strpos('_,'.$B['members'].',',','.$my['id'].',')) ? false : true;

  // 예약발행 처리 : 기존 d_regis 값을 d_publish 로 변경
	$_RSV = getDbArray($table[$m.'data'],$table[$m.'data'].'.blog='.$B['uid'].' and '.$table[$m.'data'].'.isreserve=1','*','gid','asc',0,1);
	while($_R=db_fetch_array($_RSV))
	{
		if ($_R['d_publish'] < $date['totime'])
		{
			getDbUpdate($table[$m.'data'],'isreserve=0','uid='.$_R['uid']);
			 // 승인 사용 여부를 체크하여 d_published 를 업데이트한다 .
			if(!$_R['use_auth']) getDbUpdate($table[$m.'data'],"d_published='".$date['totime']."'",'uid='.$_R['uid']);

			$_orign_category_members = getDbArray($table[$m.'catidx'],'post='.$_R['uid'],'*','uid','asc',0,1);
			while($_ocm=db_fetch_array($_orign_category_members))
			{
				getDbUpdate($table[$m.'category'],'num_open=num_open+1,num_reserve=num_reserve-1','uid='.$_ocm['category']);
			}
		}
	}

	 // 승인자 정보 추출
	 $Team=explode(',',$B['managers']);
	 if(in_array($my['id'], $Team)) $my['manager']=1; // 로그인 회원이 승인자 인지 체크

	 $MNG=getDbData($table['s_mbrid'],"id='".$Team."'",'*');
	 $manager_info=getDbData($table['s_mbrdata'],'memberuid='.$MNG['uid'],'*');

	if ($front == 'list')
	{
		$recnum = $recnum ? $recnum : $C['recnum'];
		$sort = $sort?$sort:'d_published';
		$orderby =$orderby?$orderby:'desc';
		//$setque = $table[$m.'data'].'.blog='.$B['uid'].($d['blog']['writeperm']?'':' and '.$table[$m.'data'].'.isreserve=0 and step=3');
		//$setque = $table[$m.'data'].'.site='.$s.' and '.$table[$m.'data'].'.blog='.$B['uid'].' and '.$table[$m.'data'].'.isreserve=0 and '.$table[$m.'data'].'.step=3';
		 $setque = $table[$m.'data'].'.blog='.$B['uid'].' and '.$table[$m.'data'].'.isreserve=0 and '.$table[$m.'data'].'.step=3';
		if ($where)
		{
			if($keyword)
			{
				if (strlen($_keyword)>2)
			   {
				   $setque .= getSearchSql($where,$keyword,$ikeyword,'or');
		    	}
			    else {
				     $setque .= ' and '.$table[$m.'data'].'.uid=0';
		  	   }
			}
			 if ($where == 'term' && $_date) $setque .= ' and '.$table[$m.'data'].".d_regis like '".$_date."%'";
		}

		if ($cat)
		{
			$setque .= ' and ('.$table[$m.'catidx'].'.category='.$cat.' and '.$table[$m.'data'].'.uid='.$table[$m.'catidx'].'.post)';
			// $setque .= ' and ('.getBlogCategoryCodeToSql($table[$m.'category'],$C['uid']).')'
			$NUM = getDbRows($table[$m.'catidx'].','.$table[$m.'data'],$setque);
			$RCD = getDbArray($table[$m.'catidx'].','.$table[$m.'data'],$setque,'*',$sort,$orderby,$recnum,$p);
		}
		// 동영상 뉴스를 위해 수정함
		elseif ($vtype == 'video') {
			$setque.=' and content_format=3';
			$NUM = getDbRows($table[$m.'data'],$setque);
			$RCD = getDbArray($table[$m.'data'],$setque,'*',$sort,$orderby,$recnum,$p);
		}

		else {
			$NUM = getDbRows($table[$m.'data'],$setque);
			$RCD = getDbArray($table[$m.'data'],$setque,'*',$sort,$orderby,$recnum,$p);
		}
		$TPG = getTotalPage($NUM,$recnum);
	}

	// 글쓰기 모드 접근시 저자만 접근하도록
	if($front=='write'){
     if(!$d['blog']['writeperm']) getLink($g['s'].'/','','블로그 팀원만 포스트 작성 권한이 있습니다. ','');
     $_HM['layout']='_blank/default.php';
     $_HS['layout'] ='_blank/default.php';
	}

    // 로그인시 보관함 수량 세팅 : _singleLayout.php 박스 수량 표시에 사용
    if($my['uid'])
    {
       $boxque='blog='.$B['uid'];
       $all_box_que=$boxque.' and mbruid='.$my['uid'].($step!=''?' and step='.$step:''); // 전체 보관함
       $draft_box_que=$boxque.' and mbruid='.$my['uid'].' and published=0'; // 임시보관
       $auth_box_que=$boxque.' and mbruid<>'.$my['uid'].' and mbruid<>1 and published=1 and step>0'; // 발행 대기
       $req_box_que=$boxque.' and mbruid<>'.$my['uid'].' and mbruid<>1 and published=1 and step=1'; // 승인 대기
    }

    // 보관함/승인함 페이지 접근 처리
    if(strstr('my_all,my_confirm,my_draft',$front))
    {
         	if(!$my['uid']) getLink($g['s'].'/?r='.$r.'&m=member&front=login','','로그인이 필요합니다.  ','');
    	    else{
						$recnum = $recnum ? $recnum : $C['recnum'];
						$sort = $sort?$sort:'gid';
						$orderby =$orderby?$orderby:'asc';

		    	if($front=='my_draft') $setque = $draft_box_que;
		    	else if($front=='my_all') $setque = $all_box_que;
		    	else if($front=='my_confirm'){
					 if (!$my['admin']) {
					 	if(!$my['manager']) getLink($g['s'].'/','','승인자만 접근권한이 있습니다. ','');
					 }
    	   	  $type=$type?$type:'request';
    	   	  $setque =$auth_box_que; // 승인자 및 관리자 등록글 제외

             $step1_que=$setque.' and step=1';
             $step2_que=$setque.' and step=2';
             $step3_que=$setque.' and step=3';

    	   	  $wait_num=getDbRows($table[$m.'data'],$step1_que);
    	   	  $hold_num=getDbRows($table[$m.'data'],$step2_que);
    	   	  $publish_num=getDbRows($table[$m.'data'],$step3_que);

    	   	  if($type=='request') $setque = $step1_que;
    	   	  else if($type=='hold') $setque = $step2_que;
    	   	  else if($type=='publish') $setque = $step3_que;

		    	}

					$NUM = getDbRows($table[$m.'data'],$setque);
					$RCD = getDbArray($table[$m.'data'],$setque,'*',$sort,$orderby,$recnum,$p);
					$TPG = getTotalPage($NUM,$recnum);
    	      }
    }

	if ($uid)
	{
		if($front!='write') $front = 'list';
		$R = getUidData($table[$m.'data'],$uid);
		if (!$R['uid']) getLink($g['s'].'/?r='.$r.'&m='.$m,'','존재하지 않는 포스트입니다.','');

		$_SEO = getDbData($table['s_seo'],'parent='.$R['uid'],'*');

		if ($_SEO['uid'])
		{
			$g['meta_tit'] = $_SEO['title'];
			$g['meta_sbj'] = $_SEO['subject'];
			$g['meta_key'] = $_SEO['keywords'];
			$g['meta_des'] = $_SEO['description'];
			$g['meta_cla'] = $_SEO['classification'];
			$g['meta_rep'] = $_SEO['replyto'];
			$g['meta_lan'] = $_SEO['language'];
			$g['meta_bui'] = $_SEO['build'];
		}
		else {

			// 메타 이미지 세팅 = 해당 포스트의 대표 이미지를 메타 이미지로 적용한다.
			if($R['featured_img']){
	      $FI=getUidData($table['s_upload'],$R['featured_img']);
	      $featured_img=getDynamicResizeImg($FI['tmpname'],'z'); // 동적 사이즈 조정
	      $g['meta_img']=$g['url_root'].$FI['url'].$FI['folder'].'/'.$featured_img;
			}
			$g['meta_tit'] = str_replace('"','\'',$R['subject']).'-'.$_HS['name'];
			$g['meta_key'] = $R['tag'] ? $B['name'].','.$R['tag'] : $B['name'].','.str_replace('"','\'',$R['subject']);
			$g['meta_des'] = $R['review'] ? getStripTags($R['review']) : getStrCut(getStripTags($R['review']),155,'');
			$g['meta_cla'] = $R['category'];
			$g['meta_rep'] = '';
			$g['meta_lan'] = 'kr';
			$g['meta_bui'] = getDateFormat($R['d_regis'],'Y.m.d');
		}


		if (!strpos('_'.$_SESSION['module_'.$m.'_view'],'['.$R['uid'].']'))
		{
			getDbUpdate($table[$m.'data'],'hit=hit+1','uid='.$R['uid']);
			$_SESSION['module_'.$m.'_view'] .= '['.$R['uid'].']';
		}

    // 첨부파일 세팅
		if($R['upload']){
       $d['upload'] = array();
			 $d['upload']['tmp'] = $R['upload'];
			 $d['_pload'] = getArrayString($R['upload']);
			 $attach_file_num=0;
			 foreach($d['_pload']['data'] as $_val)
			 {
				$U = getUidData($table['s_upload'],$_val);
	      if (!$U['uid'])
				{
					$R['upload'] = str_replace('['.$_val.']','',$R['upload']);
					$d['_pload']['count']--;
				}
				else {
					$d['upload']['data'][] = $U;

					if (!$U['sync'])
					{
						$_SYNC = "sync='[".$m."][".$R['uid']."][uid,down][".$table[$m.'data']."][".$R['mbruid']."][m:".$m.",bid:".$R['blog'].",uid:".$R['uid']."]'";
						getDbUpdate($table['s_upload'],$_SYNC,'uid='.$U['uid']);
					}
				}
				if($U['hidden']==0) $attach_file_num++;
			}
			$d['upload']['count'] = $d['_pload']['count'];
			$upload_data=$d['upload']['data'];
		}

	}

	$g['blog_home'] = $g['s'].'/?r='.$r.'&amp;m='.$m.'&amp;set='.$B['id'];
	$g['blog_front']= $g['blog_home'].'&amp;front=';
	$g['blog_cat']	= $g['blog_home'].'&amp;cat=';
	$g['blog_base'] = $g['blog_cat'].$cat.'&amp;front=list&amp;vtype='.$vtype.'&amp;recnum='.$recnum.'&amp;where='.$where.'&amp;keyword='.urlencode($_keyword);
	$g['blog_act']  = $g['blog_home'].$cat.'&amp;vtype='.$vtype.'&amp;recnum='.$recnum.'&amp;where='.$where.'&amp;keyword='.urlencode($_keyword).'&amp;a=';
	$g['blog_view'] = $g['blog_base'].'&amp;p='.$p.'&amp;uid=';
	$g['pagelink']	= $g['blog_base'];

	if ($d['blog']['rewrite'])
	{

		if ($B['id'] == 'blog') {
			$g['blog_home_rw'] = $g['s'].($r?'/'.$r:'').'/post';
		} else {
			$g['blog_home_rw'] = $g['s'].($r?'/'.$r:'').'/post/'.$B['id'];
		}

		if($front=='list')
		{
			$g['blog_view'] = $g['blog_home_rw'].'/';
		}
	}
	$g['dir_module_skin'] = $g['dir_module'].'theme/'.$d['blog']['theme'].'/';
	$g['url_module_skin'] = $g['url_module'].'/theme/'.$d['blog']['theme'];
	$g['img_module_skin'] = $g['url_module_skin'].'/image';

	$g['dir_module_mode'] = $g['dir_module_skin'].$front;
	$g['url_module_mode'] = $g['url_module_skin'].'/'.$front;

	if($d['blog']['sosokmenu'])
	{
		$c=substr($d['blog']['sosokmenu'],-1)=='/'?str_replace('/','',$d['blog']['sosokmenu']):$d['blog']['sosokmenu'];
		$_CA = explode('/',$c);
		$_FHM = getDbData($table['s_menu'],"id='".$_CA[0]."' and site=".$s,'*');

		$g['location'] = '<a href="'.RW(0).'">HOME</a>';
           $_tmp['count'] = count($_CA);
		$_tmp['split_id'] = '';
		for ($_i = 0; $_i < $_tmp['count']; $_i++)
		{
			$_tmp['location'] = getDbData($table['s_menu'],"id='".$_CA[$_i]."'",'*');
			$_tmp['split_id'].= ($_i?'/':'').$_tmp['location']['id'];
			$g['location']   .= ' &gt; <a href="'.RW('c='.$_tmp['split_id']).'">'.$_tmp['location']['name'].'</a>';
			$_HM['uid'] = $_tmp['location']['uid'];
		}
	}

	// 카테고리별 연결메뉴 지정 // by 권기택
	if($cat)
	{
		$_cat = getDbData($table[$m.'category'],'blog='.$B['uid']." and uid='".$cat."'",'linkedmenu');
		$c=substr($_cat['linkedmenu'],-1)=='/'?str_replace('/','',$_cat['linkedmenu']):$_cat['linkedmenu'];
		$_CA = explode('/',$c);
		$_FHM = getDbData($table['s_menu'],"id='".$_CA[0]."' and site=".$s,'*');
		$_tmp['count'] = count($_CA);
		$_tmp['id'] = $_CA[$_tmp['count']-1];
		$_HM = getDbData($table['s_menu'],"id='".$_tmp['id']."' and site=".$s,'*');
	}

	$g['main'] = $g['dir_module_skin'].($front=='write'?'_blankLayout':'_singleLayout').'.php';
 }

 $g['add_header_inc'] = $g['dir_module'].'var/code/'.$B['id'].'.header.php';
 $g['add_footer_inc'] = $g['dir_module'].'var/code/'.$B['id'].'.footer.php';
?>
