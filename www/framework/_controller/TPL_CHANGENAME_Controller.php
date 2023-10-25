<?php
/**
 * tareas_Controller, Controller "base"
 * 
 * The Class tareas_Controller is the "base" controller responsible for processing the requests.
 * Instance the model and the view.
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.02 (10/05/2010 - 26/09/2019)
 * @package {SMVC} Simple Model View Controller
 * @subpackage Controller
 */
class tareas_Controller{
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
     * $_save_data_on_file, determines if the data will be saved in a physical file, is indicated in the comments of the table
     * @access private
     * @var array
     */
    private $_save_data_on_file = false;
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
        $directory = dirname(__FILE__) . '/../../material/'.$this->_table.'/';
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
        $this->_model->setPropagate($this->_p);
        $this->getUpload();
        //$this->_controller = $controller;
        $this->getRules();

        if($this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_rules']===true){
            $this->_model->setRules($this->_rules_instructions);
        }

        if($this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_save_data_on_file']===true){
            $this->_save_data_on_file = true;
        }
    }
    /**
     * setPager public function
     * @uses valor, Variable
     * Note: setPager, indicates if pager applies
     */
    public function setPager($pager=false){
        $this->_pager = $pager;
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
        $path = dirname(__FILE__) . '/../'.FOLDER_MODEL.'tareas_Model.php';

        if (file_exists($path) == false) {
            trigger_error ('Model `' . $path . '` does not exist.', E_USER_NOTICE);
            return false;
        }

        require_once($path);
        $this->_model = new tareas_Model();
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
        $path = dirname(__FILE__) . '/../'.FOLDER_VIEW.'tareas_View.php';

        if (file_exists($path) == false) {
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
     * getRules public function
     * @uses dirname(), Function
     * @uses file_exists(), Function
     * @uses FOLDER_MODEL, Constant
     * @uses $this->_controller, String
     * @uses Rules(), Class
     * @uses $this->setPrefix(), Method
     * @uses $this->getRules(), Method
     * Note: Instance the rules to apply in case the data is a foreign KEY having prepared queries, queries related to its controller.
     */
    public function getRules(){
        $path = dirname(__FILE__) . '/../'.FOLDER_MODEL.'_rules/'.$this->_controller.'.php';

        if (file_exists($path) == false) {
            return false;
        }else{
            require_once($path);
            $this->_rules = new Rules();
            $this->_rules->setPrefix($this->_prefix);
            $this->_rules_instructions = $this->_rules->getRules();
        }
    }
    /**
     * getCrypter public function
     * @uses dirname(), Function
     * @uses Crypt(), Class
     * Note: Instance of Crypt, class that handles the encryption of the values saved in session
     */
    public function getCrypter(){
        $path = dirname(__FILE__) . '/../_lib/crypt/Class.Crypt.php';
        require_once($path);
        $this->_crypter = new Crypt();
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
        $this->setPager(true);
        $setCamposRules = array(
            'TYPE' => array(array('LIST' => true,'FORM' => false)),
            'METHOD' => array(array('GET' => false,'POST' => false,'REQUEST' => false,'FILES' => false)),
            'ONLYKEY' => false
        );
        $this->_setCampos($setCamposRules);
        $this->_model->setKey($this->_key);
        $this->_model->setStatus($this->_status);
        $this->_model->setTable($this->_prefix.$this->_table);
        $this->_model->setFields($this->_fields);

        $table_name = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_alternatename'];
        $table_save_data_on_file = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_save_data_on_file'];
        $table_rules = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_rules'];
        $table_fields = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'];
        $action = $this->_action;
        require_once($this->getView());
    }
    /**
     * listed public function
     * @uses $this->setPager(), Method, implements pager
     * @uses $this->_setCampos(), generates an array with the fields to be used, and leaves them in memory
     * @uses $this->_model->setTable(), Method, tells the model which table of the DB will use
     * @uses $this->_model->setFields(), Method, tells the model fields to be treated
     * @uses $this->_model->setKey(), Method, tells the model which is the field of type UNICO (PRI) will be the unicId
     * @uses $this->_model->setStatus(), Method, tells the model which state (logical) to apply when interacting with the DB
     * @uses $this->_model->setOrder(), Method, tells the model if the record order 'logical' applies the table must have an order field
     * @uses $this->_model->setSort(), Method, tells the model in which order the list of records should be debugged}
     * @uses $this->_model->getRecordsPaged(), Method, tells the model which method to apply
     * @uses $this->_structureBbdd, Array, It is an associative matrix that contains the structure of the database and the meta data to apply in each controller, action and view
     * @uses $this->getView(), Method, Apply the view
     * Note: list, it deals with a list of recordsets
     */
    public function listed(){
        $this->setPager(true);
        $setCamposRules = array(
            'TYPE' => array(array('LIST' => true,'FORM' => false)),
            'METHOD' => array(array('GET' => false,'POST' => false,'REQUEST' => false,'FILES' => false)),
            'ONLYKEY' => false
        );
        $this->_setCampos($setCamposRules);
        $this->_model->setTable($this->_prefix.$this->_table);		
        $this->_model->setFields($this->_fields);
        $this->_model->setKey($this->_key);
        $this->_model->setStatus($this->_status);
        $this->_model->setOrder($this->_order);
        $this->_model->setSort($this->_sort);
        // We ask if we apply paging
        if($this->_pager==true){
            /*$pagerActive = true;
            $pagerQuantity = $this->_pager_quantity;
            $pagerPage = $this->_pager_page;*/
            $this->_model->setPager(true);
            $this->_model->setPagerQuantity($this->_pager_quantity);
            $this->_model->setPagerPage($this->_pager_page);
        }
        // We ask the model for all the items
        $resultSelect = $this->_model->getRecordsPaged();
        $table_name = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_alternatename'];
        // $table_show_in_list = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_showinlist'];
        // $table_show_in_form = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_showinform'];
        $table_save_data_on_file = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_save_data_on_file'];
        $table_rules = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_rules'];
        $table_fields = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'];
        
        $action = $this->_action;
        require_once($this->getView());
    }
    /**
     * activate public function
     * @uses $this->_setCampos(), Method, generates an array with the fields to be used, and leaves them in memory
     * @uses $this->_model->setKey(), Method, tells the model which is the field of type UNICO (PRI) will be the unicId
     * @uses $this->_model->setStatus(), Method, tells the model which state (logical) to apply when interacting with the DB
     * @uses $this->_model->setTable(), Method, tells the model which table of the DB will use
     * @uses $this->_model->setFields(), Method, tells the model fields to be treated
     * @uses $this->_model->setFieldApplied(), Method, tells you the field to apply the functionality
     * @uses $this->_model->getActivate(), Method, tells the model which method to apply
     * @uses $this->getView(), Method, Apply the view
     * Note: activate, change the status (logical) from active to inactive and vice versa from a record
     */
    public function activate()
    {
        $setCamposRules = array(
            'TYPE' => array(array('LIST' => true,'FORM' => false)),
            'METHOD' => array(array('GET' => false,'POST' => false,'REQUEST' => false,'FILES' => false)),
            'ONLYKEY' => false
        );
        
        $this->_setCampos($setCamposRules);
        $this->_model->setTable($this->_prefix.$this->_table);
        $this->_model->setKey($this->_key);
        $this->_model->setStatus($this->_status);
        $this->_model->setTable($this->_prefix.$this->_table);
        $this->_model->setFields($this->_fields);
        $this->_model->setFieldApplied($this->_status);
        $this->_model->setSaveOnFile($this->_save_data_on_file);

        $resultActivate = $this->_model->getActivate();
        
        if($this->_save_data_on_file==true){
            $this->_model->getMakeFile();
        }

        $table_name = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_alternatename'];
        $table_save_data_on_file = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_save_data_on_file'];
        $table_rules = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_rules'];
        $table_fields = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'];

        $action = $this->_action;
        require_once($this->getView());
    }
    /**
     * edit public function
     * @uses $this->_setCampos(), Method, generates an array with the fields to be used, and leaves them in memory
     * @uses $this->_model->setKey(), Method, tells the model which is the field of type UNICO (PRI) will be the unicId
     * @uses $this->_model->setStatus(), Method, tells the model which state (logical) to apply when interacting with the DB
     * @uses $this->_model->setTable(), Method, tells the model which table of the DB will use
     * @uses $this->_model->setFields(), Method, tells the model fields to be treated
     * @uses $this->_model->getEdit(), Method, tells the model which method to apply
     * @uses $this->getView(), Method, Apply the view
     * @uses $this->_structureBbdd, Array, It is an associative matrix that contains the structure of the database and the meta data to apply in each controller, action and view
     * Note: edit, generate the form to be able to modify the data
     */
    public function edit(){
        $setCamposRules = array(
            'TYPE' => array(array('LIST' => true,'FORM' => false)),
            'METHOD' => array(array('GET' => false,'POST' => false,'REQUEST' => false,'FILES' => false)),
            'ONLYKEY' => false
        );
        $this->_setCampos($setCamposRules);
        $this->_model->setKey($this->_key);
        $this->_model->setStatus($this->_status);
        $this->_model->setTable($this->_prefix.$this->_table);
        $this->_model->setFields($this->_fields);
        $this->_model->setSaveOnFile($this->_save_data_on_file);

        $resultEdit = $this->_model->getEdit();

        $table_name = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_alternatename'];
        // $table_show_in_list = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_showinlist'];
        // $table_show_in_form = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_showinform'];
        $table_save_data_on_file = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_save_data_on_file'];
        $table_rules = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_rules'];
        $table_fields = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'];

        $action = $this->_action;
        require_once($this->getView());
    }
    /**
     * create public function
     * @uses $this->_setOnlyKey(), Method, generates an array with the primary (PRI) and foreign (MUL) fields
     * @uses $this->_structureBbdd, Array, It is an associative matrix that contains the structure of the database and the meta data to apply in each controller, action and view
     * @uses $this->getView(), Method, Apply the view
     * Note: create, generate the form to create a new recordset
     */
    public function create(){
        $setCamposRules = array(
            'TYPE' => '',
            'METHOD' => '',
            'ONLYKEY' => true
        );
        $this->_setCampos($setCamposRules);
        $table_name = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_alternatename'];
        // $table_show_in_list = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_showinlist'];
        // $table_show_in_form = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_showinform'];
        $table_save_data_on_file = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_save_data_on_file'];
        $table_rules = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_rules'];
        $table_fields = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'];

        $action = $this->_action;
        require_once($this->getView());
    }
    /**
     * public function searcher
     * @uses $this->_setOnlyKey(), Method, generates an array with the primary (PRI) and foreign (MUL) fields
     * @uses $this->_structureBbdd, Array, It is an associative matrix that contains the structure of the database and the meta data to apply in each controller, action and view
     * @uses $this->getView(), Method, Apply the view
     * Note: search engine, generates the form to apply a search
     */
    public function search(){
        $setCamposRules = array('TYPE' => '','METHOD' => '','ONLYKEY' => true);
        
        $this->_setCampos($setCamposRules);
        $table_name = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_alternatename'];
        // $table_show_in_list = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_showinlist'];
        // $table_show_in_form = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_showinform'];
        $table_save_data_on_file = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_save_data_on_file'];
        $table_rules = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_rules'];
        $table_fields = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'];

        $action = $this->_action;
        require_once($this->getView());
    }
    /**
     * talos01 public function
     * @uses $this->_setTodosCampos(), Method, generates an array with ALL the fields that are going to be used, and leaves them in memory
     * @uses $this->_setOnlyKey(), Method, generates an array with the primary (PRI) and foreign (MUL) fields
     * @uses $this->_model->setKey(), Method, tells the model which is the field of type UNICO (PRI) will be the unicId
     * @uses $this->_model->setTable(), Method, tells the model which table of the DB will use
     * @uses $this->_model->setFields(), Method, tells the model fields to be treated
     * @uses $this->_model->getTalos01(), Method, tells the model which method to apply
     * @uses $this->getView(), Method, Apply the view
     * Note: insert, receive and process the input of the create method
     */
    public function talos01(){
        $crypt_text = $this->_table=='users' ? CRYPT_VAR_USERS : CRYPT_VAR;

        # Aplicamos spread()
        if(!empty($_GET['password'])){ 
            $this->getCrypter();
            $this->_crypter->setKey($crypt_text);
            $inCrypter = $this->_crypter->getEncrypt($this->_p->spread('get','password',''));
            $_GET['password'] = $inCrypter; 
        }
        if(!empty($_POST['password'])){
            $this->getCrypter();
            $this->_crypter->setKey($crypt_text);
            $inCrypter = $this->_crypter->getEncrypt($this->_p->spread('post','password',''));
            $_POST['password'] = $inCrypter; 
        }
        if(!empty($_REQUEST['password'])){ 
            $this->getCrypter();
            $this->_crypter->setKey($crypt_text);
            $inCrypter = $this->_crypter->getEncrypt($this->_p->spread('request','password',''));
            $_REQUEST['password'] = $inCrypter; 
        }
        
        $setCamposRules = array(
            'TYPE' => '',
            'METHOD' => array(array('GET' => false,'POST' => true,'REQUEST' => false,'FILES' => true)),
            'ONLYKEY' => true
        );
        $this->_setCampos($setCamposRules);
        $this->_model->setKey($this->_key);
        $this->_model->setTable($this->_prefix.$this->_table);
        $this->_model->setFields($this->_fields);
        $this->_model->setSaveOnFile($this->_save_data_on_file);

        $resultInsertar = $this->_model->getTalos01();
        /**
         * File upload
         * @uses $this->setTable(), Table to apply
         * @uses $this->setFields(), Fields
         * @uses $this->setKey(), Result of insert
         * @uses $this->setPryKey(), Primary Key
         * @uses $this->setFiles(), Fields to be treated
         * @uses $this->setPosteos(), Method to listen and treat
         * @uses $this->setFolderDestino(), physical URLs
         * @uses $this->setExtSubsired(), Permitted extensions
         * @uses $this->setUpload(), Method set the UPLOAD
         * @uses $this->getUploadDelete(), Method that relieves if you are instructed to delete a pre-existing file
         * @uses $this->getUpload(), Method to apply the UPLOAD
         */
        if(!empty($resultInsertar)){
            # Table
            $this->_posted->setTable($this->_prefix.$this->_table);
            # Fields
            $this->_posted->setFields($this->_fields);
            # Result of insert
            $this->_posted->setKey($resultInsertar);
            # Primary Key
            $this->_posted->setPryKey($this->_key); 
            # Files
            $this->_posted->setFiles($_FILES);
            # Set POST
            $this->_posted->setPosteos($_POST);
            # Physical URLs
            $this->_posted->setFolderDestino(array($this->_files_path_physical, $this->_files_path_physical, $this->_files_path_physical, $this->_files_path_physical, $this->_files_path_physical, $this->_files_path_physical, $this->_files_path_physical, $this->_files_path_physical, $this->_files_path_physical));
            # Allowed extensions
            $this->_posted->setExtPermitidas($this->_c->getExtensionsAvailable());
            # Set the UPLOAD FILES
            $this->_posted->setUpload();
            # Instruction to delete a pre-existing file
            $return_upload_delete = $this->_posted->getUploadDelete();
            # Method to apply the UPLOAD FILES
            $return_upload = $this->_posted->getUpload();
        }

        # QUESTION IF YOU GENERATE A FILE FILE
        if($this->_save_data_on_file==true){
            $this->_model->getMakeFile();
        }

        $table_name = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_alternatename'];
        $table_save_data_on_file = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_save_data_on_file'];
        $table_rules = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_rules'];
        $table_fields = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'];

        $action = $this->_action;
        require_once($this->getView());
    }
    /**
     * talos02 public function
     * @uses $this->_setTodosCampos(), Method, generates an array with ALL the fields that are going to be used, and leaves them in memory
     * @uses $this->_model->setKey(), Method, tells the model which is the field of type UNICO (PRI) will be the unicId
     * @uses $this->_model->setTable(), Method, tells the model which table of the DB will use
     * @uses $this->_model->setFields(), Method, tells the model fields to be treated
     * @uses $this->_model->getTalos02(), Method, tells the model which method to apply
     * @uses $this->getView(), Method, Apply the view
     * Note: update, receive and process the input of the create method
     */
    public function talos02(){
        $crypt_text = $this->_table=='users' ? CRYPT_VAR_USERS : CRYPT_VAR;

        # Aplicamos spread()
        if(!empty($_GET['password'])){ 
            $this->getCrypter();
            $this->_crypter->setKey($crypt_text);
            $inCrypter = $this->_crypter->getEncrypt($this->_p->spread('get','password',''));
            $_GET['password'] = $inCrypter; 
        }
        if(!empty($_POST['password'])){
            $this->getCrypter();
            $this->_crypter->setKey($crypt_text);
            $inCrypter = $this->_crypter->getEncrypt($this->_p->spread('post','password',''));
            $_POST['password'] = $inCrypter; 
        }
        if(!empty($_REQUEST['password'])){ 
            $this->getCrypter();
            $this->_crypter->setKey($crypt_text);
            $inCrypter = $this->_crypter->getEncrypt($this->_p->spread('request','password',''));
            $_REQUEST['password'] = $inCrypter; 
        }

        $setCamposRules = array(
            'TYPE' => array(array('LIST' => false,'FORM' => true)),
            'METHOD' => array(array('GET' => false,'POST' => false,'REQUEST' => false,'FILES' => false)),
            'ONLYKEY' => false
        );
        $this->_setCampos($setCamposRules);
        $this->_model->setKey($this->_key);
        $this->_model->setRelationKey($this->_fields_relation);
        $this->_model->setStatus($this->_status);
        $this->_model->setTable($this->_prefix.$this->_table);
        $this->_model->setFields($this->_fields);
        $this->_model->setSaveOnFile($this->_save_data_on_file);

        $resultUpdate = $this->_model->getTalos02();

        /**
         * File upload
         * @uses $this->setTable(), Table to apply
         * @uses $this->setFields(), Fields
         * @uses $this->setKey(), Result of insert
         * @uses $this->setPryKey(), Primary Key
         * @uses $this->setFiles(), Fields to be treated
         * @uses $this->setPosteos(), Method to listen and treat
         * @uses $this->setFolderDestino(), physical URLs
         * @uses $this->setExtSubsired(), Permitted extensions
         * @uses $this->setUpload(), Method set the UPLOAD
         * @uses $this->getUploadDelete(), Method that relieves if you are instructed to delete a pre-existing file
         * @uses $this->getUpload(), Method to apply the UPLOAD
         */
        if(!empty($resultUpdate)){
            $this->_posted->setTable($this->_prefix.$this->_table);
            $this->_posted->setFields($this->_fields);
            $this->_posted->setKey($resultUpdate);
            $this->_posted->setPryKey($this->_key);
            $this->_posted->setFiles($_FILES);
            $this->_posted->setPosteos($_POST);
            $this->_posted->setFolderDestino(array($this->_files_path_physical, $this->_files_path_physical, $this->_files_path_physical, $this->_files_path_physical, $this->_files_path_physical, $this->_files_path_physical, $this->_files_path_physical, $this->_files_path_physical, $this->_files_path_physical));
            $this->_posted->setExtPermitidas($this->_c->getExtensionsAvailable());
            $this->_posted->setUpload();
            
            $return_upload_delete = $this->_posted->getUploadDelete();
            $return_upload = $this->_posted->getUpload();
        }

        if($this->_save_data_on_file==true){
            $this->_model->getMakeFile();
        }

        $table_name = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_alternatename'];
        $table_save_data_on_file = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_save_data_on_file'];
        $table_rules = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_rules'];
        $table_fields = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'];

        $action = $this->_action;
        require_once($this->getView());
    }
    /**
     * delete public function
     * @uses $this->_ setCampos(), Method, generates an array with ALL the fields that are going to be used, and leaves them in memory
     * @uses $this->_ model->setKey(), Method, tells the model which is the field of type UNICO (PRI) will be the unicId
     * @uses $this->_ model->setTable(), Method, tells the model which table of the DB will use
     * @uses $this->_ model->setFields(), Method, tells the model fields to be treated
     * @uses $this->_ model->setFieldApplied(), Method, tells you the field to apply the functionality
     * @uses $this->_ model->getDelete(), Method, tells the model which method to apply
     * @uses $this->getView(), Method, Apply the view
     * Note: delete, delete "logical" field status
     */
    public function delete(){
        $setCamposRules = array(
            'TYPE' => array(array('LIST' => true,'FORM' => false)),
            'METHOD'    => array(array('GET' => false,'POST' => false,'REQUEST' => false,'FILES' => false)),
            'ONLYKEY' => false
        );
        $this->_setCampos($setCamposRules);
        $this->_model->setKey($this->_key);
        $this->_model->setStatus($this->_status);
        $this->_model->setTable($this->_prefix.$this->_table);
        $this->_model->setFields($this->_fields);
        $this->_model->setFieldApplied($this->_status);
        $this->_model->setSaveOnFile($this->_save_data_on_file);

        $resultDelete = $this->_model->getDelete();

        if($this->_save_data_on_file==true){
            $this->_model->getMakeFile();
        }

        $table_name = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_alternatename'];
        $table_save_data_on_file = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_save_data_on_file'];
        $table_rules = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_rules'];
        $table_fields = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'];

        $action = $this->_action;
        require_once($this->getView());
    }
    /**
     * disposition public function
     * @uses $this->_ setCampos(), Method, generates an array with ALL the fields that are going to be used, and leaves them in memory
     * @uses $this->_ model->setKey(), Method, tells the model which is the field of type UNICO (PRI) will be the unicId
     * @uses $this->_ model->setStatus(), Method, tells the model which state (logical) to apply when interacting with the DB
     * @uses $this->_ model->setOrder(), Method, tells the model if the record order 'logical' applies the table must have an order field
     * @uses $this->_ model->setTable(), Method, tells the model which table of the DB will use
     * @uses $this->_ model->setFields(), Method, tells the model fields to be treated
     * @uses $this->_ model->setFieldApplied(), Method, tells you the field to apply the functionality
     * @uses $this->_ model->getOrder(), Method, tells the model which method to apply
     * @uses $this->getView(), Method, Apply the view
     * Note: delete, apply logical order implementing field 'order'
     */
    public function disposition(){
        $setCamposRules = array(
            'TYPE' => array(array('LIST' => true,'FORM' => false)),
            'METHOD' => array(array('GET' => false,'POST' => false,'REQUEST' => false,'FILES' => false)),
            'ONLYKEY' => false
        );
        $this->_setCampos($setCamposRules);
        $this->_model->setKey($this->_key);
        $this->_model->setStatus($this->_status);
        $this->_model->setOrder($this->_order);
        $this->_model->setTable($this->_prefix.$this->_table);
        $this->_model->setFields($this->_fields);
        $this->_model->setFieldApplied($this->_order);
        $this->_model->setSaveOnFile($this->_save_data_on_file);

        $result = $this->_model->getDisposition();

        if($this->_save_data_on_file==true){
            $this->_model->getMakeFile();
        }

        $table_name = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_alternatename'];
        $table_save_data_on_file = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_save_data_on_file'];
        $table_rules = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_rules'];
        $table_fields = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'];

        $action = $this->_action;
        require_once($this->getView());
    }
    /**
     * export public function
     * @uses $this->setPager(), Method, implements pager
     * @uses $this->_ setCamposForm(), Method, generates an array with ALL the fields that will be used, and leaves them in memory
     * @uses $this->_ model->setTable(), Method, tells the model which table of the DB will use
     * @uses $this->_ model->setFields(), Method, tells the model fields to be treated
     * @uses $this->_ model->setKey(), Method, tells the model which is the field of type UNICO (PRI) will be the unicId
     * @uses $this->_ model->setStatus(), Method, tells the model which state (logical) to apply when interacting with the DB
     * @uses $this->_ model->setOrder(), Method, tells the model if the record order 'logical' applies the table must have an order field
     * @uses $this->_ model->setSort(), Method, tells the model in which order the list of records should be debugged}
     * @uses $this->_ model->getExport(), Method, tells the model which method to apply
     * @uses $this->getView(), Method, Apply the view
     * Note: delete, apply logical order implementing field 'order'
     */
    public function export(){
        $this->setPager(false);
        $setCamposRules = array(
            'TYPE' => array(array('LIST' => false,'FORM' => false,'FULL' => true)),
            'METHOD' => '',
            'ONLYKEY' => ''
        );
        $this->_setCampos($setCamposRules);
        $this->_model->setTable($this->_prefix.$this->_table);		
        $this->_model->setFields($this->_fields);
        $this->_model->setKey($this->_key);
        $this->_model->setStatus($this->_status);
        $this->_model->setOrder($this->_order);
        $this->_model->setSort($this->_sort);

        $resultExport = $this->_model->getExport();
        $table_name = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_alternatename'];
        // $table_show_in_list = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_showinlist'];
        // $table_show_in_form = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_showinform'];
        $table_save_data_on_file = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_save_data_on_file'];
        $table_rules = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_rules'];
        $table_fields = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'];
        $action = $this->_action;

        require_once($this->getView());
    }
    /**
     * filterPaged public function
     * @uses $this->setPager(), Method, implements pager
     * @uses $this->_ setCampos(), Method, generates an array with ALL the fields to be used, and leaves them in memory
     * @uses $this->_ setCamposGet(), Method, add to the arrays the fields that are passed through GET
     * @uses $this->_ model->setKey(), Method, tells the model which is the field of type UNICO (PRI) will be the unicId
     * @uses $this->_ model->setStatus(), Method, tells the model which state (logical) to apply when interacting with the DB
     * @uses $this->_ model->setTable(), Method, tells the model which table of the DB will use
     * @uses $this->_ model->setFields(), Method, tells the model fields to be treated
     * @uses $this->_ model->setOrder(), Method, tells the model if the record order 'logical' applies the table must have an order field
     * @uses $this->_ model->setSort(), Method, tells the model in which order the list of records should be debugged}
     * @uses $this->_ model->setFieldAppliedArray (), Method, field array to be treated
     * @uses $this->_ model->getFecordsPaged (), Method, tells the model which method to apply
     * @uses $this->_ structureBbdd, Array, It is an associative matrix that contains the structure of the Database and the meta data to apply in each controller, action and view
     * @uses $this-> getView(), Method, Apply the view
     * Note: list, treat a list of record sets but filtered and paged
     */
    public function filterPaged(){
        $this->setPager(true);
        $setCamposRules = array(
            'TYPE' => array(array('LIST' => true,'FORM' => false)),
            'METHOD' => array(array('GET' => true,'POST' => false,'REQUEST' => false,'FILES' => false)),
            'ONLYKEY' => false
        );
        $this->_setCampos($setCamposRules);
        $this->_model->setKey($this->_key);
        $this->_model->setStatus($this->_status);
        $this->_model->setTable($this->_prefix.$this->_table);		
        $this->_model->setFields($this->_fields);
        $this->_model->setOrder($this->_order);
        $this->_model->setSort($this->_sort);

        $arrayFields = $this->_fields;
        $this->_model->setFieldAppliedArray($arrayFields);

        if($this->_pager==true){
            $pagerActive = true;
            $pagerQuantity = $this->_pager_quantity;
            $pagerPage = $this->_pager_page;

            $this->_model->setPager($pagerActive);
            $this->_model->setPagerQuantity($pagerQuantity);
            $this->_model->setPagerPage($pagerPage);
        }

        $resultFilter = $this->_model->getFilterPaged();

        $table_name = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_alternatename'];
        // $table_show_in_list = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_showinlist'];
        // $table_show_in_form = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_showinform'];
        $table_save_data_on_file = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_save_data_on_file'];
        $table_rules = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_rules'];
        $table_fields = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'];

        $action = $this->_action;
        require_once($this->getView());
    }
    /**
     * preview public function
     * @uses $this->_ setCampos(), Method, generates an array with ALL the fields that will be used, and leaves them in memory
     * @uses $this->_ model->setKey(), Method, tells the model which is the field of type UNICO (PRI) will be the unicId
     * @uses $this->_ model->setStatus(), Method, tells the model which state (logical) to apply when interacting with the DB
     * @uses $this->_ model->setTable(), Method, tells the model which table of the DB will use
     * @uses $this->_ model->setFields(), Method, tells the model fields to be treated
     * @uses $this->_ model->getPreview(), Method, tells the model which method to apply
     * @uses $this->getView(), Method, Apply the view
     * Note: preview, shows the contents of a record set in view mode.
     */
    public function preview(){
        $setCamposRules = array(
            'TYPE' => array(array('LIST' => true,'FORM' => false)),
            'METHOD' => array(array('GET' => false,'POST' => false,'REQUEST' => false,'FILES' => false)),
            'ONLYKEY' => false
        );
        $this->_setCampos($setCamposRules);
        $this->_model->setKey($this->_key);
        $this->_model->setStatus($this->_status);
        $this->_model->setTable($this->_prefix.$this->_table);
        $this->_model->setFields($this->_fields);

        $resultPreview = $this->_model->getPreview();

        $table_name = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_alternatename'];
        // $table_show_in_list = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_showinlist'];
        // $table_show_in_form = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_showinform'];
        $table_save_data_on_file = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_save_data_on_file'];
        $table_rules = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_rules'];
        $table_fields = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'];

        $action = $this->_action;
        require_once($this->getView());
    }
    /**
     * duplicate public function
     * @uses $this->_setCampos(), Method, generates an array with ALL the fields that will be used, and leaves them in memory
     * @uses $this->_model->setKey(), Method, tells the model which is the field of type UNICO (PRI) will be the unicId
     * @uses $this->_model->setTable(), Method, tells the model which table of the DB will use
     * @uses $this->_model->setFields(), Method, tells the model fields to be treated
     * @uses $this->_model->setFieldApplied(), Method, tells you the field to apply the functionality
     * @uses $this->_model->setSaveOnFile()
     * @uses $this->getView(), Method, Apply the view
     * Note: duplicate, duplicate a specific record
     */
    public function duplicate(){
        $setCamposRules = array(
            'TYPE' => array(array('LIST' => true,'FORM' => false)),
            'METHOD'  => array(array('GET' => false,'POST' => false,'REQUEST' => false,'FILES' => false)),
            'ONLYKEY' => false
        );
        $this->_setCampos($setCamposRules);
        $this->_model->setKey($this->_key);
        $this->_model->setStatus($this->_status);
        $this->_model->setTable($this->_prefix.$this->_table);
        $this->_model->setFields($this->_fields);
        $this->_model->setFieldApplied($this->_status);
        $this->_model->setSaveOnFile($this->_save_data_on_file);

        $resultDuplicate = $this->_model->getDuplicate();
        if($this->_save_data_on_file==true){
            $this->_model->getMakeFile();
        }

        $table_name = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_alternatename'];
        $table_save_data_on_file = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_save_data_on_file'];
        $table_rules = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_rules'];
        $table_fields = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'];

        $action = $this->_action;
        require_once($this->getView());
    }
    public function listedAjax(){
        $this->setPager(true);
        if(!empty($_GET['length'])){ 
            $length = $this->_p->spread('get','length',0);
        }
        if(!empty($_POST['length'])){ 
            $length = $this->_p->spread('post','length',0);
        }
        if(!empty($_REQUEST['length'])){ 
            $length = $this->_p->spread('request','length',0);
        }

        if(!empty($_GET['draw'])){ 
            $draw = $this->_p->spread('get','draw',0);
        }
        if(!empty($_POST['draw'])){ 
            $draw = $this->_p->spread('post','draw',0);
        }
        if(!empty($_REQUEST['draw'])){ 
            $draw = $this->_p->spread('request','draw',0);
        }

        if(!empty($_GET['order'])){ 
            $order = $this->_p->spread('get','order','');
        }
        if(!empty($_POST['order'])){ 
            $order = $this->_p->spread('post','order','');
        }
        if(!empty($_REQUEST['order'])){ 
            $order = $this->_p->spread('request','order','');
        }

        if(!empty($_GET['columns'])){ 
            $columns = $this->_p->spread('get','columns','');
        }
        if(!empty($_POST['columns'])){ 
            $columns = $this->_p->spread('post','columns','');
        }
        if(!empty($_REQUEST['columns'])){ 
            $columns = $this->_p->spread('request','columns','');
        }

        if(!empty($_GET['order'])){ 
            $order = $this->_p->spread('get','order','');
        }
        if(!empty($_POST['order'])){ 
            $order = $this->_p->spread('post','order','');
        }
        if(!empty($_REQUEST['order'])){ 
            $order = $this->_p->spread('request','order','');
        }

        if(!empty($_GET['start'])){ 
            $start = $this->_p->spread('get','start',0);
        }
        if(!empty($_POST['start'])){ 
            $start = $this->_p->spread('post','start',0);
        }
        if(!empty($_REQUEST['start'])){ 
            $start = $this->_p->spread('request','start',0);
        }

        if(!empty($_GET['search'])){ 
            $search = $this->_p->spread('get','search','');
        }
        if(!empty($_POST['search'])){ 
            $search = $this->_p->spread('post','search','');
        }
        if(!empty($_REQUEST['search'])){ 
            $search = $this->_p->spread('request','search','');
        }

        $start = !empty($start) ? $start : 0;

        $page_pager = $start / $length;

        // echo $columns[$order[0]['column']]['data'];
        // exit();

        $search_leavel = !empty($columns[$order[0]['column']]['data']) ? $columns[$order[0]['column']]['data'] : '';
        $search_text = !empty($search['value']) ? $search['value'] : '';
        $_GET[$search_leavel]=$search_text;
        $_POST[$search_leavel]=$search_text;
        $_REQUEST[$search_leavel]=$search_text;
        $_GET['searching']=true;

        $length = !empty($length) ? $this->_pager_quantity=$length : $this->_pager_quantity ;
        // $draw = !empty($draw) ? $this->_pager_page=$draw-1 : $this->_pager_page;
        $sort = !empty($order[0]['dir']) ? $this->_sort=$order[0]['dir'] : $this->_sort;
        $order = !empty($order) ? $this->_order=$columns[$order[0]['column']]['data'] : $this->_order;

        // print_r($search);
        // exit();

        if(empty($search['value']))
        {
            $setCamposRules = array(
                'TYPE' => array(array('LIST' => true,'FORM' => false)),
                'METHOD' => array(array('GET' => false,'POST' => false,'REQUEST' => false,'FILES' => false)),
                'ONLYKEY' => false
            );

            $this->_setCampos($setCamposRules);
            $this->_model->setTable($this->_prefix.$this->_table);		
            $this->_model->setFields($this->_fields);
            $this->_model->setKey($this->_key);
            $this->_model->setStatus($this->_status);
            $this->_model->setOrder($order);
            $this->_model->setSort($sort);
            
            if($this->_pager==true){
                $this->_model->setPager(true);
                $this->_model->setPagerQuantity($length);
                $this->_model->setPagerPage($page_pager);
            }
            // We ask the model for all the items
            $resultSelect = $this->_model->getRecordsPagedAjax();
        }
        else
        {
            $setCamposRules = array(
                'TYPE' => array(array('LIST' => true,'FORM' => false)),
                'METHOD' => array(array('GET' => true,'POST' => false,'REQUEST' => false,'FILES' => false)),
                'ONLYKEY' => false
            );
            $this->_setCampos($setCamposRules);
            $this->_model->setTable($this->_prefix.$this->_table);		
            $this->_model->setFields($this->_fields);
            $this->_model->setKey($this->_key);
            $this->_model->setStatus($this->_status);
            $this->_model->setOrder($order);
            $this->_model->setSort($sort);
            
            $arrayFields = $this->_fields;
            $this->_model->setFieldAppliedArray($arrayFields);

            // echo $search_leavel;
            // echo $search_text;
            // echo $_REQUEST[$search_leavel];
            // exit();
    
            if($this->_pager==true){
                $this->_model->setPager(true);
                $this->_model->setPagerQuantity($length);
                $this->_model->setPagerPage($page_pager);
            }
            // We ask the model for all the items
            $resultSelect = $this->_model->getRecordsPagedAjaxFull();
        }
        
        $table_name = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_alternatename'];
        // $table_show_in_list = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_showinlist'];
        // $table_show_in_form = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_showinform'];
        $table_save_data_on_file = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_save_data_on_file'];
        $table_rules = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_rules'];
        $table_fields = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'];
        $action = $this->_action;
        require_once($this->getView());
    }

# THIS ALWAYS GOES TO THE END {
    /**
     * _setCampos public function
     * @uses $this->_model->_fields, Array
     * @uses $this->_model->_fields_show, Array
     * @uses $this->_model->_fields_relation, Array
     * @uses $this->_model->_key, Array
     * @uses $this->_structureBbdd, Array, It is an associative matrix that contains the structure of the Database and the meta data to apply in each controller, action and view
     * Note: _setCampos, Indicates which is the primary key (PRI) and the foreign key (MUL)
     * It also makes available different arrangement with the columns to be taken into account
     * Configure the fields to be treated for lists or forms etc.
     * Take the value of the Database from the Comment field
     * Also add to the arrays the fields that are in the matrices $ _GET, $ _POST, $ _REQUEST, $ _FILES according to the need can be combined.
     */
    public function _setCampos($setCamposRules){
        if (is_array($setCamposRules)){
            if (isset($setCamposRules['TYPE']) && is_array($setCamposRules['TYPE'])){
                $table_name = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_alternatename'];
                // $table_show_in_list = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_showinlist'];
                // $table_show_in_form = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_showinform'];
                $table_save_data_on_file = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_save_data_on_file'];
                $table_rules = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_rules'];
                $table_fields = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'];
                // $this->_save_data_on_file = $table_save_data_on_file;
                $this->_save_data_on_file = empty($table_save_data_on_file) ? false : true;

                foreach ($setCamposRules['TYPE'] as $structure){
                    if($structure['LIST']===true){
                        foreach($table_fields as $key => $value){
                            $field = $key;
                            $field_alternate_name = $table_fields[$key]['alternatename'];
                            $field_list = $table_fields[$key]['showinlist'];
                            $field_primary_key = $table_fields[$key]['key'];
                            if($field_list=='true'){
                                $this->_fields[] = $key;
                                $this->_fields_show[] = $field_alternate_name;
                                $this->_fields_show_fild[] = array('field'=>$key, 'name'=>$field_alternate_name,'field-type'=>$field_primary_key);
                            }
                            if($field_primary_key=='PRI'){
                                $this->_key = $key;
                            }
                            if($field_primary_key=='MUL'){
                                $this->_fields_relation[] = $key;
                            }
                        }
                    }
                    if($structure['FORM']===true){
                        foreach($table_fields as $key=> $value){
                            $field = $key;
                            $field_alternate_name = $table_fields[$key]['alternatename'];
                            $field_form = $table_fields[$key]['showinform'];
                            $field_primary_key = $table_fields[$key]['key'];
                            if($field_form=='true'){
                                $this->_fields[] = $key;
                                $this->_fields_show[] = $field_alternate_name;
                                $this->_fields_show_fild[] = array('field'=>$key, 'name'=>$field_alternate_name,'field-type'=>$field_primary_key);
                            }
                            if($field_primary_key=='PRI'){
                                $this->_key = $key;
                            }
                            if($field_primary_key=='MUL'){
                                $this->_fields_relation[] = $key;
                            }
                        }
                    }
                    if(!empty($structure['FULL']) && $structure['FULL']===true){
                        foreach($table_fields as $key=> $value){
                            $field = $key;
                            $field_alternate_name = $table_fields[$key]['alternatename'];
                            $field_primary_key = $table_fields[$key]['key'];
                            $this->_fields[] = $key;
                            $this->_fields_show[] = $field_alternate_name;
                            $this->_fields_show_fild[] = array('field'=>$key, 'name'=>$field_alternate_name,'field-type'=>$field_primary_key);
                            if($field_primary_key=='PRI'){
                                $this->_key = $key;
                            }
                            if($field_primary_key=='MUL'){
                                $this->_fields_relation[] = $key;
                            }
                        }
                    }
                }
            }

            if (isset($setCamposRules['METHOD']) && is_array($setCamposRules['METHOD'])){
                foreach ($setCamposRules['METHOD'] as $method){
                    if($method['GET']===true){
                        if(isset($_GET)){
                            foreach($_GET as $var=> $val){
                                if($this->_f->chek_field($var, $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'])){
                                    if(!in_array($var,$this->_fields)){
                                        $this->_fields[] = $var;
                                    }
                                }
                            }
                        }
                    }
                    if($method['POST']===true){
                        if(isset($_POST)){
                            foreach($_POST as $var=> $val){
                                if($this->_f->chek_field($var, $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'])){
                                    if(!in_array($var,$this->_fields)){
                                        $this->_fields[] = $var;
                                    }
                                }
                            }
                        }
                    }
                    if($method['REQUEST']===true){
                        if(isset($_REQUEST)){
                            foreach($_REQUEST as $var=> $val){
                                if($this->_f->chek_field($var, $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'])){
                                    if(!in_array($var,$this->_fields)){
                                        $this->_fields[] = $var;
                                    }
                                }
                            }
                        }
                    }
                    if($method['FILES']===true){
                        if(isset($_FILES)){
                            foreach($_FILES as $var=> $val){
                                if($this->_f->chek_field($var, $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'])){
                                    if(!in_array($var,$this->_fields)){
                                        $this->_fields[] = $var;
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if (isset($setCamposRules['ONLYKEY']) && !empty($setCamposRules['ONLYKEY'])){
                $table_fields = $this->_estructuraBbdd[$this->_database][$this->_prefix.$this->_table]['GLOBAL_data'];

                foreach($table_fields as $key=> $value){
                    $field_primary_key = $table_fields[$key]['key'];

                    if($field_primary_key=='PRI'){
                        $this->_key = $key;
                    }

                    if($field_primary_key=='MUL'){
                        $this->_fields_relation[] = $key;
                    }
                }
            }
        }
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