<?

	if ( !eregi( "setting.php", $_SERVER['PHP_SELF'] ) ) {
	    die ( "You can't access this file directly..." );
	} 
	
	$module_name = basename( dirname( substr( __FILE__, 0, strlen( dirname( __FILE__ ) ) ) ) );
	$modfunction = "modules/$module_name/module.php";
	include_once( $modfunction ); 
		
	$blc_lanai=new Block();
	?>
	<span class="txtContentTitle"><?=_BLOCK_SETTING; ?></span><br/><br/>
	<?=_BLOCK_EDIT_INSTRUCTION; ?><br/><br/>
	
	<img src="theme/<?=$cfg['theme']; ?>/images/save.gif" border="0" align="absmiddle"/>
	<a href="#" onClick="javascript:document.form.submit();" ><?=_SAVE; ?></a>&nbsp;&nbsp; 
	
	<img src="theme/<?=$cfg['theme']; ?>/images/back.gif" border="0" align="absmiddle"/>
	<a href="#" onClick="javascript:history.back();"><?=_BACK; ?></a><br><br>
	<table >
	<form name="form" method="post"  action="<?=$_SERVER['PHP_SELF']; ?>">	
	<input type="hidden" name="modname" value="<?=$module_name; ?>">
	<input type="hidden" name="mf" value="blcedit">
	<input type="hidden" name="ac" value="edit">	
	<input type="hidden" name="blcid" value="<?=$_REQUEST['mid']?>">	
	<input type="hidden" name="m" value="<?=$_REQUEST['m']?>">
	<? 
		$rs=$blc_lanai->getBlockById($_REQUEST['mid']);
		switch($_REQUEST['m']){
			case 'c': 
				// content type
	?>
	<tr>
		<td><?=_BLOCK_TITLE; ?></td>
		<td><input type="text" name="blcTitle" size="50" value="<?=$rs->fields['blcTitle']?>">*</td>
	</tr>
	<tr>
		<td valign="top"><?=_BLOCK_CONTENT; ?></td>
		<td><? 
				$sBasePath = "include/fckeditor/";
				$oFCKeditor1 = new FCKeditor('blcContent') ;
				$oFCKeditor1->ToolbarSet	= "MyToolbar" ;
				$oFCKeditor1->Width ="640";	
				$oFCKeditor1->Height ="350";			
				$oFCKeditor1->BasePath	= $sBasePath ;
				$oFCKeditor1->Value		= $rs->fields['blcContent'];
				$oFCKeditor1->Create() ;
				
			?>
		</td>
	</tr>
	<tr>
		<td><?=_BLOCK_POSITION; ?></td>
		<td>
		<select name="blcPosition">
			<? 
				if ($rs->fields['blcPosition']=='l') {
				    $left="selected";
				} else if ($rs->fields['blcPosition']=='r') {
					$right="selected";
				}  else if ($rs->fields['blcPosition']=='c') {
					$center="selected";
				}  else if ($rs->fields['blcPosition']=='t') {
					$top="selected";
				}  else if ($rs->fields['blcPosition']=='b') {
					$bottom="selected";
				} 
			?>
			<option value="l" <?=$left; ?>><?=_LEFT; ?></option>
			<option value="r" <?=$right; ?>><?=_RIGHT; ?></option>
			<option value="c" <?=$center; ?>><?=_CENTER; ?></option>
			<option value="t" <?=$top; ?>><?=_TOP; ?></option>
			<option value="b" <?=$bottom; ?>><?=_BOTTOM; ?></option>
		</select>
		</td>
	</tr>
	<?
				break;
			case 'b': 
				// uploadfile
	?>
	<tr>
		<td><?=_BLOCK_TITLE; ?></td>
		<td><input type="text" name="blcTitle" size="30" value="<?=$rs->fields['blcTitle']?>">*</td>
	</tr>
	<tr>
		<td><?=_BLOCK_POSITION; ?></td>
		<td>
		<input type="hidden" name="blcName" value="<?=$rs->fields['blcName']; ?>">
		<select name="blcPosition">
			<? 
				if ($rs->fields['blcPosition']=='l') {
				    $left="selected";
				} else if ($rs->fields['blcPosition']=='r') {
					$right="selected";
				}  else if ($rs->fields['blcPosition']=='c') {
					$center="selected";
				}  else if ($rs->fields['blcPosition']=='t') {
					$top="selected";
				}  else if ($rs->fields['blcPosition']=='b') {
					$bottom="selected";
				} 
			?>
			<option value="l" <?=$left; ?>><?=_LEFT; ?></option>
			<option value="r" <?=$right; ?>><?=_RIGHT; ?></option>
			<option value="c" <?=$center; ?>><?=_CENTER; ?></option>
			<option value="t" <?=$top; ?>><?=_TOP; ?></option>
			<option value="b" <?=$bottom; ?>><?=_BOTTOM; ?></option>
		</select>
		</td>
	</tr>	
	<?
				break;
			case 'r':
				// like
	?>
	<tr>
		<td><?=_BLOCK_TITLE; ?></td>
		<td><input type="text" name="blcTitle" size="30" value="<?=$rs->fields['blcTitle']?>">*</td>
	</tr>
	<tr>
		<td><?=_BLOCK_URL; ?></td>
		<td><input type="text" name="blcRssUrl" size="50" value="<?=$rs->fields['blcRssUrl']?>">*</td>
	</tr>
	<tr>
		<td><?=_BLOCK_REFRESH; ?></td>
		<td><input type="text" name="blcRssRefesh" size="5" value="<?=$rs->fields['blcRssRefesh']?>"></td>
	</tr>
	<tr>
		<td><?=_BLOCK_POSITION; ?></td>
		<td>
		<select name="blcPosition">
			<? 
				if ($rs->fields['blcPosition']=='l') {
				    $left="selected";
				} else if ($rs->fields['blcPosition']=='r') {
					$right="selected";
				}  else if ($rs->fields['blcPosition']=='c') {
					$center="selected";
				}  else if ($rs->fields['blcPosition']=='t') {
					$top="selected";
				}  else if ($rs->fields['blcPosition']=='b') {
					$bottom="selected";
				} 
			?>
			<option value="l" <?=$left; ?>><?=_LEFT; ?></option>
			<option value="r" <?=$right; ?>><?=_RIGHT; ?></option>
			<option value="c" <?=$center; ?>><?=_CENTER; ?></option>
			<option value="t" <?=$top; ?>><?=_TOP; ?></option>
			<option value="b" <?=$bottom; ?>><?=_BOTTOM; ?></option>
		</select>
		</td>
	</tr>
	<?
				break;
		} // switch
	?>	
	</table>