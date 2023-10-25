<?php
/**
  * startController, Controller
  *
  * The Class startController is the controller in charge of processing and processing the startup or dashboard requests.
  * Is responsible for instantiating the model and the view, (exception of the Scaffolding model)
  * @author David Fernandez <fernandezdg@gmail.com>
  * @version 1.02 (10/05/2010 - 26/09/2019)
  * @package {SMVC} Simple Model View Controller
  * @subpackage Controller
  */
class startController{
# THIS ALWAYS GOES {
    /**
     * $_c, instance of Configurations
     * @access private
     * @var string
     */
    private $_c;
    /**
     * $_m, instance of Messages
     * @access private
     * @var string
     */
    private $_m;
    /**
     * $_controller, will be the name of the controller to apply
     * @access private
     * @var string
     */
    private $_controller = '';
    /**
     * $_action, will be the name of the method or action to apply
     * @access private
     * @var string
     */
    private $_action = '';
    /**
     * $_model, will be the MODEL instance
     * @access private
     * @var object
     */
    private $_model;
    /**
     * $_rules, will be the set of rules to apply when a KEY is foreign
     * @access private
     * @var string
     */
    private $_rules;
    /**
     * $_rules_instructions, when a KEY is foreign, it arranges the parameterized queries to apply for the realizations between tables
     * @access private
     * @var string
     */
    private $_rules_instructions = array();
    /**
     * $_p, instance of Propagate
     * @access private
     * @var string
     */
    private $_p;
    /**
     * $_f, instance of Functions
     * @access private
     * @var string
     */
    private $_f;
    /**
     * $_database, will be the name of the database to be used
     * @access private
     * @var string
     */
    private $_database = '';
    /**
     * $_prefix, it will be the name of the prefix of the table (if it has one)
     * @access private
     * @var string
     */
    private $_prefix = '';
    /**
     * $_table, will be the name of the table to be used (the name will be the name of the controller)
     * @access private
     * @var string
     */
    private $_table = '';
    /**
     * $_key, Primary KEY of the row in a table
     * @access private
     * @var number
     */
    private $_key = '';
    /**
     * $_field_applied, are the fields of a table that will be used (It is configured)
     * @access private
     * @var number
     */
    private $_field_applied = '';
    /**
     * $_fields, existing fields in a table (automatic)
     * @access private
     * @var array
     */
    private $_fields = array();
    /**
     * $_fields_show, fields to be displayed in lists and forms (It is configured)
     * @access private
     * @var array
     */
    private $_fields_show = array();
    /**
     * $_fields_relation, will be the set of fields in a table that have a relation with another table (KEY FORANEO)
     * @access private
     * @var array
     */
    private $_fields_relation = array();
    /**
     * $_estructuraBbdd, content structure of the Database with all its tables and rules. Method getStructureDatabase() of the model.
     * @access private
     * @var object
     */
    private $_estructuraBbdd = '';
    /**
     * $_pager, indicates whether the query will be paged and will contain pager
     * @access private
     * @var boolean
     */
    private $_pager = false;
    /**
     * $_pager_page, current page number
     * @access private
     * @var number
     */
    private $_pager_page = 0;
    /**
     * $_pager_quantity, number of records per page
     * @access private
     * @var number
     */
    private $_pager_quantity = 10;
    /**
     * $_posted, instance of the Upload class. Try uploading the files
     * @access private
     * @var object
     */
    private $_posted = '';
    /**
     * $_files_path_host, path to files
     * @access private
     * @var string
     */
    private $_files_path_host = '';
    /**
     * $_files_path_physical, physical path to the files
     * @access private
     * @var string
     */
    private $_files_path_physical = '';
    /**
     * $_status, state of a record in a table (logical deletion applies)
     * @access private
     * @var string
     */
    private $_status = 'status';
    /**
     * $_order, field to apply order in a record of a table
     * @access private
     * @var string
     */
    private $_order = 'field_order';
    /**
     * $_sort, order to apply in the consultations (ASC - DESC)
     * @access private
     * @var string
     */
    private $_sort = 'ASC';

