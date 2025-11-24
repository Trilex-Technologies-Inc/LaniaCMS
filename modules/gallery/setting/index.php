<?php

if (!eregi("setting.php", $_SERVER['PHP_SELF'])) {
		die ("You can't access this file directly...");
}

$objGallery=new Gallery();
$objGallery->_table=$cfg['tablepre']."gallery";
$sql="SELECT * FROM ".$objGallery->_table;
$pager=new GalleryPager($db,$sql,30);
$pager->link="setting.php?modname=gallery&mf=list&";
?>
<span class="txtContentTitle"><?=_GAL_SETTING; ?></span><br><br>
<img src="theme/<?=$cfg['theme']; ?>/images/new.gif" border="0" align="absmiddle"/>
<a href="setting.php?modname=gallery&mf=galadd" ><?=_GAL_GALLERY_NEW; ?></a>&nbsp;
<img src="theme/<?=$cfg['theme']; ?>/images/back.gif" border="0" align="absmiddle"/>
<a href="module.php?modname=setting" ><?=_GAL_BACK; ?></a><br><br>
<?
// update ui
$pager->pageStr=_GAL_PAGE;
$pager->lastStr=_GAL_LAST;
$pager->firstStr=_GAL_FIRST;
$pager->prevStr=_GAL_PREV;
$pager->nextStr=_GAL_NEXT;

$pager->renderPage();

?>

