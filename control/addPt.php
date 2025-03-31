<?php

include 'dbConf.php';
include 'mttConv.php';
include 'recupAll.php';

if (isset($_POST['mtt']) && ($_POST['mtv'])) {

	// Conversion des montants en numérique
    $mtt = $_POST['mtt'];
    $mttP = mttConversion($mtt); // Montant recette

    $mtv = $_POST['mtv'];
    $mtvP = mttConversion($mtv); // Montant versé

    $mank = $_POST['mank'];
    $mankP = mttConversion($mank); // Montant versé

    if ($_POST['det'] !== '') {
    	$observP = $_POST['det'];
    } else {
    	$observP = null;
    }

    $serviceP = $_SESSION['service'];
    $getbyP = $_POST['getby'];
    $madebyP = $_POST['madeby'];
    $datemadeP = $_POST['datemade'];
    $savebyP = $_SESSION['idUser'];
    $datesaveP = date('Y-m-d H:i:s');

    $sql = "INSERT INTO points (serviceP, mttP, mtvP, mankP, observP, getbyP, madebyP, datemadeP, savebyP, datesaveP) VALUES (:serviceP, :mttP, :mtvP, :mankP, :observP, :getbyP, :madebyP, :datemadeP, :savebyP, :datesaveP)";

    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':serviceP', $serviceP);
    $stmt->bindParam(':mttP', $mttP);
    $stmt->bindParam(':mtvP', $mtvP);
    $stmt->bindParam(':mankP', $mankP);
    $stmt->bindParam(':observP', $observP);
    $stmt->bindParam(':getbyP', $getbyP);
    $stmt->bindParam(':madebyP', $madebyP);
    $stmt->bindParam(':datemadeP', $datemadeP);
    $stmt->bindParam(':savebyP', $savebyP);
    $stmt->bindParam(':datesaveP', $datesaveP);

    try {
    	$stmt->execute();

    	require_once 'savePt.php';

    	$message = "Votre point a bien été enregistré.";
        $url = "../pages/points.php?msg=" . urldecode($message);
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