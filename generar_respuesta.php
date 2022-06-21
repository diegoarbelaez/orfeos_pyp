<?php
include("conexion.php");
$id = $_GET["id"];
$nombre_tabla = "OrfeosFebrero";
$sentencia2 = "select * from $nombre_tabla where id=$id";
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

    <!-- EDITOR -->
    <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>


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
                                Generar una respuesta en PDF al ciudadano
                            </h1>
                            <div class="page-header-subtitle">Personaliza los datos</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="text-center mb-5">
            <div class="display-4 text-primary mb-2"><?php echo $row['REMITENTE']  ?> - <?php echo $row['NUMERO RADICADO']  ?></div>
        </div>
        <!-- Main page content-->
        <div class="row">
            <div class="card col-6">
                <div class="card-body">
                    <div class="card-body">
                        <h5 class="card-title">Preparar Respuesta</h5>
                        <form action="guardar_actualizacion_datos.php" method="POST">
                            <table class="table table-striped table-hover" id="dataTable2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="30%" style="vertical-align: middle;">Nombres</th>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="nombres" value="<?php echo $row['REMITENTE'] ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle;">No. Documento Identificación</th>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="documento" value="<?php echo $row["documento"] ?>">
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
                                    <th style="vertical-align: middle;">Correo</th>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="correo" value="<?php echo $row["correo"] ?>">
                                        </div>
                                        </tr>
                                    <th style="vertical-align: middle;">Ciudad</th>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="ciudad" value="<?php echo $row["ciudad"] ?>">
                                        </div>
                                    </td>
                                    </tr>
                                    </tr>
                                </thead>
                            </table>
                            <br>
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <button type="submit" class="btn btn-success">ACTUALIZAR INFORMACIÓN</button>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
            <div class="card col-6">
                <div class="card-body">
                    <div class="card-body">
                        <h5 class="card-title">Respuesta Personalizada</h5>
                        <h5 class="card-title">Clasificación:</h5>
                        <?php

                        $sentencia_consulta = "select * from $nombre_tabla where id=$id";
                        $resultado_consulta = mysqli_query($conexion, $sentencia_consulta);
                        $fila_clasificacion = mysqli_fetch_assoc($resultado_consulta);

                        $sentencia_respuesta = "select * from categorias where id_categoria=" . $fila_clasificacion["categoria"];
                        $resultado_respuesta = mysqli_query($conexion, $sentencia_respuesta);
                        $fila_respuesta = mysqli_fetch_assoc($resultado_respuesta);


                        switch ($fila_clasificacion["categoria"]) {
                            case 1:
                                echo '<td><a href="#" class="btn btn-info">SIN CLASIFICAR</a></td>';
                                break;
                            case 2:
                                echo '<td><a href="#" class="btn btn-dark">ENTES DE CONTROL</a></td>';
                                break;
                            case 3:
                                echo '<td><a href="#" class="btn btn-primary">OTRAS ENTIDADES</a></td>';
                                break;
                            case 4:
                                echo '<td><a href="#" class="btn btn-secondary">ACCESO A MI VACUNA</a></td>';
                                break;
                            case 5:
                                echo '<td><a href="#" class="btn btn-success">DATOS ERRADOS</a></td>';
                                break;
                            case 6:
                                echo '<td><a href="#" class="btn btn-danger">DOSIS INCOMPLETAS</a></td>';
                                break;
                            case 7:
                                echo '<td><a href="#" class="btn btn-warning">ERROR EN PDF</a></td>';
                                break;
                            case 8:
                                echo '<td><a href="#" class="btn btn-light">OTROS CASOS</a></td>';
                                break;
                        }
                        ?>
                        <br>
                        <br>
                        <form action="generador_respuesta_pdf.php" method="POST">
                            <table class="table table-striped table-hover" id="dataTable2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="30%" style="vertical-align: middle;">Plantilla de Respuesta</th>
                                        <td>

                                            <textarea id="editor" name="html_respuesta">

                                                <?php echo $fila_respuesta["texto_respuesta"] ?>

                                            </textarea>

                                        </td>
                                    </tr>
                                </thead>
                            </table>
                            <br>
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <button type="submit" class="btn btn-success">GENERAR RESPUESTA EN PDF</button>
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

    <script src="ckeditor.js"></script>


    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
    </script>
</body>

</html>