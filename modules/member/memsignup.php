<?php
if (!eregi("module.php", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}

$module_name = basename(dirname(__FILE__));
$modfunction = "modules/$module_name/module.php";
include_once($modfunction);

// get user info
$mem_lanai = new User();
$rslogin = $mem_lanai->getUserLogin($_REQUEST['userLogin']);

if ($rslogin->recordcount() > 0) {
    $sys_lanai->getErrorBox(_LOGIN_EXIST . " <a href=\"#\" onClick=\"javascript:history.back();\">_BACK</a>");
} else {
    if ($_REQUEST['ac'] == "lostpass") {
        if (empty($_REQUEST['userFname']) || empty($_REQUEST['userLname']) || empty($_REQUEST['userEmail']) || empty($_REQUEST['userLogin']) || empty($_REQUEST['userPassword1']) || empty($_REQUEST['userPassword2'])) {
            $sys_lanai->getErrorBox(_REQUIRE_FIELDS . " <a href=\"#\" onClick=\"javascript:history.back();\">_BACK</a>");
        } else {
            if ($_REQUEST['userPassword1'] == $_REQUEST['userPassword2'] && $_REQUEST['captext'] == $_SESSION['captcha']) {
                $rs = $mem_lanai->setUserRegister($_REQUEST['userFname'], $_REQUEST['userLname'], $_REQUEST['userEmail'], $_REQUEST['userLogin'], $_REQUEST['userPassword1']);
                if (empty($rs)) {
                    $sys_lanai->getErrorBox(_CANNOT_REGISTER . " <a href=\"#\" onClick=\"javascript:history.back();\">_BACK</a>");
                } else {
                    // success message
                    ?>
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <img src="theme/<?=$cfg['theme']; ?>/images/ok.gif" class="me-2" />
                        <div><?=_REG_COMPLETE;?></div>
                    </div>
                    <?php
                }
            }
        }
    } else {
        ?>
        <h5 class="mb-2 fw-bold text-primary"><?=_USER_SIGNUP;?></h5>

        <p class="mb-4 text-muted small"><?=_USER_SIGNUP_INSTRUCTION;?></p>

        <form method="post" action="<?=$_SERVER['PHP_SELF']?>" class="row g-3 mb-5">
            <input type="hidden" name="modname" value="member"/>
            <input type="hidden" name="mf" value="memsignup"/>
            <input type="hidden" name="ac" value="lostpass"/>

            <div class="col-md-6">
                <label for="userFname" class="form-label"><?=_USER_FNAME;?></label>
                <input type="text" class="form-control" id="userFname" name="userFname">
            </div>

            <div class="col-md-6">
                <label for="userLname" class="form-label"><?=_USER_LNAME;?></label>
                <input type="text" class="form-control" id="userLname" name="userLname">
            </div>

            <div class="col-12">
                <label for="userEmail" class="form-label"><?=_USER_EMAIL;?></label>
                <input type="email" class="form-control" id="userEmail" name="userEmail">
            </div>

            <div class="col-12">
                <label for="userLogin" class="form-label"><?=_USER_LOGIN;?></label>
                <input type="text" class="form-control" id="userLogin" name="userLogin">
            </div>

            <div class="col-md-6">
                <label for="userPassword1" class="form-label"><?=_USER_PASSWORD;?></label>
                <input type="password" class="form-control" id="userPassword1" name="userPassword1">
            </div>

            <div class="col-md-6">
                <label for="userPassword2" class="form-label"><?=_USER_RE_PASSWORD;?></label>
                <input type="password" class="form-control" id="userPassword2" name="userPassword2">
            </div>

            <div class="col-md-6">
                <label for="captext" class="form-label"><?=_MEMBER_CAPTEXT;?></label>
                <input type="text" class="form-control" id="captext" name="captext" maxlength="5">
            </div>

            <div class="col-md-6 d-flex align-items-end">
                <img src="images/captcha.php?hash=<?=md5(time()); ?>" alt="captcha" class="img-fluid">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    <img src="theme/<?=$cfg['theme']; ?>/images/save.gif" class="me-1"/><?=_SAVE;?>
                </button>
                <button type="button" class="btn btn-secondary" onclick="history.back();">
                    <img src="theme/<?=$cfg['theme']; ?>/images/back.gif" class="me-1"/><?=_BACK;?>
                </button>
            </div>
        </form>
        <?php
    }
}
?>
