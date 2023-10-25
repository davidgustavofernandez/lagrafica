<?php

require_once('Class.Read.Database.Dump.php');
$structura_bbdd = new ReadDatabaseDump();
$structura_bbdd->setController('data.inc','gm_cars');
$structura_bbdd_datos = $structura_bbdd->getControllerEstructure();
print_r($structura_bbdd_datos);


?>