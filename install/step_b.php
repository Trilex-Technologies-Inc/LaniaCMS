<!-- Bootstrap 5 License Agreement Section -->
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <h5 class="card-title text-primary fw-bold mb-3">
                <?= _SETUP_LICENSE_AGREEMENT; ?>
            </h5>

            <!-- License Text -->
            <div class="mb-4">
                <textarea class="form-control" rows="15" readonly>
<?php require_once("../license.txt"); ?>
                </textarea>
            </div>

            <form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="step" value="1">

                <p class="mb-3">
                    <?= _SETUP_ASK_AGREEMENT; ?>
                </p>

                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-success">
                        <?= _SETUP_AGREE; ?>
                    </button>
                    <button type="button" class="btn btn-outline-danger" onclick="window.location.href='index.php';">
                        <?= _SETUP_DISAGREE; ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
