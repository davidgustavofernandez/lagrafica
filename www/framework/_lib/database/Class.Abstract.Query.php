<?php
/**
 * AbstractQuery, abstract class
 * 
 * Abstract Class
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * AbstractQuery Abstract Class, 
 * @package {SMVC} Simple Model View Controller
 * @subpackage database
 */
abstract class AbstractQuery{
    /**
     * Configuration protected variable values, 
     * @access protected 
     * @var string
     */
    protected $query;
    /**
     * Configuration protected variable values, 
     * @access protected 
     * @var Array
     */
    protected $colection = array();
    /**
     * Configuration protected variable values, 
     * @access protected 
     * @var string
     */
    protected $lastId;
    /**
     * Configuration protected variable values, 
     * @access protected 
     * @var string
     */
     protected $state;
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
     * Destructor borra el objeto
     * @see __destruct()
     */
    public function __destruct(){
        //unset($this);
    }
    /**
     * reset abstract public function
     * @see reset()
     */
    abstract public function reset();
    /**
     * setConection abstract public function
     * @see setConection()
     */
    abstract public function setConection($conn);
    /**
     * setQuery abstract public function
     * @see setQuery()
     */
    abstract public function setQuery($query);
    /**
     * getQuery abstract public function
     * @see getQuery()
     */
    abstract public function getQuery();
    /**
     * getQueryTotalNum abstract public function
     * @see getQueryTotalNum()
     */
    abstract public function getQueryTotalNum();
    /**
     * save abstract public function
     * @see save()
     */
    //abstract public function save();
    /**
     * setInsert abstract public function
     * @see setInsert()
     */
    abstract public function setInsert();
    /**
     * setLastId abstract public function
     * @see setLastId()
     */
    abstract public function setLastId($id);
    /**
     * setState abstract public function
     * @see setState()
     */
    abstract public function setState($valor);
    /**
     * escape abstract public function
     * @see escapeString()
     */
    abstract public function escapeString($chain);
    /**
     * getState abstract public function
     * @see getState()
     */
    abstract public function getState();
    /**
     * getTotalRecords abstract public function
     * @see getTotalRecords()
     */
    //abstract public function getTotalRecords();
    /**
     * getLastId abstract public function
     * @see getLastId()
     */
    abstract public function getLastId();
    /**
     * setDelete abstract public function
     * @see setDelete()
     */
    abstract public function setDelete();
    /**
     * setUpdate abstract public function
     * @see setUpdate()
     */
    abstract public function setUpdate();
    /**
     * trigger abstract public function
     * @see trigger()
     */
    abstract public function trigger($var);
}
?>