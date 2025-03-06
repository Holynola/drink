<?php

include 'dbConf.php';

if (isset($_GET['id'])) {

    $idCs = $_GET['id'];

    // Suppression de la ligne
    $requete = "DELETE FROM consign WHERE idCs = :idCs";
    $stmt = $bdd->prepare($requete);
    $stmt->bindParam(':idCs', $idCs);

    try {
        $stmt->execute();

        $message = "Consignation supprimée avec succès.";
        $url = '../pages/consigns.php?msg=' . urldecode($message);
        header("Location: " . $url);
    } catch (PDOException $e) {
        $mess = "Erreur ! Veuillez réessayer plus tard";
        $urls = '../pages/consigns.php?msg=' . urldecode($mess);
        die("Error executing SQL query: " . $e->getMessage());
    }

} else {
    header("Location: ../pages/consigns.php");
    exit;
}