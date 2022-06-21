
<?php
include("conexion.php");
?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">

                    <div class="sidenav-menu-heading">GESTION DE PQRS</div>
                    <a class="nav-link" href="index.php">
                        <div class="nav-link-icon"><i data-feather="arrow-down-circle"></i></div>
                        Visor de PQRS de la Dependencia
                    </a>
                </div>
            </div>
            <div class="sidenav-footer">
                <div class="sidenav-footer-content">
                    <div class="sidenav-footer-subtitle">Logeado como:</div>
                    <div class="sidenav-footer-title">
                        <?php
                        //var_dump($_SESSION);
                        $id_funcionario2 = $_SESSION["id_funcionario"]; 
                        $sentencia2 = "select * from funcionario where id_funcionario =".$id_funcionario2;
                        $resultado2 = mysqli_query($con,$sentencia2);
                        $datos2=mysqli_fetch_assoc($resultado2);
                        echo $datos2["nombre"];
                        ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>