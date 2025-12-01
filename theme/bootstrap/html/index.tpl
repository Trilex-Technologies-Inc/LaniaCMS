<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#712cf9">
    <title>{$siteName}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: #0000001a;
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em #0000001a, inset 0 .125em .5em #00000026;
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
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
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .bi {
            width: 1em;
            height: 1em;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }

        /* GLOBAL STYLES */
        body {
            padding-top: 3rem;
            padding-bottom: 3rem;
            color: rgb(var(--bs-tertiary-color-rgb));
        }

        /* CAROUSEL STYLES */
        .carousel {
            margin-bottom: 4rem;
        }

        .carousel-caption {
            bottom: 3rem;
            z-index: 10;
        }

        .carousel-item {
            height: 32rem;
        }

        /* MARKETING CONTENT */
        .marketing .col-lg-4 {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .marketing .col-lg-4 p {
            margin-right: .75rem;
            margin-left: .75rem;
        }

        /* FEATURETTES */
        .featurette-divider {
            margin: 5rem 0;
        }

        .featurette-heading {
            letter-spacing: -.05rem;
        }

        /* RESPONSIVE CSS */
        @media (min-width: 40em) {
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-uppercase" href="{$smarty.server.PHP_SELF|dirname}">{$siteName}</a>
            {include_php file="blocks/bmenu/index.php"}
        </div>
    </nav>

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
            {include_php file="theme/bootstrap/block/login.inc.php"}
        </div>
    </div>

    {literal}
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const searchCollapseEl = document.getElementById('searchCollapse');
                const loginCollapseEl = document.getElementById('loginCollapse');
                const navbarCollapseEl = document.getElementById('navbarToggler');

                const searchCollapse = new bootstrap.Collapse(searchCollapseEl, {toggle: false});
                const loginCollapse = new bootstrap.Collapse(loginCollapseEl, {toggle: false});
                const navbarCollapse = new bootstrap.Collapse(navbarCollapseEl, {toggle: false});

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
        </script>
    {/literal}
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
                <svg aria-hidden="true" class="bd-placeholder-img" height="100%" preserveAspectRatio="xMidYMid slice" width="100%" xmlns="http://www.w3.org/2000/svg">
                    <rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect>
                </svg>
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1>Example headline.</h1>
                        <p class="opacity-75">Some representative placeholder content for the first slide of the carousel.</p>
                        <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <svg aria-hidden="true" class="bd-placeholder-img" height="100%" preserveAspectRatio="xMidYMid slice" width="100%" xmlns="http://www.w3.org/2000/svg">
                    <rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect>
                </svg>
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Another example headline.</h1>
                        <p>Some representative placeholder content for the second slide of the carousel.</p>
                        <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <svg aria-hidden="true" class="bd-placeholder-img" height="100%" preserveAspectRatio="xMidYMid slice" width="100%" xmlns="http://www.w3.org/2000/svg">
                    <rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect>
                </svg>
                <div class="container">
                    <div class="carousel-caption text-end">
                        <h1>One more for good measure.</h1>
                        <p>Some representative placeholder content for the third slide of this carousel.</p>
                        <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
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

    <div class="container marketing">
        <div class="row">
            {section name=i loop=$setBlockTop[0]}
                {$setBlockTop[0][i]}
            {/section}

            {section name=i loop=$setBlockCenter[0]}
                {$setBlockCenter[0][i]}
            {/section}

            {section name=i loop=$setBlockBottom[0]}
                {$setBlockBottom[0][i]}
            {/section}
        </div>

        <hr class="featurette-divider">
        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1">First featurette heading. <span class="text-body-secondary">It'll blow your mind.</span></h2>
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
                <h2 class="featurette-heading fw-normal lh-1">Oh yeah, it's that good. <span class="text-body-secondary">See for yourself.</span></h2>
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
                <h2 class="featurette-heading fw-normal lh-1">And lastly, this one. <span class="text-body-secondary">Checkmate.</span></h2>
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
    </div>

    <footer class="container">
        <p class="float-end"><a href="#">Back to top</a></p>
        <p>&copy; 2017–2025 powered by <a href="https://lanaicms.com/">LanaiCMS</a> </p>
    </footer>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>