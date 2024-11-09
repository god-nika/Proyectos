<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Tipos de Juegos</title>
</head>
<body>




    <form action="../../../config/Admin/Equipo/Regis_Equipo.php" method="POST">
        <label for="categoria">Categoría:</label>
        <input type="text" id="categoria" name="categoria" required>

        <label for="tarifa">Tarifa por Hora:</label>
        <input type="number" id="tarifa" name="tarifa" step="0.01" required>

        <button type="submit">Agregar Tipo de Juego</button>
    </form>


    <?php
    // Incluir el archivo de conexión
    include('../../../include/conexion.php');

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta para obtener los registros de la tabla tipo_juego
    $sql = "SELECT * FROM tipo_juego";
    $result = $conn->query($sql);

    // Cerrar la conexión después de obtener los datos
    $conn->close();
    ?>


    <table border="1">
        <thead>
            <tr>
                <th>Select</th>
                <th>ID</th>
                <th>Categoría</th>
                <th>Tarifa por Hora</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mostrar los datos obtenidos de la consulta
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='eliminar[]' value='" . $row['id_Tipo_Juego'] . "'></td>";
                    echo "<td>" . $row['id_Tipo_Juego'] . "</td>";
                    echo "<td>" . $row['Categoria'] . "</td>";
                    echo "<td>" . $row['Tarifa_Hora'] . "</td>";
                    echo "<td><button onclick=\"abrirModal('" . $row['Categoria'] . "', " . $row['id_Tipo_Juego'] . ", " . $row['Tarifa_Hora'] . ")\">Actualizar</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No hay tipos de juegos registrados</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <input type='button' value='Eliminar' onclick='confirmarEliminacion()' class='botonEliminar'>

    <a href="../../../template/Admin.php" class="btn">Volver al Menú</a>

<!-- Modal para actualizar tipo de juego -->
<!-- Modal para actualizar tipo de juego -->
<div id="modalActualizar" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="cerrarModal()">&times;</span>
        <h2>Actualizar Tipo de Juego</h2>
        <form action="../../../config/Admin/Equipo/Actua_Equipo.php" method="POST">
            <!-- Campo oculto para almacenar el ID del tipo de juego -->
            <input type="hidden" id="id_tipo_juego" name="id_tipo_juego">
            
            <!-- Campo para editar directamente el nombre de la categoría -->
            <label for="nueva_categoria">Nueva Categoría:</label>
            <input type="text" id="nueva_categoria" name="nueva_categoria" required><br><br>

            <!-- Campo para ingresar la nueva tarifa -->
            <label for="nueva_tarifa">Nueva Tarifa por Hora:</label>
            <input type="number" id="nueva_tarifa" name="nueva_tarifa" required><br><br>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</div>
<script>
    function abrirModal(categoria, idTipoJuego, tarifaHora) {
        // Mostrar el modal
        document.getElementById("modalActualizar").style.display = "block";

        document.getElementById('id_tipo_juego').value = idTipoJuego;
    document.getElementById('nueva_categoria').value = categoria;
    document.getElementById('nueva_tarifa').value = tarifaHora;
    }

    function cerrarModal() {
        // Ocultar el modal
        document.getElementById("modalActualizar").style.display = "none";
    }

    // Cerrar el modal si el usuario hace clic fuera de él
    window.onclick = function(event) {
        if (event.target == document.getElementById("modalActualizar")) {
            cerrarModal();
        }
    }

    function confirmarEliminacion() {
        if (confirm("¿Estás seguro de que deseas eliminar los elementos seleccionados?")) {
            // Aquí puedes agregar el código para manejar la eliminación
        }
    }
</script>






</body>
</html>
