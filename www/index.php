<?php
require_once(dirname(__FILE__) . '/framework/_common/Class.Config.php');                        //Configuracion de variables
$_c = new Configuration();         // Todas las configuraciones // Constantes etc, etc.
require_once(dirname(__FILE__) . '/framework/_lib/handler/Class.Error.Handler.php');    //Trackeo de errores
require_once(dirname(__FILE__) . '/framework/_lib/propagate/Class.Propagate.php');        //La libreria "Propagate" permite propagar variables
require_once(dirname(__FILE__) . '/framework/_lib/messages/Class.Messages.php');        //La libreria "Messages" trata mensajes genericos
require_once(dirname(__FILE__) . '/framework/_lib/curl/Class.Curl.php');                //La libreria "Curl" permite recursos remotos
require_once(dirname(__FILE__) . '/framework/_lib/session/Class.Session.php');            //La libreria "Session" trata las sessiones
require_once(dirname(__FILE__) . '/framework/_lib/functions/Class.Functions.php');        //Clase con funciones auxiliares
//require_once( dirname(__FILE__) . '/framework/_lib/ip/Class.Ip.php');					//La libreria "Ip" permite obtener la IP del usuario
require_once(dirname(__FILE__) . '/framework/_lib/token/Class.Token.php');                //La libreria "Token" genera un codigo único
require_once(dirname(__FILE__) . '/framework/_lib/crypt/Class.Crypt.php');

$_e = new ErrorHandler();     // Trakeo de todos los errores
$_p = new Propagate();         // Trata GET, POST, REQUEST aplica filtro de injection.
$_m = new Messages();        // Contien los mensajes de alerta o error
$_r = new Curl();            // Trata servicios
$_s = new Session();         // Tato sessiones
$_f = new Functions();         // Funciones auxiliares
$_t = new Token();
$_y = new Crypt();

# Recuperamos valores por querystring
$_p->setFilter(true);
$_metodo                = 'request';

# Variables a tratar
$messaje                = $_p->spread($_metodo, "msn", '');
$token_querystring      = $_p->spread($_metodo, "t", '');
$pager_page                = $_p->spread($_metodo, 'pager_page', '');
// $id_section             = 2; //$_p->spread($_metodo,"ids",0);
$call                   = $_p->spread($_metodo, "call", 0);
$slug                   = $_p->spread($_metodo, 'slug', '');

$length                 = $_p->spread($_metodo, 'length', 0);
$draw                   = $_p->spread($_metodo, 'draw', 0);
$order                  = $_p->spread($_metodo, 'order', '');
$columns                = $_p->spread($_metodo, 'columns', '');
$start                  = $_p->spread($_metodo, 'start', 0);
$search                 = $_p->spread($_metodo, 'search', '');

$_debug                 = true;

# URL webservices
$webservices = array('URL' => CONFIG_URL_WEBSERVICES);

# SESSION / TOKEN
require_once(dirname(__FILE__) . '/_sessions_token.php');

# RECORDS en archivos fisicos formato JSON
require_once(dirname(__FILE__) . '/_common_static_json.php');


// if (empty($slug)) {
//     header("Location: " . CONFIG_HOST_NAME_FRONTEND);
//     exit();
// }

// if (empty($token_session_data_user) || $token_session_data_user == 'sindatos') {
//     if (isset($_SERVER['HTTPS'])) {
//         $laUri = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//     } else {
//         $laUri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//     }
//     $_s->setFlag();
//     $_s->setVariable('user_redirect', $laUri);

//     header("Location: " . CONFIG_HOST_NAME_FRONTEND . "login.php?msn=30&");
//     exit();
// }
// if (empty($_f->getStringOffArrayByIndice($token_session_data_user_permissions, 'permission', 'index', 'permission'))) {
//     header("Location: " . CONFIG_HOST_NAME_FRONTEND . "sin_permisos.php");
//     exit();
// }

# IDIOMA / 1 INGLES / 2 ESPAÑOL / 3 PORTUGUEZ
if ($session_language == '1') {
    $id_section         = 1;
} elseif ($session_language == '3') {
    $id_section         = 1;
} else {
    $id_section         = 1;
}

