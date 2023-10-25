<?php
/**
 * PostRequest, Trata todos los consumos de servicios 
 * 
 * La Calsse PostRequest es la encargada de consumir los servicios WEB.
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Injection class,
 * @package {SMVC} Simple Model View Controller
 * @subpackage framework
 */
class PostRequest
{
	private $_url		= array();
	private $_params	= array();
	
	public function setUrl($url)
	{
		$this->_url = $url;
	}
	public function setParams($params)
	{
		$this->_params = $params;
	}
	
	public function post_request() 
	{
		if(is_array($this->_url) && is_array($this->_params) && !empty($this->_url) && !empty($this->_params) && function_exists('curl_init'))
		{
			$url_with_get = $this->_url['URL'];
			$url_with_post = $this->create_url_string($this->_params);
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_PORT, $_SERVER['SERVER_PORT']);
			curl_setopt($ch, CURLOPT_URL, $url_with_get.'?'.$url_with_post);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $url_with_post);
			$result = curl_exec($ch);
			curl_close($ch);
			/*
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->_curl_url);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_curl_post_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERAGENT, $this->_curl_useragent);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			$this->_curl_result = $this->curl_exec($ch);
			curl_close($ch);
			*/
		}
		else 
		{
			//$result = $this->run_http_post_transaction();
			if(function_exists('curl_init'))
			{
				$sin = array('error');
				$result = base64_encode(serialize($sin));//Error uno de los campos  o no existe
			}
			else
			{
				$sin = array('error No esta coinfigurado CURL');
				$result = base64_encode(serialize($sin));//Error uno de los campos  o no existe
			}
		}
		return $result;
	}
	
	private function create_url_string($params)
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