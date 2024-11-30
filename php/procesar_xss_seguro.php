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

    $input = $_POST['xss-secure-input'];

    // Escapar caracteres especiales para prevenir XSS
    $safe_input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

    // Insertar el dato escapado en la base de datos
    $stmt = $conn->prepare("INSERT INTO xss_entries (input) VALUES (?)");
    $stmt->bind_param("s", $safe_input);
    $stmt->execute();

    header("Location: inyecciones.html?mensaje=Entrada guardada correctamente (Seguro)!");
    $stmt->close();
    $conn->close();
?>

