<?php
// include_once ('pdf/mpdf.php');
$painel_atual = "professor"; 
require_once "../config.php";

//include autoloader
require_once 'dompdf/autoload.inc.php';
/* Preparação do conteúdo
 * (costumo ter uma função a realizar esta tarefa)
 */
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml(str:"<h1>opa </h1>");

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("OPa", ["Attachment" => false]);
?>