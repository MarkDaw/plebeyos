<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Helpers/functions.php';
use Joc4enRatlla\Controllers\JocController;

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'logout'){
    unset($_SESSION['user']);
}
    

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
    $_SESSION['user'] = $_POST['username'];
}

if(!isset($_SESSION['user'])){
    loadView('login');
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gameController = new JocController($_POST); 
} else {
    loadView('jugador');
}
