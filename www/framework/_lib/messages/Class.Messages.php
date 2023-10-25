<?php
/**
 * Messages, System messages
 * 
 * The Class Messages Contains the messages that the framework will use
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Messages class,
 * @package {SMVC} Simple Model View Controller
 * @subpackage framework
 */
class Messages{	
  /**
   * Configuration values
   * @access private
   * @var String
   */
  private $_message = '';
  /**
   * Constructor sets up
   * @see __construct()
   */
  public function __construct(){}
  /**
   * setMessage function
   * Note: Function that is responsible for setting $_messages according to a given index
   * @uses $indice_1, String
   * @uses $indice_2, String
   */
  public function setMessage($indice_1, $indice_2){
    $message = array(
      'global' => array(
        // 2xx: Requests correct
        '200' => '200 [g] Ok',
        '201' => '201 [g] Crear - Creado',
        '202' => '202 [g] Aceptado - Aceptado',
        '203' => '203 [g] Información no autorizada (de HTTP / 1.1)',
        '204' => '204 [g] Anulado - Sin contenido',
        '205' => '205 [g] Recargar este contenido - Recargar contenido',
        '206' => '206 [g] Contenido parcial - Contenido parcial',
        '206' => '207 [g] Estado múltiple (estado múltiple, WebDAV)',
        // 3xx: Redirects
        '300' => '300 [g] Múltiples opciones',
        '301' => '304 [g] Movido permanentemente',
        '302' => '302 [g] Movido temporalmente',
        '303' => '303 [g] Ver otro (desde HTTP / 1.1)',
        '304' => '304 [g] no modificado',
        '305' => '305 [g] Usar un proxy (desde HTTP / 1.1)',
        '306' => '306 [g] Cambiar proxy',
        '307' => '307 [g] Redirección temporal (desde HTTP / 1.1)',
        // 4xx Client errors
        '400' => '400 [g] Solicitud incorrecta: la acción no existe',
        '403' => '403 [g] Banneado - Prohibido',
        '404' => '404 [g] No encontrado - No existe',
        '405' => '405 [g] Método no permitido - Método no permitido',
        '406' => '406 [g] No aceptable - No aceptabl',
        '408' => '408 [g] Tiempo de espera: tiempo de espera agotado',
        // 5xx Server errors
        '500' => '500 [g] Error interno - Error interno',
        '501' => '501 [g] No implementado - No implementado',
        '503' => '503 [g] Servicio no disponible - Servicio no disponible',
        // Others
        'wellcome' => 'Benvenido',
        'section' => 'Sección',
        'see_site' => '<i CLASS="fa fa-globe"></i> Ver sitio',
        'see_api' => '<i CLASS="fa fa-globe"></i> Ver API',
        'permissions_missing' => '¡Faltan permisos!',
        'permissions_missing_detail' => 'No tiene los permisos necesarios para ingresar a la sección, contacte al administrador.',
        'version' => 'Versión',
        'help' => 'Ayuda',
        'help_detail' => 'Esta versión no contiene un manual de instrucciones público. <br>Comuníquese con el programador o la compañía que está implementando la herramienta.',
        'license' => 'Licencia',
        'license_detail_1' => 'Licencia',
        'license_detail_2' => '{SMVC} Simple Model View Controller, puede usarse en proyectos comerciales y aplicaciones con la compra de una licencia comercial por única vez.<br><br>',
        'license_detail_3' => 'Licencia de código abierto',
        'license_detail_4' => 'Para proyectos y aplicaciones no comerciales, personales o de código abierto, puede usar {SMVC} bajo los términos de la licencia <a href="http://choosealicense.com/licenses/gpl-3.0/" target="_blank">GPL v3</a>. Puede usar {SMVC} Simple Model View Controller de forma gratuita.<br><br>',
        'license_detail_5' => '¿Qué se considera comercial?',
        'license_detail_6' => 'Si le pagan para hacer su trabajo, y parte de su trabajo es Implementar {SMVC}, se requiere una licencia comercial. <br>Para obtener la licencia, contacte con David Gustavo Fernández por correo electrónico a la dirección <a href="mailto:fernandezdg@gmail.com?subject=Pedido%20de%20licencia&amp;body=Sr.%20Fernandez.%0D%0A%0D%0AMe%20contacto%20con%20usted%20para%20solicitar%20los%20valores%20de%20licencia%20del%20producto%3a%0D%0A{SP%20MVC}%20V2.1.%0D%0A%0D%0AEl%20uso%20que%20le%20daremos%20es%3a%0D%0A%0D%0ASaludos%20Cordiales." target="_blank">fernandezdg@gmail.com</a>',
      ),
      'controller' => array(
        // 2xx: solicitudes correctas
        '200' => '[c] 200 Ok',
        '201' => '[c] 201 Crear - Creado',
        '202' => '[c] 202 Aceptado - Aceptado',
        '204' => '[c] 204 Anulado - Sin contenido',
        '205' => '[c] 205 Recargar este contenido - Recargar contenido',
        '206' => '[c] 206 Contenido parcial - Contenido parcial',
        // Errores del cliente 4xx
        '400' => '[c] 400 Solicitud incorrecta: la acción no existe',
        '403' => '[c] 403 Prohibido - Prohibido',
        '404' => '[c] 404 No encontrado: el controlador no existe',
        '405' => '[c] 405 Método no permitido - Método no permitido',
        '406' => '[c] 406 No aceptable - No aceptable',
        '408' => '[c] 408 Tiempo de espera: tiempo de espera agotado',
        // Errores del servidor 5xx
        '500' => '[c] 500 Error interno - Error interno',
        '501' => '[c] 501 No implementado - No implementado',
        '503' => '[c] 503 Servicio no disponible - Servicio no disponible'
      ),
      'view' => array(
        // 2xx: solicitudes correctas
        '200' => '[v] 200 Ok',
        '201' => '[v] 201 Crear - Creado',
        '202' => '[v] 202 Aceptado - Aceptado',
        '204' => '[v] 204 Anulado - Sin contenido',
        '205' => '[v] 205 Recargar este contenido - Recargar contenido',
        '206' => '[v] 206 Contenido parcial - Contenido parcial',
        // Errores del cliente 4xx
        '400' => '[v] 400 Solicitud incorrecta: la acción no existe',
        '403' => '[v] 403 Prohibido - Prohibido',
        '404' => '[v] 404 No encontrado - No existe',
        '405' => '[v] 405 Método no permitido - Método no permitido',
        '406' => '[v] 406 No aceptable - No aceptable',
        '408' => '[v] 408 Tiempo de espera: tiempo de espera agotado',
        // Errores del servidor 5xx
        '500' => '[v] 500 Error interno - Error interno',
        '501' => '[v] 501 No implementado - No implementado',
        '503' => '[v] 503 Servicio no disponible - Servicio no disponible',
      ),
      'view_dashboard' => array(
        'initial_title' => 'Seleccione una sección del menú para editar.',
        'initial_title_detail' => '<h2>Seleccione una sección del menú para editar.</h2> <div class="separador"></div><p>Vaya al menú, en la sección "Administrador" encontrará la lista de secciones que puede administrar.<br>También puedes hacer clic en elUsuario y ver sus datos.<br>Para cerrar sesión puedes ir a la sección Usaurio y haga clic en la opción <a href="index.php?controller=login&amp;action=distroy" style="color:#22a1f0;;">cerrar sesión</a>.</p>', 'dashboard' => 'Dashboard',
        'section' => 'sección',
        'content_list' => '<i class="fa fa-list" aria-hidden="true"></i> Lista de contenido',
        'content_list_detail' => 'Desde aquí puede acceder a la lista de contenidos de la tabla. También puede editar, eliminar, cambiar el estado y más. ',
        'content_list_button' => '<i class="fa fa-list" aria-hidden="true"></i> Listado',
        'create_content' => '<i class="fa fa-plus" aria-hidden="true"></i> Crear contenido',
        'create_content_detail' => 'Ingrese aquí para agregar más contenido',
        'create_content_button' => '<i class="fa fa-plus" aria-hidden="true"></i> Crear',
        'search_contents' => '<i class="fa fa-search" aria-hidden="true"></i> Buscar contenido',
        'search_contents_detail' => 'Acceda a esta sección para buscar contenido existente, utilizando filtros',
        'search_contents_button' => '<i class="fa fa-search" aria-hidden="true"></i> Buscar',
        'list_of_api_methods' => '<i class="fa fa-list" aria-hidden="true"></i> Lista de métodos API',
      ),
      'view_list' => array(
        'data' => 'Listado',
        'no_records' => 'Sin registros',
        'no_records_detail' => 'Todavía no hay contenido. Puede cargar contenido nuevo haciendo clic en el botón Crear.',
      ),
      'view_form' => array(
        'data' => 'Datos',
        'cancel' => 'Cancelar',
        'save' => 'Guardar',
        'search' => 'Buscar',
      ),
      'view_left_nav' => array(
        'dashboard' => '<i class="fa fa-tachometer"></i><span CLASS="nav-label">Dashboard</span>',
        'admin' => '<a HREF="#"><i class="fa fa-diamond"></i><span CLASS="nav-label">Administrador</span><span CLASS="fa arrow"></span></a>',
        'list' => '<span CLASS="nav-label">Listado</span>',
      ),
      'view_navigator' => array(
        'dashboard' => '<i class="fa fa-tachometer"></i> Dashboard </li>',
        'listed' => '<i class="fa fa-list" aria-hidden="true"></i> Listado',
        'create' => '<i class="fa fa-plus" aria-hidden="true"></i> Crear </a>',
        'search' => '<i class="fa fa-search" aria-hidden="true"></i> Buscar',
        'download' => '<i class="fa fa-download" aria-hidden="true"></i> Descargar </a>',
        'import' => '<i class="fa fa-upload" aria-hidden="true"></i> Importar </a>',
        'erase_all_errors' => '<i class="fa fa-trash-o" aria-hidden="true"></i> Borrar todos los errores </a>',
        'erase_all_events' => '<i class="fa fa-trash-o" aria-hidden="true"></i> Borrar todos los eventos </a>',
        'create_json' => '<i class="fa fa-cogs" aria-hidden="true"></i> Crear autos JSON </a>',
        'generate_json' => '<i class="fa fa-cogs" aria-hidden="true"></i> Generar autos </a>',
        'run_migration' => '<i class="fa fa-cogs" aria-hidden="true"></i> Migrar a SEGURO </a>',
        'refresh_json' => '<i class="fa fa-refresh" aria-hidden="true"></i> Actualizar autos </a>',
        'repository' => '<i class="fa fa-th-list" aria-hidden="true"></i> Reportes Listado </a>',
        'batch' => '<i class="fa fa-gear fa-fw" aria-hidden="true"></i> Crear Reportes</a>',
        'batchDeleteAll' => '<i class="fa fa-trash-o" aria-hidden="true"></i> Borrar Reportes</a>',
      ),
      'view_profile_nav' => array(
        'profile' => '<i class="fa fa-user fa-fw"></i> Perfil',
        'full_sections' => '<i class="fa fa-gear fa-fw"></i> Secciones administrativas completas',
        'reload_database' => '<i class="fa fa-gear fa-fw"></i> Recargar base de datos',
        'data_settings' => '<i class="fa fa-gear fa-fw"></i> Configuración de datos',
        'initial_memory' => 'Memoria inicial:',
        'used_memory' => 'Memoria usada:',
        'processed_in' => 'Procesado en:',
        'cache_expire' => 'La Sesión expira en:',
      ),
      'view_login' => array(
        'wellcome' => 'Bienvenido',
        'login' => 'Iniciar sesión',
        'forgot' => '¿Olvidó su contraseña?',
        'recover' => 'Recuperar',
        'message' => '<small>{SMVC} Simple Model View Controller</small>',
        'empty_data' => 'Complete los campos faltantes',
      ),
      'view_settings' => array(
        'settings' => 'Settings',
        'reload_database' => 'Recargar Base de datos',
        'data_settings' => 'Configuraciones de datos',
        'message' => '<small>El caché de la estructura de la base de datos se actualizó con éxito.</small>',
      ),
      'view_cards' => array(
        'cards' => 'Tarjetas',
        'ready_json' => 'JSON de tarjetas creadas',
        'create_json' => 'Crear JSON de tarjetas',
        'message' => '<small>Los datos se procesaron y el JSON se creó con las Tarjetas.</small>',
      ),
      'view_footer' => array(
        'version' => 'Versión',
        'help' => 'Ayuda',
        'license' => 'Licencia',
        'credits' => 'Credios',
        'api_credentials' => 'API Credenciales',
      ),
      'view_api' => array(
        'api_credentials' => 'Credenciales API',
        'api_credentials_1' => 'A continuación se muestran las credenciales para poder consumir los servicios de la API.<br>',
        'api_credentials_2' => '\'public_Key\' y \'personal_key\' deben enviarse codificadas en codificación base 64 <br> <br>',
        'api_credentials_3' => 'Lista de entidades (Controladores) que la API puede consumir',
        'api_credentials_4' => '<strong> Nota: </strong>\'Administrators\' requiere permisos especiales. <br> <strong> private_Key: </strong>' .CRYPT_VAR_WEB_SERVICE_KEY. '<br> <br>',
        'api_credentials_5' => 'Métodos predefinidos',
        'api_credentials_6' => '<ul><li>Lista</li><li>Listado paginado</li><li>Detalle</li><li>Insertar</li><li>Para actualizar</li><li>Eliminar</li></ul>',
        'api_credentials_7' => 'Ejemplos',
        'api_credentials_8' => 'Lista',
        'api_credentials_9' => 'Listado paginado',
        'api_credentials_10' => 'Detalle',
        'api_credentials_11' => 'Buscar',
        'api_credentials_12' => 'Insertar',
        'api_credentials_13' => 'Actualizar',
        'api_credentials_14' => 'Eliminar',
      ),
      'model' => array(
        // 2xx: Correct requests
        '200' => '[m] 200 Ok',
        '201' => '[m] 201 Crear - Creado',
        '202' => '[m] 202 Aceptado - Aceptado',
        '204' => '[m] 204 Anulado - Sin contenido',
        '205' => '[m] 205 Recargar este contenido - Recargar contenido',
        '206' => '[m] 206 Contenido parcial - Contenido parcial',
        // Errores del cliente 4xx
        '400' => '[m] 400 Solicitud incorrecta: la acción no existe',
        '403' => '[m] 403 Banneado - Prohibido',
        '404' => '[m] 404 No encontrado - No existe',
        '405' => '[m] 405 Método no permitido - Método no permitido',
        '406' => '[m] 406 No aceptable - No aceptable',
        '408' => '[m] 408 Tiempo de espera: tiempo de espera agotado',
        // Errores del servidor 5xx
        '500' => '[m] 500 Error interno - Error interno',
        '501' => '[m] 501 No implementado - No implementado',
        '503' => '[m] 503 Servicio no disponible - Servicio no disponible'
      ),
      'installer' => array(
        // 2xx: solicitudes correctas
        '200' => '[i] 200 Ok',
        '201' => '[i] 201 Crear - Creado',
        '202' => '[i] 202 Aceptado - Aceptado',
        '204' => '[i] 204 Anulado - Sin contenido',
        '205' => '[i] 205 Recargar este contenido - Recargar contenido',
        '206' => '[i] 206 Contenido parcial - Contenido parcial',
        // Errores del cliente 4xx
        '400' => '[i] 400 Solicitud incorrecta: la acción no existe',
        '403' => '[i] 403 Prohibido - Prohibido',
        '404' => '[i] 404 No encontrado - No existe',
        '405' => '[i] 405 Método no permitido - Método no permitido',
        '406' => '[i] 406 No aceptable - No aceptable',
        '408' => '[i] 408 Tiempo de espera: tiempo de espera agotado',
        // Errores del servidor 5xx
        '500' => '[i] 500 Error interno - Error interno',
        '501' => '[i] 501 No implementado - No implementado',
        '503' => '[i] 503 Servicio no disponible - Servicio no disponible',
        // 6xx errores perzonalizados
        '600' => '[i] 600 datos faltantes',
        '601' => '[i] 601 Falta el archivo variable'
      ),
      'contact_form' => array(
        // 2xx: solicitudes correctas
        '200' => 'Los datos se procesaron con éxito. ',
        // Errores del cliente 4xx
        '400' => 'Hubo un error al enviar los datos. <br>Por favor intente nuevamente más tarde. <br>Disculpe las molestias. ',
        // 6xx errores perzonalizados
        '600' => 'Corroborar: <br/>La sesión no se crea',
        '601' => 'Corroborar: <br/>El token no se guarda en la sesión',
        '602' => 'Corroborar: <br/>El token no coincide con la sesión',
        // 7xx errores perzonalizados
        '700' => 'Corroborar: <br/>TOKEN perdido',
        '701' => 'Corroborar: <br/>Nombre perdido',
        '702' => 'Corroborar: <br/>Compañía desaparecida',
        '703' => 'Corroborar: <br/>Teléfono perdido',
        '704' => 'Corroborar: <br/>Correo electrónico faltante',
        '705' => 'Corroborar: <br/>Motivo perdido',
        '706' => 'Corroborar: <br/>Mensaje faltante',
        // 7xx errores perzonalizados
        '800' => 'Corroborar: <br/>Provincia'
      ),
      'login' => array(
        // 1x errores personalizados
        '10' => 'Nombre de usuario o contraseña incorrectos',
        // 2xx: solicitudes correctas
        '200' => 'Los datos se procesaron con éxito. <br>Se ha enviado un correo electrónico para recuperar la contraseña',
        '201' => 'Su contraseña se cambió correctamente <br><a href="index.php?controller=login&action=login" target="_self" class="btn btn-wm btn-default"> Iniciar sesión </a>',
        // Errores del cliente 4xx
        '400' => 'Hubo un error al enviar los datos. <br>Por favor intente nuevamente más tarde. <br>Disculpe las molestias.',
        // Errores del servidor 5xx
        '500' => 'Cuenta invalidada',
        '501' => 'No se puede encontrar al usuario <br><a href="index.php?controller=login&action=login" target="_self">Iniciar sesión</a>',
        '502' => 'Esta opción se utilizó anteriormente. <br>Administre una nueva contraseña. <br>Recibirá un correo electrónico con un acceso válido. <br>Disculpe las molestias. <br><a href="index.php?controller=login&action=login" target="_self">Iniciar sesión</a>',
        // 6xx errores perzonalizados
        '600' => 'Corroborar: <br/> La sesión no se crea',
        '601' => 'Corroborar: <br/> El token no se guarda en la sesión',
        '602' => 'Corroborar: <br/> El token no coincide con la sesión',
        // 7xx errores perzonalizados
        '700' => 'Corroborar: <br/> TOKEN perdido',
        '701' => 'Corroborar: <br/> Nombre perdido',
        '702' => 'Corroborar: <br/> Compañía desaparecida',
        '703' => 'Corroborar: <br/> Teléfono perdido',
        '704' => 'Corroborar: <br/> Correo electrónico faltante',
        '705' => 'Corroborar: <br/> Motivo perdido',
        '706' => 'Corroborar: <br/> Mensaje faltante',
        // 8xx errores perzonalizados
        '800' => 'Corroborar: <br/> Provincia'
      )
    );
    $this->_message = isset($message[$indice_1][$indice_2]) ? $message[$indice_1][$indice_2] : 'Error 1001';
  }
  /**
   * getMessage function
   * Note: Function that is responsible for calling setMessage by passing a value to it and returning the value of $_message
   * @uses $indice_1, String
   * @uses $indice_2, String
   * @return string
   */
  public function getMessage($indice_1, $indice_2){
    $this->setMessage($indice_1, $indice_2);
    return $this->_message;
  }
  /**
   * getPageMessage function
   * Note: Function that is responsible for obtaining the message according to parameters
   * @uses $indice_1, String
   * @uses $indice_2, String
   * @return string
   */
  public function getPageMessage($txt_1='', $indice_1, $indice_2, $txt_2=''){
    $html = utf8_encode($txt_1 . $this->getMessage($indice_1, $indice_2) . $txt_2);
    return $html;
  }
  /**
   * parseTpl function
   * Note: Function that is responsible for displaying the message using a template
   * @uses $filename, String
   * @uses $data, Array
   * @return string
   */
  private function _parseTpl($filename, $data){
    $q = file_get_contents($filename);
    foreach ($data as $key => $value){
      if( is_array($value) ){
        print_r($value);
        die('Corroborar template de datos');
      }
      $q = str_replace('{'.$key.'}', $value, $q);
    }
    return $q;
  }
  /**
   * getMessageEntites function
   * Note: Function that is responsible for calling setMessage by passing a value to it and returning the value of $ _message with HTML entities_message.
   * @uses $indice_1, String
   * @uses $indice_2, String
   * @return string
   */
  public function getMessageEntites($indice_1, $indice_2){
    $this->setMessage($indice_1, $indice_2);
    //return htmlentities($this->_message);
    return $this->_message;
  }
  /**
   * Destroyer erases the object when it is no longer used
   * @see __destruct()
   */
  public function __destruct(){
    //unset($this); // Deprecate
  }
}
?>