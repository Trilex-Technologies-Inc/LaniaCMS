<?php

if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
		die ("You can't access this file directly...");
}

$objGalleryItem=new GalleryItem();
$objGalleryItem->_table=$cfg['tablepre']."gallery_item";
$objGallery=new Gallery();
$objGallery->_table=$cfg['tablepre']."gallery";

//convert type
settype($_REQUEST['gid'],"integer");

?>
<span class="txtContentTitle"><?=$objGallery->getGalleryTitle($_REQUEST['gid']); ?></span> 
<?
	if ($objGallery->getGalleryDes($_REQUEST['gid'])!="") {
		?><br><br><?=$objGallery->getGalleryDes($_REQUEST['gid']); ?><?
	}
	?><br><br><?

$sql="SELECT * FROM ".$objGalleryItem->_table." WHERE galId=".$_REQUEST['gid']." ORDER BY itmId ASC";
$pager=new GalleryItemPager($db,$sql,1);
$pager->link="module.php?modname=gallery&mf=view&gid=".$_REQUEST['gid']."&";
$pager->pageStr="";
$pager->renderPage();

?>