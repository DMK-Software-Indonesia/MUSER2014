<?php
$emailsubject ="You New Access Information on CUSERM";

$ebody="
[Access Information on DMK CUSERM System]
Your Name  =".$uname."
Company NIP/NIK=".$nip."
Work Location=".$brid."
Access Group and User Level=".$ugroupid." - ".$uacc."

User Login=".$userid."
Current created Password by System=".$newpwd."

Password Valid until=".$valid90."
Access Expiration=".$expdt."
    
Note:
Please change your Password immediately after receiving this email !



regards,
Your System Administrator
";

$headers = "From: sysadmin@companythisandthat.co.id";
$headers .="\r\nReply-To : sysadmin@companythisandthat.co.id";
//$headers .="\r\nCc: helpdesk@wallstreetenglish.co.id";
$headers .="\r\nX-Mailer: php";
if (mail($eadd,$emailsubject,$ebody,$headers)) {
    echo "Access Information sent to User !<BR>";
}

?>
