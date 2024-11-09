<?php
// actualizar_producto.php
include('../../../include/conexion.php');

$producto_id = $_POST['id_producto'];
$nombre_producto = $_POST['nombre_producto'];
$precio = $_POST['precio'];

$detalles = $_POST['detalles'];
$categoria_id = $_POST['categoria'];

// Iniciar una transacción para asegurar que ambas operaciones se realicen juntas
$conn->begin_transaction();

try {
    // Actualizar los datos del producto en la tabla 'productos'
    $query = "UPDATE productos SET nombre = ?, precio = ?, detalles = ? WHERE id_Productos = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sdsi", $nombre_producto, $precio, $detalles, $producto_id);
    $stmt->execute();

    // Actualizar la categoría del producto en la tabla 'producto_categoria'
    $query_categoria = "UPDATE producto_categoria SET id_Categoria = ? WHERE id_Productos = ?";
    $stmt_categoria = $conn->prepare($query_categoria);
    $stmt_categoria->bind_param("ii", $categoria_id, $producto_id);
    $stmt_categoria->execute();

    // Confirmar la transacción si ambas actualizaciones fueron exitosas
    $conn->commit();

    echo "<script>alert('Producto actualizado con éxito.'); window.location.href = '../../../Formularios/Admin/Productos/form_Actua.php';</script>";
} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $conn->rollback();
    echo "<script>alert('Error al actualizar el producto.'); window.location.href = '../../../Formularios/Admin/Productos/form_Actua.php';</script>";
}

// Cerrar conexiones
$stmt->close();
$stmt_categoria->close();
$conn->close();











?>
