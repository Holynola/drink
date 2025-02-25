<?php

include 'dbConf.php';

if (isset($_GET['idB'])) {

    $idB = $_GET['idB'];
    $statutB = 'DEL';

    $sql = "UPDATE boisson SET
            statutB = :statutB
            WHERE idB = :idB";
    
    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':statutB', $statutB);
    $stmt->bindParam(':idB', $idB);

    try {
        $stmt->execute();

        $message = "La boisson a été supprimée avec succès.";
        $url = '../pages/boissons.php?msg=' . urldecode($message);
        header("Location: " . $url);
        
    } catch (PDOException $e) {
        $mess = "Erreur ! Veuillez réessayer plus tard";
        $urls = '../pages/boissons.php?msg=' . urldecode($mess);
        die("Error executing SQL query: " . $e->getMessage());
    }

} else {
    header("Location: ../pages/boissons.php");
    exit;
}