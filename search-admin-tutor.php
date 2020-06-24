<?php
    session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.0.1">
  <title>Lista de alumnos</title>

  <!-- CSS only -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <!-- JS, Popper.js, and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
  </script>



  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="./styles/form-validation.css" rel="stylesheet">
</head>

<body class="bg-light">
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="./admin-index.php">tutoresESCOM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <span class="nav-link" href="./admin-index.php"> Bienvenido <?php echo $_SESSION['usuario'];?> <span
              class="sr-only">(current)</span></span>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="admin-principal-curso.php">Cursos</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="admin-principal-tutor.php">Tutores</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="admin-principal-alumno.php">Alumnos</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="./admin-principal.php">Administradores</a>
        </li>
        <li class="nav-item active">
          <form action="cerrar-sesion.php" method="post">
            <button class="nav-link btn btn-danger">Cerrar sesión</btn>
          </form>
        </li>
      </ul>
    </div>
</nav>
<div class="container">
    <div class="py-5 text-center">
      <h2>Buscar tutor</h2>
    </div>
    <div class="col-md-12 order-md-1">
      <h4 class="mb-3">Datos del tutor</h4>
      <form class="needs-validation" method="post" action="./search-admin-tutor.php" novalidate>
        <div class="row">
          <div class="mb-3 col-sm-12">
            <label for="RFC">Ingresa el ID  o nombre del tutor a buscar </label>
            <input type="RFC" class="form-control" id="RFC" placeholder="Ingresa el RFC o nombre del tutor" name="rfc" required>
            <div class="invalid-feedback">
              Campo requerido
            </div>
          </div>
            <div class="mt-3 mb-3 col-sm-12">
              <button class="btn btn-primary btn-lg btn-block mb-3" type="submit">Buscar tutor</button>
              <a href="./admin-principal-tutor.php">
                <p class="btn btn-danger btn-lg btn-block">Volver</p>
              </a>
            </div>
          </div>
      </form>
    </div>
  </div>
  <?php 
        require './conexion.php';
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $conexion = conectar();
            if($conexion[0]) {
                $parametro = strtoupper(filter_var($_POST['rfc'], FILTER_SANITIZE_STRING));
                echo '
                <div class="container">
                    <div class="my-3 p-3 bg-white rounded shadow-sm mt-5">
                        <h6 class="border-bottom border-gray pb-2 mb-0 mt-5">Listado de tutores</h6>';
                        $query = sprintf('call buscarTutor("'.$parametro.'");');
                        $resultado = mysqli_query($conexion[1],$query);
                        while($fila = mysqli_fetch_assoc($resultado)) {
                            $rutaImagen = "./tutor/".$fila['idTutor']."/".$fila['fotografiaTutor'];
                            echo '
                                <div class="media text-muted pt-3">
                                    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <div>
                                            <img class="rounded w-25 float-left mr-5 rounded" src="'.$rutaImagen.'" alt="'.$fila['nombreTutor'].' height: inherit>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center w-100">
                                            <strong class="d-block mb-2"> ID Tutor: '.$fila['idTutor'].'</strong>
                                        </div>
                                        <span class="d-block mb-2"> Nombre: '.$fila['nombreTutor'].'</span>
                                        <span class="d-block mb-2"> Correo: '.$fila['correoTutor'].'</span>
                                        <span class="d-block mb-2"> Fecha de registro: '.$fila['fechaRegistroTutor'].'</span>     
                                    </div>
                                </div>
                            ';
                        }   
                echo '
                    </div>
                </div>';
            }
        }
    ?>
  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">tutoresESCOM &copy;</p>
  </footer>
  </div>
  <script src="./scripts/form-validation.js"></script>
</body>

</html>

