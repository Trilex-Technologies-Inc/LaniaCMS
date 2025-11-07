<div class="container mt-5">
    <div class="card shadow-sm p-4 text-center">
        <!-- Success Message -->
        <div class="mb-3 d-flex align-items-center justify-content-center gap-2">
            <img src="../theme/default/images/ok.gif" alt="ok" style="height: 24px;">
            <strong class="text-success fs-5"><?= _SETUP_COMPLETE; ?></strong>
        </div>

        <!-- Warning Message -->
        <div class="mb-4 d-flex align-items-center justify-content-center gap-2">
            <img src="../theme/default/images/worning.gif" alt="warning" style="height: 24px;">
            <strong class="text-warning"><?= _SETUP_DELETEDIR; ?></strong>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-center gap-3">
            <form method="POST" action="../index.php">
                <button type="submit" class="btn btn-primary"><?= _SETUP_GOTOHOME; ?></button>
            </form>
            <form method="POST" action="../administrator/">
                <button type="submit" class="btn btn-secondary"><?= _SETUP_GOTOADMINPAGE; ?></button>
            </form>
        </div>
    </div>
</div>
