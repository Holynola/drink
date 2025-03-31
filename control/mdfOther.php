<?php

$service = $_SESSION['service'];

// Inventaires
$requete = "UPDATE inventory SET pointV = NULL WHERE serviceV = :serviceV AND pointV = :pointV";
$stmt = $bdd->prepare($requete);
$stmt->bindParam(':pointV', $idP);
$stmt->bindParam(':serviceV', $service);
$stmt->execute();

// Règlements
$requete = "UPDATE reglement SET pointR = NULL WHERE serviceR = :serviceR AND pointR = :pointR";
$stmt = $bdd->prepare($requete);
$stmt->bindParam(':pointR', $idP);
$stmt->bindParam(':serviceR', $service);
$stmt->execute();

// Commandes
$requete = "UPDATE commande SET pointC = NULL WHERE serviceC = :serviceC AND pointC = :pointC";
$stmt = $bdd->prepare($requete);
$stmt->bindParam(':pointC', $idP);
$stmt->bindParam(':serviceC', $service);
$stmt->execute();

// Dépenses
$requete = "UPDATE depense SET pointDp = NULL WHERE serviceDp = :serviceDp AND pointDp = :pointDp";
$stmt = $bdd->prepare($requete);
$stmt->bindParam(':pointDp', $idP);
$stmt->bindParam(':serviceDp', $service);
$stmt->execute();

// Paiements
$requete = "UPDATE paiement SET pointPay = NULL WHERE servicePay = :servicePay AND pointPay = :pointPay";
$stmt = $bdd->prepare($requete);
$stmt->bindParam(':pointPay', $idP);
$stmt->bindParam(':servicePay', $service);
$stmt->execute();