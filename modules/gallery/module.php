<?php

require_once('include/adodb/adodb-active-record.inc.php');
global $db;

ADOdb_Active_Record::SetDatabaseAdapter($db);

/* Class Gallery */
class Gallery extends ADOdb_Active_Record
{
    var $_table = 'tbl_ln_gallery';
    var $galId;
    var $galTitle;
    var $galDescription;
    var $galDate;

    function getGalleryTitle($gid)
    {
        global $db;
        $sql = "SELECT * FROM " . $this->_table . " 
                WHERE galId=" . $gid;
        $rs = $db->execute($sql);
        return $rs->fields['galTitle'];
    }
    function lastGalId()
    {
        global $db;
        $sql = "SELECT MAX(galId) FROM " . $this->_table . " 
                WHERE 1 ";
        $rs = $db->execute($sql);
        return $rs->fields[0];
    }
    function deleteGallery($gid)
    {
        global $db;

        // Validate ID
        $gid = intval($gid);
        if ($gid <= 0) {
            return false;
        }

        $sql = "DELETE FROM " . $this->_table . " WHERE galId = " . $gid;
        $result = $db->execute($sql);

        return $result ? true : false;
    }

    function getGalleryDate($gid)
    {
        global $db;
        $sql = "SELECT * FROM " . $this->_table . " 
                WHERE galId=" . $gid;
        $rs = $db->execute($sql);
        return $rs->fields['galDate'];
    }

    function getGalleryDes($gid)
    {
        global $db;
        $sql = "SELECT * FROM " . $this->_table . " 
                WHERE galId=" . $gid;
        $rs = $db->execute($sql);
        return $rs->fields['galDescription'];
    }

    function saveGal()
    {
        global $db;

        if (empty($this->_table)) {
            $this->ErrorMsg = "Table name not defined.";
            return false;
        }

        // Check if record exists → UPDATE
        $sql = "SELECT galId FROM {$this->_table} WHERE galId=" . intval($this->galId);
        $rs = $db->Execute($sql);

        if ($rs && !$rs->EOF) {
            // UPDATE
            $sql = sprintf(
                "UPDATE %s SET galTitle=%s, galDescription=%s, galDate=%s WHERE galId=%d",
                $this->_table,
                $db->qstr($this->galTitle),
                $db->qstr($this->galDescription),
                $db->qstr($this->galDate),
                intval($this->galId)
            );
        } else {
            // INSERT
            $sql = sprintf(
                "INSERT INTO %s (galTitle, galDescription, galDate)
                 VALUES (%s, %s, %s)",
                $this->_table,
                $db->qstr($this->galTitle),
                $db->qstr($this->galDescription),
                $db->qstr($this->galDate)
            );
        }

        // Execute query
        $result = $db->Execute($sql);

        if (!$result) {
            $this->ErrorMsg = $db->ErrorMsg();
            return false;
        }

        // If insert → get new ID
        if (!$this->galId) {
            $this->galId = $db->Insert_ID();
        }

        return true;
    }
}

/* Class GalleryItem */
class GalleryItem extends Gallery
{
    var $_table = 'tbl_ln_gallery_item';

    function delWholdGalleryItem($gid)
    {
        global $db;
        $sql = "DELETE FROM " . $this->_table . " 
                WHERE galId=" . $gid;
        $rs = $db->execute($sql);
    }

    function totalItem($gid)
    {
        global $db;
        $sql = "SELECT COUNT(*) FROM " . $this->_table . " 
                WHERE galId=" . $gid;
        $rs = $db->execute($sql);
        return $rs->fields[0];
    }

    function lastId($gid)
    {
        global $db;
        $sql = "SELECT MAX(itmId) FROM " . $this->_table . " 
                WHERE galId=" . $gid;
        $rs = $db->execute($sql);
        return $rs->fields[0];
    }

    function getImageSize($filename)
    {
        return getimagesize($filename);
    }

