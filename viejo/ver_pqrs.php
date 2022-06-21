<?php session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<?php
include("conexion.php");
include("encabezado.php");
include("nav.php");
$id_pqrs = $_GET["id_pqrs"];
$sentencia = "select * from pqrs where id_pqrs=$id_pqrs";
$resultado = mysqli_query($con, $sentencia);
$fila = mysqli_fetch_assoc($resultado);
?>
<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="arrow-down-circle"></i></div>
                                Información de la PQRS
                            </h1>
                            <div class="page-header-subtitle">Detalles sobre esta solicitud</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container mt-n10">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Default Bootstrap Form Controls-->
                    <div id="default">
                        <div class="card mb-4">
                            <div class="card-header d-flex align-items-center">
                                <a class="btn btn-transparent-dark btn-icon" href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left">
                                        <line x1="19" y1="12" x2="5" y2="12"></line>
                                        <polyline points="12 19 5 12 12 5"></polyline>
                                    </svg></a>
                                <div class="ml-3">
                                    <h2 class="my-3">Información sobre esta PQRS</h2>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                $origen = $fila["origen"];
                                switch ($origen) {
                                    case 1:
                                ?>
                                        <p class="lead">La información aquí consignada correspondea la PQRS <b><?php echo $fila["consecutivo_entrante"] ?> </b></p>
                                        <p class="lead"></p>
                                        <p class="lead">
                                            <b>PQRS No: </b><?php echo $fila["consecutivo_entrante"] ?> <br>
                                            <b>Fecha de Radicación: </b><?php echo $fila["fecha_radicacion"] ?> <br>
                                            <b>Fecha Vencimiento: </b><?php echo $fila["fecha_fin"] ?> <br>
                                            <b>Nombre Remitente: </b><?php echo $fila["nombre_remitente"] ?> <br>
                                            <b>Entidad Remitente: </b><?php echo $fila["entidad_remitente"] ?> <br>
                                            <b>Dirección Remitente: </b><?php echo $fila["direccion_remitente"] ?> <br>
                                            <b>Asunto: </b><?php echo $fila["asunto"] ?> <br>
                                        </p>
                                        <p class="lead">Los archivos adjuntos de esta PQRS se pueden descargar en el siguiente Link:<b>
                                                <br>
                                                Click Aquí ->
                                                <?php
                                                $sentencia3 = "select * from adjuntos where fk_id_pqrs = $id_pqrs";
                                                $resultado3 = mysqli_query($con, $sentencia3);
                                                $fila3 = mysqli_fetch_assoc($resultado3);
                                                echo '<a href="../' . $fila3["url_archivo"] . '" target="blank">Ver Adjunto</a>';
                                                ?> </b>
                                        </p>
                                        <?php
                                        switch ($fila["estado"]) {
                                            case 1:
                                        ?>
                                                <div class="alert alert-danger alert-icon mb-0" role="alert">
                                                    <div class="alert-icon-aside"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle">
                                                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                                            <line x1="12" y1="9" x2="12" y2="13"></line>
                                                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                                        </svg></div>
                                                    <div class="alert-icon-content">
                                                        <h5 class="alert-heading">Alerta, ten cuidado</h5>
                                                        Esta PQRS no ha sido tomada por el responsable o delegado, no ha iniciado el proceso de respuesta. Debes alertarlos
                                                    </div>
                                                </div>
                                                <!-- Incluyo el formulario de actualizar PQRS -->
                                                <?php include("formulario_actualizar_pqrs.php") ?>



                                            <?php
                                                break;
                                            case 2:
                                            ?>
                                                <div class="alert alert-warning alert-icon mb-0" role="alert">
                                                    <div class="alert-icon-aside"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle">
                                                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                                            <line x1="12" y1="9" x2="12" y2="13"></line>
                                                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                                        </svg></div>
                                                    <div class="alert-icon-content">
                                                        <h5 class="alert-heading">En Proceso, Hacer Seguimiento</h5>
                                                        Esta PQRS ya se en cuentra en proceso de ser respondida por el responsable. Debes hacer seguimiento
                                                    </div>
                                                </div>
                                                <!-- Incluyo el formulario de actualizar PQRS -->
                                                <?php include("formulario_actualizar_pqrs.php") ?>

                                            <?php
                                                break;
                                            case 3:
                                            ?>
                                                <div class="alert alert-success alert-icon mb-0" role="alert">
                                                    <div class="alert-icon-aside"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle">
                                                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                                            <line x1="12" y1="9" x2="12" y2="13"></line>
                                                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                                        </svg></div>
                                                    <div class="alert-icon-content">
                                                        <h5 class="alert-heading">Ya Terminada</h5>
                                                        Esta PQRS fue satisfactoriamente respondida por el responsable.
                                                    </div>
                                                </div>
                                        <?php
                                                break;
                                        }
                                        break;
                                    case 2:
                                        ?>
                                        <p class="lead">La información aquí consignada correspondea la PQRS <b><?php echo $fila["consecutivo_entrante"] ?> </b></p>
                                        <p class="lead"></p>
                                        <p class="lead">
                                            <b>PQRS No: </b><?php echo $fila["consecutivo_saliente"] ?> <br>
                                            <b>Fecha de Radicación: </b><?php echo $fila["fecha_radicacion"] ?> <br>
                                            <b>Destinatario: </b><?php echo $fila["destinatario"] ?> <br>
                                            <b>Entidad Destinatario: </b><?php echo $fila["entidad_destinatario"] ?> <br>
                                            <b>Dirección Destinatario: </b><?php echo $fila["direccion_destinatario"] ?> <br>
                                            <b>Teléfono Destinatario: </b><?php echo $fila["telefono_destinatario"] ?> <br>
                                            <b>Cedula Destinatario: </b><?php echo $fila["cedula_destinatario"] ?> <br>
                                            <b>Asunto: </b><?php echo $fila["asunto"] ?> <br>
                                            <b>Notas: </b><?php echo $fila["notas"] ?> <br>
                                        </p>
                                        <p class="lead">Los archivos adjuntos de esta PQRS se pueden descargar en el siguiente Link:<b>
                                                <br>
                                                Click Aquí ->
                                                <?php
                                                $sentencia3 = "select * from adjuntos where fk_id_pqrs = $id_pqrs";
                                                $resultado3 = mysqli_query($con, $sentencia3);
                                                $fila3 = mysqli_fetch_assoc($resultado3);
                                                echo '<a href="../' . $fila3["url_archivo"] . '" target="blank">Ver Adjunto</a>';
                                                ?> </b>
                                        </p>
                                        <?php
                                        switch ($fila["estado"]) {
                                            case 1:
                                        ?>
                                                <div class="alert alert-danger alert-icon mb-0" role="alert">
                                                    <div class="alert-icon-aside"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle">
                                                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                                            <line x1="12" y1="9" x2="12" y2="13"></line>
                                                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                                        </svg></div>
                                                    <div class="alert-icon-content">
                                                        <h5 class="alert-heading">Alerta, ten cuidado</h5>
                                                        Esta PQRS no ha sido tomada por el responsable o delegado, no ha iniciado el proceso de respuesta. Debes alertarlos
                                                    </div>
                                                </div>
                                                <!-- Incluyo el formulario de actualizar PQRS -->
                                                <?php include("formulario_actualizar_pqrs.php") ?>

                                            <?php
                                                break;
                                            case 2:
                                            ?>
                                                <div class="alert alert-warning alert-icon mb-0" role="alert">
                                                    <div class="alert-icon-aside"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle">
                                                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                                            <line x1="12" y1="9" x2="12" y2="13"></line>
                                                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                                        </svg></div>
                                                    <div class="alert-icon-content">
                                                        <h5 class="alert-heading">En Proceso, Hacer Seguimiento</h5>
                                                        Esta PQRS ya se en cuentra en proceso de ser respondida por el responsable. Debes hacer seguimiento
                                                    </div>
                                                </div>
                                                <!-- Incluyo el formulario de actualizar PQRS -->
                                                <?php include("formulario_actualizar_pqrs.php") ?>

                                            <?php
                                                break;
                                            case 3:
                                            ?>
                                                <div class="alert alert-success alert-icon mb-0" role="alert">
                                                    <div class="alert-icon-aside"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle">
                                                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                                            <line x1="12" y1="9" x2="12" y2="13"></line>
                                                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                                        </svg></div>
                                                    <div class="alert-icon-content">
                                                        <h5 class="alert-heading">Ya Terminada</h5>
                                                        Esta PQRS fue satisfactoriamente respondida por el responsable.
                                                    </div>
                                                </div>
                                        <?php
                                                break;
                                        }
                                        break;
                                    case 3:
                                        ?>
                                        <p class="lead">La información aquí consignada correspondea la PQRS <b><?php echo $fila["consecutivo_interdependencias"] ?> </b></p>
                                        <p class="lead"></p>
                                        <p class="lead">
                                            <b>PQRS No: </b><?php echo $fila["consecutivo_interdependencias"] ?> <br>
                                            <b>Fecha de Radicación: </b><?php echo $fila["fecha_radicacion"] ?> <br>
                                            <b>Remitente: </b>
                                            <?php
                                            $sentencia_destinatario = "select * from funcionario where id_funcionario=" . $fila["fk_id_funcionario_delegado"];
                                            $resultado_destinatario = mysqli_query($con, $sentencia_destinatario);
                                            $fila_destinatario = mysqli_fetch_assoc($resultado_destinatario);
                                            echo $fila_destinatario["nombre"]
                                            ?> <br>
                                            <b>Destinatario: </b>
                                            <?php
                                            $sentencia_remitente = "select * from funcionario where id_funcionario=" . $fila["fk_id_funcionario_remitente"];
                                            $resultado_remitente = mysqli_query($con, $sentencia_remitente);
                                            $fila_remitente = mysqli_fetch_assoc($resultado_remitente);
                                            echo $fila_remitente["nombre"];
                                            ?> <br> <b>Asunto: </b><?php echo $fila["asunto"] ?> <br>
                                            <b>Notas: </b><?php echo $fila["notas"] ?> <br>
                                        </p>
                                        <p class="lead">Los archivos adjuntos de esta PQRS se pueden descargar en el siguiente Link:<b>
                                                <br>
                                                Click Aquí ->
                                                <?php
                                                $sentencia3 = "select * from adjuntos where fk_id_pqrs = $id_pqrs";
                                                $resultado3 = mysqli_query($con, $sentencia3);
                                                $fila3 = mysqli_fetch_assoc($resultado3);
                                                echo '<a href="../' . $fila3["url_archivo"] . '" target="blank">Ver Adjunto</a>';
                                                ?> </b>
                                        </p>
                                        <?php
                                        switch ($fila["estado"]) {
                                            case 1:
                                        ?>
                                                <div class="alert alert-danger alert-icon mb-0" role="alert">
                                                    <div class="alert-icon-aside"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle">
                                                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                                            <line x1="12" y1="9" x2="12" y2="13"></line>
                                                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                                        </svg></div>
                                                    <div class="alert-icon-content">
                                                        <h5 class="alert-heading">Alerta, ten cuidado</h5>
                                                        Esta PQRS no ha sido tomada por el responsable o delegado, no ha iniciado el proceso de respuesta. Debes alertarlos
                                                    </div>
                                                </div>

                                                <!-- Incluyo el formulario de actualizar PQRS -->
                                                <?php include("formulario_actualizar_pqrs.php") ?>

                                            <?php
                                                break;
                                            case 2:
                                            ?>
                                                <div class="alert alert-warning alert-icon mb-0" role="alert">
                                                    <div class="alert-icon-aside"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle">
                                                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                                            <line x1="12" y1="9" x2="12" y2="13"></line>
                                                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                                        </svg></div>
                                                    <div class="alert-icon-content">
                                                        <h5 class="alert-heading">En Proceso, Hacer Seguimiento</h5>
                                                        Esta PQRS ya se en cuentra en proceso de ser respondida por el responsable. Debes hacer seguimiento
                                                    </div>
                                                </div>
                                                <!-- Incluyo el formulario de actualizar PQRS -->
                                                <?php include("formulario_actualizar_pqrs.php") ?>

                                            <?php
                                                break;
                                            case 3:
                                            ?>
                                                <div class="alert alert-success alert-icon mb-0" role="alert">
                                                    <div class="alert-icon-aside"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle">
                                                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                                            <line x1="12" y1="9" x2="12" y2="13"></line>
                                                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                                        </svg></div>
                                                    <div class="alert-icon-content">
                                                        <h5 class="alert-heading">Ya Terminada</h5>
                                                        Esta PQRS fue satisfactoriamente respondida por el responsable.
                                                    </div>
                                                </div>
                                <?php
                                                break;
                                        }
                                        break;
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-6 mb-4">
                    <div class="card card-header-actions h-100">
                        <div class="card-header">
                            Trazabilidad de la PQRS
                        </div>
                        <div class="card-body">
                            <div class="timeline timeline-xs">
                                <!-- Timeline Item 1-->
                                <?php
                                $sentencia_eventos = "select * from log where fk_id_pqrs=" . $id_pqrs;
                                $resultado_eventos = mysqli_query($con, $sentencia_eventos);
                                while ($fila_eventos = mysqli_fetch_assoc($resultado_eventos)) {
                                ?>
                                    <div class="timeline-item">
                                        <div class="timeline-item-marker">
                                            <div class="timeline-item-marker-text" style="width: 122px;"><?php echo $fila_eventos["fecha"] ?></div>
                                            <div class="timeline-item-marker-indicator bg-green"></div>
                                        </div>
                                        <div class="timeline-item-content">
                                        <?php echo $fila_eventos["comentario"] ?>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <!-- Timeline Item 2-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <p></p>
        </div>
    </main>
    <?php
    include("pie.php");
    ?>