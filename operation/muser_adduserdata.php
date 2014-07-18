<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/muser/auth.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/muser/connect0.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/muser/libinc/tbranchmuser.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/muser/libinc/tgroupmuser.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/muser/libinc/encode.php';

function clean($str)
{
   $str = @trim($str);
   if (get_magic_quotes_gpc()) {
      $str = stripslashes($str);
   }
   return mysql_real_escape_string($str);
}

$nip = clean($_POST['nip']);
$userid = clean($_POST['userid']);
$uname = clean($_POST['uname']);
$ugroupid = clean($_POST['ugroupid']);
$brid = clean($_POST['ubrid']);
$eadd = clean($_POST['emailadd']);
$employ_stat = clean($_POST['employ_stat']);
$ars = clean($_POST['ars']);
$arss = clean($_POST['arss']);
$ahd = clean($_POST['ahd']);
$ahds = clean($_POST['ahds']);
$amkt = clean($_POST['amkt']);
$amkts = clean($_POST['amkts']);
$aimnm = clean($_POST['aimnm']);
$fbnm = clean($_POST['fbnm']);
$gtnm = clean($_POST['gtnm']);
$ymnm = clean($_POST['ymnm']);
$expdt = clean($_POST['expdt']);
$skypenm = clean($_POST['skypenm']);
$strupwd = clean($_POST['upwd']);
echo "start : <BR>Insert to table muser.tuser<BR><BR>";
include $_SERVER['DOCUMENT_ROOT'] . '/muser/operation/muser_insertusermuser.php';
include $_SERVER['DOCUMENT_ROOT'] . '/muser/operation/muser_insertuserrs.php';
include $_SERVER['DOCUMENT_ROOT'] . '/muser/operation/muser_insertuserhd.php';
if($ugroupid==7)
   {
include $_SERVER['DOCUMENT_ROOT'] . '/muser/operation/muser_insertuserrs2.php';   
}

include $_SERVER['DOCUMENT_ROOT'] . '/muser/operation/muser_insertusermkt.php';
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if(!$link) {
      die('Failed to connect to server: ' . mysql_error());
}
$db=mysql_select_db("muser");
echo "<meta http-equiv='refresh' content='1;url=/muser/muser_main_page.php'>";
?>
