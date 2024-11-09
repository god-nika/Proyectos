<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Empleado</title>

    <link rel="stylesheet" href="../../../css/RegisVendedor.css?<?php echo time(); ?>">
  
</head>
<body>

<div class="container">
    <h2>Formulario de Empleado</h2>

    <form action="../../../config/Admin/Usuarios/registro_Vendedor.php" method="POST" enctype="multipart/form-data">
        <div class="form-group cedula-group">
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" required>
        </div>

        <div class="form-group">
            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>
        </div>

        <div class="form-group">
            <label for="password">Cree una contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="rol">Rol:</label>
            <select name="rol" id="rol" required>
                <option value="" disabled selected>Selecciona un rol</option>
                <option value="2">Vendedor</option> <!-- Asigna el valor que representa 'Vendedor' en tu tabla de roles -->
                <option value="3">Administrador</option> <!-- Asigna el valor que representa 'Administrador' en tu tabla de roles -->
            </select>
        </div>

        <input type="submit" value="Guardar">
        <a href="../../../template/Admin.php" class="btn">Volver al Menú</a>
    </form>
</div>

</body>
</html>
