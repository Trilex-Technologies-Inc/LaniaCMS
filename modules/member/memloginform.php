<?
	if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
			die ("You can't access this file directly...");
	}
	
	$module_name = basename(dirname(__FILE__));
	$modfunction="modules/$module_name/module.php";
	include_once($modfunction);

	$mem_lanai=new User();

?>
<table width="" border="0" cellspacing="1" cellpadding="3" >
  <!--
  <tr>
    <td class="tblBlockTitleBackground">
		<span class="txtBlockTitle">
		<? 
			if ($_SESSION['uid']>0) {
			    ?><?=_MEMBER_INFO; ?><?
			} else {
				?><?=$rs->fields['blcTitle'];?><?
			}
		?>		
		</span>
	</td>
  </tr>
  -->
  <tr >
  	<?
  		if ($_SESSION['uid']>0) {
	?>
	  <td >
	  	<?
			if ($mem_lanai->isUserImageExist($_SESSION['uid'])) {
				?><img src="<?="datacenter/uimage/u".$_SESSION['uid'].".gif"; ?>" width="96" height="96" border="0" align="left"><?
			} else {
				?><img src="<?="datacenter/uimage/u0.gif"; ?>" width="96" height="96" border="0"><?
			}
		?>
		</td>
		<td>
	  	<? 
			
			$mem=$mem_lanai->getUser($_SESSION['uid']); 
		?>		
		<?=$mem->fields['userFname']." ".$mem->fields['userLname']; ?><br/><br/>
	
		<img src="theme/<?=$cfg['theme'];?>/images/user.gif" border="0" align="absmiddle">	
	  	<a href="<?="module.php?modname=member&mf=meminfo"; ?>"><?=_USER_INFO; ?></a>

		<?
			if ($mem_lanai->getUserPrivilege($_SESSION['uid'])=="a") {
		?>
		<img src="theme/<?=$cfg['theme'];?>/images/setting.gif" border="0" align="absmiddle">
		<a href="<?="setting.php?modname=setting"; ?>"><?=_SITE_SETTING; ?></a>
		<?
			}
		?>
		<img src="theme/<?=$cfg['theme'];?>/images/logout.gif" border="0" align="absmiddle">
		<a href="<?="module.php?modname=member&mf=memlogout"; ?>"><?=_USER_LOGOUT; ?></a>
	</td>
 </tr>
 <tr>
	<?
		} else {
	?>
	<span class="txtContentTitle"><?=_MEMBER_LOGIN; ?></span><br/><br/>
    <form method="post" action="module.php">
	<input type="hidden" name="modname" value="member"/>
	<input type="hidden" name="mf" value="memlogin"/>
   <tr>
	 <td colspan="2">
		<img src="theme/<?=$cfg['theme'];?>/images/user2.gif" border="0" align="absmiddle">
		<a href="<?="module.php?modname=member&mf=memsignup"; ?>"><?=_USER_SIGNUP; ?></a>&nbsp;&nbsp;
	    <img src="theme/<?=$cfg['theme'];?>/images/config.gif" border="0" align="absmiddle">
		<a href="<?="module.php?modname=member&mf=memlostpass"; ?>"><?=_USER_LOST; ?></a><br/><br/>
	</td>
 </tr>
<tr>
 	  <td class="tblBlockBackground">
	  	<?=_USERNAME; ?> : 
       </td>
		<td>
		<input name="username" type="text" />
	  </td>
 </tr>
 <tr>
 	<td>
         <?=_PASSWORD; ?> : 
		  </td>
		<td>
              <input name="password" type="password" />
	</td>
 </tr>
  <tr>
	 <td><?=_MEMBER_CAPTEXT; ?> : </td>
 	<td >
			<input name="captext" type="text"  size="12" maxlength="5" />
	</td>
 </tr>
 <tr>	
  	 <td>&nbsp;</td>
 	<td >
 			 <img src="images/captcha.php?hash=<?=md5(time()); ?>"/>
	</td>
 </tr>
 <tr>	
 	 <td>&nbsp;</td>
	<td >
        <input type="submit" value="<?=_SIGNIN; ?>" class="inputButton"> <input type="reset" value="<?=_RESET; ?>" class="inputButton">
    </td>
  </tr>
 
    </form>
	<?	}	?>

 
</table>