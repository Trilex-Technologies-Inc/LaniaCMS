<?
    session_start();

    include_once("../include/lanai/class.system.php");
	$sys_lanai=new Systems();

    if (empty($_SESSION['lang'])) {
        require_once("language/lang-english.php");
    } else {
        require_once("language/lang-".$_SESSION['lang'].".php");
    }

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Setup</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
body {
	background-image: url(images/background.gif);
	background-repeat: repeat-x;
	margin-top: 0px;
}
-->
</style>
</HEAD>
<BODY>
<TABLE  WIDTH="955" ALIGN="center" cellpadding="0" cellspacing="0">
<TR>
	<TD height="80">&nbsp;</TD>
</TR>
<TR>
	<TD height="40"><img src="images/logo.gif" ></TD>
</TR>
<TR>
  <TD>&nbsp;</TD>
</TR>
<TR>
  <TD>
  <TABLE  WIDTH="795"  align="left">
<TR>
	<TD VALIGN="top" HEIGHT="400">
	<?
			if (empty($_REQUEST['step'])) {
					include_once("step_a.php");
			} else {
					if  (file_exists("step_".$_REQUEST['step'].".php")) {
							include_once("step_".$_REQUEST['step'].".php");
					} else {
							?>
							<CENTER>
							<IMG SRC="../theme/default/images/worning.gif" ALIGN="absmiddle">&nbsp;<STRONG>ขออภัยไม่พบไฟล์ที่ใช้ในการติดตั้งละหน่ายซีเอ็มเอ็ส!</STRONG>
							</CENTER>
							<?
					}
			}
	?>	</TD>
</TR>
</TABLE>
  </TD>
</TR>

</TABLE>

<TABLE  WIDTH="60%" ALIGN="center">
<TR>
  <TD ALIGN="center">&nbsp;</TD>
</TR>
<TR>
	<TD ALIGN="center"><span style="font-size:12; ">&reg; La Nai Content Management System.</span></TD>
</TR>
</TABLE>
</BODY>
</HTML>
