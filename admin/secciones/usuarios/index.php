<?php
// Incluir el archivo de conexión a la base de datos
include("../../bd.php");

// Verificar si se ha proporcionado un parámetro 'txtID' en la URL
if(isset($_GET['txtID'])) {
    // Obtiene el valor del parámetro txtID o asigna una cadena vacía si no está definido
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    // Prepara la consulta SQL para eliminar un registro de la tabla "tbl_usuarios" por su ID
    $sentencia = $conexion->prepare("DELETE FROM tbl_usuarios WHERE id=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $mensaje = "Dato del usuario eliminado con éxito. ";
    header("Location: index.php?mensaje=" . $mensaje);
}

// Preparar consulta para obtener la lista de usuarios
$sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios`");
$sentencia->execute();
$lista_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);




include("../../templates/header.php");?>

<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-info" href="crear.php" role="button">Nuevo registro</a>
    </div>
    <div class="card-body">
     

        
<div class="table-responsive-sm">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Usuarios</th>
                <th scope="col">Correo</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($lista_usuarios as $registros){?>
            <tr class="">
                <td scope="row"><?php echo $registros['usuario'];?></td>
                <td><?php echo $registros['correo'];?></td>
                <td><?php echo $registros['password'];?></td>
                <td>
                <a name="" id="" class="btn btn-success"  href="editar.php?txtID=<?php echo  $registros['id'];?>"  role="button">Editar</a>
                         | 
                         <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo  $registros['id'];?>" role="button">Eliminar</a>
                </td>
            </tr>

            <?php }?>
         
        </tbody>
    </table>
</div>



    </div>
    <div class="card-footer text-muted">


            <style>

        .btn-info {
            padding: 10px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
            background-color: #17a2b8;
            text-decoration: none;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .card-header {
            text-align: center;
            padding: 1px;
            background-color: #f0f0f0;
            border-bottom: 1px solid #ccc;
        }


            </style>

    </div>
</div>


<?php include("../../templates/footer.php");?>