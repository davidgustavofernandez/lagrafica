<?php
$data_admin = $this->_data_admin;
$data_admin_permissions = $this->_data_admin_permissions;

# Main menu {
$html_menu 	 = '';
if($this->_controller != 'login'){
  # Framework logo
  $html_menu .= '<li CLASS="nav-header">'."\r";
  $html_menu .= '  <div CLASS="dropdown profile-element">'."\r";
  $html_menu .= '      <span><a href="index.php"><img SRC="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/logo.png" ALT="' . CONFIG_NAME_SITE . '" border="0" /></a></span>'."\r";
  $html_menu .= '  </div>'."\r";
  $html_menu .= '  <div CLASS="logo-element">'."\r";
  $html_menu .= '      <a href="index.php"><img SRC="'.CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/logo_min.png" ALT="' . CONFIG_NAME_SITE . '" border="0" /></a>'."\r";
  $html_menu .= '  </div>'."\r";
  $html_menu .= '</li>'."\r";

  # MENU
  $path_menu = dirname(__FILE__) . '/menu.inc';
  if(function_exists('file_get_contents') && file_exists($path_menu)) {
    $menuarray = unserialize(file_get_contents($path_menu));
  }else{
    $menuarray = array();
  }
  


//   foreach($menu_array as $keys => $values){
//     if(in_array($keys,$data_admin_permissions)){
//       echo $keys . '|' . $values['alias'] . "\n";
//       if(!empty($values['sons'])){
//         foreach ($values['sons'] as $key => $value) {
//           echo '-' . $key . '|' . $value['alias'] . "\n";
//           if(!empty($value['sons'])){
//             foreach ($value['sons'] as $k => $v) {
//               echo '--' . $k . '|' . $v['alias'] . "\n";
//             }
//           }
//         }
//       }
//     }
//   }
//   echo "\n\n";
// print_r($menu_array);
// exit();

  $menu_array = array();
  $menu_array_dependencies = array();

  // foreach($this->_estructuraBbdd as $bbdd_key=> $bbdd_value){
  //   foreach($bbdd_value as $bbdd_tables_key=> $bbdd_tables_value){
  //     $bt_key = $bbdd_tables_key;
  //     $bt_key_alias = $this->_estructuraBbdd[$bbdd_key][$bbdd_tables_key]['GLOBAL_table_alias'];
  //     $bt_father_son = $this->_estructuraBbdd[$bbdd_key][$bbdd_tables_key]['GLOBAL_father_son'];
  //     // echo $bt_key;

  //     // if($bt_key_list=='true'){
  //       if(in_array(str_replace(CONFIG_DB_PREFIX,'',$bt_key),$data_admin_permissions)){
  //         $dependence_value = explode('_',str_replace(CONFIG_DB_PREFIX,'',$bt_key));
  //         array_push($menu_array,str_replace(CONFIG_DB_PREFIX,'',$bt_key));

  //         if(!empty($dependence_value[1])){
  //           if (array_key_exists($dependence_value[0], $menu_array_dependencies)) {
  //             array_push($menu_array_dependencies[$dependence_value[0]],str_replace(CONFIG_DB_PREFIX,'',$bt_key));
  //           }else{
  //             $menu_array_dependencies[$dependence_value[0]] = array();
  //             array_push($menu_array_dependencies[$dependence_value[0]],str_replace(CONFIG_DB_PREFIX,'',$bt_key));
  //           }
  //         }else{
  //           $menu_array_dependencies[str_replace(CONFIG_DB_PREFIX,'',$bt_key)]  = array();
  //         }
  //       }
  //     // }
  //   }
  // }


  // // print_r($this->_estructuraBbdd);

  // $caramba = array();
  // foreach($this->_estructuraBbdd as $bbdd_key=> $bbdd_value){
  //   $position = 0;
  //   foreach($bbdd_value as $bbdd_tables_key=> $bbdd_tables_value){
      
  //     $bt_key = str_replace(CONFIG_DB_PREFIX,'',$bbdd_tables_key);
  //     $bt_key_alias = $this->_estructuraBbdd[$bbdd_key][$bbdd_tables_key]['GLOBAL_table_alias'];
  //     $bt_key_alias = $this->_estructuraBbdd[$bbdd_key][$bbdd_tables_key]['GLOBAL_table_alias'];
  //     $bt_father_son = $this->_estructuraBbdd[$bbdd_key][$bbdd_tables_key]['GLOBAL_father_son'];
      
  //     $loaction_in_family_tree = explode(':',$bt_father_son);
      
  //     $temp_array = array('table' => $bt_key, 'alias' => $bt_key_alias );
  //     // print_r($temp_array);
  //     if($loaction_in_family_tree[0]=='father')
  //     {
  //       $caramba[$bt_key] = array('table' => $bt_key, 'alias' => $bt_key_alias );
  //     }
  //     elseif ($loaction_in_family_tree[0]=='son_of' && !empty($loaction_in_family_tree[1]) && empty($loaction_in_family_tree[2]) )
  //     {
  //       $caramba[$loaction_in_family_tree[1]]['sons'][$bt_key] = array('table' => $bt_key, 'alias' => $bt_key_alias );
  //     }
  //     elseif (!empty($loaction_in_family_tree[2]) )
  //     {
  //       $caramba[$loaction_in_family_tree[1]]['sons'][$loaction_in_family_tree[1].'_'.$loaction_in_family_tree[2]]['sons'][$bt_key] = array('table' => $bt_key, 'alias' => $bt_key_alias );
  //     }
  //     $position = $position + 1;
  //   }
  // }

  // print_r($caramba);

  # Sections
  if($this->_controller=='start' && $this->_action=='index'){
    $html_menu .= '<li class="active">'."\r";
  }else{
    $html_menu .= '<li>'."\r";
  }
  $html_menu .= '<a HREF="index.php">'.$this->_m->getMessageEntites('view_left_nav','dashboard').'</a></li>'."\r";

  if(!empty($menuarray)){

    $return_html_open = '';
    $return_html_middle = '';
    $return_html_close = '';

    // foreach($menu_array_dependencies as $menu_array_dependencies_key=> $menu_array_dependencies_value){
    //   if(is_array($menu_array_dependencies_value) && !empty($menu_array_dependencies_value[0])){
    //     $active_section = $this->_action==$menu_array_dependencies_key ? 'in' : '';
    //     if($return_html_open==false){
    //       $return_html_open .= '<ul CLASS="nav '.$active_section.'">'."\r";
    //     }
    //     if(($this->_controller==$menu_array_dependencies_key) || in_array($this->_controller,$menu_array_dependencies_value)){
    //       $return_html_middle .= '   <li class="active">';
    //     }else{
    //       $return_html_middle .= '   <li>';
    //     }
    //     $return_html_middle .= '       <a HREF="#"><i class="fa fa-circle-o"></i><span class="nav-label">' . ucfirst($menu_array_dependencies_key) . '</span><span class="fa arrow"></span></a>'."\r";
    //     $return_html_middle .= '       <ul CLASS="nav nav-second-level collapse">'."\r";
    //     if($this->_controller==$menu_array_dependencies_key){
    //       $return_html_middle .= '           <li class="active">';
    //     }else{
    //       $return_html_middle .= '       <li>';
    //     }
    //     $return_html_middle .= '           <a HREF="index.php?controller='.$menu_array_dependencies_key.'&amp;action=listed"><i class="fa fa-circle-o"></i> ' . ucfirst($menu_array_dependencies_key) . '</a>'."\r";

    //     foreach($menu_array_dependencies_value as $matriz_value){
    //       if($this->_controller==$matriz_value){
    //         $return_html_middle .= '       <li class="active">';
    //       }else{
    //         $return_html_middle .= '       <li>';
    //       }
    //       $return_html_middle .= '           <a HREF="index.php?controller='.$matriz_value.'&amp;action=listed"><i class="fa fa-circle-o"></i> ' . ucfirst(str_replace('_',' ',str_replace($menu_array_dependencies_key.'_','',$matriz_value))) . '</a></li>'."\r";
    //     }
    //     $return_html_middle .= '       </ul>'."\r";
    //     $return_html_middle .= '   </li>'."\r";
    //   }else{
    //     if(($this->_controller==$menu_array_dependencies_key) || in_array($this->_controller,$menu_array_dependencies_value)){
    //       $return_html_middle .= '   <li class="active">';
    //     }else{
    //       $return_html_middle .= '   <li class="NO">';
    //     }
    //     $return_html_middle .= '       <a HREF="index.php?controller='.$menu_array_dependencies_key.'&amp;action=listed"><i class="fa fa-circle-o"></i><span class="nav-label">' . ucfirst($menu_array_dependencies_key) . '</span></a></li>'."\r";
    //   }
    // }

    foreach($menuarray as $keys => $values){
      if(in_array($keys,$data_admin_permissions))
      {
        $active_section = $this->_controller==$keys ? 'in' : '';
        if($return_html_open==false){
          $return_html_open .= '<ul CLASS="nav '.$active_section.'">'."\r";
        }
        if(!empty($values['sons'])){
          $temp_arr = array();
          foreach ($values['sons'] as $kk => $vv) {
            $temp_arr[] = $kk;
          }
          if( $this->_controller==$keys  || in_array($this->_controller,$temp_arr)){
            $return_html_middle .= '  <li class="active">';
          }else{
            $return_html_middle .= '  <li>';
          }
        }
        else
        {
          if( $this->_controller==$keys ){
            $return_html_middle .= '  <li class="active">';
          }else{
            $return_html_middle .= '  <li>';
          }
        }
        $return_html_middle .= '     <a HREF="#" title="' . $values['alias'] . '"><i class="fa fa-circle-o"></i><span class="nav-label">' . $values['alias'] . '</span><span class="fa arrow"></span></a>'."\r";
        $return_html_middle .= '     <ul CLASS="nav nav-second-level collapse">'."\r";
        if($this->_controller==$keys){
          $return_html_middle .= '        <li class="active" >';
        }else{
          $return_html_middle .= '        <li>';
        }
        $return_html_middle .= '              <a HREF="index.php?controller='.$keys.'&amp;action=listed"><i class="fa fa-list" aria-hidden="true"></i> Listado</a>'."\r";

        // echo $keys . '|' . $values['alias'] . "\n";
        if(!empty($values['sons']))
        {
          foreach ($values['sons'] as $key => $value) {
            if(in_array($key,$data_admin_permissions))
            {
              // echo '-' . $key . '|' . $value['alias'] . "\n";
              if($this->_controller==$key){
                $return_html_middle .= '        <li class="active">';
              }else{
                $return_html_middle .= '        <li>';
              }
              
              if(!empty($value['sons']))
              {
                $return_html_middle .= '     <a HREF="#" title="' . $value['alias'] . '"><i class="fa fa-circle-o"></i><span class="nav-label">' . $value['alias'] . '</span><span class="fa arrow"></span></a>'."\r";
                $return_html_middle .= '     <ul CLASS="nav nav-third-level collapse">'."\r";
                if($this->_controller==$keys){
                  $return_html_middle .= '        <li class="active" >';
                }else{
                  $return_html_middle .= '        <li>';
                }
                $return_html_middle .= '              <a HREF="index.php?controller='.$key.'&amp;action=listed"><i class="fa fa-list" aria-hidden="true"></i> Listado</a></li>'."\r";
                
                foreach ($value['sons'] as $k => $v) {
                  if(in_array($k,$data_admin_permissions))
                  {
                    // echo '--' . $k . '|' . $v['alias'] . "\n";
                    if($this->_controller==$k){
                      $return_html_middle .= '        <li class="active">';
                    }else{
                      $return_html_middle .= '        <li>';
                    }
                    $return_html_middle .= '            <a HREF="index.php?controller='.$k.'&amp;action=listed"><i class="fa fa-circle-o"></i> ' . $v['alias'] . '</a></li>'."\r";
                    $return_html_middle .= '          </li>'."\r";
                  }
                }
                $return_html_middle .= '          </li>'."\r";
                $return_html_middle .= '    </ul>'."\r";

              }
              else
              {
                $return_html_middle .= '              <a HREF="index.php?controller='.$key.'&amp;action=listed"><i class="fa fa-circle-o"></i> ' . $value['alias'] . '</a></li>'."\r";
              }
              $return_html_middle .= '          </li>'."\r";
            }
          }
        }
        
        
        $return_html_middle .= '          </li>'."\r";
        $return_html_middle .= '    </ul>'."\r";
        $return_html_middle .= '  </li>'."\r";
      }
    }
    $return_html_close 	 .= '</ul>'."\r";
    $html_menu .= $return_html_open.$return_html_middle.$return_html_close;
  }
}else{
  $html_menu .= ''."\r";
}

