<?php
include("conexion.php");
$id_funcionario = $_SESSION["id_funcionario"];
//Obtengo la dependencia del usuario que está consultando
$sentencia_pqrs = "select * from funcionario where id_funcionario = $id_funcionario";
$resultado_pqrs = mysqli_query($con,$sentencia_pqrs);
$fila_funcionario = mysqli_fetch_assoc($resultado_pqrs);
$dependencia= $fila_funcionario["fk_id_dependencia"];
?>

<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="activity"></i></div>
                                Dashboard
                            </h1>
                            <div class="page-header-subtitle">Aquí puedes ver información sobre las PQRSD</div>
                        </div>
                        <div class="col-12 col-xl-auto mt-4">

                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container mt-n10">
            <div class="row">
               
                <div class="col-xxl-4 col-lg-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-3">
                                    <div class="text-white-75 small">PQRS Sin atender</div>
                                    <div class="text-lg font-weight-bold">
                                        <?php
                                        $sentencia_sin = "select count(*) as total_sin from pqrs where estado = 1 and fk_id_dependencia = $dependencia";
                                        $resultado_sin = mysqli_query($con,$sentencia_sin);
                                        $fila_sin = mysqli_fetch_assoc($resultado_sin);
                                        echo $fila_sin["total_sin"];
                                        ?>
                                    </div>
                                </div>
                                <i class="fas fa-exclamation-triangle fa-2x"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">Visualizarlas</a>
                            <div class="small text-white"><svg class="svg-inline--fa fa-angle-right fa-w-8" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z"></path>
                                </svg><!-- <i class="fas fa-angle-right"></i> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-3">
                                    <div class="text-white-75 small">PQRS En proceso</div>
                                    <div class="text-lg font-weight-bold">
                                    <?php
                                        $sentencia_sin = "select count(*) as total_sin from pqrs where estado = 2 and fk_id_dependencia = $dependencia";
                                        $resultado_sin = mysqli_query($con,$sentencia_sin);
                                        $fila_sin = mysqli_fetch_assoc($resultado_sin);
                                        echo $fila_sin["total_sin"];
                                        ?>
                                    </div>
                                </div>
                                <i class="far fa-clock fa-2x"></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">Visualizarlas</a>
                            <div class="small text-white"><svg class="svg-inline--fa fa-angle-right fa-w-8" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z"></path>
                                </svg><!-- <i class="fas fa-angle-right"></i> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-3">
                                    <div class="text-white-75 small">PQRS Resueltas</div>
                                    <div class="text-lg font-weight-bold">
                                    <?php
                                        $sentencia_sin = "select count(*) as total_sin from pqrs where estado = 3 and fk_id_dependencia = $dependencia";
                                        $resultado_sin = mysqli_query($con,$sentencia_sin);
                                        $fila_sin = mysqli_fetch_assoc($resultado_sin);
                                        echo $fila_sin["total_sin"];
                                        ?>
                                    </div>
                                </div>
                                <i class="fas fa-check fa-2x" ></i>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">Visualizarlas</a>
                            <div class="small text-white"><svg class="svg-inline--fa fa-angle-right fa-w-8" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg="">
                                    <path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z"></path>
                                </svg><!-- <i class="fas fa-angle-right"></i> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Example Colored Cards for Dashboard Demo-->
            <!-- Example DataTable for Dashboard Demo-->
            <div class="card mb-4">
                <div class="card-header">PQRS Recientes</div>
                <div class="card-body">
                    <div class="datatable">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Origen</th>
                                    <th>Consecutivo</th>
                                    <th>Dependencia</th>
                                    <th>Responsable</th>
                                    <th>Líder</th>
                                    <th>Fecha Radicación</th>
                                    <th>Fecha Vencimiento</th>
                                    <th>Estado</th>
                                    <th>Asunto</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sentencia = "SELECT pqrs.asunto as asunto, pqrs.id_pqrs as id_pqrs, pqrs.origen as origen, pqrs.fecha_radicacion as fecha_radicacion, pqrs.fecha_fin as fecha_fin, pqrs.consecutivo_entrante as consecutivo_entrante, pqrs.consecutivo_saliente as consecutivo_saliente, pqrs.consecutivo_interdependencias as consecutivo_interdependencias, pqrs.estado as estado, dependencia.nombre as nombre_dependencia, funcionario.nombre as responsable, pqrs.fk_id_funcionario_notificado as lider FROM `pqrs` INNER JOIN funcionario on pqrs.fk_id_funcionario_delegado = funcionario.id_funcionario INNER JOIN dependencia on pqrs.fk_id_dependencia=dependencia.id_dependencia  where pqrs.fk_id_dependencia = $dependencia order by id_pqrs DESC";
                                $resultado = mysqli_query($con, $sentencia);
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                ?> <tr>
                                        <td><?php echo '<a href="ver_pqrs.php?id_pqrs=' . $fila["id_pqrs"] . '" target=blank>' . $fila["id_pqrs"] . '</a>'; ?> </td>
                                        <?php
                                        switch ($fila["origen"]) {
                                            case 1:
                                                echo '<td>Entrante</td><td>' . $fila["consecutivo_entrante"] . '</td>';
                                                break;
                                            case 2:
                                                echo '<td>Saliente</td><td>' . $fila["consecutivo_saliente"] . '</td>';
                                                break;
                                            case 3:
                                                echo '<td>Interdependencias</td><td>' . $fila["consecutivo_interdependencias"] . '</td>';
                                                break;
                                        }
                                        ?>
                                        <td> <?php echo $fila["nombre_dependencia"]; ?></td>
                                        <td> <?php echo $fila["responsable"]; ?></td>
                                        <td>
                                            <?php
                                            if ($fila["lider"] != NULL) {
                                                $sentencia2 = "select * from funcionario where id_funcionario =" . $fila["lider"];
                                                $resultado2 = mysqli_query($con, $sentencia2);
                                                $fila2 = mysqli_fetch_assoc($resultado2);
                                                echo $fila2["nombre"];
                                            } else {
                                                echo "N/A";
                                            }
                                            ?></td>
                                        <td> <?php echo $fila["fecha_radicacion"]; ?></td>
                                        <td> <?php echo $fila["fecha_fin"]; ?></td>
                                        <td>
                                            <?php
                                            switch ($fila["estado"]) {
                                                case 1:
                                                    echo '<div class="badge badge-danger badge-pill">No Iniciada</div>';
                                                    break;
                                                case 2:
                                                    echo '<div class="badge badge-warning badge-pill">En Trámite</div>';
                                                    break;
                                                case 3:
                                                    echo '<div class="badge badge-success badge-pill">Cerrada</div>';
                                                    break;
                                            }
                                            ?></td>
                                        <td> <?php echo $fila["asunto"]; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer mt-auto footer-light">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 small">Alcaldía de Sevilla Valle &copy; Todos los derechos reservados</div>
                <div class="col-md-6 text-md-right small">
                    <a href="http://www.sevilla-valle.gov.co/">Política de Privacidad</a>
                    &middot;
                    <a href="http://www.sevilla-valle.gov.co/politicas/">Términos y Condiciones</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <!-- <script src="assets/demo/datatables-demo.js"></script> -->
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/date-range-picker-demo.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "pageLength": 100,
                "order": [
                    [0, "desc"]
                ],
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
                }
            });
        });
    </script>


</div>
</div>