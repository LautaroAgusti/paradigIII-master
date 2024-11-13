<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arma tu PC - Byte Zone</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/armatupc.css"> <!-- Añadir el CSS específico para esta página -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
            <li><a href="componentes.php">Componentes</a></li>
            <li><a href="armatupc.php">Arma tu PC</a></li>
            <li><a href="user.php">Login</a></li>
        </ul>
    </nav>

    <main>
        <div class="componentes-lista">
            <h3>Componentes</h3>
            <ul>
                <li>
                    <button class="dropdown-btn">Procesadores</button>
                    <div class="dropdown-content">
                        <img src="../imagenes/i5frente.jpg" alt="Procesador Intel Core i5 12400">
                        <h4>Procesador Intel Core i5 12400 4.4GHz Turbo</h4>
                        <p>$195.000</p>
                    </div>
                </li>
                <li>
                    <button class="dropdown-btn">Placas Madres</button>
                    <div class="dropdown-content">
                        <img src="../imagenes/motherfrontal.jpg" alt="Mother Gigabyte B760 AORUS ELITE AX WIFI DDR5">
                        <h4>Mother Gigabyte B760 AORUS ELITE AX WIFI DDR5</h4>
                        <p>$245.000</p>
                    </div>
                </li>
                <li>
                    <button class="dropdown-btn">Memorias RAM</button>
                    <div class="dropdown-content">
                        <img src="../imagenes/ddr4ram.jpg" alt="Memoria Ram Fury Beast 16gb Ddr4 3200MHZ">
                        <h4>Memoria Ram Fury Beast 16gb Ddr4 3200MHZ</h4>
                        <p>$70.000</p>
                    </div>
                </li>
                <li>
                    <button class="dropdown-btn">Tarjetas de Video</button>
                    <div class="dropdown-content">
                        <img src="../imagenes/4060tiportada.jpg" alt="MSI GeForce RTX 4060 Ti 8GB GDDR6 Ventus 3X Black OC">
                        <h4>MSI GeForce RTX 4060 Ti 8GB GDDR6 Ventus 3X Black OC</h4>
                        <p>$565.000</p>
                    </div>
                </li>
                <li>
                    <button class="dropdown-btn">Almacenamiento</button>
                    <div class="dropdown-content">
                        <img src="../imagenes/discom2.jpg" alt="Disco Solido SSD M.2 WD 1TB WD_Black SN770 5150MB/s">
                        <h4>Disco Solido SSD M.2 WD 1TB SN770 5150MB/s</h4>
                        <p>$110.000</p>
                    </div>
                </li>
                <li>
                    <button class="dropdown-btn">Fuentes de Poder</button>
                    <div class="dropdown-content">
                        <img src="../imagenes/650portada.jpg" alt="Fuente Gigabyte 650W 80 Plus Bronze P650B">
                        <h4>Fuente Gigabyte 650W 80 Plus Bronze P650B</h4>
                        <p>$90.000</p>
                    </div>
                </li>
            </ul>
        </div>
    </main>

    <footer>
        <div class="piedepagina">
            <p>Derechos Reservados - Byte Zone</p>
        </div>
    </footer>

    <script>
        $(document).ready(function() {
            $(".dropdown-btn").click(function() {
                // Cerrar cualquier contenido desplegable abierto, excepto el actual
                $(".dropdown-content").not($(this).next()).slideUp();
                
                // Alternar el desplegable asociado al botón actual
                $(this).next(".dropdown-content").slideToggle();
            });
        });
    </script>    
</body>
</html>
