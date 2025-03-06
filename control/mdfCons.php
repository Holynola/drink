<?php

include 'dbConf.php';

if (isset($_GET['id'])) {

    $idCs = $_GET['id'];
    $statutCs = "OK";
    $madebyCs = $_SESSION['idUser'];
    $datemadeCs = date('Y-m-d H:i:s');

    $sql = "UPDATE consign SET
            statutCs = :statutCs,
            madebyCs = :madebyCs,
            datemadeCs = :datemadeCs
            WHERE idCs = :idCs";
    
    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':statutCs', $statutCs);
    $stmt->bindParam(':madebyCs', $madebyCs);
    $stmt->bindParam(':datemadeCs', $datemadeCs);
    $stmt->bindParam(':idCs', $idCs);

    try {
        $stmt->execute();

        $message = "La consignation a été récupérée.";
        $url = '../pages/consigns.php?msg=' . urldecode($message);
        header("Location: " . $url);
    } catch (PDOException $e) {
        $mess = "Erreur ! Veuillez réessayer plus tard";
        $urls = '../pages/consigns.php?msg=' . urldecode($mess);
        die("Error executing SQL query: " . $e->getMessage());
    }

} else {
    header("Location: ../index.php");
    exit;
}