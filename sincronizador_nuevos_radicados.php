<?php
include("conexion.php");

$tabla_destino = 'OrfeosFebrero';
$tabla_origen = 'OrfeosJunio';
$existentes = 0;
$nuevos = 0;
$iteracion = 1;

$sentencia1 = "select * from $tabla_origen";
echo $sentencia1."\r\n";
$resultado = mysqli_query($conexion, $sentencia1);

while ($filas = mysqli_fetch_assoc($resultado)) {
    echo "Procesando Registro No. " . $iteracion . "  - ";
    //Variables de la tabla, las uso para insertar en la tabla destino
    //var_dump($filas);
    $radicado_encontrado = $filas["NUMERO RADICADO"];
    $fecha = substr($filas["FECHA RADICADO"],0,10);
    $asunto = $filas["ASUNTO"];
    $remitente = $filas["REMITENTE"];
    $tipo_documento = $filas["TIPO DOCUMENTO"];
    $dias_restantes = $filas["DIAS RESTANTES"];
    $enviado_por = $filas["ENVIADO POR"];
    $fecha_insercion = date("Y-m-d h:i:s");

    $sentencia2 = "select * from $tabla_destino where `NUMERO RADICADO` like '$radicado_encontrado' ";
    //echo $sentencia2." \r\n";
    $resultado2 = mysqli_query($conexion, $sentencia2);
    if (mysqli_num_rows($resultado2) > 0) {
        //Radicado ya existe, no insertar
        echo "Radicado No. " . $radicado_encontrado . " No Insertado \r\n";
        $existentes++;
    } else {
        echo "Radicado No. " . $radicado_encontrado . " Insertado con Éxito!!\r\n";
        $sentencia_insert = "INSERT INTO $tabla_destino (`id`, `NUMERO RADICADO`, `FECHA`, `ASUNTO`, `documento`, `direccion`, `telefono`, `correo`, `REMITENTE`, `TIPO DOCUMENTO`, `DIAS RESTANTES`, `ENVIADO POR`, `categoria`, `responsable`, `ultima_modificacion`) VALUES (NULL, '$radicado_encontrado', '$fecha', '$asunto', '', '', '', '', '$remitente', '$tipo_documento', '$dias_restantes', '$enviado_por', '1', '', '$fecha_insercion')";
        //echo $sentencia_insert."\r\n";
        
        $resultado2 = mysqli_query($conexion, $sentencia_insert);
        if (!$resultado2) {
            echo "Error Insertando -> " . mysqli_error($conexion);
        }
        
        $nuevos++;
    }
    $iteracion++;
}

echo "Finalizó exitosamente! \r\n";
echo "Ya habían $existentes \r\n";
echo "Agregó $nuevos \r\n";
