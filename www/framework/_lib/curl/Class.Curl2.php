<?php
/**
 * UseCurl, Genera consultas utilizando CURL
 * 
 * La Calsse UseCurl retorna el contenido de uan URL.
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SP MVC} Scaffolding Project - Model View Controller
 * @version 1.0
 * @package {SP MVC} Scaffolding Project - Model View Controller
 */
/**
 * UseCurl class,
 * @package {SP MVC} Scaffolding Project - Model View Controller
 * @subpackage UseCurl
 * 
 * @example:
 * $curl = new Curl();
 * $url = array('URL' => 'http://www.youtube.com/results');
 * $curl->setUrl($url);
 * $parametres = array(
 * 	'search_query' 	=> 'official trailer 2013',
 * 	'oq' 			=> 'official trailer 2013'
 * );
 * $curl->setParams($parametres);
 * $retorno = $curl->getRequest();
 * echo $retorno;
 */
/**
 * Injection class,
 * @package {SP MVC} Scaffolding Project - Model View Controller
 * @subpackage framework
 */
class Curl
{
	/**
     * Configuration values
     * @access private
     * @var string
     */
	private $_curl_url;
	/**
     * Configuration values
     * @access private
     * @var boolean
     */
	private $_curl_if_available = false;
	/**
     * Configuration values
     * @access private
     * @var string
     */
	private $_curl_result;
	/**
     * Configuration values
     * @access private
     * @var string
     */
	private $_curl_useragent;
	/**
     * Configuration values
     * @access private
     * @var string
     */
	private $_curl_method;
	/**
     * Configuration values
     * @access private
     * @var string
     */
	private $_curl_parameters;
	/**
     * Configuration values
     * @access private
     * @var string
     */
	private $_SessionId = '';
	/**
     * Configuration values
     * @access private
     * @var array
     */
	private $_curl_autentication_user = '';
	/**
     * __construct public function
	 * @uses setUseragent, function
	 * @uses setMethod, function
	 * @uses setCurlAvailable, function
	 * @see __construct()
	 * @desc Instancia los métodos para "Useagent", "Method", "CurlAvailable".
	 * @access public
     */
	public function __construct()
	{
		$this->setUseragent();
		$this->setMethod();
		$this->setCurlAvailable();
	}
	/**
     * setUseragent public function
	 * @uses $_curl_useragent, variable
	 * @param $useragent, string
	 * @desc Setea Agente.
	 * @access public
     */
	public function setUseragent($useragent='') 
	{
		if(empty($useragent))
		{
			$this->_curl_useragent = 'API PHP5 Client 1.1 (curl) ' . phpversion();
		}
		else
		{
			$this->_curl_useragent = $useragent;
		}
	}
	/**
     * setMethod public function
	 * @uses $_curl_method, variable
	 * @param $method, string
	 * @desc Setea el método que se implementara.
	 * @access public
     */
	public function setMethod($method='POST') 
	{
		$this->_curl_method = $method;
	}
	/**
     * setCurlAvailable protected function
	 * @uses function_exists, function
	 * @uses $_curl_if_available, variable
	 * @desc Indica si esta configurado y operable CURL en el sistema.
	 * @access protected
     */
	protected function setCurlAvailable() 
	{
		if (function_exists('curl_init')) 
		{
			$this->_curl_if_available = true;
		}
		else
		{
			$this->_curl_if_available = false;
		}
	}
	/**
     * setUrl public function
	 * @param $url, array
	 * @uses $_curl_result, variable
	 * @uses $_curl_url, variable
	 * @desc URL a usar.
	 * @access public
     */
	public function setUrl($url) 
	{
		if(empty($url) && !is_array($url))
		{
			$this->_curl_result = 'error: need url string';
			return $this->_curl_result;
		}
		else
		{
			$this->_curl_url = $url['URL'];
		}
	}
	/**
     * setParams public function
	 * @uses urlString, function
	 * @param $parametersArray, array
	 * @uses $_curl_result, variable
	 * @uses $_curl_parameters, variable
	 * @desc Parametros a enviar.
	 * @access public
     */
	public function setParams($parametersArray='') 
	{
		if(empty($parametersArray))
		{
			$this->_curl_result = 'error: need parameters';
			return $this->_curl_result;
		}
		else
		{
			$this->_curl_parameters = $this->createQueryString($parametersArray);
		}
	}
	
	/**
     * setSessionId public function
	 * @param $valor, string
	 * @uses $_SessionId, string
	 * @desc: Indica que session_id() usar para aplicar en una session remota.
	 * @access public
     */
	public function setSessionId($valor)
	{
		$this->_SessionId = $valor;
	}
	
	/**
     * setAutenticationUser public function
	 * @param $valor, string
	 * @uses $_curl_autentication_user, array
	 * @desc Indica si va a implementar autenticacion con user y password.
	 * @access public
     */
	public function setAutenticationUser($valor)
	{
		if(!is_array($valor)||!empty($valor)) 
		{
			$this->_curl_result = 'error: valor to autentication';
			return $this->_curl_result;
		}
		else
		{
			$this->_curl_autentication_user = $valor;
		}
	}
	
