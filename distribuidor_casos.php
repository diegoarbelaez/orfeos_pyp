<?php
include("conexion.php");
$nombre_tabla = "OrfeosFebrero";

$limite = 100;

$integrantes = array();

/*$integrantes = array(
    1 => "diegoarbelaez.co@gmail.com",
    2 => "danitorres612@gmail.com",
    3 => "acaicedo@minsalud.gov.co",
    4 => "dsantose@minsalud.gov.co",
    5 => "ymartinezl@minsalud.gov.co",
    6 => "sharol_890910@hotmail.com",
    7 => "oscarcb15@hotmail.com");*/

/*for ($i = 1; $i < 0; $i++) {
    array_push($integrantes, "diegoarbelaez.co@gmail.com");
    echo "Poblando a... diegoarbelaez.co@gmail.com \r\n";
}*
for ($i = 1; $i <  0; $i++) {
    array_push($integrantes, "danitorres612@gmail.com");
    echo "Poblando a... danitorres612@gmail.com \r\n";
}
for ($i = 1; $i < 0; $i++) {
    array_push($integrantes, "acaicedo@minsalud.gov.co");
    echo "Poblando a... acaicedo@minsalud.gov.co \r\n";
}
for ($i = 1; $i < 0; $i++) { 
    array_push($integrantes, "dsantose@minsalud.gov.co");
    echo "Poblando a... dsantose@minsalud.gov.co \r\n";
}
for ($i = 1; $i < 0; $i++) {
    array_push($integrantes, "ymartinezl@minsalud.gov.co");
    echo "Poblando a... ymartinezl@minsalud.gov.co \r\n";
}
for ($i = 1; $i < 0; $i++) {
    array_push($integrantes, "sharol_890910@hotmail.com");
    echo "Poblando a... sharol_890910@hotmail.com \r\n";
}
for ($i = 1; $i < 0; $i++) { 
    array_push($integrantes, "oscarcb15@hotmail.com");
    echo "Poblando a... oscarcb15@hotmail.com \r\n";
}
*/

for ($i = 1; $i < 20; $i++) { //si asignar
    array_push($integrantes, "ymartinezl@minsalud.gov.co");
    echo "Poblando a... ymartinezl@minsalud.gov.co\r\n";
}

for ($i = 1; $i < 20; $i++) { //si asignar
    array_push($integrantes, "alejafisio20092@gmail.com");
    echo "Poblando a... alejafisio20092@gmail.com \r\n";
}

for ($i = 1; $i < 15; $i++) { 
    array_push($integrantes, "marin_j23@hotmail.com");
    echo "Poblando a... marin_j23@hotmail.com \r\n";
}

for ($i = 1; $i < 15; $i++) {
    array_push($integrantes, "indiragamba@gmail.com");
    echo "Poblando a... indiragamba@gmail.com \r\n";
}

for ($i = 1; $i < 15; $i++) {
    array_push($integrantes, "aavilao@minsalud.gov.co");
    echo "Poblando a... aavilao@minsalud.gov.co \r\n";
}

for ($i = 1; $i < 15; $i++) {//si asignar
    array_push($integrantes, "szuniga@minsalud.gov.co");
    echo "Poblando a... szuniga@minsalud.gov.co \r\n";
}
/*
for ($i = 1; $i < 20; $i++) {//si asignar
    array_push($integrantes, "klaualarcon4@gmail.com");
    echo "Poblando a... yefermillan194@gmail.com \r\n";
}

*/
/*
Agregados en Abril 2022
JULISSA ALCALA GUZMAN 
yalguz_85@hotmail.com
ANA JHANI MATALLANA ESPITIA anamatallana1977@gmail.com
YEFERSON STIDWAR GACHARNA CUELLAR 
yefermillan194@gmail.com
CLAUDIAPATRICIA ALARCON BLANCO klauralarcon4@gmail.com

*/



//var_dump($integrantes);


$sentencia = "select * from $nombre_tabla where categoria = 1";
$resultado = mysqli_query($conexion, $sentencia);
$iteracion = 1;
while ($fila = mysqli_fetch_assoc($resultado)) {
    $integrante_asignado = $integrantes[rand(1, 100)];
    $sentencia_asignacion = "update $nombre_tabla set responsable='" . $integrante_asignado . "' where id=" . $fila["id"];
    $resultado_asignacion = mysqli_query($conexion, $sentencia_asignacion);
    // echo "Asignado a " . $integrante_asignado . "el id " . $fila["id"] . " \r\n";
    echo $iteracion." Radicado - ".$fila["NUMERO RADICADO"]. " Perteneciente a ".$fila["responsable"]." ahora es para ".$integrante_asignado . " \r\n";
    $iteracion++;
}
