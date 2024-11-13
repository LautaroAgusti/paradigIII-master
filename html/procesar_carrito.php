<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto_id'])) {
    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['id_usuario'])) {
        echo json_encode(['success' => false, 'message' => 'Debes iniciar sesión para agregar productos al carrito.']);
        exit();
    }

    $usuario_id = $_SESSION['id_usuario'];
    $producto_id = intval($_POST['producto_id']);

    // Verificar si el producto existe en la base de datos
    $producto_verificar = "SELECT id FROM productos WHERE id = ?";
    $stmt = $conn->prepare($producto_verificar);
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $resultado_producto = $stmt->get_result();

    if ($resultado_producto->num_rows === 0) {
        // Producto no existe
        echo json_encode(['success' => false, 'message' => 'El producto seleccionado no existe.']);
        exit();
    }

    // Verificar si el producto ya está en el carrito
    $query = "SELECT * FROM carrito WHERE usuario_id = ? AND producto_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $usuario_id, $producto_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Si el producto ya está en el carrito, incrementar la cantidad
        $query = "UPDATE carrito SET cantidad = cantidad + 1 WHERE usuario_id = ? AND producto_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $usuario_id, $producto_id);
    } else {
        // Si no está en el carrito, añadirlo
        $query = "INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES (?, ?, 1)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $usuario_id, $producto_id);
    }

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Producto agregado al carrito.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al agregar el producto al carrito.']);
    }
    exit();
}
?>
