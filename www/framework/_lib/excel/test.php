<?php
require_once('Class.Excel.php');

$excel = new Excel();
$excel->xlsHeaders("test.xls");
echo $excel->xlsBOF();
echo $excel->xlsWriteLabel(0,0,"Titulo");
echo $excel->xlsWriteLabel(1,0,"numero");
echo $excel->xlsWriteNumber(1,1,111);
echo $excel->xlsWriteLabel(2,0,"texto");
echo $excel->xlsWriteString(2,1,"comunicación ñ");
echo $excel->xlsEOF();
exit();
?>