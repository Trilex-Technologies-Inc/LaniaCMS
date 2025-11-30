<?php

if (!eregi("setting.php", $_SERVER['PHP_SELF'])) {
		die ("You can't access this file directly...");
}

?>
<span class="txtContentTitle"><?=_JPOP_SETTING; ?></span><br><br>
<a href="setting.php?modname=jpop&mf=popadd" ><?=_JPOP_NEW; ?></a> | 
<a href="module.php?modname=setting" ><?=_JPOP_BACK; ?></a><br><br>
<?

$objJpop=new Jpop();
$objJpop->_table=$cfg['tablepre']."jpop";
$sql="SELECT * FROM ".$objJpop->_table;
$pager=new JPOPSettingPager($db,$sql,5);
$pager->link="module.php?modname=jpop&mf=list&";

// update ui
$pager->pageStr=_JPOP_PAGE;
$pager->lastStr=_JPOP_LAST;
$pager->firstStr=_JPOP_FIRST;
$pager->prevStr=_JPOP_PREV;
$pager->nextStr=_JPOP_NEXT;
$pager->renderPage();

?>