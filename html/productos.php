<?php
include 'conexion.php';

// Configuración de directorio para subir imágenes
$uploadDir = '../imagenes/';

// Manejo de operaciones CRUD
$action = $_GET['action'] ?? 'list'; // Acción por defecto es 'list'

// Crear producto
if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Manejo de la imagen subida
    $imagen_url = '';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen_url = $uploadDir . basename($_FILES['imagen']['name']);
        move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen_url);
    }

    $sql = "INSERT INTO productos (nombre, categoria, descripcion, precio, imagen_url) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssds", $nombre, $categoria, $descripcion, $precio, $imagen_url);

    if ($stmt->execute()) {
        $message = "Producto creado exitosamente.";
    } else {
        $message = "Error al crear el producto: " . $conn->error;
    }
    $stmt->close();
    $action = 'list';
}

// Actualizar producto
if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Manejo de la imagen subida
    $imagen_url = $_POST['imagen_actual'];
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen_url = $uploadDir . basename($_FILES['imagen']['name']);
        move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen_url);
    }

    $sql = "UPDATE productos SET nombre = ?, categoria = ?, descripcion = ?, precio = ?, imagen_url = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdsd", $nombre, $categoria, $descripcion, $precio, $imagen_url, $id);

    if ($stmt->execute()) {
        $message = "Producto actualizado exitosamente.";
    } else {
        $message = "Error al actualizar el producto: " . $conn->error;
    }
    $stmt->close();
    $action = 'list';
}

// Eliminar producto
if ($action === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM productos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = "Producto eliminado exitosamente.";
    } else {
        $message = "Error al eliminar el producto: " . $conn->error;
    }
    $stmt->close();
    $action = 'list';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Productos</title>
    <link rel="stylesheet" href="../css/productos.css">
</head>
<body>
    <h1>CRUD de Productos</h1>
    <div class="container">
        <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>

        <?php if ($action === 'list'): ?>
            <a href="?action=create" class="btn">Agregar Producto</a>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Imagen</th>
                        <th>Fecha Agregado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM productos";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0):
                        while ($row = $result->fetch_assoc()):
                    ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['categoria']; ?></td>
                            <td><?php echo $row['descripcion']; ?></td>
                            <td><?php echo "$" . number_format($row['precio'], 2); ?></td>
                            <td><img src="<?php echo $row['imagen_url']; ?>" width="50"></td>
                            <td><?php echo $row['fecha_agregado']; ?></td>
                            <td class="actions">
                                <a href="?action=edit&id=<?php echo $row['id']; ?>" class="btn edit">Editar</a>
                                <a href="?action=delete&id=<?php echo $row['id']; ?>" class="btn delete" onclick="return confirm('¿Estás seguro de eliminar este producto?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; else: ?>
                        <tr><td colspan="8">No hay productos disponibles.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php elseif ($action === 'create' || $action === 'edit'): ?>
            <?php
            $producto = ['id' => '', 'nombre' => '', 'categoria' => '', 'descripcion' => '', 'precio' => '', 'imagen_url' => ''];
            if ($action === 'edit' && isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM productos WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $producto = $result->fetch_assoc();
                $stmt->close();
            }
            ?>
            <form action="?action=<?php echo $action === 'create' ? 'create' : 'update'; ?>" method="POST" enctype="multipart/form-data">
                <?php if ($action === 'edit'): ?>
                    <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                    <input type="hidden" name="imagen_actual" value="<?php echo $producto['imagen_url']; ?>">
                <?php endif; ?>
                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
                <label>Categoría:</label>
                <select name="categoria" required>
                    <option value="">Seleccionar categoría</option>
                    <option value="Procesadores" <?php echo $producto['categoria'] === 'Procesadores' ? 'selected' : ''; ?>>Procesadores</option>
                    <option value="Placas Madre" <?php echo $producto['categoria'] === 'Placas Madre' ? 'selected' : ''; ?>>Placas Madre</option>
                    <option value="Memorias RAM" <?php echo $producto['categoria'] === 'Memorias RAM' ? 'selected' : ''; ?>>Memorias RAM</option>
                    <option value="Tarjetas Gráficas" <?php echo $producto['categoria'] === 'Tarjetas Gráficas' ? 'selected' : ''; ?>>Tarjetas Gráficas</option>
                    <option value="Almacenamiento" <?php echo $producto['categoria'] === 'Almacenamiento' ? 'selected' : ''; ?>>Almacenamiento</option>
                    <option value="Fuentes de Alimentación" <?php echo $producto['categoria'] === 'Fuentes de Alimentación' ? 'selected' : ''; ?>>Fuentes de Alimentación</option>
                </select>
                <label>Descripción:</label>
                <textarea name="descripcion" required><?php echo $producto['descripcion']; ?></textarea>
                <label>Precio:</label>
                <input type="number" name="precio" step="0.01" value="<?php echo $producto['precio']; ?>" required>
                <label>Imagen:</label>
                <input type="file" name="imagen">
                <?php if ($action === 'edit'): ?>
                    <p>Imagen actual: <img src="<?php echo $producto['imagen_url']; ?>" width="50"></p>
                <?php endif; ?>
                <button type="submit" class="btn"><?php echo $action === 'create' ? 'Crear' : 'Actualizar'; ?></button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
