<?php
$nombre_tabla = "OrfeosFebrero";
include("conexion.php");

$id = $_GET["id"];
$sentencia2 = "select * from $nombre_tabla  where id=$id";
$resultado2 = mysqli_query($conexion, $sentencia2);
$row = mysqli_fetch_assoc($resultado2);
$categoria = $row["categoria"];

switch ($categoria) {

    case 1:
        echo "Categoria 1";
        break;
    case 2:
        echo "Categoria 2";
         break;
    case 3:
        echo "Categoria 3";
        break;
    case 4:
        echo "Categoria 4";
        break;
    case 5:
        echo "Categoria 5";
        break;
    case 6:
        header("location: generar_respuesta_tipo6.php?id=$id");
        break;
    case 7:
        echo "Categoria 7";
        break;
}
