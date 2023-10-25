<?php
/* View: dataSettings
 * Action: Show result
 * Return: HTML return
 * Comment: Shows variabls seting
 */
$html_main = '<div class="row">
  <div class="col-lg-12">
    <div class="ibox">
      <div class="ibox-title">
        <h5>'.$this->_m->getMessageEntites('view_settings','settings').' <small>'.$this->_m->getMessageEntites('view_settings','data_settings').'</small></h5>
      </div>
      <div class="ibox-content">
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h5 class="panel-title">'.$this->_m->getMessageEntites('view_settings','data_settings').'</h5>
              </div>
              <div class="panel-body">
                <p>
                  TIME ZONE:<br>
                  <hr>
                  <strong>TIME_ZONE:</strong> '.TIME_ZONE.'<br>
                  <strong>TIME_ZONE_OFFSET:</strong> '.TIME_ZONE_OFFSET.'<br>
                  <br>
                </p>
                
                <p>
                  URLS:<br>
                  <hr>
                  <strong>CONFIG_REAL_URL:</strong> '.CONFIG_REAL_URL.'<br>
                  <strong>CONFIG_ADD_PATH:</strong> '.CONFIG_ADD_PATH.'<br>
                  <strong>CONFIG_HOST_NAME_BACKEND:</strong> '.CONFIG_HOST_NAME_BACKEND.'<br>
                  <strong>CONFIG_URL_FRIENDLY:</strong> '.CONFIG_URL_FRIENDLY.'<br>
                  <br>
                </p>

                <p>
                  DATABASE:<br>
                  <hr>
                  <strong>CONFIG_DATABASE_VERSION:</strong> '.CONFIG_DATABASE_VERSION.'<br>
                  <strong>CONFIG_DB_PREFIX:</strong> '.CONFIG_DB_PREFIX.'<br>
                  <strong>CONFIG_DB_HOST:</strong> '.CONFIG_DB_HOST.'<br>
                  <strong>CONFIG_DB_NAME:</strong> '.CONFIG_DB_NAME.'<br>
                  <strong>CONFIG_DB_USER:</strong> '.CONFIG_DB_USER.'<br>
                  <strong>CONFIG_DB_PASS:</strong> '.CONFIG_DB_PASS.'<br>
                  <strong>CONFIG_DB_PORT:</strong> '.CONFIG_DB_PORT.'<br>
                  <strong>DATABASE_SCAFFOLDING:</strong> '.DATABASE_SCAFFOLDING.'<br>
                  <strong>PURGE_STRUCTURE_DATABASE:</strong> '.PURGE_STRUCTURE_DATABASE.'<br>
                  <br>
                </p>

                <p>
                  EMAIL:<br>
                  <hr>
                  <strong>CONFIG_SENDER_EMAIL:</strong> '.CONFIG_SENDER_EMAIL.'<br>
                  <strong>PATH_MAIL_HTML:</strong> '.PATH_MAIL_HTML.'<br>
                  <strong>SMTP_DEBUG:</strong> '.SMTP_DEBUG.'<br>
                  <strong>SMTP_AUTHENTICATION:</strong> '.SMTP_AUTHENTICATION.'<br>
                  <strong>SMTP_SECURE:</strong> '.SMTP_SECURE.'<br>
                  <strong>SMTP_SERVER:</strong> '.SMTP_SERVER.'<br>
                  <strong>SMTP_PORT:</strong> '.SMTP_PORT.'<br>
                  <strong>SMTP_USER:</strong> '.SMTP_USER.'<br>
                  <strong>SMTP_PASS:</strong> '.SMTP_PASS.'<br>
                  <strong>SMTP_WORD_WRAP:</strong> '.SMTP_WORD_WRAP.'<br>
                  <strong>FROM_EMAIL:</strong> '.FROM_EMAIL.'<br>
                  <strong>FROM_NAME:</strong> '.FROM_NAME.'<br>
                  <br>
                </p>


              </div>
              <div class="panel-footer" style="text-align: right">
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>';

