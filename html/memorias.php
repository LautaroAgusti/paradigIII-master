<?php include 'conexion.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/memorias.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Memorias RAM - Byte Zone</title>
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
                    <img src="../imagenes/ddr4ram.jpg" alt="Memoria Ram Fury Beast 16gb Ddr4 3200MHZ" class="active">
                    <img src="../imagenes/ddr4ram2.jpg">
                </div>
                <h4>Memoria Ram Fury Beast 16gb Ddr4 3200MHZ</h4>
                <p>$70.000</p>
                <button class="add-to-cart" data-id="5">Comprar</button>
            </div>
            <!-- Producto 2 -->
            <div class="card">
                <div class="image-container">
                    <img src="../imagenes/ddr5ram.jpg" alt="Memoria Ram Fury Beast 32GB Ddr5 5600MHZ" class="active">
                    <img src="../imagenes/ddr5ram2.jpg">
                </div>
                <h4>Memoria Kingston Fury Beast 32GB DDR5</h4>
                <p>$140.000</p>
                <button class="add-to-cart" data-id="6">Comprar</button>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
