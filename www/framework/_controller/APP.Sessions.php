<?php
/**
 * AppSessions, Try the Sessions
 * 
 * The Session Class is responsible for interacting with the controller, model and session class
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * AppSessions class,
 * @package {SMVC} Simple Model View Controller
 * @subpackage database
 */
class AppSessions {
    /**
     * Configuration values
     * @access private
     * @var String
     */
    private $_controlador = '';
    /**
     * Configuration values
     * @access public
     * @var Session
    */
    public $s = '';
    /**
     * setControlador public function
     * @uses $_folder, Array
     * Note: Load the controller
     */
    public function setControlador($controlador){
        $this->_controlador = $controlador;
    }
    /**
     * __construct function
     * @uses Class.Sesion.php, Class, Configuration class
     * Note: Create a session and set the default parameters
     */
    function __construct(){
        require_once( dirname(__FILE__) . '/../_lib/session/Class.Session.php');
        $this->s = new Session();
        
        $this->s->setDebug(true);
        $this->s->setKey(CONFIG_SESION_KEY_BACK);
        $this->s->setFlagValors('flag','arg');
        $this->s->setName(CONFIG_SESION_NAME_BACK);
        $this->s->setExpireTime(180 * 60);
        $this->s->propagate();
        
        #We validate that the session was well created
        //$error_session 	= $this->s->confirmFlag()===false ? 'Login does not propagate' : '';
    }
    /**
     * setSessionControl function
     * Note: Check that the session is created (if it is not in the login controller)
     */
    public function setSessionControl(){
        if($this->_controlador != 'login'){
            $error_session = $this->s->getVariable('flag_session_activate',false)===false ? 'Session not created' : '';

            if(!empty($error_session)){
                $laUri[] = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                $this->s->setFlag();
                $this->s->setVariable('user_redirect', $laUri);
                header('Location: index.php?controller=login&action=login');
                exit();
            }
        }
    }
    /**
     * setSessionValidateController function
     * Note: Check that the user has permission to access the controller (if it is not in the login controller)
     */
    public function setSessionValidateController(){
        if($this->_controlador != 'login'){
            $error_session 	= $this->s->getVariable('admin_permissions',false)===false ? 'There is no data' : '';

            if(!empty($error_session)){
                header('Location: index.php?controller=login&action=login');
                exit();
            }else{
                $data_admin_permissions = $this->s->getVariable('admin_permissions',true);

                if(!in_array($this->_controlador,$data_admin_permissions)){
                    header('Location: index.php?controller=start&action=withoutPermissions&msn=1');
                    exit();
                }
            }
        }
    }
    /**
     * setSessionInit function
     * Note: save a key as a session flag
     */
    public function setSessionInit($config_session_flag){
        $this->s->setFlag();
        $this->s->setVariable('flag_session_activate',$config_session_flag);
    }
    /**
     * setSessionVariableArray function
     * Note: save a variable into the session
     */
    public function setSessionVariableArray($name, $valor){
        $this->s->setVariable($name,$valor);
    }
    /**
     * getSessionVariableArray function
     * Note: get the value of the variable in the session
     */
    public function getSessionVariableArray($name, $boolean=false){
        $var = $this->s->getVariable($name,$boolean)===false ? $name.' - does not exist' : $this->s->getVariable($name,$boolean);
        return $var;
    }
    /**
     * setSessionDistroy function
     * Note: Destroy the session
     */
    public function setSessionDistroy(){		
        $this->s->setDestroy();
        header('Location: index.php?controller=login&action=login');
        exit();
    }
}
