<?php
/**
 * Query, Generate all queries
 * 
 * The Query Class is responsible for interacting directly with the Database
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Query class,
 * @package {SMVC} Simple Model View Controller
 * @subpackage database
 */
class Query extends AbstractQuery{
    private $_colection = '';
    private $_query = '';
    private $_lastId = '';
    private $_state = '';
    /**
     * Constructor sets up
     * @see __construct()
     */
    public function __construct(){}
    /**
     * Destructor sets up
     * @see __destruct()
     */
    public function __destruct(){
        //unset($this);
    }
    /**
     * reset public function
     * Note: Function that resets the variables. The goal is to be able to continue using the connection pointer and not have to re-instantiate the class.
     */
    public function reset(){
        //$this->conn = '';
        $this->_colection = '';
        $this->_query = '';
        $this->_lastId = '';
        $this->_state = '';
    }
    /**
     * setConection public function
     * @uses $conn, Object
     * Note: Function that receives the pointer and makes it available for use.
     */
    public function setConection($conn){
        $this->conn = $conn;
    }
    /**
     * setQuery public function
     * @uses $_query, String
     * Note: Function of the query in the form of String.
     */
    public function setQuery($query){
        $this->_query = $query;
    }
    /**
     * save public function
     * Note: Function that prepares the objects to be incorporated into the Database.
     */
    /*public function save(){
        return $this->_colection;
    }*/
    /**
     * setLastId public function
     * @uses $id, String
     * Note: Function that leaves the query ID available.
     */
    public function setLastId($id){
        $this->_lastId = $id;
    }
    /**
     * setState public function
     * @uses $valor, String
     * Note: Function that stores the status of the queries.
     */
    public function setState($valor){
        $this->_state = $valor;	
    }
    /**
     * escapeString public function
     * @uses $variable, String
     * @return String
     * Note: Function that cleans the Strings.
     */
    public function escapeString($chain){
        if(get_magic_quotes_gpc() != 0){
            $chain = stripslashes($chain);
        }
        $the_return = $this->conn->real_escape_string($chain);
        return $the_return;
    }
    /**
     * getState public function
     * @return $this->_state, String
     * Note: Function that sets the state of an action.
     */
    public function getState(){
        return $this->_state;	
    }
    /**
     * getLastId public function
     * @return $this->_lastId, String
     * Note: Function that returns the last ID.
     */
    public function getLastId(){
        return $this->_lastId;
    }	
    /**
     * getQuery public function
     * @uses $this->_query, String
     * @usee $this->setState, Function
     * @return $recordset, Array
     * Note: Function to inject SQL to the Database (selects preferably), resets a state and returns an array with the values of the query.
     */
    public function getQuery(){
        if(!empty($this->_query)){
            $recordset = array();

            if( $res = $this->conn->query($this->_query) ){
                $isUpdate = strpos($this->_query, 'UPDATE');
                $isInsert = strpos($this->_query, 'INSERT');
                $isDelete = strpos($this->_query, 'DELETE');
                $isTruncate = strpos($this->_query, 'TRUNCATE');

                if ($isUpdate === false && $isInsert === false && $isDelete === false && $isTruncate === false) {

                    $numRow = $res->num_rows;

                    if(!is_bool($res) and $numRow>0){
                        while($aux = $res->fetch_object()){
                            $recordset[] = $aux;
                        }
                        $res->free();
                        $this->setState('impact');

                        if(CONFIG_TRIGGER==true){
                            $this->trigger($this->_query);
                        }
                        return $recordset;
                    }else{
                        $this->setState('impact');

                        if(CONFIG_TRIGGER==true){
                            $this->trigger($this->_query);
                        }
                    }
                }else{
                    if ($isUpdate === true){
                        $this->setLastId($this->conn->insert_id);
                    }
                    $this->setState('impact');

                    if(CONFIG_TRIGGER==true){
                        $this->trigger($this->_query);
                    }
                }
            }else{
                $this->setState($this->conn->error);
            }
        }
    }
    /**
     * getQueryTotalNum public function
     * @uses $this->_query, String
     * @usee $this->setState, Function
     * @return $recordset, Array
     * Note: Function to inject SQL to the Database (selects preferably), returns the number of records.
     */
    public function getQueryTotalNum(){
        if(!empty($this->_query)){
            $recordset = array();

            if( $res = $this->conn->query($this->_query) ){
                $numRow = $res->num_rows;

                if(!is_bool($res) and $numRow>0){
                    $res->free();
                    $this->setState('impact');

                    if(CONFIG_TRIGGER==true){
                        $this->trigger($this->_query);
                    }

                    return $numRow;
                }else{
                    $this->setState('impact');
                }
            }else{
                $this->setState($this->conn->error);
            }
        }
    }
    /**
     * setInsert public function
     * @uses $this->_query, String
     * @usee $this->setState, Function
     * @uses $this->setLastId, Function
     * Note: Function to make inserts in the Database, returns the ID of the query.
     */
    public function setInsert(){
        if( $result = $this->conn->query($this->_query) ){
            $this->setLastId($this->conn->insert_id);
            $this->setState('impact');

            if(CONFIG_TRIGGER==true){
                $this->trigger($this->_query);
            }
        }else{
            $this->setState($this->conn->error);
        }
    }
    /**
     * setDelete public function
     * @uses $this->_query, String
     * @usee $this->setState, Function
     * Note: Function to manipulate the DELETE.
     */
    public function setDelete(){
        if( $result = $this->conn->query($this->_query) ){
            $this->setState('impact');

            if(CONFIG_TRIGGER==true){
                $this->trigger($this->_query);
            }
        }else{
            $this->setState($this->conn->error);
        }
    }
    /**
     * setUpdate public function
     * @uses $this->_query, String
     * @usee $this->setState, Function
     * Note: Function to manipulate the UPDATE.
     */
    public function setUpdate(){
        if( $result = $this->conn->query($this->_query) ){
            $this->setState('impact');

            if(CONFIG_TRIGGER==true){
                $this->trigger($this->_query);
            }
        }else{
            $this->setState($this->conn->error);
        }
    }
    /**
     * setInjection public function
     * @uses $this->_query, String
     * @usee $this->setState, Function
     * Note: Function to make direct consultations.
     */
    public function setInjection(){
        if( $result = $this->conn->query($this->_query) ){
            $this->setState('impact');
        }else{
            $this->setState($this->conn->error);
        }
    }

