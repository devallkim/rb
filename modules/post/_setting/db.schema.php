<?php
if(!defined('__KIMS__')) exit;

//포스트리스트
$_tmp = db_query( "select count(*) from ".$table[$module.'channel'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table[$module.'channel']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
gid			INT				DEFAULT '0'		NOT NULL,
type	TINYINT			DEFAULT '0'		NOT NULL,
mbruid		INT				DEFAULT '0'		NOT NULL,
managers		TEXT			DEFAULT ''		NOT NULL,
members		TEXT			DEFAULT ''		NOT NULL,
id			VARCHAR(50)		DEFAULT ''		NOT NULL,
name		VARCHAR(200)	DEFAULT ''		NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
d_last		VARCHAR(14)		DEFAULT ''		NOT NULL,
num_w		INT				DEFAULT '0'		NOT NULL,
num_c		INT				DEFAULT '0'		NOT NULL,
num_o		INT				DEFAULT '0'		NOT NULL,
num_m		INT				DEFAULT '0'		NOT NULL,
use_auth   TINYINT    DEFAULT '0' NOT NULL,
KEY gid(gid),
KEY type(type),
KEY mbruid(mbruid),
KEY id(id),
KEY num_w(num_w),
KEY num_c(num_c),
KEY num_o(num_o),
KEY num_m(num_m)) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'channel'],$DB_CONNECT);
}

//포스트카테고리
$_tmp = db_query( "select count(*) from ".$table[$module.'category'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table[$module.'category']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
gid			INT				DEFAULT '0'		NOT NULL,
channel		INT				DEFAULT '0'		NOT NULL,
metaurl		VARCHAR(200)	DEFAULT ''		NOT NULL,
metause		TINYINT			DEFAULT '0'		NOT NULL,
isson		TINYINT			DEFAULT '0'		NOT NULL,
parent		INT				DEFAULT '0'		NOT NULL,
depth		TINYINT			DEFAULT '0'		NOT NULL,
id			VARCHAR(50)		DEFAULT ''		NOT NULL,
name		VARCHAR(50)		DEFAULT ''		NOT NULL,
mobile		TINYINT			DEFAULT '0'		NOT NULL,
hidden		TINYINT			DEFAULT '0'		NOT NULL,
num_open	INT				DEFAULT '0'		NOT NULL,
num_reserve	INT				DEFAULT '0'		NOT NULL,
vtype		VARCHAR(10)		DEFAULT ''		NOT NULL,
recnum		TINYINT			DEFAULT '0'		NOT NULL,
vopen		TINYINT			DEFAULT '0'		NOT NULL,
d_last		VARCHAR(14)		DEFAULT ''		NOT NULL,
linkedmenu		VARCHAR(100)		DEFAULT ''		NOT NULL,
KEY gid(gid),
KEY channel(channel),
KEY parent(parent),
KEY depth(depth),
KEY id(id),
KEY mobile(mobile),
KEY hidden(hidden)) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'category'],$DB_CONNECT);
}

//포스트카테고리인덱스
$_tmp = db_query( "select count(*) from ".$table[$module.'catidx'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table[$module.'catidx']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
channel		INT				DEFAULT '0'		NOT NULL,
post		INT				DEFAULT '0'		NOT NULL,
category	INT				DEFAULT '0'		NOT NULL,
depth	   TINYINT			DEFAULT '0'		NOT NULL,
KEY channel(channel),
KEY post(post),
KEY category(category)) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'catidx'],$DB_CONNECT);
}
//포스트데이터
$_tmp = db_query( "select count(*) from ".$table[$module.'data'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table[$module.'data']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
site    INT       DEFAULT '1'		NOT NULL,
channel	INT				DEFAULT '0'		NOT NULL,
gid			INT				DEFAULT '0'		NOT NULL,
isreserve	TINYINT			DEFAULT '0'		NOT NULL,
isphoto		TINYINT			DEFAULT '0'		NOT NULL,
isvod		TINYINT			DEFAULT '0'		NOT NULL,
cutcomment	TINYINT			DEFAULT '0'		NOT NULL,
mbruid		INT				DEFAULT '0'		NOT NULL,
tag			VARCHAR(200)	DEFAULT ''		NOT NULL,
subject		VARCHAR(200)	DEFAULT ''		NOT NULL,
review		TEXT			DEFAULT ''		NOT NULL,
content		MEDIUMTEXT		NOT NULL,
hit			INT				DEFAULT '0'		NOT NULL,
comment		INT				DEFAULT '0'		NOT NULL,
oneline		INT				DEFAULT '0'		NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
d_modify	VARCHAR(14)		DEFAULT ''		NOT NULL,
d_comment	VARCHAR(14)		DEFAULT ''		NOT NULL,
sns			VARCHAR(100)	DEFAULT ''		NOT NULL,
upload		TEXT			NOT NULL,
log			TEXT			NOT NULL,
published		TINYINT			DEFAULT '0'		NOT NULL,
step		TINYINT			DEFAULT '0'		NOT NULL,
use_auth	TINYINT			DEFAULT '0'		NOT NULL,
d_publish		VARCHAR(14)		DEFAULT ''		NOT NULL,
d_published	VARCHAR(14)		DEFAULT ''		NOT NULL,
featured_img  INT				DEFAULT '0'		NOT NULL,
content_format  INT				DEFAULT '0'		NOT NULL,
KEY channel(channel),
KEY gid(gid),
KEY isreserve(isreserve),
KEY isphoto(isphoto),
KEY isvod(isvod),
KEY mbruid(mbruid),
KEY tag(tag),
KEY subject(subject),
KEY d_regis(d_regis),
KEY d_comment(d_comment)) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'data'],$DB_CONNECT);
}

