<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Leer los usuarios existentes desde el archivo JSON
    $users = json_decode(file_get_contents('ruta_al_archivo_json/users.json'), true);

    // Verificar las credenciales del usuario
    foreach ($users as $user) {
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            // Iniciar sesión (puedes utilizar $_SESSION para almacenar información del usuario)
            session_start();
            $_SESSION['user_email'] = $user['email'];

            // Redireccionar al usuario a la página principal
            header('Location: index.html');
            exit;
        }
    }

    // Si las credenciales son inválidas, mostrar un mensaje de error
    $login_error = 'Email o contraseña incorrecta.';
}
?>
<!-- HTML para el formulario de inicio de sesión -->
<form method="post">
    Email: <input type="email" name="email" required><br>
    Contraseña: <input type="password" name="password" required><br>
    <input type="submit" value="Iniciar sesión">
</form>
