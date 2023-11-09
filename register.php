<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password']; // Deberías hashear esta contraseña antes de guardarla
    $name = $_POST['name'];

    // Leer los usuarios existentes
    $users = json_decode(file_get_contents('ruta_al_archivo_json/users.json'), true);

    // Verificar si el email ya existe
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            $error = 'El email ya está registrado.';
            break;
        }
    }

    if (!isset($error)) {
        // Agregar el nuevo usuario
        $users[] = [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT), // Hashear la contraseña
            'nombre' => $name
        ];

        // Guardar el archivo
        file_put_contents('ruta_al_archivo_json/users.json', json_encode($users));

        // Redireccionar al usuario a la página de inicio de sesión
        header('Location: account.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Cuenta</title>
</head>
<body>
    <h1>Crear Cuenta</h1>
    <?php if (!empty($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="register.php" method="post">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Crear Cuenta</button>
    </form>
</body>
</html>
