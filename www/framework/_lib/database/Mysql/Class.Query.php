<?php
/**
 * Query, Genera todos los query
 * 
 * La Calsse Query es la encargada de interactuar directamente con la Database
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Query class,
 * @package {SMVC} Simple Model View Controller
 * @subpackage database
 */
class Query
{
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
	public function __destruct()
	{
		//unset($this);
	}
	/**
     * reset public function
	 * Note: Funcion que resetea las varfiables. El objetivo es poder seguir utilizando puntero de conexion y no tener que re instanciar la classe.
     */
	public function reset()
	{
		//$this->conn = '';
		$this->_colection = '';
		$this->_query = '';
		$this->_lastId = '';
		$this->_state = '';
	}
	/**
     * setConection public function
	 * @uses $conn, Object
	 * Note: Funcion que recibe el puntero y lo pone disponible para su uso.
     */
	public function setConection($conn)
	{
		$this->conn = $conn->conn;
	}
	/**
     * setQuery public function
	 * @uses $query, String
	 * Note: Funcion que la consulta en forma de String.
     */
	public function setQuery($query)
	{
		$this->_query = $query;
	}
	/**
     * save public function
	 * Note: Funcion que prepara los objetos para ser incorporados a la Database.
     */
	/*public function save()
	{
		return $this->_colection;
	}*/
	/**
     * getQuery public function
	 * @uses $this->_query, String
	 * @uses $this->setState, Function
	 * @return $recordset, Array
	 * Note: Funcion para injecta SQL a la Database (selects preferentemente), setea un estado y retorna una arreglo con los valores de la consulta.
     */
	public function getQuery()
	{
		if(!empty($this->_query))
		{
			$recordset = array();
			
			if( $res = mysql_query($this->_query,$this->conn) )
			{
				$isUpdate = strpos($this->_query, 'UPDATE');
				$isInsert = strpos($this->_query, 'INSERT');
				
				if ($isUpdate === false && $isInsert === false) {
					
					$numRow = mysql_num_rows($res);
	
					if(!is_bool($res) and $numRow>0)
					{					
						while($aux = mysql_fetch_object($res))
						{
							$recordset[] = $aux;
						}
						
						mysql_free_result($res);
						$this->setState('impact');
						
						if(CONFIG_TRIGGER==true)
						{
							$this->trigger($this->_query);
						}
				
						return $recordset;
					}
					else
					{
						$this->setState('impact');
					}
				}
				else
				{
					if ($isUpdate === true)
					{
						$this->setLastId($this->conn->insert_id);
					}
					$this->setState('impact');
					
					if(CONFIG_TRIGGER==true)
					{
						$this->trigger($this->_query);
					}
				}
			}
			else
			{
				$this->setState($this->conn->error);
			}
		}
	}
	/**
     * setInsert public function
	 * @uses $this->_query, String
	 * @usee $this->setState, Function
	 * @uses $this->setLastId, Function
	 * Note: Funcion para hacer inserts en la Database, retorna el ID de la consulta.
     */
	public function setInsert()
	{
		if( $result = mysql_query($this->_query,$this->conn) )
		{
			$this->setLastId(mysql_insert_id($this->conn));
			$this->setState('impact');
			
			if(CONFIG_TRIGGER==true)
			{
				$this->trigger($this->_query);
			}
		}
		else
		{
			$this->setState( mysql_error($this->conn) );
		}
	}
	/**
     * setLastId public function
	 * @uses $id, String
	 * Note: Funcion que deja disponible el ID de la consulta.
     */
	public function setLastId($id)
	{
		$this->_lastId = $id;
	}
	/**
     * setState public function
	 * @uses $valor, String
	 * Note: Funcion que guarda el estado de las consultas.
     */
	public function setState($valor)
	{
		$this->_state = $valor;	
	}
	/**
     * escapeString public function
	 * @uses $variable, String
	 * @return String
	 * Note: Funcion que limpia los Strings.
     */
	public function escapeString($chain)
	{
		if(get_magic_quotes_gpc() != 0) 
		{
        	$chain = stripslashes($chain);
		}
		$the_return = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($chain) : mysql_escape_string($chain);
		return $the_return;
	}
	/**
     * getState public function
     * @return $this->_state, String
	 * Note: Funcion que setea el estado de una accion.
     */
	public function getState()
	{
		return $this->_state;	
	}
	/**
     * getLastId public function
     * @return $this->_lastId, String
	 * Note: Funcion que retorna el ultimo ID.
     */
	public function getLastId()
	{
		return $this->_lastId;
	}
	/**
     * setDelete public function
	 * @uses $this->_query, String
	 * @uses $this->setState, Function
	 * Note: Funcion para manipula los DELETE.
     */
	public function setDelete()
	{
		if( $result = mysql_query($this->_query,$this->conn) )
		{
			$this->setState('impact');
			
			if(CONFIG_TRIGGER==true)
			{
				$this->trigger($this->_query);
			}
		}
		else
		{
			$this->setState( mysql_error($this->conn) );
		}
	}
	/**
     * setUpdate public function
	 * @uses $this->_query, String
	 * @uses $this->setState, Function
	 * Note: Funcion para manipula los UPDATE.
     */
	public function setUpdate()
	{
		if( $result = mysql_query($this->_query,$this->conn) )
		{
			$this->setState('impact');
			
			if(CONFIG_TRIGGER==true)
			{
				$this->trigger($this->_query);
			}
		}
		else
		{
			$this->setState( mysql_error($this->conn) );
		}
	}
	/**
     * setInjection public function
	 * @uses $this->_query, String
	 * @usee $this->setState, Function
	 * Note: Funcion para hacer consultas directas.
     */
	public function setInjection()
	{
		$recordset = array();
			
		if( $res = mysql_query($this->_query,$this->conn) )
		{
			$isUpdate = strpos($this->_query, 'UPDATE');
			$isInsert = strpos($this->_query, 'INSERT');
			
			if ($isUpdate === false && $isInsert === false) {
				
				$numRow = mysql_num_rows($res);

				if(!is_bool($res) and $numRow>0)
				{					
					while($aux = mysql_fetch_object($res))
					{
						$recordset[] = $aux;
					}
					
					mysql_free_result($res);
					$this->setState('impact');
					
					if(CONFIG_TRIGGER==true)
					{
						$this->trigger($this->_query);
					}
			
					return $recordset;
				}
				else
				{
					$this->setState('impact');
				}
			}
			else
			{
				$this->setState('Error method no acept UPDATE or INSERT');
			}
		}
		else
		{
			$this->setState($this->conn->error);
		}
	}
	/**
     * trigger public function
	 * @uses $conn, Object
	 * @usee TriggerInjection(), Function
	 * @uses setTriggerInjection(), Function
	 * Note: Genera log de datos.
     */
	public function trigger($var)
	{
		require_once( dirname(__FILE__) . "/../../../_lib/trigger/Class.Trigger.Injection.php");
		$t = new TriggerInjection(); // Trakeo de injection
		$t->setTriggerInjection(false, $var, CONFIG_TRIGGER, CONFIG_TRIGGER_PUGE, CONFIG_TRIGGER_VARS);
	}
}
?>