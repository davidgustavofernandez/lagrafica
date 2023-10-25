<?php
/**
 * loginModel, Model login
 * 
 * The loginModel class is the model to mediate between the controller and the view by applying the model. Extends the connection instance, Interact with the DB.
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 * @subpackage Controller
 */
class loginModel extends AppAbstractConnectInstance{
  /**
   * $_table, it will be the name of the table to be implemented (it is implemented as the name of the controller)
   * @access private
   * @var string
   */
  private $_table = '';
  /**
   * $_fields, array of existing fields in a table to be used (automatic)
   * @access private
   * @var array
   */
  private $_fields = array();
  /**
   * $_field_applied, array of existing fields in a table to be used (configured)
   * @access private
   * @var array
   */
  private $_field_applied = '';
  /**
   * $_field_applied_array, array of variables to apply
   * @access private
   * @var array
   */
  private $_field_applied_array = array();
  /**
   * $_key, the primary KEY in a table
   * @access private
   * @var number
   */
  private $_key = '';
  /**
   * $_status, status field of a table
   * @access private
   * @var string
   */
  private $_status = 'status';
  /**
   * $_order, field to apply order of a table
   * @access private
   * @var string
   */
  private $_order = 'field_order';
  /**
   * $_sort, field to indicate the ASC DESC order to apply in queries
   * @access private
   * @var string
   */
  private $_sort = 'ASC';
  /**
   * $_totalRecords, record amount (pager)
   * @access private
   * @var number
   */
  private $_totalRecords;
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
  private $_pager_quantity;
  /**
   * $_rules, will be the set of rules to apply when a KEY is foreign
   * @access private
   * @var array
   */
  private $_rules = array();
  /**
   * $_p, instance of Propagate
   * @access private
   * @var string
   */
  private $_p;
  /**
   * $_total_records, total record amount of a table (pager)
   * @access private
   * @var number
   */
  private $_total_records = 0;
  /**
   * $_crypter, instance of the Crypt class. Used to store and retrieve the data of the session in an "encrypted" way
   * @access private
   * @var object
   */
  private $_crypter;
  /**
   * $_data_admin, administrator user data matrix, logged in
   * @access private
   * @var object
   */
  private $_data_admin;
  /**
   * $_search_on, Matrix with fields where the search is applied
   * @access private
   * @var array
   */
  private $_search_on = array();
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
   * Note: Constructor sets up
   */
  /*function __construct()
  {
  }*/
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
   * setTable public function
   * @uses $table, String
   * Note: Controller = name table
   */
  public function setTable($table){
    $this->_table = $table;
  }
  /**
   * setFields public function
   * @uses $fields, Array
   * Note: Set of fields to use
   */
  public function setFields($fields){
    $this->_fields = $fields;
  }
  /**
   * setFieldApplied public function
   * @uses $field_applied, Array
   * Note: Set of specific field to use
   */
  public function setFieldApplied($field_applied){
    $this->_field_applied = $field_applied;
  }
  /**
   * setFieldAppliedArray public function
   * @uses $field_applied_array, Array
   * Note: Set of specific fields to use
   */
  public function setFieldAppliedArray($field_applied_array){
    $this->_field_applied_array = (array)$field_applied_array;
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
   * setPagerQuantity public function
   * @uses $pager_quantity, number
   * Note: Amount per page
   */
  public function setPagerQuantity($pager_quantity){
    $this->_pager_quantity = $pager_quantity;
  }
  /**
   * setPagerPage public function
   * @uses $pager_page, number
   * Note: Actual page
   */
  public function setPagerPage($pager_page){
    $this->_pager_page = $pager_page;
  }
  /**
   * setKey public function
   * @uses $key, number
   * Note: Primary KEY of the table
   */
  public function setKey($key=''){
    $this->_key = $key;	
  }
  /**
   * setStatus public function
   * @uses $status, number
   * Note: Status field of a table (logical deletion applied)
   */
  public function setStatus($status=''){
    $this->_status = $status;
  }
  /**
   * setOrder public function
   * @uses $order, string
   * Note: Field of a table to apply order
   */
  public function setOrder($order=''){
    $this->_order = $order;
  }
  /**
   * setSort public function
   * @uses $sort, string
   * Note: Campo para indicar el orden ASC DESC a aplicar en las consultas
   */
  public function setSort($sort=''){
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
   * setSearchFilters public function
   * @uses $search_filters, String
   * Note: Array of fields and value, to be applied 
   */
  public function setSearchFilters($search_filters){
    $this->_search_filters = $search_filters;
  }
  /**
   * setParamFilter public function
   * @uses $_params_filter, String
   * Note: Function that seta array with fields to be omitted in the insert.
  */
  public function setParamFilter($params_filter){
      $this->_params_filter = $params_filter;	
  }
  /**
   * getStructureDatabase public function
   * @uses QueryMethods, Class, Database
   * @uses setConn(), Method, Database
   * @uses getDatabaseDump(), Class
   * @uses $this->_conn, Object, Conection
   * @uses dirname(), Function
   * @uses unserialize(), Function
   * @uses PURGE_STRUCTURE_DATABASE, Constant
   * @uses CONFIG_DB_NAME, Constant
   * Note: Returns the structure of the database is the most important of the implementation of scaffolding. Everything related to the structure and metadata to solve the different views etc. etc. are inherited from the array $structure_bbddv
   */
  public function getStructureDatabase(){
    $cl = new QueryMethods();
    $cl->setConn($this->_conn);

    $path = dirname(__FILE__).'/../_lib/database/structure/data.inc';

    // Is the bbdd cached?
    if(file_exists($path)){
      $estructura_bbdd = unserialize(file_get_contents($path));
      // Exist
      if( !array_key_exists(CONFIG_DB_NAME, $estructura_bbdd) ){
        // The Database does not match the one in the cache. Delete the cache database
        $estructura_bbdd = $cl->getDatabaseDump(true);
      }
    }else{ 
      // NO exist;
      $estructura_bbdd = $cl->getDatabaseDump(true);
    }
    
    return $estructura_bbdd;
  }
  /**
    * destroy public function
    * Note: Delete the data in session. Use to "log off"
    */
  public function distroy(){}
  /**
   * getLogin public function
   * Note: Returns structure. Use for login
   */
  public function getLogin(){
    $resultEdit = array(
      (object)array(
        'id_administrator' => '',
        'name' => '',
        'last_name' => '',
        'email' => '',
        'file' => '',
        'user' => '',
        'password' => '',
        'moderator' => '',
        'date' => '0000-00-00 00:00:00',
        'modified' => '0000-00-00 00:00:00',
        'status' => '0'
      ),
      'id_administrator'
    );

    if($resultEdit!='error'){
      return $resultEdit;
    }else{
      return 'error1';
    }
  }
  /**
   * getRecover public function
   * Note: Returns structure. Use to recover password
   */
  public function getRecover(){
    $resultRecover = array(
      (object)array(
        'id_administrator' => '',
        'name' => '',
        'last_name' => '',
        'email' => '',
        'file' => '',
        'user' => '',
        'password' => '',
        'moderator' => '',
        'date' => '0000-00-00 00:00:00',
        'modified' => '0000-00-00 00:00:00',
        'status' => '0'
      ),
      'id_administrator'
    );

    if($resultRecover!='error'){
      return $resultRecover;
    }else{
      return 'error1';
    }
  }
  /**
   * getProcessRecover public function
   * Note: Returns a query and its structure. Use to obtain a single record
   */
  public function getProcessRecover(){
    $cl = new QueryMethods();
    $cl->setConn($this->_conn);
    $cl->setTable($this->_table);
    $cl->setFields($this->_fields);
    $cl->setKey($this->_key);
    $cl->setRequest($_POST);
    $cl->setFieldAppliedArray($this->_field_applied_array);
    $resultExist = $cl->existMulti();

    if($resultExist!='error'){
      return $resultExist;
    }else{
      return 'error1';
    }
  }
  /**
   * getChange public function
   * Note: Return structure. Use to recover pass
   */
  public function getChange(){
    $resultChange = array(
      (object)array(
        'id_administrator'  => '',
        'name' => '',
        'last_name' => '',
        'email' => '',
        'file' => '',
        'user' => '',
        'password' => '',
        'moderator' => '',
        'password_recover' => '',
        'date' => '0000-00-00 00:00:00',
        'modified' => '0000-00-00 00:00:00',
        'status' => '0'
      ),
      'id_administrator'
    );

    if($resultChange!='error'){
      return $resultChange;
    }else{
      return 'error1';
    }
  }
  /**
   * getStructureDatabase public function
   * Note: Return array with list of recordsets, filtering and paging
   */
  public function getRecordsPaged(){
    $cl = new QueryMethods();
    $cl->setConn($this->_conn);
    $cl->setTable($this->_table);
    $cl->setFields($this->_fields);
    $cl->setKey($this->_key);
    $cl->setStatus($this->_status);
    //echo $this->_status;
    $cl->setPager($this->_pager);
    $cl->setPagerQuantity($this->_pager_quantity);
    $cl->setPagerPage($this->_pager_page);

    $resultSelect = $cl->select();
    $estadoSelect = $cl->state();

    if($estadoSelect=='impact'){
      return $resultSelect;
    }else{
      return 'error';
    }
  }
  /**
   * getProcess public function
   * Note: Returns data and its structure. Use to obtain a single record
   */
  public function getProcess(){
    $cl = new QueryMethods();
    $cl->setConn($this->_conn);
    $cl->setTable($this->_table);
    $cl->setFields($this->_fields);
    $cl->setKey($this->_key);
    $cl->setRequest($_POST);
    $cl->setFieldAppliedArray($this->_field_applied_array);
    $resultExist = $cl->existMulti();

    if($resultExist!='error'){
      return $resultExist;
    }else{
      return 'error1';
    }
  }
  /**
   * getInjection public function
   * Note: Inject a query directly into the Use DB to inject code directly
   */
  public function getInjection($query){
    if(!empty($query)){
      $cl = new QueryMethods();
      $cl->setConn($this->_conn);
      $resultSelect = $cl->injection($query);
      $estadoSelect = $cl->state();

      return $resultSelect;
    }else{
      return 'error';
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