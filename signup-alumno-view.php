<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.0.1">
  <title>Registro de alumno</title>

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
      <h2>Formulario de registro del alumno</h2>
    </div>
    <div class="col-md-12 order-md-1">
      <h4 class="mb-3">Datos del alumno</h4>
      <form class="needs-validation" enctype="multipart/form-data" method="post" action="./signup-alumno.php" novalidate>
        <div class="row">
          <div class="mb-3 col-sm-12">
            <label for="RFC">RFC </label>
            <input type="RFC" value="RAFE980812HDFMND" class="form-control" id="RFC" placeholder="Ingresa tu RFC" name="rfc" required>
            <div class="invalid-feedback">
              Campo requerido
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <label for="firstName">Nombre completo</label>
            <input type="text" class="form-control" id="firstName" placeholder="Ingresa tu nombre completo"
              name="name"  required>
            <div class="invalid-feedback">
              Campo requerido
            </div>
            <div class="mb-3">
              <label for="email">Email </label>
              <input value="@gmail.com" type="email" class="form-control" id="email" placeholder="Ingresa tu correo" name="email" required>
              <div class="invalid-feedback">
                Campo requerido
              </div>
            </div>

            <div class="mb-3">
              <label for="password">Contraseña</label>
              <input type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña"
                name="password" value="123" required>
              <div class="invalid-feedback">
                Campo requerido
              </div>
            </div>

            <div class="mb-3">
              <label for="titulo">Rol <span class="text-muted"></span></label>
              <input type="text" value="Web developer" class="form-control" id="titulo" placeholder="Ingresa tu grado académico"
                name="rol" required>
                <div class="invalid-feedback">
                  Campo requerido
                </div>
            </div>

            <div class="mb-3">
              <label for="email">Descripción <span class="text-muted"></span></label>
              <textarea  class="form-control" cols="50" rows="10" name="descripcion" required>Estudiante</textarea>
              <div class="invalid-feedback">
                Campo requerido
              </div>
            </div>
            <div class="mb-3">
              <label for="address2">Foto de perfil <span class="text-muted"></span></label>
              <input type="file" class=" col-sm-6 form-control" id="" name="foto">
              <div class="invalid-feedback">
                Campo requerido
              </div>
            </div>

            <h4 class="mb-3">Datos de la tarjeta</h4>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="cc-name">Nombre en la tarjeta o del propietario</label>
                <input type="text" class="form-control" id="cc-name"
                  placeholder="Ingresa el nombre del propietario de la tarjeta" name="nombreTarjeta" required>
                <div class="invalid-feedback">
                  Campo requerido
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="cc-number">Número de la tarjeta</label>
                <input type="text" class="form-control" id="cc-number" placeholder="Ingresa el número de la tarjeta"
                  name="numeroTarjeta" required>
                <div class="invalid-feedback">
                  Campo requerido
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label>Fecha vencimiento</label>
                <div class="container">
                  <div class="row">    
                    <select name="mesVencimiento" class="col-sm-6 form-control">
                      <?php
                        for($i = 1; $i <= 12; $i++) {
                          echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                      ?>
                    </select>
                    <select name="anioVencimiento" class="col-sm-6 form-control">
                      <?php
                        for($i = 2020; $i <= 2040; $i++) {
                          echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                      ?>
                    </select>
                  </div>
                </div>
                
              </div>
              <div class="col-md-6 mb-3">
                <label for="cc-cvv">CVV</label>
                <input value="123" type="text" class="form-control" name="cvv" id="cc-cvv" placeholder="" name="cvvTarjeta" required>
                <div class="invalid-feedback">
                  Campo requerido
                </div>
              </div>
            </div>
            <div class="mt-3 mb-3">
              <button class="btn btn-primary btn-lg btn-block mb-3" type="submit">Registrar usuario</button>
              <a href="./signin-alumno.php">
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
