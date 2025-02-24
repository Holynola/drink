<?php

function delPaiement($idTablePay, $tablePay) {
    
    include 'dbConf.php';

    $sql = "DELETE FROM paiement WHERE idTablePay = :idTablePay AND tablePay = :tablePay";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':idTablePay', $idTablePay);
    $stmt->bindParam(':tablePay', $tablePay);

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