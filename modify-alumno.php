<?php 
    require './modify-alumno-view.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conexion = conectar();
        if($conexion[0]) {
            $rfc = strtoupper(filter_var($_POST['rfc'], FILTER_SANITIZE_STRING));
            $nombre = strtoupper(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
            $correo = strtoupper(filter_var($_POST['email'], FILTER_SANITIZE_STRING));
            $password = hash("sha256",strtoupper(filter_var($_POST['password'], FILTER_SANITIZE_STRING)));
            $rol = strtoupper(filter_var($_POST['rol'], FILTER_SANITIZE_STRING));
            $descripción = strtoupper(filter_var($_POST['descripcion'], FILTER_SANITIZE_STRING));
            $micarpeta = './alumno/'.$rfc.'/';
            $nombreFoto = $rfc.'.jpg';
            $queryExistenciaCorreo = 'SELECT idAlumno from alumno where correoAlumno = "'.$correo.'" and idAlumno != "'.$rfc.'";';
            $resultadoExistenciaCorreo = mysqli_query($conexion[1], $queryExistenciaCorreo);
            if(!mysqli_num_rows($resultadoExistenciaCorreo)) {
                if($_FILES['foto']['name'] != '') {
                    $checarImagen = @getimagesize($_FILES['foto']['tmp_name']);
                    if($checarImagen !== false) {
                        unlink($micarpeta.$nombreFoto);
                        move_uploaded_file($_FILES['foto']['tmp_name'], $micarpeta.$nombreFoto);
                    }
                }
                $queryModificarAlumno = 'call modificarAlumno("'.$rfc.'","'.$nombre.'","'.$correo.'","'.$password.'","'.$rol.'","'.$descripción.'");';
                $resultadoModificarAlumno = mysqli_query($conexion[1], $queryModificarAlumno);
                if($resultadoModificarAlumno) {
                    $_SESSION['nombreUsuario'] = $nombre;
                    echo '<script> alert("Datos modificados con éxito");</script>';
                }else{
                    echo '<script> alert("Hubo un error al modificar los datos");</script>';
                }
            }else{
                echo '<script> alert("El correo ingresado ya existe en la base de datos");</script>';
            }
        }
    }
?> 