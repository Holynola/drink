<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'dbConf.php';
include 'recupAll.php';
include 'mttConv.php';
include 'stkFunc.php';

if (isset($_POST['mtt']) && ($_POST['mtr'])) {

    // Conversion des montants en numérique
    $mtt = $_POST['mtt'];
    $mttC = mttConversion($mtt); // Montant total

    $mtr = $_POST['mtr'];
    $mtrC = mttConversion($mtr); // Montant réglé

    if (isset($_POST['facture']) && ($_POST['facture'] !== '')) {
        $factureC = $_POST['facture'];
    } else {
        $factureC = NULL;
    }

    $serviceC = $_SESSION['service'];
    $fourC = $_POST['four'];
    $madebyC = $_POST['madeby'];
    $datemadeC = $_POST['datemade'];
    $savebyC = $_SESSION['idUser'];
    $datesaveC = date('Y-m-d H:i:s');

    $sql = "INSERT INTO commande (serviceC, mttC, mtrC, fourC, factureC, madebyC, datemadeC, savebyC, pointC, datesaveC) VALUES (:serviceC, :mttC, :mtrC, :fourC, :factureC, :madebyC, :datemadeC, :savebyC, NULL, :datesaveC)";

    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':serviceC', $serviceC);
    $stmt->bindParam(':mttC', $mttC);
    $stmt->bindParam(':mtrC', $mtrC);
    $stmt->bindParam(':fourC', $fourC);
    $stmt->bindParam(':factureC', $factureC);
    $stmt->bindParam(':madebyC', $madebyC);
    $stmt->bindParam(':datemadeC', $datemadeC);
    $stmt->bindParam(':savebyC', $savebyC);
    $stmt->bindParam(':datesaveC', $datesaveC);

    try {
        $stmt->execute();

        require_once 'addStk.php';
        
        $message = "Votre commande a bien été enregistrée.";
        $url = "../pages/cmdes.php?msg=" . urldecode($message);
        header("Location: " . $url);
        exit;

    } catch (PDOException $e) {
        $mess = "Erreur ! Veuillez réessayer plus tard";
        $urls = '../pages/cmdes.php?msg=' . urldecode($mess);
        die("Error executing SQL query: " . $e->getMessage());
    }

} else {
    header("Location: ../pages/cmdes.php");
    exit;
}