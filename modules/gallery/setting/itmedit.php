<?php

if (!eregi("setting.php", $_SERVER['PHP_SELF'])) {
		die ("You can't access this file directly...");
}

/* load data to edit */
$objGalleryItem=new GalleryItem();
$objGalleryItem->_table=$cfg['tablepre']."gallery_item";
$rs=$objGalleryItem->Load("itmId=".$_REQUEST['itmId']." AND galId=".$_REQUEST['galId']);
if (!$rs) {
	/* no data to edit - show error message*/
	$sys_lanai->getErrorBox("Data not found!");
}  else {
		$objGalleryItem->itmtitle=$_REQUEST['itmTitle'];
		$objGalleryItem->itmdescription=$_REQUEST['itmDescription'];
		$result =$objGalleryItem->save();
		if (!$result) $sys_lanai->getErrorBox($objGalleryItem->ErrorMsg()); else $sys_lanai->goBack(1);
} // data found
?>