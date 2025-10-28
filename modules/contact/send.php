<?
	if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
			die ("You can't access this file directly...");
	}
	
	$module_name = basename(dirname(__FILE__));
	$modfunction="modules/$module_name/module.php";
	include_once($modfunction);
	
	$cnt=new Contact();
	$rs=$cnt->getContactById($_REQUEST['cid']);
	
	require_once("include/phpmailer/class.phpmailer.php");

	$mail = new phpmailer();		
	$mail->Host= $cfg['smtp_host'];
	$mail->Port= $cfg['smtp_port'];
	$mail->Mailer="smtp";
	$mail->Subject=$_REQUEST['title'];
	
	$mail->From=$_REQUEST['email'];
	$mail->FromName=$_REQUEST['name'] ;
	
	$mail->Body=$_REQUEST['message'];	
	if (!empty($_REQUEST['cid'])) {
		$mail->AddAddress($rs->fields['conEmail'], $rs->fields['conFname']." ".$rs->fields['conLname']);
		$emailTo=$rs->fields['conEmail'];
	} else {
		$mail->AddAddress($cfg['email'], "Administrator");
		$emailTo=$cfg['email'];
	}

	if(!$mail->Send()){
	?>
		<img src="theme/<?=$cfg['theme']; ?>/images/worning.gif" border="0" align="absmiddle"/>
		<?=_CANNOT_SEND; ?>
	<?
	} else {
	?>
		<img src="theme/<?=$cfg['theme']; ?>/images/ok.gif" border="0" align="absmiddle"/>
		<?=_SEND_COMPLETE; ?>
	<?
	}
    
    // Clear all addresses and attachments for next loop
    $mail->ClearAddresses();

?>