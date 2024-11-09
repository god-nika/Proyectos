<?php
// Conexión a la base de datos
include('../../../include/conexion.php'); 

// Obtener los datos del formulario
$nombre_producto = $_POST['nombre_producto'];
$precio = $_POST['precio'];
$cantidad = $_POST['cantidad'];
$detalles = $_POST['detalles'];
$categoria_ids = $_POST['tipo_producto']; // Suponiendo que recibes un array con las categorías seleccionadas

// Insertar el producto
$query = "INSERT INTO productos (nombre, precio, cantidad, detalles) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("sdis", $nombre_producto, $precio, $cantidad, $detalles);

if ($stmt->execute()) {
    $producto_id = $stmt->insert_id; // Obtener el ID del producto insertado

    // Insertar en la tabla intermedia
    foreach ($categoria_ids as $id_categoria) {
        $query_categoria = "INSERT INTO producto_categoria (id_Productos, id_Categoria) VALUES (?, ?)";
        $stmt_categoria = $conn->prepare($query_categoria);
        $stmt_categoria->bind_param("ii", $producto_id, $id_categoria);
        $stmt_categoria->execute();
    }

    // Cerrar la conexión
    $stmt->close();
    $stmt_categoria->close();
    $conn->close();

    // Mostrar mensaje de éxito y redirigir
    echo "<script>
        alert('Producto guardado con éxito.');
        window.location.href = '../../../Formularios/Admin/Productos/form_Actua.php'; // Redirigir al formulario
    </script>";

} else {
    // En caso de error
    echo "<script>
        alert('Error al guardar el producto.');
        window.location.href = '../../../Formularios/Admin/Productos/form.php'; // Redirigir al formulario
    </script>";
}

?>
