<?php
/* Smarty version 3.1.48, created on 2025-10-31 12:31:27
  from '/home/mmomen/public_html/laniazip/theme/vertex/html/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6904e45fab9951_05412119',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8fe3acfee483e44600e443c9461af18845057350' => 
    array (
      0 => '/home/mmomen/public_html/laniazip/theme/vertex/html/index.tpl',
      1 => 1761928245,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6904e45fab9951_05412119 (Smarty_Internal_Template $_smarty_tpl) {
?>    <meta name="theme-color" content="#712cf9">
    
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: #0000001a;
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em #0000001a, inset 0 .125em .5em #00000026
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8
      }

      .bd-mode-toggle {
        z-index: 1500
      }

      .bd-mode-toggle .bi {
        width: 1em;
        height: 1em
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important
      }
      /* GLOBAL STYLES
-------------------------------------------------- */
/* Padding below the footer and lighter body text */

body {
  padding-top: 3rem;
  padding-bottom: 3rem;
  color: rgb(var(--bs-tertiary-color-rgb));
}


/* CUSTOMIZE THE CAROUSEL
-------------------------------------------------- */

/* Carousel base class */
.carousel {
  margin-bottom: 4rem;
}
/* Since positioning the image, we need to help out the caption */
.carousel-caption {
  bottom: 3rem;
  z-index: 10;
}

/* Declare heights because of positioning of img element */
.carousel-item {
  height: 32rem;
}


/* MARKETING CONTENT
-------------------------------------------------- */

/* Center align the text within the three columns below the carousel */
.marketing .col-lg-4 {
  margin-bottom: 1.5rem;
  text-align: center;
}
/* rtl:begin:ignore */
.marketing .col-lg-4 p {
  margin-right: .75rem;
  margin-left: .75rem;
}
/* rtl:end:ignore */


/* Featurettes
------------------------- */

.featurette-divider {
  margin: 5rem 0; /* Space out the Bootstrap <hr> more */
}

/* Thin out the marketing headings */
/* rtl:begin:remove */
.featurette-heading {
  letter-spacing: -.05rem;
}

/* rtl:end:remove */

/* RESPONSIVE CSS
-------------------------------------------------- */

@media (min-width: 40em) {
  /* Bump up size of carousel content */
  .carousel-caption p {
    margin-bottom: 1.25rem;
    
    line-height: 1.4;
  }

  .featurette-heading {
    font-size: 50px;
  }
}

@media (min-width: 62em) {
  .featurette-heading {
    margin-top: 7rem;
  }
}
    </style>
  </head>
  <body>
    <header data-bs-theme="dark">
   

     
       
                <?php include_once ('/home/mmomen/public_html/laniazip/blocks/bmenu/index.php');?>

                <!-- Search Collapse -->
<div class="collapse bg-dark border-top border-secondary py-4" id="searchCollapse">
  <div class="container">
    <form action="module.php" method="get" class="row g-3">
      <input type="hidden" name="modname" value="search">
      <div class="col-12">
        <label for="keyword" class="form-label text-light">Keyword</label>
        <input type="text" class="form-control bg-secondary text-light border-0" id="keyword" name="keyword">
      </div>

      <div class="col-12">
        <label for="item" class="form-label text-light">Locate in</label>
        <select name="item" id="item" class="form-select bg-secondary text-light border-0 mb-2">
          <option value="content">Content</option>
          <option value="news">News</option>
          <option value="forum">Forum</option>
        </select>

        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="method" value="word" id="methodWord">
          <label class="form-check-label text-light" for="methodWord">Word</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="method" value="phase" id="methodPhase" checked>
          <label class="form-check-label text-light" for="methodPhase">Phrase</label>
        </div>
      </div>

      <div class="col-12">
        <button type="submit" class="btn btn-outline-light w-100">Search</button>
      </div>
    </form>
  </div>
</div>

<!-- Login Collapse -->
<div class="collapse bg-dark border-top border-secondary py-4" id="loginCollapse">
  <div class="container">
   
     <?php include_once ('/home/mmomen/public_html/laniazip/theme/vertex/block/login.inc.php');?>

          
      
    
  </div>
</div>

<!-- Mutual collapse control -->
<?php echo '<script'; ?>
>
document.addEventListener('DOMContentLoaded', () => {
  const searchCollapseEl = document.getElementById('searchCollapse');
  const loginCollapseEl = document.getElementById('loginCollapse');
  const navbarCollapseEl = document.getElementById('navbarToggler');

  const searchCollapse = new bootstrap.Collapse(searchCollapseEl, { toggle: false });
  const loginCollapse = new bootstrap.Collapse(loginCollapseEl, { toggle: false });
  const navbarCollapse = new bootstrap.Collapse(navbarCollapseEl, { toggle: false });

  // Mutual collapse: search
  searchCollapseEl.addEventListener('show.bs.collapse', () => {
    loginCollapse.hide();
    navbarCollapse.hide();
  });

  // Mutual collapse: login
  loginCollapseEl.addEventListener('show.bs.collapse', () => {
    searchCollapse.hide();
    navbarCollapse.hide();
  });

  // Mutual collapse: navbar menu
  navbarCollapseEl.addEventListener('show.bs.collapse', () => {
    searchCollapse.hide();
    loginCollapse.hide();
  });
});
<?php echo '</script'; ?>
>



            
            
      
    </header>
    <main>
      <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <svg aria-hidden="true" class="bd-placeholder-img " height="100%" preserveAspectRatio="xMidYMid slice" width="100%" xmlns="http://www.w3.org/2000/svg">
              <rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect>
            </svg>
            <div class="container">
              <div class="carousel-caption text-start">
                <h1>Example headline.</h1>
                <p class="opacity-75">Some representative placeholder content for the first slide of the carousel.</p>
                <p>
                  <a class="btn btn-lg btn-primary" href="#">Sign up today</a>
                </p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <svg aria-hidden="true" class="bd-placeholder-img " height="100%" preserveAspectRatio="xMidYMid slice" width="100%" xmlns="http://www.w3.org/2000/svg">
              <rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect>
            </svg>
            <div class="container">
              <div class="carousel-caption">
                <h1>Another example headline.</h1>
                <p>Some representative placeholder content for the second slide of the carousel.</p>
                <p>
                  <a class="btn btn-lg btn-primary" href="#">Learn more</a>
                </p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <svg aria-hidden="true" class="bd-placeholder-img " height="100%" preserveAspectRatio="xMidYMid slice" width="100%" xmlns="http://www.w3.org/2000/svg">
              <rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect>
            </svg>
            <div class="container">
              <div class="carousel-caption text-end">
                <h1>One more for good measure.</h1>
                <p>Some representative placeholder content for the third slide of this carousel.</p>
                <p>
                  <a class="btn btn-lg btn-primary" href="#">Browse gallery</a>
                </p>
              </div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <!-- Marketing messaging and featurettes
  ================================================== -->
      <!-- Wrap the rest of the page in another container to center all the content. -->
      <div class="container marketing">
        <!-- Three columns of text below the carousel -->
        <div class="row">
           <?php
