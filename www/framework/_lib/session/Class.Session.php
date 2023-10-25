<?php
/**
 * Sesion, Trata las Sessiones
 * 
 * La Calsse Sesion es la encargada de manipular todo lo relacionado a las Sessiones
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Sesion class,
 * @package {SMVC} Simple Model View Controller
 * @subpackage database
 */
class Session 
{
	/**
     * Configuration values
     * @access private
     * @var boolean
     */
	private $_Debug = false;
	/**
     * Configuration values
     * @access private
     * @var string
     */
	private $_State = '';
	/**
     * Configuration values
     * @access private
     * @var array
     */
	private $_StateArray = array();
	/**
     * Configuration values
     * @access private
     * @var string
     */
	private $_FlagVariable;
	/**
     * Configuration values
     * @access private
     * @var string
     */
	private $_FlagValue;
	/**
     * Configuration values
     * @access private
     * @var string
     */
	private $_Name = 'nOmBrE_dE_sEsSiOn';
	/**
     * Configuration values
     * @access private
     * @var boolean
     */
	private $_Expire = false;
	/**
     * Configuration values
     * @access private
     * @var number
     */
	private $_ExpireTime = 600;
	/**
     * Configuration values
     * @access private
     * @var string
     */
	private $_Key = '';
	/**
     * Configuration values
     * @access private
     * @var string
     */
	private $_SessionVariable = '';
	/**
     * Configuration values
     * @access private
     * @var string
     */
	private $_SessionValue = '';
	/**
     * Configuration values
     * @access private
     * @var string
     */
	private $_ip = '';
	/**
     * setDebug public function
	 * @uses $_StateArray, Array
	 * Note: Carga el array _StateArray con los valores que se disparan en cada funcion.
     */
	public function setDebug($valor)
	{
		$this->_Debug = $valor;
	}
	/**
     * setState private function
	 * @uses $_StateArray, Array
	 * Note: Carga el array _StateArray con los valores que se disparan en cada funcion.
     */
	private function setState($state)
	{
		if($this->_Debug == true)
		{
			$this->_StateArray[] = $state;
		}
		else
		{
			$this->_StateArray = array('TO DEGUG PLEASE ACTIVATE MODE DEBUG');
		}
	}
	/**
     * setKey public function
	 * @uses $_Key, String
	 * @uses setIp, Function
	 * @uses setState, Function
	 * Note: Carga el array _StateArray con los valores que se disparan en cada funcion.
     */
	public function setKey($key)
	{
		$this->setIp();
		//$this->_Key = $key;
		$this->_Key = md5(md5($key).md5($this->_ip));
		$this->setState('Key is create: ' . $key);
	}
	/**
     * setFlag public function
	 * @uses $_FlagVariable, String
	 * @uses $_FlagValue, String
	 * @uses setState, Function
	 * Note: Configura los valores que seran usados como bandera de SESSION.
     */
	public function setFlagValors($variable,$value)
	{
		$this->_FlagVariable = md5($variable);
		$this->_FlagValue = md5($value);
		$this->setState('VALORS FLAG IS SET: ' . $variable . $value);
	}
	/**
     * setName public function
	 * @uses $_Name, String
	 * @uses setState, Function
	 * Note: Setea el nombre que sera usada al crear la session.
     */
	public function setName($sesionName)
	{
		$this->_Name = $sesionName;
		$this->setState('NAME FOR SESSION IS ASIGNATE: ' . $sesionName);
	}
	/**
     * setExpireTime public function
	 * @uses $_Expire, String
	 * @uses $_ExpireTime, String
	 * @uses setState, Function
	 * Note: Esta funcion setea $_ExpireTime que sera el el tiempo de expiracion de session.
     */
	public function setExpireTime($valor){
		$this->_Expire = true;
		$this->_ExpireTime = $valor;
		$this->setState('SESSION_EXPIRE IS SET: ' . $valor);
	}
	/**
     * init public function
	 * @uses $_SESSION, Array
	 * @uses $_Expire, String
	 * @uses $_ExpireTime, String
	 * @uses $_Name, String
	 * @uses setFlag, Function
	 * @uses setState, Function
	 * Note: Esta funcion crea la session.
     */
	public function init()
	{
		if( $this->_Expire===true )
		{
			session_cache_expire($this->_ExpireTime);
			$this->setState('IMPACT SESSION_EXPIRE: ' . $this->_ExpireTime);
		}
		session_name($this->_Name);
		session_start();
		$this->setFlag();
	}
	
