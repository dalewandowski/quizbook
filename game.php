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
        <div id="question" class='question'></div>
        <div class="answer-container">
            <div class="answer answerA"></div>
            <div class="answer answerB"></div>
            <div class="answer answerC"></div>
            <div class="answer answerD"></div>
        </div>
        <script>
            function randomQuestion() {
                fetch('./controls/randomQuestion.php', {
                        method: 'GET'
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Błąd sieciowy: " + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log(data);
                        if (data.error) {

                            document.getElementById('question').innerHTML = data.error;
                        } else {

                            document.getElementById('question').innerHTML = data.question;
                            document.querySelector('.answerA').innerHTML = data.odpA;
                            document.querySelector('.answerB').innerHTML = data.odpB;
                            document.querySelector('.answerC').innerHTML = data.odpC;
                            document.querySelector('.answerD').innerHTML = data.odpD;
                        }
                    })
                    .catch(error => {
                        console.error("Błąd: " + error);
                        document.getElementById('question').innerHTML = "Wystąpił błąd przy pobieraniu pytania.";
                    });
            }
            randomQuestion();
        </script>
    </main>

    <footer>
        Created: D Lewandowski | Kontakt: d.lewandowski94@onet.pl | Wszelkie prawa zastrzeżone &copy; 2024
    </footer>

</body>
<script src="./controls/gameControl.js"></script>

</html>