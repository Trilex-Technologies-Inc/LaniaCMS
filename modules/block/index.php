<?
	if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
			die ("You can't access this file directly...");
	}
	
	$module_name = basename(dirname(__FILE__));
	$modfunction="modules/$module_name/module.php";
	include_once($modfunction);
	
	// get userinfo
	$block_lanai=new Block();
	$rs=$mem_lanai->getUser($_SESSION['uid']);