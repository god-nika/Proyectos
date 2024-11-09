<?php
session_start();

include ('../include/conexion.php');

// Verificar si hay una sesión iniciada
if (isset ($_SESSION['user_rol'])) {
    // Si el usuario no es un administrador, redirigirlo a una página de acceso denegado o a una página adecuada para los empleados
    if ($_SESSION['user_rol'] !== 'Administrador') {
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

    <link rel="stylesheet" href="../css/Admin.css?<?php echo time(); ?>">
    <title>Administrador</title>
</head>
<body>
    





<header>
    <div class="container">
        <h1>Panel de Administrador</h1>
        <nav>
            <ul>
                <!-- Menú desplegable para Productos -->
            <li class="dropdown">
                    <a href="#" class="dropbtn">Inicio</a>
                    <div class="dropdown-content">
                        <a href="#">Perfil</a>
                        <a href="login.php">Cerrar sesion</a>
                    </div>
                </li>
                
                
                <li class="dropdown">
                    <a href="#" class="dropbtn">Gestionar de Productos</a>
                    <div class="dropdown-content">
                        <a href="../Formularios/Admin/Productos/form.php">Registrar Productos</a>
                        <a href="../Formularios/Admin/Productos/form_Actua.php">Actualizar Productos</a>
                        <a href="../Formularios/Admin/Productos/ActuaStock.php">Stock</a>
                    </div>
                </li>
                

                <li class="dropdown">
                    <a href="#" class="dropbtn">Gestion Servicios</a>
                    <div class="dropdown-content">
                        <a href="../Formularios/Admin/Equipo/Regis_Equipo.php">Registrar Equipo</a>
                        
                    </div>
                </li>


                <li class="dropdown">
                    <a href="#" class="dropbtn">Gestion Cuentas</a>
                    <div class="dropdown-content">
                        <a href="#">Registrar Cuentas</a>
                        
                    </div>
                </li>

                
                
                <li class="dropdown">
                    <a href="#" class="dropbtn">Gestion Usuarios</a>
                    <div class="dropdown-content">
                        <a href="../Formularios/Admin/Usuarios/RegisVendedor.php">Registro de Vendedores</a>
                        <a href="../Formularios/Admin/Usuarios/Usuariodate.php">Usuarios</a>
                        
                    </div>
                </li>
                



                <li class="dropdown">
                    <a href="#" class="dropbtn">Gestion de Reportes</a>
                    <div class="dropdown-content">
                        <a href="#">Registrar reportes</a>
                        
                    </div>
                </li>
                


                <li class="dropdown">
                    <a href="#" class="dropbtn">Cierre de caja</a>
                    <div class="dropdown-content">
                        <a href="#">Cerrar Caja</a>
                        
                    </div>
                </li>


                <li class="dropdown">
                    <a href="#" class="dropbtn">Gestion de Gastos</a>
                    <div class="dropdown-content">
                        <a href="#">Registrar Gastos</a>
                        
                    </div>
                </li>
                
               
                
                
                
            </ul>
        </nav>
    </div>
</header>

</body>
</html>