<? 
	switch ($_REQUEST['ac']) {
		case "mdelete" :
			$selarr=$_REQUEST['midId'] ;
			$itmarr=$_REQUEST['banId'] ;
			for ($i=0;$i<count($itmarr);$i++) {
				if ($selarr[$i]=="on") {
					$objbanner=new banner();
					$rs=$objbanner->Load("banId=".$itmarr[$i]);
					if (!$rs) {
						/* no data to delete - show error message*/
						$sys_lanai->getErrorBox("Data not found!");
					}  else {
						/* perform delete */
						$objbanner->delete();
						$sys_lanai->go2Page("setting.php?modname=banner");
					}
				}
			}
		break;
	}
?>