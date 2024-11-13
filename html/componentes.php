<?php include './conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/componentes.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
    <title>Componentes</title>
</head>
<body>
    <header>
        <h1>Componentes de Computadora</h1>
        <!-- Botón del carrito en la esquina superior derecha -->
        <a href="carrito.php" class="carrito">
            <i class="fas fa-shopping-cart"></i>
            <span>Carrito</span>
        </a>
    </header>

    <nav>
        <ul>
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="componentes.php">Componentes</a></li>
            <li><a href="nosotros.php">Sobre Nosotros</a></li>
        </ul>
    </nav>

    <main>
        <ul class="categorias">
            <li><a href="procesadores.php">Procesadores</a></li>
            <li><a href="placasmadres.php">Placas Madre</a></li>
            <li><a href="memorias.php">Memorias RAM</a></li>
            <li><a href="tarjetasdevideo.php">Tarjetas Gráficas</a></li>
            <li><a href="almacenamiento.php">Almacenamiento</a></li>
            <li><a href="fuentes.php">Fuentes de Alimentación</a></li>
        </ul>
    </main>
</body>
</html>
