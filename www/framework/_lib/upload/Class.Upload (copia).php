<?php 
/**
 * Upload, Trata los uploads
 * 
 * Upload trata todos los files que se envian al servidor en el caso que se le indique los trata (optimizando o haciendo copias a escala).
 * @author David Fernandez <fernandezdg@gmail.com>
 * @version 1.01 (10/05/2010 - 02/03/2011)
 * @package {SMVC} Simple Model View Controller
 */
/**
 * Upload class,
 * @package {SMVC} Simple Model View Controller
 * @subpackage Upload
 */
class Upload extends AppAbstractConnectInstance
{
	private $_table;
	private $_fields;
	private $_key;
	private $_pry_key;
	
	private $_files;
	private $_posteos;
	private $_folderDestino;
	private $_extPermitidas;
	
	private $_files_names;
	private $_posteos_names;
	private $_message = '';
	private $_fileName = '';
	
	public function setTable($table)
	{
		$this->_table = $table;
	}
	public function setFields($fields)
	{
		$this->_fields = $fields;
	}
	public function setKey($key='')
	{
		$this->_key = $key;	
	}
	public function setPryKey($pry_key='')
	{
		$this->_pry_key = $pry_key;	
	}
	public function setFiles($files)
	{
		$this->_files = $files;	
	}
	public function setPosteos($posteos)
	{
		$this->_posteos = $posteos;	
	}
	public function setFolderDestino($folderDestino)
	{
		$this->_folderDestino = $folderDestino;	
	}
	public function setExtPermitidas($extPermitidas)
	{
		$this->_extPermitidas = $extPermitidas;	
	}
	public function getFileName()
	{
		return $this->_fileName;	
	}
	
	public function setUpload() //INSTANCIAMOS oopConn
	{
	}
	
	public function getUpload() //TRATAMIENTO DE UPLOADS 
	{
		$this->_files_names = array_keys($this->_files); //recupero todas las keys de file
		$this->_posteos_names = array_keys($this->_posteos); //recupero todas las keys del post
		
		for ($i = 0; $i < sizeof($this->_files) ;$i++)
		{
			if (!empty($this->_files[$this->_files_names[$i]]['name']) and $this->_files[$this->_files_names[$i]]['size'] > 0)
			{ 
				for ($j = 0; $j < sizeof($this->_posteos_names) ;$j++) //loop de las keys del post
				{
					if($this->_posteos_names[$j]==$this->_files_names[$i].'_resize_limit')
					{
						$resize=(isset($this->_posteos[$this->_posteos_names[$j]]))?$this->_posteos[$this->_posteos_names[$j]]:"0:0:0:0";	
					};
				}
			    $fileName = $this->getUploadFile($this->_files[$this->_files_names[$i]],$resize,$this->_folderDestino[$i],$this->_files_names[$i]);				
			}
			else
			{
				$this->_message = $this->_message.'|sin archivos';
			}
		
		}
		
		$this->_message = $this->_message.'|fin de upload';
		return $this->_message;
	}

