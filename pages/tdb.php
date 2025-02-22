<?php
session_start();

// Récupération de la variable service
if (!isset($_SESSION['service'])) {
    if (isset($_GET['work'])) {
        $_SESSION['service'] = $_GET['work'];
    } else {
        header('Location: ../index.php');
    }
}

require_once "design.php";

$titre = "Tableau de bord";
$page = "../public/php/bord.php";

monModel($titre, $page);