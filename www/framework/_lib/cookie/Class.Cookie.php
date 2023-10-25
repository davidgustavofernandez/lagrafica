<?php
/**
 * Cookie, Trata las Sessiones
 * 
 * La Calsse Cookie es la encargada de manipular todo las COOKIES
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011 - 13/05/2017)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Cookie class,
 * @package {SMVC} Simple Model View Controller
 * @subpackage database
 * 
 * @example:
 * $c = new Cookie();
 * $c->setKey('datacookie');
 * $c->setId('4578');
 * $c->setExpire(false);
 * $c->setPath('/');
 * $c->setDomain('192.168.5.12');
 * $c->setSecure(false);
 * $e = array('a','b','c');
 * $c->setName('USUARIO');
 * $c->setValue($e);
 * $c->setIni();
 * 
 * //$c->getCookie('USUARIO');
 * or
 * //$c->setDelete();
 *
 * // Usar para obtener el estado de la ultima accion. (opcional)
 * $estado = $this->getState();
 * 
 */
class Cookie extends AbstractCookie
{
   	/**
	 * Configuration values
     * @access private
	 * @var String $_state
	 */
	protected $_state = '';
	/**
	 * Configuration values
     * @access private
	 * @var Boolean $_key
	 */
	protected $_key = false;
	/**
	 * Configuration values
     * @access private
	 * @var String $_expire
	 */
	protected $_expire = 0;
	/**
	 * Configuration values
     * @access private
	 * @var String $_id
	 */
	protected $_id = '';
	/**
	 * Configuration values
     * @access private
	 * @var String $_path
	 */
	protected $_path = '/';
	/**
	 * Configuration values
     * @access private
	 * @var String $_domain
	 */
	protected $_domain = 'localhost';
	/**
	 * Configuration values
     * @access private
	 * @var Boolean $_secure
	 */
	protected $_secure = false;
	/**
	 * Configuration values
     * @access private
	 * @var String $_name
	 */
	protected $_name = '';
	/**
	 * Configuration values
     * @access private
	 * @var String $_value
	 */
	protected $_value = '';
	
	
	/**
     * setState public function
	 * @uses $state, String
	 * notes: Setea _state.
     */
	public function setState($state)
	{
		$this->_state = $state;
	}
	/**
     * setKey public function
	 * @uses $key, String
	 * notes: Setea _key.
     */
	public function setKey($key)
	{
		$this->_key = $key;
	}
	/**
     * setExpire public function
	 * @uses $expire, String
	 * notes: Setea _expire tiempo de expiracion para la cooki.
     */
	public function setExpire($expire)
	{
		$this->_expire = $expire;
	}
	/**
     * setId public function
	 * @uses $id, String
	 * notes: Setea _id.
     */
	public function setId($id)
	{
		$this->_id = $id;
	}
	/**
     * setPath public function
	 * @uses $path, String
	 * notes: Setea _path.
     */
	public function setPath($path)
	{
		$this->_path = $path;
	}
	/**
     * setDomain public function
	 * @uses $domain, String
	 * notes: Setea _domain.
     */
	public function setDomain($domain)
	{
		$this->_domain = $domain;
	}
	/**
     * setSecure public function
	 * @uses $secure, String
	 * notes: Setea _secure.
     */
	public function setSecure($secure)
	{
		$this->_secure = $secure;
	}
	/**
     * setName public function
	 * @uses $name, String
	 * notes: Setea _name.
     */
	public function setName($name)
	{
		$this->_name = $name;
	}
	/**
     * setValue public function
	 * @uses $value, String
	 * notes: Setea _value.
     */
	public function setValue($value)
	{
		$this->_value = $value;
	}
	
	/**
     * getState public function
	 * @uses _state, String
	 * @return $_state
	 * notes: Retorna _state.
     */
	public function getState()
	{
		return $this->_state;
	}
	
	
	/**
     * __construct public function
	 * @uses setExpire, function
	 * @uses setPath, function
	 * @uses setDomain, function
	 * @uses setSecure, function
	 * @see __construct()
	 * @desc Instancia los método para configurar variables por defecto.
	 * @access public
     */
	public function __construct()
	{
		$expire = time() + 60*60*24*30*12;
		$this->setExpire($expire);
		$this->setPath('/');
		$this->setDomain('localhost');
		$this->setSecure(false);
	}
	/**
     * ifExist public function
     * @desc Esta funcion es la encargada de validar si existe la cookie.
	 * @uses $_name, String
	 * @uses $_object, Object
	 * @uses $_id, String
	 * @uses $_COOKIE, array
	 * @notes: Se valida que esten seteadas las variables $_name, $_object. Si $_COOKIE[$this->_id] esta seteada la cookie no esta creada
     */
	public function ifExist() 
    {
    	if($this->_name != '___CRYPT___') 
        {
			if( !isset($this->_object) && !isset($_COOKIE[$this->_id]))
			{
				return false;
			}
			else
			{
				return true;
			}
		}
        else
        {
            $this->setState('INVALID COOKIE NAME. YOU MAY NOT USE "___CRYPT___" AS YOUR COOKIE NAME');
        }
    }
	
