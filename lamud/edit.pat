<?php

if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
		die ("You can't access this file directly...");
}

/* load data to edit */
$obj%CLASS%=new %CLASS%();
$rs=$obj%CLASS%->Load("%PRIKEY%=".$_REQUEST['i']);
if (!$rs) {
	/* no data to edit - show error message*/
	$sys_lanai->getErrorBox("Data not found!");
}  else {
	if ($_REQUEST['ac']=="edit") {
		%OBJFIELDS%
		$result =$obj%CLASS%->save();
		if (!$result) $sys_lanai->getErrorBox($obj%CLASS%->ErrorMsg());
	} else {
	/* found data then fill in form */
?>
	<table>
	<form name="addform" method="get" action="module.php">
	<input type="hidden" name="modname" value="%MODULE%">
	<input type="hidden" name="mf" value="edit">
	<input type="hidden" name="ac" value="edit">
	<input type="hidden" name="i" value="<?=$_REQUEST['i']; ?>">
	%FORMFIELDS%
	<tr><td>&nbsp;</td><td><input type="submit" value="<?=_SAVE; ?>" >&nbsp;<input type="reset" value="<?=_RESET; ?>"></td></tr>
	</form>
	</table>
<?
	} // edit action
} // data found
?>