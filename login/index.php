<?
		include_once("../config.inc.php");
?>
<SCRIPT LANGUAGE="JavaScript">
<?	
		if ($cfg_seo=="yes") {  
?>
		location.href="<?=$cfg_url; ?>/member.mf.memloginform.htm";
<?	} else { 
?>	
		location.href="<?=$cfg_url; ?>/module.php?modname=member&mf=memloginform";
<?
		}	
?>
</SCRIPT>