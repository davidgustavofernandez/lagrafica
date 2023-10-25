<?php

/**
 * QueryMethods, Collection of methods that apply queries
 * 
 * The QueryMethods Class extends Query and is responsible for interacting with Query to indirectly manipulate the Database
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * QueryMethods class, 
 * @package {SMVC} Simple Model View Controller
 * @subpackage database
 */
class QueryMethods extends Query
{
  private $_database = CONFIG_DB_NAME;
  private $_table = '';
  private $_key = '';
  private $_fields_relation = array();
  private $_status = '';
  private $_order = 'field_order';
  private $_sort = '';
  private $_fields = array();
  private $_field_applied = '';
  private $_field_applied_array = array();
  private $_request = array();
  private $_configDatabaseMethodsTablaNames = array();
  private $_configDatabaseMethodsFromDatabase = array();

  private $_pager = false;
  private $_pager_type = 'html';
  private $_pager_url = 0;
  private $_pager_page = 0;
  private $_pager_quantity = 10;
  private $_pager_propagate = array();

  private $_total_records = 0;

  private $_rules = array();
  private $_data_user = array();
  private $_data_user_id;
  private $_data_user_variable;
  private $_this_join;

  private $_params_filter = array();
  private $_search_on = array();
  private $_search_off = array();
  private $_search_filters = array();

  private $posteos_names = array();
  private $posteos_values = array();

  public function setPager($paginador)
  {
    $this->_pager = $paginador;
  }

  public function setPagerType($pager_type)
  {
    $this->_pager_type = $pager_type;
  }

  public function setPagerUrl($pager_url)
  {
    $this->_pager_url = $pager_url;
  }

  public function setPagerPage($pager_page)
  {
    $this->_pager_page = (int) $pager_page;
  }

  public function setPagerQuantity($pager_quantity)
  {
    $this->_pager_quantity = $pager_quantity;
  }

  public function setPagerPropagate($pager_propagate)
  {
    $this->_pager_propagate = $pager_propagate;
  }

  public function setRules($rules)
  {
    $this->_rules = $rules;
  }

  /**
   * setConn public function
   * @uses $conn, Object
   * @uses $this->setConection(), Function
   * @see setConection()
   * Note: Function that receives and sets the pointer and makes it available for use.
   */
  public function setConn($conn)
  {
    $this->setConection($conn);
  }

  /**
   * setDatabase public function
   * @uses $database, String
   * Note: Function that receives and sets the name of the database to be used.
   */
  public function setDatabase($database = '')
  {
    $this->_database = $database;
  }

  /**
   * setTable public function
   * @uses $table, String
   * Note: Function that receives and sets the name of the table to be used.
   */
  public function setTable($table = '')
  {
    $this->_table = $table;
  }

  /**
   * setFields public function
   * @uses $fields, Array
   * Note: Function that receives and sets the fields to be used.
   */
  public function setFields($fields = '')
  {
    $this->_fields = $fields;
  }

  /**
   * setFieldApplied public function
   * @uses $field, String
   * Note: Function that receives and sets a particular faithful (is used to apply changes to only one field).
   */
  public function setFieldApplied($field_applied)
  {
    $this->_field_applied = $field_applied;
  }

  /**
   * setFieldAppliedArray public function
   * @uses $field, String
   * Note: Function that receives and sets a particular faithful (is used to apply changes to only one field).
   */
  public function setFieldAppliedArray($field_applied_array)
  {
    $this->_field_applied_array = $field_applied_array;
  }

  /**
   * setRequest public function
   * @uses $request, Array
   * Note: Function that receives and sets all the elements that come from $_REQUEST, $_GET or $_POST to use.
   */
  public function setRequest($request = '')
  {
    $this->_request = $request;
  }

  /**
   * setKey public function
   * @uses $key, String
   * Note: Function that receives and sets the ID in the table to be used.
   */
  public function setKey($key = '')
  {
    $this->_key = $key;
  }

  /**
   * setRelationKey public function
   * @uses $fields_relation, array
   * Note: Function that receives and sets the set of fields in a table that have a relation with another table (KEY FORANEO)
   */
  public function setRelationKey($fields_relation = '')
  {
    $this->_fields_relation = $fields_relation;
  }

  /**
   * setStatus public function
   * @uses $status, number
   * Note: Function that receives and sets the status of a field in the table
   */
  public function setStatus($status = '')
  {
    $this->_status = $status;
  }

  /**
   * setOrder public function
   * @uses $order, string
   * Note: Function receiving and order to apply in the select
   */
  public function setOrder($order = '')
  {
    $this->_order = $order;
  }

  /**
   * setSort public function
   * @uses $sort, string
   * Note: Function that receives the type of order to apply
   */
  public function setSort($sort = '')
  {
    $this->_sort = $sort;
  }

  /**
   * setTotalRecords public function
   * @uses $_total_records, String
   * Note: Function that seta the number of records after a query.
   */
  private function setTotalRecords($total_records)
  {
    $this->_total_records = $total_records;
  }

  /**
   * setDataUser public function
   * @uses $data_user, Array
   * Note: Function that seta the data of the logged user to apply when recovering data related to it.
   */
  public function setDataUser($data_user)
  {
    $this->_data_user     = $data_user;
    $this->_data_user_id   = $data_user['id_user'];
  }
  /**
   * setDataAdministrator public function
   * @uses $data_user, Array
   * Note: Function that sets the data of the logged user to apply when recovering data related to it.
   */
  public function setDataAdministrator($data_user, $data_user_variable)
  {
    $this->_data_user       = $data_user;
    $this->_data_user_id     = $data_user['id_user'];
    $this->_data_user_variable   = $data_user_variable;
  }

  /**
   * setDataUser public function
   * @uses $data_user, Array
   * Note: Function that sets the data of the logged user to apply when recovering data related to it.
   */
  public function setThisJoin($this_join)
  {
    $this->_this_join = $this_join;
  }

  /**
   * setSearchOn public function
   * @uses $search_on, String
   * Note: Matrix with fields where the search is applied
   */
  public function setSearchOn($search_on)
  {
    $this->_search_on = $search_on;
  }

  /**
   * setSearchOff public function
   * @uses $search_off, String
   * Note: Array with fields to return
   */
  public function setSearchOff($search_off)
  {
    $this->_search_off = $search_off;
  }


  /**
   * setSearchFilters public function
   * @uses $search_filters, String
   * Note: Array of fields and value, to be applied 
   */
  public function setSearchFilters($search_filters)
  {
    $this->_search_filters = $search_filters;
  }

  /**
   * setParamFilter public function
   * @uses $_params_filter, Array
   * Note: Function that seta Array with fields to be omitted in the insert.
   */
  public function setParamFilter($params_filter)
  {
    $this->_params_filter = $params_filter;
  }

  /**
   * setTotalRecords public function
   * @uses $_total_records, String
   * Note: Function that sets the number of records after a query.
   */
  public function getTotalRecords()
  {
    return $this->_total_records;
  }

  /**
   * state public function
   * @uses $this->getState(), Function
   * @return $estado, String
   * Note: Function responsible for returning the state that is configured in each function.
   */
  public function state()
  {
    return $this->getState();
  }

  /**
   * select public function
   * @uses $this->generateDatbaseTableField(), Function
   * @uses $this->validateDatbaseTableFields(), Function
   * @uses $this->_fields, Array
   * @uses $this->setQuery(), Function
   * @uses $this->getState(), Function
   * @see $this->generateDatbaseTableField()
   * @see $this->validateDatbaseTableFields()
   * @return $record, Array
   * Note: Function responsible for processing the SELECTS data and injecting them using getQuery ().
   */
  public function select()
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTableFields();

