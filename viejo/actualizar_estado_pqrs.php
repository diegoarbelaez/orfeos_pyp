<?php
include("conexion.php");
$estado = $_POST["estado"];
$id_pqrs = $_POST["id_pqrs"];
$comentario = $_POST["comentario"];
$id_funcionario = $_POST["id_funcionario"];
$sentencia = "UPDATE pqrs set estado = $estado where id_pqrs=$id_pqrs";
$resultado = mysqli_query($con, $sentencia);
//Agrega al Log
$novedad = "";
switch ($estado) {
    case 2:
        $novedad = "Se tomó la PQRS, inició el proceso de respuesta";
        break;
    case 3:
        $novedad = "Se cierra la PQRS";
        break;
}
$sentencia_eventos = "insert into log (fk_id_pqrs,fk_id_funcionario_delegante,fk_id_funcionario_delegado,comentario,novedad) values ($id_pqrs,$id_funcionario,$id_funcionario,'$comentario','$novedad')";
$resultado_eventos = mysqli_query($con, $sentencia_eventos);
header("location:ver_pqrs.php?id_pqrs=" . $id_pqrs);
