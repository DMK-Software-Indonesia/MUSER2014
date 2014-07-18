<?php
//Include database connection details
require_once $_SERVER['DOCUMENT_ROOT'] . '/wsemuser/lib/inc/connect0.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/wsemuser/lib/inc/encode.php';

$logginguser=$link->real_escape_string($_POST['username']);
$belongingpwd=$link->real_escape_string($_POST['userpwd']);
echo "Login Information received...<BR>";
$sqlstr="select * from tuser where userid='$logginguser'";
$result=  $link->query($sqlstr);
echo "Checking parameter set to request Information Comparation...<BR>";
if($result==false){
    echo "Parameter set wrong...<BR>";
    trigger_error("SQL Statement wrong : ".$sqlstr."\r\nError: ".$link->error, E_USER_ERROR);
} else { $numrows_returned=$result->num_rows; }
echo "Parameter Set accepted...<BR>";
if($numrows_returned==0)
{
    echo "User ID not accepted...<BR>Wrong User Login !!<BR>You will be directed back to the Login Page !<BR>";
    
    $link->close();
?>
<meta http-equiv='refresh' content='5;url=/wsemuser/index.php'>
<?php    
}
echo "User ID accepted...<BR>";
echo "Checking Group Access Code...<BR>";
$result->data_seek(0);
$row=$result->fetch_assoc();
$grup=$row['ugroupid'];
echo "Group Access Code found...$grup...<BR>";
if($grup!=4 && $grup!=0){
    echo "Group Access Code insufficient to acquire System Access...<BR>";
    $msgs="System blocks the access !<BR>";
    $msgs .="You are not AUTHORIZED to use WSE MUSER !<BR><BR>";
    $msgs .="You will be directed back to the Login Page !<BR>";
    echo $msgs;
    $numviolnow=$row['violst']+1;
    $sqlstr="update tuser set violst=$numviolnow where userid='$logginguser'";
    $result1=  $link->query($sqlstr);
    $link->close();
?>
<meta http-equiv='refresh' content='5;url=/wsemuser/index.php'>
<?php    
}
echo "Group Access Code permitted...<BR>";
echo "Checking Employment Status Information...<BR>";
$empst=$row['employ_stat'];
if($empst==0){
    echo "You are not WSE INA Employee (anymore)...<BR>";
    $msgs="System blocks the access !<BR>";
    $msgs .="Access can not be granted ! Sorry !!<BR><BR>";
    $msgs .="You will be directed back to the Login Page !<BR>";
    echo $msgs;
    $link->close();
?>
<meta http-equiv='refresh' content='5;url=/wsemuser/index.php'>
<?php    
}
echo "Employment Status verified...<BR>";
echo "Checking Lock Identity on Login Information...<BR>";
$tpass=$row['upwd'];
$encpwd=$link->real_escape_string(substr(encode5t($belongingpwd),0,50));
if($tpass!=$encpwd){
    echo "System can not be unlocked...<BR>";
    $msgs="System blocks the access !<BR>";
    $msgs .="Wrong Password will bring you NoWhere !<BR><BR>";
    $msgs .="You will be directed back to the Login Page !<BR>";
    echo $msgs;
    $numviolnow=$row['violst']+1;
    $sqlstr="update tuser set violst=$numviolnow where userid='$logginguser'";
    $result1=  $link->query($sqlstr);
    $link->close();
?>
<meta http-equiv='refresh' content='5;url=/wsemuser/index.php'>
<?php    
}
echo "Checking Access Expiration verified...<BR>";
if($row['expdt']<=date("Y-m-d")){
    echo "System can not be unlocked...<BR>";
    $msgs="System blocks the access !<BR>";
    $msgs .="Your Account is not Active (already expired) !<BR>";
    $msgs .="Please contact Your System Administrator (IT) for activation or extending your login account !<BR><BR>";
    $msgs .="You will be directed back to the Login Page !<BR>";
    echo $msgs;
    $link->close();
?>
<meta http-equiv='refresh' content='5;url=/wsemuser/index.php'>
<?php    
}
echo "Account is active...<BR>";
echo "Checking Lock Identity Expiration on Login Information...<BR>";
if($row['expdt']<=date("Y-m-d")){
    echo "System can not be unlocked...<BR>";
    $msgs="System blocks the access !<BR>";
    $msgs .="Your Account is not Active (already expired) !<BR>";
    $msgs .="Please contact Your System Administrator (IT) for activation or extending your login account !<BR><BR>";
    $msgs .="You will be directed back to the Login Page !<BR>";
    echo $msgs;
    $link->close();
?>
<meta http-equiv='refresh' content='5;url=/wsemuser/index.php'>
<?php    
}
echo "Checking First Time Code on Login Information...<BR>";
if($row['ft']!=0){
    echo "This is your First Time login...<BR>";
    $msgs="You will be send to Changing Password Page !<BR>";
    $msgs .="System preparing the page....please wait....<BR>";
    echo $msgs;
    ob_start();
    session_start();
    echo "Starting SESSION...<BR>";
    
    include $_SERVER['DOCUMENT_ROOT'].'/wsemuser/lib/inc/branchlist1.php';
    include $_SERVER['DOCUMENT_ROOT'].'/wsemuser/lib/inc/branchlist2.php';
    
    session_regenerate_id();
    $_SESSION['SESS_USER_ID'] = $row['userid'];
    $_SESSION['SESS_FULLNAME'] = $row['uname'];
    $_SESSION['SESS_UGROUPID'] = $row['ugroupid'];
    $_SESSION['SESS_BRID1'] = $row['ubrid'];
    $var_a=$row['ubrid'];
    $_SESSION['SESS_BRID2'] = $brids[$var_a];
    $_SESSION['SESS_BRID3'] = $bridslong[$var_a];
    $_SESSION['SESS_UPWD'] = $row['upwd'];
    $_SESSION['SESS_EMPLOYSTAT'] = $row['employ_stat'];
    $_SESSION['SESS_ACCESSTYPE'] = $row['uacc'];
    $_SESSION['SESS_ACCOUNTEXPIREDON'] = $row['expdt'];
    $_SESSION['SESS_PWDEXPIREDON'] = $row['pwdvaliddt'];
    $_SESSION['SESS_NIKNIP'] = $row['nip'];
    $_SESSION['SESS_RECORDNUMBER'] = $row['rnr'];
    session_write_close();
    
?>
<meta http-equiv='refresh' content='5;url=/wsemuser/ui/ftch.php'>
<?php    
}
echo "Continue...<BR>";
echo "Checking Lock Identity Validity on Login Information...<BR>";
if($row['pwdvaliddt']<=date("Y-m-d")){
    echo "System can not be unlocked...<BR>";
    $msgs="You Password is expired !<BR>";
    $msgs .="Please Contact Your System Administrator to help you with the Password !<BR>";
    $msgs .="Page accessing prohibited !<BR><BR>";
    $msgs .="You will be directed back to the Login Page !<BR>";
    echo $msgs;
    $link->close();
?>
<meta http-equiv='refresh' content='5;url=/wsemuser/index.php'>
<?php    
}
$diff=floor(abs($row['pwdvaliddt'] - date("Y-m-d"))/(24*3600));

