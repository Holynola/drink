<?php

function recupStock($requete) {
    // Inclure la configuration de la base de données
    include('dbConf.php');

    try {
        // Préparer et exécuter la requête SQL
        $stmt = $bdd->prepare($requete);
        $stmt->execute();

        // Récupérer les résultats sous forme de tableau associatif
        $donnees = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retourner les données
        return $donnees;
    } catch (PDOException $e) {
        // Gestion des erreurs
        echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
        return false;
    } finally {
        // Fermer la connexion à la base de données
        $bdd = null;
    }
}

?>