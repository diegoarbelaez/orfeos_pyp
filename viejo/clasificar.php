<?php
include("conexion.php");
$clasificacion = $_POST["clasificacion"];
$notas = $_POST	["notas"];
$id_registro = $_POST["id_registro"];

$sentencia_notas= "insert into notas_micasa (fk_id_registro,notas) values ($id_registro,'$notas')";
$resultado = mysqli_query($conexion,$sentencia_notas);

$sentencia_update = "update registro_micasa set clasificacion='$clasificacion' where id_registro=$id_registro";
$resultado = mysqli_query($conexion,$sentencia_update);

header("location:confirmacion.php");


?>