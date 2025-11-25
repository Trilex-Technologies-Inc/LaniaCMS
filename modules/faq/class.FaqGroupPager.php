<?php

class FaqGroupPager extends ADODB_Pager {

    public $page;

    function __construct(&$db, $sql, $id = 'adodb', $showPageLinks = false) {
        parent::__construct($db, $sql, $id, $showPageLinks);
        $this->page = _PAGE;
    }

    function FaqGroupPager(&$db, $sql, $id = 'adodb', $showPageLinks = false) {
        $this->__construct($db, $sql, $id, $showPageLinks);
    }

    function RenderLayout($header, $grid, $footer) {
        echo "<table width=\"100%\"><tr><td>",
             "</td></tr><tr><td>",
             $grid,
             "</td></tr><tr><td>",
             $footer, " ", $header,
             "</td></tr></table>";
    }

    function Render_First($anchor = true) {
        global $PHP_SELF;
        if ($anchor) {
            echo '<a href="'.$PHP_SELF.'?modname='.$_REQUEST['modname'].'&mf='.$_REQUEST['mf'].'&'.$this->id.'_next_page=1">'.$this->first.'</a> &nbsp;';
        } else {
            echo "$this->first &nbsp;";
        }
    }

    function render_next($anchor = true) {
        global $PHP_SELF;
        if ($anchor) {
            echo '<a href="'.$PHP_SELF.'?modname='.$_REQUEST['modname'].'&mf='.$_REQUEST['mf'].'&'.$this->id.'_next_page='.($this->rs->AbsolutePage() + 1).'">'.$this->next.'</a> &nbsp;';
        } else {
            echo "$this->next &nbsp;";
        }
    }

    function render_prev($anchor = true) {
        global $PHP_SELF;
        if ($anchor) {
            echo '<a href="'.$PHP_SELF.'?modname='.$_REQUEST['modname'].'&mf='.$_REQUEST['mf'].'&'.$this->id.'_next_page='.($this->rs->AbsolutePage() - 1).'">'.$this->prev.'</a> &nbsp;';
        } else {
            echo "$this->prev &nbsp;";
        }
    }

    function render_last($anchor = true) {
        global $PHP_SELF;
        if (!$this->db->pageExecuteCountRows) return;
        if ($anchor) {
            echo '<a href="'.$PHP_SELF.'?modname='.$_REQUEST['modname'].'&mf='.$_REQUEST['mf'].'&'.$this->id.'_next_page='.$this->rs->LastPageNo().'">'.$this->last.'</a> &nbsp;';
        } else {
            echo "$this->last &nbsp;";
        }
    }

