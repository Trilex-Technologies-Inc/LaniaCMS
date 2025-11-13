<?php
// Generate SEO-friendly URL
if ($cfg['seo'] == "yes") {
    $link = "/content/" . $this->rs->fields['conId'];
} else {
    $link = "/module.php?modname=content&cid=" . $this->rs->fields['conId'];
}
?>

<div class="card mb-3 shadow-sm border-0">
  <div class="card-body">
    <h5 class="card-title fw-bold mb-2">
      <?= htmlspecialchars($this->rs->fields['conTitle']); ?>
    </h5>
    <p class="card-text">
      <a href="<?= htmlspecialchars($link); ?>" class="text-decoration-none text-primary">
        <?= htmlspecialchars($cfg['url'] . $link); ?>
      </a>
    </p>
  </div>
</div>
