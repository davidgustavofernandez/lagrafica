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
        '201' => '201 [g] Create - Created',
        '202' => '202 [g] Accepted - Accepted',
        '203' => '203 [g] Non-authoritative information (from HTTP / 1.1)',
        '204' => '204 [g] Void - No content',
        '205' => '205 [g] Reload this content - Reload content',
        '206' => '206 [g] Partial Content - Partial Content',
        '206' => '207 [g] Multiple State (Multi-Status, WebDAV)',
        // 3xx: Redirects
        '300' => '300 [g] Multiple options',
        '301' => '304 [g] Moved permanently',
        '302' => '302 [g] Moved temporarily',
        '303' => '303 [g] See another (from HTTP / 1.1)',
        '304' => '304 [g] not modified',
        '305' => '305 [g] Use a proxy (from HTTP / 1.1)',
        '306' => '306 [g] Change proxy',
        '307' => '307 [g] Temporary redirection (from HTTP / 1.1)',
        // 4xx Client errors
        '400' => '400 [g] Bad Request - The action does not exist',
        '403' => '403 [g] Banned - Prohibido',
        '404' => '404 [g] Not found - Does not exist',
        '405' => '405 [g] Method Not Allowed - Method not allowed',
        '406' => '406 [g] Not Acceptable - Not Acceptable',
        '408' => '408 [g] Timeout - Waiting time exhausted',
        // 5xx Server errors
        '500' => '500 [g] Internal Error - Internal error',
        '501' => '501 [g] Not implemented - Not implemented',
        '503' => '503 [g] Service Unavailable - Service not available',
        // Others
        'wellcome' => 'Wellcome',
        'section' => 'Section',
        'see_site' => '<i CLASS="fa fa-globe"></i> See site',
        'see_api' => '<i CLASS="fa fa-globe"></i> See API',
        'permissions_missing' => 'Permissions are missing!',
        'permissions_missing_detail' => 'You do not have the necessary permits to enter the section, contact the administrator.',
        'version' => 'Version',
        'help' => 'Help',
        'help_detail' => 'This version does not contain an a public instruction manual.<br>Contact the programmer or the company that is implementing the Framework.',
        'license' => 'Licence',
        'license_detail_1' => 'License',
        'license_detail_2' => '{SMVC} Simple Model View Controller, can be used in commercial projects and applications with the one-time purchase of a commercial license.<br><br>',
        'license_detail_3' => 'Open source license',
        'license_detail_4' => 'For non-commercial, personal, or open code projects and applications, you can use {SMVC} under the terms of the license <a href="http://choosealicense.com/licenses/gpl-3.0/" target="_blank">GPL v3</a>. You can use {SMVC} Simple Model View Controller for free.<br><br>',
        'license_detail_5' => 'What is commercial considered?',
        'license_detail_6' => 'If you are paid to do your job, and part of your job is Implementing {SMVC}, a commercial license is required.<br><br>To obtain the license contact with David Gustavo Fernandez by email to the address <a href="mailto:fernandezdg@gmail.com?subject=Pedido%20de%20licencia&amp;body=Sr.%20Fernandez.%0D%0A%0D%0AMe%20contacto%20con%20usted%20para%20solicitar%20los%20valores%20de%20licencia%20del%20producto%3a%0D%0A{SP%20MVC}%20V2.1.%0D%0A%0D%0AEl%20uso%20que%20le%20daremos%20es%3a%0D%0A%0D%0ASaludos%20Cordiales." target="_blank">fernandezdg@gmail.com</a>',
      ),
      'controller' => array(
        // 2xx: Correct requests
        '200' => '[c] 200 Ok',
        '201' => '[c] 201 Create - Created',
        '202' => '[c] 202 Accepted - Accepted',
        '204' => '[c] 204 Void - No content',
        '205' => '[c] 205 Reload this content - Reload content',
        '206' => '[c] 206 Partial Content - Partial Content',
        // 4xx Client errors
        '400' => '[c] 400 Bad Request - The action does not exist',
        '403' => '[c] 403 Banned - Prohibited',
        '404' => '[c] 404 Not found - The driver does not exist',
        '405' => '[c] 405 Method Not Allowed - Method not allowed',
        '406' => '[c] 406 Not Acceptable - Not Acceptable',
        '408' => '[c] 408 Timeout - Waiting time exhausted',
        // 5xx Server errors
        '500' => '[c] 500 Internal Error - Internal error',
        '501' => '[c] 501 Not implemented - Not implemented',
        '503' => '[c] 503 Service Unavailable - Service not available'
      ),
      'view' => array(
        // 2xx: Correct requests
        '200' => '[v] 200 Ok',
        '201' => '[v] 201 Create - Created',
        '202' => '[v] 202 Accepted - Accepted',
        '204' => '[v] 204 Void - No content',
        '205' => '[v] 205 Reload this content - Reload content',
        '206' => '[v] 206 Partial Content - Partial Content',
        // 4xx Client errors
        '400' => '[v] 400 Bad Request - The action does not exist',
        '403' => '[v] 403 Banned - Prohibited',
        '404' => '[v] 404 Not found - Does not exist',
        '405' => '[v] 405 Method Not Allowed - Method not allowed',
        '406' => '[v] 406 Not Acceptable - Not Acceptable',
        '408' => '[v] 408 Timeout - Waiting time exhausted',
        // 5xx Server errors
        '500' => '[v] 500 Internal Error - Internal error',
        '501' => '[v] 501 Not implemented - Not implemented',
        '503' => '[v] 503 Service Unavailable - Service not available',
      ),
      'view_dashboard' => array(
        'initial_title' => 'Select a section of the "Managers" menu to edit.',
        'initial_title_detail' => '<h2>Select a section of the "Managers" menu to edit.</h2> <div class = "separador"></div><p>Go to the menu, in the "Admin" section you will find the list of sections that you can manage. <br/> You can also click on the <a data-args="topPanel" data-action="togglePanel" section="skel-panels-include" href="#" style="cursor:pointer; color:#22a1f0;;">user</a> and see its data. <br/> To close session you can go to the section <a data-args="topPanel" data-action="togglePanel" class="skel-panels-include" href="#" style="cursor: pointer;color:#22a1f0;;">user</a> and click on the option <a href="index.php?controller=login&amp;action=distroy" style="color:#22a1f0;;">log out</a>.</p>',
        'dashboard' => 'Dashboard',
        'section' => 'section',
        'content_list' => '<i class="fa fa-list" aria-hidden="true"></i> Content list',
        'content_list_detail' => 'From here you can access the list of contents of the table. You can also edit, delete, change the status and more.',
        'content_list_button' => '<i class="fa fa-list" aria-hidden="true"></i> Listed',
        'create_content' => '<i class="fa fa-plus" aria-hidden="true"></i> Create content',
        'create_content_detail' => 'Enter here to add more content.',
        'create_content_button' => '<i class="fa fa-plus" aria-hidden="true"></i> Create',
        'search_contents' => '<i class="fa fa-search" aria-hidden="true"></i> Search contents',
        'search_contents_detail' => 'Access this section to search for existing content, using filters.',
        'search_contents_button' => '<i class="fa fa-search" aria-hidden="true"></i> Search',
        'list_of_api_methods' => '<i class="fa fa-list" aria-hidden="true"></i> List of API methods',
      ),
      'view_list' => array(
        'data' => 'Data List',
        'no_records' => 'No records',
        'no_records_detail' => 'There is no content yet. You can upload new content by clicking on the Create button.',
      ),
      'view_form' => array(
        'data' => 'Data',
        'cancel' => 'Cancel',
        'save' => 'Save',
        'search' => 'Search',
      ),
      'view_left_nav' => array(
        'dashboard' => '<i class="fa fa-tachometer"></i><span CLASS="nav-label">Dashboard</span>',
        'admin' => '<a HREF="#"><i class="fa fa-diamond"></i><span CLASS="nav-label">Admin</span><span CLASS="fa arrow"></span></a>',
        'list' => '<span CLASS="nav-label">List</span>',
      ),
      'view_navigator' => array(
        'dashboard' => '<i class="fa fa-tachometer"></i> Dashboard</li>',
        'listed' => '<i class="fa fa-list" aria-hidden="true"></i> Listed',
        'create' => '<i class="fa fa-plus" aria-hidden="true"></i> Create</a>',
        'search' => '<i class="fa fa-search" aria-hidden="true"></i> Search',
        'download' => '<i class="fa fa-download" aria-hidden="true"></i> Download</a>',
        'import' => '<i class="fa fa-upload" aria-hidden="true"></i> Import</a>',
        'erase_all_errors' => '<i class="fa fa-trash-o" aria-hidden="true"></i> Erase all Errors</a>',
        'erase_all_events' => '<i class="fa fa-trash-o" aria-hidden="true"></i> Erase all Events</a>',
        'create_json' => '<i class="fa fa-cogs" aria-hidden="true"></i> Create Cars JSON</a>',
        'generate_json' => '<i class="fa fa-cogs" aria-hidden="true"></i> Generate Cars</a>',
        'run_migration' => '<i class="fa fa-cogs" aria-hidden="true"></i> Migrate to SECURE</a>',
        'refresh_json' => '<i class="fa fa-refresh" aria-hidden="true"></i> Refresh Cars</a>',
      ),
      'view_profile_nav' => array(
        'profile' => '<i class="fa fa-user fa-fw"></i> Profile',
        'full_sections' => '<i class="fa fa-gear fa-fw"></i> Full admin sections',
        'reload_database' => '<i class="fa fa-gear fa-fw"></i> Reload Database',
        'data_settings' => '<i class="fa fa-gear fa-fw"></i> Data Settings',
        'initial_memory' => 'Initial memory:',
        'used_memory' => 'Used memory:',
        'processed_in' => 'Processed in:',
        'cache_expire' => 'Expire Session in:',
      ),
      'view_login' => array(
        'wellcome' => 'Wellcome',
        'login' => 'Login',
        'forgot' => 'Forgot your password?',
        'recover' => 'Recover',
        'message' => '<small>{SMVC} Simple Model View Controller</small>',
        'empty_data' => 'Please complete the missing fields',
      ),
      'view_settings' => array(
        'settings' => 'Settings',
        'reload_database' => 'Reload Database',
        'data_settings' => 'Data Settings',
        'message' => '<small>The cache of the database structure was updated successfully</small>',
      ),
      'view_cards' => array(
        'cards' => 'Cards',
        'ready_json' => 'JSON of Cards Created',
        'create_json' => 'Create JSON of Cards',
        'message' => '<small>The data was processed and the JSON was created with the Cards</small>',
      ),
      'view_migates' => array(
        'migrate_log_button' => '<i class="fa fa-list" aria-hidden="true"></i> Migration log',
        'content_list_button' => '<i class="fa fa-list" aria-hidden="true"></i> Listed',
        'migrate_log_production' => '<i class="fa fa-list" aria-hidden="true"></i> Migration log productions',
      ),
      'view_footer' => array(
        'version' => 'Version',
        'help' => 'Help',
        'license' => 'License',
        'credits' => 'Credits',
        'api_credentials' => 'API Credentials',
      ),
      'view_api' => array(
        'api_credentials' => 'API Credentials',
        'api_credentials_1' => 'Below are the credentials to be able to consume the services of the API.<br>',
        'api_credentials_2' => '\'public_Key\' and \'personal_key\' have to be sent encoded in base 64 encode<br><br>',
        'api_credentials_3' => 'List of entities (Controllers) that can be consumed by the API',
        'api_credentials_4' => '<strong>Note:</strong> \'Administrators\' requires special permits.<br><strong>private_Key:</strong> '.CRYPT_VAR_WEB_SERVICE_KEY.'<br><br>',
        'api_credentials_5' => 'Pre-defined methods',
        'api_credentials_6' => '<ul><li>List</li><li>Paged listing</li><li>Detail</li><li>Insert</li><li>To update</li><li>Delete</li></ul>',
        'api_credentials_7' => 'Examples',
        'api_credentials_8' => 'List',
        'api_credentials_9' => 'Paged listing',
        'api_credentials_10' => 'Detail',
        'api_credentials_11' => 'Search',
        'api_credentials_12' => 'Insert',
        'api_credentials_13' => 'Update',
        'api_credentials_14' => 'Delete',
      ),
      'model' => array(
        // 2xx: Correct requests
        '200' => '[m] 200 Ok',
        '201' => '[m] 201 Create - Created',
        '202' => '[m] 202 Accepted - Accepted',
        '204' => '[m] 204 Void - No content',
        '205' => '[m] 205 Reload this content - Reload content',
        '206' => '[m] 206 Partial Content - Partial Content',
        // 4xx Client errors
        '400' => '[m] 400 Bad Request - The action does not exist',
        '403' => '[m] 403 Banned - Forbidden',
        '404' => '[m] 404 Not found - Does not exist',
        '405' => '[m] 405 Method Not Allowed - Method not allowed',
        '406' => '[m] 406 Not Acceptable - Not Acceptable',
        '408' => '[m] 408 Timeout - Waiting time exhausted',
        // 5xx Server errors
        '500' => '[m] 500 Internal Error - Internal error',
        '501' => '[m] 501 Not implemented - Not implemented',
        '503' => '[m] 503 Service Unavailable - Service not available'
      ),
      'installer' => array(
        // 2xx: Correct requests
        '200' => '[i] 200 Ok',
        '201' => '[i] 201 Create - Created',
        '202' => '[i] 202 Accepted - Accepted',
        '204' => '[i] 204 Void - No content',
        '205' => '[i] 205 Reload this content - Reload content',
        '206' => '[i] 206 Partial Content - Partial Content',
        // 4xx Client errors
        '400' => '[i] 400 Bad Request - The action does not exist',
        '403' => '[i] 403 Banned - Prohibited',
        '404' => '[i] 404 Not found - Does not exist',
        '405' => '[i] 405 Method Not Allowed - Method not allowed',
        '406' => '[i] 406 Not Acceptable - Not Acceptable',
        '408' => '[i] 408 Timeout - Waiting time exhausted',
        // 5xx Server errors
        '500' => '[i] 500 Internal Error - Internal error',
        '501' => '[i] 501 Not implemented - Not implemented',
        '503' => '[i] 503 Service Unavailable - Service not available',
        // 6xx Perzonalized errors
        '600' => '[i] 600 missing data',
        '601' => '[i] 601 Missing variable file'
      ),
      'contact_form' => array(
        // 2xx: Correct requests
        '200' => 'The data was processed successfully. ',
        // 4xx Client errors
        '400' => 'There was an error in sending the data. <br> Please try again later. <br> Sorry for the inconvenience. ',
        // 6xx Perzonalized errors
        '600' => 'Corroborate: <br/> The session is not created',
        '601' => 'Corroborate: <br/> The token is not saved in the session',
        '602' => 'Corroborate: <br/> The token does not match the session',
        // 7xx Perzonalized errors
        '700' => 'Corroborate: <br/> Missing TOKEN',
        '701' => 'Corroborate: <br/> Missing Name',
        '702' => 'Corroborate: <br/> Missing Company',
        '703' => 'Corroborate: <br/> Missing Phone',
        '704' => 'Corroborate: <br/> Missing Email',
        '705' => 'Corroborate: <br/> Missing Motive',
        '706' => 'Corroborate: <br/> Missing Message',
        // 7xx Perzonalized errors
        '800' => 'Corroborate: <br/> Province'
      ),
      'login' => array(
       // 1x Customized errors
       '10' => 'Incorrect username or password.',
       // 2xx: Correct requests
       '200' => 'The data was processed successfully. <br> An email has been sent to retrieve the password ',
       '201' => 'Your Password was changed correctly <br> <a href="index.php?controller=login&action=login" target="_self" class="btn btn-wm btn-default"> Login </a> ',
       // 4xx Client errors
       '400' => 'There was an error in sending the data. <br> Please try again later. <br> Sorry for the inconvenience. ',
       // 5xx Server errors
       '500' => 'Account invalidated.',
       '501' => 'Can not find the user <br> <a href="index.php?controller=login&action=login" target="_self"> Login </a>',
       '502' => 'This option was used previously. <br> Please manage a new password. <br> You will receive an email with a valid access. <br> Sorry for the inconvenience. <br> <a href = "index.php? controller = login & action = login" target = "_ self "> Login </a> ',
       // 6xx Perzonalized errors
       '600' => 'Corroborate: <br/> The session is not created',
       '601' => 'Corroborate: <br/> The token is not saved in the session',
       '602' => 'Corroborate: <br/> The token does not match the session',
       // 7xx Perzonalized errors
       '700' => 'Corroborate: <br/> Missing TOKEN',
       '701' => 'Corroborate: <br/> Missing Name',
       '702' => 'Corroborate: <br/> Missing Company',
       '703' => 'Corroborate: <br/> Missing Phone',
       '704' => 'Corroborate: <br/> Missing Email',
       '705' => 'Corroborate: <br/> Missing Motive',
       '706' => 'Corroborate: <br/> Missing Message',
       // 8xx Perzonalized Errors
       '800' => 'Corroborate: <br/> Province'
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