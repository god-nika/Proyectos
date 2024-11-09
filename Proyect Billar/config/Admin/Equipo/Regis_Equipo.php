<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoria = $_POST['categoria'];
    $tarifa = $_POST['tarifa'];

    // Conexión a la base de datos
    include('../../../include/conexion.php');

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    // Insertar el nuevo tipo de juego
    $sql = "INSERT INTO tipo_juego (Categoria, Tarifa_Hora) VALUES ('$categoria', '$tarifa')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Tipo de juego registrado correctamente'); window.location.href = '../../../Formularios/Admin/Equipo/Regis_Equipo.php';</script>";
    } else {
        echo "<script>alert('Error al registrar el tipo de juego: " . $conn->error . "'); window.location.href = '../../../Formularios/Admin/Equipo/Regis_Equipo.php';</script>";
    }
    
    // Cerrar conexión
    $conn->close();
}
?>
