<?php

session_start();
require "./controls/validations.php";


if (isset($_POST['email'])) {

    $checkSubmit = true;

    // Walidacja imienia
    $name = $_POST['name'];



    if ((strlen($name) < 3) || (strlen($name) > 14)) {
        $checkSubmit = false;
        $_SESSION['errName'] = "Imie musi mieć od 3 do 14 znaków";
    }

    $nameValidate =  '/^[A-ZĄĆĘŁŃÓŚŹŻ][a-ząćęłńóśźż]*$/u';

    if (!preg_match($nameValidate, $name)) {
        $checkSubmit = false;
        $_SESSION['errName'] = "Błąd! Imie musi zaczynać się wielką literą. Bez cyfr i znaków specjalnych (np. Jan)";
    }

    //Walidacja nicku
    $nick = $_POST['nick'];
    $nickValidate = '/^[a-z][a-z0-9._]*$/u';

    if (!preg_match($nickValidate, $nick)) {
        $checkSubmit = false;
        $_SESSION['errNick'] = 'Nick musi składać się z małych liter i może zafierać cyfry (bez polskich znaków).';
    }

    if ((strlen($nick) < 3) || strlen($nick) > 20) {
        $checkSubmit = false;
        $_SESSION['errNick'] = 'Nick musi mieć od 3 do 20 znaków';
    }



    //Walidacja e-mail
    $email = $_POST['email'];
    $filteredEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

    if ((!filter_var($filteredEmail, FILTER_VALIDATE_EMAIL) || $filteredEmail != $email)) {
        $checkSubmit = false;
        $_SESSION['errEmail'] = "Podaj poprawny adres email!";
    }

    //Walidacja hasła

    $pass1 = $_POST['password'];
    $pass2 = $_POST['password2'];

    if ((strlen($pass1) < 8) || (strlen($pass1) > 30)) {
        $checkSubmit = false;
        $_SESSION["errPass"] = "Hasło musi mieć od 8 do 30  znaków";
    }

    if ($pass1 != $pass2) {
        $checkSubmit = false;
        $_SESSION["errPass2"] = "Hasła nie są takie same!";
    }

    $passHash = password_hash($pass1, PASSWORD_DEFAULT);

    //Akceptacja regulaminu

    // if (!isset($_POST['regulamin'])) {
    //        $checkSubmit = false;
    //      $_SESSION["errRegulamin"] ="musisz zaakceptować regulamin";
    // }



    if (password_verify($pass1, $passHash))


        if ($checkSubmit == true) {
            require_once './dataBase/dbConn.php';

            $stmt = $dbConfig->prepare("INSERT INTO users (name, nick, email, password) VALUES (:name, :nick,
            :email, :password )");
            $stmt->execute([
                'name' => $name,
                'nick' => $nick,
                'email' => $email,
                'password' => $passHash
            ]);
            header('location:login.php');
            echo "walidacja udana. Możesz się zalogować";
        }
}


?>






<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizBook - Rejestracja</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofadi+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/login.css">
    <meta name="description" content="Strona logowania do QuizBook - zaloguj się, aby rozpocząć quiz.">
    <style>
        .error {
            color: red;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <h1 class="title">Zarejestruj się</h1>

    <form method="post">
        <div class="form-container">
            <div class="form">
                <label for="name">Imię:</label></br>
                <input type="text" name="name" id="name" placeholder="Podaj swoje imię"></br>

                <?php
                if (isset($_SESSION['errName'])) {
                    echo '<div class="error">' . $_SESSION['errName'] . '</div>';
                    unset($_SESSION['errName']);
                }
                ?>

                <label for="nick">Nick:</label></br>
                <input type="text" name="nick" id="nick" placeholder="Wpisz swój nick"></br>

                <?php
                if (isset($_SESSION['errNick'])) {
                    echo '<div class="error">' . $_SESSION['errNick'] . '</div>';
                    unset($_SESSION['errNick']);
                }
                ?>

                <label for="email">Email:</label></br>
                <input type="email" name="email" id="password" placeholder="Wpisz swój email"></br>

                <?php
                if (isset($_SESSION['errEmail'])) {
                    echo '<div class="error">' . $_SESSION['errEmail'] . '</div>';
                    unset($_SESSION['errEmail']);
                }
                ?>

                <label for="password1">Hasło:</label></br>
                <input type="password" name="password" id="password" placeholder="Wpisz swoje hasło"></br>

                <?php
                if (isset($_SESSION['errPass'])) {
                    echo '<div class="error">' . $_SESSION['errPass'] . '</div>';
                    unset($_SESSION['errPass']);
                }
                ?>

                <label for="password">Powtórz hasło:</label></br>
                <input type="password" name="password2" id="password" placeholder="Powtórz swoje hasło"></br>

                <?php
                if (isset($_SESSION['errPass2'])) {
                    echo '<div class="error">' . $_SESSION['errPass2'] . '</div>';
                    unset($_SESSION['errPass2']);
                }
                ?>

                <input type="submit" value="Zarejestruj">

            </div>
            <p class="register"></p>
        </div>
    </form>

    <footer>
        Created: D Lewandowski | Kontakt: d.lewandowski94@onet.pl | Wszelkie prawa zastrzeżone &copy; 2024
    </footer>
</body>

</html>