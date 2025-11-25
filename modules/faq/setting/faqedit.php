<?



	if ( !eregi( "setting.php", $_SERVER['PHP_SELF'] ) ) {

	    die ( "You can't access this file directly..." );

	} 

	

	$module_name = basename( dirname( substr( __FILE__, 0, strlen( dirname( __FILE__ ) ) ) ) );

	$modfunction = "modules/$module_name/module.php";

	include_once( $modfunction ); 

	

	

	$faq=new Faq();

	

	switch($_REQUEST['ac']){

		case "new":



				if ((empty($_REQUEST['faiQuestion']) OR (trim($_REQUEST['faiQuestion'])==""))) {

				     $sys_lanai->getErrorBox(_REQUIRE_FIELDS." "._FAQ_QUESTION." <a href=\"javascript:history.back();\">"._BACK2FILL."</a>");

				} else {

                    $faq->setFaqItemNew($_REQUEST['faiQuestion'],$_REQUEST['faiAnswer'],$_REQUEST['fcgId']);

					$sys_lanai->go2Page($_SERVER['PHP_SELF']."?modname=".$module_name);

				}



			break;

        case "gnew":



				if ((empty($_REQUEST['fcgTitle']) OR (trim($_REQUEST['fcgTitle'])==""))) {

				     $sys_lanai->getErrorBox(_REQUIRE_FIELDS." "._FAQ_GROUP_TITLE." <a href=\"javascript:history.back();\">"._BACK2FILL."</a>");

				} else {

                    $faq->setFaqGroupNew($_REQUEST['fcgTitle'],$_REQUEST['fcgDescription']);

					$sys_lanai->go2Page($_SERVER['PHP_SELF']."?modname=".$module_name."&mf=faqgroup");

				}



			break;

		case "order" :



				$rs=$faq->getFaqItem();

				$arrId=array();

				$arrOrder=array();

				$i=0;

				while(!$rs->EOF){

					$arrId[$i]=$rs->fields['faiId'];

					$arrOrder[$i]=$rs->fields['faiOrder'];

					if ($rs->fields['faiId']==$_REQUEST['mid']) {

					    $index=$i;

					}

					$i++;

					$rs->movenext();

				} // while

				if ($_REQUEST['v']=="dn") {

				    $tmp=$arrOrder[$index];

					$arrOrder[$index]=$arrOrder[$index+1];

					$faq->setFaqItemOrder($arrId[$index],$arrOrder[$index+1]);

					$arrOrder[$index+1]=$tmp;

					$faq->setFaqItemOrder($arrId[$index+1],$tmp);

				} else {

				 	$tmp=$arrOrder[$index];

					$arrOrder[$index]=$arrOrder[$index-1];

					$faq->setFaqItemOrder($arrId[$index],$arrOrder[$index-1]);

					$arrOrder[$index-1]=$tmp;

					$faq->setFaqItemOrder($arrId[$index-1],$tmp);

				}

			   $sys_lanai->go2Page($_SERVER['PHP_SELF']."?modname=".$module_name);



			break;

        case "gorder" :



				$rs=$faq->getFaqGroup();

				$arrId=array();

				$arrOrder=array();

				$i=0;

				while(!$rs->EOF){

					$arrId[$i]=$rs->fields['fcgId'];

					$arrOrder[$i]=$rs->fields['fcgOrder'];

					if ($rs->fields['fcgId']==$_REQUEST['mid']) {

					    $index=$i;

					}

					$i++;

					$rs->movenext();

				} // while

				if ($_REQUEST['v']=="dn") {

				    $tmp=$arrOrder[$index];

					$arrOrder[$index]=$arrOrder[$index+1];

					$faq->setFaqGroupOrder($arrId[$index],$arrOrder[$index+1]);

					$arrOrder[$index+1]=$tmp;

					$faq->setFaqGroupOrder($arrId[$index+1],$tmp);

				} else {

				 	$tmp=$arrOrder[$index];

					$arrOrder[$index]=$arrOrder[$index-1];

					$faq->setFaqGroupOrder($arrId[$index],$arrOrder[$index-1]);

					$arrOrder[$index-1]=$tmp;

					$faq->setFaqGroupOrder($arrId[$index-1],$tmp);

				}

			   $sys_lanai->go2Page($_SERVER['PHP_SELF']."?modname=".$module_name."&mf=faqgroup");



			break;

		case "active":

				$faq->setFaqItemActive($_REQUEST['mid'],$_REQUEST['v']);

				$sys_lanai->go2Page($_SERVER['PHP_SELF']."?modname=".$module_name);

			break;

        case "gactive":

				$faq->setFaqGroupActive($_REQUEST['mid'],$_REQUEST['v']);

				$sys_lanai->go2Page($_SERVER['PHP_SELF']."?modname=".$module_name."&mf=faqgroup");

			break;

		case "mactive":

				$midarr=$_REQUEST['mid'];

				for ($i=0;$i<count($midarr);$i++) {

					$rsdwn=$faq->getFaqItemById($midarr[$i]);

					if ($rsdwn->fields['faiActive']=='y') {

					    $value="n";

					} else {

						$value="y";

					}

					$faq->setFaqItemActive($midarr[$i],$value);

				}

				$sys_lanai->go2Page($_SERVER['PHP_SELF']."?modname=".$module_name);

			break;

        case "mgactive":

				$midarr=$_REQUEST['mid'];

				for ($i=0;$i<count($midarr);$i++) {

					$rsdwn=$faq->getFaqGroupById($midarr[$i]);

					if ($rsdwn->fields['fcgActive']=='y') {

					    $value="n";

					} else {

						$value="y";

					}

					$faq->setFaqGroupActive($midarr[$i],$value);

				}

				$sys_lanai->go2Page($_SERVER['PHP_SELF']."?modname=".$module_name);

			break;



		case "mdelete":



				$midarr=$_REQUEST['mid'];

				for ($i=0;$i<count($midarr);$i++) {

					$faq->setFaqItemDelete($midarr[$i]);

				}

				$sys_lanai->go2Page($_SERVER['PHP_SELF']."?modname=".$module_name);



			break;

        case "mgdelete":



				$midarr=$_REQUEST['mid'];

				for ($i=0;$i<count($midarr);$i++) {

					$faq->setFaqGroupDelete($midarr[$i]);

				}

				$sys_lanai->go2Page($_SERVER['PHP_SELF']."?modname=".$module_name."&mf=faqgroup");



			break;



		case "mweight":

				$midarr=$_REQUEST['faiOrderId'];

				$valarr=$_REQUEST['faiOrder'];

				for ($i=0;$i<count($midarr);$i++) {

					$faq->setFaqItemOrder($midarr[$i],$valarr[$i]);

				}

				$sys_lanai->go2Page($_SERVER['PHP_SELF']."?modname=".$module_name);

			break;

        case "mgweight":

				$midarr=$_REQUEST['fcgOrderId'];

				$valarr=$_REQUEST['fcgOrder'];

				for ($i=0;$i<count($midarr);$i++) {

					$faq->setFaqGroupOrder($midarr[$i],$valarr[$i]);

				}

				$sys_lanai->go2Page($_SERVER['PHP_SELF']."?modname=".$module_name."&mf=faqgroup");

			break;



		case "edit":

				//edit

               if ((empty($_REQUEST['faiQuestion']) OR (trim($_REQUEST['faiQuestion'])==""))) {

				     $sys_lanai->getErrorBox(_REQUIRE_FIELDS." "._FAQ_QUESTION." <a href=\"javascript:history.back();\">"._BACK2FILL."</a>");

				} else {

                    $faq->setFaqItemEdit($_REQUEST['mid'],$_REQUEST['faiQuestion'],$_REQUEST['faiAnswer'],$_REQUEST['fcgId']);

					$sys_lanai->go2Page($_SERVER['PHP_SELF']."?modname=".$module_name);

				}

			break;

        case "gedit":

				//edit

               if ((empty($_REQUEST['fcgTitle']) OR (trim($_REQUEST['fcgTitle'])==""))) {

				     $sys_lanai->getErrorBox(_REQUIRE_FIELDS." "._FAQ_GROUP_TITLE." <a href=\"javascript:history.back();\">"._BACK2FILL."</a>");

				} else {

                    $faq->setFaqGroupEdit($_REQUEST['mid'],$_REQUEST['fcgTitle'],$_REQUEST['fcgDescription']);

					$sys_lanai->go2Page($_SERVER['PHP_SELF']."?modname=".$module_name."&mf=faqgroup");

				}

			break;



	} // switch



?>