if($diff<7){
    echo "Your Password will be expired in <B>$diff day(s)<BR>";
    echo "You will be directed back to the Change Password Page !<BR>";

    ob_start();
    session_start();
    echo "Starting SESSION...<BR>";

    include $_SERVER['DOCUMENT_ROOT'].'/wsemuser/lib/inc/branchlist1.php';
    include $_SERVER['DOCUMENT_ROOT'].'/wsemuser/lib/inc/branchlist2.php';

    session_regenerate_id();
    $_SESSION['SESS_USER_ID'] = $row['userid'];
    $_SESSION['SESS_FULLNAME'] = $row['uname'];
    $_SESSION['SESS_UGROUPID'] = $row['ugroupid'];
    $_SESSION['SESS_BRID1'] = $row['ubrid'];
    $var_a=$row['ubrid'];
    $_SESSION['SESS_BRID2'] = $brids[$var_a];
    $_SESSION['SESS_BRID3'] = $bridslong[$var_a];
    $_SESSION['SESS_UPWD'] = $row['upwd'];
    $_SESSION['SESS_EMPLOYSTAT'] = $row['employ_stat'];
    $_SESSION['SESS_ACCESSTYPE'] = $row['uacc'];
    $_SESSION['SESS_ACCOUNTEXPIREDON'] = $row['expdt'];
    $_SESSION['SESS_PWDEXPIREDON'] = $row['pwdvaliddt'];
    $_SESSION['SESS_NIKNIP'] = $row['nip'];
    $_SESSION['SESS_RECORDNUMBER'] = $row['rnr'];
    session_write_close();

?>
<meta http-equiv='refresh' content='5;url=/wsemuser/ui/ftch.php'>
<?php    

}
if($diff<14 && $diff>=7){
    echo "Your Password will be expired in <B>$diff day(s)<BR>";
    echo "Please see that You change the Password within next couple day(s)<BR>";
}
echo "Your Password will be expired in <B>$diff day(s)<BR>";
echo "Access verified...<BR>";
//Start session
ob_start();
session_start();
echo "Starting SESSION...<BR>";

include $_SERVER['DOCUMENT_ROOT'].'/wsemuser/lib/inc/branchlist1.php';
include $_SERVER['DOCUMENT_ROOT'].'/wsemuser/lib/inc/branchlist2.php';

session_regenerate_id();
$_SESSION['SESS_USER_ID'] = $row['userid'];
$_SESSION['SESS_FULLNAME'] = $row['uname'];
$_SESSION['SESS_UGROUPID'] = $row['ugroupid'];
$_SESSION['SESS_BRID1'] = $row['ubrid'];
$var_a=$row['ubrid'];
$_SESSION['SESS_BRID2'] = $brids[$var_a];
$_SESSION['SESS_BRID3'] = $bridslong[$var_a];
$_SESSION['SESS_UPWD'] = $row['upwd'];
$_SESSION['SESS_EMPLOYSTAT'] = $row['employ_stat'];
$_SESSION['SESS_ACCESSTYPE'] = $row['uacc'];
$_SESSION['SESS_ACCOUNTEXPIREDON'] = $row['expdt'];
$_SESSION['SESS_PWDEXPIREDON'] = $row['pwdvaliddt'];
$_SESSION['SESS_NIKNIP'] = $row['nip'];
$_SESSION['SESS_RECORDNUMBER'] = $row['rnr'];
session_write_close();

?>
<meta http-equiv='refresh' content='5;url=/wsemuser/ui/muser_board.php'>
