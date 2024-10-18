<?PHP

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $inputData = file_get_contents('php://input');
    $data = json_decode($inputData, true);

    $userChoice = $data['userChoice'];
    $correctAnswer = $data['correct'];

    header("Content-Type: application/json");

    if ($userChoice === $correctAnswer) {
        echo json_encode(['correct' => true]);
    } else {
        echo json_encode(['correct' => false]);
    };
};
