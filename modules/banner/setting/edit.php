<?php

if (!eregi("setting.php", $_SERVER['PHP_SELF'])) {
		die ("You can't access this file directly...");
}

/* load data to edit */
$objbanner=new banner();
$rs=$objbanner->Load("banId=".$_REQUEST['id']);
if (!$rs) {
	/* no data to edit - show error message*/
	$sys_lanai->getErrorBox("Data not found!");
}  else {
	if ($_REQUEST['ac']=="edit") {
		$objbanner->banid=$_REQUEST['banId'];
		$objbanner->bantitle=$_REQUEST['banTitle'];
		$objbanner->bandescription=$_REQUEST['banDescription'];
		$objbanner->banimage=$_REQUEST['banImage'];
		$objbanner->banurl=$_REQUEST['banURL'];
		$objbanner->bandate=$_REQUEST['banDate'];
		$objbanner->banshow=$_REQUEST['banShow'];
		$objbanner->banclick=$_REQUEST['banClick'];

		$result =$objbanner->save();
		if (!$result) { 
			$sys_lanai->getErrorBox($objbanner->ErrorMsg());
		} else {
			$sys_lanai->go2Page("setting.php?modname=banner");
		}
	} else {
	/* found data then fill in form */
?>
<span class="txtContentTitle"><?=_BANN_EDIT_ITEM; ?></span><br><br>
<?=_BANN_EDIT_INSTRUCTION; ?><br/><br/>
<img src="theme/<?=$cfg['theme']; ?>/images/back.gif" border="0" align="absmiddle"/>
<a href="setting.php?modname=banner" ><?=_BACK; ?></a><br><br>
	<table>
	<form name="addform" method="get" action="module.php">
	<input type="hidden" name="modname" value="banner">
	<input type="hidden" name="mf" value="edit">
	<input type="hidden" name="ac" value="edit">
	<input type="hidden" name="i" value="<?=$_REQUEST['id']; ?>">
	<tr><td><?=_BANN_TITLE; ?></td><td><input type="text" id="banTitle" name="banTitle" value="<?=$objbanner->bantitle;?>" size="30">*</td></tr>
	<tr><td valign="top"><?=_BANN_DES; ?></td><td><textarea id="banDescription" name="banDescription" cols="30" rows="5"><?=$objbanner->bandescription;?></textarea>* </td></tr>
	<tr><td><?=_BANN_IMAGE_URL; ?></td><td><input type="text" id="banImage" name="banImage" value="<?=$objbanner->banimage;?>" size="50" onblur="javacript:loadImage()">*</td></tr>
	<tr><td><?=_BANN_URL; ?></td><td><input type="text" id="banURL" name="banURL" value="<?=$objbanner->banurl;?>" size="40">*</td></tr>
	<tr><td>&nbsp;</td><td><img src="<?=$objbanner->banimage;?>" name="banView" ></td></tr>
	<tr><td>&nbsp;</td><td><input type="submit" value="<?=_SAVE; ?>" class="inputButton">&nbsp;<input type="reset" value="<?=_RESET; ?>" class="inputButton"></td></tr>
	</form>
	</table>
	<script language="JavaScript" src="include/jsvalidator/gen_validatorv2.js" type="text/javascript"></script>
	<script language="JavaScript" type="text/javascript">
		//You should create the validator only after the definition of the HTML form
		var frmvalidator  = new Validator("addform");
		frmvalidator.addValidation("banTitle","req","<?=_BANN_TITLE_EMPTY; ?>");
		frmvalidator.addValidation("banDescription","req","<?=_BANN_DES_EMPTY; ?>");
		frmvalidator.addValidation("banImage","req","<?=_BANN_IMAGE_URL_EMPTY; ?>");
		frmvalidator.addValidation("banURL","req","<?=_BANN_URL_EMPTY; ?>");
	</script>
<?
	} // edit action
} // data found
?>