<?php 
    require './delete-admin-alumno-view.php';
    require './conexion.php';
    function borrarRegistro($carpeta) {
        foreach(glob($carpeta . "*") as $archivos_carpeta){             
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
            $query = sprintf('SELECT idAlumno, numeroTarjeta FROM alumno WHERE idAlumno="'.$rfc.'";');
            $resultado = mysqli_query($conexion[1],$query);
            $miCarpeta = './alumno/'.$rfc.'/';
            if(mysqli_num_rows($resultado)) {
                $datosUsuario = mysqli_fetch_assoc(($resultado));
                $tarjeta = $datosUsuario['numeroTarjeta'];
                $queryEliminar = sprintf('call eliminarAlumno("'.$rfc.'");');
                $resultadoEliminar = mysqli_query($conexion[1],$queryEliminar);
                if($resultadoEliminar) {
                    if(file_exists($miCarpeta)) {
                        borrarRegistro($miCarpeta);
                    }
                    $queryBusquedaTarjeta = 'SELECT count(*) as "cantidadTarjetas" FROM alumno where numeroTarjeta = "' .$tarjeta.'";';
                    $resultadoTarjetas = mysqli_query($conexion[1], $queryBusquedaTarjeta);
                    $cantidadTarjetas = mysqli_fetch_assoc($resultadoTarjetas);
                    if(!$cantidadTarjetas['cantidadTarjetas']) {
                        $queryEliminarTarjeta = 'call eliminarTarjeta("'.$tarjeta.'");';
                        $resultado = mysqli_query($conexion[1], $queryEliminarTarjeta);
                    }
                    desconectar($conexion[1]);
                }
                echo '<script> alert("Alumno eliminado correctamente");</script>';
            }else{
                echo '<script> alert("Ese usuario no existe");</script>';
                desconectar($conexion[1]);
            }
        }
    }

?>