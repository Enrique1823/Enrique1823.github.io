<?php
// Incluir el archivo de conexión a la base de datos
include("../../bd.php");

// Verificar si se ha proporcionado un parámetro 'txtID' en la URL
if(isset($_GET['txtID'])) {
    // Obtiene el valor del parámetro txtID o asigna una cadena vacía si no está definido
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    // Prepara la consulta SQL para seleccionar un registro de la tabla "tbl_usuarios" por su ID
    $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    // Obtiene los valores del registro seleccionado
    $usuario = $registro['usuario'];
    $correo = $registro['correo'];
    $password = $registro['password'];
}

// Verificar si se ha enviado una solicitud POST
if($_POST) {
    // Obtiene los valores de los campos del formulario o asigna una cadena vacía si no están definidos
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : "";
    $correo = (isset($_POST['correo'])) ? $_POST['correo'] : "";
    $password = (isset($_POST['password'])) ? $_POST['password'] : "";

    // Prepara la consulta SQL para actualizar un registro en la tabla "tbl_usuarios" por su ID
    $sentencia = $conexion->prepare("UPDATE tbl_usuarios 
        SET
        usuario=:usuario,
        correo=:correo,
        password=:password
        WHERE id=:id ");

    // Asocia los valores obtenidos de los campos del formulario a los parámetros de la consulta
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->bindParam(":password", $password);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    // Mensaje de éxito para redirigir con un parámetro de mensaje
    $mensaje = "Dato del usuario editado con éxito";
    header("Location: index.php?mensaje=" . $mensaje);
}












include("../../templates/header.php");?>


<div class="card">
    <div class="card-header">
        Usuario
    </div>
    <div class="card-body">
        
    <form action="" method="post">

        <div class="mb-3">
          <label for="txtID" class="form-label">ID:</label>
          <input readonly type="text"
            class="form-control"  value="<?php echo $txtID;?>"  name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
    
        </div>


        <div class="mb-3">
          <label for="" class="form-label">Nombre del Usuario:</label>
          <input type="text"
            class="form-control"  value="<?php echo $usuario;?>"  name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del Usuario">

        </div>

        <div class="mb-3">
          <label for="" class="form-label">Password:</label>
          <input type="password"
            class="form-control"  value="<?php echo $password;?>"  name="password" id="password" aria-describedby="helpId" placeholder="Password">

        </div>

        <div class="mb-3">
          <label for="correo" class="form-label">Correo:</label>
          <input type="email"  value="<?php echo $correo;?>"  class="form-control" name="correo" id="correo" aria-describedby="emailHelpId" placeholder="Correo">
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