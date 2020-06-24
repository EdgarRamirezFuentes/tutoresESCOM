<?php 
    require './delete-tutor-course-view.php';
    function borrarRegistro($carpeta) {
        $archivos = glob($carpeta . "/*");
        if(count($archivos) != 0) {
            foreach($archivos as $archivos_carpeta){             
                unlink($archivos_carpeta);
            }
        }
        rmdir($carpeta);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($conexion[0]) {
            $idCurso = (int) filter_var($_POST['curso'], FILTER_SANITIZE_STRING);
            $queryNombreCurso = 'select nombreCurso from curso where idCurso = '.$idCurso.';';
            $queryEliminar = sprintf('call eliminarCurso('.$idCurso.');');
            $resultadoNombreCurso = mysqli_query($conexion[1], $queryNombreCurso);
            $resultadoEliminar = mysqli_query($conexion[1],$queryEliminar);
            if($resultadoEliminar) {
                $nombreCurso = str_replace(" ", "_", mysqli_fetch_assoc($resultadoNombreCurso)['nombreCurso']);
                echo '<script> alert("Curso eliminado con éxito");</script>';
                $path = './tutor/'.$_SESSION['idUsuario'].'/'.'curso/'. $nombreCurso;
                borrarRegistro($path);
                desconectar($conexion[1]);
            }
        }
    }

?>