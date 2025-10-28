<?
 
	if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
			die ("You can't access this file directly...");
	}
	
	$module_name = basename(dirname(__FILE__));
	$modfunction="modules/$module_name/module.php";
	include_once($modfunction);
	
	$content = new Content();
	/// settype
	settype($_REQUEST['cid'],"integer");
	$rs=$content->getContentById($_REQUEST['cid']);
	if (($rs->recordcount())>0) {
			
?>
<?=$sys_lanai->setPageTitle($rs->fields['conTitle']); ?>
<span class="txtContentTitle"><?=$rs->fields['conTitle'] ?></span><br/><br/>
<?=$rs->fields['conBody1']?>
<?=$rs->fields['conBody2']?>
<?
	} else {
		$sys_lanai->getErrorBox(_CONTENT_NOT_FOUND);
	}
?>