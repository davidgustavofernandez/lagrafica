<?php
require_once(dirname(__FILE__) . '/framework/_common/Class.Config.php');
$_c = new Configuration();
require_once(dirname(__FILE__) . '/framework/_lib/handler/Class.Error.Handler.php');
require_once(dirname(__FILE__) . '/framework/_lib/propagate/Class.Propagate.php');
require_once(dirname(__FILE__) . '/framework/_lib/messages/Class.Messages.php');
require_once(dirname(__FILE__) . '/framework/_lib/curl/Class.Curl.php');
require_once(dirname(__FILE__) . '/framework/_lib/session/Class.Session.php');
require_once(dirname(__FILE__) . '/framework/_lib/functions/Class.Functions.php');
//require_once( dirname(__FILE__) . '/framework/_lib/ip/Class.Ip.php');
require_once(dirname(__FILE__) . '/framework/_lib/token/Class.Token.php');
require_once(dirname(__FILE__) . '/framework/_lib/crypt/Class.Crypt.php');

$_e = new ErrorHandler();
$_p = new Propagate();
$_m = new Messages();
$_r = new Curl();
$_s = new Session();
$_f = new Functions();
$_t = new Token();
$_y = new Crypt();

# Recuperamos valores por querystring
$_p->setFilter(true);
$_metodo                = 'request';

# Variables a tratar
$messaje                = $_p->spread($_metodo, "msn", '');
$token_querystring      = $_p->spread($_metodo, "t", '');
$pager_page                        = $_p->spread($_metodo, 'pager_page', '');
// $id_section             = 2; //$_p->spread($_metodo,"ids",0);
$call                   = $_p->spread($_metodo, "call", 0);
$slug                   = $_p->spread($_metodo, 'slug', '');
$recover                = $_p->spread($_metodo, 'recover', '');
$_debug                 = true;

# URL webservices
$webservices = array('URL' => CONFIG_URL_WEBSERVICES);

# SESSION / TOKEN
require_once(dirname(__FILE__) . '/_sessions_token.php');

# RECORDS en archivos fisicos formato JSON
require_once(dirname(__FILE__) . '/_common_static_json.php');

# IDIOMA / 1 INGLES / 2 ESPAÑOL / 3 PORTUGUEZ
if ($session_language == '1') {
    $id_section         = 8;
} elseif ($session_language == '3') {
    $id_section         = 8;
} else {
    $id_section         = 8;
}

# Data section
$data_section = $_f->getArrayOnArrayByIndice($static_sections_array, 'id_section', $id_section);

# Tracking Variables
$tracking_id_section = $data_section['id_section'];
$tracking_variable = '';
$tracking_valor = '';
$tracking_name = $data_section['name'];

# Tracking
require_once(dirname(__FILE__) . '/_common_tracking.php');

# Archivo Header / Meta 
require_once(dirname(__FILE__) . '/_common_html_header.php');

