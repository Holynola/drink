<?php

function addModify($tableM, $idtableM, $actionM, $auteurM) {

    include 'dbConf.php';

    // Get the current date and time
    $datesaveM = date('Y-m-d H:i:s');

    // Préparation de la requête SQL
    $sql = "INSERT INTO modif (tableM, idtableM, actionM, auteurM, datesaveM) VALUES (:tableM, :idtableM, :actionM, :auteurM, :datesaveM)";
    $stmt = $bdd->prepare($sql);

    // Liaison des paramètres avec les valeurs réelles
    $stmt->bindParam(':tableM', $tableM);
    $stmt->bindParam(':idtableM', $idtableM);
    $stmt->bindParam(':actionM', $actionM);
    $stmt->bindParam(':auteurM', $auteurM);
    $stmt->bindParam(':datesaveM', $datesaveM);

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