    function calculateDimensions($old_x, $old_y, $new_w, $new_h, $strategy, $crop_position)
    {
        $src_x = 0;
        $src_y = 0;
        $src_w = $old_x;
        $src_h = $old_y;

        switch ($strategy) {
            case 'stretch':
                $thumb_w = $new_w;
                $thumb_h = $new_h;
                break;

            case 'fill':
                $ratio_orig = $old_x / $old_y;
                if ($new_w / $new_h > $ratio_orig) {
                    $thumb_w = $new_w;
                    $thumb_h = $new_w / $ratio_orig;
                } else {
                    $thumb_h = $new_h;
                    $thumb_w = $new_h * $ratio_orig;
                }
                break;

            case 'crop':
                $thumb_w = $new_w;
                $thumb_h = $new_h;

                $src_ratio = $old_x / $old_y;
                $dst_ratio = $new_w / $new_h;

                if ($src_ratio > $dst_ratio) {
                    $src_h = $old_y;
                    $src_w = $old_y * $dst_ratio;
                    switch ($crop_position) {
                        case 'left':
                            $src_x = 0;
                            break;
                        case 'right':
                            $src_x = $old_x - $src_w;
                            break;
                        default:
                            $src_x = ($old_x - $src_w) / 2;
                    }
                } else {
                    $src_w = $old_x;
                    $src_h = $old_x / $dst_ratio;
                    switch ($crop_position) {
                        case 'top':
                            $src_y = 0;
                            break;
                        case 'bottom':
                            $src_y = $old_y - $src_h;
                            break;
                        default:
                            $src_y = ($old_y - $src_h) / 2;
                    }
                }
                break;

            case 'fit':
            default:
                if ($old_x > $old_y) {
                    $thumb_w = $new_w;
                    $thumb_h = $old_y * ($new_h / $old_x);
                } else if ($old_x < $old_y) {
                    $thumb_w = $old_x * ($new_w / $old_y);
                    $thumb_h = $new_h;
                } else {
                    $thumb_w = $new_w;
                    $thumb_h = $new_h;
                }
                break;
        }

        return array($thumb_w, $thumb_h, $src_x, $src_y, $src_w, $src_h);
    }

    function saveImage($image, $filename, $format, $quality)
    {
        switch ($format) {
            case 'jpeg':
                return imagejpeg($image, $filename, $quality);
            case 'png':
                $png_quality = 9 - round(($quality / 100) * 9);
                return imagepng($image, $filename, $png_quality);
            case 'gif':
                return imagegif($image, $filename);
            default:
                throw new Exception("Unsupported output format: " . $format);
        }
    }

    function resizeImage($name, $filename, $new_w, $new_h, $options = array())
    {
        $defaults = array(
            'quality' => 75,
            'format' => 'auto',
            'strategy' => 'fit',
            'crop_position' => 'center'
        );

        $options = array_merge($defaults, $options);

        if (!file_exists($name)) {
            throw new Exception("Source image file does not exist: " . $name);
        }

        $image_info = getimagesize($name);
        if ($image_info === false) {
            throw new Exception("Unable to determine image type");
        }

        $mime_type = $image_info['mime'];

        switch ($mime_type) {
            case 'image/jpeg':
                $src_img = imagecreatefromjpeg($name);
                if ($options['format'] === 'auto') {
                    $options['format'] = 'jpeg';
                }
                break;
            case 'image/png':
                $src_img = imagecreatefrompng($name);
                if ($options['format'] === 'auto') {
                    $options['format'] = 'png';
                }
                break;
            case 'image/gif':
                $src_img = imagecreatefromgif($name);
                if ($options['format'] === 'auto') {
                    $options['format'] = 'gif';
                }
                break;
            default:
                throw new Exception("Unsupported image format: " . $mime_type);
        }

        if ($src_img === false) {
            throw new Exception("Failed to create image resource");
        }

        $old_x = imagesx($src_img);
        $old_y = imagesy($src_img);

        $dimensions = $this->calculateDimensions($old_x, $old_y, $new_w, $new_h, $options['strategy'], $options['crop_position']);

        $thumb_w = $dimensions[0];
        $thumb_h = $dimensions[1];
        $src_x = $dimensions[2];
        $src_y = $dimensions[3];
        $src_w = $dimensions[4];
        $src_h = $dimensions[5];

        $dst_img = imagecreatetruecolor($thumb_w, $thumb_h);
        if ($dst_img === false) {
            imagedestroy($src_img);
            throw new Exception("Failed to create destination image");
        }

        if ($options['format'] === 'png' || $options['format'] === 'gif') {
            imagealphablending($dst_img, false);
            imagesavealpha($dst_img, true);
            $transparent = imagecolorallocatealpha($dst_img, 0, 0, 0, 127);
            imagefill($dst_img, 0, 0, $transparent);
        }

        $success = imagecopyresampled($dst_img, $src_img, 0, 0, $src_x, $src_y, $thumb_w, $thumb_h, $src_w, $src_h);

        if (!$success) {
            imagedestroy($src_img);
            imagedestroy($dst_img);
            throw new Exception("Failed to resample image");
        }

        $save_result = $this->saveImage($dst_img, $filename, $options['format'], $options['quality']);

        imagedestroy($dst_img);
        imagedestroy($src_img);

        if (!$save_result) {
            throw new Exception("Failed to save image to: " . $filename);
        }

        return true;
    }

