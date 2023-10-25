<?php
/**
 * Connect, Connection pointer | Pointer of connection
 * 
 * The Connect Class extends from AbstractConn Generates the pointer conn
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Connect class, 
 * Return: connection pointer | Pointer of connection
 * @subpackage database
 */
class Connect extends AbstractConnect{
    /**
     * Constructor sets up
     * @see __construct()
     */
    public function __construct(){
        $this->setDbHost(CONFIG_DB_HOST);
        $this->setDbName(CONFIG_DB_NAME);
        $this->setDbUser(CONFIG_DB_USER);
        $this->setDbPass(CONFIG_DB_PASS);
        $this->setDbPort(CONFIG_DB_PORT);
    }
    /**
     * setConn function
     * @see setDbHost()
     * @see setDbName()
     * @see setDbUser()
     * @see setDbPass()
     * @see setDbPort()
     * @uses $this->db_host, String
     * @uses $this->db_name, String
     * @uses $this->db_user, String
     * @uses $this->db_pass, String
     * @uses $this->db_port, String
     * Note: Function that generates conection to the database
     */
    public function setConn(){
        $this->conn = mysql_connect($this->db_host, $this->db_user, $this->db_pass) or trigger_error(mysql_error($this->conn),E_USER_ERROR);
        
        if($this->conn){
            mysql_select_db($this->db_name) or trigger_error(mysql_error($this->conn),E_USER_ERROR);
            mysql_query("SET NAMES utf8",$this->conn);
        }
    }
    /**
     * getConn function
     * @uses $this->conn, Object
     * Note: Function returns the pointer
     * @return object
     */
    public function getConn(){
        return $this->conn;
    }
    /**
     * setDbHost public function
     * @see _conect()
     */
    public function setDbHost($valor){
        $this->db_host = $valor;
    }
    /**
     * setDbName public function
     * @see _conect()
     */
    public function setDbName($valor){
        $this->db_name = $valor;
    }
    /**
     * setDbUser public function
     * @see _conect()
     */
    public function setDbUser($valor){
        $this->db_user = $valor;
    }
    /**
     * setDbPass public function
     * @see _conect()
     */
    public function setDbPass($valor){
        $this->db_pass = $valor;
    }
    /**
     * setDbPort public function
     * @see _conect()
     */
    public function setDbPort($valor){
        $this->db_port = $valor;
    }
    /**
     * setDisConect function
     * @see _conect()
     */
    public function setDisConect(){
        mysql_close($this->conn);
    }
    /**
     * Destructor borra el objeto
     * @see __destruct()
     */
    public function __destruct(){
        $this->conn->close();
        //unset($this);
    }
}
?>