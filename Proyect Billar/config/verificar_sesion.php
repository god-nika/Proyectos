<?php
session_start();

// Verificar si el usuario no ha iniciado sesión
if (!isset($_SESSION['correo'])) {
    header("Location: ../template/login.php"); // Redirigir al usuario al inicio de sesión
    exit;
}
?>