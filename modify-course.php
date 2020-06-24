<?php
    require './modify-course-view.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($conexion[0]) {
            $idCurso =(int) filter_var($_POST['id'], FILTER_SANITIZE_STRING);
            $nombre = strtoupper(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
            $categoria = (int) filter_var($_POST['categoria'], FILTER_SANITIZE_STRING);
            $precio = (float) filter_var($_POST['precio'], FILTER_SANITIZE_STRING);
            $idioma = (int) filter_var($_POST['idioma'], FILTER_SANITIZE_STRING);
            $institucion= (int) filter_var($_POST['institucion'], FILTER_SANITIZE_STRING);
            $descripción = strtoupper(filter_var($_POST['descripcion'], FILTER_SANITIZE_STRING));
            $fechaRegistro = date("Y-m-d");
            $queryModificarCurso = 'call modificarCurso("'.$idCurso.'","'.$nombre.'","'.$descripción.'","'.$fechaRegistro.'",'.$precio.','.$idioma.','.$categoria.','.$institucion.');';
            $queryChecarNombre = 'select idCurso from curso where nombreCurso= "'.$nombre.'";';
            $resultadoChecarNombre = mysqli_query($conexion[1], $queryChecarNombre);
            $queryViejoNombre = 'select nombreCurso from  curso where idCurso = '.$idCurso.';';
            $resutadoViejoNombre = mysqli_query($conexion[1], $queryViejoNombre);
            $viejoNombre = str_replace(' ', '_', mysqli_fetch_assoc($resutadoViejoNombre)['nombreCurso']);
            if(!mysqli_num_rows($resultadoChecarNombre)) {
                $nombreCarpeta = str_replace(' ', '_', $nombre);
                $resultadoModificarCurso = mysqli_query($conexion[1], $queryModificarCurso);
                if($resultadoModificarCurso) {
                    rename('./tutor/'.$_SESSION['idUsuario'].'/'.'curso/'. $viejoNombre, './tutor/'.$_SESSION['idUsuario'].'/'.'curso/'. $nombreCarpeta);
                    echo '<script> alert("Se ha modificado correctamente el curso");</script>';
                }
            }else{
                echo '<script> alert("El nombre ingresado del curso ya existe");</script>';
            }
        }
    }
?>