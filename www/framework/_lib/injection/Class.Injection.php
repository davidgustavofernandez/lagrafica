<?php
/**
 * Injection, Trata los posibles mal usos de manipulacion de datos
 * 
 * La Calsse Injection es la encargada de tratar, filtrar lo recibido.
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Injection class,
 * @package {SMVC} Simple Model View Controller
 * @subpackage framework
 */
class Injection
{	
	/**
	 * Configuration private variable values, 
	 * 
     * Configuration values
	 * @access private
     * @var boolean
     */
	private $_filter = false;
	
	/**
     * Constructor sets up
	 * @see __construct()
     */
	public function __construct()
	{
		$this->setFilter(false);
	}

	/**
     * Set if the filter is going to applied
     *
     * @param  boolean  $filter
     */
    public function setFilter($filter=true)
    {
		$this->_filter 	= $filter==true ? true : false;
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
		if($this->_filter === true)
		{
			$no_admite = array(
							   /*'"',*/
							   "'",
							   /*"&",*/
							   "--",
							   "select",
							   "insert",
							   "update",
							   "delete",
							   "drop",
							   "%",
							   ";",
							   /*"=",*/
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
							   //"/",
							   "(",
							   ")",
							   "*"
							   );
			
			foreach( $no_admite as $no_admite_str )
			{
				$chain = str_replace($no_admite_str,"", $this->escapeString($chain));
				$chain = str_replace(strtoupper($no_admite_str),"", $this->escapeString($chain));
			}
		}
		
		return (string) $this->escapeString($chain);
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
		$connex = new mysqli(CONFIG_DB_HOST, CONFIG_DB_USER, CONFIG_DB_PASS, CONFIG_DB_NAME, CONFIG_DB_PORT) or trigger_error($connex->error($connex),E_USER_ERROR);
		$retorno = $connex->real_escape_string($chain);
		$connex->close();
		return $retorno;
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