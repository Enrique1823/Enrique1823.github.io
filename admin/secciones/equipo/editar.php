<?php
// Incluir el archivo de conexión a la base de datos
include("../../bd.php");

// Verificar si se ha proporcionado un parámetro 'txtID' en la URL
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    // Preparar y ejecutar la consulta para obtener los datos del integrante con el ID especificado
    $sentencia = $conexion->prepare(" SELECT * FROM tbl_equipo  WHERE id=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    // Obtener los valores del integrante desde el resultado de la consulta
    $imagen = $registro["imagen"];
    $nombreCompleto = $registro["nombreCompleto"];
    $puesto = $registro["puesto"];
    $twitter = $registro["twitter"];
    $facebook = $registro["facebook"];
}

// Verificar si se ha enviado una solicitud POST
if ($_POST) {
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $imagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";
    $nombreCompleto = (isset($_POST['nombreCompleto'])) ? $_POST['nombreCompleto'] : "";
    $puesto = (isset($_POST['puesto'])) ? $_POST['puesto'] : "";
    $twitter = (isset($_POST['twitter'])) ? $_POST['twitter'] : "";
    $facebook = (isset($_POST['facebook'])) ? $_POST['facebook'] : "";

    // Preparar y ejecutar la consulta para actualizar los datos del integrante
    $sentencia = $conexion->prepare("UPDATE tbl_equipo SET
    nombreCompleto=:nombreCompleto,
    puesto=:puesto,
    twitter=:twitter,
    facebook=:facebook
    WHERE ID=:id");

    // Vincular los parámetros con los valores obtenidos del formulario
    $sentencia->bindParam(":nombreCompleto", $nombreCompleto);
    $sentencia->bindParam(":puesto", $puesto);
    $sentencia->bindParam(":twitter", $twitter);
    $sentencia->bindParam(":facebook", $facebook);
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
        move_uploaded_file($tmp_imagen, "../../../assets/img/team/" . $nombre_archivo_imagen);

        // Obtener la imagen anterior y eliminarla si existe
        $sentencia = $conexion->prepare("SELECT imagen FROM tbl_equipo WHERE id=:id ");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);
        if (isset($registro_imagen["imagen"])) {
            if (file_exists("../../../assets/img/team/" . $registro_imagen["imagen"])) {
                unlink("../../../assets/img/team/" . $registro_imagen["imagen"]);
            }
        }

        // Actualizar el nombre de la imagen en la base de datos
        $sentencia = $conexion->prepare(" UPDATE tbl_equipo SET imagen=:imagen WHERE id=:id ");
        $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $imagen = $nombre_archivo_imagen;
    }

    // Redireccionar a 'index.php' con un mensaje de éxito
    $mensaje = "Dato de integrante editado con éxito";
    header("Location:index.php?mensaje=" . $mensaje);
}






include("../../templates/header.php");?>


<div class="card">
    <div class="card-header">
        Nuevo Integrante
    </div>
    <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">


        <div class="mb-3">
          <label for="" class="form-label">ID:</label>
          <input readonly  value="<?php echo $txtID;?>" type="text"
            class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
         
        </div>

        <div class="mb-3">

      <label for="imagen" class="form-label">Imagen:</label> 
      <img width="50" src="../../../assets/img/team/<?php echo $imagen;?>"/>
       <input type="file" 
        class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imagen">
    </div>

    <div class="mb-3">
      <label for="nombreCompleto" class="form-label">Nombre_Completo:</label> 
      <input type="text"
        class="form-control" value="<?php echo $nombreCompleto; ?>" name="nombreCompleto" id="nombreCompleto" aria-describedby="helpId" placeholder="Nombre">
         </div>

         <div class="mb-3">
           <label for="puesto" class="form-label">Puesto:</label>
           <input type="text"
             class="form-control" value="<?php echo $puesto; ?>" name="puesto" id="puesto" aria-describedby="helpId" placeholder="Puesto">
         </div>

        <div class="mb-3">
          <label for="twitter" class="form-label">Twitter:</label>
          <input type="text"
            class="form-control"  value="<?php echo $twitter; ?>" name="twitter" id="twitter" aria-describedby="helpId" placeholder="Twitter">
        </div>


         <div class="mb-3">
           <label for="facebook" class="form-label">Facebook</label>
           <input type="text"
             class="form-control" value="<?php echo $facebook; ?>" name="facebook" id="facebook" aria-describedby="helpId" placeholder="Facebook">
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