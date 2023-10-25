<?php
require_once( dirname(__FILE__) . '/Class.Fpdf.php');

// { ---------------------------------------------------------------------------------------------------------
// APROBADO
class PDF extends FPDF
{
    function Header()
    {
        $this->Image('images/logo_certificado.png',75,24,56);
    }

    function PrintColumn($margin, $width, $height, $font_size, $style, $border, $fill, $align, $text)
    {
        $text = iconv('UTF-8', 'windows-1252', $text);
        $this->SetLeftMargin($margin);
        $this->SetFont('Arial',$style,$font_size);
        $this->MultiCell($width,$height,$text,$border,$align,$fill);
    }
}
$border = 0;
$fill = false;
$style = '';
$pdf = new PDF();

$pdf->AddPage();
$pdf->SetFont('Arial','',10);

// Date
$pdf->Ln(12);
$pdf->PrintColumn('55','100','4.35','6',$style,$border,$fill,'R','12/09/2020');
// Name & DNI & Status
$pdf->Ln(17);
$pdf->PrintColumn('55','100','4.35','9',$style,$border,$fill,'C','Estimado Carlos Pérez Carlos Pérez Carlos Pérez DNI 11.123.456');
$pdf->PrintColumn('55','100','4.35','9',$style,$border,$fill,'C','Su crédito ha sido APROBADO');

// Table Left
$border = 1;
$background_color = 'e9ebf5';
$fill = true;
$pdf->SetFillColor(200,220,255);

$pdf->SetY(0);
$pdf->SetLeftMargin(0);
$pdf->Ln(58.5);

$pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Amprobado N°');
$pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Modelo:');
$pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Marca:');
$pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Año');
$pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Monto Aprobado:');
$pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Plazo:');
$pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Cuota Pura');
$pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Monto Prenda:');
$pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Email:');

// Table Rigth
$pdf->SetY(0);
$pdf->SetLeftMargin(0);
$pdf->Ln(58.5);
$pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
$pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','AMAROK 20TD 4x2 DC COM 180HP L17');
$pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
$pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
$pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
$pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
$pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
$pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
$pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');


// Alto del rengrlon
$row_height = 4.4;
$initial_height = 102;
// Insurance data
$pdf->SetY(0);
$pdf->SetLeftMargin(0);
$pdf->Ln($initial_height);
$style = 'B';
$pdf->PrintColumn('55','100','4.35','7',$style,$border,$fill,'C','Datos Seguro');

$pdf->SetY(0);
$pdf->SetLeftMargin(0);
$pdf->Ln($initial_height+$row_height);
$style = '';
$pdf->PrintColumn('55','25','9.6','8',$style,$border,$fill,'C','ID Aseguradora');

$pdf->SetY(0);
$pdf->SetLeftMargin(0);
$pdf->Ln($initial_height+$row_height);
$style = '';
$pdf->PrintColumn('80','25','4.8','8',$style,$border,$fill,'C','Clase de Cobertura');

$pdf->SetY(0);
$pdf->SetLeftMargin(0);
$pdf->Ln($initial_height+$row_height);
$style = '';
$pdf->PrintColumn('105','25','9.6','8',$style,$border,$fill,'C','Premio con IVA');

$pdf->SetY(0);
$pdf->SetLeftMargin(0);
$pdf->Ln($initial_height+$row_height);
$style = '';
$pdf->PrintColumn('130','25','4.8','8',$style,$border,$fill,'C','Monto cuota con seguro');

$loanInstallAmount = 21773.81;
$smartixResponse = array(
    array(
        "internalId" => 14855,
        "rowNr" => 0,
        "rowId" => 14855,
        "masterId" => 28197,
        "RowViewNumber" => 0,
        "IdAseguradora" => "34",
        "ClaseCobertura" => "C",
        "CodigoProducto" => "07",
        "PremioConIva" => 7178.33,
        "TipoVigencia" => "Semestral",
        "SumaAsegurada" => "997500.0000",
        "Enabled" => null,
        "TotalInstallAmount" => 12656.25
    ),
    array(
        "internalId" => 14856,
        "rowNr" => 1,
        "rowId" => 14856,
        "masterId" => 28197,
        "RowViewNumber" => 0,
        "IdAseguradora" => "56",
        "ClaseCobertura" => "C",
        "CodigoProducto" => "M5",
        "PremioConIva" => 3558.82,
        "TipoVigencia" => "Anual",
        "SumaAsegurada" => "1045000.00",
        "Enabled" => null,
        "TotalInstallAmount" => 16639.71
    ),
    array(
        "internalId" => 14857,
        "rowNr" => 2,
        "rowId" => 14857,
        "masterId" => 28197,
        "RowViewNumber" => 0,
        "IdAseguradora" => "34",
        "ClaseCobertura" => "C",
        "CodigoProducto" => "05",
        "PremioConIva" => 2614.97,
        "TipoVigencia" => "Semestral",
        "SumaAsegurada" => "997500.0000",
        "Enabled" => null,
        "TotalInstallAmount" => 15695.86
    ),
);

