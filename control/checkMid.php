<?php
session_start();

$posteAutorises = [1, 2, 3, 5];

if (!isset($_SESSION['poste']) || !in_array($_SESSION['poste'], $posteAutorises)) {
	header('Location: tdb.php');
	exit;
}