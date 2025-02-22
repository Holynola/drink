<?php

function addLog($userLg, $posteLg) {

    include 'dbConf.php';

    // Get the current date and time
    $datesaveLg = date('Y-m-d H:i:s');

    // Préparation de la requête SQL
    $sql = "INSERT INTO logs (userLg, posteLg, datesaveLg) VALUES (:userLg, :posteLg, :datesaveLg)";
    $stmt = $bdd->prepare($sql);

    // Liaison des paramètres avec les valeurs réelles
    $stmt->bindParam(':userLg', $userLg);
    $stmt->bindParam(':posteLg', $posteLg);
    $stmt->bindParam(':datesaveLg', $datesaveLg);

    // Exécution de la requête
    if ($stmt->execute()) {
        return true;
    } else {
        echo "Erreur d'insertion : " . $stmt->errorInfo()[2];
        return false;
    }

    // Fermeture de la connexion (recommandé)
    $bdd = null;
}