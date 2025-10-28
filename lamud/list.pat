<?php

if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
		die ("You can't access this file directly...");
}

$obj%CLASS%=new %CLASS%();
$sql="SELECT * FROM ".$obj%CLASS%->_table;
$pager=new Pager($db,$sql,30);
$pager->link="module.php?modname=%MODULE%&mf=list&";
$pager->renderPage();

?>