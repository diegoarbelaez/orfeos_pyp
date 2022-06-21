<?php

use Mpdf\Tag\PageBreak;

function getPlantilla($html_respuesta,$id)
{
    include("conexion.php");
    $nombre_tabla = "OrfeosFebrero";


    $sentencia = "select * from $nombre_tabla where id=$id";
    $resultado = mysqli_query($conexion, $sentencia);
    $fila = mysqli_fetch_assoc($resultado);
    $numero_radicado = $fila['NUMERO RADICADO'];
    $fecha_radicado = $fila['FECHA RADICADO'];
    $nombres=$fila['REMITENTE'];
    $documento = $fila['documento'];
    $direccion = $fila['direccion'];
    $telefono = $fila['telefono'];
    $correo = $fila['correo'];
    $ciudad = $fila['ciudad'];


    $plantilla = '
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_reporte.css">
</head>
<header class="clearfix">
<body>
    <table>
        <tr>
            <td>
            <br><br><br><img src="logomsps.png"></td>
        </tr>
    </table>
</header>
<main>
    <table>
        <tr>
        <td style="text-align: right"> <h1>*'.$numero_radicado.'*</h1> </td>
        </tr>
        <tr>
        <td style="text-align: right"> Al contestar por favor cite estos datos </td>
        </tr>
        <tr>
        <td style="text-align: right"> Radicado No.<b>'.$numero_radicado.'</b> </td>
        </tr>
        <tr>
        <td style="text-align: right"> Fecha:'.$fecha_radicado.' </td>
        </tr>
        <tr>
        <td style="text-align: right"> Página {PAGENO} de {nbpg} </td>
        </tr>

        </tr>    
    </table>
    <div>
        <br><br><br><br>
        <p class="texto_hecho">
            Bogotá, '.date("Y-m-d").'
        
        <br><br><br><br><br>
        Señor(a):<br>
        <b>'.$nombres.'</b><br>
        '.$documento.'<br>
        '.$direccion.'<br>
        '.$telefono.'<br>
        '.$correo.'<br>
        '.$ciudad.'<br>
        </p>
    </div>
    <br><br><br><br><br>
    <div>
    <p class="texto_hecho">
            '.$html_respuesta.'
        </p>
    </div>
    
    ';
   
    $plantilla .= '
        <htmlpagefooter name="myFooter1" style="display:none border:0px ">
        <table width="100%">
            <tr>
                <td width="100%" align="center" style="font-weight: bold; font-size:9; ">
                    <b>CRA 13 Nº 32 - 76 - Código postal 110311, Bogotá Colombia D.C.</b>
                </td>
            </tr>
            <tr>
            <td width="100%" align="center" style="font-size:9; ">
                Teléfono: (57 - 1)3305000 - Línea Gratuita: 018000960020 - fax: (57-1) 3305050 - www.minsalud.gov.co
            </td>
        </tr>
        </table>
        </htmlpagefooter>
        <htmlpagefooter name="myFooter2" style="display:none">
            <table width="100%">
                <tr>
                    <td width="33%">My document</td>
                    <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                    <td width="33%" style="text-align: right;">{DATE j-m-Y}</td>
                </tr>
            </table>
        </htmlpagefooter>
        </body>
        </html>';


    return $plantilla;
}
