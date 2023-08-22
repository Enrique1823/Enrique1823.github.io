<?php
// Incluir el archivo de conexión a la base de datos
include("../../bd.php");

// Verificar si se ha proporcionado un parámetro 'txtID' en la URL
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    // Obtener la información de la imagen asociada al ID y eliminarla si existe
    $sentencia = $conexion->prepare("SELECT imagen FROM recetas_desplegable WHERE id=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);
    if (isset($registro_imagen["imagen"])) {
        if (file_exists("../../../assets/img/portfolio/" . $registro_imagen["imagen"])) {
            unlink("../../../assets/img/portfolio/" . $registro_imagen["imagen"]);
        }
    }

    // Eliminar la receta con el ID especificado
    $sentencia = $conexion->prepare("DELETE FROM recetas_desplegable WHERE id=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    // Redireccionar a 'index.php' con un mensaje de éxito
    $mensaje = "Receta eliminada con éxito.";
    header("Location:index.php?mensaje=" . $mensaje);
}

// Obtener la lista de recetas desplegable
$sentencia = $conexion->prepare("SELECT * FROM `recetas_desplegable`");
$sentencia->execute();
$lista_recetas_desplegable = $sentencia->fetchAll(PDO::FETCH_ASSOC);






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
                    <th scope="col">ID</th>
                    <th scope="col">Título</th>
                    <th scope="col">Subtitulo</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Ingredientes</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Acciones</th>
                    

	

                </tr>
            </thead>
            <tbody>
                <?php foreach($lista_recetas_desplegable as $registros){?>
               <tr class="">
                    <td scope="col"><?php echo $registros['ID'];?></td>
                    <td scope="col"><?php echo $registros['titulo'];?></td>
                    <td scope="col"><?php echo $registros['subtitulo'];?></td>
                    


                    <td scope="col">
                        <img width="50" src="../../../assets/img/portfolio/<?php echo $registros['imagen'];?>"/>
                
                
                </td>
                <td scope="col"><?php echo $registros['ingredientes'];?></td>
                    <td scope="col"><?php echo $registros['descripcion'];?></td>
                    
                    <td scope="col">
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