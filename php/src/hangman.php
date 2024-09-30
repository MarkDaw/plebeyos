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
    include("./functions_hangman.php");
    define('SOLUTION', 'palabra');

    $answer = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $answer = generateEmptyAnswer(SOLUTION, $answer);

        $letter = $_POST['char'];
        $isValid = checkLetter(SOLUTION, $letter, $answer);
        printAnswer($answer);

        if (!$isValid) {
            echo "<p class=\"incorrect\">La $letter no es valida</p>";
        }else {
            echo "<p class=\"correct\">La $letter  es valida</p>";
        }

        printAnswer($answer);

    } else {
        $answer = generateEmptyAnswer(SOLUTION, $answer);
        printAnswer($answer);
    }
    ?>
    <form method="post">
        <input type="text" name="char" id="char" maxlength="1">
        <input type="submit" value="Enviar">
    </form>

</body>

</html>