<?
	include_once("include/lanai/class.system.php");
	$sys_lanai=new Systems();
	if ($_REQUEST['vertexlogin']=="1") {
		// do login script
		$uxid=$sys_lanai->getUserAuthentication($_REQUEST['txtLogin'],$_REQUEST['txtPassword']);
		if ($uxid>0) {
			$_SESSION['uid']=$uxid;
			$sys_lanai->goBack(1);
		} else {
			$sys_lanai->getErrorAlertBox("Cannot login, please verify your login and password!");
			$sys_lanai->goBack(1);
		}
	} else {
		if ($_SESSION['uid'] <= 0) {
			// show login form
?>
<table border="0" cellspacing="2" cellpadding="3" align="center">
	<form id="form1" name="form1" method="post" action="">
  <tr>
    <td>
		Login to the system. Not member yet ? <a href="module.php?modname=member&amp;mf=memsignup">Signup</a> today.&nbsp;&nbsp;Login : <input name=" txtLogin" type="text" class="txtLicense" size="15" />
    &nbsp;&nbsp;Password : <input name="txtPassword" type="password" class="txtLicense" size="15" />&nbsp;
    <input type="hidden" name="vertexlogin" value="1">   
    <input name="imageField" type="image" src="theme/vertex/images/loginbutt.png" align="absbottom" border="0" style="border:0px;"/>
	</td>
  </tr>
  </form>
</table>
<?
		} else {
			// show user info
			include_once("modules/member/module.php");
			$mem_lanai=new User();
			$mem=$mem_lanai->getUser($_SESSION['uid']); 
?>
<table align="left">
<tr><td>
<?			
?>Welcome, <?=$mem->fields['userFname']." ".$mem->fields['userLname']; ?>. <?
			if ($mem_lanai->getUserPrivilege($_SESSION['uid'])=="a") {
?>&nbsp;&nbsp;Now you can <a href="<?="setting.php?modname=setting"; ?>">setting</a> your site or <a href="<?="module.php?modname=member&mf=memlogout"; ?>">signout</a>.<?
			}
?>
<td></tr>
</table>
<?			
		}
	}
?>