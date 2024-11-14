<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/placasmadres.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Placas Madre - Byte Zone</title>
</head>
<body>
    <!-- Botón del carrito -->
    <a href="carrito.php" class="carrito">
        <i class="fas fa-shopping-cart"></i> <!-- Icono del carrito -->
        <span>Carrito</span>
    </a>

    <header>
        <div class="titulo">
            <h1>Byte Zone</h1>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="../html/componentes.php">Componentes</a></li>
            <li><a href="../html/armatupc.php">Arma tu PC</a></li>
        </ul>
    </nav>

    <main>
    <div class="product-container">
    <!-- Producto 1 -->
    <div class="card">
        <div class="image-container">
            <img src="../imagenes/motherfrontal.jpg" alt="Mother Gigabyte B760 AORUS ELITE AX WIFI DDR5" class="active">
            <img src="../imagenes/motherfrontal1.jpg">
            <img src="../imagenes/mothercostado.jpg">
            <img src="../imagenes/motheratras.jpg">
        </div>
        <h4>Mother Gigabyte B760 AORUS ELITE AX WIFI DDR5</h4>
        <p>$245.000</p>
        <button class="add-to-cart" data-id="3">Comprar</button> <!-- Asegúrate de que el ID sea el correcto -->
    </div>
    <!-- Producto 2 -->
    <div class="card">
        <div class="image-container">
            <img src="../imagenes/motherz790portada.jpg" alt="Mother MSI Z790 PROJECT ZERO LGA 1700" class="active">
            <img src="../imagenes/z790frontal.jpg">
            <img src="../imagenes/z790costado.jpg">
            <img src="../imagenes/z790atras.jpg">
        </div>
        <h4>Mother MSI Z790 PROJECT ZERO LGA 1700</h4>
        <p>$320.000</p>
        <button class="add-to-cart" data-id="4">Comprar</button> <!-- Este ID debe coincidir con el de la base de datos -->
    </div>
</div>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Configuración de los botones "Comprar"
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
