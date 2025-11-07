<?php

		include_once('setconfig.inc.php');
		include_once('include/header.inc.php');

		$theme=New Theme();
		$smarty->assign ("getLogoHeader", $theme->getLogoHeader());
		$smarty->assign ("getFooter", $theme->getFooter());
		$smarty->assign ("setBlockLeft", $theme->setBlock("l"));
		$smarty->assign ("setBlockRight", $theme->setBlock("r"));
		$smarty->assign ("setModule", $theme->getModule($_REQUEST['modname'],$_REQUEST['mf']));
		//$smarty->assign ("setBlockCenter", $theme->setBlock("c"));
		$smarty->assign ("setBlockTop", $theme->setBlock("t"));
		$smarty->assign ("setBlockBottom", $theme->setBlock("b"));
		$smarty->display('module.tpl');

		include_once('include/footer.inc.php');
?>
