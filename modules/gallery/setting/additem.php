<?php
if (!eregi("setting.php", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}
?>
<span class="txtContentTitle"><?=_GAL_NEW_ITEM; ?></span><br><br>
<img src="theme/<?=$cfg['theme']; ?>/images/back.gif" border="0" align="absmiddle"/>
<a href="setting.php?modname=gallery" ><?=_GAL_BACK; ?></a><br><br>
<table>
<form name="addform" method="post" action="setting.php" enctype="multipart/form-data">
<input type="hidden" name="modname" value="gallery">
<input type="hidden" name="mf" value="additem">
<input type="hidden" name="gid" value="<?=$_REQUEST['gid']?>">
<input type="hidden" name="ac" value="add">
<?
for ($i=0;$i<10;$i++) {
?>
<tr><td><b><?=($i+1); ?>.</b></td><td><?=_GAL_ITEM_TITLE; ?> </td><td><input type="text" id="itmTitle" name="itmTitle[]" value="Untitled"></td></tr>
<tr><td>&nbsp;</td><td><?=_GAL_ITEM_DES; ?> </td><td><input type="text" id="itmDescription" name="itmDescription[]" size="50"></td></tr>
<tr><td>&nbsp;</td><td><?=_GAL_BROWSE; ?> </td><td><input type="file" id="imFilename" name="itmFilename[]" size="50"></td></tr>
<?
}
?>
<tr><td>&nbsp;</td><td>&nbsp;</td><td><input type="submit" value="<?=_SAVE; ?>" class="inputButton">&nbsp;<input type="reset" value="<?=_RESET; ?>" class="inputButton"></td></tr>
</form>
</table>
<?php
if ($_REQUEST['ac']=="add") {
    
$objGalleryItem=new GalleryItem();
$objGalleryItem->_table=$cfg['tablepre']."gallery_item";

$lid=$objGalleryItem->lastId(intval($_REQUEST['gid']));
$lid=$lid+1;

$itmTitle=$_REQUEST['itmTitle'];
$itmDes=$_REQUEST['itmDescription'];

$uploaddir = $cfg['datadir'].$sys_lanai->getPath()."gallery".$sys_lanai->getPath();

for ($i=0;$i<10;$i++)  {
    if (!empty($_FILES["itmFilename"]["tmp_name"][$i])) {
    
    $filename=$uploaddir."image_".sprintf("%04d",$_REQUEST['gid'])."_".sprintf("%04d",($i+$lid)).".jpg";
    $filename2=$uploaddir."image_".sprintf("%04d",$_REQUEST['gid'])."_".sprintf("%04d",($i+$lid))."_small.jpg";
    $filename3=$uploaddir."image_".sprintf("%04d",$_REQUEST['gid'])."_".sprintf("%04d",($i+$lid))."_medium.jpg";
    
    if (move_uploaded_file($_FILES["itmFilename"]["tmp_name"][$i], $filename)) {
        
        $objGalleryItem->resizeImage($filename,$filename2,140,140);    
        $objGalleryItem->resizeImage($filename,$filename3,400,400);    
        
        // Create NEW object for database operations
        $itemObj = new GalleryItem();
        $itemObj->_table = $cfg['tablepre']."gallery_item";
        
        $itemObj->itmId = ($i+$lid);
        $itemObj->galId = intval($_REQUEST['gid']);
        $itemObj->itmTitle = $itmTitle[$i];
        $itemObj->itmDescription = $itmDes[$i];
        
        list($w,$h)=getimagesize($filename);
        $itemObj->itmSize = $w."x".$h;         
        
        $result = $itemObj->save();
        
        if (!$result) {
            $sys_lanai->getErrorBox(_GAL_ERROR_CANNOT_INSERT_DATA);
        } else {
            $sys_lanai->go2Page("setting.php?modname=gallery");
        }
    }
    }
}

}
?>