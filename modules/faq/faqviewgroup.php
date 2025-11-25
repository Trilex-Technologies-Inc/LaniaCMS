<?
      
	if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
			die ("You can't access this file directly...");
	}

	$module_name = basename(dirname(__FILE__));
	$modfunction="modules/$module_name/module.php";
	include_once($modfunction);
	$faq = new Faq();

    	/// settype
	settype($_REQUEST['mid'],"integer");
	
	$rs=$faq->getFagItemByGroupId($_REQUEST['mid']);
	if (( $rs->recordcount())>0) {
        $rsgroup=$faq->getFaqGroupById($_REQUEST['mid']);
	?>
	<span class="txtContentTitle"><?=_FAQ_GROUP; ?> <?=$rsgroup->fields['fcgTitle']; ?></span><br/><br/>
    <ul>
	<?
		while(!$rs->EOF){
		?>
            <li><a href="#<?=$rs->fields['faiId']; ?>" ><?=$rs->fields['faiQuestion']; ?></a>
		<?
			$rs->movenext();
		} // while
    ?></ul>
    <?
        	$rs=$faq->getFagItemByGroupId($_REQUEST['mid']);
		while(!$rs->EOF){
	?>
	<table cellspacing="1" cellpadding="3" >
    <tr>
        <td class="txtContentTitle">
        <a name="<?=$rs->fields['faiId']; ?>"></a>
        <?=_QUESTION; ?>
        </td>
        <td class="txtContentTitle"><?=$rs->fields['faiQuestion']; ?></td>
    </tr>
    <tr>
        <td valign="top"  class="txtContentTitle"><?=_ANSWER; ?></td>
        <td><?=$rs->fields['faiAnswer']; ?></td>
    </tr>
    </table>
	<br/>
    <?
			$rs->movenext();
		} // while    
	} // if


?>