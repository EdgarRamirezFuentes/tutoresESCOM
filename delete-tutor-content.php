<?php 
    session_start();
    require './conexion.php';
    $conexion = conectar();
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($conexion[0]) {
            $idContent = (int) $_POST['idContent'];
            $queryNombre = 'select nombreContenido from contenido where idContenido ='.$_POST['idContent'].';';
            $idTutor = $_SESSION['idUsuario'];
            $nombreCurso = str_replace(" ", "_", strtoupper(filter_var($_POST['curso'], FILTER_SANITIZE_STRING)));
            $nombreContent = str_replace(" ", "_",filter_var(mysqli_fetch_assoc(mysqli_query($conexion[1], $queryNombre))['nombreContenido'], FILTER_SANITIZE_STRING));
            $path = './tutor/'.$idTutor.'/curso/'.$nombreCurso.'/'.$nombreContent.'.mp4';
            $queryEliminar = 'call eliminarContenido('.$idContent.');';
            $resultadoEliminar = mysqli_query($conexion[1], $queryEliminar);
            if($resultadoEliminar) {
                unlink($path);
                header('Location: ./tutor-principal-course.php');
            }else {
                header('Location: ./tutor-index.php');
            }
        }
    }
?> 