# OUPUT Theme & Tepmplate
$common_header_tags = '
  <meta CHARSET="utf-8" />
  <meta HTTP-EQUIV="X-UA-Compatible" CONTENT="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>'.TEMPLATE_NAME_TITLE.'</title>
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="author" content="David Gustavo Fernandez - fernandezdg@gmail.com" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta name="language" content="Spanish" />
  <meta http-equiv="content-language" content="es" />
  <meta http-equiv="expires" content="1" />
  <meta content="index,follow" name="robots" />
  
  <!-- Apple -->
  <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-touch-fullscreen" content="yes">

  <!-- Favicon -->
  <link rel="shortcut icon" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon/favicon.ico" />
  <link rel="apple-touch-icon" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon/favicon.ico" />

  <!-- Icon -->
  <link rel="apple-touch-icon" sizes="57x57" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon/apple-icon-57x57.png" />
  <link rel="apple-touch-icon" sizes="60x60" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon/apple-icon-60x60.png" />
  <link rel="apple-touch-icon" sizes="72x72" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon/apple-icon-72x72.png" />
  <link rel="apple-touch-icon" sizes="76x76" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon/apple-icon-76x76.png" />
  <link rel="apple-touch-icon" sizes="114x114" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon/apple-icon-114x114.png" />
  <link rel="apple-touch-icon" sizes="120x120" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon/apple-icon-120x120.png" />
  <link rel="apple-touch-icon" sizes="144x144" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon/apple-icon-144x144.png" />
  <link rel="apple-touch-icon" sizes="152x152" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon/apple-icon-152x152.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon/apple-icon-180x180.png" />
  <link rel="fluid-icon" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon/apple-icon-180x180.png" title="SMVC" />
  <link rel="icon" type="image/png" sizes="16x16" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon/favicon-16x16.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="96x96" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon/favicon-96x96.png" />
  <link rel="icon" type="image/png" sizes="192x192"  href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon/android-icon-192x192.png" />
  <link rel="manifest" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon/manifest.json" />
  <meta name="msapplication-TileColor" CONTENT="#ffffff" />
  <meta name="msapplication-TileImage" CONTENT="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon/ms-icon-144x144.png" />
  <meta name="theme-color" CONTENT="#ffffff" />

  <!-- Bootstrap Core CSS -->
  <link rel="stylesheet" type="text/css" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/vendor/bootstrap/css/bootstrap.css" />
  <!-- MetisMenu CSS -->
  <link rel="stylesheet" type="text/css" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/vendor/metisMenu/metisMenu.min.css" />
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/css/sb-admin-2.css" />
  <!-- Custom Fonts -->
  <link REL="stylesheet" type="text/css" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/vendor/font-awesome/css/font-awesome.min.css" />
  <!--[if lt IE 9]>
      <script src="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/3.7.0/html5shiv.js"></script>
      <script src="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Calendar -->
  <link rel="stylesheet" type="text/css" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/calendar/jquery.datetimepicker.min.css">
  <!-- Steps -->
  <link rel="stylesheet" type="text/css" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/css/custom.css">
  <link rel="stylesheet" type="text/css" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/css/steps.css">
';

# Instance template
$temp = new Templates();

# Skin
$temp->setSkinPath(FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/');

# Files
$temp->setTemplate('_Index.xml');

# Instance DOMDocument, DOMXPath
$temp->setIni();

# Content  ($path, $index, $data)
# Title
//$temp->setData('/html/head/title', 0, TEMPLATE_NAME_TITLE);
# User
$temp->setData('/html/body/div/div/div/nav/ul', 0, $html_profile);
# Menu
$temp->setData('/html/body/div/nav/div/ul', 0, $html_menu);
# Main
$temp->setData('/html/body/div/div/div/div/h2', 0, $admin_wellcome);
$temp->setData('/html/body/div/div/div/div/ol', 0, $html_breadcrumbs);
$temp->setData('/html/body/div/div/div/nav/div', 0, $html_global_buttons);
// $temp->setData('/html/body/div/div/div/nav/div/a', 1, $this->_m->getMessageEntites('global','see_api'));
$temp->setData('/html/body/div/div/div', 2, $html_main);
# Footer
$temp->setData('/html/body/div/div/div/div/div/footer', 0, $html_footer);

# Set common metatags & files
$temp->setChangeAttribute('/html', array('xml:lang', 'LANG'),array('xml:lang'=>'es', 'LANG'=>'es'));
$temp->setData('/html/head', 0, $common_header_tags);

# Set Js
# jQuery
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/vendor/jquery/jquery.min.js'));
# Bootstrap Core JavaScript
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/vendor/bootstrap/js/bootstrap.min.js'));
# slimScroll
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/slimscroll-1.3.6/jquery.slimscroll.js'));
# Metis Menu Plugin JavaScript
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/vendor/metisMenu/metisMenu.min.js'));
# Custom Theme JavaScript
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/sb-admin-2.js'));
# Sparkline
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/sparkline/jquery.sparkline.js'));
# ChartJs
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/chartjs/Chart.min.js'));
# Steps
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/steps/jquery.steps.min.js'));
# Validate
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/steps/jquery.validate.min.js'));
# Calendar
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/calendar/jquery.datetimepicker.full.js'));

if($this->_action!='preview' && $this->_action!='cargar'){
  # Scripts
  $temp->addChild("body",0,"script", $collector);
}

echo $temp->getTemplate();