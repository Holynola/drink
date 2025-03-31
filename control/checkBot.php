<?php
session_start();

$posteAutorises = [3, 4, 5];

if (!isset($_SESSION['poste']) || !in_array($_SESSION['poste'], $posteAutorises)) {
	header('Location: tdb.php');
	exit;
}