// print_r($data_section);
// exit();
?>
<link rel="stylesheet" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/lib/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/brand.svg" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader End -->

    <!-- Header Start -->
    <?php require_once(dirname(__FILE__) . '/_common_nav.php'); ?>
    <!-- Header End -->

    <main id="index">
        <!-- Hero Star -->
        <section class="hero-sections section-padding30 background-tertiary">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col col-xl-6 col-lg-7 col-md-10 col-sm-10">
                        <div class="content text-center align-middle">
                            <div class="section-tittle animatedTop">
                                <h1>
                                    <?php echo $data_section['title']; ?>
                                </h1>
                                <p class="animatedTop">Nuestros términos y condiciones de la web.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero End -->

        <!-- Scroll -->
        <section class="scroll-section section-padding30" id="about-us">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="content-scroll">
                            <div class="intro-scroll">
                                <a href="#info" class="smoothscroll">
                                    <div class="mouse"></div>
                                </a>
                                <div class="end-top"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Scroll -->

        <!-- Terms and conditions -->
        <section class="terms section-padding--123 animatedBottom">
            <div class="container box--1 bg--2">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="ibox " id="ibox1">
                            <div class="ibox-title">
                                <h5>Colors buttons</h5>
                            </div>
                            <div class="ibox-content float-e-margins">
                                <div class="sk-spinner sk-spinner-wave">
                                    <div class="sk-rect1"></div>
                                    <div class="sk-rect2"></div>
                                    <div class="sk-rect3"></div>
                                    <div class="sk-rect4"></div>
                                    <div class="sk-rect5"></div>
                                </div>
                                <p>
                                    Use any of the available button classes to quickly create a styled button.
                                </p>

                                <h3 class="font-bold">
                                    Normal buttons
                                </h3>
                                <p>
                                    <button type="button" class="btn btn-default btn-lg">Default</button>
                                    <button type="button" class="btn btn-primary btn-lg">Primary</button>
                                    <button type="button" class="btn btn-success btn-lg">Success</button>
                                    <button type="button" class="btn btn-info btn-lg">Info</button>
                                    <button type="button" class="btn btn-warning btn-lg">Warning</button>
                                    <button type="button" class="btn btn-danger btn-lg">Danger</button>
                                    <button type="button" class="btn btn-link btn-lg">Link</button>
                                </p>
                                <p>
                                    <button type="button" class="btn btn-default">Default</button>
                                    <button type="button" class="btn btn-primary ladda-button" data-style="zoom-in">Primary</button>
                                    <button type="button" class="btn btn-success">Success</button>
                                    <button type="button" class="btn btn-info">Info</button>
                                    <button type="button" class="btn btn-warning">Warning</button>
                                    <button type="button" class="btn btn-danger">Danger</button>
                                    <button type="button" class="btn btn-link">Link</button>
                                </p>
                                <p>
                                    <button type="button" class="btn btn-default btn-sm">Default</button>
                                    <button type="button" class="btn btn-primary btn-sm">Primary</button>
                                    <button type="button" class="btn btn-success btn-sm">Success</button>
                                    <button type="button" class="btn btn-info btn-sm">Info</button>
                                    <button type="button" class="btn btn-warning btn-sm">Warning</button>
                                    <button type="button" class="btn btn-danger btn-sm">Danger</button>
                                    <button type="button" class="btn btn-link btn-sm">Link</button>
                                </p>
                                <p>
                                    <button type="button" class="btn btn-default btn-xs">Default</button>
                                    <button type="button" class="btn btn-primary btn-xs">Primary</button>
                                    <button type="button" class="btn btn-success btn-xs">Success</button>
                                    <button type="button" class="btn btn-info btn-xs">Info</button>
                                    <button type="button" class="btn btn-warning btn-xs">Warning</button>
                                    <button type="button" class="btn btn-danger btn-xs">Danger</button>
                                    <button type="button" class="btn btn-link btn-xs">Link</button>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- Terms and conditions -->

        <section class="test">

            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center">
                        <h2 class="section-heading"><?php echo $data_section['title'] ?></h2>
                        <hr class="my-4">
                        <p class="mb-5"><?php echo $data_section['descent']; ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h1>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h1>
                        <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
                        <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
                        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>
                        <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h5>
                        <h6>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="content pt-20 pb-20 background-primary">
                            <h4><?php echo $data_section['title']; ?></h3>
                                <p><?php echo $data_section['descent']; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="content pt-20 pb-20 background-secondary">
                            <h4><?php echo $data_section['title']; ?></h3>
                                <p><?php echo $data_section['descent']; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="content pt-20 pb-20 background-tertiary">
                            <h4><?php echo $data_section['title']; ?></h3>
                                <p><?php echo $data_section['descent']; ?></p>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="content pt-20 pb-20 background-quaternary">
                            <h4><?php echo $data_section['title']; ?></h3>
                                <p><?php echo $data_section['descent']; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="content pt-20 pb-20 background-septuagenarian">
                            <h4><?php echo $data_section['title']; ?></h3>
                                <p><?php echo $data_section['descent']; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="content pt-20 pb-20 background-tertiary">
                            <h4><?php echo $data_section['title']; ?></h3>
                                <p><?php echo $data_section['descent']; ?></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="content">

                            <div class="content-circle">
                                <div class="circle back-primary"></div>
                            </div>
                            <div class="content-circle">
                                <div class="circle back-primary1"></div>
                            </div>
                            <div class="content-circle">
                                <div class="circle back-primary2"></div>
                            </div>
                            <div class="content-circle">
                                <div class="circle back-primary3"></div>
                            </div>
                            <div class="content-circle">
                                <div class="circle back-primary4"></div>
                            </div>

                            <div class="content-circle">
                                <div class="circle back-secondary"></div>
                            </div>
                            <div class="content-circle">
                                <div class="circle back-secondary1"></div>
                            </div>
                            <div class="content-circle">
                                <div class="circle back-secondary2"></div>
                            </div>

                            <div class="content-circle">
                                <div class="circle back-tertiary"></div>
                            </div>
                            <div class="content-circle">
                                <div class="circle back-tertiary1"></div>
                            </div>
                            <div class="content-circle">
                                <div class="circle back-tertiary2"></div>
                            </div>
                            <div class="content-circle">
                                <div class="circle back-tertiary3"></div>
                            </div>

                            <div class="content-circle">
                                <div class="circle back-quaternary"></div>
                            </div>

                            <div class="content-circle">
                                <div class="circle back-septuagenarian"></div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12 mb-100">
                        <br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-primary" href="#">primary</a>
                        <a class="btn btn-primary btn-sm" href="#">primary sm</a>
                    </div>
                    <div class="col-lg-12">
                        <a class="btn btn-secondary" href="#">secondary</a>
                        <a class="btn btn-secondary btn-sm" href="#">primary sm</a>
                    </div>
                    <div class="col-lg-12">
                        <a class="btn btn-tertiary" href="#">tertiary</a>
                        <a class="btn btn-tertiary btn-sm" href="#">tertiary sm</a>
                    </div>

                    <div class="col-lg-12">
                        <button type="button" class="btn btn-primary">Primary</button>
                        <button type="button" class="btn btn-secondary">Secondary</button>
                        <button type="button" class="btn btn-success">Success</button>
                        <button type="button" class="btn btn-danger">Danger</button>
                        <button type="button" class="btn btn-warning">Warning</button>
                        <button type="button" class="btn btn-info">Info</button>
                        <button type="button" class="btn btn-light">Light</button>
                        <button type="button" class="btn btn-dark">Dark</button>
                        <button type="button" class="btn btn-link">Link</button>
                    </div>
                    <div class="col-lg-12">
                        <button type="button" class="btn btn-primary btn-sm">Primary</button>
                        <button type="button" class="btn btn-secondary btn-sm">Secondary</button>
                        <button type="button" class="btn btn-success btn-sm">Success</button>
                        <button type="button" class="btn btn-danger btn-sm">Danger</button>
                        <button type="button" class="btn btn-warning btn-sm">Warning</button>
                        <button type="button" class="btn btn-info btn-sm">Info</button>
                        <button type="button" class="btn btn-light btn-sm">Light</button>
                        <button type="button" class="btn btn-dark btn-sm">Dark</button>
                        <button type="button" class="btn btn-link btn-sm">Link</button>
                    </div>

                    <div class="col-lg-12 mb-100">
                        <br>
                    </div>

                </div>

            </div>
        </section>

        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="ibox " id="ibox1">
                        <div class="ibox-title">
                            <h5>Colors buttons</h5>
                        </div>
                        <div class="ibox-content float-e-margins">
                            <div class="sk-spinner sk-spinner-wave">
                                <div class="sk-rect1"></div>
                                <div class="sk-rect2"></div>
                                <div class="sk-rect3"></div>
                                <div class="sk-rect4"></div>
                                <div class="sk-rect5"></div>
                            </div>
                            <p>
                                Use any of the available button classes to quickly create a styled button.
                            </p>

                            <h3 class="font-bold">
                                Normal buttons
                            </h3>
                            <p>
                                <button type="button" class="btn btn-default btn-lg">Default</button>
                                <button type="button" class="btn btn-primary btn-lg">Primary</button>
                                <button type="button" class="btn btn-success btn-lg">Success</button>
                                <button type="button" class="btn btn-info btn-lg">Info</button>
                                <button type="button" class="btn btn-warning btn-lg">Warning</button>
                                <button type="button" class="btn btn-danger btn-lg">Danger</button>
                                <button type="button" class="btn btn-link btn-lg">Link</button>
                            </p>
                            <p>
                                <button type="button" class="btn btn-default">Default</button>
                                <button type="button" class="btn btn-primary ladda-button" data-style="zoom-in">Primary</button>
                                <button type="button" class="btn btn-success">Success</button>
                                <button type="button" class="btn btn-info">Info</button>
                                <button type="button" class="btn btn-warning">Warning</button>
                                <button type="button" class="btn btn-danger">Danger</button>
                                <button type="button" class="btn btn-link">Link</button>
                            </p>
                            <p>
                                <button type="button" class="btn btn-default btn-sm">Default</button>
                                <button type="button" class="btn btn-primary btn-sm">Primary</button>
                                <button type="button" class="btn btn-success btn-sm">Success</button>
                                <button type="button" class="btn btn-info btn-sm">Info</button>
                                <button type="button" class="btn btn-warning btn-sm">Warning</button>
                                <button type="button" class="btn btn-danger btn-sm">Danger</button>
                                <button type="button" class="btn btn-link btn-sm">Link</button>
                            </p>
                            <p>
                                <button type="button" class="btn btn-default btn-xs">Default</button>
                                <button type="button" class="btn btn-primary btn-xs">Primary</button>
                                <button type="button" class="btn btn-success btn-xs">Success</button>
                                <button type="button" class="btn btn-info btn-xs">Info</button>
                                <button type="button" class="btn btn-warning btn-xs">Warning</button>
                                <button type="button" class="btn btn-danger btn-xs">Danger</button>
                                <button type="button" class="btn btn-link btn-xs">Link</button>
                            </p>



                            <h3 class="font-bold">
                                Destacados
                            </h3>
                            <p>
                            <div class="bg-muted p-xs b-r-xs"> Example muted</div>
                            <div class="bg-primary p-xs b-r-xs"> Example primary</div>
                            <div class="bg-success p-xs b-r-xs"> Example success</div>
                            <div class="bg-info p-xs b-r-xs"> Example info</div>
                            <div class="bg-warning p-xs b-r-xs"> Example warning</div>
                            <div class="bg-danger p-xs b-r-xs"> Example danger</div>
                            </p>
                            <p>
                            <div class="bg-muted p-sm b-r-sm"> Example muted</div>
                            <div class="bg-primary p-sm b-r-sm"> Example primary</div>
                            <div class="bg-success p-sm b-r-sm"> Example success</div>
                            <div class="bg-info p-sm b-r-sm"> Example info</div>
                            <div class="bg-warning p-sm b-r-sm"> Example warning</div>
                            <div class="bg-danger p-sm b-r-sm"> Example danger</div>
                            </p>


                            <h3 class="font-bold">
                                Colors
                            </h3>
                            <p>
                            <div class="bg_gray-100 circle"></div>
                            <div class="bg_gray-200 circle"></div>
                            <div class="bg_gray-300 circle"></div>
                            <div class="bg_gray-400 circle"></div>
                            <div class="bg_gray-500 circle"></div>
                            <div class="bg_gray-600 circle"></div>
                            <div class="bg_gray-700 circle"></div>
                            <div class="bg_gray-800 circle"></div>
                            <div class="bg_gray-900 circle"></div>

                            <div class="bg_black circle"></div>

                            <div class="bg_navy circle"></div>
                            <div class="bg_dark-gray circle"></div>
                            <div class="bg_blue circle"></div>
                            <div class="bg_lazur circle"></div>
                            <div class="bg_yellow circle"></div>
                            <div class="bg_red circle"></div>
                            <div class="bg_red2 circle"></div>

                            <div class="bg_text-color circle"></div>
                            <div class="bg_gray circle"></div>
                            <div class="bg_light-gray circle"></div>
                            <div class="bg_label-badge-color circle"></div>
                            <div class="bg_light-blue circle"></div>
                            <div class="bg_white circle"></div>

                            <div class="bg_primary circle"></div>
                            <div class="bg_primary1 circle"></div>
                            <div class="bg_primary2 circle"></div>
                            <div class="bg_primary3 circle"></div>
                            <div class="bg_primary4 circle"></div>

                            <div class="bg_secondary circle"></div>
                            <div class="bg_secondary1 circle"></div>
                            <div class="bg_secondary2 circle"></div>

                            <div class="bg_tertiary circle"></div>
                            <div class="bg_tertiary1 circle"></div>
                            <div class="bg_tertiary2 circle"></div>
                            <div class="bg_tertiary3 circle"></div>
                            </p>
                        </div>
                    </div>
                </div>




            </div>

            <div class="col-lg-12 mb-100">
                <br>
            </div>




            <div class="row main-body">

                <div class="col-12">
                    <div class="mt-4 bg-body rounded shadow-sm">
                        <div class="content-body p-4">
                            <h4>Normal Buttons</h4>
                            <p class="description"> Use any of the available button classes to quickly create a styled button.</p>
                            <div class="template-demo">
                                <button type="button" class="btn btn-primary"> Primary </button>
                                <button type="button" class="btn btn-secondary"> Secondary </button>
                                <button type="button" class="btn btn-success"> Success </button>
                                <button type="button" class="btn btn-danger"> Danger </button>
                                <button type="button" class="btn btn-warning"> Warning </button>
                                <button type="button" class="btn btn-info">Info</button>
                                <button type="button" class="btn btn-light">Light</button>
                                <button type="button" class="btn btn-dark">Dark</button>
                                <button type="button" class="btn btn-link">Link</button>
                            </div>
                        </div>
                        <div class="content-body p-4 pt-1">
                            <h4>Rounded Buttons</h4>
                            <p class="description"> Add class <code>.btn-rounded</code></p>
                            <div class="template-demo">
                                <button type="button" class="btn btn-primary btn-rounded"> Primary </button>
                                <button type="button" class="btn btn-secondary btn-rounded"> Secondary </button>
                                <button type="button" class="btn btn-success btn-rounded"> Success </button>
                                <button type="button" class="btn btn-danger btn-rounded"> Danger </button>
                                <button type="button" class="btn btn-warning btn-rounded"> Warning </button>
                                <button type="button" class="btn btn-info btn-rounded">Info</button>
                                <button type="button" class="btn btn-light btn-rounded">Light</button>
                                <button type="button" class="btn btn-dark btn-rounded">Dark</button>
                                <button type="button" class="btn btn-link btn-rounded">Link</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="mt-4 bg-body rounded shadow-sm">
                        <div class="content-body p-4">
                            <h4>Button Size</h4>
                            <p> Use class <code>.btn-{size}</code> </p>
                            <div class="template-demo">
                                <button type="button" class="btn btn-secondary btn-lg"> btn-lg </button>
                                <button type="button" class="btn btn-secondary btn-md"> btn-md </button>
                                <button type="button" class="btn btn-secondary btn-sm"> btn-sm </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="mt-4 bg-body rounded shadow-sm">
                        <div class="content-body p-4">
                            <h4>Block Buttons</h4>
                            <p> Add class <code>.btn-block</code> </p>
                            <div class="template-demo">
                                <button type="button" class="btn btn-info btn-lg btn-block"> Block buttons <i class="fa fa-bars float-right" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btn btn-dark btn-lg btn-block"> Block buttons </button>
                                <button type="button" class="btn btn-primary btn-lg btn-block">
                                    <i class="mdi mdi-account"></i> Block buttons </button>
                                <button type="button" class="btn btn-outline-secondary btn-lg btn-block"> Block buttons </button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>



    </main>


    <!-- Footer Start -->
    <?php require_once(dirname(__FILE__) . '/_common_footer.php'); ?>
    <!-- Footer End -->

    <!-- Scroll Up -->
    <div id="back-top">
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

    <!-- Scripts -->
    <?php require_once(dirname(__FILE__) . '/_common_srcipt.php'); ?>

    <script>
        var id_section = '8';
    </script>

    <script type="text/javascript" src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/js/main.js"></script>
    <script type="text/javascript" src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/lib/scrollreveal/scrollreveal.min.js"></script>

    <script>
        $('.animate-clip').animatedHeadline({
            animationType: 'clip',
            revealAnimationDelay: 3000
        });
    </script>

    <!-- Hero Plugins -->
    <script type="text/javascript" src="assets/js/plugins/jquery.hero.js"></script>
    <script>
        $(window).on('load resize', function() {
            var slider1 = $('.hero-sections .container').hero({
                responsive: false,
                height_mode: [{
                    'mode': 'viewport',
                    'type': 'less',
                    'valor': 400
                }],
                background: [{
                    'size': 'cover',
                    'repeat': 'no-repeat',
                    'position': 'top center',
                }],
                images: [{
                    'desktop': '',
                    'tablet_portrait': '',
                    'tablet_landscape': '',
                    'mobile_portrait': '',
                    'mobile_landscape': '',
                }],
                // image: './assets/img/works/big/1_nuestro_sueno_1.jpg',
                // height: '500',
            });
        });
    </script>

    <script>
        window.addEventListener('DOMContentLoaded', function() {
            (function() {
                var config = {
                    viewFactor: 0.15,
                    duration: 1200,
                    distance: "150px",
                    scale: 1,
                    reset: false,
                }

                window.sr = new ScrollReveal(config);
                sr.reveal('.animatedBottom', {
                    origin: 'bottom'
                });
                sr.reveal('.animatedLeft', {
                    origin: 'left'
                });
                sr.reveal('.animatedRight', {
                    origin: 'right'
                });
                sr.reveal('.animatedTop', {
                    origin: 'top'
                });
                sr.reveal('.animatedFade', {
                    distance: "0px",
                });
            })()
        }, true);
    </script>

    <!-- Google Analytics -->
    <?php require_once(dirname(__FILE__) . '/_common_analyticstracking.php'); ?>

</body>

</html>