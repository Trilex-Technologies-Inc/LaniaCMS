<?
	if (!eregi("setting.php", $_SERVER['PHP_SELF'])) {
			die ("You can't access this file directly...");
	}
	
	include_once('modules/member/module.php');
	$mem_lanai=new user();
	
	$module_name = basename(dirname(__FILE__));
	$modfunction="modules/$module_name/module.php";
	include_once($modfunction);
	
	//if ($mem_lanai->getUserPrivilege($_SESSION['uid'])=="a") {
	
		$set_lanai=new setting();	
		// set setting menu	
		$rs=$set_lanai->getModuleSettingByPrivilege($mem_lanai->getUserPrivilege($_SESSION['uid']));	
		
		if (!$sys_lanai->isUserLogin()) {
		    $sys_lanai->getErrorBox(_REQUIRE_LOGIN);
		} else {
		?>
		<span class="txtContentTitle"><?=_SITE_SETTING; ?></span><br/><br/>
		<table cellpadding="3"  width="60%">
		<?
		global $cfg;
		
		$ix=0;
	 	for ($i=0;$i<(ceil(($rs->recordcount())/2));$i++) {
		?><tr><?
			for ($j=0;$j<2;$j++) {
				if (!$rs->EOF) {
				?>
				<td>
				<table border="0">
				<tr>
				<td >
				<?	
					if (file_exists($cfg['dir'] . $sys_lanai->getPath()."theme/".$cfg['theme']."/images/setting_".$rs->fields['modName'].".gif")) {
					?><img src="theme/<?=$cfg['theme'];?>/images/setting_<?=$rs->fields['modName']; ?>.gif" border="0"><?
					} else {
					?><img src="theme/<?=$cfg['theme'];?>/images/configure.gif" border="0"><?
					}
				?> 
				</td>

				<td align="center"><a href="setting.php?modname=<?=$rs->fields['modName']; ?>"><?=_SETTING; ?> <?=ucwords($rs->fields['modTitle']); ?></a></td>
				</tr>
				</table>
				<?
				}
				$rs->movenext();
			}			
		?></tr><?
		}
		
		//} else {
		//	$sys_lanai->getErrorBox(_CANNOT_ACCESS);
		//}
		?>
		</table>
		<?
		}
?>
<br><br><br><br>