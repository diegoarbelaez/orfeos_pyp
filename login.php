<?php session_start();

// it will never let you open index(login) page if session is set
if (isset($_SESSION['user']) != "") {
    header("Location: index.php");
    exit;
}



//require_once 'dbconfig.php';
require_once 'conexion.php';

$error = false;
$errMSG = '';
$emailError = '';
$passError = '';



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn-login'])) {

    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['usuario']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $password = trim($_POST['password']);
    $password = strip_tags($password);
    $password = htmlspecialchars($password);
    // prevent sql injections / clear user invalid inputs

    if (empty($email)) {
        $error = true;
        $emailError = "Ingrese un correo electrónico";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "El correo que ingresó no es válido";
    }

    if (empty($password)) {
        $error = true;
        $passError = "Clave incorrecta, intente nuevamente";
    }

    // if there's no error, continue to login
    if (!$error) {

        //$password = hash('sha256', $pass); // password hashing using SHA256
        $sentencia = "SELECT * FROM administradores WHERE usuario='$email'";


        $res = mysqli_query($conexion, $sentencia);
        //echo $sentencia."<br>";
        $row = mysqli_fetch_array($res);
        $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row
        //var_dump($row);
        //echo "<br>Password: " . $row['password'];

        if ($row['password'] == $password) {
            $_SESSION["user"] = $row["usuario"];
            $_SESSION["loggedin"] = true;

            if ($row["usuario"] == 'cengativa@minsalud.gov.co' || $row["usuario"] == 'csosa@minsalud.gov.co' || $row["usuario"] == 'administrador-masivo@minsalud.gov.co') {
                $tipo_usuario = 5;
            } else {
                $tipo_usuario = 1;
            }

            $sentencia_lastlogin = "update administradores set lastlogin = '".date('Y-m-d H:i:s')."' where usuario = '".$row['usuario']."'";
            $resultado_lastlogin = mysqli_query($conexion,$sentencia_lastlogin);            
            



            switch ($tipo_usuario) {
                case 1:
                    header("location:listado_orfeos.php");
                    break;
                case 5:
                    header("location:dashboard.php");
                    break;
                case 7: // Va al index del raiz - Ventanilla única
                    header("location:index.php");
                    break;
                case 6: // va al super administrador
                    header("location:radicar_saliente.php");
                    break;
            }

            
            //var_dump($_SESSION);
            //echo "login correcto";
            //aquí valido que tipo de usuario es y así mismo lo dirijo hacia la página indicada
            //header("Location: index.php");
        } else {
            $errMSG = "Credenciales incorrectas... verifique nuevamente";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ORFEOS CDV</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <!-- Basic login form-->
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header justify-content-center">
                                    <h3 class="font-weight-light my-4">Utilidad Provisional de Manejo de Orfeos - OTIC</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Login form-->
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                        <!-- Form Group (email address)-->
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Correo</label>
                                            <input class="form-control py-4" id="inputEmailAddress" type="correo" name="usuario" placeholder="Ingrese su dirección de correo" />
                                        </div>
                                        <!-- Form Group (password)-->
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Clave</label>
                                            <input class="form-control py-4" id="inputPassword" type="password" name="password" placeholder="Enter password" />
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">

                                            <button type="submit" id="btn-login" name="btn-login" class="btn btn-success" id="showtoast">Ingresar</button>
                                            <?php echo $errMSG . '' . $emailError . '' . $passError ?>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>