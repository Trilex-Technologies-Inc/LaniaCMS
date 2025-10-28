<?
	if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
			die ("You can't access this file directly...");
	}
	
	$module_name = basename(dirname(__FILE__));
	$modfunction="modules/$module_name/module.php";
	include_once($modfunction);
	
	// get userinfo
	$mem_lanai=new User();
	
	//achaha
	
	if ($_REQUEST['ac']=="lostpass") {	    
		if (empty($_REQUEST['userLogin'])){
			$sys_lanai->getErrorBox(_REQUIRE_FIELDS." <a href=\"#\" >_BACK</a>");
		} else {
			$rs=$mem_lanai->getUserLogin($_REQUEST['userLogin']);
			if (($rs->recordcount()>0)  AND ($_REQUEST['captext']==$_SESSION['captcha'])){
			    // gen new password
				require_once("include/phpmailer/class.phpmailer.php");
				
				$mail = new phpmailer();			
				
				$passwd=substr(md5(date("hms")),0,6);
				
				$mail->Host     = $cfg['smtp_host'];
				$mail->Port     = $cfg['smtp_port'];
				$mail->Mailer   = "smtp";
				
				$mail->From=$rs->fields['userEmail'];
				$mail->FromName= $rs->fields['userFname']." ".$rs->fields['userLname'];

				$mail->Subject=_CHANGE_PASSWORD;
				$mail->Body=_CHANGE_PASSWORD_MESSAGE." ".$passwd;	
				$mail->AddAddress($rs->fields['userEmail'],$rs->fields['userFname']." ".$rs->fields['userLname']);
			
				
			
				if(!$mail->Send()){

				?>
					<img src="theme/<?=$cfg['theme']; ?>/images/worning.gif" border="0" align="absmiddle"/>
					<?=_LOSTPASS_CANNOT_SEND; ?>
					
				<?
				} else {
					$mem_lanai->setUpdateUserPassword($rs->fields['userId'],md5($passwd));
				?>
					<img src="theme/<?=$cfg['theme']; ?>/images/ok.gif" border="0" align="absmiddle"/>
					<?=_LOSTPASS_SEND_COMPLETE; ?>
				<?
				}
			    
			    // Clear all addresses and attachments for next loop
			    $mail->ClearAddresses();
			} else {
			 	$sys_lanai->getErrorBox(_LOGIN_NOTEXIST." <a href=\"#\" onClick=\"javascript:history.back();\">_BACK</a>");
			}
			
		}
	} else {	
		?>
		<span class="txtContentTitle"><?=_USER_LOSTPASS;?></span><br/><br/>
		<?=_USER_LOSTPASS_INSTRUCTION;?><br/><br/>
		
		<img src="theme/<?=$cfg['theme']; ?>/images/save.gif" border="0" align="absmiddle"/>
		<a href="#" onClick="javascript:document.form.submit();"><?=_SAVE; ?></a>&nbsp;&nbsp; 
		
		<img src="theme/<?=$cfg['theme']; ?>/images/back.gif" border="0" align="absmiddle"/>
		<a href="module.php?modname=member&mf=memloginform" ><?=_BACK; ?></a>
		<br><br>
		<table>
		<form name="form" method="post" action="<?=$_SERVER['PHP_SELF']?>" >
		<input type="hidden" name="modname" value="member"/>
		<input type="hidden" name="mf" value="memlostpass"/>
		<input type="hidden" name="ac" value="lostpass"/>
		<tr>
			<td><?=_USER_LOGIN; ?></td>
			<td><input type="text" name="userLogin" size="30"></td>
		</tr>
		<tr>
			<td valign="top"><?=_MEMBER_CAPTEXT; ?></td>
			<td>
					<input name="captext" type="text"  size="12" maxlength="5" />
			</td>
		<tr>
			<td>&nbsp;</td>
			<td>
					<img src="images/captcha.php?hash=<?=md5(time()); ?>"/>
			</td>
		</tr>
		</form>
		</table>
		<?
	}
?>