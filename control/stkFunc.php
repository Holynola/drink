<?php

function addStock($serviceSt, $BoissonSt, $qteSt, $cmdSt, $nbrebtleSt, $nbrecarsSt, $prixcSt) {

    // Inclusion du fichier de configuration de la base de données
    include 'dbConf.php';

    // Récupération de la date et de l'heure actuelles
    $datesaveSt = date('Y-m-d H:i:s');

    // Requête SQL pour insérer les données dans la table `stock`
    $sql = "INSERT INTO stock ( 
                serviceSt, 
                BoissonSt, 
                qteSt, 
                cmdSt, 
                nbrebtleSt, 
                nbrecarsSt, 
                prixcSt, 
                prixaSt, 
                savebySt, 
                datesaveSt
            ) VALUES (
                :serviceSt, 
                :BoissonSt, 
                :qteSt, 
                :cmdSt, 
                :nbrebtleSt, 
                :nbrecarsSt, 
                :prixcSt, 
                NULL, 
                NULL, 
                :datesaveSt
            )";

    // Préparation de la requête
    $stmt = $bdd->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(':serviceSt', $serviceSt);
    $stmt->bindParam(':BoissonSt', $BoissonSt);
    $stmt->bindParam(':qteSt', $qteSt);
    $stmt->bindParam(':cmdSt', $cmdSt);
    $stmt->bindParam(':nbrebtleSt', $nbrebtleSt);
    $stmt->bindParam(':nbrecarsSt', $nbrecarsSt);
    $stmt->bindParam(':prixcSt', $prixcSt);
    $stmt->bindParam(':datesaveSt', $datesaveSt);

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