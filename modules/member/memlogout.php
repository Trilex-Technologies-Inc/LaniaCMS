<?
	if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
			die ("You can't access this file directly...");
	}
	
	$module_name = basename(dirname(__FILE__));
	$modfunction="modules/$module_name/module.php";
	include_once($modfunction);

	//$_SESSION['uid']=0;
	session_unregister('uid');
	$sys_lanai->go2Page("index.php");
?>