<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/dmkcuserm/lib/inc/branchlist1.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/dmkcuserm/lib/inc/branchlist2.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/dmkcuserm/lib/inc/ugroup.php';


$myuserid = "sysadmin";
$myuname = "User Access System Administrator";
$myugroupid = 0;

function clean($str) {
   $str = @trim($str);
   if (get_magic_quotes_gpc()) {
      $str = stripslashes($str);
   }
   return mysqli_real_escape_string($str);
}
?>
<html>
    <head>
   <?php
   include $_SERVER['DOCUMENT_ROOT'] . '/dmkcuserm/lib/inc/kopf.php';
   ?>
    <link rel="stylesheet" type="text/css" href="../lib/css/calendar-win2k-cold-1.css"/>
    <script type="text/javascript" src="../lib/js/calendar.js"></script>
    <script type="text/javascript" src="../lib/js/calendar-en.js"></script>
    <script type="text/javascript" src="../lib/js/calendar-setup.js"></script>
    <link rel="stylesheet" type="text/css" href="../lib/css/button_small_exe.css"/>
   </head> 
   <body bgcolor="#F6E3CE" style="font-family: Arial; font-size: 11px;">
      <div id="body" style="margin:0 auto; width: 1240px">
         <table border="0" width="100%">
            <tr height="50" align="center"><td><H2>CUSERM 1.0 Injector</h2></td></tr>
            <tr height="20"><td>&nbsp;</td></tr>
            <tr height="20" align="center"><td style="font-family: Verdana; font-size: 11px; font-weight: bold;">User ID : <?php echo "$myuserid ( $myuname )"; ?>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Group : <?php echo $myugroupid; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Access Level : Mighty God
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add User Form Page
               </td></tr>
            <tr height="20"><td>&nbsp;</td></tr>
            <tr height="20"><td>&nbsp;</td></tr>
         </table>
          <div id="addins" style="margin:0 auto; width: 800px">
              <table border="0" width="100%" style="font-family: Tahoma; font-size: 12px">
               <tr style="background-color: #A7A7A7">
                  <th width="100">Labels</th>
                  <th width="300">To be filled in</th>
                  <th width="100">Labels</th>
                  <th width="300">To be filled in</th>
               </tr>
               <FORM id="EditForm" name="EditForm" method="post" action="/dmkcuserm/operation/muser_adduserdata_thru_injector.php">
                <tr style="background-color: #CFEFEF">
                   <td><b>&nbsp;NIP</b></td>
                   <td><input type="text" name="nip" id="nip" value="" size="10" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0"></td>
                   <td><b>&nbsp;Center</b></td>
<td>
   <?php
   $jumlah_lokasi=count($brids);
   ?>
   <select id="ubrid" name="ubrid" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0">
    <?php
        for ($i=0;$i<$jumlah_lokasi;$i++) {
        ?>
        <option value="<?php echo $i; ?>"><?php echo $brids[$i]. " - " . $bridslong[$i]; ?></option>
    <?php
        }
    ?>
   </select>
</td>
                </tr>
                <tr style="background-color: #CFEFEF">
                   <td><b>&nbsp;User ID</b></td>
                   <td><input type="text" name="userid" id="userid" value="" size="20" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0"> 20c max</td>
                   <td><b>&nbsp;User Name</b></td>
                   <td><input type="text" name="uname" id="uname" value="" size="20" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0"> 50c max</td>
                </tr>
                <tr style="background-color: #CFEFEF">
                   <td><b>&nbsp;Office eMail</b></td>
                   <td><input type="text" name="emailadd" id="emailadd" value="" size="30" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0"></td>
                   <td><b>&nbsp;Private eMail</b></td>
                   <td><input type="text" name="emailadd2" id="emailadd2" value="" size="30" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0" disabled></td>
                </tr>
                <tr style="background-color: #CFEFEF">
                   <td><b>&nbsp;Group(choose)</b></td>
                   <td>
<?php
$jumlah_grup=count($basegroups) -1;
?>
<select id="ugroupid" name="ugroupid" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0">
<?php
for($j=1;$j<=$jumlah_grup;$j++){
?>   
    <option value="<?php echo $j; ?>"><?php echo $basegroups[$j]."-".$bgdesc[$j]; ?></option>
<?php    
}
?>
</select>
                    </td>
                    <td><b>AccRight as</b></td>
                    <td>
<select id="uacc" name="uacc" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0">
    <option value="1" selected="selected">User or Member</option>
    <option value="0">Admin</option>
</select>
                    </td>
                 </tr>
                 <tr style="background-color: #CFEFEF">
                    <td><b>&nbsp;Expired On</b></td>
                    <td><input type="text" name="expdt" id="expdt" size="10" value="" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0">
                   <img src="../images/img.gif" id="trigger_adate" style="cursor: pointer; border: 1px solid red;" title="Date selector" onMouseOver="this.style.background='red';" onMouseOut="this.style.background=''" />
                   <script type="text/javascript">
                       Calendar.setup(
                       {
                         inputField  : "expdt",         // ID of the input field
                         ifFormat    : "%Y-%m-%d",    // the date format
                         button      : "trigger_adate"       // ID of the button
                       }
                   );
                   </script>
                   <td colspan="2" align="center">&nbsp;</td>
                 </tr>
                 <tr style="background-color: #CFEFEF">
                    <td><b>&nbsp;Yahoo Msg ID</b></td>
                    <td><input type="text" name="ymnm" id="ymnm" value="" size="25" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0" disabled></td>
                    <td><b>&nbsp;AIM ID</b></td>
                    <td><input type="text" name="aimnm" id="aimnm" value="" size="25" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0"  disabled></td>
                 </tr>
                 <tr style="background-color: #CFEFEF">
                    <td><b>&nbsp;Facebook ID</b></td><
                    <td><input type="text" name="fbnm" id="fbnm" value="" size="25" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0"  disabled></td>
                    <td><b>&nbsp;GoogleTalk ID</b></td><
                    <td><input type="text" name="gtnm" id="gtnm" value="" size="25" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0"  disabled></td>
                 </tr>
                 <tr style="background-color: #CFEFEF">
                    <td><b>&nbsp;Skype ID</b></td>
                    <td><input type="text" name="skypenm" id="skypenm" value="" size="25" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0"  disabled></td>
                    <td colspan="2">&nbsp;</td></tr>
                <tr style="background-color: #CFEFEF">
                   <td colspan="4">&nbsp;</td>
                </tr>
                <tr style="background-color: #CFEFEF">
                   <td colspan="4" align="center">
                      <input type="submit" value="Create New User" name="BtnCreate" class="css_btn_class_small_exe"/>
                   </td>
                </tr>
               </form>
                <tr style="background-color: #CFEFEF">
                   <td colspan="4" align="center">&nbsp;</td>
                </tr>
                <tr style="background-color: #CFEFEF">
                   <td colspan="4" align="center">User ID should consist of 4 chars Firstname + 2 chars Lastname + NIP/NIK: ie. Ali Jumadi NIK876 ==> AliJu876</td>
                </tr>
                <tr style="background-color: #CFEFEF">
                   <td colspan="4" align="center">User will be CREATED and the Information will be automatically sent to above inserted email info</td>
                </tr>
               <tr style="background-color: #F6E3CE">
			<td colspan="4" align="center">
<?php
include $_SERVER['DOCUMENT_ROOT'].'/dmkcuserm/lib/inc/footer1000.php';
?>                
            </td>
               </tr>
            </table>
         </div>
      </div>
   </body>
</html>