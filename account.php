<?php
// Aquí puedes iniciar la sesión si es necesario
session_start();

// Verificar si el usuario ya está logueado
if (isset($_SESSION['user_email'])) {
    header('Location: index.html'); // Redirigir al usuario a la página principal si ya está logueado
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Cuenta</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <?php if (!empty($login_error)): ?>
        <p><?php echo $login_error; ?></p>
    <?php endif; ?>
    <form action="login.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Iniciar Sesión</button>
    </form>
    <p>O</p>
    <a href="register.php">Crear una cuenta nueva</a>
</body>
</html>
