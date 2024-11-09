<?php
// Conectar a la base de datos
include('../../../include/conexion.php');

// Lógica de eliminación de productos
if (isset($_POST['id_producto']) && !empty($_POST['id_producto'])) {
    $ids = $_POST['id_producto'];

    // Convertir el array de IDs en una cadena separada por comas
    $ids_str = implode(',', array_map('intval', $ids));

    // Eliminar productos de la base de datos
    $query = "DELETE FROM productos WHERE id_Productos IN ($ids_str)";
    if ($conn->query($query) === TRUE) {
        // Redirigir a la misma página para reflejar los cambios
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();  // Terminar la ejecución del script
    } else {
        echo "<script>alert('Error al eliminar productos: " . $conn->error . "');</script>";
    }
}
?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/form_actua.css?<?php echo time(); ?>">
    

    <title>Productos - Billar</title>
    
    
    <script>
        function mostrarFormularioActualizar(id, nombre, precio, cantidad, detalles) {
            // Asignar valores al formulario
            document.getElementById('id_producto').value = id;
            document.getElementById('nombre_producto').value = nombre;
            document.getElementById('precio').value = precio;
            
            document.getElementById('detalles').value = detalles;

            // Mostrar el formulario
            document.getElementById('formulario_actualizacion').style.display = 'block';
        }

        function ocultarFormulario() {
            document.getElementById('formulario_actualizacion').style.display = 'none';
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Productos - Billar</h1>

         
        <form method="GET" action="form_Actua.php">
        <label for="filtro_categoria">Filtrar por Categoría:</label>
        <select id="filtro_categoria" name="filtro_categoria" onchange="this.form.submit()">
            <option value="">Todas las Categorías</option>
            <?php
            include('../../include/conexion.php');

            // Consultar todas las categorías
            $query = "SELECT * FROM categorias";
            $result = $conn->query($query);

            while ($row = $result->fetch_assoc()) {
                // Mantener la categoría seleccionada en el dropdown si se ha seleccionado previamente
                $selected = isset($_GET['filtro_categoria']) && $_GET['filtro_categoria'] == $row['id_Categoria'] ? 'selected' : '';
                echo "<option value=\"{$row['id_Categoria']}\" $selected>{$row['nombre']}</option>";
            }
            ?>
        </select>
    </form>


    <form id="form_eliminar" method="POST" action="">
        <!-- Tabla de Productos -->
<table border="1">
    <thead>
        <tr>
            <th>Seleccionar</th>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Detalles</th>
            <th>Categoría</th> 
            <th>Actualizar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include('../../../include/conexion.php');


            // Modificar la consulta para filtrar por categoría si se selecciona una
            $filtro_categoria = isset($_GET['filtro_categoria']) ? $_GET['filtro_categoria'] : '';



        // Consultar los productos junto con sus categorías
        $query = "
            SELECT p.*, c.nombre AS categoria
            FROM productos p
            JOIN producto_categoria pc ON p.id_Productos = pc.id_Productos             
            JOIN categorias c ON pc.id_Categoria = c.id_Categoria
            
        ";



            // Añadir filtro si hay una categoría seleccionada
            if (!empty($filtro_categoria)) {
                $query .= " WHERE pc.id_Categoria = $filtro_categoria";
            }

            $query .= " ORDER BY p.id_Productos ASC";




        $result = $conn->query($query);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td><input type='checkbox' name='id_producto[]' value='{$row['id_Productos']}'></td>
                <td>{$row['id_Productos']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['precio']}</td>
                <td>{$row['cantidad']}</td>
                <td>{$row['detalles']}</td>
                <td>{$row['categoria']}</td> <!-- Mostrar la categoría -->
                <td>
                    <button type='button' onclick=\"mostrarFormularioActualizar({$row['id_Productos']}, '{$row['nombre']}', {$row['precio']}, {$row['cantidad']}, '{$row['detalles']}')\">Actualizar</button>

                </td>
            </tr>";
        }


     

        ?>
    </tbody>
</table>
    
<input type='button' value='Eliminar' onclick='confirmarEliminacion()' class='botonEliminar'>
<a href="../../../template/Admin.php" class="btn">Volver al Menú</a>
</form>




</div>

        <!-- Formulario de Actualización -->
<div id="formulario_actualizacion" >
    <div class="contecte">
    <span class="close" onclick="cerrarModal()">&times;</span>
    <h2>Actualizar Producto</h2>
    <form action="../../../config/Admin/Productos/actualizar_producto.php" method="POST">
        <input type="hidden" id="id_producto" name="id_producto">
        
        <div class="form-group">
            <label for="nombre_producto">Nombre del Producto:</label>
            <input type="text" id="nombre_producto" name="nombre_producto" required>
        </div>

        <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" step="0.01" required>
        </div>

        

        <div class="form-group">
            <label for="detalles">Detalles (opcional):</label>
            <textarea id="detalles" name="detalles"></textarea>
        </div>

        <div class="form-group">
            <label for="categoria">Categoría:</label>
            <select id="categoria" name="categoria" required>
                <?php
                 // Conectar a la base de datos
                 include('../../../include/conexion.php');
                 
                 // Consultar las categorías
                 $query = "SELECT * FROM categorias";
                 $result = $conn->query($query);
         
                 while ($row = $result->fetch_assoc()) {
                     echo "<option value=\"{$row['id_Categoria']}\">{$row['nombre']}</option>";
                 }
                 ?>
            </select>
        </div>

        <div class="ppa">
        <button type="button" class="btn-cancelar" onclick="ocultarFormulario()">Cancelar</button>
            <input type="submit" value="Actualizar Producto">
        </div>
    </form>
            </div>
        </div>

<script> 

function confirmarEliminacion() {
    const seleccionados = document.querySelectorAll("input[name='id_producto[]']:checked");
    if (seleccionados.length > 0) {
        if (confirm("¿Estás seguro de que deseas eliminar los productos seleccionados?")) {
            document.getElementById("form_eliminar").submit();
        }
    } else {
        alert("Por favor, selecciona al menos un producto para eliminar.");
    }
}

function cerrarModal() {
        // Ocultar el modal
        document.getElementById("formulario_actualizacion").style.display = "none";
    }

    // Cerrar el modal si el usuario hace clic fuera de él
    window.onclick = function(event) {
        if (event.target == document.getElementById("formulario_actualizacion")) {
            cerrarModal();
        }
    }

</script>











    
</body>
</html>
