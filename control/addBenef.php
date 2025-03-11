<?php

function addBenefice($serviceBf, $ventBf, $boissonBf, $qteBf, $mtvBf, $mtaBf) {

    include 'dbConf.php'; // Inclure la configuration de la base de données

    // Get the current date and time
    $datesaveBf = date('Y-m-d H:i:s');

    // Préparation de la requête SQL
    $sql = "INSERT INTO benefice (serviceBf, ventBf, boissonBf, qteBf, mtvBf, mtaBf, datesaveBf) 
            VALUES (:serviceBf, :ventBf, :boissonBf, :qteBf, :mtvBf, :mtaBf, :datesaveBf)";
    $stmt = $bdd->prepare($sql);

    // Liaison des paramètres avec les valeurs réelles
    $stmt->bindParam(':serviceBf', $serviceBf);
    $stmt->bindParam(':ventBf', $ventBf);
    $stmt->bindParam(':boissonBf', $boissonBf);
    $stmt->bindParam(':qteBf', $qteBf);
    $stmt->bindParam(':mtvBf', $mtvBf);
    $stmt->bindParam(':mtaBf', $mtaBf);
    $stmt->bindParam(':datesaveBf', $datesaveBf);

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

?>