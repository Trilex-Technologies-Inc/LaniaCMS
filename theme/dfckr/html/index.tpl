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
    <td width="254" height="65"><img src="theme/{$cfgTheme}/images/bann-logo.png" width="177" height="47" /></td>
    <td width="701" align="right"><img src="theme/{$cfgTheme}/images/bann-powered.png" width="124" height="47" /></td>
  </tr>
  <tr>
    <td height="32" bgcolor="#232323"><img src="theme/{$cfgTheme}/images/bann-salogan.png" width="354" height="25" /></td>
    <td bgcolor="#232323">
                <!--menu -->
        {include_php file="blocks/bmenu/index.php"}
    </td>
  </tr>
  <tr>
    <td height="460" colspan="2" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="5">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td valign="top">
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
        <td width="180" valign="top">
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
    <td height="30" class="license-box" ><a href="feed.php?type=RSS"><img src="theme/{$cfgTheme}/images/bann-feed.png" width="23" height="23" border="0" align="absmiddle" /></a><span class="license">Subscribe to our RSS feed</span> </td>
    <td height="30" class="license-box" ><div align="center" class="license">
      <div align="right">Copyright &copy; 2007 RedLine Software All Rights Reserved. </div>
    </div></td>
  </tr>
</table>