    /**
     * $_ses, instance of the AppSessions class. Tarata the data saved in the session
     * @access private
     * @var object
     */
    private $_ses = '';
    /**
     * $_data_admin, user administrator data in the session
     * @access private
     * @var array
     */
    private $_data_admin = '';
    /**
     * $_data_admin_permissions, permissions of the administrator user, recovered from the session, in relation to the controllers
     * @access private
     * @var array
     */
    private $_data_admin_permissions = '';
    /**
     * $_crypter, instance of the Crypt class. Used to store and retrieve the data of the session in an "encrypted" way
     * @access private
     * @var object
     */
    private $_crypter;
    /**
     * $_search_on, Matrix with fields where the search is applied
     * @access private
     * @var array
     */
    private $_search_on = array();
    /**
     * $_search_off, Array with fields to return
     * @access private
     * @var array
     */
    private $_search_off = array();
    /**
     * $_search_filters, Array of fields and value, to be applied
     * @access private
     * @var array
     */
    private $_search_filters = array();
    /**
     * $_params_filter, Array with fields to be omitted in the insert
     * @access private
     * @var array
     */
    private $_params_filter = array();
    /**
     * __construct function
     * @see __construct()
     * Note: Constructor
     */
    function __construct(){}
    /**
     * setConfigurations public function
     * @uses setConfigurations(), Class
     * @uses $this->_c, Instance
     * Note: Set list of supported file extensions to upload and download into the system
     */
    public function setConfigurations($c){
        $this->_c = $c;
    }
    /**
     * setMessages public function
     * @uses setMessages(), Class
     * @uses $this->_m, Instance
     * Note: Set global messages
     */
    public function setMessages($m){
        $this->_m = $m;
    }
    /**
     * setPropagate public function
     * @uses AppSessions(), Class
     * @uses $this->_p, Instance
     * Note: Set the propagate instance
     */
    public function setPropagate($p){
        $this->_p = $p;
    }
    /**
     * setFunctions public function
     * @uses AppSessions(), Class
     * @uses $this->_f, Instance
     * Note: Set the instance Functions
     */
    public function setFunctions($f){
        $this->_f = $f;
    }
    /**
     * setSessions public function
     * @uses AppSessions(), Class
     * @uses $this->_ses->setControlador(), Method
     * @uses $this->_ses->setSessionControl(), Method
     * @uses $this->_ses->setSessionValidateController(), Method
     * @uses $this->_ses->getSessionVariableArray(), Method
     * @uses dirname, Function
     * @uses $this->_controller, String
     * Note: It treats the sessions, it propagates and it has the data of the user administrator in memory with its set of permissions
     */
    public function setSessions(){
        require_once( dirname(__FILE__) . '/APP.Sessions.php');
        $this->_ses = new AppSessions();
        $this->_ses->setControlador(str_replace('Controller','',$this->_controller));
        $this->_ses->setSessionControl();
        $this->_ses->setSessionValidateController();
        $this->_data_admin = $this->_ses->getSessionVariableArray('admin_data',true);
        $this->_data_admin_permissions = $this->_ses->getSessionVariableArray('admin_permissions',true);
    }
    /**
     * setFilesPath public function
     * @uses dirname(), Function
     * @uses CONFIG_HOST_NAME_FRONTEND, Constant
     * @uses $this->_table, String
     * @uses $path, String
     * Note: Set the paths of the images
     */
    public function setFilesPath($path=''){
        $directory = dirname(__FILE__) . '/../material/'.$this->_table.'/';
        $this->_files_path_physical = empty($path) ? $directory : $path;
        $this->_files_path_host = CONFIG_HOST_NAME_FRONTEND.'material/'.$this->_table.'/';
    }
    /**
     * setAction public function
     * @uses $action, String
     * Note: Set the method or action to apply
     */
    public function setAction($action){
        $this->_action = $action;
    }
    /**
     * setPrefix public function
     * @uses $prefix, String
     * Note: Set the prefix of the table
     */
    public function setPrefix($prefix){
        $this->_prefix = $prefix;
    }
    /**
     * setDatabase public function
     * @uses $database, String
     * Note: Set the name of database to use
     */
    public function setDatabase($database){
        $this->_database = $database;
    }
    /**
     * setSearchOn public function
     * @uses $search_on, String
     * Note: Matrix with fields where the search is applied
     */
    public function setSearchOn($search_on){
        $this->_search_on = $search_on;
    }
    /**
     * setSearchOff public function
     * @uses $search_on, String
     * Note: Array with fields to return
     */
    public function setSearchOff($search_off){
        $this->_search_off = $search_off;
    }
    /**
     * setSearchFilters public function
     * @uses $search_filters, String
     * Note: Array of fields and value, to be applied 
     */
    public function setSearchFilters($search_filters){
        $this->_search_filters = $search_filters;
    }
    /**
     * setParamFilter public function
     * @uses $params_filter, String
     * Note: Array with fields that will be excluded when inserting
     */
    public function setParamFilter($params_filter){
        $this->_params_filter = $params_filter;
    }
    /**
     * setController public function
     * @uses $controller, String
     * @uses $this->setSessions(), Function
     * @uses $this->setFilesPath(), Function
     * @uses $this->getModel(), Function
     * @uses $this->getUpload(), Function
     * @uses $this->getRules(), Function
     * Note: Set the controller to apply, instantiate the path of the records, the model, file upload and rules
     */
    public function setController($controller){
        $this->_table = $controller;
        $this->_controller = $controller;
        $this->setSessions();
        $this->setFilesPath();
        $this->getModel();
        $this->getUpload();
    }
    /**
     * setPagerPage public function
     * @uses $pager_page, String
     * Note: Apply the page of the pager
     */
    public function setPagerPage($pager_page){
        $this->_pager_page = (int) $pager_page;
    }
    /**
     * setOrder public function
     * @uses $order, String
     * Note: Indicate what the field to take into account to apply the "ORDER BY" in the query
     */
    public function setOrder($order){
        $this->_order = $order;
    }
    /**
     * setSort public function
     * @uses $sort, String
     * Note: Indicates the type of order to be applied ASC / DESC
     */
    public function setSort($sort){
        $this->_sort = $sort;
    }
    /**
     * getModel public function
     * @uses dirname(), Function
     * @uses file_exists(), Function
     * @uses trigger_error(), Function
     * @uses FOLDER_MODEL, Constant
     * @uses AppBaseModel(), Class
     * @uses getStructureDatabase(), Method
     * Note: Instance the Model
     */
    public function getModel(){
        $path = dirname(__FILE__) . '/../'.FOLDER_MODEL.'startModel.php';

        if (file_exists($path) == false){
            trigger_error ('Model `' . $path . '` does not exist.', E_USER_NOTICE);
            return false;
        }

        require_once($path);
        $this->_model = new startModel();
        $this->_estructuraBbdd = $this->_model->getStructureDatabase();
    }
    /**
     * getView public function
     * @uses dirname(), Function
     * @uses file_exists(), Function
     * @uses trigger_error(), Function
     * @uses FOLDER_VIEW, Constant
     * Note: Includes the View
     */
    public function getView(){
        $path = dirname(__FILE__) . '/../'.FOLDER_VIEW.'startView.php';

        if (file_exists($path) == false){
            trigger_error ('View `' . $path . '` does not exist.', E_USER_NOTICE);
            return false;
        }
        return $path;
    }
    /**
     * getUpload public function
     * @uses $_POST(), Array
     * @uses dirname(), Function
     * @uses Upload(), Class
     * Note: Upload Instance (treats uploads of files)
     */
    public function getUpload(){
        if($_POST){
            $path = dirname(__FILE__) . '/../_lib/upload/Class.Upload.php';
            require_once($path);
            $this->_posted = new Upload();
            # Fields Name Secure
            $this->_posted->setFilesNamesSecure(FILES_NAMES_SECURE);
            # Fields Quality
            $this->_posted->setFilesQuality(FILES_QUALITY);
        }
    }
    /**
     * setPager public function
     * @uses valor, Variable
     * Note: setPager, indicates if pager applies
     */
    public function setPager($valor=false){
        $this->_pager = $valor;
    }
# } THIS ALWAYS GOES
    /**
      * List of available ACTIONS
      * Note: Each action as controller has its equivalent as model (model) and view (view)
      * The controller is in charge of receiving the interactions, processing them and arranging them for the model and then calls the view, each controller implements its correlation with the MODEL and its VISTA. A controller can dispense with the model but not with his view. Each controller has its equilibrium in the DB to respond to the Scaffolding system, but it may not have equibalence such as: start, login (This is configured in the config class in the setExceptionsApi () method)
      * /
    /**
     * index public function
     * @uses $this->_action, Variable
     * @uses $this->getView(), Method, Apply the view
     * Note: index, initial method for each controller.
     */
    public function index(){
        $table_name = 'Start';
        $action = $this->_action;
        require_once($this->getView());
    }
    public function detalle(){
        $table_name = 'Start';
        $action = $this->_action;
        require_once($this->getView());
    }
    public function listed(){
        $table_name = 'Start';
        $action = $this->_action;
        require_once($this->getView());
    }
    public function seccionesfull(){
        $table_name = 'Start';
        $action = $this->_action;
        require_once($this->getView());
    }
    public function filter(){
        $table_name = 'Start';
        $action = $this->_action;
        require_once($this->getView());
    }
    public function filterProcess(){
        $table_name = 'Start';
        $action = $this->_action;
        require_once($this->getView());
    }
    public function create(){
        $table_name = 'Start';
        $action = $this->_action;
        require_once($this->getView());
    }
    public function version(){
        $table_name = 'Start';
        $action = $this->_action;
        require_once($this->getView());
    }
    public function help(){
        $table_name = 'Start';
        $action = $this->_action;
        require_once($this->getView());
    }
    public function license(){
        $table_name = 'Start';
        $action = $this->_action;
        require_once($this->getView());
    }
    public function credits(){
        $table_name = 'Start';
        $action = $this->_action;
        require_once($this->getView());
    }
    public function withoutPermissions(){
        $table_name = 'Start';
        $action = $this->_action;
        require_once($this->getView());
    }
    public function menu(){
        $resultSelect = $this->_model->getStructureDatabase();
        $action = $this->_action;
    }
    public function api_credentials(){
        $table_name = 'Start';
        $action = $this->_action;
        require_once($this->getView());
    }

