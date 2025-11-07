<?=_SETUP_CHANGEPMSS; ?>
<UL>
	<LI>config.inc.php - 
	<?
			if (is_writable("../config.inc.php")) {
					?>[ <span style="color:green;"><?=_SETUP_WRITEABLE; ?></span> ]<?
			} else {
					?>[ <span style="color:red;"><?=_SETUP_CREATE_LATER; ?></span> ]<?
			}
	?>
	</LI>
	<LI>/blocks - 
	<?
			if (is_writable("../blocks")) {
					$d1=true;
					?>[ <span style="color:green;"><?=_SETUP_WRITEABLE; ?></span> ]<?
			} else {
					$d1=false;
					?>[ <span style="color:red;"><?=_SETUP_CANNOTWRITE; ?></span> ]<?
			}
	?>
	</LI>
	<LI>/modules - 
	<?
			if (is_writable("../modules")) {
					$d2=true;
					?>[ <span style="color:green;"><?=_SETUP_WRITEABLE; ?></span> ]<?
			} else {
					$d2=false;
					?>[ <span style="color:red;"><?=_SETUP_CANNOTWRITE; ?></span> ]<?
			}
	?>
	</LI>
	<LI>/theme - 
	<?
			if (is_writable("../theme")) {
					$d3=true;
					?>[ <span style="color:green;"><?=_SETUP_WRITEABLE; ?></span> ]<?
			} else {
					$d3=false;
					?>[ <span style="color:red;"><?=_SETUP_CANNOTWRITE; ?></span> ]<?
			}
	?>
	</LI>
	<LI>/datacenter - 
	<?
			if (is_writable("../datacenter")) {
					$d4=true;
					?>[ <span style="color:green;"><?=_SETUP_WRITEABLE; ?></span> ]<?
			} else {
					$d4=false;
					?>[ <span style="color:red;"><?=_SETUP_CANNOTWRITE; ?></span> ]<?
			}
	?>
	</LI>
</UL>
<TABLE  ALIGN="right" >
<TR>
	<TD ALIGN="RIGHT">
	<FORM METHOD="GET" ACTION="<?=$_SERVER['PHP_SELF']; ?>">
		<INPUT TYPE="hidden" NAME="step" VALUE="b">
		<INPUT TYPE="submit" VALUE="< <?=_SETUP_BACK; ?>" >
	</FORM>
	</TD>
	<TD>
		<FORM METHOD="GET" ACTION="<?=$_SERVER['PHP_SELF']; ?>">
		<INPUT TYPE="hidden" NAME="step" VALUE="2">
		<?
			if ($d1 AND $d2 AND $d3 AND $d4)  {
				?><INPUT TYPE="submit" VALUE="<?=_SETUP_CONFIG; ?> >" ><?
			}
		?>
	</FORM>
	</TD>
</TR>
</TABLE>
