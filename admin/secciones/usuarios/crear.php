<?php
// Incluir el archivo de conexión a la base de datos
include("../../bd.php");

// Verificar si se ha enviado una solicitud POST
if ($_POST) {
    // Obtener los valores del formulario o establecer valores predeterminados
    $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : "";
    $password = (isset($_POST['password'])) ? $_POST['password'] : "";
    $correo = (isset($_POST['correo'])) ? $_POST['correo'] : "";

    // Preparar y ejecutar la consulta para insertar un nuevo usuario en la tabla
    $sentencia = $conexion->prepare("INSERT INTO `tbl_usuarios`
     (`ID`, `usuario`, `password`, `correo`)
      VALUES (NULL,:usuario,:password,:correo);");

    // Vincular los parámetros con los valores obtenidos del formulario
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);
    $sentencia->bindParam(":correo", $correo);

    $sentencia->execute();

    // Redireccionar a 'index.php' con un mensaje de éxito
    $mensaje = "Usuario agregado con éxito";
    header("Location:index.php?mensaje=" . $mensaje);
}






 include("../../templates/header.php");?>

<div class="card">
    <div class="card-header">
        Usuario
    </div>
    <div class="card-body">
        
    <form action="" method="post">

        <div class="mb-3">
          <label for="" class="form-label">Nombre del Usuario:</label>
          <input type="text"
            class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del Usuario">

        </div>

        <div class="mb-3">
          <label for="" class="form-label">Password:</label>
          <input type="password"
            class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password">

        </div>

        <div class="mb-3">
          <label for="correo" class="form-label">Correo:</label>
          <input type="email" class="form-control" name="correo" id="correo" aria-describedby="emailHelpId" placeholder="Correo">
        </div>

        
    <button type="submit" class="btn btn-success">Agregar</button>

|
    <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>






    </form>
    </div>
    <div class="card-footer text-muted">


    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        /* Estilos para la tarjeta (card) */
        .card {
            width: 100%;
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            background-color: #ffffff;
        }

        .card-header {
            text-align: center;
            padding: 10px;
            background-color: #007bff;
            color: #ffffff;
            font-size: 24px;
            font-weight: bold;
            border-radius: 5px 5px 0 0;
        }

        /* Estilos para el formulario */
        .form-label {
            font-size: 16px;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-success,
        .btn-danger {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #ffffff;
            text-decoration: none;
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-success:hover,
        .btn-danger:hover {
            opacity: 0.8;
        }

        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn-group a {
            flex: 1;
        }

        .btn-group a:not(:last-child) {
            margin-right: 10px;
        }

        .card-footer {
            text-align: center;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 0 0 5px 5px;
        }
    </style>
      
    </div>
</div>




<?php include("../../templates/footer.php");?>