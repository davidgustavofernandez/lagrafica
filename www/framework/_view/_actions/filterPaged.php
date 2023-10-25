<?php
/* View: filterPaged
 * Action: Shows a filtered listing
 * Return: HTML return
 * Comment: Generates a paged list after applying a search, that is with a filter applied
 */

$listado = '';
$paginador = '';
$cantidad_campos = -1;

if( is_array($resultFilter) ){
    $cantidadRecords = count($resultFilter);

    if($this->_pager==true){
        $paginadorLink = 'index.php';
        $paginadorPropagate = array('controller','action');

        $this->_model->setTable($this->_prefix.$this->_table);
        $this->_model->setFields($this->_fields);

        $paginadorRecords = $this->_model->getTotalRecords();

        require_once( dirname(__FILE__) . '/../../_lib/paginador/Class.Paginador.php' );
        $pager = new Paginador;
        $pager->setRecords($paginadorRecords);
        $pager->setPagerQuantity($pagerQuantity);
        $pager->setPagerPage($pagerPage);
        $pager->setPagerUrl($paginadorLink);
        $pager->setPropaga($paginadorPropagate);
        $paginador = $pager->paginado();
    }

    foreach($this->_fields_show as $fields){
        if(strtolower($fields)!=$the_status){
            $cantidad_campos = $cantidad_campos + 1;
        }
        
        if(strtolower($fields)==$the_order){
            $cantidad_campos = $cantidad_campos - 1;
        }
    }

    # Title {
    $listado = '<div class="subrow principal">';
    $collector = '';
    // foreach($this->_fields_show as $campo){
    //     if(strtolower($campo)!=$the_status && strtolower($campo)!=$the_order){
    //         if($campo=='Id'){
    //             $listado .= '   <div class="strings indice"><h1>' . $campo .'</h1></div>';
    //         }else{
    //             $listado .= '   <div class="strings rx'.$cantidad_campos.'"><h1>' . $campo .'</h1></div>';
    //         }
    //     }
    // }
    foreach($this->_fields_show_fild as $campo){
      $validate_id = explode('_',$campo['field']);
      $is_id = $validate_id[0] == 'id' ? true : false;

      if(strtolower($campo['field'])!=$the_status && strtolower($campo['field'])!=$the_order){
        if($is_id === true && $campo['field-type']=='PRI'){
          $listado .= '   <div class="strings indice"><h1>' . $campo['name'] .'</h1></div>';
        }else{
          $listado .= '   <div class="strings rx'.$cantidad_campos.'"><h1>' . $campo['name'] .'</h1></div>';
        }
      }
    }
    $listado .= '   <div class="actions action"></div>';
    $listado .= '</div>';
    # } Title

    # Detail {
    $color = 1;
    $indice_interno = 1;
    $total_records = count($resultFilter);

    foreach($resultFilter as $record){
        $valor = ($color / 2);
        $colorAplica = is_float($valor) ? '1' : '2';
        $tiene_orden = false;

        $listado .= '<div class="subrow_'.$colorAplica.'">';

        foreach($this->_fields as $key=>$value){
            if(in_array($table_fields[$value]['alternatename'], $this->_fields_show)){
                if($table_fields[$value]['type_of']=='order'){
                    $tiene_orden = true;
                }

                if($value!=$the_status && $value!=$the_order){
                    if(in_array($value,$this->_fields_relation) && !empty($table_fields[$value]['query']) ){
                        $aplica_were = substr_count($table_fields[$value]['query'],'WHERE');

                        if($aplica_were>=1){
                            $field_primary_query = $this->_model->getInjection($table_fields[$value]['query'].' and ' . $value . '=' . $record->$value);
                        }else{
                            if($table_fields[$value]['type_of']=='selectparent'){
                                $values = str_replace('parent_','',$value);
                                // echo $table_fields[$value]['query'].' WHERE ' . $values . '=' . $record->$value.'<br>';
                                $field_primary_query = $this->_model->getInjection($table_fields[$value]['query'].' WHERE ' . $values . '=' . $record->$value);
                            }elseif($table_fields[$value]['type_of']=='selectequal'){
                                $values = str_replace('equal1_','',$value);
                                $values = str_replace('equal2_','',$values);
                                $values = str_replace('equal3_','',$values);
                                // echo $table_fields[$value]['query'].' WHERE ' . $values . '=' . $record->$value.'<br>';
                                $field_primary_query = $this->_model->getInjection($table_fields[$value]['query'].' WHERE ' . $values . '=' . $record->$value);
                            }else{
                              $field_primary_query = $this->_model->getInjection($table_fields[$value]['query'].' WHERE ' . $value . '=' . $record->$value);
                            }
                        }

                        $elString = !empty($field_primary_query[0]->name) ? $field_primary_query[0]->name : '';
                        $elColorTexto = !empty($field_primary_query[0]->color_font) ? '#'.$field_primary_query[0]->color_font : '#000 !important';
                        $elColorFondo = !empty($field_primary_query[0]->color) ? '#'.$field_primary_query[0]->color : '#fff !important';

                        if(in_array($value,$array_leds_status)){
                            $listado .= '   <div class="strings rx'.$cantidad_campos.'" style="background-color:'.$elColorFondo.';"><h2 style="color:'.$elColorTexto.' !important;">' . $elString . '</h2></div>';
                        }else{
                            $listado .= '   <div class="strings rx'.$cantidad_campos.'"><h2><div class="datacel">'.$table_fields[$value]['alternatename'].':&nbsp;</div>' . $elString . '</h2></div>';
                        }
                    }else{
                        if($table_fields[$value]['type_of']=='file' && !empty($record->$value))
                        {
                            if(file_exists($this->_files_path_physical.'thumb/'.$record->$value) || file_exists($this->_files_path_physical.'small/'.$record->$value) || file_exists($this->_files_path_physical.'big/'.$record->$value) || file_exists($this->_files_path_physical.'media/'.$record->$value))
                            {	
                                if(file_exists($this->_files_path_physical.'thumb/'.$record->$value)){
                                    $in_path = 'thumb/';
                                }else if(file_exists($this->_files_path_physical.'small/'.$record->$value)){
                                    $in_path = 'small/';
                                }elseif(file_exists($this->_files_path_physical.'big/'.$record->$value)){
                                    $in_path = 'big/';
                                }elseif(file_exists($this->_files_path_physical.'media/'.$record->$value)){
                                    $in_path = 'media/';
                                }

                                if(file_exists($this->_files_path_physical.'media/'.$record->$value)){
                                    $in_path_big = 'media/';
                                }else if(file_exists($this->_files_path_physical.'big/'.$record->$value)){
                                    $in_path_big = 'big/';
                                }elseif(file_exists($this->_files_path_physical.'small/'.$record->$value)){
                                    $in_path_big = 'small/';
                                }elseif(file_exists($this->_files_path_physical.'thumb/'.$record->$value)){
                                    $in_path_big = 'thumb/';
                                }

                                $extencion = explode(".",$record->$value);
                                $extArchivo = '.'.strtolower($extencion[1]);
                                $extImages = array (".jpg", ".jpeg", ".gif", ".png");

                                if( in_array($extArchivo,$extImages) && $in_path == 'thumb/' ){
                                    $imagen_mostrar 	= $this->_files_path_host.$in_path.$record->$value;
                                    $imagen_mostrar_pop = $this->_files_path_host.$in_path_big.$record->$value;
                                }else{
                                    $imagen_mostrar 	= CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon_folder/48x48/icon_folder_'.strtolower($extencion[1]).'.gif';
                                    $imagen_mostrar_pop	= $this->_files_path_host.$in_path_big.$record->$value;
                                }

                                if(empty($imagen_mostrar_pop)){
                                    $listado .= '   <div class="strings rx'.$cantidad_campos.'"><img src="'.$imagen_mostrar.'" border="0" style="border-color:#CCCCCC;"></div>';
                                }else{
                                    if( in_array($extArchivo,$extImages) ){
                                        $listado .= '   <div class="strings rx'.$cantidad_campos.'"><a href="'.$imagen_mostrar_pop.'" rel="superbox[image]" class="pop_'.$table_fields[$value]['field'].'"><img src="'.$imagen_mostrar.'" border="0" style="border-color:#CCCCCC;"></a></div>';
                                        $collector .= $this->_f->magnificPpoUp('pop_'.$table_fields[$value]['field'].'','image',''.$imagen_mostrar_pop.'');
                                    }else{
                                        $listado .= '   <div class="strings rx'.$cantidad_campos.'"><a href="'.$imagen_mostrar_pop.'"  class="pop_'.$table_fields[$value]['field'].'" targuet="_blank"><img src="'.$imagen_mostrar.'" border="0" style="border-color:#CCCCCC;"></a></div>';
                                    }
                                }
                            }
                        }else if($table_fields[$value]['type_of']=='varcharlink' && !empty($record->$value)){
                            $listado .= '   <div class="strings rx'.$cantidad_campos.'">' . $record->$value . ' <a href="' . $record->$value . '" target="_blank">[ver]</a></div>';
                        }else{
                            $pos = strpos($record->$value, '@');

                            if ($pos !== false) {
                                $array_mail = explode('@',$record->$value);
                                $new_str = $array_mail['0'].'</br>@'.$array_mail['1'];
                            }else{
                                $new_str = strip_tags($record->$value,"<b>");
                            }
                            
                            if($table_fields[$value]['key']=='PRI'){
                                $listado .= '   <div class="strings indice"><h2><div class="datacel">'.$table_fields[$value]['alternatename'].':&nbsp;</div>' . $new_str . '</h2></div>';
                            }else{                                
                                if($table_fields[$value]['type_of']=='checkbox'){
                                    $validate_empty =  empty( $new_str ) ? '<h2>No</h2><div class="datacel">'.$table_fields[$value]['alternatename'].':&nbsp;</div>' : '<h1>Si</h1>';
                                    $listado .= '   <div class="strings rx'.$cantidad_campos.'">' . $validate_empty . '</div>';
                                }else{
                                    $listado .= '   <div class="strings rx'.$cantidad_campos.'"><h2><div class="datacel">'.$table_fields[$value]['alternatename'].':&nbsp;</div>' . $new_str . '</h2></div>';
                                }
                            }
                        }
                    }
                }
            }
        }

        $disposition_listed = '';
        
        if($tiene_orden==true){
            if($this->_sort=='ASC'){
                $nuestra_primero = true;
                $nuestra_ultimo = true;

                $cp = ceil($paginadorRecords / $pagerQuantity);
                $cpm = empty($cp) ? 0 : $cp-1;

                $tempPaginaMasUno = $this->_pager_page +1;
                $tempPaginaMenosUno = $this->_pager_page -1;

                if($indice_interno==1 && $pagerPage==0){
                    $nuestra_primero = false;
                }

                if($cantidadRecords>=2 && $this->_pager_page==$cpm && $cantidadRecords==$indice_interno){
                    $nuestra_ultimo = false;
                }
                
                if($nuestra_primero){
                    $disposition_listed .= '<div class="disposition"><a href="index.php?controller='.$this->_controller.'&amp;action=disposition&amp;direccion=antes&amp;'.$the_key.'='.$record->$the_key.'&amp;pager_page='.$this->_pager_page.'&amp;" class="fa fa-caret-right" title="Antes"></a>';
                }else{
                    $disposition_listed .= '<div class="disposition">•';
                }					

                $largo = strlen($record->$the_order);
                
                if($largo>=2){
                    $disposition_listed .= '<div class="numero">';
                    $elvalor = $record->$the_order;
                    
                    for($i = 0; $i < $largo; $i++)  {
                       $disposition_listed .= $elvalor[$i];
                    }
                    
                    $disposition_listed .= '</div>';
                }else{
                    $disposition_listed .= '<div class="numero">'.$record->$the_order.'</div>';
                }

                if($nuestra_ultimo){
                    $disposition_listed .= '<a href="index.php?controller='.$this->_controller.'&amp;action=disposition&amp;direccion=despues&amp;'.$the_key.'='.$record->$the_key.'&amp;pager_page='.$this->_pager_page.'&amp;" class="bot_despues" title="Despues">></a></div>';
                }else{
                    $disposition_listed .= '•</div>';
                }
            }else if($this->_sort=='DESC'){
                $nuestra_primero = true;
                $nuestra_ultimo = true;

                $cp = ceil($paginadorRecords / $pagerQuantity);
                $cpm = empty($cp) ? 0 : $cp-1;

                $tempPaginaMasUno = $this->_pager_page +1;
                $tempPaginaMenosUno = $this->_pager_page -1;

                if($indice_interno==1 && $pagerPage==0){
                    $nuestra_primero = false;
                }

                if($cantidadRecords>=2 && $this->_pager_page==$cpm && $cantidadRecords==$indice_interno){
                    $nuestra_ultimo = false;
                }
                
                if($nuestra_primero){
                    $disposition_listed .= '<div class="disposition"><a href="index.php?controller='.$this->_controller.'&amp;action=disposition&amp;direccion=despues&amp;'.$the_key.'='.$record->$the_key.'&amp;pager_page='.$this->_pager_page.'&amp;" class="fa fa-caret-left" title="Despues"></a>';
                }else{
                    $disposition_listed .= '<div class="disposition"><div class="primero">•</div>';
                }					

                $largo = strlen($record->$the_order);
                
                if($largo>=2){
                    $disposition_listed .= '<div class="numero">';
                    $elvalor = $record->$the_order;
                    for($i = 0; $i < $largo; $i++)  {
                       $disposition_listed .= $elvalor[$i];
                    }
                    $disposition_listed .= '</div>';
                }else{
                    $disposition_listed .= '<div class="numero">'.$record->$the_order.'</div>';
                }

                if($nuestra_ultimo){
                    $disposition_listed .= '<a href="index.php?controller='.$this->_controller.'&amp;action=disposition&amp;direccion=antes&amp;'.$the_key.'='.$record->$the_key.'&amp;pager_page='.$this->_pager_page.'&amp;" class="fa fa-caret-right" title="Antes"></a></div>';
                }else{
                    $disposition_listed .= '<div class="ultimo">•</div></div>';
                }
            }
        }

        $listado .= '   <div class="actions action">';
        $listado .= $disposition_listed;

        // $listado .= '       <a href="index.php?controller='.$this->_controller.'&amp;action=preview&amp;'.$the_key.'='.$record->$the_key.'&amp;pager_page='.$this->_pager_page.'&amp;" class="bot_action btn-primary fa fa-eye" rel="superbox[iframe][1162x600]"></a>';
        $listado .= '       <a href="javascript:void(0);" data-href="index.php?controller='.$this->_controller.'&amp;action=preview&amp;'.$the_key.'='.$record->$the_key.'&amp;pager_page='.$this->_pager_page.'&amp;" class="bot_action bot-modal btn-primary fa fa-eye"></a>';
        
        $listado .= '       <a href="index.php?controller='.$this->_controller.'&amp;action=edit&amp;'.$the_key.'='.$record->$the_key.'&amp;pager_page='.$this->_pager_page.'&amp;" class="bot_action btn-primary fa fa-pencil"></a>';

        if(isset($record->$the_status)){
            if($record->$the_status==1){
                $listado .= '       <a href="index.php?controller='.$this->_controller.'&amp;action=activate&amp;'.$the_key.'='.$record->$the_key.'&amp;pager_page='.$this->_pager_page.'&amp;" class="bot_action btn-primary fa fa-check"></a>';
            }else{
                $listado .= '       <a href="index.php?controller='.$this->_controller.'&amp;action=activate&amp;'.$the_key.'='.$record->$the_key.'&amp;pager_page='.$this->_pager_page.'&amp;" class="bot_action btn-primary fa fa-times"></a>';
            }
        }
        
        $listado .= '       <a href="index.php?controller='.$this->_controller.'&amp;action=delete&amp;'.$the_key.'='.$record->$the_key.'&amp;pager_page='.$this->_pager_page.'&amp;" class="bot_action btn-primary fa fa-trash-o"></a>';
        $listado .= '   </div>';
        
        $color = $color + 1;
        $indice_interno = $indice_interno + 1;
        
        $listado .= '</div>';
    }
    # } Detail
    $lista = true;
}else{
    $listado = 'No hay registros';
    $paginador = '';
    $lista = false;
}