	public function getUploadDelete()//BORRA TODOS LOS ARCHIVOS QUE SON PASADOS COMO PARAMETRO SIE EL PARAMETRO TIENE EL PREFIJO "delete_" LO TRATAMOS SINO, NADA
	{
		$this->_posteos_names = array_keys($this->_posteos); //recupero todas las keys del post
		
		for ($i = 0; $i < sizeof($this->_posteos_names) ;$i++) //loop de las keys post post
		{
			
			if( (substr($this->_posteos_names[$i], 0, 7)=="delete_") and ($this->_posteos[$this->_posteos_names[$i]]!='') and !empty($this->_posteos_names[$i]) and !empty($this->_posteos[$this->_posteos_names[$i]]))//para eliminar tiene la keys que vienen por post tiene que tener "delete_" como prefijo mas el nombre del archivo a eliminar
			{
				/*
				echo $this->_posteos_names[$i];
				echo '<br>';
				echo $this->_posteos[$this->_posteos_names[$i]];
				exit();
				*/
				for ($j = 0; $j < sizeof($this->_folderDestino) ;$j++)//loop de los flders donde se guardaron 
				{
					if( file_exists($this->_folderDestino[$j].'big/'.$this->_posteos[$this->_posteos_names[$i]]) && !empty($this->_posteos[$this->_posteos_names[$i]]) )
					{
						@unlink($this->_folderDestino[$j].'big/'.$this->_posteos[$this->_posteos_names[$i]]);
					}
					if( file_exists($this->_folderDestino[$j].'small/'.$this->_posteos[$this->_posteos_names[$i]]) && !empty($this->_posteos[$this->_posteos_names[$i]]) )
					{
						@unlink($this->_folderDestino[$j].'small/'.$this->_posteos[$this->_posteos_names[$i]]);
					}
					if( file_exists($this->_folderDestino[$j].'thumb/'.$this->_posteos[$this->_posteos_names[$i]]) && !empty($this->_posteos[$this->_posteos_names[$i]]) )
					{
						@unlink($this->_folderDestino[$j].'thumb/'.$this->_posteos[$this->_posteos_names[$i]]);
					}
					if( file_exists($this->_folderDestino[$j].'media/'.$this->_posteos[$this->_posteos_names[$i]]) && !empty($this->_posteos[$this->_posteos_names[$i]]) )
					{
						@unlink($this->_folderDestino[$j].'media/'.$this->_posteos[$this->_posteos_names[$i]]);
					}
					
					$nombreCampo = str_replace("delete_","",$this->_posteos_names[$i]);
					
					###TRATAR
					$cl = new QueryMethods();
					$cl->setConn($this->_conn);
					$cl->injectionInsert("update ".$this->_table." set $nombreCampo = '' where ".$this->_pry_key." = '".$this->_key."'");//reseteo campo

					$this->_message = $this->_message.'|archivo eliminado';
				}
			}
		}
	}
	
