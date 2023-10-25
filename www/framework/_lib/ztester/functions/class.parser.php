<?php 
##################################################################################################
## TOMO DATOS usando CURL
##################################################################################################
###########################################################################
## Codigo de Muestra
###########################################################################
/*$oopParser = new oopParser();
$oopParser->genera = true;
$oopParser->formato = '.html';
$oopParser->path = 'search';
$oopParser->archivo = 'salida.html';
$oopParser->depuro_directorio = true;
$oopParser->periodo = 'yesterday'; //now
$oopParser->separador_inicial = '<STRING>';
$oopParser->separador_final = '</STRING>';
$oopParser->curl_activo = false;
$oopParser->curl_tipo = 'http';
$oopParser->curl_metodo = 'GET';
$oopParser->curl_url = 'http://www.laurl.com/pagina.asp';
$oopParser->curl_parametros;
$oopParser->outputExepciones = array ("0");
$retorno = $oopParser->Generador();*/

class oopParser
{
	#---------------------------------------------------------------------------------------------
	# $genera determina si va a crear un .html con el resultado servido
	#---------------------------------------------------------------------------------------------
	public $genera = true;
	
	#---------------------------------------------------------------------------------------------
	# $formato formato de salida del documento.
	#---------------------------------------------------------------------------------------------
	public $formato = '.html';
	
	#---------------------------------------------------------------------------------------------
	# $path es el directorio sobre el cual se va a trabajar. 
	# En este directorio se generara un archivo .html con el resulrado fianl obtenido por CURL
	#---------------------------------------------------------------------------------------------
	public $path;
	
	#---------------------------------------------------------------------------------------------
	# $archivo es el nombre de salida del archivo
	#---------------------------------------------------------------------------------------------
	public $archivo;
	
	#---------------------------------------------------------------------------------------------
	# $depuro_directorio en true borra los contenidos del directorio teniendo en cuenta el periodo.
	#---------------------------------------------------------------------------------------------	
	public $depuro_directorio = true;
	
	#---------------------------------------------------------------------------------------------
	# $periodo periodo en que se borraran los archivos que se generaron
	#---------------------------------------------------------------------------------------------	
	public $periodo = 'yesterday';
	
	#---------------------------------------------------------------------------------------------
	# $separador_inicial Parameto inicial para el parseador.
	#---------------------------------------------------------------------------------------------
	public $separador_inicial;
	
	#---------------------------------------------------------------------------------------------
	# $separador_final Parameto final para el parseador.
	#---------------------------------------------------------------------------------------------
	public $separador_final;
	
	#---------------------------------------------------------------------------------------------
	# $curl_activo determina si se va a usar CURL par generar el .html
	#---------------------------------------------------------------------------------------------
	public $curl_activo = true;
	
	#---------------------------------------------------------------------------------------------
	# $curl_tipo metodo que usara CURL par generar el .html
	#---------------------------------------------------------------------------------------------
	public $curl_tipo = "http";
	
	#---------------------------------------------------------------------------------------------
	# $curl_metodo metodo que usara CURL par generar el .html
	#---------------------------------------------------------------------------------------------
	public $curl_metodo = "GET";
	
	#---------------------------------------------------------------------------------------------
	# $curl_url url a tratar
	#---------------------------------------------------------------------------------------------
	public $curl_url;
	
	#---------------------------------------------------------------------------------------------
	# $curl_parametros parametros pasados a curl para hacer la cnsulta.
	#---------------------------------------------------------------------------------------------
	public $curl_parametros;
	
	#---------------------------------------------------------------------------------------------
	# $outputExepciones Escapa posiciones dentro del array fianl
	#---------------------------------------------------------------------------------------------
	public $outputExepciones  = array();
	
	#---------------------------------------------------------------------------------------------
	# $outputArray Salida resultante
	#---------------------------------------------------------------------------------------------
	private $outputArray  = array();
	
	function __construct()
	{
		#---------------------------------------------------------------------------------------------
		# Rutina pregunta si va a depurar el directodio
		#---------------------------------------------------------------------------------------------
		/*if( $this->depuro_directorio == true )
		{
			if( file_exists( $this->path."/".$this->archivo ) && is_dir( $this->path."/" ) && ( filemtime($this->path."/".$this->archivo) ) < ( strtotime($this->periodo) ) ) 
			{
				$directorio = 'cookies';
				$dirOpen = opendir($directorio) or trigger_error("directorio no creado",E_USER_ERROR);
				
				while ( $file = readdir($dirOpen) )
				{
					echo $directorio.'<br>';
					if ( ( eregi($this->formato, $file) ) && ( filemtime($this->path."/".$file) ) < ( strtotime($this->periodo) ) )
					{
						$del=@unlink($this->path."/".$file);
						//echo $this->path."/".$file;
						
					}
				}
			}
			/*
			$directorio = 'cookies';
			$dp = opendir($directorio) or trigger_error("directorio no creado",E_USER_ERROR);
	
			while ($file = readdir($dp)){
				if ((eregi('.html',$file)) && (filemtime($directorio."/".$file)) < (strtotime('now'))){
					$del=@unlink($directorio."/".$file);
				};
			};*/

		//};
		
	}//
	
