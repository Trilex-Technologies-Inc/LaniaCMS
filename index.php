<?
		if  (!file_exists('config.inc.php')) {
			?><SCRIPT LANGUAGE="JavaScript">
			<!--
					location.href="install/";
			//-->
			</SCRIPT><?
		}
		include_once('setconfig.inc.php');
		include_once('include/header.inc.php');

		$theme=New Theme();
		$smarty->assign ("getLogoHeader", $theme->getLogoHeader());
		$smarty->assign ("getFooter", $theme->getFooter());
		$smarty->assign ("setBlockLeft", $theme->setBlock("l"));
		$smarty->assign ("setBlockRight", $theme->setBlock("r"));
		$smarty->assign ("setBlockCenter", $theme->setBlock("c"));
		$smarty->assign ("setBlockTop", $theme->setBlock("t"));
		$smarty->assign ("setBlockBottom", $theme->setBlock("b"));
		$smarty->display('index.tpl');

		include_once('include/footer.inc.php');
?>