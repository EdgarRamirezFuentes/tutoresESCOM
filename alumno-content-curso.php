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
  <title>Datos del curso</title>

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
          <a class="nav-link" href="#">Tutores</a>
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
  <div class="container">
    <div class="my-3 p-3 bg-white rounded shadow-sm mt-5">
    <h6 class="border-bottom border-gray pb-2 mb-0 mt-5">Contenido del curso</h6>
    <?php 
        require './conexion.php';
        $conexion = conectar();
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($conexion[0]) {
                $idCurso = (int) filter_var($_POST['id'], FILTER_SANITIZE_STRING);
                $queryContenido = 'select nombreContenido from contenido where idCurso = '.$idCurso.' order by nombreContenido;';
                $query = sprintf('SELECT * FROM cursoRegistradosAdmin where idCurso ='.$idCurso.';');
                $queryInscrito = 'select * from inscripcion where idAlumno = "'.$_SESSION['idUsuario'].'" and idCurso ='.$idCurso.';';
                $resultado = mysqli_query($conexion[1],$query);
                $resultadoInscrito = mysqli_query($conexion[1], $queryInscrito);
                $resultadoContenido = mysqli_query($conexion[1],$queryContenido);
                while($fila = mysqli_fetch_assoc($resultado)) {
                    echo '
                    <form class="needs-validation" method="post" action="./inscripcion-curso.php" novalidate>
                        <div class="media text-muted pt-3">
                            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <input type="hidden" class="form-control" value="'.$fila['idCurso'].'" name="id" required>
                            <input type="hidden" class="form-control" value="'.$_SESSION['idUsuario'].'" name="usuario" required>
                            <input type="hidden" class="form-control" value="'.$fila['precioCurso'].'" name="precio" required>
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <strong class="d-block"> Nombre del curso: '.$fila['nombreCurso'].'</strong>
                                </div>
                                <span class="d-block text-gray-dark"> Tutor: '.$fila['nombreTutor'].'</span>
                                <span class="d-block text-gray-dark"> Categoria: '.$fila['descripcionCategoria'].'</span>
                                <span class="d-block"> Idioma: '.$fila['descripcionIdioma'].'</span>
                                <span class="d-block"> Institución: '.$fila['descripcionInstitucion'].'</span>
                                <span class="d-block"> Precio: '.$fila['precioCurso'].'</span>
                                <span class="d-block"> Descripción: </span>
                                <span class="d-block">'.$fila['descripcionCurso'].'</span>
                                ';
                                if(!mysqli_num_rows($resultadoInscrito)) {
                                    echo '
                                    <div class="mt-3 mb-3 col-sm-12">
                                        <button class="btn btn-primary btn-lg btn-block mb-3" type="submit">Inscribirse</button>
                                    </div>
                                    <strong class="d-block"> Contenido: </strong>
                                    ';
                                    while($contenido= mysqli_fetch_assoc($resultadoContenido)) {
                                      echo '<span class="d-block mb-3">'.$contenido['nombreContenido'].'</span>';
                                    }
                                }else{
                                  echo '<strong class="d-block"> Contenido: </strong>
                                    ';
                                    while($contenido= mysqli_fetch_assoc($resultadoContenido)) {
                                      echo '
                                      <form class="needs-validation" method="post" action="./ver-contenido.php" novalidate>
                                        <input type="hidden" name="nombreContenido" value="'.$contenido['nombreContenido'].'">
                                        <input type="hidden" name="nombreCurso" value="'.$fila['nombreCurso'].'">
                                        <span class="d-block">'.$contenido['nombreContenido'].'</span>
                                        <button class="btn btn-outline-primary mb-3" type="submit">Ver contenido</button>
                                      </form>
                                      ';
                                    }
                                }
                            echo '</div>
                        </div>
                    </form>
                    ';
                }
            }
        }
    ?>
    </div>
  </div>
  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">tutoresESCOM &copy;</p>
  </footer>
  </div>
  <script src="./scripts/form-validation.js"></script>
</body>

</html>

