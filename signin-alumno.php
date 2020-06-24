<?php
    require './signin-alumno-view.php';
    require './conexion.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conexion = conectar();
        if($conexion[0]) {
            $correo = strtoupper(filter_var($_POST['email'], FILTER_SANITIZE_STRING));
            $password = hash("sha256",strtoupper(filter_var($_POST['password'], FILTER_SANITIZE_STRING)));
            $query = sprintf('SELECT idAlumno, nombreAlumno FROM alumno WHERE correoAlumno ="'.$correo.'" AND contraseniaAlumno="'.$password.'";');
            $resultado = mysqli_query($conexion[1],$query);
            if(mysqli_num_rows($resultado)) {
                session_start();
                $fila = mysqli_fetch_assoc($resultado);
                $_SESSION["nombreUsuario"] = $fila['nombreAlumno'];
                $_SESSION["idUsuario"] = $fila['idAlumno'];
                desconectar($conexion[1]);
                header('Location: ./alumno-index.php');
            }else{
                echo '
                <script>
                    alert("Correo o contraseña incorrectos");
                </script>';
                desconectar($conexion[1]);
            }
        }
    }
?>