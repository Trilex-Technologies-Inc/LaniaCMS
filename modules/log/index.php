<?php
include "include/swfchart/charts.php";

$obLog = new SysLog();
$rs = $obLog->loadLastLog(20);
?>



<div class="container my-4">
    <h4 class="text-primary mb-3"><?=_LOG_STAT; ?></h4>

    <h5 class="text-secondary mb-3"><?=_LOG_DETAIL; ?></h5>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col"><?=_LOG_DATE; ?></th>
                    <th scope="col"><?=_LOG_IP; ?></th>
                    <th scope="col"><?=_LOG_URI; ?></th>
                </tr>
            </thead>
            <tbody>
                <?php while (!$rs->EOF) { ?>
                <tr>
                    <td><?=adodb_date2("d M Y H:i", $rs->fields['logDatetime']); ?></td>
                    <td><?=$rs->fields['logIP'];?></td>
                    <td><?=$rs->fields['pagUrl'];?></td>
                </tr>
                <?php $rs->MoveNext(); } ?>
            </tbody>
        </table>
    </div>
</div>
