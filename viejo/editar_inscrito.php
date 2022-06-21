<?php
include("conexion.php");
$id_registro = $_GET["id_registro"];
$sentencia2 = "select * from registro_micasa where id_registro=$id_registro";
$resultado2 = mysqli_query($conexion, $sentencia2);
$row = mysqli_fetch_assoc($resultado2);
$tipo = $row["tipo_perfil"];

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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script> -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js" crossorigin="anonymous"></script>

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
            <div class="display-4 text-primary mb-2"><?php echo $row["nombres"] . " " . $row["apellidos"] ?></div>
            <div class="display-4">Perfilado como
                <?php
                $tipo_perfil = "";
                switch ($row["tipo_perfil"]) {
                    case 0:
                        $tipo_perfil = "Empleado";
                        break;
                    case 1:
                        $tipo_perfil = "Profesional";
                        break;
                    case 2:
                        $tipo_perfil = "Pensionado";
                        break;
                    case 3:
                        $tipo_perfil = "Rentista";
                        break;
                    case 4:
                        $tipo_perfil = "Independiente";
                        break;
                    case 5:
                        $tipo_perfil = "Transportador";
                        break;
                    case 6:
                        $tipo_perfil = "Transportador Empleado";
                        break;
                    case 7:
                        $tipo_perfil = "Independiente Informal";
                        break;
                }
                echo $tipo_perfil;
                ?>
            </div>
        </div>
        <!-- Main page content-->
        <div class="row">
            <div class="card col-6">
                <div class="card-body">
                    <div class="card-body">
                        <h5 class="card-title">Editar Información del Ciudadano</h5>
                        <form action="guardar_actualizacion.php" method="POST">
                            <table class="table table-striped table-hover" id="dataTable2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="30%" style="vertical-align: middle;">Nombres</th>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="nombres" value="<?php echo $row["nombres"] ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle;">Apellidos</th>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="apellidos" value="<?php echo $row["apellidos"] ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle;">Cedula</th>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="cedula" value="<?php echo $row["cedula"] ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle;">Dirección</th>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="direccion" value="<?php echo $row["direccion"] ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <th style="vertical-align: middle;">Teléfono</th>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="telefono" value="<?php echo $row["telefono"] ?>">
                                        </div>
                                    </td>
                                    </tr>
                                    </tr>
                                    <th style="vertical-align: middle;">Fecha de Nacimiento</th>
                                    <td>
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="fecha_nacimiento" value="<?php echo $row["fecha_nacimiento"] ?>">
                                        </div>
                                    </td>
                                    </tr>
                                    </tr>
                                    <th style="vertical-align: middle;">Actividad Económica</th>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="actividad_economica" value="<?php echo $row["actividad_economica"] ?>">
                                        </div>
                                    </td>
                                    </tr>
                                    </tr>
                                    <th style="vertical-align: middle;">Perfil</th>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="nivel_educativo" value="<?php echo $row["nivel_educativo"] ?>">
                                        </div>
                                    </td>
                                    </tr>
                                    </tr>
                                    <th style="vertical-align: middle;">Correo</th>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="correo" value="<?php echo $row["correo"] ?>">
                                        </div>
                                    </td>
                                    </tr>
                                    </tr>
                                    <th style="vertical-align: middle;">Teléfono</th>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="telefono" value="<?php echo $row["telefono"] ?>">
                                        </div>
                                    </td>
                                    </tr>
                                </thead>
                            </table>
                            <br>
                            <input type="hidden" name="id_registro" value="<?php echo $id_registro ?>">
                            <button type="submit" class="btn btn-success">ACTUALIZAR INFORMACIÓN</button>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
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