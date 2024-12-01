<?php
// Iniciar sesión
session_start();

// Destruir la sesión
session_destroy();

// Redirigir al login
header("Location: login.php"); // Ajusta el nombre del archivo de login si es necesario
exit();
?>
