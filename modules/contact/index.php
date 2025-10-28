<?
	if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
			die ("You can't access this file directly...");
	}
	
	$module_name = basename(dirname(__FILE__));
	$modfunction="modules/$module_name/module.php";
	include_once($modfunction);
	$cnt=new Contact();
?>
<script language="JavaScript" type="text/JavaScript">
<!--
	function validate(frmObj)
	{
		if ((frmObj.name.value.length)==0)  {
			alert ('<?=_REQUIRE_FIELDS; ?> <?=_CONTACT_NAME; ?>');
			return false;
		}
		if ((frmObj.email.value.length)==0)  {
			alert ('<?=_REQUIRE_FIELDS; ?> <?=_CONTACT_EMAIL; ?>');
			return false;
		}
		if ((frmObj.message.value.length)==0)  {
			alert ('<?=_REQUIRE_FIELDS; ?> <?=_CONTACT_MESSAGE; ?>');
			return false;
		}  	
	}
	
	function MM_jumpMenu(targ,selObj,restore){ //v3.0
	  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
	  if (restore) selObj.selectedIndex=0;
	}
-->
</script>
<span class="txtContentTitle"><?=_CONTACT; ?></span><br/><br/>
<?=_CONTACT_INSTRUCTION; ?><br/><br/>

<form method="post" action="<?=$_SERVER['PHP_SELF']?>" onsubmit="return validate(this)">
<?	
	/// set type
	settype($_REQUEST['cid'],"integer");
	if (!empty($_REQUEST['cid'])) {
		$cndetail=$cnt->getContactById($_REQUEST['cid']);
		if ($cndetail->recordcount()>0) {
		
?>	
<table >
<tr>
	<td>
		<?=$cndetail->fields['conFname']?> <?=$cndetail->fields['conLname']?>
		<br><?=$cndetail->fields['conPosition']?><br><br>
		<?=$cndetail->fields['conAddress1']?><br><?=$cndetail->fields['conAddress2']?><br>
		<?=$cndetail->fields['conCity']." ".$cndetail->fields['conState']." ".$cndetail->fields['conZipcode']." ".$cndetail->fields['cntId'];?><br><br>
		<?=_PHONE; ?>: <?=$cndetail->fields['conPhone']?><br>
		<?=_FAX; ?>: <?=$cndetail->fields['conFax']?><br>
		<?=_MOBILE; ?>: <?=$cndetail->fields['conMobile']?><br>
		<?=_EMAIL; ?>: <?=$cndetail->fields['conEmail']?><br>
		<?=_HOMEPAGE; ?>: <?=$cndetail->fields['conURL']?><br>
	</td>
</tr>
</table>
<br>
<?   
		}		
	}
?>
<table >
<input type="hidden" name="modname" value="<?=$module_name; ?>">
<input type="hidden" name="mf" value="send">
<input type="hidden" name="cid" value="<?=$_REQUEST['cid']; ?>">
<input type="hidden" name="ac" value="send">
<tr>
	<td><?=_CONTACT_TO; ?></td>
	<td><?=$cnt->getContactCombo("to"); ?></td>
</tr>
<tr>
	<td><?=_CONTACT_NAME; ?></td>
	<td><input type="text" name="name" class="txtInput"/>*</td>
</tr>
<tr>
	<td><?=_CONTACT_EMAIL; ?></td>
	<td><input type="text" name="email" class="txtInput"/>*</td>
</tr>
<tr>
	<td><?=_CONTACT_TITLE; ?></td>
	<td><input type="text" name="title" class="txtInput"/></td>
</tr>
<tr>
	<td valign="top"><?=_CONTACT_MESSAGE; ?></td>
	<td><textarea name="message" cols="30" rows=5"" class="txtInput"></textarea>*</td>
</tr>
<tr>
	<td valign="top"></td>
	<td><input type="submit" value="<?=_SEND; ?>"  class="inputButton" /> <input type="reset" value="<?=_RESET; ?>"  class="inputButton"/></td>
</tr>
</form>
</table>