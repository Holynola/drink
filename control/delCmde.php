<?php

include 'dbConf.php';
include 'delPay.php';

if (isset($_GET['idC'])) {

    $idC = $_GET['idC'];

    // Suppression de la ligne
    $requete = "DELETE FROM commande WHERE idC = :idC";
    $stmt = $bdd->prepare($requete);
    $stmt->bindParam(':idC', $idC);

    // Execute the SQL statement
    try {
        $stmt->execute();

        delPaiement($idC, 'commande');

        $message = "Commande supprimée avec succès.";
        $url = '../pages/cmdes.php?msg=' . urldecode($message);
        header("Location: " . $url);
    } catch (PDOException $e) {
        $mess = "Erreur ! Veuillez réessayer plus tard";
        $urls = '../pages/cmdes.php?msg=' . urldecode($mess);
        die("Error executing SQL query: " . $e->getMessage());
    }

} else {
    header("Location: ../pages/cmdes.php");
    exit;
}