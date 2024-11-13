<?php
session_start();
include 'conexion.php';

// Cerrar sesión
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: user.php"); // Redirigir a la página de inicio de sesión
    exit();
}

if (isset($_POST['register'])) {
    // Procesar el formulario de registro
    $nombre_usuario = $_POST['new-username'];
    $correo = $_POST['new-email'];
    $contraseña = password_hash($_POST['new-password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuarios (nombre_usuario, correo, contraseña) VALUES ('$nombre_usuario', '$correo', '$contraseña')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registro exitoso');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

if (isset($_POST['login'])) {
    // Procesar el formulario de inicio de sesión
    $nombre_usuario = $_POST['username'];
    $contraseña = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE nombre_usuario='$nombre_usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($contraseña, $row['contraseña'])) {
            $_SESSION['id_usuario'] = $row['id'];
            $_SESSION['nombre_usuario'] = $row['nombre_usuario'];
            echo "<script>
                alert('Inicio de sesión exitoso');
                window.location.href = '../index.php';
            </script>";
        } else {
            echo "<script>alert('Contraseña incorrecta');</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Byte Zone - Inicio de Sesión y Registro</title>
    <link rel="stylesheet" href="../css/user.css">
</head>
<body>
    <header>
        <div class="titulo">
            <h1>Byte Zone</h1>
        </div>
    </header>
    
    <nav>
        <ul>
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="Componentes.php">Componentes</a></li>
            <li><a href="ArmatuPC.php">Arma tu PC</a></li>
        </ul>
    </nav>

    <main>
        <?php if (isset($_SESSION['id_usuario'])): ?>
            <!-- Mostrar el botón de cerrar sesión si el usuario está logueado -->
            <div class="contenido">
                <h2>Bienvenido, <?php echo $_SESSION['nombre_usuario']; ?></h2>
                <a href="user.php?logout=true" class="boton-logout">Cerrar Sesión</a>
            </div>
        <?php else: ?>
            <!-- Formulario de inicio de sesión -->
            <div class="contenido">
                <div class="formulario">
                    <h2>Iniciar Sesión</h2>
                    <form method="POST" action="user.php">
                        <label for="username">Usuario:</label>
                        <input type="text" id="username" name="username" required>
                        
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" required>
                        
                        <button type="submit" name="login">Ingresar</button>
                    </form>
                </div>
            </div>

            <!-- Formulario de registro -->
            <div class="contenido">
                <div class="formulario">
                    <h2>Registro</h2>
                    <form method="POST" action="user.php">
                        <label for="new-username">Usuario:</label>
                        <input type="text" id="new-username" name="new-username" required>
                        
                        <label for="new-email">Correo Electrónico:</label>
                        <input type="email" id="new-email" name="new-email" required>
                        
                        <label for="new-password">Contraseña:</label>
                        <input type="password" id="new-password" name="new-password" required>
                        
                        <button type="submit" name="register">Registrarse</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <div class="piedepagina">
            <p>Derechos Reservados</p>
        </div>
    </footer>
</body>
</html>
