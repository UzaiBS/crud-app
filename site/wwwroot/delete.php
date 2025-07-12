<?php
// delete.php
require_once 'includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
        $stmt->execute([$id]);
        header('Location: index.php?msg=Usuario eliminado exitosamente.');
        exit();
    } catch (PDOException $e) {
        header('Location: index.php?msg=Error al eliminar el usuario: ' . urlencode($e->getMessage()));
        exit();
    }
} else {
    header('Location: index.php?msg=ID de usuario no proporcionado para eliminar.');
    exit();
}