    function getMinGallery()
    {
        global $db;
        $sql = "SELECT MIN(galId) FROM " . $this->_table . " ";
        $rsx = $db->execute($sql);
        $min = $rsx->fields[0];
        return $min;
    }

    function getMaxGallery()
    {
        global $db;
        $sql = "SELECT MAX(galId) FROM " . $this->_table . " ";
        $rsx = $db->execute($sql);
        $max = $rsx->fields[0];
        return $max;
    }

    function getMinItem($gid)
    {
        global $db;
        $sql = "SELECT MIN(itmId) FROM " . $this->_table . " 
                WHERE galId=" . $gid;
        $rsx = $db->execute($sql);
        $min = $rsx->fields[0];
        return $min;
    }

    function getMaxItem($gid)
    {
        global $db;
        $sql = "SELECT MAX(itmId) FROM " . $this->_table . " 
                WHERE galId=" . $gid;
        $rsx = $db->execute($sql);
        $max = $rsx->fields[0];
        return $max;
    }

    function ranDomGallery($numofitem)
    {
        $ranitem = array();
        $galNum = rand($this->getMinGallery(), $this->getMaxGallery());
        $itmMax = $this->getMaxItem($galNum);
        $itmMin = $this->getMinItem($galNum);
        for ($i = 0; $i < $numofitem; $i++) {
            $itemNum = rand($itmMin, $itmMax);
            array_push($ranitem, $itemNum);
        }
        $ranitem = array($ranitem, $galNum);
        return $ranitem;
    }
}

/* Class GalleryPager */
class GalleryPager extends Pager
{
    /* render grid header */
    function renderGridHeader()
    {
        ob_start();
?>
        <table class="dataTable">
        <?php
        $s = ob_get_contents();
        ob_end_clean();
        return $s;
    }