	/**
     * setIni public function
     * @desc Esta funcion es la encargada de crear la cookie.
	 * @uses $_name, String
	 * @uses $_object, Object
	 * @uses $_id, String
	 * @uses $_expire, Number
	 * @uses $_path, String
	 * @uses $_domain, String
	 * @uses $_secure, Boolean
	 * @uses $_COOKIE, array
	 * @uses _setObject(), function
	 * @uses setcookie(), function
	 * @uses setState(), function
	 * @notes: La variable $_expire tiene que estar bien formada o no se creara la cookie, $_secure tiene a no ser que la cookie sea leida por HTTPS tiene que ser false.
	 * @notes: Se valida que esten seteadas las variables $_name, $_object. Si $_COOKIE[$this->_id] esta seteada la cookie no se crea de nuevo
     */
    public function setIni() 
    {
    	if($this->_name != '___CRYPT___') 
        {
        	if( !isset($this->_object) && !isset($_COOKIE[$this->_id]))
            {
            	$this->_setObject();
	            setcookie($this->_id,$this->_object,$this->_expire,$this->_path,$this->_domain,$this->_secure);
	            $_COOKIE[$this->_id] = $this->_object;
	            $this->setState('impact init');
            }
        }
        else
        {
            $this->setState('INVALID COOKIE NAME. YOU MAY NOT USE "___CRYPT___" AS YOUR COOKIE NAME');
        }
    }
	/**
     * getCookie public function
     * @desc Retorna los datos de la cookie.
	 * @uses $_name, String
	 * @uses $_COOKIE, array
	 * @uses getObject(), function
	 * @uses getCookieObject(), function
	 * @uses setState(), function
	 * @notes: La variable $_expire tiene que estar bien formada o no se creara la cookie, $_secure tiene a no ser que la cookie sea leida por HTTPS tiene que ser false.
	 * @notes: Se valida $_name. $_COOKIES determina si la cookie ya fue creada si es asi genera el objeto extrayendo los datos de ella con getCookiesObject()
	 */
    public function getCookie() 
    {
        if($this->_name != '___CRYPT___') 
        {
        	if($_COOKIE)
            {
            	$obj = $this->getCookieObject();
            }
            else
            {
        		$obj = $this->getObject();
            }

            if(isset($obj[$this->_name]))
            {
            	$this->setState('impact getCookie');
            	return $obj[$this->_name];
            }
            else
            {
            	$this->setState('No name OBJECT');
            	return null;
            }
        }else{
            $this->setState('INVALID COOKIE NAME. YOU MAY NOT USE "___CRYPT___" AS YOUR COOKIE NAME');
        }
    }
	/**
     * setDelete public function
     * @desc Elimina la cookie y los objetos de ella.
     * @uses $_key, string
	 * @uses $_name, String
	 * @uses $_object, Object
	 * @uses $_id, String
	 * @uses $_expire, Number
	 * @uses $_path, String
	 * @uses $_domain, String
	 * @uses $_secure, Boolean
	 * @uses unset(), function 
	 * @uses serialize(), function
	 * @uses base64_encode(), function
	 * @uses _setCrypt(), function
	 * @uses setState(), function
	 * @notes: Se valida $_name.
	 */
    public function setDelete() 
    {
        unset($_COOKIE[$this->_id]);
		setcookie($this->_id,'',time()-100,$this->_path,$this->_domain,$this->_secure);
		//$_COOKIE[$this->_id]='';
	    $this->setState('impact setDelete');
    }
	/**
     * _setObject public function
     * @desc Genera un objeto con el contenido para la COOKIE.
     * @uses $_key, string
	 * @uses $_name, String
	 * @uses $_object, Object
	 * @uses md5(), function 
	 * @uses serialize(), function
	 * @uses base64_encode(), function
	 * @uses _setCrypt(), function
	 * @notes: Serializamos el objeto, lo encodeamos y lo encriptamos con una llave.
	 */
	public function _setObject()
    {
    	if(!empty($this->_value))
		{
			$obj['___CRYPT___'] 	= md5($this->_key);
			$obj[$this->_name]		= $this->_value;
			$this->_object			= $this->_setCrypt(base64_encode(serialize($obj)),$this->_key);
		}
    }
    /**
     * getObject public function
     * @desc Retorna el objeto dentro de la COOKIE.
     * @uses $_key, string
	 * @uses $_object, Object
	 * @uses unserialize(), function
	 * @uses base64_decode(), function
	 * @uses _setUnCrypt(), function
	 * @notes: Desencriptamos con la llave, desencodeamos y desserializamos el objeto. Siempre usando el objeto creado en memoria.
	 */
    public function getObject()
    {
    	$obj = unserialize(base64_decode($this->_setUnCrypt($this->_object,$this->_key)));
        return $obj;
    }
    /**
     * getCookieObject public function
     * @desc Retorna el objeto dentro de la COOKIE.
     * @uses $_key, string
	 * @uses $_object, Object
	 * @uses unserialize(), function
	 * @uses base64_decode(), function
	 * @uses _setUnCrypt(), function
	 * @notes: Desencriptamos con la llave, desencodeamos y desserializamos el objeto. Usando el objeto dentro de la COOKIE ya existente.
	 */
    public function getCookieObject()
    {
    	$obj = unserialize(base64_decode($this->_setUnCrypt($_COOKIE[$this->_id],$this->_key)));
    	return $obj;
    }
	/**
     * _setCryptDigit public function
     * @desc Encripta el valor pasado asociado a una key.
     * @uses $valor, Sting
     * @uses $key, String
	 * @uses md5(), function
	 * @uses substr(), function
	 * @note: Eleva a $valor[n] a la potencia de $key[n] secuencialmente por el largo de $valor.
	 */
	public function _setCryptDigit($valor, $key)
	{
		$randNumber = md5($key);
		$c = 0;
		$return = "";
		for($i=0;$i<strlen($valor);$i++) 
		{
			if($c==strlen($randNumber))
			{
				$c=0;
			}
			$return.= substr($valor,$i,1) ^ substr($randNumber,$c,1);
			$c++;
		}
		return $return;
	}
	/**
     * _setCrypt public function
     * @desc Encripta el valor pasado asociado a una key.
     * @uses $valor, Sting
     * @uses $key, String
     * @uses urlencode(), function
	 * @uses md5(), function
	 * @uses substr(), function
	 * @uses base64_encode(), function
	 * @uses str_replace(), function
	 * @uses _setCryptDigit(), function
	 * @see _setCryptDigit(), function
	 * @return String
	 * @note: Aplica urlencode() a $valor, eleva a $randNumber[n].$valor[n] a la potencia de $randNumber[n] secuencialmente por el largo de $valor. Aplica base64_encode() y str_replace() si $valor es un array() o entra en recursividad.
	 */
	public function _setCrypt($valor, $key)
	{
		if(!is_array($valor))
		{
			$valor = urlencode($valor);
			$randNumber = md5(rand(0,32000));
			$c = 0;
			$return = "";
			for ($i=0;$i<strlen($valor);$i++)
			{
				if ($c==strlen($randNumber))
				{ 
					$c=0;
				}
				$return.= substr($randNumber,$c,1).(substr($valor,$i,1) ^ substr($randNumber,$c,1));
				$c++;
			}
			$return = base64_encode($this->_setCryptDigit($return, $key));
			$return = str_replace('+','AbCdE',$return);
			return $return;
		}
		else
		{
			$return = array();
			foreach($valor as $x=>$y)
			{
				$return[$x] = $this->_setCrypt($y, $key);
			}
			return $return;
		}
	}
	/**
     * setUnCrypt public function
     * @desc Encripta el valor pasado asociado a una key.
     * @uses $valor, Sting
     * @uses $key, String
     * @uses urldecode(), function
	 * @uses md5(), function
	 * @uses substr(), function
	 * @uses base64_decode(), function
	 * @uses str_replace(), function
	 * @uses _setCryptDigit(), function
	 * @see _setCrypt(), function
	 * @see _setCryptDigit(), function
	 * @return String
	 * @note: Operatoria inversa a _setCrypt().
	 */
	public function _setUnCrypt($valor,$key)
	{
		if(!is_array($valor))
		{
			$valor = str_replace('AbCdE','+',$valor);
			$valor = $this->_setCryptDigit(base64_decode($valor), $key);
			$return = "";
			for ($i=0;$i<strlen($valor);$i++)
			{
				$md5 = substr($valor,$i,1);
				$i++;
				$return.= (substr($valor,$i,1) ^ $md5);
			}
			return urldecode($return);
		}
		else
		{
			$return = array();
			foreach($valor as $x=>$y)
			{
				$return[$x] = $this->_setUnCrypt($y, $key);
			}
			return $return;
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