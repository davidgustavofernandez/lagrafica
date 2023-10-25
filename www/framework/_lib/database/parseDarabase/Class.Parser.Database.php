<?php
class ParserDatabase
{
	private $_file;
	private $_xpath;
	private $_xml;
	
	public function setFile($file='')
	{
		$this->_file = $file;
	}
	
	public function setIni()
	{
		$this->_xml = new DOMDocument(); // Cargamos el objeto DOM
		$this->_xml->load( $this->_file ); // Cargamos el XML
	}
	
	public function getDatabase()
	{
		$this->domToSimpleArray($this->_xml);
	}
	
	public function domToSimpleArray($domnode, &$array) 
	{
		$array_ptr = &$array;
		$domnode = $domnode->firstChild;
		
		while (!is_null($domnode)) 
		{
			if (! (trim($domnode->nodeValue) == "") )
			{
				switch ($domnode->nodeType)
				{
					case XML_TEXT_NODE: 
					{
						$array_ptr['cdata'] = $domnode->nodeValue;
						break;
					}
					case XML_ELEMENT_NODE: 
					{
						$array_ptr = &$array[$domnode->nodeName][];
						
						if ($domnode->hasAttributes() ) 
						{
							$attributes = $domnode->attributes;
							if (!is_array ($attributes)) 
							{
								break;
							}
							
							foreach ($attributes as $index => $domobj) 
							{
								$array_ptr[$index] = $array_ptr[$domobj->name] = $domobj->value;
							}
						}
						break;
					}
				}
				if ( $domnode->hasChildNodes() ) 
				{
					$this->domToSimpleArray($domnode, $array_ptr);
				}
			}
			$domnode = $domnode->nextSibling;
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