# User profile & Framework data {
if(!empty($data_admin['name'])){
  $admin_id = !empty($data_admin['id_administrator']) ? $data_admin['id_administrator'] : '';
  $admin_name = !empty($data_admin['name']) ? $data_admin['name'] : '';
  $admin_lastname = !empty($data_admin['last_name']) ? $data_admin['last_name'] : '';
  $admin_email = !empty($data_admin['email']) ? $data_admin['email'] : '';
  //$admin_rol = !empty($data_admin['id_administrator_rol']) ? $data_admin['id_administrator_rol'] : '';
  $admin_file = !empty($data_admin['file']) ? $data_admin['file'] : '';
  $admin_file_url = !empty($data_admin['file']) ? '../material/administrators/thumb/' . $admin_file : FOLDER_THEME.'skin/' . TEMPLATE_SKIN_BACKEND . '/images/Usuario.jpg';
  $admin_moderator = !empty($data_admin['moderator']) ? $data_admin['moderator'] : '';
  $admin_api_token = !empty($data_admin['api_token']) ? $data_admin['api_token'] : '';
  $admin_access_api = !empty($data_admin['access_api']) ? $data_admin['access_api'] : '';
  $cache_expire = session_cache_expire();

  # Welcome message
  if($this->_controller=='start'){
    if($this->_action=='index'){
      $admin_wellcome = $this->_m->getMessageEntites('global','wellcome').' <span class="text-navy">' . $admin_name . '</span>';
    }else{
      $admin_wellcome = '' .ucfirst(str_replace('_',' ',mb_strtolower($table_name,'UTF-8'))) . '';
    }
  }else{
    $admin_wellcome = '' .ucfirst(str_replace('_',' ',mb_strtolower($table_name,'UTF-8'))) . '';
  }

  $admin_name_lastname =  $admin_name . ' <strong>'. $admin_lastname.'</strong>';

  $html_profile = '';
  $html_profile .= '<li>'."\r";
  $html_profile .= ' <span CLASS="m-r-sm text-muted welcome-message">'.$admin_name . ' <strong>'. $admin_lastname.'</strong>'.'</span>'."\r";
  $html_profile .= '</li>'."\r";
  $html_profile .= '<!-- dropdown-user { -->'."\r";
  $html_profile .= '<li class="dropdown">'."\r";
  $html_profile .= '     <a class="dropdown-toggle user-data" data-toggle="dropdown" href="#">'."\r";
  $html_profile .= '         <img SRC="' . $admin_file_url . '" CLASS="img-circle" ALT="' . $admin_name.'" width="40" />'."\r";
  $html_profile .= '         <i class="fa fa-caret-down"></i>'."\r";
  $html_profile .= '     </a>'."\r";
  $html_profile .= '     <ul class="dropdown-menu dropdown-user">'."\r";
  $html_profile .= '         <li>'."\r";
  $html_profile .= '             <a href="index.php?controller=administrators&amp;action=edit&amp;id_administrator='.$admin_id.'">'.$this->_m->getMessageEntites('view_profile_nav','profile').'</a>'."\r";
  $html_profile .= '             <li class="divider"></li>'."\r";

  if($this->_controller != 'login'){
    if($this->_data_admin['moderator']==1 ){
      $html_profile .= '     <li>'."\r";
      $html_profile .= '         <a href="'.CONFIG_HOST_NAME_BACKEND.'_lib/trigger/trigger_sql.xml"><i class="fa fa-gear fa-fw"></i> trigger</a>'."\r";
      $html_profile .= '     </li>'."\r";
      $html_profile .= '     <li>'."\r";
      $html_profile .= '         <a href="_lib/ztester/" target="_blank"><i class="fa fa-gear fa-fw"></i> ztester</a>'."\r";
      $html_profile .= '     </li>'."\r";
      $html_profile .= '     <li>'."\r";
      $html_profile .= '         <a href="index.php?controller=start&action=errorsList&" target="_blank"><i class="fa fa-gear fa-fw"></i> Errors Logs</a>'."\r";
      $html_profile .= '     </li>'."\r";
      $html_profile .= '     <li>'."\r";
      $html_profile .= '         <a href="index.php?controller=start&action=eventsList&" target="_blank"><i class="fa fa-gear fa-fw"></i> Events Logs</a>'."\r";
      $html_profile .= '     </li>'."\r";
      $html_profile .= '     <li>'."\r";
      $html_profile .= '         <a href="index.php?controller=start&amp;action=seccionesfull">'.$this->_m->getMessageEntites('view_profile_nav','full_sections').'</a>'."\r";
      $html_profile .= '     </li>'."\r";
      $html_profile .= '     <li>'."\r";
      $html_profile .= '         <a href="index.php?controller=settings&amp;action=reloadDatabase">'.$this->_m->getMessageEntites('view_profile_nav','reload_database').'</a>'."\r";
      $html_profile .= '     </li>'."\r";
      $html_profile .= '     <li>'."\r";
      $html_profile .= '         <a href="index.php?controller=settings&amp;action=dataSettings">'.$this->_m->getMessageEntites('view_profile_nav','data_settings').'</a>'."\r";
      $html_profile .= '     </li>'."\r";

      $html_profile .= '     <li class="divider"></li>'."\r";
      $html_profile .= '     <li>'."\r";
      $html_profile .= '         <div class="area">'.$this->_m->getMessageEntites('view_profile_nav','initial_memory').' <span class="pull-right text-muted small">' . $this->_f->convertSize(CONFIG_MEMO_INI) . '</span></div>'."\r";
      $html_profile .= '     </li>'."\r";
      $html_profile .= '     <li>'."\r";
      $html_profile .= '         <div class="area">'.$this->_m->getMessageEntites('view_profile_nav','used_memory').' <span class="pull-right text-muted small">' . $this->_f->convertSize(memory_get_usage(true)) . '</span></div>'."\r";
      $html_profile .= '     </li>'."\r";
      $html_profile .= '     <li>'."\r";
      $html_profile .= '         <div class="area">'.$this->_m->getMessageEntites('view_profile_nav','processed_in').' <span class="pull-right text-muted small">' . round(($this->_f->convertMicrotime(microtime()) - $this->_f->convertMicrotime(CONFIG_TIME_INI)),2) . ' segs.</span></div>'."\r";
      $html_profile .= '     </li>'."\r";
      $html_profile .= '     <li>'."\r";
      $html_profile .= '         <div class="area">'.$this->_m->getMessageEntites('view_profile_nav','cache_expire').' <span class="pull-right text-muted small">'. $cache_expire . ' Min.</span></div>'."\r";
      $html_profile .= '     </li>'."\r";
      $html_profile .= '     <li class="divider"></li>'."\r";
    }
  }
  $html_profile .= '     <li>'."\r";
  $html_profile .= '         <a href="index.php?controller=login&amp;action=distroy"><i class="fa fa-sign-out fa-fw"></i> Logout</a>'."\r";
  $html_profile .= '     </li>'."\r";

  $html_profile .= ' </ul>'."\r";
  $html_profile .= '</li>'."\r";
  $html_profile .= '<!-- } dropdown-user -->'."\r";
}else{
  $admin_id = '';
  $admin_name = '';
  $admin_lastname = '';
  $admin_rol = '';
  $admin_file = '';
  $admin_moderator = '';
  $admin_wellcome = '';
  $html_profile = '';
  $framework_logo = '';
}
/* } User profile & framework data */

