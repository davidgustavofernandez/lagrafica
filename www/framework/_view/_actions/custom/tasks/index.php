<?php
/* View: index
 * Action: Show inital options
 * Return: HTML return
 * Comment: Show the access to principal functions (Here you can add charts, info or other function)
 */

$html_main = '';
$html_main .= '<div CLASS="row">';
$html_main .= ' <div class="col-lg-12">';
$html_main .= '  <div class="ibox float-e-margins">';
$html_main .= '      <div class="ibox-title">';
$html_main .= '          <h5>'.$this->_m->getMessageEntites('view_dashboard','dashboard').' <small>'.$this->_m->getMessageEntites('view_dashboard','section').'</small></h5>';
$html_main .= '          <div class="html5buttons">';
$html_main .= '              <div class="dt-buttons btn-group">'.$html_header.'</div>';
$html_main .= '          </div>';
$html_main .= '      </div>';
# CHART {	
$html_main .= '      <div class="ibox-content">';
$html_main .= '          <div class="row">';
$html_main .= '              <div class="col-lg-12">';
$html_main .= '                  <div class="panel panel-primary">';
$html_main .= '                      <div class="panel-heading">';
$html_main .= '                          <h5 class="panel-title"><i class="fa fa-bar-chart" aria-hidden="true"></i> Metrics</h5>';
$html_main .= '                      </div>';
$html_main .= '                      <div class="panel-body">';
$html_main .= '                          <canvas id="lineChart" width="100%" height="30"></canvas>';
$html_main .= '                      </div>';
$html_main .= '                      <!--<div class="panel-footer" style="text-align: right">';
$html_main .= '                          <a href="'.$urlListedEntities.'" class="btn btn-primary btn-xs">'.$this->_m->getMessageEntites('view_dashboard','content_list_button').'</a>';
$html_main .= '                      </div>-->';
$html_main .= '                  </div>';
$html_main .= '              </div>';
$html_main .= '          </div>';
$html_main .= '      </div>';
# } CHART
$html_main .= '  </div>';
$html_main .= ' </div>';
$html_main .= '</div>';


$the_query = "SELECT * FROM ".$this->_prefix."tasks_states WHERE status='1'";
$tasks_status = $this->_model->getInjection($the_query);

$valor_tasks_status_temp = Array();
$names_tasks_status_temp = Array();
$labels_tasks_status_temp = Array();
$color_tasks_status_temp = Array();
$border_color_tasks_status_temp = Array();

if(!empty($tasks_status )){
    foreach($tasks_status as $ts){
        ${"task_".$ts->id_task_state} = $this->_model->getInjection("SELECT count(id_task) as total FROM ".$this->_prefix.$this->_table." WHERE id_task_state='".$ts->id_task_state."' and status='1'");
        array_push($valor_tasks_status_temp, ${"task_".$ts->id_task_state}[0]->total);
        array_push($names_tasks_status_temp, "task_".$ts->id_task_state);
        array_push($labels_tasks_status_temp, $ts->name);
    
        if(!empty($ts->color)){
            list($r, $g, $b) = sscanf($ts->color, "#%02x%02x%02x");
            array_push($color_tasks_status_temp, 'rgba('.$r.', '.$g.', '.$b.', 0.2)');
            array_push($border_color_tasks_status_temp, 'rgb('.$r.', '.$g.', '.$b.')');
        }
    }
}

$valor_tasks_status = "'".implode("', '", $valor_tasks_status_temp)."'";
$names_tasks_status = "'".implode("', '", $names_tasks_status_temp)."'";
$labels_tasks_status = '"'.implode('", "', $labels_tasks_status_temp).'"';
$color_tasks_status = '"'.implode('", "', $color_tasks_status_temp).'"';
$border_color_tasks_status = '"'.implode('", "', $border_color_tasks_status_temp).'"';

$collector = '
$(function () {

    var lineData = {
        labels: ['.$labels_tasks_status.'],
        datasets: [
            {
                label: "Files loaded",
                data: ['.$valor_tasks_status.'],
                fill: false,
                backgroundColor: ['.$color_tasks_status.'],
                borderColor: ['.$border_color_tasks_status.'],
                borderWidth:1,
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
            }
        ]
    };

    var lineOptions = {
        responsive: true
    };

    var ctx = document.getElementById("lineChart").getContext("2d");
    new Chart(ctx, {type: "bar", data: lineData, options:lineOptions});

});';


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
# ChartJs DEMO
// $temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/chartjs/ja_chartjs-demo.js'));

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