<?php

if (!eregi("setting.php", $_SERVER['PHP_SELF'])) {
		die ("You can't access this file directly...");
}

$objConfig=new SysConfig();
$status=$objConfig->getCurrentStatus();



$objMeta=new Meta();
$objMeta->_table=$cfg['tablepre']."meta";
$objMeta->Load("mtaId=1");

?>
<span class="txtContentTitle"><?=_CFG_SETTING; ?></span><br><br>
<?
	if (!$objConfig->configIsWrite()) {
		$sys_lanai->getErrorBox(_CFG_CANNOT_WRITE);
	} else {
?>
<img src="theme/<?=$cfg['theme']; ?>/images/save.gif" border="0" align="absmiddle"/>
<a href="javascript:document.form.submit();" ><?=_SAVE; ?></a>&nbsp;&nbsp;
<img src="theme/<?=$cfg['theme']; ?>/images/back.gif" border="0" align="absmiddle"/>
<a href="module.php?modname=setting" ><?=_BACK; ?></a><br><br>
<table>
<form name="form" method="post" action="<?=$_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="modname" value="config">
<input type="hidden" name="mf" value="editconfig">
<?
	if ($status=="no") {
		$varno="selected";
	} else {
		$varyes="selected";
	}
?>
<tr>
	<td><?=_CFG_OFFLINE; ?></td>
	<td>
		<select name="cfgStatus">
			<option value="no" <?=$varno; ?>><?=_NO; ?></option>
			<option value="yes" <?=$varyes; ?>><?=_YES; ?></option>
		</select>
	</td>
</tr>
<tr>
	<td><?=_CFG_KEYWORDS; ?></td>
	<td><input type="text" name="mtaKeywords" maxlength="255" size="50" value="<?=$objMeta->mtakeywords; ?>"></td>
</tr>
<tr>
	<td><?=_CFG_DESCRIPTION; ?></td>
	<td><input type="text" name="mtaDescription" maxlength="255" size="50" value="<?=$objMeta->mtadescription; ?>"></td>
</tr>
<tr>
	<td><?=_CFG_ABSTRACT; ?></td>
	<td><input type="text" name="mtaAbstract" maxlength="100" size="50" value="<?=$objMeta->mtaabstract; ?>"></td>
</tr>
<tr>
	<td><?=_CFG_AUTHOR; ?></td>
	<td><input type="text" name="mtaAuthor" maxlength="75" size="50" value="<?=$objMeta->mtaauthor; ?>"></td>
</tr>
<tr>
	<td><?=_CFG_DISTRIBUTION; ?></td>
	<td>
	<?
			if ($objMeta->mtadistribution=="Global") {
				$v1="selected";
			} else if ($objMeta->mtadistribution=="Local") {
				$v2="selected";
			} else {
				$v3="selected";
			}
	?>
		<select name="mtaDistribution">
			<option value="Global" <?=$v1; ?>>Global</option>
			<option value="Local" <?=$v2; ?>>Local</option>
			<option value="Internal Use" <?=$v3; ?>>Internal Use</option>
		</select>
	</td>
</tr>
<tr>
	<td><?=_CFG_COPY; ?></td>
	<td><input type="text" name="mtaCopyright" maxlength="255" size="50" value="<?=$objMeta->mtacopyright; ?>"></td>
</tr>
</form>
</table>
<?
	} // write
?>