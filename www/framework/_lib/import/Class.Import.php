<?php 
/**
 * IMPORT v1.0 Generates array from a .CSV
 * 
 * Do not delete this information 10-06-2019 - Bs. A.s argentina
 * EXPORT v1.0 is a product developed by:
 * David Gustavo Fernández.
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.0
 * @package {SMVC} Simple Model View Controller
 */
class Import	
{
	/**
	* file, Path of origin File .csv
	* @var string
	*/
 	private $_file;
 	/**
	* delimiter, Delimiter to generate array
	* @var string
	*/
 	private $_delimiter = ",";
 	/**
	* collection, Array with the final content
	* @var string
	*/
	private $_collection = array();

	/**
	* has_header, indicates if file has header with titles such as NAME, DETAIL, etc.
	* @var string
	*/
	private $_has_header = false;

	/**
	* encode, indicates the type of encode that must be passed to UTF8
	* @var string
	*/
	private $_encode = "Windows-1252";
	
	/**
	 * Constructor sets up
	 * @see __construct()
	 */
	public function __construct(){

	}

	public function setEncode($encode)
	{
		$this->_encode = $encode;
	}

	public function setFile($file)
	{
		$this->_file = $file;
	}

	public function setDelimiter($delimiter)
	{
		$this->_delimiter = $delimiter;
	}

	public function setHasHeader($has_header)
	{
		$this->_has_header = $has_header;
	}
	
	public function convert( $str ) {
		// $return = '';

		// $encoding = mb_detect_encoding($str, mb_detect_order(), false);
		// // echo $encoding;
		// if($encoding == "UTF-8")
		// {
		// 	// $str = mb_convert_encoding($str, 'UTF-8', 'UTF-8');
		// 	$return = iconv( 'UTF-8', "UTF-8", $str );
		// 	// echo $return . '==UTF-8';
		// }
		// elseif($encoding == "ASCII")
		// {
		// 	$return = iconv( 'ASCII', "UTF-8", $str );
		// 	echo '|'.$return . '=>ASCII>='.$str.'|';
		// 	// $str = mb_convert_encoding($str, 'ASCII', 'UTF-8');
		// }
		// else{
		// 	echo $encoding;
		// }
		// return $return;

		// $out = iconv(mb_detect_encoding($str, mb_detect_order(), false), "UTF-8//IGNORE", $str);
		// // print_r($out);
		// return $out;
	    // return iconv( $this->_encode, "UTF-8", $str );
		if(iconv( "UTF-8", "UTF-8", $str )){
			return iconv( "UTF-8", "UTF-8", $str );
		}else{
			// echo mb_detect_encoding($str, mb_detect_order(), false);
			return iconv( "ASCII", "UTF-8", $str );
		}
	}
	/**
	* importInit, function, Inicia la table de contenidos
	* @shtml, {@link $shtml}
	* @return none
	*/
	public function importInit()
	{
		if (($fp = fopen("{$this->_file}", "r")) !== FALSE) 
		{
		  $count = 0;
		  while (($data = fgetcsv($fp, 50000, $this->_delimiter)) !== FALSE) 
		  {
		    if($count!=0 && $this->_has_header===false)
		    {
		    	$this->_collection[] = array_map( array($this, 'convert'), $data );
		    }
		    else
		    {
		    	$this->_collection[] = array_map( array($this, 'convert'), $data );
		    }
		    $count = $count +1;	
		  }
		  fclose($fp);
		}
		else
		{
			return arry('error');
		}
		return $this->_collection;
	}
	
	/**
	 * Destructor borra el objeto
	 * @see __destruct()
	 */
	public function __destruct(){}
	
}

?>