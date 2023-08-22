<?php
// Incluye el archivo de conexión a la base de datos
include("../../bd.php");

// Verifica si se recibió el parámetro txtID en la URL (a través de GET)
if(isset($_GET['txtID'])){
    // Obtiene el valor del parámetro txtID o asigna una cadena vacía si no está definido
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    // Prepara la consulta SQL para eliminar un registro de la tabla "recetas_normales" por su ID
    $sentencia = $conexion->prepare("DELETE FROM recetas_normales WHERE id=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $mensaje="Receta eliminada con éxito. ";
    header("Location:index.php?mensaje=".$mensaje);
}

// Prepara la consulta SQL para seleccionar todos los registros de la tabla "recetas_normales"
$sentencia = $conexion->prepare("SELECT * FROM `recetas_normales`");
$sentencia->execute();
$lista_recetas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// Incluye el encabezado del sitio
include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
       <br/> <br/>
        <a name="" id="" class="btn btn-info" href="crear.php" role="button">Nuevo registro</a>
        
    </div>
    <div class="card-body">
        
    <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Icono</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($lista_recetas as $registros){?>
                <tr class="">
                    <td><?php echo $registros['ID'];?></td>
                    <td><?php echo $registros['icono'];?></td>
                    <td><?php echo $registros['titulo'];?></td>
                    <td><?php echo $registros['descripcion'];?></td>
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
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
        }

        /* Estilos para la tarjeta */
        .card {
            width: 100%;
            margin: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 25px;
            background-color: #fff;
        }

        .card-header {
            text-align: center;
            padding: 1px;
            background-color: #f0f0f0;
            border-bottom: 1px solid #ccc;
        }

        /* Estilos para el botón "Nuevo registro" */
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

        /* Estilos para la tabla */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .table thead th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        /* Estilos para los botones "Editar" y "Eliminar" en la tabla */
        .btn-success,
        .btn-danger {
            padding: 5px 10px;
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
    </style>
    

    </div>
    
    
</div>














<?php include("../../templates/footer.php");?>