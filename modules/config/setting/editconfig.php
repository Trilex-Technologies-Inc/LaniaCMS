<?php

if (!eregi("setting.php", $_SERVER['PHP_SELF'])) {
		die ("You can't access this file directly...");
}

/* load data to edit */
$objStatus=new SysConfig();

$objConfig=new Meta();
$objConfig->_table=$cfg['tablepre']."meta";
$rs=$objConfig->Load("mtaId=1");

if (!$rs) {
	/* no data to edit - show error message*/
	$sys_lanai->getErrorBox("Data not found!");
}  else {
	$objConfig->mtaId=1;
    $objConfig->mtakeywords=$_POST['mtaKeywords'];
	$objConfig->mtadescription=$_POST['mtaDescription'];
	$objConfig->mtaabstract=$_POST['mtaAbstract'];
	$objConfig->mtaauthor=$_POST['mtaAuthor'];
	$objConfig->mtadistribution=$_POST['mtaDistribution'];
	$objConfig->mtacopyright=$_POST['mtaCopyright'];
	$result =$objConfig->Save();
	$objStatus->setUpdateStatus($_POST['cfgStatus']);
	if (!$result) $sys_lanai->getErrorBox($objConfig->ErrorMsg()); else $sys_lanai->go2Page("setting.php?modname=config");
}

?>