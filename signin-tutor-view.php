<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.0.1">
  <title>Iniciar sesión tutor</title>

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
  <link href="./styles/signin.css" rel="stylesheet">
</head>

<body class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
      <a href="./index.php"><button class="btn btn-lg btn-primary btn-block" name = "submitbtn" type="submit">Iniciar sesión como admin</button></a>
      </div>
      <div class="col-sm-6">
      <a href="./signin-alumno.php"><button class="btn btn-lg btn-primary btn-block" name = "submitbtn" type="submit">Iniciar sesión como alumno</button></a>
      </div>
    </div>
    <form class="form-signin col-sm-12" action="signin-tutor.php" method="POST">
    <img class="mb-4" src="" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Bienvenido tutor</h1>
    <input type="email"  class="form-control" name="email" placeholder="Ingresa tu correo electrónico" required autofocus>
    <input type="password" class="form-control" name="password" placeholder="Ingresa tu contraseña" required>
    <button class="btn btn-lg btn-primary btn-block" name = "submitbtn" type="submit">Iniciar sesión</button>
    <a href="./signup-tutor.php"><p class="mt-5 mb-3 text-muted">Crear cuenta</p></a>
    <p class="mt-5 mb-3 text-muted">tutoresESCOM &copy;</p>
  </form>
  </div>
</body>

</html>
