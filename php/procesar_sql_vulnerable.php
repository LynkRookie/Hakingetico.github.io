<?php
    $servername = "localhost";
    $username = "root";  // Cambia según tu configuración
    $password = "";      // Cambia según tu configuración
    $dbname = "ciberseguridad";  // Nombre de la base de datos

    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $usuario = $_POST['sql-vulnerable-username'];
    $clave = $_POST['sql-vulnerable-password'];

    // Consulta vulnerable
    $sql = "SELECT * FROM usuarios WHERE username = '$usuario' AND password = '$clave'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("Location: inyecciones.html?mensaje=Inicio de sesión exitoso!");
    } else {
        header("Location: inyecciones.html?mensaje=Usuario o contraseña incorrectos.");
    }

    $conn->close();
?>