    function RenderGrid() {
        ob_start();
        $gSQLBlockRows = $this->rows;
        $mod_lanai = new Faq();
        ?>
        <script type="text/javascript">
        function selectall(obj) {
            var checkBoxes = document.getElementsByTagName('input');
            for (var i = 0; i < checkBoxes.length; i++) {
                checkBoxes[i].checked = obj.checked;
            }
        }
        </script>

        <form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="modname" value="faq">
        <input type="hidden" name="mf" value="faqedit">
        <input type="hidden" name="ac" value="">
        <table cellpadding="3" cellspacing="1" width="100%">
            <tr>
                <th align="center"><input type="checkbox" value="select_all" onclick="selectall(this);" /></th>
                <th width="70%"><?php echo _FAQ_GROUP_TITLE; ?></th>
                <th><?php echo _WEIGHT; ?></th>
                <th><?php echo _ORDER; ?></th>
                <th><?php echo _ACTIVE; ?></th>
                <th><?php echo _EDIT; ?></th>
            </tr>
        <?php
        $rownum = 1;
        while (!$this->rs->EOF) {
            ?>
            <tr>
                <td align="center">
                    <input type="checkbox" name="mid[]" value="<?php echo $this->rs->fields['fcgId']; ?>" />
                </td>
                <td>
                    <img src="theme/<?php echo $mod_lanai->cfg['theme']; ?>/images/file.gif" border="0" align="absmiddle" />
                    <?php echo $this->rs->fields['fcgTitle']; ?>
                </td>
                <td align="center">
                    <input type="text" name="fcgOrder[]" value="<?php echo $this->rs->fields['fcgOrder']; ?>" size="1" maxlength="2" />
                    <input type="hidden" name="fcgOrderId[]" value="<?php echo $this->rs->fields['fcgId']; ?>" />
                </td>
                <td>
                    <?php
                    if ($rownum == 1) {
                        echo '<a href="'.$_SERVER['PHP_SELF'].'?modname='.$_REQUEST['modname'].'"><img src="theme/'.$mod_lanai->cfg['theme'].'/images/space.gif" width="22" border="0" align="absmiddle"></a>';
                        echo '<a href="'.$_SERVER['PHP_SELF'].'?modname='.$_REQUEST['modname'].'&mf=faqedit&ac=gorder&v=dn&mid='.$this->rs->fields['fcgId'].'"><img src="theme/'.$mod_lanai->cfg['theme'].'/images/downarrow.gif" border="0" align="absmiddle"></a>';
                    } elseif ($rownum == $this->rs->recordcount()) {
                        echo '<a href="'.$_SERVER['PHP_SELF'].'?modname='.$_REQUEST['modname'].'&mf=faqedit&ac=gorder&v=up&mid='.$this->rs->fields['fcgId'].'"><img src="theme/'.$mod_lanai->cfg['theme'].'/images/uparrow.gif" width="22" border="0" align="absmiddle"></a>';
                        echo '<a href="'.$_SERVER['PHP_SELF'].'?modname='.$_REQUEST['modname'].'"><img src="theme/'.$mod_lanai->cfg['theme'].'/images/space.gif" border="0" align="absmiddle"></a>';
                    } else {
                        echo '<a href="'.$_SERVER['PHP_SELF'].'?modname='.$_REQUEST['modname'].'&mf=faqedit&ac=gorder&v=up&mid='.$this->rs->fields['fcgId'].'"><img src="theme/'.$mod_lanai->cfg['theme'].'/images/uparrow.gif" width="22" border="0" align="absmiddle"></a>';
                        echo '<a href="'.$_SERVER['PHP_SELF'].'?modname='.$_REQUEST['modname'].'&mf=faqedit&ac=gorder&v=dn&mid='.$this->rs->fields['fcgId'].'"><img src="theme/'.$mod_lanai->cfg['theme'].'/images/downarrow.gif" border="0" align="absmiddle"></a>';
                    }
                    ?>
                </td>
                <td align="center">
                    <?php
                    if ($this->rs->fields['fcgActive'] == 'y') {
                        echo '<a href="'.$_SERVER['PHP_SELF'].'?modname='.$_REQUEST['modname'].'&mf=faqedit&v=n&ac=gactive&mid='.$this->rs->fields['fcgId'].'"><img src="theme/'.$mod_lanai->cfg['theme'].'/images/ok.gif" border="0" align="absmiddle"></a>';
                    } else {
                        echo '<a href="'.$_SERVER['PHP_SELF'].'?modname='.$_REQUEST['modname'].'&mf=faqedit&v=y&ac=gactive&mid='.$this->rs->fields['fcgId'].'"><img src="theme/'.$mod_lanai->cfg['theme'].'/images/cancel.gif" border="0" align="absmiddle"></a>';
                    }
                    ?>
                </td>
                <td align="center">
                    <a href="<?php echo $_SERVER['PHP_SELF'].'?modname='.$_REQUEST['modname'].'&mf=faqgeditform&mid='.$this->rs->fields['fcgId']; ?>">
                        <img src="theme/<?php echo $mod_lanai->cfg['theme']; ?>/images/edit.gif" border="0" align="absmiddle">
                    </a>
                </td>
            </tr>
            <?php
            $rownum++;
            $this->rs->movenext();
        }
        ?>
        </table>
        </form>
        <?php
        $s = ob_get_contents();
        ob_end_clean();
        return $s;
    }

}
?>
