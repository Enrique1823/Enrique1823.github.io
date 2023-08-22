<?php
$servidor = "localhost";
$baseDeDatos = "website";
$usuario = "root";
$contrasenia = "";

try {
    // Crear una instancia de PDO para la conexión a la base de datos
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos", $usuario, $contrasenia);

    // Configurar atributos de PDO para manejar errores y excepciones
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $error) {
    // En caso de error en la conexión, mostrar el mensaje de error
    echo "Error en la conexión: " . $error->getMessage();
}
?>
