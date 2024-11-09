<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/ActuaStock.css?<?php echo time(); ?>">
    <title>Tabla de Productos y Movimientos de Stock</title>
    <style>
        /* Estilos para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #333;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>




<?php
// Conexión a la base de datos
include('../../../include/conexion.php'); // Cambia esto al nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener los productos y sus movimientos de stock
$query = "SELECT 
    p.id_Productos AS id_producto,
    p.nombre AS nombre_producto,
    p.precio AS precio,
    p.cantidad AS cantidad_actual,
    p.detalles AS detalles,
    c.nombre AS categoria,
    ms.cantidad_Ingresada AS cantidad_ingresada,
    ms.fecha AS fecha_ingreso,
    ms.cantidad_total AS cantidad_despues_ingreso
FROM 
    productos p
LEFT JOIN 
    producto_categoria pc ON p.id_Productos = pc.id_Productos
LEFT JOIN 
    categorias c ON pc.id_Categoria = c.id_Categoria
LEFT JOIN 
    movimientos_stock ms ON p.id_Productos = ms.id_producto
ORDER BY 
    p.id_Productos, ms.fecha DESC;";

$result = $conn->query($query);
?>

<div class="container">

<h2>Lista de Productos y Movimientos de Stock</h2>

<table border="1"> <!-- Añadir borde para mejor visualización -->
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad Actual</th>
            <th>Detalles</th>
            <th>Categoría</th>
            <th>Cantidad Ingresada</th>
            <th>Fecha de Ingreso</th>
            <th>Cantidad Después del Ingreso</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            // Mostrar los datos de cada fila
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id_producto'] . "</td>"; // Cambiar a id_producto
                echo "<td>" . $row['nombre_producto'] . "</td>"; // Cambiar a nombre_producto
                echo "<td>" . $row['precio'] . "</td>";
                echo "<td>" . $row['cantidad_actual'] . "</td>";
                echo "<td>" . $row['detalles'] . "</td>";
                echo "<td>" . $row['categoria'] . "</td>";
                echo "<td>" . ($row['cantidad_ingresada'] ?? '') . "</td>"; // Mostrar vacío si no hay valor
                echo "<td>" . ($row['fecha_ingreso'] ?? '') . "</td>"; // Mostrar vacío si no hay valor
                echo "<td>" . ($row['cantidad_despues_ingreso'] ?? '') . "</td>"; // Mostrar vacío si no hay valor
                echo "<td><button onclick=\"abrirModal('" . $row['nombre_producto'] . "', " . $row['id_producto'] . ", " . $row['cantidad_actual'] . ")\">Registrar</button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No hay productos registrados</td></tr>";
        }
        ?>
    </tbody>
</table>

<a href="../../../template/Admin.php" class="btn">Volver al Menú</a>

</div>

<!-- Modal para registrar cantidad ingresada -->
<div id="modalRegistrar" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="cerrarModal()">&times;</span>
        <h2>Registrar Nueva Cantidad de Producto</h2>
        <form action="../../../config/Admin/Productos/Actua_Stock.php" method="POST">
            <p id="productoSeleccionado">Producto: </p>
            <p id="cantidadActual">Cantidad Actual: </p>

            <input type="hidden" id="id_producto" name="id_producto">
            <input type="hidden" id="cantidad_actual" name="cantidad_actual">

            <label for="cantidad_ingresada">Cantidad a Ingresar:</label>
            <input type="number" id="cantidad_ingresada" name="cantidad_ingresada" required><br><br>

            <button type="submit">Actualizar Stock</button>
        </form>
    </div>
</div>



<script>
    function abrirModal(nombreProducto, idProducto, cantidadActual) {
        // Mostrar el modal
        document.getElementById("modalRegistrar").style.display = "block";

        // Configurar los valores del producto seleccionado
        document.getElementById("productoSeleccionado").innerText = "Producto: " + nombreProducto;
        document.getElementById("cantidadActual").innerText = "Cantidad Actual: " + cantidadActual;
        document.getElementById("id_producto").value = idProducto;
        document.getElementById("cantidad_actual").value = cantidadActual;
    }

    function cerrarModal() {
        // Ocultar el modal
        document.getElementById("modalRegistrar").style.display = "none";
    }

    // Cerrar el modal si el usuario hace clic fuera de él
    window.onclick = function(event) {
        if (event.target == document.getElementById("modalRegistrar")) {
            cerrarModal();
        }
    }
</script>








</body>
</html>


