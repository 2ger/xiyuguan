<?php
if(!defined('InEmpireBak'))
{
	exit();
}

//Database
$phome_db_dbtype='mysql';
$phome_db_ver='5.0';
$phome_db_server='localhost';
$phome_db_port='';
$phome_db_username='root';
$phome_db_password='yh999999';
$phome_db_dbname='';
$baktbpre='';
$phome_db_char='';

//USER
$set_username='admin';
$set_password='fa489651df7fd597040df70b7d7b773b';
$set_loginauth='123456';
$set_loginrnd='NQBzsNH5LrRFcuiBp5kFQcXdBL69LH';
$set_outtime='60';
$set_loginkey='1';

//COOKIE
$phome_cookiedomain='';
$phome_cookiepath='/';
$phome_cookievarpre='benbuk_';

//LANGUAGE
$langr=ReturnUseEbakLang();
$ebaklang=$langr['lang'];
$ebaklangchar=$langr['langchar'];

//BAK
$bakpath='bdata';
$bakzippath='zip';
$filechmod='1';
$phpsafemod='';
$php_outtime='1000';
$limittype='';
$canlistdb='';
$ebak_set_moredbserver='';
$ebak_set_hidedbs='';
$ebak_set_escapetype='1';

//------------ SYSTEM ------------
HeaderIeChar();
?>