	/**
     * curl_exec protected function
	 * @param resource $ch a curl handle
	 * @uses curl_exec, function
	 * @desc Ejecutar una transacción curl - esto existe principalmente para las subclases pueden añadir opciones adicionales y / o procesar la respuesta, si lo desean
     * @access protected
	 */
	protected function curl_exec($ch) {
		$result = curl_exec($ch);
		return $result;
	}
	
	/**
     * getRequest public function
	 * @uses $_curl_if_available, variable
	 * @uses $_curl_parameters, variable
	 * @desc Implement curl transaction.
	 * @access public
     */
	public function getRequest() 
	{
		if ($this->_curl_if_available) 
		{
			if(!empty($this->_SessionId))
			{
				session_write_close();
				$this->_curl_parameters = $this->_curl_parameters.'&sid='.$this->_SessionId;
			}
			
			$ch = curl_init();
			
			if(!empty($this->_SessionId))
			{
				//The name of a file to save all internal cookies to when the handle is closed
				curl_setopt($ch, CURLOPT_COOKIEJAR, $this->_SessionId);
    			//The name of the file containing the cookie data.
				curl_setopt($ch, CURLOPT_COOKIEFILE, $this->_SessionId);
				curl_setopt($ch, CURLOPT_VERBOSE, TRUE );
				//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    			//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				//curl_setopt($ch, CURLOPT_COOKIESESSION, true);
			}
			
			if(strpos($this->_curl_url, 'https') === 0)
			{
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			}
						
			//An alternative port number to connect to. 
			//curl_setopt($ch, CURLOPT_PORT, $_SERVER['SERVER_PORT']);
			
			if($this->_curl_method=='POST')
			{
				//Set the url to send data too
				curl_setopt($ch, CURLOPT_URL, $this->_curl_url);
				//A custom request method to use instead
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
				//Do a regular HTTP POST? (yes)
				curl_setopt($ch, CURLOPT_POST, true);
				//The data to post in the HTTP operation
				curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_curl_parameters);
			}
			else
			{
				//Set the url to send data too
				curl_setopt($ch, CURLOPT_URL, $this->_curl_url . '?' . $this->_curl_parameters );
				//A custom request method to use instead
				//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
				//Do a regular HTTP POST? (yes)
				//curl_setopt($ch, CURLOPT_POST, false);
				//The data to post in the HTTP operation
				//curl_setopt($ch, CURLOPT_POSTFIELDS, '');
			}
			//Include header in result? (no)
			curl_setopt($ch, CURLOPT_HEADER, false);
			//Return the transfer as a string - instead of printing it
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//The number of seconds to allow cURL to execute
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
			//The maximum number of seconds to allow cURL to execute
        	//curl_setopt($ch, CURLOPT_TIMEOUT, 60);
			//The "User-Agent" header to be used in a HTTP request
        	//curl_setopt($ch, CURLOPT_USERAGENT, $this->_curl_useragent);
			//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			
			//Don't use a cached version of the url
        	//curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
			
			if(!empty($this->_curl_autentication_user) || is_array($this->_curl_autentication_user))
			{
				curl_setopt($ch, CURLOPT_USERPWD, $this->_curl_autentication_user['username'] . ':' . $this->_curl_autentication_user['password']); 
				curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY ) ; 
			}
			
			$this->_curl_result = curl_exec($ch);
			curl_close($ch);
		}
		else
		{
			$this->_curl_result = 'curl is not habalible';
		}
		return $this->_curl_result;
	}
	/**
     * createQueryString private function
	 * @param $params, array
	 * @uses urlencode(), function
	 * @uses implode(), function
	 * @uses $_curl_autentication_user, array
	 * @desc: Indica si va a implementar autenticacion con user y password.
	 * @access private
     */
	private function createQueryString($params)
	{
		$post_params = array();
		foreach ($params as $key => &$val)
		{
			$post_params[] = $key.'='.urlencode($val);
		}
		return implode('&', $post_params);
	}
	
	public function run_http_post_transaction() 
	{
		if(is_array($this->_url) && is_array($this->_params) && !empty($this->_url) && !empty($this->_params))
		{
			$url_with_get = $this->_url['URL'];
			$url_with_post = $this->create_url_string($this->_params);
			$url_joing = $url_with_get.'?'.$url_with_post;
			$content_type = 'application/x-www-form-urlencoded';
			
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			$content_length = strlen($url_with_post);
			$context =
			array('http' =>
				  array('method' => 'GET',
						'user_agent' => $user_agent,
						'header' => 'Content-Type: ' . $content_type . "\r\n" .
									'Content-Length: ' . $content_length,
						'content' => $url_with_post));
			$context_id = stream_context_create($context);
			$sock = fopen($url_joing, 'r', true, $context_id);
			
			$result = '';
			
			if ($sock) {
				while (!feof($sock)) {
					$result .= fgets($sock, 4096);
				}
				fclose($sock);
			}
			return $result;
		}
	}
	/**
	 * Destructor borra el objeto
	 * @see __destruct()
	 */
	public function __destruct()
	{
		//unset($this);
	}
}
?>