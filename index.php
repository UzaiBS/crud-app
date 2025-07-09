<?php
// index.php
require_once 'includes/db.php';

$stmt = $pdo->query('SELECT * FROM users');
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuarios</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h1>Lista de Usuarios</h1>
        <p>
            <a href="add.php" class="btn btn-success">Agregar Nuevo Usuario</a>
        </p>

        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($_GET['msg']); ?>
            </div>
        <?php endif; ?>

        <?php if (count($users) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['phone']); ?></td>
                            <td>
                                <a href="view.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-info">Ver</a>
                                <a href="edit.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-warning">Editar</a>
                                <a href="delete.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-danger delete-btn" data-user-name="<?php echo htmlspecialchars($user['name']); ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay usuarios registrados.</p>
        <?php endif; ?>
    </div>
    <script src="js/script.js"></script>
</body>

</html>