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
  <title>Página principal alumno</title>

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

  <!-- Custom styles for this template -->
  <link href="./styles/starter-template.css" rel="stylesheet">

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
</head>

<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="./alumno-index.php">tutoresESCOM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <span class="nav-link" href="./alumno-index.php"> Bienvenido <?php echo $_SESSION['nombreUsuario'];?> <span
              class="sr-only">(current)</span></span>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="./alumno-principal-curso.php">Cursos</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="./modify-alumno.php">Modificar mis datos</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="./recibos-alumno.php">Recibos de inscripciones</a>
        </li>
        <li class="nav-item active">
          <form action="cerrar-sesion.php" method="post">
            <button class="nav-link btn btn-danger">Cerrar sesión</btn>
          </form>
        </li>
      </ul>
    </div>
  </nav>
  <main role="main" class="container-fluid text-center">
    <h1 class="mb-5">Menú mis cursos</h1>
    <div class="row">
        <div class="col-sm-6 mt-5 text-center">
            <a href="./mis-cursos-alumno.php" class="btn btn-primary">Mostrar mis cursos</a>
        </div>
        <div class="col-sm-6 mt-5 text-center">
            <a href="./show-alumno-curso.php" class="btn btn-primary">Mostrar todos los cursos</a>
        </div>
    </div>
  </main>
</body>

</html>
