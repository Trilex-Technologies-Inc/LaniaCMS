<?

	if ( !eregi( "setting.php", $_SERVER['PHP_SELF'] ) ) {
	    die ( "You can't access this file directly..." );
	} 
	
	$module_name = basename( dirname( substr( __FILE__, 0, strlen( dirname( __FILE__ ) ) ) ) );
	$modfunction = "modules/$module_name/module.php";
	include_once( $modfunction ); 
	
	
	$news=new News();
	$rs=$news->getNewsById($_REQUEST['mid']);
	
	?><span class="txtContentTitle"><?=_NEWS_SETTING; ?></span><br/><br/>
	<?=_NEWS_EDIT_INSTRUCTION; ?><br/><br/>
	
	<img src="theme/<?=$cfg['theme']; ?>/images/save.gif" border="0" align="absmiddle"/>
	<a href="#" onClick="javascript:document.form.submit();" ><?=_SAVE; ?></a>&nbsp;&nbsp; 
	
	<img src="theme/<?=$cfg['theme']; ?>/images/back.gif" border="0" align="absmiddle"/>
	<a href="#" onClick="javascript:history.back();"><?=_BACK; ?></a>
	<br><br>
	<table cellpadding="3" cellspacing="1" >
	<form name="form" method="post"  action="<?=$_SERVER['PHP_SELF']; ?>">
	<input type="hidden" name="mf" value="nwsedit">
	<input type="hidden" name="modname" value="<?=$module_name; ?>">
	<input type="hidden" name="mid" value="<?=$_REQUEST['mid']; ?>">
	<input type="hidden" name="ac" value="edit">
	<tr>
		<td ><?=_NEWS_TITLE; ?></td>
		<td width="100%" ><input type="text" name="nwsTitle" size="40" value="<?=$rs->fields['nwsTitle']; ?>">*</td>	
	</tr>
	<tr>
		<td ><?=_NEWS_GROUP; ?></td>
		<td >
		<?=$news->getNewsGroupCombo("chnId",$rs->fields['chnId']); ?>*
		</td>	
	</tr>
	<tr>
		<td  colspan="2" >
		<? 
				$sBasePath = "include/fckeditor/";
				$oFCKeditor1 = new FCKeditor('nwsPreface') ;
				$oFCKeditor1->ToolbarSet	= "MyToolbar" ;
				$oFCKeditor1->Width ="640";	
				$oFCKeditor1->Height ="300";			
				$oFCKeditor1->BasePath	= $sBasePath ;
				$oFCKeditor1->Value		= $rs->fields['nwsPreface'];
				$oFCKeditor1->Create() ;
			?>*
		</td>	
	</tr>
	<tr>
		<td  colspan="2" >
		<? 
				$sBasePath = "include/fckeditor/";
				$oFCKeditor2 = new FCKeditor('nwsBody') ;
				$oFCKeditor2->ToolbarSet	= "MyToolbar" ;
				$oFCKeditor2->Width ="640";	
				$oFCKeditor2->Height ="300";			
				$oFCKeditor2->BasePath	= $sBasePath ;
				$oFCKeditor2->Value		= $rs->fields['nwsBody'];
				$oFCKeditor2->Create() ;
			?>
		</td>	
	</tr>
	</form>
	</table>