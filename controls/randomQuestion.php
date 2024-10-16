<?php

// Włączenie wyświetlania błędów
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Wczytaj plik konfiguracyjny i połączenie z bazą danych
require '../dataBase/dbConn.php';
// Ustaw nagłówek odpowiedzi na JSON
header('Content-Type: application/json; charset=utf-8');

// Przygotowanie zapytania SQL do losowania pytania
$sql = "SELECT pytanie, odpowiedz_a, odpowiedz_b, odpowiedz_c, odpowiedz_d, poprawna FROM pytania ORDER BY RAND() LIMIT 1";
$db = $dbConfig->prepare($sql);

// Wykonanie zapytania
try {
    $db->execute();
    $question = $db->fetch(PDO::FETCH_ASSOC);

    // Sprawdzenie, czy pytanie zostało znalezione
    if (!$question) {
        echo json_encode(['error' => 'Nie znaleziono pytania']);
    } else {
        echo json_encode([
            'question' => $question['pytanie'],
            'odpA' => $question['odpowiedz_a'],
            'odpB' => $question['odpowiedz_b'],
            'odpC' => $question['odpowiedz_c'],
            'odpD' => $question['odpowiedz_d'],
            'correct' => $question['poprawna']
        ]);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Błąd zapytania: ' . $e->getMessage()]);
}
