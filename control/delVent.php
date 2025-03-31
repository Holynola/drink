<?php

include 'dbConf.php';
include 'recupAll.php';
include 'mdfStk.php';

if (isset($_GET['idV'])) {

    $idV = $_GET['idV'];

    // Suppression de la ligne
    $requete = "DELETE FROM inventory WHERE idV = :idV";
    $stmt = $bdd->prepare($requete);
    $stmt->bindParam(':idV', $idV);

    $service = $_SESSION['service'];

    // Execute the SQL statement
    try {
        $stmt->execute();

        require_once 'delOther.php';

        $message = "L'inventaire a été supprimé avec succès.";
        $url = '../pages/invents.php?msg=' . urldecode($message);
        header("Location: " . $url);
        exit;
    } catch (PDOException $e) {
        $mess = "Erreur ! Veuillez réessayer plus tard";
        $urls = '../pages/invents.php?msg=' . urldecode($mess);
        header("Location: " . $urls);
        die("Error executing SQL query: " . $e->getMessage());
    }

} else {
    header("Location: ../pages/invents.php");
    exit;
}