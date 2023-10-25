<?php
/**
 * TriggerInjection, Trata lo que se injecta a la Database
 * 
 * TriggerInjection trata todos los querys que son aplicados a la Database.
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * TriggerInjection class,
 * @package {SMVC} Simple Model View Controller
 * @subpackage database
 * 
 * @example:
 * $t = new TriggerInjection();
 * $t->setTriggerInjection(false, $var, true, true, true);
 */
class TriggerInjection
{	
	private $_path;
	private $_data;
	private $_autommatic;
	private $_use;
	private $_reset;
	private $_variables;
	private $_conn;
	/**
     * setTriggerInjection public function
	 * @uses $path, String
	 * @uses $data, String
	 * @uses $autommatic, Boolean
	 * @uses $reset, Boolean
	 * @uses $vars, Boolean
	 * @uses $conn, Object
	 */
	public function setTriggerInjection($path=false, $data=false, $use=false, $reset=false, $variables=false)
	{
		$this->_path 			= $path;
		$this->_data 			= $data;
		$this->_use 			= $use;
		$this->_reset 			= $reset;
		$this->_variables 		= $variables;
		
		$this->getTriggerInjection();
	}
	/**
	 * function getTriggerInjection
	 * Se encarga de generar un log fisico con todas las consultas injectadas a la Database
	 * @uses $autommatic, Boolean, Determina si genera el log automaticamente o va a recibir los valores
	 * @uses CONFIG_TRIGGER_INJECTION_FILE, 	anotherconstant
	 * @uses CONFIG_TRIGGER_INJECTION_PATH, 	anotherconstant
	 * @uses CONFIG_TIME, 						anotherconstant
	 * @uses CONFIG_DATE, 						anotherconstant
	 */
	public function getTriggerInjection()
	{
		/**
		 * @internal Comprueba si se va a usar el trigger
		 */
		if ( $this->_use==true )
		{
			/**
			 * @internal Abrir archivo de texto y introducir los datos borrando todo o no
			 */
			$path = ($this->_path==false) ? dirname(__FILE__).'/trigger_sql.xml' : $this->_path;
			/**
			 * @internal Comprueba si existe si crea de nuevo el file
			 */
			if($this->_reset==true && file_exists($path))
			{
				@unlink($path);
			}
			
			/**
			 * @internal Interaciones que recojen la informacion de $_SESSION, $_GET, $_POST, $_COOKIE
			 */
			$trigger_in_session =  "";
			$trigger_in_get =  "";
			$trigger_in_post =  "";
			$trigger_in_cookie =  "";
			$trigger_datos_request = "";
			
			if ( $this->_variables==true )
			{
				if(isset($_SESSION))
				{
					foreach($_SESSION as $ses_var=> $ses_val)
					{
						if(is_array($ses_val))
						{
							if(isset($ses_val))
							{
								foreach($ses_val as $ses_var1=>$ses_val1)
								{
									$trigger_in_session .=  "array[".$ses_var1."] = ".$ses_val1."\r\n";
								}
							}
						}
						else
						{
							$trigger_in_session .= "_SESSION[".$ses_var."] = ".$ses_val."\r\n";
						}
					}
				}
				if(isset($_GET))
				{
					foreach($_GET as $get_var=> $get_val)
					{
						if(is_array($get_val))
						{
							if(isset($get_val))
							{
								foreach($get_val as $get_var1=>$get_val1)
								{
									$trigger_in_get .=  "array[".$get_var1."] = ".$get_val1."\r\n";
								}
							}
						}
						else
						{
							$trigger_in_get .= "_GET[".$get_var."] = ".$get_val."\r\n";
						}
					}
				}
				if(isset($_POST))
				{
					foreach($_POST as $post_var=> $post_val)
					{
						if(is_array($post_val))
						{
							if(isset($post_val))
							{
								foreach($post_val as $post_var1=>$post_val1)
								{
									$trigger_in_post .=  "array[".$post_var1."] = ".$post_val1."\r\n";
								}
							}
						}
						else
						{
							$trigger_in_post .= "_POST[".$post_var."] = ".$post_val."\r\n";
						}
					}
				}
				if(isset($_COOKIE))
				{
					foreach($_COOKIE as $coo_var=> $coo_val)
					{
						if(is_array($coo_val))
						{
							if(isset($coo_val))
							{
								foreach($coo_val as $coo_var1=>$coo_val1)
								{
									$trigger_in_cookie .=  "array[".$coo_var1."] = ".$coo_val1."\r\n";
								}
							}
						}
						else
						{
							$trigger_in_cookie .= "_COOKIE[".$coo_var."] = ".$coo_val."\r\n";
						}
					}
				}
				
				$trigger_datos_request .= '   <s>' . $trigger_in_session . '</s>'. "\r\n";
				$trigger_datos_request .= '   <g>' . $trigger_in_get . '</g>'. "\r\n";
				$trigger_datos_request .= '   <p>' . $trigger_in_post . '</p>'. "\r\n";
				$trigger_datos_request .= '   <c>' . $trigger_in_cookie . '</c>'. "\r\n";
			}
			else
			{
				$trigger_datos_request .= '   <s></s>'. "\r\n";
				$trigger_datos_request .= '   <g></g>'. "\r\n";
				$trigger_datos_request .= '   <p></p>'. "\r\n";
				$trigger_datos_request .= '   <c></c>'. "\r\n";
			}
			
			/**
			 * @internal Comprueba purga o agrega data
			 */
			if ( !file_exists($path) || $this->_reset==true )
			{
				/**
				 * @internal Datos a guardar // SQL injectado
				 */
				$trigger_datos = '<?xml version="1.0" encoding="utf-8"?>'. "\r\n";
				$trigger_datos .= '<objetos>' 				. "\r\n";
				$trigger_datos .= '  <objeto>'. "\r\n";
				$trigger_datos .= '   <fecha>' . date("Y-m-d") . '</fecha>'. "\r\n";
				$trigger_datos .= '   <hora>' . date("H:i:s") . '</hora>'. "\r\n";
				$trigger_datos .= '   <url>' . $_SERVER['PHP_SELF'] . '</url>'. "\r\n";
				
				$trigger_datos .= $trigger_datos_request;
				
				$trigger_datos .= '   <detalle><![CDATA[' . $this->_data . ']]></detalle>'. "\r\n";
				$trigger_datos .= '  </objeto>'. "\r\n";
				$trigger_datos .= '<!--next-->' 				. "\r\n";
				$trigger_datos .= '</objetos>' 				. "\r\n";
			}
			else
			{
				/**
				 * @internal Datos a guardar // SQL injectado
				 */
				$elbody = file_get_contents($path);
				
				$trigger_datos = '  <objeto>'. "\r\n";
				$trigger_datos .= '   <fecha>' . date("Y-m-d") . '</fecha>'. "\r\n";
				$trigger_datos .= '   <hora>' . date("H:i:s") . '</hora>'. "\r\n";
				$trigger_datos .= '   <url>' . $_SERVER['PHP_SELF'] . '</url>'. "\r\n";
				
				$trigger_datos .= $trigger_datos_request;
				
				$trigger_datos .= '   <detalle><![CDATA[' . $this->_data . ']]></detalle>'. "\r\n";
				$trigger_datos .= '  </objeto>'. "\r\n";
				$trigger_datos .= '<!--next-->' 				. "\r\n";
				
				$elbody = str_replace('<!--next-->', $trigger_datos, $elbody);
				$trigger_datos = $elbody;
			}
			
			$trigger_fp = ($this->_reset==false) ? fopen($path,"w") : fopen($path,"a+");
			
			if($trigger_fp != false)
			{
				fwrite($trigger_fp, $trigger_datos);
				fclose($trigger_fp);
			}
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