<?php
$host     = 'localhost';
$dbname   = 'mi_base';
$username = 'root';
$password = 'secreto';
$charset  = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

try {
    $pdo = new PDO($dsn, $username, $password, [
        // Para que PDO lance excepciones cuando hay errores
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        // Para que las consultas por defecto te devuelvan arrays asociativos
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} 
catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}