<style type="text/css">
<!--
@import url("theme/{$cfgTheme}/style/dhtml-horiz.css");
-->
</style>
<!--[if gte IE 5.5]>
<script language="JavaScript" src="theme/{$cfgTheme}/style/dhtml.js" type="text/JavaScript"></script>
<![endif]-->
<table width="760" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td><img src="theme/{$cfgTheme}/images/logo.gif" /></td>
    <td height="60" ></td>
  </tr>
</table>
<table width="760" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#EEEEEE">
    <!--menu -->
    {include_php file="blocks/bmenu/index.php"}
    </td>
  </tr>
  <tr>
    <td bgcolor="#000000"><img src="theme/{$cfgTheme}/images/middle1.gif"  /></td>
  </tr>
  <tr>
    <td background="theme/{$cfgTheme}/images/bgbar.gif">&nbsp;</td>
  </tr>
</table>

<br />
<table width="760" border="0" cellpadding="5" cellspacing="1">
  <tr>
    <td valign="top" style="padding-left:5px;" height="400">
    <!--body -->
{$setModule}
    </td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
   </tr>
</table>
<br />
<table width="760" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td class="tblLicense">&nbsp;</td>
  </tr>
  <tr>
    <td>
 <!-- footer -->
    <div align="center">
	{$getFooter}
    </div>
</td>
  </tr>
</table>