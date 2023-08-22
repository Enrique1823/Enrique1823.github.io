<?php
// Incluir el archivo de conexión a la base de datos
include("../../bd.php");

// Verificar si se ha proporcionado un parámetro 'txtID' en la URL
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    // Obtener el nombre de la imagen de la receta que se va a eliminar
    $sentencia = $conexion->prepare("SELECT imagen FROM tbl_entradas WHERE id=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);
    
    // Verificar si la imagen existe y eliminarla
    if (isset($registro_imagen["imagen"])) {
        if (file_exists("../../../assets/img/about/" . $registro_imagen["imagen"])) {
            unlink("../../../assets/img/about/" . $registro_imagen["imagen"]);
        }
    }

    // Preparar y ejecutar la consulta para eliminar la receta con el ID especificado
    $sentencia = $conexion->prepare("DELETE FROM tbl_entradas WHERE id=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    // Redireccionar a 'index.php' con un mensaje de éxito
    $mensaje = "Registro eliminado con éxito. ";
    header("Location:index.php?mensaje=" . $mensaje);
}

// Preparar y ejecutar la consulta para obtener la lista de entradas
$sentencia = $conexion->prepare("SELECT * FROM `tbl_entradas`");
$sentencia->execute();
$lista_entradas = $sentencia->fetchAll(PDO::FETCH_ASSOC);





include("../../templates/header.php");?>


<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-info" href="crear.php" role="button">Nuevo registro</a>

    <div class="card-body">
        

    
    </div>
    <div class="card-footer text-muted">
        
    <div class="table-responsive-sm">
        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Ingredientes</th>
                    <th scope="col">Preparacion</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($lista_entradas as $registros){?>
                <tr class="">
                    <td><?php echo $registros['ID'];?></td>
                    <td><?php echo $registros['titulo'];?></td>
                    <td><?php echo $registros['ingredientes'];?></td>
                    <td><?php echo $registros['Preparamiento'];?></td>
                    <td><img width="50" src="../../../assets/img/about/<?php echo $registros['imagen'];?>"/> </td>
                    <td>   
                        
                    <a name="" id="" class="btn btn-success"  href="editar.php?txtID=<?php echo  $registros['ID'];?>"  role="button">Editar</a>
                         | 
                    <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo  $registros['ID'];?>" role="button">Eliminar</a>
                
                
                    </td>
                
                </tr>

                <?php }?>
            
            </tbody>
        </table>
    </div>

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