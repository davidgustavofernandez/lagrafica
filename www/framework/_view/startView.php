<?php
require_once( dirname(__FILE__) . '/../_lib/template/Class.Template.php');
require_once( dirname(__FILE__) . '/APP.MenuView.php');

$urlListed = 'index.php?controller='.$this->_controller.'&action=listed&pager_page='.$this->_pager_page.'&';
$urlErrorsList = 'index.php?controller='.$this->_controller.'&action=errorsList&';
$urlEventsList = 'index.php?controller='.$this->_controller.'&action=eventsList&';

$html_main = '';
$collector = '';

switch($action){
	case 'index':
		$html_main = ''.
		$salida_original = '';
		$salida_tratado = '';

		$html_main .= '<div class="col-lg-12">'."\r";
		$html_main .= '  <div class="ibox float-e-margins">'."\r";
		$html_main .= '      <div class="ibox-title">'."\r";
		$html_main .= '          <h5>'.$this->_m->getMessageEntites('global','wellcome').'</h5>'."\r";
		//$html_main .= '          <div class="ibox-tools">'."\r";
		//$html_main .= '              <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>'."\r";
		//$html_main .= '              <a class="close-link"><i class="fa fa-times"></i></a>'."\r";
		//$html_main .= '          </div>'."\r";
		$html_main .= '      </div>'."\r";
		$html_main .= '      <div class="ibox-content">'."\r";
		$html_main .= $this->_m->getMessageEntites('view_dashboard','initial_title_detail');
		$html_main .= '      </div>'."\r";
		$html_main .= '  </div>'."\r";
		$html_main .= '</div>'."\r";
		$html_main .= '<div CLASS="row">'."\r";
		$html_main .= '	<div CLASS="col-lg-12">'."\r";
		$html_main .= '	</div>'."\r";
		$html_main .= '</div>'."\r";
	break;

	case 'listed':
		$html_main = '<div CLASS="row">'."\r";
		$html_main .= '  <div CLASS="col-lg-12">'."\r";
		$html_main .= '      <div CLASS="ibox float-e-margins">'."\r";
		$html_main .= '          <div CLASS="ibox-content">'."\r";
		$html_main .= '              <h2>'.$action.'</h2>'."\r";
		$html_main .= '              <div class="hr-line-solid"></div>'."\r";
		$html_main .= '              <p></p>'."\r";
		$html_main .= '          </div>'."\r";
		$html_main .= '      </div>'."\r";
		$html_main .= '  </div>'."\r";
		$html_main .= '</div>'."\r";
	break;

	case 'seccionesfull':
		$listado_menu = '';

		if($this->_controller != 'login'){
			foreach($this->_estructuraBbdd as $bbdd_key=> $bbdd_value){//$this->_estructuraBbdd viene de la vista
				foreach($bbdd_value as $bbdd_tables_key=> $bbdd_tables_value){
					$bt_key = $bbdd_tables_key;
					$bt_key_name = $this->_estructuraBbdd[$bbdd_key][$bbdd_tables_key]['GLOBAL_alternatename'];
					// $bt_key_list = $this->_estructuraBbdd[$bbdd_key][$bbdd_tables_key]['GLOBAL_showinlist'];
					// $bt_key_form = $this->_estructuraBbdd[$bbdd_key][$bbdd_tables_key]['GLOBAL_showinform'];

					// if($bt_key_list=='true'){
						if(in_array(str_replace(CONFIG_DB_PREFIX,'',$bt_key),$data_admin_permissions)){
							$listado_menu .= '		<a href="index.php?controller='.str_replace(CONFIG_DB_PREFIX,'',$bt_key).'&amp;action=index">' . str_replace('_',' ',str_replace(CONFIG_DB_PREFIX,'',$bbdd_tables_key)) . '</a><br>'."\r";
						}
					// }
				}
			}
		}

		$html_main = '<div CLASS="row">'."\r";
		$html_main .= '  <div CLASS="col-lg-12">'."\r";
		$html_main .= '      <div CLASS="ibox float-e-margins">'."\r";
		$html_main .= '          <div CLASS="ibox-content">'."\r";
		$html_main .= '              <h2>All administrable sections</h2>'."\r";
		$html_main .= '              <div class="hr-line-solid"></div>'."\r";
		$html_main .= '              <p>'.$listado_menu.'</p>'."\r";
		$html_main .= '          </div>'."\r";
		$html_main .= '      </div>'."\r";
		$html_main .= '  </div>'."\r";
		$html_main .= '</div>'."\r";
	break;

	case 'create':
		$html_main = '<div CLASS="row">'."\r";
		$html_main .= '	<div CLASS="col-lg-12">'."\r";
		$html_main .= '      <div CLASS="ibox float-e-margins">'."\r";
		$html_main .= '          <div CLASS="ibox-content">'."\r";
		$html_main .= '              <h2>'.$action.'</h2>'."\r";
		$html_main .= '                  <div class="hr-line-solid"></div>'."\r";
		$html_main .= '                  <p></p>'."\r";
		$html_main .= '              </div>'."\r";
		$html_main .= '      </div>'."\r";
		$html_main .= '	</div>'."\r";
		$html_main .= '</div>'."\r";
	break;

	case 'withoutPermissions':
		$html_main = '<div CLASS="row">'."\r";
		$html_main .= '	<div CLASS="col-lg-12">'."\r";
		$html_main .= '      <div CLASS="ibox float-e-margins">'."\r";
		$html_main .= '          <div CLASS="ibox-content">'."\r";
		$html_main .= '              <h2>'.$this->_m->getMessageEntites('global','permissions_missing').'</h2>'."\r";
		$html_main .= '              <div class="hr-line-solid"></div>'."\r";
		$html_main .= '              <p>'.$this->_m->getMessageEntites('global','permissions_missing_detail').'</p>'."\r";
		$html_main .= '          </div>'."\r";
		$html_main .= '      </div>'."\r";
		$html_main .= '  </div>'."\r";
		$html_main .= '</div>'."\r";
	break;

	case 'version':
		$html_main = '<div CLASS="row">'."\r";
		$html_main .= '	<div CLASS="col-lg-12">'."\r";
		$html_main .= '      <div CLASS="ibox float-e-margins">'."\r";
		$html_main .= '          <div CLASS="ibox-content">'."\r";
		$html_main .= '              <h2>'.$this->_m->getMessageEntites('global','version').'</h2>'."\r";
		$html_main .= '              <div class="hr-line-solid"></div>'."\r";
		$html_main .= '              <p>';
		$html_main .= '/*<br>';
		$html_main .= '* @nombre {SMVC} Simple Model View Controller<br>';
		$html_main .= '* @author David Gustavo Fernandez - <a href="mailto:fernandezdg@gmail.com" target="_blank">fernandezdg@gmail.com</a><br>';
		$html_main .= '* @version 4.5<br>';
		$html_main .= '* @update 20/07/2020<br>';
		$html_main .= '* @package {SMVC} Simple Model View Controller<br>';
		$html_main .= '*/';
		$html_main .= '</p>';
		$html_main .= '          </div>'."\r";
		$html_main .= '      </div>'."\r";
		$html_main .= '  </div>'."\r";
		$html_main .= '</div>'."\r";
	break;

	case 'help':
		$html_main = '<div CLASS="row">'."\r";
		$html_main .= '	<div CLASS="col-lg-12">'."\r";
		$html_main .= '      <div CLASS="ibox float-e-margins">'."\r";
		$html_main .= '          <div CLASS="ibox-content">'."\r";
		$html_main .= '              <h2>'.$this->_m->getMessageEntites('global','help').'</h2>'."\r";
		$html_main .= '              <div class="hr-line-solid"></div>'."\r";
		$html_main .= '              <p>'.$this->_m->getMessageEntites('global','help_detail').'</p>';
		$html_main .= '          </div>'."\r";
		$html_main .= '      </div>'."\r";
		$html_main .= '	</div>'."\r";
		$html_main .= '</div>'."\r";
	break;

	case 'license':
		$html_main = '<div CLASS="row">'."\r";
		$html_main .= '	<div CLASS="col-lg-12">'."\r";
		$html_main .= '      <div CLASS="ibox float-e-margins">'."\r";
		$html_main .= '          <div CLASS="ibox-content">'."\r";
		$html_main .= '              <h2>'.$this->_m->getMessageEntites('global','license').'</h2>'."\r";
		$html_main .= '              <div class="hr-line-solid"></div>'."\r";
		$html_main .= '<p>'.$this->_m->getMessageEntites('global','license_detail_2').'</p>';
		$html_main .= '              <h2>'.$this->_m->getMessageEntites('global','license_detail_3').'</h2>';
		$html_main .= '              <div CLASS="separador"></div>';
		$html_main .= '<p>'.$this->_m->getMessageEntites('global','license_detail_4').'</p>';
		$html_main .= '              <h2>'.$this->_m->getMessageEntites('global','license_detail_5').'</h2>';
		$html_main .= '              <div CLASS="separador"></div>';
		$html_main .= '<p>'.$this->_m->getMessageEntites('global','license_detail_6').'</p>';
		$html_main .= '          </div>'."\r";
		$html_main .= '      </div>'."\r";
		$html_main .= '	</div>'."\r";
		$html_main .= '</div>'."\r";
	break;

	case 'credits':
		$html_main = '<div CLASS="row">'."\r";
		$html_main .= '	<div CLASS="col-lg-12">'."\r";
		$html_main .= '      <div CLASS="ibox float-e-margins">'."\r";
		$html_main .= '          <div CLASS="ibox-content">'."\r";
		$html_main .= '              <h2>Credits</h2>'."\r";
		$html_main .= '              <div class="hr-line-solid"></div>'."\r";
		$html_main .= '              <p><strong>{SMVC} Simple Model View Controller</strong></p>';
		$html_main .= '<p>';
		$html_main .= "It is a product developed by David Gustavo Fernandez.<br><br>";
		$html_main .= "{SMVC} can be used under the terms of the license <a href='http://choosealicense.com/licenses/gpl-3.0/' target='_blank'>GPL v3</a>. See <a href='index.php?controller=start&action=license' target='_blank'>license</a> <br><br>";
		$html_main .= "Contact: <a href='mailto:fernandezdg@gmail.com?subject=Pedido%20de%20licencia&amp;body=Sr.%20Fernandez.%0D%0A%0D%0AMe%20contacto%20con%20usted%20por%20el%20producto%3a%0D%0A{SP%20MVC}%20V2.1.%0D%0A%0D%0ASaludos%20Cordiales.' target='_blank'>fernandezdg@gmail.com</a>";
		$html_main .= '</p>';
		$html_main .= '          </div>'."\r";
		$html_main .= '      </div>'."\r";
		$html_main .= '	</div>'."\r";
		$html_main .= '</div>'."\r";
	break;

	case 'api_credentials':
		$sections_list = '';
		if($this->_controller != 'login'){
			foreach($this->_estructuraBbdd as $bbdd_key=> $bbdd_value){//$this->_estructuraBbdd viene de la vista
				// print_r($this->_estructuraBbdd);
				foreach($bbdd_value as $bbdd_tables_key=> $bbdd_tables_value){
					// echo $bbdd_tables_key;
					$bt_key = $bbdd_tables_key;
					$bt_key_name = $this->_estructuraBbdd[$bbdd_key][$bbdd_tables_key]['GLOBAL_alternatename'];
					// $bt_key_list = $this->_estructuraBbdd[$bbdd_key][$bbdd_tables_key]['GLOBAL_showinlist'];
					// $bt_key_form = $this->_estructuraBbdd[$bbdd_key][$bbdd_tables_key]['GLOBAL_showinform'];

					// if($bt_key_list=='true'){
						if(in_array(str_replace(CONFIG_DB_PREFIX,'',$bt_key),$data_admin_permissions)){
							// $sections_list .= '      <a href="index.php?controller='.str_replace(CONFIG_DB_PREFIX,'',$bt_key).'&amp;action=index">' . utf8_decode(htmlentities(strtolower($bt_key_name))) . '</a> ['.$bbdd_tables_key.']<br>'."\r";
							$sections_list .= '<a href="index.php?controller='.str_replace(CONFIG_DB_PREFIX,'',$bt_key).'&amp;action=index">' . $bbdd_tables_key . '</a><br>'."\r";
						}
					// }
				}
			}
		}
		// print_r($bbdd_value);
		$html_main = '<div CLASS="row">'."\r";
		$html_main .= ' <div CLASS="col-lg-12">'."\r";
		$html_main .= '      <div CLASS="ibox float-e-margins">'."\r";
		$html_main .= '          <div CLASS="ibox-content">'."\r";
		$html_main .= '              <h2>'.$this->_m->getMessageEntites('view_api','api_credentials').'</h2>'."\r";
		$html_main .= '              <div class="hr-line-solid"></div>'."\r";
		$html_main .= '<p>';
		$html_main .= $this->_m->getMessageEntites('view_api','api_credentials_1');
		$html_main .= '<strong>API URL:</strong> <a href="'.CONFIG_HOST_NAME_FRONTEND.'api/webservices.php" target="_blank">'.CONFIG_HOST_NAME_FRONTEND.'api/webservices.php <i class="fa fa-external-link-square"></i></a><br>';
		$html_main .= "<strong>public_key:</strong> ".CRYPT_VAR_WEB_SERVICE."<br>";
		$html_main .= "<strong>personal_key:</strong> ".$admin_api_token."<br><br>";

		$html_main .= $this->_m->getMessageEntites('view_api','api_credentials_2');
		
		$html_main .= '</p>';
		$html_main .= '              <h2>'.$this->_m->getMessageEntites('view_api','api_credentials_3').'</h2>';
		$html_main .= '              <div CLASS="separador"></div>';

		$html_main .= '<p>';
		$html_main .= $sections_list."<br>";
		$html_main .= $this->_m->getMessageEntites('view_api','api_credentials_4');
		$html_main .= '</p>';


		$html_main .= '              <h2>'.$this->_m->getMessageEntites('view_api','api_credentials_5').'</h2>';
		$html_main .= '              <div CLASS="separador"></div>';
		$html_main .= '<p>';
		$html_main .= $this->_m->getMessageEntites('view_api','api_credentials_6');
		$html_main .= '</p><br><br>';


		$html_main .= '              <h2>'.$this->_m->getMessageEntites('view_api','api_credentials_7').'</h2>';
		$html_main .= '              <div CLASS="separador"></div>';
		$html_main .= '<p>';
		$html_main .= '<ul>';

		$html_main .= '<li><strong>'.$this->_m->getMessageEntites('view_api','api_credentials_8').'</strong> <br><p><a href="'.CONFIG_HOST_NAME_FRONTEND.'api/webservices.php?controller=users&action=listed&status=1&public_key='.base64_encode(CRYPT_VAR_WEB_SERVICE).'&personal_key='.base64_encode($admin_api_token).'" target="_blank">'.CONFIG_HOST_NAME_FRONTEND.'api/webservices.php?<br>controller=users&<br>action=listed&<br>status=1&<br>public_key='.base64_encode(CRYPT_VAR_WEB_SERVICE).'&<br>personal_key='.base64_encode($admin_api_token).
		'</a></p></li>';

		$html_main .= '<li><strong>'.$this->_m->getMessageEntites('view_api','api_credentials_9').'</strong> <br><p><a href="'.CONFIG_HOST_NAME_FRONTEND.'api/webservices.php?controller=users&action=filterPaged&pager_page=0&pager_quantity=2&status=1&public_key='.base64_encode(CRYPT_VAR_WEB_SERVICE).'&personal_key='.base64_encode($admin_api_token).'" target="_blank">'.CONFIG_HOST_NAME_FRONTEND.'api/webservices.php?<br>controller=users&<br>action=filterPaged&<br>pager_page=0&<br>pager_quantity=2&<br>status=1&<br>public_key='.base64_encode(CRYPT_VAR_WEB_SERVICE).'&<br>personal_key='.base64_encode($admin_api_token).
		'</a></p></li>';

		$html_main .= '<li><strong>'.$this->_m->getMessageEntites('view_api','api_credentials_10').'</strong> <br><p><a href="'.CONFIG_HOST_NAME_FRONTEND.'api/webservices.php?controller=users&action=detail&id_user=1&public_key='.base64_encode(CRYPT_VAR_WEB_SERVICE).'&personal_key='.base64_encode($admin_api_token).'" target="_blank">'.CONFIG_HOST_NAME_FRONTEND.'api/webservices.php?controller=users&<br>action=detail&<br>id_user=1&<br>public_key='.base64_encode(CRYPT_VAR_WEB_SERVICE).'&<br>personal_key='.base64_encode($admin_api_token).
		'</a></p></li>';

		$html_main .= '<li><strong>'.$this->_m->getMessageEntites('view_api','api_credentials_11').'</strong> <br><p><a href="'.CONFIG_HOST_NAME_FRONTEND.'api/webservices.php?controller=users&action=search&name=Xxxx&public_key='.base64_encode(CRYPT_VAR_WEB_SERVICE).'&personal_key='.base64_encode($admin_api_token).'" target="_blank">'.CONFIG_HOST_NAME_FRONTEND.'api/webservices.php?controller=users&<br>action=search&<br>name=Xxxx&<br>public_key='.base64_encode(CRYPT_VAR_WEB_SERVICE).'&<br>personal_key='.base64_encode($admin_api_token).
		'</a></p></li>';

		$html_main .= '<li><strong>'.$this->_m->getMessageEntites('view_api','api_credentials_12').'</strong> <br><p>'.CONFIG_HOST_NAME_FRONTEND.'api/webservices.php?controller=users&<br>action=talos01&<br>name=Xxxxx&<br>last_name=Xxxxx&<br>public_key='.base64_encode(CRYPT_VAR_WEB_SERVICE).'&<br>personal_key='.base64_encode($admin_api_token).
		'</p></li>';

		$html_main .= '<li><strong>'.$this->_m->getMessageEntites('view_api','api_credentials_13').'</strong> <br><p>'.CONFIG_HOST_NAME_FRONTEND.'api/webservices.php?controller=users&<br>action=talos02&<br>name=Xxxxx&<br>last_name=Xxxxx&<br>public_key='.base64_encode(CRYPT_VAR_WEB_SERVICE).'&<br>personal_key='.base64_encode($admin_api_token).
		'</p></li>';

		$html_main .= '<li><strong>'.$this->_m->getMessageEntites('view_api','api_credentials_14').'</strong> <br><p><a href="'.CONFIG_HOST_NAME_FRONTEND.'api/webservices.php?controller=users&action=talos03&id_user=1&public_key='.base64_encode(CRYPT_VAR_WEB_SERVICE).'&personal_key='.base64_encode($admin_api_token).'" target="_blank">
		'.CONFIG_HOST_NAME_FRONTEND.'api/webservices.php?<br>controller=users&<br>action=talos03&<br>id_user=1&<br>public_key='.base64_encode(CRYPT_VAR_WEB_SERVICE).'&<br>personal_key='.base64_encode($admin_api_token).
		'</a></p></li>';

		$html_main .= '</ul>';
		$html_main .= '</p>';


		$html_main .= '          </div>'."\r";
		$html_main .= '      </div>'."\r";
		$html_main .= ' </div>'."\r";
		$html_main .= '</div>'."\r";
	break;

	case 'errorsList':

	  # Titles {
	  $return_list = '<div class="subrow principal">';
	  $return_list .= '   <div class="strings indice rx1"><h1>File</h1></div>';
	  $return_list .= '   <div class="actions action"></div>';
	  $return_list .= '</div>';
	  # } Titles

	  $color = 1;
	  $indice_interno = 1;
	  $resultErrorsList = array_reverse($resultErrorsList);

	  foreach($resultErrorsList as $value){
		if(!empty($value)){
		  if($value === '.' || $value === '..') {continue;}
		  $file_phisical = dirname(__FILE__) .'/../_lib/handler/log/'.$value;
		  $color_bg = '#ff0000';
		  $color_text = '#ffffff';
		  $flag = 'ERROR';

		  if(is_file($file_phisical)){


			$findme   = 'track';
			$pos = strpos($value, $findme);

			if ($pos === false) {
				$color_bg = '#ff0000';
				$flag = 'ERROR';
			} else {
				$color_bg = '#224abe';
				$flag = 'TRACK';
			}
			$value_name = str_replace('error_','',$value);
			$value_name = str_replace('track_','',$value_name);


			$valor = ($color / 2);
			$colorAplica = is_float($valor) ? '1' : '2';
			$return_list .= '<div class="subrow_'.$indice_interno.'">';
			$return_list .= '   <div class="strings rx1"><h2 style="background-color:'.$color_bg.'; color:'.$color_text.' !important; float: left; padding: 5px 7px; border-radius: 7px; margin: 0 5px 0 0 !important;">'.$flag.'</h2><h2 style="float: left; padding: 5px 7px; border-radius: 7px; margin: 0 !important;"><div class="datacel">File</div>' . $value_name . '</h2></div>';

			$file = CONFIG_HOST_NAME_BACKEND.'_lib/handler/log/'.$value;
			// $return_list .= '      <a href="'.$file.'" target="_blank">' . $value . '</a><br>'."\r";

			$return_list .= '   <div class="actions action">';
			$return_list .= '     <a href="'.$file.'" class="bot_action bot-modal btn-primary fa fa-eye" target="_blank"></a>';
		  	$return_list .= '     <a href="index.php?controller=start&action=errorsFileLittering&file='.$value.'&" class="bot_action btn-primary fa fa-trash-o"></a>';
			$return_list .= '   </div>';
			$return_list .= '</div>';



			$color = $color + 1;
			if($indice_interno == 2){
			  $indice_interno = 1;
			}else{
			  $indice_interno = $indice_interno + 1;
			}
			
		  }
		}
	  }

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
	  $html_main .= '                      <div class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">'.$return_list.'</div>';
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
	break;

	case 'errorsFileLittering':
		header('Location: '.utf8_encode($urlErrorsList).'');
		exit();
	break;

	case 'eraseAllErrors':
		header('Location: '.utf8_encode($urlErrorsList).'');
		exit();
	break;

	case 'eventsList':
		
		$return_list = '<div class="subrow principal">';
		$return_list .= '   <div class="strings indice rx1"><h1>File</h1></div>';
		$return_list .= '   <div class="actions action"></div>';
		$return_list .= '</div>';

		$color = 1;
		$indice_interno = 1;
		foreach($resultEventsList as $value)
		{
		if(!empty($value))
		{
			if($value === '.' || $value === '..')
			{
			continue;
			}
			$file_phisical = dirname(__FILE__) .'/../../material/_events/'.$value;

			if(is_file($file_phisical))
			{
			$valor = ($color / 2);
			$colorAplica = is_float($valor) ? '1' : '2';
			$return_list .= '<div class="subrow_'.$indice_interno.'">';
			$return_list .= '   <div class="strings rx1"><h2><div class="datacel">File</div>' . $value . '</h2></div>';
			$file = CONFIG_HOST_NAME_FRONTEND.'material/_events/'.$value;
			$return_list .= '   <div class="actions action">';
			$return_list .= '     <a href="'.$file.'" class="bot_action bot-modal btn-primary fa fa-eye" target="_blank"></a>';
			$return_list .= '     <a href="index.php?controller=start&action=eventsFileLittering&file='.$value.'&" class="bot_action btn-primary fa fa-trash-o"></a>';
			$return_list .= '   </div>';
			$return_list .= '</div>';
			$color = $color + 1;
			if($indice_interno == 2){
			$indice_interno = 1;
			}else{
			$indice_interno = $indice_interno + 1;
			}
			}
		}
		}
  
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
		$html_main .= '                      <div class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">'.$return_list.'</div>';
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
	break;
  
	case 'eventsFileLittering':
		header('Location: '.utf8_encode($urlEventsList).'');
		exit();
	break;

	case 'eraseAllEvents':
		header('Location: '.utf8_encode($urlEventsList).'');
		exit();
	break;

	default:
		$html_main = ' ';
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
// $temp->setData('/html/body/div/div/div/nav/div/a', 0, $this->_m->getMessageEntites('global','see_site'));
$temp->setData('/html/body/div/div/div/nav/div', 0, $html_global_buttons);
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
