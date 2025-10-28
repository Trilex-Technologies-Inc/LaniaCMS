<?php
  
/**
	 * MenuPager
	 * 
	 * @package 
	 * @author Administrator
	 * @copyright Copyright (c) 2006
	 * @version $Id: class.MenuPager.php,v 1.2 2007/06/30 14:13:44 redlinesoft Exp $
	 * @access public
	 **/
	class MenuPager extends ADODB_Pager {
	
		function MenuPager(&$db,$sql,$id = 'adodb', $showPageLinks = false){
			ADODB_Pager::ADODB_Pager($db,$sql,$id = 'adodb', $showPageLinks = false);
			$this->page=_PAGE;
		}
		
		function RenderLayout($header,$grid,$footer)
		{
			echo "<table width=\"100%\" ><tr><td>",
				 "</td></tr><tr><td>",
					$grid,
				"</td></tr><tr><td>",
					$footer," ",$header,
				"</td></tr></table>";
		}
		
		//---------------------------
		// Display link to first page
		function Render_First($anchor=true)
		{
			global $PHP_SELF;
			if ($anchor) {
			?>
				<a href="<?php echo $PHP_SELF,'?modname=',$_REQUEST['modname'],'&mf=',$_REQUEST['mf'],'&',$this->id;?>_next_page=1"><?php echo $this->first;?></a> &nbsp; 
			<?php
			} else {
				print "$this->first &nbsp; ";
			}
		}
		
		//--------------------------
		// Display link to next page
		function render_next($anchor=true)
		{
			global $PHP_SELF;
		
			if ($anchor) {
			?>
			<a href="<?php echo $PHP_SELF,'?modname=',$_REQUEST['modname'],'&mf=',$_REQUEST['mf'],'&',$this->id,'_next_page=',$this->rs->AbsolutePage() + 1 ?>"><?php echo $this->next;?></a> &nbsp; 
			<?php
			} else {
				print "$this->next &nbsp; ";
			}
		}
		
		//------------------
		// Link to last page
		
		function render_last($anchor=true)
		{
			global $PHP_SELF;
		
			if (!$this->db->pageExecuteCountRows) return;
			
			if ($anchor) {
			?>
				<a href="<?php echo $PHP_SELF,'?modname=',$_REQUEST['modname'],'&mf=',$_REQUEST['mf'],'&',$this->id,'_next_page=',$this->rs->LastPageNo() ?>"><?php echo $this->last;?></a> &nbsp; 
			<?php
			} else {
				print "$this->last &nbsp; ";
			}
		}
		
		// Link to previous page
		function render_prev($anchor=true)
		{
			global $PHP_SELF;
			if ($anchor) {
			?>
				<a href="<?php echo $PHP_SELF,'?modname=',$_REQUEST['modname'],'&mf=',$_REQUEST['mf'],'&',$this->id,'_next_page=',$this->rs->AbsolutePage() - 1 ?>"><?php echo $this->prev;?></a> &nbsp; 
			<?php 
			} else {
				print "$this->prev &nbsp; ";
			}
		}
		
		//--------------------------------------------------------
		// Simply rendering of grid. You should override this for
		// better control over the format of the grid
		//
		// We use output buffering to keep code clean and readable.
		function RenderGrid()
		{
			//global $gSQLBlockRows; // used by rs2html to indicate how many rows to display
			//include_once(ADODB_DIR.'/tohtml.inc.php');
			ob_start();
			$gSQLBlockRows = $this->rows;
			//rs2html($this->rs,$this->gridAttributes,$this->gridHeader,$this->htmlSpecialChars);
			$mod_lanai=new Menu();
			?>
			<script language="javascript" type="text/javascript"> 
		
			function selectall(obj) { 
				var checkBoxes = document.getElementsByTagName('input'); 
				for (i = 0; i < checkBoxes.length; i++) { 
					if (obj.checked == true) { 
						checkBoxes[i].checked = true; // this checks all the boxes 
					} else { 
						checkBoxes[i].checked = false; // this unchecks all the boxes 
					} 
				} 
			} 
			
			</script> 
			<table cellpadding="3" cellspacing="1" width="100%">
			<form name="form" method="post" action="<?=$_SERVER['PHP_SELF']?>">
			<input type="hidden" name="modname" value="menu">
			<input type="hidden" name="mf" value="mnuedit">
			<input type="hidden" name="ac" value="">
			<tr>
				<th class="tblRowSolidTopDown"  align="center"><input type="checkbox" value="select_all" onclick="selectall(this);" class="radioButton" /></th>
				<th class="tblRowSolidTopDown" width="50%"><?=_MENU_TITLE; ?></th>
				<th class="tblRowSolidTopDown" width="10%"><?=_MENU_PARENT; ?></th>
				<th class="tblRowSolidTopDown" width="10%"><?=_MENU_TYPE; ?></th>
				<th class="tblRowSolidTopDown"><?=_WEIGHT; ?></th>
				<th class="tblRowSolidTopDown"><?=_ORDER; ?></th>
				<th class="tblRowSolidTopDown"><?=_ACTIVE; ?></th>
				<th class="tblRowSolidTopDown"><?=_EDIT; ?></th>
			</tr>
			<?
			$rownum=1;
			while(!$this->rs->EOF){			
			?>
			<tr>
				<td class="tblRowDash" align="center">
					<input type="checkbox" name="mid[]"  value="<?=$this->rs->fields['mnuId']; ?>"  class="radioButton" />
				</td>
				<td class="tblRowDash">
					<img src="theme/<?=$mod_lanai->cfg['theme'];?>/images/file.gif" border="0" align="absmiddle">
					<?=$this->rs->fields['mnuTitle']; ?>
				</td>
				<td class="tblRowDash">				
					<? 
						$rs=$mod_lanai->getMenuById($this->rs->fields['mnuParentId']); 
						if (($rs->recordcount())>0) {
						    ?><?=$rs->fields['mnuTitle']; ?><?
						} else {
						    ?><?=_MENU_NONE; ?><?
						}
					?>					
				</td>
				<td class="tblRowDash" align="center">				
					<?=strtoupper($this->rs->fields['mnuType']); ?>
				</td>
				<td class="tblRowDash" align="center">				
					<input type="text" name="mnuOrder[]" value="<?=$this->rs->fields['mnuOrder']; ?>" size="1" maxlength="2" >
					<input type="hidden" name="mnuOrderId[]" value="<?=$this->rs->fields['mnuId']; ?>">
				</td>
				<td class="tblRowDash">				
				<?
					if ($rownum==1) {
					    ?>
						<a href="<?=$_SERVER['PHP_SELF']."?modname=".$_REQUEST['modname']; ?>">
						<img src="theme/<?=$mod_lanai->cfg['theme'];?>/images/space.gif" width="22" border="0" align="absmiddle">
						</a>
						<a href="<?=$_SERVER['PHP_SELF']."?modname=".$_REQUEST['modname']; ?>&mf=mnuedit&ac=order&v=dn&mid=<?=$this->rs->fields['mnuId']; ?>">
						<img src="theme/<?=$mod_lanai->cfg['theme'];?>/images/downarrow.gif" border="0" align="absmiddle">
						</a>
						<?
					} else if ($rownum==$this->rs->recordcount()) {
					    ?>
						<a href="<?=$_SERVER['PHP_SELF']."?modname=".$_REQUEST['modname']; ?>&mf=mnuedit&ac=order&v=up&mid=<?=$this->rs->fields['mnuId']; ?>">
						<img src="theme/<?=$mod_lanai->cfg['theme'];?>/images/uparrow.gif" width="22" border="0" align="absmiddle">
						</a>
						<a href="<?=$_SERVER['PHP_SELF']."?modname=".$_REQUEST['modname']; ?>">
						<img src="theme/<?=$mod_lanai->cfg['theme'];?>/images/space.gif" border="0" align="absmiddle">
						</a>
						<?
					} else {
						?>
						<a href="<?=$_SERVER['PHP_SELF']."?modname=".$_REQUEST['modname']; ?>&mf=mnuedit&ac=order&v=up&mid=<?=$this->rs->fields['mnuId']; ?>">
						<img src="theme/<?=$mod_lanai->cfg['theme'];?>/images/uparrow.gif" width="22" border="0" align="absmiddle">
						</a>
						<a href="<?=$_SERVER['PHP_SELF']."?modname=".$_REQUEST['modname']; ?>&mf=mnuedit&ac=order&v=dn&mid=<?=$this->rs->fields['mnuId']; ?>">
						<img src="theme/<?=$mod_lanai->cfg['theme'];?>/images/downarrow.gif" border="0" align="absmiddle">
						</a>
						<?
					}
				?>	
				</td>				
				<td class="tblRowDash" align="center">
				<?
					if ($this->rs->fields['mnuActive']=='y') {
					    ?>
						<a href="<?=$_SERVER['PHP_SELF']."?modname=".$_REQUEST['modname']; ?>&mf=mnuedit&v=n&ac=active&mid=<?=$this->rs->fields['mnuId']; ?>">
						<img src="theme/<?=$mod_lanai->cfg['theme'];?>/images/ok.gif" border="0" align="absmiddle">
						</a>
						<?
					} else {
						?>
						<a href="<?=$_SERVER['PHP_SELF']."?modname=".$_REQUEST['modname']; ?>&mf=mnuedit&v=y&ac=active&mid=<?=$this->rs->fields['mnuId']; ?>">
						<img src="theme/<?=$mod_lanai->cfg['theme'];?>/images/cancel.gif" border="0" align="absmiddle">
						</a>
						<?
					}
				?>					
				</td>
				<td class="tblRowDash" align="center">
					<?
						if ($this->rs->fields['mnuType']=="l") {
						    $link="&m=l";
						} else if ($this->rs->fields['mnuType']=="m") {
						    $link="&m=m";
						} else if ($this->rs->fields['mnuType']=="c") {
						    $link="&m=c";
						}
					?>
					<a href="<?=$_SERVER['PHP_SELF']."?modname=".$_REQUEST['modname']; ?>&mf=mnueditform&mid=<?=$this->rs->fields['mnuId']; ?>&conId=<?=$this->rs->fields['conId']; ?><?=$link; ?>">
					<img src="theme/<?=$mod_lanai->cfg['theme'];?>/images/edit.gif" border="0" align="absmiddle">
					</a>
				</td>				
			</tr>
			<?
				$rownum++;
				$this->rs->movenext();
			} // while{
			?></table><?
			$s = ob_get_contents();
			ob_end_clean();
			return $s;
		}
		
	}
  
?>