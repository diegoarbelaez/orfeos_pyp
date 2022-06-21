<?php
include("conexion.php");
$id_usuario = $_SESSION["id_usuario"];
//Obtengo la dependencia del usuario que está consultando
$sentencia_pqrs = "select * from funcionario where id_funcionario = $id_usuario";
echo $sentencia_pqrs;
$resultado_pqrs = mysqli_query($con,$sentencia_pqrs);
$fila_usuario = mysqli_fetch_assoc($resultado_pqrs);
$dependencia= $fila_usuario["fk_id_dependencia"];


///



$sentencia_sin = "select count(*) as total_sin from pqrs where estado = 1 and fk_id_dependencia = $dependencia";
echo $sentencia_sin;
$resultado_sin = mysqli_query($con,$sentencia_sin);
$fila_sin = mysqli_fetch_assoc($resultado_sin);
echo $fila_sin["total_sin"];
?>