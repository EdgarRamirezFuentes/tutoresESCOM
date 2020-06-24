<?php 
    require './add-course-view.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($conexion[0]) {
            $idTutor = $_SESSION['idUsuario'];
            $nombre = strtoupper(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
            $categoria = (int) filter_var($_POST['categoria'], FILTER_SANITIZE_STRING);
            $precio = (float) filter_var($_POST['precio'], FILTER_SANITIZE_STRING);
            $idioma = (int) filter_var($_POST['idioma'], FILTER_SANITIZE_STRING);
            $institucion= (int) filter_var($_POST['institucion'], FILTER_SANITIZE_STRING);
            $descripción = strtoupper(filter_var($_POST['descripcion'], FILTER_SANITIZE_STRING));
            $fechaRegistro = date("Y-m-d");
            $nombreCarpeta = str_replace(" ", "_", $nombre);
            $micarpeta = './tutor/'.$idTutor.'/curso/'.$nombreCarpeta.'/';
            $queryExistenciaCurso = sprintf('SELECT nombreCurso FROM curso WHERE nombreCurso = "'. $nombre.'";');
            $resultadoExistenciaCurso = mysqli_query($conexion[1], $queryExistenciaCurso);
            if(!mysqli_num_rows($resultadoExistenciaCurso)) {
                if (!file_exists($micarpeta)) {
                    mkdir($micarpeta, 0777, true);
                }
                $queryAgregarCurso = 'call agregarCurso("'.$idTutor.'","'.$nombre.'","'.$descripción.'","'.$fechaRegistro.'",'.$precio.','.$idioma.','.$categoria.','.$institucion.');';
                $resultadoAgregarCurso = mysqli_query($conexion[1], $queryAgregarCurso);
                if($resultadoAgregarCurso) {
                    echo '<script> alert("Curso agregado con éxito");</script>';
                }else{
                    echo '<script> alert("Hubo un error al agregar el curso");</script>';
                }
            }else{
                echo '<script> alert("El curso ingresado ya existe en la base de datos");</script>';
                desconectar($conexion[1]);
            }
        }
    }

?>