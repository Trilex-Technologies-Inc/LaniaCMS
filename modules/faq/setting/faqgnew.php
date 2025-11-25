<?



	if ( !eregi( "setting.php", $_SERVER['PHP_SELF'] ) ) {

	    die ( "You can't access this file directly..." );

	}



	$module_name = basename( dirname( substr( __FILE__, 0, strlen( dirname( __FILE__ ) ) ) ) );

	$modfunction = "modules/$module_name/module.php";

	include_once( $modfunction );



	$faq=new Faq();

	?>

	<span class="txtContentTitle"><?=_FAQ_SETTING; ?></span><br/><br/>

	<?=_FAQ_GROUP_NEW_INSTRUCTION; ?><br/><br/>

	<img src="theme/<?=$cfg['theme']; ?>/images/save.gif" border="0" align="absmiddle"/>
	<a href="#" onClick="javascript:document.form.submit();" ><?=_SAVE; ?></a>&nbsp;&nbsp;
	<img src="theme/<?=$cfg['theme']; ?>/images/back.gif" border="0" align="absmiddle"/>
	<a href="#" onClick="javascript:history.back();"><?=_BACK; ?></a><br><br>

    <table cellpadding="3" cellspacing="1" >

	<form name="form" method="post"  action="<?=$_SERVER['PHP_SELF']; ?>">

	<input type="hidden" name="modname" value="<?=$module_name; ?>">

	

	<input type="hidden" name="ac" value="gnew">

    <tr>

      <td><?=_FAQ_GROUP_TITLE; ?></td>

      <td><input type="text" name="fcgTitle" size="40"/></td>

    </tr>

    <tr>

      <td valign="top"><?=_FAQ_GROUP_DESCRIPTION; ?></td>

      <td>

		<textarea name="fcgDescription" cols="60" rows="10"></textarea>

      </td>

    </tr>

    </form>

	</table>

