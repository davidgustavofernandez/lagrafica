<?php
/**
 * Ip, Obtiene la Ip del usuario
 * 
 * Functions que retorna la IP del usuario
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Config class,
 * @subpackage Libreria
 */
class Ip
{
	/**
	 * Configuration values
     * @access private
	 * @var number $_ip
	 */
	private $_ip = '';
	/**
     * getIp function
	 * @uses strcasecmp(), Function
	 * @uses $_SERVER, Function
	 * @uses isset(), Function
	 * Note: Retorna la IP del usuario
	 */
	function getIp()
	{
		if( isset($_SERVER['HTTP_CLIENT_IP']) && strcasecmp(isset($_SERVER['HTTP_CLIENT_IP']),"0.0.0.0") )
		{
		    $this->_ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif( isset($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp(isset($_SERVER['HTTP_X_FORWARDED_FOR']),"0.0.0.0"))
		{
		    $this->_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			$this->_ip = '';
		}
				
		return $this->_ip;
	}
	
	function getIpRemoteAddr()
	{
		if(isset($_SERVER['REMOTE_ADDR']) && strcasecmp(isset($_SERVER['REMOTE_ADDR']),"0.0.0.0"))
		{
			$this->_ip = $_SERVER['REMOTE_ADDR'];
		}
		else
		{
			$this->_ip = '';
		}
				
		return $this->_ip;
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