<?php
$nombre_tabla = "OrfeosFebrero";
include("conexion.php");

use Mpdf\Mpdf;

require_once('vendor/autoload.php');
require_once('plantilla_respuesta_orfeos.php');
//trae el css
//$css = file_get_contents('style_reporte.css'); 

//base de datos
//require_once('productos.php');


//$mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/custom/temp/dir/path']);

$mpdf = new \Mpdf\Mpdf([
    "format" => "Legal",
    "img_dpi" => 96
]);

$mpdf->SetCompression(true);
$mpdf->SetFooter('{PAGENO} / {nb}');




$html_respuesta = $_POST["html_respuesta"];
$id = $_POST["id"];

$sentencia = "select * from $nombre_tabla where id=$id";
$resultado = mysqli_query($conexion, $sentencia);
$fila = mysqli_fetch_assoc($resultado);
$numero_radicado = $fila['NUMERO RADICADO'];
$fecha_radicado = $fila['FECHA RADICADO'];




$plantilla = getPlantilla($html_respuesta,$id);
//$mpdf -> WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);

$mpdf->WriteHTML($plantilla);

/*

$mpdf->AddPage('L');
$mpdf->WriteHTML('<p>Esta es una nueva página</p>',\Mpdf\HTMLParserMode::HTML_BODY);

$mpdf->AddPage('P','','','','',0,0,0,0); // Margenes
$mpdf->WriteHTML('<p>Esta es una nueva página Horizontal</p>',\Mpdf\HTMLParserMode::HTML_BODY); */

//Para guardar el PDF con el nombre del contratista y cédula, lo busco en BD

$mpdf->Output("Respuesta Radicado No. $numero_radicado.pdf", "I"); 
//$mpdf->Output("contratistas/SIAOBSERVA/SUPERVISORES/".$fecha_final ." ". $nombre_contratista ." ".$cedula_contratista. " informeSupervision.pdf", "F");