<?php 
    session_start();
    require './conexion.php';
    $conexion = conectar();
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($conexion[0]) {
            $idTutor = $_SESSION['idUsuario'];
            $idCurso = (int) filter_var($_POST['id'], FILTER_SANITIZE_STRING);
            $nombreCurso = str_replace(" ", "_", strtoupper(filter_var($_POST['curso'], FILTER_SANITIZE_STRING)));
            $nombreContent = str_replace(" ", "_",filter_var($_POST['name'], FILTER_SANITIZE_STRING));
            $path = './tutor/'.$idTutor.'/curso/'.$nombreCurso.'/'.$nombreContent.'.mp4';
            $queryExistencia = 'SELECT nombreContenido from contenido where idCurso = '.$idCurso.'nombreContenido ="'.str_replace("_"," ", $nombreContent).'";';
            $resultadoExistencia = mysqli_query($conexion[1], $queryExistencia);
            if(!mysqli_num_rows($resultadoExistencia)) {
                $queryAgregar = 'call agregarContenido('.$idCurso.',"'.str_replace("_"," ",$nombreContent).'");';
                var_dump($queryAgregar);
                $resultadoAgregar = mysqli_query($conexion[1], $queryAgregar);
                if($resultadoAgregar) {
                    move_uploaded_file($_FILES['content']['tmp_name'], $path);
                }
                header('Location: ./tutor-principal-course.php');
            }else {
                header('Location: ./tutor-index.php');
            }
        }
    }
?> 