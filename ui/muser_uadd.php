<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/muser/auth.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/muser/connect0.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/muser/libinc/decode.php';

$userid = $_SESSION['SESS_USER_ID'];
$uname = $_SESSION['SESS_FULLNAME'];
$ugroupid = $_SESSION['SESS_UGROUPID'];
$ars = $_SESSION['SESS_RSUSR'];
$arss = $_SESSION['SESS_RSUSRSTAT'];
$ahd = $_SESSION['SESS_HDUSR'];
$ahds = $_SESSION['SESS_HDUSRSTAT'];
$amkt = $_SESSION['SESS_MKTUSR'];
$amkts = $_SESSION['SESS_MKTUSRSTAT'];

function clean($str) {
   $str = @trim($str);
   if (get_magic_quotes_gpc()) {
      $str = stripslashes($str);
   }
   return mysql_real_escape_string($str);
}
?>
<html>
   <?php
   include $_SERVER['DOCUMENT_ROOT'] . '/muser/libinc/kopf.php';
   ?>
   <body bgcolor="#F6E3CE" style="font-family: Arial; font-size: 11px;">
      <div id="body" style="margin:0 auto; width: 1240px">
         <table border="0" width="100%">
            <tr height="50" align="center"><td><H2>WSI [UMS] Centralized User Management System</h2></td></tr>
            <tr height="20"><td>&nbsp;</td></tr>
            <tr height="20" align="center"><td style="font-family: Verdana; font-size: 11px; font-weight: bold;">User ID : <?php echo "$userid ( $uname )"; ?>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Group : <?php echo $ugroupid; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Access Level : <?php echo "$ars | $arss | $ahd | $ahds | $amkt | $amkts"; ?>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add User Form
               </td></tr>
            <tr height="20"><td>&nbsp;</td></tr>
            <tr height="20"><td>&nbsp;</td></tr>
         </table><div id="addins" style="margin:0 auto; width: 800px"><table border="0" width="100%" style="font-family: Tahoma; font-size: 12px">
               <tr style="background-color: #A7A7A7">
                  <th width="100">Labels</th>
                  <th width="300">To be filled in</th>
                  <th width="100">Labels</th>
                  <th width="300">To be filled in</th>
               </tr>
               <FORM id="EditForm" name="EditForm" method="post" action="/muser/operation/muser_adduserdata.php">
                  <tr style="background-color: #CFEFEF">
                     <td colspan="2">&nbsp;</td>
                     <td><b>&nbsp;NIP</b></td>
                     <td><input type="text" name="nip" id="nip" value="" size="10" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0"></td>
                  </tr>
                  <tr style="background-color: #CFEFEF">
                     <td><b>&nbsp;User ID</b></td>
                     <td><input type="text" name="userid" id="userid" value="" size="20" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0"> 16c max</td>
                     <td><b>&nbsp;User Name</b></td>
                     <td><input type="text" name="uname" id="uname" value="" size="20" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0"></td>
                  </tr>
                  <tr style="background-color: #CFEFEF">
                     <td><b>&nbsp;Group</b></td>
                     <td>
                        <?php
                        $res1 = mysql_query("select * from tgroup") or die(mysql_error());
                        ?>
                        <select id="ugroupid" name="ugroupid" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0">
                           <?php
                           $g = mysql_fetch_array($res1);
                           $idg = $g['ugroupid']; $descg = $g['sgroupid'];
                           ?>
                           <option value="<?php echo $idg; ?>" selected><?php echo $descg; ?></option>
                           <?php
                           while ($g = mysql_fetch_array($res1)) {
                              $idg = $g['ugroupid'];
                              $descg = $g['sgroupid'];
                                 ?>
                                 <option value="<?php echo $idg; ?>"><?php echo $descg; ?></option>
                                 <?php
                           }
                           mysql_free_result($res1);
                           ?>
                        </select>
                     </td>
                     <td><b>&nbsp;Center</b></td>
                     <td>
                        <?php
                        $res1 = mysql_query("select * from tbranch") or die(mysql_error());
                        ?>
                        <select id="ubrid" name="ubrid" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0">
                           <?php
                           $g = mysql_fetch_array($res1);
                           $idg = $g['brid'];$dg1 = $g['branchID'];$dg2 = $g['lnbranchid'];
                                 ?>
                                 <option value="<?php echo $idg; ?>" selected><?php echo $dg1 . " - " . $dg2; ?></option>
                                 <?php
                           while ($g = mysql_fetch_array($res1)) {
                              $idg = $g['brid'];
                              $dg1 = $g['branchID'];
                              $dg2 = $g['lnbranchid'];
                                 ?>
                                 <option value="<?php echo $idg; ?>"><?php echo $dg1 . " - " . $dg2; ?></option>
                                 <?php
                           }
                           mysql_free_result($res1);
                           ?>
                        </select>
                     </td>
                  </tr>
                  <tr style="background-color: #CFEFEF">
                     <td><b>&nbsp;HR Status</b></td>
                     <td>
                        <select id="employ_stat" name="employ_stat" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0">
                              <option value="0" selected>inactive</option><option value="1">active</option>
                        </select>
                     </td>
                     <td><b>&nbsp;eMail</b></td>
                     <td><input type="text" name="emailadd" id="emailadd" value="" size="40" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0"></td>
                  </tr>
                  <tr style="background-color: #CFEFEF">
                     <td><b>&nbsp;Expired On</b></td>
                     <td><input type="text" name="expdt" id="expdt" value="" size="20" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0"></td>
                     <td><b>&nbsp;Password</b></td>
                     <td><input type="text" name="upwd" id="upwd" value="" size="20" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0">&nbsp;(min 8, max 20 chars)</td>
                  </tr>
                  <tr style="background-color: #CFEFEF">
                     <td><b>&nbsp;RS Access</b></td>
                     <td>
                        <select id="ars" name="ars" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0">
                              <option value="0" selected>denied - tidak diijinkan</option><option value="1">allowed - diijinkan</option>
                        </select>
                     </td>
                     <td><b>&nbsp;RS Group Acc</b></td>
                     <td>
                        <select id="arss" name="arss" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0">
                              <option value="0" selected>common user - pengguna</option><option value="1">user admin - Admin</option>
                        </select>
                     </td>
                  </tr>
                  <tr style="background-color: #CFEFEF">
                     <td><b>&nbsp;HD Access</b></td>
                     <td>
                        <select id="ahd" name="ahd" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0">
                              <option value="0" selected>denied - tidak diijinkan</option><option value="1">allowed - diijinkan</option>
                        </select>
                     </td>
                     <td><b>&nbsp;HD Group Acc</b></td>
                     <td>
                        <select id="ahds" name="ahds" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0">
                              <option value="0" selected>common user - pengguna</option><option value="1">user admin - Admin</option>
                        </select>
                     </td>
                  </tr>
                  <tr style="background-color: #CFEFEF">
                     <td><b>&nbsp;MKT Access</b></td>
                     <td>
                        <select id="amkt" name="amkt" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0">
                              <option value="0" selected>denied - tidak diijinkan</option><option value="1">allowed - diijinkan</option>
                        </select>
                     </td>
                     <td><b>&nbsp;MKT Group Acc</b></td>
                     <td>
                        <select id="amkts" name="amkts" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0">
                              <option value="0" selected>common user - pengguna</option><option value="1">user admin - Admin</option>
                        </select>
                     </td>
                  </tr>
                  <tr style="background-color: #CFEFEF">
                     <td><b>&nbsp;Yahoo Msg ID</b></td>
                     <td><input type="text" name="ymnm" id="ymnm" value="" size="25" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0"></td>
                     <td><b>&nbsp;AIM ID</b></td>
                     <td><input type="text" name="aimnm" id="aimnm" value="" size="25" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0"></td>
                  </tr>
                  <tr style="background-color: #CFEFEF">
                     <td><b>&nbsp;Facebook ID</b></td><
                     <td><input type="text" name="fbnm" id="fbnm" value="" size="25" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0"></td>
                     <td><b>&nbsp;GoogleTalk ID</b></td><
                     <td><input type="text" name="gtnm" id="gtnm" value="" size="25" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0"></td>
                  </tr>
                  <tr style="background-color: #CFEFEF">
                     <td><b>&nbsp;Skype ID</b></td>
                     <td><input type="text" name="skypenm" id="skypenm" value="" size="25" style="border:1px solid #000000; font-family: Tahoma; font-size: 12px; padding: 0"></td>
                     <td colspan="2">&nbsp;</td></tr>
                  <tr style="background-color: #CFEFEF">
                     <td colspan="4">&nbsp;</td>
                  </tr>
                  <tr style="background-color: #CFEFEF">
                     <td colspan="4" align="center">
                        <input type="submit" value="Create New User" name="BtnCreate" style="border:2px solid #000000; padding-left: 8px; padding-right: 8px; padding-top: 1px; padding-bottom: 1px; font-weight:bold; text-align:center; word-spacing:0; background-color:#ff9900; color:#000000; margin-left:0; margin-top:0">
                        &nbsp;&nbsp;&nbsp;<input type="Button" value="Cancel" name="BtnCancel" style="border:2px solid #000000; padding-left: 30px; padding-right: 30px;  padding-top: 1px; padding-bottom: 1px; background-color:#ff9900; color:#000000; font-weight:bold" onClick="location.href='/muser/muser_main_page.php'">
                     </td>
                  </tr>
               </form>
               <tr style="background-color: #CFEFEF">
                  <td colspan="4" align="center">&nbsp;</td>
               </tr>
               <tr style="background-color: #F6E3CE">
                  <td colspan="4" align="center">&nbsp;</td>
               </tr>
            </table>
         </div>
         <?php
         include $_SERVER['DOCUMENT_ROOT'] . '/muser/libinc/footer1240.php';
         ?>
      </div>
   </body>
</html>