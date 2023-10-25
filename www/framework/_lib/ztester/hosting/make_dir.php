<?php
$directorys = array(
	"./wp-snapshots",
	"./wp-snapshots/tmp",
);

// Para crear directorios
foreach($directorys as $directory){
	if(!is_dir($directory)){
		if(mkdir($directory, 0777)){
			echo 'Directorio: "'.$directory.'" creado con éxito. <br>';
		}else{
			echo 'No se pudo crear el directorio: "'.$directory.'". <br>';
		}
	}
}

// Para crear archivos
// foreach($directorys as $directory){
// 	if(!is_dir($directory)){
// 		if(touch($directory)){
// 			echo 'Directorio: "'.$directory.'" creado con éxito. <br>';
// 		}else{
// 			echo 'No se pudo crear el directorio: "'.$directory.'". <br>';
// 		}
// 	}
// }

// foreach($directorys as $directory){
// 	if(is_dir($directory)){
// 		if(chmod($directory, 777)){
// 			echo 'Se aplicaron permisos 777 al directorio: "'.$directory.'.<br>';
// 		}else{
// 			echo 'No se pudo asignar permisos al directorio: "'.$directory.'". <br>';
// 		}
// 	}
// }
?>