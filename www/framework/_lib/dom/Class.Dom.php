<?php
/**
 * Dom, Trata XHTML
 * 
 * Dispone las funcionalidades basicas para trabajar con XPATH y DOM
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 * @version 1.0
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Dom class,
 * @package {SMVC} Simple Model View Controller
 * @subpackage dom
 * 
 * @example:
 * $d = new Dom();
 * $d->setFile($documento_a_tratar);
 * $d->setIni();
 * # reemplazamos contenido
 * $d->setConten('/html/head/title', 0, 'Titulo Cambiado');
 * #obtenemos contenido
 * $contenido = $d->getConten('/html/body/div/div/div/div/div', 0);
 * # reemplazamos contenido
 * $d->setConten('/html/body/div/div/div/div', 4, $contenido);
 * $salida = $d->getTemplate();
 * echo $salida
 */
class Dom
{
	/**
     * Instancia de DOMXPath
     * @access private
     * @var Object
     */
	private $_xpath;
	/**
     * Instancia de DOMDocument
     * @access private
     * @var Object
     */
	private $_xmlt;
	/**
     * Conten Metod _xpath->query
     * @access private
     * @var Colection
     */
	private $_res;
	/**
     * Configuration values
     * @access private
     * @var string
     */
	private $_file = '';
	
	/**
     * setFile public function
	 * @uses $file, String
	 * @access public
	 * @note Recibe como parametro la URL del file a tratar
	 */
	public function setFile($file)
	{
		$this->_file = $file;
	}
	/**
     * setIni public function
	 * @uses DOMDocument, Class
	 * @uses DOMXPath, Class
	 * @access public
	 * @note Instancia DOMDocument, DOMXPath implementa los metodos load(), xinclude(), dispone en memoria el contenido del documento.
	 */
	public function setIni()
	{
		# Seteamos variable con instancia de DOMDocument
		$this->_xmlt = new DOMDocument(); 
		
		if(!empty($this->_file) )
		{
			# Seteamos Metodo load con el file a tratar
			# IMPORTANTE el documento tiene que ser XHTML
			$this->_xmlt->load($this->_file);
			# Incluimos el contenido
			$this->_xmlt->xinclude(); 
			# Comentado: Validamos el documento validacion extricta
			// $_xmlt->validate();
			# Seteamos variable con instancia de XPath
			$this->_xpath = new DOMXPath( $this->_xmlt );
		}
		else
		{
			return 'Error: Falta URL';
		}
	}
	/**
     * setConten public function
	 * @uses $var, String
	 * @access public
	 * @note Remplaza contenido tomando en cuanta la estructura de "tags", indice y su contenido
	 */
	public function setConten($chain_tags, $indice, $var)
	{
		# Configura el puntero en el lugar que queremos 
		# ejemplos: "/html/head/title", "/html/body/div/div/div/div"
		$this->_res = $this->_xpath->query($chain_tags, $this->_xmlt ); 
		# Modificamos el contenidos segun su indice ya que pueden existr dos objetos en la misma altura Ejemplo: 0
		$this->_res->item($indice)->nodeValue = $var; 
	}
	/**
     * getConten public function
	 * @uses $var, String
	 * @access public
	 * @note Obtiene contenido tomando en cuanta la estructura de "tags" y indice
	 */
	public function getConten($chain_tags, $indice)
	{
		# Configura el puntero en el lugar que queremos 
		# ejemplos: "/html/head/title", "/html/body/div/div/div/div"
		$this->_res = $this->_xpath->query($chain_tags, $this->_xmlt ); 
		#Retorna el contenidos segun su indice ya que pueden existr dos objetos en la misma altura Ejemplo: 0
		return $this->_res->item($indice)->nodeValue; 
	}
	/**
     * getTemplate public function
	 * @access public
	 * @note Retorna el contenido tratado
	 */
	public function getTemplate()
	{
		// Imprimimos el contenido
		return html_entity_decode($this->_xmlt->saveHTML ()); 
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