<?php
/* View: export
 * Action: Create XLS with the records
 * Return: .xls return
 * Comment: Generate to download a .xls with the records in the table
 */
require_once( dirname(__FILE__) . '/../../_lib/export/Class.Export.php' );

if( is_array($resultExport) ){

    $indice_interno = 1;
    $multiplo = 1000;

    foreach($resultExport as $record){
        
        if($indice_interno==1 || $indice_interno%$multiplo==0){
            $excel = new Export();
            $excel->descargable = true;
            $excel->nombrearchivo = '../material/'.$this->_controller.'/reports/'.$this->_controller.'_'.date("Ymd").'_'.date("His"). '_' . $indice_interno . ".xls";
            $excel->ExelIni();
            $arrayTitulos = array();
            foreach($this->_fields_show_fild as $campo){
                array_push($arrayTitulos, utf8_decode($campo['field']));
            }
            # Creamos los nombres de los campos
            $excel->newTr($arrayTitulos);

            $arrayConten = array();
        }

        # Creamos los las columnas con sus contenidos
        foreach($this->_fields_show_fild as $fields){
            if($fields['field']=='password'){
                array_push($arrayConten, '••••••••');
            } else {
                array_push($arrayConten, $this->_f->clean_string(utf8_decode($record->{$fields['field']})));
            }
        }
        $excel->newTr($arrayConten);
        
        $indice_interno = $indice_interno + 1;

        if($indice_interno%$multiplo==0){
            $excel->ExelFin();
        }
            
        
    }
}else{
    array_push($arrayConten, 'No hay registros');
}

?>