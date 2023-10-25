<?php
/**
 * Connect, Connection pointer | Pointer of connection
 * 
 * The Connect Class extends from AbstractConnect Generates the conn pointer
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Connect class, 
 * Return: connection pointer | Pointer of connection
 * @subpackage database
 * 
 * @example
 * $conn = new Connect();
 * $conn->setDbHost('ubuntudev');
 * $conn->setDbName('data_base');
 * $conn->setDbUser('user');
 * $conn->setDbPass('password');
 * $conn->setDbPort('3306');
 * $conn->setConn();
 * $conn->getConn();
 */
class Connect extends AbstractConnect{
    /**
     * __construct function
     * @see __construct()
     * @uses $this->setDbHost, Function
     * @uses $this->setDbName, Function
     * @uses $this->setDbUser, Function
     * @uses $this->setDbPass, Function
     * @uses $this->setDbPort, Function
     * Note: Constructor
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
     * Note: Funcion que genera puntero
     */
    public function setConn(){
        $this->conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name, $this->db_port) or trigger_error(mysql_error($this->conn),E_USER_ERROR);
        $this->conn->query("SET NAMES 'utf8'");
    }
    /**
     * getConn function
     * @uses $this->conn, Object
     * Note: Funcion retorna el puntero
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
        $this->conn->close();
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