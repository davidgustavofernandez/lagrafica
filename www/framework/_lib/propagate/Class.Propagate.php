<?php
/**
 * Propagate, Propaga y trata las variables
 * 
 * La Calsse Propagate es la encargada de propagar y trata las variables que vienen por POST, GET y REQUEST
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @version 2.00 (20/10/2016)
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
						if(!empty($_GET['latitud']) || !empty($_GET['longitud']) || !empty($_GET['x_card_num']) || !empty($_GET['transaction_id']) || !empty($_GET['precio']) || !empty($_GET['precio_antes']) || !empty($_GET['f_phone']) || !empty($_GET['f_phone_mobile']) || !empty($_GET['telefono']) || !empty($_GET['celular']) || !empty($_GET['numero']) )
						{
							return isset($_GET[$variable])? intval($_GET[$variable]) : intval($else);
						}
						else
						{
							return isset($_GET[$variable])? $_GET[$variable] : intval($else);
						}
					}
					else
					{
						return isset($_GET[$variable])? $this->_injection($_GET[$variable]) : $else;
					}
				break;
				
				case 'post':
					if(is_numeric($else))
					{
						if(!empty($_POST['latitud']) || !empty($_POST['longitud']) || !empty($_POST['x_card_num']) || !empty($_POST['transaction_id']) || !empty($_POST['precio']) || !empty($_POST['precio_antes']) || !empty($_POST['f_phone']) || !empty($_POST['f_phone_mobile']) || !empty($_POST['telefono']) || !empty($_POST['celular']) || !empty($_POST['numero']) )
						{
							return isset($_POST[$variable])? $_POST[$variable] : intval($else);
						}
						else
						{
							return isset($_POST[$variable])? intval($_POST[$variable]) : intval($else);
						}
					}
					else
					{
						return isset($_POST[$variable])? $this->_injection($_POST[$variable]) : $else ;
					}
				break;
				
				case 'request':
					if(is_numeric($else) && !empty($_REQUEST[$variable]))
					{
						if(!empty($_REQUEST['latitud']) || !empty($_REQUEST['longitud']) || !empty($_REQUEST['x_card_num']) || !empty($_REQUEST['transaction_id']) || !empty($_REQUEST['precio']) || !empty($_REQUEST['precio_antes']) || !empty($_REQUEST['f_phone']) || !empty($_REQUEST['f_phone_mobile']) || !empty($_REQUEST['telefono']) || !empty($_REQUEST['celular']) || !empty($_REQUEST['numero']) )
						{
							return isset($_REQUEST[$variable])? $_REQUEST[$variable] : intval($else) ;
						}
						else
						{
							return isset($_REQUEST[$variable])? intval($_REQUEST[$variable]) : intval($else) ;
						}	
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
	public function clean($variable, $else='')
	{
		if(is_numeric($else) && !empty($variable))
		{
			return isset($variable)? intval($variable) : intval($else) ;
		}
		else
		{
			return isset($variable)? $this->_injection($variable) : $else ;
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
				//'"',
				// "'",
				//"&",
				"--",
				"select",
				//"insert",
				"update",
				//"delete",
				// "drop",
				//"%",
				// ";",
				//"=",
				"\\",
				// "<script>",
				// "< /script>",
				// "</script>",
				//"#",
				"<input",
				"<textarea",
				"<option",
				"<select",
				"<button",
				//"!",
				"`",
				"\\",
				//"/",
				// "(",
				// ")",
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
		
		if(is_numeric($chain))
		{
			// echo 'Numeric:' . $chain . '<br>';
			if(preg_match('/^0x/', $chain))
			{
				return $chain;
			}
			else
			{
				return preg_replace('@([^0-9+-.])@Ui', '', $chain);
			}
		}
		elseif(!empty($chain))
		{
			if(!is_array($chain)) { 
				$chain = trim($chain);
			};
			
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
				// echo 'Numeric:' . $chain . '<br>';
				if(preg_match('/^0x/', $chain))
				{
					return $chain;
				}
				else
				{
					return preg_replace('@([^0-9+-.])@Ui', '', $chain);
				}
			}
			else if(is_bool($chain))
			{
				return (boolean) ($chain?true:false);
			}
			else if(is_float($chain))
			{
				//echo 'Float:' . $chain . '<br>';
				return (float) preg_replace("@([^0-9\,\.\+\-])@Ui", "", $chain);
			}
			else if(is_string($chain))
			{
				// echo 'String:' . $chain . '<br>';
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
					//return (string) $this->escapeString(preg_replace("@([^a-zA-Z0-9\+\-\_\*\@\$\!\;\.\,\?\#\:\=\%\/\ ]+)@Ui", "", $chain));
					return (string) $this->escapeString($chain);
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
