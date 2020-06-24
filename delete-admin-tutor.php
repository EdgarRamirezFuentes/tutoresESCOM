<?php 
    require './delete-admin-tutor-view.php';
    require './conexion.php';

    function borrarRegistro($carpeta) {
        $archivos = glob($carpeta . "/*");
        foreach($archivos as $archivos_carpeta){             
            if (is_dir($archivos_carpeta)){
                borrarRegistro($archivos_carpeta);
            }else {
                unlink($archivos_carpeta);
            }
        }
        rmdir($carpeta);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conexion = conectar();
        if($conexion[0]) {
            $rfc = strtoupper(filter_var($_POST['rfc'], FILTER_SANITIZE_STRING));
            $query = sprintf('SELECT idTutor FROM tutor WHERE idTutor="'.$rfc.'";');
            $resultado = mysqli_query($conexion[1],$query);
            $miCarpeta = './tutor/'.$rfc;
            if(mysqli_num_rows($resultado)) {
                $datosUsuario = mysqli_fetch_assoc(($resultado));
                $queryEliminar = sprintf('call eliminarTutor("'.$rfc.'");');
                $resultadoEliminar = mysqli_query($conexion[1],$queryEliminar);
                if($resultadoEliminar) {
                    if(file_exists($miCarpeta)) {
                        borrarRegistro($miCarpeta);
                    }
                    echo '<script> alert("Tutor eliminado correctamente");</script>';
                    desconectar($conexion[1]);
                }
                if(file_exists($miCarpeta)) {
                    borrarRegistro($miCarpeta);
                }
            }else{
                echo '<script> alert("Ese usuario no existe");</script>';
                desconectar($conexion[1]);
            }
        }
    }

?>