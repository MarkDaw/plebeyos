<?php
session_start();
if(!isset($_SESSION['user']) && !isset($_COOKIE['user-remember'])){
    header('Location: ../login.php?action=login-failed');
}
include("./functions_hangman.php");
define('SOLUTION', 'palabra');
if (!isset($_SESSION['answer'])) {
    $_SESSION['answer'] = generateEmptyAnswer(SOLUTION, []);
    $_SESSION['incorrect_letters'] = [];
    $_SESSION['correct_letters'] = [];
    $_SESSION['tries'] = 6;
}

$answer = $_SESSION['answer'];
$incorrectLetters = $_SESSION['incorrect_letters'];
$correctLetters = $_SESSION['correct_letters'];
$tries = $_SESSION['tries'];

$userLogged = (isset($_COOKIE['user-remember']))? "<h1>Sesión del usuario " . $_COOKIE['user-remember'] . " mediante cookie</h1>":"<h1>Sesión del usuario " . $_SESSION['user'] . "</h1>";
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
            $tries -= 1;    
            echo "<p class=\"incorrect\">La $letter no es valida</p>";
        }else {
            if (!in_array($letter, $correctLetters) && !in_array(strtolower($letter), $correctLetters)) {
                $correctLetters[] = strtolower($letter);
            }
            echo "<p class=\"correct\">La $letter  es valida</p>";
        }

        

        printAnswer($answer);


        



    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

        echo $userLogged;
        

        if(isset($_GET["action"]) && $_GET["action"] === "restart") {
            $answer = generateEmptyAnswer(SOLUTION, $answer);
            $incorrectLetters = [];
            $correctLetters = [];
            $tries = 6;
        }
        
        printAnswer($answer);
    }
    if (!checkEndGame($answer, $tries)) {
        ?>
        <form method="post">
            <input type="text" name="char" id="char" maxlength="1" autofocus>
            <input type="submit" value="Enviar">
        </form>
        <?php 
    }
    
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
    
    echo "<p>Te quedan $tries intentos</p>";

    if (checkEndGame($answer, $tries)) {
        $endMsg = ($tries === 0)? "<h1 class=\"incorrect\">Has perdido.</h1>": "<h1 class=\"correct\">Has ganado.</h1>";
        echo $endMsg;
        $answer = generateEmptyAnswer(SOLUTION, $answer);
        $incorrectLetters = [];
        $correctLetters = [];
        $tries = 6;
    }

    $_SESSION['answer'] = $answer;
    $_SESSION['incorrect_letters'] = $incorrectLetters;
    $_SESSION['correct_letters'] = $correctLetters;
    $_SESSION['tries'] = $tries;
    ?>

    <p><a href="?action=restart">Reiniciar partida</a></p>
    <p><a href="../login.php?action=login-closed">Cerrar sesión</a></p>

    

</body>

</html>