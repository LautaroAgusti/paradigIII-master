<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tarjetasdevideo.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Tarjetas de Video - Byte Zone</title>
</head>
<body>
    <header>
        <div class="titulo">
            <h1>Byte Zone</h1>
        </div>
        <!-- Botón del carrito -->
        <a href="carrito.php" class="carrito">
            <i class="fas fa-shopping-cart"></i> <!-- Icono del carrito -->
            <span>Carrito</span>
        </a>
    </header>

    <nav>
        <ul>
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="componentes.php">Componentes</a></li>
            <li><a href="armatupc.php">Arma tu PC</a></li>
        </ul>
    </nav>

    <main>
        <div class="product-container">
            <!-- Producto 1 -->
            <div class="card">
                <div class="image-container">
                    <img src="../imagenes/3060portada.jpg" alt="MSI GeForce RTX 3060 12GB GDDR6 VENTUS 2X OC" class="active">
                    <img src="../imagenes/3060frontal.jpg">
                    <img src="../imagenes/3060backplate.jpg">
                </div>
                <h4>MSI GeForce RTX 3060 12GB GDDR6 VENTUS 2X OC</h4>
                <p>$395.000</p>
                <button class="add-to-cart" data-id="9">Comprar</button>
            </div>
            <!-- Producto 2 -->
            <div class="card">
                <div class="image-container">
                    <img src="../imagenes/4060tiportada.jpg" alt="MSI GeForce RTX 4060 Ti 8GB GDDR6 Ventus 3X Black OC" class="active">
                    <img src="../imagenes/4060tifrontal.jpg">
                    <img src="../imagenes/4060tibackplate.jpg">
                </div>
                <h4>MSI GeForce RTX 4060 Ti 8GB GDDR6 Ventus 3X Black OC</h4>
                <p>$565.000</p>
                <button class="add-to-cart" data-id="10">Comprar</button>
            </div>
            <!-- Agrega más tarjetas de productos de tarjetas de video aquí -->
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Configuración para agregar al carrito
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
                    images[currentIndex].classList.remove('active');
                    currentIndex = (currentIndex + 1) % images.length;
                    images[currentIndex].classList.add('active');
                }, 3000); // Cambia cada 3 segundos
            });
        });
    </script>
</body>
</html>