	public function getUploadFile($file,$resizeLimit,$folderDestino,$campo)//SUBE ARCHIVO Y RESIZEA SI EXISTE EL CAMPO OCULTO {$VAR}_resize_limit
	{
		$for_name = date("dmY_His", time())."_".rand(10000000, 20000000); // GENERO NOMBRE PARA LA IMAGEN FINAL
		$extencion = explode(".", $file['name']);
		$extArchivo = '.'.strtolower($extencion[1]);
		
		$new_filename = $for_name.$extArchivo; 
		$new_filename_jpg = $for_name.".jpg";
		
		move_uploaded_file($file['tmp_name'] , $folderDestino.$new_filename);//ANTES QUE NADA COPIO ARCHIVO A CARPETA $folderDestino PARA RE UTILIZARLO
	   	chmod($folderDestino.$new_filename, 0777);
		//chgrp($folderDestino.$new_filename, 'root');
		//chown($folderDestino.$new_filename, 'root');
		
		if($resizeLimit!='0:0:0:0')
		{
			$limit = explode(':', $resizeLimit);
		}
		
		$generaThumb 	= $limit[0]!='0' ? true : false;
		$generaSmall 	= $limit[1]!='0' ? true : false;
		$generaBig 		= $limit[2]!='0' ? true : false;
		$cargaDirecta 	= $limit[3]!='0' ? true : false;
		
		//APLICO RESIZE Y GENERO LAS IMAGENES EN CARPETAS 'BIG' 'SMALL' 'THUMB'
		if( (in_array($extArchivo, $this->_extPermitidas)) and ($resizeLimit!="") and (($extArchivo == '.jpg') || ($extArchivo == '.jpeg') || ($extArchivo == '.gif') || ($extArchivo == '.png')) and ($resizeLimit!='0:0:0:0') )//UPLOAD// EVALUO SI ES FORMATO PERMITIDO, IMAGEN y SI $resizeLimit!='0:0', SI NO EVALUO SI ES FORMATO PERMITIDO, O NADA
		{ 
			$im_info = getimagesize($folderDestino.$new_filename);
				
			switch($im_info[2])
			{
				case 1:
					$imagen = @imagecreatefromgif($folderDestino.$new_filename) or die('en la carga');
				break;
					case 2:
					$imagen = @imagecreatefromjpeg($folderDestino.$new_filename) or die('en la carga');
				break;
					case 3:
					$imagen = @imagecreatefrompng($folderDestino.$new_filename) or die('en la carga');
				break;
			}
				
			if(($imagen===false) || (!$imagen))
			{
				$this->_message = $this->_message.' | error en la carga';
				//exit();
			}

			if($generaThumb	==true){ $thumb_max 	= $limit[0]; } // small
			if($generaSmall	==true){ $small_max 	= $limit[1]; } // small
			if($generaBig	==true){ $big_max 		= $limit[2]; } // big
			
			if($im_info[0]>$im_info[1]) 
			{
				if($generaThumb==true)
				{ 
					$thumb_w = $thumb_max;
					$thumb_h = ($im_info[1]/$im_info[0])*$thumb_max;
				}
				if($generaSmall==true)
				{ 
					$small_w = $small_max;
					$small_h = ($im_info[1]/$im_info[0])*$small_max;
				}
				if($generaBig==true)
				{ 				
					$big_w = $big_max;
					$big_h = ($im_info[1]/$im_info[0])*$big_max;
				}			
			} 
			else 
			{
				if($generaThumb==true)
				{ 
					$thumb_w = ($im_info[0]/$im_info[1])*$thumb_max;
					$thumb_h = $thumb_max;
				}
				if($generaSmall==true)
				{ 
					$small_w = ($im_info[0]/$im_info[1])*$small_max;
					$small_h = $small_max;
				}
				if($generaBig==true)
				{ 
					$big_w = ($im_info[0]/$im_info[1])*$big_max;
					$big_h = $big_max;
				}			
			}
			
			if($generaThumb==true)
			{ 
				$thumb = imagecreatetruecolor($thumb_w,$thumb_h); 
				if($extArchivo == '.png')
				{
					imagealphablending($thumb, false);
				}
				imagecopyresampled($thumb,$imagen,0,0,0,0, $thumb_w,$thumb_h,imagesx($imagen),imagesy($imagen));
			};
			
			if($generaSmall==true)
			{ 
				$small = imagecreatetruecolor($small_w,$small_h); 
				if($extArchivo == '.png')
				{
					imagealphablending($small, false);
				}
				imagecopyresampled($small,$imagen,0,0,0,0, $small_w,$small_h,imagesx($imagen),imagesy($imagen));
			};
			
			if($generaBig==true)
			{ 
				$big = imagecreatetruecolor($big_w,$big_h); 
				if($extArchivo == '.png')
				{
					imagealphablending($big, false);
				}
				imagecopyresampled($big,$imagen,0,0,0,0, $big_w,$big_h,imagesx($imagen),imagesy($imagen));
			};
			
			imagedestroy($imagen);
			
			if($generaThumb==true)
			{ 
				if($extArchivo == '.jpg' or $extArchivo == '.jpeg')
				{
					imagejpeg($thumb, $folderDestino.'thumb/'.$for_name.$extArchivo,100); 
				}
				else if($extArchivo == '.png')
				{
					imagesavealpha($thumb, true);
					imagepng($thumb, $folderDestino.'thumb/'.$for_name.$extArchivo,0,NULL); 
				}
				else if($extArchivo == '.gif')
				{
					imagegif($thumb, $folderDestino.'thumb/'.$for_name.$extArchivo,100); 
				}
				else
				{
					imagejpeg($thumb, $folderDestino.'thumb/'.$new_filename_jpg,100); 
				}
				
				chmod($folderDestino.'thumb/'.$for_name.$extArchivo, 0777);
				//chgrp($folderDestino.'thumb/'.$for_name.$extArchivo, 'root');
				//chown($folderDestino.'thumb/'.$for_name.$extArchivo, 'root');
			};
			
			if($generaSmall==true)
			{ 
				if($extArchivo == '.jpg' or $extArchivo == '.jpeg')
				{
					imagejpeg($small, $folderDestino.'small/'.$for_name.$extArchivo,100); 
				}
				else if($extArchivo == '.png')
				{
					imagesavealpha($small, true);
					imagepng($small, $folderDestino.'small/'.$for_name.$extArchivo,0,NULL); 
				}
				else if($extArchivo == '.gif')
				{
					imagegif($small, $folderDestino.'small/'.$for_name.$extArchivo,100); 
				}
				else
				{
					imagejpeg($small, $folderDestino.'small/'.$new_filename_jpg,100); 
				}
				
				chmod($folderDestino.'small/'.$for_name.$extArchivo, 0777);
				//chgrp($folderDestino.'small/'.$for_name.$extArchivo, 'root');
				//chown($folderDestino.'small/'.$for_name.$extArchivo, 'root');
			};
			if($generaBig==true)
			{ 
				if($extArchivo == '.jpg' or $extArchivo == '.jpeg')
				{
					imagejpeg($big, $folderDestino.'big/'.$for_name.$extArchivo,100);
				}
				else if($extArchivo == '.png')
				{
					imagesavealpha($big, true);
					imagepng($big, $folderDestino.'big/'.$for_name.$extArchivo,0,NULL);
				}
				else if($extArchivo == '.gif')
				{
					imagegif($big, $folderDestino.'big/'.$for_name.$extArchivo,100);
				}
				else
				{
					imagejpeg($big, $folderDestino.'big/'.$for_name.$extArchivo,100);
				}
				
				chmod($folderDestino.'big/'.$for_name.$extArchivo, 0777);
				//chgrp($folderDestino.'big/'.$for_name.$extArchivo, 'root');
				//chown($folderDestino.'big/'.$for_name.$extArchivo, 'root');
			};
			
			if($generaThumb	==true){ imagedestroy($thumb); };
			if($generaSmall	==true){ imagedestroy($small); };
			if($generaBig	==true){ imagedestroy($big); };
			
			###TRATAR
			/*
			echo "update ".$this->_table." set $campo = '".$for_name.$extArchivo."' where ".$this->_pry_key." = '".$this->_key."'";
			exit();
			*/
			
			$cl = new QueryMethods();
			$cl->setConn($this->_conn);
			$cl->injectionInsert("update ".$this->_table." set $campo = '".$for_name.$extArchivo."' where ".$this->_pry_key." = '".$this->_key."'");//reseteo campo
			
			$this->_message = $this->_message.'|cargado'.$for_name.$extArchivo;
			$this->_fileName = $for_name.$extArchivo;
		}
		else
		{
			$this->_message = $this->_message.'|formato no valido.';
			$this->_fileName = '';
		}//FIN DE UPLOAD IMAGENES
		
		if( (in_array($extArchivo, $this->_extPermitidas)) and ($cargaDirecta==true) )//upload de archivos 
		{
			copy($folderDestino.$new_filename , $folderDestino.'media/'.$new_filename);
	   		chmod($folderDestino.'media/'.$new_filename, 0777);
			//chgrp($folderDestino.'media/'.$new_filename, 'root');
			//chown($folderDestino.'media/'.$new_filename, 'root');

			###TRATAR
			$cl = new QueryMethods();
			$cl->setConn($this->_conn);
			$cl->injectionInsert("update ".$this->_table." set $campo = '".$new_filename."' where ".$this->_pry_key." = '".$this->_key."'");//reseteo campo
			
			$this->_message = $this->_message.'|cargado|'.$new_filename;
			$this->_fileName = $new_filename;
		}
		else
		{
			$this->_message = $this->_message.'|formato no valido';
			$this->_fileName = '';
		}//FIN DE UPLOAD ARCHIVO
		
		if(file_exists($folderDestino.$new_filename)==true)//BORRO IMAGEN ORIGINAL
		{
			@unlink($folderDestino.$new_filename);
		}

	}//FIN UploadFile()
	/**
	 * Destructor borra el objeto
	 * @see __destruct()
	 */
	public function __destruct()
	{
		//unset($this);
	}
	
}//FIN oopUpload 

?>