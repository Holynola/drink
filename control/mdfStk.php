<?php

function updateStk($idSt, $venduSt) {
    // Connexion à la base de données
    include 'dbConf.php';

    // Requête de mise à jour
    $stmt = $bdd->prepare('UPDATE stock SET venduSt = :venduSt WHERE idSt = :idSt');
    
    $stmt->bindParam(':venduSt', $venduSt);
    $stmt->bindParam(':idSt', $idSt);
    
    $stmt->execute();

    $bdd = null;
}