<?php

// password_verify($password,
session_start();
ob_start(); // Rozpocznij buforowanie wyjścia
require_once "./dataBase/dbConn.php";



// Sprawdzanie, czy użytkownik jest już zalogowany
if (isset($_SESSION['nick'])) {
    header("Location: game.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Pobranie danych z formularza
    $nick = $_POST["nick"];
    $password = $_POST['password'];

    // Przygotowanie zapytania do bazy danych
    $stmt = $dbConfig->prepare("SELECT * FROM users WHERE nick = :nick");
    $stmt->execute(['nick' => $nick]);

    // Pobranie użytkownika z bazy
    $user = $stmt->fetch(PDO::FETCH_ASSOC);



    // Sprawdzanie, czy użytkownik istnieje i hasło jest poprawne
    if ($user &&  password_verify($password, $user['password'])) {
        // Ustawianie sesji dla zalogowanego użytkownika
        $_SESSION['nick'] = $user['nick'];


        // Przekierowanie na stronę gry
        header('Location: game.php');
        exit;
    } else {
        // Błędne dane logowania
        $_SESSION['e.login'] = '<p style="color: red; font-size: 0.5rem;">Niepoprawny nick lub hasło</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizBook - Logowanie</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofadi+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/login.css">
    <meta name="description" content="Strona logowania do QuizBook - zaloguj się, aby rozpocząć quiz.">
</head>

<body>
    <h1 class="title">Zaloguj się, aby rozpocząć quiz!</h1>

    <form action="" method="post">
        <div class="form-container">
            <div class="form">
                <label for="nick">Nick:</label></br>
                <input type="text" name="nick" id="nick" placeholder="Wpisz swój nick" required></br>

                <label for="password">Hasło:</label></br>
                <input type="password" name="password" id="password" placeholder="Wpisz swoje hasło" required></br>

                <input type="submit" value="Zaloguj się">
                <?php
                if (isset($_SESSION['e.login'])) {
                    echo $_SESSION['e.login'];
                    unset($_SESSION['e.login']); // Usuwamy komunikat po wyświetleniu
                }
                ?>
            </div>
            <p class="register">Nie masz jeszcze konta? <a href="register.php">Zarejestruj się tutaj!</a></p>
        </div>
    </form>

    <footer>
        Created: D Lewandowski | Kontakt: d.lewandowski94@onet.pl | Wszelkie prawa zastrzeżone &copy; 2024
    </footer>
</body>

</html>