<?php 
/**
 * EXPORT v1.0 Genera XLS dinamicamente.
 * 
 * No borre esta información 15-07-2009 - Bs. A.s Argentina
 * EXPORT v1.0 es un producto desarrollado por:
 * David Gustavo Fernández.
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.0
 * @package {SMVC} Simple Model View Controller
 */
class Export	
{
	/**
	* fp, Puntero que obtenemos al crear el archivo
	* @var string
	*/
 	public $fp;
	/**
	* descargable, Variable que condiciona si genera la descarga o no de archivo 
	* @var boolean
	*/
	public $descargable = false;
	/**
	* nombrearchivo, Path mas nombre del archivo a crear 
	* @var string
	*/
	public $nombrearchivo = "";
	/**
	* shtml, Variable que contendra el contenido del archivo
	* @var string
	*/
	private $_shtml = "";
	
	/**
	* ExelIni, function, Inicia la table de contenidos
	* @shtml, {@link $shtml}
	* @return none
	*/
	public function ExelIni()
	{
		$this->_shtml.="<table>";
	}
	
	/**
	* newTr, function, Concatena los nuevos contenidos insertando nueva fila en formato html, Parsea los contenidos del array pasado como parametro
	* @shtml, {@link $shtml} Variable a concatenar
	* @param string $value Array de contenidos
	* @return none
	*/
	public function newTr($value)
	{
		$this->_shtml.= "<tr>";
		for ($i = 0; $i < count($value) ;$i++)//LOOP DEL ARRAY
		{
			$this->_shtml.= "<td>".$value[$i]."</td>";
		}
		$this->_shtml.= "</tr>";
			
	}
	
	/**
	* ExelDescarga, function, Genera descarga del archivo pasado como parametro {@link $nombrearchivo}
	* @param string $archivo Path mas nombre del archivo
	* @return file
	*/
	private function ExelDescarga($archivo)// HEADERS
	{ 
		$filename = basename($archivo);
		$filesize = filesize($archivo);
		
		$USR_BROWSER_AGENT="";
		if (preg_match('@Opera(/| )([0-9].[0-9]{1,2})@', $_SERVER['HTTP_USER_AGENT'])) $USR_BROWSER_AGENT='OPERA';
		if (preg_match('@MSIE ([0-9].[0-9]{1,2})@', $_SERVER['HTTP_USER_AGENT'])) $USR_BROWSER_AGENT='IE';
		$mime_type = ($USR_BROWSER_AGENT == 'IE' || $USR_BROWSER_AGENT == 'OPERA')
		? 'application/octetstream'
		: 'application/octet-stream';
		
		if ($USR_BROWSER_AGENT == 'IE') 
		{
			header('Pragma: public');
		} 
		else
		{
			header('Pragma: no-cache');
		}
		
		header('Content-Length: ' . $filesize);
		header('Content-Transfer-Encoding: binary');
		header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Content-Type: ' . $mime_type);

		header("Content-Type: application/download");
		//header("Content-Type: application/xls");
		header("Content-Type: application/vnd.ms-excel; name='excel'"); 
		//header("Content-type: application/csv");
        header("Content-Type: application/force-download"); 
        //header("Content-Type: application/vnd.ms-excel"); 
		
		@readfile ($archivo);
		exit();
	}
	
	/**
	* ExelFin, function, Cierra la table de contenidos. Genera archivo fisico con los contenidos. 
	* @shtml, {@link $shtml}
	* @ExelDescarga, function, Genera descarga {@link ExelDescarga}
	* @return none
	*/
	public function ExelFin()
	{
		$this->_shtml.="</table>";
		$retorno = pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0).$this->xlsWriteLabel(0,0,$this->_shtml).pack("ss", 0x0A, 0x00);
		
		$this->fp=@fopen($this->nombrearchivo,"w+");
		fwrite($this->fp,$retorno);
		fclose($this->fp);
		
		if($this->descargable==true){
			$this->ExelDescarga($this->nombrearchivo);
		}
	}
	public function ExelExporta($contenido)
	{
		if(!empty($contenido))
		{				
			$this->fp=@fopen($this->nombrearchivo,"w+");
			fwrite($this->fp,$contenido);
			fclose($this->fp);
			
			if($this->descargable==true){
				$this->ExelDescarga($this->nombrearchivo);
			}
		}
	}
	public function xlsWriteLabel($Row, $Col, $Value ) {
		$L = strlen($Value);
		return pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L).$Value;
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