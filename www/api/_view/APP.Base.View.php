<?php

$urlListar = 'index.php?controller=' . $this->_controller . '&action=listar&paginar=' . $this->_pager_page . '&';
$urlListarEntities = htmlentities($urlListar);
$the_key = $this->_key;
$sin = array('error');

switch ($action) {

  case 'index':
    $sin = array(htmlentities('Controlador: ') . $this->_controller);
    $data = array(
      'error' => true,
      'controller' => $this->_controller,
      'action' => $this->_action,
      'data' => $sin
    );
    $retorno = json_encode($data);
    $tpl_main = $retorno;
    break;

    // case 'listar':
    //   if( is_array($resultSelect) ){
    //     $cantidadRecords = count($resultSelect);

    //     $data = array(
    //       'error' => false,
    //       'controller' => $this->_controller,
    //       'action' => $this->_action,
    //       //'pRecords' => $pagerRecords,
    //       'pCantidad' => $pagerQuantity,
    //       'pPaginar' => $pagerPage,
    //       //'pLink' => $pagerLink,
    //       //'pPropagate' => $pagerPropagate,
    //       'data' => $resultSelect
    //     );
    //     $retorno = json_encode($data);
    //   }else{
    //     $data = array(
    //       'error' => true,
    //       'controller' => $this->_controller,
    //       'action' => $this->_action,
    //       'data' => $sin
    //     );
    //     $retorno = json_encode($data);
    //   }

    //   $tpl_main = $retorno;
    // break;

  case 'listed':
    if (is_array($resultSelect)) {
      $data = array(
        'error' => false,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $resultSelect
      );
      $retorno = json_encode($data);
    } else {
      $data = array(
        'error' => true,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $sin
      );
      $retorno = json_encode($data);
    }

    $tpl_main = $retorno;
    break;

  case 'filter':
    if (is_array($resultFilter)) {
      $data = array(
        'error' => false,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $resultFilter
      );
      $retorno = json_encode($data);
    } else {
      $sin = array('No hay registros');
      $data = array(
        'error' => true,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $sin
      );
      $retorno = json_encode($data);
    }

    $tpl_main = $retorno;
    break;

  case 'filtrar':
    if (is_array($resultFilter)) {
      $data = array(
        'error' => false,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $resultFilter
      );
      $retorno = json_encode($data);
    } else {
      $data = array(
        'error' => true,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $sin
      );
      $retorno = json_encode($data);
    }

    $tpl_main = $retorno;
    break;

  case 'posicion':
    if (!empty($result)) {
      $data = array(
        'error' => false,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $result
      );
      $retorno = json_encode($data);
    } else {
      $data = array(
        'error' => true,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $sin
      );
      $retorno = json_encode($data);
    }

    $tpl_main = $retorno;
    break;

  case 'search':
    if (is_array($result)) {
      $data = array(
        'error' => false,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $result
      );
      $retorno = json_encode($data);
    } else {
      $data = array(
        'error' => true,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $sin
      );
      $retorno = json_encode($data);
    }

    $tpl_main = $retorno;
    break;

  case 'detail':
    if (is_object($resultSingle['0'])) {
      $data = array(
        'error' => false,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'structure' => $table_fields,
        'data' => $resultSingle['0']
      );
      $retorno = json_encode($data);
    } else {
      $data = array(
        'error' => true,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $sin
      );
      $retorno = json_encode($data);
    }

    $tpl_main = $retorno;
    break;

  case 'talos01':
    if (is_int($resultInsertar)) {
      $data = array(
        'error' => false,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $resultInsertar
      );
      $retorno = json_encode($data);
    } else {
      $data = array(
        'error' => true,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $sin
      );
      $retorno = json_encode($data);
    }

    $tpl_main = $retorno;
    break;

  case 'talos02':
    if (!empty($resultUpdate)) {
      $data = array(
        'error' => false,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $resultUpdate
      );
      $retorno = json_encode($data);
    } else {
      $data = array(
        'error' => true,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $sin
      );
      $retorno = json_encode($data);
    }

    $tpl_main = $retorno;
    break;

  case 'talos03':
    if (!empty($resultDelete)) {
      $data = array(
        'error' => false,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $resultDelete
      );
      $retorno = json_encode($data);
    } else {
      $data = array(
        'error' => true,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $sin
      );
      $retorno = json_encode($data);
    }

    $tpl_main = $retorno;

    break;

  case 'give':

    if (is_array($result)) {
      $data = array(
        'error' => false,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $result
      );
      $retorno = json_encode($data);
    } else {
      $sin = array('No hay registros');
      $data = array(
        'error' => true,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $sin
      );
      $retorno = json_encode($data);
    }

    $tpl_main = $retorno;

    break;

  case 'give2':
    if (is_array($result)) {
      $data = array(
        'error' => false,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $result
      );
      $retorno = json_encode($data);
    } else {
      $sin = array('No hay registros');
      $data = array(
        'error' => true,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $sin
      );
      $retorno = json_encode($data);
    }

    $tpl_main = $retorno;

    break;

  case 'filterPaged':

    if (is_array($resultFilter)) {
      $cantidadRecords = count($resultFilter);

      /*if($this->_pager==true)
      {*/
      $pagerLink = !empty($pagerUrl) ? $pagerUrl : $this->_table . '.php';

      // echo array_key_exists("pager_page",$this->_pager_propagate);
      // exit();
      $pagerPropagateTemp = array_key_exists("pager_page", $pagerPropagate) ? $pagerPropagate : array('controller', 'action');

      $this->_model->setTable($this->_prefix . $this->_table);
      $this->_model->setFields($this->_fields);

      $pagerRecords = $this->_model->getTotalRecords();

      require_once(dirname(__FILE__) . '/../../framework/_lib/pager/Class.Pager.php');
      $pager = new Pager;
      $pager->setPagerType($pagerType);
      $pager->setPagerUrl($pagerLink);
      $pager->setRecords($pagerRecords);
      $pager->setPagerQuantity($pagerQuantity);
      $pager->setPagerPage($pagerPage);
      // print_r($pagerPropagateTemp);
      // exit();
      $pager->setPagerPropagate($pagerPropagateTemp);
      // $pager->setLink($pagerLink);
      // $pager->setPropaga($pagerPropagate);
      $paginador = $pager->paged();
      //}

      $data = array(
        'error' => false,
        'controller' => $this->_controller,
        'action' => $this->_action,

        'pageType' => $pagerType,
        'pageTotalRecords' => $pagerRecords,
        'pageCantidad' => $pagerQuantity,
        'pagePaginar' => $pagerPage,
        'pageLink' => $pagerLink,
        'pagePropagate' => $pagerPropagate,
        'paginador' => $paginador,

        'data' => $resultFilter
      );
      $retorno = json_encode($data);
    } else {
      $data = array(
        'error' => true,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $sin
      );
      $retorno = json_encode($data);
    }

    $tpl_main = $retorno;

    break;

  case 'delete01':

    if (!empty($resultDelete)) {
      $data = array(
        'error' => false,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $resultDelete
      );
      $retorno = json_encode($data);
    } else {
      $data = array(
        'error' => true,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $sin
      );
      $retorno = json_encode($data);
    }

    $tpl_main = $retorno;

    break;

  case 'injectionPaged':

    if (is_array($resultFilter)) {
      $cantidadRecords = count($resultFilter);

      /*if($this->_pager==true)
      {*/
      // $pagerLink = $this->_table.'.php';
      $pagerLink = !empty($pagerUrl) ? $pagerUrl : $this->_table . '.php';
      $pagerPropagate = array('controller', 'action');

      $this->_model->setTable($this->_prefix . $this->_table);
      $this->_model->setFields($this->_fields);

      $pagerRecords = $this->_model->getTotalRecords();

      require_once(dirname(__FILE__) . '/../../framework/_lib/pager/Class.Pager.php');
      $pager = new Pager;
      $pager->setPagerType($pagerType);
      $pager->setPagerUrl($pagerLink);
      $pager->setRecords($pagerRecords);
      $pager->setPagerQuantity($pagerQuantity);
      $pager->setPagerPage($pagerPage);
      // $pager->setLink($pagerLink);
      // $pager->setPropaga($pagerPropagate);
      $paginador = $pager->paged();
      //}

      $data = array(
        'error' => false,
        'controller' => $this->_controller,
        'action' => $this->_action,

        'pageTotalRecords' => $pagerRecords,
        'pageCantidad' => $pagerQuantity,
        'pagePaginar' => $pagerPage,
        'pageLink' => $pagerLink,
        'pagePropagate' => $pagerPropagate,
        'paginador' => $paginador,

        'data' => $resultFilter
      );
      $retorno = json_encode($data);
    } else {
      $data = array(
        'error' => true,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $sin
      );
      $retorno = json_encode($data);
    }

    $tpl_main = $retorno;

    break;

  case 'duplicate':
    if (!empty($resultDuplicate)) {
      $data = array(
        'error' => false,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $resultDuplicate
      );
      $retorno = json_encode($data);
    } else {
      $data = array(
        'error' => true,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $sin
      );
      $retorno = json_encode($data);
    }

    $tpl_main = $retorno;
    break;

  case 'seeker':

    if (is_array($result)) {
      $data = array(
        'error' => false,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $result
      );
      $retorno = json_encode($data);
    } else {
      $data = array(
        'error' => true,
        'controller' => $this->_controller,
        'action' => $this->_action,
        'data' => $sin
      );
      $retorno = json_encode($data);
    }

    $tpl_main = $retorno;

    break;

  case 'listedAjax':
    if ($this->_table == "users_galleries") {
      $temp_table_name = 'galeria';
    } else {
      $temp_table_name = '';
    }
    $the_key = $this->_key;
    $the_status = $this->_status;
    $the_order = $this->_order;
    $array_leds_status = array('id_order_state', 'id_task_state', 'id_book_state', 'id_copayment_state', 'id_appointment_state');
    if (isset($resultSelect)) {

      $quantityRecords = count($resultSelect);
      $this->_model->setTable($this->_prefix . $this->_table);
      $this->_model->setFields($this->_fields);
      $pagerRecords = $this->_model->getTotalRecords();

      // var_dump($table_fields);

      $quantity_fields = count($this->_fields) - 1;
      $proccess_result_select = array();

      foreach ($resultSelect as $key => $value) {

        // print_r($resultSelect);

        $temp_array = array();
        $element_fiel = '';
        $element_id = '';
        $field_id_user = '';
        $field_id_user_value = '';

        foreach ($this->_fields as $k => $v) {

          if ($table_fields[$v]['field'] == 'id_user') {
            $field_id_user = $table_fields[$v]['field'];
            $field_id_user_value = $resultSelect[$key]->$v;
          }

          // print_r($table_fields[$v]['field']);
          // echo $table_fields[$v]['field'].' | '.$resultSelect[$key]->$v."\n";
          // print_r($table_fields[$v]);
          // echo $table_fields[$v]['key'] .  '||' . $table_fields[$v]['type_of'] .  '||' . $v . '|' . $resultSelect[$key]->$v . "\n";
          // Dejamos afuera si es multickeckbox
          if ($table_fields[$v]['type_of'] == 'file') {
            $temp_array[$v] = '';
            if (!empty($resultSelect[$key]->$v)) {
              if (file_exists($this->_files_path_physical . 'thumb/' . $resultSelect[$key]->$v) || file_exists($this->_files_path_physical . 'small/' . $resultSelect[$key]->$v) || file_exists($this->_files_path_physical . 'big/' . $resultSelect[$key]->$v) || file_exists($this->_files_path_physical . 'media/' . $resultSelect[$key]->$v)) {
                $temp_name = explode('.', $resultSelect[$key]->$v);

                if (file_exists($this->_files_path_physical . 'thumb/' . $resultSelect[$key]->$v)) {
                  $in_path = 'thumb/';
                } else if (file_exists($this->_files_path_physical . 'small/' . $resultSelect[$key]->$v)) {
                  $in_path = 'small/';
                } elseif (file_exists($this->_files_path_physical . 'big/' . $resultSelect[$key]->$v)) {
                  $in_path = 'big/';
                } elseif (file_exists($this->_files_path_physical . 'media/' . $resultSelect[$key]->$v)) {
                  $in_path = 'media/';
                }

                if (file_exists($this->_files_path_physical . 'big/' . $resultSelect[$key]->$v)) {
                  $in_path_big = 'big/';
                } else if (file_exists($this->_files_path_physical . 'media/' . $resultSelect[$key]->$v)) {
                  $in_path_big = 'media/';
                } elseif (file_exists($this->_files_path_physical . 'small/' . $resultSelect[$key]->$v)) {
                  $in_path_big = 'small/';
                } elseif (file_exists($this->_files_path_physical . 'thumb/' . $resultSelect[$key]->$v)) {
                  $in_path_big = 'thumb/';
                }

                $extencion = explode(".", $resultSelect[$key]->$v);
                $extArchivo = '.' . strtolower($extencion[1]);
                $extImages = array(".jpg", ".jpeg", ".gif", ".png", ".svg");

                if (in_array($extArchivo, $extImages) && $in_path == 'thumb/') {
                  $imagen_mostrar   = $this->_files_path_host . $in_path . $resultSelect[$key]->$v;
                  $imagen_mostrar_pop = $this->_files_path_host . $in_path_big . $resultSelect[$key]->$v;
                } else {
                  $imagen_mostrar   = CONFIG_HOST_NAME_BACKEND . FOLDER_THEME . TEMPLATE_SKIN_BACKEND . '/images/icon_folder/48x48/icon_folder_' . strtolower($extencion[1]) . '.gif';
                  $imagen_mostrar_pop  = $this->_files_path_host . $in_path_big . $resultSelect[$key]->$v;
                }

                // if(empty($imagen_mostrar_pop)){
                //   $temp_array['file'] = '<img src="'.$imagen_mostrar.'" border="0" style="border-color:#CCCCCC;">';
                // }else{
                //   if( in_array($extArchivo,$extImages) ){
                //     $temp_array['file'] = '<img src="'.$imagen_mostrar.'" border="0" style="border-color:#CCCCCC;">';
                //   }else{
                //     $temp_array['file'] = '<img src="'.$imagen_mostrar.'" border="0" style="border-color:#CCCCCC;">';
                //   }
                // }

                if (empty($imagen_mostrar_pop)) {
                  $temp_array[$v] = '<img src="' . $imagen_mostrar . '" border="0" style="border-color:#CCCCCC;">';
                } else {
                  if (in_array($extArchivo, $extImages)) {
                    $temp_array[$v] .= '<a ' . $temp_array[$v] . ' href="' . $imagen_mostrar_pop . '" rel="superbox[image]" class="pop_' . $table_fields[$v]['field'] . $temp_name[0] . '"><img src="' . $imagen_mostrar . '" border="0" style="border-color:#CCCCCC;"></a>';
                    $temp_array[$v] .= '<script>' . $this->_f->magnificPpoUp('pop_' . $table_fields[$v]['field'] . $temp_name[0] . '', 'image', '' . $imagen_mostrar_pop . '') . '</script>';
                  } else {
                    $temp_array[$v] .= '<a href="' . $imagen_mostrar_pop . '" rel="superbox[iframe][800x600]" class="pop_' . $table_fields[$v]['field'] . '" target="_blank"><img src="' . $imagen_mostrar . '" border="0" style="border-color:#CCCCCC;"></a>';
                  }
                }
              }
            } else {
              $temp_array[$v] = '';
            }
          } else if ($table_fields[$v]['type_of'] == 'checkbox') {
            $temp_array[$v] = $resultSelect[$key]->$v == 1 ? 'Si' : 'No';
          } else if ($table_fields[$v]['type_of'] == 'tinyint' || $table_fields[$v]['type_of'] == 'order') // Tratamos checkbox
          {
            if ($v != "status" && $v != "field_order") {
              $temp_array[$v] = $resultSelect[$key]->$v;
            }
          } else if ($table_fields[$v]['type_of'] == 'multicheckbox') {
            $temp_array[$v] = '';
          } else if ($table_fields[$v]['type_of'] == 'bigint') {
            $temp_array[$v] = $resultSelect[$key]->$v;
          } else if ($table_fields[$v]['type_of'] == 'varchar') {
            $temp_array[$v] = $resultSelect[$key]->$v;
          } else if ($table_fields[$v]['type_of'] == 'richcolor') {
            $temp_array[$v] = '<span style="color:' . $resultSelect[$key]->$v . ';">' . $resultSelect[$key]->$v . '</span>';
          } else if ($table_fields[$v]['type_of'] == 'email') {
            $temp_array[$v] = $resultSelect[$key]->$v;
          } else if ($table_fields[$v]['type_of'] == 'varcharlink') {
            $temp_array[$v] = $this->_f->getSubString($resultSelect[$key]->$v, 20, '...') . ' <a href="' . $resultSelect[$key]->$v . '" target="_blank" title="' . $resultSelect[$key]->$v . '"><i class="fa fa-external-link-square" aria-hidden="true"></i></a>';
          } else {
            // Preguntamos si es un KEY foraneo
            if (!empty($table_fields[$v]['key'])) {
              // Si esta vacio procesamos directamente
              if ($table_fields[$v]['key'] == 'PRI') {
                $element_id = $resultSelect[$key]->$v;
                $element_fiel = $v;
                $temp_array[$v] = !empty($resultSelect[$key]->$v) ? $resultSelect[$key]->$v : '';
              } else {
                // Es MUL traigo el valor de otra tabla
                # We ask if WHERE is already applied
                $aplica_were = substr_count($table_fields[$v]['query'], 'WHERE');

                if ($aplica_were >= 1) {
                  $field_primary_query = $this->_model->getInjection($table_fields[$v]['query'] . ' and ' . $v . '=' . $resultSelect[$key]->$v);
                } else {
                  if ($table_fields[$v]['type_of'] == 'selectparent') {
                    $_values = str_replace('parent_', '', $v);
                    $field_primary_query = $this->_model->getInjection($table_fields[$v]['query'] . ' WHERE ' . $_values . '=' . $resultSelect[$key]->$v);
                  } else {
                    $field_primary_query = $this->_model->getInjection($table_fields[$v]['query'] . ' WHERE ' . $v . '=' . $resultSelect[$key]->$v);
                  }
                }
                if (!empty($field_primary_query[0]->first_name)) {
                  $data_field = 'first_name';
                  $data_text = $field_primary_query[0]->first_name;
                } else if (!empty($field_primary_query[0]->name)) {
                  $data_field = 'name';
                  $data_text = $field_primary_query[0]->name;
                } else {
                  $data_field = '';
                  $data_text = '';
                }
                $foreing_model = trim(str_replace('SELECT * FROM ' . $this->_prefix, '', $table_fields[$v]['query']));
                // $temp_array[$v] = $data_text . ' <a href="index.php?controller='.$foreing_model.'&amp;action=edit&amp;'.$v.'=' . $resultSelect[$key]->$v . '&amp;" target="_blank" title="'. $data_text .'"><i class="fa fa-external-link-square" aria-hidden="true"></i></a>';
                // $temp_array[$v] = $data_text;
                $first_name = !empty($field_primary_query[0]->first_name) ? $field_primary_query[0]->first_name : '';
                $elString = !empty($field_primary_query[0]->name) ? $field_primary_query[0]->name : $first_name;
                /* ONIX CARDS */
                $elStringCaracteristic = !empty($field_primary_query[0]->characteristics) ? ' - ' . $field_primary_query[0]->characteristics : '';
                $elColorTexto = !empty($field_primary_query[0]->color_font) ? $field_primary_query[0]->color_font : '#000 !important';
                $elColorFondo = !empty($field_primary_query[0]->color) ? $field_primary_query[0]->color : '#fff !important';

                if (!empty($v)) {
                  if (in_array($v, $array_leds_status)) {
                    $temp_array[$v] = '<div class="strings rx' . $quantity_fields . ' hasbg" style="background-color:' . $elColorFondo . ';"><h2 style="color:' . $elColorTexto . ' !important;">' . $elString . '</h2></div>';
                  } else {
                    // $temp_array[$v] = '<div class="strings rx'.$quantity_fields.'"><h2><div class="datacel">'.$table_fields[$v]['alternatename'].':&nbsp;</div>' . $elString . $elStringCaracteristic .'</h2></div>';
                    $temp_array[$v] = '<div class="strings rx' . $quantity_fields . '"><h2>' . $elString . $elStringCaracteristic . '</h2></div>';
                  }
                }
              }
            } else {
              //  Procesamos si es KEY foraneo
              $temp_array[$v] = !empty($resultSelect[$key]->$v) ? $resultSelect[$key]->$v : '';
            }
          }
        }



        // Ver
        $temp_array['actions'] = '<a href="javascript:void(0);" onClick="$(\'.modal-body\').load($(this).attr(\'data-href\'),function(){ $(\'#myModal\').modal({show:true});});" data-href="' . CONFIG_HOST_NAME_FRONTEND . $temp_table_name . '-ver.php?' . $element_fiel . '=' . $element_id . '&amp;" class="btn btn-primary btn-xxs bot-modal fa fa-eye" title="Ver Detalle"></a>';
        // Usaurios Dashboard
        if ($this->_table == "users_availabilities" || $this->_table == "users_availabilities_modules" || $this->_table == "users") {
          if (!empty($field_id_user) && !empty($field_id_user_value)) {
            $temp_array['actions'] .= ' <a href="' . CONFIG_HOST_NAME_FRONTEND . 'profesionales-dashboard.php?' . $field_id_user . '=' . $field_id_user_value . '&amp;" class="btn btn-primary btn-xxs fa fa-th-large" title="Profesionales Dashboard "></a>';
          }
        }
        // Editar
        if ($this->_table != "patients_evolutions" && $this->_table != "copayments") {

          if ($this->_table == "appointments") {
            // print_r($table_fields['over_shift']['field']);
            // // print_r($table_fields[$v]);
            // print_r($resultSelect[$key]->over_shift);
            // echo "\n";
            // echo $table_fields[$v]['field'].' | '.$resultSelect[$key]->$v."\n";

            if (!empty($table_fields['over_shift']['field']) && !empty($resultSelect[$key]->over_shift)) {
              $temp_array['actions'] .= ' <a href="' . CONFIG_HOST_NAME_FRONTEND . 'sobreturnos-editar.php?' . $element_fiel . '=' . $element_id . '&amp;" class="btn btn-primary btn-xxs fa fa-pencil" title="Editar"></a>';
            } else {
              $temp_array['actions'] .= ' <a href="' . CONFIG_HOST_NAME_FRONTEND . $temp_table_name . '-editar.php?' . $element_fiel . '=' . $element_id . '&amp;" class="btn btn-primary btn-xxs fa fa-pencil" title="Editar"></a>';
            }
          } else {
            $temp_array['actions'] .= ' <a href="' . CONFIG_HOST_NAME_FRONTEND . $temp_table_name . '-editar.php?' . $element_fiel . '=' . $element_id . '&amp;" class="btn btn-primary btn-xxs fa fa-pencil" title="Editar"></a>';
          }
        }
        if (isset($value->$the_status)) {
          if ($value->$the_status == 1) {
            $temp_array['actions'] .= ' <a href="_ajax.php?action=' . $temp_table_name . 'State&amp;apply=0&amp;' . $element_fiel . '=' . $element_id . '&amp;token=' . $token . '&amp;" class="btn btn-primary btn-xxs  fa fa-check" title="Activo, click para desactivar"></a>';
          } else {
            $temp_array['actions'] .= ' <a href="_ajax.php?action=' . $temp_table_name . 'State&amp;apply=1&amp;' . $element_fiel . '=' . $element_id . '&amp;token=' . $token . '&amp;" class="btn btn-danger btn-xxs  fa fa-times" title="Desactivo, click para activar" style="width: 27px;"></a>';
          }
        }
        // Borrar
        if ($this->_table != "patients" && $this->_table != "copayments" && $this->_table != "users") {
          $temp_array['actions'] .= ' <a href="_ajax.php?action=' . $temp_table_name . 'Erase&amp;' .  $element_fiel . '=' . $element_id . '&amp;token=' . $token . '&amp;" onclick="return confirm(\'Are you sure you want to DELETE this records?\rCAUTION: This action can not be undone! \');" class="btn btn-danger btn-xxs fa fa-trash-o" title="Borrar"></a>';
        }
        // Listar Evoluciones
        if ($this->_table == "patients") {
          $temp_array['actions'] .= ' <a href="' . CONFIG_HOST_NAME_FRONTEND . 'evolucion-listado.php?' . $element_fiel . '=' . $element_id . '&amp;" class="btn btn-primary btn-xxs fa fa-id-card-o" title="Ver Evolución / Historia Cliníca "></a>';
          $temp_array['actions'] .= ' <a href="' . CONFIG_HOST_NAME_FRONTEND . 'historia-clinica-pdf.php?' . $element_fiel . '=' . $element_id . '&amp;" target="_blank" class="btn btn-primary btn-xxs fa fa-download" title="Descargar Historia Cliníca"></a>';
        }
        // Crear Turno
        if ($this->_table == "users") {
          $temp_array['actions'] .= ' <a href="turnos-crear.php?' . $element_fiel . '=' . $element_id . '&amp;" class="btn btn-primary btn-xxs fa fa-calendar" title="Crear Turno"></a>';
          $temp_array['actions'] .= ' <a href="sobreturnos-crear.php?' . $element_fiel . '=' . $element_id . '&amp;" class="btn btn-danger btn-xxs fa fa-calendar-plus-o" title="Crear Sobreturno"></a>';

          // $temp_array['actions'] .= ' <a href="profesionales-disponibilidad.php?'.$element_fiel.'='.$element_id.'&amp;" class="btn btn-primary btn-xxs fa fa-clock-o" title="Ver Disponibilidad"></a>';
        }
        $proccess_result_select[] = $temp_array;
      }

      $return = array(
        'draw' => $this->_pager_page,
        'pager_page' => $this->_pager_page,
        // 'buscando' => $_GET,
        'recordsTotal' => $pagerRecords,
        'recordsFiltered' => $pagerRecords,
        'data' => $proccess_result_select,
        // 'collector' => $collector,
      );

      $retorno = json_encode($return);
    } else {
      // print_r($table_fields['id_user_tracking']['type_of']);
      // print_r($this->_fields);
      $proccess_result_select = array();

      foreach ($table_fields as $k => $v) {
        if ($table_fields[$k]['type_of'] == 'file') // Tratamos FILES
        {
          $temp_array[$k] = '';
        } else if ($table_fields[$k]['type_of'] == 'checkbox') // Tratamos checkbox
        {
          $temp_array[$k] = '';
        } else if ($table_fields[$k]['type_of'] == 'multicheckbox') // Tratamos multicheckbox
        {
          $temp_array[$k] = '';
        } else {
          if (!empty($table_fields[$k]['key'])) // Preguntamos si es un KEY foraneo
          {
            if ($table_fields[$k]['key'] == 'PRI' && strtolower($k) == $the_order) {
              $temp_array[$k] = 'Está buscando letras en un campo numérico?';
            } else {
              $temp_array[$k] = '';
            }
          } else {
            if (strtolower($k) == $the_order) {
              $temp_array[$k] = 'Sin Resultados';
            } else {
              $temp_array[$k] = '';
            }
          }
        }
      }
      $proccess_result_select[] = $temp_array;

      $return = array(
        'draw' => $this->_pager_page,
        'pager_page' => $this->_pager_page,
        'recordsTotal' => 0,
        'recordsFiltered' => 0,
        'data' => $proccess_result_select,
      );

      $retorno = json_encode($return);
    }

    $tpl_main = $retorno;
    break;

  default:

    $data = array(
      'error' => true,
      'controller' => $this->_controller,
      'action' => $this->_action,
      'data' => $sin
    );
    $retorno = json_encode($data);

    $tpl_main = $retorno;

    break;
}

header("Access-Control-Allow-Origin: *");
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json; charset=utf-8');

echo $tpl_main;
