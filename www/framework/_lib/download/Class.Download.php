<?php
/**
 * Download v1.0 Fuerza descarga de archivos.
 * 
 * No borre esta información 15-07-2009 - Bs. A.s Argentina
 * EXPORT v1.0 es un producto desarrollado por:
 * David Gustavo Fernández.
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.0
 * @package {SMVC} Simple Model View Controller
 */
class Download
{
	/**
	 * _file Nombre del archivo original
	 *
	 * @access private
	 * @var string
	 */
	private $_file;
	
	/**
	 * _filePath Path del archivo
	 *
	 * @access private
	 * @var string
	 */
	private $_filePath;
	private $_filePathRelated;
	
	/**
	 * _browserType Tipo de Browser
	 *
	 * @access private
	 * @var string
	 */
	private $_browserType;
	
	/**
	 * _mimeType Tipo Mime
	 *
	 * @access private
	 * @var string
	 */
	private $_mimeType;
	
	/**
	 * _downloadName Nombre del archivo de descarga
	 *
	 * @access private
	 * @var string
	 */
	private $_downloadName;
	
	private $_extPermitidas = array();
	private $_pathsPermitidos = array();
	
	/**
	 * Constructor
	 * @see __construct()
	 */
	public function __construct()
	{
		
	}
	/*public function __construct($file, $mimeType = '', $downloadName = '')
	{
		if(!file_exists($file))
		{
			return;
		}
		
		$this->_file = $file;
		$this->_mimeType = $mimeType;

		if($downloadName != '')
			$this->_downloadName = $downloadName;
		else
			$this->_downloadName = $file;
	}*/
	
	/**
	 * setFile function
	 * 
	 * Note: Setea el archivo
	 * @return string
	 */
	public function setFile($file)
	{
		$this->_file = $file;
	}
	
	/**
	 * setFilePath function
	 * 
	 * Note: Setea el path del archivo
	 * @return string
	 */
	public function setFilePath($filePath)
	{
		$this->_filePath = $filePath;
	}
	/**
	 * setFilePath function
	 * 
	 * Note: Setea el path del archivo
	 * @return string
	 */
	public function setFilePathRelated($filePathRelated)
	{
		$this->_filePathRelated = $filePathRelated;
	}
	/**
	 * setMimeType function
	 * 
	 * Note: Setea el tipo mime del archivo
	 * @return string
	 */
	public function setMimeType()
	{
		$this->_mimeType = ($this->_browserType == 'Internet Explorer' || $this->_browserType == 'opera') ? 'application/octetstream' : 'application/octet-stream';
	}
	
	/**
	 * setBrowserType function
	 * 
	 * Note: Setea el tipo de browser que solicita la descarga
	 * @return string
	 */
	public function setBrowserType($browserType)
	{
		$this->_browserType = $browserType;
	}
	
	/**
	 * setDownloadName function
	 * 
	 * Note: Setea el nombre del archivo
	 * @return string
	 */
	public function setDownloadName($downloadName)
	{
		$this->_downloadName = $downloadName;
	}
	
	public function setExtPermitidas($extPermitidas)
	{
		$this->_extPermitidas = $extPermitidas;	
	}
	
	public function setPathsPermitidos($setPathsPermitidos)
	{
		$this->_pathsPermitidos = $setPathsPermitidos;	
	}
	/**
	 * download function
	 * 
	 * Note: Funcion que genera la descarga
	 * @return file
	 */
	public function download()
	{
		$extencion = explode(".", $this->_file);
		if(count($extencion)>2)
		{
			return 'formato no valido.';
			exit();
		};
		
		$extArchivo = '.'.strtolower($extencion[1]);
		
		if( (in_array($extArchivo, $this->_extPermitidas)) )
		{
			if( (in_array($this->_filePath, $this->_pathsPermitidos)) )
			{
				if(!file_exists($this->_filePathRelated.$this->_filePath.$this->_file))
				{
					return;
				}
				if(!empty($this->_downloadName))
				{
					$this->_downloadName = $this->_file;
				}
		
				header('Content-Type: ' . $this->_mimeType);
				header('Content-Length: ' . filesize($this->_filePathRelated.$this->_filePath.$this->_file));
				header('Content-Transfer-Encoding: binary');
				header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
				
				if ($this->_browserType == 'Internet Explorer') 
				{
					header('Content-Disposition: attachment; filename="' . $this->_downloadName . '"');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
				} 
				else
				{
					header('Content-Disposition: attachment; filename="' . $this->_downloadName . '"');
					header('Pragma: no-cache');
				}
				
				readfile($this->_filePathRelated.$this->_filePath.$this->_file);
			}
			else
			{
				return 'formato no valido...';
				exit();
			}
		}
		else
		{
			return 'formato no valido..';
			exit();
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