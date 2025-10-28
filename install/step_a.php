<?
    if (!empty($_REQUEST['set'])) {
        $_SESSION['lang']=$_REQUEST['set'];
    ?>
        <script language="JavaScript" type="text/javascript">
        /*<![CDATA[*/
                location.href="index.php";
        /*]]>*/
        </script>
    <?
    }
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<?
    function getLanguage() {
    	if ($handle = opendir('language/')) {
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
<form name="form1">
<?=_SETUP_SELECT_LANGUAGE; ?>
  <select name="menu1" onChange="MM_jumpMenu('parent',this,0)">
<?
    foreach ($langar as $value) {
      $xvalue=substr($value,5,strlen($value));
      $xvalue=substr($xvalue,0,strlen($xvalue)-4);
      if ($_SESSION['lang']==$xvalue) {
          $selected="selected";
      } else {
      	  $selected="";
      }
?>
    <option value="index.php?set=<?=$xvalue; ?>" <?=$selected; ?>><?=ucwords($xvalue); ?></option>
<?
    }
?>
  </select>
</form>
<FORM METHOD=POST ACTION="<?=$_SERVER['PHP_SELF']; ?>">
<INPUT TYPE="hidden" NAME="step" VALUE="b">
<DIV ALIGN="right"><INPUT TYPE="submit" VALUE="<?=_SETUP_LICENSE_AGREEMENT; ?> >" ></DIV>
</FORM>
