<?php
/* View: search
 * Action: Show the form search
 * Return: HTML return
 * Comment: Generate the search form
 */
require_once( dirname(__FILE__) . '/../../_lib/datatype/Class.Data.Type.php' );

$html_field = '';
$theType = new DataType();
$theType->setEmpty(true);

foreach($this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'] as $key=> $value){
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

    $field_type_of = ($field_type_of=='richtext' || $field_type_of=='text' || $field_type_of=='longtext' || $field_type_of=='longtext' ) ? $field_type_of='varchar' : $field_type_of=$field_type_of;

    if($field_primary_key!='PRI' && $field!=$this->_status && $field!=$this->_order){
        if($field_form=='true'){
            if(!empty($table_fields[$key]['query'])){
                $field_primary_query = $this->_model->getInjection($table_fields[$key]['query'] . ' where status=1 ');
            }else{
                $field_primary_query = '';
            }
            $default_valor = '';

            $typeIn = array(
                'TYPE' => $field_type_of,
                'NAME' => $field,
                'ID' => $field,
                'SOBRIQUET' => 'CAMBIAR',
                'VALUE' => array(
                    array(
                        'VALUE'	=> '',
                        'CHEQUEADO' => '0',
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
                'KEY' => $table_fields[$key]['field']
            );

            $theType->setTypeArray($typeIn);

            if($field_type_of=='file' || $field_type_of=='multicheckbox' || $field_type_of=='multicheckboxchild' || $field_type_of=='hiddendate' || $field_type_of=='hiddentime' || $field_type_of=='hiddendatetime' || $field_type_of=='varcharlink'  ){
                //
            }else{
                $theType->setTypeArray($typeIn);
                if($field_type_of=='hiddendate' || $field_type_of=='hiddentime' || $field_type_of=='hiddendatetime'){
                    $html_field .= $theType->_composer()."\r";
                }else{
                    $html_field .= '<div class="form-group box_'.$field_type_of.'">'."\r";
                    $html_field .= '    <label class="col-sm-2 control-label">'.$field_alternate_name.':</label>'."\r";
                    $html_field .= '    <div class="col-sm-9">'."\r";
                    $html_field .= '    '.$theType->_composer().''."\r";
                    $collector = $collector . $theType->getColector();
                    $html_field .= '    </div>'."\r";
                    $html_field .= '</div>'."\r";
                    $html_field .= '<div class="hr-line-dashed"></div>'."\r";
                }
            }
        }
    }
}

$tpl_script = '<script>
function validar(){
    d = document.' . $this->_controller . ';
    error = \'\';
    if(error!=\'\'){ alert("Por favor complete los campos faltantes:\n"+error); }else{ d.submit(); }
}
</script>';

$html_main = '';
$html_main .= $tpl_script;
$html_main .= '<div CLASS="row">';
$html_main .= '  <div class="col-lg-12">';
$html_main .= '      <div class="ibox float-e-margins">';
$html_main .= '          <div class="ibox-title">';
$html_main .= '              <h5>'.$this->_m->getMessageEntites('view_form','data').'</h5>';
$html_main .= '              <div class="html5buttons">';
$html_main .= '                  <div class="dt-buttons btn-group">'.$html_header.'</div>';
$html_main .= '              </div>';
$html_main .= '          </div>';
# FORM {
$html_main .= '          <div class="ibox-content">';		
$html_main .= '              <form action="index.php" class="form-horizontal" method="get" onSubmit="return validar(this);" name="' . $this->_controller . '" id="' . $this->_controller . '" enctype="multipart/form-data">';
$html_main .= '                  <input type="hidden" name="controller" value="'.$this->_controller.'" />';
$html_main .= '                  <input type="hidden" name="action" value="filterPaged" />';
$html_main .= '                  <input type="hidden" name="pager_page" value="'.$this->_pager_page.'" />';
$html_main .= '                  <input type="hidden" name="searching" value="true" />';
$html_main .= '                  '.$html_field;
$html_main .= '                  <div class="form-group">';
$html_main .= '                      <div class="col-sm-4 col-sm-offset-2">';
$html_main .= '                          <input type="button" value="'.$this->_m->getMessageEntites('view_form','cancel').'" CLASS="btn btn-white" onClick="location.href=\''.$urlListedEntities.'\'">';
$html_main .= '                          <input type="submit" value="'.$this->_m->getMessageEntites('view_form','search').'" CLASS="btn btn-primary"> ';
$html_main .= '                      </div>';
$html_main .= '                  </div>';
$html_main .= '              </form>';		
$html_main .= '          </div>';
# } FORM
$html_main .= '      </div>';
$html_main .= '  </div>';
$html_main .= '</div>';

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
$temp->setTemplate('_Forms.xml');

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

### JS
# CKEditor
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/ckeditor/ckeditor.js'));
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/ckeditor/config.js'));
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/ckeditor/adapters/jquery.js'));
$ckeditor_script = '
    CKEDITOR.disableAutoInline = true;
    CKEDITOR.config.entities = false;
    CKEDITOR.config.entities_greek = false;
';
$temp->addChild("body",0,"script", $ckeditor_script);
# Magnific Popup core JS file
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/magnific-popup/dist/jquery.magnific-popup.js'));
# Colorpicker
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/colorpicker/colorpicker.js'));
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/colorpicker/eye.js'));
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/colorpicker/utils.js'));
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/steps/jquery.steps.min.js'));
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/steps/jquery.validate.min.js'));
# Calendar
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/calendar/jquery.datetimepicker.full.js'));

### CSS
# Magnific Popup core CSS file
$temp->addFile("head",0,"link",array('rel'=>'stylesheet', 'type'=>'text/css', 'href'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/magnific-popup/dist/magnific-popup.css'));
# Colorpicker
$temp->addFile("head",0,"link",array('rel'=>'stylesheet', 'type'=>'text/css', 'href'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/colorpicker/colorpicker.css'));
# Calendar
$temp->addFile("head",0,"link",array('rel'=>'stylesheet', 'type'=>'text/css', 'href'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/calendar/jquery.datetimepicker.min.css'));

# Scripts
$temp->addChild("body",0,"script", $collector);

echo $temp->getTemplate();
?>