$smartixResponseLength = sizeof($smartixResponse);

$insurers = array(
    "34" => "Mercantil",
    "56" => "Boston",
    "2177272" => "Sura"
);

// Nuevo Alto del rengrlon
$new_initial_height = 116;
// Alto del rengrlon
$row_height = 4.4;
$total_height = '';

for($i=0; $i<$smartixResponseLength; $i++){

    $apply_height = $new_initial_height + ($row_height * $i);
    $total_height = $apply_height;
    $loanInstallAmount = str_replace(',','',$loanInstallAmount);
    $price_with_iva = str_replace(',','',$smartixResponse[$i]['PremioConIva']);
    $quota_with_insurance = $loanInstallAmount + $price_with_iva;
    $quota_with_insurance = number_format($quota_with_insurance, 2, ',', '.');

    $pdf->SetY(0);
    $pdf->SetLeftMargin(0);
    $pdf->Ln($apply_height);
    $style = '';
    $pdf->PrintColumn('55','25','4.35','8',$style,$border,$fill,'C',$insurers[$smartixResponse[$i]['IdAseguradora']]);

    $pdf->SetY(0);
    $pdf->SetLeftMargin(0);
    $pdf->Ln($apply_height);
    $style = '';
    $pdf->PrintColumn('80','25','4.35','8',$style,$border,$fill,'C','Tercero');

    $pdf->SetY(0);
    $pdf->SetLeftMargin(0);
    $pdf->Ln($apply_height);
    $style = '';
    $pdf->PrintColumn('105','25','4.35','8',$style,$border,$fill,'C',number_format($smartixResponse[$i]['PremioConIva'], 2, ',', '.'));

    $pdf->SetY(0);
    $pdf->SetLeftMargin(0);
    $pdf->Ln($apply_height);
    $style = '';
    $pdf->PrintColumn('130','25','4.35','8',$style,$border,$fill,'C',$quota_with_insurance);
}

// SIGNATURE
$border = 0;
$background_color = '';
$fill = false;
$heig_more = 12;
$pdf->SetY(0);
$pdf->SetLeftMargin(0);
$pdf->Ln($total_height + $heig_more);

$pdf->PrintColumn('62','87','4.35','8',$style,$border,$fill,'C','Firma del cliente: ____________________');
$pdf->PrintColumn('62','87','4.35','8',$style,$border,$fill,'C','Aclaración: ____________________');
$pdf->PrintColumn('62','87','4.35','8',$style,$border,$fill,'C','DNI: ____________________');


// BOX
$pdf->SetDrawColor(255, 0, 0);
$pdf->SetLineWidth(1);
// $pdf->Rect(55 , 20, 100, $total_height+15);
$pdf->Rect(50 , 20, 110, $total_height+15);

// RESET COLOR & LINE
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.1);

$pdf->Output();
// $pdf->Output('F',dirname(__FILE__) . '/material/certifieds/media/certificado.pdf');
// } ---------------------------------------------------------------------------------------------------------



// { ---------------------------------------------------------------------------------------------------------
// RECHAZADO
// class PDF extends FPDF
// {
//     function Header()
//     {
//         $this->Image('images/logo_certificado.png',75,24,56);
//     }

//     function PrintColumn($margin, $width, $height, $font_size, $style, $border, $fill, $align, $text)
//     {
//         $text = iconv('UTF-8', 'windows-1252', $text);
//         $this->SetLeftMargin($margin);
//         $this->SetFont('Arial',$style,$font_size);
//         $this->MultiCell($width,$height,$text,$border,$align,$fill);
//     }
// }
// $border = 0;
// $fill = false;
// $style = '';
// $pdf = new PDF();
// // $pdf->AliasNbPages();
// $pdf->AddPage();
// $pdf->SetFont('Arial','',10);

// $pdf->Ln(12);
// $pdf->PrintColumn('55','100','4.35','6',$style,$border,$fill,'R','12/09/2020');
// $pdf->Ln(17);
// $pdf->PrintColumn('55','100','4.35','9',$style,$border,$fill,'C','Estimado Carlos Pérez Carlos Pérez Carlos Pérez DNI 11.123.456');
// $pdf->PrintColumn('55','100','4.35','9',$style,$border,$fill,'C','Lamentamos informarle que su crédito se encuentra');
// $style = 'B';
// $pdf->PrintColumn('55','100','4.35','9',$style,$border,$fill,'C','RECHAZADO');
// $style = '';

