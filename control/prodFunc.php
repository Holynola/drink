<?php

function addProduit($servicePr, $ventPr, $boissonPr, $qtePr, $mttPr) {

    // Inclusion du fichier de configuration de la base de données
    include 'dbConf.php';

    // Récupération de la date et de l'heure actuelles
    $datesavePr = date('Y-m-d H:i:s');

    // Requête SQL pour insérer les données dans la table `produit`
    $sql = "INSERT INTO produit (
                servicePr,
                ventPr, 
                boissonPr, 
                qtePr, 
                mttPr, 
                datesavePr
            ) VALUES (
                :servicePr,
                :ventPr, 
                :boissonPr, 
                :qtePr, 
                :mttPr, 
                :datesavePr
            )";

    // Préparation de la requête
    $stmt = $bdd->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(':servicePr', $servicePr);
    $stmt->bindParam(':ventPr', $ventPr);
    $stmt->bindParam(':boissonPr', $boissonPr);
    $stmt->bindParam(':qtePr', $qtePr);
    $stmt->bindParam(':mttPr', $mttPr);
    $stmt->bindParam(':datesavePr', $datesavePr);

    // Exécution de la requête
    if ($stmt->execute()) {
        return true; // Succès
    } else {
        // Affichage de l'erreur en cas d'échec
        echo "Erreur d'insertion : " . $stmt->errorInfo()[2];
        return false;
    }

    // Fermeture de la connexion (optionnel, car PDO la ferme automatiquement à la fin du script)
    $bdd = null;
}

?>