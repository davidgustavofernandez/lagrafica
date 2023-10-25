<?php
require_once( dirname(__FILE__) . '/framework/_common/Class.Config.php');
$_c = new Configuration();
require_once( dirname(__FILE__) . '/framework/_lib/handler/Class.Error.Handler.php');
require_once( dirname(__FILE__) . '/framework/_lib/propagate/Class.Propagate.php');
require_once( dirname(__FILE__) . '/framework/_lib/messages/Class.Messages.php');
require_once( dirname(__FILE__) . '/framework/_lib/curl/Class.Curl.php');
require_once( dirname(__FILE__) . '/framework/_lib/session/Class.Session.php');
require_once( dirname(__FILE__) . '/framework/_lib/functions/Class.Functions.php');
//require_once( dirname(__FILE__) . '/framework/_lib/ip/Class.Ip.php');
require_once( dirname(__FILE__) . '/framework/_lib/token/Class.Token.php');
require_once( dirname(__FILE__) . '/framework/_lib/crypt/Class.Crypt.php');

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
$messaje                = $_p->spread($_metodo,"msn",'');
$token_querystring      = $_p->spread($_metodo,"t",'');
$pager_page             = $_p->spread($_metodo,'pager_page','');
// $id_section              = 2; //$_p->spread($_metodo,"ids",0);
$call                   = $_p->spread($_metodo,"call",0);
$slug                   = $_p->spread($_metodo,'slug','');
$_debug                 = true;

# URL webservices
$webservices = array('URL' => CONFIG_URL_WEBSERVICES);

# SESSION / TOKEN
require_once( dirname(__FILE__) . '/_sessions_token.php');

# RECORDS en archivos fisicos formato JSON
require_once( dirname(__FILE__) . '/_common_static_json.php');

if(empty($id_section) && empty($slug)){
  header("Location: ".CONFIG_HOST_NAME_FRONTENDEND);
  exit();
}

// CHECK IF EXIST SECTION
if( empty($_f->getStringOffArrayByIndice($static_sections_array,'id_section',$id_section,'name')) && empty($_f->getStringOffArrayByIndice($static_sections_array,'slug',$slug,'name')) )
{
  header("Location: ".CONFIG_HOST_NAME_FRONTENDEND."");
  exit();
}
elseif( !empty($_f->getStringOffArrayByIndice($static_sections_array,'slug',$slug,'name')) && !empty($slug) )
{
  $id_section = $_f->getStringOffArrayByIndice($static_sections_array,'slug',$slug,'id_section');
}

# IDIOMA / 1 INGLES / 2 ESPAÑOL / 3 PORTUGUEZ
// if($session_language=='1')
// {
// 	$id_section 		= 3;
// }
// elseif($session_language=='3')
// {
// 	$id_section 		= 3;
// }
// else
// {
// 	$id_section 		= 3;
// }

# Data section
$data_section = $_f->getArrayOnArrayByIndice($static_sections_array,'id_section',$id_section);

# Tracking Variables
$tracking_id_section = $data_section['id_section'];
$tracking_variable = '';
$tracking_valor = '';
$tracking_name = $data_section['name'];

# Tracking
require_once( dirname(__FILE__) . '/_common_tracking.php');

# Archivo Header / Meta 
require_once( dirname(__FILE__) . '/_common_html_header.php');

