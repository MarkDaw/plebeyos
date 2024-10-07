<?php 
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['user'])) {
        $_SESSION['user'] = $_POST['user'];
    }
    
    if (isset($_POST['game'])) {
        $allowedGames = ['hangman', '4inarow'];
        $game = $_POST['game'];
        if (in_array($game, $allowedGames)) {
            header('Location: ' . $game . '.php');
            exit();
        } else {
            echo "<h1>Juego no válido</h1>";
        }
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['action']) && $_GET['action'] === 'login-failed') {
                echo "<h1>Debes autenticarte primero</h1>";
            }
    ?>
            <form action="" method="post">
                <label for="user">Usuario</label>
                <input type="text" name="user" id="user" required>
                <input type="submit" value="Enviar">
            </form>
    <?php 
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['user'])) {
            echo "<h1>Bienvenido " . htmlspecialchars($_SESSION['user']) . "</h1>";
    ?>
            <form action="" method="post">
                <fieldset>
                    <legend>Selecciona un juego</legend>
                    <label for="hangman">
                        <input type="radio" name="game" id="hangman" value="hangman"> Ahorcado
                    </label>
                    <label for="4inarow">
                        <input type="radio" name="game" id="4inarow" value="4inarow"> 4 en ratlla
                    </label>
                    <input type="submit" value="Enviar">
                </fieldset>
            </form>
    <?php 
        }
    ?>
</body>
</html>
