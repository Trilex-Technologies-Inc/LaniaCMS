<TABLE cellpadding="3" cellspacing="1" WIDTH="100%">
<FORM METHOD="POST" ACTION="<?=$_SERVER['PHP_SELF']; ?>">
<TR>
    <TD colspan="2"><b><?=_SETUP_SITEINFO; ?>:</b><br /></TD>
</TR>
<TR>
	<TD BGCOLOR="#EEEEEE"><?=_SETUP_SITENAME; ?> </TD>
	<TD><INPUT TYPE="text" NAME="cfg_title"  SIZE="40"  VALUE="Lanai Core!" ></TD>
</TR>
<TR>
	<TD BGCOLOR="#EEEEEE"><?=_SETUP_URL; ?> </TD>
	<TD><INPUT TYPE="text" NAME="cfg_url" SIZE="30" VALUE="http://<?=$_SERVER["SERVER_NAME"];  ?>"></TD>
</TR>
<TR>
	<TD BGCOLOR="#EEEEEE"><?=_SETUP_DIR; ?> </TD>
	<TD>
        <INPUT TYPE="text" NAME="cfg_dir" SIZE="60" VALUE="<?=substr(getcwd(),0,(strlen(getcwd())-8)) ;  ?>">
        <input type="hidden" name="cfg_off" value="no">
        <input type="hidden" name="cfg_log" value="yes">
    </TD>
</TR>
<?

    function getLanguage() {
    	if ($handle = opendir("../language/")) {
    		$i=0;
    	   while (false !== ($file = readdir($handle))) {
    	  		//if ($file != "." && $file != ".."  && !is_file($file) && file_exists("language/".$file."/theme.php")) {
    	   		if ($file != "." && $file != ".."  && !is_file($file)) {
    				$arTheme[$i]=$file;
    				$i++;
    			}
    	   }
    	   closedir($handle);
    	}
    	return ($arTheme);
    }

    $langar=getLanguage();

?>
<TR>
	<TD BGCOLOR="#EEEEEE"><?=_SETUP_LANG; ?> </TD>
	<TD>
        <select name="cfg_lang" size="1">
<?
    foreach ($langar as $value) {
      $xvalue=substr($value,5,strlen($value));
      $xvalue=substr($xvalue,0,strlen($xvalue)-4);
?>
        <option value="<?=$xvalue; ?>" selected="selected"><?=ucwords($xvalue); ?></option>
<?
    }
?>
        </select>
    </TD>
</TR>
<TR>
	<TD BGCOLOR="#EEEEEE"><?=_SETUP_THEME; ?> </TD>
	<TD>
        <select name="cfg_theme" size="1">
        <option value="vertex" selected="selected">Default</option>
        </select>
    </TD>
</TR>
<TR>
	<TD BGCOLOR="#EEEEEE"><?=_SETUP_TIMEZONE; ?> </TD>
	<TD>
        <select name="cfg_offsettime" size="1">
        <?
            for ($i=0;$i<26;$i++) {
                $isx=($i-12);
                if ($isx==7) {
                    $select="selected";
                } else {
                    $select="";
                }
                if ($isx>0){
                    $isx="+".$isx;
                }

                ?><option value="<?=($i-12); ?>" <?=$select; ?>><?=$isx; ?></option><?
            }
        ?>

        </select>
    </TD>
</TR>
<TR>
    <TD colspan="2"><br /><b><?=_SETUP_ADMININFO; ?>:</b><br /></TD>
</TR>
<TR>
	<TD BGCOLOR="#EEEEEE"><?=_SETUP_USERNAME; ?> </TD>
	<TD><INPUT TYPE="text" NAME="username" VALUE="admin"></TD>
</TR>
<TR>
	<TD BGCOLOR="#EEEEEE"><?=_SETUP_PASSWORD; ?> </TD>
<?
	$pwdarr=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
					'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
					'1','2','3','4','5','6','7','8','9','0');
	for ($i=0;$i<6;$i++) {
		$pwsstr.=$pwdarr[rand(0,62)];
	}
?>
	<TD><INPUT TYPE="text" NAME="password" VALUE="<?=$pwsstr; ?>"></TD>
</TR>
<TR>
	<TD BGCOLOR="#EEEEEE"><?=_SETUP_EMAIL; ?> </TD>
	<TD><INPUT TYPE="text" NAME="cfg_email" SIZE="30"  VALUE="admin@<?=$_SERVER["SERVER_NAME"];  ?>"></TD>
</TR>
<TR>
    <TD colspan="2"><br /><b><?=_SETUP_DATABASEINFO; ?>:</b><br /></TD>
</TR>
<TR>
	<TD BGCOLOR="#EEEEEE"><?=_SETUP_DB; ?> </TD>
	<TD>MySQL<input type="hidden" name="dbtype" value="mysql"></TD>
</TR>
<TR>
	<TD BGCOLOR="#EEEEEE"><?=_SETUP_DBHOST; ?> </TD>
	<TD><INPUT TYPE="text" NAME="dbhost" VALUE="localhost"></TD>
</TR>
<TR>
	<TD BGCOLOR="#EEEEEE"><?=_SETUP_DBUSER; ?> </TD>
	<TD><INPUT TYPE="text" NAME="dbuser" VALUE="root"></TD>
</TR>
<TR>
	<TD BGCOLOR="#EEEEEE"><?=_SETUP_DBPWD; ?> </TD>
	<TD><INPUT TYPE="text" NAME="dbpw" VALUE=""></TD>
</TR>
<TR>
	<TD BGCOLOR="#EEEEEE"><?=_SETUP_DBNAME; ?> </TD>
	<TD><INPUT TYPE="text" NAME="dbname" VALUE="lanaicore"></TD>
</TR>
<TR>
	<TD BGCOLOR="#EEEEEE"><?=_SETUP_TABLEPRE; ?> </TD>
	<TD><INPUT TYPE="text" NAME="tablepre" VALUE="tbl_ln_"></TD>
</TR>
<TR>
    <TD colspan="2"><br /><b><?=_SETUP_MAILINFO; ?>: </b><br /></TD>
</TR>
<TR>
	<TD BGCOLOR="#EEEEEE"><?=_SETUP_SMHOST; ?> </TD>
	<TD><INPUT TYPE="text" NAME="smtp_host" VALUE="localhost"></TD>
</TR>
<TR>
	<TD BGCOLOR="#EEEEEE"><?=_SETUP_SMPORT; ?> </TD>
	<TD><INPUT TYPE="text" NAME="smtp_port" VALUE="25"></TD>
</TR>
<TR>
	<TD BGCOLOR="#EEEEEE"><?=_SETUP_SNT2ADMIN; ?> </TD>
	<TD>
    <input type="radio" name="cfg_sendmail" value="yes" checked/> <?=_SETUP_YES; ?>
    <input type="radio" name="cfg_sendmail" value="no"/> <?=_SETUP_NO; ?>
    </TD>
</TR>
</TABLE>
<br />
<TABLE  ALIGN="right" >
<TR>
	<TD ALIGN="RIGHT">
		<INPUT TYPE="hidden" NAME="step" VALUE="<?=($_REQUEST['step']-1)?>">
		<INPUT TYPE="button" VALUE="< <?=_SETUP_BACK; ?>" onClick="javascript:history.back();">
	</TD>
	<TD>
		<INPUT TYPE="hidden" NAME="step" VALUE="<?=($_REQUEST['step']+1)?>">
        <INPUT TYPE="submit" VALUE="<?=_SETUP_CREATE_TABLE; ?> >" >

	</TD>
</TR>
</FORM>
</TABLE>
