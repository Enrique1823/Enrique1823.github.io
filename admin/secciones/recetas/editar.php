<?php
// Incluye el archivo de conexión a la base de datos
include("../../bd.php");

// Verifica si se recibió el parámetro txtID en la URL (a través de GET)
if(isset($_GET['txtID'])){
    // Obtiene el valor del parámetro txtID o asigna una cadena vacía si no está definido
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    // Prepara la consulta SQL para seleccionar un registro de la tabla "recetas_normales" por su ID
    $sentencia = $conexion->prepare("SELECT * FROM recetas_normales WHERE id=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    // Obtiene los valores del registro seleccionado
    $icono = $registro['icono'];
    $titulo = $registro['titulo'];
    $descripcion = $registro['descripcion'];
} 

// Verifica si se recibieron datos por POST
if($_POST){
    // Obtiene los valores de los campos del formulario o asigna una cadena vacía si no están definidos
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $icono = (isset($_POST['icono'])) ? $_POST['icono'] : "";
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";

    // Prepara la consulta SQL para actualizar un registro en la tabla "recetas_normales" por su ID
    $sentencia = $conexion->prepare("UPDATE recetas_normales 
        SET
        icono=:icono,
        titulo=:titulo,
        descripcion=:descripcion
        WHERE id=:id ");

    // Asocia los valores obtenidos de los campos del formulario a los parámetros de la consulta
    $sentencia->bindParam(":icono", $icono);
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $mensaje = "Receta modificada con éxito.";
    header("Location: index.php?mensaje=" . $mensaje);

    // Mensaje de éxito para redirigir con un parámetro de mensaje

}

// Incluye el encabezado del sitio
include("../../templates/header.php");
?>
<div class="card">

    <div class="card-header">
        EDITANDO LA INFORMACIÓN DE LAS RECETAS.
    </div>

    <div class="card-body">


    <form action="" enctype="multipart/form-data" method="post">

        <div class="mb-3">
          <label for="txtID" class="form-label">ID:</label>
          <input readonly value="<?php echo $txtID;?>" type="text"
            class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
        </div>

    <div class="mb-3">
      <label for="icono" class="form-label">Icono:</label>
      <input value="<?php echo $icono;?>"  type="text"
        class="form-control" name="icono" id="icono" aria-describedby="helpId" placeholder="Icono">
    </div>

        <div class="mb-3">
          <label for="titulo" class="form-label">Titulo:</label>
          <input value="<?php echo $titulo;?>"  type="text"
            class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo">
        </div>

        <div class="mb-3">
          <label for="" class="form-label">Descripción:</label>
          <input value="<?php echo $descripcion;?>"  type="text"
            class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripción">
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