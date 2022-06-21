<?php
include("conexion.php");
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$cedula = $_POST["cedula"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$fecha_nacimiento = $_POST["fecha_nacimiento"];
$actividad_economica = $_POST["actividad_economica"];
$nivel_educativo = $_POST["nivel_educativo"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$id_registro = $_POST["id_registro"];

$sentencia = "update registro_micasa set
nombres = '$nombres',
apellidos = '$apellidos',
cedula = '$cedula',
direccion = '$direccion',
telefono = '$telefono',
fecha_nacimiento = '$fecha_nacimiento',
actividad_economica = '$actividad_economica',
nivel_educativo = '$nivel_educativo',
correo = '$correo',
telefono = '$telefono'
where id_registro = $id_registro";

$resultado = mysqli_query($conexion,$sentencia);
if($resultado){
    header("location:confirmacion_edicion.php");
}
else {
   echo "Error en Sentencia -> ". mysqli_error($conexion);
}
?>