    public function setManyInjection(){
        $queries = explode('||',$this->_query);
        $leng_queries = count($queries);

        for($i=0; $i<$leng_queries; $i++){
            if( $leng_queries-1 == $i ){
                $result = $this->conn->query($queries[$i]);
                $numRow = $result->num_rows;

                if(!is_bool($result) and $numRow>0){

                    $recordset[] = $result->fetch_object();
                    $result->free();
                    $this->setState('impact');

                    // if(CONFIG_TRIGGER==true){
                    //     $this->trigger($queries[$i]);
                    // }
                    return $recordset;
                }else{
                    $this->setState('impact');
                    // if(CONFIG_TRIGGER==true){
                    //     $this->trigger($queries[$i]);
                    // }
                }
            }else{
                $this->conn->query($queries[$i]);
            }
        }
    }
    /**
     * trigger public function
     * @uses $conn, Object
     * @usee TriggerInjection(), Function
     * @uses setTriggerInjection(), Function
     * Note: Generate data log
     */
    public function trigger($var){
        require_once( dirname(__FILE__) . "/../../../_lib/trigger/Class.Trigger.Injection.php");
        $t = new TriggerInjection();
        $t->setTriggerInjection(false, $var, CONFIG_TRIGGER, CONFIG_TRIGGER_PUGE, CONFIG_TRIGGER_VARS);
    }
}
?>