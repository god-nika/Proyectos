<?php

// Conexión a la base de datos
include('../include/conexion.php'); // Asegúrate de tener un archivo para la conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar los datos del formulario
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $password = $_POST['password']; // No encriptar la contraseña

    // Validar si el correo ya está registrado
    $sql_check = "SELECT id_Persona FROM persona WHERE correo = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $correo);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // El correo ya está registrado, se debe manejar este caso
        echo "<script>
        alert('El correo ya está registrado.');
        window.location.href = '../Formularios/Cliente/RegisCliente.php'; // Redirigir al formulario
        </script>";
    } else {



    // Iniciar una transacción (opcional, pero recomendado)
    $conn->begin_transaction();

    try {
        // Insertar los datos en la tabla 'persona'
        $sql_persona = "INSERT INTO persona (Cedula, nombres, apellidos, Telefono, correo, Direccion) 
                        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_persona = $conn->prepare($sql_persona);
        $stmt_persona->bind_param("ssssss", $cedula, $nombre, $apellido, $telefono, $correo, $direccion);
        $stmt_persona->execute();
        
        // Obtener el id_Persona del último registro insertado
        $id_Persona = $conn->insert_id;

        // Insertar los datos en la tabla 'user_rol' con el rol de cliente (id_Rol = 1)
        $id_Rol = 1; // Rol de Cliente
        $sql_user_rol = "INSERT INTO user_rol (id_Persona, id_Rol, Contraseña) 
                         VALUES (?, ?, ?)";
        $stmt_user_rol = $conn->prepare($sql_user_rol);
        $stmt_user_rol->bind_param("iis", $id_Persona, $id_Rol, $password);
        $stmt_user_rol->execute();

        // Confirmar la transacción
        $conn->commit();
        echo "<script>
        alert('Usuario guardado con éxito');
        window.location.href = '../template/login.php'; // Redirigir al formulario
        </script>";

    } catch (Exception $e) {
        // En caso de error, revertir la transacción
        $conn->rollback();
        echo "<script>
        alert('Error al guardar el usuario: " . $e->getMessage() . "');
        window.location.href = '../template/login.php'; // Redirigir al formulario
        </script>";
    }

    // Cerrar las consultas preparadas
    $stmt_persona->close();
    $stmt_user_rol->close();
    $conn->close();
}
}
?>