// if (empty($_f->getStringOffArrayByIndice($static_sections_array, 'id_section', $id_section, 'name')) && empty($_f->getStringOffArrayByIndice($static_sections_array, 'slug', $slug, 'name'))) {
//     $id_section = $_f->getStringOffArrayByIndice($static_sections_array, 'id_section', '1', 'id_section');
// } elseif (!empty($_f->getStringOffArrayByIndice($static_sections_array, 'slug', $slug, 'name')) && !empty($slug)) {
//     $id_section = $_f->getStringOffArrayByIndice($static_sections_array, 'slug', $slug, 'id_section');
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

// $_y->setKey(CRYPT_VAR_TXT);
// // $scryptInCrypter = $_y->getEncrypt("SELECT * FROM " . CONFIG_DB_PREFIX . "users_galleries WHERE id_user='" . $token_session_data_user["id_user"] . "' AND status='1';");
// $scryptInCrypter = $_y->getEncrypt("SELECT * FROM " . CONFIG_DB_PREFIX . "users_galleries WHERE status='1';");
// $param_users = array(
//     'controller' => 'users_galleries',
//     'action' => 'give',
//     'query' => $scryptInCrypter,
//     'public_key' => base64_encode(CRYPT_VAR_WEB_SERVICE),
//     'personal_key' => base64_encode('7usWlQCZ4v2L6Q0CrZYKzwwnh')
// );

// $_r->setUrl($webservices);
// $_r->setMethod('POST');
// $_r->setParams($param_users);
// $response = $_r->getRequest();

// // print_r($param_users);
// // print_r($response);

// // $url_final = '';
// // foreach($param_users as $key=> $value){
// //   $url_final .= $key.'='.$value.'&';
// // }
// // echo '<br><br>';
// // echo $webservices['URL'].'?'.$url_final;
// // echo '<br>';
// // echo "SELECT * FROM ".CONFIG_DB_PREFIX."appointments WHERE (appointment_date BETWEEN '".$start_date."' AND '".$end_date."') AND id_user='".$id_user."' AND status='1';";
// // exit();

// if (!empty($response)) {
//     $retorno = json_decode($response, true);

//     if (is_array($retorno) && $retorno['error'] == false) {
//         $data_result = $retorno['data'];
//         // print_r($data_result);
//     }
// }

// foreach ($data_result as $key => $value) {
//     echo $key . '=' . $value['id_user'] . '&';
// }

// exit();

# Private Data of user
// require_once(dirname(__FILE__) . '/_private.php');

// $path_settings_emails = dirname(__FILE__) . '/material/_data/' . CONFIG_DB_PREFIX . 'settings_emails.inc';
// if (function_exists('file_get_contents') && file_exists($path_settings_emails)) {
//     $static_settings_emails_array = unserialize(file_get_contents($path_settings_emails));
// } else {
//     $static_settings_emails_array = array();
// }

// $email_tpl_file = dirname(__FILE__) . '/material/settings_emails/media/' . $_f->getStringOffArrayByIndice($static_settings_emails_array, 'variable_name', 'for_user_contact_email', 'file');

// print_r($static_settings_emails_array);

// $_f->getStringOffArrayByIndice($static_sections_heros_array, 'id_section_hero', '1', 'file_desktop')
// print_r($static_sections_heros_array);
$data_hero = $_f->getArrayOnArrayByIndice($static_sections_heros_array, 'id_section_hero', '1');

// print_r($data_hero);
// exit();
?>
<link rel="stylesheet" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/lib/jquery-nice-select-1.1.0/css/nice-select.css">
<link rel="stylesheet" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/lib/switchery/switchery.css">
<link rel="stylesheet" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/lib/jquery-animated-headlines-master/dist/css/jquery.animatedheadline.css">
<link rel="stylesheet" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/lib/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/lib/jquery-nice-select-1.1.0/css/nice-select.css">
<link rel="stylesheet" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/lib/sweetalert/sweetalert.css">

<!-- Bx Slider -->
<link rel="stylesheet" type="text/css" href="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/lib/bxslider/4.2.12/jquery.bxslider.css">

</head>

