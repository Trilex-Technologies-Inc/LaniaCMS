<?
	if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
			die ("You can't access this file directly...");
	}
	
	$module_name = basename(dirname(__FILE__));
	$modfunction="modules/$module_name/module.php";
	include_once($modfunction);
	
	$poll = new Poll();
	$rsPoll=$poll->getPoll();
?>
	<script language="JavaScript" type="text/JavaScript">
	<!--
	function MM_jumpMenu(targ,selObj,restore){ //v3.0
	  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
	  if (restore) selObj.selectedIndex=0;
	}
	//-->
	</script>
	<span class="txtContentTitle"><?=_POLL; ?></span><br/><br/>
	<table cellpadding="3" cellspacing="1" border="0">
	<form name="form1" id="form1">
	<tr>
		<td><?=_POLL_SELECT; ?></td>
		<td>
		  <select name="menu1" onchange="MM_jumpMenu('parent',this,0)">
		  <option><?=_POLL_SELECT_TOPIC; ?></option>
		<?
			while(!$rsPoll->EOF){			
		?>
		    <option value="<?=$_SERVER['PHP_SELF']; ?>?modname=<?=$module_name; ?>&mid=<?=$rsPoll->fields['pllId']; ?>"><?=$rsPoll->fields['pllTitle']; ?></option>
		<?
				$rsPoll->moveNext();
			} // while
		?>
		  </select>
	  	</td>
	</tr>
	</form>
	</table>
	<br/>
<?
	if (($_REQUEST['mid']!="") OR ($_REQUEST['mid']!=0)) {
		$rsPollItem=$poll->getPollItemById($_REQUEST['mid']);
?>
	<table cellpadding="5" cellspacing="1" border="0">
	<tr>
		<td colspan="3">
			<span class="txtContentTitle"><?=_POLL_RESULT." : ".$rsPollItem->fields['pllTitle']; ?></span>
		</td>
	<tr>
	<? 	
		$rsPollOptionItem=$poll->getPollOptionItemShow($_REQUEST['mid']);
		$total=$poll->getVoteTotal($_REQUEST['mid']);
		if ($total==0) { $totalx=1; } else { $totalx=$total;  }
		while(!$rsPollOptionItem->EOF){
		?>
		<tr>
			<td>&nbsp;&nbsp;<?=$rsPollOptionItem->fields['ppoTitle']; ?></td>
			<td><img src="modules/poll/images/bar.gif" border="1" height="12" style="border-color:gray; " width="<?=(($rsPollOptionItem->fields['ppoScore']/$totalx)*400); ?>"></td>
			<td><?=sprintf("%0.2f",(($rsPollOptionItem->fields['ppoScore']/$totalx)*100))." % "; ?>(<?=$rsPollOptionItem->fields['ppoScore']; ?>)</td>
		</tr>
		<?
			$rsPollOptionItem->moveNext();
		} // while
	?>
	<tr>
		<td colspan="3">
			<span class="txtContentTitle"><?=_POLL_TOTAL." : ".$total; ?></span>
		</td>
	<tr>
	</table>
<?
	}
	
?>