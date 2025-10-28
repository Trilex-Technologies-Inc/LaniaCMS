<?
	if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
			die ("You can't access this file directly...");
	}
	
	$module_name = basename(dirname(__FILE__));
	$modfunction="modules/$module_name/module.php";
	include_once($modfunction);
?><span class="txtContentTitle"><?=_NWS_LIST; ?></span><br/><br/><?
	$news = new News();
	
	$news->getShowNewsByGroup($rows=20,$_REQUEST['mid']);

?>