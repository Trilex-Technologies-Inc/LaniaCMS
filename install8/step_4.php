<?=_SETUP_COPY_CODE; ?> 'config.inc.php'<br/><br/>
<textarea cols="100" rows="15">
&lt;?

    ## Config your database server
    $dbname="<?=$_SESSION['dbname']; ?>";
    $dbhost="<?=$_SESSION['dbhost']; ?>";
    $dbuser="<?=$_SESSION['dbuser']; ?>";
    $dbpw="<?=$_SESSION['dbpw']; ?>";
    $tablepre="<?=$_SESSION['tablepre']; ?>";
    $dbtype="mysql";

    ## Site
    $cfg_title="<?=$_SESSION['cfg_title']; ?>";
    $cfg_footer="&amp;reg; Power by La-Nai Content Management System.<br/><a href=\"http://la-nai.sourceforge.net\" target=\"_blank\">La-Nai</a> is Free Software released under the <a href=\"license.txt\" title=\"GNU/GPL License\" target=\"_blank\">GNU/GPL license</a>.";
    $cfg_url="<?=$_SESSION['cfg_url']; ?>";
    $cfg_datadir="<?=$_SESSION['cfg_dir'].$sys_lanai->getPath()."datacenter"; ?>";
    $cfg_packagedir="<?=$_SESSION['cfg_dir'].$sys_lanai->getPath()."datacenter".$sys_lanai->getPath()."package"; ?>";
    $cfg_dir="<?=$_SESSION['cfg_dir']; ?>";
    $cfg_email="<?=$_SESSION['cfg_email']; ?>";
    $cfg_theme="<?=$_SESSION['cfg_theme']; ?>";

    ## Misc
    $cfg_off="no";
    $cfg_offsettime=<?=$_SESSION['cfg_offsettime']; ?>;
    $cfg_sendmail="<?=$_SESSION['cfg_sendmail']; ?>";
    $cfg_log="no";

    ## smtp
    $cfg_smtp_host="<?=$_SESSION['smtp_host']; ?>";
    $cfg_smtp_port="<?=$_SESSION['smtp_port']; ?>";

    ## Language
    $cfg_lang="<?=$_SESSION['cfg_lang']; ?>";

	## SEO
	$cfg_seo="no";

?&gt;
</textarea>
<br /><br />
<TABLE  ALIGN="right" >
<FORM METHOD="POST" ACTION="<?=$_SERVER['PHP_SELF']; ?>">
<TR>
	<TD ALIGN="RIGHT">
		<INPUT TYPE="hidden" NAME="step" VALUE="<?=($_REQUEST['step']-1)?>">
		<INPUT TYPE="button" VALUE="< <?=_SETUP_BACK; ?>" onClick="javascript:history.back();">
	</TD>
	<TD>
		<INPUT TYPE="hidden" NAME="step" VALUE="<?=($_REQUEST['step']+1)?>">
        <INPUT TYPE="submit" VALUE="<?=_SETUP_VERIFY_CONFIG; ?> >" >
	</TD>
</TR>
</FORM>
</TABLE>