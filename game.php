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
        <div class="result-container">
            <div class="text">PUNKTY: </div>
            <div class="result"></div>
        </div>
        <script>
            let correctAnswer = '';
            let pts = 0; // Punkty
            let isAnswerChecked = false; // Flaga do sprawdzania odpowiedzi
            let answerCount = 0;

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
                        if (data.error) {
                            document.getElementById('question').innerHTML = data.error;
                        } else {

                            document.getElementById('question').innerHTML = data.question;
                            document.querySelector('.answerA').innerHTML = "A)" + data.odpA;
                            document.querySelector('.answerB').innerHTML = "B)" + data.odpB;
                            document.querySelector('.answerC').innerHTML = "C)" + data.odpC;
                            document.querySelector('.answerD').innerHTML = "D)" + data.odpD;
                            correctAnswer = data.correct;
                            isAnswerChecked = false; // Reset flag

                            // Dodaj nasłuchiwacze zdarzeń tylko raz
                            document.querySelectorAll('.answer').forEach(e => {
                                e.removeEventListener("click", checkAnswer);
                                e.addEventListener("click", function() {
                                    checkAnswer(this.innerHTML.charAt(0));
                                });
                            });

                        }
                    })
                    .catch(error => {
                        console.error("Błąd: " + error);
                        document.getElementById('question').innerHTML = "Wystąpił błąd przy pobieraniu pytania.";
                    });
            }

            function checkAnswer(userChoice) {
                if (isAnswerChecked) return; // Zablokuj ponowne kliknięcia

                isAnswerChecked = true; // Ustaw flagę
                fetch('./controls/checkAnswer.php', {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            'correct': correctAnswer,
                            'userChoice': userChoice
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.correct) {
                            pts++; // Zwiększ punkty
                            document.querySelector('.result').innerHTML = pts; // Zaktualizuj wynik
                        }
                        randomQuestion(); // Pobierz nowe pytanie
                    })
                    .catch(error => {
                        console.error("BŁĄD! ", error);
                    });
            }
            if (answerCount < 10) {
                randomQuestion();
            }
        </script>
    </main>

    <footer>
        Created: D Lewandowski | Kontakt: d.lewandowski94@onet.pl | Wszelkie prawa zastrzeżone &copy; 2024
    </footer>

</body>


</html>