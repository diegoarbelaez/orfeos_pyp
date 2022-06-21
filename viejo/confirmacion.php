<?php
include("conexion.php");
$sentencia = "select count(*) as resultado from registro_micasa";
$resultado = mysqli_query($conexion, $sentencia);
$fila = mysqli_fetch_assoc($resultado);

$sentencia2 = "select * from registro_micasa";
$resultado2 = mysqli_query($conexion, $sentencia2);
$row = mysqli_fetch_assoc($resultado2);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Listado de Inscritos - Mi Casa YA</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js" crossorigin="anonymous"></script>
    <!-- TABLAS DE BOOTSTRAP -->
    <!-- Estas son las librerias para que funcione -->
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="jquery-3.5.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/13c34f0681.js" crossorigin="anonymous"></script>

</head>

<body class="nav-fixed">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary mb-5">
            <div class="container">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                Consultas y Registro de Inscripciones
                            </h1>
                            <div class="page-header-subtitle">Aquí puedes consultar por cédula el ciudadano</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="text-center mb-5">
            <div class="display-4 text-primary mb-2">Registros Actualizados <i class="far fa-edit"></i></div>
            <div class="display-4"><?php echo $fila["resultado"] ?> Hasta el momento</div>
            <div class="display-4"><?php

                                    $sentencia_cargados = "select count(*) as total_cargados from registro_micasa where documento1 != ''";
                                    $resultado_cargados = mysqli_query($conexion, $sentencia_cargados);
                                    $fila_cargados = mysqli_fetch_assoc($resultado_cargados);

                                    echo $fila_cargados["total_cargados"];


                                    ?> Hasta el momento</div>
        </div>
        <!-- Main page content-->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-body">
                        <h5 class="card-title">Consulta Individual</h5>
                        <div class="position-relative form-group row">
                            <div class="col-md-3">
                                <label class="">REGISTRO ACTUALIZADO</label>
                            </div>
                        </div>
                        <a href="index.php" class="btn btn-success">REALIZAR UNA NUEVA CONSULTA</a>
                    </div>
                </div>
                <!-- Detailed pricing example-->
            </div>
        <hr class="my-10" />
    </main>

</body>

</html>