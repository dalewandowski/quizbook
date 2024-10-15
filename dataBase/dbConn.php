<?php
// dbConn.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$config = require_once "dbConfig.php";

try {
    $dbConfig = new PDO(
        "mysql:host={$config['host']};dbname={$config['dbName']};charset=utf8",
        $config['user'],
        $config['password'],
        [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
} catch (PDOException $error) {
    echo json_encode(['error' => "Błąd połączenia: " . $error->getMessage()]);
    exit("Błąd bazy danych");
}
