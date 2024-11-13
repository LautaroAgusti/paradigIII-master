<?php
session_start();
include 'conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    echo "<script>alert('Debe iniciar sesión para ver el carrito.'); window.location.href='user.php';</script>";
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

// Procesar la eliminación de un producto si se envía la solicitud
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_producto_id'])) {
    $producto_id = intval($_POST['eliminar_producto_id']);

    $query = "DELETE FROM carrito WHERE usuario_id = ? AND producto_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $id_usuario, $producto_id);
    if ($stmt->execute()) {
        echo "<script>alert('Producto eliminado del carrito.'); window.location.href='carrito.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el producto.'); window.location.href='carrito.php';</script>";
    }
    exit();
}

// Obtener los productos del carrito
$query = "SELECT c.producto_id, c.cantidad, p.nombre, p.precio, (c.cantidad * p.precio) AS total 
          FROM carrito c
          JOIN productos p ON c.producto_id = p.id
          WHERE c.usuario_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

$total_carrito = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="../css/carrito.css">
</head>
<body>
        <a href="../index.php">
        <h1>Byte Zone</h1>
        </a>

    <table>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Total</th>
            <th>Eliminar</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['cantidad']; ?></td>
                <td>$<?php echo number_format($row['precio'], 2); ?></td>
                <td>$<?php echo number_format($row['total'], 2); ?></td>
                <td>
                    <form method="POST" style="margin: 0;">
                        <input type="hidden" name="eliminar_producto_id" value="<?php echo $row['producto_id']; ?>">
                        <button type="submit" class="eliminar-btn">X</button>
                    </form>
                </td>
            </tr>
            <?php $total_carrito += $row['total']; ?>
        <?php endwhile; ?>
        <tr>
            <td colspan="3">Total</td>
            <td>$<?php echo number_format($total_carrito, 2); ?></td>
            <td></td>
        </tr>
    </table>
    <a href="../index.php" class="return-btn">Seguir Comprando</a>
</body>
</html>
