<?php
// Incluir el archivo de conexión a la base de datos
include("../../bd.php");

// Verificar si se ha enviado una solicitud POST
if ($_POST) {
    // Obtener los valores enviados desde el formulario o establecer valores predeterminados
    $nombreconfiguracion = (isset($_POST['nombreconfiguracion'])) ? $_POST['nombreconfiguracion'] : "";
    $valor = (isset($_POST['valor'])) ? $_POST['valor'] : "";

    // Preparar la sentencia SQL para insertar en la tabla 'tbl_configuraciones'
    $sentencia = $conexion->prepare("INSERT INTO `tbl_configuraciones` (`ID`, `nombreconfiguracion`, `valor`)
        VALUES (NULL,:nombreconfiguracion,:valor );");

    // Vincular los parámetros con los valores obtenidos del formulario
    $sentencia->bindParam(":nombreconfiguracion", $nombreconfiguracion);
    $sentencia->bindParam(":valor", $valor);

    // Ejecutar la sentencia SQL para insertar los datos en la base de datos
    $sentencia->execute();

    // Redireccionar a 'index.php' con un mensaje de éxito
    $mensaje = "Configuración agregada con éxito";
    header("Location:index.php?mensaje=".$mensaje);
}

// Incluir la cabecera de la página
include("../../templates/header.php");
?>



<div class="card">
    <div class="card-header">
        Configuración
    </div>
    <div class="card-body">
    
    <form action="" method="post">



    <div class="mb-3">
      <label for="nombreconfiguracion" class="form-label">Nombre:</label>
      <input type="text"
        class="form-control" name="nombreconfiguracion" id="nombreconfiguracion" aria-describedby="helpId" placeholder="Nombre de la configuración">
    
    </div>

    <div class="mb-3">
      <label for="valor" class="form-label">Valor:</label>
      <input type="text"
        class="form-control" name="valor" id="valor" aria-describedby="helpId" placeholder="Valor de la configuración">
     
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