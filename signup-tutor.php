<?php 
    require './signup-tutor-view.php';
    require './conexion.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conexion = conectar();
        if($conexion[0]) {
            $rfc = strtoupper(filter_var($_POST['rfc'], FILTER_SANITIZE_STRING));
            $nombre = strtoupper(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
            $correo = strtoupper(filter_var($_POST['email'], FILTER_SANITIZE_STRING));
            $password = hash("sha256",strtoupper(filter_var($_POST['password'], FILTER_SANITIZE_STRING)));
            $rol = strtoupper(filter_var($_POST['rol'], FILTER_SANITIZE_STRING));
            $descripción = strtoupper(filter_var($_POST['descripcion'], FILTER_SANITIZE_STRING));
            $nombreTarjeta = strtoupper(filter_var($_POST['nombreTarjeta'], FILTER_SANITIZE_STRING));
            $numeroTarjeta = filter_var($_POST['numeroTarjeta'], FILTER_SANITIZE_STRING);
            $mesVencimiento = filter_var($_POST['mesVencimiento'], FILTER_SANITIZE_STRING);
            $anioVencimiento= filter_var($_POST['anioVencimiento'], FILTER_SANITIZE_STRING);
            $cvv = hash("sha256",filter_var($_POST['cvv'], FILTER_SANITIZE_STRING));
            $fechaRegistro = date("Y-m-d");
            $micarpeta = './tutor/'.$rfc.'/';
            $nombreFoto = $rfc.'.jpg';
            $queryExistenciaTutor = sprintf('SELECT idTutor FROM tutor WHERE idTutor = "'. $rfc.'";');
            $queryExistenciaTarjeta = sprintf('SELECT numeroTarjeta FROM tarjeta where numeroTarjeta = "'.$numeroTarjeta.'";');
            $resultadoExistenciaTutor = mysqli_query($conexion[1], $queryExistenciaTutor);
            $resultadoExistenciaTarjeta = mysqli_query($conexion[1], $queryExistenciaTarjeta);
            if(!mysqli_num_rows($resultadoExistenciaTutor)) {
                // Checamos que no tengamos registro de los datos de la tarjeta ingresada.
                $queryExistenciaCorreo = 'SELECT correoTutor from tutor where correoTutor = "'.$correo.'";';
                $resultadoExistenciaCorreo = mysqli_query($conexion[1], $queryExistenciaCorreo);
                if(!mysqli_num_rows($resultadoExistenciaCorreo)) {
                     // Eligió imagen de perfil.
                     if (!file_exists($micarpeta)) {
                        mkdir($micarpeta, 0777, true);
                        mkdir($micarpeta.'curso/', 0777, true);
                    }
                    if($_FILES['foto']['name'] != '') {
                        $checarImagen = @getimagesize($_FILES['foto']['tmp_name']);
                        if($checarImagen !== false) {
                            move_uploaded_file($_FILES['foto']['tmp_name'], $micarpeta.$nombreFoto);
                        }
                    }else { // Se le agrega una imagen por defecto por no tener imagen de perfil.
                        $fuente = './tutor/tutorSinImagen.jpg';
                        $destino = $micarpeta.$nombreFoto;
                        copy($fuente, $destino);
                    }
                    if(!mysqli_num_rows($resultadoExistenciaTarjeta)) {
                        $queryAgregarTarjeta = sprintf('call agregarTarjeta("'.$numeroTarjeta.'","'.$nombreTarjeta.'","'.$mesVencimiento.'","'.$anioVencimiento.'","'.$cvv.'");');
                        $resultadoAgregarTarjeta = mysqli_query($conexion[1], $queryAgregarTarjeta);
                    }else{
                        echo '<script> alert("Este número de tarjeta ya está registrado\nSe tomarán los datos correspondientes a este número de tarjeta");</script>';
                    }
                    $queryAgregarTutor = 'call agregarTutor("'.$rfc.'","'.$nombre.'","'.$correo.'","'.$password.'","'.$rol.'","'.$descripción.'","'.$fechaRegistro.'","'.$nombreFoto.'","'.$numeroTarjeta.'");';
                    $resultadoAgregarTutor = mysqli_query($conexion[1], $queryAgregarTutor);
                    if($resultadoAgregarTutor) {
                        echo '<script> alert("Tutor agregado con éxito");</script>';
                    }else{
                        echo '<script> alert("Hubo un error al agregar al tutor");</script>';
                    }
                }else{
                    echo '<script> alert("El correo ingresado ya existe en la base de datos");</script>';
                }
            }else{
                echo '<script> alert("El ID ingresado ya existe en la base de datos");</script>';
                desconectar($conexion[1]);
            }
        }
    }
?> 