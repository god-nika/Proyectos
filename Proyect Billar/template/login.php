<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/loginn.css?<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
<div class="centrar">
    <div class="wrapper">
        <form action="../config/procesar_login.php" method="POST">
            <p class="form-login">Iniciar Sesión</p>
            <?php if (isset($_SESSION['mensaje_error'])): ?>
                <div class="mensaje-error"><?php echo $_SESSION['mensaje_error']; ?></div>
            <?php unset($_SESSION['mensaje_error']); endif; ?>
            
            <div class="input-box">
                <input type="email" id="correo" name="correo" placeholder="Correo Electrónico" required><br>
            </div>
            
            <div class="input-box">
                <input type="password" id="clave" name="clave" placeholder="Password"  required><br>
            </div>
            
            <div class="centrar_boton">
                <button class="btn">Iniciar Sesión</button>
                
            </div>


                 <br>
            <div class="centrar_boton">
            <a href="../Formularios/Cliente/RegisCliente.php" class="btn">Registrarse</a>
            </div>

            <h5>Ya tiene una cuenta?</h5>

        </form>
    </div>
</div>

</body>
</html>