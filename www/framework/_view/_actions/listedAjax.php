<?php
/* View: listAjax
 * Action: List the records
 * Return: HTML return
 * Comment: Retrieve the result of query, The name of the variable return is $resultSelect
 */
if (isset($resultSelect)) {

  $quantityRecords = count($resultSelect);
  $this->_model->setTable($this->_prefix . $this->_table);
  $this->_model->setFields($this->_fields);
  $pagerRecords = $this->_model->getTotalRecords();

  $quantity_fields = count($this->_fields) - 1;
  $proccess_result_select = array();

  foreach ($resultSelect as $key => $value) {
    $temp_array = array();
    $element_fiel = '';
    $element_id = '';

    foreach ($this->_fields as $k => $v) {
      # Order
      if ($table_fields[$v]['type_of'] == 'order') {
        $tiene_orden = true;
      }
      if (in_array($v, $this->_fields_relation) && !empty($table_fields[$v]['query'])) {
        # We ask if WHERE is already applied
        $aplica_were = substr_count($table_fields[$v]['query'], 'WHERE');

        if ($aplica_were >= 1) {
          $field_primary_query = $this->_model->getInjection($table_fields[$v]['query'] . ' and ' . $v . '=' . $resultSelect[$key]->$v);
        } else {
          if ($table_fields[$v]['type_of'] == 'selectparent') {
            $vs = str_replace('parent_', '', $v);
            // echo $table_fields[$v]['query'].' WHERE ' . $vs . '=' . $resultSelect[$key]->$v.'<br>';
            $field_primary_query = $this->_model->getInjection($table_fields[$v]['query'] . ' WHERE ' . $vs . '=' . $resultSelect[$key]->$v);
          } elseif ($table_fields[$v]['type_of'] == 'selectequal') {
            $vs = str_replace('equal1_', '', $v);
            $vs = str_replace('equal2_', '', $vs);
            $vs = str_replace('equal3_', '', $vs);
            // echo $table_fields[$v]['query'].' WHERE ' . $vs . '=' . $resultSelect[$key]->$v.'<br>';
            $field_primary_query = $this->_model->getInjection($table_fields[$v]['query'] . ' WHERE ' . $vs . '=' . $resultSelect[$key]->$v);
          } else {
            $field_primary_query = $this->_model->getInjection($table_fields[$v]['query'] . ' WHERE ' . $v . '=' . $resultSelect[$key]->$v);
          }
        }
        // echo $v;
        // print_r($table_fields[$v]['query'].' WHERE ' . $v . '=' . $resultSelect[$key]->$v);
        // print_r($field_primary_query[0]);

        $first_name = !empty($field_primary_query[0]->first_name) ? $field_primary_query[0]->first_name : '';
        $user_name = !empty($field_primary_query[0]->user_name) ? $field_primary_query[0]->user_name : $first_name;
        $elString = !empty($field_primary_query[0]->name) ? $field_primary_query[0]->name : $user_name;
        if (empty($elString)) {
          $elString = !empty($field_primary_query[0]->name_patient) ? $field_primary_query[0]->name_patient : '';
        }
        /* ONIX CARDS */
        $elStringCaracteristic = !empty($field_primary_query[0]->characteristics) ? ' - ' . $field_primary_query[0]->characteristics : '';
        $elColorTexto = !empty($field_primary_query[0]->color_font) ? $field_primary_query[0]->color_font : '#000 !important';
        $elColorFondo = !empty($field_primary_query[0]->color) ? $field_primary_query[0]->color : '#fff !important';

        # For Listings that need to mark with color the cell taking the last color from another table
        // print_r($array_leds_status);
        // echo $v."\r";
        // echo "=============="."\r";
        //   print_r($temp_array);
        //   echo $v."\r";
        //   print_r($temp_array[$v])."\r";
        // echo "=============="."\r";
        if (!empty($v)) {
          if (in_array($v, $array_leds_status)) {
            $temp_array[$v] = '<div class="strings rx' . $quantity_fields . ' hasbg" style="background-color:' . $elColorFondo . ';"><h2 style="color:' . $elColorTexto . ' !important;">' . $elString . '</h2></div>';
          } else {
            // $temp_array[$v] = '<div class="strings rx'.$quantity_fields.' f"><h2><div class="datacel">'.$table_fields[$v]['alternatename'].':&nbsp;</div>' . $elString . $elStringCaracteristic .'</h2></div>';
            $temp_array[$v] = '<div class="strings rx' . $quantity_fields . ' f"><h2>' . $resultSelect[$key]->$v . ' - ' . $elString . $elStringCaracteristic . '</h2></div>';
          }
        }
      } else {
        // Dejamos afuera si es multickeckbox
        if ($table_fields[$v]['type_of'] == 'file') // Tratamos FILES
        {
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

              if (file_exists($this->_files_path_physical . 'media/' . $resultSelect[$key]->$v)) {
                $in_path_big = 'media/';
              } else if (file_exists($this->_files_path_physical . 'big/' . $resultSelect[$key]->$v)) {
                $in_path_big = 'big/';
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
        } else if ($table_fields[$v]['type_of'] == 'checkbox') // Tratamos checkbox
        {
          $temp_array[$v] = $resultSelect[$key]->$v == 1 ? 'Si' : 'No';
        } else if ($table_fields[$v]['type_of'] == 'tinyint' || $table_fields[$v]['type_of'] == 'order') // Tratamos checkbox
        {
          if ($v != "status" && $v != "field_order") {
            $temp_array[$v] = $resultSelect[$key]->$v;
          }
        } else if ($table_fields[$v]['type_of'] == 'multicheckbox') // Tratamos multicheckbox
        {
          $temp_array[$v] = '';
        } else if ($table_fields[$v]['type_of'] == 'varcharlink') // Tratamos multicheckbox
        {
          $temp_array[$v] = $this->_f->getSubString($resultSelect[$key]->$v, 20, '...') . ' <a href="' . $resultSelect[$key]->$v . '" target="_blank" title="' . $resultSelect[$key]->$v . '"><i class="fa fa-external-link-square" aria-hidden="true"></i></a>';
        } else if ($table_fields[$v]['type_of'] == 'bigint') {
          $temp_array[$v] = $resultSelect[$key]->$v;
        } else if ($table_fields[$v]['type_of'] == 'varchar') {
          $temp_array[$v] = $resultSelect[$key]->$v;
        } else if ($table_fields[$v]['type_of'] == 'richcolor') {
          $temp_array[$v] = '
          <div class="strings rx6 hasbg" style="background-color:' . $resultSelect[$key]->$v . ';"><h2 style="color:#000000 !important;">' . $resultSelect[$key]->$v . '</h2></div>';
        } else {
          // Preguntamos si es un KEY foraneo
          if (!empty($table_fields[$v]['key'])) {
            // Si esta vacio procesamos directamente
            if ($table_fields[$v]['key'] == 'PRI') {
              $element_id = $resultSelect[$key]->$v;
              $element_fiel = $v;
              $temp_array[$v] = !empty($resultSelect[$key]->$v) ? $resultSelect[$key]->$v : '';
            } else if ($table_fields[$v]['key'] == 'UNI') {
              $temp_array[$v] = $resultSelect[$key]->$v;
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
              } else if (!empty($field_primary_query[0]->name_patient)) {
                $data_field = 'name_patient';
                $data_text = $field_primary_query[0]->name_patient;
              } else if (!empty($field_primary_query[0]->user_name)) {
                $data_field = 'user_name';
                $data_text = $field_primary_query[0]->user_name;
              } else {
                $data_field = '';
                $data_text = '';
              }
              $foreing_model = trim(str_replace('SELECT * FROM ' . $this->_prefix, '', $table_fields[$v]['query']));
              if ($table_fields[$v]['type_of'] == 'email') {
                $temp_array[$v] = $this->_f->formatEmail($resultSelect[$key]->$v) . '</a>';
              } else if ($table_fields[$v]['type_of'] == 'varcharlink') {
                $temp_array[$v] = $data_text . ' <a href="index.php?controller=' . $foreing_model . '&amp;action=edit&amp;' . $v . '=' . $resultSelect[$key]->$v . '&amp;" target="_blank" title="' . $data_text . '"><i class="fa fa-external-link-square" aria-hidden="true"></i></a>';
              }
            }
          } else {
            //  Procesamos si es KEY foraneo
            $temp_array[$v] = !empty($resultSelect[$key]->$v) ? $resultSelect[$key]->$v : '';
          }
        }
      }
    }
    $temp_array['actions'] = '
    <a href="javascript:void(0);" onClick="$(\'.modal-body\').load($(this).attr(\'data-href\'),function(){ $(\'#myModal\').modal({show:true});});" data-href="index.php?controller=' . $this->_table . '&amp;action=preview&amp;' . $element_fiel . '=' . $element_id . '&amp;" class="bot_action bot-modal btn-primary fa fa-eye"></a>
    <a href="index.php?controller=' . $this->_table . '&amp;action=edit&amp;' . $element_fiel . '=' . $element_id . '&amp;" class="bot_action btn-primary fa fa-pencil" title="Edit Element"></a>
    ';

    if (isset($value->$the_status)) {
      if ($value->$the_status == 1) {
        $temp_array['actions'] .= ' <a href="index.php?controller=' . $this->_table . '&amp;action=activate&amp;' . $element_fiel . '=' . $element_id . '&amp;" class="bot_action btn-primary fa fa-check" title="Active, click to deactivate"></a>';
      } else {
        $temp_array['actions'] .= ' <a href="index.php?controller=' . $this->_table . '&amp;action=activate&amp;' . $element_fiel . '=' . $element_id . '&amp;" class="bot_action btn-danger fa fa-times" title="Deactivated, click to activate" style="padding: 5px 7px;"></a>';
      }
    }
    $temp_array['actions'] .= ' <a href="index.php?controller=' . $this->_table . '&amp;action=delete&amp;' . $element_fiel . '=' . $element_id . '&amp;" onclick="return confirm(\'Are you sure you want to DELETE this records?\rCAUTION: This action can not be undone! \');" class="bot_action btn-danger fa fa-trash-o" title="Delete"></a>';
    $temp_array['actions'] .= ' <a href="index.php?controller=' . $this->_table . '&amp;action=duplicate&amp;' . $element_fiel . '=' . $element_id . '&amp;" onclick="return confirm(\'Are you sure you want to CLONE this records?\rCAUTION: This action can not be undone! \');" class="bot_action btn-primary fa fa-files-o" title="Clone"></a>';
    if ($this->_table == 'imports') {
      $temp_array['actions'] .= ' <a href="index.php?controller=' . $this->_table . '&amp;action=runImport&amp;' . $element_fiel . '=' . $element_id . '&amp;" onclick="return confirm(\'Are you sure you want to IMPORT all records?\rCAUTION: This action can not be undone! \');" class="bot_action btn-danger fa fa-upload" title="Run Import"></a>';
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

  header("Access-Control-Allow-Origin: *");
  header('Cache-Control: no-cache, must-revalidate');
  header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
  header('Content-type: application/json; charset=utf-8');
  echo json_encode($return);
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

  header("Access-Control-Allow-Origin: *");
  header('Cache-Control: no-cache, must-revalidate');
  header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
  header('Content-type: application/json; charset=utf-8');
  echo json_encode($return);
}
