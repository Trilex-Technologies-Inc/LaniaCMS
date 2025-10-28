<style type="text/css">
<!--
@import url("theme/<?=$cfg['theme']; ?>/style/dhtml-horiz.css");
-->
</style>
<?
		include_once("include/lanai/class.navigator.php");
		global $db,$tablepre,$sys_lanai;
		$sys_nav=new Navigator();
		$sql="SELECT * FROM ".$tablepre."menu WHERE mnuActive='y'  AND mnuParentId=0 ORDER BY mnuOrder ASC ";
		$rs=$db->execute($sql);
		$num=$rs->recordcount();
		?>
		<ul id="navmenu">
		<?
		while(!$rs->EOF){
				// find real link
				$prelink=$sys_nav->getMenuRealLink($rs);
				?>
					<li><a href="<?=$prelink; ?>" target="<?=$rs->fields['mnuTarget']; ?>"  ><?=$rs->fields['mnuTitle']; ?></a>
				<? 
				// get sub menu
				$sqlsub="SELECT * FROM ".$tablepre."menu WHERE mnuParentId=".$rs->fields['mnuId']." AND mnuActive='y' ORDER BY mnuOrder ASC";
				$rssub=$db->execute($sqlsub);
                if ($rssub->recordcount()>0) {
                    ?><ul><?
				while(!$rssub->EOF){
					// find real link
					$prelink=$sys_nav->getMenuRealLink($rssub);
					?>
						<li><a href="<?=$prelink; ?>" target="<?=$rssub->fields['mnuTarget']; ?>" ><?=$rssub->fields['mnuTitle']; ?></a></li>
					<? 
					$rssub->movenext();
				}
                    ?></ul></li><?
                } else {
                    ?></li><?
                }
			$rs->movenext();
		} // while
		?>
		</ul>
