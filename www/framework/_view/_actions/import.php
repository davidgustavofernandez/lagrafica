<?php
/* View: import
 * Action: Get data from a .csv file
 * Return: array() return
 * Comment: Get the records of an excel to insert them in a table
 */
require_once( dirname(__FILE__) . '/../../_lib/import/Class.Import.php' );

$excel = new Import();
$excel->descargable = true;
$excel->nombrearchivo = '../material/'.$this->_controller.'/reports/'.$this->_controller.'_'.date("Ymd").'_'.date("His"). ".xls";
$excel->ExelIni();
$listado = '';
$paginador = '';
$arrayTitulos = array();

if( is_array($resultExport) ){
    $cantidadRecords = count($resultExport);
    
    foreach($this->_fields_show_fild as $campo){
        array_push($arrayTitulos, utf8_decode($campo['name']));
    }
    # Creamos los nombres de los campos
    $excel->newTr($arrayTitulos);
    $color = 1;
    $indice_interno = 1;

    foreach($resultExport as $record){
        $arrayConten = array();
        foreach($this->_fields_show_fild as $fields){
            if($fields['field']=='password'){
                array_push($arrayConten, '••••••••');
            } else {
                array_push($arrayConten, utf8_decode($record->{$fields['field']}));
            }
        }
        $excel->newTr($arrayConten);
    }
}else{
    array_push($arrayConten, 'No hay registros');
    $excel->newTr($arrayConten);
}
$excel->ExelFin();
$html_main = 'aguarde...';
?>