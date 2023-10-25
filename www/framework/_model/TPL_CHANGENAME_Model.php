<?php
/**
 * TPL_CHANGENAME_Model, Model "base"
 *
 * The TPL_CHANGENAME_Model Class is the "base" model to mediate between the controller and the view by applying the model. Interact with the Database
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 * @subpackage Controller
 */
class TPL_CHANGENAME_Model extends AppAbstractConnectInstance{
    /**
     * $_table, name of the table to be used (it will be implemented as the name of the controller)
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
     * $_key, Primary KEY of the row in a table
     * @access private
     * @var number
     */
    private $_key = '';
    /**
     * $_fields_relation, group of KEYs in a table that have a relation with another table (KEY FORANEO)
     * @access private
     * @var array
     */
    private $_fields_relation = array();
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
     * $_f, instance of Functions
     * @access private
     * @var class
     */
    private $_f;
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
     * $_save_data_on_file, Indicates whether it generates a physical file with all the information
     * @access private
     * @var boolean
     */
    private $_save_data_on_file = false;
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
     * setFunctions public function
     * @uses AppSessions(), Class
     * @uses $this->_f, Instance
     * Note: Set the instance Functions
     */
    public function setFunctions($f){
        $this->_f = $f;
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
     * setRelationKey public function
     * @uses $fields_relation, array
     * Note: Fields Key Relation, Secondary Relations of a Table
     */
    public function setRelationKey($fields_relation=''){
        $this->_fields_relation = $fields_relation;	
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
     * Note: Order ASC DESC to apply in consultations
     */
    public function setSort($sort=''){
        $this->_sort = $sort;
    }
    /**
     * setRules public function
     * @uses $rules, string
     * Note: Set of rules / exceptions to apply
     */
    public function setRules($rules){
        $this->_rules = $rules;
    }
    /**
     * setSaveOnFile public function
     * @uses $fields, Array
     * Note: Generate a physical file with all the information (JSON into media/_data/controller.php)
     */
    public function setSaveOnFile($variable){
        $this->_save_data_on_file = $variable;
    }
    /**
     * setDataUser public function
     * @uses $data_admin, array
     * Note: set the data of the logged in user
     */
    public function setDataUser($data_admin){
        $this->_data_admin = $data_admin;
    }
    /**
     * setTotalRecords public function
     * @uses $_total_records, String
     * Note: Quantity of records, loaded after a select type query.
     */
    private function setTotalRecords($total_records=0){
        $this->_total_records = $total_records;	
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
    /**
     * setTotalRecords public function
     * @uses $_total_records, String
     * Note: Returns the number of records after a consultation
     */
    public function getTotalRecords(){
        return $this->_total_records;	
    }
    /**
     * getStructureDatabase public function
     * @uses QueryMethods, Class, Database
     * @uses setConn(), Method, Database
     * @uses getDatabaseDump(), Class
     * @uses $this->_conn, Object, Connection
     * @uses dirname(), Function
     * @uses unserialize(), Function
     * @uses PURGE_STRUCTURE_DATABASE, Constant
     * @uses CONFIG_DB_NAME, Constant
     * Note: Returns the structure of the database is the most important of the implementation of scaffolding. Everything related to the structure and meta data to solve the different views etc. etc. are inherited from the array $structure_bbddv
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
     * getRecordsPaged public function
     * Note: Return array with list of record sets, filtering and paging
     */
    public function getRecordsPaged(){
        $cl = new QueryMethods();
        $cl->setConn($this->_conn);
        $cl->setTable($this->_table);
        $cl->setFields($this->_fields);
        $cl->setKey($this->_key);
        $cl->setStatus($this->_status);
        $cl->setOrder($this->_order);
        $cl->setSort($this->_sort);

        $cl->setPager($this->_pager);
        $cl->setPagerQuantity($this->_pager_quantity);
        $cl->setPagerPage($this->_pager_page);

        $resultSelect = $cl->select();
        $estadoSelect = $cl->state();
        $this->setTotalRecords($cl->getTotalRecords());

        if($estadoSelect=='impact'){
            return $resultSelect;
        }else{
            return 'error';
        }
    }
    /**
     * getRecordsAll public function
     * Note: Returns an array with the list of record sets, without paging. Use to know the amount of record resulting from a select.
     */
    public function getRecordsAll(){
        $cl = new QueryMethods();
        $cl->setConn($this->_conn);
        $cl->setTable($this->_table);
        $cl->setFields($this->_fields);
        $cl->setStatus($this->_status);

        $resultSelect = $cl->selectTotalNum();
        $estadoSelect = $cl->state();

        return $resultSelect;
    }
    /**
     * getActivate public function
     * Note: Changes the "logical" state of a row in the Database. Use to change the state of the active field (status=0/1)
     */
    public function getActivate(){
        $cl = new QueryMethods();
        $cl->setConn($this->_conn);
        $cl->setTable($this->_table);
        $cl->setFields($this->_fields);
        $cl->setKey($this->_key);
        $cl->setStatus($this->_status);
        $cl->setRequest($_GET);
        $cl->setFieldApplied($this->_field_applied);
        $resultActivate = $cl->activate();
        
        if($resultActivate=='impact'){
            return $resultActivate;
        }else{
            return 'error';
        }
    }
    /**
     * getDelete public function
     * Note: Applies a "logical" deletion of a row in the data base. Use to delete (status=-1)
     */
    public function getDelete(){
        $cl = new QueryMethods();
        $cl->setConn($this->_conn);
        $cl->setTable($this->_table);
        $cl->setFields($this->_fields);
        $cl->setKey($this->_key);
        $cl->setStatus($this->_status);
        $cl->setRequest($_GET);
        $cl->setFieldApplied($this->_field_applied);
        //$cl->setRules($this->_rules);
        $resultDelete = $cl->delete();

        if($resultDelete=='impact'){
            return $resultDelete;
        }else{
            return 'error';
        }
    }
    /**
     * getEdit public function
     * Note: Array with the fields that the view will present as a form. Use to obtain record set to edit
     */
    public function getEdit(){
        $cl = new QueryMethods();
        $cl->setConn($this->_conn);
        $cl->setTable($this->_table);
        $cl->setFields($this->_fields);
        $cl->setKey($this->_key);
        $cl->setStatus($this->_status);
        $cl->setRequest($_GET);
        //$cl->setRules($this->_rules);
        //$cl->setFieldApplied($this->_field_applied);
        $resultSingle = $cl->selectSingle();

        if(!empty($resultSingle[0]->password)){
            $crypt_text = $this->_table==CONFIG_DB_PREFIX.'users' ? CRYPT_VAR_USERS : CRYPT_VAR;
            $this->getCrypter();
            $this->_crypter->setKey($crypt_text);
            $deCrypter = $this->_crypter->getDecrypt($resultSingle[0]->password);
            $resultSingle[0]->password = $deCrypter; 
        }

        if($resultSingle!='error'){
            return $resultSingle;
        }else{
            return 'error1';
        }
    }
    /**
     * getTalos01 public function
     * Note: It treats the data of a query of type ID and inserts the data, in addition it treats data passed by GET, POST and REQUEST. It deals with the data posted. Use to Insert.
     */
    public function getTalos01(){
        # Aplicamos spread() 
        $_GET['id_user'] = $this->_p->spread('get','id_user',0);
        $_POST['id_user'] = $this->_p->spread('post','id_user',0);
        $_REQUEST['id_user'] = $this->_p->spread('request','id_user',0);

        if(!empty($_GET['id_user'])){
            $theIdUsuario = $_GET['id_user'];
        }elseif(!empty($_POST['id_user'])){
            $theIdUsuario = $_POST['id_user'];
        }elseif(!empty($_REQUEST['id_user'])){
            $theIdUsuario = $_REQUEST['id_user']; 
        }

        $cl = new QueryMethods();
        $cl->setConn($this->_conn);
        $cl->setTable($this->_table);
        $cl->setFields($this->_fields);
        $cl->setKey($this->_key);
        $cl->setRequest($_REQUEST);
        $cl->setRules($this->_rules);
        $resultInsertar = $cl->insert();

        if($resultInsertar!='error'){
            return $resultInsertar;
        }else{
            return 'error';
        }
    }
    /**
     * getTalos02 public function
     * Note: Array with the fields that the view will present as a form. Use for Updates.
     */
    public function getTalos02(){
        # Aplicamos spread() 
        $_GET['id_user'] = $this->_p->spread('get','id_user',0);
        $_POST['id_user'] = $this->_p->spread('post','id_user',0);
        $_REQUEST['id_user'] = $this->_p->spread('request','id_user',0);

        if(!empty($_GET['id_user'])){ 
            $theIdUsuario = $_GET['id_user'];
        }elseif(!empty($_POST['id_user'])){
            $theIdUsuario = $_POST['id_user'];
        }elseif(!empty($_REQUEST['id_user'])){
            $theIdUsuario = $_REQUEST['id_user']; 
        }
        // print_r($_REQUEST);
        // exit();

        $cl = new QueryMethods();
        $cl->setConn($this->_conn);
        $cl->setTable($this->_table);
        $cl->setFields($this->_fields);
        $cl->setKey($this->_key);
        $cl->setRelationKey($this->_fields_relation);
        $cl->setRequest($_REQUEST);
        $cl->setRules($this->_rules);

        $resultUpdate = $cl->update();

        if($resultUpdate!='error'){
            return $resultUpdate;
        }else{
            return 'error';
        }
    }
    /**
     * getDisposition public function
     * Note: Apply an index change on the ORDER field of the table, Use to change the state of the order
     */
    public function getDisposition(){
        $cl = new QueryMethods();
        $cl->setConn($this->_conn);
        $cl->setTable($this->_table);
        $cl->setFields($this->_fields);
        $cl->setKey($this->_key);
        $cl->setStatus($this->_status);
        $cl->setOrder($this->_order);
        $cl->setRequest($_GET);
        $cl->setFieldApplied($this->_field_applied);
        $result = $cl->disposition();

        if($result=='impact'){
            return $result;
        }else{
            return 'error';
        }
    }
    /**
     * getFilterPaged public function
     * Note: Obtain a list of record sets filtered and paginated. Use to Filter
     */
    public function getFilterPaged(){
        $cl = new QueryMethods();
        $cl->setConn($this->_conn);
        $cl->setTable($this->_table);
        $cl->setFields($this->_fields);
        $cl->setKey($this->_key);
        $cl->setStatus($this->_status);
        $cl->setOrder($this->_order);
        $cl->setSort($this->_sort);
        $cl->setRequest($_GET);
        $cl->setFieldAppliedArray($this->_field_applied_array);

        if($this->_pager){
            $cl->setPager($this->_pager);
            $cl->setPagerQuantity($this->_pager_quantity);
            $cl->setPagerPage($this->_pager_page);
        }

        $resultFilter = $cl->filterPaged();
        $estadoFilter = $cl->state();
        $this->setTotalRecords($cl->getTotalRecords());

        if($estadoFilter=='impact'){
            return $resultFilter;
        }else{
            return 'error';
        }
    }
    /**
     * getExport public function
     * Note: It obtains a list of record sets so that the view can generate the download of them in XLS format. Use to export data in .xls format
     */
    public function getExport(){
        $cl = new QueryMethods();
        $cl->setConn($this->_conn);
        $cl->setTable($this->_table);
        $cl->setFields($this->_fields);
        $cl->setKey($this->_key);
        $cl->setStatus($this->_status);
        $cl->setOrder($this->_order);
        $cl->setSort($this->_sort);

        $resultExport = $cl->select();
        $estadoSelect = $cl->state();

        $this->setTotalRecords($cl->getTotalRecords());

        if($estadoSelect=='impact'){
            return $resultExport;
        }else{
            return 'error';
        }        
    }
    /**
     * getPreview public function
     * Note: Get the detail of record sets so that the view can only show them. Use to show content
     */
    public function getPreview(){
        $cl = new QueryMethods();
        $cl->setConn($this->_conn);
        $cl->setTable($this->_table);
        $cl->setFields($this->_fields);
        $cl->setKey($this->_key);
        $cl->setStatus($this->_status);
        $cl->setRequest($_GET);
        $resultSingle = $cl->selectSingle();

        if($resultSingle!='error'){
            return $resultSingle;
        }else{
            return 'error1';
        }
    }
    /**
     * getDuplicate public function
     * Note: Duplicate a record in a table given an ID. Use for Duplicate
     */
    public function getDuplicate(){
        $cl = new QueryMethods();
        $cl->setConn($this->_conn);
        $cl->setTable($this->_table);
        $cl->setFields($this->_fields);
        $cl->setKey($this->_key);
        $cl->setStatus($this->_status);
        $cl->setRequest($_GET);
        $cl->setFieldApplied($this->_field_applied);
        $cl->setOrder($this->_order);
        //$cl->setRules($this->_rules);
        $resultDuplicate = $cl->duplicate();

        if($resultDuplicate=='impact'){
            return $resultDuplicate;
        }else{
            return 'error';
        }
    }
    /**
     * getRecordsPagedAjax public function
     * Note: Return array with list of record sets, filtering and paging
     */
    public function getRecordsPagedAjax(){
        $cl = new QueryMethods();
        $cl->setConn($this->_conn);
        $cl->setTable($this->_table);
        $cl->setFields($this->_fields);
        $cl->setKey($this->_key);
        $cl->setStatus($this->_status);
        $cl->setOrder($this->_order);
        $cl->setSort($this->_sort);

        $cl->setPager($this->_pager);
        $cl->setPagerQuantity($this->_pager_quantity);
        $cl->setPagerPage($this->_pager_page);

        $resultSelect = $cl->select();
        $estadoSelect = $cl->state();
        $this->setTotalRecords($cl->getTotalRecords());

        if($estadoSelect=='impact'){
            return $resultSelect;
        }else{
            return 'error';
        }
    }

    /**
     * getRecordsPagedAjaxFull public function
     * Note: Return array with list of record sets, filtering and paging
     */
    public function getRecordsPagedAjaxFull(){
        $cl = new QueryMethods();
        $cl->setConn($this->_conn);
        $cl->setTable($this->_table);
        $cl->setFields($this->_fields);
        $cl->setKey($this->_key);
        $cl->setStatus($this->_status);
        $cl->setOrder($this->_order);
        $cl->setSort($this->_sort);
        $cl->setRequest($_GET);
        $cl->setFieldAppliedArray($this->_field_applied_array);

        if($this->_pager){
            $cl->setPager($this->_pager);
            $cl->setPagerQuantity($this->_pager_quantity);
            $cl->setPagerPage($this->_pager_page);
        }

        $resultSelect = $cl->filterPagedAjax();
        $estadoSelect = $cl->state();
        $this->setTotalRecords($cl->getTotalRecords());

        if($estadoSelect=='impact'){
            return $resultSelect;
        }else{
            return 'error';
        }
    }
    /**
    * getMakeFile public function
     * Note: Generates an Object with the records of the table that is physically saved. Use to generate physical object
    */
    public function getMakeFile(){
        if($this->_save_data_on_file==true){
            if(in_array('field_order',$this->_fields)){
                $data_table = $this->getInjection("SELECT * FROM ".$this->_table." WHERE status='1' or status='3' order by field_order asc");
            }else if($this->_table==CONFIG_DB_PREFIX.'paises'){
                $data_table = $this->getInjection("SELECT * FROM ".$this->_table." WHERE status='1' or status='3' order by name asc");
            }else{
                if($this->_table==CONFIG_DB_PREFIX.'administrators'){
                    $data_table = $this->getInjection("SELECT id_administrator, api_token, access_api FROM ".$this->_table." WHERE status='1' or status='3'");
                }else{
                    $data_table = $this->getInjection("SELECT * FROM ".$this->_table." WHERE status='1' or status='3'");
                }
            }

            if(!empty($data_table)){
                if($this->_table!=CONFIG_DB_PREFIX.'administrators' && $this->_table!=CONFIG_DB_PREFIX.'users'){
                    $data_table_encode = json_encode($data_table);
                    $data_table_decode = json_decode($data_table_encode, true);

                    $path = dirname(__FILE__).'/../../material/_data/'.$this->_table.'.inc';

                    if(file_exists($path)){
                        @unlink($path);
                    }

                    $dump_fp = fopen($path,"w");

                    if($dump_fp != false){
                        fwrite($dump_fp, serialize($data_table_decode));
                        fclose($dump_fp);
                    }
                }
                if($this->_table==CONFIG_DB_PREFIX.'administrators')
                {
                    $data_table_encode = json_encode($data_table);
                    $data_table_decode = json_decode($data_table_encode, true);
                    $data_table_encypt = array();

                    foreach($data_table_decode as $k=>$v){
                        $indice = $k;
                        $data_table_encypt[$indice]['ia'] = $v['id_administrator'];
                        $data_table_encypt[$indice]['at'] = $v['api_token'];
                        $data_table_encypt[$indice]['aa'] = $v['access_api'];
                    }

                    $path = dirname(__FILE__).'/../../material/_data/'.CONFIG_DB_PREFIX.'oauth.inc';

                    if(file_exists($path)){
                        @unlink($path);
                    }

                    $dump_fp = fopen($path,"w");

                    if($dump_fp != false){
                        fwrite($dump_fp, serialize($data_table_encypt));
                        fclose($dump_fp);
                    }
                }
            }
            // else
            // {
            //     $path = dirname(__FILE__).'/../../material/_data/'.$this->_table.'.inc';

            //     if(file_exists($path)){
            //         @unlink($path);
            //     }

            //     $dump_fp = fopen($path,"w");

            //     if($dump_fp != false){
            //         fwrite($dump_fp, '');
            //         fclose($dump_fp);
            //     }
            // }
        }
    }
    /**
    * getInjection public function
     * Note: Inject a query directly into the database. Use to inject code directly
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