<?

	if ( !eregi( "setting.php", $_SERVER['PHP_SELF'] ) ) {
	    die ( "You can't access this file directly..." );
	} 
	
	$module_name = basename( dirname( substr( __FILE__, 0, strlen( dirname( __FILE__ ) ) ) ) );
	$modfunction = "modules/$module_name/module.php";
	include_once( $modfunction ); 
	
	
	$pll=new Poll();
	$rsPoll=$pll->getPollItemById($_REQUEST['mid']);
	$rsPollOption=$pll->getPollOptionItemById($_REQUEST['mid']);
	
	?><span class="txtContentTitle"><?=_POLL_SETTING; ?></span><br/><br/>
	<?=_POLL_EDIT_INSTRUCTION; ?><br/><br/>
	
	<img src="theme/<?=$cfg['theme']; ?>/images/save.gif" border="0" align="absmiddle"/>
	<a href="#" onClick="javascript:document.form.submit();" ><?=_SAVE; ?></a>&nbsp;&nbsp; 
	
	<img src="theme/<?=$cfg['theme']; ?>/images/back.gif" border="0" align="absmiddle"/>
	<a href="#" onClick="javascript:history.back();"><?=_BACK; ?></a>
	<br><br>
	<table cellpadding="3" cellspacing="1" >
	<form name="form" method="post"  action="<?=$_SERVER['PHP_SELF']; ?>" ENCTYPE="multipart/form-data" >
	<input type="hidden" name="mf" value="plledit">
	<input type="hidden" name="ac" value="edit">
	<input type="hidden" name="mid" value="<?=$_REQUEST['mid']; ?>">
	<input type="hidden" name="modname" value="<?=$module_name; ?>">
	<tr>
		<td><?=_POLL_TITLE; ?></td>
		<td><input type="text" name="pllTitle" size="30" value="<?=$rsPoll->fields['pllTitle']; ?>">*</td>
	</tr>
	<tr>
		<td><?=_POLL_LAG; ?></td>
		<td><input type="text" name="pllLag" size="4" value="<?=$rsPoll->fields['pllLag']; ?>">* <?=_POLL_SEC; ?></td>
	</tr>
	<tr>
		<td><?=_POLL_OPTION; ?></td>		
	</tr>			
	<? 
	 	for ($i=0;$i<12;$i++) {
		?>
		<tr> 
			<td align="right"><?=($i+1); ?>&nbsp;</td>
			<td>
			<input type="text" name="ppoTitle[]" size="30" value="<?=$rsPollOption->fields['ppoTitle']?>">
			<input type="hidden" name="ppoId[]" value="<?=$rsPollOption->fields['ppoId']?>">
			</td>	
		</tr>			
		<? 
			$rsPollOption->MoveNext();
		}
	?>			
	</form>
	</table>