<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_user = [
        "email" => $_POST['email'],
        "password" => password_hash($_POST['password'], PASSWORD_DEFAULT),
        "nombre" => $_POST['nombre']
    ];

    // Leer los usuarios existentes desde el archivo JSON
    $users = json_decode(file_get_contents('ruta_al_archivo_json/users.json'), true);

    // Verificar si el correo electrónico ya está en uso
    foreach ($users as $user) {
        if ($user['email'] === $new_user['email']) {
            $registration_error = 'El correo electrónico ya está en uso.';
            break;
        }
    }

    // Si el correo electrónico no está en uso, agregar el nuevo usuario
    if (!isset($registration_error)) {
        $users[] = $new_user;
        file_put_contents('ruta_al_archivo_json/users.json', json_encode($users));

        // Redireccionar al usuario a la página de inicio de sesión
        header('Location: login.php');
        exit;
    }
}
?>
<!-- HTML para el formulario de registro -->
<form method="post">
    Nombre: <input type="text" name="nombre" required><br>
    Email: <input type="email" name="email" required><br>
    Contraseña: <input type="password" name="password" required><br>
    Confirmar Contraseña: <input type="password" name="confirm_password" required><br>
    <input type="submit" value="Registrarse">
</form>
