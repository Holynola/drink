<?php

session_start();

date_default_timezone_set('Africa/Abidjan');

// Paramètres de connexion
$host = 'localhost'; // Nom de l'hôte
$dbname = 'ecole'; // Nom de la base de données
$user = 'root'; // Nom d'utilisateur
$pass = '101214Bureau'; // Mot de passe
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

// Connexion à la base de données
try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass, $options);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}