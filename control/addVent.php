<?php

include 'dbConf.php';
include 'mttConv.php';
include 'stkFunc.php';
include 'prodFunc.php';
include 'recupAll.php';
include 'mdfStk.php';
include 'addBenef.php';

if (isset($_POST['mtt']) && ($_POST['mtr'])) {

    // Conversion des montants en numérique
    $mtt = $_POST['mtt'];
    $mttV = mttConversion($mtt); // Montant recette

    $mtr = $_POST['mtr'];
    $mtrV = mttConversion($mtr); // Montant reçu

    if ($_POST['getby'] !== '') {
        $getbyV = $_POST['getby'];
    } else {
        $getbyV = null;
    }

    if ($_POST['det'] !== '') {
        $detailV = $_POST['det'];
    } else {
        $detailV = null;
    }

    $serviceV = $_SESSION['service'];
    $madebyV = $_POST['madeby'];
    $datemadeV = $_POST['datemade'];
    $savebyV = $_SESSION['idUser'];
    $datesaveV = date('Y-m-d H:i:s');

    $sql = "INSERT INTO inventory (serviceV, mttV, mtrV, detailV, getbyV, madebyV, datemadeV, savebyV, pointV, datesaveV) VALUES (:serviceV, :mttV, :mtrV, :detailV, :getbyV, :madebyV, :datemadeV, :savebyV, NULL, :datesaveV)";

    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':serviceV', $serviceV);
    $stmt->bindParam(':mttV', $mttV);
    $stmt->bindParam(':mtrV', $mtrV);
    $stmt->bindParam(':detailV', $detailV);
    $stmt->bindParam(':getbyV', $getbyV);
    $stmt->bindParam(':madebyV', $madebyV);
    $stmt->bindParam(':datemadeV', $datemadeV);
    $stmt->bindParam(':savebyV', $savebyV);
    $stmt->bindParam(':datesaveV', $datesaveV);

    try {
        $stmt->execute();

        require_once 'addProd.php';
        
        $message = "Votre inventaire a bien été enregistré.";
        $url = "../pages/invents.php?msg=" . urldecode($message);
        header("Location: " . $url);
        exit;

    } catch (PDOException $e) {
        $mess = "Erreur ! Veuillez réessayer plus tard";
        $urls = '../pages/invents.php?msg=' . urldecode($mess);
        die("Error executing SQL query: " . $e->getMessage());
    }

} else {
    header("Location: ../pages/invents.php");
    exit;
}