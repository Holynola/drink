<?php

include 'dbConf.php';
include 'delPay.php';

if (isset($_GET['idDp'])) {

    $idDp = $_GET['idDp'];

    // Suppression de la ligne
    $requete = "DELETE FROM depense WHERE idDp = :idDp";
    $stmt = $bdd->prepare($requete);
    $stmt->bindParam(':idDp', $idDp);

    // Execute the SQL statement
    try {
        $stmt->execute();

        delPaiement($idDp, 'depense');

        $message = "Dépense supprimée avec succès.";
        $url = '../pages/dpnses.php?msg=' . urldecode($message);
        header("Location: " . $url);
    } catch (PDOException $e) {
        $mess = "Erreur ! Veuillez réessayer plus tard";
        $urls = '../pages/dpnses.php?msg=' . urldecode($mess);
        die("Error executing SQL query: " . $e->getMessage());
    }

} else {
    header("Location: ../pages/dpnses.php");
    exit;
}