<?
	if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
			die ("You can't access this file directly...");
	}
	
	$module_name = basename(dirname(__FILE__));
	$modfunction="modules/$module_name/module.php";
	include_once($modfunction);
		
	// get userinfo
	$mem_lanai=new User();
	$rslogin=$mem_lanai->getUserLogin($_REQUEST['userLogin']);
	if (($rslogin->recordcount())>0) {
	    $sys_lanai->getErrorBox(_LOGIN_EXIST." <a href=\"#\" onClick=\"javascript:history.back();\">_BACK</a>");
	} else {
	
	if ($_REQUEST['ac']=="lostpass") {
	    if ((empty($_REQUEST['userFname'])) OR (empty($_REQUEST['userLname'])) OR (empty($_REQUEST['userEmail'])) OR (empty($_REQUEST['userLogin'])) OR (empty($_REQUEST['userPassword1'])) OR (empty($_REQUEST['userPassword2'])) ) {
	        $sys_lanai->getErrorBox(_REQUIRE_FIELDS." <a href=\"#\" onClick=\"javascript:history.back();\">_BACK</a>");
	    } else {
			if (($_REQUEST['userPassword1']==$_REQUEST['userPassword2']) AND ($_REQUEST['captext']==$_SESSION['captcha']))   {
				// set 
	            $rs=$mem_lanai->setUserRegister($_REQUEST['userFname'],$_REQUEST['userLname'],$_REQUEST['userEmail'],$_REQUEST['userLogin'],$_REQUEST['userPassword1']);
	        	if (empty($rs)) {
	        	     $sys_lanai->getErrorBox(_CANNOT_REGISTER." <a href=\"#\" onClick=\"javascript:history.back();\">_BACK</a>");
	        	} else {
					// can register
					?>
						<img src="theme/<?=$cfg['theme']; ?>/images/ok.gif" border="0" align="absmiddle"/>
						<?=_REG_COMPLETE; ?><br/>
					<?
					
					if ($cfg['sendmail']=="yes") {
						// Send mail
						require_once("include/phpmailer/class.phpmailer.php");
						$mail = new phpmailer();
						$mail->Host= $cfg['smtp_host'];
						$mail->Port= $cfg['smtp_port'];
						$mail->Mailer="smtp";
						$mail->From=$cfg['email'];
						$mail->FromName= "Member Register";
						$mail->Subject=_MEMBER_REGISTER;
						$mail->Body=_REG_MESSAGE."\n\nName :\t".$_REQUEST['userFname']." ".$_REQUEST['userLname']."\nE-Mail:\t".$_REQUEST['userEmail']."\nUsername :\t".$_REQUEST['userLogin']."\nPassword :\t".$_REQUEST['userPassword1']."\nActivate your account : ".$cfg['url']."/module.php?modname=".$module_name."&mf=meminfo&ac=activate&u=".$_REQUEST['userLogin']."&p=".md5($_REQUEST['userPassword1']);
						$mail->AddAddress($_REQUEST['userEmail'],$_REQUEST['userFname']." ".$_REQUEST['userLname']);
						if(!$mail->Send()){
						?>
							<img src="theme/<?=$cfg['theme']; ?>/images/worning.gif" border="0" align="absmiddle"/>
							<?=_REG_CANNOT_SEND; ?>
						<?
						} else {
						?>
							<img src="theme/<?=$cfg['theme']; ?>/images/ok.gif" border="0" align="absmiddle"/>
							<?=_REG_SEND_COMPLETE; ?>
						<?
						}
					    
					    // Clear all addresses and attachments for next loop
					    $mail->ClearAddresses();
					}
					
				}
			}
		}
	} else {
	
?>
<span class="txtContentTitle"><?=_USER_SIGNUP;?></span><br/><br/>
<?=_USER_SIGNUP_INSTRUCTION;?><br/><br/>
<img src="theme/<?=$cfg['theme']; ?>/images/save.gif" border="0" align="absmiddle"/>
<a href="#" onClick="javascript:document.form.submit();"><?=_SAVE; ?></a>&nbsp;&nbsp; 
<img src="theme/<?=$cfg['theme']; ?>/images/back.gif" border="0" align="absmiddle"/>
<a href="#" onClick="javascript:history.back();" ><?=_BACK; ?></a>
<br><br>
<table>
<form name="form" method="post" action="<?=$_SERVER['PHP_SELF']?>" >
<input type="hidden" name="modname" value="member"/>
<input type="hidden" name="mf" value="memsignup"/>
<input type="hidden" name="ac" value="lostpass"/>
<tr>
	<td><?=_USER_FNAME; ?></td>
	<td><input type="text" name="userFname" size="30"></td>
</tr>
<tr>
	<td><?=_USER_LNAME; ?></td>
	<td><input type="text" name="userLname" size="30"></td>
</tr>
<tr>
	<td><?=_USER_EMAIL; ?></td>
	<td><input type="text" name="userEmail" size="30"></td>
</tr>
<tr>
	<td><?=_USER_LOGIN; ?></td>
	<td><input type="text" name="userLogin" ></td>
</tr>
<tr>
	<td><?=_USER_PASSWORD; ?></td>
	<td><input type="password" name="userPassword1"></td>
</tr>
<tr>
	<td><?=_USER_RE_PASSWORD; ?></td>
	<td><input type="password" name="userPassword2"></td>
</tr>
<tr>
	<td><?=_MEMBER_CAPTEXT; ?></td>
	<td><input name="captext" type="text"  size="12" maxlength="5" /></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><img src="images/captcha.php?hash=<?=md5(time()); ?>"/></td>
</tr>
</form>
</table>
<?
	} // lostpass
	} // check exist
?>
