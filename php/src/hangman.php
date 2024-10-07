<?php
session_start();
include("./functions_hangman.php");
define('SOLUTION', 'palabra');
if (!isset($_SESSION['answer'])) {
    $_SESSION['answer'] = generateEmptyAnswer(SOLUTION, []);
    $_SESSION['incorrect_letters'] = [];
    $_SESSION['correct_letters'] = [];
}

$answer = $_SESSION['answer'];
$incorrectLetters = $_SESSION['incorrect_letters'];
$correctLetters = $_SESSION['correct_letters']; 
?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HangMan</title>
    <style>
        span {
            margin-right: 10px;
        }

        .correct {
            color: green;
        }

        .incorrect {
            color: red;
        }
    </style>
</head>

<body>
    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $letter = $_POST['char'];
        $isValid = checkLetter(SOLUTION, $letter, $answer);
        printAnswer($answer);

        if (!$isValid) {
            if (!in_array($letter, $incorrectLetters) && !in_array(strtolower($letter), $incorrectLetters)) {
                $incorrectLetters[] = strtolower($letter);
            }
            echo "<p class=\"incorrect\">La $letter no es valida</p>";
        }else {
            if (!in_array($letter, $correctLetters) && !in_array(strtolower($letter), $correctLetters)) {
                $correctLetters[] = strtolower($letter);
            }
            echo "<p class=\"correct\">La $letter  es valida</p>";
        }

        $_SESSION['answer'] = $answer;
        $_SESSION['incorrect_letters'] = $incorrectLetters;
        $_SESSION['correct_letters'] = $correctLetters;

        printAnswer($answer);

        if (!in_array('_', $answer)) {
            echo "<h1 class=\"correct\">¡Felicidades! Has ganado.</h1>";
            session_destroy(); 
        }

    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if(isset($_GET["action"]) && $_GET["action"] === "restart") {
            session_destroy();
            $answer = generateEmptyAnswer(SOLUTION, $answer);
            $incorrectLetters = [];
            $correctLetters = [];
        }
        
        printAnswer($answer);
    }
    ?>
    <form method="post">
        <input type="text" name="char" id="char" maxlength="1">
        <input type="submit" value="Enviar">
    </form>
    <?php 
    if (!empty($incorrectLetters)){
        echo "<p class=\"incorrect\">";
        foreach ($incorrectLetters as $letter) {
            echo "<span>$letter</span>";
        }
        echo "</p>";
    }

    if (!empty($correctLetters)){
        echo "<p class=\"correct\">";
        foreach ($correctLetters as $letter) {
            echo "<span>$letter</span>";
        }
        echo "</p>";
    }
    ?>

    <p><a href="?action=restart">Reiniciar partida</a></p>

    

</body>

</html>