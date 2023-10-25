<?php
/* View: list
 * Action: List the records
 * Return: HTML return
 * Comment: Retrieve the result of query, The name of the variable return is $resultSelect
 */
if(isset($resultSelect)){
  $return_list = '';
  $return_pager = '';
  $quantity_fields = -1;
  $collector_js = '';
  
  if( is_array($resultSelect) ){
    // print_r($resultSelect);
    // exit();

    $quantityRecords = count($resultSelect);

    if($this->_pager==true){
      $pagerLink = 'index.php';
      $pagerPropagate = array('controller','action');

      $this->_model->setTable($this->_prefix.$this->_table);
      $this->_model->setFields($this->_fields);

      $pagerRecords = $this->_model->getTotalRecords();

      require_once( dirname(__FILE__) . '/../../_lib/paginador/Class.Paginador.php' );
      $pager = new Paginador;
      $pager->setRecords($pagerRecords);
      $pager->setPagerQuantity($this->_pager_quantity);
      $pager->setPagerPage($this->_pager_page);
      $pager->setPagerUrl($pagerLink);
      $pager->setPropaga($pagerPropagate);
      $return_pager = $pager->paginado();
    }
    # Titles {
      // foreach($this->_fields_show as $fields){
      //   if(strtolower($fields)!=$the_status){
      //     $quantity_fields = $quantity_fields + 1;
      //   }
      //   if(strtolower($fields)==$the_order){
      //     $quantity_fields = $quantity_fields - 1;
      //   }
      // }

      $thead = '<tr>';
      foreach($this->_fields_show_fild as $campo){
        $validate_id = explode('_',$campo['field']);
        $is_id = $validate_id[0] == 'id' ? true : false;

        if(strtolower($campo['field'])!=$the_status && strtolower($campo['field'])!=$the_order){
          if($is_id === true && $campo['field-type']=='PRI'){
            $thead .= '   <th class="indice">' . $campo['name'] .'</th>';
          }else{
            $thead .= '   <th>' . $campo['name'] .'</th>';
          }
        }
      }
      $thead .= '   <th>Actions</th>';
      $thead .= '</tr>';
    # } Titles

    # Rows {
      $tfoot = '<tr>';
      foreach($this->_fields as $field){
        if(strtolower($field)!=$the_status && strtolower($field)!=$the_order){
          $tfoot .= '   <th>' . $field .'</th>';
        }
      }
      $tfoot .= '   <th>actions</th>';
      $tfoot .= '</tr>';
    # }
    $lista = true;

  }else{
      $return_list = 'No hay registros';
      $return_pager = '';
      $lista = false;
  }

  $html_main = '<!-- Main x12 { -->';
  $html_main .= '<div CLASS="row">';
  $html_main .= '  <div class="col-lg-12">';
  $html_main .= '      <div class="ibox float-e-margins">';
  $html_main .= '          <div class="ibox-title">';
  $html_main .= '              <h5>'.$this->_m->getMessageEntites('view_list','data').'</h5>';
  /*
  $html_main .= '                  <div class="ibox-tools">';
  $html_main .= '                      <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>';
  $html_main .= '                  </div>';
   */
  $html_main .= '              <div class="html5buttons">';
  $html_main .= '                  <div class="dt-buttons btn-group">'.$html_header.'</div>';
  $html_main .= '              </div>';
  $html_main .= '          </div>';
  $html_main .= '          <div class="ibox-content">';
  $html_main .= '              <div class="table-responsive">';

  if($lista==true){
  $html_main .= '                  <table class="table table-striped table-bordered table-hover responsive" id="dataTables-example" style="width:100%">';
  $html_main .= '                     <thead>';
  $html_main .= '                     '.$thead;
  $html_main .= '                     </thead>';
  // $html_main .= '                     <tfoot>';
  // $html_main .= '                     '.$tfoot;
  // $html_main .= '                     </tfoot>';
  $html_main .= '                  </table>';
  // $html_main .= '			'.$return_pager;
  }else{
  $html_main .= '                  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">';
  $html_main .= '                      <div class="col-lg-12" style="pading:15px 0 0px 15px !important;">';
  $html_main .= '                          <div class="panel panel-default" style="margin-top: 15px">';
  $html_main .= '                             <div class="panel-heading">';
  $html_main .= '                                 <h5 class="panel-title">'.$this->_m->getMessageEntites('view_list','no_records').'</h5>';
  $html_main .= '                             </div>';
  $html_main .= '                             <div class="panel-body">';
  $html_main .= '                                 <p>'.$this->_m->getMessageEntites('view_list','no_records_detail').'</p>';
  $html_main .= '                             </div>';
  $html_main .= '                             <div class="panel-footer" style="text-align: right">';
  $html_main .= '                                 <a href="'.$urlCreateEntities.'" class="btn btn-primary btn-xs">Create</a>';
  $html_main .= '                             </div>';
  $html_main .= '                         </div>';
  $html_main .= '                     </div>';
  $html_main .= '                  </div>';
  }
  
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
}else{
	$return_list = 'No hay registros';
	$return_pager = '';
	$lista = false;
	
	$html_main = '<!-- Main x12 { -->';
  $html_main .= '<div CLASS="row">';
  $html_main .= '  <div class="col-lg-12">';
  $html_main .= '      <div class="ibox float-e-margins">';
  $html_main .= '          <div class="ibox-title">';
  $html_main .= '              <h5>'.$this->_m->getMessageEntites('view_list','data').'</h5>';
  $html_main .= '              <div class="html5buttons">';
  $html_main .= '                  <div class="dt-buttons btn-group">'.$html_header.'</div>';
  $html_main .= '              </div>';
  $html_main .= '          </div>';
  $html_main .= '          <div class="ibox-content">';
  $html_main .= '              <div class="table-responsive">';
  $html_main .= '                  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">';
  $html_main .= '                      <div class="col-lg-12" style="pading:15px 0 0px 15px !important;">';
  $html_main .= '                          <div class="panel panel-default" style="margin-top: 15px">';
  $html_main .= '                             <div class="panel-heading">';
  $html_main .= '                                 <h5 class="panel-title">'.$this->_m->getMessageEntites('view_list','no_records').'</h5>';
  $html_main .= '                             </div>';
  $html_main .= '                             <div class="panel-body">';
  $html_main .= '                                 <p>'.$this->_m->getMessageEntites('view_list','no_records_detail').'</p>';
  $html_main .= '                             </div>';
  $html_main .= '                             <div class="panel-footer" style="text-align: right">';
  $html_main .= '                                 <a href="'.$urlCreateEntities.'" class="btn btn-primary btn-xs">Create</a>';
  $html_main .= '                             </div>';
  $html_main .= '                         </div>';
  $html_main .= '                     </div>';
  $html_main .= '                  </div>';
  $html_main .= '              </div>';
  $html_main .= '          </div>';
  $html_main .= '      </div>';
  $html_main .= '  </div>';
  $html_main .= '</div>';
}

