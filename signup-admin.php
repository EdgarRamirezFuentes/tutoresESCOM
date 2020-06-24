<?php 
    require('./signup-admin-view.php');
    require('./conexion.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $situacion = 0;
        $conexion = conectar();
        if($conexion[0]) {
            $rfc = strtoupper(filter_var($_POST['rfc'], FILTER_SANITIZE_STRING));
            $nombre = strtoupper(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
            $correo = strtoupper(filter_var($_POST['email'], FILTER_SANITIZE_STRING));
            $password = hash("sha256",strtoupper(filter_var($_POST['password'], FILTER_SANITIZE_STRING)));
            $queryBusqueda = sprintf('SELECT correoAdmin FROM admin WHERE correoAdmin="'.$correo.'";');
            $resultadoBusqueda = mysqli_query($conexion[1],$queryBusqueda);
            if(!$resultadoBusqueda) {
                $queryAgregar = sprintf('call agregarAdmin("'.$rfc.'","'.$nombre.'","'.$correo.'","'.$password.'");');
                $resultadoAgregar = mysqli_query($conexion[1],$queryAgregar);
                if($resultadoAgregar) {
                    echo '<script> alert("Usuario agregado correctamente");</script>';
                    desconectar($conexion[1]);
                }else{
                    echo '<script> alert("El ID ingresado ya existe en la base de datos");</script>';
                    desconectar($conexion[1]);
                }
            }else{
                echo '<script> alert("El correo ingresado ya existe en la base de datos");</script>';
                desconectar($conexion[1]);
            }
        }
    }

?>