$html_main = '<!-- Main x12 { -->';
$html_main .= '<div CLASS="row">';
$html_main .= '  <div class="col-lg-12">';
$html_main .= '      <div class="ibox float-e-margins">';
$html_main .= '          <div class="ibox-title">';
$html_main .= '              <h5>Datos en la tabla</h5>';
$html_main .= '              <div class="html5buttons">';
$html_main .= '                  <div class="dt-buttons btn-group">'.$html_header.'</div>';
$html_main .= '              </div>';
$html_main .= '          </div>';
$html_main .= '          <div class="ibox-content">';
$html_main .= '              <div class="table-responsive">';
$html_main .= '                  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">';
if($lista==true){
$html_main .= '                      <div class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">'.$listado.'</div>';
}else{
$html_main .= '                      <div class="col-lg-12" style="pading:15px 0 0px 15px !important;">';
$html_main .= '                          <div class="panel panel-default" style="margin-top: 15px">';
$html_main .= '                              <div class="panel-heading"><h5 class="panel-title">No hay registros</h5></div>';
$html_main .= '                              <div class="panel-body"><p>Aún no hay contenidos puede cargar nuevos contenidos haciendo clic en el boton crear.</p></div>';
$html_main .= '                              <div class="panel-footer" style="text-align: right">';
$html_main .= '                                  <a href="'.$urlSearchEntities.'" class="btn btn-primary btn-xs">Search</a>';
$html_main .= '                                  <a href="'.$urlCreateEntities.'" class="btn btn-primary btn-xs">Create</a>';
$html_main .= '                                  <a href="'.$urlListedEntities.'" class="btn btn-primary btn-xs">Listed</a>';
$html_main .= '                              </div>';
$html_main .= '                          </div>';
$html_main .= '                      </div>';
}
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

$final_script = "
  $(document).ready(function(){

   $('.bot_action.bot-modal').click(function(){
    console.log(dataURL);
    var dataURL = $(this).attr('href');
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