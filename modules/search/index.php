<?
	$obsearch=new LanaiSeach();
	$schemaarr=$obsearch->loadSchema();
	$ssm=array();
	$ssi=array();
	foreach ($schemaarr as $val) {
		$valitm=split("#",$val);
		array_push($ssi,$valitm[0]);
		array_push($ssm,$valitm[1]);
	}
/*	print_r($ssi);
	print_r($ssm);*/
?>
<span class="txtContentTitle"><?=_SEARCH_LANAI; ?></span><br><br>
<?=_SEARCH_LANAI_INSTRUCTION; ?><br><br>
<table>
<form action="module.php" method="get">
<input type="hidden" name="modname" value="search" >
<tr>
<td><?=_SEARCH_KEYWORD; ?></td>
<td>
<input type="text" id="keyword" name="keyword" size="60" value="<?=$_REQUEST['keyword']; ?>">
<input type="submit" value="<?=_SEARCH; ?>" class="inputButton">
</td>
</tr>
<tr>
<td><?=_SEARCH_ITEM; ?></td>
<td>
<select name="item">
<?
	for ($i=0;$i<(count($ssi));$i++) {
		if ($ssi[$i]==$_REQUEST['item']) { 
			$sel="selected"; 
		} else {
			$sel=""; 
		} 
?><option value="<?=$ssi[$i]; ?>" <?=$sel; ?>><?=$SEARCH_LANG[$ssi[$i]]; ?></option><?	
	}
?>
</select>
<input type="radio" name="method" value="word"  ><?=_SEARCH_WORD; ?>
<input type="radio" name="method" value="phase" checked><?=_SEARCH_PHASE; ?>
</td>
</tr>
</table>
<br><br>
<?

if (!empty($_REQUEST['keyword'])) {
	$sql=$obsearch->getSchema($_REQUEST['item']);
	$sql=ereg_replace("%tablepre%",$cfg['tablepre'],$sql);
	if ($_REQUEST['method']=="phase") {
		$sql=ereg_replace("%keyword%","%".trim($_REQUEST['keyword'])."%",$sql);
	} else {
		$sql=ereg_replace("%keyword%",trim($_REQUEST['keyword']),$sql);
	}
 
	$pager=new SearchPage($db,$sql,30);
	$pager->item=$_REQUEST['item'];
	$pager->link="module.php?modname=search&keyword=".$_REQUEST['keyword']."&item=".$_REQUEST['item']."&method=".$_REQUEST['method']."&";
	$pager->renderPage();
}

?>