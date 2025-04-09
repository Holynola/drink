<?php

// Supprimer les bénéfices enregistrés
$requete = "DELETE FROM benefice WHERE ventBf = :ventBf";
$stmt = $bdd->prepare($requete);
$stmt->bindParam(':ventBf', $idV);
$stmt->execute();

// Supprimer les produits vendus
$requete = "DELETE FROM produit WHERE ventPr = :ventPr";
$stmt = $bdd->prepare($requete);
$stmt->bindParam(':ventPr', $idV);
$stmt->execute();