
<?php
include('../pclzip.lib.php');
$archive = new PclZip('temp/putty.zip');
if ($archive->extract(PCLZIP_OPT_PATH, '/home/raziel/public_html/osp04/include/pclzip/example/extract/')){
die("Error : ".$archive->errorInfo(true));
}
?>