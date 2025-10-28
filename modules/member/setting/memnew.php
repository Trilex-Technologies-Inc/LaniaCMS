<?

	if ( !eregi( "setting.php", $_SERVER['PHP_SELF'] ) ) {
	    die ( "You can't access this file directly..." );
	} 
	
	$module_name = basename( dirname( substr( __FILE__, 0, strlen( dirname( __FILE__ ) ) ) ) );
	$modfunction = "modules/$module_name/module.php";
	include_once( $modfunction ); 
		
	$member=new User();
	
	?><span class="txtContentTitle"><?=_MEMBER_NEW; ?></span><br/><br/>
	<?=_MEMBER_NEW_INSTRUCTION; ?><br/><br/>
	
	<img src="theme/<?=$cfg['theme']; ?>/images/save.gif" border="0" align="absmiddle"/>
	<a href="#" onClick="javascript:document.form.submit();"><?=_SAVE; ?></a>&nbsp;&nbsp; 
	
	<img src="theme/<?=$cfg['theme']; ?>/images/back.gif" border="0" align="absmiddle"/>
	<a href="#" onClick="javascript:history.back();" ><?=_BACK; ?></a>
	<br><br>
	
	<table border="0" cellspacing="2" cellpadding="3">
	<form name="form" method="post"  action="<?=$_SERVER['PHP_SELF']; ?>"  ENCTYPE="multipart/form-data" >
	<input type="hidden" name="mf" value="memedit">
	<input type="hidden" name="modname" value="<?=$module_name; ?>">
	<input type="hidden" name="ac" value="new">
	<tr>
		<td><?=_USER_FNAME; ?></td>
		<td><input type="text" name="userFname">*</td>
	</tr>
	<tr>
		<td><?=_USER_LNAME; ?></td>
		<td><input type="text" name="userLname">*</td>
	</tr>
	<tr>
		<td><?=_USER_ADDRESS1; ?></td>
		<td><input type="text" name="userAddress1" size="40"></td>
	</tr>
	<tr>
		<td><?=_USER_ADDRESS2; ?></td>
		<td><input type="text" name="userAddress2" size="40"></td>
	</tr>
	<tr>
		<td><?=_USER_CITY; ?></td>
		<td><input type="text" name="userCity"></td>
	</tr>
	<tr>
		<td><?=_USER_STATE; ?></td>
		<td><input type="text" name="userState"></td>
	</tr>
	<tr>
		<td><?=_USER_COUNTRY; ?></td>
		<td><?=$member->setCountryCombo($rs->fields['cntId'],"cntId"); ?></td>
	</tr>
	<tr>
		<td><?=_USER_ZIPCODE; ?></td>
		<td><input type="text" name="userZipcode"></td>
	</tr>
	<tr>
		<td><?=_USER_PHONE; ?></td>
		<td><input type="text" name="userPhone"></td>
	</tr>
	<tr>
		<td><?=_USER_FAX; ?></td>
		<td><input type="text" name="userFax"></td>
	</tr>
	<tr>
		<td><?=_USER_MOBILE; ?></td>
		<td><input type="text" name="userMobile"></td>
	</tr>
	<tr>
		<td><?=_USER_EMAIL; ?></td>
		<td><input type="text" name="userEmail">*</td>
	</tr>
	<tr>
		<td><?=_USER_URL; ?></td>
		<td><input type="text" name="userURL"></td>
	</tr>
	
	<tr>
		<td><?=_USER_LOGIN; ?></td>
		<td><input type="text" name="userLogin">*</td>
	</tr>
	<tr>
		<td><?=_USER_PASSWORD; ?></td>
		<td><input type="password" name="userPassword1" value="">*</td>
	</tr>
	<tr>
		<td><?=_USER_RE_PASSWORD; ?></td>
		<td><input type="password" name="userPassword2" value="">*</td>
	</tr>	
	<tr>
		<td><?=_USER_PRIVILEGE; ?></td>
		<td>
			<select name="userPrivilege">
				<option value="u"><?=_USER; ?></option>
				<option value="a"><?=_ADMIN; ?></option>
			</select>
		</td>
	</tr>
	<? 
		if (is_writable($cfg['datadir'].$sys_lanai->getPath()."uimage")) {
	?>
	<tr>
		<td><?=_USER_AVATAR; ?></td>
		<td><input type="file" name="userAvatar"></td>
	</tr>
	<?
		}
	?>
	</form>
	</table>
<?

?>