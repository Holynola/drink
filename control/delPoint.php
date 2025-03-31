<?php

include 'dbConf.php';
include 'recupAll.php';

if (isset($_GET['idP'])) {

	$idP = $_GET['idP'];

	// Suppression de la ligne
    $requete = "DELETE FROM points WHERE idP = :idP";
    $stmt = $bdd->prepare($requete);
    $stmt->bindParam(':idP', $idP);

    try {
    	$stmt->execute();

    	require_once 'mdfOther.php';

    	$message = "Le point a été supprimé avec succès.";
        $url = '../pages/points.php?msg=' . urldecode($message);
        header("Location: " . $url);
        exit;
    } catch (PDOException $e) {
        $mess = "Erreur ! Veuillez réessayer plus tard";
        $urls = '../pages/points.php?msg=' . urldecode($mess);
        header("Location: " . $urls);
        die("Error executing SQL query: " . $e->getMessage());
    }

} else {
	header("Location: ../pages/points.php");
    exit;
} 