<?php
/* View: export
 * Action: Create XLS with the records
 * Return: .xls return
 * Comment: Generate to download a .xls with the records in the table
 */
require_once( dirname(__FILE__) . '/../../_lib/export/Class.Export.php' );

$excel = new Export();
$excel->descargable = true;
$excel->nombrearchivo = '../material/'.$this->_controller.'/reports/'.$this->_controller.'_'.date("Ymd").'_'.date("His"). ".xls";
$excel->ExelIni();
$listado = '';
$paginador = '';
$arrayTitulos = array();

if( is_array($resultExport) ){
    $cantidadRecords = count($resultExport);
    
    foreach($this->_fields_show_fild as $campo){
        // array_push($arrayTitulos, utf8_decode($campo['name']));field
        array_push($arrayTitulos, utf8_decode($campo['field']));
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
                array_push($arrayConten, $this->_f->clean_string(utf8_decode($record->{$fields['field']})));
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