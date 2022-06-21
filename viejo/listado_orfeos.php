<?php
include("conexion.php");
$sentencia = "select count(*) as resultado from orfeos";
$resultado = mysqli_query($conexion, $sentencia);
$fila = mysqli_fetch_assoc($resultado);
$sentencia2 = "select * from orfeos";
$resultado2 = mysqli_query($conexion, $sentencia2);
$row = mysqli_fetch_assoc($resultado2);
//$id_session = '220203071303o172162226';
$id_session = '';

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
                                Consultas de Orfeos MSPS
                            </h1>
                            <div class="page-header-subtitle">Casos descargados - 2/2/22 22:25h</div>
                        </div>
                        <!-- <div class="col-auto mt-4">
                            <div class="form-group">
                                <form action="listado_orfeos.php" method="POST">
                                    <label>Session ID</label>
                                    <input type="text" class="form-control" name="sesion" value="<?php echo $id_session; ?>">
                                    <input type="submit" class="btn btn-primary" name="guardar_sesion" value="Guardar" style="margin-top: 10px;">
                                </form>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </header>
        <div class="text-center mb-5">
            <div class="display-4 text-primary mb-2">Casos del CDV <i class="far fa-edit"></i></div>
            <div class="display-4"><?php
                                    $sentencia_cargados = "select count(*) as total_casos from orfeos";
                                    $resultado_cargados = mysqli_query($conexion, $sentencia_cargados);
                                    $fila_cargados = mysqli_fetch_assoc($resultado_cargados);
                                    echo $fila_cargados["total_casos"];
                                    ?> Hasta el momento</div>
        </div>
        <!-- Main page content-->
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-body">
                    <h5 class="card-title">Listado de Clasificaciones</h5>
                    <div>
                        <a href="index2.php" target="new" class="btn btn-info">LISTADO GENERAL</a>
                        <a href="listado_novedades.php" target="new" class="btn btn-dark">ENTES DE CONTROL</a>
                        <a href="listado_novedades.php" target="new" class="btn btn-primary">OTRAS ENTIDADES</a>
                        <a href="listado_documentos_cargados.php" target="new" class="btn btn-secondary">NO PUEDO ACCEDER A MI VACUNA</a>
                        <a href="listado_clasifica.php" target="new" class="btn btn-success">DATOS DE IDENTIFICACION ERRADOS</a>
                        <a href="listado_noclasifica.php" target="new" class="btn btn-danger">DOSIS ERRADAS O INCOMPLETAS</a>
                        <a href="listado_faltan.php" target="new" class="btn btn-warning">NO GENERA EL PDF</a>
                        <a href="listado_novedades.php" target="new" class="btn btn-primary">OTROS CASOS</a>

                        <br>
                        <br>
                    </div>
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Número Radicado</th>
                            <th>Fecha Radicado</th>
                            <th>Asunto</th>
                            <th>Remitente</th>
                            <th>Tipo de Documento</th>
                            <th>Días Restantes</th>
                            <th>Enviado por</th>
                            <th>Ver Caso</th>
                        </tr>
                        <?php
                        $sql = mysqli_query($conexion, "SELECT * from orfeos order by 'FECHA RADICADO' DESC");
                        if (mysqli_num_rows($sql) == 0) {
                            echo '<tr><td colspan="8">No hay datos.</td></tr>';
                        }
                        $elementosxpagina = 500;
                        $total_elementos = mysqli_num_rows($sql);
                        $paginas = ceil($total_elementos / $elementosxpagina);
                        if (!$_GET) {
                        ?>
                            <script type="text/javascript">
                                window.location = "listado_orfeos.php?pagina=1";
                            </script>
                        <?php
                        } else {
                            $iniciar = ($_GET['pagina'] - 1) * $elementosxpagina;
                            $sql = mysqli_query($conexion, "SELECT * from orfeos order by 'FECHA RADICADO' DESC LIMIT " . $iniciar . "," . $elementosxpagina);
                            while ($row = mysqli_fetch_assoc($sql)) {
                                echo '
                                <tr>
                                <td> ' . $row['id'] . '</a></td>
                                <td>' . $row['NUMERO RADICADO'] . '</td>
                                <td>' . $row['FECHA RADICADO'] . '</td>
                                <td>' . $row['ASUNTO'] . '</td>
                                <td>' . $row['REMITENTE'] . '</td>
                                <td>' . $row['TIPO DOCUMENTO'] . '</td>
                                <td>' . $row['DIAS RESTANTES'] . '</td>
                                <td>' . $row['ENVIADO POR'] . '</td>
                                <td>' . "<a href='https://orfeo.minsalud.gov.co/orfeo/linkArchivo.php?&PHPSESSID=" . $id_session . "CERTIFICAVACUNACOVID&numrad=" . $row['NUMERO RADICADO'] . "' target='_blank'>Ver Caso</a>" . '</td>';
                            }
                        }
                        ?>
                    </table>
                    <!-- PAGINADOR -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="listado_orfeos.php?pagina=<?php echo $_GET['pagina'] - 1 ?>">
                                    Anterior
                                </a>
                            </li>
                            <?php for ($i = 0; $i < $paginas; $i++) : ?>
                                <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>"><a class="page-link" href="listado_orfeos.php?pagina=<?php echo $i + 1  ?>"><?php echo $i + 1  ?></a></li>
                            <?php endfor ?>
                            <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>">
                                <a class="page-link" href="listado_orfeos.php?pagina=<?php echo $_GET['pagina'] + 1 ?>">
                                    Siguiente
                                </a>
                            </li>
                        </ul>
                    </div>
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
                "pageLength": 50,
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