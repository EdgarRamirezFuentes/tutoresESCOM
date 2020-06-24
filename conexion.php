<?php
    function conectar() {
        $conn = mysqli_connect("localhost", "root","","tutoresescom");
        if(mysqli_connect_errno()) {
            echo 'Error en conectar la base de datos';
            return [false,$conn];
        }else{
            return [true,$conn];
        }
    }

    function desconectar($conn) {
        mysqli_close($conn);
    }
?>