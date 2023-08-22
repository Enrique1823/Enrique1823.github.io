<?php 
// Incluir el archivo de conexión a la base de datos
include("../../bd.php");






// Verificar si se ha proporcionado un parámetro 'txtID' en la URL
if (isset($_GET['txtID'])) {
    // Obtener el valor de 'txtID' de la URL
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    // Preparar y ejecutar la consulta para obtener los datos de la configuración con el ID especificado
    $sentencia = $conexion->prepare("SELECT * FROM tbl_configuraciones WHERE id=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    // Obtener los valores de la configuración desde el resultado de la consulta
    $nombreconfiguracion = $registro['nombreconfiguracion'];
    $valor = $registro['valor'];
}

// Verificar si se ha enviado una solicitud POST (al editar una configuración existente)
if ($_POST) {
    // Obtener los valores del formulario o establecer valores predeterminados
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $nombreconfiguracion = (isset($_POST['nombreconfiguracion'])) ? $_POST['nombreconfiguracion'] : "";
    $valor = (isset($_POST['valor'])) ? $_POST['valor'] : "";

    // Preparar la sentencia SQL para actualizar los datos de la configuración
    $sentencia = $conexion->prepare("UPDATE `tbl_configuraciones`
    SET nombreconfiguracion=:nombreconfiguracion,valor=:valor WHERE id=:id;");

    // Vincular los parámetros con los valores obtenidos del formulario
    $sentencia->bindParam(":nombreconfiguracion", $nombreconfiguracion);
    $sentencia->bindParam(":valor", $valor);
    $sentencia->bindParam(":id", $txtID);

    // Ejecutar la sentencia SQL para actualizar los datos en la base de datos
    $sentencia->execute();

    // Redireccionar a 'index.php' con un mensaje de éxito
    $mensaje = "Configuración editada con éxito";
    header("Location:index.php?mensaje=".$mensaje);
}






include("../../templates/header.php");?>

<div class="card">
    <div class="card-header">
        Configuración
    </div>
    <div class="card-body">
    
    <form action="" method="post">


        <div class="mb-3">
          <label for="txtID" class="form-label">ID:</label>
          <input readonly value="<?php echo $txtID;?>"  type="text"
            class="form-control"  name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">

        </div>

    <div class="mb-3">
      <label for="nombreconfiguracion" class="form-label">Nombre:</label>
      <input readonly value="<?php echo $nombreconfiguracion;?>" type="text"
        class="form-control" name="nombreconfiguracion" id="nombreconfiguracion" aria-describedby="helpId" placeholder="Nombre de la configuración">
    
    </div>

    <div class="mb-3">
      <label for="valor" class="form-label">Valor:</label>
      <input  value="<?php echo $valor;?>"  type="text"
        class="form-control" name="valor" id="valor" aria-describedby="helpId" placeholder="Valor de la configuración">
     
    </div>

    
    <button type="submit" class="btn btn-success">Actualizar</button>

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
            background-color: #fff;
        }

        .card-header {
            text-align: center;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
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
            color: #fff;
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