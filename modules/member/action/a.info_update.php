<?php
if(!defined('__KIMS__')) exit;

if (!$my['uid'])
{
	getLink('','','정상적인 접근이 아닙니다.','');
}


if ($act == 'info')  // 프로필 정보 변경
{

	include_once $g['dir_module'].'var/var.join.php';

	$memberuid	= $my['admin'] && $memberuid ? $memberuid : $my['uid'];
	$name		= trim($name);
	$nic		= trim($nic);
	$nic		= $nic ? $nic : $name;

	if (($d['member']['form_nic'] && !$check_nic) || !$check_email)
	{
		getLink('','','정상적인 접근이 아닙니다.','');
	}
	if(getDbRows($table['s_mbrdata'],"memberuid<>".$memberuid." and email='".$email."'"))
	{
		getLink('','','이미 존재하는 이메일입니다.','');
	}
	if($d['member']['form_nic'])
	{
		if(!$my['admin'])
		{
			if(strstr(','.$d['member']['join_cutnic'].',',','.$nic.',') || getDbRows($table['s_mbrdata'],"memberuid<>".$memberuid." and nic='".$nic."'"))
			{
				getLink('','','이미 존재하는 닉네임입니다.','');
			}
		}
	}

	$home		= $home ? (strstr($home,'http://')?str_replace('http://','',$home):$home) : '';
	$birth1		= $birth_1;
	$birth2		= $birth_2.$birth_3;
	$birthtype	= $birthtype ? $birthtype : 0;
	// $tel1		= $tel1_1 && $tel1_2 && $tel1_3 ? $tel1_1 .'-'. $tel1_2 .'-'. $tel1_3 : '';
	// $tel2		= $tel2_1 && $tel2_2 && $tel2_3 ? $tel2_1 .'-'. $tel2_2 .'-'. $tel2_3 : '';

	if(!$overseas)
	{
		$zip		= $zip_1.$zip_2;
		$addrx		= explode(' ',$addr1);
		$addr0		= $addr1 && $addr2 ? $addrx[0] : '';
		$addr1		= $addr1 && $addr2 ? $addr1 : '';
		$addr2		= trim($addr2);
	}
	else {
		$zip		= '';
		$addr0		= '';
		$addr1		= '';
		$addr2		= '';
	}

	$job		= trim($job);
	$company		= trim($company);
	$marr1		= $marr_1 && $marr_2 && $marr_3 ? $marr_1 : 0;
	$marr2		= $marr_1 && $marr_2 && $marr_3 ? $marr_2.$marr_3 : 0;
	$sms		= $tel2 && $sms ? 1 : 0;
	$mailing	= $remail;
	$pw_q		= trim($pw_q);
	$pw_a		= trim($pw_a);
	$_add = explode('<split>',$my['addfield']);
	$addfield	= '';
	for ($i = 0; $i < 10; $i++)
	{
		$addfield .= ($i ? $_add[$i] : $addfield_0).'<split>';
	}

	$_QVAL = "email='$email',name='$name',nic='$nic',home='$home',sex='$sex',birth1='$birth1',birth2='$birth2',birthtype='$birthtype',tel1='$tel1',";
	$_QVAL.= "zip='$zip',addr0='$addr0',addr1='$addr1',addr2='$addr2',job='$job',company='$company',marr1='$marr1',marr2='$marr2',sms='$sms',mailing='$mailing',pw_q='$pw_q',pw_a='$pw_a',addfield='$addfield'";
	getDbUpdate($table['s_mbrdata'],$_QVAL,'memberuid='.$memberuid);

	$isCOMP = getDbData($table['s_mbrcomp'],'memberuid='.$memberuid,'*');

	if ($comp)
	{
		$comp_num	= $comp_num_1 && $comp_num_2 && $comp_num_3 ? $comp_num_1.$comp_num_2.$comp_num_3 : 0;
		//$comp_type	= $comp_type;
		$comp_name	= trim($comp_name);
		$comp_ceo	= trim($comp_ceo);
		$comp_condition	= trim($comp_condition);
		$comp_item = trim($comp_item);
		$comp_tel	= $comp_tel_1 && $comp_tel_2 ? $comp_tel_1 .'-'. $comp_tel_2 .($comp_tel_3 ? '-'.$comp_tel_3 : '') : '';
		$comp_fax	= $comp_fax_1 && $comp_fax_2 && $comp_fax_3 ? $comp_fax_1 .'-'. $comp_fax_2 .'-'. $comp_fax_3 : '';
		$comp_zip	= $comp_zip_1.$comp_zip_2;
		$comp_addr0	= $comp_addr1 && $comp_addr2 ? substr($comp_addr1,0,6) : '';
		$comp_addr1	= $comp_addr1 && $comp_addr2 ? $comp_addr1 : '';
		$comp_addr2	= trim($comp_addr2);
		$comp_part	= trim($comp_part);
		$comp_level	= trim($comp_level);

		if ($isCOMP['memberuid'])
		{
			$_QVAL = "comp_num='$comp_num',comp_type='$comp_type',comp_name='$comp_name',comp_ceo='$comp_ceo',comp_condition='$comp_condition',comp_item='$comp_item',";
			$_QVAL.= "comp_tel='$comp_tel',comp_fax='$comp_fax',comp_zip='$comp_zip',comp_addr0='$comp_addr0',comp_addr1='$comp_addr1',comp_addr2='$comp_addr2',comp_part='$comp_part',comp_level='$comp_level'";
			getDbUpdate($table['s_mbrcomp'],$_QVAL,'memberuid='.$isCOMP['memberuid']);
		}
		else {

			$_QKEY = "memberuid,comp_num,comp_type,comp_name,comp_ceo,comp_condition,comp_item,";
			$_QKEY.= "comp_tel,comp_fax,comp_zip,comp_addr0,comp_addr1,comp_addr2,comp_part,comp_level";
			$_QVAL = "'$memberuid','$comp_num','$comp_type','$comp_name','$comp_ceo','$comp_condition','$comp_item',";
			$_QVAL.= "'$comp_tel','$comp_fax','$comp_zip','$comp_addr0','$comp_addr1','$comp_addr2','$comp_part','$comp_level'";
			getDbInsert($table['s_mbrcomp'],$_QKEY,$_QVAL);
		}
	}

	//트리포트 회원정보 변경
	include $g['path_core'].'function/rss.func.php';
	$g['livequry'] = 'https://ssl.3-pod.com/User/api.aspx?ptncode=0331&ptnkey=FD08508FA0220C53BA94BE59EBC06045&enc=utf-8&cmd=';

	$_insertmbrdata  = 'member_no='.$my['mbrno'];
	$_insertmbrdata .= '&member_name='.$name;
	$_insertmbrdata .= '&zip_no='.($zip_1?$zip_1.'-'.$zip_2:'');
	$_insertmbrdata .= '&addr_zip='.urlencode($addr1?$addr1:'주소 앞부분');
	$_insertmbrdata .= '&addr_desc='.urlencode(trim($addr2)?trim($addr2):'주소 뒷부분');

	$_result = getUrlData($g['livequry'].'MODIFY_MEMBER_INFO&'.$_insertmbrdata,10);

	if (getRssContent($_result,'Result') != 10000)
	{
		echo '<link type="text/css" rel="stylesheet" charset="utf-8" href="'.$g['s'].'/_core/css/sys.css" />';
		echo '<script type="text/javascript">';
		echo 'parent.window.scrollTo(0,0);';
		echo 'parent.alertLayer("#alertBox","danger","정보변경 실패 - <a href=\"/'.$my['id'].'\" class=\"alert-link\">프로필 보기</a>","Y","Y","");';
		echo '</script>';
		exit;
	}

	setrawcookie('info_update_result', rawurlencode('success'));  // 성공여부 cookie 저장
	getLink('reload','parent.','','');

}

