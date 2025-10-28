<?
	if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
			die ("You can't access this file directly...");
	}
	
	$module_name = basename(dirname(__FILE__));
	$modfunction="modules/$module_name/module.php";
	include_once($modfunction);
	
	$content = new News();
	/// settype
	settype($_REQUEST['cid'],"integer");
	$rs=$content->getNewsById($_REQUEST['cid']);
	// load read class
	include_once("include/lanai/class.read.php");
	include_once("include/lanai/class.comment.php");
	$readObj=new ReadTotal("news",$_REQUEST['cid']);
	$commOjb=new Comment();
	
	if (($rs->recordcount())>0) {
	
?>
<table cellpadding="3" cellspacing="1">
<tr>
	<td>
		<span class="txtContentTitle"><?=$rs->fields['nwsTitle']; ?></span>
		<?=$sys_lanai->setPageTitle($rs->fields['nwsTitle']); ?>
	</td>
</tr>
<tr>
	<td>
		<span class="txtDateTime"><?=adodb_date2("l,d F Y",$rs->fields['nwsCreate']); ?></span>
		<br/><br/>
	</td>
</tr>
<tr>
	<td>
		<?=$rs->fields['nwsPreface']?>
		<?=$rs->fields['nwsBody']?>
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td >
	 <?=$readObj->getReadTotal("news",$_REQUEST['cid']); ?> <?=_NEWS_READ_TOTAL; ?>
	 <? 
	 		$numComment=$commOjb->getCommentTotal("news",$_REQUEST['cid']); 
	 		if ($numComment>0) {
	 			?><?=$numComment; ?> <?=_NWS_COMMENT_TOTAL; ?><?
	 		}
	 ?> 
	 <a href="#comment"><?=_POST_COMMENT; ?></a>
        </td>
</tr>
<!-- comment -->
<tr>
	<td>
	<a name="comment"></a>&nbsp;
	</td>
</tr>
<tr>
	<td>
	<table width="100%" cellpadding="3" cellspacing="2">
	<?
		$rscom=$commOjb->getComment("news",$_REQUEST['cid']);
		while (!$rscom->EOF) {
	?>
	<tr>
	<td class="tblComment ">
	<?=_NAME; ?> <a href="mailto:<?=$rscom->fields['comEmail']; ?>" ><?=$rscom->fields['comAuthor']; ?></a> 
	<?=_DATE; ?> <?=adodb_date2("l,d F Y - H:m:s",$rscom->fields['comDate']); ?>	
	</td>
	</tr>
	<tr>
	<td class="tblCommentButtom">
	<?=nl2br($rscom->fields['comDetail']); ?>
	<br><br>
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>

	<?
			$rscom->movenext();
		}
	?>
	</table>
	</td>
</tr>
<script language="JavaScript" src="include/jsvalidator/gen_validatorv2.js" type="text/javascript"></script>
<tr>
	<td>
	<span class="txtContentTitle"><?=_POST_COMMENT; ?></span>
	</td>
</tr>
<tr>
	<td>
	<table cellpadding="3">
	<form name="form" method="POST" action="<?=$_SERVER['PHP_SELF']; ?>">
	<input type="hidden" name="modname" value="news">
	<input type="hidden" name="mf" value="nwscomment">
	<input type="hidden" name="cid" value="<?=$_REQUEST['cid']?>">
	<tr>
		<td><?=_NAME; ?></td>
		<td><input type="text" name="comAuthor" >*</td>
	</tr>
	<tr>
		<td><?=_EMAIL; ?></td>
		<td><input type="text" name="comEmail" >*</td>
	</tr>
	<tr>
		<td valign="top"><?=_VERIFY; ?></td>
		<td><input type="text" name="txtVerify" >*</td>
	</tr>
	<tr>
		<td valign="top">&nbsp;</td>
		<td><img src="images/captcha.php"></td>
	</tr>
	<tr>
		<td valign="top"><?=_COMMENT_INTR; ?></td>
		<td><textarea name="comDetail" cols="50" rows="5" wrap="virtual"></textarea>*</td>
	</tr>
	<tr>
		<td valign="top"></td>
		<td><input type="submit" value="<?=_NWS_POST_COMMENT; ?>" class="inputButton"> 
		<input type="reset" value="<?=_CLEAR; ?>"  class="inputButton"></td>
	</tr>
	</form>
	<script language="JavaScript" type="text/javascript">
	var frmvalidator  = new Validator("form");
 	 frmvalidator.addValidation("comAuthor","req","<?=_NWS_AUTHOR_EMPTY; ?>");
 	 frmvalidator.addValidation("comEmail","req","<?=_NWS_EMAIL_EMPTY; ?>");
 	 frmvalidator.addValidation("comEmail","email","<?=_NWS_EMAIL_INVALID; ?>");
 	  frmvalidator.addValidation("comDetail","req","<?=_NWS_COMMENT_EMPTY; ?>");
 	  frmvalidator.addValidation("txtVerify","req","<?=_NWS_VERIFY_EMPTY; ?>");
	</script>
	</table>
	</td>
</tr>
</table>
<!-- comment -->
<?
	} else {
		$sys_lanai->getErrorBox(_NWS_NOT_FOUND);
	}
?>