# Menu Acciones  ---------------------------------------------------------------------------------------------
$html_header = '';

if($this->_controller!='start'){
  if( $this->_controller!='stats' ){
    $html_header .= '<ul>';
    $html_header .= '<li><a class="btn btn-primary btn-sm" href="index.php?controller=' . $this->_controller . '&amp;action=index">'.$this->_m->getMessageEntites('view_navigator','dashboard').'</a></li>';
    $html_header .= '<li><a class="btn btn-primary btn-sm" href="index.php?controller=' . $this->_controller . '&amp;action=listed">'.$this->_m->getMessageEntites('view_navigator','listed').'</a></li>';
    $html_header .= '<li><a class="btn btn-primary btn-sm" href="index.php?controller=' . $this->_controller . '&amp;action=create&amp;pager_page='.$this->_pager_page.'&amp;">'.$this->_m->getMessageEntites('view_navigator','create').'</li>';
    $html_header .= '<li><a class="btn btn-primary btn-sm" href="index.php?controller=' . $this->_controller . '&amp;action=search">'.$this->_m->getMessageEntites('view_navigator','search').'</a></li>';

    //if( ($this->_controller=='users' || $this->_controller=='productos') || $this->_controller=='users_trackings' || $this->_controller=='copys'){
      $html_header .= '<li><a class="btn btn-danger btn-sm" href="index.php?controller=' . $this->_controller . '&amp;action=export">'.$this->_m->getMessageEntites('view_navigator','download').'</a></li>';
    //}
    if( $this->_controller=='maps' ){
      $html_header .= '<li><a class="btn btn-danger btn-sm" href="index.php?controller=' . $this->_controller . '&amp;action=importUpload">'.$this->_m->getMessageEntites('view_navigator','import').'</a></li>';
    }
    // if( $this->_controller=='cards' ){
    //   $html_header .= '<li><a class="btn btn-warning btn-sm" href="index.php?controller=' . $this->_controller . '&amp;action=makeCardsJson">'.$this->_m->getMessageEntites('view_navigator','create_json').'</a></li>';
    // }
    // $html_header .= '<li><a class="btn btn-info btn-sm" href="index.php?controller=' . $this->_controller . '&amp;action=exportBatchList">'.$this->_m->getMessageEntites('view_navigator','repository').'</a></li>';
    // $html_header .= '<li><a class="btn btn-danger btn-sm" href="index.php?controller=' . $this->_controller . '&amp;action=exportBatch">'.$this->_m->getMessageEntites('view_navigator','batch').'</a></li>';
    
    $html_header .= '<li>';
    $html_header .= '<div class="ibox-tools">';
    $html_header .= '    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">';
    $html_header .= '        <i class="fa fa-wrench"></i>';
    $html_header .= '    </a>';
    $html_header .= '    <ul id="nestable-menu" class="dropdown-menu dropdown-user" x-placement="bottom-start" style="padding: 0 0 7px 0;">';
    
    $html_header .= '        <li id="expand-all"><a class="dropdown-item" href="index.php?controller=' . $this->_controller . '&amp;action=exportBatch">'.$this->_m->getMessageEntites('view_navigator','batch').'</a></li>';
    $html_header .= '        <li id="collapse-all"><a class="dropdown-item" href="index.php?controller=' . $this->_controller . '&amp;action=exportBatchList">'.$this->_m->getMessageEntites('view_navigator','repository').'</a></li>';
    $html_header .= '        <li id="expand-all"><a class="dropdown-item" href="index.php?controller=' . $this->_controller . '&amp;action=exportBatchEraseAllFiles">'.$this->_m->getMessageEntites('view_navigator','batchDeleteAll').'</a></li>';
    $html_header .= '    </ul>';
    $html_header .= '</div>';
    $html_header .= '</li>';
    
    $html_header .= '</ul>';
  }
}elseif($this->_controller=='start'){
  if($this->_action=='errorsList'){
    $html_header .= '<ul>';
      $html_header .= '<li><a class="btn btn-danger btn-sm" href="index.php?controller=' . $this->_controller . '&amp;action=eraseAllErrors" onclick="return confirm(\'Are you sure you want to DELETE all Files?\rCAUTION: This action can not be undone! \');">'.$this->_m->getMessageEntites('view_navigator','erase_all_errors').'</a></li>';
    $html_header .= '</ul>';
  } else if($this->_action=='eventsList') {
    $html_header .= '<ul>';
      $html_header .= '<li><a class="btn btn-danger btn-sm" href="index.php?controller=' . $this->_controller . '&amp;action=eraseAllEvents" onclick="return confirm(\'Are you sure you want to DELETE all FIles?\rCAUTION: This action can not be undone\');">'.$this->_m->getMessageEntites('view_navigator','erase_all_events').'</a></li>';
    $html_header .= '</ul>';
  }
}

