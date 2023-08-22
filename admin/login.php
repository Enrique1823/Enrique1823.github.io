<?php 
// Inicia la sesión para poder usar variables de sesión
session_start();

// Si se ha enviado el formulario (POST)
if ($_POST) {
    // Incluye el archivo de conexión a la base de datos
    include("./bd.php");

    // Obtiene los valores de usuario y contraseña del formulario, o asigna cadena vacía si no están definidos
    $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : "";
    $password = (isset($_POST['password'])) ? $_POST['password'] : "";

    // Prepara la consulta SQL para verificar el usuario y contraseña en la base de datos
    $sentencia = $conexion->prepare("SELECT *, count(*) as n_usuario
        FROM `tbl_usuarios`
        WHERE usuario=:usuario
        AND password=:password
    ");
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);

    // Ejecuta la consulta
    $sentencia->execute();

    // Obtiene los resultados de la consulta
    $lista_usuarios = $sentencia->fetch(PDO::FETCH_LAZY);

    // Si se encontró un usuario con los datos proporcionados
    if ($lista_usuarios['n_usuario'] > 0) {
        // Almacena el nombre de usuario en una variable de sesión
        $_SESSION['usuario'] = $lista_usuarios['usuario'];
        // Establece el estado de inicio de sesión en verdadero
        $_SESSION['logueado'] = true;
        // Redirige a la página de inicio del administrador
        header("Location:index.php");
    } else {
        // Si no se encontró un usuario con los datos proporcionados, muestra un mensaje de error
        $mensaje = "ERROR: el usuario o contraseña son incorrectos. Intente nuevamente :)";
    }
}
?>

<!-- HTML para la página de inicio de sesión -->
</br>
</br>
</br>
</br>
</br>
</br>
<!doctype html>
<html lang="en">

<head>
  <title>INICIO DE SESIÓN ADMIN</title>
  <link rel="icon" type="image/x-icon" href="assets/img/logoapp.png" />

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>

  <div class="container">
    <div class="row">
      <div class="col-4">
       
      </div>
      <div class="col-4">
      <?php if (isset($mensaje)) { ?>
        <!-- Muestra un mensaje de error si el inicio de sesión falla -->
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong><?php echo $mensaje; ?></strong>
          </div>
          <?php } ?>
        <div class="card">
          <div class="card-header">
            LOGIN
          </div>
          <div class="card-body">
            <!-- Coloca el formulario de inicio de sesión aquí -->
          </div>
          <script>
            // Inicializa las alertas de Bootstrap
            var alertList = document.querySelectorAll('.alert');
            alertList.forEach(function (alert) {
              new bootstrap.Alert(alert)
            })
          </script>

          


          <form action="" method="post">

          <div class="mb-3">
            <label for="usuario" class="form-label">USUARIO</label>
            <input type="text"
              class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="">
              <i class="bi bi-eye"></i>
          </div>

          <div class="mb-3">
            <label for="contrasenia" class="form-label">CONTRASEÑA</label>
            <input type="password"
              class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
            
          </div>

          <input name="" id="" class="btn btn-primary" type="submit" value="Entrar">

        
          </form>

        
        </div>

        <style>
        body {
            background-color: #f5f5f5;
        }

        .card {
            margin: 50px auto;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 15px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .card-body {
            padding: 20px;
        }

        .alert {
            border-radius: 5px;
        }

        .form-label {
            font-weight: bold;
        }

        .bi-eye {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>

          





      </div>
      
    </div>
  </div>



  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>









</html>




