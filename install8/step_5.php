<?=_SETUP_CHECK_CONFIG; ?>
<?
    if (file_exists("../config.inc.php"))  {
        $cfg=true;
        ?><?=$title."&nbsp;&nbsp;["; ?><span style="color:green;"><?=_SETUP_OK; ?></span>]<?
    } else {
        $cfg=false;
        ?><?=$title."&nbsp;&nbsp;["; ?><span style="color:red;"><?=_SETUP_FAILD; ?></span>]<?
    }
?>
<br /><br />
<TABLE  ALIGN="right" >
<FORM METHOD="POST" ACTION="<?=$_SERVER['PHP_SELF']; ?>">
<TR>
	<TD ALIGN="RIGHT">
		<INPUT TYPE="hidden" NAME="step" VALUE="<?=($_REQUEST['step']-1)?>">
		<INPUT TYPE="button" VALUE="< <?=_SETUP_BACK; ?>" onClick="javascript:history.back();">
	</TD>
    <?
        if ($cfg) {
    ?>
	<TD>
		<INPUT TYPE="hidden" NAME="step" VALUE="<?=($_REQUEST['step']+1)?>">
        <INPUT TYPE="submit" VALUE="<?=_SETUP_CLEANUP; ?> >" >
	</TD>
    <?
        } // check config file
    ?>
</TR>
</FORM>
</TABLE>