	/**
     * propagate public function
	 * @uses $_SESSION, Array
	 * @uses $_Expire, String
	 * @uses $_ExpireTime, String
	 * @uses $_Name, String
	 * @uses setFlag, Function
	 * @uses setState, Function
	 * Note: Esta funcion propaga los datos de session.
     */
	public function propagate()
	{
		if( $this->_Expire===true )
		{
			session_cache_expire($this->_ExpireTime);
			$this->setState('IMPACT SESSION_EXPIRE: ' . $this->_ExpireTime);
		}
		session_name($this->_Name);
		session_start();
		$this->setState('PORPAGATE SESSION');
	}
	/**
     * setFlag public function
	 * @uses $_SESSION, Array
	 * @uses $_FlagVariable, String
	 * @uses $_FlagValue, String
	 * @uses setState, Function
	 * Note: Configura una variable como Bandera de SESSION dentro de la SESSSION.
     */
	public function setFlag()
	{
		if( isset($this->_FlagVariable) && isset($this->_FlagValue) )
		{
			$_SESSION[$this->_FlagVariable] = $this->_FlagValue;
			$this->setState('SET FLAG');
		}
	}
	/**
     * unSetFlag public function
	 * @uses $_SESSION, Array
	 * @uses $_FlagVariable, String
	 * @uses $_FlagValue, String
	 * @uses setState, Function
	 * Note: Elimina la variable en SESSSION. Esto probocara que los datos no sean tomados en cuenta.
     */
	private function unSetFlag()
	{
		if( isset($this->_FlagVariable) && isset($this->_FlagValue) )
		{
			//session_unregister($this->_FlagVariable);
			unset($_SESSION[$this->_FlagVariable]);
			$this->setState('UN SET Flag');
		}
	}
	/**
     * setVariable public function
	 * @uses $_SESSION, Array
	 * @uses $_FlagVariable, String
	 * @uses $_Key, String
	 * @uses $_SessionVariable, String
	 * @uses $_SessionValue, String
	 * @uses setVariableValor, Function
	 * @uses setState, Function 
	 * Note: Configura los valores para un nueva variable de SESSION.
     */
	public function setVariable($variable, $valor)
	{
		if (array_key_exists($this->_FlagVariable,$_SESSION)) 
		{
			if( !empty($variable) && !empty($valor) )
			{
				$this->_SessionVariable = $variable;
				$this->_SessionValue = $valor;
				$variableSession = md5($this->_SessionVariable . $this->_Key);
				/* Queda inahabilitado el filtro de no poder redefinir una variable.
				 * if( isset($_SESSION[$variableSession]) == false ){*/
					if(!is_array($this->_SessionValue)){
						$_SESSION[$variableSession] = base64_encode($this->_SessionValue);
						$this->setState('WRITE VAR '. $_SESSION[$variableSession] = base64_encode($this->_SessionValue));
						return $this->_State;
					}else{
						$_SESSION[$variableSession] = base64_encode(serialize($this->_SessionValue));
						$this->setState('WRITE ARRAY ' . $_SESSION[$variableSession] = base64_encode(serialize($this->_SessionValue)) );
						return $this->_State;
					}
				
				/*}else{
					$this->setState('DONT RE WRITE VAR');
					return $this->_State;
				}*/
			}
			
		}
		else
		{
			$this->setState('NO HAVE SESSION');
			return $this->_State;
		}
	}
	/**
     * getVariable public function
     * @uses $_SESSION, Array
	 * @uses $_Key, String
	 * @uses $_FlagVariable, String
	 * @uses $variable, String
	 * @uses $_State, String
	 * @uses setState(), Function
	 * Note: Retorna el valor de una variable que existe en la SESSION.
	 * Nota valid 1: Que el valor $_FlagVariable este en la matriz de la session.
	 * Nota valid 2: Que la variable a retornar exista.
     */
	public function getVariable($variable,$returnArray=false)
	{
		if (array_key_exists($this->_FlagVariable,$_SESSION)) 
		{ 
			$variableSession = md5($variable . $this->_Key);
			if( isset($_SESSION[$variableSession]) )
			{
				if(!$returnArray) {
					$this->setState('DATA IN VAR');
					return base64_decode($_SESSION[$variableSession]);
				}else{
					$this->setState('DATA IN ARRAY');
					return unserialize(base64_decode($_SESSION[$variableSession]));
				}
			}
			else
			{
				$this->setState('UNDEFINED VAR');
				return false;
			}
		}
		else
		{
			$this->setState('NO HAVE SESSION');
			return false;
		}
	}
	

