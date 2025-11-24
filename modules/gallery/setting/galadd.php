<?php

if (!eregi("setting.php", $_SERVER['PHP_SELF'])) {
		die ("You can't access this file directly...");
}

?>
<span class="txtContentTitle"><?=_GAL_NEW_GALLERY; ?></span><br><br>
<img src="theme/<?=$cfg['theme']; ?>/images/back.gif" border="0" align="absmiddle"/>
<a href="setting.php?modname=gallery" ><?=_GAL_BACK; ?></a><br><br>
<table>
<form name="addform" method="post" action="<?=$_SERVER['PHP_SELF']?>">
<input type="hidden" name="modname" value="gallery">
<input type="hidden" name="mf" value="galadd">
<input type="hidden" name="ac" value="add">
<tr><td><?=_GAL_GALLERY_TITLE; ?> : </td><td><input type="text" id="galTitle" name="galTitle" value="Untitled"></td></tr>
<tr><td valign="top"><?=_GAL_GALLERY_DESC; ?> : </td><td><textarea id="galDescription" name="galDescription" cols="30" rows="5">Untitled Description</textarea></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" value="<?=_SAVE; ?>" class="inputButton">&nbsp;<input type="reset" value="<?=_RESET; ?>" class="inputButton"></td></tr>
</form>
</table>
<?php

if ($_REQUEST['ac']=="add") {
$objGallery=new Gallery();
$objGallery->_table=$cfg['tablepre']."gallery";
echo $objGallery->_table;
if ((empty($_REQUEST['galTitle'])) OR ($_REQUEST['galTitle']=="")) $_REQUEST['galTitle']="Untitled";
$objGallery->galTitle=$_REQUEST['galTitle'];
$objGallery->galDescription=$_REQUEST['galDescription'];
$objGallery->galDate=date("Y-m-d H:i:s");
$result=$objGallery->save();
$id=$objGallery->lastGalId();

if (!$result) $sys_lanai->getErrorBox(_GAL_ERROR_CANNOT_INSERT_DATA); else $sys_lanai->go2Page("setting.php?modname=gallery&mf=additem&gid=".$id);
}
?>