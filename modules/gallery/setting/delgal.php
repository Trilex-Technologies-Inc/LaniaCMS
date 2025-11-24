<?php

if (!eregi("setting.php", $_SERVER['PHP_SELF'])) {
	die ("You can't access this file directly...");
}

/* load data to delete */
$objGallery=new Gallery();
$objGallery->_table=$cfg['tablepre']."gallery";
$rs=$objGallery->Load("galId=".$_REQUEST['gid']);
if (!$rs) {
	/* no data to delete - show error message*/
	$sys_lanai->getErrorBox("Data not found!");
}  else {
	if ($_REQUEST['ac']=="del") {
	/* perform delete */
	$objGallery->deleteGallery($_REQUEST['gid']);
	$objGalleryItem=new GalleryItem();
	$objGalleryItem->delWholdGalleryItem($_REQUEST['gid']);
	$sys_lanai->go2Page("setting.php?modname=gallery");
	} else {
	?>
	<b><?=_GAL_WANT_TO_DELETE; ?></b><br><br>
	<form action="<?=$_SERVER['PHP_SELF']; ?>">
	<input type="hidden" name="modname" value="gallery">
	<input type="hidden" name="mf" value="delgal">
	<input type="hidden" name="ac" value="del">
	<input type="hidden" name="gid" value="<?=$_REQUEST['gid']; ?>">
	<input type="submit" name="submit" value="<?=_YES; ?>" class="inputButton">
	<input type="button" name="reset" value="<?=_NO; ?>" class="inputButton" onClick="javascript:history.back();">
	</form>
	<?	
	}
}

?>