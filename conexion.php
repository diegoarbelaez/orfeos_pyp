<?php
$db_host = "127.0.0.1";
$db_user = "root";
$db_pass = "";
$db_name = "mipgenlinea_orfeos";
$conexion = new mysqli($db_host, $db_user, $db_pass, $db_name);

/*
if (!$conexion->set_charset("utf8")) {
    printf("", $conexion->error);
} else {
   printf("", $conexion->character_set_name());
}*/

if ($conexion->connect_errno) {
    printf("Falló la conexión 2022: %s\n", $mysqli->connect_error);
    exit();
}
