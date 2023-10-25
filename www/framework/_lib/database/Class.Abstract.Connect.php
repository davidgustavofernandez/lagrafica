<?php
/**
 * AbstractConnect, abstract class
 * 
 * Abstract Class
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * AbstractConnect Abstract Class, 
 * @package {SMVC} Simple Model View Controller
 * @subpackage database
 */
abstract class AbstractConnect{
    /**
     * Configuration protected variable values, 
     * @access protected 
     * @var string
     */
    protected $db_host;
    /**
     * Configuration protected variable values, 
     * @access protected 
     * @var string
     */
    protected $db_name;
    /**
     * Configuration protected variable values, 
     * @access protected 
     * @var string
     */
    protected $db_user;
    /**
     * Configuration protected variable values, 
     * @access protected 
     * @var string
     */
    protected $db_pass;
    /**
     * Configuration protected variable values, 
     * @access protected 
     * @var string
     */
    protected $db_port;
    /**
     * Configuration protected variable values, 
     * @access protected 
     * @var string
     * @return conn
     */
    public $conn;
    /**
     * Constructor abstract public function
     * @see __construct()
     */
    abstract public function __construct();
    /**
     * setConn abstract public function
     * @see setConn()
     */
    abstract public function setConn();
    /**
     * getConn abstract public function
     * @see setConn()
     */
    abstract public function getConn();
    /**
     * setDisConect abstract public function
     * @see setConn()
     */
    abstract public function setDisConect();
    /**
     * setDbHost abstract public function
     * @see setDbHost()
     */
    abstract public function setDbHost($valor);
    /**
     * setDbName abstract public function
     * @see setDbName()
     */
    abstract public function setDbName($valor);
    /**
     * setDbUser abstract public function
     * @see setDbUser()
     */
    abstract public function setDbUser($valor);
    /**
     * setDbPass abstract public function
     * @see setDbPass()
     */
    abstract public function setDbPass($valor);
    /**
     * setDbPort abstract public function
     * @see setDbPort()
     */
    abstract public function setDbPort($valor);
    /**
     * Destructor borra el objeto
     * @see __destruct()
     */
    public function __destruct(){
        //unset($this);
    }
}
?>