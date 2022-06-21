<?php session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<?php
include("conexion.php");
$nombre_tabla = "OrfeosFebrero";
$sentencia = "select count(*) as resultado from $nombre_tabla";
$resultado = mysqli_query($conexion, $sentencia);
$fila = mysqli_fetch_assoc($resultado);
$sentencia2 = "select * from $nombre_tabla";
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
    <title>Consultas de Orfeo CDV</title>
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
                            <div class="page-header-subtitle">Casos descargados - 4/3/22 7:30AM</div>
                            <div class="page-header-subtitle">Conectado como: <b><?php echo $_SESSION["user"]; ?></b></div>
                            <div class="page-header-subtitle"><a href="dashboard.php" class="btn btn-success">INICIO</a> </div>
                            <div class="page-header-subtitle"><a href="logout.php" class="btn btn-danger">CERRAR SESIÓN</a> </div>
                        </div>
                        <!-- <div class="col-auto mt-4">
                            <div class="form-group">
                                <form action="listado_orfeos_admin.php" method="POST">
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
                                    $sentencia_cargados = "select count(*) as total_casos from $nombre_tabla WHERE 'FECHA RADICADO' > '2021-09-01 00:00:00'";
                                    $resultado_cargados = mysqli_query($conexion, $sentencia_cargados);
                                    $fila_cargados = mysqli_fetch_assoc($resultado_cargados);
                                    echo $fila_cargados["total_casos"];
                                    ?> Casos totales</div>
        </div>
        <!-- Main page content-->
        <div class="card mb-12">
            <div class="card-body">
                <div class="card-body">
                    <form action="resultados_buscador_admin.php" method="GET">
                        <div>
                            <div class="form-group">
                                <label class="small mb-1" for="inputEmailAddress"><b>Buscador</b></label>
                                <input class="form-control" type="text" name="radicado" placeholder="# Radicado" /><br>
                                <button type="submit" id="btn-login" name="btn-login" class="btn btn-success" id="showtoast">Buscar Radicado</button>
                                <br><br><br><br>
                            </div>

                        </div>
                    </form>
                    <h5 class="card-title">Listado de Clasificaciones</h5>
                    <div>
                        <?php
                        //Guarda las categorias en un arreglo
                        $colores = array();

                        $sentencia = "select * from categorias";
                        $resultado = mysqli_query($conexion, $sentencia);
                        while ($datos = mysqli_fetch_assoc($resultado)) {
                        ?>
                            <a href="#" target="new" class="btn btn-primary" style="background-color:<?php echo $datos["color"] ?>;"><?php echo $datos["clasificacion"] ?></a>
                        <?php
                            array_push($colores, $datos["color"]);
                        }
                        ?>
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
                            <th>Generar Respuesta</th>
                            <th>Clasificación</th>

                        </tr>
                        <?php
                        $sql = mysqli_query($conexion, "SELECT * from $nombre_tabla WHERE 'FECHA RADICADO' > '2021-09-01 00:00:00' order by 'FECHA RADICADO' DESC");
                        if (mysqli_num_rows($sql) == 0) {
                            echo '<tr><td colspan="8">No hay datos.</td></tr>';
                        }
                        $elementosxpagina = 500;
                        $total_elementos = mysqli_num_rows($sql);
                        $paginas = ceil($total_elementos / $elementosxpagina);
                        if (!$_GET) {
                        ?>
                            <script type="text/javascript">
                                window.location = "listado_orfeos_admin.php?pagina=1&categoria=4";
                            </script>
                        <?php
                        } else {
                            $iniciar = ($_GET['pagina'] - 1) * $elementosxpagina;
                            $sql = mysqli_query($conexion, "SELECT * from $nombre_tabla WHERE 'FECHA RADICADO' > '2021-09-01 00:00:00' order by 'FECHA RADICADO' DESC LIMIT " . $iniciar . "," . $elementosxpagina);
                            while ($row = mysqli_fetch_assoc($sql)) {
                                echo '
                                <tr>
                                <td> ' . $row['id'] . '</a></td>
                                <td>' . $row['NUMERO RADICADO'] . '</td>
                                <td>' . $row['FECHA'] . '</td>
                                <td>' . $row['ASUNTO'] . '</td>
                                <td>' . $row['REMITENTE'] . '</td>
                                <td>' . $row['TIPO DOCUMENTO'] . '</td>
                                <td>' . $row['DIAS RESTANTES'] . '</td>
                                <td>' . $row['ENVIADO POR'] . '</td>
                                <td>' . "<a href='https://orfeo.minsalud.gov.co/orfeo/linkArchivo.php?&PHPSESSID=" . $id_session . "CERTIFICAVACUNACOVID&numrad=" . $row['NUMERO RADICADO'] . "' target='_blank'>Ver Caso</a>" . '</td>
                                <td>' . "<a href='generar_respuesta.php?id=" . $row['id'] . "' target='_blank'>Generar PDF</a>" . '</td>';

                                $sentencia_clasificacion = "select * from categorias where id_categoria =" . $row['categoria'];
                                $resultado_clasificacion = mysqli_query($conexion, $sentencia_clasificacion);
                                $fila_categoria = mysqli_fetch_assoc($resultado_clasificacion);
                                echo '<td><a href="clasificar.php?id=' . $row['id'] . '" class="btn btn-info" style="background-color:' . $fila_categoria["color"] . '">' . $fila_categoria["clasificacion"] . '</a></td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </table>
                    <!-- PAGINADOR -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="listado_orfeos_admin.php?pagina=<?php echo $_GET['pagina'] - 1 ?>">
                                    Anterior
                                </a>
                            </li>
                            <?php for ($i = 0; $i < $paginas; $i++) : ?>
                                <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>"><a class="page-link" href="listado_orfeos_admin.php?pagina=<?php echo $i + 1  ?>"><?php echo $i + 1  ?></a></li>
                            <?php endfor ?>
                            <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>">
                                <a class="page-link" href="listado_orfeos_admin.php?pagina=<?php echo $_GET['pagina'] + 1 ?>">
                                    Siguiente
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Detailed pricing example-->
        </div>
    </main>
</body>

</html>