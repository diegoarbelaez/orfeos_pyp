<?php session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php
include("conexion.php");
$nombre_tabla = "OrfeosFebrero";
$id = $_GET["id"];
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
                                Clasificar este caso
                            </h1>
                            <div class="page-header-subtitle">Leer documentación</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="text-center mb-5">
            <div class="display-4 text-primary mb-2"><?php echo $row['REMITENTE']  ?></div>
            <div class="display-4">Perfilado como
            </div>
        </div>
        <!-- Main page content-->
        <div class="row">
            <div class="card col-12">
                <div class="card-body">
                    <div class="card-body">
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
                        array_push($colores,$datos["color"]);
                        }
                        ?>

                            <br>
                            <br>
                        </div>

                        <form action="guardar_actualizacion.php" method="POST">
                            <table class="table table-striped table-hover" id="dataTable2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="30%" style="vertical-align: middle;">Clasifique el Caso por favor:</th>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control" id="exampleFormControlSelect1" name="categoria">
                                                    <?php
                                                    $sentencia = "select * from $nombre_tabla where id=$id";
                                                    $resultado = mysqli_query($conexion, $sentencia);
                                                    while ($datos = mysqli_fetch_assoc($resultado)) {
                                                    ?>
                                                        <option value="<?php echo $datos["categoria"]; ?>">
                                                            <?php
                                                            $sentencia2 = "select * from categorias where id_categoria = " . $datos["categoria"];
                                                            $resultado2 = mysqli_query($conexion, $sentencia2);
                                                            $datos2 = mysqli_fetch_assoc($resultado2);
                                                            echo $datos2["clasificacion"]; ?>

                                                        -CLASIFICACIÓN ACTUAL-</option>
                                                    <?php
                                                    }
                                                    ?>

                                                    <?php
                                                    $sentencia = "select * from categorias";
                                                    $resultado = mysqli_query($conexion, $sentencia);
                                                    while ($datos = mysqli_fetch_assoc($resultado)) {
                                                    ?>
                                                        <option value="<?php echo $datos["id_categoria"]; ?>"><?php echo $datos["clasificacion"] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </td>
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