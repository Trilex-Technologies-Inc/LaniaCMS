<?
	if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
			die ("You can't access this file directly...");
	}
	
	$module_name = basename(dirname(__FILE__));
	$modfunction="modules/$module_name/module.php";
	include_once($modfunction);
	
	$news = new News();
	//$rs=$content->getNewsById($_REQUEST['cid']);
	
	$rsc=$news->getGroupList();
	if (($rsc->recordcount())>1) {
	    $rs=$news->getShowGroup();
	?>
	<span class="txtContentTitle"><?=_NWS_GROUP; ?></span><br/><br/>
	<table>
	<?
		while(!$rs->EOF){
		?>
		<tr>
			<td>
			<img src="theme/<?=$news->cfg['theme'];?>/images/file.gif" border="0" align="absmiddle">
			<?
				$link=$sys_lanai->getSEOLink($_SERVER['PHP_SELF']."?modname=".$module_name."&mf=nwsviewgroup&mid=".$rs->fields['chnId']);	
			?>
			<a href="<?=$link; ?>">
			<?=$rs->fields['chnTitle']; ?>
			</a>
			(<?=$news->getNumGroup($rs->fields['chnId']);?>)
			</td>
		</tr>
		<?
			$rs->movenext();
		} // while
	?></table><?
	} else {
	?>
	<span class="txtContentTitle"><?=_NWS_LIST; ?></span><br/><br/>
	<?
		$news->getNewsListPager();
	}
	
	
?>
