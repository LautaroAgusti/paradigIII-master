<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/fuentes.css">
    <title>Fuentes de Alimentación - Byte Zone</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>

    <header>
        <div class="titulo">
            <h1>Byte Zone</h1>
        </div>
        <!-- Botón del carrito -->
        <a href="carrito.php" class="carrito">
    <i class="fas fa-shopping-cart"></i> Carrito
</a>

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
                    <img src="../imagenes/650portada.jpg" alt="Fuente Gigabyte 650W 80 Plus Bronze P650B" class="active">
                    <img src="../imagenes/650frente.jpg">
                    <img src="../imagenes/659costado.jpg">
                </div>
                <h4>Fuente Gigabyte 650W 80 Plus Bronze P650B</h4>
                <p>$90.000</p>
                <button class="add-to-cart" data-id="13">Comprar</button>
            </div>
            <!-- Producto 2 -->
            <div class="card">
                <div class="image-container">
                    <img src="../imagenes/750frontal.jpg" alt="Fuente Gigabyte 750W 80 Plus Gold UD750GM Full Modular PG5 ATX 3.0" class="active">
                    <img src="../imagenes/750abajo.jpg">
                    <img src="../imagenes/750atras.jpg">
                </div>
                <h4>Fuente Gigabyte 750W 80 Plus Gold UD750GM</h4>
                <p>$170.000</p>
                <button class="add-to-cart" data-id="14">Comprar</button>
            </div>
            <!-- Añadir más tarjetas de productos según sea necesario -->
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
