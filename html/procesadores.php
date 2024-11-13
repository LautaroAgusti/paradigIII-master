<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> <!-- Iconos -->
    <link rel="stylesheet" href="../css/procesadores.css">
    <title>Procesadores - Byte Zone</title>
</head>
<body>

    <!-- Botón del carrito -->
    <a href="carrito.php" class="carrito">
        <i class="fas fa-shopping-cart"></i> <!-- Icono del carrito -->
        <span>Carrito</span>
    </a>

    <header>
        <h1>Byte Zone</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="componentes.php">Componentes</a></li>
            <li><a href="sobre-nosotros.php">Sobre Nosotros</a></li>
        </ul>
    </nav>

    <main>
        <div class="product-container">
            <!-- Producto 1 -->
            <div class="card">
                <div class="image-container">
                    <img src="../imagenes/i5frente.jpg" alt="Procesador Intel Core i5 12400" class="active">
                    <img src="../imagenes/i5costado.jpg" alt="Vista lateral Intel Core i5">
                    <img src="../imagenes/i5costado2.jpg" alt="Vista trasera Intel Core i5">
                </div>
                <h4>Procesador Intel Core i5 12400 4.4GHz Turbo</h4>
                <p>$195.000</p>
                <button class="add-to-cart" data-id="3">Comprar</button>
            </div>
            <!-- Producto 2 -->
            <div class="card">
                <div class="image-container">
                    <img src="../imagenes/i7frente.jpg" alt="Procesador Intel Core i7 12700KF" class="active">
                    <img src="../imagenes/i7costado.jpg" alt="Vista lateral Intel Core i7">
                    <img src="../imagenes/i7costado2.jpg" alt="Vista trasera Intel Core i7">
                </div>
                <h4>Procesador Intel Core i7 12700KF 5.0GHz Turbo</h4>
                <p>$320.000</p>
                <button class="add-to-cart" data-id="4">Comprar</button>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Configuración del carrito
            const buttons = document.querySelectorAll('.add-to-cart');

            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    const productoId = this.getAttribute('data-id');

                    fetch('procesar_carrito.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `producto_id=${productoId}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            alert(data.message); // Mensaje de error o sesión no iniciada
                        } else {
                            alert(data.message); // Producto agregado al carrito
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });

            // Configuración del carrusel
            const cards = document.querySelectorAll('.card');

            cards.forEach(card => {
                let images = card.querySelectorAll('img');
                let currentIndex = 0;

                setInterval(() => {
                    // Eliminar la clase "active" de la imagen actual
                    images[currentIndex].classList.remove('active');
                    // Mover al siguiente índice
                    currentIndex = (currentIndex + 1) % images.length;
                    // Añadir la clase "active" a la siguiente imagen
                    images[currentIndex].classList.add('active');
                }, 3000); // Cambia cada 3 segundos
            });
        });
    </script>
</body>
</html>
