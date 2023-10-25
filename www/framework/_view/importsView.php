<?php
//require_once( dirname(__FILE__) . '/../'.FOLDER_THEME.'Class.Template.php');
require_once( dirname(__FILE__) . '/../_lib/template/Class.Template.php');
require_once( dirname(__FILE__) . '/APP.MenuView.php');

$urlIndex = 'index.php?controller='.$this->_controller.'&action=index&pager_page='.$this->_pager_page.'&';
$urlIndexEntities = htmlentities($urlIndex);
$urlListed = 'index.php?controller='.$this->_controller.'&action=listed&pager_page='.$this->_pager_page.'&';
$urlListedEntities = htmlentities($urlListed);
$urlCreate = 'index.php?controller='.$this->_controller.'&action=create&pager_page='.$this->_pager_page.'&';
$urlCreateEntities = htmlentities($urlCreate);
$urlSearch = 'index.php?controller='.$this->_controller.'&action=search&pager_page='.$this->_pager_page.'&';
$urlSearchEntities = htmlentities($urlSearch);

if(!empty($success)){
  $urlListedSuccess = 'index.php?controller='.$success['controller'].'&action=listed&';
}else{
  $urlListedSuccess = 'index.php';
}
$urlListedEntitiesSuccess = htmlentities($urlListedSuccess);

$the_key = $this->_key;
$the_status = $this->_status;
$the_order = $this->_order;
$array_leds_status = array('id_order_state','id_task_state','id_book_state');
$collector = '';
$html_main = '';

$url_api_list = CONFIG_HOST_NAME_FRONTEND.'api/webservices.php?controller='.$this->_controller.'&
action=listed&status=1&
public_key='.base64_encode(CRYPT_VAR_WEB_SERVICE).'&personal_key='.base64_encode($admin_api_token);

$url_api_paginated_list = CONFIG_HOST_NAME_FRONTEND.'api/webservices.php?controller='.$this->_controller.'&
action=filterPaged&pager_page=0&pager_quantity=2&status=1&
public_key='.base64_encode(CRYPT_VAR_WEB_SERVICE).'&personal_key='.base64_encode($admin_api_token);

$url_api_detail = CONFIG_HOST_NAME_FRONTEND.'api/webservices.php?controller='.$this->_controller.'&
action=detail&'.$the_key.'=1&status=1&
public_key='.base64_encode(CRYPT_VAR_WEB_SERVICE).'&personal_key='.base64_encode($admin_api_token);

$url_api_search = CONFIG_HOST_NAME_FRONTEND.'api/webservices.php?controller='.$this->_controller.'&
action=search&first_name=david&
public_key='.base64_encode(CRYPT_VAR_WEB_SERVICE).'&personal_key='.base64_encode($admin_api_token);

$url_api_insert = CONFIG_HOST_NAME_FRONTEND.'api/webservices.php?controller='.$this->_controller.'&
action=talos01&first_name=Xxx&last_name=Xxxx&
public_key='.base64_encode(CRYPT_VAR_WEB_SERVICE).'&personal_key='.base64_encode($admin_api_token);

$url_api_update = CONFIG_HOST_NAME_FRONTEND.'api/webservices.php?controller='.$this->_controller.'&
action=talos02&'.$the_key.'=1&first_name=David Gustavo&
public_key='.base64_encode(CRYPT_VAR_WEB_SERVICE).'&personal_key='.base64_encode($admin_api_token);

$url_api_duplicate = CONFIG_HOST_NAME_FRONTEND.'api/webservices.php?controller='.$this->_controller.'&
action=duplicate&'.$the_key.'=1&
public_key='.base64_encode(CRYPT_VAR_WEB_SERVICE).'&personal_key='.base64_encode($admin_api_token);

$url_api_delete = CONFIG_HOST_NAME_FRONTEND.'api/webservices.php?controller='.$this->_controller.'&
action=talos03&'.$the_key.'=1&
public_key='.base64_encode(CRYPT_VAR_WEB_SERVICE).'&personal_key='.base64_encode($admin_api_token);

switch($action){
    
  case 'index':
    require_once( dirname(__FILE__) . '/_actions/index.php' );
  break;

  case 'listed':
    require_once( dirname(__FILE__) . '/_actions/listed.php' );
  break;

  case 'activate':
    header('Location: '.utf8_encode($urlListed).'');
    exit();
  break;

  case 'success':
    $html_main = '<section CLASS="12u" class="first">
                    <div CLASS="box_index">
                        <h1>medios / carga / éxito</h1>
                        <div CLASS="box_conten">
                            <h2>Éxito</h2>
                            <div CLASS="separador"></div>
                            <p>El contenido fue cargado con éxito.</p>
                        </div>
                    </div>
                </section>';
  break;

  case 'filterPaged':
    require_once( dirname(__FILE__) . '/_actions/filterPaged.php' );
  break;

  case 'create':
    require_once( dirname(__FILE__) . '/_actions/create.php' );
  break;

  case 'search':
    require_once( dirname(__FILE__) . '/_actions/search.php' );
  break;

  case 'talos01':
    $url = 'index.php?controller='.$this->_controller.'&action=listed&pager_page='.$this->_pager_page.'&';
    header('Location: '.$url.'');
    exit();
  break;

  case 'delete':
    $url = 'index.php?controller='.$this->_controller.'&action=listed&pager_page='.$this->_pager_page.'&';
    header('Location: '.$url.'');
    exit();
  break;

  case 'disposition':
    $url = 'index.php?controller='.$this->_controller.'&action=listed&pager_page='.$this->_pager_page.'&';
    header('Location: '.$url.'');
    exit();
  break;

  case 'edit':
    require_once( dirname(__FILE__) . '/_actions/edit.php' );
  break;

  case 'talos02':
    $url = 'index.php?controller='.$this->_controller.'&action=listed&pager_page='.$this->_pager_page.'&';
    header('Location: '.$url.'');
    exit();
  break;

  case 'export':
    require_once( dirname(__FILE__) . '/_actions/export.php' );
  break;

  case 'preview':
    require_once( dirname(__FILE__) . '/_actions/preview.php' );
  break;

  case 'duplicate':
    $url = 'index.php?controller='.$this->_controller.'&action=listed&pager_page='.$this->_pager_page.'&';
    header('Location: '.$url.'');
    exit();
  break;

  case 'runImport':
    require_once( dirname(__FILE__) . '/_actions/success.php' );
  break;

  case 'listedAjax':
    require_once( dirname(__FILE__) . '/_actions/listedAjax.php' );
  break;

  default:
    $html_main = ' ';
  break;
  }

?>