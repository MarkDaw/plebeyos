<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Helpers/functions.php';
use Joc4enRatlla\Controllers\JocController;

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'exit'){
    unset($_SESSION['user']);
    unset($_SESSION['game']);
    unset($_SESSION['scores']);
}elseif($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'reset'){
    unset($_SESSION['game']);
}
    

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
    $_SESSION['user'] = $_POST['username'];
}

if(!isset($_SESSION['user'])){
    loadView('login');
} elseif (isset($_SESSION['user']) || (isset($_GET['action']) && $_GET['action'] === 'reset')){
    $gameController = new JocController($_POST); 
} else {
    loadView('jugador');
}
