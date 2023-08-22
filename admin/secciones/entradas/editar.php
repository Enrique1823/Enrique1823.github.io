<?php
// Incluir el archivo de conexión a la base de datos
include("../../bd.php");

// Verificar si se ha proporcionado un parámetro 'txtID' en la URL
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    // Preparar y ejecutar la consulta para obtener los datos de la receta con el ID especificado
    $sentencia = $conexion->prepare(" SELECT * FROM tbl_entradas  WHERE id=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    // Obtener los valores de la receta desde el resultado de la consulta
    $titulo = $registro['titulo'];
    $ingredientes = $registro["ingredientes"];
    $Preparamiento = $registro["Preparamiento"];
    $imagen = $registro["imagen"];
}

// Verificar si se ha enviado una solicitud POST
if ($_POST) {
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $ingredientes = (isset($_POST['ingredientes'])) ? $_POST['ingredientes'] : "";
    $Preparamiento = (isset($_POST['Preparamiento'])) ? $_POST['Preparamiento'] : "";

    // Preparar y ejecutar la consulta para actualizar los datos de la receta
    $sentencia = $conexion->prepare(" UPDATE `tbl_entradas`
   SET titulo=:titulo,ingredientes=:ingredientes,Preparamiento=:Preparamiento WHERE id=:id ");

    // Vincular los parámetros con los valores obtenidos del formulario
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":ingredientes", $ingredientes);
    $sentencia->bindParam(":Preparamiento", $Preparamiento);
    $sentencia->bindParam(":id", $txtID);
    $imagen = $nombre_archivo_imagen;

    // Ejecutar la sentencia SQL para actualizar los datos en la base de datos
    $sentencia->execute();

    // Verificar si se ha subido una nueva imagen
    if ($_FILES["imagen"]["tmp_name"] != "") {
        $imagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";

        // Generar un nombre único para la imagen
        $fecha_imagen = new DateTime();
        $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp() . "_" . $imagen : "";

        // Mover la nueva imagen a la ubicación deseada
        $tmp_imagen = $_FILES["imagen"]["tmp_name"];
        move_uploaded_file($tmp_imagen, "../../../assets/img/about/" . $nombre_archivo_imagen);

        // Obtener la imagen anterior y eliminarla si existe
        $sentencia = $conexion->prepare("SELECT imagen FROM tbl_entradas WHERE id=:id ");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);
        if (isset($registro_imagen["imagen"])) {
            if (file_exists("../../../assets/img/about/" . $registro_imagen["imagen"])) {
                unlink("../../../assets/img/about/" . $registro_imagen["imagen"]);
            }
        }

        // Actualizar el nombre de la imagen en la base de datos
        $sentencia = $conexion->prepare(" UPDATE tbl_entradas SET imagen=:imagen WHERE id=:id ");
        $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $imagen = $nombre_archivo_imagen;
    }

    // Redireccionar a 'index.php' con un mensaje de éxito
    $mensaje = "Receta editada con éxito";
    header("Location:index.php?mensaje=" . $mensaje);
}













include("../../templates/header.php");?>



<div class="card">
    <div class="card-header">
    Entradas de recetas
    </div>

    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">


    <div class="mb-3">
      <label for="" class="form-label">ID:</label>
      <input type="text"
        class="form-control" readonly value="<?php echo $txtID;?>"  name="txtID" id="txtID" aria-describedby="helpId" placeholder="">
     
    </div>



        <div class="mb-3">
          <label for="titulo" class="form-label">Titulo:</label>
          <input type="text"
            class="form-control" value="<?php echo $titulo;?>" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo">
        </div>

        <div class="mb-3">
          <label for="ingredientes" class="form-label">Ingredientes:</label>
          <input type="text"
            class="form-control" value="<?php echo $ingredientes;?>" name="ingredientes" id="ingredientes" aria-describedby="helpId" placeholder="Ingredientes">
        </div>

        <div class="mb-3">
          <label for="Preparamiento" class="form-label">Preparamiento:</label>
          <input type="text"
            class="form-control" value="<?php echo $Preparamiento;?>" name="Preparamiento" id="Preparamiento" aria-describedby="helpId" placeholder="Preparamiento">
        </div>

        <div class="mb-3">
          <label for="imagen" class="form-label">Imagen:</label>
          <img width="50" src="../../../assets/img/about/<?php echo $imagen;?>"/>
          <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen" aria-describedby="fileHelpId">
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