$collector = '
$(document).ready(function() {
';

$collector .= '
$.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { console.log(message)};
$.extend( true, $.fn.dataTable.defaults, lang_esp );   
';

// $collector .= '
// $.fn.dataTable.ext.errMode = () => alert("Seleccione la columna en la que se buscara.\rLas columnas numericas no soportan letras.\rLa busqueda rápida no funciona en campos que son una relación con otra tabla.");
// ';


$collector .= '
  $("input[type=search]").val("").change();
  var oTable = $("#dataTables-example").dataTable( {
      "processing": true,
      "serverSide": true,
      "responsive": true,
      "ajax": "index.php?controller='.$this->_table.'&action=listedAjax",';
// $collector .= 'error: function (jqXHR, textStatus, errorThrown) { alert("error");},';
$collector .= '"columns": [ ';

      // foreach($resultSelect as $key => $value) {

        foreach($this->_fields as $k=>$v){
          
          if(strtolower($v)!=$the_status && strtolower($v)!=$the_order)
          {
            
            if ($table_fields[$v]['type_of']=='file') // Tratamos FILES
            {
              $collector .= '{ "data": "'.$v.'", "orderable": false },';
            }
            else if ($table_fields[$v]['type_of']=='checkbox') // Tratamos checkbox
            {
              $collector .= '{ "data": "'.$v.'", "orderable": false },';
            }
            // else if ($table_fields[$v]['type_of']=='tinyint' || $table_fields[$v]['type_of']=='order') 
            // {
            //   $collector .= '{ "data": "'.$v.'", "orderable": false },';
            // }
            else if ($table_fields[$v]['type_of']=='multicheckbox') // Tratamos multicheckbox
            {
              $collector .= '{ "data": "'.$v.'", "orderable": false },';
            }
            else if ($table_fields[$v]['type_of']=='bigint')
            {
              $collector .= '{ "data": "'.$v.'" },';
            }
            else
            {
              if (!empty($table_fields[$v]['key'])) // Preguntamos si es un KEY foraneo
              {
                if ($table_fields[$v]['key']=='PRI')
                {
                  $collector .= '{ "data": "'.$v.'" },';
                }
                else
                {
                  $collector .= '{ "data": "'.$v.'", },';
                }
              }
              else{
                $collector .= '{ "data": "'.$v.'" },';
              }
            }

          }

        }

      // }

$collector .= '{
        "className": "details-control",
        "orderable": false,
        "searchable": false,
        "data": "actions",
        "defaultContent": "",
        "width": "161px",
      },
    ],
    order: [[0, "desc"]],
      ';

$collector .= '
  } );

  $("input[type=search]").unbind();

  $("div.dataTables_wrapper div.dataTables_filter input").on(\'click\', function (e) {
    oTable.fnFilter($("input[type=search]").val());
  });

  $("div.dataTables_wrapper div.dataTables_filter label").append(\'<span class="fa fa-search form-control-feedback"></span>\');
';

$collector .= '
});
';
// $collector .= $collector_js;

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
  <link REL="stylesheet" type="text/css" href="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/vendor/datatables/css/jquery.dataTables.min.css" />
';

# Instance template
$temp = new Templates();

# Skin
$temp->setSkinPath(FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/');

# Files
$temp->setTemplate('_List.xml');

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

# Set JS
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
# Magnific Popup core JS file
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/magnific-popup/dist/jquery.magnific-popup.js'));
# Magnific Popup core JS file
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/vendor/datatables/js/jquery.dataTables.js'));
# Magnific Popup core JS file
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/vendor/datatables/js/dataTables.bootstrap.js'));
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/vendor/datatables-responsive/dataTables.responsive.min.js'));
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/vendor/datatables/js/esp.js'));

$final_script = "
  $(document).ready(function(){
    $('.bot-modal').click(function(){
      var dataURL = $(this).attr('data-href');
      console.log('URL: '+dataURL);
      $('.modal-body').load(dataURL,function(){
        $('#myModal').modal({show:true});
      });
    });
  });
";
$temp->addChild("body",0,"script", $final_script);

# Set CSS
# Magnific Popup core CSS file
$temp->addFile("head",0,"link",array('rel'=>'stylesheet', 'type'=>'text/css', 'href'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/magnific-popup/dist/magnific-popup.css'));

if($this->_action!='preview' && $this->_action!='cargar'){
    # Scripts
    $temp->addChild("body",0,"script", $collector);
}

echo $temp->getTemplate();
