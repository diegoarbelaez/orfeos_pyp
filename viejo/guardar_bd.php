<?php
include("conexion.php");
include("correo.php");
$tipo_transaccion = $_POST["tipo_transaccion"];
//var_dump($_POST);

switch ($tipo_transaccion) {

    case "radicar_pqrs";
        echo "entró al case radicar_pqrs";
        $id_insertado;
        $nombre_remitente = $_POST["nombre_remitente"];
        $cedula_remitente = $_POST["cedula_remitente"];
        $entidad_remitente = $_POST["entidad_remitente"];
        $direccion_remitente = $_POST["direccion_remitente"];
        $telefono_remitente = $_POST["telefono_remitente"];
        $funcionario_delegado = $_POST["funcionario_delegado"]; //a quien va dirigida la PQRS
        $funcionario_notificado = $_POST["funcionario_notificado"]; //lider de PQRS en la dependencia 
        $notas = $_POST["notas"];
        $asunto = $_POST["asunto"];
        $tipo = $_POST["tipo"];


        //Revisar esto! aqui inserta el archivo

        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES["adjunto"]["type"])) {
            var_dump($_POST);
            echo "Entró";
            $target_dir = "archivos/";
            $carpeta = $target_dir;
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
            $target_file = $carpeta . basename($_FILES["adjunto"]["name"]);
            echo "Nombre del Archivo ->" . $target_file;
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["adjunto"]["tmp_name"]);
                if ($check !== false) {
                    $errors[] = "El archivo es una imagen - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    $errors[] = "El archivo no es una imagen.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                $errors[] = "Lo sentimos, archivo ya existe. Cambia el nombre del archivo";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["adjunto"]["size"] > 7524288) {
                $errors[] = "Lo sentimos, el archivo es demasiado grande.  Tamaño máximo admitido: 7 MB";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "docx" && $imageFileType != "xls" && $imageFileType != "xlsx" && $imageFileType != "txt"  && $imageFileType != "zip"
            ) {
                $errors[] = "Lo sentimos, sólo archivos JPG, JPEG, PNG, GIF, DOCX, XLSX, PDF  son permitidos.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $errors[] = "Lo sentimos, tu archivo no fue subido.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["adjunto"]["tmp_name"], $target_file)) {
                    $messages[] = "El Archivo ha sido subido correctamente.";
                } else {
                    $errors[] = "Lo sentimos, hubo un error subiendo el archivo.";
                }
            }
            if (isset($errors)) {
                header("Location:error_carga_archivo.php?error=$errors[0]");
            }
            if (isset($messages)) {
                // Inserta los datos en la tabla pqrs si todo está OK
                //Primero busca el consecutivo en el que van las PQRS Entrantes
                $sentencia_consecutivo = "select consecutivo_entrante from pqrs order by consecutivo_entrante desc limit 1";
                $resultado_consecutivo = mysqli_query($con, $sentencia_consecutivo);
                $ultimo_consecutivo = mysqli_fetch_assoc($resultado_consecutivo);
                $string_bd = $ultimo_consecutivo["consecutivo_entrante"];
                $partes = explode("-", $string_bd);
                $ultimo_consecutivo_extraido = $partes[1];
                $ultimo_consecutivo_extraido++;
                //echo "<br>Ultimo Consecutivo " . $ultimo_consecutivo_extraido;
                $partes[1] = $ultimo_consecutivo_extraido;
                $ultimo_consecutivo_generado = implode("-", $partes);

                //busca la depenencia y el correo del funcionario delegado (funcionario delegado es a quién va dirigida la PQRS, y el notificado es el Líder)
                $sentencia_dependencia = "select * from funcionario where id_funcionario=$funcionario_delegado";
                $result_dependencia = mysqli_query($con, $sentencia_dependencia);
                $datos_dependencia = mysqli_fetch_assoc($result_dependencia);
                $fk_id_depencia = $datos_dependencia["fk_id_dependencia"];
                $correo_delegado = $datos_dependencia["correo"];

                $sentencia_dependencia2 = "select * from funcionario where id_funcionario=$funcionario_notificado";
                $result_dependencia2 = mysqli_query($con, $sentencia_dependencia2);
                $datos_dependencia2 = mysqli_fetch_assoc($result_dependencia2);
                $fk_id_depencia2 = $datos_dependencia2["fk_id_dependencia"];
                $correo_notificado = $datos_dependencia2["correo"];



                //echo "<br> ID Dependencia".$fk_id_depencia;



                $sentencia = "INSERT INTO pqrs (nombre_remitente,cedula_remitente,entidad_remitente,direccion_remitente,telefono_remitente,fk_id_funcionario_delegado,fk_id_funcionario_notificado,notas,consecutivo_entrante,fk_id_dependencia,origen,asunto,estado,tipo) values ('$nombre_remitente','$cedula_remitente','$entidad_remitente','$direccion_remitente','$telefono_remitente',$funcionario_delegado,$funcionario_notificado,'$notas','$ultimo_consecutivo_generado',$fk_id_depencia,1,'$asunto',1,$tipo)";
                //echo $sentencia;
                if (mysqli_query($con, $sentencia)) {
                    //echo "Agregado correctamente a la BD";
                    $id_insertado = mysqli_insert_id($con);
                    //echo "<br>id_insertado " . $id_insertado;
                } else {
                    echo "Error: " . $sentencia . "<br>" . mysqli_error($con);
                }
                $sentencia2 = "INSERT INTO adjuntos (fk_id_pqrs,url_archivo) values ($id_insertado,'$target_file')";
                //echo $sentencia2;
                if (mysqli_query($con, $sentencia2)) {
                  //  echo "Agregado correctamente a la BD";
                } else {
                    echo "Error: " . $sentencia . "<br>" . mysqli_error($con);
                }

                //Según el tipo de la solicitud se debe asignar la fecha
                $fecha_vencimiento = "";
                $sentencia_fecha = "select fecha_radicacion from pqrs where id_pqrs=$id_insertado";
                $resultado_fecha_radicacion = mysqli_query($con, $sentencia_fecha);
                $fila_fecha = mysqli_fetch_assoc($resultado_fecha_radicacion);
                $fecha_radicacion = $fila_fecha["fecha_radicacion"];
                $dias_vencimiento = "";

                switch ($tipo) {
                    case 1:
                        $dias_vencimiento = "+ 10 days";
                        break;
                    case 2:
                        $dias_vencimiento = "+ 10 days";
                        break;
                    case 3:
                        $dias_vencimiento = "+ 10 days";
                        break;
                    case 4:
                        $dias_vencimiento = "+ 10 days";
                        break;
                    case 5:
                        $dias_vencimiento = "+ 10 days";
                        break;
                    case 6:
                        $dias_vencimiento = "+ 10 days";
                        break;
                    case 7:
                        $dias_vencimiento = "+ 10 days";
                        break;
                    case 8:
                        $dias_vencimiento = "+ 10 days";
                        break;
                    case 9:
                        $dias_vencimiento = "+ 10 days";
                        break;
                    case 10:
                        $dias_vencimiento = "+ 10 days";
                        break;
                }
                //Calcula fecha de vencimiento
                //$date = date("d-m-Y");
                //Incrementando  dias
                $fecha_vencimiento = strtotime($fecha_radicacion . "" . $dias_vencimiento);

                echo $fecha_radicacion . "<br>";
                echo $fecha_vencimiento . "<br>";
                echo $id_insertado . "<br>"; 


                //Enviar Correo al Secretario y al líder de PQRS


                //$conexion->close();

                //HTML del email
                $contratista = "Diego Arbelaez";
                $log = "EJEMPLO";
                $mensaje = '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=500px, initial-scale=1.0">
                    <title>Acaba de ser radicada una PQRS en Ventanilla </title>
                </head>
                <body>
                    <p>Número de radicado:</p>
                    <br>
                    <br>
                    <p>' . $ultimo_consecutivo_generado . '</p>
                    <br>
                    <br> Correos: '.$correo_delegado.' - '.$correo_notificado.'
                    <p>
                    <br>
                    <br>
                    La Fecha límite de respuesta es: '.$fecha_vencimiento.'
                    <br>
                    <br>
                    Recuerda estar pendiente del software DIANA,, para ver las PQRS pendientes
                    <br>
                    <br>
                    </p>
                </body>
                </html>';

                $destinatarios = "diegoarbelaez.co@gmail.com";
                $asunto = "PQRS Radicada";
                $adjunto = "/archivos/diego.png";

                enviarCorreo($mensaje,$destinatarios,$asunto,$adjunto);

                header("Location:confirmacion_radicacion2.php?id_pqrs=$id_insertado");


            }
        }
        break;

    case "enviar_pqrs";

        echo "entró al case radicar_pqrs";
        $id_insertado;
        $nombre_destinatario = $_POST["nombre_destinatario"];
        $cedula_destinatario = $_POST["cedula_destinatario"];
        $entidad_destinatario = $_POST["entidad_destinatario"];
        $direccion_destinatario = $_POST["direccion_destinatario"];
        $telefono_destinatario = $_POST["telefono_destinatario"];
        $notas = $_POST["notas"];
        $asunto = $_POST["asunto"];
        $tipo = $_POST["tipo"];
        $funcionario_delegado = $_POST["funcionario_delegado"];
        //$adjunto = $_POST["adjunto"];



        //Revisar esto! aqui inserta el archivo

        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES["adjunto"]["type"])) {
            var_dump($_POST);
            echo "Entró";
            $target_dir = "archivos/";
            $carpeta = $target_dir;
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
            $target_file = $carpeta . basename($_FILES["adjunto"]["name"]);
            echo "Nombre del Archivo ->" . $target_file;
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["adjunto"]["tmp_name"]);
                if ($check !== false) {
                    $errors[] = "El archivo es una imagen - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    $errors[] = "El archivo no es una imagen.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                $errors[] = "Lo sentimos, archivo ya existe. Cambia el nombre del archivo";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["adjunto"]["size"] > 7524288) {
                $errors[] = "Lo sentimos, el archivo es demasiado grande.  Tamaño máximo admitido: 7 MB";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "docx" && $imageFileType != "xls" && $imageFileType != "xlsx" && $imageFileType != "txt"  && $imageFileType != "zip"
            ) {
                $errors[] = "Lo sentimos, sólo archivos JPG, JPEG, PNG, GIF, DOCX, XLSX, PDF  son permitidos.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $errors[] = "Lo sentimos, tu archivo no fue subido.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["adjunto"]["tmp_name"], $target_file)) {
                    $messages[] = "El Archivo ha sido subido correctamente.";
                } else {
                    $errors[] = "Lo sentimos, hubo un error subiendo el archivo.";
                }
            }
            if (isset($errors)) {
                header("Location:error_carga_archivo.php?error=$errors[0]");
            }
            if (isset($messages)) {
                // Inserta los datos en la tabla pqrs si todo está OK
                //Primero busca el consecutivo en el que van las PQRS Entrantes
                $sentencia_consecutivo = "select consecutivo_saliente from pqrs order by consecutivo_saliente desc limit 1";
                $resultado_consecutivo = mysqli_query($con, $sentencia_consecutivo);
                $ultimo_consecutivo = mysqli_fetch_assoc($resultado_consecutivo);
                $string_bd = $ultimo_consecutivo["consecutivo_saliente"];
                $partes = explode("-", $string_bd);
                $ultimo_consecutivo_extraido = $partes[1];
                $ultimo_consecutivo_extraido++;
                //echo "<br>Ultimo Consecutivo " . $ultimo_consecutivo_extraido;
                $partes[1] = $ultimo_consecutivo_extraido;
                $ultimo_consecutivo_generado = implode("-", $partes);

                //busca la depenencia del funcionario delegado
                $sentencia_dependencia = "select fk_id_dependencia from funcionario where id_funcionario=$funcionario_delegado";
                $result_dependencia = mysqli_query($con, $sentencia_dependencia);
                $datos_dependencia = mysqli_fetch_assoc($result_dependencia);
                $fk_id_depencia = $datos_dependencia["fk_id_dependencia"];
                //echo "<br> ID Dependencia".$fk_id_depencia;



                $sentencia = "INSERT INTO pqrs (destinatario,cedula_destinatario,entidad_destinatario,direccion_destinatario,telefono_destinatario,fk_id_funcionario_delegado,notas,consecutivo_saliente,fk_id_dependencia,asunto,tipo,origen) values ('$nombre_destinatario','$cedula_destinatario','$entidad_destinatario','$direccion_destinatario','$telefono_destinatario',$funcionario_delegado,'$notas','$ultimo_consecutivo_generado',$fk_id_depencia,'$asunto',$tipo,2)";
                echo $sentencia;
                if (mysqli_query($con, $sentencia)) {
                    echo "Agregado correctamente a la BD";
                    $id_insertado = mysqli_insert_id($con);
                    echo "<br>id_insertado " . $id_insertado;
                } else {
                    echo "Error: " . $sentencia . "<br>" . mysqli_error($con);
                }
                $sentencia2 = "INSERT INTO adjuntos (fk_id_pqrs,url_archivo) values ($id_insertado,'$target_file')";
                echo $sentencia2;
                if (mysqli_query($con, $sentencia2)) {
                    echo "Agregado correctamente a la BD";
                } else {
                    echo "Error: " . $sentencia . "<br>" . mysqli_error($con);
                }
                header("Location:confirmacion_radicacion_saliente.php?id_pqrs=$id_insertado");
                //$conexion->close();

                /*
            //Enviar correo al supervisor del contrato
            $sentencia4 = "select * from contrato where id_contrato = $id_contrato";
            //echo $sentencia4;
            $resultado4 = $conexion->query($sentencia4);
            //Enviar el Correo de notificación, según los datos del id_contratista
            $fila4 = $resultado4->fetch_object();
            $correo_supervisor = $fila4->correo_supervisor;
            //echo $correo_supervisor;
            //$correo_supervisor = "diegoarbelaez.co@gmail.com";
            //Obtengo el nombre del contratista
            $nombre_contratista = $fila3->nombres . ' ' . $fila3->apellidos;

            //HTML del email
            $mensaje = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=500px, initial-scale=1.0">
                <title>El Contratista ' . $nombre_contratista . ' acaba de agregar un Hecho sobre su contrato</title>
            </head>
            <body>
                <p>Hecho:</p>
                <br>
                <br>
                <p>' . $log . '</p>
                <br>
                <br>
                <p>
                Ya puedes calificar este hecho
                <br>
                <br>
                Recuerda, si calificas rápido, rápidamente los contratistas tendrán retroalimentación sobre sus hechos reportados
                <br>
                <br>
                Ingresa a MegaReporte y revisa tu actividad
                <br>
                <br>
                Recuerda! MegaReporte hace las cosas más fáciles para ti!
                </p>
            </body>
            </html>';
                        //PHP Mailer
                        $mail = new PHPMailer;
                        $mail->isSMTP();
                        $mail->SMTPDebug = SMTP::DEBUG_OFF;
                        $mail->Host = 'smtp.gmail.com';
                        $mail->Port = 587;
                        $mail->SMTPSecure = 'tls';
                        $mail->SMTPAuth = true;
                        $mail->Username = "sumoalequipo.sevilla@gmail.com";
                        $mail->Password = "Kyzavy46";
                        $mail->CharSet = 'UTF-8';
                        $mail->setFrom('mega.reporte.col@gmail.com', 'Administrador Megareporte');
                        $mail->addReplyTo('mega.reporte.col@gmail.com', 'Administrador Megareporte');
                        $mail->addAddress($correo_supervisor, 'Administrador Megareporte');
                        $mail->Subject = 'Nuevo hecho reportado por ' . $nombre_contratista;
                        $mail->msgHTML($mensaje, __DIR__);
                        $mail->AltBody = 'Este es un texto alternativo';
                        $mail->addAttachment('images/sumoalequipo.png');
                        if (!$mail->send()) {
                            echo "Mailer Error: " . $mail->ErrorInfo;
                        } else {
                            //echo "Message sent!";
                        }
                        function save_mail($mail)
                        {
                            $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
                            $imapStream = imap_open($path, $mail->Username, $mail->Password);
                            $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
                            imap_close($imapStream);
                            return $result;
                        }
                        header("Location:confirmacion_log.php?id_contrato=$id_contrato");
                    }*/
            }
        }
        break;


    case "radicar_inter";

        echo "entró al case radicar_pqrs";
        $id_insertado;
        $notas = $_POST["notas"];
        $asunto = $_POST["asunto"];
        $tipo = $_POST["tipo"];
        $funcionario_delegado = $_POST["funcionario_delegado"];
        $funcionario_notificado = $_POST["funcionario_notificado"];
        $fk_id_funcionario_radicador = $_POST["funcionario_radicador"];
        //$adjunto = $_POST["adjunto"];




        //Revisar esto! aqui inserta el archivo

        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES["adjunto"]["type"])) {
            var_dump($_POST);
            echo "Entró";
            $target_dir = "archivos/";
            $carpeta = $target_dir;
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
            $target_file = $carpeta . basename($_FILES["adjunto"]["name"]);
            echo "Nombre del Archivo ->" . $target_file;
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["adjunto"]["tmp_name"]);
                if ($check !== false) {
                    $errors[] = "El archivo es una imagen - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    $errors[] = "El archivo no es una imagen.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                $errors[] = "Lo sentimos, archivo ya existe. Cambia el nombre del archivo";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["adjunto"]["size"] > 7524288) {
                $errors[] = "Lo sentimos, el archivo es demasiado grande.  Tamaño máximo admitido: 7 MB";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "docx" && $imageFileType != "xls" && $imageFileType != "xlsx" && $imageFileType != "txt"  && $imageFileType != "zip"
            ) {
                $errors[] = "Lo sentimos, sólo archivos JPG, JPEG, PNG, GIF, DOCX, XLSX, PDF  son permitidos.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $errors[] = "Lo sentimos, tu archivo no fue subido.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["adjunto"]["tmp_name"], $target_file)) {
                    $messages[] = "El Archivo ha sido subido correctamente.";
                } else {
                    $errors[] = "Lo sentimos, hubo un error subiendo el archivo.";
                }
            }
            if (isset($errors)) {
                header("Location:error_carga_archivo.php?error=$errors[0]");
            }
            if (isset($messages)) {
                // Inserta los datos en la tabla pqrs si todo está OK
                //Primero busca el consecutivo en el que van las PQRS Entrantes
                $sentencia_consecutivo = "select consecutivo_interdependencias from pqrs order by consecutivo_interdependencias desc limit 1";
                $resultado_consecutivo = mysqli_query($con, $sentencia_consecutivo);
                $ultimo_consecutivo = mysqli_fetch_assoc($resultado_consecutivo);
                $string_bd = $ultimo_consecutivo["consecutivo_interdependencias"];
                $partes = explode("-", $string_bd);
                $ultimo_consecutivo_extraido = $partes[1];
                $ultimo_consecutivo_extraido++;
                //echo "<br>Ultimo Consecutivo " . $ultimo_consecutivo_extraido;
                $partes[1] = $ultimo_consecutivo_extraido;
                $ultimo_consecutivo_generado = implode("-", $partes);

                //busca la depenencia del funcionario delegado
                $sentencia_dependencia = "select fk_id_dependencia from funcionario where id_funcionario=$funcionario_delegado";
                $result_dependencia = mysqli_query($con, $sentencia_dependencia);
                $datos_dependencia = mysqli_fetch_assoc($result_dependencia);
                $fk_id_depencia = $datos_dependencia["fk_id_dependencia"];
                //echo "<br> ID Dependencia".$fk_id_depencia;



                $sentencia = "INSERT INTO pqrs (consecutivo_interdependencias,fk_id_funcionario_remitente,fk_id_dependencia,fk_id_funcionario_delegado,fk_id_funcionario_notificado,tipo,origen,asunto,notas,estado) values ('$ultimo_consecutivo_generado','$fk_id_funcionario_radicador','$fk_id_depencia','$funcionario_delegado','$funcionario_notificado',$tipo,3,'$asunto','$notas',1)";
                echo $sentencia;
                if (mysqli_query($con, $sentencia)) {
                    echo "Agregado correctamente a la BD";
                    $id_insertado = mysqli_insert_id($con);
                    echo "<br>id_insertado " . $id_insertado;
                } else {
                    echo "Error: " . $sentencia . "<br>" . mysqli_error($con);
                }
                $sentencia2 = "INSERT INTO adjuntos (fk_id_pqrs,url_archivo) values ($id_insertado,'$target_file')";
                echo $sentencia2;
                if (mysqli_query($con, $sentencia2)) {
                    echo "Agregado correctamente a la BD";
                } else {
                    echo "Error: " . $sentencia . "<br>" . mysqli_error($con);
                }
                header("Location:confirmacion_radicacion_inter.php?id_pqrs=$id_insertado");
                //$conexion->close();

                /*
            //Enviar correo al supervisor del contrato
            $sentencia4 = "select * from contrato where id_contrato = $id_contrato";
            //echo $sentencia4;
            $resultado4 = $conexion->query($sentencia4);
            //Enviar el Correo de notificación, según los datos del id_contratista
            $fila4 = $resultado4->fetch_object();
            $correo_supervisor = $fila4->correo_supervisor;
            //echo $correo_supervisor;
            //$correo_supervisor = "diegoarbelaez.co@gmail.com";
            //Obtengo el nombre del contratista
            $nombre_contratista = $fila3->nombres . ' ' . $fila3->apellidos;

            //HTML del email
            $mensaje = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=500px, initial-scale=1.0">
                <title>El Contratista ' . $nombre_contratista . ' acaba de agregar un Hecho sobre su contrato</title>
            </head>
            <body>
                <p>Hecho:</p>
                <br>
                <br>
                <p>' . $log . '</p>
                <br>
                <br>
                <p>
                Ya puedes calificar este hecho
                <br>
                <br>
                Recuerda, si calificas rápido, rápidamente los contratistas tendrán retroalimentación sobre sus hechos reportados
                <br>
                <br>
                Ingresa a MegaReporte y revisa tu actividad
                <br>
                <br>
                Recuerda! MegaReporte hace las cosas más fáciles para ti!
                </p>
            </body>
            </html>';
                        //PHP Mailer
                        $mail = new PHPMailer;
                        $mail->isSMTP();
                        $mail->SMTPDebug = SMTP::DEBUG_OFF;
                        $mail->Host = 'smtp.gmail.com';
                        $mail->Port = 587;
                        $mail->SMTPSecure = 'tls';
                        $mail->SMTPAuth = true;
                        $mail->Username = "sumoalequipo.sevilla@gmail.com";
                        $mail->Password = "Kyzavy46";
                        $mail->CharSet = 'UTF-8';
                        $mail->setFrom('mega.reporte.col@gmail.com', 'Administrador Megareporte');
                        $mail->addReplyTo('mega.reporte.col@gmail.com', 'Administrador Megareporte');
                        $mail->addAddress($correo_supervisor, 'Administrador Megareporte');
                        $mail->Subject = 'Nuevo hecho reportado por ' . $nombre_contratista;
                        $mail->msgHTML($mensaje, __DIR__);
                        $mail->AltBody = 'Este es un texto alternativo';
                        $mail->addAttachment('images/sumoalequipo.png');
                        if (!$mail->send()) {
                            echo "Mailer Error: " . $mail->ErrorInfo;
                        } else {
                            //echo "Message sent!";
                        }
                        function save_mail($mail)
                        {
                            $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
                            $imapStream = imap_open($path, $mail->Username, $mail->Password);
                            $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
                            imap_close($imapStream);
                            return $result;
                        }
                        header("Location:confirmacion_log.php?id_contrato=$id_contrato");
                    }*/
            }
        }
        break;
}