# Breadcrumbs {
$html_breadcrumbs = '';
if($this->_controller=='login'){
  $dato_carriada = 'Login';
}else{
  $dato_carriada = ucfirst(str_replace('_',' ',mb_strtolower($table_name,'UTF-8')));
}

$html_breadcrumbs .= '<li>'."\r";
$html_breadcrumbs .= '	<a HREF="index.php">'.$this->_m->getMessageEntites('global','section').'</a>'."\r";
$html_breadcrumbs .= '</li>'."\r";

if(empty($this->_action)){
  $html_breadcrumbs .= '<li CLASS="active">'."\r";
  $html_breadcrumbs .= '	<strong>'.$dato_carriada.'</strong>'."\r";
}else{
  $html_breadcrumbs .= '<li>'."\r";
  $html_breadcrumbs .= '	'.$dato_carriada.''."\r";
}

$html_breadcrumbs .= '</li>'."\r";
$dictionary_actions = array(
'index' => 'Index',
'listed' => 'Listado',
'activate' => 'Activar',
'edit' => 'Editar',
'create' => 'Crear',
'search' => 'Buscar',
'talos01' => 'Insertar',
'talos02' => 'Borar',
'delete' => 'Borar',
'disposition' => 'Ordenar',
'export' => 'Exportar',
'filterPaged' => 'Listado filtrado',
'preview' => 'Vista Previa',
'duplicate' => 'Duplicar',
'listedAjax' => 'Listado Ajax',
'runImport' => 'Importar',
'version' => 'Versión',
'help' => 'Ayuda',
'license' => 'Licencia',
'credits' => 'Creditos',
'withoutPermissions' => 'Sin Permisos',
'menu' => 'Menú',
'api_credentials' => 'Credenciales de API',
'errorsList' => 'Lista de Errores',
'eventsList' => 'Lista de Eventos',
);

