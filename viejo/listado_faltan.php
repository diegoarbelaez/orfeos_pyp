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
    <script src="jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />
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
                                <div class="page-header-icon"><i data-feather="package"></i></div>
                                Consultas y Registro de Inscripciones
                            </h1>
                            <div class="page-header-subtitle">Aquí los registrados en tiempo real</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="text-center mb-5">
            <div class="display-4 text-primary mb-2">Registros Actualizados <i class="far fa-edit"></i></div>
            <div class="display-4"><?php

                                    $sentencia_cargados = "select count(*) as total_cargados from registro_micasa where clasificacion = 'Falta Documentos'";
                                    $resultado_cargados = mysqli_query($conexion, $sentencia_cargados);
                                    $fila_cargados = mysqli_fetch_assoc($resultado_cargados);

                                    echo $fila_cargados["total_cargados"];


                                    ?> Hasta el momento</div>
        </div>
        <!-- Main page content-->
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-body">
                    <h5 class="card-title">Listado de Inscritos</h5>
                    <div>
                    <a href="index2.php" target="new" class="btn btn-info">LISTADO GENERAL</a>
                        <a href="listado_documentos_cargados.php" target="new" class="btn btn-secondary">LISTADO DOCUMENTOS CARGADOS</a>
                        <a href="listado_clasifica.php" target="new" class="btn btn-success">LISTADO CLASIFICA</a>
                        <a href="listado_noclasifica.php" target="new" class="btn btn-danger">LISTADO NO CLASIFICA</a>
                        <a href="listado_faltan.php" target="new" class="btn btn-warning">LISTADO FALTAN DOCUMENTOS</a>
                        <a href="listado_novedades.php" target="new" class="btn btn-primary">LISTADO NOVEDADES</a>

                        <br>
                        <br>
                    </div>
                    <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Edición</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Cédula</th>
                                <th>F. Expedición</th>
                                <th>Lugar Expedición</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Fecha Nacimiento</th>
                                <th>Lugar de Nacimiento</th>
                                <th>Actividad Económica</th>
                                <th>Ingresos</th>
                                <th>Caja Compensación</th>
                                <th>Estado Civil</th>
                                <th>Nivel Educativo</th>
                                <th>Vivienda Propia</th>
                                <th>Vivienda que aspira</th>
                                <th>Fecha del Registro</th>
                                <th>Archivos Cargados</th>


                            </tr>
                        </thead>
                        <?php
                        $sentencia1 = "SELECT * from registro_micasa where clasificacion = 'Falta Documentos'";
                        $sql = mysqli_query($conexion, $sentencia1);
                        echo $sentencia1;
                        while ($row = mysqli_fetch_assoc($sql)) {
                            echo '
                            <tr>
                            <td> ' . $row['id_registro'] . '</a></td>
                            <td> <a href="editar_inscrito.php?id_registro=' . $row['id_registro'] . '"><i class="far fa-edit"></i>Editar</a></td>
                            <td>' . $row['nombres'] . '</td>
                            <td>' . $row['apellidos'] . '</td>
                            <td>' . $row['cedula'] . '</td>
                            <td>' . $row['fecha_expedicion'] . '</td>
                            <td>' . $row['lugar_expedicion'] . '</td>
                            <td>' . $row['direccion'] . '</td>
                            <td>' . $row['telefono'] . '</td>
                            <td>' . $row['correo'] . '</td>
                            <td>' . $row['fecha_nacimiento'] . '</td>
                            <td>' . $row['lugar_nacimiento'] . '</td>
                            <td>' . $row['actividad_economica'] . '</td>
                            <td>' . $row['ingresos'] . '</td>
                            <td>' . $row['caja_compensacion'] . '</td>
                            <td>' . $row['estado_civil'] . '</td>
                            <td>' . $row['nivel_educativo'] . '</td>
                            <td>' . $row['vivienda_propia'] . '</td>
                            <td>' . $row['vivienda_aspira'] . '</td>
                            <td>' . $row['fecha_registro'] . '</td>';
                            if (!empty($row['documento1'])) {
                                echo '
                            <td><a href="ver_documentos3.php?id_registro=' . $row["id_registro"] . '" target="blank"> Ver Archivos </a></td>';
                            } else {
                                echo '<td>No ha Cargado</td>';
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
            <!-- Detailed pricing example-->
        </div>
        <hr class="my-10" />
    </main>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip',
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    }
                },
                "scrollX": true,
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            });
        });
    </script>
</body>

</html>