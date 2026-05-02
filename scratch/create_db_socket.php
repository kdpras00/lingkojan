<?php
$socket = '/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:unix_socket=$socket", $user, $pass);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS lingkojan");
    echo "Database 'lingkojan' created or already exists.\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
