<?php
// add.php
require_once 'includes/db.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    if (empty($name) || empty($email)) {
        $error = 'El nombre y el email son campos obligatorios.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'El formato del email no es válido.';
    } else {
        try {
            $stmt = $pdo->prepare('INSERT INTO users (name, email, phone) VALUES (?, ?, ?)');
            $stmt->execute([$name, $email, $phone]);
            header('Location: index.php?msg=Usuario agregado exitosamente.');
            exit();
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Código de error para entrada duplicada
                $error = 'El email ya está registrado.';
            } else {
                $error = 'Error al agregar el usuario: ' . $e->getMessage();
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
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h1>Agregar Nuevo Usuario</h1>
        <p><a href="index.php" class="btn btn-primary">Volver a la lista</a></p>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form action="add.php" method="POST">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="phone">Teléfono:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
            </div>
            <button type="submit" class="btn btn-success">Guardar Usuario</button>
        </form>
    </div>
</body>

</html>