<?php session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php
include("conexion.php");
include("encabezado.php");
include("nav.php");
?>
<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="arrow-up-circle"></i></div>
                                Radicar PQRSD Saliente
                            </h1>
                            <div class="page-header-subtitle">Radicar una solicitud o respuesta a un ciudadano o entidad</div>
                        </div>

                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <form action="guardar_bd.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="tipo_transaccion" value="enviar_pqrs">
            <div class="container mt-n10">
                <div class="row">
                    <div class="col-lg-9">
                        <!-- Default Bootstrap Form Controls-->
                        <div id="default">
                            <div class="card mb-4">
                                <div class="card-header">Por favor diligencia La información a quien se envía la comunicación o solicitud</div>
                                <div class="card-body">
                                    <!-- Component Preview-->

                                    <div class="sbp-preview">
                                        <div class="sbp-preview-content">
                                            <table>
                                                <tr>
                                                    <td width="50%">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Nombre del destinatario</label>
                                                            <input name="nombre_destinatario" class="form-control" id="exampleFormControlInput1" type="text" required>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Cédula o NIT del destinatario</label>
                                                            <input name="cedula_destinatario" class="form-control" id="exampleFormControlInput1" type="text">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Empresa o Entidad</label>
                                                            <input name="entidad_destinatario" class="form-control" id="exampleFormControlInput1" type="text">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table>
                                                <tr>
                                                    <td width="50%">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Asunto</label>
                                                            <input name="asunto" class="form-control" id="exampleFormControlInput1" type="text" required>
                                                        </div>
                                                    </td>
                                                    <td width="25%">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Dirección del Destinatario</label>
                                                            <input name="direccion_destinatario" class="form-control" id="exampleFormControlInput1" type="text">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1">Teléfono de Quien Radica</label>
                                                            <input name="telefono_destinatario" class="form-control" id="exampleFormControlInput1" type="text" required>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="default">
                            <div class="card mb-4">
                                <div class="card-header">Por favor diligencia La información de quien envía la comunicación o solicitud</div>
                                <div class="card-body">
                                    <!-- Component Preview-->
                                    <div class="sbp-preview">
                                        <div class="sbp-preview-content">
                                            <table>
                                                <tr>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Secretarios de Despacho - Funcionario Principal</label>
                                                        <select class="form-control" id="exampleFormControlSelect1" name="funcionario_delegado">
                                                            <?php
                                                            $sentencia = "select funcionario.nombre as nombrefuncionario, funcionario.id_funcionario as idfuncionario, dependencia.nombre as nombredependencia from funcionario inner join dependencia on dependencia.id_dependencia = funcionario.fk_id_dependencia where funcionario.tipo in (1,2,3)";
                                                            $resultado = mysqli_query($con, $sentencia);
                                                            while ($datos = mysqli_fetch_assoc($resultado)) {
                                                            ?>
                                                                <option value="<?php echo $datos["idfuncionario"]; ?>"><?php echo $datos["nombrefuncionario"] . " - " . $datos["nombredependencia"] ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </tr>
                                            </table>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Tipo de Petición</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="tipo">
                                                    <option value="1">Petición de Interés General</option>
                                                    <option value="2">Petición de Interés Particular</option>
                                                    <option value="3">Petición de Información</option>
                                                    <option value="4">Petición de Documentos</option>
                                                    <option value="5">Petición de consulta</option>
                                                    <option value="6">Queja</option>
                                                    <option value="7">Sugerencia</option>
                                                    <option value="8">Denuncia</option>
                                                    <option value="9">Reconocimientos</option>
                                                    <option value="10">Reclamos</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Notas Adicionales</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="notas"></textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="default">
                            <div class="card mb-4">
                                <div class="card-header">Por favor escanea y carga el archivo como formato PDF</div>
                                <div class="card-body">
                                    <div class="sbp-preview">
                                        <div class="sbp-preview-content">
                                            <div class="custom-file">
                                                <input type="file" class="file-custom" id="adjunto" name="adjunto">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p></p>
                                        <button class="btn btn-blue" width="100%" type="submit">CARGAR ARCHIVO Y GENERAR PQRS</button>
                                    </div>
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