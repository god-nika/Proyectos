

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/form.css?<?php echo time(); ?>">
    
    <title>Ingreso de Productos - Billar</title>


    
</head>
<body>
    <div class="container">
        <h1>Ingreso de Productos - Billar</h1>
        <form action="../../../config/Admin/Productos/registro_producto.php" method="POST">
            <div class="form-group">
            <label for="tipo_producto">Tipo de Producto:</label>
<select name="tipo_producto[]" id="tipo_producto" required>
    <option value="" disabled selected>Selecciona una categoría</option>
    <option value="5">Comestible</option> 
    <option value="6">Bebida No Alcohólica</option>
    <option value="7">Bebida Alcohólica</option>
    <option value="8">Equipo de Juego</option>
</select>

            </div>

            <div class="form-group">
                <label for="nombre_producto">Nombre del Producto:</label>
                <input type="text" id="nombre_producto" name="nombre_producto" required placeholder="Ej: Papas, Gaseosa, Palo de Billar">
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" required placeholder="Ej: 5000">
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" required placeholder="Ej: 10">
            </div>

            <div class="form-group" id="detalles_adicionales">
    <label for="detalles">Detalles (opcional):</label>
    <textarea id="detalles" name="detalles" placeholder="Ej: Marca de papas, tipo de bebida, características del equipo"></textarea>
</div>


            <div class="form-group">
                <input type="submit" value="Ingresar Producto">
                <a href="../../../template/Admin.php" class="btn">Volver al Menú</a>
            </div>

           
        </form>
    </div>





    





   
</body>
</html>