if ($act == 'noti')  // 알림 정보 변경
{

	$memberuid	= $my['admin'] && $memberuid ? $memberuid : $my['uid'];

	$tel2		= $tel2_1 && $tel2_2 && $tel2_3 ? $tel2_1 .'-'. $tel2_2 .'-'. $tel2_3 : '';

	$_QVAL = "noti_mng='$noti_mng',noti_rct='$noti_rct',tel2='$tel2'";
	getDbUpdate($table['s_mbrdata'],$_QVAL,'memberuid='.$memberuid);

	//트리포트 회원정보 변경
	include $g['path_core'].'function/rss.func.php';
	$g['livequry'] = 'https://ssl.3-pod.com/User/api.aspx?ptncode=0331&ptnkey=FD08508FA0220C53BA94BE59EBC06045&enc=utf-8&cmd=';

	$_insertmbrdata  = 'member_no='.$my['mbrno'];

	if ($noti_mng) {
		$_insertmbrdata .= '&mng_name='.$my['name'];
		$_insertmbrdata .= '&mng_email='.trim($email);
		$_insertmbrdata .= '&mng_htel='.trim($tel2);
	} else {
		$_insertmbrdata .= '&mng_name=';
		$_insertmbrdata .= '&mng_email=';
		$_insertmbrdata .= '&mng_htel=';
	}

	if ($noti_rct) {
		$_insertmbrdata .= '&rct_name='.$my['name'];
		$_insertmbrdata .= '&rct_email='.trim($email);
		$_insertmbrdata .= '&rct_htel='.trim($tel2);
	} else {
		$_insertmbrdata .= '&rct_name=';
		$_insertmbrdata .= '&rct_email=';
		$_insertmbrdata .= '&rct_htel=';
	}

	$_result = getUrlData($g['livequry'].'MODIFY_MEMBER_INFO&'.$_insertmbrdata,10);

	if (getRssContent($_result,'Result') != 10000)
	{
 	getLink('reload','parent.','알림정보 변경 실패 되었습니다. 다시 시도해 주세요.','');
	}

	setrawcookie('info_update_result', rawurlencode('success'));  // 성공여부 cookie 저장
	getLink('reload','parent.','','');
}


