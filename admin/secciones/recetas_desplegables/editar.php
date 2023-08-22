<?php
// Incluir el archivo de conexión a la base de datos
include("../../bd.php");

// Verificar si se ha proporcionado un parámetro 'txtID' en la URL
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    // Obtener los detalles de la receta con el ID especificado
    $sentencia = $conexion->prepare("SELECT * FROM recetas_desplegable  WHERE id=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    // Obtener los valores de la receta para mostrar en el formulario de edición
    $titulo = $registro['titulo'];
    $subtitulo = $registro["subtitulo"];
    $imagen = $registro["imagen"];
    $ingredientes = $registro["ingredientes"];
    $descripcion = $registro["descripcion"];
}

// Verificar si se ha enviado una solicitud POST
if ($_POST) {
    // Obtener los valores del formulario o establecer valores predeterminados
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $subtitulo = (isset($_POST['subtitulo'])) ? $_POST['subtitulo'] : "";
    $ingredientes = (isset($_POST['ingredientes'])) ? $_POST['ingredientes'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";

    // Preparar y ejecutar la consulta para actualizar la receta
    $sentencia = $conexion->prepare(" UPDATE recetas_desplegable 
        SET
        titulo=:titulo,
        subtitulo=:subtitulo,
        ingredientes=:ingredientes,
        descripcion=:descripcion
        WHERE id=:id ");
    
    // Vincular los parámetros con los valores obtenidos del formulario
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":subtitulo", $subtitulo);
    $sentencia->bindParam(":ingredientes", $ingredientes);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    // Verificar si se ha subido una nueva imagen
    if ($_FILES["imagen"]["tmp_name"] != "") {
        $imagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";

        // Generar un nombre único para la imagen
        $fecha_imagen = new DateTime();
        $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp() . "_" . $imagen : "";

        $tmp_imagen = $_FILES["imagen"]["tmp_name"];
        // Mover la nueva imagen a la ubicación deseada
        move_uploaded_file($tmp_imagen, "../../../assets/img/portfolio/" . $nombre_archivo_imagen);

        // Obtener la imagen actual de la receta
        $sentencia = $conexion->prepare("SELECT imagen FROM recetas_desplegable WHERE id=:id ");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);

        // Verificar si la imagen actual existe y eliminarla
        if (isset($registro_imagen["imagen"])) {
            if (file_exists("../../../assets/img/portfolio/" . $registro_imagen["imagen"])) {
                unlink("../../../assets/img/portfolio/" . $registro_imagen["imagen"]);
            }
        }

        // Actualizar el nombre de la imagen en la base de datos
        $sentencia = $conexion->prepare(" UPDATE recetas_desplegable SET imagen=:imagen WHERE id=:id ");
        $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
    }

    // Redireccionar a 'index.php' con un mensaje de éxito
    $mensaje = "Receta editada con éxito";
    header("Location:index.php?mensaje=" . $mensaje);
}





 include("../../templates/header.php");?>









<div class="card">
    <div class="card-header">
        Producto de recetas
    </div>
    <div class="card-body">
    <form action="" enctype="multipart/form-data" method="post">


    <div class="mb-3">
      <label for="" class="form-label">ID</label>  
      <input type="text"
        class="form-control" readonly name="txtID" id="txtID" value="<?php echo $txtID;?>" aria-describedby="helpId" placeholder="">
    
    </div>

<div class="mb-3">
  <label for="titulo" class="form-label">Titulo:</label>
  <input type="text"
    class="form-control" value="<?php echo $titulo;?>"  name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo">
</div>

<div class="mb-3">
  <label for="subtitulo" class="form-label">Subtitulo:</label>
  <input type="text"
    class="form-control" value="<?php echo $subtitulo;?>" name="subtitulo" id="subtitulo" aria-describedby="helpId" placeholder="Subtitulo">
</div>

<div class="mb-3">
  <label for="imagen" class="form-label">Imagen:</label>
  <img width="50" src="../../../assets/img/portfolio/<?php echo $imagen;?>"/>
  <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen" aria-describedby="fileHelpId">
</div>


    <div class="mb-3">
      <label for="ingredientes" class="form-label">Ingredientes</label>
      <input type="text"
        class="form-control" value="<?php echo $ingredientes;?>" name="ingredientes" id="ingredientes" aria-describedby="helpId" placeholder="ingredientes">

    </div>


    <div class="mb-3">
      <label for="descripcion" class="form-label">Descripción:</label>
      <input type="text"
        class="form-control"  value="<?php echo $descripcion;?>" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion">
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