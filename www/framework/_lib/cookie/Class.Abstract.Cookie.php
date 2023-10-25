<?php
/**
 * AbstractCookie, abstract class
 * 
 * Abstract Class
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Cookie Abstract Class, 
 * @package {SMVC} Simple Model View Controller
 * @subpackage database
 */
abstract class AbstractCookie
{
	/**
	 * Configuration protected variable values
	 */
	/**
     * String de estado de los procesos
     * @access private
     * @var string _state
     */
	protected $_state;
	/**
     * String que se utilizara como llave
     * @access protected
     * @var string _key
     */
    protected $_key;
    /**
     * Number que determinará la vide del cookie
     * @access protected
     * @var string _expire
     */
    protected $_expire;
    /**
     * String que sera en nombre de la cookie
     * @access protected
     * @var string _id
     */
    protected $_id;
    /**
     * String de destino de la cookie
     * @access protected
     * @var string _path
     */
    protected $_path;
    /**
     * String del dominio al cual pertenece la cookie
     * @access protected
     * @var string _domain
     */
    protected $_domain;
    /**
     * Boolean determina si se accede a la cookie de forma segura
     * @access protected
     * @var boolean _secure
     */
    protected $_secure;
    /**
     * Object seran los datos a insertar en la cookie
     * @access protected
     * @var object _object
     */
    protected $_object;
    /**
     * String nombre del objeto
     * @access protected
     * @var string _name
     */
    protected $_name;
    /**
     * El contenido del objeto soporta cualquier tipo de dato
     * @access protected
     * @var string _value
     */
    private $_value;
	/**
     * setState abstract public function
	 * @uses $state, String
	 * notes: Setea _state.
     */
	abstract public function setState($state);
	/**
     * getState abstract public function
	 * @uses _state, String
	 * @return $_state
	 * notes: Retorna _state.
     */
	abstract public function getState();
	/**
     * setKey abstract public function
	 * @uses $key, String
	 * notes: Setea _key.
     */
	abstract public function setKey($key);
	/**
     * setExpire abstract public function
	 * @uses $expire, String
	 * notes: Setea _expire tiempo de expiracion para la cooki.
     */
	abstract public function setExpire($expire);
	/**
     * setId abstract public function
	 * @uses $id, String
	 * notes: Setea _id.
     */
	abstract public function setId($id);
	/**
     * setPath abstract public function
	 * @uses $path, String
	 * notes: Setea _path.
     */
	abstract public function setPath($path);
	/**
     * setDomain abstract public function
	 * @uses $domain, String
	 * notes: Setea _domain.
     */
	abstract public function setDomain($domain);
	/**
     * setSecure abstract public function
	 * @uses $secure, String
	 * notes: Setea _secure.
     */
	abstract public function setSecure($secure);
	/**
     * setName abstract public function
	 * @uses $name, String
	 * notes: Setea _name.
     */
	abstract public function setName($name);
	/**
     * setValue abstract public function
	 * @uses $value, String
	 * notes: Setea _value.
     */
	abstract public function setValue($value);
    
	/**
     * ifExist abstract public function
	 * @see ifExist()
     */
	abstract public function ifExist();
	/**
     * setIni abstract public function
	 * @see setIni()
     */
	abstract public function setIni();
	/**
     * getCookie abstract public function
	 * @see getCookie()
     */
	abstract public function getCookie();
	/**
     * setDelete abstract public function
	 * @see setDelete()
     */
	abstract public function setDelete();
	/**
     * setObject abstract public function
	 * @see setObject()
     */
	abstract public function _setObject();
	/**
     * getObject abstract public function
	 * @see getObject()
     */
	abstract public function getObject();
	/**
     * getCookieObject abstract public function
	 * @see getCookieObject()
     */
	abstract public function getCookieObject();
	/**
     * setCryptDigit abstract public function
     * @uses $valor, Sting
     * @uses $key, String
	 * @see setCryptDigit()
     */
	abstract public function _setCryptDigit($valor, $key);
	/**
     * setCrypt abstract public function
     * @uses $valor, Sting
     * @uses $key, String
	 * @see setCrypt()
     */
	abstract public function _setCrypt($valor, $key);
	/**
     * setUnCrypt abstract public function
     * @uses $valor, Sting
     * @uses $key, String
	 * @see setUnCrypt()
     */
	abstract public function _setUnCrypt($valor,$key);
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