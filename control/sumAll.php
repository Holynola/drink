<?php

function sumDon($table, $colonne, $condition = null) {
  
    include('dbConf.php');
  
    // Préparer la requête SQL pour la somme
    $requete = "SELECT SUM($colonne) AS somme FROM $table";
  
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
  
    // Extraire la somme de la colonne du résultat
    $somme = $resultat->fetchColumn();
  
    // Fermer la connexion à la base de données
    $bdd = null;
  
    // Renvoyer la somme
    return $somme;
}
