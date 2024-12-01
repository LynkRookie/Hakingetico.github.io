<?php
session_start();

// Comprobamos si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Redirige al login si no está autenticado
    exit();
}

$usuario = $_SESSION['usuario']; // Obtener el nombre de usuario de la sesión

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        .content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 0 auto;
        }
        a {
            color: #28a745;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="content">
        <h2>Bienvenido, <?php echo htmlspecialchars($usuario); ?>!</h2>
        <p>Has iniciado sesión correctamente.</p>
        <p><a href="logout.php">Cerrar sesión</a></p>
    </div>

</body>
</html>

