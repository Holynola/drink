<?php

include 'dbConf.php';
include 'mttConv.php';

if (isset($_POST['mtt']) && ($_POST['madeby'])) {

    // Conversion de montant en numérique
    $mtt = $_POST['mtt'];
    $mttPay = mttConversion($mtt);

    $servicePay = $_SESSION['service'];
    $idTablePay = $_GET['idp'];
    $tablePay = 'depense';
    $madebyPay = $_POST['madeby'];
    $datemadePay = $_POST['datemade'];
    $savebyPay = $_SESSION['idUser'];
    $datesavePay = date('Y-m-d H:i:s');

    $sql = "INSERT INTO paiement (servicePay, idTablePay, tablePay, mttPay, madebyPay, datemadePay, savebyPay, pointPay, datesavePay) VALUES (:servicePay, :idTablePay, :tablePay, :mttPay, :madebyPay, :datemadePay, :savebyPay, NULL, :datesavePay)";

    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':servicePay', $servicePay);
    $stmt->bindParam(':idTablePay', $idTablePay);
    $stmt->bindParam(':tablePay', $tablePay);
    $stmt->bindParam(':mttPay', $mttPay);
    $stmt->bindParam(':madebyPay', $madebyPay);
    $stmt->bindParam(':datemadePay', $datemadePay);
    $stmt->bindParam(':savebyPay', $savebyPay);
    $stmt->bindParam(':datesavePay', $datesavePay);

    try {
        $stmt->execute();
        
        $message = "Votre paiement a bien été enregistré.";
        $url = "../pages/dpnses.php?msg=" . urldecode($message);
        header("Location: " . $url);
        exit;

    } catch (PDOException $e) {
        $mess = "Erreur ! Veuillez réessayer plus tard";
        $urls = '../pages/dpnses.php?msg=' . urldecode($mess);
        die("Error executing SQL query: " . $e->getMessage());
    }

} else {
    header("Location: ../pages/dpnses.php");
    exit;
}