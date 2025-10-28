<?php

if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
		die ("You can't access this file directly...");
}

/* load data to delete */
$obj%CLASS%=new %CLASS%();
$rs=$obj%CLASS%->Load("%PRIKEY%=".$_REQUEST['i']);
if (!$rs) {
	/* no data to delete - show error message*/
	$sys_lanai->getErrorBox("Data not found!");
}  else {
	/* perform delete */
	$obj%CLASS%->delete();
}
?>