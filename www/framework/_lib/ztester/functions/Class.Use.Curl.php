<?php
/**
 * UseCurl, Genera consultas utilizando CURL
 * 
 * La Calsse UseCurl retorna el contenido de uan URL.
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.0
 * @package {SMVC} Simple Model View Controller
 */
/**
 * UseCurl class, 
 * Retorno: String or Json
 */
class UseCurl
{
	private $_curl_url;
	private $_curl_if_available = false;
	private $_curl_result;
	private $_curl_useragent;
	private $_curl_method;
	
	/**
	 * Constructor sets up
	 * @see __construct()
	 */
	public function __construct()
	{
		$this->setUseragent();
		$this->setMethod();
		$this->setCurlAvailable();
	}
	
	public function setUseragent($useragent='') 
	{
		if(empty($useragent))
		{
			$this->_curl_useragent = 'Facebook API PHP5 Client 1.1 (curl) ' . phpversion();
		}
		else
		{
			$this->_curl_useragent = $useragent;
		}
	}
	
	public function setMethod($method='POST') 
	{
		$this->_curl_method = $method;
	}
	
	public function setCurlAvailable() 
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
	
	public function setUrl($url='') 
	{
		if(empty($url))
		{
			$this->_curl_result = 'error: need url string';
			return $this->_curl_result;
		}
		else
		{
			$this->_curl_url = $url;
		}
	}
	
	public function setPostString($postString='') 
	{
		if(empty($postString))
		{
			$this->_curl_result = 'error: need string to post';
			return $this->_curl_result;
		}
		else
		{
			$this->_curl_post_string = $postString;
		}
	}
	
	/**
	* execute a curl transaction -- this exists mostly so subclasses can add
	* extra options and/or process the response, if they wish.
	*
	* @param resource $ch a curl handle
	*/
	protected function curl_exec($ch) {
		$result = curl_exec($ch);
		return $result;
	}
  
	public function do_request() 
	{
		if ($this->_curl_if_available) 
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->_curl_url);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_curl_post_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERAGENT, $this->_curl_useragent);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			// $this->_curl_result = $this->curl_exec($ch);

			if(curl_errno($ch) || curl_error($ch))
	        {
	        	$errno = curl_errno($ch);
	        	$error_message = curl_strerror($errno);
	            return 'Curl errors - ERRNO: '.curl_errno($ch).' | ERROR: '.curl_error($ch).' | MSN:'.$error_message;
	        }
	        else
	        {
	            return $this->curl_exec($ch);
	        }

			curl_close($ch);
		}
		else
		{
			return 'curl is not habalible';
		}
		
	}
	/*
	public function post_request($method, $params) 
	{
		list($get, $post) = $this->finalize_params($method, $params);
		$post_string = $this->create_url_string($post);
		$get_string = $this->create_url_string($get);
		$url_with_get = $this->server_addr . '?' . $get_string;
		
		if ($this->use_curl_if_available && function_exists('curl_init')) {
			$useragent = 'Facebook API PHP5 Client 1.1 (curl) ' . phpversion();
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url_with_get);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			$result = $this->curl_exec($ch);
			curl_close($ch);
		} else {
			$content_type = 'application/x-www-form-urlencoded';
			$content = $post_string;
			$result = $this->run_http_post_transaction($content_type,
			$content,
			$url_with_get);
		}
		
		return $result;
	}
	
	/*
	
	
	$submit_url = "https://sitename/process.php";
	
	$curl = curl_init();
	
	//curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC ) ;
	//curl_setopt($curl, CURLOPT_USERPWD, "username:password");
	//curl_setopt($curl, CURLOPT_SSLVERSION,3);
	//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
	//curl_setopt($curl, CURLOPT_HEADER, true);
	//curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_URL, $_c_url);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $params );
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
	
	$data = split("text/html", curl_exec($curl) );
	$temp = split("\r\n", $data[1]) ;
	
	$result = unserialize( $temp[2] ) ;
	
	print_r($result);
	curl_close($curl); */
}
?>