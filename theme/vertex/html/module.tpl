<style type="text/css">
<!--
@import url("theme/{$cfgTheme}/style/dhtml-horiz.css");
-->
</style>
<!--[if gte IE 5.5]>
<script language="JavaScript" src="theme/{$cfgTheme}/style/dhtml.js" type="text/JavaScript"></script>
<![endif]-->
<table width="955" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="36" class="txtLicense" >{include_php file="theme/vertex/block/login.inc.php"}</td>
  </tr>
  <tr>
    <td height="36">
            <!--menu -->
        {include_php file="blocks/bmenu/index.php"}
    </td>
  </tr>
  <tr>
    <td height="60" valign="top"><img src="theme/{$cfgTheme}/images/logo.gif" /></td>
  </tr>
  <tr>
    <td height="500" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="3">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="100%" valign="top">
	<!--body -->
	{$setModule}
        </td>
        <td valign="top">
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="license"><div align="center">Copyright &copy; 2009 RedLine Software. All Rights Reserved. </div></td>
  </tr>
</table>