<script>
function delitem(g,i) {
	location.href="setting.php?modname=gallery&mf=delitm&gid="+g+"&itm="+i
}
</script>
<?php

if (!eregi("setting.php", $_SERVER['PHP_SELF'])) {
		die ("You can't access this file directly...");
}
?>
<span class="txtContentTitle"><?=_GAL_MAN_ITEM; ?></span><br><br>
<img src="theme/<?=$cfg['theme']; ?>/images/back.gif" border="0" align="absmiddle"/>
<a href="setting.php?modname=gallery" ><?=_GAL_BACK; ?></a><br><br>
<?

$objGalleryItem=new GalleryItem();
$objGalleryItem->_table=$cfg['tablepre']."gallery_item";
$objGallery=new Gallery();
$objGallery->_table=$cfg['tablepre']."gallery";
$sql="SELECT * FROM ".$objGalleryItem->_table." WHERE galId=".$_REQUEST['gid']." ORDER BY itmId ASC";
$pager=new GalleryItemManagePager($db,$sql,30);
$pager->link="setting.php?modname=gallery&mf=mangal&gid=".$_REQUEST['gid']."&";
// update ui
$pager->pageStr=$galIndex._GAL_PAGE;
$pager->lastStr=_GAL_LAST;
$pager->firstStr=_GAL_FIRST;
$pager->prevStr=_GAL_PREV;
$pager->nextStr=_GAL_NEXT;
$pager->renderPage();

?>