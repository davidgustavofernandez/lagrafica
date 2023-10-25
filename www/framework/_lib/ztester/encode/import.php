<?php
require_once( dirname(__FILE__) . '/../../../_common/Class.Config.php');
$_c = new Configuration();
require_once( dirname(__FILE__) . '/../../handler/Class.Error.Handler.php');
$_e = new ErrorHandler();
require_once( dirname(__FILE__) . '/../../propagate/Class.Propagate.php');
$_p = new Propagate();
$_p->setFilter(true);
$_metodo = 'request';

// Test Encoding
$encode = $_p->spread($_metodo,"encode",'');
$str = $_p->spread($_metodo,"str",'');

require_once( dirname(__FILE__) . '/../../import/Class.Import.php');
$nombrearchivo = "maps.csv";
$import = new Import();
$import->setFile($nombrearchivo);
$import->setDelimiter(",");
$import->setEncode($encode);
$import->setHasHeader(true);
// $datos = $import->importInit();
$datos = $import->importInit();

print_r($datos);

?>
