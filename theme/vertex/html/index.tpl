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
    <td height="60" valign="top"><img src="theme/{$cfgTheme}/images/logo.gif"  /></td>
  </tr>
  <tr>
    <td height="500" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="3">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="100%" valign="top">
        	<!--top -->
	{section name=i loop=$setBlockTop[0]}
	{$setBlockTop[0][i]}
	{/section}
	<!--body -->
	{section name=i loop=$setBlockCenter[0]}
	{$setBlockCenter[0][i]}
	{/section}
	<!--bottom -->
	{section name=i loop=$setBlockBottom[0]}
	{$setBlockBottom[0][i]}
	{/section}
        </td>
        <td valign="top">
        	<!--right -->
	{section name=i loop=$setBlockRight[0]}
	{$setBlockRight[0][i]}
	{/section}
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