$__section_i_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['setBlockTop']->value[0]) ? count($_loop) : max(0, (int) $_loop));
$__section_i_0_total = $__section_i_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_0_total !== 0) {
for ($__section_i_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_0_iteration <= $__section_i_0_total; $__section_i_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
        <?php echo $_smarty_tpl->tpl_vars['setBlockTop']->value[0][(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)];?>

      <?php
}
}
?>

      <!-- Center Blocks -->
      <?php
$__section_i_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['setBlockCenter']->value[0]) ? count($_loop) : max(0, (int) $_loop));
$__section_i_1_total = $__section_i_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_1_total !== 0) {
for ($__section_i_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_1_iteration <= $__section_i_1_total; $__section_i_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
        <?php echo $_smarty_tpl->tpl_vars['setBlockCenter']->value[0][(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)];?>

      <?php
}
}
?>

      <!-- Bottom Blocks -->
      <?php
$__section_i_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['setBlockBottom']->value[0]) ? count($_loop) : max(0, (int) $_loop));
$__section_i_2_total = $__section_i_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_i'] = new Smarty_Variable(array());
if ($__section_i_2_total !== 0) {
for ($__section_i_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] = 0; $__section_i_2_iteration <= $__section_i_2_total; $__section_i_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']++){
?>
        <?php echo $_smarty_tpl->tpl_vars['setBlockBottom']->value[0][(isset($_smarty_tpl->tpl_vars['__smarty_section_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_i']->value['index'] : null)];?>

      <?php
}
}
?>
        </div>
        <!-- /.row -->
        <!-- START THE FEATURETTES -->
        <hr class="featurette-divider">
        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading fw-normal lh-1">First featurette heading. <span class="text-body-secondary">It’ll blow your mind.</span>
            </h2>
            <p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting prose here.</p>
          </div>
          <div class="col-md-5">
            <svg aria-label="Placeholder: 500x500" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" height="500" preserveAspectRatio="xMidYMid slice" role="img" width="500" xmlns="http://www.w3.org/2000/svg">
              <title>Placeholder</title>
              <rect width="100%" height="100%" fill="var(--bs-secondary-bg)"></rect>
              <text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text>
            </svg>
          </div>
        </div>
        <hr class="featurette-divider">
        <div class="row featurette">
          <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading fw-normal lh-1">Oh yeah, it’s that good. <span class="text-body-secondary">See for yourself.</span>
            </h2>
            <p class="lead">Another featurette? Of course. More placeholder content here to give you an idea of how this layout would work with some actual real-world content in place.</p>
          </div>
          <div class="col-md-5 order-md-1">
            <svg aria-label="Placeholder: 500x500" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" height="500" preserveAspectRatio="xMidYMid slice" role="img" width="500" xmlns="http://www.w3.org/2000/svg">
              <title>Placeholder</title>
              <rect width="100%" height="100%" fill="var(--bs-secondary-bg)"></rect>
              <text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text>
            </svg>
          </div>
        </div>
        <hr class="featurette-divider">
        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading fw-normal lh-1">And lastly, this one. <span class="text-body-secondary">Checkmate.</span>
            </h2>
            <p class="lead">And yes, this is the last block of representative placeholder content. Again, not really intended to be actually read, simply here to give you a better view of what this would look like with some actual content. Your content.</p>
          </div>
          <div class="col-md-5">
            <svg aria-label="Placeholder: 500x500" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" height="500" preserveAspectRatio="xMidYMid slice" role="img" width="500" xmlns="http://www.w3.org/2000/svg">
              <title>Placeholder</title>
              <rect width="100%" height="100%" fill="var(--bs-secondary-bg)"></rect>
              <text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text>
            </svg>
          </div>
        </div>
        <hr class="featurette-divider">
        <!-- /END THE FEATURETTES -->
      </div>
      <!-- /.container -->
      <!-- FOOTER -->
      <footer class="container">
        <p class="float-end">
          <a href="#">Back to top</a>
        </p>
        <p>&copy; 2017–2025 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a>
        </p>
      </footer>
    </main>
   <?php echo '<script'; ?>

        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">
<?php echo '</script'; ?>
>
<?php }
}
