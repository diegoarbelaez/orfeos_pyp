<?php
include("conexion.php");

/* Esto es lo que vamos a hacer

FASE I
1. Identificar palabras y frases de los asuntos
2. Guardarlas en una BD
3. Tabular de mayor a menor, qué sucede


PASO 1.
1. Leer asunto
2. Eliminar conectores, menos de 3 letras
3. Tabular

*/

$sentencia = "select ASUNTO from orfeos";
$resultado = mysqli_query($conexion, $sentencia);

$bodega_palabras = array();

while ($fila = mysqli_fetch_assoc($resultado)) {
    //echo $fila["ASUNTO"];
    $asunto = explode(" ", $fila["ASUNTO"]);
    foreach ($asunto as $valor) {
        if (strlen($valor) > 3) {

            switch ($valor){
                case "certificado": break;
            }

            array_push($bodega_palabras, $valor);
            echo "agregó ->" . $valor . "\n\r";
        }
    }
}
