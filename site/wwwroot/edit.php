<?php
// edit.php
require_once 'includes/db.php';

$user = null;
$message = '';
$error = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$id]);
    $user = $stmt->fetch();

    if (!$user) {
        header('Location: index.php?msg=Usuario no encontrado para editar.');
        exit();
    }
} else {
    header('Location: index.php?msg=ID de usuario no proporcionado.');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    if (empty($name) || empty($email)) {
        $error = 'El nombre y el email son campos obligatorios.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'El formato del email no es válido.';
    } else {
        try {
            $stmt = $pdo->prepare('UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?');
            $stmt->execute([$name, $email, $phone, $id]);
            header('Location: index.php?msg=Usuario actualizado exitosamente.');
            exit();
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Código de error para entrada duplicada
                $error = 'El email ya está registrado para otro usuario.';
            } else {
                $error = 'Error al actualizar el usuario: ' . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h1>Editar Usuario</h1>
        <p><a href="index.php" class="btn btn-primary">Volver a la lista</a></p>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form action="edit.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($user['name']); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($user['email']); ?>">
            </div>
            <div class="form-group">
                <label for="phone">Teléfono:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
            </div>
            <button type="submit" class="btn btn-warning">Actualizar Usuario</button>
        </form>
    </div>
</body>

</html>