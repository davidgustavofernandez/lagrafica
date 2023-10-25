<?php
/* View: exportBatchList
 * Action: List Batch Files
 * Return: HTML return
 * Comment: Retrieve the result of query, The name of the variable return is $resultSelect
 */
# Titles {
$return_list = '<div class="subrow principal">';
$return_list .= '   <div class="strings indice rx1"><h1>File</h1></div>';
$return_list .= '   <div class="actions action"></div>';
$return_list .= '</div>';
# } Titles

$color = 1;
$indice_interno = 1;
$resultExportBatchList = array_reverse($resultExportBatchList);

// print_r($resultExportBatchList);
// echo 'ok';
// exit();

foreach($resultExportBatchList as $value){
  if(!empty($value)){
    if($value === '.' || $value === '..') {continue;}
    $file_phisical = dirname(__FILE__) .'/../../../material/'.$this->_controller.'/reports/'.$value;
    // echo $file_phisical;
    // exit();
    $color_bg = '#ff0000';
    $color_text = '#ffffff';
    $flag = 'ERROR';

    if(is_file($file_phisical)){


    $findme   = 'track';
    $pos = strpos($value, $findme);

    if ($pos === false) {
      $color_bg = '#ff0000';
      $flag = 'ERROR';
    } else {
      $color_bg = '#224abe';
      $flag = 'TRACK';
    }
    $value_name = str_replace('error_','',$value);
    $value_name = str_replace('track_','',$value_name);

    $extencion = explode(".",$value);
    $extArchivo = '.'.strtolower($extencion[1]);
    $extImages = array (".jpg", ".jpeg", ".gif", ".png");

    if( in_array($extArchivo,$extImages) ){
      $imagen_mostrar = CONFIG_HOST_NAME_FRONTEND.'material/'.$this->_controller.'/reports/'.$value;
    }else{
      $imagen_mostrar = CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon_folder/16x16/icon_folder_'.strtolower($extencion[1]).'.gif';
    }
    $imagen_ver = CONFIG_HOST_NAME_FRONTEND.'material/'.$this->_controller.'/reports/'.$value;

    $valor = ($color / 2);
    $colorAplica = is_float($valor) ? '1' : '2';
    $return_list .= '<div class="subrow_'.$indice_interno.'">';
    $return_list .= '   <div class="strings rx1"><div style="float:left;margin:2px;"><img src="'.$imagen_mostrar.'" border="0" style="width:16px;"></div><h2 style="float: left; padding: 5px 7px; border-radius: 7px; margin: 0 !important;"><div class="datacel">File</div>' . $value_name . '</h2></div>';
    $return_list .= '   <div class="actions action" style="text-align: right;">';
    $return_list .= '     <a href="'.$imagen_ver.'" class="bot_action bot-modal btn-primary fa fa-eye" target="_blank"></a>';
    $return_list .= '     <a href="index.php?controller='.$this->_controller.'&action=exportBatchFileDelete&file='.$value.'&" class="bot_action btn-primary fa fa-trash-o"></a>';
    $return_list .= '   </div>';
    $return_list .= '</div>';



    $color = $color + 1;
    if($indice_interno == 2){
      $indice_interno = 1;
    }else{
      $indice_interno = $indice_interno + 1;
    }
    
    }
  }
}

$html_main = '<!-- Main x12 { -->';
$html_main .= '<div CLASS="row">';
$html_main .= '  <div class="col-lg-12">';
$html_main .= '      <div class="ibox float-e-margins">';
$html_main .= '          <div class="ibox-title">';
$html_main .= '              <h5>'.$this->_m->getMessageEntites('view_list','data').'</h5>';
$html_main .= '              <div class="html5buttons">';
$html_main .= '                  <div class="dt-buttons btn-group">'.$html_header.'</div>';
$html_main .= '              </div>';
// $html_main .= '               <div class="ibox-tools">';
// $html_main .= '                   <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">';
// $html_main .= '                       <i class="fa fa-wrench"></i>';
// $html_main .= '                   </a>';
// $html_main .= '                   <ul id="nestable-menu" class="dropdown-menu dropdown-user" x-placement="bottom-start" style="position: absolute; top: 18px; left: 26px; will-change: top, left;">';
// $html_main .= '                       <li id="collapse-all"><a href="javascript:void(0);" class="dropdown-item">Colapsar</a></li>';
// $html_main .= '                       <li id="expand-all"><a href="javascript:void(0);" class="dropdown-item">Expandir</a></li>';
// $html_main .= '                   </ul>';
// $html_main .= '               </div>';
$html_main .= '          </div>';
$html_main .= '          <div class="ibox-content">';
$html_main .= '              <div class="table-responsive">';
$html_main .= '                  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">';
$html_main .= '                      <div class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">'.$return_list.'</div>';
$html_main .= '                  </div>';
$html_main .= '              </div>';
$html_main .= '          </div>';
$html_main .= '      </div>';
$html_main .= '  </div>';
$html_main .= '</div>';
$html_main .= '<!-- Modal -->';
$html_main .= '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
$html_main .= '  <div class="modal-dialog">';
$html_main .= '      <div class="modal-content">';
$html_main .= '          <div class="modal-header">';
$html_main .= '              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>';
$html_main .= '              <h4 class="modal-title">Detail</h4>';
$html_main .= '          </div>';
$html_main .= '          <div class="modal-body"></div>';
$html_main .= '          <div class="modal-footer">';
$html_main .= '              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
$html_main .= '          </div>';
$html_main .= '      </div>';
$html_main .= '      <!-- /.modal-content -->';
$html_main .= '  </div>';
$html_main .= '  <!-- /.modal-dialog -->';
$html_main .= '</div>';
$html_main .= '<!-- /.modal -->';


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
// $temp->setData('/html/body/div/div/div/nav/div/a', 0, $this->_m->getMessageEntites('global','see_site'));
$temp->setData('/html/body/div/div/div/nav/div', 0, $html_global_buttons);
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
