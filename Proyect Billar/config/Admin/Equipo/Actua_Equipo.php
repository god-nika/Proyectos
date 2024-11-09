<?php
// Incluye la conexión a la base de datos
include('../../../include/Conexion.php'); // Asegúrate de que esta ruta es correcta y lleva al archivo de conexión

// Verifica si se enviaron los datos desde el formulario
if (isset($_POST['id_tipo_juego']) && isset($_POST['nueva_categoria']) && isset($_POST['nueva_tarifa'])) {
    // Obtiene los valores enviados por el formulario
    $id_tipo_juego = $_POST['id_tipo_juego'];
    $nueva_categoria = $_POST['nueva_categoria'];
    $nueva_tarifa = $_POST['nueva_tarifa'];

    // Prepara la consulta de actualización
    $sql = "UPDATE Tipo_Juego SET Categoria = ?, Tarifa_Hora = ? WHERE id_Tipo_Juego = ?";

    // Prepara la sentencia
    if ($stmt = $conn->prepare($sql)) {
        // Asocia los parámetros a la consulta
        $stmt->bind_param("sdi", $nueva_categoria, $nueva_tarifa, $id_tipo_juego);

        // Ejecuta la consulta
        if ($stmt->execute()) {
            // Redirecciona a la página principal con un mensaje de éxito
            echo "<script>alert('Datos actualizados correctamente'); window.location.href = '../../../Formularios/Admin/Equipo/Regis_Equipo.php';</script>";
            exit();
        } else {
            echo "Error al actualizar el registro: " . $stmt->error;
        }

        // Cierra la sentencia
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
} else {
    echo "Faltan datos para realizar la actualización.";
}

// Cierra la conexión
$conn->close();
?>
