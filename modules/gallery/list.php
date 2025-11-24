<?php

if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
		die ("You can't access this file directly...");
}

$objGalleryItem=new GalleryItem();
$objGalleryItem->_table=$cfg['tablepre']."gallery_item";
$objGallery=new Gallery();
$objGallery->_table=$cfg['tablepre']."gallery";
$galIndex="<a href=\"module.php?modname=gallery\">^"._GAL_GAL_INDEX."</a> ";
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
$pager=new GalleryItemViewPager($db,$sql,16);
$pager->link="module.php?modname=gallery&mf=list&gid=".$_REQUEST['gid']."&";
// update ui
$pager->pageStr=$galIndex._GAL_PAGE;
$pager->lastStr=_GAL_LAST;
$pager->firstStr=_GAL_FIRST;
$pager->prevStr=_GAL_PREV;
$pager->nextStr=_GAL_NEXT;
$pager->renderPage();

?>