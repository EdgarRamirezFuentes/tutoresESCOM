<?php 
    require('./modify-admin-view.php');
    require('./conexion.php');
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $situacion = 0;
        $conexion = conectar();
        if($conexion[0]) {
            $rfc = strtoupper(filter_var($_POST['rfc'], FILTER_SANITIZE_STRING));
            $nombre = strtoupper(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
            $correo = strtoupper(filter_var($_POST['email'], FILTER_SANITIZE_STRING));
            $password = hash("sha256",strtoupper(filter_var($_POST['password'], FILTER_SANITIZE_STRING)));
            $queryBusquedaUsuario = ('SELECT idAdmin from admin where idAdmin = "'.$rfc.'";');
            $resultadoBusquedaUsuario = mysqli_query($conexion[1], $queryBusquedaUsuario);
            if(mysqli_num_rows($resultadoBusquedaUsuario)) {
                $queryBusquedaCorreo = sprintf('SELECT idAdmin, correoAdmin FROM admin WHERE correoAdmin="'.$correo.'" and idAdmin != "'.$rfc.'";');
                $resultadoBusquedaCorreo = mysqli_query($conexion[1],$queryBusquedaCorreo);
                if(!mysqli_num_rows($resultadoBusquedaCorreo)) {
                    $queryModificar = sprintf('call modificarAdmin("'.$rfc.'","'.$nombre.'","'.$correo.'","'.$password.'");');
                    $resultadoModificar = mysqli_query($conexion[1],$queryModificar);
                    if($resultadoModificar) {
                        echo '<script> alert("Usuario modificado correctamente");</script>';
                        desconectar($conexion[1]);
                    }else{
                        echo '<script> alert("Hubo un error al modificar el usuario");</script>';
                        desconectar($conexion[1]);
                    }
                }else{
                    echo '<script> alert("El correo ingresado ya existe en la base de datos");</script>';
                    desconectar($conexion[1]);
                }
            }else{
                echo '<script> alert("El ID ingresado no existe en la base de datos");</script>';
                desconectar($conexion[1]);
            }
        }     
    }
?>