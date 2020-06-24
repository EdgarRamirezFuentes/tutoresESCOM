<?php 
    require './delete-admin-view.php';
    require './conexion.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conexion = conectar();
        if($conexion[0]) {
            $rfc = strtoupper(filter_var($_POST['rfc'], FILTER_SANITIZE_STRING));
            $query = sprintf('SELECT idAdmin FROM admin WHERE idAdmin="'.$rfc.'";');
            $resultado = mysqli_query($conexion[1],$query);
            $fila = mysqli_fetch_assoc($resultado);
            if($fila) {
                $queryEliminar = sprintf('call eliminarAdmin("'.$rfc.'");');
                $resultadoEliminar = mysqli_query($conexion[1],$queryEliminar);
                if($resultadoEliminar) {
                    echo '<script> alert("Usuario eliminado con éxito");</script>';
                    desconectar($conexion[1]);
                }
            }else{
                echo '<script> alert("Ese usuario no existe");</script>';
                desconectar($conexion[1]);
            }
        }
    }

?>