//포스트월별수량
$_tmp = db_query( "select count(*) from ".$table[$module.'month'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table[$module.'month']." (
date		CHAR(6)			DEFAULT ''		NOT NULL,
channel	INT				DEFAULT '0'		NOT NULL,
num			INT				DEFAULT '0'		NOT NULL,
KEY date(date),
KEY channel(channel)) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'month'],$DB_CONNECT);
}

//포스트일별수량
$_tmp = db_query( "select count(*) from ".$table[$module.'day'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table[$module.'day']." (
date		CHAR(8)			DEFAULT ''		NOT NULL,
channel	INT				DEFAULT '0'		NOT NULL,
num			INT				DEFAULT '0'		NOT NULL,
KEY date(date),
KEY channel(channel)) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'day'],$DB_CONNECT);
}

//구독회원
$_tmp = db_query( "select count(*) from ".$table[$module.'members'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table[$module.'members']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
channel	INT				DEFAULT '0'		NOT NULL,
mbruid		INT				DEFAULT '0'		NOT NULL,
level		TINYINT			DEFAULT '0'		NOT NULL,
num_w		INT				DEFAULT '0'		NOT NULL,
num_c		INT				DEFAULT '0'		NOT NULL,
num_o		INT				DEFAULT '0'		NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
KEY channel(channel),
KEY mbruid(mbruid),
KEY level(level),
KEY d_regis(d_regis)) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'members'],$DB_CONNECT);
}

// 좋아요 데이타
$_tmp = db_query( "select count(*) from ".$table[$module.'likes'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table[$module.'likes']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
mbruid		INT				DEFAULT '0'		NOT NULL,
post		INT				DEFAULT '0'		NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
KEY mbruid(mbruid),
KEY post(post),
KEY d_regis(d_regis)) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'likes'],$DB_CONNECT);
}

//SEO테이블
$_tmp = db_query( "select count(*) from ".$table[$module.'seo'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table[$module.'seo']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
channel	INT				DEFAULT '0'		NOT NULL,
parent		INT				DEFAULT '0'		NOT NULL,
subject		VARCHAR(200)	DEFAULT ''		NOT NULL,
title		VARCHAR(200)	DEFAULT ''		NOT NULL,
keywords	VARCHAR(200)	DEFAULT ''		NOT NULL,
description	VARCHAR(200)	DEFAULT ''		NOT NULL,
classification	VARCHAR(200)	DEFAULT ''		NOT NULL,
replyto		VARCHAR(50)		DEFAULT ''		NOT NULL,
language	CHAR(2)			DEFAULT ''		NOT NULL,
build		VARCHAR(14)		DEFAULT ''		NOT NULL,
KEY channel(channel),
KEY parent(parent)) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'seo'],$DB_CONNECT);
}

//키워드셋 리스트
$_tmp = db_query( "select count(*) from ".$table[$module.'keywordset'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table[$module.'keywordset']." (
uid         INT             PRIMARY KEY     NOT NULL AUTO_INCREMENT,
id   VARCHAR(30)     DEFAULT ''      NOT NULL,
name        VARCHAR(200)    DEFAULT ''      NOT NULL,
description        VARCHAR(250)    DEFAULT ''      NOT NULL,
position        VARCHAR(100)    DEFAULT ''      NOT NULL,
p_theme    VARCHAR(100)    DEFAULT ''      NOT NULL,
m_theme   VARCHAR(100)    DEFAULT ''      NOT NULL,
d_regis   VARCHAR(14)    DEFAULT ''      NOT NULL,
d_update VARCHAR(14)    DEFAULT ''      NOT NULL,
KEY id(id),
KEY name(name)) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'keywordset'],$DB_CONNECT);
}

// 키워드 데이타
$_tmp = db_query( "select count(*) from ".$table[$module.'keyword'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table[$module.'keyword']." (
uid         INT             PRIMARY KEY     NOT NULL AUTO_INCREMENT,
keywordset        INT   DEFAULT '0'  NOT NULL,
hidden    TINYINT   DEFAULT '0' NOT NULL,
name        VARCHAR(200)    DEFAULT ''      NOT NULL,
category  INT DEFAULT  '0' NOT NULL,
keyword_type  VARCHAR(30)    DEFAULT ''      NOT NULL,
matching_type  VARCHAR(10)    DEFAULT ''      NOT NULL,
keywordPKs  VARCHAR(200)    DEFAULT ''      NOT NULL,
img_src  VARCHAR(200)    DEFAULT ''      NOT NULL,
d_regis   VARCHAR(14)    DEFAULT ''      NOT NULL,
d_update VARCHAR(14)    DEFAULT ''      NOT NULL,
KEY category(category),
KEY name(name)) ENGINE=".$DB['type']." CHARSET=UTF8");
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table[$module.'keyword'],$DB_CONNECT);
}
?>
