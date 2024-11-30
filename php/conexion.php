<?php
// Datos de conexión
$host = 'localhost'; // El host de tu base de datos
$usuario = 'root';   // Tu usuario de MySQL
$contraseña = '';    // Tu contraseña de MySQL
$base_de_datos = 'ciberseguridad'; // El nombre de la base de datos

// Crear la conexión
$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos);

// Verificar si hubo un error en la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