if ($act == 'pw')  // 비밀번호 변경
{

	if (!$pw || !$pw1 || !$pw2)
	{
		getLink('','','정상적인 접근이 아닙니다.','');
	}

	if ($my['last_pw'] < 20171105) {

		if (md5($pw) != $my['pw'] && $my['tmpcode'] != md5($pw))
		{
			echo '<script type="text/javascript">';
			echo 'parent.window.scrollTo(0,0);';
			echo 'parent.alertLayer("#alertBox","danger","현재 비밀번호가 일치하지 않습니다.","Y","Y","");';
			echo 'parent.$("#user_old_password").val("").focus();';
			echo '</script>';
			exit();
		}


	} else {

		if (getCrypt($pw,$my['d_regis']) != $my['pw'] && $my['tmpcode'] != getCrypt($pw,$my['d_regis']))
		{

			echo '<script type="text/javascript">';
			echo 'parent.window.scrollTo(0,0);';
			echo 'parent.alertLayer("#alertBox","danger","현재 비밀번호가 일치하지 않습니다.","Y","Y","");';
			echo 'parent.$("#user_old_password").val("").focus();';
			echo '</script>';
			exit();
		}
	}



	if ($pw == $pw1)
	{
		getLink('reload','parent.','현재 비밀번호와 변경할 비밀번호가 같습니다.','');
	}

	getDbUpdate($table['s_mbrid'],"pw='".getCrypt($pw1,$my['d_regis'])."'",'uid='.$my['uid']);
	getDbUpdate($table['s_mbrdata'],"last_pw='".$date['today']."',tmpcode=''",'memberuid='.$my['uid']);

	$_SESSION['mbr_pw']  = getCrypt($pw1,$my['d_regis']);

	// getLink('reload','parent.','변경되었습니다.','');

	echo '<script type="text/javascript">';
	echo 'parent.window.scrollTo(0,0);';
	echo 'parent.alertLayer("#alertBox","success","비밀번호가 변경되었습니다.","Y","Y","");';
	echo '</script>';
	exit();

}




?>
