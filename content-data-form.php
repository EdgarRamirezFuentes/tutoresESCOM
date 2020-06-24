<?php 
    session_start();
    require './conexion.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conexion = conectar();
        if($conexion[0]) {
            $idCurso = (int) filter_var($_POST['curso'], FILTER_SANITIZE_STRING);
            $queryCurso = 'SELECT nombreCurso from curso where idCurso = '.$idCurso.';';
            $nombre = mysqli_fetch_assoc(mysqli_query($conexion[1], $queryCurso))['nombreCurso'];
        }
    }
?>  

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.0.1">
  <title>Modificar alumno</title>

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
  <div class="container">
    <div class="py-5 text-center">
      <h2>Formulario de datos del nuevo contenido del curso</h2>
    </div>
    <div class="col-md-12 order-md-1">
      <h4 class="mb-3"><?php echo $nombre; ?></h4>
      <form class="needs-validation" method="post" enctype="multipart/form-data" action="./add-content-tutor.php" novalidate>
      <input type="hidden" value="<?php echo $idCurso;?>" class="form-control"  name="id" required>
      <input type="hidden" value="<?php echo $nombre;?>" name="curso" required>
        <div class="row">
          <div class="col-md-12 mb-3">
            <label for="firstName">Nombre del contenido</label>
            <input type="text" class="form-control" placeholder="Ingresa el nombre del contenido" name="name" required>
            <div class="invalid-feedback">
              Campo requerido
            </div>
            <div class="mb-3">
              <label for="address2">Video a agregar <span class="text-muted"></span></label>
              <input type="file" class=" col-sm-6 form-control" name="content" required>
            </div>
            <div class="mb-3 mt-3">
              <button class="btn btn-primary btn-lg btn-block mb-3" type="submit">Agregar contenido</button>
              <a href="./add-content-tutor-view.php">
                <p class="btn btn-danger  btn-lg btn-block">Volver</p>
              </a>
            </div>
          </div>
      </form>
    </div>
  </div>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">tutoresESCOM &copy;</p>
  </footer>
  </div>
  <script src="./scripts/form-validation.js"></script>
</body>

</html>
