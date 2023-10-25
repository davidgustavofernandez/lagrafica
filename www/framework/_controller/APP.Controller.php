<?php
/**
 * AppController, Principal Controller
 * 
 * AppController It is the controller, also the MODEL and the VISTA instance.
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * AppController class,
 * @subpackage AppController
 * 
 * @example:
 * $start = new AppController();
 * $start->appStart();
 */
class AppController{
    /**
     * $_controller, will be the name of the controller to apply
     * @access private
     * @var string
     */
    private $_controller;
    /**
     * $_action, will be the name of the method or action to apply
     * @access private
     * @var string
     */
    private $_action;
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
    private $_search_on = array();
    private $_search_off = array();
    private $_search_filters = array();
    private $_params_filter = array();
    /**
     * $_sort, order to apply in the consultations (ASC - DESC)
     * @access private
     * @var string
     */
    private $_sort = 'ASC';
    /**
    * appStart function
     * @uses Class.Messages.php, Class, Contains alert or error messages
     * @uses Class.Configuration.php, Class, Configuration class
     * @uses Class.Propagate.php, Class, Try GET, POST, REQUEST apply injection filter.
     * @uses Class.Error.Handler.php, Class, Error Track
     * @uses Class.Abstract.Conn.php, Class, Abstraction of the connect class
     * @uses Class.Connect.php, Class, Connection class, according to the database version
     * @uses Class.Abstract.Query.php, Class, Abstraction of the query class
     * @uses Class.Query.php, Class, Principal Queries
     * @uses Class.QueryMethods.php, Class, Queries and typical Methods
     * @uses APP.Abstract.Database.Model.php, Class, Abstraction of the instance of connection
     * @uses Class.Functions.php, Class, Auxiliary functions
     * Note: Method that initializes the controller, provides everything necessary for the framework.
     */
    public function appStart(){
        require_once( dirname(__FILE__) . '/../_lib/messages/Class.Messages.php');
        $m = new Messages();
        # Configuration class
        require_once( dirname(__FILE__) . '/../_common/Class.Config.php');
        $c = new Configuration();
        # Ijection Class
        if(!empty($_REQUEST['controller']) && $_REQUEST['controller']==='login'){
            # Propagate Login INJECTION (only for login)
            require_once( dirname(__FILE__) . '/../../framework/_lib/propagate/Class.Propagate.Login.php');
        }else{
            # Propagate INJECTION (Regular Class)
            require_once( dirname(__FILE__) . '/../../framework/_lib/propagate/Class.Propagate.php');
        }
        $p = new Propagate();
        $p->setFilter(true);

        require_once( dirname(__FILE__) . '/../_lib/handler/Class.Error.Handler.php');
        require_once( dirname(__FILE__) . '/../_lib/database/Class.Abstract.Connect.php');
        require_once( dirname(__FILE__) . '/../_lib/database/'.CONFIG_DATABASE_VERSION.'/Class.Connect.php');
        require_once( dirname(__FILE__) . '/../_lib/database/Class.Abstract.Query.php');
        require_once( dirname(__FILE__) . '/../_lib/database/'.CONFIG_DATABASE_VERSION.'/Class.Query.php');
        require_once( dirname(__FILE__) . '/../_lib/database/Class.Query.Methods.php');
        require_once( dirname(__FILE__) . '/../_model/APP.Abstract.Connect.Instance.php');
        require_once( dirname(__FILE__) . '/../_lib/functions/Class.Functions.php');
        
        $e = new ErrorHandler();
        $f = new Functions();

        # We apply or not injection filter
        $p->setFilter(true); 
        $this->_controller = $p->spread('request','controller','start') . 'Controller';
        $this->_action = $p->spread('request','action','index');
        $this->_pager_page = $p->spread('request','pager_page',0);
        $this->_order = $p->spread('request','order','field_order');
        $this->_sort = $p->spread('request','sort','DESC');
        
        if(!empty($_REQUEST['search_on'])){
            require_once( dirname(__FILE__) . '/../_lib/crypt/Class.Crypt.php');
            $_crypter = new Crypt();
            $_crypter->setKey(CRYPT_VAR_TXT);
            $temp_search_on = $_crypter->getDecrypt($p->spread('request','search_on',''));
            $temp_search_on_decode = unserialize(base64_decode($temp_search_on));
            $this->_search_on = is_array($temp_search_on_decode) ? $temp_search_on_decode : array();
            // print_r($this->_search_on);
        }
        if(!empty($_REQUEST['search_off'])){
            require_once( dirname(__FILE__) . '/../_lib/crypt/Class.Crypt.php');
            $_crypter = new Crypt();
            $_crypter->setKey(CRYPT_VAR_TXT);
            $temp_search_off = $_crypter->getDecrypt($p->spread('request','search_off',''));
            $temp_search_off_decode = unserialize(base64_decode($temp_search_off));
            $this->_search_off = is_array($temp_search_off_decode) ? $temp_search_off_decode : array();
            // print_r($this->_search_on);
        }
        if(!empty($_REQUEST['search_filters'])){
            require_once( dirname(__FILE__) . '/../../framework/_lib/crypt/Class.Crypt.php');
            $_crypter = new Crypt();
            $_crypter->setKey(CRYPT_VAR_TXT);
            $temp_search_filters = $_crypter->getDecrypt($p->spread('request','search_filters',''));
            $temp_search_filters_decode = unserialize(base64_decode($temp_search_filters));
            $this->_search_filters = is_array($temp_search_filters_decode) ? $temp_search_filters_decode : array();
          }
          if(!empty($_REQUEST['params_filter'])){
            require_once( dirname(__FILE__) . '/../../framework/_lib/crypt/Class.Crypt.php');
            $_crypter = new Crypt();
            $_crypter->setKey(CRYPT_VAR_TXT);
            $temp_params_filter = $_crypter->getDecrypt($p->spread('request','params_filter',''));
            $temp_params_filter_decode = unserialize(base64_decode($temp_params_filter));
            $this->_params_filter = is_array($temp_params_filter_decode) ? $temp_params_filter_decode : array();
          }
            
        # We ask if the controller" is a system exception, If it is an exception, the controller must be declared as an exception (see setExceptions())
        if( in_array($this->_controller, $c->setExceptions()) ){
            $controllerPath = FOLDER_CONTROLLER . $this->_controller . '.php';
        }else{
            $controllerPath = FOLDER_CONTROLLER . 'APP.Base.Controller.php';
        }
        if(is_file($controllerPath)){
            require_once($controllerPath);
        }else{
            die($m->getPageMessage($this->_controller . '->' . $this->_action, 'controlador','404'));
        }

        if( in_array($this->_controller, $c->setExceptions()) ){
            # Custom Controller Instance
            $control = new $this->_controller();
        }else{
            # Instance of Generic Controller
            $control = new AppBaseController();
        }
        $control->setPrefix(CONFIG_DB_PREFIX);
        $control->setDatabase(CONFIG_DB_NAME);
        $control->setConfigurations($c);
        $control->setMessages($m);
        $control->setPropagate($p);
        $control->setFunctions($f);
        
        # We ask if there is a method equal to the action passed as an argument
        if (is_callable(array($control, $this->_action)) == false){
            die($m->getPageMessage($this->_controller . '->' . $this->_action, 'controlador','400'));
            return false;
        }

        $control->setController(str_replace('Controller','',$this->_controller));
        $control->setAction($this->_action);
        $control->setPagerPage($this->_pager_page);
        $control->setOrder($this->_order);
        $control->setSort($this->_sort);
        $control->setSearchOn($this->_search_on);
        $control->setSearchOff($this->_search_off);
        $control->setSearchFilters($this->_search_filters);
        $control->setParamFilter($this->_params_filter);
        $control->{$this->_action}();
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