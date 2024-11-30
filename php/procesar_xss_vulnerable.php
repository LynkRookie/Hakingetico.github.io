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

    $input = $_POST['xss-vulnerable-input'];

    // Verificar si hay un posible XSS
    if (strpos($input, "<script>") !== false || strpos($input, "javascript:") !== false) {
        header("Location: inyecciones.html?mensaje=Posible ataque XSS detectado!");
    } else {
        // Guardamos el dato en la base de datos si no es XSS
        $stmt = $conn->prepare("INSERT INTO xss_entries (input) VALUES (?)");
        $stmt->bind_param("s", $input);
        $stmt->execute();
        header("Location: inyecciones.html?mensaje=Entrada guardada correctamente!");
        $stmt->close();
    }

    $conn->close();
?>
