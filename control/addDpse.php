<?php

include 'dbConf.php';
include 'mttConv.php';

if (isset($_POST['mtt']) && ($_POST['madeby'])) {

    // Conversion des montants en numérique
    $mtt = $_POST['mtt'];
    $mttDp = mttConversion($mtt);

    $mtr = $_POST['reg'];
    $mtrDp = mttConversion($mtr);

    $serviceDp = $_SESSION['service'];
    $detailDp = $_POST['det'];
    $madebyDp = $_POST['madeby'];
    $datemadeDp = $_POST['datemade'];
    $savebyDp = $_SESSION['idUser'];
    $datesaveDp = date('Y-m-d H:i:s');

    $sql = "INSERT INTO depense (serviceDp, mttDp, mtrDp, detailDp, madebyDp, datemadeDp, savebyDp, pointDp, datesaveDp) VALUES (:serviceDp, :mttDp, :mtrDp, :detailDp, :madebyDp, :datemadeDp, :savebyDp, NULL, :datesaveDp)";

    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':serviceDp', $serviceDp);
    $stmt->bindParam(':mttDp', $mttDp);
    $stmt->bindParam(':mtrDp', $mtrDp);
    $stmt->bindParam(':detailDp', $detailDp);
    $stmt->bindParam(':madebyDp', $madebyDp);
    $stmt->bindParam(':datemadeDp', $datemadeDp);
    $stmt->bindParam(':savebyDp', $savebyDp);
    $stmt->bindParam(':datesaveDp', $datesaveDp);

    try {
        $stmt->execute();
        
        $message = "Votre dépense a bien été enregistrée.";
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