<?php
session_start();
session_destroy();
header("Location:./login.php");
?>

<!-- Este código se utiliza para cerrar la sesión de un usuario y redirigirlo a la página de inicio de sesión.    -->