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
$pager_page             = $_p->spread($_metodo, 'pager_page', '');
$id_section             = $_p->spread($_metodo, "ids", 0);
$call                   = $_p->spread($_metodo, "call", 0);
$slug                   = $_p->spread($_metodo, 'slug', '');
$_debug                 = true;

# URL webservices
$webservices = array('URL' => CONFIG_URL_WEBSERVICES);

# SESSION / TOKEN
require_once(dirname(__FILE__) . '/_sessions_token.php');

# RECORDS en archivos fisicos formato JSON
require_once(dirname(__FILE__) . '/_common_static_json.php');



if (empty($id_section) && empty($slug)) {
    header("Location: " . CONFIG_HOST_NAME_FRONTEND);
    exit();
}

// print_r($static_sections_array);
// echo $slug;
// print_r($_f->getStringOffArrayByIndice($static_sections_array, 'slug', $slug, 'name'));
// exit();

// CHECK IF EXIST SECTION
if (
    empty($_f->getStringOffArrayByIndice($static_sections_array, 'id_section', $id_section, 'name')) &&
    empty($_f->getStringOffArrayByIndice($static_sections_array, 'slug', $slug, 'name'))
) {
    header("Location: " . CONFIG_HOST_NAME_FRONTEND . "");
    exit();
} elseif (!empty($_f->getStringOffArrayByIndice($static_sections_array, 'slug', $slug, 'name')) && !empty($slug)) {
    $id_section = $_f->getStringOffArrayByIndice($static_sections_array, 'slug', $slug, 'id_section');
}


# IDIOMA / 1 INGLES / 2 ESPAÑOL / 3 PORTUGUEZ
// if ($session_language == '1') {
//     $id_section         = 8;
// } elseif ($session_language == '3') {
//     $id_section         = 8;
// } else {
//     $id_section         = 8;
// }

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

?>
<link rel="stylesheet" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/lib/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="<?php echo $data_section['slug']; ?>">

    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/logo/brand.svg" alt="">
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
                                <p class="animatedTop"><?php echo $data_section['descent']; ?></p>
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
                                <div class="smoothscroll">
                                    <div class="mouse"></div>
                                </div>
                                <div class="end-top"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Scroll -->

        <!-- Sections -->
        <section class="terms section-padding--123 animatedBottom">
            <div class="container box--1 bg--2">
                <div class="row justify-content-center">
                    <div class="col col-xl-12 col-lg-7 col-md-10 col-sm-10">
                        <div class="section-tittle text-center">
                            <!-- <h1 class="animatedFade"><?php echo $data_section['title']; ?></h1> -->
                            <?php echo str_replace("[[[CTA]]]", '', $data_section['detail']); ?>
                            <a href="http://" target="_blank" class=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sections -->

        <!-- Contacts -->
        <section class="contact-section" id="contacto">
            <div class="container">

                <div class="row d-flex justify-content-center animatedFade">
                    <div class="col col-xl-12 col-lg-8 col-md-11 col-sm-11">
                        <div class="section-tittle section-tittle3  text-center">
                            <h1>Contactos</h1>
                            <h6>También atendemos por WhatsApp.</h6>
                        </div>
                    </div>
                </div>


                <div class="row d-flex justify-content-center">

                    <div class="col col-xl-4 col-lg-4 col-md-12 col-sm-12 animatedRight">
                        <div class="section-contacts text-center mb-90">
                            <div class="btn btn-light btn-lg btn-rounded contactAction" data-channel="phone" data-phone="<?php echo $static_settings_array[0]['contact_phone']; ?>" data-email="" data-subject="" data-body="">
                                <div class=" content-fa"><i class="fa fa-phone fa-3x mb-3 sr-contact"></i></div>
                                <div class="content-number">
                                    <p><?php echo $static_settings_array[0]['contact_phone']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col col-xl-4 col-lg-4 col-md-12 col-sm-12 animatedRight">
                        <div class="section-contacts text-center mb-90">
                            <div class="btn btn-light btn-lg btn-rounded contactAction" data-channel="whatsapp" data-phone="<?php echo $static_settings_array[0]['contact_whatsapp']; ?>" data-email="" data-subject="" data-body="">
                                <div class="content-fa"><i class="fa fa-whatsapp fa-3x mb-3 sr-contact"></i></div>
                                <div class="content-number">
                                    <p class="button-square">Escríbenos por WhatsApp</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col col-xl-4 col-lg-4 col-md-12 col-sm-12 animatedRight">
                        <div class="section-contacts text-center mb-90">
                            <div class="btn btn-light btn-lg btn-rounded contactAction" data-channel="email" data-phone="" data-email="<?php echo $static_settings_array[0]['contact_email']; ?>" data-subject="<?php echo $static_settings_array[0]['contact_email_subject']; ?>" data-body="<?php echo $static_settings_array[0]['contact_email_body']; ?>">
                                <div class="content-fa"><i class="fa fa-envelope-o fa-3x mb-3 sr-contact"></i></div>
                                <div class="content-number">
                                    <p><?php echo $static_settings_array[0]['contact_email']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>

        </section>
        <!-- Contacts -->

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
        var id_section = <?php echo $id_section; ?>;
    </script>

    <script type="text/javascript" src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/js/main.js"></script>
    <script type="text/javascript" src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/lib/scrollreveal/scrollreveal.min.js"></script>

    <!-- Hero Plugins -->
    <script type="text/javascript" src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/js/plugins/jquery.hero.js"></script>
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
                // image: '<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/works/big/1_nuestro_sueno_1.jpg',
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