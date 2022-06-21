<?php
$nombre_tabla = "OrfeosFebrero";
include("conexion.php");
$id = $_POST["id"];
$nombre = $_POST["nombres"];
$documento = $_POST["documento"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$correo = $_POST["correo"];
$ciudad = $_POST["ciudad"];


$sentencia = "update $nombre_tabla set REMITENTE='$nombre', documento='$documento', direccion='$direccion', telefono='$telefono', correo='$correo', ciudad='$ciudad' where id=$id";
$resultado = mysqli_query($conexion, $sentencia);

//echo $sentencia;

header("Location:generar_respuesta_masiva.php?id=$id");

?>