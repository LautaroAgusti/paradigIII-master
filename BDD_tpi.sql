
CREATE DATABASE bytezone;
USE bytezone;


CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'usuario') NOT NULL DEFAULT 'usuario', -- Añadido para roles
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    imagen_url VARCHAR(255),
    fecha_agregado TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO productos (nombre, categoria, descripcion, precio, imagen_url) 
VALUES 
('Procesador Intel Core i5 12400', 'Procesadores', 'Procesador de alto rendimiento con 4.4GHz Turbo', 195000, 'i5frente.jpg'),
('Procesador Intel Core i7 12700KF', 'Procesadores', 'Procesador de alto rendimiento con 5.0GHz Turbo', 320000, 'i7frente.jpg'),
('Mother Gigabyte B760 AORUS ELITE AX WIFI DDR5', 'Placas Madre', 'Placa base Gigabyte con soporte para DDR5 y WiFi integrado.', 245000, '../imagenes/motherfrontal.jpg'),
('Mother MSI Z790 PROJECT ZERO LGA 1700', 'Placas Madre', 'Placa base MSI con diseño premium y soporte LGA 1700.', 320000, '../imagenes/motherz790portada.jpg'),
('Memoria Ram Fury Beast 16gb Ddr4 3200MHZ', 'Memorias RAM', 'Memoria RAM DDR4 de 3200MHz', 70000, '../imagenes/ddr4ram.jpg'),
('Memoria Kingston Fury Beast 32GB DDR5', 'Memorias RAM', 'Memoria RAM DDR5 de 5600MHz', 140000, '../imagenes/ddr5ram.jpg'),
('MSI GeForce RTX 3060 12GB GDDR6 VENTUS 2X OC', 'Tarjetas de Video', 'Tarjeta gráfica MSI con 12GB de memoria GDDR6.', 395000, '../imagenes/3060portada.jpg'),
('MSI GeForce RTX 4060 Ti 8GB GDDR6 Ventus 3X Black OC', 'Tarjetas de Video', 'Tarjeta gráfica MSI con 8GB de memoria GDDR6 y diseño Black OC.', 565000, '../imagenes/4060tiportada.jpg'),
('Disco Solido SSD M.2 WD 1TB SN770 5150MB/s', 'Almacenamiento', 'SSD M.2 WD con velocidad de lectura de hasta 5150MB/s.', 110000, '../imagenes/discom2.jpg'),
('Disco Solido SSD Team 2TB Vulcan Z 550MB/s', 'Almacenamiento', 'SSD Team Vulcan Z con capacidad de 2TB y velocidad de 550MB/s.', 130000, '../imagenes/ssd2.jpg'),
('Fuente Gigabyte 650W 80 Plus Bronze P650B', 'Fuentes de Alimentación', 'Fuente de poder Gigabyte con certificación 80 Plus Bronze.', 90000, '../imagenes/650portada.jpg'),
('Fuente Gigabyte 750W 80 Plus Gold UD750GM', 'Fuentes de Alimentación', 'Fuente de poder Gigabyte con certificación 80 Plus Gold y diseño modular.', 170000, '../imagenes/750frontal.jpg');

CREATE TABLE carrito (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    fecha_agregado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE
);
SELECT * FROM usuarios WHERE id = 1; 
SELECT * FROM productos WHERE id = 1; 





CREATE TABLE configuracion (
    id_config INT AUTO_INCREMENT PRIMARY KEY,
    clave VARCHAR(255) NOT NULL UNIQUE,
    valor TEXT NOT NULL
);

DELETE FROM carrito WHERE producto_id IN (SELECT id FROM productos);
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE productos;
SET FOREIGN_KEY_CHECKS = 1;