    /* reder page  */
    function renderGrid()
    {
        global $cfg;
        $itmObj = new GalleryItem();
        $itmObj->_table = $cfg['tablepre'] . "gallery_item";
        ob_start();
        while (!$this->rs->EOF) {
        ?><tr class="dataRow"><?php
                                ?>
                <td width="100%">
                    <?php
                    $total = $itmObj->totalItem($this->rs->fields['galId']);
                    if ($total == 0) {
                        // noimage
                        $fname = "modules/gallery/images/noimage.jpg";
                    } else {
                        // ramdom
                        $fname = "datacenter/gallery/image_" . sprintf("%04d", $this->rs->fields['galId']) . "_0001_small.jpg";
                    }
                    ?>
                    <a href="<?= $_SERVER['PHP_SELF'] ?>?modname=gallery&mf=mangal&gid=<?= $this->rs->fields['galId']; ?>">
                        <img src="<?= $fname; ?>" border="0" align="left" style="border:1px #CCC solid; padding:5px; margin: 0px 10px 0px 0px;">
                    </a>
                    <b><?= $this->rs->fields['galTitle']; ?></b><br>
                    <?= $this->rs->fields['galDescription']; ?><br><br>
                    <?= $total; ?> <?= _ITEMS; ?><br><br>
                    <img src="theme/<?= $cfg['theme']; ?>/images/new.gif" border="0" align="absmiddle" />
                    <a href="setting.php?modname=gallery&mf=additem&gid=<?= $this->rs->fields['galId']; ?>"><?= _ADD_ITEM; ?></a>&nbsp;
                    <img src="theme/<?= $cfg['theme']; ?>/images/edit.gif" border="0" align="absmiddle" />
                    <a href="setting.php?modname=gallery&mf=editgal&gid=<?= $this->rs->fields['galId']; ?>"><?= _EDIT_GALLERY; ?></a>&nbsp;
                    <img src="theme/<?= $cfg['theme']; ?>/images/delete.gif" border="0" align="absmiddle" />
                    <a href="setting.php?modname=gallery&mf=delgal&gid=<?= $this->rs->fields['galId']; ?>"><?= _DEL_GALLERY; ?></a>&nbsp;
                    <img src="theme/<?= $cfg['theme']; ?>/images/search.gif" border="0" align="absmiddle" />
                    <a href="module.php?modname=gallery&mf=list&gid=<?= $this->rs->fields['galId']; ?>" target="_blank"><?= _VIW_GALLERY; ?></a>
                </td>
                <?php
                ?></tr><?php
                    $this->rs->movenext();
                }
                $s = ob_get_contents();
                ob_end_clean();
                return $s;
            }
        }

        /* Class GalleryViewPager */
        class GalleryViewPager extends Pager
        {
            /* render grid header */
            function renderGridHeader()
            {
                ob_start();
        ?>
            <table class="dataTable">
            <?php
                $s = ob_get_contents();
                ob_end_clean();
                return $s;
            }

            /* reder page  */
            function renderGrid()
            {
                global $cfg;
                $itmObj = new GalleryItem();
                $itmObj->_table = $cfg['tablepre'] . "gallery_item";
                $objGallery = new Gallery();
                $objGallery->_table = $cfg['tablepre'] . "gallery";
                ob_start();
                while (!$this->rs->EOF) {
                ?><tr class="dataRow"><?php
                                        ?>
                        <td width="100%">
                            <?php
                            $total = $itmObj->totalItem($this->rs->fields['galId']);
                            if ($total == 0) {
                                // noimage
                                $fname = "modules/gallery/images/noimage.jpg";
                            } else {
                                // ramdom
                                $fname = "datacenter/gallery/image_" . sprintf("%04d", $this->rs->fields['galId']) . "_0001_small.jpg";
                            }
                            ?>
                            <table>
                                <tr>
                                    <td>
                                        <a href="module.php?modname=gallery&mf=list&gid=<?= $this->rs->fields['galId']; ?>">
                                            <img src="<?= $fname; ?>" border="0" align="left" style="border:1px #CCC solid; padding:5px; margin: 0px 10px 0px 0px;">
                                        </a>
                                    </td>
                                    <td>
                                        <b><u><?= $this->rs->fields['galTitle']; ?></u></b><br><br>
                                        <?= $this->rs->fields['galDescription']; ?><br><br>
                                        <b><?= $total; ?></b> <?= _ITEMS; ?><br>
                                        <span style="font-size:12px"><i><?= _ITEMS_MO; ?>
                                                <?php
                                                $galdate = $objGallery->getGalleryDate($this->rs->fields['galId']);
                                                echo adodb_date2("d-m-Y", $galdate);
                                                ?></i></span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <?php
                        ?></tr><?php
                            $this->rs->movenext();
                        }
                        $s = ob_get_contents();
                        ob_end_clean();
                        return $s;
                    }
                }

                /* Class GalleryItemViewPager */
                class GalleryItemViewPager extends Pager
                {
                    /* render grid header */
                    function renderGridHeader()
                    {
                        ob_start();
                ?>
                <table class="dataTable">
                <?php
                        $s = ob_get_contents();
                        ob_end_clean();
                        return $s;
                    }

                    /* reder page  */
                    function renderGrid()
                    {
                        global $cfg;
                        $itmObj = new GalleryItem();
                        $itmObj->_table = $cfg['tablepre'] . "gallery_item";
                        ob_start();
                        while (!$this->rs->EOF) {
                        ?><tr class="dataRow"><?php
                            for ($i = 1; $i <= 4; $i++) {
                                if (!empty($this->rs->fields['galId'])) {
                            ?><td width="100%">
                                            <?php
                                            $total = $itmObj->totalItem($this->rs->fields['galId']);
                                            $fname = "datacenter/gallery/image_" . sprintf("%04d", $this->rs->fields['galId']) . "_" . sprintf("%04d", $i) . "_small.jpg";
                                            ?>
                                            <a href="module.php?modname=gallery&mf=view&gid=<?= $this->rs->fields['galId']; ?>&page=<?= $this->rs->fields['itmId']; ?>">
                                                <img src="<?= $fname; ?>" border="0" align="left" style="border:1px #CCC solid; padding:5px; margin: 0px 0px 0px 0px;" alt="<?= $this->rs->fields['itmTitle'] . ", " . $this->rs->fields['itmDescription']; ?>">
                                            </a>
                                        </td>
                                <?php
                                } // empty
                                $this->rs->movenext();
                            } // for
                                ?></tr><?php
                            }
                            $s = ob_get_contents();
                            ob_end_clean();
                            return $s;
                        }
                    }

                    /* Class GalleryItemPager */
                    class GalleryItemPager extends Pager
                    {
                        var $itm;
                        var $itmT;
                        var $itmD;
                        var $itmS;

                        /* render grid header */
                        function renderGridHeader()
                        {
                            ob_start();
                    ?>
                    <table class="dataTable" cellspacing="0" cellpadding="0">
                    <?php
                            $s = ob_get_contents();
                            ob_end_clean();
                            return $s;
                        }

                        /* render */
                        function renderPage()
                        {
                            global $cfg;
                    ?>
                        <table cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <?= $this->renderGridHeader(); ?>
                                    <?= $this->renderGrid();       ?>
                                    <?= $this->renderGridFooter(); ?>
                                </td>
                                <td valign="top">
                                    <table bgcolor="#EEEEEE" cellpadding="10" style="border:1px #CCC solid; ">
                                        <tr>
                                            <td>
                                                <a href="module.php?modname=gallery&mf=list&gid=<?= $_REQUEST['gid']; ?>">^<?= _INDEX; ?></a><br><br>
                                                <?php
                                                $fname1 = "datacenter/gallery/image_" . sprintf("%04d", $_REQUEST['gid']) . "_" . sprintf("%04d", $this->itm - 1) . "_small.jpg";
                                                $fname2 = "datacenter/gallery/image_" . sprintf("%04d", $_REQUEST['gid']) . "_" . sprintf("%04d", $this->itm + 1) . "_small.jpg";
                                                if (!file_exists($fname1)) {
                                                    $fname1 = "modules/gallery/images/blank.jpg";
                                                    $fitm1 = "module.php?modname=gallery&mf=view&gid=" . $_REQUEST['gid'] . "&page=1";
                                                } else {
                                                    $fitm1 = "module.php?modname=gallery&mf=view&gid=" . $_REQUEST['gid'] . "&page=" . ($this->itm - 1);
                                                }
                                                if (!file_exists($fname2)) {
                                                    $fname2 = "modules/gallery/images/blank.jpg";
                                                    $fitm2 = "module.php?modname=gallery&mf=view&gid=" . $_REQUEST['gid'] . "&page=" . $this->itm;
                                                } else {
                                                    $fitm2 = "module.php?modname=gallery&mf=view&gid=" . $_REQUEST['gid'] . "&page=" . ($this->itm + 1);
                                                }
                                                ?>
                                                <a href="<?= $fitm1; ?>">
                                                    <img src="<?= $fname1; ?>" border="0">
                                                </a>
                                                <a href="<?= $fitm2; ?>">
                                                    <img src="<?= $fname2; ?>" border="0">
                                                </a>
                                            </td>
                                            <td align="center">
                                                <?= $this->showPageNumber();   ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= _GAL_ITEM_TITLE; ?> <?= $this->itmT; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?= _GAL_ITEM_DES; ?><?= $this->itmD; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?= _GAL_ITEM_SIZE; ?> <?= $this->itmS; ?> <?= _GAL_PIXELS; ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                    <?php
                        }

                        /* reder page  */
                        function renderGrid()
                        {
                            global $cfg;
                            $itmObj = new GalleryItem();
                            $itmObj->_table = $cfg['tablepre'] . "gallery_item";
                            ob_start();
                            $k = 1;
                            while (!$this->rs->EOF) {
                            ?><tr class="dataRow"><?php
                                                ?><td width="100%">
                                        <?php
                                        $total = $itmObj->totalItem($this->rs->fields['galId']);
                                        $this->itm = $this->rs->fields['itmId'];
                                        $this->itmT = $this->rs->fields['itmTitle'];
                                        $this->itmD = $this->rs->fields['itmDescription'];
                                        $this->itmS = $this->rs->fields['itmSize'];
                                        $fname = "datacenter/gallery/image_" . sprintf("%04d", $this->rs->fields['galId']) . "_" . sprintf("%04d", $k) . "_medium.jpg";
                                        ?>
                                        <a href="datacenter/gallery/image_<?= sprintf("%04d", $this->rs->fields['galId']) . "_" . sprintf("%04d", $k) . ".jpg"; ?>" target="_blank">
                                            <img src="<?= $fname; ?>" border="0" align="left" style="border:1px #CCC solid; padding:5px;  margin: 0px 10px 0px 0px;" alt="<?= $this->rs->fields['itmTitle'] . ", " . $this->rs->fields['itmDescription']; ?>">
                                        </a>
                                    </td>
                                    <?php

                                    $this->rs->movenext();

                                    ?></tr><?php
                                        $k++;
                                    }
                                    $s = ob_get_contents();
                                    ob_end_clean();
                                    return $s;
                                }
                            }

                            class GalleryItemManagePager extends Pager
                            {
                                /* render grid header */
                                function renderGridHeader()
                                {
                                    ob_start();
                            ?>
                            <table class="dataTable">
                            <?php
                                    $s = ob_get_contents();
                                    ob_end_clean();
                                    return $s;
                                }

                                /* reder page  */
                                function renderGrid()
                                {
                                    global $cfg;
                                    $itmObj = new GalleryItem();
                                    $itmObj->_table = $cfg['tablepre'] . "gallery_item";
                                    ob_start();
                                    while (!$this->rs->EOF) {
                                    ?><tr class="dataRow">
                                        <td width="100%">
                                            <?php
                                            $total = $itmObj->totalItem($this->rs->fields['galId']);
                                            $fname = "datacenter/gallery/image_" . sprintf("%04d", $this->rs->fields['galId']) . "_" . sprintf("%04d", $this->rs->fields['itmId']) . "_small.jpg";
                                            ?>
                                            <table>
                                                <tr>
                                                    <td><img src="<?= $fname; ?>" border="0" align="left" style="border:1px #CCC solid; padding:5px; margin: 0px 0px 0px 0px;" alt="<?= $this->rs->fields['itmTitle'] . ", " . $this->rs->fields['itmDescription']; ?>"></td>
                                                    <td>
                                                        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                                                            <input type="hidden" name="modname" value="gallery">
                                                            <input type="hidden" name="mf" value="itmedit">
                                                            <input type="hidden" name="itmId" value="<?= $this->rs->fields['itmId']; ?>">
                                                            <input type="hidden" name="galId" value="<?= $this->rs->fields['galId']; ?>">
                                                            &nbsp;&nbsp;<input type="text" name="itmTitle" value="<?= $this->rs->fields['itmTitle']; ?>"><br>
                                                            &nbsp;&nbsp;<textarea name="itmDescription" rows="3" cols="30"> <?= $this->rs->fields['itmDescription']; ?></textarea><br>
                                                            &nbsp;&nbsp;<input type="submit" value="<?= _SAVE; ?>" class="inputButton">
                                                            <input type="reset" value="<?= _RESET; ?>" class="inputButton">
                                                            <input type="button" value="<?= _DELETE; ?>" class="inputButton" onClick="javascript:delitem(<?= $this->rs->fields['galId']; ?>,<?= $this->rs->fields['itmId']; ?>)">
                                                        </form>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <?php

                                        $this->rs->movenext();

                                        ?></tr><?php
                                            }
                                            $s = ob_get_contents();
                                            ob_end_clean();
                                            return $s;
                                        }
                                    }

                                    ?>