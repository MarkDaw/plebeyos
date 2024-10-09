<?php 
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['user'])) {
        $_SESSION['user'] = $_POST['user'];

        if (isset($_POST['user-remember']) && $_POST['user-remember'] == '1') {
            setcookie('user-remember', $_SESSION['user'], time() + (30 * 24 * 60 * 60), "/", "",false,false);
        } else {
            unset($_COOKIE['user-remember']);
            setcookie('user-remember', '', time() - 3600, "/");
        }

    }

    
    
    if (isset($_POST['game'])) {
        $allowedGames = ['hangman', '4inarow'];
        $game = $_POST['game'];
        if (in_array($game, $allowedGames)) {
            header('Location: /' . $game . '/' . $game .'.php');
            exit();
        } else {
            echo "<h1>Juego no válido</h1>";
        }
    }
    
}

$isCookieRemoved = false;

if (isset($_GET['action']) && $_GET['action'] === 'login-closed' && isset($_COOKIE['user-remember'])){
    setcookie('user-remember', '', time() - 3600, "/");
    $isCookieRemoved = true;
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

            if (isset($_GET['action']) && $_GET['action'] === 'login-closed' && isset($_COOKIE['user-remember'])) {
                echo "<h1>Adiós " . $_COOKIE['user-remember'] ."</h1>";
                echo "<p>Se eliminan las cookies y las sesiones</p>";
                session_destroy();
            }elseif($isCookieRemoved){
                echo "<h1>Adiós " . $_SESSION['user'] ."</h1>";
                echo "<p>Se eliminan las sesiones</p>";
                session_destroy();
            }


            if(isset($_COOKIE['user-remember'])) echo "<h1>Bienvenido de nuevo " . $_COOKIE['user-remember'] . "</h1>";
    ?>
            <form action="" method="post">
                <label for="user">Usuario</label>
                <input type="text" name="user" id="user" required><br>
                <label>
                    <input type="checkbox" name="user-remember" value="1" <?php echo isset($_COOKIE['user-remember']) ? 'checked' : ''; ?>> Recordar Usuario
                </label><br>
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
