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
$id_insertado = $_GET["id_pqrs"];
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
                                PQRS Radicada exitosamente
                            </h1>
                            <div class="page-header-subtitle">Ahora puedes imprimir el Sticker</div>
                        </div>

                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <form action="guardar_bd.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="tipo_transaccion" value="radicar_pqrs">
            <div class="container mt-n10">
                <div class="row">
                    <div class="col-lg-9">
                        <!-- Default Bootstrap Form Controls-->
                        <div id="default">
                            <div class="card mb-4">
                                <div class="card-header">Aquí los datos de la radicación de la PQRS</div>
                                <div class="card-body">
                                    <!-- Component Preview-->
                                    <div class="sbp-preview">
                                        <div class="sbp-preview-content">
                                            <?php
                                            //Traigo toda la información de la PQRS para imprimir el Sticker
                                            $sentencia = "select * from pqrs inner join funcionario on pqrs.fk_id_funcionario_delegado=funcionario.id_funcionario where id_pqrs = $id_insertado";
                                            $resultado = mysqli_query($con, $sentencia);
                                            $datos = mysqli_fetch_assoc($resultado);
                                            ?>
                                            Alcaldía de Sevilla<br>
                                            NIT: 800.100.527-0 <br>
                                            No. Radicado: <?php echo $datos["consecutivo_entrante"]; ?><br>
                                            Fecha y Hora: <?php echo $datos["fecha_radicacion"]; ?><br>
                                            Responsable: <?php echo $datos["nombre"]; ?><br>
                                            Asunto: <?php echo $datos["asunto"]; ?><br>
                                            Notas: <?php echo $datos["notas"]; ?><br>
                                        </div>
                                    </div>
                                    <div>
                                        <p></p>
                                    </div>
                                    <!-- Component Preview-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div>
            <p></p>
        </div>
    </main>
    <?php
    include("pie.php");
    ?>