?>

  </head>

  <body id="registry" class="<?php echo $data_section['slug']; ?>">

    <!-- Navigation -->
    <?php require_once( dirname(__FILE__) . '/_common_navigation.php'); ?>

    <section class="registry" id="registry">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h1 class="section-heading"><?php echo $data_section['name']; ?></h1>
            <hr class="my-4">
            <p class="mb-5"><?php echo str_replace("[[[CONFIG_NAME_SITE]]]",CONFIG_NAME_SITE,$data_section['descent']); ?></p>
          </div>
        </div>

        
        <div class="row">
          <div class="col-lg-12">
              
            <p><?php echo $data_section['detail']; ?></p>

          </div>
        </div>

      </div>
    </section>
    
    <!-- Footer --> 
    <?php require_once( dirname(__FILE__) . '/_common_footer.php'); ?>

    <!-- Scripts -->
    <?php require_once( dirname(__FILE__) . '/_common_srcipt.php'); ?>

    <!-- Custom scripts for this template -->
    <script src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/js/scripts.js"></script>
    
    <!-- Contact form JavaScript -->
    <script src="<?php echo CONFIG_HOST_NAME_FRONTEND; ?>assets/js/jqBootstrapValidation.js"></script>
    <script>
    
      // Registry Form Scripts
      // $(function() {

        $("#formRegistry input, #formRegistry textarea, #formRegistry select").jqBootstrapValidation({
          
          preventSubmit: true,
          submitError: function($form, event, errors) {
            // additional error messages or events
            console.log('error',errors);
          },
          submitSuccess: function($form, event) {
            
            console.log('submite');

            event.preventDefault();
            var formData = new FormData($("#formRegistry")[0]);

            $('#button_contact').hide();
            $("#loading").show();

            $.ajax({
              url: "<?php echo CONFIG_HOST_NAME_FRONTEND; ?>_ajax.php",
              type: "POST",
              data: formData,
              contentType: false,
              processData: false,
              cache: false,
              dataType: 'json',

              success: function(resp){
              if (resp.error) 
              {
                var erroresList = '<ul>';
                $.each(resp.error, function(key, mensaje) {
                  erroresList += '<li>'+mensaje+'</li>';
                });
                erroresList += '</ul>';

                // Fail message
                $('#msnModal .modal-title').html('<?php echo $_f->getStringOffArrayByNameLang($static_settings_copys_array,'js_error_verify_data',$session_language,true); ?>');
                $('#msnModal .modal-detail').html(erroresList);
                $('#msnModal').modal('show');

                $("#loading").hide();
                $("#button_contact").show();
              }
              else 
              {
                // OK message
                $('#formRegistry').trigger("reset");
                  window.location = '<?php echo CONFIG_HOST_NAME_FRONTEND; ?>index.php?msn=4';
                }
              },
              error: function() {
                // Fail message
                $('#msnModal .modal-title').html('<?php echo $_f->getStringOffArrayByNameLang($static_settings_copys_array,'js_error_sorry',$session_language,true); ?>');
                $('#msnModal .modal-detail').html('<?php echo $_f->getStringOffArrayByNameLang($static_settings_copys_array,'js_error_server_error',$session_language,true); ?>');
                $('#msnModal').modal('show');
                $('#formRegistry').trigger("reset");

                $("#loading").hide();
                $("#button_contact").show();
              },
            });
          },
          filter: function() {
            return $(this).is(":visible");
          },
        });

      // });

      function eventHandler(event, selector) {
        event.stopPropagation();
        event.preventDefault();
        if (event.type === 'touchend') selector.off('click');
      }

    </script>
    <script>
    <?php 
      if(!empty($messaje)) {
        if($messaje=='4') {
          if(!empty($token_session_user) && $token_session_user=='logado') {
            $the_name = $token_session_data_user['nombre'];
          } else {
            $the_name = '';
          }
          $titulo = $_f->getStringOffArrayByNameLang($static_settings_copys_array,'msn_wellcome',$session_language,true) . ' ' .$the_name; 
          $detalle = $_f->strireplace($_f->getStringOffArrayByNameLang($static_settings_copys_array,'msn_wellcome_detail',$session_language));
        } if($messaje=='3') {
          $titulo = $_f->getStringOffArrayByNameLang($static_settings_copys_array,'recover_msn_success_title',$session_language); 
          $detalle = $_f->getStringOffArrayByNameLang($static_settings_copys_array,'recover_msn_success_detail',$session_language);
        }
        ?>
        $(document).ready(function(){
          $('#msnModal .modal-title').html('<?php echo $titulo; ?>');
          $('#msnModal .modal-detail').html('<?php echo $detalle; ?>');
          setTimeout(function(){
            $('#msnModal').modal('show');
          }, 1000);
        });
      <?php 
      }
      ?>
      </script>

  </body>
</html>
