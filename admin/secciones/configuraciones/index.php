<?php
// Incluir el archivo de conexión a la base de datos
include("../../bd.php");

// Verificar si se ha proporcionado un parámetro 'txtID' en la URL
if (isset($_GET['txtID'])) {
    // Obtener el valor de 'txtID' de la URL
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    // Preparar y ejecutar la consulta para eliminar la configuración con el ID especificado
    $sentencia = $conexion->prepare("DELETE FROM tbl_configuraciones WHERE id=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    // Redireccionar a 'index.php' con un mensaje de éxito
    $mensaje = "Registro eliminado con éxito. ";
    header("Location:index.php?mensaje=".$mensaje);
}

// Preparar y ejecutar la consulta para obtener la lista de configuraciones
$sentencia = $conexion->prepare("SELECT * FROM `tbl_configuraciones`");
$sentencia->execute();
$lista_configuraciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);



include("../../templates/header.php");?>

<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-success" href="crear.php" role="button">Nuevo registro</a>
    </div>
    <div class="card-body">
       
    <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre de la configuración</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($lista_configuraciones as $registros){?>
                <tr class="">
                    <td><?php echo $registros['ID'];?></td>
                    <td><?php echo $registros['nombreconfiguracion'];?></td>
                    <td><?php echo $registros['valor'];?></td>
                    <td>
                    <a name="" id="" class="btn btn-info"  href="editar.php?txtID=<?php echo  $registros['ID'];?>"  role="button">Editar</a>
                         |
                         
                  <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo  $registros['ID'];?>" role="button">Eliminar</a> 
                
                

                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
    



    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>







<?php include("../../templates/footer.php");?>