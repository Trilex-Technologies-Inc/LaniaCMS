<?php

if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
		die ("You can't access this file directly...");
}

$objGallery=new Gallery();
$objGallery->_table=$cfg['tablepre']."gallery";
?>
<span class="txtContentTitle"><?=_GALLRY; ?></span><br><br>
<?
$sql="SELECT * FROM ".$objGallery->_table;
$pager=new GalleryViewPager($db,$sql,10);
$pager->link="module.php?modname=gallery&";
// update ui

$pager->pageStr=_GAL_PAGE;
$pager->lastStr=_GAL_LAST;
$pager->firstStr=_GAL_FIRST;
$pager->prevStr=_GAL_PREV;
$pager->nextStr=_GAL_NEXT;
$pager->renderPage();

?>