// $border = 1;
// $background_color = 'e9ebf5';
// $fill = true;
// $pdf->SetFillColor(200,220,255);

// $pdf->SetY(0);
// $pdf->SetLeftMargin(0);
// $pdf->Ln(61);
// $style = 'B';

// $pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Amprobado N°');
// $pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Modelo:');
// $pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Marca:');
// $pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Año');
// $pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Monto Aprobado:');
// $pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Plazo:');
// $pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Cuota Pura');
// $pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Monto Prenda:');
// $pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Email:');

// $style = '';
// $pdf->SetY(0);
// $pdf->SetLeftMargin(0);
// $pdf->Ln(61);
// $pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
// $pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
// $pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
// $pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
// $pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
// $pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
// $pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
// $pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
// $pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');

// // BOX
// $pdf->SetDrawColor(255, 0, 0);
// $pdf->SetLineWidth(1);
// $pdf->Rect(50, 20, 110, 90);

// // RESET COLOR & LINE
// $pdf->SetDrawColor(0, 0, 0);
// $pdf->SetLineWidth(0.1);

// $pdf->Output();
// // $pdf->Output('F',dirname(__FILE__) . '/material/certifieds/media/certificado.pdf');
// } ---------------------------------------------------------------------------------------------------------



// {---------------------------------------------------------------------------------------------------------
// PENDIENTE
// class PDF extends FPDF
// {
//     function Header()
//     {
//         $this->Image('images/logo_certificado.png',75,24,56);
//         // $this->Image('images/certificado_rechazado.png',55,20,100);
//     }

//     function PrintColumn($margin, $width, $height, $font_size, $style, $border, $fill, $align, $text)
//     {
//         $text = iconv('UTF-8', 'windows-1252', $text);
//         $this->SetLeftMargin($margin);
//         $this->SetFont('Arial',$style,$font_size);
//         $this->MultiCell($width,$height,$text,$border,$align,$fill);
//     }
// }
// $border = 0;
// $fill = false;
// $style = '';
// $pdf = new PDF();
// // $pdf->AliasNbPages();
// $pdf->AddPage();
// $pdf->SetFont('Arial','',10);

// $pdf->Ln(12);
// $pdf->PrintColumn('55','100','4.35','6',$style,$border,$fill,'R','12/09/2020');
// $pdf->Ln(17);
// $pdf->PrintColumn('55','100','4.35','9',$style,$border,$fill,'C','Estimado Carlos Pérez Carlos Pérez Carlos Pérez DNI 11.123.456');
// $pdf->PrintColumn('55','100','4.35','9',$style,$border,$fill,'C','Su crédito se encuentra PENDIENTE, estamos trabajando');
// $pdf->PrintColumn('55','100','4.35','9',$style,$border,$fill,'C','para brindarle una pronta respuesta');

// $border = 1;
// $background_color = 'e9ebf5';
// $fill = true;
// $pdf->SetFillColor(200,220,255);

// $pdf->SetY(0);
// $pdf->SetLeftMargin(0);
// $pdf->Ln(61);
// $style = 'B';

// $pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Amprobado N°');
// $pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Modelo:');
// $pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Marca:');
// $pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Año');
// $pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Monto Aprobado:');
// $pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Plazo:');
// $pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Cuota Pura');
// $pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Monto Prenda:');
// $pdf->PrintColumn('55','50','4.35','7',$style,$border,$fill,'C','Email:');

// $style = '';
// $pdf->SetY(0);
// $pdf->SetLeftMargin(0);
// $pdf->Ln(61);
// $pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
// $pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
// $pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
// $pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
// $pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
// $pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
// $pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
// $pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');
// $pdf->PrintColumn('105','50','4.35','7',$style,$border,$fill,'C','asd asda sd asda');

// // BOX
// $pdf->SetDrawColor(255, 0, 0);
// $pdf->SetLineWidth(1);
// $pdf->Rect(50 , 20, 110, 90);

// // RESET COLOR & LINE
// $pdf->SetDrawColor(0, 0, 0);
// $pdf->SetLineWidth(0.1);

// $pdf->Output();
// // $pdf->Output('F',dirname(__FILE__) . '/material/certifieds/media/certificado.pdf');
// }---------------------------------------------------------------------------------------------------------


?>