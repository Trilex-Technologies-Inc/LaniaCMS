<TEXTAREA ROWS="20" COLS="100%" false><? require_once("../license.txt"); ?></TEXTAREA><BR><BR>
<FORM METHOD=POST ACTION="<?=$_SERVER['PHP_SELF']; ?>">
<INPUT TYPE="hidden" NAME="step" VALUE="1">
<?=_SETUP_ASK_AGREEMENT; ?>
<INPUT TYPE="submit" VALUE="<?=_SETUP_AGREE; ?>" > / <INPUT TYPE="button" VALUE="<?=_SETUP_DISAGREE; ?>" >
</FORM>