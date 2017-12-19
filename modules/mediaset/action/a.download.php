<?php
if(!defined('__KIMS__')) exit;

include $g['dir_module'].'var/var.php';

$R=getUidData($table['s_upload'],$uid);
if (!$R['uid']) getLink('','','정상적인 요청이 아닙니다.','');
if ($R['type'] < 1) return getLink('','','다운로드 받을 수 없는 파일입니다.','');


$filename = getUTFtoKR($R['name']);
$filetmpname = getUTFtoKR($R['tmpname']);

if ($R['url']==$d['mediaset']['ftp_urlpath'])
{
	$filepath = $d['mediaset']['ftp_urlpath'].$R['folder'].'/'.$filetmpname;
	$filesize = $R['size'];
}
else {
	$filepath = $g['path_file'].$R['folder'].'/'.$filetmpname;
	$filesize = filesize($filepath);
}

header("Content-Type: application/octet-stream");
header("Content-Length: " .$filesize);
header('Content-Disposition: attachment; filename="'.$filename.'"');
header("Cache-Control: private, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if ($R['fserver'] && $R['url'] == $d['mediaset']['ftp_urlpath'])
{
	$FTP_CONNECT = ftp_connect($d['mediaset']['ftp_host'],$d['mediaset']['ftp_port']);
	$FTP_CRESULT = ftp_login($FTP_CONNECT,$d['mediaset']['ftp_user'],$d['mediaset']['ftp_pass']);
	if (!$FTP_CONNECT) getLink('','','FTP서버 연결에 문제가 발생했습니다.','');
	if (!$FTP_CRESULT) getLink('','','FTP서버 아이디나 패스워드가 일치하지 않습니다.','');
	if($d['mediaset']['ftp_pasv']) ftp_pasv($FTP_CONNECT, true);

	$filepath = $g['path_tmp'].'session/'.$filetmpname;
	ftp_get($FTP_CONNECT,$filepath,$d['mediaset']['ftp_folder'].$R['folder'].'/'.$filetmpname,FTP_BINARY);
	ftp_close($FTP_CONNECT);
	$fp = fopen($filepath, 'rb');
	if (!fpassthru($fp)) fclose($fp);
	unlink($filepath);
}
else {
	$fp = fopen($filepath, 'rb');
	if (!fpassthru($fp)) fclose($fp);
}
exit;
?>