	/**
     * setVariableChange public function
     * @uses $_SESSION, Array
	 * @uses $_Key, Array
	 * @uses $_FlagVariable, String
	 * @uses $_State, String
	 * @uses $_SessionVariable, String
	 * @uses $_SessionValue, String
	 * @uses $variable, String
	 * @uses $valor, String
	 * @uses setState(), Function
	 * Note: Esta funcion crea una nueva variable de session con su valor.
	 * Nota valid 1: Que el valor _varLogon este en la matriz de la session.
	 * Nota valid 2: Que la variable ya este creada.
     */
	public function setVariableChange($variable, $valor, $tipo=true)
	{
		if (array_key_exists($this->_FlagVariable,$_SESSION)) 
		{
			if( !empty($variable) && !empty($valor) )
			{
				$this->_SessionVariable = $variable;
				$this->_SessionValue = $valor;
				
				$variableSession = md5($this->_SessionVariable . $this->_Key);
				
				if( isset($_SESSION[$variableSession]) == true )
				{
					if($tipo===true)
					{
						$_SESSION[$variableSession] = base64_encode($this->_SessionValue);
						$this->setState('RE WRITE VAR '. $_SESSION[$variableSession] = base64_encode($this->_SessionValue));
						return $this->_State;
					}
					else
					{
						$_SESSION[$variableSession] = base64_encode(serialize($this->_SessionValue));
						$this->setState('WRITE ARRAY ' . $_SESSION[$variableSession] = base64_encode(serialize($this->_SessionValue)) );
						return $this->_State;
					}
				}
				else
				{
					$this->setState('UNDEFINED VAR');
					return $this->_State;
				}
			}
		}
		else
		{
			$this->setState('NO HAVE SESSION');
			return $this->_State;
		}
	}
	/**
     * setVariableUnset public function
     * @uses $_SESSION, Array
	 * @uses $_varLogon, String
	 * @uses $_var, String
	 * @uses $_val, String
	 * @uses $_State, String
	 * @uses setState(), Function
	 * Note: Esta funcion destruye una variable de session con su valor.
	 * Nota valid 1: Que el valor _varLogon este en la matriz de la session.
	 * Nota valid 2: Que la variable ya este creada.
     */
	public function setVariableUnset($variable)
	{
		if (array_key_exists($this->_FlagVariable,$_SESSION)) 
		{
			$variableSession = md5($variable . $this->_Key);
			if( isset($_SESSION[$variableSession]) )
			{
				$_SESSION[$variableSession]	= '';
				unset($_SESSION[$variableSession]);
				$this->setState('UNSET VAR');
				return $this->_State;
			}
			else
			{
				$this->setState('UNDEFINED VAR');
				return $this->_State;
			}
		}
		else
		{
			$this->setState('NO HAVE SESSION');
			return $this->_State;
		}
	}
	/**
     * setDestroy public function
	 * @uses $_SESSION, Array
	 * @uses $_State, String
	 * @uses setState(), Function
	 * Note: Esta funcion destruye todas las variables y la session.
     */
	public function setDestroy()
	{
		//session_name($this->_Name);
		//session_start();
		//$this->unSetFlag();
		if(isset($_SESSION))
		{
			foreach($_SESSION as $var=> $val)
			{
				//session_unregister($var);
				unset($_SESSION[$var]);
				$this->setState('UNSET VAR: ' . $var);
			}
		}
		session_unset(); 
		session_destroy();
		
		$this->setState('SESSION DESTROY');
	}
	// Verifica la ip real de un usuario
	/**
     * setIp public function
	 * @uses $valor, String
	 * @uses _ip, String
	 * @uses _State, String
	 * @uses setState(), Function
	 * Note: Esta funcion verifica la ip real de un usuario.
     */
	function setIp()
	{
		if( isset($_SERVER['HTTP_CLIENT_IP']) && strcasecmp(isset($_SERVER['HTTP_CLIENT_IP']),"0.0.0.0") )
		{
		    $this->_ip = $_SERVER['HTTP_CLIENT_IP'];
			$this->setState('IMPACT IP' . $this->_ip);
		}
		elseif( isset($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp(isset($_SERVER['HTTP_X_FORWARDED_FOR']),"0.0.0.0"))
		{
		    $this->_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			$this->setState('IMPACT IP' . $this->_ip);
		}
		elseif(isset($_SERVER['REMOTE_ADDR']) && strcasecmp(isset($_SERVER['REMOTE_ADDR']), "0.0.0.0"))
		{
		    $this->_ip=$_SERVER['REMOTE_ADDR'];
			$this->setState('IMPACT IP' . $this->_ip);
		}
		elseif(isset($_SERVER['REMOTE_ADDR']) && strcasecmp(isset($_SERVER['REMOTE_ADDR']),"0.0.0.0"))
		{
			$this->_ip = $_SERVER['REMOTE_ADDR'];
			$this->setState('IMPACT IP' . $this->_ip);
		}
		else
		{
			$this->_ip = '10000000000000000001';
			$this->setState('NO IMPACT IP');
			$this->setState('IMPACT IP: ' . $this->_ip);
		}
				
		return $this->_State;
	}
	/**
     * getKey private function
	 * @uses _key, String
	 * Note: Retorna $_key.
     */
	private function getKey()
	{
		return $this->_key;
	}
	/**
     * getIp private function
	 * @uses _ip, String
	 * Note: Retorna $_ip.
     */
	private function getIp()
	{
		return $this->_ip;
	}
	/**
     * getState public function
	 * @uses _State, String
	 * Note: Retorna _State.
     */
	public function getState()
	{
		return $this->_StateArray;
	}	
	
	###############################################
	/**
     * confirmKey public function
	 * @uses $_Key, String
	 * @uses setIp, Function
	 * @uses setState, Function
	 * Note: Se encarga de validar si la KEy de session es valida.
     */
	public function confirmKey($key)
	{
		$this->setIp();
		
		if( isset($this->_Key) && isset($this->_ip) )
		{
			if($this->_Key == md5(md5($key).md5($this->_ip)))
			{
				$this->setState('Key vaidate: TRUE');
				return true;
			}else{
				$this->setState('Key vaidate: FALSE');
				return false;
			}
		}else{
			$this->setState('Key valors no set: FALSE');
			return false;
		}
		
	}
	/**
     * confirmFlag public function
	 * @uses $_FlagVariable, String
	 * @uses $_FlagValue, String
	 * @uses setState, Function
	 * Note: Se encarga de validar los valores usados como bandera.
     */
	public function confirmFlag()
	{
		
		if( isset($this->_FlagVariable) && isset($this->_FlagValue) && isset($_SESSION[$this->_FlagVariable]) )
		{
			if($_SESSION[$this->_FlagVariable] == $this->_FlagValue)
			{
				$this->setState('FLAG vaidate: TRUE');
				return true;
			}else{
				$this->setState('Key vaidate: FALSE');
				return false;
			}
		}else{
			$this->setState('FLAG valors no set');
			return false;
		}
	}
}
?>