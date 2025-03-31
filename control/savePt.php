<?php

$service = $_SESSION['service'];

// Récupération de l'ID de la dernière ligne de la table 'points'
$sqlP = "SELECT idP FROM points ORDER BY idP DESC LIMIT 1";
$sqlP = $bdd->prepare($sqlP);
$sqlP->execute();
$idP = $sqlP->fetchColumn(); // ID Points

// Inventaires
$requete = "UPDATE inventory SET pointV = :pointV WHERE serviceV = :serviceV AND pointV IS NULL";
$stmt = $bdd->prepare($requete);
$stmt->bindParam(':pointV', $idP);
$stmt->bindParam(':serviceV', $service);
$stmt->execute();

// Règlements
$requete = "UPDATE reglement SET pointR = :pointR WHERE serviceR = :serviceR AND pointR IS NULL";
$stmt = $bdd->prepare($requete);
$stmt->bindParam(':pointR', $idP);
$stmt->bindParam(':serviceR', $service);
$stmt->execute();

// Commandes
$requete = "UPDATE commande SET pointC = :pointC WHERE serviceC = :serviceC AND pointC IS NULL";
$stmt = $bdd->prepare($requete);
$stmt->bindParam(':pointC', $idP);
$stmt->bindParam(':serviceC', $service);
$stmt->execute();

// Dépenses
$requete = "UPDATE depense SET pointDp = :pointDp WHERE serviceDp = :serviceDp AND pointDp IS NULL";
$stmt = $bdd->prepare($requete);
$stmt->bindParam(':pointDp', $idP);
$stmt->bindParam(':serviceDp', $service);
$stmt->execute();

// Paiements
$requete = "UPDATE paiement SET pointPay = :pointPay WHERE servicePay = :servicePay AND pointPay IS NULL";
$stmt = $bdd->prepare($requete);
$stmt->bindParam(':pointPay', $idP);
$stmt->bindParam(':servicePay', $service);
$stmt->execute();