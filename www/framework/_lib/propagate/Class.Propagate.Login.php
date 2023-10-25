<?php
/**
 * Propagate Login, Propaga y trata las variables
 * 
 * La Calsse Propagate Login es la encargada de propagar y trata las variables que vienen por POST, GET y REQUEST solo para el login
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Propagate class,
 * @package {SMVC} Simple Model View Controller
 * @subpackage framework
 */
class Propagate
{	
	/**
	 * Configuration private variable values, 
	 * 
	 * Configuration values
	 * @access private
	 * @var string
	 */
	private $_method = 'post';
	/**
     * Configuration values
	 * @access private
     * @var boolean
     */
	private $_filter = false;
	/**
     * Configuration values
	 * @access private
     * @var array
     */
	private $_method_available = array('get','post','request');

	/**
     * Constructor sets up
	 * @see __construct()
     */
	public function __construct()
	{
		//$this->setMethod('post');
		$this->setFilter(false);
		$this->init();
	}
	/**
     * Set if the filter is going to applied
     *
     * @param  boolean  $filter
     */
    public function setFilter($filter=false)
    {
		$this->_filter 	= $filter;
	}
	/**
     * spread function
	 * @uses $method, String
	 * @uses $variable, String
	 * @uses $else, String/Number
	 * @uses $this->_method_available, Array
	 * @uses $_GET, Array
	 * @uses $_POST, Array
	 * @uses $_REQUEST, Array
	 * Note: Funcion que propaga las variables segun el metodo que se le pasa y el nombre de la variable
	 */
    public function spread($method='post', $variable, $else='')
	{
		if(in_array($method,$this->_method_available))
		{
			//global ${$variable};
			switch($method)
			{
				case 'get':
					if(is_numeric($else))
					{
						return isset($_GET[$variable])? intval($_GET[$variable]) : intval($else) ;
					}
					else
					{
						return isset($_GET[$variable])? $this->_injection($_GET[$variable]) : $else ;
					}
				break;
				
				case 'post':
					if(is_numeric($else))
					{
						return isset($_POST[$variable])? intval($_POST[$variable]) : intval($else) ;
					}
					else
					{
						return isset($_POST[$variable])? $this->_injection($_POST[$variable]) : $else ;
					}
				break;
				
				case 'request':
					if(is_numeric($else))
					{
						return isset($_REQUEST[$variable])? intval($_REQUEST[$variable]) : intval($else) ;
					}
					else
					{
						return isset($_REQUEST[$variable])? $this->_injection($_REQUEST[$variable]) : $else ;
					}
				break;
				
				default:
					return '';
				break;
			}
		}
	}
	/**
	 * _injection function
	 * 
	 * Note: Funcion que trata la cadena de manera que el resultado no sea peligroso para el sistema
	 * @param  string  $chain
	 * @return string
	 */
	private function _injection($chain)
	{
		if($this->_filter === true)
		{
			$no_admite = array(
							   '"',
							   "'",
							   "&",
							   "--",
							   "select",
							   "insert",
							   "update",
							   "delete",
							   "drop",
							   "%",
							   ";",
							   "=",
							   "\\",
							   "<script>",
							   "< /script>",
							   "</script>",
							   "#",
							   "<input",
							   "<textarea",
							   "<option",
							   "<select",
							   "<button",
							   "!",
							   "`",
							   "\\",
							   "/",
							   "(",
							   ")",
							   "*",
							   "execute ",
							   "exec ",
							   "exec(",
							   "/*",
							   "*/",
							   "xp_"
							   );
			
			foreach( $no_admite as $no_admite_str )
			{
				$chain = str_replace($no_admite_str,"", $chain);
				$chain = str_replace(strtoupper($no_admite_str),"", $chain);
			}
		}
		
		if(!empty($chain))
		{
			if(!is_array($chain)) { $chain = trim($chain); };
			
			if(is_array($chain))
			{
				$chainArray = array();
				
				foreach ($chain as $claveChain => $valorChain)
				{
					$chainArray[$claveChain] = $this->getInjection($valorChain);
				}
				
				return (array) $chainArray;
			}
			else if(is_numeric($chain))
			{
				return preg_replace("@([^0-9])@Ui", "", $chain);
			}
			else if(is_bool($chain))
			{
				return (boolean) ($chain?true:false);
			}
			else if(is_float($chain))
			{
				return (float) preg_replace("@([^0-9\,\.\+\-])@Ui", "", $chain);
			}
			else if(is_string($chain))
			{
				if(filter_var ($chain, FILTER_VALIDATE_URL))
				{
					return (string) $this->escapeString($chain);
				}
				else if(filter_var ($chain, FILTER_VALIDATE_EMAIL))
				{
					return (string) $this->escapeString($chain);
				}
				else if(filter_var ($chain, FILTER_VALIDATE_IP))
				{
					return (string) $this->escapeString($chain);
				}
				else if(filter_var ($chain, FILTER_VALIDATE_FLOAT))
				{
					return (string) $this->escapeString($chain);
				}
				else
				{
					return (string) $this->escapeString(preg_replace("@([^a-zA-Z0-9\+\-\_\*\@\$\!\;\.\?\#\:\=\%\/\ ]+)@Ui", "", $chain));
					//return (string) $this->escapeString($chain);
				}
			}
		}
		else
		{
			return '';
		}
	}
	/**
	 * getInjection function
	 * 
	 * Note: Funcion que trata la cadena de manera que el resultado no sea peligroso para el sistema
	 * @param  string  $chain
	 * @return string
	 */
	public function getInjection($chain)
	{
		return $this->_injection($chain);
	}
	/**
     * escapeString public function
	 * @uses $variable, String
	 * @return String
	 * Note: Funcion que limpia los Strings.
     */
	public function escapeString($chain)
	{
		// if(get_magic_quotes_gpc() != 0)
		// {
        	$chain = stripslashes($chain);
		// }
		$connex = new mysqli(CONFIG_DB_HOST, CONFIG_DB_USER, CONFIG_DB_PASS, CONFIG_DB_NAME, CONFIG_DB_PORT) or trigger_error($connex->error($connex),E_USER_ERROR);
		$retorno = $connex->real_escape_string($chain);
		$connex->close();
		return $retorno;
	}
	/**
     * escapeString public function
	 * @uses $variable, String
	 * @return String
	 * Note: Funcion que limpia los Strings.
     */
	public function init()
	{
		if($_GET)
		{
			$this->_filter = true;
			foreach ($_GET as $claveGet => $valorGet)
			{
				$_GET[$claveGet] = $this->getInjection($valorGet);
			}
		}
		if($_POST)
		{
			$this->_filter = true;
			foreach ($_POST as $clavePost => $valorPost)
			{
				$_POST[$clavePost] = $this->getInjection($valorPost);
			}
		}
		if($_REQUEST)
		{
			$this->_filter = true;
			foreach ($_REQUEST as $claveRequest => $valorRequest)
			{
				$_REQUEST[$claveRequest] = $this->getInjection($valorRequest);
			}
		}
	}
	/**
     * Destructor sets up
	 * @see __destruct()
     */
	public function __destruct()
	{
		//unset($this);
	}
	
}

?>