    if ($resultValidate) {
      if (!empty($this->_fields) && is_array($this->_fields)) {
        $s = '';
        $n = count($this->_fields);
        $_have_order = false;

        for ($i = 0; $i < $n; $i++) {
          $s .= $i < ($n - 1) ? $this->_fields[$i] . ', ' : $this->_fields[$i];
        }

        if (in_array($this->_order, $this->_fields)) {
          $_have_order = true;
        }

        $query = 'SELECT ' . $s . ' FROM ' . $this->_table . ' ';

        if (!empty($this->_key)) {
          $query .= (!empty($this->_key)) ? ' WHERE ' . $this->_key . '>=0 ' : ' ';
        }

        if (!empty($this->_status)) {
          $query .= (!empty($this->_status)) ? ' AND ' . $this->_status . '>=0 ' : ' ';
        }

        if (!empty($this->_search_filters)) {
          $nameLength = count($this->_search_filters);
          $nn = 0;
          $query .= ' AND ';
          foreach ($this->_search_filters as $k => $v) {
            $sepa = $nn < ($nameLength - 1) ? ' AND ' : ' ';
            $query .= $k . " = '" . $v . "'" . $sepa;
            $nn = $nn + 1;
          }
        }

        if (!empty($this->_order) && $_have_order == true) {
          $query .= (!empty($this->_order)) ? ' ORDER BY ' . $this->_order . ' ' . $this->_sort . ' ' : ' ';
        } else if (!empty($this->_key)) {
          $query .= (!empty($this->_key)) ? ' ORDER BY ' . $this->_key . ' ' . $this->_sort . ' ' : ' ';
        }

        $queryTotal = $query;
        // echo $queryTotal;
        // exit();

        if ($this->_pager == true) {
          $pager_type = $this->_pager_type;
          $pager_url = $this->_pager_url;
          $pager_quantity = $this->_pager_quantity;
          $pager_start = $this->_pager_page * $this->_pager_quantity;
          $query .= " LIMIT $pager_start,$pager_quantity ";
        }
        $this->setQuery($query);
        $record = $this->getQuery();
        $estado = $this->getState();

        if ($estado == 'impact') {
          $this->setQuery($queryTotal);
          $rec = $this->getQuery();
          $est = $this->getState();

          if ($est == 'impact') {
            if (!empty($rec)) {
              $this->setTotalRecords(count($rec));
            }
          }
          return $record;
        }
      } else {
        $query = 'SELECT * FROM ' . $this->_table;

        if ($this->_pager == true) {
          $pager_type = $this->_pager_type;
          $pager_url = $this->_pager_url;
          $pager_quantity = $this->_pager_quantity;
          $pager_start = $this->_pager_page * $this->_pager_quantity;
          $query .= " LIMIT $pager_start,$pager_quantity ";
        }

        $this->setQuery($query);
        $record = $this->getQuery();
        $estado = $this->getState();

        if ($estado == 'impact') {
          return $record;
        }
      }
    } else {
      $this->setState('error');
    }
  }

  public function selectActive()
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTableFields();

    if ($resultValidate) {
      if (!empty($this->_fields) && is_array($this->_fields)) {
        $s = '';
        $n = count($this->_fields);
        $_have_order = false;

        for ($i = 0; $i < $n; $i++) {
          $s .= $i < ($n - 1) ? $this->_fields[$i] . ', ' : $this->_fields[$i];
        }

        if (in_array($this->_order, $this->_fields)) {
          $_have_order = true;
        }

        $query = 'SELECT ' . $s . ' FROM ' . $this->_table . ' ';

        if (!empty($this->_key)) {
          $query .= (!empty($this->_key)) ? ' WHERE ' . $this->_key . '>=0 ' : ' ';
        }

        if (!empty($this->_status)) {
          $query .= (!empty($this->_status)) ? ' AND ' . $this->_status . '>0 ' : ' ';
        }

        if (!empty($this->_search_filters)) {
          $nameLength = count($this->_search_filters);
          $nn = 0;
          $query .= ' AND ';
          foreach ($this->_search_filters as $k => $v) {
            $sepa = $nn < ($nameLength - 1) ? ' AND ' : ' ';
            $query .= $k . " = '" . $v . "'" . $sepa;
            $nn = $nn + 1;
          }
        }

        if (!empty($this->_order) && $_have_order == true) {
          $query .= (!empty($this->_order)) ? ' ORDER BY ' . $this->_order . ' ' . $this->_sort . ' ' : ' ';
        } else if (!empty($this->_key)) {
          $query .= (!empty($this->_key)) ? ' ORDER BY ' . $this->_key . ' ' . $this->_sort . ' ' : ' ';
        }

        $queryTotal = $query;
        // echo $queryTotal;
        // exit();

        if ($this->_pager == true) {
          $pager_type = $this->_pager_type;
          $pager_url = $this->_pager_url;
          $pager_quantity = $this->_pager_quantity;
          $pager_start = $this->_pager_page * $this->_pager_quantity;
          $query .= " LIMIT $pager_start,$pager_quantity ";
        }
        $this->setQuery($query);
        $record = $this->getQuery();
        $estado = $this->getState();

        if ($estado == 'impact') {
          $this->setQuery($queryTotal);
          $rec = $this->getQuery();
          $est = $this->getState();

          if ($est == 'impact') {
            if (!empty($rec)) {
              $this->setTotalRecords(count($rec));
            }
          }
          return $record;
        }
      } else {
        $query = 'SELECT * FROM ' . $this->_table;

        if ($this->_pager == true) {
          $pager_type = $this->_pager_type;
          $pager_url = $this->_pager_url;
          $pager_quantity = $this->_pager_quantity;
          $pager_start = $this->_pager_page * $this->_pager_quantity;
          $query .= " LIMIT $pager_start,$pager_quantity ";
        }

        $this->setQuery($query);
        $record = $this->getQuery();
        $estado = $this->getState();

        if ($estado == 'impact') {
          return $record;
        }
      }
    } else {
      $this->setState('error');
    }
  }

  /**
   * selectTotalNum public function
   * @uses $this->generateDatbaseTableField(), Function
   * @uses $this->validateDatbaseTableFields(), Function
   * @uses $this->_fields, Array
   * @uses $this->setQuery(), Function
   * @uses $this->getState(), Function
   * @see $this->generateDatbaseTableField()
   * @see $this->validateDatbaseTableFields()
   * @return $record, Array
   * Note: Function responsible for bringing the total record of a query using getQuery ().
   */
  public function selectTotalNum()
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTableFields();

    if ($resultValidate) {
      if (!empty($this->_fields) && is_array($this->_fields)) {
        $s = '';
        $n = count($this->_fields);

        for ($i = 0; $i < $n; $i++) {
          $s .= $i < ($n - 1) ? $this->_fields[$i] . ', ' : $this->_fields[$i];
        }

        $query = 'SELECT ' . $s . ' FROM ' . $this->_table;
        $this->setQuery($query);
        $record = $this->getQueryTotalNum();
        $estado = $this->getState();

        if ($estado == 'impact') {
          return $record;
        }
      } else {
        $query = 'SELECT * FROM ' . $this->_table;
        $this->setQuery($query);
        $record = $this->getQueryTotalNum();
        $estado = $this->getState();

        if ($estado == 'impact') {
          return $record;
        }
      }
    } else {
      $this->setState('error');
    }
  }

  /**
   * selectTotalNumFilter public function
   * @uses $this->generateDatbaseTableField(), Function
   * @uses $this->validateDatbaseTableFields(), Function
   * @uses $this->_fields, Array
   * @uses $this->setQuery(), Function
   * @uses $this->getState(), Function
   * @see $this->generateDatbaseTableField()
   * @see $this->validateDatbaseTableFields()
   * @return $record, Array
   * Note: Function responsible for bringing the total record of a query using getQuery().
   */
  public function selectTotalNumFilter()
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTableFields();

    if ($resultValidate) {
      if (!empty($this->_field_applied_array[0]) && !empty($this->_fields) && is_array($this->_fields) && !empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);
        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (in_array($this->posteos_names[$i], $this->_fields)) {
            $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
          }
        }

        $namesArrayLength = count($this->_field_applied_array);
        $stingWhere = '';
        $n = 0;
        $aplica_and = false;

        foreach ($namesArray as $key => $value) {
          if ($key != $this->_order) {
            $separador = $aplica_and === true ? ' AND ' : '';

            if (in_array($key, $this->_field_applied_array)) {
              $stingWhere .= $separador . " " . $key . "='" . $value . "' ";
            }
            $aplica_and = true;
          }
        }

        $query = "SELECT * FROM " . $this->_table . " where " . $stingWhere . " ";

        $_have_order = false;

        if (in_array($this->_order, $this->_fields)) {
          $_have_order = true;
        }

        if (!empty($this->_order) && $_have_order == true) {
          $query .= (!empty($this->_order)) ? ' ORDER BY ' . $this->_order . ' ' . $this->_sort . ' ' : ' ';
        } else if (!empty($this->_key)) {
          $query .= (!empty($this->_key)) ? ' ORDER BY ' . $this->_key . ' ' . $this->_sort . ' ' : ' ';
        }

        $this->setQuery($query);
        $record = $this->getQueryTotalNum();
        $estado = $this->getState();

        if ($estado == 'impact') {
          return $record;
        } else {
          $this->setState('error');
        }
      } else if (!empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);
        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (in_array($this->posteos_names[$i], $this->_fields)) {
            $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
          }
        }

        $query = "SELECT * FROM " . $this->_table . " WHERE status='1' ";

        $this->setQuery($query);
        $record = $this->getQuery();
        $estado = $this->getState();

        if ($estado == 'impact') {
          return $record;
        } else {
          $this->setState('error');
        }
      }
    } else {
      $this->setState('error');
    }
  }

  /**
   * insert public function
   * @uses $this->generateDatbaseTableField(), Function
   * @uses $this->validateDatbaseTableFields(), Function
   * @uses $this->_fields, Array
   * @uses $this->_request, Array
   * @uses $this->setQuery(), Function
   * @uses $this->setInsert(), Function
   * @uses $this->getState(), Function
   * @uses $this->getLastId(), Function
   * @see $this->generateDatbaseTableField()
   * @see $this->validateDatbaseTableFields()
   * @return $this->getLastId(), String
   * Note: Function in charge of processing INSERT data and injecting it using setInsert().
   */
  public function insert()
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTableFields();

    if ($resultValidate) {
      if (!empty($this->_fields) && is_array($this->_fields) && !empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);

        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (!is_array($this->posteos_values[$i])) {
            if (in_array($this->posteos_names[$i], $this->_fields)) {
              $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
            }
          }
        }

        $namesArrayLength = count($namesArray);
        $finalSet = ' SET ';
        $n = 0;

        foreach ($namesArray as $key => $value) {
          if (is_array($this->_params_filter)) {
            if (!empty($value)) {
              $separador = $n < ($namesArrayLength - 1) ? ', ' : '';
              $finalSet = $finalSet . $key . "='" . $value . "'" . $separador;
            } elseif (empty($value) && $key == 'status') {
              $separador = $n < ($namesArrayLength - 1) ? ', ' : '';
              $finalSet = $finalSet . $key . "='0'" . $separador;
            } else {
              $is_id = strpos($key, 'id_');

              if ($is_id !== false) {
                $separador = $n < ($namesArrayLength - 1) ? ', ' : '';
                $finalSet = $finalSet . $key . "='0'" . $separador;
              }
            }
          }

          $n = $n + 1;
        }
        // echo 'INSERT INTO '.$this->_table.' '.$finalSet ;
        // exit();
        $this->setQuery('INSERT INTO ' . $this->_table . ' ' . $finalSet);
        $record = $this->setInsert();
        $estado = $this->getState();

        if ($estado == 'impact') {
          $lastId = $this->getLastId();
        } else {
          $lastId = 0;
        }

        if (!empty($lastId) && is_integer($lastId)) {
          if (array_key_exists($this->_order, $this->_configDatabaseMethodsFromDatabase[$this->_database][$this->_table]) && !empty($lastId)) {
            $this->injectionInsert("UPDATE " . $this->_table . " SET " . $this->_order . "='" . $lastId . "' where " . $this->_key . "='" . $lastId . "' ");
          }
          for ($i = 0; $i < $namesPostLength; $i++) {
            if (is_array($this->posteos_values[$i]) && is_array($this->_rules) && !empty($this->_rules[$this->posteos_names[$i]]['borra']) && !empty($this->_rules[$this->posteos_names[$i]]['inserta']) && !empty($this->posteos_values[$i])) {
              $this->injectionInsert(str_replace('[' . $this->_key . ']', $lastId, $this->_rules[$this->posteos_names[$i]]['borra']));

              foreach ($this->posteos_values[$i] as $valor) {
                $this->injectionInsert(str_replace('[' . $this->_rules[$this->posteos_names[$i]]['id_a'] . ']', intval($valor), str_replace('[' . $this->_rules[$this->posteos_names[$i]]['id_c'] . ']', $lastId, $this->_rules[$this->posteos_names[$i]]['inserta'])));
              }
            }
          }
        }
        return $lastId;
      } else {
        $this->setState('error');
      }
    } else {
      $this->setState('error');
    }
  }

  /**
   * delete public function
   * @uses $this->generateDatbaseTableField(), Function
   * @uses $this->validateDatbaseTable(), Function
   * @uses $this->_fields, Array
   * @uses $this->_request, Array
   * @uses $this->setQuery(), Function
   * @uses $this->setDelete(), Function
   * @uses $this->getState(), Function
   * @see $this->generateDatbaseTableField()
   * @see $this->validateDatbaseTableFields()
   * @return $this->getState(), String
   * Note: Function in charge of processing DELETE data and injecting it using setDelete(). LOGICAL DELETION
   */
  public function delete()
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTable();

    if ($resultValidate) {
      if (!empty($this->_fields) && is_array($this->_fields) && !empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);

        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (in_array($this->posteos_names[$i], $this->_fields)) {
            $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
          }
        }

        $namesArrayLength = count($namesArray);
        $finalSet = ' SET ' . $this->_field_applied . ' ="-1" ';

        foreach ($namesArray as $key => $value) {
          if ($key == $this->_key) {
            $idAplicar = $key;
            $idAplicarValue = $value;
          }
        }

        // echo "UPDATE ".$this->_table." ".$finalSet." where ".$idAplicar."='".$idAplicarValue."' ";
        // exit();

        $this->setQuery("UPDATE " . $this->_table . " " . $finalSet . " where " . $idAplicar . "='" . $idAplicarValue . "' ");
        $record = $this->setUpdate();
        $estado = $this->getState();

        if ($estado == 'impact') {
          return $estado;
        }
      } else {
        $this->setState('error');
      }
    } else {
      $this->setState('error');
    }
  }

  /**
   * delete01 public function
   * @uses $this->generateDatbaseTableField(), Function
   * @uses $this->validateDatbaseTable(), Function
   * @uses $this->_fields, Array
   * @uses $this->_request, Array
   * @uses $this->setQuery(), Function
   * @uses $this->setDelete(), Function
   * @uses $this->getState(), Function
   * @see $this->generateDatbaseTableField()
   * @see $this->validateDatbaseTableFields()
   * @return $this->getState(), String
   * Note: Function in charge of processing DELETE data and injecting it using setDelete (). LOGICAL DELETION
   */
  public function delete01()
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTable();

    if ($resultValidate) {
      if (!empty($this->_fields) && is_array($this->_fields) && !empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);
        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (!is_array($this->posteos_values[$i])) {
            if (in_array($this->posteos_names[$i], $this->_fields)) {
              $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
            }
          }
        }

        foreach ($namesArray as $key => $value) {
          if ($key == $this->_key) {
            $idAplicar = $key;
            $idAplicarValue = $value;
          }
        }

        // echo "DELETE FROM ".$this->_table." where ".$idAplicar."='".$idAplicarValue."' ";
        // exit();

        $this->setQuery("DELETE FROM " . $this->_table . " where " . $idAplicar . "='" . $idAplicarValue . "' ");
        $record = $this->setUpdate();
        $estado = $this->getState();

        if ($estado == 'impact') {
          return $estado;
        }
      } else {
        $this->setState('error');
      }
    } else {
      $this->setState('error');
    }
  }

  /**
   * update public function
   * @uses $this->generateDatbaseTableField(), Function
   * @uses $this->validateDatbaseTableFields(), Function
   * @uses $this->_fields, Array
   * @uses $this->_request, Array
   * @uses $this->setQuery(), Function
   * @uses $this->setUpdate(), Function
   * @uses $this->getState(), Function
   * @see $this->generateDatbaseTableField()
   * @see $this->validateDatbaseTableFields()
   * @return $this->getState(), String
   * Note: Function in charge of processing UPDATE data and injecting it using setUpdate().
   */
  public function update()
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTableFields();

    if ($resultValidate) {
      if (!empty($this->_fields) && is_array($this->_fields) && !empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);
        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (!is_array($this->posteos_values[$i])) {
            if (in_array($this->posteos_names[$i], $this->_fields)) {
              $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
            }
          }
        }

        $namesArrayLength = count($namesArray);
        $finalSet = ' SET ';
        $n = 0;

        foreach ($namesArray as $key => $value) {
          if (!empty($value)) {
            if ($key == $this->_key) {
              $idAplicar = $key;
              $idAplicarValue = $value;
            }

            $separador = $n < ($namesArrayLength - 1) ? ', ' : '';

            if ($key != $this->_key) {
              $finalSet = $finalSet . $key . "='" . $value . "'" . $separador . " ";
            }
          } else if (empty($value)) {
            if (is_int($value)) {
              $value_vacio = 0;
            } elseif (empty($value) && $key == 'status') {
              $value_vacio = 0;
            } elseif ($value == '0') {
              $value_vacio = 0;
            } else {
              $value_vacio = '';
            }
            if ($key == $this->_key) {
              $idAplicar = $key;
              $idAplicarValue = $value_vacio;
            }

            $separador = $n < ($namesArrayLength - 1) ? ', ' : '';

            if ($key != $this->_key) {
              $finalSet = $finalSet . $key . "='" . $value_vacio . "'" . $separador . " ";
            }
          } else {
            $is_id = strpos($key, 'id_');

            if ($is_id !== false) {
              if ($key == $this->_key) {
                $idAplicar = $key;
                $idAplicarValue = $value;
              }
              $separador = $n < ($namesArrayLength - 1) ? ', ' : '';
              if ($key != $this->_key) {
                $finalSet = $finalSet . $key . "='0'" . $separador . " ";
              }
            }
          }
          $n = $n + 1;
        }

        // echo "UPDATE ".$this->_table." ".$finalSet." where ".$idAplicar."='".$idAplicarValue."' ";
        // exit();

        $this->setQuery("UPDATE " . $this->_table . " " . $finalSet . " where " . $idAplicar . "='" . $idAplicarValue . "' ");
        $record = $this->setUpdate();
        $estado = $this->getState();

        if ($estado == 'impact') {
          $lastId = (int) $idAplicarValue;
        } else {
          $lastId = 0;
        }

        # We deal with other tables
        if (!empty($lastId) && is_integer($lastId)) {
          # We delete all foreign relationships from the table and then create the new ones
          if (is_array($this->_fields_relation) && !empty($this->_fields_relation) && is_array($this->_rules)) {
            $fieldsRelationLength = count($this->_fields_relation);
            $rulesLength = count($this->_rules);

            foreach ($this->_rules as $key => $value) {
              if (in_array($key, $this->_fields_relation)) {
                $this->injectionInsert(str_replace('[' . $this->_key . ']', $lastId, $this->_rules[$key]['borra']));
              }
            }
          }

          for ($i = 0; $i < $namesPostLength; $i++) {
            if (is_array($this->posteos_values[$i]) && is_array($this->_rules) && !empty($this->_rules[$this->posteos_names[$i]]['borra']) && !empty($this->_rules[$this->posteos_names[$i]]['update']) && !empty($this->posteos_values[$i])) {
              $this->injectionInsert(str_replace('[' . $this->_key . ']', $lastId, $this->_rules[$this->posteos_names[$i]]['borra']));

              foreach ($this->posteos_values[$i] as $valor) {
                $this->injectionInsert(str_replace('[' . $this->_rules[$this->posteos_names[$i]]['id_a'] . ']', intval($valor), str_replace('[' . $this->_rules[$this->posteos_names[$i]]['id_c'] . ']', $lastId, $this->_rules[$this->posteos_names[$i]]['update'])));
              }
            }
          }
        }
        return $lastId;
      } else {
        $this->setState('1 error');
      }
    } else {
      $this->setState('2 error');
    }
  }
  /**
   * activate public function
   * @uses $this->_field, Array
   * @uses $this->_request, Array
   * @uses $this->getState(), Function
   * Note: Function responsible for changing the status of the active field.
   */
  public function activate()
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTable();

    if ($resultValidate) {
      if (!empty($this->_fields) && is_array($this->_fields) && !empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);

        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (in_array($this->posteos_names[$i], $this->_fields)) {
            $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
          }
        }

        $namesArrayLength = count($namesArray);
        $finalSet = ' SET ' . $this->_field_applied . ' = 1 - ' . $this->_field_applied . ' ';

        foreach ($namesArray as $key => $value) {
          if ($key == $this->_key) {
            $idAplicar = $key;
            $idAplicarValue = $value;
          }
        }
        $this->setQuery("UPDATE " . $this->_table . " " . $finalSet . " where " . $idAplicar . "='" . $idAplicarValue . "' ");
        $record = $this->setUpdate();
        $estado = $this->getState();

        if ($estado == 'impact') {
          return $estado;
        }
      } else {
        $this->setState('error');
      }
    } else {
      $this->setState('error');
    }
  }
  /**
   ** disposition public function
   * @uses $this->_field, Array
   * @uses $this->_request, Array
   * @uses $this->getState(), Function
   * Note: Function responsible for changing the state of the active field.
   */
  public function disposition()
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTable();
    $direccion = '';

    if ($resultValidate) {
      if (!empty($this->_fields) && is_array($this->_fields) && !empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);

        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (in_array($this->posteos_names[$i], $this->_fields)) {
            $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
          }
          if ($this->posteos_names[$i] == 'direccion') {
            $direccion = $this->posteos_values[$i];
          }
        }

        $namesArrayLength = count($namesArray);

        foreach ($namesArray as $key => $value) {
          if ($key == $this->_key) {
            $idAplicar = $key;
            $idAplicarValue = $value;
          }
        }

        $query = "SELECT " . $this->_order . " FROM " . $this->_table . " WHERE " . $idAplicar . "='" . $idAplicarValue . "' ";

        $this->setQuery($query);
        $record = $this->getQuery();
        $estado = $this->getState();
        $name_orden = $this->_order;
        $old_order = $record['0']->$name_orden;

        switch ($direccion) {
          case 'despues':
            $where_clause = "  and " . $name_orden . " > " . $old_order . " order by " . $name_orden;
            break;
          default:
            $where_clause = "  and " . $name_orden . " < " . $old_order . " order by " . $name_orden . " desc";
            break;
        }

        $q = " SELECT " . $idAplicar . ", " . $name_orden . " FROM " . $this->_table . " WHERE 1=1 " . $where_clause . " limit 1 ";

        $this->setQuery($q);
        $records = $this->getQuery();
        $state = $this->getState();

        if ($state == 'impact') {
          $new_order = $records['0']->$name_orden;
          $moved_codigo = $records['0']->$idAplicar;

          $q1 = "UPDATE " . $this->_table . " SET " . $name_orden . " = " . $new_order . " WHERE " . $idAplicar . "='" . $idAplicarValue . "' ";
          $q2 = "UPDATE " . $this->_table . " SET " . $name_orden . " = " . $old_order . " WHERE " . $idAplicar . "='" . $moved_codigo . "' ";

          $this->setQuery($q1);
          $record_1 = $this->setUpdate();
          $estado_1 = $this->getState();

          $this->setQuery($q2);
          $record_2 = $this->setUpdate();
          $estado_2 = $this->getState();

          if ($estado_1 == 'impact' && $estado_2 == 'impact') {
            return $estado_1 . '|' . $estado_2;
          }
        }
      } else {
        $this->setState('error');
      }
    } else {
      $this->setState('error');
    }
  }
  /**
   * Posicion public function
   * @uses $this->_field, Array
   * @uses $this->_request, Array
   * @uses $this->getState(), Function
   * Note: Function charged to deliver the record Next and previous
   */
  public function posicion()
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTable();
    $direccion = '';

    if ($resultValidate) {
      if (!empty($this->_fields) && is_array($this->_fields) && !empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);

        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (in_array($this->posteos_names[$i], $this->_fields)) {
            $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
          }
        }

        $namesArrayLength = count($namesArray);
        $stingWhere = '';
        $n = 0;

        foreach ($namesArray as $key => $value) {
          if ($key == $this->_key) {
            $idAplicar = $key;
            $idAplicarValue = $value;
          }

          $separador = $n < ($namesArrayLength - 1) ? ' AND ' : '';

          if (in_array($key, $this->_field_applied_array) and $idAplicar != $key and $this->_order != $key) {
            $stingWhere .= $key . "='" . $value . "'" . $separador;
          }

          $n = $n + 1;
        }

        $query = "SELECT " . $this->_order . " FROM " . $this->_table . " WHERE " . $idAplicar . "='" . $idAplicarValue . "' ";

        $this->setQuery($query);
        $record = $this->getQuery();
        $estado = $this->getState();
        $name_orden = $this->_order;
        $old_order = $record['0']->$name_orden;

        $where_despues = " and " . $stingWhere . " " . $name_orden . " > " . $old_order . " order by " . $name_orden;
        $where_antes = " and " . $stingWhere . " " . $name_orden . " < " . $old_order . " order by " . $name_orden . " desc";

        $q_antes = " SELECT " . $idAplicar . ", " . $name_orden . ", nombre FROM " . $this->_table . " WHERE 1=1 " . $where_antes . " limit 1 ";
        $q_despues = " SELECT " . $idAplicar . ", " . $name_orden . ", nombre FROM " . $this->_table . " WHERE 1=1 " . $where_despues . " limit 1 ";

        $this->setQuery($q_antes);
        $r_antes = $this->getQuery();
        $s_antes = $this->getState();

        if ($s_antes == 'impact') {
          $id_antes = !empty($r_antes['0']->$idAplicar) ? $r_antes['0']->$idAplicar : 0;
          $id_antes_nombre = !empty($r_antes['0']->nombre) ? $r_antes['0']->nombre : '';
        } else {
          $id_antes = 0;
          $id_antes_nombre = '';
        }

        $this->setQuery($q_despues);
        $r_despues = $this->getQuery();
        $s_despues = $this->getState();

        if ($s_despues == 'impact') {
          $id_despues = !empty($r_despues['0']->$idAplicar) ? $r_despues['0']->$idAplicar : 0;
          $id_despues_nombre = !empty($r_despues['0']->nombre) ? $r_despues['0']->nombre : '';
        } else {
          $id_despues = 0;
          $id_despues_nombre = '';
        }

        return $id_antes . '|' . $idAplicarValue . '|' . $id_despues . '|' . $id_antes_nombre . '|' . $id_despues_nombre;
      } else {
        $this->setState('error');
      }
    } else {
      $this->setState('error');
    }
  }
  /**
   * Status public function
   * @uses $this->_field, Array
   * @uses $this->_request, Array
   * @uses $this->getState(), Function
   * Note: Function responsible for changing the status of the active field.
   */
  public function Status($valor)
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTable();

    if ($resultValidate) {
      if (!empty($this->_fields) && is_array($this->_fields) && !empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);
        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (in_array($this->posteos_names[$i], $this->_fields)) {
            $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
          }
        }

        $namesArrayLength = count($namesArray);
        $finalSet = ' SET ' . $this->_field_applied . '=' . $valor . ' ';

        foreach ($namesArray as $key => $value) {
          if ($key == $this->_key) {
            $idAplicar = $key;
            $idAplicarValue = $value;
          }
        }

        $this->setQuery("UPDATE " . $this->_table . " " . $finalSet . " where " . $idAplicar . "='" . $idAplicarValue . "' ");
        $record = $this->setUpdate();
        $estado = $this->getState();

        if ($estado == 'impact') {
          return $estado;
        }
      } else {
        $this->setState('error');
      }
    } else {
      $this->setState('error');
    }
  }

  /**
   * selectSingle public function
   * @uses $this->generateDatbaseTableField(), Function
   * @uses $this->validateDatbaseTableFields(), Function
   * @uses $this->_fields, Array
   * @uses $this->setQuery(), Function
   * @uses $this->getState(), Function
   * @see $this->generateDatbaseTableField()
   * @see $this->validateDatbaseTableFields()
   * @return $record, Array
   * Note: Function responsible for processing the SELECTS data and inject them using getQuery() for a single record.
   */
  public function selectSingle()
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTableFields();

    if ($resultValidate) {
      if (!empty($this->_fields) && is_array($this->_fields) && !empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);
        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (in_array($this->posteos_names[$i], $this->_fields)) {
            $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
          }
        }

        $namesArrayLength = count($namesArray);

        foreach ($namesArray as $key => $value) {
          if ($key == $this->_key) {
            $idAplicar = $key;
            $idAplicarValue = $value;
          }
        }

        $query = "SELECT * FROM " . $this->_table . " where " . $idAplicar . "='" . $idAplicarValue . "' ";

        $this->setQuery($query);
        $record = $this->getQuery();
        $estado = $this->getState();

        $record[] = $idAplicar; //CAMPO KEY primario

        if ($estado == 'impact') {
          return $record;
        }
      } else {
        $this->setState('error');
      }
    } else {
      $this->setState('error');
    }
  }

  public function exist()
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTableFields();

    if ($resultValidate) {
      if (!empty($this->_field_applied) && !empty($this->_fields) && is_array($this->_fields) && !empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);
        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (in_array($this->posteos_names[$i], $this->_fields)) {
            $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
          }
        }

        $namesArrayLength = count($namesArray);

        foreach ($namesArray as $key => $value) {
          if ($key == $this->_field_applied) {
            $idAplicar = $key;
            $idAplicarValue = $value;
          }
        }

        $query = "SELECT * FROM " . $this->_table . " where " . $idAplicar . "='" . $idAplicarValue . "' ";

        $this->setQuery($query);
        $record = $this->getQuery();
        $estado = $this->getState();

        if ($estado == 'impact') {
          return $record[0];
        } else {
          $this->setState('error');
        }
      }
    } else {
      $this->setState('error');
    }
  }

  public function existMulti()
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTableFields();

    if ($resultValidate) {
      if (!empty($this->_field_applied_array[0]) && !empty($this->_fields) && is_array($this->_fields) && !empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);
        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (in_array($this->posteos_names[$i], $this->_fields)) {
            $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
          }
        }

        $namesArrayLength = count($this->_field_applied_array);
        $stingWhere = '';
        $n = 0;

        foreach ($namesArray as $key => $value) {
          $separador = $n < ($namesArrayLength - 1) ? ' AND ' : '';

          if (in_array($key, $this->_field_applied_array)) {
            $stingWhere .= $key . "='" . $value . "'" . $separador;
          }
          $n = $n + 1;
        }

        $query = "SELECT * FROM " . $this->_table . " where " . $stingWhere;

        $this->setQuery($query);
        $record = $this->getQuery();
        $estado = $this->getState();

        if ($estado == 'impact') {
          return !empty($record[0]) ? $record[0] : '';
        } else {
          $this->setState('error');
        }
      }
    } else {
      $this->setState('error');
    }
  }

  public function filter()
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTableFields();

    if ($resultValidate) {
      if (!empty($this->_field_applied_array[0]) && !empty($this->_fields) && is_array($this->_fields) && !empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);
        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (in_array($this->posteos_names[$i], $this->_fields)) {
            $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
          }
        }

        $namesArrayLength = count($this->_field_applied_array);
        $stingWhere = '';
        $n = 0;
        $aplica_and = false;

        foreach ($namesArray as $key => $value) {
          if ($key != $this->_order) {
            $separador = $aplica_and === true ? ' AND ' : '';

            if (in_array($key, $this->_field_applied_array)) {
              $stingWhere .= $separador . " " . $key . "='" . $value . "' ";
            }

            $aplica_and = true;
          }
        }

        $query = "SELECT * FROM " . $this->_table . " where " . $stingWhere . " ";

        $_have_order = false;

        if (in_array($this->_order, $this->_fields)) {
          $_have_order = true;
        }

        if (!empty($this->_status)) {
          $query .= (!empty($this->_status)) ? ' and ' . $this->_status . '>=0 ' : ' ';
        }

        if (!empty($this->_order) && $_have_order == true) {
          $query .= (!empty($this->_order)) ? ' ORDER BY ' . $this->_order . ' ' . $this->_sort . ' ' : ' ';
        } else if (!empty($this->_key)) {
          $query .= (!empty($this->_key)) ? ' ORDER BY ' . $this->_key . ' ' . $this->_sort . ' ' : ' ';
        }

        $this->setQuery($query);
        $record = $this->getQuery();
        $estado = $this->getState();

        if ($estado == 'impact') {
          return $record;
        } else {
          $this->setState('error');
        }
      } else if (!empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);
        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (in_array($this->posteos_names[$i], $this->_fields)) {
            $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
          }
        }

        $query = "SELECT * FROM " . $this->_table . " WHERE status='1' ";

        $this->setQuery($query);
        $record = $this->getQuery();
        $estado = $this->getState();

        if ($estado == 'impact') {
          return $record;
        } else {
          $this->setState('error');
        }
      }
    } else {
      $this->setState('error');
    }
  }

  public function filterPaged()
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTableFields();
    $searching = false;

    if ($resultValidate) {
      if (!empty($this->_field_applied_array[0]) && !empty($this->_fields) && is_array($this->_fields) && !empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);

        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (in_array($this->posteos_names[$i], $this->_fields)) {
            if (!empty($this->posteos_values[$i]) || $this->posteos_values[$i] == 0) {
              $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
            }
          }
          if ($this->posteos_names[$i] == 'searching' && $this->posteos_values[$i] == 'true') {
            $searching = true;
          }
        }

        $namesArrayLength = count($this->_field_applied_array);
        $stingWhere = '';
        $n = 0;
        $aplica_and = false;

        foreach ($namesArray as $key => $value) {
          if ($key != $this->_order && !empty($value)) {
            $separador = $aplica_and === true ? ' AND ' : '';

            if (in_array($key, $this->_field_applied_array)) {
              if ($searching === true) {
                $esKeyForanea = strrpos($key, "id_");

                if ($esKeyForanea === false) {
                  $stingWhere .= $separador . " (" . $key . " like  '%" . $value . "%') ";
                } else {
                  $stingWhere .= $separador . " " . $key . "='" . $value . "' ";
                }
              } else {
                $stingWhere .= $separador . " " . $key . "='" . $value . "' ";
              }
            }
            $aplica_and = true;
          }
        }

        $query = "SELECT * FROM " . $this->_table . " where " . $stingWhere . " ";
        // print_r($query);
        // exit();

        $_have_order = false;
        if (in_array($this->_order, $this->_fields)) {
          $_have_order = true;
        }

        if (!empty($this->_status)) {
          $query .= (!empty($this->_status)) ? ' and ' . $this->_status . '>=0 ' : ' ';
        }

        if (!empty($this->_order) && $_have_order == true) {
          $query .= (!empty($this->_order)) ? ' ORDER BY ' . $this->_order . ' ' . $this->_sort . ' ' : ' ';
        } else if (!empty($this->_key)) {
          $query .= (!empty($this->_key)) ? ' ORDER BY ' . $this->_key . ' ' . $this->_sort . ' ' : ' ';
        }

        $queryTotal = $query;

        if ($this->_pager == true) {
          $pager_type = $this->_pager_type;
          $pager_url = $this->_pager_url;
          $pager_quantity = $this->_pager_quantity;
          $pager_start = $this->_pager_page * $this->_pager_quantity;
          $query .= " LIMIT $pager_start,$pager_quantity ";
        }

        $this->setQuery($query);
        $record = $this->getQuery();
        $estado = $this->getState();

        if ($estado == 'impact') {
          $this->setQuery($queryTotal);
          $rec = $this->getQuery();
          $est = $this->getState();

          if ($est == 'impact' && is_array($rec)) {
            $this->setTotalRecords(count($rec));
          }
          return $record;
        } else {
          $this->setState('error');
        }
      } else if (!empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);
        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (in_array($this->posteos_names[$i], $this->_fields)) {
            $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
          }
        }

        $query = "SELECT * FROM " . $this->_table . " WHERE status='1' ";

        $this->setQuery($query);
        $record = $this->getQuery();
        $estado = $this->getState();

        if ($estado == 'impact') {
          return $record;
        } else {
          $this->setState('error');
        }
      }
    } else {
      $this->setState('error');
    }
  }

  public function filterPagedAjax()
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTableFields();
    $searching = false;

    if ($resultValidate) {
      if (!empty($this->_field_applied_array[0]) && !empty($this->_fields) && is_array($this->_fields) && !empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);

        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (in_array($this->posteos_names[$i], $this->_fields)) {
            if (!empty($this->posteos_values[$i]) || $this->posteos_values[$i] == 0) {
              $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
            }
          }
          if ($this->posteos_names[$i] == 'searching' && $this->posteos_values[$i] == 'true') {
            $searching = true;
          }
        }

        $namesArrayLength = count($this->_field_applied_array);
        $stingWhere = '';
        $n = 0;
        $aplica_and = false;

        foreach ($namesArray as $key => $value) {
          // if($key!=$this->_order && !empty($value)){
          if (!empty($value)) {
            $separador = $aplica_and === true ? ' AND ' : '';
            if (in_array($key, $this->_field_applied_array)) {
              if ($searching === true) {
                $esKeyForanea = strrpos($key, "id_");
                if ($esKeyForanea === false) {
                  $stingWhere .= $separador . " (" . $key . " like  '%" . $value . "%') ";
                } else {
                  $stingWhere .= $separador . " " . $key . "='" . $value . "' ";
                }
              } else {
                $stingWhere .= $separador . " " . $key . "='" . $value . "' ";
              }
            }
            $aplica_and = true;
          }
        }
        // print_r($this->_field_applied_array);
        $query = "SELECT * FROM " . $this->_table . " where " . $stingWhere . " ";
        // print_r($query);
        // exit();

        $_have_order = false;
        if (in_array($this->_order, $this->_fields)) {
          $_have_order = true;
        }

        if (!empty($this->_status)) {
          $query .= (!empty($this->_status)) ? ' and ' . $this->_status . '>=0 ' : ' ';
        }

        if (!empty($this->_order) && $_have_order == true) {
          $query .= (!empty($this->_order)) ? ' ORDER BY ' . $this->_order . ' ' . $this->_sort . ' ' : ' ';
        } else if (!empty($this->_key)) {
          $query .= (!empty($this->_key)) ? ' ORDER BY ' . $this->_key . ' ' . $this->_sort . ' ' : ' ';
        }

        $queryTotal = $query;

        // echo $queryTotal;
        // exit();

        if ($this->_pager == true) {
          $pager_type = $this->_pager_type;
          $pager_url = $this->_pager_url;
          $pager_quantity = $this->_pager_quantity;
          $pager_start = $this->_pager_page * $this->_pager_quantity;
          $query .= " LIMIT $pager_start,$pager_quantity ";
        }

        $this->setQuery($query);
        $record = $this->getQuery();
        $estado = $this->getState();

        if ($estado == 'impact') {
          $this->setQuery($queryTotal);
          $rec = $this->getQuery();
          $est = $this->getState();

          if ($est == 'impact' && is_array($rec)) {
            $this->setTotalRecords(count($rec));
          }
          return $record;
        } else {
          $this->setState('error');
        }
      } else if (!empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);
        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (in_array($this->posteos_names[$i], $this->_fields)) {
            $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
          }
        }

        $query = "SELECT * FROM " . $this->_table . " WHERE status='1' ";

        $this->setQuery($query);
        $record = $this->getQuery();
        $estado = $this->getState();

        if ($estado == 'impact') {
          return $record;
        } else {
          $this->setState('error');
        }
      }
    } else {
      $this->setState('error');
    }
  }

  public function search()
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTableFields();

    if ($resultValidate) {
      if (!empty($this->_field_applied_array[0]) && !empty($this->_fields) && is_array($this->_fields) && !empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);
        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (in_array($this->posteos_names[$i], $this->_fields)) {
            $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
          }
        }

        $namesArrayLength = count($this->_field_applied_array);
        $stingWhere = '';
        $n = 0;

        foreach ($namesArray as $key => $value) {
          $separador = $n < ($namesArrayLength - 1) ? ' AND ' : ' ';

          if (in_array($key, $this->_field_applied_array)) {
            $stingWhere .= $key . " like '%" . $value . "%'" . $separador;
          }
          $n = $n + 1;
        }

        $query = "SELECT * FROM " . $this->_table . " where " . $stingWhere . " AND status='1' ";
        // print_r($query);
        // exit();

        $this->setQuery($query);
        $record = $this->getQuery();
        $estado = $this->getState();

        if ($estado == 'impact') {
          return $record;
        } else {
          $this->setState('error');
        }
      }
    } else {
      $this->setState('error');
    }
  }
  /**
   * duplicate public function
   * @uses $this->generateDatbaseTableField(), Function
   * @uses $this->validateDatbaseTable(), Function
   * @uses $this->_fields, Array
   * @uses $this->_request, Array
   * @uses $this->setQuery(), Function
   * @uses $this->setDelete(), Function
   * @uses $this->getState(), Function
   * @see $this->generateDatbaseTableField()
   * @see $this->validateDatbaseTableFields()
   * @return $this->getState(), String
   * Note: Function for Duplicate a specific record of the database
   */
  public function duplicate()
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTable();

    if ($resultValidate) {
      if (!empty($this->_fields) && is_array($this->_fields) && !empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);

        $namesPostLength = count($this->posteos_names);
        $namesArray = array();
        $finalSet = '';
        $list_records = '';
        $list_records_value = '';

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (in_array($this->posteos_names[$i], $this->_fields)) {
            $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
          }
        }

        $finalSet = 'INSERT INTO ' . $this->_table . '';

        foreach ($namesArray as $key => $value) {
          if ($key == $this->_key) {
            $idAplicar = $key;
            $idAplicarValue = $value;
          }
        }

        $fullArrayLength = count($this->_configDatabaseMethodsFromDatabase[$this->_database][$this->_table]);
        $n = 1;

        foreach ($this->_configDatabaseMethodsFromDatabase[$this->_database][$this->_table] as $key => $value) {
          if ($key != $this->_key) {
            if ($n < $fullArrayLength) {
              if ($key != $this->_order) {
                $list_records .= $key . ',';
                $list_records_value .= $key . ',';
              }
            } else {
              if ($key != $this->_order) {
                $list_records .= $key;
                $list_records_value .= $key;
              }
            }
          }
          $n = $n + 1;
        }

        $finalSet .= '(' . $list_records . ') SELECT ' . $list_records_value . ' FROM ' . $this->_table . ' WHERE ' . $idAplicar . '=' . $idAplicarValue . '';
        $this->setQuery($finalSet);

        $record = $this->setInsert();
        $estado = $this->getState();

        if ($estado == 'impact') {
          $lastId = $this->getLastId();
        } else {
          $lastId = 0;
        }

        if (!empty($lastId) && is_integer($lastId)) {
          if (array_key_exists($this->_order, $this->_configDatabaseMethodsFromDatabase[$this->_database][$this->_table]) && !empty($lastId)) {
            $this->injectionInsert("UPDATE " . $this->_table . " SET " . $this->_order . "='" . $lastId . "' where " . $this->_key . "='" . $lastId . "' ");
          }
        }
        return $estado;
      } else {
        $this->setState('error');
      }
    } else {
      $this->setState('error');
    }
  }
  /**
   * injection public function
   * @uses $valor, String
   * @uses $this->setQuery(), Function
   * @uses $this->getQuery(), Function
   * @uses $this->getState(), Function
   * @return $estado, String
   * Note: Function charged with applying Querys directly.
   */
  public function seeker()
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTableFields();

    if ($resultValidate) {
      if (!empty($this->_search_on[0]) && !empty($this->_fields) && is_array($this->_fields) && !empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);
        $namesPostLength = count($this->posteos_names);
        $namesArray = array();
        $search_value = '';

        // print_r($this->_search_on);
        // echo 'ok';

        foreach ($this->posteos_names as $kkk => $vvv) {
          if ($vvv == 'search') {
            $search_value = $this->posteos_values[$kkk];
            // echo $this->posteos_values[$kkk];
            // $caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
            // $caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
            // $search_value = str_replace($caracteres_malos, $caracteres_buenos, $this->posteos_values[$kkk]);
            // $search_value = strtolower($search_value);
            // $search_value = str_replace(' ', ' ',$search_value);
          }
        }

        $stingFilter = '';
        if (!empty($this->_search_filters)) {
          $nameLength = count($this->_search_filters);
          $nn = 0;
          foreach ($this->_search_filters as $k => $v) {
            $sepa = $nn < ($nameLength - 1) ? ' AND ' : ' ';
            $stingFilter .= $k . " = '" . $v . "'" . $sepa;
            $nn = $nn + 1;
          }
          $stingFilter .= ' AND ';
        }

        $stingWhere = '';
        $namesArrayLength = count($this->_search_on);
        $n = 0;
        foreach ($this->_search_on as $key => $value) {
          $separador = $n < ($namesArrayLength - 1) ? ' OR ' : ' ';
          $stingWhere .= $value . " like '%" . $search_value . "%'" . $separador;
          $n = $n + 1;
        }

        if (!empty($this->_search_off[0])) {
          $valueReturns = '';
          $namesSearchLength = count($this->_search_off);
          $nn = 0;
          foreach ($this->_search_off as $k => $v) {
            $separadors = $nn < ($namesSearchLength - 1) ? ', ' : ' ';
            $valueReturns .= $v . $separadors;
            $nn = $nn + 1;
          }
        } else {
          $valueReturns = '*';
        }

        $query = "SELECT " . $valueReturns . " FROM " . $this->_table . " where " . $stingFilter . " status='1' AND " . $stingWhere . " limit 0, 50; ";

        // echo $query;
        // exit();

        $this->setQuery($query);
        $record = $this->getQuery();
        $estado = $this->getState();

        if ($estado == 'impact') {
          return $record;
        } else {
          $this->setState('error');
        }
      }
    } else {
      $this->setState('error');
    }
  }
  public function injection($valor)
  {
    $this->setQuery($valor);
    $record = $this->getQuery();
    $estado = $this->getState();

    if ($estado == 'impact') {
      return $record;
    }
  }
  public function injection2($valor)
  {
    $this->setQuery($valor);
    $record = $this->setManyInjection();
    $estado = $this->getState();

    if ($estado == 'impact') {
      return $record;
    }
  }
  /**
  ###TRATAR
   * injectionInsert public function
   * @uses $valor, String
   * @uses $this->setQuery(), Function
   * @uses $this->setInsert(), Function
   * @uses $this->getState(), Function
   * @return $estado, String
   * Note: Function charged with applying Querys directly.
   */
  public function injectionInsert($valor)
  {
    $this->setQuery($valor);
    $record = $this->setInsert();
    $estado = $this->getState();

    if ($estado == 'impact') {
      return $this->getLastId();
    } else {
      $this->setState('1 error');
    }
  }
  /**
  ###TRATAR
   * injectionInsert public function
   * @uses $valor, String
   * @uses $this->setQuery(), Function
   * @uses $this->setInsert(), Function
   * @uses $this->getState(), Function
   * @return $estado, String
   * Note: Function charged with applying Querys directly.
   */
  public function injectionPaged($valor)
  {
    $query = $valor;
    $queryTotal = $query;

    if ($this->_pager == true) {
      $pager_type = $this->_pager_type;
      $pager_url = $this->_pager_url;
      $pager_quantity = $this->_pager_quantity;
      $pager_start = $this->_pager_page * $this->_pager_quantity;
      $query .= " LIMIT $pager_start,$pager_quantity ";
    }
    /*
    echo $query;
    exit();
    */
    $this->setQuery($query);
    $record = $this->getQuery();
    $estado = $this->getState();

    if ($estado == 'impact') {
      $this->setQuery($queryTotal);
      $rec = $this->getQuery();
      $est = $this->getState();

      if ($est == 'impact') {
        $this->setTotalRecords(count($rec));
      }
      return $record;
    } else {
      $this->setState('error');
    }
  }
  /**
   * selectNumFrom public function
   * @uses $this->generateDatbaseTableField(), Function
   * @uses $this->validateDatbaseTableFields(), Function
   * @uses $this->_fields, Array
   * @uses $this->setQuery(), Function
   * @uses $this->getState(), Function
   * @see $this->generateDatbaseTableField()
   * @see $this->validateDatbaseTableFields()
   * @return $record, Array
   * Note: Function responsible for bringing the total record of a query using getQuery(). He passes the field to take into account
   */
  public function selectNumFrom($theQuery)
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTableFields();

    if ($resultValidate) {
      if (!empty($theQuery) && is_array($theQuery) && !empty($this->_fields) && is_array($this->_fields) && !empty($this->_request) && is_array($this->_request)) {
        $this->posteos_names = array_keys($this->_request);
        $this->posteos_values = array_values($this->_request);
        $namesPostLength = count($this->posteos_names);
        $namesArray = array();

        for ($i = 0; $i < $namesPostLength; $i++) {
          if (in_array($this->posteos_names[$i], $this->_fields)) {
            $namesArray[$this->posteos_names[$i]] = $this->posteos_values[$i];
          }
        }

        $namesArrayLength = count($namesArray);

        foreach ($namesArray as $key => $value) {
          if ($key == $theQuery['WHERE']) {
            $idAplicar = $key;
            $idAplicarValue = $value;
          }
        }

        $query = "SELECT " . $theQuery['SELECT'] . " FROM  " . $theQuery['FROM'] . "  WHERE " . $idAplicar . "=" . $idAplicarValue . " " . $theQuery['AND'];

        $this->setQuery($query);
        $record = $this->getQuery();
        $estado = $this->getState();

        if ($estado == 'impact') {
          return $record;
        } else {
          $this->setState('error');
        }
      }
    } else {
      $this->setState('error');
    }
  }

  /**
   * generateDatbaseTableField public function
   * @uses $this->_configDatabaseMethodsTablaNames(), Array
   * @uses $this->_configDatabaseMethodsFromDatabase(), Array
   * @uses $this->injection(), Function
   * @return $_configDatabaseMethodsFromDatabase, Array
   * Note: Function responsible for generating an Array with the structure of the Database.
   */
  public function generateDatbaseTableField()
  {
    $directory = dirname(__FILE__) . '/structure';
    if (!is_dir($directory)) {
      mkdir($directory, 0777);
    }

    $path = dirname(__FILE__) . '/structure/data.inc';

    if (file_exists($path)) {
      $bbdd = unserialize(file_get_contents($path));
      $bbdd_total_number = count(array_keys($bbdd));
      $bbdd_name = array_keys($bbdd);

      if (isset($bbdd)) {
        foreach ($bbdd as $variable1 => $valor1) {
          if (isset($valor1)) {
            foreach ($valor1 as $variable2 => $valor2) {
              $this->_configDatabaseMethodsTablaNames[$variable2] = true;
              if (isset($valor2)) {
                foreach ($valor2 as $variable3 => $valor3) {
                  if ($variable3 == 'GLOBAL_data') {
                    if (isset($valor3)) {
                      foreach ($valor3 as $variable4 => $valor4) {
                        foreach ($valor4 as $fields) {
                          $this->_configDatabaseMethodsFromDatabase[$variable1][$variable2][$valor4['field']] = $valor4['type'];
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    } else {
      $baseDeDatos = $this->injection('SELECT DATABASE() as Name');

      for ($i = 0; $i < count(array_keys($baseDeDatos)); $i++) {
        /*
        $prefijo_databse = explode(CONFIG_DB_PREFIX,$baseDeDatos[$i]->Name);

        if($prefijo_databse[0]==CONFIG_DB_PREFIX)
        {
        */
        $tablas = $this->injection('SHOW TABLE STATUS FROM ' . $baseDeDatos[$i]->Name);

        for ($j = 0; $j < count(array_keys($tablas)); $j++) {
          $this->_configDatabaseMethodsTablaNames[$tablas[$j]->Name] = true;
          $columnas = $this->injection('SHOW COLUMNS FROM ' . $tablas[$j]->Name);

          for ($h = 0; $h < count(array_keys($columnas)); $h++) {
            foreach ($columnas as $fields) {
              $this->_configDatabaseMethodsFromDatabase[$baseDeDatos[$i]->Name][$tablas[$j]->Name][$fields->Field] = $fields->Type;
            }
          }
        }
        //}
      }
    }
  }
  /**
   * validateDatbaseTableFields public function
   * @uses $this->_configDatabaseMethodsTablaNames(), Array
   * @uses $this->_configDatabaseMethodsFromDatabase(), Array
   * @return Boolean
   * Note: Function responsible for checking that a Field is in the structure of the Database.
   */
  public function validateDatbaseTableFields()
  {
    if (array_key_exists($this->_table, $this->_configDatabaseMethodsTablaNames)) {
      if (is_array($this->_fields)) {
        foreach ($this->_fields as $fields) {
          if (!array_key_exists($fields, $this->_configDatabaseMethodsFromDatabase[$this->_database][$this->_table])) {
            return false;
          }
        }
        return true;
      }
    } else {
      return false;
    }
  }
  /**
   * validateDatbaseTableFields public function
   * @uses $this->_configDatabaseMethodsTablaNames(), Array
   * @return Boolean
   * Note: Function responsible for checking that a Table is in the structure of the Database.
   */
  public function validateDatbaseTable()
  {
    if (array_key_exists($this->_table, $this->_configDatabaseMethodsTablaNames)) {
      return true;
    } else {
      return false;
    }
  }
  /**
   * getDatbaseTableField public function
   * @uses $this->_configDatabaseMethodsFromDatabase, Array
   * @uses $this->getState(), Function
   * @return $estado, String
   * Note: Function responsible for returning the structure of the Database.
   */
  public function getDatbaseTableField()
  {
    return $this->_configDatabaseMethodsFromDatabase;
  }

  /**
   * setDatabaseDump public function
   * @uses $this->injection, Function
   * @uses $reset, Boolean
   * Note: Function responsible for generating a dump of the Database and making it available to the system in XML format.
   * Note: Deprecate Function. DEPRECADO!!
   */
  public function setDatabaseDumpXXX($reset = true)
  {
    $matriz = '';
    $baseDeDatos = $this->injection('SELECT DATABASE() as Name');

    $matriz .= '<core>' . "\r\n";

    for ($i = 0; $i < count(array_keys($baseDeDatos)); $i++) {
      $prefijo_databse = explode(CONFIG_DB_PREFIX, $baseDeDatos[$i]->Name);

      if ($prefijo_databse[0] == CONFIG_DB_PREFIX) {
        $tablas = $this->injection('SHOW TABLE STATUS FROM ' . $baseDeDatos[$i]->Name);

        $matriz .= '  <databases>' . "\r\n";
        $matriz .= '	<database>' . $baseDeDatos[$i]->Name . '</database>' . "\r\n";

        for ($j = 0; $j < count(array_keys($tablas)); $j++) {
          $matriz .= '	<tables>' . "\r\n";
          $matriz .= '	 <table>' . $tablas[$j]->Name . '</table>' . "\r\n";

          $this->_configDatabaseMethodsTablaNames[$tablas[$j]->Name] = true;
          $columnas = $this->injection('SHOW COLUMNS FROM ' . $tablas[$j]->Name);
          $keys = $this->injection('SHOW KEYS FROM ' . $tablas[$j]->Name);
          $keysArray = $keys;

          foreach ($columnas as $fields) {
            $matriz .= '	   <fields>' . "\r\n";
            $matriz .= '	     <field>' . $fields->Field . '</field>' . "\r\n";
            $matriz .= '	     <type>' . $fields->Type . '</type>' . "\r\n";
            $matriz .= '	     <showinlist>true</showinlist>' . "\r\n";
            $matriz .= '	     <showinform>true</showinform>' . "\r\n";
            $matriz .= '	     <alternatename>' . str_replace('_', ' ', trim(strtolower($fields->Field))) . '</alternatename>' . "\r\n";
            $matriz .= '	     <key>' . $fields->Key . '</key>' . "\r\n";
            $matriz .= '	     <query></query>' . "\r\n";
            $matriz .= '	     <routing></routing>' . "\r\n";
            $matriz .= '	   </fields>' . "\r\n";
          }
          $matriz .= '	</tables>' . "\r\n";
        }
        $matriz .= '  </databases>' . "\r\n";
      }
    }
    $matriz .= '</core>';

    $path = dirname(__FILE__) . '/database/database.xml';

    if ($reset == true && file_exists($path)) {
      @unlink($path);
    }

    $trigger_fp = ($reset == false) ? fopen($path, "w") : fopen($path, "a+");

    if ($trigger_fp != false) {
      fwrite($trigger_fp, $matriz);
      fclose($trigger_fp);
    }
  }

  /**
   * getDatabaseDumpJson public function 
   * @uses $this->injection, Function
   * Note: Function responsible for generating a dump of the Database and return the values in JSON.
   */
  public function getDatabaseDump($reset = false, $scaffolding = true, $check_dir = false)
  {
    $matriz = array();
    $baseDeDatos = $this->injection('SELECT DATABASE() as Name');

    if ($check_dir === true) {
      $the_table_name_path_data = dirname(__FILE__) . '/../../../material/_data';
      if (!is_dir($the_table_name_path_data)) {
        mkdir($the_table_name_path_data, 0777);
      }
    }

    if ($scaffolding) {
      for ($i = 0; $i < count(array_keys($baseDeDatos)); $i++) {
        $tablas = $this->injection('SHOW TABLE STATUS FROM ' . $baseDeDatos[$i]->Name);

        for ($j = 0; $j < count(array_keys($tablas)); $j++) {
          //echo CONFIG_DB_PREFIX . '|' . $tablas[$j]->Name. '<br>';
          $prefijo_databse = explode('_', $tablas[$j]->Name);
          /*
          if( !empty($prefijo_databse[0]) ){ echo $prefijo_databse[0]. '<br>'; }
          */
          // alternate_name = true;
          // show_in_list = true;
          // show_in_form = true;
          // rules = true;
          // save_data_on_file = true;
          // father_son = father: / son_of:table_name
          // alias = Administradores
          if (!empty($prefijo_databse[0]) && $prefijo_databse[0] . '_' == CONFIG_DB_PREFIX) {
            $this->_configDatabaseMethodsTablaNames[$tablas[$j]->Name] = true;
            $dato_tabla_comment = explode(';', $tablas[$j]->Comment);
            $table_use_alias          = (!empty($dato_tabla_comment[0]) && $dato_tabla_comment[0] == 'false') ? false : true;
            $table_rules              = (!empty($dato_tabla_comment[1]) && $dato_tabla_comment[1] == 'false') ? false : true;
            $table_save_data_on_file  = (!empty($dato_tabla_comment[2]) && $dato_tabla_comment[2] == 'false') ? false : true;
            $table_father_son         = empty($dato_tabla_comment[3]) ? false : $dato_tabla_comment[3];
            $table_alias              = empty($dato_tabla_comment[4]) ? false : $dato_tabla_comment[4];

            if ($table_alias == false && $table_use_alias == false) {
              $table_alternate_name = ucwords(str_replace('_', '', $prefijo_databse[1]));
            } else {
              $table_alternate_name = $table_alias;
            }

            // CHECK DIRECTORY
            if ($check_dir === true) {
              $the_table_name = str_replace(CONFIG_DB_PREFIX, "", $tablas[$j]->Name);
              $the_table_name_path = dirname(__FILE__) . '/../../../material/' . $the_table_name;
              if (!is_dir($the_table_name_path)) {
                if (!mkdir($the_table_name_path, 0777)) {
                  echo 'The "material" directory needs write permissions';
                } else {
                  if (!is_dir($the_table_name_path . '/big')) {
                    mkdir($the_table_name_path . '/big', 0777);
                  }
                  if (!is_dir($the_table_name_path . '/media')) {
                    mkdir($the_table_name_path . '/media', 0777);
                  }
                  if (!is_dir($the_table_name_path . '/reports')) {
                    mkdir($the_table_name_path . '/reports', 0777);
                  }
                  if (!is_dir($the_table_name_path . '/small')) {
                    mkdir($the_table_name_path . '/small', 0777);
                  }
                  if (!is_dir($the_table_name_path . '/thumb')) {
                    mkdir($the_table_name_path . '/thumb', 0777);
                  }
                }
              }
            }

            $columnas = $this->injection('SHOW FULL FIELDS FROM ' . $tablas[$j]->Name);
            $keys = $this->injection('SHOW KEYS FROM ' . $tablas[$j]->Name);

            for ($g = 0; $g < count(array_keys($columnas)); $g++) {
              $dato_comment = explode(';', $columnas[$g]->Comment);
              $type_of = empty($dato_comment[0]) ? false : $dato_comment[0];
              $show_in_list = empty($dato_comment[1]) ? false : $dato_comment[1];
              $show_in_form = empty($dato_comment[2]) ? false : $dato_comment[2];
              $alternate_name = empty($dato_comment[3]) ? $columnas[$g]->Field : $dato_comment[3];
              $query = empty($dato_comment[4]) ? '' : $dato_comment[4];
              $restrictions = empty($dato_comment[5]) ? '' : $dato_comment[5];
              $foreign = empty($dato_comment[4]) ? '' : str_replace('SELECT * FROM ' . CONFIG_DB_PREFIX, '', $dato_comment[4]);
              $temp_field = empty($dato_comment[6]) ? '' : explode(':', $dato_comment[6]);
              $foreign_field = empty($temp_field[0]) ? '' : $temp_field[0];
              $foreign_fields = empty($temp_field[1]) ? '' : explode(',', $temp_field[1]);
              $validation = empty($dato_comment[7]) ? '' : $dato_comment[7];

              $fields = array(
                'field' => $columnas[$g]->Field,
                'type' => $columnas[$g]->Type,
                'type_of' => $type_of,
                'null' => $columnas[$g]->Null,
                'key' => $columnas[$g]->Key,
                'default' => $columnas[$g]->Default,
                'extra' => $columnas[$g]->Extra,
                'alternatename' => $alternate_name,
                'showinlist' => $show_in_list,
                'showinform' => $show_in_form,
                'restrictions' => $restrictions,
                'foreign' => $foreign,
                'foreign_field' => $foreign_field,
                'foreign_fields' => $foreign_fields,
                'validation' => $validation,
                'query' => $query,
              );
              // echo '<----------------------------------';
              // print_r($fields);
              // echo '---------------------------------->';

              $matriz[$baseDeDatos[$i]->Name][$tablas[$j]->Name]['GLOBAL_alternatename'] = $table_alternate_name;
              // $matriz[$baseDeDatos[$i]->Name][$tablas[$j]->Name]['GLOBAL_showinlist'] = $table_show_in_list;
              // $matriz[$baseDeDatos[$i]->Name][$tablas[$j]->Name]['GLOBAL_showinform'] = $table_show_in_form;
              $matriz[$baseDeDatos[$i]->Name][$tablas[$j]->Name]['GLOBAL_rules'] = $table_rules;
              $matriz[$baseDeDatos[$i]->Name][$tablas[$j]->Name]['GLOBAL_save_data_on_file'] = $table_save_data_on_file;
              $matriz[$baseDeDatos[$i]->Name][$tablas[$j]->Name]['GLOBAL_father_son'] = $table_father_son;
              $matriz[$baseDeDatos[$i]->Name][$tablas[$j]->Name]['GLOBAL_table_alias'] = $table_alias;
              $matriz[$baseDeDatos[$i]->Name][$tablas[$j]->Name]['GLOBAL_data'][$columnas[$g]->Field] = $fields;
            }
          }
        }
      }
    } else {
      $makeIntance = false;
      for ($i = 0; $i < count(array_keys($baseDeDatos)); $i++) {
        $prefijo_databse = explode(CONFIG_DB_PREFIX, $baseDeDatos[$i]->Name);

        if ($prefijo_databse[0] == CONFIG_DB_PREFIX) {
          $tablas = $this->injection('SHOW TABLE STATUS FROM ' . $baseDeDatos[$i]->Name);

          for ($j = 0; $j < count(array_keys($tablas)); $j++) {
            $tableName = str_replace(CONFIG_DB_PREFIX, "", $tablas[$j]->Name);
            $structurePath = dirname(__FILE__) . '/structure/' . $tableName . '.inc';

            if (file_exists($structurePath) && is_file($structurePath)) {
              require_once($structurePath);
              $controller = new $tableName();
              $structureData = $controller->getStructure();

              $this->_configDatabaseMethodsTablaNames[$tablas[$j]->Name] = true;

              $matriz[$baseDeDatos[$i]->Name][$tablas[$j]->Name]['GLOBAL_alternatename'] = empty($structureData['GLOBAL_alternatename']) ? $tablas[$j]->Name : $structureData['GLOBAL_alternatename'];
              $matriz[$baseDeDatos[$i]->Name][$tablas[$j]->Name]['GLOBAL_showinlist'] = empty($structureData['GLOBAL_showinlist']) ? false : $structureData['GLOBAL_showinlist'];
              $matriz[$baseDeDatos[$i]->Name][$tablas[$j]->Name]['GLOBAL_showinform'] = empty($structureData['GLOBAL_showinform']) ? false : $structureData['GLOBAL_showinform'];
              $matriz[$baseDeDatos[$i]->Name][$tablas[$j]->Name]['GLOBAL_rules'] = empty($structureData['GLOBAL_rules']) ? false : $structureData['GLOBAL_rules'];
              $matriz[$baseDeDatos[$i]->Name][$tablas[$j]->Name]['GLOBAL_save_data_on_file'] = empty($structureData['GLOBAL_save_data_on_file']) ? false : $structureData['GLOBAL_save_data_on_file'];
              $matriz[$baseDeDatos[$i]->Name][$tablas[$j]->Name]['GLOBAL_data'] = empty($structureData['GLOBAL_data']) ? false : $structureData['GLOBAL_data'];
            } else {
              //die('the controller was not found (file)');
            }
          }
        }
      }
    }

    $menu = array();
    foreach ($matriz as $bbdd_key => $bbdd_value) {
      $position = 0;
      foreach ($bbdd_value as $bbdd_tables_key => $bbdd_tables_value) {

        $bt_key = str_replace(CONFIG_DB_PREFIX, '', $bbdd_tables_key);
        $bt_key_alias = $matriz[$bbdd_key][$bbdd_tables_key]['GLOBAL_table_alias'];
        $bt_key_alias = $matriz[$bbdd_key][$bbdd_tables_key]['GLOBAL_table_alias'];
        $bt_father_son = $matriz[$bbdd_key][$bbdd_tables_key]['GLOBAL_father_son'];

        $loaction_in_family_tree = explode(':', $bt_father_son);

        $temp_array = array('table' => $bt_key, 'alias' => $bt_key_alias);
        // print_r($temp_array);
        if ($loaction_in_family_tree[0] == 'father') {
          $menu[$bt_key] = array('table' => $bt_key, 'alias' => $bt_key_alias);
        } elseif ($loaction_in_family_tree[0] == 'son_of' && !empty($loaction_in_family_tree[1]) && empty($loaction_in_family_tree[2])) {
          $menu[$loaction_in_family_tree[1]]['sons'][$bt_key] = array('table' => $bt_key, 'alias' => $bt_key_alias);
        } elseif (!empty($loaction_in_family_tree[2])) {
          $menu[$loaction_in_family_tree[1]]['sons'][$loaction_in_family_tree[1] . '_' . $loaction_in_family_tree[2]]['sons'][$bt_key] = array('table' => $bt_key, 'alias' => $bt_key_alias);
        }
        $position = $position + 1;
      }
    }

    $path_menu = dirname(__FILE__) . '/../../_view/menu.inc';
    if ($reset == true && file_exists($path_menu)) {
      @unlink($path_menu);
      $dump_fp_menu = ($reset == false) ? fopen($path_menu, "w") : fopen($path_menu, "a+");

      if ($dump_fp_menu != false) {
        fwrite($dump_fp_menu, serialize($menu));
        fclose($dump_fp_menu);
      }
    } else {
      $dump_fp_menu = ($reset == false) ? fopen($path_menu, "w") : fopen($path_menu, "a+");

      if ($dump_fp_menu != false) {
        fwrite($dump_fp_menu, serialize($menu));
        fclose($dump_fp_menu);
      }
    }

    $directory = dirname(__FILE__) . '/structure';
    if (!is_dir($directory)) {
      mkdir($directory, 0777);
    }
    $path = dirname(__FILE__) . '/structure/data.inc';

    if ($reset == true && file_exists($path)) {
      @unlink($path);
      $dump_fp = ($reset == false) ? fopen($path, "w") : fopen($path, "a+");

      if ($dump_fp != false) {
        fwrite($dump_fp, serialize($matriz));
        fclose($dump_fp);
      }
    } else {
      $dump_fp = ($reset == false) ? fopen($path, "w") : fopen($path, "a+");

      if ($dump_fp != false) {
        fwrite($dump_fp, serialize($matriz));
        fclose($dump_fp);
      }
    }
    return $matriz;
  }

  /**
   * Destroyer erases the object when it is no longer used
   * @see __destruct()
   */
  public function __destruct()
  {
    //unset($this); // Deprecate
  }

  /**
   * selectMultiUserFilter public function
   * @uses $this->generateDatbaseTableField(), Function
   * @uses $this->validateDatbaseTableFields(), Function
   * @uses $this->_fields, Array
   * @uses $this->setQuery(), Function
   * @uses $this->getState(), Function
   * @see $this->generateDatbaseTableField()
   * @see $this->validateDatbaseTableFields()
   * @return $record, Array
   * Note: Function responsible for processing the data SELECTS and inject them using getQuery(). Filtering by the relation of that record with a user
   */
  public function selectMultiUserFilter($relation)
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTableFields();

    //echo '|'.$this->_data_user_id.'|';
    //print_r($this->_data_user);

    if (!empty($relation)) {
      if (!empty($this->_data_user_id) && !empty($this->_this_join)) {
        if ($resultValidate) {
          if (!empty($this->_fields) && is_array($this->_fields)) {
            $s = '';
            $n = count($this->_fields);
            $_have_order = false;

            for ($i = 0; $i < $n; $i++) {
              $s .= $i < ($n - 1) ? 'ge.' . $this->_fields[$i] . ', ' : 'ge.' . $this->_fields[$i];
            }

            if (in_array($this->_order, $this->_fields)) {
              $_have_order = true;
            }

            $query = 'SELECT ' . $s . ' FROM ' . $relation . ' geur ';
            $query .= ' ' . $this->_this_join . ' ';

            if (!empty($this->_key)) {
              $query .= (!empty($this->_key)) ? ' WHERE ge.' . $this->_key . '>=0 ' : ' ';
            }

            if (!empty($this->_status)) {
              $query .= (!empty($this->_status)) ? ' and ge.' . $this->_status . '>=0 ' : ' ';
            }

            if (!empty($this->_data_user_variable)) {
              $query .= (!empty($this->_data_user_id)) ? ' and geur.' . $this->_data_user_variable . '="' . $this->_data_user_id . '" ' : ' ';
              $query .= (!empty($this->_data_user['id_empresa'])) ? ' and gu.id_empresa="' . $this->_data_user['id_empresa'] . '" ' : ' ';
            } else {
              $query .= (!empty($this->_data_user_id)) ? ' and gu.id_user="' . $this->_data_user_id . '" ' : ' ';
            }

            if (!empty($this->_order) && $_have_order == true) {
              $query .= (!empty($this->_order)) ? ' ORDER BY ge.' . $this->_order . ' ' . $this->_sort . ' ' : ' ';
            } else if (!empty($this->_key)) {
              $query .= (!empty($this->_key)) ? ' ORDER BY ge.' . $this->_key . ' ' . $this->_sort . ' ' : ' ';
            }

            $queryTotal = $query;

            if ($this->_pager == true) {
              $pager_type = $this->_pager_type;
              $pager_url = $this->_pager_url;
              $pager_quantity = $this->_pager_quantity;
              $pager_start = $this->_pager_page * $this->_pager_quantity;
              $query .= " LIMIT $pager_start,$pager_quantity ";
            }
            /*
            print_r($query);
            exit();
            */
            $this->setQuery($query);
            $record = $this->getQuery();
            $estado = $this->getState();

            if ($estado == 'impact') {
              $this->setQuery($queryTotal);
              $rec = $this->getQuery();
              $est = $this->getState();

              if ($est == 'impact') {
                $this->setTotalRecords(count($rec));
              }
              return $record;
            }
          } else {
            $query = 'SELECT * FROM ' . $this->_table;

            if ($this->_pager == true) {
              $pager_type = $this->_pager_type;
              $pager_url = $this->_pager_url;
              $pager_quantity = $this->_pager_quantity;
              $pager_start = $this->_pager_page * $this->_pager_quantity;
              $query .= " LIMIT $pager_start,$pager_quantity ";
            }

            $this->setQuery($query);
            $record = $this->getQuery();
            $estado = $this->getState();

            if ($estado == 'impact') {
              return $record;
            }
          }
        } else {
          $this->setState('error');
        }
      } else {
        $this->setState('error');
      }
    } else {
      $this->setState('error');
    }
  }
  /**
   * selectMultiFilterUser public function
   * @uses $this->generateDatbaseTableField(), Function
   * @uses $this->validateDatbaseTableFields(), Function
   * @uses $this->_fields, Array
   * @uses $this->setQuery(), Function
   * @uses $this->getState(), Function
   * @see $this->generateDatbaseTableField()
   * @see $this->validateDatbaseTableFields()
   * @return $record, Array
   * Note: Function responsible for processing the data SELECTS and inject them using getQuery (). Filtering by the relation of that record with a user
   */
  public function selectMultiFilterUser($relation)
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTableFields();

    if (!empty($relation)) {
      if (!empty($this->_data_user_id) && !empty($this->_this_join)) {
        if ($resultValidate) {
          if (!empty($this->_fields) && is_array($this->_fields)) {
            $s = '';
            $n = count($this->_fields);
            $_have_order = false;

            for ($i = 0; $i < $n; $i++) {
              $s .= $i < ($n - 1) ? 'gc.' . $this->_fields[$i] . ', ' : 'gc.' . $this->_fields[$i];
            }

            if (in_array($this->_order, $this->_fields)) {
              $_have_order = true;
            }

            $query = 'SELECT ' . $s . ' FROM ' . $relation . ' gc ';
            $query .= ' ' . $this->_this_join . ' ';

            if (!empty($this->_key)) {
              $query .= (!empty($this->_key)) ? ' WHERE gc.' . $this->_key . '>=0 ' : ' ';
            }

            if (!empty($this->_status)) {
              $query .= (!empty($this->_status)) ? ' and gc.' . $this->_status . '>=0 ' : ' ';
            }

            if (!empty($this->_data_user)) {
              /*print_r($this->_data_user);
              exit();*/
              $query .= (!empty($this->_data_user['id_user'])) ? ' and gu.id_user="' . $this->_data_user['id_user'] . '" ' : ' ';
              $query .= (!empty($this->_data_user['id_empresa'])) ? ' and gc.id_empresa="' . $this->_data_user['id_empresa'] . '" ' : ' ';
            } else {
              $query .= (!empty($this->_data_user_id)) ? ' and gu.id_user="' . $this->_data_user_id . '" ' : ' ';
            }
            if (!empty($relation) && ($relation == 'gc_cuentas' || $relation == 'gc_superadmins')) {
              $query .= ' GROUP BY gc.' . $this->_key;
            }

            if (!empty($this->_order) && $_have_order == true) {
              $query .= (!empty($this->_order)) ? ' ORDER BY gc.' . $this->_order . ' ' . $this->_sort . ' ' : ' ';
            } else if (!empty($this->_key)) {
              $query .= (!empty($this->_key)) ? ' ORDER BY gc.' . $this->_key . ' ' . $this->_sort . ' ' : ' ';
            }

            $queryTotal = $query;

            if ($this->_pager == true) {
              $pager_type = $this->_pager_type;
              $pager_url = $this->_pager_url;
              $pager_quantity = $this->_pager_quantity;
              $pager_start = $this->_pager_page * $this->_pager_quantity;
              $query .= " LIMIT $pager_start,$pager_quantity ";
            }

            $this->setQuery($query);
            $record = $this->getQuery();
            $estado = $this->getState();

            if ($estado == 'impact') {
              $this->setQuery($queryTotal);
              $rec = $this->getQuery();
              $est = $this->getState();

              if ($est == 'impact') {
                $this->setTotalRecords(count($rec));
              }
              return $record;
            }
          } else {
            $query = 'SELECT * FROM ' . $this->_table;

            if ($this->_pager == true) {
              $pager_type = $this->_pager_type;
              $pager_url = $this->_pager_url;
              $pager_quantity = $this->_pager_quantity;
              $pager_start = $this->_pager_page * $this->_pager_quantity;
              $query .= " LIMIT $pager_start,$pager_quantity ";
            }

            $this->setQuery($query);
            $record = $this->getQuery();
            $estado = $this->getState();

            if ($estado == 'impact') {
              return $record;
            }
          }
        } else {
          $this->setState('error');
        }
      } else {
        $this->setState('error');
      }
    } else {
      $this->setState('error');
    }
  }
  /**
   * select public function
   * @uses $this->generateDatbaseTableField(), Function
   * @uses $this->validateDatbaseTableFields(), Function
   * @uses $this->_fields, Array
   * @uses $this->setQuery(), Function
   * @uses $this->getState(), Function
   * @see $this->generateDatbaseTableField()
   * @see $this->validateDatbaseTableFields()
   * @return $record, Array
   * Note: Function responsible for processing the data SELECTS and inject them using getQuery (). Filtering by the relation of that record with a user
   */
  public function selectUserFilter($relation)
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTableFields();

    if (!empty($relation)) {
      if (!empty($this->_data_user_id) && !empty($this->_this_join)) {
        if ($resultValidate) {
          if (!empty($this->_fields) && is_array($this->_fields)) {
            $s = '';
            $n = count($this->_fields);
            $_have_order = false;

            for ($i = 0; $i < $n; $i++) {
              $s .= $i < ($n - 1) ? 'ge.' . $this->_fields[$i] . ', ' : 'ge.' . $this->_fields[$i];
            }

            if (in_array($this->_order, $this->_fields)) {
              $_have_order = true;
            }

            $query = 'SELECT ' . $s . ' FROM ' . $relation . ' ge ';
            $query .= ' ' . $this->_this_join . ' ';

            if (!empty($this->_key)) {
              $query .= (!empty($this->_key)) ? ' WHERE ge.' . $this->_key . '>=0 ' : ' ';
            }

            if (!empty($this->_status)) {
              $query .= (!empty($this->_status)) ? ' and ge.' . $this->_status . '>=0 ' : ' ';
            }

            $query .= (!empty($this->_data_user_id)) ? ' and gu.id_user="' . $this->_data_user_id . '" ' : ' ';

            if (!empty($this->_order) && $_have_order == true) {
              $query .= (!empty($this->_order)) ? ' ORDER BY ge.' . $this->_order . ' ' . $this->_sort . ' ' : ' ';
            } else if (!empty($this->_key)) {
              $query .= (!empty($this->_key)) ? ' ORDER BY ge.' . $this->_key . ' ' . $this->_sort . ' ' : ' ';
            }

            $queryTotal = $query;

            if ($this->_pager == true) {
              $pager_type = $this->_pager_type;
              $pager_url = $this->_pager_url;
              $pager_quantity = $this->_pager_quantity;
              $pager_start = $this->_pager_page * $this->_pager_quantity;
              $query .= " LIMIT $pager_start,$pager_quantity ";
            }

            $this->setQuery($query);
            $record = $this->getQuery();
            $estado = $this->getState();

            if ($estado == 'impact') {
              $this->setQuery($queryTotal);
              $rec = $this->getQuery();
              $est = $this->getState();

              if ($est == 'impact') {
                $this->setTotalRecords(count($rec));
              }
              return $record;
            }
          } else {
            $query = 'SELECT * FROM ' . $this->_table;

            if ($this->_pager == true) {
              $pager_type = $this->_pager_type;
              $pager_url = $this->_pager_url;
              $pager_quantity = $this->_pager_quantity;
              $pager_start = $this->_pager_page * $this->_pager_quantity;
              $query .= " LIMIT $pager_start,$pager_quantity ";
            }

            $this->setQuery($query);
            $record = $this->getQuery();
            $estado = $this->getState();
            if ($estado == 'impact') {
              return $record;
            }
          }
        } else {
          $this->setState('error');
        }
      } else if (!empty($this->_data_user_id)) {
        if ($resultValidate) {
          if (!empty($this->_fields) && is_array($this->_fields)) {
            $s = '';
            $n = count($this->_fields);
            $_have_order = false;

            for ($i = 0; $i < $n; $i++) {
              $s .= $i < ($n - 1) ? ' ' . $this->_fields[$i] . ', ' : ' ' . $this->_fields[$i];
            }

            if (in_array($this->_order, $this->_fields)) {
              $_have_order = true;
            }

            $query = 'SELECT ' . $s . ' FROM ' . $relation . ' ';

            if (!empty($this->_key)) {
              $query .= (!empty($this->_key)) ? ' WHERE ' . $this->_key . '>=0 ' : ' ';
            }

            if (!empty($this->_status)) {
              $query .= (!empty($this->_status)) ? ' and ' . $this->_status . '>=0 ' : ' ';
            }

            $query .= (!empty($this->_data_user_id)) ? ' and id_user="' . $this->_data_user_id . '" ' : ' ';

            if (!empty($this->_order) && $_have_order == true) {
              $query .= (!empty($this->_order)) ? ' ORDER BY ' . $this->_order . ' ' . $this->_sort . ' ' : ' ';
            } else if (!empty($this->_key)) {
              $query .= (!empty($this->_key)) ? ' ORDER BY ' . $this->_key . ' ' . $this->_sort . ' ' : ' ';
            }

            $queryTotal = $query;

            if ($this->_pager == true) {
              $pager_type = $this->_pager_type;
              $pager_url = $this->_pager_url;
              $pager_quantity = $this->_pager_quantity;
              $pager_start = $this->_pager_page * $this->_pager_quantity;
              $query .= " LIMIT $pager_start,$pager_quantity ";
            }

            $this->setQuery($query);
            $record = $this->getQuery();
            $estado = $this->getState();

            if ($estado == 'impact') {
              $this->setQuery($queryTotal);
              $rec = $this->getQuery();
              $est = $this->getState();

              if ($est == 'impact') {
                $this->setTotalRecords(count($rec));
              }
              return $record;
            }
          } else {
            $query = 'SELECT * FROM ' . $this->_table;

            if ($this->_pager == true) {
              $pager_type = $this->_pager_type;
              $pager_url = $this->_pager_url;
              $pager_quantity = $this->_pager_quantity;
              $pager_start = $this->_pager_page * $this->_pager_quantity;
              $query .= " LIMIT $pager_start,$pager_quantity ";
            }

            $this->setQuery($query);
            $record = $this->getQuery();
            $estado = $this->getState();

            if ($estado == 'impact') {
              return $record;
            }
          }
        } else {
          $this->setState('error');
        }
      } else {
        $this->setState('error');
      }
    } else {
      $this->setState('error');
    }
  }

  /**
   * selectImplementFilter public function
   * @uses $this->generateDatbaseTableField(), Function
   * @uses $this->validateDatbaseTableFields(), Function
   * @uses $this->_fields, Array
   * @uses $this->setQuery(), Function
   * @uses $this->getState(), Function
   * @see $this->generateDatbaseTableField()
   * @see $this->validateDatbaseTableFields()
   * @return $record, Array
   * Note: Function responsible for processing the data SELECTS and inject them using getQuery (). Filtering by the relation of that record with a user
   */
  public function selectImplementFilter($fieldsArray)
  {
    $this->generateDatbaseTableField();
    $resultValidate = $this->validateDatbaseTableFields();
    //echo '|'.$this->_data_user_id.'|';
    //print_r($this->_data_user);

    if (!empty($fieldsArray) && is_array($fieldsArray)) {
      $fieldsString     = '';
      $fieldsStrinCount   = count($fieldsArray);
      $fieldsStrinCounter = 0;

      foreach ($fieldsArray as $key => $value) {
        $fieldsString .= $fieldsStrinCounter < ($fieldsStrinCount) ? " and " . $key . "='" . $value . "' " : " " . $key . "='" . $value . "' ";
        $fieldsStrinCounter = $fieldsStrinCounter + 1;
      }

      if ($resultValidate) {
        if (!empty($this->_fields) && is_array($this->_fields)) {
          $s = '';
          $n = count($this->_fields);
          $_have_order = false;

          for ($i = 0; $i < $n; $i++) {
            $s .= $i < ($n - 1) ? $this->_fields[$i] . ', ' : $this->_fields[$i];
          }

          if (in_array($this->_order, $this->_fields)) {
            $_have_order = true;
          }

          $query = 'SELECT ' . $s . ' FROM ' . $this->_table . ' ';

          if (!empty($this->_key)) {
            $query .= (!empty($this->_key)) ? ' WHERE ' . $this->_key . '>=0 ' : ' ';
          }

          if (!empty($this->_status)) {
            $query .= (!empty($this->_status)) ? ' and ' . $this->_status . '>=0 ' : ' ';
          }

          if (!empty($fieldsString)) {
            $query .= $fieldsString;
          }

          if (!empty($this->_order) && $_have_order == true) {
            $query .= (!empty($this->_order)) ? ' ORDER BY ' . $this->_order . ' ' . $this->_sort . ' ' : ' ';
          } else if (!empty($this->_key)) {
            $query .= (!empty($this->_key)) ? ' ORDER BY ' . $this->_key . ' ' . $this->_sort . ' ' : ' ';
          }

          $queryTotal = $query;

          if ($this->_pager == true) {
            $pager_type = $this->_pager_type;
            $pager_url = $this->_pager_url;
            $pager_quantity = $this->_pager_quantity;
            $pager_start = $this->_pager_page * $this->_pager_quantity;
            $query .= " LIMIT $pager_start,$pager_quantity ";
          }

          $this->setQuery($query);
          $record = $this->getQuery();
          $estado = $this->getState();

          if ($estado == 'impact') {
            $this->setQuery($queryTotal);
            $rec = $this->getQuery();
            $est = $this->getState();

            if ($est == 'impact') {
              $this->setTotalRecords(count($rec));
            }
            return $record;
          }
        } else {
          $query = 'SELECT * FROM ' . $this->_table;

          if ($this->_pager == true) {
            $pager_type = $this->_pager_type;
            $pager_url = $this->_pager_url;
            $pager_quantity = $this->_pager_quantity;
            $pager_start = $this->_pager_page * $this->_pager_quantity;
            $query .= " LIMIT $pager_start,$pager_quantity ";
          }

          $this->setQuery($query);
          $record = $this->getQuery();
          $estado = $this->getState();

          if ($estado == 'impact') {
            return $record;
          }
        }
      } else {
        $this->setState('error');
      }
    } else {
      $this->setState('error');
    }
  }
}
