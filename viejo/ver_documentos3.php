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
    <script src="jquery-3.5.1.min.js" crossorigin="anonymous"></script>
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
        <?php
        include("conexion.php");
        $id_registro = $_GET["id_registro"];
        $sentencia2 = "select * from registro_micasa where id_registro=$id_registro";
        $resultado2 = mysqli_query($conexion, $sentencia2);
        if (mysqli_num_rows($resultado2) > 0) {
            $row = mysqli_fetch_assoc($resultado2);
            $tipo = $row["tipo_perfil"];
            $id_registro = $row["id_registro"];
        ?>
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
                            <h5 class="card-title">Información del Ciudadano</h5>
                            <table class="table table-striped table-hover" id="dataTable2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="30%">Nombres</th>
                                        <td><?php echo $row["nombres"] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Apellidos</th>
                                        <td><?php echo $row["apellidos"] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Cedula</th>
                                        <td><?php echo $row["cedula"] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Dirección</th>
                                        <td><?php echo $row["direccion"] ?></td>
                                    </tr>
                                    <th>Teléfono</th>
                                    <td><?php echo $row["telefono"] ?></td>
                                    </tr>
                                    </tr>
                                    <th>Fecha de Nacimiento</th>
                                    <td><?php echo $row["fecha_nacimiento"] ?></td>
                                    </tr>
                                    </tr>
                                    <th>Actividad Económica</th>
                                    <td><?php echo $row["actividad_economica"] ?></td>
                                    </tr>
                                    </tr>
                                    <th>Perfil</th>
                                    <td><?php echo $tipo_perfil ?></td>
                                    </tr>
                                    </tr>
                                    <th>Nivel Educativo</th>
                                    <td><?php echo $row["nivel_educativo"] ?></td>
                                    </tr>
                                    </tr>
                                    <th>Vivienda Propia</th>
                                    <td><?php echo $row["vivienda_propia"] ?></td>
                                    </tr>
                                    <th>
                                        <p style="color: red;">ESTADO DE LA APROBACIÓN</p>
                                    </th>
                                    <td>
                                        <p style="color: red;"><?php echo $row["clasificacion"] ?></p>
                                    </td>
                                    </tr>
                                </thead>
                            </table>
                            <br>
                        </div>
                    </div>
                    <!-- Detailed pricing example-->
                </div>
                <?php

                switch ($tipo) {
                    case 0:
                ?>
                        <div class="card col-6">
                            <div class="card-body">
                                <div class="card-body">
                                    <h5 class="card-title">Documentos Cargados</h5>
                                    <table class="table table-striped table-hover" id="dataTable2" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="80%">Fotocopia de la Cédula</th>
                                                <td><a href="<?php echo "../" . $row["documento1"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Certificado Laboral no mayor a 2 meses</th>
                                                <td><a href="<?php echo "../" . $row["documento2"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Colillas de Pago de los últimos 3 meses</th>
                                                <?php
                                                if (!empty($row["documento3"])) {
                                                    echo '
                                                <td><a href="../' . $row["documento3"] . '" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>';
                                                } else {
                                                    echo "<td>No cargado</td>";
                                                }
                                                ?>
                                            </tr>
                                            <tr>
                                                <th>Extractos bancarios de los últimos 3 meses</th>
                                                <?php
                                                if (!empty($row["documento4"])) {
                                                    echo '
                                                <td><a href="../' . $row["documento4"] . '" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>';
                                                } else {
                                                    echo "<td>No cargado</td>";
                                                }
                                                ?>
                                            </tr>
                                            <th>Declaración de Renta</th>
                                            <?php
                                            if (!empty($row["documento5"])) {
                                                echo '
                                                <td><a href="../' . $row["documento4"] . '" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>';
                                            } else {
                                                echo "<td>No cargado</td>";
                                            }
                                            ?> </tr>
                                        </thead>
                                    </table>
                                    <br>
                                </div>
                            </div>
                        </div>

                    <?php
                        break;
                    case 1:
                    ?>
                        <div class="card col-6">
                            <div class="card-body">
                                <div class="card-body">
                                    <h5 class="card-title">Documentos Cargados</h5>
                                    <table class="table table-striped table-hover" id="dataTable2" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="80%">Fotocopia de la Cédula</th>
                                                <td><a href="<?php echo "../" . $row["documento1"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Certificado de prestación de servicios</th>
                                                <td><a href="<?php echo "../" . $row["documento2"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Extractos bancarios de los últimos 3 meses</th>
                                                <?php
                                                if (!empty($row["documento3"])) {
                                                    echo '
                                                <td><a href="../' . $row["documento3"] . '" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>';
                                                } else {
                                                    echo "<td>No cargado</td>";
                                                }
                                                ?>
                                            </tr>
                                            <tr>
                                                <th>Declaración de Renta</th>
                                                <?php
                                                if (!empty($row["documento4"])) {
                                                    echo '
                                                <td><a href="../' . $row["documento4"] . '" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>';
                                                } else {
                                                    echo "<td>No cargado</td>";
                                                }
                                                ?>
                                            </tr>
                                            </tr>
                                        </thead>
                                    </table>
                                    <br>

                                </div>
                            </div>
                        </div>
                    <?php
                        break;
                    case 2:
                    ?>
                        <div class="card col-6">
                            <div class="card-body">
                                <div class="card-body">
                                    <h5 class="card-title">Documentos Cargados</h5>
                                    <table class="table table-striped table-hover" id="dataTable2" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="80%">Fotocopia de la Cédula</th>
                                                <td><a href="<?php echo "../" . $row["documento1"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Copia de la Resolución</th>
                                                <td><a href="<?php echo "../" . $row["documento2"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Colillas de pago de los últimos 3 meses</th>
                                                <td><a href="<?php echo "../" . $row["documento3"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Declaración de Renta</th>
                                                <?php
                                                if (!empty($row["documento4"])) {
                                                    echo '
                                                <td><a href="../' . $row["documento4"] . '" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>';
                                                } else {
                                                    echo "<td>No cargado</td>";
                                                }
                                                ?>
                                            </tr>
                                            </tr>
                                        </thead>
                                    </table>
                                    <br>

                                </div>
                            </div>
                        </div>
                    <?php
                        break;
                    case 3:
                    ?>
                        <div class="card col-6">
                            <div class="card-body">
                                <div class="card-body">
                                    <h5 class="card-title">Documentos Cargados</h5>
                                    <table class="table table-striped table-hover" id="dataTable2" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="80%">Fotocopia de la Cédula</th>
                                                <td><a href="<?php echo "../" . $row["documento1"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Certificado de tradición no mayor a 30 días</th>
                                                <td><a href="<?php echo "../" . $row["documento2"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Contrato de Arrendamiento o Certificación de la Inmobiliaria</th>
                                                <td><a href="<?php echo "../" . $row["documento3"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Extractos bancarios de los últimos 3 meses</th>
                                                <td><a href="<?php echo "../" . $row["documento4"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <th>Declaración de Renta</th>
                                            <?php
                                            if (!empty($row["documento5"])) {
                                                echo '
                                                <td><a href="../' . $row["documento5"] . '" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>';
                                            } else {
                                                echo "<td>No cargado</td>";
                                            }
                                            ?>
                                            </tr>
                                        </thead>
                                    </table>
                                    <br>

                                </div>
                            </div>
                        </div>
                    <?php
                        break;
                    case 4:
                    ?>
                        <div class="card col-6">
                            <div class="card-body">
                                <div class="card-body">
                                    <h5 class="card-title">Documentos Cargados</h5>
                                    <table class="table table-striped table-hover" id="dataTable2" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="80%">Fotocopia de la Cédula</th>
                                                <td><a href="<?php echo "../" . $row["documento1"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>RUT</th>
                                                <td><a href="<?php echo "../" . $row["documento2"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Cámara de Comercio no mayor a 30 días</th>
                                                <td><a href="<?php echo "../" . $row["documento3"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Estados Financieros de los dos últimos años</th>
                                                <td><a href="<?php echo "../" . $row["documento4"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Extractos bancarios de los últimos 3 meses</th>
                                                <td><a href="<?php echo "../" . $row["documento5"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Declaración de Renta</th>
                                                <?php
                                                if (!empty($row["documento6"])) {
                                                    echo '
                                                <td><a href="../' . $row["documento6"] . '" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>';
                                                } else {
                                                    echo "<td>No cargado</td>";
                                                }
                                                ?>
                                            </tr>
                                            <tr>
                                                <th>Referencias Comerciales</th>
                                                <?php
                                                if (!empty($row["documento7"])) {
                                                    echo '
                                                <td><a href="../' . $row["documento7"] . '" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>';
                                                } else {
                                                    echo "<td>No cargado</td>";
                                                }
                                                ?>
                                            </tr>
                                        </thead>
                                    </table>
                                    <br>
                                </div>
                            </div>
                        </div>
                    <?php
                        break;
                    case 5:
                    ?>
                        <div class="card col-6">
                            <div class="card-body">
                                <div class="card-body">
                                    <h5 class="card-title">Documentos Cargados</h5>
                                    <table class="table table-striped table-hover" id="dataTable2" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="80%">Fotocopia de la Cédula</th>
                                                <td><a href="<?php echo "../" . $row["documento1"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Certificado de la Empresa donde está afiliado el vehículo</th>
                                                <td><a href="<?php echo "../" . $row["documento2"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Tarjeta de Propiedad de los vehículos</th>
                                                <td><a href="<?php echo "../" . $row["documento3"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Extractos Bancarios de los últimos 3 meses</th>
                                                <td><a href="<?php echo "../" . $row["documento4"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <th>Declaración de Renta</th>
                                            <?php
                                            if (!empty($row["documento5"])) {
                                                echo '
                                                <td><a href="../' . $row["documento5"] . '" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>';
                                            } else {
                                                echo "<td>No cargado</td>";
                                            }
                                            ?> </tr>
                                        </thead>
                                    </table>
                                    <br>

                                </div>
                            </div>
                        </div>
                    <?php
                        break;
                    case 6:
                    ?>
                        <div class="card col-6">
                            <div class="card-body">
                                <div class="card-body">
                                    <h5 class="card-title">Documentos Cargados</h5>
                                    <table class="table table-striped table-hover" id="dataTable2" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="80%">Fotocopia de la Cédula</th>
                                                <td><a href="<?php echo "../" . $row["documento1"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Certificado laboral no mayor de 2 meses</th>
                                                <td><a href="<?php echo "../" . $row["documento2"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Colilla de pago, (certificado de ingresos)</th>
                                                <td><a href="<?php echo "../" . $row["documento3"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Tarjeta de propiedad del vehículo</th>
                                                <td><a href="<?php echo "../" . $row["documento4"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Certificado de la empresa donde está afiliado</th>
                                                <td><a href="<?php echo "../" . $row["documento5"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Extractos Bancarios de los últimos 3 meses</th>
                                                <td><a href="<?php echo "../" . $row["documento6"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                        </thead>
                                    </table>
                                    <br>

                                </div>
                            </div>
                        </div>
                    <?php
                        break;
                    case 7:
                    ?>
                        <div class="card col-6">
                            <div class="card-body">
                                <div class="card-body">
                                    <h5 class="card-title">Documentos Cargados</h5>
                                    <table class="table table-striped table-hover" id="dataTable2" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="80%">Fotocopia de la Cédula</th>
                                                <td><a href="<?php echo "../" . $row["documento1"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Certificación de clientes y proveedores, antiuedad 2 años</th>
                                                <td><a href="<?php echo "../" . $row["documento2"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>RUT</th>
                                                <td><a href="<?php echo "../" . $row["documento3"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Certificado de Ingresos</th>
                                                <td><a href="<?php echo "../" . $row["documento4"] ?>" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>
                                            </tr>
                                            <tr>
                                                <th>Extractos Bancarios</th>
                                                <?php
                                                if (!empty($row["documento5"])) {
                                                    echo '
                                                <td><a href="../' . $row["documento5"] . '" target="new"><i class="far fa-file-alt"></i> Ver Documento</a></td>';
                                                } else {
                                                    echo "<td>No cargado</td>";
                                                }
                                                ?>
                                            </tr>
                                        </thead>
                                    </table>
                                    <br>

                                </div>
                            </div>
                        </div>
                <?php
                        break;
                }
                ?>
            </div>
            <row>
                <div class="row">
                    <div class="card col-6">
                        <div class="card-body">
                            <div class="card-body">
                                <h5 class="card-title">CLASIFICACIÓN</h5>
                                <form action="clasificar.php" method="POST">
                                    <div class="position-relative form-group row">
                                        <div class="col-md-6">
                                            <label for="exampleFormControlSelect1">Tipo de Petición</label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="clasificacion">
                                                <option value="" selected="true" disabled="disabled">--Seleccione--</option>
                                                <option>Clasifica</option>
                                                <option>Falta Documentos</option>
                                                <option>No Clasifica</option>
                                                <option>Novedades</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="position-relative form-group row">
                                        <div class="col-md-9">
                                            <label for="exampleFormControlSelect1">Notas sobre el candidato</label>
                                            <textarea class="form-control" name="notas" rows="10" placeholder="Escriba aquí sus notas..."></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id_registro" value="<?php echo $id_registro ?>">
                                    <button type="submit" class="btn btn-primary">GUARDAR INFORMACIÓN</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card col-6">
                        <div class="card-body">
                            <div class="card-body">
                                <h5 class="card-title">NOTAS GUARDADAS</h5>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="10%">ID</th>
                                            <th scope="col" width="90%">Nota</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = mysqli_query($conexion, "SELECT * from notas_micasa where fk_id_registro = $id_registro order by id_notas desc");
                                        while ($row = mysqli_fetch_assoc($sql)) {
                                            echo '
                                            <tr>
                                            <td> ' . $row['id_notas'] . '</a></td>
                                            <td> ' . $row['notas'] . '</a></td>
                                            </tr>
                                            ';
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </row>
        <?php
        } else {
            //No encontró registros en la BD
        ?>
            <div class="text-center mb-5">
                <div class="display-4 text-primary mb-2">CÉDULA NO ENCONTRADA EN BD</div>
                <div class="display-4">Verifique la cédula y vuelva a intentar
                    <BR>
                    <a href="index2.php" class="btn btn-primary">REALIZAR NUEVA CONSULTA</a>

                <?php
            }
                ?>
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