<?
	if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
			die ("You can't access this file directly...");
	}
	$module_name = basename(dirname(__FILE__));
	$modfunction="modules/$module_name/module.php";
	include_once($modfunction);
	$faq = new Faq();
	$rsc=$faq->getFaqGroupShow();
	$num=$rsc->recordcount();
	if ($num>1) {
	    $rs=$faq->getFaqGroupShow();
	?>
	<span class="txtContentTitle"><?=_FAQ_GROUP; ?></span><br/><br/>
	<table cellpadding="3" cellspacing="1">
	<?
		while(!$rs->EOF){
		?>		
		<tr>
		    <td rowspan="2" valign="top"><img src="theme/<?=$faq->cfg['theme'];?>/images/setting_faq.gif" border="0" align="absmiddle"></td>
		    <td>
				<a href="<?=$_SERVER['PHP_SELF']."?modname=".$module_name; ?>&mf=faqviewgroup&mid=<?=$rs->fields['fcgId']; ?>">
				<?=$rs->fields['fcgTitle']; ?>
				</a>
				(<?=$faq->getTotalItemInGroup($rs->fields['fcgId']);?>)</td>
		</tr>
		<tr>
		  <td><?=$rs->fields['fcgDescription']; ?></td>
		</tr>		
		<?
			$rs->movenext();
		} // while
	?></table><?
	} else {
		if ($num>0) {
		 	$rs=$faq->getFaqGroupShow();
		 	$sys_lanai->go2Page("module.php?modname=faq&mf=faqviewgroup&mid=".$rs->fields['fcgId']);
		}
	}

?>