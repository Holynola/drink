<?php

function compDon($table, $condition = null) {
  
    include('dbConf.php');
  
    // Préparer la requête SQL pour compter les lignes
    $requete = "SELECT COUNT(*) FROM $table";
  
    // Si une condition est fournie, l'ajouter à la requête
    if ($condition !== null) {
        $requete .= " WHERE $condition";
    }
  
    // Exécuter la requête et récupérer le résultat
    $resultat = $bdd->query($requete);
  
    // Vérifier si la requête a réussi
    if ($resultat === false) {
        echo "Erreur lors de l'exécution de la requête : " . $bdd->errorInfo()[2];
        return false;
    }
  
    // Extraire le nombre de lignes du résultat
    $nombreLignes = $resultat->fetchColumn();
  
    // Fermer la connexion à la base de données
    $bdd = null;
  
    // Renvoyer le nombre de lignes
    return $nombreLignes;
}
