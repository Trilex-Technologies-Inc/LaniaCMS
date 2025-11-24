<?php

if (!eregi("setting.php", $_SERVER['PHP_SELF'])) {
		die ("You can't access this file directly...");
}

/* load data to edit */
$objGallery=new Gallery();
$objGallery->_table=$cfg['tablepre']."gallery";

$rs=$objGallery->Load("galId=".$_REQUEST['gid']);

if (!$rs) {
	/* no data to edit - show error message*/
	$sys_lanai->getErrorBox("Data not found!");
}  else {
	if ($_REQUEST['ac']=="edit") {
		$objGallery->galTitle=$_REQUEST['galTitle'];
        $objGallery->galId=$_REQUEST['gid'];
		$objGallery->galDescription=$_REQUEST['galDescription'];
		$objGallery->galDate=date("Y-m-d H:i:s");
		$result =$objGallery->saveGal();
		if (!$result) $sys_lanai->getErrorBox($objGallery->ErrorMsg()); else $sys_lanai->go2Page("setting.php?modname=gallery");
	} else {
	/* found data then fill in form */
?>
<span class="txtContentTitle"><?=_GAL_EDIT_GALLERY; ?></span><br><br>
<img src="theme/<?=$cfg['theme']; ?>/images/back.gif" border="0" align="absmiddle"/>
<a href="setting.php?modname=gallery" ><?=_GAL_BACK; ?></a><br><br>
	<table>
	<form name="addform" method="get" action="setting.php">
	<input type="hidden" name="modname" value="gallery">
	<input type="hidden" name="mf" value="editgal">
	<input type="hidden" name="ac" value="edit">
	<input type="hidden" name="gid" value="<?=$_REQUEST['gid']; ?>">
	<tr><td><?=_GAL_GALLERY_TITLE; ?> : </td><td><input type="text" id="galTitle" name="galTitle" value="<?=$objGallery->GALTITLE;?>"></td></tr>
	<tr><td valign="top"><?=_GAL_GALLERY_DESC; ?> : </td><td><textarea id="galDescription" name="galDescription" cols="30" rows="5"><?=$objGallery->GALDESCRIPTION;?></textarea></td></tr>
	<tr><td>&nbsp;</td><td><input type="submit" value="<?=_SAVE; ?>" class="inputButton">&nbsp;<input type="reset" value="<?=_RESET; ?>" class="inputButton"></td></tr>
	</form>
	</table>
<?
	} // edit action
} // data found
?>