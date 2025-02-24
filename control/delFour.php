<?php

include 'dbConf.php';

if (isset($_GET['idt'])) {
    $idF = $_GET['idt'];

    $statutF = 'DEL';

    $sql = "UPDATE fournisseur SET
            statutF = :statutF
            WHERE idF = :idF";
    
    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':statutF', $statutF);
    $stmt->bindParam(':idF', $idF);

    try {
        $stmt->execute();

        $message = "Le fournisseur a été supprimé avec succès.";
        $url = '../pages/suppliers.php?msg=' . urldecode($message);
        header("Location: " . $url);
        
    } catch (PDOException $e) {
        $mess = "Erreur ! Veuillez réessayer plus tard";
        $urls = '../pages/suppliers.php?msg=' . urldecode($mess);
        die("Error executing SQL query: " . $e->getMessage());
    }

} else {
    header("Location: ../pages/suppliers.php");
    exit;
}