$action_name = array_key_exists($this->_action, $dictionary_actions) ? $dictionary_actions[$this->_action] : $this->_action;
if(!empty($this->_action)){
  $html_breadcrumbs .= '<li CLASS="active">'."\r";
  $html_breadcrumbs .= '	<strong>'.ucfirst(str_replace('_',' ',mb_strtolower($action_name,'UTF-8'))).'</strong>'."\r";
  $html_breadcrumbs .= '</li>'."\r";
}
# } Breadcrumbs

# Footer
$html_footer = '<a href="index.php?controller=start&amp;action=version">'.$this->_m->getMessageEntites('view_footer','version').'</a> | <a href="index.php?controller=start&amp;action=help">'.$this->_m->getMessageEntites('view_footer','help').'</a> | <a href="index.php?controller=start&amp;action=license">'.$this->_m->getMessageEntites('view_footer','license').'</a> | <a href="index.php?controller=start&amp;action=credits">'.$this->_m->getMessageEntites('view_footer','credits').'</a>';
if($this->_controller != 'login'){
  if($this->_data_admin['moderator']==1){
    $html_footer .= ' | <a href="index.php?controller=start&amp;action=api_credentials" target="_blank">'.$this->_m->getMessageEntites('view_footer','api_credentials').'</a>';
  }
}
$html_footer .= ' | <strong>Copyright</strong> {SMVC} © 2020 ';
# Global Buttons
$html_global_buttons = '<a CLASS="navbar-minimalize minimalize-styl-2 btn btn-primary " HREF="#"><i CLASS="fa fa-bars"></i></a>';
if($this->_controller != 'login'){
  if($this->_data_admin['moderator']==1){
    $html_global_buttons .= '<a CLASS="btn btn-primary minimalize-styled" HREF="../index.php" target="_blank">'.$this->_m->getMessageEntites('global','see_site').'</a>';
    $html_global_buttons .= '<a CLASS="btn btn-primary minimalize-styled" HREF="../api/webservices.php" target="_blank">'.$this->_m->getMessageEntites('global','see_api').'</a>';
  }
}

?>