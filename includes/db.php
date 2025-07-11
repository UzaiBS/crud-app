<?php
// includes/db.php

//$host = 'appwebcondbs-servidor.mysql.database.azure.com';
$host = $_ENV['DB_HOST'];
//$db = 'appwebcondbs_db';
$db = $_ENV['DB_NAME'];
//$user = 'roots'; // Tu usuario de MySQL
$user = $_ENV['DB_USER'];
//$pass = 'Tempo@1234'; // Tu contraseña de MySQL
$pass = $_ENV['DB_PASS'];
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
