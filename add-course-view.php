<!doctype html>
<html lang="en">
<?php 
  require './conexion.php';
  session_start();
  $conexion = conectar();
  if($conexion[0]) {
    $queryCategoria = 'select * from categoria order by descripcionCategoria';
    $queryInstitucion = 'select * from institucion order by descripcionInstitucion';
    $queryIdioma = 'select * from idioma order by descripcionIdioma';
    $resultadoCategoria = mysqli_query($conexion[1], $queryCategoria);
    $resultadoInstitucion = mysqli_query($conexion[1], $queryInstitucion);
    $resultadoIdioma = mysqli_query($conexion[1], $queryIdioma);
  }
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.0.1">
  <title>Registro de curso</title>

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
      <h2>Formulario de registro del curso</h2>
    </div>
    <div class="col-md-12 order-md-1">
      <h4 class="mb-3">Datos del curso</h4>
      <form class="needs-validation" method="post" action="./add-course.php" novalidate>
        <div class="row">
          <div class="mb-3 col-sm-12">
            <label for="nombre">Nombre del curso</label>
            <input type="text" class="form-control" placeholder="Ingresa el nombre del curso" name="name" required>
            <div class="invalid-feedback">
              Campo requerido
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <label>Categoría</label>
            <div class="container">
              <div class="row">    
                <select name="categoria" class="col-sm-6 form-control">
                  <?php
                    while($datos = mysqli_fetch_assoc($resultadoCategoria)) {
                      echo '<option value="'.$datos['idCategoria'].'">'.$datos['descripcionCategoria'].'</option>';
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <label>Institución</label>
            <div class="container">
              <div class="row">    
                <select name="institucion" class="col-sm-6 form-control">
                  <?php
                    while($datos = mysqli_fetch_assoc($resultadoInstitucion)) {
                      echo '<option value="'.$datos['idInstitucion'].'">'.$datos['descripcionInstitucion'].'</option>';
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <label>Idioma</label>
            <div class="container">
              <div class="row">    
                <select name="idioma" class="col-sm-6 form-control">
                  <?php
                    while($datos = mysqli_fetch_assoc($resultadoIdioma)) {
                      echo '<option value="'.$datos['idIdioma'].'">'.$datos['descripcionIdioma'].'</option>';
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <div class="mb-3">
              <label for="email">Descripción <span class="text-muted"></span></label>
              <textarea  class="form-control" cols="50" rows="10" name="descripcion" required>Profesor</textarea>
              <div class="invalid-feedback">
                Campo requerido
              </div>
            </div>
            <div class="mb-3 col-sm-3">
            <label for="nombre">Precio del curso</label>
            <input type="number" class="form-control" step="any" name="precio" required>
            <div class="invalid-feedback">
              Campo requerido
            </div>
          </div>
            <div class="mt-3 mb-3">
              <button class="btn btn-primary btn-lg btn-block mb-3" type="submit">Agregar curso</button>
              <a href="./tutor-principal-course.php">
                <p class="btn btn-danger btn-lg btn-block">Cancelar</p>
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
