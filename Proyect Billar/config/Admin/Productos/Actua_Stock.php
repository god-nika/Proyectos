<?php
// Conexión a la base de datos
include('../../../include/conexion.php');

$id_producto = $_POST['id_producto']; // ID del producto seleccionado
$cantidad_ingresada = $_POST['cantidad_ingresada']; // Nueva cantidad ingresada

// Iniciar una transacción para asegurar consistencia de datos
$conn->begin_transaction();

try {
    // 1. Registrar el nuevo movimiento de stock
    $query_insert_stock = "INSERT INTO movimientos_stock (id_producto, cantidad_Ingresada, fecha, cantidad_total)
                           VALUES (?, ?, NOW(), ?)";
    $stmt_stock = $conn->prepare($query_insert_stock);
    
    // Obtener la cantidad actual del producto
    $query_get_cantidad = "SELECT cantidad FROM productos WHERE id_Productos = ?";
    $stmt_get_cantidad = $conn->prepare($query_get_cantidad);
    $stmt_get_cantidad->bind_param("i", $id_producto);
    $stmt_get_cantidad->execute();
    $result = $stmt_get_cantidad->get_result();
    $row = $result->fetch_assoc();
    
    $cantidad_actual = $row['cantidad'];
    $cantidad_total = $cantidad_actual + $cantidad_ingresada;
    
    // Ejecutar el INSERT en movimientos_stock
    $stmt_stock->bind_param("iii", $id_producto, $cantidad_ingresada, $cantidad_total);
    $stmt_stock->execute();
    
    // 2. Actualizar la cantidad en la tabla productos
    $query_update_productos = "UPDATE productos SET cantidad = ? WHERE id_Productos = ?";
    $stmt_productos = $conn->prepare($query_update_productos);
    $stmt_productos->bind_param("ii", $cantidad_total, $id_producto);
    $stmt_productos->execute();

    // Confirmar la transacción
    $conn->commit();
    echo "<script>alert('Producto registrado y actualizado correctamente.'); window.location.href = '../../../Formularios/Admin/Productos/ActuaStock.php';</script>";

} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión
$conn->close();
?>


