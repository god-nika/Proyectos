<?php
// Incluye la conexión a la base de datos
include('../../../include/Conexion.php');

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura los datos del formulario
    $id = $_POST['id'];
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $estado = $_POST['estado'];

    // Prepara la consulta de actualización
    $sql = "UPDATE persona 
            LEFT JOIN user_rol ON persona.id_Persona = user_rol.id_Persona 
            SET persona.Cedula = ?, persona.nombres = ?, persona.apellidos = ?, persona.Telefono = ?, persona.correo = ?, persona.Direccion = ?, user_rol.id_estado = ?
            WHERE persona.id_Persona = ?";

    // Prepara y ejecuta la consulta
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssii", $cedula, $nombre, $apellido, $telefono, $correo, $direccion, $estado, $id);
        
        if ($stmt->execute()) {
            echo "<script>alert('Usuario actualizado con exito.'); window.location.href = '../../../Formularios/Admin/Usuarios/Usuariodate.php';</script>";
        } else {
            echo "<script>alert('Error al actualizar usuario.'); window.location.href = '../../../Formularios/Admin/Productos/form_Actua.php';</script>" . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
}

$conn->close();
?>
