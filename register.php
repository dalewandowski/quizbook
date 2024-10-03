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
</head>

<body>
    <h1 class="title">Zarejestruj się</h1>

    <form action="" method="post">
        <div class="form-container">
            <div class="form">
                <label for="name">Imię:</label></br>
                <input type="text" name="name" id="name" placeholder="Podaj swoje imię" required></br>
                <label for="nick">Nick:</label></br>
                <input type="text" name="nick" id="nick" placeholder="Wpisz swój nick" required></br>
                <label for="email">Email:</label></br>
                <input type="email" name="password" id="password" placeholder="Wpisz swój email" required></br>
                <label for="password1">Hasło:</label></br>
                <input type="password" name="password" id="password" placeholder="Wpisz swoje hasło" required></br>
                <label for="password">Powtórz hasło:</label></br>
                <input type="password" name="password" id="password" placeholder="Powtórz swoje hasło" required></br>




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