<body>

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
        <section class="hero-section section-padding30 background-tertiary">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col col-xl-6 col-lg-7 col-md-10 col-sm-10">
                        <div class="content text-center align-middle">
                            <div class="section-tittle animated--Top animate-clip">
                                <h1 class="ah-headline">
                                    <span class="ah-words-wrapper">
                                        <b class="is-visible">Diseño Gráfico</b>
                                        <b>Marketing Digital</b>
                                        <b>Diseño Web</b>
                                        <b>Publicidad Creativa</b>
                                    </span>
                                </h1>
                                <!-- <p class="animatedTop">¿Necesitas un desarrollo personalizado? ¿Tu sitio web ? ¿Tu
                                    tienda online?<br>
                                    ¿Necesitas integrar tu sistema de Stock? Si la respuesta es sí, estas en el lugar
                                    correcto.
                                </p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero End -->

        <section class="network">
            <div class="container">
                <div class="social_content">
                    <div class="content_social">
                        <div class="social">
                            <div class="social-toggle" href="<?php echo $share_url; ?>" title="Compartir contenido">
                                <div class="circle-share">
                                    <div class="text"><i class="fa fa-share-alt icon" aria-hidden="true"></i></div>
                                    <div class="circle"></div>
                                </div>
                            </div>
                            <div class="social-buttons">
                                <div class="social-buttons-inner">
                                    <div class="button-square share" data-channel="email" data-url="<?php echo $share_url; ?>" data-title="<?php echo $share_name; ?>" data-summary="<?php echo $share_summary; ?>" data-image="<?php echo $share_image; ?>" data-hashtags="<?php echo $share_hashtags; ?>" data-email="<?php echo $share_email; ?>" data-email-body="<?php echo $share_email_body; ?>" data-email-subject="<?php echo $share_email_subject; ?>" data-whatsapp-phone="<?php echo $share_whatsapp_phone; ?>" data-whatsapp-body="<?php echo $share_whatsapp_body; ?>" data-source="<?php echo $share_source; ?>">
                                        <div class="circle-social">
                                            <div class="text"><i class="fa fa-envelope icon" aria-hidden="true"></i></div>
                                            <div class="circle color-enterprise"></div>
                                        </div>
                                    </div>

                                    <div class="button-square share" data-channel="linkedin" data-url="<?php echo $share_url; ?>" data-title="<?php echo $share_name; ?>" data-summary="<?php echo $share_summary; ?>" data-image="<?php echo $share_image; ?>" data-hashtags="<?php echo $share_hashtags; ?>" data-email="<?php echo $share_email; ?>" data-email-body="<?php echo $share_email_body; ?>" data-email-subject="<?php echo $share_email_subject; ?>" data-whatsapp-phone="<?php echo $share_whatsapp_phone; ?>" data-whatsapp-body="<?php echo $share_whatsapp_body; ?>" data-source="<?php echo $share_source; ?>">
                                        <div class="circle-social">
                                            <div class="text"><i class="fa fa-linkedin icon" aria-hidden="true"></i></div>
                                            <div class="circle color-linkedin"></div>
                                        </div>
                                    </div>

                                    <div class="button-square share" data-channel="instagram" data-url="<?php echo $share_url; ?>" data-title="<?php echo $share_name; ?>" data-summary="<?php echo $share_summary; ?>" data-image="<?php echo $share_image; ?>" data-hashtags="<?php echo $share_hashtags; ?>" data-email="<?php echo $share_email; ?>" data-email-body="<?php echo $share_email_body; ?>" data-email-subject="<?php echo $share_email_subject; ?>" data-whatsapp-phone="<?php echo $share_whatsapp_phone; ?>" data-whatsapp-body="<?php echo $share_whatsapp_body; ?>" data-source="<?php echo $share_source; ?>">
                                        <div class="circle-social">
                                            <div class="text"><i class="fa fa-instagram icon" aria-hidden="true"></i></div>
                                            <div class="circle color-instagram"></div>
                                        </div>
                                    </div>

                                    <div class="button-square share" data-channel="twitter" data-url="<?php echo $share_url; ?>" data-title="<?php echo $share_name; ?>" data-summary="<?php echo $share_summary; ?>" data-image="<?php echo $share_image; ?>" data-hashtags="<?php echo $share_hashtags; ?>" data-email="<?php echo $share_email; ?>" data-email-body="<?php echo $share_email_body; ?>" data-email-subject="<?php echo $share_email_subject; ?>" data-whatsapp-phone="<?php echo $share_whatsapp_phone; ?>" data-whatsapp-body="<?php echo $share_whatsapp_body; ?>" data-source="<?php echo $share_source; ?>">
                                        <div class="circle-social">
                                            <div class="text"><i class="fa fa-twitter icon" aria-hidden="true"></i></div>
                                            <div class="circle color-twitter"></div>
                                        </div>
                                    </div>

                                    <div class="button-square share" data-channel="facebook" data-url="<?php echo $share_url; ?>" data-title="<?php echo $share_name; ?>" data-summary="<?php echo $share_summary; ?>" data-image="<?php echo $share_image; ?>" data-hashtags="<?php echo $share_hashtags; ?>" data-email="<?php echo $share_email; ?>" data-email-body="<?php echo $share_email_body; ?>" data-email-subject="<?php echo $share_email_subject; ?>" data-whatsapp-phone="<?php echo $share_whatsapp_phone; ?>" data-whatsapp-body="<?php echo $share_whatsapp_body; ?>" data-source="<?php echo $share_source; ?>">
                                        <div class="circle-social">
                                            <div class="text"><i class="fa fa-facebook icon" aria-hidden="true"></i></div>
                                            <div class="circle color-facebook"></div>
                                        </div>
                                    </div>
                                    <div class="button-square share" data-channel="whatsapp" data-url="<?php echo $share_url; ?>" data-title="<?php echo $share_name; ?>" data-summary="<?php echo $share_summary; ?>" data-image="<?php echo $share_image; ?>" data-hashtags="<?php echo $share_hashtags; ?>" data-email="<?php echo $share_email; ?>" data-email-body="<?php echo $share_email_body; ?>" data-email-subject="<?php echo $share_email_subject; ?>" data-whatsapp-phone="<?php echo $share_whatsapp_phone; ?>" data-whatsapp-body="<?php echo $share_whatsapp_body; ?>" data-source="<?php echo $share_source; ?>">
                                        <div class="circle-social">
                                            <div class="text"><i class="fa fa-whatsapp icon" aria-hidden="true"></i></div>
                                            <div class="circle color-whatsapp"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Scroll -->
        <section class="scroll-section section-padding30">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="content-scroll">
                            <div class="intro-scroll">
                                <a href="#agencia" class="smoothscroll">
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

        <!-- Separator -->
        <section class="separator">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="content">
                            <img src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/bg_tringle_black.svg" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- Separator -->

        <!-- About Us -->
        <section class="us-section" id="agencia">
            <div class="container box--1 bg--2">
                <div class="row justify-content-center">
                    <div class="col col-xl-8 col-lg-7 col-md-10 col-sm-10">
                        <div class="section-tittle text-center">
                            <h1 class="animatedFade">Agencia</h1>
                            <h6 class="animatedBottom">
                                Somos una agencia de diseño, marketing y programación dedicada a ayudar a marcas y empresas a alcanzar su máximo potencial en el mundo digital y en el mercado tradicional. Nuestra pasión es crear estrategias innovadoras y creativas que impulsen el crecimiento y el éxito de nuestros clientes.
                                <br>
                            </h6>
                            <h6 class="animatedBottom">
                                Nuestra misión es ofrecer soluciones personalizadas y efectivas a cada uno de nuestros clientes, aprovechando nuestra experiencia y conocimientos en diseño, marketing y publicidad.
                                <br>
                            </h6>
                            <h6 class="animatedBottom">
                                Queremos ser socios estratégicos de cada marca, acompañándolos en su camino hacia el éxito y contribuyendo a su crecimiento sostenible.
                                <br>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Us -->

        <!-- Separator -->
        <section class="separator">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="content">
                            <img src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/bg_tringle_cyan.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Separator -->

        <!-- Services -->
        <section class="services-section" id="servicios">
            <div class="container">
                <div class="row d-flex justify-content-center animatedFade">
                    <div class="col col-xl-12 col-lg-8 col-md-11 col-sm-11">
                        <div class="section-tittle text-center mb--30">
                            <h1>Servicios</h1>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col col-xl-6 col-lg-6 col-md-9 col-sm-9" id="diseno-grafico">
                        <div class="services-caption">
                            <div class="image data-background" data-background="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/services/Diseno-Grafico.jpg">
                                <img src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/services/servicios-empty.gif" alt="">
                            </div>
                            <div class="hover">
                                <div class="content">
                                    <a href="secciones.php?ids=27" class="btn btn-link btn-xs">Leer más</a>
                                </div>
                            </div>
                            <div class="service-cap">
                                <h3>Diseño Gráfico</h3>
                                <h6>Identidad corporativa</h6>
                                <!-- <a href="#" class="btn btn-link btn-xs">Leer más</a> -->
                            </div>
                        </div>




                    </div>
                    <div class="col col-xl-6 col-lg-6 col-md-9 col-sm-9" id="marketing-digital">
                        <div class="services-caption">
                            <div class="image data-background" data-background="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/services/Marketing-Digital.jpg">
                                <img src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/services/servicios-empty.gif" alt="">
                            </div>
                            <div class="hover">
                                <div class="content">
                                    <a href="secciones.php?ids=28" class="btn btn-link btn-xs">Leer más</a>
                                </div>
                            </div>
                            <div class="service-cap">
                                <h3>Marketing Digital</h3>
                                <h6>Estrategias digitales</h6>
                                <!-- <a href="#" class="btn btn-link btn-xs">Leer más</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col col-xl-6 col-lg-6 col-md-9 col-sm-9" id="diseno-web">
                        <div class="services-caption">
                            <div class="image data-background" data-background="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/services/Diseno-Web.jpg">
                                <img src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/services/servicios-empty.gif" alt="">
                            </div>
                            <div class="hover">
                                <div class="content">
                                    <a href="secciones.php?ids=29" class="btn btn-link btn-xs">Leer más</a>
                                </div>
                            </div>
                            <div class="service-cap">
                                <h3>Diseño Web</h3>
                                <h6>Responsive 100%</h6>
                                <!-- <a href="#" class="btn btn-link btn-xs">Leer más</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col col-xl-6 col-lg-6 col-md-9 col-sm-9" id="publicidad-creativa">
                        <div class="services-caption">
                            <div class="image data-background" data-background="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/services/Publicidad-Creativa.jpg">
                                <img src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/services/servicios-empty.gif" alt="">
                            </div>
                            <div class="hover">
                                <div class="content">
                                    <a href="secciones.php?ids=30" class="btn btn-link btn-xs">Leer más</a>
                                </div>
                            </div>
                            <div class="service-cap">
                                <h3>Publicidad Creativa</h3>
                                <h6>Campañas publicitarias</h6>
                                <!-- <a href="#" class="btn btn-link btn-xs">Leer más</a> -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- Services -->

        <!-- Separator -->
        <section class="separator">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="content">
                            <img src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/bg_tringle_magenta.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Separator -->

        <!-- Works -->
        <section class="works-section" id="trabajos">
            <div class="container box--1 bg--2">
                <div class="row d-flex justify-content-center">
                    <div class="col col-xl-12 col-lg-8 col-md-11 col-sm-11">
                        <div class="section-tittle section-tittle3  text-center mb-90">
                            <h1>Trabajos</h1>
                        </div>
                    </div>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col col-xl-10 col-lg-10 col-md-12 col-sm-12">

                        <ul id="slider">
                            <li style="
                            background-image: url('<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/works/big/1_nuestro_sueno_1.jpg');
                            background-position: center center;
                            -webkit-background-size: cover;
                            -moz-background-size: cover;
                            -o-background-size: cover;
                            background-size: cover;
                            " attr-url="1">
                            </li>
                            <li style="
                            background-image: url('<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/works/big/1_nuestro_sueno_2.jpg');
                            background-position: center center;
                            -webkit-background-size: cover;
                            -moz-background-size: cover;
                            -o-background-size: cover;
                            background-size: cover;
                            " attr-url="2">
                            </li>
                            <li style="
                            background-image: url('<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/works/big/1_nuestro_sueno_3.jpg');
                            background-position: center center;
                            -webkit-background-size: cover;
                            -moz-background-size: cover;
                            -o-background-size: cover;
                            background-size: cover;
                            " attr-url="1">
                            </li>
                            <li style="
                            background-image: url('<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/works/big/1_nuestro_sueno_4.jpg');
                            background-position: center center;
                            -webkit-background-size: cover;
                            -moz-background-size: cover;
                            -o-background-size: cover;
                            background-size: cover;
                            " attr-url="2">
                            </li>
                            <li style="
                            background-image: url('<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/works/big/1_nuestro_sueno_5.jpg');
                            background-position: center center;
                            -webkit-background-size: cover;
                            -moz-background-size: cover;
                            -o-background-size: cover;
                            background-size: cover;
                            " attr-url="1">
                            </li>
                            <li style="
                            background-image: url('<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/works/big/2_fuel_universe.jpg');
                            background-position: center center;
                            -webkit-background-size: cover;
                            -moz-background-size: cover;
                            -o-background-size: cover;
                            background-size: cover;
                            " attr-url="2">
                            </li>
                            <li style="
                            background-image: url('<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/works/big/3_skp_pro_audio.jpg');
                            background-position: center center;
                            -webkit-background-size: cover;
                            -moz-background-size: cover;
                            -o-background-size: cover;
                            background-size: cover;
                            " attr-url="2">
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col col-xl-12 col-lg-8 col-md-11 col-sm-11 text-center mt-10">
                        <div class="content show-more">
                            <!-- <a href="#" class="btn btn-link btn-xs" id="go-to-work">Ver más</a> -->
                        </div>
                    </div>
                </div>
        </section>
        <!-- Works -->

        <!-- Separator -->
        <section class="separator">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="content">
                            <img src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/bg_tringle_yellow.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Separator -->

        <!-- Form -->
        <section class="form-section section-padding-123 " id="consultas">
            <div class="container">

                <div class="row d-flex justify-content-center animatedFade">
                    <div class="col col-xl-12 col-lg-8 col-md-11 col-sm-11">
                        <div class="section-tittle section-tittle3  text-center">
                            <h1>Consultas y Presupuestos</h1>
                            <h6>Contanos en que podemos ayudarte.</h6>
                        </div>
                    </div>
                </div>

                <form name="formContact" id="formContact" novalidate="">
                    <input type="hidden" name="action" id="action" value="contact">
                    <input type="hidden" name="token" id="token" value="<?php echo $token_session_form; ?>" />

                    <div class="row">
                        <div class="col col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Nombre *" tabindex="4" required data-validation-required-message="Por favor ingrese su Nombre">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email *" tabindex="5" required data-validation-required-message="Por favor ingrese su Email" data-validation-Validemail-Message="Por favor ingrese un Email valido">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" name="cell_phone" placeholder="Teléfono Celular *" tabindex="6" required data-validation-regex-regex="^(?:(?:00)?(549|595)?)?0?(?:(11|9)|[2368]\d)(?:(?=\d{0,2}15)\d{2})??\d{8}$" data-validation-regex-message="Por favor ingrese un Teléfono válido de Argentina, que no tenga caracteres especiales, ni espacios." data-validation-required-message="Por favor ingrese un Teléfono">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <select name="id_form_type" class="form-control form_pooldown" tabindex="7" required data-validation-required-message="Selecciones un tipo de consulta">
                                    <option value="">Seleccione el tipo de consulta *</option>
                                    <?php
                                    if (is_array($static_forms_types_array)) {
                                        $leng_form_type = count($static_forms_types_array) - 1;

                                        for ($i = 0; $i <= $leng_form_type; $i++) {
                                            echo '<option value="' . $static_forms_types_array[$i]['id_form_type'] . '">' . $static_forms_types_array[$i]['name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <p class="help-block text-danger"></p>
                            </div>

                            <div class="form-group" style="padding-top: 15px;">
                                <input type="checkbox" class="checkbox check js-switch_1" value="1" id="anewsletter" name="anewsletter" tabindex="9">
                                <p class="check-text">Suscribirme para recibir newsletter.</p>
                                <input type="text" class="no-view" readonly name="newsletter" id="newsletter" value="" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group" style="padding-top: 15px;">
                                <input type="checkbox" class="checkbox check js-switch_2" value="1" id="aterms_and_conditions" checked name="aterms_and_conditions">
                                <p class="check-text">Acepto los <a href="./terminos_y_condiciones.php">Términos y Condiciones.</a></p>
                                <input type="text" class="no-view" readonly name="terms_and_conditions" id="terms_and_conditions" value="1" name="terms_and_conditions" tabindex="9" required data-validation-required-message="Se requiere que acepte los términos y condiciones." />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>

                        <div class="col col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <textarea class="form-control" id="message" name="message" placeholder="Mensaje *" tabindex="8" required data-validation-required-message="Por favor ingrese un mensaje"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>

                            <div class="form-group text-end">
                                <div id="success"></div>
                                <button id="button_contact" type="submit" class="btn btn-primary btn-lg btn-rounded" tabindex="10">ENVIAR</button>
                                <div class="loading" id="loading">
                                    <div class="content margin_30" style="">
                                        <div class="spinner">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="txt-required text-primary">(*) Datos obligatorios</div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

        </section>
        <!-- Form -->

        <!-- Separator -->
        <section class="separator">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="content">
                            <img src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/img/bg_tringle_black.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Separator -->

        <!-- Contacts -->
        <section class="contact-section section-padding-123" id="contacto">
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
                            <div class="btn btn-light btn-lg btn-rounded contactAction" data-channel="phone" data-phone="<?php echo $setting_contact_phone; ?>" data-email="" data-subject="" data-body="">
                                <div class=" content-fa"><i class="fa fa-phone fa-3x mb-3 sr-contact"></i></div>
                                <div class="content-number">
                                    <p><?php echo $setting_contact_phone; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col col-xl-4 col-lg-4 col-md-12 col-sm-12 animatedRight">
                        <div class="section-contacts text-center mb-90">
                            <div class="btn btn-light btn-lg btn-rounded contactAction" data-channel="whatsapp" data-phone="<?php echo $setting_contact_whatsapp; ?>" data-email="" data-subject="" data-body="">
                                <div class="content-fa"><i class="fa fa-whatsapp fa-3x mb-3 sr-contact"></i></div>
                                <div class="content-number">
                                    <p class="button-square">Escríbenos por WhatsApp</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col col-xl-4 col-lg-4 col-md-12 col-sm-12 animatedRight">
                        <div class="section-contacts text-center mb-90">
                            <div class="btn btn-light btn-lg btn-rounded contactAction" data-channel="email" data-phone="" data-email="<?php echo $setting_contact_email; ?>" data-subject="<?php echo $static_settings_array[0]['contact_email_subject']; ?>" data-body="<?php echo $static_settings_array[0]['contact_email_body']; ?>">
                                <div class="content-fa"><i class="fa fa-envelope-o fa-3x mb-3 sr-contact"></i></div>
                                <div class="content-number">
                                    <p><?php echo $setting_contact_email; ?></p>
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

    <div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body"></div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <?php require_once(dirname(__FILE__) . '/_common_srcipt.php'); ?>
    <script>
        var id_section = '1';
    </script>

    <script type="text/javascript" src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/lib/jquery-nice-select-1.1.0/js/jquery.nice-select.min.js"></script>
    <script type="text/javascript" src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/lib/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript" src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/lib/switchery/switchery.js"></script>
    <script type="text/javascript" src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/js/main.js?a=1"></script>
    <script type="text/javascript" src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/lib/scrollreveal/scrollreveal.min.js"></script>
    <script type="text/javascript" src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/lib/jqBootstrapValidation/jqBootstrapValidation.min.js"></script>

    <script>
        $('.animate-clip').animatedHeadline({
            animationType: 'clip',
            revealAnimationDelay: 3000
        });
    </script>

    <!-- Hero Plugins -->
    <script type="text/javascript" src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/js/plugins/jquery.hero.js"></script>
    <script>
        $(window).on('load resize', function() {
            var slider1 = $('.hero-section .container').hero({
                responsive: true,
                images: [{
                    'desktop': '<?php echo CONFIG_HOST_NAME_FRONTEND; ?>material/sections_heros/big/<?php echo $data_hero['file_desktop'] ?>',
                    'tablet_portrait': '<?php echo CONFIG_HOST_NAME_FRONTEND; ?>material/sections_heros/big/<?php echo $data_hero['file_tablet_portrait'] ?>',
                    'tablet_landscape': '<?php echo CONFIG_HOST_NAME_FRONTEND; ?>material/sections_heros/big/<?php echo $data_hero['file_tablet_landscape'] ?>',
                    'mobile_portrait': '<?php echo CONFIG_HOST_NAME_FRONTEND; ?>material/sections_heros/big/<?php echo $data_hero['file_mobile_portrait'] ?>',
                    'mobile_landscape': '<?php echo CONFIG_HOST_NAME_FRONTEND; ?>material/sections_heros/big/<?php echo $data_hero['file_mobile_landscape'] ?>',
                }],
                height_mode: [{
                    'mode': 'viewport',
                    'type': 'more',
                    'valor': 450
                }],
                background: [{
                    'size': 'cover',
                    'repeat': 'no-repeat',
                    'position': 'top center',
                    'attachment': 'fixed',
                }]
            });

        });
    </script>

    <!-- Mask Image Plugins -->
    <!-- <script type="text/javascript" src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/js/plugins/jquery.mask_image.js"></script>
    <script>
        $( window ).on('load resize',function() {
        $('#mask_image').mask_image({
            responsive: true,
            height: 500
        });
        });
    </script> -->

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
    <script type="text/javascript">
        $("#whatsApp-paraguay").on("click", function() {
            var url =
                'https://api.whatsapp.com/send?phone=595975115146&textHola,%20gracias%20por%20contactarte%20contanos%20en%20en%20que%20te%20podemos%20asesorar.';
            window.open(url, '_blank');
        });
        $("#whatsApp-argentina").on("click", function() {
            var url =
                'https://api.whatsapp.com/send?phone=5491153340882&textHola,%20gracias%20por%20contactarte%20contanos%20en%20en%20que%20te%20podemos%20asesorar.';
            window.open(url, '_blank');
        });
    </script>
    <script>
        var elem_1 = document.querySelector(".js-switch_1");
        var switchery_1 = new Switchery(elem_1, {
            color: "#4e73df"
        });
        elem_1.onchange = function() {
            if (elem_1.checked == true) {
                $("#newsletter").val('1');
            } else {
                $("#newsletter").val('');
            }
        }

        var elem_2 = document.querySelector(".js-switch_2");
        var switchery_2 = new Switchery(elem_2, {
            color: "#4e73df"
        });
        elem_2.onchange = function() {
            if (elem_2.checked == true) {
                $("#terms_and_conditions").val('1');
            } else {
                $("#terms_and_conditions").val('');
            }
        }

        $("#formContact input, #formContact textarea, #formContact select, #formContact checkbox").jqBootstrapValidation({

            preventSubmit: true,
            submitError: function($form, event, errors) {
                // additional error messages or events
                console.log('error', errors);
            },
            submitSuccess: function($form, event) {

                console.log('submite');

                event.preventDefault();
                var formData = new FormData($("#formContact")[0]);

                $('#button_contact').hide();
                $("#loading").css('display', 'inline-block');

                $.ajax({
                    url: "<?php echo CONFIG_HOST_NAME_FRONTEND; ?>_ajax.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: 'json',
                    success: function(resp) {

                        if (resp.error) {

                            var erroresList = '';
                            $.each(resp.data, function(key, mensaje) {
                                erroresList += mensaje;
                            });

                            // Fail message
                            swal({
                                title: "<?php echo $_f->getStringOffArrayByNameLang($static_settings_copys_array, 'js_error_verify_data', $session_language, true); ?>",
                                text: erroresList,
                                type: "error"
                            });

                            $("#loading").hide();
                            $("#button_contact").show();

                        } else {

                            // OK message
                            swal({
                                    title: "¡Gracias por contactarnos!",
                                    text: "Ya recibimos su mensaje, nos pondremos en contacto con usted en breve.",
                                    type: "success"
                                },
                                function() {
                                    $('#formContact').trigger("reset");
                                    $("#loading").hide();
                                    $("#button_contact").show();
                                });
                            // $('#formContact').trigger("reset");
                            // window.location = '<?php echo CONFIG_HOST_NAME_FRONTEND; ?>?msn=20&#index';
                        }
                    },
                    error: function() {
                        // Fail message
                        swal({
                                title: "<?php echo $_f->getStringOffArrayByNameLang($static_settings_copys_array, 'js_error_sorry', $session_language, true); ?>",
                                text: "<?php echo $_f->getStringOffArrayByNameLang($static_settings_copys_array, 'js_error_server_error', $session_language, true); ?>",
                                type: "error"
                            },
                            function() {
                                $('#formContact').trigger("reset");
                                $("#loading").hide();
                                $("#button_contact").show();
                            });
                    },
                });
            },
            filter: function() {
                return $(this).is(":visible");
            },
        });
    </script>

    <script>
        // $(document).ready(function() {
        //     var content = $('.separator .container .row .col .content');
        //     var image = $('.separator .container .row .col .content img');
        //     var correction = '-' + image.height() + 'px';
        //     var content = $('.separator .container .row .col .content').css('margin-top', correction);
        //     // alert(`${image.width()} x ${image.height()}`);
        // });
    </script>

    <!-- Google Analytics -->
    <?php require_once(dirname(__FILE__) . '/_common_analyticstracking.php'); ?>

</body>

</html>