    # Errors log
    public function errorsList(){
        $table_name = 'Start';
        $resultErrorsList = $this->_model->getErrorsList();
        $action = $this->_action;
        require_once($this->getView());
    }
    public function errorsFileLittering(){
        if(!empty($_GET['file'])){
          $file = $this->_p->spread('get','file','');
        }
        if(!empty($_POST['file'])){
          $file = $this->_p->spread('post','file','');
        }
        if(!empty($_REQUEST['file'])){
          $file = $this->_p->spread('request','file','');
        }
        if(!empty($file)){
          $resultErrorsFileDelete = $this->_model->getErrorsFileLittering($file);
        }else{
          $resultErrorsFileDelete = false;
        }
        $table_name = 'Start';
        $action = $this->_action;
        require_once($this->getView());
    }
    public function eraseAllErrors(){
        $resultEraseAllErrors = $this->_model->getEraseAllErrors();
        $table_name = 'Start';
        $action = $this->_action;
        require_once($this->getView());
    }


    public function set_menu(){
      $menu_state = 1;
      if(!empty($_GET['m'])){
        $menu_state = $this->_p->spread('get','m',0);
      }
      if(!empty($_POST['m'])){
        $menu_state = $this->_p->spread('post','m',0);
      }
      if(!empty($_REQUEST['m'])){
        $menu_state = $this->_p->spread('request','m',0);
      }
      $table_name = 'Start';
      $result = $this->_model->setMenu($menu_state);
      $action = $this->_action;
      require_once($this->getView());
    }

    # Events log
    public function eventsList(){
        $table_name = 'Start';
        $resultEventsList = $this->_model->getEventsList();
        $action = $this->_action;
        require_once($this->getView());
    }
    public function eventsFileLittering(){
        if(!empty($_GET['file'])){
          $file = $this->_p->spread('get','file','');
        }
        if(!empty($_POST['file'])){
          $file = $this->_p->spread('post','file','');
        }
        if(!empty($_REQUEST['file'])){
          $file = $this->_p->spread('request','file','');
        }
        if(!empty($file)){
          $resultEventsFileDelete = $this->_model->getEventsFileLittering($file);
        }else{
          $resultEventsFileDelete = false;
        }
        $table_name = 'Start';
        $action = $this->_action;
        require_once($this->getView());
    }
    public function eraseAllEvents(){
        $resultEraseAllEvents = $this->_model->getEraseAllEvents();
        $table_name = 'Start';
        $action = $this->_action;
        require_once($this->getView());
    }
    
    /**
     * __destruct public function
     * Note: Clears the object when it is no longer used
     * @see __destruct()
     */
    public function __destruct(){
        //unset($this);
    }
}
?>