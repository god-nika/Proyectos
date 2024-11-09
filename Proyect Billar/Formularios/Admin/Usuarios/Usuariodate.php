<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/AdminUser.css?<?php echo time(); ?>">
    <title>Usuarios </title>
</head>
<body>
<div class="container">

<h1>Usuarios</h1>

<!-- Filtro por Rol -->
<form method="GET" action="">
    <label for="filtro_rol">Filtrar por Rol:</label>
    <select id="filtro_rol" name="filtro_rol" onchange="this.form.submit()">
        <option value="">Todos los Roles</option>
        <?php
        // Conexión a la base de datos
        include('../../../include/conexion.php');

       // Consultar solo los roles de Cliente y Vendedor
         $query_roles = "SELECT * FROM rol WHERE id_Rol IN (1, 2)";
         $result_roles = mysqli_query($conn, $query_roles);

        while ($row = mysqli_fetch_assoc($result_roles)) {
            // Mantener el rol seleccionado en el dropdown si se ha seleccionado previamente
            $selected = isset($_GET['filtro_rol']) && $_GET['filtro_rol'] == $row['id_Rol'] ? 'selected' : '';
            echo "<option value=\"{$row['id_Rol']}\" $selected>{$row['rol']}</option>";
        }
        ?>
    </select>
</form>



<?php
// Conexión a la base de datos
include('../../../include/Conexion.php');

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Eliminar registros
if (isset($_POST['eliminar'])) {
    $registros_a_eliminar = $_POST['eliminar'];
    foreach ($registros_a_eliminar as $id) {
        $consulta_eliminar = "DELETE FROM persona WHERE id_Persona = $id";
        if (!mysqli_query($conn, $consulta_eliminar)) {
            echo "Error al eliminar el registro con ID $id: " . mysqli_error($conn);
        }
    }
    
}



// Consulta para obtener todos los registros de persona y su rol

$filtro_rol = isset($_GET['filtro_rol']) ? $_GET['filtro_rol'] : '';

$consulta = "
    SELECT persona.*, rol.rol, estado.Nombre 
    FROM persona 
    LEFT JOIN user_rol ON persona.id_Persona = user_rol.id_Persona 
    LEFT JOIN rol ON user_rol.id_Rol = rol.id_Rol
    LEFT JOIN estado ON user_rol.id_estado = estado.id_estado
    WHERE user_rol.id_Rol IN (1, 2)";




// Añadir filtro si hay un rol seleccionado
if (!empty($filtro_rol)) {
    $consulta .= " AND user_rol.id_Rol  = $filtro_rol";
}



$resultado = mysqli_query($conn, $consulta);

if (mysqli_num_rows($resultado) > 0) {
    echo "<form id='eliminarForm' action='' method='post'>";
    echo "<table>";
    echo "<tr><th>Seleccionar</th><th>ID</th><th>Cédula</th><th>Nombre</th><th>Apellido</th><th>Teléfono</th><th>Correo</th><th>Dirección</th><th>Estado</th><th>Rol</th><th>Actualizar</th></tr>";
    
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td><input type='checkbox' name='eliminar[]' value='" . $fila['id_Persona'] . "'></td>";
        echo "<td>" . $fila['id_Persona'] . "</td>";
        echo "<td>" . $fila['Cedula'] . "</td>";
        echo "<td>" . $fila['nombres'] . "</td>";
        echo "<td>" . $fila['apellidos'] . "</td>";
        echo "<td>" . $fila['Telefono'] . "</td>";
        echo "<td>" . $fila['correo'] . "</td>";
        echo "<td>" . $fila['Direccion'] . "</td>";
        echo "<td>" . $fila['Nombre'] . "</td>";
        echo "<td>" . $fila['rol'] . "</td>";
        echo "<td><input type='button' value='Actualizar' onclick='abrirModal(" . json_encode($fila) . ")' class='botonEditar'></td>";
        echo "</tr>";
    }
    
    echo "</table>";
    echo "<input type='button' value='Eliminar' onclick='confirmarEliminacion()' class='botonEliminar'>";
    echo "<a href='../../../template/Admin.php' class='btn'>Volver al Menú</a>";
    echo "</form>";
} else {
    echo "No hay registros para mostrar.";
}

mysqli_close($conn);
?>

</div>


<!-- Modal para editar -->
<div id="modalEditar" class="modal">
    <div class="modal-content">
        <span class="close" onclick="cerrarModal()">&times;</span>
        <form id="formEditar" action="../../../config/Admin/Usuarios/Actualizar_User.php" method="post">
            <input type="hidden" name="id" id="editId">
            <label for="cedula">Cédula:</label>
            <input type="text" name="cedula" id="editCedula"><br>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="editNombre"><br>
            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" id="editApellido"><br>
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="editTelefono"><br>
            <label for="correo">Correo:</label>
            <input type="text" name="correo" id="editCorreo"><br>
            <label for="estado">Estado:</label>
                <select name="estado" id="editEstado">
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                    <option value="3">De baja</option>
                </select><br>

            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" id="editDireccion"><br>

            <div class="form-group">
                
            <button type="button" class="btn-cancelar" onclick="ocultarFormulario()">Cancelar</button>

            <input type="button" class="pocoyo" value="Guardar cambios" onclick="guardarCambios()">
    
        </div>
  
        </form>
    </div>
</div>


<script>
// JavaScript para el manejo del modal y edición
function confirmarEliminacion() {
    if (confirm("¿Estás seguro de que deseas eliminar los registros seleccionados?")) {
        document.getElementById("eliminarForm").submit();
    }
}

function abrirModal(fila) {
    // Rellena los campos del formulario
    document.getElementById('editId').value = fila.id_Persona;
    document.getElementById('editCedula').value = fila.Cedula;
    document.getElementById('editNombre').value = fila.nombres;
    document.getElementById('editApellido').value = fila.apellidos;
    document.getElementById('editTelefono').value = fila.Telefono;
    document.getElementById('editCorreo').value = fila.correo;
    document.getElementById('editDireccion').value = fila.Direccion;
    document.getElementById('editEstado').value = fila.id_estado; // Cambia aquí según el nombre de la columna

    // Mostrar el modal
    document.getElementById('modalEditar').style.display = "flex";
}


function cerrarModal() {
    // Ocultar el modal
    document.getElementById('modalEditar').style.display = "none";
}

function ocultarFormulario() {
    // Ocultar el modal (función para el botón cancelar)
    document.getElementById('modalEditar').style.display = "none";
}


function guardarCambios() {
    var form = document.getElementById('formEditar');
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../../config/Admin/Usuarios/Actualizar_User.php", true); // Actualiza esta URL si es necesario
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert("Registro actualizado correctamente.");
            location.reload(); // Recargar la página para mostrar los cambios
        } else {
            alert("Error al actualizar el registro.");
        }
    };
    xhr.send(formData);
}


</script>



</body>
</html>