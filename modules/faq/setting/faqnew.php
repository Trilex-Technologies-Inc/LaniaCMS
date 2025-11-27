<?php
if (stripos($_SERVER['PHP_SELF'], "setting.php") === false) {
    die("You can't access this file directly...");
}

$module_name = basename(dirname(__FILE__));
$modfunction = "modules/$module_name/module.php";

if (file_exists($modfunction)) {
    include_once($modfunction);
} else {
    die("Module file not found.");
}

$faq = new Faq();
?>

<script src="include/tinymce/js/tinymce/tinymce.min.js"></script>

tinymce.init({
    selector: 'textarea.tinymce',
    height: 300,
 license_key: 'gpl',
    menubar: true,
    plugins: "preview paste importcss searchreplace autolink code visualblocks fullscreen image link media table charmap help emoticons",
    toolbar: 'undo redo | formatselect | bold italic underline | link image media table | alignleft aligncenter alignright | bullist numlist outdent indent | removeformat',
    paste_as_text: false,
    content_css: false
});
</script>

<span class="txtContentTitle"><?=_FAQ_SETTING; ?></span><br/><br/>
<?=_FAQ_NEW_INSTRUCTION; ?><br/><br/>

<img src="theme/<?=$cfg['theme']; ?>/images/save.gif" border="0" align="absmiddle"/>  
<a href="#" onclick="document.form.submit(); return false;"><?=_SAVE; ?></a>&nbsp;&nbsp;
<img src="theme/<?=$cfg['theme']; ?>/images/back.gif" border="0" align="absmiddle"/>
<a href="#" onclick="history.back(); return false;"><?=_BACK; ?></a><br><br>

<form name="form" method="post" action="<?=$_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="modname" value="faq">
    <input type="hidden" name="mf" value="faqedit">
    <input type="hidden" name="ac" value="new">

    <table cellpadding="3" cellspacing="1">
        <tr>
            <td><?=_FAQ_GROUP; ?></td>
            <td><?=$faq->getFaqGroupCombo("fcgId",""); ?></td>
        </tr>
        <tr>
            <td><?=_FAQ_QUESTION; ?></td>
            <td><input type="text" name="faiQuestion" size="60"/></td>
        </tr>
        <tr>
            <td valign="top"><?=_FAQ_ANSWER; ?></td>
            <td>
                <textarea name="faiAnswer" class="tinymce">This is some <strong>sample text</strong>.</textarea>
            </td>
        </tr>
    </table>
</form>
