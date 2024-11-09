<?php
session_start();

include('../include/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];

    // Modifica la consulta para incluir el estado del usuario
    $stmt = $conn->prepare("SELECT p.correo, ur.Contraseña, r.rol, ur.id_estado 
                            FROM persona p 
                            JOIN user_rol ur ON p.id_Persona = ur.id_Persona 
                            JOIN rol r ON ur.id_Rol = r.id_Rol 
                            WHERE p.correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verificar la contraseña
        if ($clave === $row['Contraseña']) {
            // Verificar el estado del usuario (suponiendo que 1 es 'activo')
            if ($row['id_estado'] == 1) {
                // Inicio de sesión exitoso
                $_SESSION['user_rol'] = $row['rol'];

                if ($row['rol'] === 'Cliente') {
                    header("Location: ../template/Cliente.php"); // Ruta para el panel del cliente
                } elseif ($row['rol'] === 'Vendedor') {
                    header("Location: ../template/Vendedor.php"); // Ruta para el panel del vendedor
                } elseif ($row['rol'] === 'Administrador') {
                    header("Location: ../template/Admin.php"); // Ruta para el panel del administrador
                }

                exit();
            } else {
                // Usuario inactivo
                $_SESSION['mensaje_error'] = "Tu cuenta está inactiva o de baja. No puedes acceder.";
                header("Location: ../template/login.php"); // Redirige de nuevo a la página de inicio de sesión
                exit();
            }
        } else {
            // Contraseña incorrecta
            $_SESSION['mensaje_error'] = "Credenciales incorrectas";
            header("Location: ../template/login.php"); // Redirige de nuevo a la página de inicio de sesión
            exit();
        }
    } else {
        // Usuario no encontrado
        $_SESSION['mensaje_error'] = "Usuario no encontrado";
        header("Location: ../template/login.php"); // Redirige de nuevo a la página de inicio de sesión
        exit();
    }
}

$conn->close();
?>
