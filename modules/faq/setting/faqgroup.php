<?



	if ( !eregi( "setting.php", $_SERVER['PHP_SELF'] ) ) {

	    die ( "You can't access this file directly..." );

	}



	$module_name = basename( dirname( substr( __FILE__, 0, strlen( dirname( __FILE__ ) ) ) ) );

	$modfunction = "modules/$module_name/module.php";

	include_once( $modfunction );





	$module=new Faq();

	?><span class="txtContentTitle"><?=_FAQ_SETTING; ?></span><br/><br/>

	<?=_FAQ_GROUP_SETTING_INSTRUCTION; ?><br/><br/>

	

	<img src="theme/<?=$cfg['theme']; ?>/images/new.gif" border="0" align="absmiddle"/>

	<a href="<?=$_SERVER['PHP_SELF']?>?modname=<?=$module_name?>&mf=faqgnew" ><?=_NEW; ?></a>&nbsp;&nbsp;

    

	<img src="theme/<?=$cfg['theme']; ?>/images/view_text.gif" border="0" align="absmiddle"/>

	<a href="<?=$_SERVER['PHP_SELF']?>?modname=<?=$module_name?>" ><?=_FAQ_SETTING; ?></a>&nbsp;&nbsp;

    

	<a href="javascript:chk_mweight();" ><img src="theme/<?=$cfg['theme']; ?>/images/save.gif" border="0" align="absmiddle"/>

	<?=_SAVEWEIGHT; ?></a>&nbsp;&nbsp;

	

	<img src="theme/<?=$cfg['theme']; ?>/images/ok.gif" border="0" align="absmiddle"/>

	<a href="javascript:chk_mactive();" ><?=_ACTIVE; ?></a>&nbsp;&nbsp;

	

	<img src="theme/<?=$cfg['theme']; ?>/images/delete.gif" border="0" align="absmiddle"/>

	<a href="javascript:chk_mdelete();" ><?=_DELETE; ?></a>&nbsp;&nbsp;

	

	<img src="theme/<?=$cfg['theme']; ?>/images/back.gif" border="0" align="absmiddle"/>

	<a href="module.php?modname=setting" ><?=_BACK; ?></a>

	<br><br>

	<script language="javascript">

	<!--

		function chk_mdelete() {

			if (confirm("<?=_DELETE_QUESTION; ?>")){

				document.form.ac.value="mgdelete";

				document.form.submit();

			}

		}

		function chk_mactive() {

			document.form.ac.value="mgactive";

			document.form.submit();

		}

        function chk_mweight() {

			document.form.ac.value="mgweight";

			document.form.submit();

		}

	//-->

	</script>

<?

	$module->getFaqGroupList();



?>

