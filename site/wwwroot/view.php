<?php
// view.php
require_once 'includes/db.php';

$user = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$id]);
    $user = $stmt->fetch();
}

if (!$user) {
    header('Location: index.php?msg=Usuario no encontrado.');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Usuario</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h1>Detalles del Usuario</h1>
        <p><a href="index.php" class="btn btn-primary">Volver a la lista</a></p>

        <p><strong>ID:</strong> <?php echo htmlspecialchars($user['id']); ?></p>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>

        <p>
            <a href="edit.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-warning">Editar Usuario</a>
            <a href="delete.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-danger delete-btn" data-user-name="<?php echo htmlspecialchars($user['name']); ?>">Eliminar Usuario</a>
        </p>
    </div>
    <script src="js/script.js"></script>
</body>

</html>