	function Generador()
	{
		##################################################################################################
		## Rutina pregunta si va a depurar el directodio | OK
		##################################################################################################
		if( $this->depuro_directorio == true )
		{
			if( file_exists( $this->path."/".$this->archivo ) && is_dir( $this->path."/" ) && ( filemtime($this->path."/".$this->archivo) ) < ( strtotime($this->periodo) ) ) 
			{

				$dirOpen = opendir($this->path) or trigger_error("directorio no creado",E_USER_ERROR);
				
				while ( $file = readdir($dirOpen) )
				{
					echo $file.'<br>';
					if ( ( eregi($this->formato, $file) ) && ( filemtime($this->path."/".$file) ) < ( strtotime($this->periodo) ) )
					{
						$del=@unlink($this->path."/".$file);
						//echo $this->path."/".$file;
					}
				}
			}
		};
		
		##################################################################################################
		## PREGUNTO si usa curl, si el archivo existe y si la fecha en se creo es mayor a un dia si es mayor 
		## Prosesamos el nuevo contenido del HTML generado por CURL determinando metodo y cabecera
		##################################################################################################
		if($this->curl_activo == true)
		{
			if( !file_exists( $this->path . "/" . $this->archivo ) || is_dir( $this->path . "/" ) && ((filemtime($this->path . "/" . $this->archivo)) < (strtotime($this->periodo))) ) 
			{
				//echo $this->path . "/" . $this->archivo.'<br>';
				//echo filemtime($this->path . "/" . $this->archivo).'<br>';
				//echo strtotime($this->periodo).'<br>';
				
				if( $this->curl_tipo == 'https' )
				{
					$curl = curl_init();
					$fp = fopen ($this->path . "/" . $this->archivo, "w");
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
					curl_setopt($curl, CURLOPT_HEADER, 0);
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
					curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
					curl_setopt($curl, CURLOPT_COOKIEFILE, "cookiefile");
					curl_setopt($curl, CURLOPT_COOKIEJAR, "cookiefile");
					curl_setopt($curl, CURLOPT_URL, $this->curl_url.$this->curl_parametros); # this is where you first time connect - GET method authorization in my case, if you have POST - need to edit code a bit
					curl_setopt($curl, CURLOPT_FILE, $fp);
					curl_exec($curl);
					curl_close ($curl);
					fclose($fp); //Cierro puntero
				}
				else
				{
					if($this->curl_metodo == 'GET')
					{
						$curl = curl_init($this->curl_url);
						$fp = fopen ($this->path . "/" . $this->archivo, "w");
						//curl_setopt ($curl, CURLOPT_POST, 1);
						//curl_setopt ($curl, CURLOPT_POSTFIELDS, $this->curl_parametros);
						curl_setopt ($curl, CURLOPT_FILE, $fp);
						curl_setopt ($curl, CURLOPT_HEADER, 0);
						curl_exec ($curl);
						curl_close ($curl);
						fclose ($fp);
					}
					else
					{
						$curl = curl_init($this->curl_url);
						$fp = fopen ($this->path . "/" . $this->archivo, "w");
						curl_setopt ($curl, CURLOPT_POST, 1);
						curl_setopt ($curl, CURLOPT_POSTFIELDS, $this->curl_parametros);
						curl_setopt ($curl, CURLOPT_FILE, $fp);
						curl_setopt ($curl, CURLOPT_HEADER, 0);
						curl_exec ($curl);
						curl_close ($curl);
						fclose ($fp);
					};
				};
			}
		};
		##################################################################################################
		
		##################################################################################################
		## Prosesamos el contenido del HTML generado por CURL
		##################################################################################################
		if( file_exists( $this->path . "/" . $this->archivo ) ) 
		{
			$body = file_get_contents($this->path . "/" . $this->archivo); //Recupero el contenido del archivo
	
			$miarray = split($this->separador_inicial, $body); //Genero array
			$cant_elem = count($miarray); //cantidad de elemento del array inicial
				
			for ($i=0; $i < $cant_elem; $i++)
			{
				//if($i>=1 and $i<=5) // Rango a tratar dentro del array 
				//{
					$nuevoArray = split($this->separador_final, $miarray[$i]); // Array temporal nuevo
					$countElements = strlen($nuevoArray[0]); //CANTIDAD de elementos temporal
	
					if( trim( substr($miarray[$i],0,$countElements) )  != "" and !in_array( $i, $this->outputExepciones ) )
					{
						$this->outputArray[] = trim(substr($miarray[$i],0,$countElements)); //Trato y cargo en array final
					};
				//}
				next($miarray);
			};
			
			return $this->outputArray;
			
		};
		##################################################################################################
	}
	
}

?>