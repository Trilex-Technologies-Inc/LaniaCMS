<!-- ✅ Optional Theme CSS -->
<link rel="stylesheet" href="theme/<?= htmlspecialchars($cfgTheme) ?>/style/dhtml-horiz.css" />

<!--[if gte IE 5.5]>
<script src="theme/<?= htmlspecialchars($cfgTheme) ?>/style/dhtml.js" type="text/javascript"></script>
<![endif]-->

<!-- �? Main Layout -->
<div class="container my-4">
  <!-- Header Section -->
  <header class="header">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="logo-container">
          <img   src="theme/{$cfgTheme}/images/logo.gif" alt="RedLine Software Logo" class="logo me-3">
          <div>
            <h1 class="h3 mb-1 fw-bold">RedLine Software</h1>
            <p class="mb-0 opacity-75">Advanced Software Solutions</p>
          </div>
        </div>
      </div>
      <div class="col-md-6">

        {include_php file="theme/vertex/block/login.inc.php"}

      </div>
    </div>
  </header>




  <nav class="navbar navbar-expand-lg navbar-custom mb-4">
    <div class="container-fluid">
      {include_php file="blocks/bmenu/index.php"}
    </div>
  </nav>


  <main class="row g-4">


    <div class="col-lg-9 col-md-8">
      <!-- Top Blocks -->
      {section name=i loop=$setBlockTop[0]}
        {$setBlockTop[0][i]}
      {/section}

      <!-- Center Blocks -->
      {section name=i loop=$setBlockCenter[0]}
        {$setBlockCenter[0][i]}
      {/section}

      <!-- Bottom Blocks -->
      {section name=i loop=$setBlockBottom[0]}
        {$setBlockBottom[0][i]}
      {/section}
    </div>


    <aside class="col-lg-3 col-md-4">
      <div class="p-3 bg-light rounded shadow-sm h-100">
        {section name=i loop=$setBlockRight[0]}
          {$setBlockRight[0][i]}
        {/section}
      </div>
    </aside>

  </main>


  <footer class="text-center text-secondary small py-3 mt-5 border-top">
    &copy; <?= date('Y') ?> RedLine Software. All Rights Reserved.
  </footer>

</div>

<!-- ✅ Bootstrap Bundle JS -->
<script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">
</script>
