<?php

include("encabezado.php");
include("nav.php");
$error=$_GET["error"];
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="text-center mt-4">
                        <img class="img-fluid p-4" src="assets/img/freepik/500-internal-server-error-pana.svg" alt="">
                        <p class="lead">Lamentablemente tu archivo no pudo ser cargardo, debes iniciar nuevamente el proceso</p>
                        <p class="lead">Error: <?php echo $error ?></p>
                        <a class="text-arrow-icon" href="radicar_entrante.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left ml-0 mr-1">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                            Regresar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer mt-auto footer-light">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 small">Copyright &copy; Your Website 2020</div>
                <div class="col-md-6 text-md-right small">
                    <a href="#!">Privacy Policy</a>
                    &middot;
                    <a href="#!">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>
<?php
//include("pie.php");


?>