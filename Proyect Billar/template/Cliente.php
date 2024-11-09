<?php
session_start();

include ('../include/conexion.php');

// Verificar si hay una sesión iniciada
if (isset ($_SESSION['user_rol'])) {
    // Si el usuario no es un administrador, redirigirlo a una página de acceso denegado o a una página adecuada para los empleados
    if ($_SESSION['user_rol'] !== 'Cliente') {
        header("Location: ../template/login.php"); // Ruta para la página de acceso denegado
        exit();
    }
} else {
    // Si no hay una sesión iniciada, redirigir al usuario al formulario de inicio de sesión
    header("Location: ../template/login.php"); // Ruta para el formulario de inicio de sesión
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tienda.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/Admin.css?<?php echo time(); ?>">
    <title>Cliente</title>
</head>
<body>
    
<header>

<header>
    <div class="container">
        <h1>Tu Tienda en Línea</h1>
        <nav>
            <ul>


            <li class="dropdown">
                    <a href="#" class="dropbtn">Inicio</a>
                    <div class="dropdown-content">
                        <a href="#">Perfil</a>
                        <a href="#">Historial de Compras</a>
                        <a href="login.php">Cerrar sesion</a>
                    </div>
                </li>



                <li class="dropdown">
                    <a href="#" class="dropbtn">Productos</a>
                    <div class="dropdown-content">
                        <a href="#">Ver Productos</a>
                        
                    </div>
                </li>


                <li class="dropdown">
                    <a href="#" class="dropbtn">Reservaciones</a>
                    <div class="dropdown-content">
                        <a href="#">Realizar una reservacion</a>
                        
                    </div>
                </li>
                



                
                <li><a href="#">Carrito de Compras</a></li>




                
            </ul>
        </nav>
    </div>
</header>

    

    
    



</body>
</html>