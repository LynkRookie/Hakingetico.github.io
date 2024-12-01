<?php 
// Configuración para la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ciberseguridad";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Variables para el login
$usuario = $contrasena = "";
$error = "";
$successMessage = "";

// Iniciar la sesión
session_start();

// Comprobación del inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // No se filtran los datos correctamente (vulnerabilidad SQL Injection)
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $sql = $conn->prepare("SELECT contrasena FROM usuarios WHERE usuario=?");
    $sql->bind_param("s", $usuario); // "s" es para un string
    $sql->execute();
    $result = $sql->get_result();

    // Verificar el resultado de la consulta
    if ($result->num_rows > 0) {
        // Establecer la variable de sesión
        $_SESSION['usuario'] = $usuario; // Guardar el nombre de usuario en la sesión

        // Mensaje de éxito
        $successMessage = "Inicio de sesión exitoso. Bienvenido, " . $usuario . "!";

        // Redirigir a bienvenida.php
        header("Location: bienvenida.php");
        exit(); // Detener la ejecución del script
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inyecciones y Ataques XSS - Proyecto de Ciberseguridad</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        /* Estilos del formulario */
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 20px auto;
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        h3 {
            text-align: center;
            color: #555;
            margin-bottom: 15px;
        }

        label {
            font-size: 14px;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        p.error {
            color: #d9534f;
            font-size: 14px;
            text-align: center;
        }

        p.success {
            color: #28a745;
            font-size: 14px;
            text-align: center;
        }

        /* Campos de entrada */
        input[type="text"], input[type="password"] {
            width: 100%; /* Asegura que los campos ocupen todo el ancho disponible */
            max-width: 350px; /* Ajusta el ancho máximo si es necesario */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box; /* Asegura que el padding no afecte al tamaño total */
        }

        /* Botones */
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Espaciado entre formularios */
        .form-container + .form-container {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <img src="css/Universidad-Santo-Tomas (1).png" alt="Logo Universidad Santo Tomás">
                    <div>
                        <h1 class="site-title">Ciberseguridad</h1>
                        <p class="site-subtitle">Universidad Santo Tomás</p>
                    </div>
                </div>
                <div class="student-info">
                    <p><strong>Estudiantes:</strong> Cristóbal Sáez Badilla y Damian Jinel Cortes</p>
                    <p><strong>Correos:</strong> <a href="mailto:c.saez41@alumnossantotomas.cl">c.saez41@alumnossantotomas.cl</a> / <a href="mailto:d.jinel@alumnossantotomas.cl">d.jinel@alumnossantotomas.cl</a></p>
                    <p><strong>Profesor:</strong> Marco Vega</p>
                </div>
            </div>
        </div>
    </header>

    <nav>
        <div class="container">
            <ul>
                <li>
                    <a href="index.html">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path>
                        </svg>
                        Portada
                    </a>
                </li>
                <li>
                    <a href="fase1.html">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </svg>
                        Fase 1: Reconocimiento
                    </a>
                </li>
                <li>
                    <a href="fase2.html">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="4 17 10 11 4 5"></polyline>
                            <line x1="12" x2="20" y1="19" y2="19"></line>
                        </svg>
                        Fase 2: Scanning
                    </a>
                </li>
                <li>
                    <a href="fase3.html">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m15.5 7.5 2.3 2.3a1 1 0 0 0 1.4 0l2.1-2.1a1 1 0 0 0 0-1.4L19 4"></path>
                            <path d="m21 2-9.6 9.6"></path>
                            <circle cx="7.5" cy="15.5" r="5.5"></circle>
                        </svg>
                        Fase 3: Acceso
                    </a>
                </li>
                <li>
                    <a href="fase4.html">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                            <path d="M3 5V19A9 3 0 0 0 21 19V5"></path>
                            <path d="M3 12A9 3 0 0 0 21 12"></path>
                        </svg>
                        Fase 4: Mantenimiento de Acceso
                    </a>
                </li>
                <li>
                    <a href="fase5.html">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m7 21-4.3-4.3c-1-1-1-2.5 0-3.4l9.6-9.6c1-1 2.5-1 3.4 0l5.6 5.6c1 1 1 2.5 0 3.4L13 21"></path>
                            <path d="M22 21H7"></path>
                            <path d="m5 11 9 9"></path>
                        </svg>
                        Fase 5: Borrado de Huellas
                    </a>
                </li>
                <li>
                    <a href="inyecciones.html">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                        </svg>
                        Inyecciones y Ataques XSS
                    </a>
                </li>


            </ul>
        </div>
    </nav>

    <main>
        <div class="container">
    <div class="form-container">
        <h2>Inicio de Sesión</h2>
        
        <!-- Mostrar mensajes de error o éxito -->
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if ($successMessage): ?>
            <p class="success"><?php echo $successMessage; ?></p>
        <?php endif; ?>
        
        <!-- Formulario de inicio de sesión -->
        <form method="post" action="">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" value="<?php echo $usuario; ?>" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" value="<?php echo $contrasena; ?>" required>

            <input type="submit" value="Iniciar sesión">
        </form>
    </div>

    <!-- Formulario de prueba de XSS -->
    <div class="form-container">
        <h3>Prueba de XSS</h3>
        <form method="post" action="">
            <label for="comentario">Comentario (Inyección XSS):</label>
            <input type="text" id="comentario" name="comentario" placeholder="Ingresa un comentario">
            
            <input type="submit" value="Enviar">
        </form>

        <?php
        // Mostrar el comentario de XSS (potencial vulnerabilidad)
        if (isset($_POST['comentario'])) {
            echo "<p><strong>Comentario ingresado:</strong> " . htmlspecialchars($_POST['comentario'], ENT_QUOTES, 'UTF-8') . "</p>";
            echo "<p><strong>NOTA:</strong> Si el comentario contiene código JavaScript, puede que se ejecute (vulnerabilidad XSS).</p>";
        }
        ?>
    </div>

</body>
</html>
