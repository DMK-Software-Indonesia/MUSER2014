<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/dmkcuserm/lib/inc/connect0.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/dmkcuserm/lib/inc/encode.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/dmkcuserm/lib/inc/password_generator.php';

$nip = $link->real_escape_string($_POST['nip']);
$userid = $link->real_escape_string($_POST['userid']);
$uname = $link->real_escape_string($_POST['uname']);
$ugroupid = $link->real_escape_string($_POST['ugroupid']);
$brid = $link->real_escape_string($_POST['ubrid']);
$eadd = $link->real_escape_string($_POST['emailadd']);
//$eadd2 = $link->real_escape_string($_POST['emailadd2']);
//$aimnm = $link->real_escape_string($_POST['aimnm']);
//$fbnm = $link->real_escape_string($_POST['fbnm']);
//$gtnm = $link->real_escape_string($_POST['gtnm']);
//$ymnm = $link->real_escape_string($_POST['ymnm']);
$expdt = $link->real_escape_string($_POST['expdt']);
//$skypenm = $link->real_escape_string($_POST['skypenm']);
$uacc=$link->real_escape_string($_POST['uacc']);

//check existing userid
$sqlstr="select * from tuser where userid='$userid'";
$result=  $link->query($sqlstr);
if($result==false){
    trigger_error("SQL Statement wrong : ".$sqlstr."\r\nError: ".$link->error, E_USER_ERROR);
} else { $numrows_returned=$result->num_rows; }
if(0!=$numrows_returned)
{
    die("User Creation stopped !!<BR>Sorry, Userid given is not available !<BR>Repeat the creation !<BR>You will be directed back to the Injector !<BR>");
    $link->close();
?>
<meta http-equiv='refresh' content='5;url=/dmkcuserm/ui/muser_uadd_injectorpage.php'>
<?php    
}
$result->free();
//generate pwd for new user
$pwd_avail=0;
while($pwd_avail!=1){
    $newpwd=GeneratePwd();
    $sqlstr="select * from tpwdlist where userid='$userid' and txtpwd='$newpwd'";
    $result=  $link->query($sqlstr);
    if($result==false){
        trigger_error("SQL Statement wrong : ".$sqlstr."\r\nError: ".$link->error, E_USER_ERROR);
    } else { $numrows_returned=$result->num_rows; }
    if($numrows_returned==0){
        $pwd_avail=1;
    }
}
$encrypted_pwd=$link->real_escape_string(substr(encode5t($newpwd),0,50));
$result->free();
//save first to table tuser
$valid90=date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") + 90, date("Y")));

$sqlstr="INSERT INTO tuser (nip,userid,upwd,txtpwd,uname,ugroupid,";
$sqlstr .="uacc,ubrid,expdt,pwdvaliddt,emailadd,";
$sqlstr .="violst,employ_stat,createon,uuser)";
$sqlstr .=" VALUES ($nip,'$userid','$encrypted_pwd','$newpwd','$uname',$ugroupid,";
$sqlstr .="$uacc,$brid,'$expdt','$valid90','$eadd',";
$sqlstr .="0,1,'".date('Y-m-d')."','sysadmin')";

if($link->query($sqlstr) == false){
    trigger_error("SQL Statement wrong : ".$sqlstr."\r\nError: ".$link->error, E_USER_ERROR);
} else {
    $last_inserted_id=$link->insert_id;
    $affected_rows=$link->affected_rows;
}
$sqlstr="insert into tpwdlist (userid,upwd,txtpwd,cuser) values ('$userid','$encrypted_pwd','$newpwd','sysadmin') ";
if($link->query($sqlstr) == false){
    trigger_error("SQL Statement wrong : ".$sqlstr."\r\nError: ".$link->error, E_USER_ERROR);
} else {
    $last_inserted_id=$link->insert_id;
    $affected_rows=$link->affected_rows;
}
echo "User Created !!<BR>";
$link->close();

require_once $_SERVER['DOCUMENT_ROOT'] . '/dmkcuserm/lib/inc/sendmail.php';
?>
<meta http-equiv='refresh' content='10;url=/dmkcuserm/ui/muser_uadd_injectorpage.php'>