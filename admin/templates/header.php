<?php
// Inicia la sesión
session_start();

// URL base para redireccionar
$url_base = "http://localhost/website/admin/";

// Si el usuario no ha iniciado sesión, redirige al inicio de sesión
if (!isset($_SESSION['usuario'])) {
    header("Location:" . $url_base . "login.php");
}
?>

<!doctype html>
<html lang="en" >
<head>
  <title>Administrador</title>

  <meta charset="utf-8">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">


    <script
  src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
  crossorigin="anonymous"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 


</head>
<body >
  <header>
    <!-- place navbar here -->
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#" aria-current="page">Administrador <span class="visually-hidden">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/recetas/">Recetas</a>
            <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/recetas_desplegables/">Recetas desplegables</a>
            <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/entradas/">Entradas</a>
            <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/equipo/">equipo</a>
            <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/configuraciones/">Configuraciones</a>
            <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/usuarios/">Usuarios</a>
            <a class="nav-item nav-link" href="<?php echo $url_base;?>cerrar.php">Cerrar sesión</a>
           
        </div>
    </nav>
  </header>
  <main class="container" >

  <br/>


  <script>
            <?php if (isset($_GET['mensaje'])) { ?>
                // Muestra una notificación de éxito si se proporciona un mensaje en la URL
                Swal.fire({ icon: "success", title: "<?php echo $_GET['mensaje']; ?>" });
            <?php } ?>
        </script>





     









  <style>
    /* Estilos generales */
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }

    header {
      padding: 20px 0;
      background-color: black;
      color: #ffffff;
      text-align: center;
    }

    header .navbar {
      justify-content: center;
    }

    header .nav-item {
      margin-right: 15px;
    }

    main {
      padding-top: 20px;
    }

    /* Estilos para la línea separadora */
    .separator-line {
      width: 100%;
      height: 1px;
      background-color: #ddd;
      margin: 20px 0;
    }
  </style>