<?php 
    require './conexion.php';
    $conexion = conectar();
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($conexion[0]) {
            $idCurso = (int) filter_var($_POST['id'], FILTER_SANITIZE_STRING);
            $idAlumno = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
            $precio = (float) filter_var($_POST['precio'], FILTER_SANITIZE_STRING);
            $fechaInscripcion = date("Y-m-d");
            $queryInscribir = sprintf('call inscribirCurso('.$idCurso.',"'.$idAlumno.'","'.$fechaInscripcion.'",'.$precio.');');
            var_dump($queryInscribir);
            $resultadoInscribir = mysqli_query($conexion[1],$queryInscribir);
            if($resultadoInscribir) {
                echo '<script> alert("Inscrito con éxito");</script>';
                header('Location: ./alumno-index.php');
                desconectar($conexion[1]);
            }
        }
    }

?>