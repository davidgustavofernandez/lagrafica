<?php
require_once( dirname(__FILE__) . '/../_lib/template/Class.Template.php');
require_once( dirname(__FILE__) . '/APP.MenuView.php');

$urlListed = 'index.php?controller='.$this->_controller.'&action=listed&pager_page='.$this->_pager_page.'&';
$urlRecover = 'index.php?controller=login&action=recover';
$urlLogin = CONFIG_REAL_URL;
$urlListedEntities = htmlentities($urlListed);
$urlRecoverEntities = htmlentities($urlRecover);
$urlLoginEntities = htmlentities($urlLogin);
$the_key = $this->_key;
$collector = '';
$html_field = '';
$html_main = '';

switch($action){
  case 'index':
    header('Location: index.php?controller=login&action=login');
    exit();
  break;

  case 'login':
    $message = $this->_p->spread('get','message',0);

    require_once( dirname(__FILE__) . '/../_lib/datatype/Class.Data.Type.php' );
    $id_record_name = $resultLogin['1'];
    $id_record_value = $resultLogin['0']->$id_record_name;

    $theType = new DataType();

    $collector= '
    function validar(){
      d = document.' . $this->_controller . ';
      error = \'\';
      error += completo(d.user,"USER");
      error += completo(d.password,"PASSWORD");
      if(error!=\'\'){ alert("'.$this->_m->getMessageEntites('view_login','empty_data').':\n"+error); }else{ d.submit(); }
    }
    $(document).ready(function () {
      $(document).keypress(function(e) {
        if(e.which == 13) {
          validar();
        }
      });
    });
    ';

    $html_main .= '<div>'."\r";
    $html_main .= '  <div>'."\r";
    $html_main .= '      <img SRC="themes/skin/'.TEMPLATE_SKIN_BACKEND.'/images/logo_login.png" ALT="'.CONFIG_NAME_SITE.'" BORDER="0"/>'."\r";
    $html_main .= '	</div>'."\r";
    // $html_main .= '	<h3>'.$this->_m->getMessageEntites('view_login','wellcome').'</h3>'."\r";
    // $html_main .= '	<p>'.CONFIG_NAME_SITE.'</p>'."\r";
    $html_main .= '	<form class="m-t" ACTION="index.php" method="post" onSubmit="return validar(this);" name="' . $this->_controller . '" id="' . $this->_controller . '" enctype="multipart/form-data">'."\r";
    $html_main .= '	<input type="hidden" name="controller" value="'.$this->_controller.'" />'."\r";
    $html_main .= '	<input type="hidden" name="action" value="process" />'."\r";

    if(!empty($message)){
      $html_main .= '	<div class="alert alert-danger"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'.$this->_m->getMessageEntites('login',$message).'</div>'."\r";
    }

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

      if($field=='user' || $field=='password'){
        if($field_primary_key!='PRI' && $field!=$this->_status && $field!='field_order'){
          if($field_form=='true'){
            if(!empty($table_fields[$key]['query'])){
              $field_primary_query = $this->_model->getInjection($table_fields[$key]['query']);
            }else{
              $field_primary_query = '';
            }

            $typeIn = array(
              'TYPE' => $field_type_of,
              'NAME' => $field,
              'ID' => $field,
              'PLACEOLDER' => $field,
              'SOBRIQUET' => 'CAMBIAR',
              'VALUE' => array(
                array(
                  'VALUE'	=> $resultLogin[0]->$key,
                  'CHEQUEADO' => $resultLogin[0]->$key,
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
            $html_main .= '      <div class="form-group">'."\r";
            $html_main .= '          '.$theType->_composer().''."\r";
            $html_main .= '      </div>'."\r";
          }
        }
      }
    }

    $html_main .= '      <input TYPE="button" CLASS="btn btn-primary block full-width m-b" VALUE="'.$this->_m->getMessageEntites('view_login','login').'" onClick="validar();" />';
    $html_main .= '      <p class="text-muted text-center"><small>'.$this->_m->getMessageEntites('view_login','forgot').'</small></p>'."\r";
    $html_main .= '      <a class="btn btn-sm btn-white btn-block" href="'.$urlRecoverEntities.'">'.$this->_m->getMessageEntites('view_login','recover').'</a>'."\r";
    $html_main .= '      <p class="m-t">'.$this->_m->getMessageEntites('view_login','message').'</p>'."\r";
    $html_main .= '  </form>'."\r";
    $html_main .= '</div>'."\r";
  break;

  case 'recover':
    require_once( dirname(__FILE__) . '/../_lib/datatype/Class.Data.Type.php' );
    $id_record_name = $resultRecover['1'];
    $id_record_value = $resultRecover['0']->$id_record_name;

    $theType = new DataType();

    $collector= '
    function validar(){
      d = document.' . $this->_controller . ';
      error = \'\';
      error += completo(d.email,"EMAIL");
      if(error!=\'\'){ alert("'.$this->_m->getMessageEntites('view_login','empty_data').':\n"+error); }else{ d.submit(); }
    }
    $(document).ready(function () {
      $(document).keypress(function(e) {
        if(e.which == 13) {
          validar();
        }
      });
    });
    ';

    $html_main .= '<div>'."\r";
    $html_main .= '  <div>'."\r";
    $html_main .= '      <img SRC="themes/skin/'.TEMPLATE_SKIN_BACKEND.'/images/logo_login.png" ALT="'.CONFIG_NAME_SITE.'" BORDER="0"/>'."\r";
    $html_main .= '  </div>'."\r";
    $html_main .= '  <h3>Recover Password</h3>'."\r";
    $html_main .= '  <form class="m-t" ACTION="index.php" method="post" onSubmit="return validar(this);" name="' . $this->_controller . '" id="' . $this->_controller . '" enctype="multipart/form-data">'."\r";
    $html_main .= '      <input type="hidden" name="controller" value="'.$this->_controller.'" />'."\r";
    $html_main .= '      <input type="hidden" name="action" value="processRecover" />'."\r";

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

      if($field=='email'){
        if($field_primary_key!='PRI' && $field!=$this->_status && $field!='field_order'){
          if($field_form=='true'){
            if(!empty($table_fields[$key]['query'])){
              $field_primary_query = $this->_model->getInjection($table_fields[$key]['query']);
            }else{
              $field_primary_query = '';
            }

            $typeIn = array(
              'TYPE' => $field_type_of,
              'NAME' => $field,
              'ID' => $field,
              'PLACEOLDER' => $field,
              'SOBRIQUET' => 'CAMBIAR',
              'VALUE' => array(
                array(
                  'VALUE'	=> $resultRecover[0]->$key,
                  'CHEQUEADO' => $resultRecover[0]->$key,
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
            $html_main .= '      <div class="form-group">'."\r";
            $html_main .= '          '.$theType->_composer().''."\r";
            $html_main .= '      </div>'."\r";
          }
        }
      }
    }

    $html_main .= '      <button type="button" class="btn btn-primary block full-width m-b" onClick="validar();">'.$this->_m->getMessageEntites('view_login','recover').'</button>'."\r";
    $html_main .= '      <p class="text-muted text-center"><small>'.$this->_m->getMessageEntites('view_login','forgot').'</small></p>'."\r";
    $html_main .= '      <a class="btn btn-sm btn-white btn-block" href="'.$urlLoginEntities.'">Login</a>'."\r";
    $html_main .= '  </form>'."\r";
    $html_main .= '</div>'."\r";
  break;

  case 'process':
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

      if($field_primary_key=='PRI'){
        $_id_table = (string)$field;
      }
    }

    if(!empty($resultProcess->$_id_table) ){
      if(is_numeric($resultProcess->$_id_table)){
        $elRetorno = (array)$resultProcess;

        $this->_ses->setSessionInit(CONFIG_SESION_FLAG);
        $this->_ses->setSessionVariableArray('admin_data', $elRetorno);

        # WE BLOCK THE PERMITS ACCORDING TO THE SECTIONS AND SAVE THEM IN THE SESSION
        $query = "SELECT vmc.id_administrator_permission AS id_administrator_permission, p.table_name AS tabla FROM ".$this->_prefix."administrators_permissions_relations vmc INNER JOIN ".$this->_prefix."administrators_permissions p on p.id_administrator_permission=vmc.id_administrator_permission WHERE vmc.id_administrator = '" . $elRetorno['id_administrator'] . "' and p.status > '0' and vmc.status > '0';";

        $adminPermissions = $this->_model->getInjection($query);

        if(is_array($adminPermissions)){
          $adminPermissionsFinal = array();

          foreach($adminPermissions as $permisos){
            $adminPermissionsFinal[] = $permisos->tabla;
          }

          $this->_ses->setSessionVariableArray('admin_permissions', $adminPermissionsFinal);

          # I ask if I redirect
          $oldUri = $this->_ses->getSessionVariableArray('admin_redirect',true) ? $this->_ses->getSessionVariableArray('user_redirect',true) : '' ;

          if(!empty($oldUri['0']) && $oldUri != 'user_redirect - does not exist'){
            header('Location: '.$oldUri['0'].'');
          }else{
            header('Location: index.php');
          }
          exit();
        }else{
          /*$laUri[] = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
          $this->_ses->setSessionInit(CONFIG_SESION_FLAG);
          $this->_ses->setSessionVariableArray('user_redirect', $laUri);*/
          header('Location: index.php?controller=login&action=withoutPermissions');
          exit();
        }
      }else{
        header('Location: index.php?controller=login&action=login');
        exit();
      }
    }else{
      header('Location: index.php?controller=login&action=login&message=10');
      exit();
    }
  break;

  case 'processRecover':
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


      if($field_primary_key=='PRI'){
        $_id_table = (string)$field;
      }
    }

    if(!empty($resultProcess->$_id_table) ){
      if(is_numeric($resultProcess->$_id_table)){
        $elRetorno = (array)$resultProcess;

        # Token
        require_once( dirname(__FILE__) . '/../_lib/token/Class.Token.php' );
        $tokenise = new Token();
        $tokenise->setChars(true,true,true,false);
        $tokenise->setLength(10,10);
        $theToken = $tokenise->getToken();

        # Crypt
        require_once( dirname(__FILE__) . '/../_lib/crypt/Class.Crypt.php' );
        $cryptise = new Crypt();
        $cryptise->setKey(CRYPT_VAR);
        $inCrypter = $cryptise->getEncrypt($theToken.'|'.$elRetorno['id_administrator']);

        # VARIABLES for email
        $user_email = $elRetorno['email'];
        $user_name = $elRetorno['name'] . ' ' . $elRetorno['last_name'];
        $email_fecha = $this->_f->date_decode(date('Y-m-d h:i:s'), TIME_ZONE, DATETIME_FORMAT);
        $email_titulo = 'Recover password';
        $email_asunto = 'Recover password';
        $email_url = CONFIG_HOST_NAME_BACKEND.'/mails/';
        $email_url_recover = CONFIG_HOST_NAME_BACKEND.'index.php?controller=login&action=change&password_recover='.$inCrypter;
        $email_url_to_admin = CONFIG_HOST_NAME_FRONTEND.'index.php';
        
        # CONTENT OF THE EMAIL
        $elbody = file_get_contents('mails/recupera.html');
        $elbody = str_replace('[[[brand]]]',CONFIG_NAME_SITE,$elbody);
        $elbody = str_replace('[[[title]]]',$email_titulo,$elbody);
        $elbody = str_replace('[[[date]]]',$email_fecha,$elbody);
        $elbody = str_replace('[[[user]]]',$user_name,$elbody);
        $elbody = str_replace('[[[urlsitio]]]',$email_url,$elbody);
        $elbody = str_replace('[[[urlrecover]]]',$email_url_recover,$elbody);
        $elbody = str_replace('[[[url_admin]]]',$email_url_to_admin,$elbody);

        # UID token
        $query = "UPDATE ".$this->_prefix."administrators SET password_recover = '".$inCrypter."' WHERE id_administrator= '" . $elRetorno['id_administrator'] . "' and status > '0';";
        $updateToken = $this->_model->getInjection($query);

        if(CONFIG_EN_DESARROLLO){
          echo "<br>";
          echo "Form Mail: " . FROM_NAME . " <" . FROM_EMAIL . "><br>";
          echo "Email addressee : " . $user_email . "<br>";
          echo "Name addressee : " . $user_name . "<br>";
          echo "Subject : " . $email_asunto . "<br>";
          echo "HTML : " . "<br>";
          echo $elbody . "<br>";
          exit();
        }else{
          require_once( dirname(__FILE__) . '/../_lib/mails/Class.Sender.Smtp.php' );
          
          $sm = new SenderSmtp();
          $sm->setPathMailHtml('/');
          $sm->setServer('');
          $sm->setAuthentication(false);
          $sm->setPort(25);
          $sm->setUser('');
          $sm->setPassword('');
          $sm->setEmailFromName(FROM_NAME);
          $sm->setEmailFromEmail(FROM_EMAIL);
          $sm->setEmailToName($user_name);
          $sm->setEmailToEmail($user_email);
          $sm->setEmailSubject($email_asunto);
          $sm->setEmailConten($elbody);
          $sm->setSistem('MAIL');
          $retorno = $sm->getSender();

          # We ask if the email was sent
          if($retorno=='200'){
            header('Location: index.php?controller=login&action=nomatch&message=200');
            exit();
          }else{
            header('Location: index.php?controller=login&action=nomatch&message=400');
            exit();
          }
        }
      }else{
        header('Location: index.php?controller=login&action=nomatch&message=500');
        exit();
      }
    }else{
      header('Location: index.php?controller=login&action=nomatch&message=500');
      exit();
    }
  break;

  case 'change':
    require_once( dirname(__FILE__) . '/../_lib/datatype/Class.Data.Type.php' );
    $id_record_name = $resultChange['1'];
    $id_record_value = $resultChange['0']->$id_record_name;

    if(!empty($_GET['password_recover'])){
      $userRecover = $this->_p->spread('get','password_recover','');
    }elseif(!empty($_POST['password_recover'])){
      $userRecover = $this->_p->spread('post','password_recover','');
    }elseif(!empty($_REQUEST['password_recover'])){
      $userRecover = $this->_p->spread('recover','password_recover','');
    }

    if(empty($userRecover)){
      header('Location: index.php?controller=login&action=nomatch&message=501');
      exit();
    }

    $theType = new DataType();

    # IMPROVE VALIDATION
    $collector= '
    function validar(){
      d = document.' . $this->_controller . ';
      error = \'\';
      error += completo(d.password,"password");
      error += completo(d.password_recover,"RECOVER");
      if(error!=\'\'){ alert("'.$this->_m->getMessageEntites('view_login','empty_data').':\n"+error); }else{ d.submit(); }
    }
    $(document).ready(function () {
      $(document).keypress(function(e) {
        if(e.which == 13) {
          validar();
        }
      });
    });
    ';

    $html_main .= '<div>'."\r";
    $html_main .= '  <div>'."\r";
    $html_main .= '      <img SRC="themes/skin/'.TEMPLATE_SKIN_BACKEND.'/images/logo_login.png" ALT="'.CONFIG_NAME_SITE.'" BORDER="0"/>'."\r";
    $html_main .= '  </div>'."\r";
    $html_main .= '  <h3>Change password</h3>'."\r";
    $html_main .= '  <form class="m-t" ACTION="index.php" method="post" onSubmit="return validar(this);" name="' . $this->_controller . '" id="' . $this->_controller . '" enctype="multipart/form-data">';
    $html_main .= '      <input type="hidden" name="controller" value="'.$this->_controller.'" />';
    $html_main .= '      <input type="hidden" name="action" value="processChange" />';
    $html_main .= '      <input type="hidden" name="password_recover" value="'.$userRecover.'" />';

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


      if($field=='password'){
        if($field_primary_key!='PRI' && $field!=$this->_status && $field!='field_order'){
          if($field_form=='true'){
            if(!empty($table_fields[$key]['query'])){
              $field_primary_query = $this->_model->getInjection($table_fields[$key]['query']);
            }else{
              $field_primary_query = '';
            }

            $typeIn = array(
              'TYPE' => $field_type_of,
              'NAME' => $field,
              'ID' => $field,
              'PLACEOLDER' => $field,
              'SOBRIQUET' => 'CAMBIAR',
              'VALUE' => array(
                array(
                  'VALUE'	=> $resultChange[0]->$key,
                  'CHEQUEADO'	=> $resultChange[0]->$key,
                  'VISIBLE'	=> '0'
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
            $html_main .= '      <div class="form-group">';
            $html_main .= '          '.$theType->_composer().'';
            $html_main .= '      </div>';
          }
        }
      }
    }
    $html_main .= '      <button type="button" class="btn btn-primary block full-width m-b" onClick="validar();">Change</button>'."\r";
    $html_main .= '      <p class="text-muted text-center"><small>Forgot your password?</small></p>'."\r";
    $html_main .= '      <a class="btn btn-sm btn-white btn-block" href="'.$urlRecoverEntities.'">Recover</a>'."\r";
    $html_main .= '  </form>'."\r";
    $html_main .= '</div>'."\r";
  break;

  case 'processChange':
    if(!empty($_GET['password_recover'])){
      $userRecover = $this->_p->spread('get','password_recover','');
    }elseif(!empty($_POST['password_recover'])){
      $userRecover = $this->_p->spread('post','password_recover','');
    }elseif(!empty($_REQUEST['password_recover'])){
      $userRecover = $this->_p->spread('recover','password_recover','');
    }

    if(empty($userRecover)){
      header('Location: index.php?controller=login&action=nomatch&message=501');
      exit();
    }

    if(!empty($_GET['password'])){
      $userPassword = $this->_p->spread('get','password','');
    }elseif(!empty($_POST['password'])){
      $userPassword = $this->_p->spread('post','password','');
    }elseif(!empty($_REQUEST['password'])){
      $userPassword = $this->_p->spread('recover','password','');
    }

    if(empty($userPassword)){
      header('Location: index.php?controller=login&action=nomatch&message=501');
      exit();
    }

    # Recover encrypted user
    require_once( dirname(__FILE__) . '/../_lib/crypt/Class.Crypt.php' );
    $cryptise = new Crypt();
    $cryptise->setKey(CRYPT_VAR);
    $deCrypter = $cryptise->getDecrypt($userRecover);
    $dataInCrypter = explode('|',$deCrypter);
    # Encrypt the PASSWORD
    $passwordCrypter = $cryptise->getEncrypt($userPassword);

    # Search user by UID token
    $query = "SELECT id_administrator, password_recover FROM ".$this->_prefix."administrators WHERE password_recover= '" . $userRecover . "' and status > '0';";
    $dataUserFromRecover = $this->_model->getInjection($query);

    if(is_array($dataUserFromRecover)){
      if(!empty($dataUserFromRecover[0])){
        # Validate administrator
        if($userRecover === $dataUserFromRecover[0]->password_recover){
          # Update password
          $queryUpdate = "UPDATE ".$this->_prefix."administrators SET password = '".$passwordCrypter."', password_recover='' WHERE id_administrator= '" . $dataUserFromRecover[0]->id_administrator . "' and status > '0';";
          $dataUserFromRecover = $this->_model->getInjection($queryUpdate);
          header('Location: index.php?controller=login&action=nomatch&message=201');
          exit();
        }
      }else{
        header('Location: index.php?controller=login&action=nomatch&message=502');
        exit();
      }
    }else{
      header('Location: index.php?controller=login&action=nomatch&message=502');
      exit();
    }
  break;

  case 'nomatch':
    $message = $this->_p->spread('get','message',0);
    
    if(!empty($message) && is_int($message)){
      $html_main .= '<div>'."\r";
      $html_main .= '  <div>'."\r";
      $html_main .= '      <img SRC="themes/skin/'.TEMPLATE_SKIN_BACKEND.'/images/logo_login.png" ALT="'.CONFIG_NAME_SITE.'" BORDER="0"/>'."\r";
      $html_main .= '  </div>'."\r";
      $html_main .= '  <h3>Mensaje</h3>'."\r";
      $html_main .= '  <div class="alert alert-danger"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'.$this->_m->getMessageEntites('login',$message).'</div>'."\r";
      $html_main .= '  <p class="text-muted text-center"><small>Forgot your password?</small></p>'."\r";
      $html_main .= '  <a class="btn btn-sm btn-white btn-block" href="'.$urlRecoverEntities.'">Recover</a>'."\r";
      $html_main .= '  <p class="text-muted text-center"><small>Did you remember your password?</small></p>'."\r";
      $html_main .= '  <input TYPE="button" CLASS="btn btn-primary block full-width m-b" VALUE="Login"  onclick="window.location.href=\''.$urlLoginEntities.'\';" />';
      $html_main .= '</div>'."\r";
    }
  break;

  case 'distroy':
    $this->_ses->setSessionInit(CONFIG_SESION_FLAG);
    $this->_ses->setSessionDistroy();
    $html_main .= 'Controlador ' . $this->_controller . ' Salir';
  break;

  case 'withoutPermissions':
    $html_main .= 'No tiene permisos';
  break;

  default:
    $html_main .= ' ';
  break;
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
$temp->setTemplate('_Login.xml');

# Instance DOMDocument, DOMXPath
$temp->setIni();

# Content  ($path, $index, $data)
# Main
$temp->setData('/html/body/div', 0, $html_main);

# Set common metatags & files
$temp->setChangeAttribute('/html', array('xml:lang', 'LANG'),array('xml:lang'=>'es', 'LANG'=>'es'));
$temp->setData('/html/head', 0, $common_header_tags);

# Set Js
# jQuery
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/vendor/jquery/jquery.min.js'));
# Bootstrap Core JavaScript
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/vendor/bootstrap/js/bootstrap.min.js'));

# Functions
$temp->addFile("body",0,"script",array('type'=>'text/javascript', 'src'=>CONFIG_HOST_NAME_BACKEND.FOLDER_THEME.TEMPLATE_SKIN_BACKEND.'/js/functions.js'));

if($this->_action!='preview' && $this->_action!='cargar'){
  # Scripts
  $temp->addChild("body",0,"script", $collector);
}

echo $temp->getTemplate();
?>