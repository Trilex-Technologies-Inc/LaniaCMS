<?php

if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
		die ("You can't access this file directly...");
}

?>
<table>
<form name="addform" method="get" action="module.php">
<input type="hidden" name="modname" value="%MODULE%">
<input type="hidden" name="mf" value="add">
<input type="hidden" name="ac" value="add">
%FORMFIELDS%<tr><td>&nbsp;</td><td><input type="submit" value="<?=_SAVE; ?>" >&nbsp;<input type="reset" value="<?=_RESET; ?>"></td></tr>
</form>
</table>
<?php
if ($_REQUEST['ac']=="add") {
$obj%CLASS%=new %CLASS%();
%OBJFIELDS%
$result=$obj%CLASS%->save();
if (!$result) $sys_lanai->getErrorBox($obj%CLASS%->ErrorMsg());
}
?>