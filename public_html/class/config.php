<?php
if(!defined('InEmpireBak'))
{
	exit();
}

//Database
$phome_db_dbtype='';
$phome_db_ver='';
$phome_db_server='localhost';
$phome_db_port='';
$phome_db_username='root';
$phome_db_password='';
$phome_db_dbname='';
$baktbpre='';
$phome_db_char='';

//USER
$set_username='admin';
$set_password='14e1b600b1fd579f47433b88e8d85291';
$set_loginauth='';
$set_loginrnd='EmpireCMS-EmpireBak-EmpireDown';
$set_outtime='60';
$set_loginkey='1';

//COOKIE
$phome_cookiedomain='';
$phome_cookiepath='/';
$phome_cookievarpre='ebak_';

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