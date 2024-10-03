<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizBook</title>
    <meta name="description" content="Witaj naszym Quzie! Cieszymy się, że do nas trafiłeś i zapraszamy Cię do wzięcia udziału w wyjątkowej zabawie, podczas której sprawdzisz swoją wiedzę na różnorodne tematy.">
    <link rel="stylesheet" href="./styles/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofadi+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/game.css">
</head>

<body>

    <header>
        <div class="header-container">
            <h6 class="title">Witaj w naszym Quizie! Postaraj się odpowiedzieć na jak największą liczbę pytań, aby uzyskać jak najlepszy wynik i stanąć na czołowej pozycji w naszym rankingu. Powodzenia!</h6>
            <div class="logout-container">
                <a href="./logout.php" class="logout">Wyloguj się</a>
            </div>
        </div>
    </header>

    <main>
        <?php
        require_once "./dataBase/dbConn.php";

        $id = rand(1, 25);

        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            $db = $dbConfig->prepare("SELECT * FROM pytania WHERE id = :id ");
        }
        $db->execute(['id' => $id]);

        $querry = $db->fetch(PDO::FETCH_ASSOC);

        if ($querry) {

            $correctAnswer = $querry['poprawna'];
            echo '<span class="category">Kategoria: ' . htmlspecialchars($querry["kategoria"]) . "</span>";
            echo '<div class="querry-container"> <span id="querry">' . htmlspecialchars($querry["pytanie"]) . "</span> </div>";
            echo '<div class="answers">' .
                '<button class="answer" onclick="checkAnswer(\'A\', \'' . $correctAnswer . '\')">' . htmlspecialchars($querry["odpowiedz_a"]) . '</button>' .
                '<button class="answer" onclick="checkAnswer(\'B\', \'' . $correctAnswer . '\')">' . htmlspecialchars($querry["odpowiedz_b"]) . '</button>' .
                '<button class="answer" onclick="checkAnswer(\'C\', \'' . $correctAnswer . '\')">' . htmlspecialchars($querry["odpowiedz_c"]) . '</button>' .
                '<button class="answer" onclick="checkAnswer(\'D\', \'' . $correctAnswer . '\')">' . htmlspecialchars($querry["odpowiedz_d"]) . '</button>' .
                '</div>';
        } else {
            echo "Nie znaleziono pytania :(";
        };
        ?>
    </main>

    <footer>
        Created: D Lewandowski | Kontakt: d.lewandowski94@onet.pl | Wszelkie prawa zastrzeżone &copy; 2024
    </footer>

</body>
<script src="./controls/gameControl.js"></script>

</html>