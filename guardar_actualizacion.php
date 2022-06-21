<?php session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php
include("conexion.php");
$nombre_tabla = "OrfeosFebrero";
$id = $_POST["id"];
$categoria = $_POST["categoria"];
$sentencia = "update $nombre_tabla set categoria = $categoria, responsable='".$_SESSION["user"]."', ultima_modificacion='".date("Y-m-d h:i:s")."' where id=$id";
$resultado = mysqli_query($conexion, $sentencia);
//var_dump($_SESSION);
//echo $sentencia;
header("Location:listado_orfeos.php");

?>