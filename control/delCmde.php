<?php

include 'dbConf.php';
include 'delPay.php';
include 'recupAll.php';
include 'sumAll.php';

if (isset($_GET['idC'])) {

    $idC = $_GET['idC'];

    require_once 'delStock.php';

    // Suppression de la ligne
    $requete = "DELETE FROM commande WHERE idC = :idC";
    $stmt = $bdd->prepare($requete);
    $stmt->bindParam(':idC', $idC);

    // Exécuter la requête SQL
    try {
        $stmt->execute();

        delPaiement($idC, 'commande');

        $message = "Commande supprimée avec succès.";
        $url = '../pages/cmdes.php?msg=' . urlencode($message);
        header("Location: " . $url);
        exit(); // Arrêter l'exécution du script ici
    } catch (PDOException $e) {
        $mess = "Erreur ! Veuillez réessayer plus tard";
        $urls = '../pages/cmdes.php?msg=' . urlencode($mess);
        header("Location: " . $urls);
        exit(); // Arrêter l'exécution du script ici
    }

} else {
    header("Location: ../pages/cmdes.php");
    exit();
}