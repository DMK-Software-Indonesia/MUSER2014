<html>
    <head>
    <?php
include $_SERVER['DOCUMENT_ROOT'].'/dmkcuserm/lib/inc/kopf.php';
    ?>
<link rel="stylesheet" type="text/css" href="./lib/css/button_login.css"/>
<link rel="stylesheet" type="text/css" href="./lib/css/button_clear.css"/>
<link rel="stylesheet" type="text/css" href="./lib/css/autostyle.css"/>
<script language="JavaScript" src="./lib/js/gen_validatorv4.js" type="text/javascript"></script>
    </head>
    <body>
<div style="margin: 0px auto; width: 800px; height: 600px;">
	<table style="width: 100%" id="basetable" name="basetable">
        <tr align="center" style="height:80px"><td>&nbsp;</td>
		</tr>
		<tr align="center">
			<td>
			<h2 class="auto-style1">Centralized User Management System</h2>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
			<div style="margin: 0 auto; width: 400px;">
				<fieldset id="Formbox" name="Formbox" style="margin:0 auto;">
				<legend>&nbsp;<span class="auto-style3"><strong>CUSERM&nbsp;&nbsp;Login</strong></span>&nbsp;&nbsp;
				</legend>
                <form id="LoginForm" name="LoginForm" method="POST" action="./operation/xxxxxxxxoooo0000.php">
				<table style="width: 100%">
					<tr>
						<td width="150px" style="height: 23px; width: 400px;" colspan="2"></td>
					</tr>
					<tr>
						<td class="auto-style2" style="padding-left: 20px">
						Username</td>
						<td>
                            <input id="username" name="username" type="text" style="border-radius:5px; padding:1px; width: 160px;" tabindex="1"/></td>
					</tr>
					<tr>
						<td class="auto-style2" style="padding-left: 20px; height: 23px;">
						Password</td>
						<td style="height: 23px">
						<input id="userpwd" name="userpwd" type="password" style="padding:1px; border-radius:5px; width: 120px;" tabindex="2"/></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
                        <input type="reset" value="C l e a r" name="BtnClear" class="css_btn_class_clear" tabindex="4">&nbsp;&nbsp;
                        <input type="submit" value="Sign In" name="BtnGo" class="css_btn_class_front" tabindex="3">
                        </td>
					</tr>
				</table>
</form>
<script language="JavaScript" type="text/javascript">
var frmx=new Validator("LoginForm");
frmx.addValidation("username","req","Error :\r\nPlease type your login user name !");
frmx.addValidation("username","alnum","Error :\r\nInvalid Characters!!\r\nPlease type your login user name !");
frmx.addValidation("username","minlen=8","Error :\r\nPlease type your valid login user name !\r\nMinimum 8 chars !");
frmx.addValidation("username","maxlen=20","Error :\r\nPlease type your valid login user name !\r\nMaximum 20 chars !");
frmx.addValidation("userpwd","req","Error :\r\nPlease type your login password !");
frmx.addValidation("userpwd","alnum","Error :\r\nInvalid Characters!!\r\nPlease type your login password !");
frmx.addValidation("userpwd","minlen=8","Error :\r\nPlease type your valid login password !\r\nMinimum 8 chars !");
frmx.addValidation("userpwd","maxlen=12","Error :\r\nPlease type your valid login password !\r\nMaximum 12 chars !");
</script>
				</fieldset>
			</div></td>
		</tr>
		<tr>
			<td>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/dmkcuserm/lib/inc/footer1000.php';
?>                
            </td>
		</tr>
	</table>
</div>
    </body>
</html>