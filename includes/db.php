<?php
// includes/db.php

//$host = 'localhost'; // O la IP de tu servidor de base de datos
$host = 'appwebcondbs-servidor.mysql.database.azure.com';
//$db = 'crud_db';
$db = 'appwebconbds_db';
$user = 'roots'; // Tu usuario de MySQL
$pass = 'Tempo@1234'; // Tu contraseña de MySQL
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
