<?

    if ( !eregi( "setting.php", $_SERVER['PHP_SELF'] ) ) {
       die ( "You can't access this file directly..." );
    }

    $module_name = basename( dirname( substr( __FILE__, 0, strlen( dirname( __FILE__ ) ) ) ) );

    /* load class package */
    include_once("include/lanai/class.package.php");

    /* initial object */
    $objPackage=new Package();
    $cus_modname="gallery";
    $cus_title="Gallery";

    /* case steps */
    switch ($_REQUEST['step']) {
      case "1":
        /* create necessary tables */
        ?>
        <span class="txtContentTitle">Create Necessary Tables </span>
        <br /><br />
        Create Table Gallery and Gallery Item.
        <br /><br />
        <?
        $sql="CREATE TABLE ".$cfg['tablepre']."gallery_item (
				  itmId INTEGER UNSIGNED NOT NULL,
				  galId INTEGER UNSIGNED NOT NULL,
				  itmTitle VARCHAR(45) NOT NULL,
				  itmDescription TEXT NULL,
				  itmSize VARCHAR(45) NULL,
				  PRIMARY KEY  (`itmId`,`galId`)
			)";
        $objPackage->execQuery($sql);
        
        $sql="CREATE TABLE ".$cfg['tablepre']."gallery (
				  galId INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
				  galTitle VARCHAR(45) NULL,
				  galDescription TEXT NULL,
				  galDate DATETIME NULL,
				  PRIMARY KEY(galId)
			)";
        $objPackage->execQuery($sql);
        ?>
        <!-- form button -->
        <input type="button" class="inputButton" value="Next ->" onClick="javascript:location.href='<?=$_SERVER['PHP_SELF']?>?modname=<?=$module_name; ?>&mf=install&step=2';">
        <?
      break;
      case "2":
        ?>
        <span class="txtContentTitle">Insert Module & Menu </span>
        <br /><br />
        Please edit this message for insert module and menu information script.
        <br /><br />
        <?
        /* insert module */
        $objPackage->setupModule($cus_modname);
        /* insert menu */
        $objPackage->setupMenu($cus_modname,$cus_title);
        /* insert privilege */
        $objPackage->setupPrivilege("a");
        ?>
        <!-- form button -->
        <input type="button" class="inputButton" value="Next ->" onClick="javascript:location.href='<?=$_SERVER['PHP_SELF']?>?modname=<?=$module_name; ?>';">
        <?
      break;
      default:
        ?>
        <span class="txtContentTitle">Install gallery Module</span>
        <br /><br />
        Please create directory 'datacenter/gallery' and chmod 777 to them. 
        <br /><br />
        <!-- form button -->
        <input type="button" class="inputButton" value="Next ->" onClick="javascript:location.href='<?=$_SERVER['PHP_SELF']?>?modname=<?=$module_name; ?>&mf=install&step=1';">
        <?
    }

?>
