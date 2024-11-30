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

    $usuario = $_POST['sql-secure-username'];
    $clave = $_POST['sql-secure-password'];

    // Consulta segura con consultas preparadas
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $usuario, $clave);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: inyecciones.html?mensaje=Inicio de sesión exitoso!");
    } else {
        header("Location: inyecciones.html?mensaje=Usuario o contraseña incorrectos.");
    }

    $stmt->close();
    $conn->close();
?>

