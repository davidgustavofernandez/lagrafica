<?php
/* View: create
 * Action: Show a form to create a new record
 * Return: HTML return
 * Comment: Generate the empty form to insert a new record
 */
require_once( dirname(__FILE__) . '/../../../framework/_lib/datatype/Class.Data.Type.php' );
require_once( dirname(__FILE__) . '/../../../framework/_lib/crypt/Class.Crypt.php');

$id_record_name = $resultPreview['1'];
$id_record_value = $resultPreview['0']->$id_record_name;

if(!empty($resultPreview['1']) && is_array($resultPreview)){
    $theType = new DataType();
    $edita_orden = false;

    $html_main .= '<table border="0" cellspacing="1" cellpadding="4" class="table table-striped"><tbody>'."\r";
    $varcharlink_array = array();

    foreach($this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'] as $key=> $value){
        $result_valor = '';
        $default_valor = '';
        $field = $key;                                                  // Field Name
        $field_alternate_name = $table_fields[$key]['alternatename'];   // Alternative name of the field
        $field_type = $table_fields[$key]['type'];                      // Type of field
        $field_type_of = $table_fields[$key]['type_of'];                // Type of component for Datatype
        $field_list = $table_fields[$key]['showinlist'];                // It is shown in the listing
        $field_form = $table_fields[$key]['showinform'];                // It is shown in the form
        $field_primary_key = $table_fields[$key]['key'];                // Determines if it is a primary KY in the table
        $field_restrictions = $table_fields[$key]['restrictions'];      // Filter or restriction to apply for FILES and IMAGES
        $field_foreign = $table_fields[$key]['foreign'];                // Relationship with another entity
        $field_foreign_field = $table_fields[$key]['foreign_field'];    // Field of the relationship with another entity
        $field_foreign_fields = $table_fields[$key]['foreign_fields'];  // Fields to filter in another relationship
        $field_validation = $table_fields[$key]['validation'];          // Apply validation on the field (LACK)
        $field_primary_query = $table_fields[$key]['query'];            // Query to apply relationship with another table

        $edita_orden = $field!=$this->_order ? true : false;

        if($field_primary_key!='PRI' && $field!=$this->_status && $edita_orden==true){
            if($field_form=='true'){
                $search_in = '';
                $default_valor_name = '';
                if(!empty($table_fields[$key]['query'])){
                    if($field_type_of=='multicheckbox' || $field_type_of=='multicheckboxchild'){
                        $pre_field_primary_query = str_replace('['.$id_record_name.']', $resultPreview['0']->$id_record_name, $this->_rules_instructions[$field]['preview']);
                        $field_primary_query = !empty($pre_field_primary_query) ? $this->_model->getInjection($pre_field_primary_query) : 'error';
                    }elseif($field_type_of=='seeker' || $field_type_of=='seekerequal'){
                        $_y = new Crypt();
                        $temp_search_in = base64_encode(serialize($field_foreign_fields));
                        $_y->setKey(CRYPT_VAR_TXT);
                        $search_in = $_y->getEncrypt($temp_search_in);
                        if(!empty($resultPreview[0]->$key)){
                            $relatin_query = $table_fields[$key]['query'] . ' where '.$field.'='.$resultPreview[0]->$key.';';
                            // echo $relatin_query;
                            $value_name = $this->_model->getInjection($relatin_query);
                            if(!empty($value_name[0]->name)){
                                $default_valor_name = $value_name[0]->name;
                            }elseif(!empty($value_name[0]->first_name)){
                                $default_valor_name = $value_name[0]->first_name;
                            }
                        }
                    }else{
                        $field_primary_query = $this->_model->getInjection($table_fields[$key]['query'] . ' where status=1 ');
                    }
                }else{
                    $field_primary_query = '';
                }

                $default_valor = $resultPreview[0]->$key;

                $typeIn = array(
                    'TYPE' => $field_type_of,
                    'NAME' => $field,
                    'ID' => $field,
                    'SOBRIQUET' => 'CAMBIAR',
                    'VALUE' => array(
                        array(
                            'VALUE'	=> $default_valor,
                            'VALUE_NAME' => $default_valor_name,
                            'CHEQUEADO' => $resultPreview[0]->$key,
                            'VISIBLE' => '0'
                        )
                    ),
                    'FOREIGN_ENTITY' => $field_foreign,
                    'VALIDATION' => $field_validation,
                    'PATHHOST' => $this->_files_path_host,
                    'PATHPHYSICAL' => $this->_files_path_physical,
                    'TABLE' => $this->_table,
                    'QUERY_PREPARED' => $field_primary_query,
                    'FORM' => $this->_controller,
                    'KEY' => $table_fields[$key]['field'],
                    'SERACH_FIELD' => $field_foreign_field,
                    'SERACH_FIELDS' => $search_in,
                    'RESTRICTIONS' => $field_restrictions,
                );
                // if($field_type_of=='seeker'){
                //     print_r($typeIn);
                // }
                # Files
                if($field_type_of=='file' && !empty($default_valor)){
                    if(file_exists($this->_files_path_physical.'thumb/'.$default_valor) || file_exists($this->_files_path_physical.'small/'.$default_valor) || file_exists($this->_files_path_physical.'big/'.$default_valor) || file_exists($this->_files_path_physical.'media/'.$default_valor)){
                        $temp_name = explode('.',$default_valor);
                        
                        if(file_exists($this->_files_path_physical.'small/'.$default_valor)){
                            $in_path = 'small/';
                        }else if(file_exists($this->_files_path_physical.'thumb/'.$default_valor)){
                            $in_path = 'thumb/';
                        }elseif(file_exists($this->_files_path_physical.'big/'.$default_valor)){
                            $in_path = 'big/';
                        }elseif(file_exists($this->_files_path_physical.'media/'.$default_valor)){
                            $in_path = 'media/';
                        }

                        if(file_exists($this->_files_path_physical.'small/'.$default_valor)){
                            $in_path_big = 'small/';
                        }else if(file_exists($this->_files_path_physical.'big/'.$default_valor)){
                            $in_path_big = 'big/';
                        }elseif(file_exists($this->_files_path_physical.'thumb/'.$default_valor)){
                            $in_path_big = 'thumb/';
                        }elseif(file_exists($this->_files_path_physical.'media/'.$default_valor)){
                            $in_path_big = 'media/';
                        }

                        $extencion = explode(".",$default_valor);
                        $extArchivo = '.'.strtolower($extencion[1]);
                        $extImages = array (".jpg", ".jpeg", ".gif", ".png");

                        if( in_array($extArchivo,$extImages) && $in_path == 'small/' ){
                            $imagen_mostrar 	= $this->_files_path_host.$in_path.$default_valor;
                            $imagen_mostrar_pop = $this->_files_path_host.$in_path_big.$default_valor;
                            $imagen_mostrar_thumb	= $this->_files_path_host.$in_path.$default_valor;
                        }else{
                            $imagen_mostrar 	= CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/images/icon_folder/48x48/icon_folder_'.strtolower($extencion[1]).'.gif';
                            $imagen_mostrar_pop	= $this->_files_path_host.$in_path_big.$default_valor;
                            $imagen_mostrar_thumb	= $this->_files_path_host.$in_path.$default_valor;
                        }

                        if(empty($imagen_mostrar_pop)){
                            $html_main .= '<tr>'."\r";
                            $html_main .= '<td><p>'.$field_alternate_name.':</p></td>'."\r";
                            $html_main .= '<td><img src="'.$imagen_mostrar.'" border="0" style="border-color:#CCCCCC; max-width: 100%;"></td>'."\r";
                            $html_main .= '</tr>'."\r";
                        }else{
                            if( in_array($extArchivo,$extImages) ){
                                $html_main .= '<tr>'."\r";
                                $html_main .= '<td><p>'.$field_alternate_name.':</p></td>'."\r";
                                $html_main .= '<td><img src="'.$imagen_mostrar_thumb.'" border="0" style="border-color:#CCCCCC; width: 100%;"></td>'."\r";
                                $html_main .= '</tr>'."\r";
                            }else{
                                $html_main .= '<tr>'."\r";
                                $html_main .= '<td><p>'.$field_alternate_name.':</p></td>'."\r";
                                $html_main .= '<td><img src="'.$imagen_mostrar.'" border="0" style="border-color:#CCCCCC;"></td>'."\r";
                                $html_main .= '</tr>'."\r";
                            }
                        }
                    }
                }else{
                    $theType->setTypeArray($typeIn);
                    if($field_type_of=='hiddendate' || $field_type_of=='hiddentime' || $field_type_of=='hiddendatetime'){
                        //
                    }else{
                        $html_main .= '<tr>'."\r";
                        $html_main .= '<td><p>'.$field_alternate_name.':</p></td>'."\r";
                        $html_main .= '<td>'.$theType->_show().'</td>'."\r";
                        $html_main .= '</tr>'."\r";
                    }
                }
            }
        }
    }
    $html_main .= '</tbody></table>'."\r";
}else{
    $listado = 'No Tiene permisos';
    $paginador = '';
    $html_main = $listado;
}

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
$temp->setTemplate('_Preview.xml');

# Instance DOMDocument, DOMXPath
$temp->setIni();

# Content  ($path, $index, $data)
$temp->setData('/html/body/div', 0, $html_main);

# Set common metatags & files
$temp->setChangeAttribute('/html', array('xml:lang', 'LANG'),array('xml:lang'=>'es', 'LANG'=>'es'));
$temp->setData('/html/head', 0, $common_header_tags);

if($this->_action!='preview' && $this->_action!='cargar'){
    # Scripts
    $temp->addChild("body",0,"script", $collector);
}

echo $temp->getTemplate();
?>