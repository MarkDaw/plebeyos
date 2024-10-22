<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Helpers/functions.php';
use Joc4enRatlla\Controllers\JocController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gameController = new JocController($_POST); 
} else {
    loadView('jugador');
}
