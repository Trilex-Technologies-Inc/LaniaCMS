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
    <td height="60" >	</td>
  </tr>
</table>
<table width="760"  border="0" cellpadding="0" cellspacing="0">
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
    <td valign="top" style="padding-left:15px;">
    <!--body -->
     	{section name=i loop=$setBlockCenter[0]}
		{$setBlockCenter[0][i]}
		<br/><br/>
	{/section}
    </td>
    <td height="400" valign="top"  style="padding-left:10px;">
    <!--right -->
	{section name=i loop=$setBlockRight[0]}
		{$setBlockRight[0][i]}
		<br/>
	{/section}
	&nbsp;
    </td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top" style="padding-left:10px;"><div align="right"></div></td>
  </tr>
</table>
<br />
<table  width="760" border="0" cellpadding="1" cellspacing="1">
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