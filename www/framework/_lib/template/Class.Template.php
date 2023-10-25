<?php
/**
 * Templates, It is responsible for incorporating DOM and XPATH content into the XHTML extension templates
 * 
 * The Templates Class Add content and serve the final XHTML.
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.0
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Templates class, 
 * Return: String (HTML)
 * @package {SMVC} Simple Model View Controller
 * @subpackage classes
 */
class Templates{
  /**
   * xpath
   * @access private
   * @var string
   * Note: DOM route
   */
  private $xpath;
  /**
   * xmlt
   * @access private
   * @var object
   * Note: DOM object
   */
  private $xmlt;
  /**
   * _skin_path
   * @access private
   * @var object
   * Note: Path of the skin
   */
  private $_skin_path;
  /**
   * _res
   * @access private
   * @var object
   * Note: Collection / result.
   */
  private $_res;
  /**
   * _template
   * @access private
   * @var string
   * Note: Template to apply.
   */
  private $_template = '_Index.xml';
  /**
   * setSkinPath function
   *
   * @return string
   * Note: Set the skin directory to apply
   */
  public function setSkinPath($skin_path='Default'){
    $this->_skin_path = $skin_path;
  }
  /**
   * setTemplate function
   *
   * @return string
   * Note:Set the template to apply
   */
  public function setTemplate($value){
    $this->_template = $value;
  }
  /**
   * setIni function
   *
   * @uses $this->xmlt, Object
   * @uses DOMDocument, Class
   * @uses load(), Method of DOMDocument
   * @uses xinclude(), Method of DOMDocument
   * @uses validate(), Method of DOMDocument
   * @uses DOMXPath, Class
   * Note: Instance DOMDocument y DOMXPath
   */
  public function setIni(){
    # instantiate DOMDocument
    $this->xmlt = new DOMDocument();
    # we load the XHTML
    $this->xmlt->load( utf8_encode( $this->_skin_path . $this->_template ) );
    # We make the inclusions
    $this->xmlt->xinclude( );
    # We validate the document
    // $xmlt->validate( );
    # instantiated DOMXPath
    $this->xpath = new DOMXPath( $this->xmlt );
  }
  /**
   * setData function
   *
   * @uses $this->xpath, Object
   * @uses DOMDocument, Class
   * @uses DOMXPath, Class
   * @uses query(), Method of DOMXPath
   * @uses item(), Method of DOMXPath
   * @uses htmlspecialchars(), Convert special characters to HTML entities
   * Note: Add content to the collection
   */
  public function setData($path, $indice=0, $data){
    if( !empty($path) && !empty($data) ){
      # We indicate the DOM path where we will locate the content, for example "/html/head/title"
      $this->_res = $this->xpath->query( $path, $this->xmlt );
      $this->_res->item($indice)->nodeValue = htmlspecialchars($data);
    }
  }
  /**
   * addChild function
   *
   * @uses $this->xmlt, Object
   * @uses getElementsByTagName(), Searches for all elements with given local tag name
   * @uses createElement(), Create new element node
   * @uses setAttribute(), Adds new attribute
   * @uses appendChild(), Adds new child at the end of the children
   * Note: Create a new element with your code inside and incorporate it as a child
   */
  public function addChild($reference_tag, $position, $element, $code, $attribute='',$attribute_value=''){
    $reference = $this->xmlt->getElementsByTagName($reference_tag)->item($position);
    $node = $this->xmlt->createElement($element,$code);
    
    if(!empty($attribute)&&!empty($attribute_value)){
      $node->setAttribute($attribute,$attribute_value);
    }
    
    $newnode = $reference->appendChild($node);
  }
  /**
   * addFile function
   *
   * @uses $this->xmlt, Object
   * @uses getElementsByTagName(), Searches for all elements with given local tag name
   * @uses createElement(), Create new element node
   * @uses setAttribute(), Adds new attribute
   * @uses appendChild(), Adds new child at the end of the children
   * Note: Incorporates as the last child of a node, an element with attributes
   */
  public function addFile($reference_tag, $position, $element, $attributes){
    $reference = $this->xmlt->getElementsByTagName($reference_tag)->item($position);
    $node = $this->xmlt->createElement($element);
    
    if(!empty($attributes) && is_array($attributes)){
      foreach($attributes as $key=> $value){
        $node->setAttribute($key,$value);
      }
    }
    
    $newnode = $reference->appendChild($node);
  }
  /**
   * setChangeAttribute function
   *
   * @uses $this->xpath, Object
   * @uses evaluate(), Evaluates the given XPath expression and returns a typed result if possible 
   * @uses removeAttribute(), Removes attribute
   * @uses setAttribute(), Adds new attribute
   * Note: Search and change the values of the attributes of a tag
   */
  public function setChangeAttribute($reference_tag, $delete_attributes, $new_attributes){
    $reference = $this->xpath->evaluate($reference_tag);
    
    if(!empty($delete_attributes) && is_array($delete_attributes)){
      foreach($delete_attributes as $attribut){
        $reference->item(0)->removeAttribute($attribut);
      }
    }
    if(!empty($new_attributes)&&!empty($new_attributes)){
      foreach($new_attributes as $key=> $value){
        $reference->item(0)->setAttribute($key,$value);
      }
    }
  }
  /**
   * getTemplate function
   *
   * @uses $this->xmlt, Object
   * @uses html_entity_decode(), Convert all HTML entities to their applicable characters
   * @uses saveHTML(), Method of DOMDocument
   * Note: Returns the modified content
   */
  public function getTemplate(){
    return html_entity_decode($this->xmlt->saveHTML());
  }
  /**
   * __destruct public function
   * Note: Clears the object when it is no longer used
   * @see __destruct()
   */
  public function __destruct(){
    //unset($this);
  }
}

?>