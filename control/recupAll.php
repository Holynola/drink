<?php

function recupDon($table, $condition = null) {
    
  include('dbConf.php');
  
  // Préparer la requête SQL
  $requete = "SELECT * FROM $table";
  
  // Si une condition est fournie, l'ajouter à la requête
  if ($condition !== null) {
      $requete .= " WHERE $condition";
  }

  // Exécuter la requête et récupérer les résultats
  $resultat = $bdd->query($requete);

  // Vérifier si la requête a réussi
  if ($resultat === false) {
      echo "Erreur lors de l'exécution de la requête : " . $bdd->errorInfo()[2];
      return false;
  }

  // Parcourir les résultats et les stocker dans un tableau
  $donnees = [];
  while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
      $donnees[] = $ligne;
  }

  // Fermer la connexion à la base de données
  $bdd = null;

  // Renvoyer le tableau des données
  return $donnees;
}